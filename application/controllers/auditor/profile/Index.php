<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
	}
	
	public function index($id='')
	{

		if($id!=''){
			$result = $this->Plumber_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('plumber/registration'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Plumber_Model->action($requestData);
				if($data) $message = 'Installation Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Plumber_Model->changestatus($requestData);
				$message		= 	'Installation Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('plumber/registration'); 
		}
		
		// $pagedata['notification'] 	= $this->getNotification();
		// $pagedata['empty_arr'] = [];
		// $pagedata['fName'] = $this->getProvinceList();
		$pagedata['fName'] = $this->config->item('name');
		$pagedata['lName'] = $this->config->item('surname');
		$pagedata['idNo'] = $this->config->item('id_Number');
		$pagedata['photoFile'] = $this->config->item('racial');
		$pagedata['email'] = $this->config->item('yesno');
		$pagedata['pin'] = $this->config->item('othernationality');
		$pagedata['phoneWork'] = $this->config->item('homelanguage');
		$pagedata['phoneMobile'] = $this->config->item('disability');
		$pagedata['companyName'] = $this->config->item('citizen');
		$pagedata['companyRegNo'] = $this->config->item('deliverycard');
		$pagedata['vatRegNo'] = $this->config->item('employmentdetail');
		$pagedata['addressLine1'] = $this->config->item('designation');
		$pagedata['province'] = $this->config->item('designation');
		$pagedata['city'] = $this->config->item('designation');
		$pagedata['Suburb'] = $this->config->item('designation');
		$pagedata['areaCode'] = $this->config->item('designation');
		$pagedata['CompanyLogo'] = $this->config->item('designation');
		$pagedata['bankName'] = $this->config->item('designation');
		$pagedata['accName'] = $this->config->item('designation');
		$pagedata['branchCode'] = $this->config->item('designation');
		$pagedata['branchCode'] = $this->config->item('designation');
		$pagedata['accNumber'] = $this->config->item('designation');
		$pagedata['accType'] = $this->config->item('designation');


		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/profile/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function ajaxregistration()
	{
		$post 	= $this->input->post();
		$result = $this->Plumber_Model->action($post);
		
		if($result){
			$json = ['status' => '1'];
		}else{
			$json = ['status' => '0'];
		}
		
		return json_encode($json);
	}
	
	public function DTInstallationType()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Plumber_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'name' 		=> 	$result['name'],
										'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'	=> 	'
															<div class="table-action">
																<a href="'.base_url().'plumber/registration/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
															</div>
														'
									];
			}
		}
		
		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}
}
