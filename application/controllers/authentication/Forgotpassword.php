<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CC_Controller 
{
	public function index()
	{
		if($this->input->post()){			
			$requestData 	= $this->input->post();
			$data 			= $this->Users_Model->forgotPassword($requestData);
			
			if($data=='1') $this->session->set_flashdata('success', 'Check your email id and follow the steps to reset your password.');
			elseif($data=='3') $this->session->set_flashdata('error', 'Incorrect Email ID.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('authentication/forgotpassword'); 			
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		
		$data['plugins'] = ['validation'];
		$data['content'] = $this->load->view('authentication/forgotpassword/index', $pagedata, true);
		
		$this->layout1($data);
	}
	
	public function verification()
	{
		if(!$this->input->get('id')){
			$this->session->set_flashdata('error', 'Try Later.');
			redirect(''); 
		}
		
		$this->load->library('encryption');
		$id 		= $this->encryption->decrypt($this->input->get('id'));
		$checkID 	= $this->Users_Model->checkEncryptUserID($id);
	
		if($checkID=='2'){
			$this->session->set_flashdata('error', 'Try Later.');
			redirect(''); 
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
				
				redirect(''); 
			}
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		
		$data['plugins'] = ['validation'];
		$data['content'] = $this->load->view('authentication/forgotpassword/verification', '', true);
		$this->layout1($data);
	}
}
