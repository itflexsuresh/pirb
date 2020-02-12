<?php
//Resellers Controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resellers_Model');
	}
	
	public function index()
	{
		$id = $this->getUserID();		
		$this->resellersprofile($id, ['roletype' => $this->config->item('roleresellers'), 'pagetype' => 'profile'], ['redirect' => 'resellers/profile/index','adminvalue' => '0']);
	}
}
