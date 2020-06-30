<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Coc_Ordermodel');
		$this->load->model('Auditor_Model');
		$this->load->model('Friends_Model');
		$this->load->model('Chat_Model');

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
	}
	// Plumber Registration:

	public function plumber_registration()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('name','First Name','trim|required');
			$this->form_validation->set_rules('surname','Second Name','trim|required');
			$this->form_validation->set_rules('address[2][postal_code]','postal code','trim|required');
			$this->form_validation->set_rules('mobile_phone','Mobile phone','trim|required');
			$this->form_validation->set_rules('company_name','Company name','trim|required');
			$this->form_validation->set_rules('billing_email','Billing email','trim|required');
			$this->form_validation->set_rules('address[3][postal_code]','Postal code','trim|required');
			$this->form_validation->set_rules('billing_email','Billing email','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = implode(",", validation_errors());
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');
				$userdata			= $this->Plumber_Model->getList('row', ['id' => $plumberID, 'status' => ['0','1']], ['users', 'usersdetail', 'usersplumber', 'usersskills', 'company', 'physicaladdress', 'postaladdress', 'billingaddress']);
				$jsonArray = array("status"=>'1', "message"=>'Profile Updated Successfully', "result"=>$userdata);
			}

		}else{
			
			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}
		

		echo json_encode($jsonArray);
		
	}

	// Plumber Dashboard:

	public function plumber_dashoard(){

		if ($this->input->post('user_id')) {

			$id 										= $this->input->post('user_id');
			$userdata 									= $this->getUserDetails($id);
			$jsonData['id'] 							= $id;
			$jsonData['userdata'] 						= $this->getUserDetails($id);

			$jsonData['mycpd']							= $this->userperformancestatus(['performancestatus' => '1', 'auditorstatement' => '1']);
			$jsonData['nonlogcoc']						= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['4','5']]);
			$jsonData['adminstock'] 					= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $id]);
			$jsonData['adminstock']						= array_sum(array_column($jsonData['adminstock'], 'quantity'));
			$jsonData['coccount']						= $this->Coc_Model->COCcount(['user_id' => $id]);
			$jsonData['coccount']						= $jsonData['coccount']['count'];
			$jsonData['history']						= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);
			$jsonData['auditcoc'] 						= $jsonData['history']['total'];
			$jsonData['auditrefixincomplete'] 			= $jsonData['history']['refixincomplete'];
			$jsonData['auditorratio']					= $this->Auditor_Model->getAuditorRatio('row', ['userid' => $id]);
			$jsonData['auditorratio']					= ($jsonData['auditorratio']) ? $jsonData['auditorratio']['audit'].'%' : '0%';
			$jsonData['myprovinceperformancestatus'] 	= $this->userperformancestatus(['province' => $userdata['province']], $id);
			$jsonData['performancestatus'] 				= $this->userperformancestatus();
			$jsonData['mycityperformancestatus'] 		= $this->userperformancestatus(['city' => $userdata['city']], $id);
			$jsonData['provinceperformancestatus'] 		= $this->userperformancestatus(['province' => $userdata['province'], 'limit' => '3']);
			$jsonData['cityperformancestatus'] 			= $this->userperformancestatus(['city' => $userdata['city'], 'limit' => '3'],$id);
			$friends 									= $this->Friends_Model->getList('all', ['userid' => $id, 'fromto' => $id, 'status' => ['1'], 'limit' => '10']);
			$friendsarray								= [];
			if(count($friends) > 0){
			foreach($friends as $friend){
				$friendperformance = $this->userperformancestatus(['userid' => $friend['userid']]);
				$friendsarray[] =  $friend+['rank' => $friendperformance];
			}
			
			array_multisort(array_column($friendsarray, 'rank'), SORT_ASC, $friendsarray);
		}

			$jsonData['friends'] 						= $friendsarray;

			$jsonData['chat_count'] 					= $this->Chat_Model->getList('count',['to_id' => $id, 'msg_status' => '0']);
			$jsonData['chat_messages'] 					= $this->Chat_Model->getList('all',['to_id' => $id, 'msg_status' => '0']);

			$jsonArray = array("status"=>'1', "message"=>'User details', "result"=>$jsonData);

		
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}

		echo json_encode($jsonArray);
	}

	// Plumber CoC:
	public function plumber_COC(){

		if ($this->input->post('user_id')) {
			
			$userid 					=	$this->input->post('user_id');
			$userdata					= 	$this->getUserDetails($userid);
			$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
			$userdatacoc_count			= 	$this->Coc_Model->COCcount(['user_id' => $userid]);
			$jsonData['province'] 		= 	$this->getProvinceList();
			$jsonData['userid']			= 	$userid;
			$jsonData['userdata']		= 	$userdata;
			$jsonData['userdata1']		= 	$userdata1;
			$jsonData['coc_count']		= 	$userdatacoc_count;

			$jsonData['deliverycard']	= 	$this->config->item('purchasecocdelivery');
			$jsonData['coctype']		= 	$this->config->item('coctype');
			$jsonData['settings']		= 	$this->Systemsettings_Model->getList('row');
			$jsonData['logcoc']			=	$this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['4','5']]);
			$jsonData['cocpaperwork']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
			$jsonData['cocelectronic']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
			$jsonData['postage']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
			$jsonData['couriour']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
			$jsonData['collectedbypirb']= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb')]);
			$orderquantity 				= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $userid]);
			$jsonData['userorderstock']	= array_sum(array_column($orderquantity, 'quantity'));

			$jsonArray = array("status"=>'1', "message"=>'Plumber coc details', "result"=>$jsonData);

		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}

		echo json_encode($jsonArray);
	}

	// CoC Statement:
	public function coc_statement(){

		if ($this->input->post('user_id')) {

			$userid 				= $this->input->post('user_id');
			
			$jsonData['userid'] 	= $userid;
			$jsonData['totalcount'] = $this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['2','4','5','7']]);
			$jsonData['results'] 	= $this->Coc_Model->getCOCList('all', ['user_id' => $userid, 'coc_status' => ['2','4','5','7']]);

			$jsonArray = array("status"=>'1', "message"=>'COC statement details', "result"=>$jsonData);
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}

		echo json_encode($jsonArray);
	}

	// Log CoC:
	public function logcoc(){

		if ($this->input->post()) {

			$this->form_validation->set_rules('completion_date','Completeion date','trim|required');
			$this->form_validation->set_rules('name','Owners name','trim|required');
			$this->form_validation->set_rules('street','Street','trim|required');
			$this->form_validation->set_rules('number','Number','trim|required');
			$this->form_validation->set_rules('contact_no','Contact mobile','trim|required');
			$this->form_validation->set_rules('agreement','Agreement','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = implode(",", validation_errors());
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');
				$cocId 				= $this->input->post('coc_id');

				$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
				$specialisations 				= explode(',', $userdata['specialisations']);
				$post['company_details'] 		= 	$userdata['company_details'];
				$data 	=  $this->Coc_Model->actionCocLog($post);

				
				$auditorid						= isset($this->input->post('auditorid')) ? ['auditorid' => $this->input->post('auditorid')] : [];
				$jsonData['coc_result']							= $this->Coc_Model->getCOCList('row', ['id' => $cocId, 'user_id' => $plumberID]+$auditorid);
		
		
				$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
				$specialisations 				= explode(',', $userdata['specialisations']);


				$jsonData['userdata'] 			= $userdata;
				$jsonData['cocid'] 				= $cocId;
				
				$jsonData['province'] 			= $this->getProvinceList();
				$jsonData['designation2'] 		= $this->config->item('designation2');
				$jsonData['ncnotice'] 			= $this->config->item('ncnotice');
				$jsonData['installationtype']	= $this->getInstallationTypeList();
				$jsonData['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
				$jsonData['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);
				$jsonData['result']				= $result;
				
				$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);		
				$jsonData['noncompliance']		= [];
				foreach($noncompliance as $compliance){
					$jsonData['noncompliance'][] = [
						'id' 		=> $compliance['id'],
						'details' 	=> $this->parsestring($compliance['details']),
						'file' 		=> $compliance['file']
					];
				}

				if($post['submit']=='save'){
					$message = 'Thanks for Saving the COC.';
				}elseif($post['submit']=='log'){
					$message = 'Thanks for Logging the COC.';
				}

				$jsonArray = array("status"=>'1', "message"=>$message, "result"=>$jsonData);
			}
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

}