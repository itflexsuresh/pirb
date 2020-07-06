<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Help_Model');
	}
	
	public function index()
	{
		$result = $this->Help_Model->getList('row', ['type' => ['3'], 'status' => ['0','1']]);
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['result'] 			= $result;
		$data['plugins']				= [];
		$data['content'] 				= $this->load->view('plumber/help/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
