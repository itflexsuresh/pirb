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
		$results = $this->Help_Model->getList('all', ['type' => ['3'], 'status' => ['1']]);
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['results'] 			= $results;
		$data['plugins']				= [];
		$data['content'] 				= $this->load->view('plumber/help/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
