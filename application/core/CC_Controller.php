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
					else redirect('company/registration/company'); 
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
		$data = $this->Company_Model->getList('all', ['status' => ['1']]);
		
		if(count($data) > 0) return ['' => 'Select Company']+array_column($data, 'company_name', 'id');
		else return [];
	}
	
	public function getRates($id)
	{
		$data = $this->Rates_Model->getList('row', ['id' => $id, 'status' => ['1']]);
		
		if($data) return $data['amount'];
		else return '';
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
	
	public function plumbercard($userid)
	{
		$data['company'] 			= $this->getCompanyList();
		$data['designation2'] 		= $this->config->item('designation2');
		$data['specialisations'] 	= $this->config->item('specialisations');
		
		$data['result'] = $this->Plumber_Model->getList('row', ['id' => $userid]);
		return $this->load->view('common/card', $data, true) ;
	}
	
	public function plumberprofile($id, $pagedata=[], $extras=[])
	{
		$result = $this->Plumber_Model->getList('row', ['id' => $id, 'type' => '3', 'status' => ['1']]);
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
					if(isset($requestData['approvalstatus'])){
						if($requestData['approvalstatus']=='1'){
							$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '5', 'emailstatus' => '1']);
				
							if($notificationdata){
								$body 	= str_replace(['{Plumbers Name and Surname}', '{email}'], [$result['name'].' '.$result['surname'], $result['email']], $notificationdata['email_body']);
								$this->CC_Model->sentMail($plumberdata['email'], $notificationdata['subject'], $body);
							}
						}elseif($requestData['approvalstatus']=='1'){
							$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '6', 'emailstatus' => '1']);
				
							if($notificationdata){
								$body 	= str_replace(['{Plumbers Name and Surname}'], [$result['name'].' '.$result['surname']], $notificationdata['email_body']);
								$this->CC_Model->sentMail($plumberdata['email'], $notificationdata['subject'], $body);
							}
						}
					}
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
		
		$data['plugins']				= ['validation','datepicker','inputmask','select2'];
		$data['content'] 				= $this->load->view('common/plumber', (isset($pagedata) ? $pagedata : ''), true);
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
		
			if(isset($requestData['coc_purchase_limit'])) $this->Coc_Model->actionCocCount(['count' => $requestData['coc_purchase_limit'], 'user_id' => $id]);
			
			if($data) $this->session->set_flashdata('success', 'Resellers '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			if($extras['redirect']) redirect($extras['redirect']); 
			else redirect('admin/resellers/index');
		}
		
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

}
