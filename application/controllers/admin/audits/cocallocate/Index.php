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

		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		$pagedata['checkpermission'] = $this->checkUserPermission('27', '2');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/audits/cocallocate/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTAllocateAudit()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Auditor_allocatecoc_Model->getList('count', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);
		$results 		= $this->Auditor_allocatecoc_Model->getList('all', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);

		$checkpermission	=	$this->checkUserPermission('27', '2');

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$user_id 		= $result['id'];
				$performance 	= $this->Plumber_Model->performancestatus('all', ['plumberid' => $user_id]);
				$overallpoint 	= array_sum(array_column($performance, 'point'));
				
				if(isset($requestdata['rating_start']) && $requestdata['rating_start']!='' && $overallpoint < $requestdata['rating_start']){
					continue;
					--$totalcount;
				}
				if(isset($requestdata['rating_end']) && $requestdata['rating_end']!=''  && $overallpoint > $requestdata['rating_start']){
					continue;
					--$totalcount;
				} 
		
				if($checkpermission){
					$action = 	"<a href='javascript:void(0);' class='cocmodal' data-user-id='".$user_id."'>logged COC</a>";
				}else{
					$action = '';
				}
				
				$totalrecord[] = 	[
										'plumbername' 			=> 	$result['plumbername'],
										'regno' 				=> 	$result['regno'],
										'company' 				=> 	$result['company'],
										'city' 					=> 	$result['cityname'],
										'province' 				=> 	$result['provincename'],
										'audit' 				=> 	$result['audit'],
										'cautionary' 			=> 	$result['cautionary'],
										'refix_incomplete' 		=> 	$result['refix_incomplete'],
										'refix_complete' 		=> 	$result['refix_complete'],
										'rating' 				=> 	$overallpoint,
										'coc_link' 				=> 	$action
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

	public function DTcoc()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Auditor_allocatecoc_Model->getCOCList('count', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);
		$results 		= $this->Auditor_allocatecoc_Model->getCOCList('all', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$coc_id = $result['coc_id'];
				$totalrecord[] = 	[
										'coc_id' 		=> 	"<span class='coc_id'>$coc_id</span>",
										'installationtype' 			=> 	$result['installationtype'],
										'city' 			=> 	$result['postal_city'],
										'province' 		=> 	$result['postal_province'],
										'suburb' 		=> 	$result['postal_suburb'],
										'allocate' 		=> 	"<div class='allocate_section'>
										<input type='search' autocomplete='off' class='form-control user_search' name='user_search' id='user_search_$coc_id' >
										<div class='user_suggestion' id='user_suggestion_$coc_id'></div>										
										<input type='hidden' id='auditor_id_$coc_id' class='auditor_id' name='auditor_id'><input type='checkbox' name='allocate' class='allocate'>
										</div>",
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
	
	public function auditor_allocate(){
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			$result 		=  	$this->Auditor_allocatecoc_Model->action($requestData);	
			
			if($result){
				$this->CC_Model->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $requestData['user_id'], 'auditorid' => $requestData['auditor_id'], 'cocid' => $requestData['coc_id'], 'action' => '8', 'type' => '1']);
				
				$plumberdata	= 	$this->getUserDetails($requestData['user_id']);				
				$auditordata	= 	$this->getUserDetails($requestData['auditor_id']);				
				
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '20', 'emailstatus' => '1']);
				
				if($notificationdata){
					$array1 = ['{Plumbers Name and Surname}','{COC number}', '{Auditors Names and Surname}'];
					$array2 = [$plumberdata['name'], $requestData['coc_id'], $auditordata['name']];
					
					$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
					$this->CC_Model->sentMail($plumberdata['email'], $notificationdata['subject'], $body);
				}
				
				if($this->config->item('otpstatus')!='1'){
					$smsdata 	= $this->Communication_Model->getList('row', ['id' => '20', 'smsstatus' => '1']);
		
					if($smsdata){
						$sms = str_replace(['{number of COC}', '{auditors name and surname}'], [$requestData['coc_id'], $auditordata['name']], $smsdata['sms_body']);
						$this->sms(['no' => $plumberdata['mobile_phone'], 'msg' => $sms]);
					}
				}
		 	}
			
			echo json_encode($result);
		}
	}
	
}

