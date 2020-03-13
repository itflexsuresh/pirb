<?php
//Resellers Controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Resellers_allocatecoc_Model');
	}
	
	public function index()
	{
		$pagedata['usersid'] = $this->getUserID();
		$pagedata['notification'] 	= $this->getNotification();		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask'];
		$data['content'] 			= $this->load->view('resellers/cocstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
}
