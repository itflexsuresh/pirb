<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CC_Model');
	}
	
	public function updateprofile()
	{
		$adminid	= $this->getUserID();
		$result 	= $this->Users_Model->getUserDetails('row', ['1'], $adminid, ['1']);
		
		if($result){
			$pagedata['result'] = $result;
		}else{
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect('admin/dashboard'); 
		}
		
		if($this->input->post()){
			$id = $this->input->post('id');
			
			$this->form_validation->set_rules('name', 		'Name',				'trim|required');
			$this->form_validation->set_rules('phone', 		'Phone Number',		'trim|required|numeric');
			$this->form_validation->set_rules('address', 	'Address',			'trim|required');
			$this->form_validation->set_rules('email', 		'Email ID', 		'trim|required|valid_email|callback_emailvalidation['.$id.']');
			
			if($this->form_validation->run() != FALSE)
			{
				$requestData 	= $this->input->post();
				$data 			= $this->Users_Model->actionUsers($requestData, $this->getUserID());
				
				if($data) $this->session->set_flashdata('success', 'Profile '.(($id=='') ? 'created' : 'updated').' successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
				
				redirect('admin/profile/updateprofile'); 
			}
		}
		
		$data['plugins']	= ['dropzone'];
		$data['content'] 	= $this->load->view('admin/profile/updateprofile', $pagedata, true);
		$this->layout2($data);
	}	
	
	public function changepassword()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('oldpassword', 		'Old Password',				'trim|required|min_length[6]');
			$this->form_validation->set_rules('newpassword', 		'New Password',				'trim|required|min_length[6]');
			$this->form_validation->set_rules('confirmnewpassword', 'Confirm New Password',		'trim|required|min_length[6]|matches[newpassword]');
			
			if($this->form_validation->run() != FALSE)
			{
				$requestData 	= $this->input->post();
				$data 			= $this->Users_Model->changePassword($requestData, $this->getUserID());
				
				if($data=='1') $this->session->set_flashdata('success', 'Password changed successfully.');
				elseif($data=='2') $this->session->set_flashdata('error', 'Old Password and New Password cannot be same.');
				elseif($data=='3') $this->session->set_flashdata('error', 'Incorrect Old Password.');
				else $this->session->set_flashdata('error', 'Try Later.');
				
				redirect('admin/profile/changepassword'); 
			}
		}
		
		$data['content'] 	= $this->load->view('admin/profile/changepassword', '', true);
		$this->layout2($data);
	}
	
	public function adminUpload()
	{
		if($this->input->post() && $this->input->post('type')=='remove'){
			$requestData = $this->input->post();
			if($requestData['id']==''){
				unlink('./assets/uploads/temp/'.$requestData['file']);
				return true;
			}else{
				echo $requestData['file'];
			}
		}else{
			$data = $this->CC_Model->fileUpload('file', './assets/uploads/temp');
			echo $data['file_name'];
		}
	}
	
	public function emailvalidation($email, $id)
	{
		$result = $this->Users_Model->emailvalidation(['email' => $email, 'id' => $id]);
		
		if($result=='false')
		{
			$this->form_validation->set_message('emailvalidation', 'The Email ID already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
}
