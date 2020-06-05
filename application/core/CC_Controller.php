<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CC_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CC_Model');
		$this->load->model('Users_Model');
		$this->load->model('Company_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Managearea_Model');
		$this->load->model('Qualificationroute_Model');
		$this->load->model('Rates_Model');
		$this->load->model('Comment_Model');
		$this->load->model('Systemsettings_Model');
		$this->load->model('Auditor_Model');
		$this->load->model('Coc_Model');
		$this->load->model('Coc_Ordermodel');
		$this->load->model('Communication_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Paper_Model');
		$this->load->model('Noncompliance_Model');
		$this->load->model('Auditor_Reportlisting_Model');
		$this->load->model('Global_performance_Model');
		$this->load->model('Auditor_Comment_Model');
		$this->load->model('Diary_Model');
		$this->load->model('Resellers_Model');
		$this->load->model('Resellers_allocatecoc_Model');
		$this->load->model('Plumberperformance_Model');

		$this->load->library('pdf');
		$this->load->library('phpqrcode/qrlib');
		
		$segment1 = $this->uri->segment(1);
		if($segment1!='' && $segment1!='login' && $segment1!='forgotpassword' && $segment1!='authentication' && $segment1!='ajax' && $segment1!='common') $this->middleware();
	}
	
	public function layout1($data=[])
	{
		$this->middleware('1');
		$this->load->view('template/layout1', $data);
	}
	
	public function layout2($data=[])
	{
		$this->middleware();	
		$data['userdata'] 					= $this->getUserDetails();
		$data['permission'] 				= ($data['userdata']['type']=='2') ? $this->getUserPermission() : [];
		$data['performancestatus'] 			= ($data['userdata']['type']=='3') ? $this->userperformancestatus() : '';
		$data['provinceperformancestatus'] 	= ($data['userdata']['type']=='3') ? $this->userperformancestatus(['province' => $data['userdata']['province']]) : '';
		$data['cityperformancestatus'] 		= ($data['userdata']['type']=='3') ? $this->userperformancestatus(['city' => $data['userdata']['city']]) : '';
		
		$data['sidebar'] 		= $this->load->view('template/sidebar', $data, true);
		$this->load->view('template/layout2', $data);
	}
	
	public function middleware($type='')
	{
		$userDetails = $this->getUserDetails();
		
		if($type=='1'){
			if($userDetails){				
				if($userDetails['type']=='1' || $userDetails['type']=='2'){
					redirect('admin/dashboard/index'); 
				}elseif($userDetails['type']=='3'){
					if($userDetails['formstatus']=='1' && $userDetails['approvalstatus']=='1') redirect('plumber/dashboard/index'); 
					elseif($userDetails['formstatus']=='1' && $userDetails['approvalstatus']=='0') redirect('plumber/profile/index'); 
					else redirect('plumber/registration/index'); 
				}elseif($userDetails['type']=='4'){
					if($userDetails['formstatus']=='1') redirect('company/profile/index'); 
					else redirect('company/registration/index'); 
				}elseif($userDetails['type']=='5'){
					redirect('auditor/dashboard/index'); 
				}elseif($userDetails['type']=='6'){
					redirect('resellers/profile/index'); 
				}
			}
		}else{
			$segment1 = $this->uri->segment(1);
			if(!$userDetails){
				if($segment1=='admin'){
					redirect(''); 
				}elseif($segment1=='plumber'){
					redirect('login/plumber'); 
				}elseif($segment1=='company'){
					redirect('login/company'); 
				}elseif($segment1=='auditor'){
					redirect('login/auditor'); 
				}elseif($segment1=='resellers'){
					redirect('login/resellers'); 
				}
			}else{			
				if(($userDetails['type']=='1'  || $userDetails['type']=='2') && $segment1!='admin'){
					redirect('admin/dashboard/index'); 
				}elseif($userDetails['type']=='3' && $segment1!='plumber'){
					if($userDetails['formstatus']=='1') redirect('plumber/profile/index'); 
					else redirect('plumber/registration/index'); 
				}elseif($userDetails['type']=='4' && $segment1!='company'){
					if($userDetails['formstatus']=='1') redirect('company/profile/index'); 
					else redirect('company/registration/index'); 
				}elseif($userDetails['type']=='5' && $segment1!='auditor'){
					redirect('auditor/profile/index'); 
				}elseif($userDetails['type']=='6' && $segment1!='resellers'){
					redirect('resellers/profile/index'); 
				}
			}
		}
	}
	
	public function getPageStatus($pagestatus='')
	{
		if($pagestatus=='' || $pagestatus=='1'){
			return '1';
		}else{
			return '0';
		}
	}

	public function getAuditorPageStatus($pagestatus='')
	{
		if($pagestatus=='' || $pagestatus=='1'){
			return '1';
		}else{
			return '2';
		}
	}
	
	public function getUserID($id='')
	{
		$userDetails = $this->getUserDetails($id);
		
		if($userDetails){
			return $userDetails['id'];
		}else{
			return '';
		}
	}
	
	public function getUserDetails($id='')
	{
		if($id!=''){
			$userid = $id;
		}elseif($this->session->has_userdata('userid')){
			$userid = $this->session->userdata('userid');
		}
		
		if(isset($userid)){
			$result = $this->Users_Model->getUserDetails('row', ['id' => $userid, 'status' => ['0','1']]);
			
			if($result){
				return $result;
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	
	public function getUserPermission()
	{
		return $this->Users_Model->getUserPermission($this->getUserID());
	}
	
	public function checkUserPermission($pagetype, $permissiontype, $redirect='')
	{
		$userDetails = $this->getUserDetails();
		if($userDetails['type']=='2'){
			$permission = $this->Users_Model->getUserPermission($this->getUserID());
						
			$readpermission 	= explode(',', $permission['readpermission']);
			$writepermission 	= explode(',', $permission['writepermission']);
			
			if($permissiontype=='1'){
				if(!in_array($pagetype, $readpermission) && !in_array($pagetype, $writepermission)){ 
					$this->session->set_flashdata('error', 'Invalid Url');
					redirect('admin/administration/installationtype'); 
				}
			}
			
			if($permissiontype=='2'){
				if(!in_array($pagetype, $writepermission)){ 
					if($redirect=='1'){
						$this->session->set_flashdata('error', 'Invalid Url');
						redirect('admin/administration/installationtype'); 
					}
					
					return false;
				}else{
					return true;
				}
			}
		}else{
			return true;
		}
	}
	
	public function getNotification()
	{
		return $this->load->view('template/notification', '', true);
	}
	
	function parsestring($text) {
		$text = str_replace("\r\n", "\n", $text);
		$text = str_replace("\r", "\n", $text);

		$text = str_replace("\n", "\\n", $text);
		return $text;
	}

	public function getInstallationTypeList()
	{
		$data = $this->Installationtype_Model->getList('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Installation Type']+array_column($data, 'name', 'id');
		else return [];
	}

	public function getProvinceList()
	{
		$data = $this->Managearea_Model->getListProvince('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Province']+array_column($data, 'name', 'id');
		else return [];
	}
	
	public function getQualificationRouteList()
	{
		$data = $this->Qualificationroute_Model->getList('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Qualification Route']+array_column($data, 'name', 'id');
		else return [];
	}
	
	public function getCompanyList()
	{
		$data = $this->Company_Model->getList('all', ['type' => '4', 'status' => ['1'], 'companystatus' => ['1']], ['users', 'usersdetail']);
		
		if(count($data) > 0) return ['' => 'Select Company']+array_column($data, 'company', 'id');
		else return [];
	}
	
	public function getPlumberPerformanceList()
	{
		$data = $this->Plumberperformance_Model->getList('all', ['status' => ['1']]);
		
		if(count($data) > 0) return array_column($data, 'type', 'id');
		else return [];
	}
	
	public function getRates($id)
	{
		$data = $this->Rates_Model->getList('row', ['id' => $id, 'status' => ['1']]);
		
		if($data) return $data['amount'];
		else return '';
	}
	
	public function getAuditorPoints($id)
	{
		$data = $this->Global_performance_Model->getPointList('row', ['id' => $id]);
		
		if($data) return $data['point'];
		else return '';
	}
	
	public function getWorkmanshipPoint()
	{
		return 	[
			'1' => $this->getAuditorPoints($this->config->item('verypoor')),
			'2' => $this->getAuditorPoints($this->config->item('poor')),
			'3' => $this->getAuditorPoints($this->config->item('good')),
			'4' => $this->getAuditorPoints($this->config->item('excellent'))
		];
	}
	
	public function getPlumberVerificationPoint()
	{
		return 	[
			'1' => $this->getAuditorPoints($this->config->item('plumberverificationyes')),
			'2' => $this->getAuditorPoints($this->config->item('plumberverificationno'))
		];
	}
	
	public function getCocVerificationPoint()
	{
		return 	[
			'1' => $this->getAuditorPoints($this->config->item('cocverificationyes')),
			'2' => $this->getAuditorPoints($this->config->item('cocverificationno'))
		];
	}
	
	public function getRollingAverage()
	{
		return $this->getAuditorPoints($this->config->item('rollingaverage'));
	}
	
	public function getPlumberRates()
	{
		return 	[
			'1' => $this->getRates($this->config->item('learner')),
			'2' => $this->getRates($this->config->item('assistant')),
			'3' => $this->getRates($this->config->item('operator')),
			'4' => $this->getRates($this->config->item('licensed'))
		];
	}
	
	public function getCityList()
	{
		$data = $this->Managearea_Model->getListCity('all', ['status' => ['1']]);

		if(count($data) > 0) return ['' => 'Select City']+array_column($data, 'name', 'id');
		else return [];
	}
	
	public function getAuditorReportingList($userid)
	{
		$requestData = $this->input->post();
		$data = $this->Auditor_Reportlisting_Model->getList('all', ['status' => ['1'], 'user_id' => $userid]);

		if(count($data) > 0) return ['' => 'Select My Report Listings/Favourites']+array_column($data, 'favour_name', 'id');
		else return [];
	}
	
	public function plumbercard($userid)
	{
		$data['company'] 			= $this->getCompanyList();
		$data['designation2'] 		= $this->config->item('designation2');
		$data['specialisations'] 	= $this->config->item('specialisations');
		$data['settings'] 			= $this->Systemsettings_Model->getList('row');
		
		$data['result'] = $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber', 'company']);
		return $this->load->view('common/card', $data, true) ;
	}
	
	public function plumberprofile($id, $pagedata=[], $extras=[])
	{
		$result = $this->Plumber_Model->getList('row', ['id' => $id, 'type' => '3', 'status' => ['1', '2']], ['users', 'usersdetail', 'usersplumber', 'usersskills', 'company', 'physicaladdress', 'postaladdress', 'billingaddress']);
		if(!$result){
			redirect($extras['redirect']); 
		}
		
		if($this->input->post()){
			$requestData 			= 	$this->input->post();
			$requestData['user_id'] = 	$id;
			
			if(isset($requestData['coc_purchase_limit'])){
				$currentcoclimit	= $result['coc_purchase_limit'];
				$coclimit 			= $requestData['coc_purchase_limit'];
				
				
				$userpaperstock 	= $this->Paper_Model->getList('count', ['nococstatus' => '2', 'userid' => $id]); 				
				$orderquantity 		= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $id]);
				$userorderstock 	= array_sum(array_column($orderquantity, 'quantity'));
				$plumberstock		= ($userpaperstock + $userorderstock);
				if($coclimit < $plumberstock){
					$this->session->set_flashdata('error', 'Plumber already has '.$userpaperstock.' coc without logged and '.$userorderstock.' coc waiting for approval.');
					
					redirect($extras['redirect']); 
				}else{
					$stockcount = $coclimit - $plumberstock;
				}
				
				$this->Coc_Model->actionCocCount(['count' => $stockcount, 'user_id' => $id]);	
			}
			
			$plumberdata 	=  $this->Plumber_Model->action($requestData);
				
			if(isset($requestData['submit']) && $requestData['submit']=='approvalsubmit'){
				$commentdata 	=  $this->Comment_Model->action($requestData);				
			}
			
			if($plumberdata || (isset($commentdata) && $commentdata)){
				$data		= '1';
				$message 	= 'Plumber '.(($id=='') ? 'created' : 'updated').' successfully.';
			}
			
			if(isset($data)){
				
				if(isset($requestData['submit']) && $requestData['submit']=='approvalsubmit'){
					if(isset($requestData['approval_status'])){
						$diaryparam = ($extras['roletype']=='1') ? ['adminid' => $this->getUserID(), 'type' => '1'] : [];
						if($requestData['approval_status']=='1'){
							$this->CC_Model->diaryactivity(['plumberid' => $id, 'action' => '2']+$diaryparam);
							
							$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '5', 'emailstatus' => '1']);
				
							if($notificationdata){
								$body 	= str_replace(['{Plumbers Name and Surname}', '{email}'], [$result['name'].' '.$result['surname'], $result['email']], $notificationdata['email_body']);
								$this->CC_Model->sentMail($result['email'], $notificationdata['subject'], $body);
							}
							
							if($this->config->item('otpstatus')!='1'){
								$smsdata 	= $this->Communication_Model->getList('row', ['id' => '5', 'smsstatus' => '1']);
					
								if($smsdata){
									$sms = str_replace(['{primary email}'], [$result['email']], $smsdata['sms_body']);
									$this->sms(['no' => $result['mobile_phone'], 'msg' => $sms]);
								}
							}
						}elseif($requestData['approval_status']=='2'){
							$this->CC_Model->diaryactivity(['plumberid' => $id, 'action' => '3']+$diaryparam);
							
							$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '6', 'emailstatus' => '1']);
				
							if($notificationdata){
								$body 	= str_replace(['{Plumbers Name and Surname}'], [$result['name'].' '.$result['surname']], $notificationdata['email_body']);
								$this->CC_Model->sentMail($result['email'], $notificationdata['subject'], $body);
							}
							
							if($this->config->item('otpstatus')!='1'){
								$smsdata 	= $this->Communication_Model->getList('row', ['id' => '6', 'smsstatus' => '1']);
					
								if($smsdata){
									$sms = $smsdata['sms_body'];
									$this->sms(['no' => $result['mobile_phone'], 'msg' => $sms]);
								}
							}
						}
					}
				}
				
				if(isset($requestData['designation2']) && $requestData['designation2']!=$result['designation']){
					$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '7', 'emailstatus' => '1']);
				
					if($notificationdata){
						$body 	= str_replace(['{Plumbers Name and Surname}'], [$result['name'].' '.$result['surname']], $notificationdata['email_body']);
						$this->CC_Model->sentMail($result['email'], $notificationdata['subject'], $body);
					}
					
					if($this->config->item('otpstatus')!='1'){
						$smsdata 	= $this->Communication_Model->getList('row', ['id' => '7', 'smsstatus' => '1']);
			
						if($smsdata){
							$sms = $smsdata['sms_body'];
							$this->sms(['no' => $result['mobile_phone'], 'msg' => $sms]);
						}
					}	
				}
				
				if(isset($requestData['submit']) && $requestData['submit']!='approvalsubmit'){
					$diaryparam = ($extras['roletype']=='1') ? ['adminid' => $this->getUserID(), 'type' => '1'] : ['type' => '2'];
					$this->CC_Model->diaryactivity(['plumberid' => $id, 'action' => '4']+$diaryparam);
				}
				
				$this->session->set_flashdata('success', $message);
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			
			redirect($extras['redirect']); 
		}
		
		$userid			= 	$result['id'];
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['qualificationroute'] = $this->getQualificationRouteList();
		$pagedata['plumberrates'] 		= $this->getPlumberRates();
		$pagedata['company'] 			= $this->getCompanyList();
		$pagedata['card'] 				= $this->plumbercard($userid);
		
		$pagedata['titlesign'] 			= $this->config->item('titlesign');
		$pagedata['gender'] 			= $this->config->item('gender');
		$pagedata['racial'] 			= $this->config->item('racial');
		$pagedata['yesno'] 				= $this->config->item('yesno');
		$pagedata['othernationality'] 	= $this->config->item('othernationality');
		$pagedata['homelanguage'] 		= $this->config->item('homelanguage');
		$pagedata['disability'] 		= $this->config->item('disability');
		$pagedata['citizen'] 			= $this->config->item('citizen');
		$pagedata['deliverycard'] 		= $this->config->item('deliverycard');
		$pagedata['employmentdetail'] 	= $this->config->item('employmentdetail');
		$pagedata['userid'] 			= $userid;
		$pagedata['result'] 			= $result;
		
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['applicationstatus'] 	= $this->config->item('applicationstatus');
		$pagedata['approvalstatus'] 	= $this->config->item('approvalstatus');
		$pagedata['rejectreason'] 		= $this->config->item('rejectreason');
		$pagedata['plumberstatus'] 		= $this->config->item('plumberstatus');
		$pagedata['specialisations'] 	= $this->config->item('specialisations');
		$pagedata['comments'] 			= $this->Comment_Model->getList('all', ['user_id' => $id]);
		$pagedata['defaultsettings'] 	= $this->Systemsettings_Model->getList('row');
		$pagedata['menu']				= $this->load->view('common/plumber/menu', ['id'=>$id],true);
		
		$data['plugins']				= ['validation','datepicker','inputmask','select2'];
		$data['content'] 				= $this->load->view('common/plumber/profile', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function companyprofile($id, $pagedata=[], $extras=[])
	{
		$result = $this->Company_Model->getList('row', ['id' => $id, 'type' => '4', 'status' => ['0','1', '2']], ['users', 'usersdetail', 'userscompany', 'physicaladdress', 'postaladdress']);
		if(!$result){
			redirect($extras['redirect']); 
		}
		
		if($this->input->post()){
			$requestData 			= 	$this->input->post();
			$requestData['user_id'] = 	$id;
			
			$companydata 	=  $this->Company_Model->action($requestData);
				
			if(isset($requestData['submit']) && $requestData['submit']=='approvalsubmit'){
				$commentdata 	=  $this->Comment_Model->action($requestData);				
			}
			
			if($companydata || (isset($commentdata) && $commentdata)){
				$data		= '1';
				$message 	= 'Company '.(($id=='') ? 'created' : 'updated').' successfully.';
			}
			
			if(isset($data)){
				$this->session->set_flashdata('success', $message);
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			
			redirect($extras['redirect']); 
		}
		
		$userid			= 	$result['id'];
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['province'] 				= $this->getProvinceList();
		$pagedata['approvalstatus'] 		= $this->config->item('approvalstatus');
		$pagedata['companyrejectreason'] 	= $this->config->item('companyrejectreason');
		$pagedata['worktype'] 				= $this->config->item('worktype');
		$pagedata['specialization']			= $this->config->item('specialization');
		$pagedata['companystatus']			= $this->config->item('companystatus');
		$pagedata['comments'] 				= $this->Comment_Model->getList('all', ['user_id' => $id]);
		$pagedata['result'] 				= $result;
		$pagedata['menu']					= $this->load->view('common/company/menu', ['id'=>$id],true);
		//
		$data['plugins']				= ['validation','datepicker','inputmask','select2'];
		$data['content'] 				= $this->load->view('common/company/company', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	// Company Employee Listing
	public function employee($id=[], $pagedata=[], $extras=[])
	{

		 if (isset($pagedata['pagetype']) && $pagedata['pagetype']=='adminempdetails') {

		 	// comp_id = plumber ID

			$result = $this->Company_Model->getEmpList('employee', ['comp_id' => $id['id'], 'type' => '3', 'status' => ['0','1', '2']]);
			//print_r($result[0]['user_id']);die;
			$pagedata['employee'] = $result;
			$pagedata['specialization']	= $this->config->item('specialisations');

			$pagedata['company'] 		= $this->getCompanyList();
			$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
			$userdata1					= $this->Plumber_Model->getList('row', ['id' => $result[0]['user_id']], ['users', 'usersdetail', 'usersplumber']);

			$pagedata['user_details1'] 	= $userdata1;

			
			
			////$pagedata['history']		= $this->Auditor_Model->getReviewHistory2Count(['plumberid' => $result[0]['user_id']]);
			$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $result[0]['user_id']]);

			$pagedata['history2']		= $this->Auditor_Model->getReviewHistory2Count(['plumberid' => $result[0]['user_id']]);

			$pagedata['logged']			= $this->Coc_Model->getCOCList('count', ['user_id' => $result[0]['user_id'], 'coc_status' => ['2']]);

			$pagedata['allocated']		= $this->Coc_Model->getCOCList('count', ['user_id' => $result[0]['user_id'], 'coc_status' => ['4']]);

			$pagedata['nonlogged']		= $this->Coc_Model->getCOCList('count', ['user_id' => $result[0]['user_id'], 'coc_status' => ['5']]);

			$pagedata['user_details'] 	= $this->Plumber_Model->getList('row', ['id' => $result[0]['user_id']], ['users', 'usersdetail', 'usersplumber']);

			$pagedata['settings_cpd']	= $this->Systemsettings_Model->getList('all',['user_id' => $result[0]['user_id']]);
			

			//$pagedata['loggedcoc']		= $this->Coc_Model->getCOCList('count', ['user_id' => $result[0]['user_id'], 'coc_status' => ['2']]);
		 }
		
		if(isset($result) && !$result){
			redirect($extras['redirect']); 
		}
		
		if (is_array($id)) {
			$companyID =  $id['compid'];
		}else{
			$companyID =  $id;
		}
		
		$pagedata['menu']				= $this->load->view('common/company/menu', ['id'=>$companyID],true);
		$data['plugins']				= ['datatables','validation','datepicker','inputmask','select2', 'echarts'];
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['designation2']		= $this->config->item('designation2');
		$pagedata['plumberstatus']		= $this->config->item('plumberstatus');
		$pagedata['id'] 				= $companyID;
		$data['content'] 				= $this->load->view('common/company/employee_listing', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function companydiary($id='')
	{
		if($id!=''){
			$result = $this->Company_Model->getList('row', ['id' => $id, 'type' => '4', 'status' => ['1', '2']], ['users', 'usersdetail', 'userscompany', 'physicaladdress', 'postaladdress']);
			$pagedata['result'] 		= $result;
			$DBcomments = $this->Comment_Model->getList('all', ['user_id' => $id, 'type' => '4', 'status' => ['1', '2']]);
			if($DBcomments){
				$pagedata['comments']		= $DBcomments;
			}
		}

		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			$data = $this->Company_Model->companydiary($requestData);
			if($data) $message = 'Comment added successfully.';

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');

			redirect('admin/company/index/diary/'.$requestData['user_id'].''); 

		}


		$pagedata['diarylist'] = $this->diaryactivity(['companyid'=>$id]);		

		$pagedata['user_id']		= $result['id'];
		$pagedata['user_role']		= $this->config->item('roletype');
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['roletype']		= $this->config->item('roleadmin');
		$pagedata['menu']			= $this->load->view('common/company/menu', ['id'=>$result['id']],true);
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('common/company/diary', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	public function resellersprofile($id, $pagedata=[], $extras=[])
	{
		if($id!=''){
			$result = $this->Resellers_Model->getList('row', ['id' => $id, 'status' => ['0','1']], ['users', 'usersdetail', 'coccount', 'physicaladdress', 'postaladdress', 'billingaddress']);
			if($result){
				$pagedata['result'] = $result;

			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				if($extras['redirect']) redirect($extras['redirect']); 
				else redirect('admin/resellers/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 				= 	$this->input->post();
			$requestData['roletype'] 	= 	$pagedata['roletype'];

			$data 	=  $this->Resellers_Model->action($requestData);
		
			if($data) $this->session->set_flashdata('success', 'Resellers '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			if($extras['redirect']) redirect($extras['redirect']); 
			else redirect('admin/resellers/index');
		}
		
		$post1['user_id'] = $id;
		$post1['search']['value'] = 'in stock';
		$pagedata['stock_count'] = $this->Resellers_allocatecoc_Model->getstockList('count',$post1);

		$pagedata['adminvalue']   = $extras['adminvalue'];
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','inputmask'];
		$data['content'] 			= $this->load->view('common/resellers', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function auditorprofile($id,$extras=[])
	{
		if($id!=''){
			$result = $this->Auditor_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				if($extras['redirect']) redirect($extras['redirect']); 
				else redirect('admin/audits/index'); 
			}
		}

		if($this->input->post()){
			$requestData 	= $this->input->post();			
			$data 			= $this->Auditor_Model->action($requestData);
			
			if($data) $this->session->set_flashdata('success', 'Auditor '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			if($extras['redirect']) redirect($extras['redirect']); 
			else redirect('admin/audits/index');
		}

		
		$pagedata['notification'] = $this->getNotification();
		$pagedata['provincelist'] = $this->getProvinceList();
		$pagedata['audit_status'] = $this->config->item('audits_status1');
		
		$pagedata['history']	  = $this->Auditor_Model->getReviewHistoryCount(['auditorid' => $id]);	
		
		$data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','inputmask','echarts'];
		$data['content'] = $this->load->view('common/auditor', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function coclogaction($id, $pagedata=[], $extras=[])
	{
		$userid							= $extras['userid'];
		$auditorid						= isset($extras['auditorid']) ? ['auditorid' => $extras['auditorid']] : [];
		$result							= $this->Coc_Model->getCOCList('row', ['id' => $id, 'user_id' => $userid]+$auditorid);
		if(!$result){
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect($extras['redirect']); 
		}
		
		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
		$specialisations 				= explode(',', $userdata['specialisations']);
		
		if($this->input->post()){
			$requestData 						= 	$this->input->post();
			$requestData['company_details'] 	= 	$userdata['company_details'];
			
			$data 	=  $this->Coc_Model->actionCocLog($requestData);
			
			$message = '';
			if(isset($requestData['submit'])){
				if($requestData['submit']=='save'){
					$message = 'Thanks for Saving the COC.';
				}elseif($requestData['submit']=='log'){
					$message = 'Thanks for Logging the COC.';
					$this->CC_Model->diaryactivity(['plumberid' => $this->getUserID(), 'cocid' => $requestData['coc_id'], 'action' => '7', 'type' => '2']);
										
					$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '18', 'emailstatus' => '1']);
				
					if($notificationdata){
						$body 	= str_replace(['{Plumbers Name and Surname}', '{number}'], [$userdata['name'].' '.$userdata['surname'], $id], $notificationdata['email_body']);
						$this->CC_Model->sentMail($userdata['email'], $notificationdata['subject'], $body);
					}				
					
					if($this->config->item('otpstatus')!='1'){
						$smsdata 	= $this->Communication_Model->getList('row', ['id' => '18', 'smsstatus' => '1']);
			
						if($smsdata){
							$sms = str_replace(['{number of COC}'], [$id], $smsdata['sms_body']);
							$this->sms(['no' => $userdata['mobile_phone'], 'msg' => $sms]);
						}
					}
					
					if(isset($requestData['ncemail']) && $requestData['ncemail']=='1'){
						$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '23', 'emailstatus' => '1']);
				
						if(isset($requestData['email']) && $requestData['email']!='' && $notificationdata){
							$replacetext = ['', '', '', '', '', '', ''];							
							if(isset($requestData['name'])) 		$replacetext[0] = $requestData['name'];
							if(isset($requestData['address'])) 		$replacetext[1] = $requestData['address'];
							if(isset($requestData['street'])) 		$replacetext[2] = $requestData['street'];
							if(isset($requestData['number'])) 		$replacetext[3] = $requestData['number'];
							if(isset($requestData['province'])){
								$provincename 	= 	$this->Managearea_Model->getListProvince('row', ['id' => $requestData['province']]);
								$replacetext[4] 	=  $provincename['name'];
							} 	
							if(isset($requestData['city'])){
								$cityname 	= 	$this->Managearea_Model->getListCity('row', ['id' => $requestData['city']]);
								$replacetext[5] =  $cityname['name'];
							} 		
							if(isset($requestData['suburb'])){
								$suburbname = 	$this->Managearea_Model->getListSuburb('row', ['id' => $requestData['suburb']]);
								$replacetext[6] =  $suburbname['name'];
							} 	
							$subject 	= str_replace(['{Customer Name}', '{Complex Name}', '{Street}', '{Number}', '{Suburb}', '{City}', '{Province}'], $replacetext, $notificationdata['subject']);
							$body 		= str_replace(['{Customer Name}', '{Complex Name}', '{Street}', '{Number}', '{Suburb}', '{City}', '{Province}'], $replacetext, $notificationdata['email_body']);
							
							$pdf 		= FCPATH.'assets/uploads/temp/'.$requestData['coc_id'].'.pdf';
							$this->pdfnoncompliancereport($requestData['coc_id'], $userid, $pdf);
							$this->CC_Model->sentMail($requestData['email'], $subject, $body, $pdf, $userdata['email']);
							if(file_exists($pdf)) unlink($pdf);  
						}				
						
						if(isset($requestData['contact_no']) && $requestData['contact_no']!='' && $this->config->item('otpstatus')!='1'){
							$smsdata 	= $this->Communication_Model->getList('row', ['id' => '23', 'smsstatus' => '1']);
				
							if($smsdata){
								$sms = $smsdata['sms_body'];
								$this->sms(['no' => $requestData['contact_no'], 'msg' => $sms]);
							}
						}
					}
				}
			}
			
			if($data) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
		
			redirect($extras['redirect']); 
		}
		
		$pagedata['userdata'] 			= $userdata;
		$pagedata['cocid'] 				= $id;
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['ncnotice'] 			= $this->config->item('ncnotice');
		$pagedata['installationtype']	= $this->getInstallationTypeList();
		$pagedata['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
		$pagedata['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);
		$pagedata['result']				= $result;
		
		$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);		
		$pagedata['noncompliance']		= [];
		foreach($noncompliance as $compliance){
			$pagedata['noncompliance'][] = [
				'id' 		=> $compliance['id'],
				'details' 	=> $this->parsestring($compliance['details']),
				'file' 		=> $compliance['file']
			];
		}
		
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker', 'inputmask'];
		$data['content'] 				= $this->load->view('common/logcocstatement', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
	
	public function getauditreview($id, $pagedata=[], $extras=[])
	{		
		$extraparam = [];
		if(isset($extras['auditorid'])) $extraparam['auditorid'] 	= $extras['auditorid'];
		if(isset($extras['plumberid'])) $extraparam['user_id'] 		= $extras['plumberid'];		
		$result	= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]+$extraparam);	
		if(!$result){
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect($extras['redirect']); 
		}
		
		$pagedata['settings'] 		= $this->Systemsettings_Model->getList('row');
		$pagedata['result']			= $result;
		
		if($this->input->post()){
			$datetime 		=  date('Y-m-d H:i:s');
			$requestData 	=  $this->input->post();
			$data 			=  $this->Auditor_Model->actionStatement($requestData);
						
			if($data){
				if($requestData['submit']=='save' && isset($requestData['hold'])){
					$this->db->update('stock_management', ['audit_status' => '5'], ['id' => $pagedata['result']['id']]);
				}elseif($requestData['submit']=='save' && !isset($requestData['hold']) && $requestData['auditstatus']=='0'){
					$this->db->update('stock_management', ['audit_status' => '3'], ['id' => $pagedata['result']['id']]);
				}elseif($requestData['submit']=='save' && !isset($requestData['hold']) && $requestData['auditstatus']=='1'){
					$this->db->update('stock_management', ['audit_status' => '2'], ['id' => $pagedata['result']['id']]);
				}
				
				if($requestData['auditstatus']=='0'){
					$auditreviewrow = $this->Auditor_Model->getReviewList('row', ['coc_id' => $pagedata['result']['id'], 'reviewtype' => '1', 'status' => '0']);
					if($auditreviewrow){
						$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '22', 'emailstatus' => '1']);

						if($notificationdata){
							$pdf 		= FCPATH.'assets/uploads/temp/'.$id.'.pdf';
							$this->pdfauditreport($id, $pdf);
							
							$duedate 		= ($auditreviewrow) ? date('d-m-Y', strtotime($auditreviewrow['created_at'].' +'.$pagedata['settings']['refix_period'].'days')) : '';
							
							$body 	= str_replace(['{Plumbers Name and Surname}', '{COC number}', '{refix number} ', '{due date}'], [$pagedata['result']['u_name'], $pagedata['result']['id'], $pagedata['settings']['refix_period'], $duedate], $notificationdata['email_body']);
							$this->CC_Model->sentMail($pagedata['result']['u_email'], $notificationdata['subject'], $body, $pdf);
							if(file_exists($pdf)) unlink($pdf);  
						}
						
						if($this->config->item('otpstatus')!='1'){
							$smsdata 	= $this->Communication_Model->getList('row', ['id' => '22', 'smsstatus' => '1']);
				
							if($smsdata){
								$sms = str_replace(['{number of COC}'], [$id], $smsdata['sms_body']);
								$this->sms(['no' => $pagedata['result']['u_mobile'], 'msg' => $sms]);
							}
						}
					}
				}
				
				if(isset($requestData['auditcomplete']) && $requestData['auditcomplete']=='1' && $requestData['submit']=='submitreport'){

					
					//Invoice and Order
					$inspectionrate = $this->currencyconvertor($this->getRates($this->config->item('inspection')));
					$invoicedata = [
						'description' 	=> 'Audit undertaken for '.$pagedata['result']['u_name'].' on COC '.$pagedata['result']['id'].'. Date of Review Submission '.date('d-m-Y', strtotime($datetime)),
						'user_id'		=> (isset($extras['auditorid'])) ? $extras['auditorid'] : '',
						'total_cost'	=> $inspectionrate,
						'status'		=> '2',
						'created_at'	=> $datetime
					];
					$this->db->insert('invoice', $invoicedata);
					$insertid = $this->db->insert_id();
					unset($invoicedata['total_cost']);
					$invoicedata = $invoicedata+['cost_value' => $inspectionrate, 'total_due' => $inspectionrate, 'inv_id' => $insertid];
					$this->db->insert('coc_orders', $invoicedata);
					
					if($requestData['auditstatus']=='1'){						
						// Email
						$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '21', 'emailstatus' => '1']);
						if($notificationdata){
							$body 	= str_replace(['{Plumbers Name and Surname}', '{COC number}'], [$pagedata['result']['u_name'], $pagedata['result']['id']], $notificationdata['email_body']);
							$this->CC_Model->sentMail($pagedata['result']['u_email'], $notificationdata['subject'], $body);
						}
						
						// SMS
						if($this->config->item('otpstatus')!='1'){
							$smsdata 	= $this->Communication_Model->getList('row', ['id' => '21', 'smsstatus' => '1']);
				
							if($smsdata){
								$sms = str_replace(['{number of COC}'], [$id], $smsdata['sms_body']);
								$this->sms(['no' => $pagedata['result']['u_mobile'], 'msg' => $sms]);
							}
						}
						
						// Stock
						$this->db->update('stock_management', ['audit_status' => '1'], ['id' => $pagedata['result']['id']]);
						
						$this->CC_Model->diaryactivity(['plumberid' => $pagedata['result']['user_id'], 'auditorid' => $pagedata['result']['auditorid'], 'cocid' => $pagedata['result']['id'], 'action' => '9', 'type' => '4']);
					}elseif($requestData['auditstatus']=='0'){
						$this->db->update('stock_management', ['audit_status' => '4'], ['id' => $pagedata['result']['id']]);
						
						$this->CC_Model->diaryactivity(['plumberid' => $pagedata['result']['user_id'], 'auditorid' => $pagedata['result']['auditorid'], 'cocid' => $pagedata['result']['id'], 'action' => '10', 'type' => '4']);
					}
					
					$this->Auditor_Model->actionRatio($requestData['plumberid']);
					/// check audit statements

					$auditcomplete_count = $this->db->select('count(auditcomplete) as countaudit')->get_where('auditor_statement', ['plumber_id' => $requestData['plumberid'], 'auditcomplete' => '1'])->row_array();
					$audit_list = $this->db->select('id, allocation')->get_where('compulsory_audit_listing', ['user_id' => $requestData['plumberid']])->row_array();
					
					if ($audit_list['allocation']<=$auditcomplete_count['countaudit']) {
						//$this->db->delete('compulsory_audit_listing', array('id' => $audit_list['id']));
						//$this->db->delete('compulsory_audit_listing')->where('id', $audit_list['id']);
						$this->db->where('id', $audit_list['id']);
   						$this->db->delete('compulsory_audit_listing'); 
					}

				} 
				
				$this->session->set_flashdata('success', 'Successfully updated.');
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			
			redirect($extras['redirect']); 
		}
		
		$pagedata['userid'] 					= $this->getUserID();
		$pagedata['notification'] 				= $this->getNotification();
		$pagedata['province'] 					= $this->getProvinceList();
		$pagedata['installationtype']			= $this->getInstallationTypeList();
		$pagedata['auditorreportlist']			= $this->getAuditorReportingList((isset($extras['auditorid']) ? $extras['auditorid'] : ''));
		$pagedata['workmanshippt']				= $this->getWorkmanshipPoint();
		$pagedata['plumberverificationpt']		= $this->getPlumberVerificationPoint();
		$pagedata['cocverificationpt']			= $this->getCocVerificationPoint();
		$pagedata['cocverificationpt']			= $this->getCocVerificationPoint();
		$pagedata['noaudit']					= $this->getAuditorPoints($this->config->item('noaudit'));
		$pagedata['workmanship'] 				= $this->config->item('workmanship');
		$pagedata['yesno'] 						= $this->config->item('yesno');		
		$pagedata['reviewtype'] 				= $this->config->item('reviewtype');	
		$pagedata['reviewlist']					= $this->Auditor_Model->getReviewList('all', ['coc_id' => $id]);
		$pagedata['menu']						= $this->load->view('common/auditstatement/menu', (isset($pagedata) ? $pagedata : ''), true);
		
		$data['plugins']			= ['datepicker', 'sweetalert', 'validation', 'select2'];
		$data['content'] 			= $this->load->view('common/auditstatement/review', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function getaudithistory($id, $pagedata=[], $extras=[])
	{
		$auditorid					= isset($extras['auditorid']) ? ['auditorid' => $extras['auditorid']] : [];
		$result						= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]+$auditorid);	
		if(!$result){
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect($extras['redirect']); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['result']			= $result;
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $pagedata['result']['user_id']]);	
		$pagedata['menu']			= $this->load->view('common/auditstatement/menu', (isset($pagedata) ? $pagedata : ''), true);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'datepicker', 'echarts'];
		$data['content'] 			= $this->load->view('common/auditstatement/history', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function getauditdiary($id, $pagedata=[], $extras=[])
	{
		$auditorid					= isset($extras['auditorid']) ? ['auditorid' => $extras['auditorid']] : [];
		$result	= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]+$auditorid);	
		if(!$result){
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect($extras['redirect']); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['result']			= $result;
		$pagedata['comments']		= $this->Auditor_Comment_Model->getList('all', ['coc_id' => $id]);	
		$pagedata['diary']			= $this->diaryactivity(['cocid' => $id]+$auditorid);	
		$pagedata['menu']			= $this->load->view('common/auditstatement/menu', (isset($pagedata) ? $pagedata : ''), true);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'datepicker', 'sweetalert', 'validation', 'select2'];
		$data['content'] 			= $this->load->view('common/auditstatement/diary', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function getchat($id, $data=[], $extras=[])
	{
		$auditorid	= isset($extras['auditorid']) ? ['auditorid' => $extras['auditorid']] : [];
		$result		= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]+$auditorid);	
		if(!$result){
			$this->session->set_flashdata('error', 'No Record Found.');
			redirect($extras['redirect']); 
		}
		$data['result']	= $result;
		
		$this->load->view('common/auditstatement/chat', $data);
	}
	
	public function pdfauditreport($id, $save='')
	{
		$pagedata['result']			= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]);
		$pagedata['reviewlist']		= $this->Auditor_Model->getReviewList('all', ['coc_id' => $id]);
		$html = $this->load->view('pdf/auditreport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		
		if($save==''){
			$this->pdf->stream('Audit Report '.$id);
		}else{
			file_put_contents($save, $output);
			return $save;
		}
	}

	public function pdfelectroniccocreport($id, $userid)
	{		
		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
		$pagedata['userdata']	 		= $userdata;
		$pagedata['specialisations']	= explode(',', $pagedata['userdata']['specialisations']);
		$pagedata['result']		    	= $this->Coc_Model->getCOCList('row', ['id' => $id]);
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$specialisations 				= explode(',', $userdata['specialisations']);
		$pagedata['installationtype']	= $this->getInstallationTypeList();
		$pagedata['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => []]);
		$pagedata['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations]);

		$html = $this->load->view('pdf/electroniccocreport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A2', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		$this->pdf->stream('Electronic COC Report '.$id);
	}
	
	public function pdfnoncompliancereport($id, $userid, $save='')
	{		
		$pagedata['result']			= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]);
		$pagedata['noncompliance'] 	= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);	

		$html = $this->load->view('pdf/noncompliancereport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A2', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		
		if($save==''){
			$this->pdf->stream('Non Compliance Report '.$id);
		}else{
			file_put_contents($save, $output);
			return $save;
		}
	}	

	public function cocreport($id, $title, $extras=[])
	{		
		$pagedata['settings']	= $this->Systemsettings_Model->getList('row');
		$pagedata['currency']   = $this->config->item('currency');
		$pagedata['rowData'] 	= $this->Coc_Model->getListPDF('row', ['id' => $id, 'status' => ['0','1']]);
		$pagedata['rowData1'] 	= $this->Coc_Model->getPermissions('row', ['id' => $id, 'status' => ['0','1']]);
		$pagedata['rowData2'] 	= $this->Coc_Model->getPermissions1('row', ['id' => $id, 'status' => ['0','1']]);
		$pagedata['title'] 		= $title;
		$pagedata['extras'] 	= $extras;
		
		$html 			= $this->load->view('pdf/coc', (isset($pagedata) ? $pagedata : ''), true);						  
		$pdfFilePath 	= $id.'.pdf';
		$filePath 		= FCPATH.'assets/inv_pdf/';
		
		if(file_exists($filePath.$pdfFilePath)) unlink($filePath.$pdfFilePath);  
			
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		file_put_contents($filePath.$pdfFilePath, $output);
		
		return $filePath.$pdfFilePath;
	}	

	public function mycptindex($pagestatus='',$id='',$userid='')
	{
		if($id!=''){
			$result = $this->Mycpd_Model->getQueueList('row', ['id' => $id, 'pagestatus' => $pagestatus]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('plumber/mycpd/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){

				$data 	=  $this->Mycpd_Model->actionInsert($requestData);
				if($data) $message = 'CPD Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}elseif($requestData['submit']=='save'){
				//print_r($requestData);die;

				$data 	=  $this->Mycpd_Model->actionSave($requestData);
				if($data) $message = 'My CPD '.(($id=='') ? 'save' : 'updated').' successfully.';
			}
			else{
				$data 			= 	$this->Mycpd_Model->changestatus($requestData);
				$message		= 	'CPD Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('plumber/mycpd/index'); 
		}		
		
		$pagedata['mycpd'] 							= $this->userperformancestatus(['performancestatus' => '1', 'auditorstatement' => '1']);
		
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['cpdstreamID'] 	= $this->config->item('cpdstream');
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);
		$pagedata['id'] 			= $userid;
		$pagedata['user_details'] 	= $userdata1;
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker', 'knob'];
		$data['content'] 			= $this->load->view('plumber/mycpd/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function userperformancestatus($data = []){	
		$rollingavg 	= $this->getRollingAverage();
		$userid			= $this->getUserID();
		$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		
		$extradata 				= $data;
		$extradata['date'] 		= $date;
		$extradata['archive'] 	= '0';
		
		if(count($data)==0){
			$extradata['plumberid'] = $userid;
		}elseif(count($data) > 0 && in_array('performancestatus', array_keys($data))){
			unset($extradata['date']);
			unset($extradata['archive']);
			$extradata['plumberid'] = $userid;
			unset($data);
		}
		
		$results = $this->Plumber_Model->performancestatus('all', $extradata);
		
		if(isset($data) && count($data) > 0){
			if(isset($data['limit'])) return $results;
			else return array_search($userid, array_column($results, 'userid'))+1;
		}else{
			return count($results) ? array_sum(array_column($results, 'point')) : '0';
		}
	}
	
	public function performancestatusrollingaverage(){	
		$data = $this->Global_performance_Model->getPointList('row', ['id' => $this->config->item('rollingaverage')]);
		if($data && isset($data['point']) && $data['point']!=''){
			$this->db->trans_begin();	
			$date = date('Y-m-d', strtotime(date('Y-m-d').'-'.$data['point'].' months'));
			$this->db->update('auditor_statement', ['archive' => '1'], ['auditcompletedate <=' => $date,'archive' => '0']);
			$this->db->update('cpd_activity_form', ['archive' => '1'], ['approved_date <=' => $date,'archive' => '0']);	
			$this->db->update('performance_status', ['archive' => '1'], ['enddate <=' => $date,'archive' => '0']);	
			
			if($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return false;
			}
			else
			{
				$this->db->trans_commit();
				return true;
			}
		}
	}
	
	public function performancestatusmail()
	{
		$warnings	= $this->Global_performance_Model->getWarningList('all', ['status' => ['1']]);
		$rollingavg = $this->getRollingAverage();
		$date		= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		
		$datas = $this->Plumber_Model->performancestatus('all', ['plumbergroup' => '1', 'archive' => '0', 'date' => $date, 'performancestatus' => '1']);
		foreach($datas as $data){
			$explodepoint 	= explode(',', $data['point']);
			$plumberid		= $data['userid'];
			$warninglevel 	= '';
			$warningtext 	= '';
			
			foreach($explodepoint as $plumberpoint){				
				for($i=0; $i<count($warnings); $i++){	
			
					if($plumberpoint < 0){					
						$warningpoint = $warnings[$i]['point'];
						$warningend = isset($warnings[$i+1]['point']) ? $warnings[$i+1]['point'] : '0';
						
						if(
							($warningend!='0' && ((abs($warningpoint) <= abs($plumberpoint)) && (abs($warningend) > abs($plumberpoint)))) ||
							($warningend=='0' && ((abs($warningpoint) <= abs($plumberpoint))))
						){
							$warninglevel = $i+1;
							$warningtext  = $warnings[$i]['warning'];
						}					
					}
				}				
			}
			
			if($warninglevel!=''){
				$userDetails = $this->getUserDetails($plumberid);
				$userwarning = $userDetails['performancestatus'];
				if($userwarning!=$warninglevel){
					$this->db->update('users', ['performancestatus' => $warninglevel], ['id' => $plumberid]);
					$notificationid 	= ['9', '10', '11', '12'];
					$notificationdata 	= $this->Communication_Model->getList('row', ['id' => $notificationid[$warninglevel-1], 'emailstatus' => '1']);

					if($notificationdata){
						$plumber 	= $this->Plumber_Model->getList('row', ['id' => $plumberid], ['users', 'usersdetail']);
						$body 		= str_replace(['{Plumbers Name and Surname}', '{Performance warning status}'], [$plumber['name'].' '.$plumber['surname'], $warningtext], $notificationdata['email_body']);
						$this->CC_Model->sentMail($plumber['email'], $notificationdata['subject'], $body);
					}
					
					if($this->config->item('otpstatus')!='1'){
						$smsdata 	= $this->Communication_Model->getList('row', ['id' => $notificationid[$warninglevel-1], 'smsstatus' => '1']);
			
						if($smsdata){
							$sms = str_replace(['{performance warning status}.'], [$warningtext], $smsdata['sms_body']);
							$this->sms(['no' => $plumber['mobile_phone'], 'msg' => $sms]);
						}
					}
					
					if($warninglevel=='4'){
						$this->db->update('users', ['status' => '2'], ['id' => $plumberid]);
						$this->db->update('users_detail', ['status' => '2'], ['user_id' => $plumberid]);
					}
				}
			}else{
				$this->db->update('users', ['performancestatus' => '0'], ['id' => $plumberid]);
			}							
		}
	}
	
	public function diaryactivity($requestdata=[])
	{
		$data['results'] 	= $this->Diary_Model->getList('all', $requestdata);
		return $this->load->view('common/diary', $data, true);
	}
	
	public function sms($data)
	{
		$no = str_replace([' ', '(', ')', '-'], ['', '', '', ''], trim($data['no']));
		if($no[0]=='0') $no = substr($no, 1);
			
		$param = [
			'Type' 		=> 'sendparam',
			'username' 	=> 'PIRB Registration',
			'password' 	=> 'Plumber',
			'numto' 	=> '+'.$no,
			'data1' 	=> $data['msg']
		];
		
		$url = 'http://www.mymobileapi.com/api5/http5.aspx';
		
		$this->curlRequest($url, 'GET', $param);
	}
	
	public function curlRequest($url, $method, $param=[])
	{
		$curlaction['url'] = $url;
		
		$curl = curl_init(); 

        if (!$curl) {
            die("Couldn't initialize a cURL handle"); 
        }
		
		
		if($method=='GET' && count($param) > 0){
			$curlaction['request'] = json_encode($param);
			$url = $url.'?'.http_build_query($param);
		}
		
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json')); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
		
		if($method=='POST' && count($param) > 0){			
			$param = json_encode($param);
			$curlaction['request'] = $param;
			curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
		}
		
        $result = curl_exec($curl); 

        if (curl_errno($curl)){
			//return false;
            //echo 'cURL error: ' . curl_error($curl); 
			$curlaction['error'] = curl_error($curl); 
        }else{ 
           // print_r(curl_getinfo($curl)); 
		   $curlaction['info'] = json_encode(curl_getinfo($curl)); 
        }
		
        curl_close($curl);
		
		$curlaction['response'] = $result; 
		$this->curlAction($curlaction);
		return $result;
	}
	
	public function curlAction($data)
	{
		$this->db->trans_begin();
		
		$datetime		= 	date('Y-m-d H:i:s');
		
		if(isset($data['url']))		 		$request['url'] 			= $data['url'];
		if(isset($data['request']))		 	$request['request'] 		= $data['request'];
		if(isset($data['response']))		$request['response'] 		= $data['response'];
		if(isset($data['error']))			$request['error'] 			= $data['error'];
		if(isset($data['info']))			$request['info'] 			= $data['info'];
		
		$request['datetime'] 	= $datetime;
		$this->db->insert('curl_log', $request);
				
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}

	public function cronLog($extras=[]){
		$requestdata0['filename'] 		= $extras['filename'];
		$requestdata0['start_time'] 	= $extras['start_time'];
		$requestdata0['end_time'] 		= $extras['end_time'];
		$result = $this->db->insert('cron_log',$requestdata0);
	}
	
	
	public function downloadfile($file){
		if (file_exists($file)){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}
	}
	
	function base64conversion($path){
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		return 'data:image/' . $type . ';base64,' . base64_encode($data);
	}
	
	function currencyconvertor($currency){
		$amount 	= number_format(floor($currency*100)/100, 2,".","");
		$lastchr	= $amount[strlen($amount)-1];
		
		if($lastchr < 5){
			$amount[strlen($amount)-1] = '0';
		}else{
			$amount[strlen($amount)-1] = '5';
		}
		
		return $amount;
	}
}
