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
		$this->load->model('Documentsletters_Model');
		$this->load->model('Diary_Model');
		$this->load->model('Performancestatus_Model');
		$this->load->model('Cpdtypesetup_Model');

		
	}
	
	public function index()
	{
		$this->checkUserPermission('18', '1');

		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		$pagedata['checkpermission'] = $this->checkUserPermission('18', '2');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1', '2']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1', '2']]+$post);

		$checkpermission = $this->checkUserPermission('18', '2');

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if ($checkpermission) {
					$action = '<div class="table-action">
									<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								</div>';
				}else{
					$action = '';
				}

				$designation 	= isset($this->config->item('designation2')[$result["designation"]]) ? $this->config->item('designation2')[$result["designation"]] : '';
				$status 		= isset($this->config->item('plumberstatus')[$result["plumberstatus"]]) ? $this->config->item('plumberstatus')[$result["plumberstatus"]] : '';

				$totalrecord[] = 	[
										'reg_no' 		=> 	$result['registration_no'],
										'name' 			=> 	$result['name'],
										'surname' 		=> 	$result['surname'],
										'designation' 	=> 	$designation,
										'email' 		=> 	$result['email'],
										'status' 		=> 	$status,
										'action'		=> 	$action
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
		$this->checkUserPermission('19', '1');

		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['checkpermission'] = $this->checkUserPermission('19', '2');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive'];
		$data['content'] 			= $this->load->view('admin/plumber/rejected', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTRejectedPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['2'], 'status' => ['1']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['2'], 'status' => ['1']]+$post);

		$checkpermission = $this->checkUserPermission('19', '2');

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if ($checkpermission) {
					$action = '<div class="table-action">
									<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								</div>';
				}else{
					$action = '';
				}


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
		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistory2Count(['plumberid' => $id]);
		$pagedata['settings_cpd']	= $this->Systemsettings_Model->getList('all');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'echarts'];

		$data['content'] 			= $this->load->view('admin/plumber/cpd', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	

	// public function DTCpdQueue()
	// {
	// 	$post 			= $this->input->post();

	// 	$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => $post['pagestatus'], 'user_id' => $post['user_id']]+$post);
	// 	$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => $post['pagestatus'], 'user_id' => $post['user_id']]+$post);
		
	// 	$totalrecord 	= [];
	// 	if(count($results) > 0){
	// 		foreach($results as $result){
	// 			if ($result['status']==0) {
	// 				$statuz 	= 'Pending';
	// 				$awardPts 	= '';
	// 				$action 	= '';//'<div class="table-action"><a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a></div>';
	// 			}elseif($result['status']==3){
	// 				$statuz 	= 'Not Submited';
	// 				$awardPts 	= '';
	// 				$action 	= '';//'<div class="table-action"><a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a></div>';
	// 			}
			
	// 			else{
	// 				$statuz 	= $this->config->item('approvalstatus')[$result['status']];
	// 				$awardPts 	= $result['points'];
	// 				$action 	= '<div class="table-action"><a href="'.base_url().'admin/plumber/index/viewcpd/'.$post['pagestatus'].'/'.$result['id'].'/'.$post['user_id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a></div>';
	// 			}

	// 			// Attachments
	// 			if ($result['file1']!='') {
	// 				$attach = '<div class="table-action">
	// 				<a href="'.base_url().'assets/uploads/cpdqueue/'.$result['file1'].'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Attachments"><i class="fa fa-download"></i></a>
	// 				</div>';
	// 			}else{
	// 				$attach = '';
	// 			}


	// 			$totalrecord[] = 	[
	// 				'date' 					=> 	date("m-d-Y", strtotime($result['cpd_start_date'])),
	// 				'acivity' 				=> 	$result['cpd_activity'],
	// 				'streams' 				=> 	$this->config->item('cpdstream')[$result['cpd_stream']],
	// 				'comments' 				=> 	$result['comments'],
	// 				'points' 				=> 	$awardPts,
	// 				'attachment' 			=> 	$attach,
	// 				'status' 				=> 	$statuz,
	// 				'action'				=> 	$action
	// 			];
	// 		}
	// 	}
		
	// 	$json = array(
	// 		"draw"            => intval($post['draw']),   
	// 		"recordsTotal"    => intval($totalcount),  
	// 		"recordsFiltered" => intval($totalcount),
	// 		"data"            => $totalrecord
	// 	);

	// 	echo json_encode($json);
	// }


	public function DTCpdQueue()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Cpdtypesetup_Model->getQueueList('count', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
		$results 		= $this->Cpdtypesetup_Model->getQueueList('all', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				if ($result['status']==0) {
					$statuz 	= 'Pending';
					$awardPts 	= '';
					$post['pagestatus'] = '0';
					$action 	= '<div class="table-action"><a href="'.base_url().'admin/cpd/cpdtypesetup/index_queue/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a></div>';
				}			
				else{
					$statuz 	= $this->config->item('approvalstatus')[$result['status']];
					if ($statuz=='Reject') {
						$awardPts 	= 0;
					}else{
						$awardPts 	= $result['points'];
					}
					$post['pagestatus'] = '0';
					
					$action 	= '<div class="table-action"><a href="'.base_url().'admin/cpd/cpdtypesetup/index_queue/'.$post['pagestatus'].'/'.$result['id'].'/'.$post['user_id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-pencil-alt"></i></a></div>';
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

	// public function DTCpdQueue()
	// {
	// 	$post 			= $this->input->post();

	// 	$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
	// 	$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
	// 	//print_r($results);die;
		
	// 	$totalrecord 	= [];
	// 	if(count($results) > 0){
	// 		foreach($results as $result){
	// 			if ($result['status']==0) {
	// 				$statuz 	= 'Pending';
	// 				$awardPts 	= '';
	// 				$action 	= '
	// 				<div class="table-action">
	// 				<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
	// 				</div>
	// 				';
	// 			}elseif($result['status']==3){
	// 				$statuz 	= 'Not Submited';
	// 				$awardPts 	= '';
	// 				$action 	= '
	// 				<div class="table-action">
	// 				<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
	// 				</div>
	// 				';
	// 			}
			
	// 			else{
	// 				$statuz 	= $this->config->item('approvalstatus')[$result['status']];
	// 				if ($statuz!='Reject') {
	// 					$awardPts 	= $result['points'];
	// 				}else{
	// 					$awardPts 	= 0;
	// 				}
					
	// 				$action 	= '
	// 				<div class="table-action">
	// 				<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
	// 				</div>
	// 				';
	// 			}

	// 			// Attachments
	// 			if ($result['file1']!='') {
	// 				$attach = '<div class="table-action">
	// 				<a href="'.base_url().'assets/uploads/cpdqueue/'.$result['file1'].'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Attachments"><i class="fa fa-download"></i></a>
	// 				</div>';
	// 			}else{
	// 				$attach = '';
	// 			}


	// 			$totalrecord[] = 	[
	// 				'date' 					=> 	date("m-d-Y", strtotime($result['cpd_start_date'])),
	// 				'acivity' 				=> 	$result['cpd_activity'],
	// 				'streams' 				=> 	$this->config->item('cpdstream')[$result['cpd_stream']],
	// 				'comments' 				=> 	$result['comments'],
	// 				'points' 				=> 	$awardPts,
	// 				'attachment' 			=> 	$attach,
	// 				'status' 				=> 	$statuz,
	// 				'action'				=> 	$action
	// 			];
	// 		}
	// 	}
		
	// 	$json = array(
	// 		"draw"            => intval($post['draw']),   
	// 		"recordsTotal"    => intval($totalcount),  
	// 		"recordsFiltered" => intval($totalcount),
	// 		"data"            => $totalrecord
	// 	);

	// 	echo json_encode($json);
	// }

	public function viewcpd($pagestatus='',$id='',$userid='')
	{
		$this->mycptindex($pagestatus,$id,$userid);
	}

	public function performance($id, $pagestatus='')
	{	
		if($this->input->post()){
			$requestData	=	$this->input->post();
			$data 			= 	$this->Performancestatus_Model->action($requestData);
			
			if(isset($data)) $this->session->set_flashdata('success', 'Successfully Saved.');
			else $this->session->set_flashdata('error', 'Try Later.');
				
			redirect('admin/plumber/index/performance/'.$id); 
		}
		
		$userid 					= $id;
		$rollingavg 				= $this->getRollingAverage();
		$date						= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		$pagestatus					= ($pagestatus=='2' ? '1' : '0');
		$extraparam					= $pagestatus=='0' ? ['date' => $date] : [];
		
		$pagedata['plumberid'] 		= $id;
		$pagedata['userdata']		= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['performancelist']= $this->getPlumberPerformanceList();
		$pagedata['pagestatus'] 	= $pagestatus;
		$pagedata['warning']		= $this->Global_performance_Model->getWarningList('all', ['status' => ['1']]);
		$pagedata['results']		= $this->Plumber_Model->performancestatus('all', ['plumberid' => $userid, 'archive' => $pagestatus]+$extraparam);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker', 'select2', 'echarts'];
		$data['content'] 			= $this->load->view('admin/plumber/performance', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
	
	public function DTPerformancestatus()
	{
		$post 			= $this->input->post();
		
		$userid 		= $post['id'];
		$rollingavg 	= $this->getRollingAverage();
		$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		
		if($post['archive']=='0'){
			$post['date'] = $date;
		}
		$totalcount 	= $this->Plumber_Model->performancestatus('count', ['plumberid' => $userid]+$post);
		$results 		= $this->Plumber_Model->performancestatus('all', ['plumberid' => $userid]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			$pdfimg 	= base_url().'assets/images/pdf.png';
			
			foreach($results as $result){	
				$filepath	= ($result['flag']=='2') ? base_url().'assets/uploads/cpdqueue/' : base_url().'assets/uploads/plumber/'.$userid.'/performance/';
				$attachment = $result['attachment'];
				if($attachment!=''){						
					$explodeattachment 	= explode('.', $attachment);
					$extfile 			= array_pop($explodeattachment);
					$file 				= (in_array($extfile, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$attachment;
					$attachment 		= '<img src="'.$file.'" width="100">';
				}else{
					$attachment 		= '';
				}
							
				$totalrecord[] = 	[
										'date' 				=> 	date('d-m-Y', strtotime($result['date'])),
										'type' 				=> 	$result['type'],
										'comments' 			=> 	$result['comments'],
										'point' 			=> 	$result['point'],
										'attachment' 		=> 	$attachment,
										'action'			=> 	'
																	<div class="table-action">	
																		<a href="javascript:void(0);" class="archive" data-id="'.$result['id'].'" data-flag="'.$result['flag'].'"><i class="fa fa-archive"></i></a>
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
	
	public function performanceaction()
	{
		$requestData	=	$this->input->post();
		$data 			= 	$this->Plumber_Model->performancestatusaction($requestData);
		
		if(isset($data)) $this->session->set_flashdata('success', 'Successfully archived.');
		else $this->session->set_flashdata('error', 'Try Later.');
			
		redirect('admin/plumber/index/performance/'.$requestData['plumberid']); 
	}
	
	public function coc($id,$pagestatus='')
	{
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['id'] 			= $id;
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);				
		$pagedata['logged']			= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['2']]);
		$pagedata['allocated']		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['4']]);
		$pagedata['nonlogged']		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['5']]);

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'echarts'];
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
					$action = ''; //'<a href="'.base_url().'admin/plumber/index/actioncoc/'.$result['id'].'/'.$user_id.'" data-toggle="tooltip" data-placement="top" title="Edit" disbled><i class="fa fa-pencil-alt"></i></a>';
				}elseif($result['coc_status']=='2'){
					$action = '<a href="'.base_url().'admin/plumber/index/viewcoc/'.$result['id'].'/'.$user_id.'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				}elseif($result['coc_status']=='7'){
					$action = '';
				}
				
				$cocstatus = isset($this->config->item('cocstatus')[$result['coc_status']]) ? $this->config->item('cocstatus')[$result['coc_status']] : '';
				$coctype = isset($this->config->item('coctype')[$result['type']]) ? $this->config->item('coctype')[$result['type']] : '';
				
				$allcateddate = isset($result['allocation_date']) ? $result['allocation_date'] : '';
				$loggeddate = isset($result['cl_log_date']) ? $result['cl_log_date'] : '';
				$allcated_logged_date = '';				
				if($allcateddate != ''){
					$allcateddate = date('d-m-Y', strtotime($allcateddate));
					$allcated_logged_date = $allcated_logged_date.$allcateddate;
				}

				if($loggeddate != ''){
					$loggeddate = date('d-m-Y', strtotime($loggeddate));
					$allcated_logged_date = $allcated_logged_date.'/ '.$loggeddate;
				}
				

				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'cocstatus' 		=> 	$cocstatus,
										'purchased' 		=> 	$allcated_logged_date,
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

	public function viewcoc($id,$plumberid='')
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleadmin'), 'electroniccocreport' => 'admin/plumber/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'admin/plumber/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'admin/plumber/index', 'userid' => $plumberid]
		);
	}

	public function actioncoc($id,$plumberid='')
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'action', 'roletype' => $this->config->item('roleadmin'), 'electroniccocreport' => 'admin/plumber/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'admin/plumber/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'admin/plumber/index', 'userid' => $plumberid]
		);
	}

	public function electroniccocreport($id,$plumberid='')
	{	
		$userid = $plumberid;
		$this->pdfelectroniccocreport($id, $userid);
	}
	
	public function noncompliancereport($id,$plumberid='')
	{	
		$userid = $plumberid;
		$this->pdfnoncompliancereport($id, $userid);
	}

	public function audit($id)
	{		
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $id]);
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['id'] 			= $id;
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		$pagedata['notification'] 	= $this->getNotification();
		
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);	

		$pagedata['loggedcoc']		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['2']]);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'echarts'];
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
				$action 		= '<a href="'.base_url().'admin/plumber/index/viewaudit/'.$result['id'].'/'.$userid.'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				
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

	public function viewaudit($id, $plumberid='')
	{
		$this->getauditreview($id, ['pagetype' => 'view', 'viewcoc' => 'admin/plumber/index/viewcocaudit/'.$id.'/'.$plumberid, 'auditreport' => 'admin/plumber/index/auditreport/'.$id.'/'.$plumberid, 'roletype' => $this->config->item('roleadmin')], ['redirect' => 'admin/audits/auditstatement/index']);
	}
	
	public function viewcocaudit($id, $plumberid='')
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleadmin'), 'electroniccocreport' => 'admin/audits/auditstatement/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'admin/audits/auditstatement/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'admin/audits/auditstatement/index', 'userid' => $plumberid]
		);
	}

	public function auditreport($id, $plumberid='')
	{
		$this->pdfauditreport($id);
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
										'invoicevalue' 	=> 	$result['total_due'],
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

	public function documents($plumberid,$documentsid='')
	{
		if($documentsid!=''){
			$result = $this->Documentsletters_Model->getList('row', ['id' => $documentsid]);
			if($result){
				$pagedata['result'] = $result;				

			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				if($extras['redirect']) redirect($extras['redirect']); 
				else redirect('admin/plumber/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();			
			$result 	=  $this->Documentsletters_Model->action($requestData);				
			if($result){
			 $this->session->set_flashdata('success', 'Documents Letters '.(($result=='') ? 'created' : 'updated').' successfully.');

			 redirect('admin/plumber/index/documents/'.$plumberid);
			}
			else{
			 $this->session->set_flashdata('error', 'Try Later.');
			}

		}
		
		$userdata1	= $this->Plumber_Model->getList('row', ['id' => $plumberid]);
		$pagedata['user_details'] 	= $userdata1;
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['plumberid'] 	= $plumberid;
		$pagedata['menu']			= $this->load->view('common/plumber/menu', ['id'=>$plumberid],true);
		$data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','inputmask'];
		$data['content'] = $this->load->view('admin/plumber/documents', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function DTDocuments()
	{
		
		$post 		= $this->input->post();			
		$totalcount =  $this->Documentsletters_Model->getList('count',$post);
		$results 	=  $this->Documentsletters_Model->getList('all',$post);
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				
				$timestamp = strtotime($result['created_at']);
				$newDate = date('d-F-Y H:i:s', $timestamp);	
				$filename = isset($result['file']) ? $result['file'] : '';
				
				$filepath	= base_url().'assets/uploads/plumber/';
				$pdfimg 	= base_url().'assets/images/pdf.png';
				$file 		= '';
				
				if($filename!=''){
					$explodefile 	= explode('.', $filename);
					$extfile 		= array_pop($explodefile);
					$imgpath 		= (in_array($extfile, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$filename;
					$file = '<div class="col-md-6"><a href="' .$imgpath.'" target="_blank"><img src="'.$imgpath.'" width="100"></div></a>';
				}
				
				$action = '<div class="table-action"><a href="' . base_url() . 'admin/plumber/index/documents/'.$result['user_id'].'/' . $result['id'] . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a><a href="'.base_url().'admin/plumber/index/Deletefunc/'.$result['user_id'].'/' . $result['id'] .'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" style="color:red;"></i></a><a href="' .base_url().'assets/uploads/plumber/'.$result['file'].'" download><i class="fa fa-download" style="color:blue;"></i></a></div>';

				$totalrecord[] = 	[	
										'description'=> 	$result['description'],	
										'datetime' 	 => 	$newDate,
										'file' 	 	 => 	$file,
										'action' 	 => 	$action,
										
									];
			}
		}
		
		$json = array(			  
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}

	public function Deletefunc($plumberid,$documentsid='')
	{		
		
		$result = $this->Documentsletters_Model->deleteid($documentsid);
		if($result == '1'){
			// $url = FCPATH."assets/uploads/plumber/".$documentsid.".pdf";
			// unlink($url);
			$this->session->set_flashdata('success', 'Record was Deleted');
		}
		else{
			$this->session->set_flashdata('error', 'Error to delete the Record.');		
		}

		$this->index();
		redirect('admin/plumber/index/documents/'.$plumberid);
	}

	public function diary($id='')
	{
		////////////////////// $plumberid,$documentsid=''
		if($id!=''){
			$result = $this->Plumber_Model->getList('row', ['id' => $id, 'type' => '3', 'status' => ['1', '2']]);
			$pagedata['result'] 		= $result;

			$DBcomments = $this->Comment_Model->getList('all', ['user_id' => $id, 'type' => '3', 'status' => ['1', '2']]);
			if($DBcomments){
				$pagedata['comments']		= $DBcomments;
			}else{
				// $this->session->set_flashdata('error', 'No comments Found.');
				//redirect('admin/plumber/index'); 
			}
		}

		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			$data = $this->Plumber_Model->plumberdiary($requestData);
			if($data) $message = 'Comment added successfully.';

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');

			redirect('admin/plumber/index/diary/'.$requestData['user_id'].''); 

		}


		$pagedata['diarylist'] = $this->diaryactivity(['plumberid'=>$id]);		

		$pagedata['user_id']		= $result['id'];
		$pagedata['user_role']		= $this->config->item('roletype');
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['menu']				= $this->load->view('common/plumber/menu', ['id'=>$result['id']],true);
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/diary', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
}

