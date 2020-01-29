<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systemsettings extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Systemsettings_Model');
	}
	
	public function index()
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			$data 			=  $this->Systemsettings_Model->action($requestData);
			if($data) $this->session->set_flashdata('success', 'System Settings '.(($id=='') ? 'updated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/systemsettings/Systemsettings'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provinceList'] 			= $this->getProvinceList();
		$pagedata['cpdstream']	 			= $this->config->item('cpdstream');
		$pagedata['result']	 				= $this->Systemsettings_Model->getList('row');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/systemsetup/systemsettings/index', (isset($pagedata) ? $pagedata : ''), true);

		$this->layout2($data);
	}

}
