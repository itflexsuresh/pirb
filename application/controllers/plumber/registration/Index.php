<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
	}
	
	public function index()
	{
		$userid			= 	$this->getUserID();
		$userdata		= 	$this->getUserDetails();
		
		if($this->input->post()){
			$requestData 			= 	$this->input->post();
			$requestData['user_id'] = 	$userid;
			$requestData['flag'] 	= 	'1';
			$data 					=  	$this->Plumber_Model->action($requestData);
			
			if(isset($data)) $this->session->set_flashdata('success', 'Waiting for approval');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('plumber/profile/index'); 
		}
		
	
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['qualificationroute'] = $this->getQualificationRouteList();
		$pagedata['plumberrates'] 		= $this->getPlumberRates();
		$pagedata['company'] 			= $this->getCompanyList();
		
		$pagedata['titlesign'] 			= $this->config->item('titlesign');
		$pagedata['gender'] 			= $this->config->item('gender');
		$pagedata['racial'] 			= $this->config->item('racial');
		$pagedata['yesno'] 				= $this->config->item('yesno');
		$pagedata['othernationality'] 	= $this->config->item('othernationality');
		$pagedata['homelanguage'] 		= $this->config->item('homelanguage');
		$pagedata['disability'] 		= $this->config->item('disability');
		$pagedata['citizen'] 			= $this->config->item('citizen');
		$pagedata['deliverycard'] 		= $this->config->item('deliverycard');
		$pagedata['employmentdetail'] 	= $this->config->item('employmentdetail');
		$pagedata['designation1'] 		= $this->config->item('designation1');
		$pagedata['criminalact'] 		= $this->config->item('criminalact');
		$pagedata['registerprocedure'] 	= $this->config->item('registerprocedure');
		$pagedata['acknowledgement'] 	= $this->config->item('acknowledgement');
		$pagedata['codeofconduct'] 		= $this->config->item('codeofconduct');
		$pagedata['declaration'] 		= $this->config->item('declaration');
		$pagedata['userid'] 			= $userid;
		$pagedata['userdata'] 			= $userdata;
		$pagedata['result'] 			= $this->Plumber_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
		
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 				= $this->load->view('plumber/registration/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function ajaxregistration()
	{
		$post 				= $this->input->post();
		$post['user_id'] 	= $this->getUserID();
		$result = $this->Plumber_Model->action($post);
		
		if($result){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxskillaction()
	{
		$post 				= $this->input->post();
		
		if(isset($post['action']) && $post['action']=='delete'){
			$result = $this->Plumber_Model->deleteSkillList($post['skillid']);
		}else{
			$post['user_id'] 	= $this->getUserID();
			if(isset($post['action']) && $post['action']=='edit'){
				$result['skillid'] = $post['skillid'];
			}else{
				$result = $this->Plumber_Model->action($post);
			}
			
			$result = $this->Plumber_Model->getSkillList('row', ['id' => $result['skillid']]);
		}
		
		if($result){
			// $result['date'] = date('d-m-Y',strtotime($result['date']));
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
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
