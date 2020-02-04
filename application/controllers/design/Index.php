<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function register()
	{
		$data['content'] 	= $this->load->view('design/register', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function admin_cocstatement()
	{
		$data['content'] 	= $this->load->view('design/admin_cocstatement', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
