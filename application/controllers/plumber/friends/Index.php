<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Friends_Model');
	}
	
	public function index()
	{
		$id 										= $this->getUserID();
		$userdata 									= $this->getUserDetails();
		
		if($this->input->post()){
			$requestData			=	$this->input->post();
			$requestData['id']		=	$id;
			
			if($requestData['submit']=='Add Friend'){
				$this->Friends_Model->action($requestData);
			}
			
			if($requestData['submit']=='Search' || isset($requestData['search'])){
				$pagedata['friendslist'] 		= 	$this->Friends_Model->search($requestData);
			}
			
			$pagedata['post']	= $this->input->post();
		}
		
		$data['plugins']			= [];
		$data['content'] 			= $this->load->view('plumber/friends/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
