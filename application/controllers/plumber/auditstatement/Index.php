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
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('plumber/auditstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTAuditStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);	
		$settings 		= $this->Systemsettings_Model->getList('row');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$auditstatus 	= isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
				$action 		= '<a href="'.base_url().'plumber/auditstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				
				$review 		= $this->Auditor_Model->getReviewList('row', ['coc_id' => $result['id'], 'reviewtype' => '1', 'status' => '0']);
				$refixdate 		= ($review) ? date('d-m-Y', strtotime($review['created_at'].' +'.$settings['refix_period'].'days')) : '';
				
				$totalrecord[] 	= 	[
										'cocno' 			=> 	$result['id'],
										'status' 			=> 	$auditstatus,
										'consumer' 			=> 	$result['cl_name'],
										'address' 			=> 	$result['cl_address'],
										'refixdate' 		=> 	($refixdate!='') ? '<p class="'.((date('Y-m-d') > date('Y-m-d', strtotime($refixdate))) ? "tagline" : "").'">'.$refixdate.'</p>' : '',
										'auditor' 			=> 	$result['auditorname'],
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
	
	public function view($id)
	{
		$this->getAuditStatement($id, ['pagetype' => 'view', 'viewcoc' => 'plumber/auditstatement/index/viewcoc', 'auditreport' => 'plumber/auditstatement/index/auditreport/'.$id, 'roletype' => $this->config->item('roleplumber')], ['redirect' => 'plumber/auditstatement/index', 'plumberid' => $this->getUserID()]);
	}
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction($id, ['pagetype' => 'view', 'roletype' => $this->config->item('roleplumber')], ['redirect' => 'plumber/auditstatement/index', 'userid' => $plumberid]);
	}
	
	public function auditreport($id)
	{
		$this->pdfauditreport($id);
	}
}
