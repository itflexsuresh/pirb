<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Noncompliance_Model');
		$this->load->model('Auditor_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('plumber/auditstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTAuditStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Auditor_Model->getAuditStatementList('count', ['user_id' => $userid]+$post);
		$results 		= $this->Auditor_Model->getAuditStatementList('all', ['user_id' => $userid]+$post);		
		$totalrecord 	= [];
		if(count($results) > 0){
			$action = '';
			foreach($results as $result){
				
				$action = '<a href="'.base_url().'plumber/auditstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
				
				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'status' 		=> 	$this->config->item('auditstatus')[$result['audit_status']],
										'consumer' 		=> 	$result['consumer'],
										'address' 			=> 	$result['conaddress'],
										'refixdate' 			=> 	date('d-m-Y', strtotime($result['allocation_date'])),
										'auditor' 			=> 	$result['name']." ".$result['surname'],
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
	
	public function action($id)
	{
		$this->getAuditStatementData($id, ['pagetype' => 'action', 'roletype' => $this->config->item('roleplumber')], ['redirect' => 'plumber/auditstatement/index', 'userid' => $this->getUserID()]);
	}
}
