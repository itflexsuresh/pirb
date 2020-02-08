<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rates extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rates_Model');
	}
	
	public function index($id='')
	{
		if($id!=''){
			$result = $this->Rates_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/systemsetup/rates/rates'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			if($requestData['submit']=='submit'){

            $validfrom=  strtotime($result['validfrom']);
            $futurefrom= strtotime($requestData['validfrom']);

            if($validfrom < $futurefrom){
            	$data 	=  $this->Rates_Model->actionfuture($requestData);
            }
            else{
            	$data 	=  $this->Rates_Model->action($requestData);
            }
              				
				if($data) $message = 'RatesModel '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Rates_Model->changestatus($requestData);
				$message		= 	'RatesModel deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/rates/rates'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$pagedata['results'] 				= $this->Rates_Model->getList('all', ['status' => ['0','1']]);
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];

		$data['content'] 					= $this->load->view('admin/systemsetup/rates/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
