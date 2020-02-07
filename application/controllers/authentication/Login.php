<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
		$this->load->model('CC_Model');
	}
	
	public function index($usertype='')
	{
		if($usertype!=''){
			if(!isset($this->config->item('usertype1')[$usertype])){
				redirect('');
			}
			
			$usertype 		= $this->config->item('usertype1')[$usertype];
			$usertypename 	= $this->config->item('usertype2')[$usertype];
		}else{
			$usertype 		= '';
			$usertypename 	= '';
		}
		
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
				$data 					= $this->Users_Model->actionUsers($requestData);
				
				if($data){
					$id 		= 	$data;
					$subject 	= 	'Email Verification';
					$message 	= 	'<div>Hi,</div>

									<div>Please Click the below link to verify your account.</div>
									<div><a href="'.base_url().'login/verification/'.$id.'/'.$usertypename.'">Click Here</a></div>
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
			
			redirect('login/'.$usertypename); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['usertype']		= $usertype;
		$pagedata['usertypename']	= $usertypename;
		$data['plugins']			= ['validation'];
		$data['content'] = $this->load->view('authentication/login/index', $pagedata, true);
		$this->layout1($data);
	}
	
	public function verification($id, $usertype='')
	{
		if($usertype!=''){
			if(!isset($this->config->item('usertype1')[$usertype])){
				redirect('');
			}
			
			$usertype 		= $this->config->item('usertype1')[$usertype];
			$usertypename 	= $this->config->item('usertype2')[$usertype];
		}else{
			$usertype 		= '';
			$usertypename 	= '';
		}
		
		$data 		= $this->Users_Model->verification($id);
		
		if($data) $this->session->set_flashdata('success', 'Successfully Verified.');
		else $this->session->set_flashdata('error', 'Try Later.');
		
		redirect('login/'.$usertypename); 
	}
	
	public function emailvalidation()
	{	
		$requestData 		= $this->input->post();
		$requestData['id'] 	= isset($requestData['id']) ? $requestData['id'] : '';
		$data 				= $this->Users_Model->emailvalidation($requestData);
		
		echo $data;
	}
}
