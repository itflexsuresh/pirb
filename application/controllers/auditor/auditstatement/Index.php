<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Systemsettings_Model');
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
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'auditorid' => $userid]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'auditorid' => $userid]+$post);		
		$settings 		= $this->Systemsettings_Model->getList('row');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			
			foreach($results as $result){
				$auditstatus 	= isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
				if($result['as_auditcomplete']=='1'){
					$action 		= '<a href="'.base_url().'auditor/auditstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				}else{
					$action 		= '<a href="'.base_url().'auditor/auditstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
				}
				
				$review 		= $this->Auditor_Model->getReviewList('row', ['coc_id' => $result['id'], 'reviewtype' => '1', 'status' => '0']);
				$refixdate 		= ($review) ? date('d-m-Y', strtotime($review['created_at'].' +'.$settings['refix_period'].'days')) : '';
				
				$totalrecord[] 	= 	[
										'cocno' 			=> 	$result['id'],
										'status' 			=> 	$auditstatus,
										'plumber' 			=> 	$result['u_name'],
										'plumbermobile' 	=> 	$result['u_mobile'],
										'refixdate' 		=> 	($refixdate!='') ? '<p class="'.((date('Y-m-d') > date('Y-m-d', strtotime($refixdate))) ? "tagline" : "").'">'.$refixdate.'</p>' : '',
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
		$this->getAuditStatement($id, ['pagetype' => 'action', 'viewcoc' => 'auditor/auditstatement/index/viewcoc', 'roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID()]);
	}
	
	public function view($id)
	{
		$this->getAuditStatement($id, ['pagetype' => 'view', 'viewcoc' => 'auditor/auditstatement/index/viewcoc', 'auditreport' => 'auditor/auditstatement/index/auditreport/'.$id, 'roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID()]);
	}
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction($id, ['pagetype' => 'view', 'roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'userid' => $plumberid]);
	}
	
	public function auditreport($id)
	{
		$this->pdfauditreport($id);
	}
}
