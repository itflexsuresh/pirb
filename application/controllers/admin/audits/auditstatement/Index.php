<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Auditor_Comment_Model');
	}
	
	public function index()
	{
		$this->checkUserPermission('28', '1');

		if($this->input->post()){

			$this->checkUserPermission('28', '2', '1');

			$requestData 	= 	$this->input->post();

			$data 	=  $this->Coc_Model->cancelcoc($requestData);
				
			if($data) $this->session->set_flashdata('success', 'Coc Cancelled Successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/audits/auditstatement/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['checkpermission'] = $this->checkUserPermission('28', '2');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/audits/auditstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTAuditStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'noaudit' => '']+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'noaudit' => '']+$post);	
		$settings 		= $this->Systemsettings_Model->getList('row');

		$checkpermission	=	$this->checkUserPermission('28', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				// if($checkpermission){
				// 	$action = 	'<a href='javascript:void(0);' class='cocmodal' data-user-id='$user_id'>logged COC</a>';
				// }else{
				// 	$action = '';
				// }
				
				$auditstatus 	= 	isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
				$action 		= 	'
										<a href="'.base_url().'admin/audits/auditstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
										<a href="javascript:void(0);" data-id="'.$result['id'].'" id="cancelcoc" data-toggle="tooltip" data-placement="top" title="Cancel Coc"><i class="fa fa-times"></i></a>
									';
				
				$review 		= $this->Auditor_Model->getReviewList('row', ['coc_id' => $result['id'], 'reviewtype' => '1', 'status' => '0']);
				$refixdate 		= ($review) ? date('d-m-Y', strtotime($review['created_at'].' +'.$settings['refix_period'].'days')) : '';
				
				$totalrecord[] 	= 	[
										'cocno' 			=> 	$result['id'],
										'status' 			=> 	$auditstatus,
										'auditorname' 		=> 	$result['auditorname'],
										'auditormobile' 	=> 	$result['auditormobile'],
										'auditordate' 		=> 	isset($result['audit_allocation_date']) && $result['audit_allocation_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['audit_allocation_date'])) : '',
										'refixdate' 		=> 	($refixdate!='') ? '<p class="'.((date('Y-m-d') > date('Y-m-d', strtotime($refixdate))) ? "tagline" : "").'">'.$refixdate.'</p>' : '',
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
		$this->getauditreview($id, ['pagetype' => 'view', 'viewcoc' => 'admin/audits/auditstatement/index/viewcoc', 'downloadattachment' => 'admin/audits/auditstatement/index/downloadattachment', 'seperatechat' => 'admin/audits/auditstatement/index/seperatechat/'.$id.'/view', 'auditreport' => 'admin/audits/auditstatement/index/auditreport/'.$id, 'roletype' => $this->config->item('roleadmin')], ['redirect' => 'admin/audits/auditstatement/index']);
	}
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleadmin'), 'electroniccocreport' => 'admin/audits/auditstatement/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'admin/audits/auditstatement/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'admin/audits/auditstatement/index', 'userid' => $plumberid]
		);
	}
	
	public function seperatechat($id, $pagetype)
	{
		$this->getchat($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => $pagetype], ['redirect' => 'admin/audits/auditstatement/index']);
	}
	
	public function history($id)
	{
		$this->getaudithistory($id, ['roletype' => $this->config->item('roleadmin')], ['redirect' => 'admin/audits/auditstatement/index']);
	}
	
	public function diary($id)
	{
		if($this->input->post()){
			$requestData 				= 	$this->input->post();
			$requestData['coc_id'] 		= 	$id;
			$requestData['user_id'] 	= 	$this->getUserID();
		
			$commentdata 	=  $this->Auditor_Comment_Model->action($requestData);	
			
			if($commentdata) $this->session->set_flashdata('success', 'Comment Added Successfully.');	
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/audits/auditstatement/index/diary/'.$id); 
		}			
		
		$this->getauditdiary($id, ['roletype' => $this->config->item('roleadmin')], ['redirect' => 'admin/audits/auditstatement/index']);
	}
	
	public function auditreport($id)
	{
		$this->pdfauditreport($id);
	}
	
	public function electroniccocreport($id, $userid)
	{	
		$this->pdfelectroniccocreport($id, $userid);
	}
	
	public function noncompliancereport($id, $userid)
	{	
		$this->pdfnoncompliancereport($id, $userid);
	}
	
	public function downloadattachment($cocid, $file){
		$file = './assets/uploads/chat/'.$cocid.'/'.$file;
		$this->downloadfile($file);
	}
}
