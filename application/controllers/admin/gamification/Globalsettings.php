<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalsettings extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Globalsettings_Model');
	}
	
	public function index($id='')
	{		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			$data 			=  $this->Globalsettings_Model->action($requestData);
         
			if($data) $this->session->set_flashdata('success', 'Global Settings '.(($id=='') ? 'updated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/gamification/Globalsettings'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['result']	 				= $this->Globalsettings_Model->getList('all');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/gamification/gamification', (isset($pagedata) ? $pagedata : ''), true);


		$this->layout2($data);
	}
	
	
  }




