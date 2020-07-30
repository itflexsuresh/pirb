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
			$requesttype	= [$usertype];
		}else{
			$usertype 		= '';
			$usertypename 	= '';
			$requesttype	= ['1', '2'];
		}
		
		if($this->input->post())
		{	
			$requestData 	= $this->input->post();
			
			if($requestData['submit']=='login'){
				$requestData['type'] = $requesttype;		
				$data = $this->Users_Model->login($requestData);
				
				$data = $this->Users_Model->getUserDetails('row', ['id' => $data['result']]);
				
				$status			= $data['status'];
				$mailstatus		= $data['mailstatus'];
				$id				= $data['id'];
				
				if($status!='2'){
					if($mailstatus=='1'){						
						$this->session->set_userdata('userid', $id);						
						$this->middleware('1');
					}elseif($mailstatus=='0'){
						$this->session->set_flashdata('error', 'Please activate your account by verifying the link sent to your E-mail id.');
					}else{	
						$this->session->set_flashdata('error', 'Invalid Credentials.');
					}
				}else{
					$this->session->set_flashdata('error', 'Your account is disabled. Please contact admin.');
				}
				
			}elseif($requestData['submit']=='register'){
				$requestData['id'] 		= '';
				$requestData['status'] 	= '0';
				$data 					= $this->Users_Model->actionUsers($requestData);
				
				if($data){
					$id 		= 	$data;
					$subject 	= 	'Email Verification';
					$message 	= 	'<div>Thank you for creating an account/profile on the PIRB\'s Audit-IT System.</div>
									<br>
									<div>Please click on the link below to verify your email address:</div>
									<br>
									<div><a href="'.base_url().'login/verification/'.$id.'/'.$usertypename.'">Click Here</a></div>
									<br>
									<div>Once verified, you will automatically be redirected to the Login Page, and may then log into your new account/profile to complete the required Application to Register forms.</div>
									<br>
									<div>Best Regards</div>
									<br>
									<div>The PIRB Team</div>
									<div>Tel: 0861 747 275</div>
									<div>Email: info@pirb.co.za</div>
									<br>
									<div>Please do not reply to this email, as it will not be responded to.</div>
									';
				
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
		
		if($data){
			$this->session->unset_userdata('userid');
			$this->session->set_flashdata('success', 'Successfully Verified.');
		}else{
			$this->session->set_flashdata('error', 'Try Later.');
		}
		
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
