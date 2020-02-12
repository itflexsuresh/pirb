<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
	}
	
	public function index($userid)
	{
		$data['company'] 			= $this->getCompanyList();
		$data['designation2'] 		= $this->config->item('designation2');
		$data['specialisations'] 	= $this->config->item('specialisations');
		
		$data['result'] = $this->Plumber_Model->getList('row', ['id' => $userid]);
		$this->load->view('common/card', $data) ;
		

	}
	
}
