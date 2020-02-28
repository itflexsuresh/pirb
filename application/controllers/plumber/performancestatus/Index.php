<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Global_performance_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['warning']		= $this->Global_performance_Model->getWarningList('all', ['status' => ['1']]);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'morrischart'];
		$data['content'] 			= $this->load->view('plumber/performancestatus/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
	
	public function DTPerformancestatus()
	{
		$userid 		= $this->getUserID();
		$rollingavg 	= $this->getRollingAverage();
		$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		
		$post 			= $this->input->post();
		$totalcount 	= $this->Plumber_Model->performancestatus('count', ['plumberid' => $userid, 'date' => $date]+$post);
		$results 		= $this->Plumber_Model->performancestatus('all', ['plumberid' => $userid, 'date' => $date]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){				
				$totalrecord[] = 	[
										'date' 				=> 	date('d-m-Y', strtotime($result['date'])),
										'type' 				=> 	$result['type'],
										'comments' 			=> 	$result['comments'],
										'point' 			=> 	$result['point'],
										'attachment' 		=> 	$result['attachment'],
										'action'			=> 	'
																	<div class="table-action">																		
																	</div>
																'
									];
			}
		}
		
		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}
}
