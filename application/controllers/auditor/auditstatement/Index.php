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
		
		$totalrecord 	= [];
		if(count($results) > 0){
			
			foreach($results as $result){
				$auditstatus 	= isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
				if($result['as_auditcomplete']=='1'){
					$action 		= '<a href="'.base_url().'auditor/auditstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				}else{
					$action 		= '<a href="'.base_url().'auditor/auditstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
				}
				
				$refixdate 			= ($result['ar1_refix_date']!='') ? '<p class="'.((date('Y-m-d') > date('Y-m-d', strtotime($result['ar1_refix_date']))) && $result['as_refixcompletedate']=='' ? "tagline" : "").'">'.date('d-m-Y', strtotime($result['ar1_refix_date'])).'</p>' : '';
				$refixcompletedate 	= ($result['as_refixcompletedate']!='') ? '<p class="successtagline">'.date('d-m-Y', strtotime($result['as_refixcompletedate'])).'</p>' : '';
				
				$totalrecord[] 	= 	[
										'notification' 		=> 	$result['notification'],
										'cocno' 			=> 	$result['id'],
										'status' 			=> 	$auditstatus,
										'plumber' 			=> 	$result['u_name'],
										'plumbermobile' 	=> 	$result['u_mobile'],
										'allocateddate' 	=> 	isset($result['audit_allocation_date']) && $result['audit_allocation_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['audit_allocation_date'])) : '',
										'refixdate' 		=> 	$refixdate,
										'refixcompletedate' => 	$refixcompletedate,
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
		$this->getauditreview($id, ['pagetype' => 'action', 'viewcoc' => 'auditor/auditstatement/index/viewcoc', 'downloadattachment' => 'auditor/auditstatement/index/downloadattachment', 'seperatechat' => 'auditor/auditstatement/index/seperatechat/'.$id.'/action', 'roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID(), 'notification' => '1']);
	}
	
	public function view($id)
	{
		$this->getauditreview($id, ['pagetype' => 'view', 'viewcoc' => 'auditor/auditstatement/index/viewcoc', 'downloadattachment' => 'auditor/auditstatement/index/downloadattachment', 'seperatechat' => 'auditor/auditstatement/index/seperatechat/'.$id.'/view', 'auditreport' => 'auditor/auditstatement/index/auditreport/'.$id, 'roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID()]);
	}
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleauditor'), 'electroniccocreport' => 'auditor/auditstatement/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'auditor/auditstatement/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'auditor/auditstatement/index', 'userid' => $plumberid, 'auditorid' => $this->getUserID()]
		);
	}
	
	public function seperatechat($id, $pagetype)
	{
		$this->getchat($id, ['roletype' => $this->config->item('roleauditor'), 'pagetype' => $pagetype], ['redirect' => 'auditor/auditstatement/index']);
	}
	
	public function history($id)
	{
		$this->getaudithistory($id, ['roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID()]);
	}
	
	public function diary($id)
	{
		if($this->input->post()){
			$requestData 				=   $this->input->post();
			$requestData['coc_id'] 		= 	$id;
			$requestData['user_id'] 	= 	$this->getUserID();
			
			$commentdata 	=  $this->Auditor_Comment_Model->action($requestData);	
			
			if($commentdata) $this->session->set_flashdata('success', 'Comment Added Successfully.');	
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('auditor/auditstatement/index/diary/'.$id); 
		}			
		
		$this->getauditdiary($id, ['roletype' => $this->config->item('roleauditor')], ['redirect' => 'auditor/auditstatement/index', 'auditorid' => $this->getUserID()]);
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
