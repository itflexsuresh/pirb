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
		$this->load->model('Communication_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Noncompliance_Model');
		$this->load->model('Auditor_Reportlisting_Model');
		$this->load->model('Global_performance_Model');
		$this->load->model('Auditor_Comment_Model');
		$this->load->model('Diary_Model');
		
		$this->load->library('pdf');
		$this->load->library('phpqrcode/qrlib');
	}
	
	public function layout1($data=[])
	{
		$this->middleware('1');
		$this->load->view('template/layout1', $data);
	}
	
	public function layout2($data=[])
	{
		$this->middleware();
		$data['userdata'] 		= $this->getUserDetails();
		$data['sidebar'] 		= $this->load->view('template/sidebar', $data, true);
		$this->load->view('template/layout2', $data);
	}
	
	public function middleware($type='')
	{
		$userDetails = $this->getUserDetails();
		if($type=='1'){
			if($userDetails){
				if($userDetails['type']=='1'){
					redirect('admin/administration/installationtype'); 
				}elseif($userDetails['type']=='3'){
					if($userDetails['formstatus']=='1') redirect('plumber/profile/index'); 
					else redirect('plumber/registration/index'); 
				}elseif($userDetails['type']=='4'){
					if($userDetails['formstatus']=='1') redirect('company/profile/index'); 
					else redirect('company/registration/index'); 
				}elseif($userDetails['type']=='5'){
					redirect('auditor/profile/index'); 
				}elseif($userDetails['type']=='6'){
					redirect('resellers/profile/index'); 
				}
			}
		}else{
			if(!$userDetails){
				redirect('');
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
		$data = $this->Company_Model->getList('all', ['type' => '4', 'status' => ['1'], 'companystatus' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Company']+array_column($data, 'company', 'id');
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
		
		$data['result'] = $this->Plumber_Model->getList('row', ['id' => $userid]);
		return $this->load->view('common/card', $data, true) ;
	}
	
	public function plumberprofile($id, $pagedata=[], $extras=[])
	{
		$result = $this->Plumber_Model->getList('row', ['id' => $id, 'type' => '3', 'status' => ['1', '2']]);
		if(!$result){
			if($extras['redirect']) redirect($extras['redirect']); 
			else redirect('admin/plumber/index'); 
		}
		
		if($this->input->post()){
			$requestData 			= 	$this->input->post();
			$requestData['user_id'] = 	$id;
			
			$plumberdata 	=  $this->Plumber_Model->action($requestData);
				
			if(isset($requestData['submit']) && $requestData['submit']=='approvalsubmit'){
				$commentdata 	=  $this->Comment_Model->action($requestData);				
			}
			
			if(isset($requestData['coc_purchase_limit'])) $this->Coc_Model->actionCocCount(['count' => $requestData['coc_purchase_limit'], 'user_id' => $id]);
			
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
						}elseif($requestData['approval_status']=='2'){
							$this->CC_Model->diaryactivity(['plumberid' => $id, 'action' => '3']+$diaryparam);
							
							$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '6', 'emailstatus' => '1']);
				
							if($notificationdata){
								$body 	= str_replace(['{Plumbers Name and Surname}'], [$result['name'].' '.$result['surname']], $notificationdata['email_body']);
								$this->CC_Model->sentMail($result['email'], $notificationdata['subject'], $body);
							}
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
			
			if($extras['redirect']) redirect($extras['redirect']); 
			else redirect('admin/plumber/index'); 
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
		$result = $this->Company_Model->getList('row', ['id' => $id, 'type' => '4', 'status' => ['0','1', '2']]);
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
			$result = $this->Company_Model->getEmpList('employee', ['comp_id' => $id['id'], 'type' => '3', 'status' => ['0','1', '2']]);

			$pagedata['employee'] = $result;
			$pagedata['specialization']	= $this->config->item('specialization');

			$pagedata['company'] 		= $this->getCompanyList();
			$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
			$userdata1					= $this->Plumber_Model->getList('row', ['id' => $result[0]['user_id']]);

			$pagedata['user_details'] 	= $userdata1;

			
			
			$pagedata['history']		= $this->Auditor_Model->getReviewHistory2Count(['auditorid' => '', 'plumberid' => $result[0]['user_id']]);
			$pagedata['settings_cpd']	= $this->Systemsettings_Model->getList('all',['user_id' => $result[0]['user_id']]);
			

			$pagedata['loggedcoc']		= $this->Coc_Model->getCOCList('count', ['user_id' => $result[0]['user_id'], 'coc_status' => ['2']]);
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
		$data['plugins']				= ['datatables','validation','datepicker','inputmask','select2', 'morrischart'];
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['designation2']		= $this->config->item('designation2');
		$pagedata['plumberstatus']		= $this->config->item('plumberstatus');
		$pagedata['id'] 				= $companyID;
		$data['content'] 				= $this->load->view('common/company/employee_listing', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function resellersprofile($id, $pagedata=[], $extras=[])
	{
		if($id!=''){
			$result = $this->Resellers_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;

			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				if($extras['redirect']) redirect($extras['redirect']); 
				else redirect('admin/resellers/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			$data 	=  $this->Resellers_Model->action($requestData);
		
			// if(isset($requestData['coc_purchase_limit'])) $this->Coc_Model->actionCocCount(['count' => $requestData['coc_purchase_limit'], 'user_id' => $id]);
			
			if($data) $this->session->set_flashdata('success', 'Resellers '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			if($extras['redirect']) redirect($extras['redirect']); 
			else redirect('admin/resellers/index');
		}
		
		
		$pagedata['stock_count'] = $this->Resellers_Model->getStockCount();
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
		
		$data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','inputmask'];
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
		
		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid]);
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
				}
				
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '18', 'emailstatus' => '1']);
			
				if($notificationdata){
					$body 	= str_replace(['{Plumbers Name and Surname}', '{number}'], [$userdata['name'].' '.$userdata['surname'], $id], $notificationdata['email_body']);
					$this->CC_Model->sentMail($userdata['email'], $notificationdata['subject'], $body);
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
		$pagedata['installationtype']	= $this->getInstallationTypeList();
		$pagedata['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => []]);
		$pagedata['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations]);
		$pagedata['result']				= $result;
		
		$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);		
		$pagedata['noncompliance']		= [];
		foreach($noncompliance as $compliance){
			$pagedata['noncompliance'][] = [
				'id' 		=> $compliance['id'],
				'details' 	=> $this->parsestring($compliance['details'])
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
				if(isset($requestData['auditcomplete']) && $requestData['auditcomplete']=='1' && $requestData['submit']=='submitreport'){
					if($requestData['auditstatus']=='1'){	
						//Invoice and Order
						$inspectionrate = $this->getRates($this->config->item('inspection'));
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
						
						// Email
						$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '21', 'emailstatus' => '1']);
						if($notificationdata){
							$body 	= str_replace(['{Plumbers Name and Surname}', '{COC number}'], [$pagedata['result']['u_name'], $pagedata['result']['id']], $notificationdata['email_body']);
							$this->CC_Model->sentMail($pagedata['result']['u_email'], $notificationdata['subject'], $body);
						}
						
						// Stock
						$this->db->update('stock_management', ['audit_status' => '1'], ['id' => $pagedata['result']['id']]);
					}elseif($requestData['auditstatus']=='0'){
						$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '22', 'emailstatus' => '1']);
	
						if($notificationdata){
							$body 	= str_replace(['{Plumbers Name and Surname}', '{COC number}', '{refix number} '], [$pagedata['result']['u_name'], $pagedata['result']['id'], $pagedata['settings']['refix_period']], $notificationdata['email_body']);
							$this->CC_Model->sentMail($pagedata['result']['u_email'], $notificationdata['subject'], $body);
						}
						
						$this->db->update('stock_management', ['audit_status' => '4'], ['id' => $pagedata['result']['id']]);
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
		$pagedata['history']		= $this->Auditor_Model->getReviewHistoryCount(['auditorid' => $pagedata['result']['auditorid'], 'plumberid' => $pagedata['result']['user_id']]);	
		$pagedata['menu']			= $this->load->view('common/auditstatement/menu', (isset($pagedata) ? $pagedata : ''), true);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'datepicker', 'morrischart'];
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
		$pagedata['diary']			= $this->diaryactivity(['coc_id' => $id]);	
		$pagedata['menu']			= $this->load->view('common/auditstatement/menu', (isset($pagedata) ? $pagedata : ''), true);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'datepicker', 'sweetalert', 'validation', 'select2'];
		$data['content'] 			= $this->load->view('common/auditstatement/diary', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function pdfauditreport($id)
	{
		$pagedata['result']			= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]);
		$pagedata['reviewlist']		= $this->Auditor_Model->getReviewList('all', ['coc_id' => $id]);
		$html = $this->load->view('pdf/auditreport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		$this->pdf->stream('Audit Report '.$id);
	}

	public function pdfelectroniccocreport($id, $userid)
	{		
		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid]);
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
	
	public function pdfnoncompliancereport($id, $userid)
	{		
		$pagedata['result']			= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]);
		$pagedata['noncompliance'] 	= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);	

		$html = $this->load->view('pdf/noncompliancereport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A2', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		$this->pdf->stream('Non Compliance Report '.$id);
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
		
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $userid]);
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['cpdstreamID'] 	= $this->config->item('cpdstream');
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);
		$pagedata['id'] 			= $userid;
		$pagedata['user_details'] 	= $userdata1;
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('plumber/mycpd/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function performancestatusrollingaverage(){	
		$data = $this->Global_performance_Model->getPointList('row', ['id' => $this->config->item('rollingaverage')]);
		if($data && isset($data['point']) && $data['point']!=''){
			$this->db->trans_begin();	
			$date = date('Y-m-d', strtotime(date('Y-m-d').'-'.$data['point'].' months'));
			$this->db->update('auditor_statement', ['archive' => '1'], ['auditcompletedate <=' => $date,'archive' => '0']);
			$this->db->update('cpd_activity_form', ['archive' => '1'], ['approved_date <=' => $date,'archive' => '0']);	
			
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
		
		$datas = $this->Plumber_Model->performancestatus('all', ['plumbergroup' => '1', 'archive' => '0', 'date' => $date]);
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
						$plumber 	= $this->Plumber_Model->getList('row', ['id' => $plumberid]);
						$body 		= str_replace(['{Plumbers Name and Surname}', '{Performance warning status}'], [$plumber['name'].' '.$plumber['surname'], $warningtext], $notificationdata['email_body']);
						$this->CC_Model->sentMail($plumber['email'], $notificationdata['subject'], $body);
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
}
