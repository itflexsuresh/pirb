<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CC_Model');
		$this->load->model('Company_Model');
		$this->load->model('Communication_Model');
	}
	
	public function index()
	{
		$userid		= 	$this->getUserID();
		$result		= 	$this->Company_Model->getList('row', ['id' => $userid, 'type' => '4', 'status' => ['0','1']]);
		//die;
		
		if(!$result){
			redirect('admin/company/index');
		}
		
		if($result['formstatus']=='1'){
			redirect('company/profile/index'); 
		}
		
		if($this->input->post()){
			$requestData 				= 	$this->input->post();
			if (isset($requestData['save1'])) {
				$requestData['formstatus'] 	= 	'0';
				$mark ="Application saved.";
			}else{
				$requestData['formstatus'] 	= 	'1';
				$mark ="Thanks for submitting the application.";
			}

			$requestData['user_id']	 	= 	$userid;
			
			$requestData['status'] 		= 	'1';
			$data 						=  	$this->Company_Model->action($requestData);
			
			if(isset($data)){
				/*
				$companydata 		= $this->Company_Model->getList('row', ['id' => $userid]);				
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '4', 'emailstatus' => '1']);
				
				if($notificationdata){
					$body 	= str_replace(['{Plumbers Name and Surname}', '{Company}'], [$companydata['name'].' '.$companydata['surname'], $companydata['companyname']], $notificationdata['email_body']);
					$this->CC_Model->sentMail($companydata['email'], $notificationdata['subject'], $body);
				}
				*/
				$this->session->set_flashdata('success', $mark);
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			if ($mark =="Application saved.") {
				redirect('company/registration/index');
			}else{
				redirect('company/profile/index'); 
			}			
		}
		
	
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['worktype'] 			= $this->config->item('worktype');
		$pagedata['specialization']		= $this->config->item('specialization');
		$pagedata['pagetype'] 			= 'registration';
		$pagedata['roletype'] 			= $this->config->item('rolecompany');
		$pagedata['result'] 			= $result;
		
		$pagedata['commoncompany'] 		= $this->load->view('common/company', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins']				= ['sweetalert', 'validation', 'datepicker', 'inputmask', 'select2'];
		$data['content'] 				= $this->load->view('company/registration/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function ajaxOTP(){
		if ($this->input->post()) {
			$requestData1 = $this->input->post();
			$requestData2['user_id'] 				=	$requestData1['user_id'];
			$requestData2['mobile'] 				= 	$requestData1['mobile_phone'];
			$requestData2['otp'] 					= 	rand ( 10000 , 99999 );
			
			$result = $this->Company_Model->ajaxOTP($requestData2);

			$data = array('otp' => $requestData2['otp']);
			echo json_encode($data);
		}
	}

	public function OTPVerification(){
		if ($this->input->post()) {
			$requestData 						= $this->input->post();
			$result 							= $this->Company_Model->OTPVerification($requestData);
			echo $result;
		}
	}


}
