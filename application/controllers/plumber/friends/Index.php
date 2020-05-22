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
			
			if($requestData['submit']=='Add Friend'){
				$requestData['fromid']	=	$id;
				$this->Friends_Model->action($requestData);
			}
			
			if($requestData['submit']=='Accept'){
				$requestData['status'] = '1';
				$this->Friends_Model->action($requestData);
			}
			
			if($requestData['submit']=='Remove'){
				$this->Friends_Model->remove($requestData);
			}
			
			redirect('plumber/friends/index?search='.$requestData['search']);
		}
		
		if($this->input->get('search')){
			$requestData				=	$this->input->get();
			$requestData['userid']		=	$id;
			$pagedata['search'] 		= 	$requestData['search'];
			$pagedata['friendslist'] 	= 	$this->Friends_Model->search($requestData);
		}
		
		$pagedata['friends'] 				= 	$this->Friends_Model->getList('all', ['userid' => $id, 'fromto' => $id, 'status' => ['1']]);
		$pagedata['fromrequestlist'] 		= 	$this->Friends_Model->getList('all', ['userid' => $id, 'fromid' => $id, 'status' => ['0']]);
		$pagedata['torequestlist'] 			= 	$this->Friends_Model->getList('all', ['userid' => $id, 'toid' => $id, 'status' => ['0']]);
		
		$data['plugins']			= [];
		$data['content'] 			= $this->load->view('plumber/friends/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
