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
		if($this->input->post()){
			$requestData 	=  $this->input->post();
			$data 			=  $this->Auditor_Model->actionReviewRating($requestData);
						
			if($data){
				$this->session->set_flashdata('success', 'Successfully Rated.');
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			
			redirect('plumber/auditstatement/index'); 
		}
		
		$id 										= $this->getUserID();
		$history									= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);
		$pagedata['auditcoc'] 						= $history['total'];
		$pagedata['auditrefixincomplete'] 			= $history['refixincomplete'];
		$auditorratio								= $this->Auditor_Model->getAuditorRatio('row', ['userid' => $id]);
		$pagedata['auditorratio']					= ($auditorratio) ? $auditorratio['audit'].'%' : '0%';
		
		
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'knob', 'rating'];
		$data['content'] 			= $this->load->view('plumber/auditstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTAuditStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);	
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$auditstatus 	= isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
				$action 		= '<a href="'.base_url().'plumber/auditstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				
				if($result['as_auditcomplete']=='1'){
					$action 	.= '<a href="javascript:void(0);" class="starrating" data-auditorid="'.$result['auditorid'].'" data-cocid="'.$result['id'].'" data-toggle="modal" data-target="#ratingmodal"><i class="fa fa-star"></i></a>';
				}
				
				$refixdate 			= ($result['ar1_refix_date']!='') ? '<p class="'.((date('Y-m-d') > date('Y-m-d', strtotime($result['ar1_refix_date']))) && $result['as_refixcompletedate']=='' ? "tagline" : "").'">'.date('d-m-Y', strtotime($result['ar1_refix_date'])).'</p>' : '';
				$refixcompletedate 	= ($result['as_refixcompletedate']!='') ? '<p class="successtagline">'.date('d-m-Y', strtotime($result['as_refixcompletedate'])).'</p>' : '';
				
				$totalrecord[] 	= 	[
										'notification' 		=> 	$result['notification'],
										'cocno' 			=> 	$result['id'],
										'status' 			=> 	$auditstatus,
										'consumer' 			=> 	$result['cl_name'],
										'address' 			=> 	$result['cl_address'],
										'refixdate' 		=> 	$refixdate,
										'refixcompletedate' => 	$refixcompletedate,
										'auditordate' 		=> 	isset($result['audit_allocation_date']) && $result['audit_allocation_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['audit_allocation_date'])) : '',
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
		$this->getauditreview($id, ['pagetype' => 'view', 'viewcoc' => 'plumber/auditstatement/index/viewcoc', 'downloadattachment' => 'plumber/auditstatement/index/downloadattachment', 'seperatechat' => 'plumber/auditstatement/index/seperatechat/'.$id.'/view', 'auditreport' => 'plumber/auditstatement/index/auditreport/'.$id, 'roletype' => $this->config->item('roleplumber')], ['redirect' => 'plumber/auditstatement/index', 'plumberid' => $this->getUserID(), 'notification' => '1']);
	}
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleplumber'), 'electroniccocreport' => 'plumber/auditstatement/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'plumber/auditstatement/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'plumber/auditstatement/index', 'userid' => $plumberid]
		);
	}
	
	public function seperatechat($id, $pagetype)
	{
		$this->getchat($id, ['roletype' => $this->config->item('roleplumber'), 'pagetype' => $pagetype], ['redirect' => 'plumber/auditstatement/index']);
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
