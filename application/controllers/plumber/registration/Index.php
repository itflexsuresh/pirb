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
		$userid		= 	$this->getUserID();
		$result		= 	$this->Plumber_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
		
		if(!$result){
			redirect('admin/plumber/index');
		}
		
		if($result['formstatus']=='1'){
			redirect('plumber/profile/index'); 
		}
		
		if($this->input->post()){
			$requestData 				= 	$this->input->post();
			$requestData['user_id']	 	= 	$userid;
			$requestData['formstatus'] 	= 	'1';
			$requestData['status'] 		= 	'1';
			$data 						=  	$this->Plumber_Model->action($requestData);
			
			if(isset($data)) $this->session->set_flashdata('success', 'Thanks for submitting the application. You will get notified through email about the application status.');
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
		$pagedata['result'] 			= $result;
		
		$data['plugins']				= ['sweetalert', 'validation', 'datepicker', 'inputmask', 'select2'];
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
	
	public function ajaxplumberdata()
	{
		$userid		= 	$this->getUserID();
		$result		= 	$this->Plumber_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
		
		if($result){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
	}
}
