<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Paper_Model');
	}
	
	public function index()
	{
		$userid 				= $this->getUserID();
		$pagedata['count'] 		= $this->Paper_Model->getList('count', ['cocstatus' => '1']);		
		$pagedata['result'] 	= $this->Paper_Model->getList('count');

		if($this->input->post()){
			$requestData 	= 	$this->input->post();				
			$data 			=  	$this->Paper_Model->action($requestData);			

			if(isset($data)) $this->session->set_flashdata('success', ' COC '.(($id =='') ? 'Generated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/cocstatement/papermanagement/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['userid']			= $userid;		

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('admin/cocstatement/papermanagement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	

	
}
