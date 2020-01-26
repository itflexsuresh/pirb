<?php
//Resellers Controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resellers_Model');
	}
	
	public function index()
	{
		$userid			= 	$this->getUserID();
		$userdata		= 	$this->getUserDetails();
		
		if($this->input->post()){
			$requestData 			= 	$this->input->post();
			$data 					=  	$this->Resellers_Model->action($requestData);
			
			if(isset($data)) $this->session->set_flashdata('success', 'Waiting for approval');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('resellers/profile/index'); 
		}
		
	
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['userid'] 			= $userid;
		$pagedata['userdata'] 			= $userdata;
		$pagedata['result'] 			= $this->Resellers_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
		
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 				= $this->load->view('resellers/profile/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTInstallationType()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Resellers_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Resellers_Model->getList('all', ['status' => ['0','1']]+$post);
		
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
