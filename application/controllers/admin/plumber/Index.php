<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Mycpd_Model');
		$this->load->model('Coc_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Noncompliance_Model');
		$this->load->model('Accounts_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1', '2']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1', '2']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$designation 	= isset($this->config->item('designation2')[$result["designation"]]) ? $this->config->item('designation2')[$result["designation"]] : '';
				$status 		= isset($this->config->item('plumberstatus')[$result["plumberstatus"]]) ? $this->config->item('plumberstatus')[$result["plumberstatus"]] : '';

				$totalrecord[] = 	[
										'reg_no' 		=> 	$result['registration_no'],
										'name' 			=> 	$result['name'],
										'surname' 		=> 	$result['surname'],
										'designation' 	=> 	$designation,
										'email' 		=> 	$result['email'],
										'status' 		=> 	$status,
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'applications'], ['redirect' => 'admin/plumber/index']);
	}
	
	public function rejected()
	{
		$pagedata['notification'] 	= $this->getNotification();
		
		$data['plugins']			= ['datatables', 'datatablesresponsive'];
		$data['content'] 			= $this->load->view('admin/plumber/rejected', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTRejectedPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['2'], 'status' => ['1']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['2'], 'status' => ['1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$rejectreason 	= $this->config->item('rejectreason');
				
				$reasonforrejection = [];
				$exploderejectreasons 	= explode(',', $result['reject_reason']);
				foreach($exploderejectreasons as $exploderejectreason){
					$rejectreasondata = isset($rejectreason[$exploderejectreason]) ? $rejectreason[$exploderejectreason] : '';
					if($exploderejectreason==4){
						$reasonforrejection[] = $rejectreasondata.' - '.$result['reject_reason_other'];
					}else{
						$reasonforrejection[] = $rejectreasondata;
					}
				}
				
				$totalrecord[] = 	[
										'applicationreceived' 	=> 	date('d-m-Y', strtotime($result['application_received'])),
										'name' 					=> 	$result['name'].' '.$result['surname'],
										'reason' 				=> 	implode(', ', $reasonforrejection),
										'action'				=> 	'
																		<div class="table-action">
																			<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
	
	public function rejectedaction($id)
	{
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'rejectedapplications'], ['redirect' => 'admin/plumber/index/rejected']);
	}

	public function cpd($id,$pagestatus='')
	{
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);		
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['id'] 			= $id;
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();
		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['auditorid' => '', 'plumberid' => $id]);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'morrischart'];

		$data['content'] 			= $this->load->view('admin/plumber/cpd', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	

	public function DTCpdQueue()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => $post['pagestatus'], 'user_id' => $post['user_id']]+$post);
		$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => $post['pagestatus'], 'user_id' => $post['user_id']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				if ($result['status']==0) {
					$statuz 	= 'Pending';
					$awardPts 	= '';
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					';
				}elseif($result['status']==3){
					$statuz 	= 'Not Submited';
					$awardPts 	= '';
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					';
				}
			
				else{
					$statuz 	= $this->config->item('approvalstatus')[$result['status']];
					$awardPts 	= $result['points'];
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
					</div>
					';
				}

				// Attachments
				if ($result['file1']!='') {
					$attach = '<div class="table-action">
					<a href="'.base_url().'assets/uploads/cpdqueue/'.$result['file1'].'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Attachments"><i class="fa fa-download"></i></a>
					</div>';
				}else{
					$attach = '';
				}


				$totalrecord[] = 	[
					'date' 					=> 	date("m-d-Y", strtotime($result['cpd_start_date'])),
					'acivity' 				=> 	$result['cpd_activity'],
					'streams' 				=> 	$this->config->item('cpdstream')[$result['cpd_stream']],
					'comments' 				=> 	$result['comments'],
					'points' 				=> 	$awardPts,
					'attachment' 			=> 	$attach,
					'status' 				=> 	$statuz,
					'action'				=> 	$action
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

	public function performance($id,$pagestatus='')
	{
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'applications'], ['redirect' => 'admin/plumber/index']);
	}
	
	public function coc($id,$pagestatus='')
	{
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['id'] 			= $id;
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['auditorid' => '', 'plumberid' => $id]);
		$pagedata['history2']		= $this->Auditor_Model->getReviewHistory2Count(['auditorid' => '', 'plumberid' => $id]);

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'morrischart'];
		$data['content'] 			= $this->load->view('admin/plumber/coc', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function DTCocStatement()
	{
		
		$post 			= $this->input->post();

		$user_id = $post['user_id'];

		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2','4','5'], 'user_id' => $user_id]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2','4','5'], 'user_id' => $user_id]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			$action = '';
			foreach($results as $result){
				if($result['coc_status']=='5' || $result['coc_status']=='4'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit" disbled><i class="fa fa-pencil-alt"></i></a>';
				}elseif($result['coc_status']=='2'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				}
				
				$cocstatus = isset($this->config->item('cocstatus')[$result['coc_status']]) ? $this->config->item('cocstatus')[$result['coc_status']] : '';
				$coctype = isset($this->config->item('coctype')[$result['type']]) ? $this->config->item('coctype')[$result['type']] : '';
				
				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'cocstatus' 		=> 	$cocstatus,
										'purchased' 		=> 	date('d-m-Y', strtotime($result['purchased_at'])),
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

	public function audit($id)
	{		
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['id'] 			= $id;
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();
		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['auditorid' => '', 'plumberid' => $id]);	
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'morrischart'];
		$data['content'] 			= $this->load->view('admin/plumber/audit', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);

	}

	public function DTAuditStatement()
	{
		
		$post 			= $this->input->post();
		$userid 		= $post['user_id'];
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

	public function accounts($id)
	{
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['id'] 			= $id;
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/plumber/accounts', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function DTAccounts()
	{
		$post 			= $this->input->post();
		$userid 		= $post['user_id'];
		$userdata1		= $this->Plumber_Model->getList('row', ['id' => $userid]);		
		$totalcount 	= $this->Accounts_Model->getList('count', ['user_id' => $userid]+$post);
		$results 		= $this->Accounts_Model->getList('all', ['user_id' => $userid]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$invoicestatus = 	isset($this->config->item('payment_status2')[$result['status']]) ? $this->config->item('payment_status2')[$result['status']] : '';
				//print_r($this->db->last_query());
				
				if($result['status']=='0'){
					$this->session->set_userdata('pay_purchaseorder', $result['inv_id']);

					$action = 	'
									<input type="hidden" id="feeamt" value="'.$result['total_cost'].'">
									<input type="hidden" id="name" value="'.$userdata1['name'].'">
									<input type="hidden" id="surname" value="'.$userdata1['surname'].'">
									<input type="hidden" id="usremail" value="'.$userdata1['email'].'">
									<a <a href="javascript:void(0);"> <i class="fa fa-credit-card payfastpayment">
									<script>
									$(".payfastpayment").click(function(){
									$("#name_first").val($("#name").val());
									$("#name_last").val($("#surname").val());
									$("#totaldue1").val($("#feeamt").val());
									$("#email_address").val($("#usremail").val());
									$( "#paymentsubmit" ).trigger( "click" );								
									
								});
								</script></i></a>
								';
				}else{
					$action = 	'';	
				}
				
				$totalrecord[] = 	[      
										'description' 	=> 	$result['description'],
										'invoiceno' 	=> 	$result['inv_id'],
										'invoicedate' 	=> 	date('d-m-Y', strtotime($result['created_at'])),
										'invoicevalue' 	=> 	$result['total_cost'],
										'invoicestatus' => 	$invoicestatus,
										'orderstatus' 	=> 	'',			
							     		'action'	    => 	'
																<div class="col-md-6">
																	<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf" target="_blank" ><img src="'.base_url().'assets/images/pdf.png" height="50" width="50"></a>
																	'.(isset($action) ? $action : '').'
																</div>'
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

	public function documents($id)
	{
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'applications'], ['redirect' => 'admin/plumber/index/rejected']);
	}

	public function diary($id)
	{
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'applications'], ['redirect' => 'admin/plumber/index/rejected']);
	}
	
}

