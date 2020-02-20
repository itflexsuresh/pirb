<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert'];
		$data['content'] 			= $this->load->view('auditor/auditstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTAuditStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['5'], 'auditorid' => $userid]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['5'], 'auditorid' => $userid]+$post);		
		
		$totalrecord 	= [];
		if(count($results) > 0){
			
			foreach($results as $result){
				$auditstatus 	= isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
				$action 		= '<a href="'.base_url().'auditor/auditstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
				
				$totalrecord[] 	= 	[
										'cocno' 			=> 	$result['id'],
										'status' 			=> 	$auditstatus,
										'plumber' 			=> 	$result['u_name'],
										'plumbermobile' 	=> 	$result['u_mobile'],
										'refixdate' 		=> 	date('d-m-Y', strtotime($result['allocation_date'])),
										'suburb' 			=> 	$result['cl_suburb_name'],
										'ownername' 		=> 	$result['cl_name'],
										'ownermobile' 		=> 	$result['cl_contact_no'],
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
		$this->getAuditStatement($id, ['pagetype' => 'action', 'roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID()]);
	}
}
