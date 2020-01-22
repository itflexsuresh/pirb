<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
	}
	
	public function index()
	{
		if($this->input->post())
		{			
			$this->form_validation->set_rules('email', 		'Email ID', 	'trim|required|valid_email');
			$this->form_validation->set_rules('password', 	'Password', 	'trim|required');
			
			if($this->form_validation->run() != FALSE)
			{
				$requestData 	= $this->input->post();
				$data 			= $this->Users_Model->login($requestData);
				
				$status			= $data['status'];
				$result			= $data['result'];
				
				if($status=='1'){
					$this->session->set_userdata('userid', $result);
					$this->middleware('1');
				}elseif($status=='0'){
					if($result=='0')	$this->session->set_flashdata('error', 'Your account is disabled For further assistance contact admin.');
					else				$this->session->set_flashdata('error', 'Invalid Credentials.');
				}else{	
					$this->session->set_flashdata('error', 'Invalid Credentials.');
				}
				
				redirect(''); 
			}
		}
		
		$data['content'] = $this->load->view('authentication/login/index', '', true);
		$this->layout1($data);
	}
}
