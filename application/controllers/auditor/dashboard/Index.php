<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
		$this->load->model('Chat_Model');
	}
	
	public function index()
	{
		$id 						= $this->getUserID();
		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['auditorid' => $id]);	
		$pagedata['unread_chat']	= $this->Chat_Model->getList('count',['viewed' => $id]);
		
		$data['plugins']			= ['echarts', 'knob', 'zingchart'];
		$data['content'] 			= $this->load->view('auditor/dashboard/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
