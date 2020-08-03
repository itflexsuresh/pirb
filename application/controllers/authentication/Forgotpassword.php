<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CC_Controller 
{
	public function index($usertype='')
	{
		if($usertype!=''){
			if(!isset($this->config->item('usertype1')[$usertype])){
				redirect('');
			}
			
			$usertype 		= $this->config->item('usertype1')[$usertype];
			$usertypename 	= $this->config->item('usertype2')[$usertype];
			$postusertype	= [$usertype];
		}else{
			$usertype 		= '';
			$usertypename 	= '';
			$postusertype	= ['1','2'];
		}
		
		if($this->input->post()){			
			$requestData 			= $this->input->post();
			$requestData['type'] 	= $postusertype;
			$data 			= $this->Users_Model->forgotPassword($requestData);
			
			if($data=='1') $this->session->set_flashdata('success', 'Please check your email inbox and follow the steps, as instructed, to reset your password.');
			elseif($data=='3') $this->session->set_flashdata('error', 'Incorrect Email ID.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('login/'.$usertypename); 			
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['usertype']		= $usertype;
		$pagedata['usertypename']	= $usertypename;
		
		$data['plugins'] 			= ['validation'];
		$data['content'] 			= $this->load->view('authentication/forgotpassword/index', $pagedata, true);
		
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
			$requesttype	= $usertype;
		}else{
			$usertype 		= '';
			$usertypename 	= '';
			$requesttype	= '1';
		}
		
		$checkID 	= $this->Users_Model->checkEncryptUserID($id, ['type' => $requesttype]);

		if($checkID=='2'){
			$this->session->set_flashdata('error', 'Try Later.');
			redirect('login/'.$usertypename); 
		}
		
		if($this->input->post()){
			$this->form_validation->set_rules('newpassword', 		'New Password',				'trim|required|min_length[6]');
			$this->form_validation->set_rules('confirmnewpassword', 'Confirm New Password',		'trim|required|min_length[6]|matches[newpassword]');
			
			if($this->form_validation->run() != FALSE)
			{
				$requestData 			= $this->input->post();
				$requestData['id']		= $id;
				
				$data 					= $this->Users_Model->resetPassword($requestData);
				
				if($data) $this->session->set_flashdata('success', 'Password changed successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
				
				redirect('login/'.$usertypename); 
			}
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['usertype']		= $usertype;
		$pagedata['usertypename']	= $usertypename;
		
		$data['plugins'] 			= ['validation'];
		$data['content'] 			= $this->load->view('authentication/forgotpassword/verification', $pagedata, true);
		$this->layout1($data);
	}
}
