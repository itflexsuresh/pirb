<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Coc_Ordermodel');
		$this->load->model('Auditor_Model');
	}
	
	public function index()
	{
		$id 										= $this->getUserID();
		$userdata 									= $this->getUserDetails();
		
		$pagedata['mycpd'] 							= $this->userperformancestatus(['performancestatus' => '1', 'auditorstatement' => '1']);
		$pagedata['nonlogcoc']						= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['4','5']]);
		$adminstock 								= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $id]);
		$pagedata['adminstock']						= array_sum(array_column($adminstock, 'quantity'));
		$coccount									= $this->Coc_Model->COCcount(['user_id' => $id]);
		$pagedata['coccount']						= $coccount['count'];
		
		$pagedata['myprovinceperformancestatus'] 	= $this->userperformancestatus(['province' => $userdata['province']]);
		$pagedata['performancestatus'] 				= $this->userperformancestatus();
		$pagedata['mycityperformancestatus'] 		= $this->userperformancestatus(['city' => $userdata['city']]);
		$pagedata['provinceperformancestatus'] 		= $this->userperformancestatus(['province' => $userdata['province'], 'limit' => '3']);
		$pagedata['cityperformancestatus'] 			= $this->userperformancestatus(['city' => $userdata['city'], 'limit' => '3']);
		
		$data['plugins']			= ['echarts'];
		$data['content'] 			= $this->load->view('plumber/dashboard/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
