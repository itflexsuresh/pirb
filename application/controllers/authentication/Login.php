<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
		$this->load->model('CC_Model');
		$this->load->library('encryption');
	}
	
	public function index()
	{
		if($this->input->post())
		{	
			$requestData 	= $this->input->post();
			
			if($requestData['submit']=='login'){				
				$data = $this->Users_Model->login($requestData);
				
				$data = $this->Users_Model->getUserDetails('row', ['id' => $data['result']]);
				
				$status			= $data['status'];
				$mailstatus		= $data['mailstatus'];
				$id				= $data['id'];
				
				if($mailstatus=='1'){						
					$this->session->set_userdata('userid', $id);						
					$this->middleware('1');
				}elseif($mailstatus=='0'){
					$this->session->set_flashdata('error', 'Please activate your account by verifying the link sent to your E-mail id.');
				}else{	
					$this->session->set_flashdata('error', 'Invalid Credentials.');
				}
				
			}elseif($requestData['submit']=='register'){
				$requestData['id'] 		= '';
				$requestData['status'] 	= '0';
				$requestData['type'] 	= '3';
				$data 			= $this->Users_Model->actionUsers($requestData);
				
				if($data){
					$encryptid 	= 	$this->encryption->encrypt($data);
					$subject 	= 	'Email Verification';
					$message 	= 	'<div>Hi,</div>

									<div>Please Click the below link to verify your account.</div>
									<div><a href="'.base_url().'authentication/login/verification?id='.$encryptid.'">Click Here</a></div>
									<br>
									<div>Best Regards</div>
									<br>
									<div>Lea Smith</div>
									Chairman of the PIRB';
				
					$this->CC_Model->sentMail($requestData['email'], $subject, $message);
				
					$this->session->set_flashdata('success', 'Successfully Registered. Kindly check your inbox for account activation details.');
				}else{
					$this->session->set_flashdata('error', 'Try Later.');	
				} 
			}
			
			redirect(''); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['validation'];
		$data['content'] = $this->load->view('authentication/login/index', $pagedata, true);
		$this->layout1($data);
	}
	
	public function verification()
	{
		if(!$this->input->get('id')){
			$this->session->set_flashdata('error', 'Try Later.');
			redirect(''); 
		}
		
		$decryptid 	= $this->encryption->decrypt($this->input->get('id'));
		$data 		= $this->Users_Model->verification($decryptid);
		
		if($data) $this->session->set_flashdata('success', 'Successfully Verified.');
		else $this->session->set_flashdata('error', 'Try Later.');
		
		redirect(''); 
	}
	
	public function emailvalidation()
	{	
		
		$requestData 		= $this->input->post();
		$requestData['id'] 	= isset($requestData['id']) ? $requestData['id'] : '';
		$data 				= $this->Users_Model->emailvalidation($requestData);
		
		echo $data;
	}
}
