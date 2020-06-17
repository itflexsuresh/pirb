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
		$this->load->model('Friends_Model');
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
		
		$history									= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);
		$pagedata['auditcoc'] 						= $history['total'];
		$pagedata['auditrefixincomplete'] 			= $history['refixincomplete'];
		$auditorratio								= $this->Auditor_Model->getAuditorRatio('row', ['userid' => $id]);
		$pagedata['auditorratio']					= ($auditorratio) ? $auditorratio['audit'].'%' : '0%';
		
		$pagedata['performancestatus'] 				= $this->userperformancestatus();
		$pagedata['overallperformancestatus'] 		= $this->userperformancestatus(['overall' => '1']);
		$pagedata['overallperformancestatuslimit'] 	= $this->userperformancestatus(['overall' => '1', 'limit' => '3']);
		$pagedata['provinceperformancestatus'] 		= $this->userperformancestatus(['province' => $userdata['province']]);
		$pagedata['provinceperformancestatuslimit'] = $this->userperformancestatus(['province' => $userdata['province'], 'limit' => '3']);
		
		$friends 									= $this->Friends_Model->getList('all', ['userid' => $id, 'fromto' => $id, 'status' => ['1'], 'limit' => '10']);
		$friendsarray								= [];
		if(count($friends) > 0){
			foreach($friends as $friend){
				$friendperformance = $this->userperformancestatus(['overall' => '1', 'userid' => $friend['userid']]);
				$friendsarray[] =  $friend+['rank' => $friendperformance];
			}
			
			array_multisort(array_column($friendsarray, 'rank'), SORT_ASC, $friendsarray);
		}
		
		$pagedata['friends'] 						= $friendsarray;
		
		$data['plugins']			= ['echarts', 'knob', 'zingchart'];
		$data['content'] 			= $this->load->view('plumber/dashboard/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
