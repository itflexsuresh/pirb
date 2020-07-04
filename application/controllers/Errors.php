<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->output->set_status_header('404');
		
		$userid = $this->getUserID();
		
		$data['exception']			= 1;
		$data['plugins']			= [];
		$data['content'] 			= $this->load->view('common/errors/notfound', '', true);
		
		if($userid!=''){
			$this->layout2($data);
		}else{
			$this->layout1($data);
		}
	}
}
