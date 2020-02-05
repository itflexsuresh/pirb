<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
	}
	
	public function index()
	{
		$id = $this->getUserID();
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleplumber'), 'pagetype' => 'profile'], ['redirect' => 'plumber/profile/index']);
	}
	
}
