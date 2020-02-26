<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$id = $this->getUserID();
		$this->companyprofile($id, ['roletype' => $this->config->item('rolecompany'), 'pagetype' => 'companyprofile'], ['redirect' => 'company/profile/index']);
	}
	
}
