<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalperformance extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_performance_Model');
	}
	
	public function index($id='')
	{
		$this->checkUserPermission('15', '1');
		
		if($this->input->post()){

			$this->checkUserPermission('15', '2', '1');
			
                $requestData 	= 	$this->input->post();

            	$data 	=  $this->Global_performance_Model->action($requestData);
			if($data) $this->session->set_flashdata('success', 'Global Performance Settings '.(($id=='') ? 'updated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/performancesettings/Globalperformance'); 
		}
		$post 			= $this->input->post();
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$pagedata['checkpermission'] 		= $this->checkUserPermission('15', '2');
		$pagedata['results'] 				= $this->Global_performance_Model->getPointList('all');
		$pagedata['results1'] 				= $this->Global_performance_Model->getPointList('all');
		$pagedata['result'] 		= $this->Global_performance_Model->getWarningList('all', ['status' => ['0','1']]+$post);
		
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];

		$data['content'] 					= $this->load->view('admin/systemsetup/performancesettings/globalperformance', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
