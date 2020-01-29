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
				$data 			= $this->Users_Model->login($requestData);
				
				if($data['status']=='1'){
					$data = $this->Users_Model->getUserDetails('row', ['id' => $data['result']]);
					
					$status			= $data['status'];
					$mailstatus		= $data['mailstatus'];
					$id				= $data['id'];
					
					if($mailstatus=='1'){
						$this->session->set_userdata('userid', $id);
						$this->middleware('1');
					}elseif($status=='0' && $mailstatus=='0'){
						$this->session->set_flashdata('error', 'Please Verify Email.');
					}else{	
						$this->session->set_flashdata('error', 'Invalid Credentials.');
					}
				}else{	
					$this->session->set_flashdata('error', 'Invalid Credentials.');
				}
			}elseif($requestData['submit']=='register'){
				$requestData['id'] 		= '';
				$requestData['status'] 	= '0';
				$requestData['type'] 	= '3';
				$data 			= $this->Users_Model->actionUsers($requestData);
				
				$encryptid 	= 	$this->encryption->decrypt($data['id']);
				$subject 	= 	'Email Verification';
				$message 	= 	'
									Please Click the below link to verify your account 
									<a href="'.base_url().'authentication/login/verification/'.$encryptid.'">Click Here</a>
								';
				
				$this->CC_Model->sentMail2($requestData['email'], $subject, $message);
				
				if($data) $this->session->set_flashdata('success', 'Successfully Registered.');
				else $this->session->set_flashdata('error', 'Try Later.');
			}
			
			redirect(''); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['validation'];
		$data['content'] = $this->load->view('authentication/login/index', $pagedata, true);
		$this->layout1($data);
	}
	
	public function verification($id)
	{
		$decryptid 	= $this->encryption->decrypt($id);
		$data 		= $this->Users_Model->verification($requestData);
		$this->session->set_flashdata('success', 'Successfully Verified.');
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
