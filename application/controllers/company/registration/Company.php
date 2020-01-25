<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//admin controller
class Company extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_Model');
	}
	
	public function index($id='')
	{

		if($id!=''){
			$result = $this->Company_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');

				redirect('company/registration/company'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();


			if($requestData['submit']=='submit'){
				$data 	=  $this->Company_Model->action($requestData);
				if($data) $message = 'Company '.(($id=='') ? 'Registered' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Company_Model->changestatus($requestData);
				$message		= 	'Company deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('company/registration/company'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		$pagedata['worktype'] 		= $this->config->item('worktype');
		$pagedata['specialization']	= $this->config->item('specialization');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('company/registration/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function ajaxregistration()
	{
		$post 	= $this->input->post();
		$result = $this->Company_Model->action($post);
		
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
		$totalcount 	= $this->Company_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Company_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'name' 		=> 	$result['name'],
										'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'	=> 	'
															<div class="table-action">
																<a href="'.base_url().'company/registration/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
		public function profile_page()
	{
		$data['content'] 			= $this->load->view('company/profile/index');
		
	}
}
