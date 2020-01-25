<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systemusers extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Systemusers_Model');
	}
	
	public function index($id='')
	{		
		if($id!=''){
			$result = $this->Systemusers_Model->getList('row', ['u_id' => $id, 'u_status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/installationtype'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Systemusers_Model->action($requestData);
				if($data) $message = 'Installation Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Systemusers_Model->changestatus($requestData);
				$message		= 	'Installation Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/installationtype'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/systemsetup/systemusers/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTSystemusersList()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Systemusers_Model->getList('count', ['u_status' => ['0','1']]+$post);
		$results 		= $this->Systemusers_Model->getList('all', ['u_status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'u_name' 				=> 	$result['u_name'],
										'u_surname' 			=> 	$result['u_surname'],
										'u_email' 				=> 	$result['u_email'],
										'u_password_raw' 		=> 	$result['u_password_raw'],
										'u_type' 				=> 	$result['u_type'],
										'action'				=> 	'
															<div class="table-action">
																<a href="'.base_url().'admin/systemsetup/systemusers/systemuseredit/index/'.$result['u_id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>	
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
	
	public function action($id='')
	{
		if($id!=''){
			$result = $this->Systemusers_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/systemsetup/systemusers/systemusers/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Systemusers_Model->action($requestData);
				if($data) $message = 'SystemusersModel Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Systemusers_Model->changestatus($requestData);
				$message		= 	'SystemusersModel Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/systemusers/systemusers'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		//$pagedata['roletype']       = $this->getRoletype();
		$pagedata['roletype'] = $this->config->item('roletype');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/systemsetup/systemusers/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
