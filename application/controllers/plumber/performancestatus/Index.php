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
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('plumber/performancestatus/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTPerformancestatus()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Plumber_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['2','4','5']]+$post);
		$results 		= $this->Plumber_Model->getCOCList('all', ['user_id' => $userid, 'coc_status' => ['2','4','5']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){				
				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'cocstatus' 		=> 	$cocstatus,
										'purchased' 		=> 	$allocation_log_date,
										'coctype' 			=> 	$coctype,
										'customer' 			=> 	$result['cl_name'],
										'address' 			=> 	$result['cl_address'],
										'company' 			=> 	$result['plumbercompany'],
										'reseller' 			=> 	$result['resellername'],
										'action'			=> 	'
																	<div class="table-action">
																		'.$action.'
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
