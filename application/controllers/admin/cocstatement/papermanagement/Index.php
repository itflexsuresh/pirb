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
		$userid = $this->getUserID();
		$result['ar'] = $this->Paper_Model->getCount('row', ['id' => $userid, 'status' => ['0','1']]);		
		$result['un'] = $this->Paper_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);

		
		if($result)
		{
			$pagedata['result'] = $result;
		}
		else
		{
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect('admin/cocstatement/papermanagement/index'); 
		}
		
		if($this->input->post()){


			$requestData 	= 	$this->input->post();	
			
			//$id				=	$requestData['id'];
			
			$data 			=  	$this->Paper_Model->action($requestData);			

			if(isset($data)) $this->session->set_flashdata('success', ' COC '.(($id =='') ? 'Generated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/cocstatement/papermanagement/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		//$pagedata['provincelist'] 	= $this->getProvinceList();	
		$pagedata['userid']			= $userid;		

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('admin/cocstatement/papermanagement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);

	}

	

	
}
