<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Auditor_Model');
	}
	
	public function index()
	{
		$id 						= $this->getUserID();
		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);		
		$pagedata['history2']		= $this->Auditor_Model->getReviewHistory2Count(['plumberid' => $id]);		
		$pagedata['logged']			= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['2']]);
		$pagedata['allocated']		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['4']]);
		$pagedata['nonlogged']		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['5']]);
		$pagedata['settings_cpd']	= $this->Systemsettings_Model->getList('all');
		$pagedata['user_details'] 	= $this->Plumber_Model->getList('row', ['id' => $id], ['usersplumber']);
		
		$data['plugins']			= ['echarts'];
		$data['content'] 			= $this->load->view('plumber/dashboard/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
