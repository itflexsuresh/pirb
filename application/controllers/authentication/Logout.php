<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data 		= $this->getUserDetails();
		$redirect 	= ($this->config->item('usertype2')[$data['type']]) ? 'login/'.$this->config->item('usertype2')[$data['type']] : '';
		
		$this->session->unset_userdata('userid');
		redirect($redirect); 
	}
}
