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
		$this->load->model('Mycpd_Model');
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
	// Log CoC View:
	public function logcoc_view(){

		if ($this->input->post() && $this->input->post('user_id') && $this->input->post('id')) {
			$jsonData = [];

			$plumberID						= $this->input->post('user_id');
			$id								= $this->input->post('id'); // id = cocid

			if ($this->input->post('auditorid') != '') {
				$auditorid						= ['auditorid' => $extras['auditorid']];
			}else{
				$auditorid						= [];
			}
			
			$result							= $this->Coc_Model->getCOCList('row', ['id' => $id, 'user_id' => $plumberID]+$auditorid);

			$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
			$specialisations 				= explode(',', $userdata['specialisations']);


			$jsonData['userdata'] 			= $userdata;
			$jsonData['cocid'] 				= $id;
			$jsonData['result'] 			= $result;
			$jsonData['notification'] 		= $this->getNotification();
			$jsonData['province'] 			= $this->getProvinceList();
			$jsonData['designation2'] 		= $this->config->item('designation2');
			$jsonData['ncnotice'] 			= $this->config->item('ncnotice');
			$jsonData['installationtype']	= $this->getInstallationTypeList();
			$jsonData['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
			$jsonData['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);
			$jsonData['result']				= $result;
		
			$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $plumberID]);		
			$jsonData['noncompliance']		= [];
			foreach($noncompliance as $compliance){
				$jsonData['noncompliance'][] = [
					'id' 		=> $compliance['id'],
					'details' 	=> $this->parsestring($compliance['details']),
					'file' 		=> $compliance['file']
				];
			}

			$jsonArray = array("status"=>'1', "message"=>'Plumber CoC Detail', "result"=>$jsonData);
			
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

	// Log coc save:
	public function logcoc_save(){

			if ($this->input->post() && $this->input->post('submit') == 'save') {
			

			$this->form_validation->set_rules('completion_date','Completeion date','trim|required');
			$this->form_validation->set_rules('name','Owners name','trim|required');
			$this->form_validation->set_rules('street','Street','trim|required');
			$this->form_validation->set_rules('number','Number','trim|required');
			$this->form_validation->set_rules('contact_no','Contact mobile','trim|required');
			$this->form_validation->set_rules('agreement','Agreement','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = validation_errors();
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');
				$cocId 				= $this->input->post('coc_id');
				$datetime			= date('Y-m-d H:i:s');

				$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
				$specialisations 				= explode(',', $userdata['specialisations']);
				$post['company_details'] 		= 	$userdata['company_details'];

				// Save

				if ($this->input->post('id') != '') { // id = log coc autoincrement id
					$id 			= 	$this->input->post('id');
				}else{
					$id 			= 	'';
				}
				

				if(isset($post['coc_id'])) 				$request['coc_id'] 					= $cocId;
				if(isset($post['completion_date'])) 	$request['completion_date'] 		= date('Y-m-d', strtotime($post['completion_date']));
				if(isset($post['order_no'])) 			$request['order_no'] 				= $post['order_no'];
				if(isset($post['name'])) 				$request['name'] 					= $post['name'];
				if(isset($post['address'])) 			$request['address'] 				= $post['address'];
				if(isset($post['street'])) 				$request['street'] 					= $post['street'];
				if(isset($post['number'])) 				$request['number'] 					= $post['number'];
				if(isset($post['province'])) 			$request['province'] 				= $post['province'];
				if(isset($post['city'])) 				$request['city'] 					= $post['city'];
				if(isset($post['suburb'])) 				$request['suburb'] 					= $post['suburb'];
				if(isset($post['contact_no'])) 			$request['contact_no'] 				= $post['contact_no'];
				if(isset($post['alternate_no'])) 		$request['alternate_no'] 			= $post['alternate_no'];
				if(isset($post['email'])) 				$request['email'] 					= $post['email'];
				if(isset($post['installationtype'])) 	$request['installationtype'] 		= implode(',', $post['installationtype']);
				if(isset($post['specialisations'])) 	$request['specialisations'] 		= implode(',', $post['specialisations']);
				if(isset($post['installation_detail'])) $request['installation_detail'] 	= $post['installation_detail'];
				if(isset($post['file1'])) 				$request['file1'] 					= $post['file1'];
				if(isset($post['agreement'])) 			$request['agreement'] 				= $post['agreement'];
				if(isset($post['file1'])) 				$request['file1'] 					= $post['file1'];	
				if(isset($post['company_details'])) 	$request['company_details'] 		= $post['company_details'];
				if(isset($post['ncnotice'])) 			$request['ncnotice'] 				= $post['ncnotice'];
				if(isset($post['ncemail'])) 			$request['ncemail'] 				= $post['ncemail'];
				if(isset($post['ncreason'])) 			$request['ncreason'] 				= $post['ncreason'];
				
				
				$request['file2'] 					= (isset($data['file2'])) ? implode(',', $data['file2']) : '';

				if($id==''){
					$request['created_at'] = $datetime;
					$request['created_by'] = $plumberID;
					$this->db->insert('coc_log', $request);
				}else{
					$request		=	[
						'updated_at' 		=> $datetime,
						'updated_by' 		=> $plumberID
					];
					$this->db->update('coc_log', $request, ['id' => $id]);
				}
				
				$cocstatus = '5';
				if(isset($cocstatus)) $this->db->update('stock_management', ['coc_status' => $cocstatus], ['id' => $cocId]);
				
				$result							= $this->Coc_Model->getCOCList('row', ['id' => $id, 'user_id' => $plumberID]);

				$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
				$specialisations 				= explode(',', $userdata['specialisations']);


				$jsonData['userdata'] 			= $userdata;
				$jsonData['cocid'] 				= $cocId;
				$jsonData['log_coc_id'] 		= $id;
				$jsonData['result'] 			= $result;
				$jsonData['notification'] 		= $this->getNotification();
				$jsonData['province'] 			= $this->getProvinceList();
				$jsonData['designation2'] 		= $this->config->item('designation2');
				$jsonData['ncnotice'] 			= $this->config->item('ncnotice');
				$jsonData['installationtype']	= $this->getInstallationTypeList();
				$jsonData['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
				$jsonData['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);
			
				$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $plumberID]);		
				$jsonData['noncompliance']		= [];
				foreach($noncompliance as $compliance){
					$jsonData['noncompliance'][] = [
						'id' 		=> $compliance['id'],
						'details' 	=> $this->parsestring($compliance['details']),
						'file' 		=> $compliance['file']
					];
				}

				$jsonArray = array("status"=>'1', "message"=>'Thanks for Saving the COC.', "result"=>$jsonData);
			}
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

	// Log coc log:
	public function logcoc_log(){

		if ($this->input->post() && $this->input->post('submit') == 'log') {
			

			$this->form_validation->set_rules('completion_date','Completeion date','trim|required');
			$this->form_validation->set_rules('name','Owners name','trim|required');
			$this->form_validation->set_rules('street','Street','trim|required');
			$this->form_validation->set_rules('number','Number','trim|required');
			$this->form_validation->set_rules('contact_no','Contact mobile','trim|required');
			$this->form_validation->set_rules('agreement','Agreement','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = validation_errors();
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');
				$cocId 				= $this->input->post('coc_id');
				$datetime			= date('Y-m-d H:i:s');

				$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
				$specialisations 				= explode(',', $userdata['specialisations']);
				$post['company_details'] 		= 	$userdata['company_details'];

				// Save

				if ($this->input->post('id') != '') { // id = log coc autoincrement id
					$id 			= 	$this->input->post('id');
				}else{
					$id 			= 	'';
				}
				

				if(isset($post['coc_id'])) 				$request['coc_id'] 					= $cocId;
				if(isset($post['completion_date'])) 	$request['completion_date'] 		= date('Y-m-d', strtotime($post['completion_date']));
				if(isset($post['order_no'])) 			$request['order_no'] 				= $post['order_no'];
				if(isset($post['name'])) 				$request['name'] 					= $post['name'];
				if(isset($post['address'])) 			$request['address'] 				= $post['address'];
				if(isset($post['street'])) 				$request['street'] 					= $post['street'];
				if(isset($post['number'])) 				$request['number'] 					= $post['number'];
				if(isset($post['province'])) 			$request['province'] 				= $post['province'];
				if(isset($post['city'])) 				$request['city'] 					= $post['city'];
				if(isset($post['suburb'])) 				$request['suburb'] 					= $post['suburb'];
				if(isset($post['contact_no'])) 			$request['contact_no'] 				= $post['contact_no'];
				if(isset($post['alternate_no'])) 		$request['alternate_no'] 			= $post['alternate_no'];
				if(isset($post['email'])) 				$request['email'] 					= $post['email'];
				if(isset($post['installationtype'])) 	$request['installationtype'] 		= implode(',', $post['installationtype']);
				if(isset($post['specialisations'])) 	$request['specialisations'] 		= implode(',', $post['specialisations']);
				if(isset($post['installation_detail'])) $request['installation_detail'] 	= $post['installation_detail'];
				if(isset($post['file1'])) 				$request['file1'] 					= $post['file1'];
				if(isset($post['agreement'])) 			$request['agreement'] 				= $post['agreement'];
				if(isset($post['file1'])) 				$request['file1'] 					= $post['file1'];	
				if(isset($post['company_details'])) 	$request['company_details'] 		= $post['company_details'];
				if(isset($post['ncnotice'])) 			$request['ncnotice'] 				= $post['ncnotice'];
				if(isset($post['ncemail'])) 			$request['ncemail'] 				= $post['ncemail'];
				if(isset($post['ncreason'])) 			$request['ncreason'] 				= $post['ncreason'];
				
				
				$request['file2'] 					= (isset($data['file2'])) ? implode(',', $data['file2']) : '';

				if($id==''){
					$request['created_at'] = $datetime;
					$request['created_by'] = $plumberID;
					$this->db->insert('coc_log', $request);
				}else{
					$request		=	[
						'updated_at' 		=> $datetime,
						'updated_by' 		=> $plumberID
					];
					$this->db->update('coc_log', $request, ['id' => $id]);
				}
				
				$cocstatus = '2';
				$this->db->set('count', 'count + 1',FALSE); 
				$this->db->where('user_id', $plumberID); 
				$increase_count = $this->db->update('coc_count'); 

				if(isset($cocstatus)) $this->db->update('stock_management', ['coc_status' => $cocstatus], ['id' => $cocId]);
				
				$result							= $this->Coc_Model->getCOCList('row', ['id' => $id, 'user_id' => $plumberID]);

				$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $plumberID], ['users', 'usersdetail', 'usersplumber', 'company']);
				$specialisations 				= explode(',', $userdata['specialisations']);


				$jsonData['userdata'] 			= $userdata;
				$jsonData['cocid'] 				= $cocId;
				$jsonData['log_coc_id'] 		= $id;
				$jsonData['result'] 			= $result;
				$jsonData['notification'] 		= $this->getNotification();
				$jsonData['province'] 			= $this->getProvinceList();
				$jsonData['designation2'] 		= $this->config->item('designation2');
				$jsonData['ncnotice'] 			= $this->config->item('ncnotice');
				$jsonData['installationtype']	= $this->getInstallationTypeList();
				$jsonData['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
				$jsonData['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);
			
				$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $plumberID]);		
				$jsonData['noncompliance']		= [];
				foreach($noncompliance as $compliance){
					$jsonData['noncompliance'][] = [
						'id' 		=> $compliance['id'],
						'details' 	=> $this->parsestring($compliance['details']),
						'file' 		=> $compliance['file']
					];
				}
				
				$jsonArray = array("status"=>'1', "message"=>'Thanks for Logging the COC.', "result"=>$jsonData);
			}
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

	// Audit Statement:
	public function audit_statement(){

		if ($this->input->post() && $this->input->post('type') == 'list') {

			$userid 		= $this->input->post('user_id');
			$post 			= $this->input->post();
			$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);
			$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);

			if (count($results) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'Audit Statement', "result"=>$results);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
			}

		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

	// Audit Review;
	public function auditreview_coc(){

		if ($this->input->post() && $this->input->post('type') == 'auditreview_coc') {
			$extraparam = [];

			$cocID 						= $this->input->post('coc_id');
			if ($this->input->post('auditorid') != '') {
				$extraparam['auditorid'] = $this->input->post('auditorid');
			}else{
				$extraparam['auditorid'] = '';
			}
			
			$extraparam['user_id'] 		= $this->input->post('user_id');	
			$result						= $this->Coc_Model->getCOCList('row', ['id' => $cocID, 'coc_status' => ['2']]+$extraparam);	

			if (count($result) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'Audit Statement', "result"=>$result);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
			}
		}elseif ($this->input->post() && $this->input->post('user_id') && $this->input->post('type') == 'view_coc') {

			$userid							= $this->input->post('user_id');

			if ($this->input->post('auditorid') != '') {
				$auditorid						= ['auditorid' => $this->input->post('auditorid')];
			}else{
				$auditorid						= [];
			}
			
			$result							= $this->Coc_Model->getCOCList('row', ['id' => $id, 'user_id' => $userid]+$auditorid);

			if (count($result) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'View CoC', "result"=>$result);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
			}
		}

		else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	// Chat History:
	public function chathistory(){

		if ($this->input->post()) {

			$cocID 		= $this->input->post('coc_id');
			if ($this->input->post('auditorid') != '') {
				$auditorid	= ['auditorid' => $this->input->post('auditorid')];
			}else{
				$auditorid	= [];
			}

			
			$result		= $this->Coc_Model->getCOCList('row', ['id' => $cocID, 'coc_status' => ['2']]+$auditorid);	

			if (count($result) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'Chat History', "result"=>$result);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
			}
		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_current_year(){

		if ($this->input->post() && $this->input->post('user_id')) {

			$user_id 		= $this->input->post('user_id');
			$pagestatus 	= '1';
			$post['pagestatus'] = $pagestatus;

			$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			

			if (count($results) > 0) {
				$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$results);
			}else{
				$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
			}

			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_previous_year(){

		if ($this->input->post() && $this->input->post('user_id')) {

			$user_id 		= $this->input->post('user_id');
			$pagestatus 	= '0';
			$post['pagestatus'] = $pagestatus;

			$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			

			if (count($results) > 0) {
				$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$results);
			}else{
				$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
			}

			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_edit_view(){

		if ($this->input->post() && $this->input->post('cpdID') && $this->input->post('pagestatus')) {

			$cpdID 			= $this->input->post('cpdID');
			$pagestatus 	= $this->input->post('pagestatus');

			$result 		= $this->Mycpd_Model->getQueueList('row', ['id' => $cpdID, 'pagestatus' => $pagestatus]);

			if (count($result) > 0) {
				$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$result);
			}else{
				$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
			}

			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_insert_action(){

		if ($this->input->post() && $this->input->post('user_id')) {
			
			$pagestatus 	= $this->input->post('pagestatus');

			$this->form_validation->set_rules('activity','CPD Activity','trim|required');
			$this->form_validation->set_rules('startdate','Start date','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = implode(",", validation_errors());
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{
				$requestData1 		= [];

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');
				$datetime			= date('Y-m-d H:i:s');

				if(isset($post['hidden_regnumber'])) 	$requestData1['reg_number']    		= $post['hidden_regnumber'];
				if(isset($post['user_id']))  			$requestData1['user_id'] 	    	= $post['user_id'];
				if(isset($post['name_surname']))  		$requestData1['name_surname']  		= $post['name_surname'];
				if(isset($post['activity'])) 			$requestData1['cpd_activity']  		= $post['activity'];
				if(isset($post['startdate'])) 	 		$requestData1['cpd_start_date'] 	= date("Y-m-d H:i:s", strtotime($post['startdate']));
				if(isset($post['comments'])) 	 		$requestData1['comments'] 			= $post['comments'];
				if(isset($post['image1'])) 		 		$requestData1['file1'] 				= $post['image1'];
				if(isset($post['points'])) 		 		$requestData1['points'] 			= $post['points'];
				if(isset($post['hidden_stream_id'])) 	$requestData1['cpd_stream'] 		= $post['hidden_stream_id'];
				$requestData1['status'] 														= '0';

				$requestData1['created_at'] = 	$datetime;
				$requestData1['created_by']	= 	$plumberID;

				$result = $this->db->insert('cpd_activity_form', $requestData1);

				$jsonArray = array("status"=>'1', "message"=>'My CPD Inserted Successfully', "result"=>$result);
			}
			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_edit_action(){

		if ($this->input->post() && $this->input->post('pagestatus') && $this->input->post('user_id') && $this->input->post('cpd_id')) {
			
			$pagestatus 	= $this->input->post('pagestatus');

			$this->form_validation->set_rules('activity','CPD Activity','trim|required');
			$this->form_validation->set_rules('startdate','Start date','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = implode(",", validation_errors());
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{
				$requestData1 		= [];

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');
				$cpd_id 			= $this->input->post('cpd_id');
				$datetime			= date('Y-m-d H:i:s');

				if(isset($post['hidden_regnumber'])) 	$requestData1['reg_number']    		= $post['hidden_regnumber'];
				if(isset($post['user_id']))  			$requestData1['user_id'] 	    	= $post['user_id'];
				if(isset($post['name_surname']))  		$requestData1['name_surname']  		= $post['name_surname'];
				if(isset($post['activity'])) 			$requestData1['cpd_activity']  		= $post['activity'];
				if(isset($post['startdate'])) 	 		$requestData1['cpd_start_date'] 	= date("Y-m-d H:i:s", strtotime($post['startdate']));
				if(isset($post['comments'])) 	 		$requestData1['comments'] 			= $post['comments'];
				if(isset($post['image1'])) 		 		$requestData1['file1'] 				= $post['image1'];
				if(isset($post['points'])) 		 		$requestData1['points'] 			= $post['points'];
				if(isset($post['hidden_stream_id'])) 	$requestData1['cpd_stream'] 		= $post['hidden_stream_id'];
				$requestData1['status'] 														= '0';

				$requestData1['created_at'] = 	$datetime;
				$requestData1['created_by']	= 	$plumberID;

				$result = $this->db->update('cpd_activity_form', $requestData1, ['id' => $cpd_id]);

				$jsonArray = array("status"=>'1', "message"=>'My CPD Updated Successfully', "result"=>$result);
			}
			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

}