<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_allocatecoc_Model');
		$this->load->model('Communication_Model');
		$this->load->model('CC_Model');
	}
	
	public function index()
	{
		$this->checkUserPermission('27', '1');
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			
			foreach($requestData['allocate'] as $allocate){
				$auditorid 	= $allocate['auditorid'];
				$plumberid 	= $allocate['plumberid'];
				$cocid 		= $allocate['cocid'];
				
				$result 	=  	$this->Auditor_allocatecoc_Model->action(['auditor_id' => $auditorid, 'coc_id' => $cocid]);	
				
				if($result){
					$this->CC_Model->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $plumberid, 'auditorid' => $auditorid, 'cocid' => $cocid, 'action' => '8', 'type' => '1']);
					
					$plumberdata	= 	$this->getUserDetails($plumberid);				
					$auditordata	= 	$this->getUserDetails($auditorid);				
					
					$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '20', 'emailstatus' => '1']);
					
					if($notificationdata){
						$array1 = ['{Plumbers Name and Surname}','{COC number}', '{Auditors Names and Surname}'];
						$array2 = [$plumberdata['name'], $cocid, $auditordata['name']];
						
						$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
						$this->CC_Model->sentMail($plumberdata['email'], $notificationdata['subject'], $body);
					}
					
					if($this->config->item('otpstatus')!='1'){
						$smsdata 	= $this->Communication_Model->getList('row', ['id' => '20', 'smsstatus' => '1']);
			
						if($smsdata){
							$sms = str_replace(['{number of COC}', '{auditors name and surname}'], [$cocid, $auditordata['name']], $smsdata['sms_body']);
							$this->sms(['no' => $plumberdata['mobile_phone'], 'msg' => $sms]);
						}
					}
				}
			}
			
			redirect('admin/audits/cocallocate/index');
		}
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['company'] 			= $this->getCompanyList();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['plumberstatus'] 		= $this->config->item('plumberstatus');
		$pagedata['checkpermission'] 	= $this->checkUserPermission('27', '2');
		$pagedata['totalcoccount'] 		= $this->Auditor_allocatecoc_Model->getCOCList('count', []);
		
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 				= $this->load->view('admin/audits/cocallocate/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTAllocateAudit()
	{
		$post 			= $this->input->post();

		$results 		= $this->Auditor_allocatecoc_Model->getList('all', $post);

		$checkpermission	=	$this->checkUserPermission('27', '2');

		$totalrecord 	= [];
		$noofcoc		= 0;
		
		if(count($results) > 0){
			foreach($results as $index => $result){
				$audit 			= $result['audit'];
				$rollingavg 	= $this->getRollingAverage();
				$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
				$user_id 		= $result['user_id']; 
				$performance 	= $this->Plumber_Model->performancestatus('all', ['plumberid' => $user_id, 'archive' => '0', 'date' => $date]);
				$overallpoint 	= array_sum(array_column($performance, 'point'));
				
				$checkcocranking 	= [];
				if($post['compulsory_audit']=='1') 									$checkcocranking[] = ($result['auditassign'] <= $result['auditcomplete']) ? '0' : '1';
				if($post['audit_ratio_start']!='' && $post['audit_ratio_end']=='') 	$checkcocranking[] = ($audit < $post['audit_ratio_start']) ? '0' : '1';
				if($post['audit_ratio_start']=='' && $post['audit_ratio_end']!='') 	$checkcocranking[] = ($audit > $post['audit_ratio_end']) ? '0' : '1';
				if($post['audit_ratio_start']!='' && $post['audit_ratio_end']!='') 	$checkcocranking[] = ($audit >=  $post['audit_ratio_start'] && $audit <= $post['audit_ratio_end']) ? '1' : '0';
				if($post['rating_start']!='' && $post['rating_end']=='') 			$checkcocranking[] = ($overallpoint < $post['rating_start']) ? '0' : '1';
				if($post['rating_start']=='' && $post['rating_end']!='') 			$checkcocranking[] = ($overallpoint > $post['rating_end']) ? '0' : '1';
				if($post['rating_start']!='' && $post['rating_end']!='') 			$checkcocranking[] = ($overallpoint >= $post['rating_start'] && $overallpoint <= $post['rating_end']) ? '1' : '0';
				
				if(count($checkcocranking) && array_sum($checkcocranking)=='0'){
					//--$totalcount;
					continue;
				}
				
				/*
				if($post['no_coc_allocation']!=''){
					if($index=='0') $totalcount = '0';
					
					$postcocallocation 	= $post['no_coc_allocation'];
					$noofcoc 			+= $result['coccount'];
					$cocprevtotal 		= isset($results[$index-1]['coccount']) ? $results[$index-1]['coccount'] : '0';
					//echo $cocprevtotal.'-'.$noofcoc.'-'.$postcocallocation;
					if($cocprevtotal <= $postcocallocation && $noofcoc > $postcocallocation){
						break;
					}
					
					++$totalcount;
				}
				*/
				if($checkpermission){
					$action = 	"<a href='javascript:void(0);' class='cocaccordion' data-user-id='".$user_id."'><i class='fa fa-caret-up caretup'></i><i class='fa fa-caret-down caretdown displaynone'></i></a>";
				}else{
					$action = '';
				}
				
				$totalrecord[] = 	[
										'plumbername' 			=> 	$result['plumbername'],
										'regno' 				=> 	$result['regno'],
										'company' 				=> 	$result['company'],
										'city' 					=> 	$result['cityname'],
										'province' 				=> 	$result['provincename'],
										'audit' 				=> 	($result['audit']!='') ? $result['audit'].'%' : '',
										'cautionary' 			=> 	($result['cautionary']!='') ? $result['cautionary'].'%' : '',
										'refix_incomplete' 		=> 	($result['refix_incomplete']!='') ? $result['refix_incomplete'].'%' : '',
										'refix_complete' 		=> 	($result['refix_complete']!='') ? $result['refix_complete'].'%' : '',
										'rating' 				=> 	$overallpoint,
										'coc_link' 				=> 	$action
									];
			}
		}
		
		$json = array(
			"data"   => $totalrecord
		);

		echo json_encode($json);
	}

	public function coc()
	{ 
		$post 			= $this->input->post();
		$result 		= $this->Auditor_allocatecoc_Model->getCOCList('all', $post);
		echo json_encode(array("result" => $result));
	}
} 

