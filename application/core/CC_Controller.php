<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CC_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Managearea_Model');
	}
	
	public function layout1($data=[])
	{
		$this->middleware('1');
		$this->load->view('template/layout1', $data);
	}
	
	public function layout2($data=[])
	{
		$this->middleware();
		$data['userdata'] 		= $this->getUserDetails();
		$data['sidebar'] 		= $this->load->view('template/sidebar', $data, true);
		$this->load->view('template/layout2', $data);
	}
	
	public function middleware($type='')
	{
		$userDetails = $this->getUserDetails();
		
		if($type=='1'){
			if($userDetails){
				redirect('admin/administration/installationtype'); 
			}
		}else{
			if(!$userDetails){
				redirect('');
			}
		}
	}
	
	public function getUserID()
	{
		$userDetails = $this->getUserDetails();
		
		if($userDetails){
			return $userDetails['u_id'];
		}else{
			return '';
		}
	}
	
	public function getUserDetails()
	{
		if($this->session->has_userdata('userid')){
			$userid = $this->session->userdata('userid');
			$result = $this->Users_Model->getUserDetails('row', ['1'], $userid);
			
			if($result){
				return $result;
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	
	public function getNotification()
	{
		return $this->load->view('template/notification', '', true);
	}

	public function getInstallationTypeList()
	{
		$data = $this->Installationtype_Model->getList('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Installation Type']+array_column($data, 'name', 'id');
		else return [];
	}

	public function getProvinceList()
	{
		$data = $this->Managearea_Model->getListProvince('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Province']+array_column($data, 'name', 'id');
		else return [];
	}

	public function getCityList()
	{
		$data = $this->Managearea_Model->getListCity('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select City']+array_column($data, 'name', 'id');
		else return [];
	}
}
