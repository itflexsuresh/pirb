<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subtype  extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subtype_Model');

		$this->checkUserPermission('3', '1');
	}
	
	public function index($id='')
	{
		if($id!=''){
			$this->checkUserPermission('3', '2', '1');

			$result = $this->Subtype_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/subtype'); 
			}
		}
		
		if($this->input->post()){
			$this->checkUserPermission('3', '2', '1');

			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Subtype_Model->action($requestData);
				if($data) $message = 'Sub Type'.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Subtype_Model->changestatus($requestData);
				$message		= 	'Sub Type Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/subtype'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['installationtypelist'] 	= $this->getInstallationTypeList();
		$pagedata['checkpermission'] 		= $this->checkUserPermission('3', '2');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/administration/subtype/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTSubtype()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Subtype_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Subtype_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('3', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/administration/subtype/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}

				$totalrecord[] = 	[
										'installationtypename' 		=> 	$result['installationtypename'],
										'name' 						=> 	$result['name'],
										'status' 					=> 	$this->config->item('statusicon')[$result['status']],
										'action'					=> 	$action
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

	public function SubTypeValidation()
	{
		$requestData 		= $this->input->post();
		$data 				= $this->Subtype_Model->subValidator($requestData);
		
		echo $data;
	}
}
