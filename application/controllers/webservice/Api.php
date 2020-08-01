<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Max-Age: 1728000");
		header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
		header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

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
		$this->load->model('Subtype_Model');
		$this->load->model('Reportlisting_Model');
	}

	public function login(){
		if ($this->input->post()) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg =  validation_errors();

				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{
				$jsonData = [];
				$email 		= trim($this->input->post('email'));
				$password 	= md5($this->input->post('password'));
				$type 		= $this->input->post('roletype');

				$query = $this->db->where_in('type', $type)->get_where('users', ['email' => $email, 'password' => $password]);
			
				if($query->num_rows() > 0){
					$result = $query->row_array();

					$jsonData['userdetails'] = [ 'userid' => $result['id'], 'roletype' => $result['type'], 'role' => $this->config->item('usertype2')[$result['type']]
					 ];
					
					$jsonArray = array('status' => '1', "message"=>'Login sucessfully', 'result' => $jsonData);
				}else{
					$jsonArray = array('status' => '0', "message"=>'Invalid Credentials.', 'result' => []);
				}
			}

		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}
		echo json_encode($jsonArray);
	}

	public function email_validation($email)
    {
        if(stristr($str,'@uni-email-1.com') !== false) return true;
        if(stristr($str,'@uni-email-2.com') !== false) return true;
        if(stristr($str,'@uni-email-3.com') !== false) return true;

        $this->form_validation->set_message('email', 'Invalid Credentials.');
        return FALSE;
    }

	// Plumber Registration:

	public function plumber_registration()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('name','First Name','trim|required');
			$this->form_validation->set_rules('surname','Second Name','trim|required');
			$this->form_validation->set_rules('citizen','Citizen Residential','trim|required');
			$this->form_validation->set_rules('address[2][postal_code]','postal code','trim|required');
			// Physical address
			$this->form_validation->set_rules('address[1][address]','Physical Address ','trim|required');
			$this->form_validation->set_rules('address[1][province]','Physical Province ','trim|required');
			$this->form_validation->set_rules('address[1][city]','Physical City ','trim|required');
			$this->form_validation->set_rules('address[1][suburb]','Physical Suburb ','trim|required');

			$this->form_validation->set_rules('mobile_phone','Mobile phone','trim|required');
			// $this->form_validation->set_rules('company_name','Company name','trim|required');
			// $this->form_validation->set_rules('billing_email','Billing email','trim|required');
			
			// Postal address
			$this->form_validation->set_rules('address[2][address]','Postal Address','trim|required');
			$this->form_validation->set_rules('address[2][province]','Postal Province ','trim|required');
			$this->form_validation->set_rules('address[2][city]','Postal City ','trim|required');
			$this->form_validation->set_rules('address[2][suburb]','Postal Suburb ','trim|required');

			// Billing details
			$this->form_validation->set_rules('company_name','Billing name','trim|required');
			$this->form_validation->set_rules('billing_email','Billing email','trim|required');
			$this->form_validation->set_rules('billing_contact','Billing Contact','trim|required');
			// Billing address
			$this->form_validation->set_rules('address[3][address]','Billing Address','trim|required');
			$this->form_validation->set_rules('address[3][province]','Billing Province','trim|required');
			$this->form_validation->set_rules('address[3][city]','Billing City','trim|required');
			$this->form_validation->set_rules('address[3][suburb]','Billing Suburb','trim|required');

			$this->form_validation->set_rules('address[3][postal_code]','Postal code','trim|required');	
			// $this->form_validation->set_rules('image1','Identity Document','trim|required');
			// $this->form_validation->set_rules('image2','Photo ID','trim|required');

			// Declaration:
			$this->form_validation->set_rules('registerprocedure','The Registered Procedure','trim|required');
			$this->form_validation->set_rules('acknowledgement','Acknowledgement','trim|required');
			$this->form_validation->set_rules('codeofconduct','PIRBs Code of Conduct','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg =  validation_errors();
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{
				$jsonData = [];

				$jsonData['page_lables'] = [ 'headertabs' => 'Welcome', 'Personal Details', 'Billing Details', 'Employement Details', 'Designation', 'Declaration', 'buttons' => 'Previous', 'Next', 'welcome' => 'Registered Plumber Details
', 'Donec augue enim, volutpat at ligula et, dictum laoreet sapien. Sed maximus feugiat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla eu mollis leo, eu elementum nisl. Curabitur cursus turpis nibh, egestas efficitur diam tristique non. Proin faucibus erat ligula, nec interdum odio rhoncus vel. Nulla facilisi. Nulla vehicula felis lorem, sed molestie lacus maximus quis. Mauris dolor enim, fringilla ut porta sed, ullamcorper id quam. Integer in eleifend justo, quis cursus odio. Pellentesque fermentum sapien elit, aliquam rhoncus neque semper in. Duis id consequat nisl, vitae semper elit. Nulla tristique lorem sem, et pretium magna cursus sit amet. Maecenas malesuada fermentum mauris, at vestibulum arcu vulputate a.', 'personaldetails' => 'Registered Plumber Details', 'Title *', 'Date of Birth *', 'Name *', 'Surname *', 'Gender *', 'Racial Status *', 'South African National *', 'ID Number', 'Home Language *', 'Disability *', 'Citizen Residential Status *', 'Identity Document *', 'Photo ID *', 'Photos must be no more than 6 months old Photos must be high quality Photos must be in colour Photos must have clear preferably white background Photos must be in sharp focus and clear Photo must be only of your head and shoulders You must be looking directly at the camera No sunglasses or hats File name is your NAME and SURNAME.', '(Image/File Size Smaller than 5mb)', 'Registration Card', 'Due to the high number of card returns and cost incurred, the registration fees do not include a registration card. Registration cards are available but must be requested separately. If the registration card option is selected you will be billed accordingly.', 'Registration Card Required *', 'Method of Delivery of Card *', 'Physical Address', 'Postal Address', 'Note: All delivery services will be sent to this address.', 'Note: All postal services will be sent to this address.', 'Physical Address *', 'Postal Address *', 'Province *', 'City *', 'Suburb *', 'Add city', 'Add suburb', 'Postal Code *', 'Contact Details', 'Home Phone:', 'Mobile Phone *', 'Note: All SMS and OTP notifications will be sent to this mobile number above.', 'Work Phone:', 'Secondary Mobile Phone', 'Email Address *', 'Secondary Email Address', 'Note: This email will be used as your user profile name and all emails notifications will be sent to it.', 'billingdetails' => 'Billing Details', 'All invoices generated, will be used this billing information.', 'Billing Name *', 'Company Reg Number', 'Company VAT Number', 'Billing Email *', 'Billing Contact *', 'Billing Address *', 'Province *', 'City *', 'Suburb *', 'Add city', 'Add suburb', 'Postal Code *', 'employementdetails' => 'Employment Details', 'Company Details', 'Your Employment Status', 'Company *', 'If the Company does not appear on this list please ask the company to register with the PIRB. Once they have been approved and registered, return to the list and select the company', 'designation' => 'Designation', '', 'Applications for Master Plumber and/or specialisations can only be done once your registration has been verified and approved. Please select the relevant designation being applied for.'
			];

				$post 				= $this->input->post();
				$plumberID 			= $this->input->post('user_id');

				$userdata			= $this->Plumber_Model->getList('row', ['id' => $plumberID, 'status' => ['0','1']], ['users', 'usersdetail', 'usersplumber', 'usersskills', 'company', 'physicaladdress', 'postaladdress', 'billingaddress']);

		//print_r($userdata);die;
				$post['user_id']	 	= 	$plumberID;
				$post['formstatus'] 	= 	'1';
				$post['status'] 		= 	'1';
				$post['usersdetailid'] 	= 	$userdata['usersdetailid'];
				$post['usersplumberid'] = 	$userdata['usersplumberid'];

				if ((isset($post['address'][1]['id']) && $post['address'][1]['id'] !='') && (isset($post['address'][1]['type']) && $post['address'][1]['type'] !='')) {
					$post['address'][1]['id'] 	= $post['address'][1]['id'];
					$post['address'][1]['type'] = $post['address'][2]['type'];
				}else{
					$post['address'][1]['id'] 	= '';
					$post['address'][1]['type'] = '';
				}

				if ((isset($post['address'][2]['id']) && $post['address'][2]['id'] !='') && (isset($post['address'][2]['type']) && $post['address'][2]['type'] !='')) {
					$post['address'][2]['id'] 	= $post['address'][2]['id'];
					$post['address'][2]['type'] = $post['address'][2]['type'];
				}else{
					$post['address'][2]['id'] 	= '';
					$post['address'][2]['type'] = '';
				}

				if ((isset($post['address'][3]['id']) && $post['address'][3]['id'] !='') && (isset($post['address'][3]['type']) && $post['address'][3]['type'] !='')) {
					
					$post['address'][3]['id'] 	= $post['address'][3]['id'];
					$post['address'][3]['type'] = $post['address'][3]['type'];
				}else{
					$post['address'][3]['id'] 	= '';
					$post['address'][3]['type'] = '';
				}

				if (isset($post['skill_id'])) {
					$post['skill_id'] = $post['skill_id'];
				}else{
					$post['skill_id'] = '';
				}

				

				$data 				=  	$this->Plumber_Model->action($post);

				if ($data) {
					

					$jsonData['userdata'] = $userdata;
					$jsonArray = array("status"=>'1', "message"=>'Profile Updated Successfully', "result"=>$jsonData);
				}else{
					$jsonArray = array("status"=>'0', "message"=>'Something went wrong Please try again!!!', 'result' => []);
				}
				
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
			$userdetails 								= $this->Plumber_Model->getList('row', ['id' => $id], ['users', 'usersdetail', 'usersplumber', 'usersskills', 'company', 'physicaladdress', 'postaladdress', 'billingaddress']);

			$getcity = $this->Managearea_Model->getListCity('all', ['status' => ['1']]);
			if(count($getcity) > 0) {
				$citydata=  ['' => 'Select City']+array_column($getcity, 'name', 'id');
			}else{
				$citydata = [];
			}
			$getsuburb = $this->Managearea_Model->getListSuburb('all', ['status' => ['1']]);
			if(count($getsuburb) > 0) {
				$suburbdata=  ['' => 'Select City']+array_column($getsuburb, 'name', 'id');
			}
			else {
				$suburbdata = [];
			}

			// Physical address
			$physicaladdress 		= isset($userdetails['physicaladdress']) ? explode('@-@', $userdetails['physicaladdress']) : [];
			$addressid1 			= isset($physicaladdress[0]) ? $physicaladdress[0] : '';
			$address1				= isset($physicaladdress[2]) ? $physicaladdress[2] : '';
			$suburb1 				= isset($physicaladdress[3]) ? $suburbdata[$physicaladdress[3]] : '';
			$city1 					= isset($physicaladdress[4]) ? $citydata[$physicaladdress[4]] : '';
			$province1 				= isset($physicaladdress[5]) ? $this->getProvinceList()[$physicaladdress[5]] : '';
			$postalcode1 			= isset($physicaladdress[6]) ? $physicaladdress[6] : '';

			// Postal address
			$postaladdress 			= isset($result['postaladdress']) ? explode('@-@', $result['postaladdress']) : [];
			$addressid2 			= isset($postaladdress[0]) ? $postaladdress[0] : '';
			$address2				= isset($postaladdress[2]) ? $postaladdress[2] : '';
			$suburb2 				= isset($postaladdress[3]) ? $suburbdata[$postaladdress[3]] : '';
			$city2 					= isset($postaladdress[4]) ? $citydata[$postaladdress[4]] : '';
			$province2 				= isset($postaladdress[5]) ? $this->getProvinceList()[$postaladdress[5]] : '';
			$postalcode2 			= isset($postaladdress[6]) ? $postaladdress[6] : '';
			// Billing address
			$billingaddress 		= isset($userdetails['billingaddress']) ? explode('@-@', $userdetails['billingaddress']) : [];
			$addressid3 			= isset($billingaddress[0]) ? $billingaddress[0] : '';
			$address3				= isset($billingaddress[2]) ? $billingaddress[2] : '';
			$suburb3 				= isset($billingaddress[3]) ? $suburbdata[$billingaddress[3]] : '';
			$city3 					= isset($billingaddress[4]) ? $citydata[$billingaddress[4]] : '';
			$province3 				= isset($billingaddress[5]) ? $this->getProvinceList()[$billingaddress[5]] : '';
			$postalcode3 			= isset($billingaddress[6]) ? $billingaddress[6] : '';
			
			//$jsonData['id'] 								= $id;
			//$jsonData['userdata'] 						= $this->getUserDetails($id);
			$mycpd 								= $this->userperformancestatus(['performancestatus' => '1', 'auditorstatement' => '1', 'userid' => $id]);
			$nonlogcoc 							= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['4','5']]);
			$adminstock 			 			= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $id]);
			$adminstock 						= array_sum(array_column($adminstock, 'quantity'));
			$coccount 							= $this->Coc_Model->COCcount(['user_id' => $id]);
			$coccount 							= $coccount['count'];
			$history 							= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);
			$auditcoc 							= $history['total'];
			$auditrefixincomplete				= $history['refixincomplete'];
			$auditorratio						= $this->Auditor_Model->getAuditorRatio('row', ['userid' => $id]);
			$auditorratio 						= ($auditorratio) ? $auditorratio['audit'].'%' : '0%';
			// country rangking
			$overallperformancestatus 			= $this->userperformancestatus(['overall' => '1']);
			$myprovinceperformancestatus 		= $this->userperformancestatus(['province' => $userdata['province']], $id);
			$performancestatus 					= $this->userperformancestatus(['userid' => $id]);
			$mycityperformancestatus 			= $this->userperformancestatus(['city' => $userdata['city']], $id);
			$provinceperformancestatus 			= $this->userperformancestatus(['province' => $userdata['province'], 'limit' => '3']);

			$countryranking 	= $this->ranking(['id' => $id, 'type' => 'country']);
			$regionalranking 	= $this->ranking(['id' => $id, 'type' => 'province']);
			$countryrank  = 0;
			$regionalrank = 0;

			// country and industry
			foreach ($countryranking as $key1 => $user_country_ranking) {
				if ($user_country_ranking['userid'] == $id) {
					$countryrank = $key1+1;
				}
			}
			// province
			foreach ($regionalranking as $key1 => $user_province_ranking) {
				if ($user_province_ranking['userid'] == $id) {
					$regionalrank = $key1+1;
				}
			}

			// $jsonData['cityperformancestatus'] 			= $this->userperformancestatus(['city' => $userdata['city'], 'limit' => '3'],$id);

			if ($this->config->item('plumberstatus')[$userdetails['plumberstatus']] == 'Pending') {
				$jsonData = ['plumberstatus' => $this->config->item('plumberstatus')[$userdetails['plumberstatus']], 'pageresponse' => 'Your Applciation is Pending'];

			}elseif($this->config->item('plumberstatus')[$userdetails['plumberstatus']] == 'Active'){
				//$jsonData['plumber_contact_details'] 	= [];
				$jsonData['plumber_details']			= [];
				$jsonData['plumber_profile']			= [];
				$jsonData['plumber_designation']		= [];
				$jsonData['page_lables']				= [];

				//$jsonData['plumber_contact_details'] = ['email' => $userdata['email'], 'mobile1' => $userdetails['mobile_phone'], 'home_phone' => $userdetails['home_phone'], 'mobile2' => $userdetails['mobile_phone2'], 'work_phone' => $userdetails['work_phone'], 'email2' => $userdetails['email2'], 'physical_address' => ['province' => $province1, 'city' => $city1, 'suburb' => $suburb1, 'address' => $address1, 'postalcode' => $postalcode1], 'postal_address' => ['province' => $province2, 'city' => $city2, 'suburb' => $suburb2, 'address' => $address2, 'postalcode' => $postalcode2], 'billing_address' => ['province' => $province3, 'city' => $city3, 'suburb' => $suburb3, 'address' => $address3, 'postalcode' => $postalcode3]];

				$jsonData['page_lables'] = [ 'hellomsg' => 'Hello,', 'card' => 'PIRB registration card', 'country_rank' => 'My Country Ranking', 'perfomancscore' => 'My Performance Score', 'reginal_ranking' => 'My Regional Ranking', 'non_log' => 'non-logged', 'purchase' => 'Purchase CoC', 'cocstatement' => 'CoC Statement', 'audit_percent' => 'My Audits', 'rank_industry' => 'Industry Ranking', 'point' => 'Points', 'cpd' => 'My CPD', 'perfomancstatus' => 'Performance Status'
			];

			if (isset($userdata) && (count($userdata) > 0)) {
				$jsonData['plumber_details'] = [
					'plumberid' 		=> $userdata['id'],
					'renewaldate' 		=> date('d-m-Y', strtotime($userdata['expirydate'])),
					'name' 				=> $userdata['name'],
					'regno' 			=> $userdata['registration_no'],
					'status' 			=> $this->config->item('plumberstatus')[$userdetails['plumberstatus']],
					'nonlogcoc' 		=> $nonlogcoc,
					'adminstock' 		=> $adminstock,
					'employementstatus' => $this->config->item('employmentdetail')[$userdetails['employment_details']],
					'companyname' 		=> $userdetails['companyname'],
					'coccount' 			=> $coccount,
					'auditorreview' 	=> $history,
					'auditcoc' 			=> $auditcoc,
					'auditrefixincomplete' 	=> $auditrefixincomplete,
					'auditorratio' 		=> $auditorratio,
					'overallperformancestatus' 		=> $overallperformancestatus,
					'myprovinceperformancestatus' 	=> $regionalrank,
					'performancestatus' 			=> $performancestatus,
					'mycityperformancestatus' 		=> $mycityperformancestatus,
					'industryranking' 				=> $countryrank,
					'countryranking' 				=> $countryrank,
					'provinceperformancestatus' 	=> $provinceperformancestatus[0]['point'],
					'cpdpoints' 					=> $mycpd
					

				];
			}

			if ($userdata['file2'] !='') {
				$jsonData['plumber_profile'] = [
					'file' 		=> base_url().'assets/uploads/plumber/'.$id.'/'.$userdata['file2'] 
				];
			}else{
				$jsonData['plumber_profile'] = [
					'file' 		=> base_url().'assets/uploads/plumber/'.$id.'/'.$userdata['file2'] 
				];
					
			}
			if ($userdata['designation'] !='') {
				$jsonData['plumber_designation'] = [
					'designation' 		=> $this->config->item('designation2')[$userdata['designation']]
				];
			}else{
				$jsonData['plumber_designation'] = [
					'designation' 		=> $jsonData['userdata']['designation'] 
				];
			}

			}elseif($this->config->item('plumberstatus')[$userdetails['plumberstatus']] == 'CPD Suspention'){
				$jsonData = ['plumberstatus' => $this->config->item('plumberstatus')[$userdetails['plumberstatus']], 'pageresponse' => 'plumber has CPD Suspention'];
				
			}elseif($this->config->item('plumberstatus')[$userdetails['plumberstatus']] == 'Expired'){
				$jsonData = ['plumberstatus' => $this->config->item('plumberstatus')[$userdetails['plumberstatus']], 'pageresponse' => 'Plumber has Expired'];
				
			}elseif($this->config->item('plumberstatus')[$userdetails['plumberstatus']] == 'Deceased'){
				$jsonData = ['plumberstatus' => $this->config->item('plumberstatus')[$userdetails['plumberstatus']], 'pageresponse' => 'Plumber has Deceased'];
				
			}elseif($this->config->item('plumberstatus')[$userdetails['plumberstatus']] == 'Resigned'){
				$jsonData = ['plumberstatus' => $this->config->item('plumberstatus')[$userdetails['plumberstatus']], 'pageresponse' => 'Plumber has Resigned'];
				
			}
			//print_r($jsonData);die;
			$jsonArray = array("status"=>'1', "message"=>'User details', "result"=>$jsonData);

		
		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}

		echo json_encode($jsonArray);
	}

	public function card(){

		if ($this->input->post() && $this->input->post('user_id')) {
			$userid 			= $this->input->post('user_id');
			$cardtype 			= $this->input->post('cardtype');
			$card 				= $this->plumbercard_api(['id' => $userid, 'type' => $cardtype]);
			$jsonData['card'] 	= $card;
			echo $jsonData['card'];die;
			$jsonArray = array("status"=>'1', "message"=>'Plumber PIRB registration card', 'result' => $jsonData);
		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}
		echo json_encode($jsonArray);
	}
	public function plumbercard_api($requestdata = []){

		$data['company'] 			= $this->getCompanyList();
		$data['designation2'] 		= $this->config->item('designation3');
		$data['specialisations'] 	= $this->config->item('specialisations');
		$data['settings'] 			= $this->Systemsettings_Model->getList('row');
		
		$data['result'] = $this->Plumber_Model->getList('row', ['id' => $requestdata['id']], ['users', 'usersdetail', 'usersplumber', 'company']);
		if (isset($requestdata['type']) && $requestdata['type'] == 'front') {
			return $this->load->view('api/card/card_front', $data, true) ;
		}elseif (isset($requestdata['type']) && $requestdata['type'] == 'back'){
			return $this->load->view('api/card/card_back', $data, true) ;
		}
		
	}

	// Purchase CoC:
	public function purchase_coc(){

		if ($this->input->post('user_id')) {
			$jsonData = [];
			$jsonData['plumber_purchase_details'] = [];
			
			$userid 					=	$this->input->post('user_id');
			$userdata					= 	$this->getUserDetails($userid);
			$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
			$userdatacoc_count			= 	$this->Coc_Model->COCcount(['user_id' => $userid]);
			//$jsonData['userid']			= 	$userid;
			//$jsonData['userdata']		= 	$userdata;
			//$jsonData['userdata1']		= 	$userdata1;
			// $jsonData['coc_count']		= 	$userdatacoc_count['count'];

			$jsonData['deliverycard']	= 	$this->config->item('purchasecocdelivery');
			$jsonData['coctype']		= 	$this->config->item('coctype');
			$settings 					= 	$this->Systemsettings_Model->getList('row');
			$nonlogcoc	 				=	$this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['4','5']]);
			$cocpaperwork 				=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
			$cocelectronic 				=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
			$postage 					= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
			$couriour 					= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
			$collectedbypirb 			= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb')]);
			$orderquantity 				= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $userid]);
			
			$userorderstock 			= array_sum(array_column($orderquantity, 'quantity'));

			$jsonData['collectedbypirb']= 	['id' => $collectedbypirb['id'], 'supllyname' => $collectedbypirb['supplyitem'], 'amount' => $collectedbypirb['amount']];
			$jsonData['couriour']		= 	['id' => $couriour['id'], 'supllyname' => $couriour['supplyitem'], 'amount' => $couriour['amount']];
			$jsonData['postage']		= 	['id' => $postage['id'], 'supllyname' => $postage['supplyitem'], 'amount' => $postage['amount']];
			$jsonData['cocelectronic']	=	['id' => $cocelectronic['id'], 'supllyname' => $cocelectronic['supplyitem'], 'amount' => $cocelectronic['amount']];
			$jsonData['cocpaperwork']	=	['id' => $cocpaperwork['id'], 'supllyname' => $cocpaperwork['supplyitem'], 'amount' => $cocpaperwork['amount']];

			if ($userdata1['coc_electronic'] == '0') {
				$coc_electronic = '1';
			}else{
				$coc_electronic = '2';
			}
			$jsonData['plumber_purchase_details'] = ['plumberid' => $userdata1['id'],  'coc_purchase_limit' => $userdata1['coc_purchase_limit'], 'coc_purchase' => $userdatacoc_count['count'], 'nonlogcoc' => $nonlogcoc, 'adminallocated' => $userorderstock, 'coc_electronic' => $this->config->item('yesno')[$coc_electronic]
				];

			$jsonData['page_lables'] = [ 'mycoc' => 'My COC’s', "permitted" => "Total number COC’s your are permitted", "purchase" => "Number of Permitted COC's that you are able to purchase", "nonlogged" => "Number of non-logged COC’s","allocateadmin" => "Number of COC’s to be allocated by admin", "purchasecoc_heading" => "Purchase COC’s", "selectcoctype" => "Select type of COC’s you wish to purchase", "coctype1" => "Electronic","coctype2" => "Paper Based", "purchasecoc" => "Number of COC’s you wish to purchase", "typecost" => "Cost of COC Type", "vat" => "VAT @".$settings['vat_percentage']."%", "totaldue" => "Total Due", "currency" => $this->config->item('currency'), 'vatamt' => $settings['vat_percentage']
			];


			$jsonArray = array("status"=>'1', "message"=>'Plumber coc details', "result"=>$jsonData);

		}else{

			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}

		echo json_encode($jsonArray);
	}

	public function purchase_coc_action(){

		if ($this->input->post('user_id') && $this->input->post('coc_count') && $this->input->post('coc_type') ) {
			$userid 					=	$this->input->post('user_id');
			$coc_count 					=	$this->input->post('coc_count');
			$coc_type 					=	$this->input->post('coc_type'); // 1- electronic , 2- paperbased
			$delivery_type 				=	$this->input->post('delivery_type'); // 1- collected by PIRB , 2- By courier, 3- registered post
			$userdata					= 	$this->getUserDetails($userid);
			$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
			$userdatacoc_count			= 	$this->Coc_Model->COCcount(['user_id' => $userid]);
			$settings 					= 	$this->Systemsettings_Model->getList('row');

			if ($coc_count > $userdatacoc_count['count']) {
				if ($userdatacoc_count['count'] == '0') {
					$errormsg = 'Purchase limit has been exceeded. Contact our support for further assistance.';
				}else{
					$errormsg = 'You cannot purchase more than '.$userdatacoc_count['count'].' COCs. Contact our support for further assistance.';
				}
				$jsonData['plumber_purchase_details'] = ['plumberid' => $userdata1['id'], 'errormsg' => $errormsg
				];
				$jsonArray = array("status"=>'1', "message"=>'Purchase COC’s', 'result' => $jsonData);
			}else{

				if ($this->input->post('coc_type') == '1') {
					$cocelectronic 		=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
					$typecost 			= 	$cocelectronic['amount']*$coc_count;
					$deliveryamt 		= 	0;
				}else{
					$cocpaperwork 		=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
					$typecost 			= 	$cocpaperwork['amount']*$coc_count;

					if ($delivery_type == '1') {
						$deliveryamt 	= 0;
					}elseif($delivery_type == '2'){
						$couriour 		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
						$deliveryamt 	= 	$couriour['amount'];
					}elseif($delivery_type == '3'){
						$postage 		=	 $this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
						$deliveryamt 	= 	 $postage['amount'];
					}

				}

				$vatcalculation = ((($typecost+$deliveryamt)*$settings['vat_percentage'])/100);
				$totaldue 		= ($typecost+$deliveryamt+$vatcalculation);

				$jsonData['plumber_purchase_details'] = ['plumberid' => $userdata1['id'], 'costtypeofcoc' => number_format($typecost, 2, '.', ''), 'deliverycost' => number_format($deliveryamt, 2, '.', ''), 'totalvat' => number_format($vatcalculation, 2, '.', ''), 'totaldue' => number_format($totaldue, 2, '.', '')
					];
				$jsonArray = array("status"=>'1', "message"=>'Purchase COC’s', 'result' => $jsonData);
			}

		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', 'result' => []);
		}
		echo json_encode($jsonArray);
	}

	// CoC Statement:
	public function coc_statement(){

		if ($this->input->post('user_id') && $this->input->post('type') == 'list') {
			$jsonData = [];

			$userid 				= $this->input->post('user_id');

			$totalcount 			 = $this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['2','4','5','7']]);
			$results	 			= $this->Coc_Model->getCOCList('all', ['user_id' => $userid, 'coc_status' => ['2','4','5','7']]);

			foreach ($results as $key => $value) {
				if ( $this->config->item('cocstatus')[$value['coc_status']] == 'Logged') {
					$colorcode = '#ade33d';
				}else{
					$colorcode = '#7f694f';
				}
				$jsonData['coc_statement'][] = [ 'plumberid' => $value['user_id'], 'coc_status' =>  $this->config->item('cocstatus')[$value['coc_status']], 'coc_type' => $this->config->item('coctype')[$value['type']], 'cl_name' => $value['cl_name'], 'colorcode' => $colorcode, 'totalcount' => $totalcount
				];
			}

			$jsonArray = array("status"=>'1', "message"=>'COC statement details', "result"=>$jsonData);

		}elseif($this->input->post('user_id') && $this->input->post('type') == 'search'  && $this->input->post('keywords')){
			$keywords 		= $this->input->post('keywords');
			$userid 		= $this->input->post('user_id');
			$post 			= $this->input->post();

			$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2','4','5','7'], 'user_id' => $userid, 'search' => ['value' => $keywords], 'page' => 'plumbercocstatement']);
			$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2','4','5','7'], 'user_id' => $userid, 'search' => ['value' => $keywords], 'page' => 'plumbercocstatement']);

			foreach ($results as $key => $value) {
				if ( $this->config->item('cocstatus')[$value['coc_status']] == 'Logged') {
					$colorcode = '#ade33d';
				}else{
					$colorcode = '#7f694f';
				}
				$jsonData['coc_statement'][] = [ 'plumberid' => $value['user_id'], 'coc_status' =>  $this->config->item('cocstatus')[$value['coc_status']], 'coc_type' => $this->config->item('coctype')[$value['type']], 'cl_name' => $value['cl_name'], 'colorcode' => $colorcode, 'totalcount' => $totalcount
				];
			}
			
			$jsonArray = array("status"=>'1', "message"=>'COC statement serach details', "result"=>$jsonData);

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

			$jsonData['page_lables'] = [ 'plumbingwork' => 'Plumbing Work Completion Date *', 'insuranceclaim' => "Insurance Claim/Order no: (if relevant)", 'certificate' => "Certificate Number: ".$id."", 'installationimages' => "Installation Images", 'address' => "Physical Address Details of Installation", 'ownersname' => "Owners Name *", 'complex' => "Name of Complex/Flat and Unit Number (if applicable)", 'street' => "Street *", 'number' => "Number *", 'province' => "Province *", 'city' => "City *", 'suburb' => "Suburb *", 'contact' => "Contact Mobile *", 'alternate_no' => "Alternate Contact", 'email' => "Email Address"
			];

			$jsonData['userdata'] 			= $userdata;
			$jsonData['cocid'] 				= $id;
			$jsonData['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
			$jsonData['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);


			$province 						= $this->Managearea_Model->getListProvince('all', ['status' => ['1']]);
			if(count($province) > 0){
				foreach ($province as $key => $value) {
					$jsonData['province_list'][] = [ 'id' => $value['id'], 'name' => $value['name']
					];
				}
			}

			//$jsonData['result'] 			= $result;

			//$jsonData['designation2'] 		= $this->config->item('designation2');
			//$jsonData['ncnotice'] 			= $this->config->item('ncnotice');
			//$jsonData['installationtype']	= $this->getInstallationTypeList();
		
			//$noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $plumberID]);		
			//$jsonData['noncompliance']		= [];
			// foreach($noncompliance as $compliance){
			// 	$jsonData['noncompliance'][] = [
			// 		'id' 		=> $compliance['id'],
			// 		'details' 	=> $this->parsestring($compliance['details']),
			// 		'file' 		=> $compliance['file']
			// 	];
			// }

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
			$this->form_validation->set_rules('province','Province','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('suburb','suburb','trim|required');
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
			$this->form_validation->set_rules('installationtype[]','Instalaltion type','trim|required');
			$this->form_validation->set_rules('specialisations[]','Specialisations','trim|required');
			$this->form_validation->set_rules('installation_detail','Instalaltion details','trim|required');
			$this->form_validation->set_rules('ncnotice','non compliance notice','trim|required');
			

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
		if ($this->input->post() && $this->input->post('type') == 'search') {
			$jsonData = [];
			$jsonData['results'] = [];

			$keywords 		= $this->input->post('keywords');
			$userid 		= $this->input->post('user_id');
			$post 			= $this->input->post();
			$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'user_id' => $userid, 'search' => ['value' => $keywords], 'page' => 'plumberauditorstatement', 'noaudit' => '']);
			$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'user_id' => $userid, 'search' => ['value' => $keywords], 'page' => 'plumberauditorstatement', 'noaudit' => '']);

			foreach ($results as $key => $value) {
				if ($value['u_status'] =='1') {
					$colorcode = '#ade33d';
				}elseif($value['u_status'] =='2'){
					$colorcode = '#ffd700';
				}elseif($value=='3'){
					$colorcode = '#eb0000';
				}elseif($value['u_status'] =='4'){
					$colorcode = '#ade33d';
				}elseif($value['u_status'] =='5'){
					$colorcode = '#87d0ef';
				}
				$jsonData['results'][] = [
					'coc_number' => $value['id'], 'auditstatus' => $this->config->item('auditstatus')[$value['u_status']], 'colorcode' => $colorcode, 'consumername' => $value['cl_name'], 'auditorname' => $value['auditorname'], 'address' => $value['cl_address'], 'audit_allocation_date' => $value['audit_allocation_date'], 
				];
			}
			$jsonData['totalcount'] = $totalcount;
			if (count($results) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'Search Audit Statement', "result"=> $jsonData);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'No record found', "result"=>[]);
			}
			
		}elseif ($this->input->post() && $this->input->post('type') == 'dropdown') {
			$jsonData = [];
			$jsonData['results'] = [];

			$length 		= $this->input->post('dropdown_value');
			$userid 		= $this->input->post('user_id');
			$post 			= $this->input->post();
			if ($this->input->post('keywords')!='') {
				$keywords 		= $this->input->post('keywords');
			}else{
				$keywords 		= '';
			}
			$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'user_id' => $userid, 'search' => ['value' => $keywords], 'page' => 'plumberauditorstatement', 'start' => '0', 'length' => $length, 'noaudit' => '']);
			$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'user_id' => $userid, 'search' => ['value' => $keywords], 'page' => 'plumberauditorstatement', 'start' => '0', 'length' => $length, 'noaudit' => '']);

			foreach ($results as $key => $value) {
				if ($value['u_status'] =='1') {
					$colorcode = '#ade33d';
				}elseif($value['u_status'] =='2'){
					$colorcode = '#ffd700';
				}elseif($value=='3'){
					$colorcode = '#eb0000';
				}elseif($value['u_status'] =='4'){
					$colorcode = '#ade33d';
				}elseif($value['u_status'] =='5'){
					$colorcode = '#87d0ef';
				}
				$jsonData['results'][] = [
					'coc_number' => $value['id'], 'auditstatus' => $this->config->item('auditstatus')[$value['u_status']], 'colorcode' => $colorcode, 'consumername' => $value['cl_name'], 'auditorname' => $value['auditorname'], 'address' => $value['cl_address'], 'audit_allocation_date' => $value['audit_allocation_date'], 
				];
			}
			$jsonData['totalcount'] = $totalcount;
			if (count($results) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'Search Audit Statement', "result"=> $jsonData);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'No record found', "result"=>[]);
			}
			
		}elseif ($this->input->post() && $this->input->post('type') == 'list') {
			$jsonData = [];
			$jsonData['results'] = [];

			$userid 		= $this->input->post('user_id');
			$post 			= $this->input->post();
			$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);
			$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2'], 'user_id' => $userid, 'noaudit' => '']+$post);
			
			foreach ($results as $key => $value) {
				if ($value['u_status'] =='1') {
					$colorcode = '#ade33d';
				}elseif($value['u_status'] =='2'){
					$colorcode = '#ffd700';
				}elseif($value=='3'){
					$colorcode = '#eb0000';
				}elseif($value['u_status'] =='4'){
					$colorcode = '#ade33d';
				}elseif($value['u_status'] =='5'){
					$colorcode = '#87d0ef';
				}
				$jsonData['results'][] = [
					'coc_number' => $value['id'], 'auditstatus' => $this->config->item('auditstatus')[$value['u_status']], 'colorcode' => $colorcode, 'consumername' => $value['cl_name'], 'auditorname' => $value['auditorname'], 'address' => $value['cl_address'], 'audit_allocation_date' => $value['audit_allocation_date'], 
				];
			}
			$jsonData['totalcount'] = $totalcount;
			//$jsonData['results'] 	= $results;

			if (count($results) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'Audit Statement', "result"=>$jsonData);
			}else{
				$jsonArray = array("status"=>'0', "message"=>'No record found', "result"=>[]);
			}

		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

	// coc Details;
	public function coc_details(){

		if ($this->input->post() && $this->input->post('type') == 'coc_details') {
			$extraparam = [];
			$jsonData 	= [];
			
			$userid						= $this->input->post('user_id');
			$id							= $this->input->post('coc_id'); // id = coc id
			// if ($this->input->post('auditorid') !='') {
			// 	$extraparam['auditorid']	= $this->input->post('auditorid');
			// }else{
			// 	$extraparam['auditorid']	= '';
			// }
			$extraparam['user_id'] 		= $userid;
			$extraparam['page'] 		= 'review';
		
			$result						= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]+$extraparam);
			$userdata				 	= $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber', 'company']);
			$reviewlist					= $this->Auditor_Model->getReviewList('all', ['coc_id' => $id]);
			
			// $specialisations 				= explode(',', $userdata['specialisations']);

			// $jsonData['userdata'] 			= $userdata;
			// $jsonData['cocid'] 				= $id;
			// $jsonData['auditorid'] 			= $auditorid;
			// $jsonData['notification'] 		= $this->getNotification();
			// $jsonData['province'] 			= $this->getProvinceList();
			// $jsonData['designation2'] 		= $this->config->item('designation2');
			// $jsonData['ncnotice'] 			= $this->config->item('ncnotice');
			// $jsonData['installationtype']	= $this->getInstallationTypeList();
			// $jsonData['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
			// $jsonData['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);

			// $noncompliance					= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);		
			// $jsonData['noncompliance']		= [];
			// foreach($noncompliance as $compliance){
			// 	$jsonData['noncompliance'][] = [
			// 		'id' 		=> $compliance['id'],
			// 		'details' 	=> $this->parsestring($compliance['details']),
			// 		'file' 		=> $compliance['file']
			// 	];
			// }

			$jsonData['page_lables'] = [
				'page_heading' => 'CoC Details', 'certificate' => 'Certificate','plumbingwork' => 'Plumbing work completeion date', 'ownersname' => 'Owners name', 'street' => 'Street', 'suburb' => 'Suburb', 'city' => 'City', 'province' => 'Province', 'complex' => 'Name of the complex / flat (if applicable)', 'contactnumber1' => 'Contact number', 'contactnumber2' => 'Alternate Contact number', 'auditstaus' => 'Audit status', 'auditorname' => 'Auditors name and surname', 'phone' => 'Phone (mobile)', 'date' => 'Date of audit', 'overall' => 'Overall workmanship', 'plumberpresent' => 'Licensed plumber present', 'coccorrect' => 'Was CoC completed correctly'
			];

			$jsonData['result']	= [ 'cocnumber' => $result['id'], 'plumberid' => $result['user_id'], 'completiondate' => date("d-m-Y", strtotime($result['cl_completion_date'])), 'onersname' =>  $result['cl_name'], 'cl_address' =>  $result['cl_address'], 'cl_street' =>  $result['cl_street'], 'cl_province_name' =>  $result['cl_province_name'], 'cl_city_name' =>  $result['cl_city_name'], 'cl_suburb_name' =>  $result['cl_suburb_name'], 'complex' =>  $result['cl_address'], 'cl_contact_no' =>  $result['cl_contact_no'], 'cl_alternate_no' =>  $result['cl_alternate_no'], 'auditstatus' => $this->config->item('auditstatus')[$result['audit_status']], 'auditorname' => $result['auditorname'], 'auditormobile' => $result['auditormobile'], 'auditormobile' => $result['auditormobile'], 'as_audit_date' => date("d-m-Y", strtotime($result['as_audit_date'])), 'as_workmanship', $this->config->item('workmanship')[$result['as_workmanship']], 'as_plumber_verification' => $this->config->item('yesno')[$result['as_plumber_verification']], 'as_coc_verification' => $this->config->item('yesno')[$result['as_coc_verification']]
			];

			foreach ($reviewlist as $key => $value) {

				if ($this->config->item('reviewtype')[$value['reviewtype']] == 'Cautionary') {
				$colorcode = '#ffd700';
				}elseif($this->config->item('reviewtype')[$value['reviewtype']] == 'Compliment'){
					$colorcode = '#ade33d';
				}elseif($this->config->item('reviewtype')[$value['reviewtype']] == 'Failure'){
					$colorcode = '#f33333';
				}

				$jsonData['review_details'][] = [ 'reviewtype' => $this->config->item('reviewtype')[$value['reviewtype']], 'statementname' => $value['statementname'], 'colorcode' => $colorcode
				];
			}

			// print_r($jsonData);die;
			$jsonArray = array("status"=>'1', "message"=>'CoC Details', "result"=>$jsonData);
		}else{
			$jsonArray = array("status"=>'0', "message"=>'Invalid Api', "result"=>[]);
		}

		echo json_encode($jsonArray);
	}

	// Audit Review, view coc;
	public function auditreview_coc(){

		if ($this->input->post() && $this->input->post('user_id') && $this->input->post('type') == 'view_coc') {

			$userid					 = $this->input->post('user_id');
			$cocID 					 = $this->input->post('coc_id');
			$electroniccocreport 	 = '';
			$noncompliancereport 	 = '';
			$userdata				 = $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber', 'company']);
			$specialisations 		 = explode(',', $userdata['specialisations']);

			//$jsonData['installationtype']	= $this->getInstallationTypeList();
			$installations 		 	 = $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => [], 'ids' => range(1,8)]);
			$specialisations_details = $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations, 'ids' => range(1,8)]);

			if ($this->input->post('auditorid') != '') {
				$auditorid			 = ['auditorid' => $this->input->post('auditorid')];
			}else{
				$auditorid			 = [];
			}
			
			$result 				 = $this->Coc_Model->getCOCList('row', ['id' => $cocID, 'user_id' => $userid]+$auditorid);
			$logdate 				 = isset($result['cl_log_date']) && date('Y-m-d', strtotime($result['cl_log_date']))!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_log_date'])) : '';

			$noncompliance			 = $this->Noncompliance_Model->getList('all', ['coc_id' => $cocID, 'user_id' => $userid]);

			$jsonData['noncompliance']		= [];
			foreach($noncompliance as $compliance){
				$jsonData['noncompliance'][] = [
					'id' 		=> $compliance['id'],
					'details' 	=> $this->parsestring($compliance['details']),
					'file' 		=> base_url().'assets/uploads/plumber/'.$userid.'/log/'.$compliance['file'] 
				];
			}

			$jsonData['installation_details']		= [];
			foreach($installations as $installation){
				$jsonData['installation_details'][] = [
					'id' 		=> $installation['id'],
					'name' 		=> $installation['name'],
					'code' 		=>$installation['code']
				];
			}

			$jsonData['specialisation_details']		= [];
			foreach($specialisations_details as $specialisations_detail){
				$jsonData['specialisation_details'][] = [
					'id' 		=> $specialisations_detail['id'],
					'name' 		=> $specialisations_detail['name'],
					'code' 		=>$specialisations_detail['code']
				];
			}

			$jsonData['coc_data']		= [];
			$jsonData['coc_data'] = [ 'coc_id' => $result['id'], 'coc_id' => $result['id'], 'plumberid' => $result['user_id'], 'completiondate' => date('d-m-Y', strtotime($result['cl_completion_date'])), 'insuranceclaim' => $result['cl_order_no'], 'cl_name' => $result['cl_name'], 'cl_name' => $result['cl_name'], 'complex' => $result['cl_address'], 'cl_street' => $result['cl_street'], 'cl_number' => $result['cl_number'], 'cl_province_name' => $result['cl_province_name'], 'cl_city_name' => $result['cl_city_name'], 'cl_suburb_name' => $result['cl_suburb_name'], 'cl_contact_no' => $result['cl_contact_no'], 'cl_alternate_no' => $result['cl_alternate_no'], 'cl_email' => $result['cl_email'], 'cl_installationtype' => $result['cl_installationtype'], 'cl_specialisations' => $result['cl_specialisations'], 'cl_installation_detail' => $result['cl_installation_detail'], 'cl_ncnotice ' => $result['cl_ncnotice'], 'cl_agreement' => $result['cl_agreement']
			];

			$jsonData['installation_images']		= [];
			if ($result['cl_file2'] !='') {
				if(strpos($result['cl_file2'], ',') !== false){
					$imgarray = explode(",",$result['cl_file2']);
					foreach ($imgarray as $key => $images) {
						$jsonData['installation_images'][] = [
							'file' 		=> base_url().'assets/uploads/plumber/'.$userid.'/log/'.$images 
						];
					}
				}else{
					$jsonData['installation_images'][] = [
							'file' 		=> base_url().'assets/uploads/plumber/'.$userid.'/log/'.$result['cl_file2'] 
						];
				}
			}else{
				$jsonData['installation_images'][] = [
							'file' 		=> '' 
						];
			}

			if ($result['type'] =='2' && $logdate!='') {
				//$electroniccocreport = base_url().'plumber/auditstatement/index/electroniccocreport/'.$cocID.'/'.$cocID;
				$electroniccocreport = base_url().'webservice/api/pdfelectroniccocreport_api/'.$cocID.'/'.$cocID;
			}
			if (count($jsonData['noncompliance']) > 0 && $logdate!='') {
				//$noncompliancereport = base_url().'plumber/auditstatement/index/noncompliancereport/'.$cocID.'/'.$userid;
				$noncompliancereport = base_url().'webservice/api/pdfnoncompliancereport_api/'.$cocID.'/'.$cocID;
			}

			$jsonData['pdf'] = ['electroniccocreport' => $electroniccocreport, 'noncompliancereport' => $noncompliancereport];

			$jsonData['page_lables'] = [ 'plumbingwork' => 'Plumbing Work Completion Date *', 'insuranceclaim' => "Insurance Claim/Order no: (if relevant)", "certificatenumber" => $cocID, 'physicaladdress' => "Physical Address Details of Installation", 'ownername' => "Owners Name *", 'complex' => "Name of Complex/Flat and Unit Number (if applicable)", 'street' => "Street *", 'number' => "Number *", 'province' => "Province *", 'city' => "City *", 'suburb' => "Suburb *", 'contactmobile' => "Contact Mobile *", 'Alternate Contact' => "Alternate Contact", 'email' => "Email Address", 'installationimages' => "Installation Images"
			];

			$jsonData['agreement'] = [ 'header' => ["I ".$result['u_name'].", Licensed registration number ".$result['plumberregno'].", certify that, the above compliance certifcate details are true and correct and will be logged in accordance with the prescribed requirements as defned by the PIRB. Select either A or B as appropriate"],'agreement1' => ['description' => 'A: The above plumbing work was carried out by me or under my supervision, and that it complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.', 'agreementid' => '1'], 'agreement2' => ['description' => 'B: I have fully inspected and tested the work started but not completed by another Licensed plumber. I further certify that the inspected and tested work and the necessary completion work was carried out by me or under my supervision- complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.', 'agreementid' => '2'], 
			];

			if (count($result) > 0) {
				$jsonArray = array("status"=>'1', "message"=>'View CoC', "result"=>$jsonData);
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

			$jsonData 			= [];
			$post['cocid'] 		= $this->input->post('cocid');  
			$post['fromto'] 	= $this->input->post('userid');   // fromto = userid
			$result 			= $this->Chat_Model->getList('all', $post);
			
			if(count($result)){
				foreach ($result as $key => $value) {
					$jsonData['chatdata'][] = [ 'id' => $value['id'], 'coc_id' => $value['coc_id'], 'from_id' => $value['from_id'], 'to_id' => $value['to_id'], 'quote' => $value['quote'], 'message' => $value['message'], 'attachment' => $value['attachment'], 'name' => $value['name'], 'chatdate' => date('d-m-Y', strtotime($value['created_at']))
					];
				}
				$jsonArray = ['status' => '1', "message"=>'Chat History', 'result' => $jsonData];
			}else{
				$jsonArray = ['status' => '0', "message"=>'No chat found', 'result' => []];
			}
			
		}else{
			$jsonArray = array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_current_year(){

		if ($this->input->post() && $this->input->post('user_id')) {
			$jsonData 					= [];
			$jsonData['page_lables'] 	= [];
			$jsonData['results'] 		= [];

			$user_id 		= $this->input->post('user_id');
			$pagestatus 	= '1';
			$post['pagestatus'] = $pagestatus;

			$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			$mycpd 			= $this->userperformancestatus(['userid' => $user_id, 'performancestatus' => '1', 'auditorstatement' => '1']);
			$userdata		= $this->Plumber_Model->getList('row', ['id' => $user_id], ['users', 'usersdetail', 'usersplumber', 'company']);

			$jsonData['page_lables'] = [ 'mycpd' => 'My CPD points', 'logcpd' => 'Log your CPD points', 'activity' => 'PIRB CPD Activity', 'date' => 'The Date', 'comments' => 'comments', 'documents' => 'Supporting Documents', 'files' => 'Choose Files', 'declaration' => 'I declare that the information contained in this CPD Activity form is complete, accurate and true. I further decalre that I understadn that I must keep verifiable evidence of all the CPD activities for at least 2 years and the PRIB may conduct a random audit of my activity(s) which would require me to submit the evidence to the PIRB', 'or' => 'OR', 'previouscpd' => 'Your Previous CPD Points'
			];
			$jsonData['total_cpd_point'] 	= $mycpd;
			$jsonData['renewal_cpd_point'] 	= '';
			$jsonData['plumber_details'][] 	= ['registration_no' => $userdata['registration_no'], 'name_surname' => $userdata['name'].' '.$userdata['surname']];
			foreach ($results as $key => $value) {

				if ($value['status'] == '0') {
					$status = 'Pending';
					$statusicons = '';
				}elseif($value['status'] == '1'){
					$status = 'Approve';
					$statusicons = '';
				}elseif($value['status'] == '2'){
					$status = 'Reject';
					$statusicons = '';
				}
				$jsonData['results'][] = [ 'dateofactivity' => date('d/m/Y', strtotime($value['cpd_start_date'])), 'activity' => $value['cpd_activity'], 'status' => $status, 'stausicons' => $statusicons, 'cpdpoints' => $value['points'], 'userid' => $value['user_id'], 'cpdid' => $value['id'], 
				];
			}

			if (count($results) > 0) {
				$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$jsonData);
			}else{
				$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
			}

			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}
	public function cpd_search_activity(){
		if ($this->input->post() && $this->input->post('user_id')) {
			$jsonData 	= [];
			$userid 	= $this->input->post('user_id');
			$keyword 	= $this->input->post('keyword');

			if ($keyword != '') {
				$data 		=   $this->Mycpd_Model->autosearchActivity(['search_keyword' => $keyword]);
				foreach ($data as $key => $value) {
					$jsonData['cpd_data'][] = [ 'actid' =>$value['id'], 'activityname' => $value['activity'], 'streamid' => $value['cpdstream'], 'points' => $value['points'], 'startdate' => date('m-d-Y', strtotime($value['startdate'])), 'plumberid' => $userid
					];
				}
				if (count($data) > 0) {
					$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$jsonData);
				}else{
					$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
				}
			}else{

				$currentDate = date('Y-m-d H:i:s');

				$this->db->select('cp1.id, cp1.activity, cp1.startdate, cp1.points, cp1.cpdstream');
				$this->db->from('cpdtypes cp1');

				$this->db->where('cp1.status="1"');
				$this->db->where('cp1.startdate<="'.$currentDate.'"');
				$this->db->where('cp1.enddate>"'.$currentDate.'"');
				
				$this->db->group_by("cp1.id");		
				$query = $this->db->get();
				$data = $query->result_array(); 

				foreach ($data as $key => $value) {
					$jsonData['cpd_data'][] = [ 'actid' =>$value['id'], 'activityname' => $value['activity'], 'streamid' => $value['cpdstream'], 'points' => $value['points'], 'startdate' => date('m-d-Y', strtotime($value['startdate'])), 'plumberid' => $userid
					];
				}

				if (count($data) > 0) {
					$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$jsonData);
				}else{
					$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
				}

			}

		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_previous_year(){

		if ($this->input->post() && $this->input->post('user_id')) {
			$jsonData 					= [];
			$jsonData['page_lables'] 	= [];
			$jsonData['results'] 		= [];

			$user_id 		= $this->input->post('user_id');
			$pagestatus 	= '0';
			$post['pagestatus'] = $pagestatus;

			$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$pagestatus], 'user_id' => [$user_id]]+$post);
			
			$jsonData['page_lables'] = [ 'mycpd' => 'My CPD points', 'logcpd' => 'Log your CPD points', 'activity' => 'PIRB CPD Activity', 'date' => 'The Date', 'comments' => 'comments', 'documents' => 'Supporting Documents', 'files' => 'Choose Files', 'declaration' => 'I declare that the information contained in this CPD Activity form is complete, accurate and true. I further decalre that I understadn that I must keep verifiable evidence of all the CPD activities for at least 2 years and the PRIB may conduct a random audit of my activity(s) which would require me to submit the evidence to the PIRB', 'or' => 'OR', 'previouscpd' => 'Your Previous CPD Points'
			];

			foreach ($results as $key => $value) {

				if ($value['status'] == '0') {
					$status = 'Pending';
					$statusicons = '';
				}elseif($value['status'] == '1'){
					$status = 'Approve';
					$statusicons = '';
				}elseif($value['status'] == '2'){
					$status = 'Reject';
					$statusicons = '';
				}
				$jsonData['results'][] = [ 'dateofactivity' => date('d/m/Y', strtotime($value['cpd_start_date'])), 'activity' => $value['cpd_activity'], 'status' => $status, 'stausicons' => $statusicons, 'cpdpoints' => $value['points'], 'userid' => $value['user_id'], 'cpdid' => $value['id']
				];
			}

			if (count($results) > 0) {
				$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$jsonData);
			}else{
				$jsonArray 	= array("status"=>'0', "message"=>'No Record Found', "result"=>[]);
			}

			
		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}
	public function mycpd_view(){
		if ($this->input->post() && $this->input->post('cpdid') && $this->input->post('pagestatus')) {
			$cpdID 			= $this->input->post('cpdID');
			$pagestatus 	= $this->input->post('pagestatus');
			$base_url 		= base_url();
			$file1 			= '';
			$file2 			= '';

			$result 		= $this->Mycpd_Model->getQueueList('row', ['id' => $cpdID, 'pagestatus' => $pagestatus]);
			if (count($result) > 0) {
					if ($result['file1'] !='') {
						$file1 			= $base_url.'assets/uploads/cpdqueue/'.$result['file1'];
					}if ($result['file2'] !='') {
						$file2 			= $base_url.'assets/uploads/cpdqueue/'.$result['file2'];
					}
					$jsonData['result'] = [ 'id' => $result['id'], 'user_id' => $result['user_id'], 'cpd_activity' => $result['cpd_activity'], 'cpd_start_date' => date('d/m/Y', strtotime($result['cpd_start_date'])), 'comments' => $result['comments'], 'file1' => $file1,'file2' => $file2,'admin_comments' => $result['admin_comments'],'status' => $this->config->item('approvalstatus')[$result['status']]
					]; 
			}
			$jsonData['page_lables'] = [ 'heading' => 'View your CPD Activity', 'subheading1' => 'PIRB CPD Activity', 'subheading2' => 'The Date', 'subheading3' => 'comments', 'subheading4' => 'Supporting Documents', 'heading1' => 'PIRB Office Purpose', 'subheading5' => 'CPD Activity Approval Status:', 'status1' => 'Approved', 'status2' => 'Rejected', 'subheading6' => 'Admin Comments:'
			];
			$jsonArray 	= array("status"=>'1', "message"=>'My CPD', "result"=>$jsonData);

		}else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function mycpd_edit_view(){

		if ($this->input->post() && $this->input->post('cpdID') && $this->input->post('pagestatus')) {
			$jsonData 					= [];
			$jsonData['page_lables'] 	= [];
			$jsonData['result'] 		= [];
			$base_url 					= base_url();

			$cpdID 			= $this->input->post('cpdID');
			$pagestatus 	= $this->input->post('pagestatus');

			$result 		= $this->Mycpd_Model->getQueueList('row', ['id' => $cpdID, 'pagestatus' => $pagestatus]);

			$jsonData['page_lables'] = [ 'mycpd' => 'My CPD points', 'logcpd' => 'Log your CPD points', 'activity' => 'PIRB CPD Activity', 'date' => 'The Date', 'comments' => 'comments', 'documents' => 'Supporting Documents', 'files' => 'Choose Files', 'declaration' => 'I declare that the information contained in this CPD Activity form is complete, accurate and true. I further decalre that I understadn that I must keep verifiable evidence of all the CPD activities for at least 2 years and the PRIB may conduct a random audit of my activity(s) which would require me to submit the evidence to the PIRB', 'or' => 'OR', 'previouscpd' => 'Your Previous CPD Points', 'renewalcpd' => 'CPD points needed for renewal'
			];
			if ($result['status'] == '0') {
					$status = 'Pending';
					$statusicons = '';
				}elseif($result['status'] == '1'){
					$status = 'Approve';
					$statusicons = '';
				}elseif($result['status'] == '2'){
					$status = 'Reject';
					$statusicons = '';
				}

			$jsonData['result'] = [ 'dateofactivity' => date('d/m/Y', strtotime($result['cpd_start_date'])), 'activity' => $result['cpd_activity'], 'status' => $status, 'stausicons' => $statusicons, 'cpdpoints' => $result['points'], 'comments' => $result['comments'], 'admindocument' => ''.$base_url.'assets/uploads/cpdqueue/'.$result['file1'].'', 'plumberdocument' => ''.$base_url.'assets/uploads/cpdqueue/'.$result['file2'].'','cpdstreamid' => $result['cpd_stream'], 'userid' => $result['user_id'], 'cpdid' => $result['id'], 'renewalcpd' => ''
				];

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
			
			$pagestatus 	= '1';

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
				//print_r($post);die;
				if ($post['image1'] != '') {
					$data = $this->fileupload(['files' => $post['image1'], 'file_name' => $post['file_name'], 'user_id' => $plumberID, 'page' => 'plumbercpd']);
					$image = $data[0];
				}

				if(isset($post['hidden_regnumber'])) 	$requestData1['reg_number']    		= $post['hidden_regnumber'];
				if(isset($post['user_id']))  			$requestData1['user_id'] 	    	= $post['user_id'];
				if(isset($post['name_surname']))  		$requestData1['name_surname']  		= $post['name_surname'];
				if(isset($post['activity'])) 			$requestData1['cpd_activity']  		= $post['activity'];
				if(isset($post['startdate'])) 	 		$requestData1['cpd_start_date'] 	= date("Y-m-d H:i:s", strtotime($post['startdate']));
				if(isset($post['comments'])) 	 		$requestData1['comments'] 			= $post['comments'];
				if(isset($image)) 		 				$requestData1['file1'] 				= $image;
				if(isset($post['points'])) 		 		$requestData1['points'] 			= $post['points'];
				if(isset($post['hidden_stream_id'])) 	$requestData1['cpd_stream'] 		= $post['hidden_stream_id'];
				// 1- submit 2- save
				if ($this->input->post('submit') == '1') {
					$requestData1['status'] 												= '0';
				}else{
					$requestData1['status'] 												= '3';
				}
				
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

				if ($post['image1'] != '') {
					$data = $this->fileupload(['files' => $post['image1'], 'user_id' => $plumberID, 'page' => 'plumbercpd']);
					$image = base64_decode($data);
					print_r($data);die;
				}

				if(isset($post['hidden_regnumber'])) 	$requestData1['reg_number']    		= $post['hidden_regnumber'];
				if(isset($post['user_id']))  			$requestData1['user_id'] 	    	= $post['user_id'];
				if(isset($post['name_surname']))  		$requestData1['name_surname']  		= $post['name_surname'];
				if(isset($post['activity'])) 			$requestData1['cpd_activity']  		= $post['activity'];
				if(isset($post['startdate'])) 	 		$requestData1['cpd_start_date'] 	= date("Y-m-d H:i:s", strtotime($post['startdate']));
				if(isset($post['comments'])) 	 		$requestData1['comments'] 			= $post['comments'];
				if(isset($image)) 		 				$requestData1['file1'] 				= $image;
				if(isset($post['points'])) 		 		$requestData1['points'] 			= $post['points'];
				if(isset($post['hidden_stream_id'])) 	$requestData1['cpd_stream'] 		= $post['hidden_stream_id'];
				
				if ($this->input->post('submit') == 'submit') {
					$requestData1['status'] 												= '0';
				}else{
					$requestData1['status'] 												= '3';
				}
				
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

	public function noncompliance_coc(){

		if ($this->input->post() && $this->input->post('user_id') && $this->input->post('pagetype') =='view') {
			$jsonData = [];

			if ($this->input->post('request_type') !='' && $this->input->post('request_type') =='ajaxgetinstallationtype') {

				$data		= $this->getInstallationTypeList_api();
				$message 	= 'Installation Types';
				
			}elseif ($this->input->post('request_type') !='' && $this->input->post('request_type') =='ajaxgetsubtype' && $this->input->post('installationtypeid') !='') {

				$installationtypeid		= $this->input->post('installationtypeid');
				$data					= $this->getSubTypeList_api(['installationtypeid' => $installationtypeid]);
				$message 				= 'Sub Types';

			}elseif ($this->input->post('request_type') !='' && $this->input->post('request_type') =='ajaxreportreportlisting' && $this->input->post('installationtypeid') !='' && $this->input->post('subtypeid') !='') {

				$installationtypeid		= $this->input->post('installationtypeid');
				$subtypeid 				= $this->input->post('subtypeid');
				$data					= $this->getreportlisting_api(['installationtypeid' => $installationtypeid, 'subtypeid' => $subtypeid]);
				$message 				= 'Non Compliance Report';

			}elseif ($this->input->post('request_type') !='' && $this->input->post('request_type') =='imageupload') {

				$post = $this->input->post();
				if ($post['nc_file'] != '') {
					$data = $this->fileupload(['files' => $post['nc_file'], 'file_name' => $post['file_name'], 'user_id' => $post['user_id'], 'page' => 'noncompliance_coc_image']);
					$message 		= 'Non Compliance Images';
				}
			}

			$jsonData['page_lables'] = [ 'heading' => 'Pre-existing Non Compliance Conditions', 'installation' => 'Installation Type', 'subtype' => 'Sub Type', 'statement' => 'Statement', 'nc_details' => 'Non compliance details', 'remedi' => 'Possible remedial actions', 'sans' => 'SANS / Regulation / Bylaw Reference', 'img' => 'images', 'addimg' => 'Add images'
			];
			$jsonArray 		= array("status"=>'1', "message"=>$message, "result"=>$data);
		}elseif ($this->input->post() && $this->input->post('user_id') && $this->input->post('id') && $this->input->post('pagetype') =='edit') {

			$id 	= $this->input->post('id');
			$userid = $this->input->post('user_id');
			$result = $this->Noncompliance_Model->getList('row', ['id' => $id]);
			if ($result) {
				$message 		= 'Non Compliance Data';

				if ($result['file'] !='') {
					if(strpos($result['file'], ',') !== false){
						$imgarray = explode(",",$result['file']);
						foreach ($imgarray as $key => $images) {
							$jsonData['nc_images'][] = [
								'file' 	=> base_url().'assets/uploads/plumber/'.$userid.'/log/'.$images 
							];
						}
					}else{
						$jsonData['nc_images'][] = [
								'file' 	=> base_url().'assets/uploads/plumber/'.$userid.'/log/'.$result['file'] 
							];
					}
				}else{
					$jsonData['nc_images'][] = [
								'file' 	=> '' 
							];
				}
				$installationtype 	= $this->getInstallationTypeList_api(['id' => $result['installationtype'], 'type' => 'getinstallation']);
				$subtype 			= $this->getSubTypeList_api(['id' => $result['subtype'], 'type' => 'getsubtypes']);
				$statement 			= $this->getreportlisting_api(['id' => $result['statement'], 'type' => 'getstatement']);

				$jsonData['noncompliance_details'][] = [ 'id' => $result['id'], 'user_id' => $result['user_id'], 'coc_id' => $result['coc_id'], 'installationtypeid' => $result['installationtype'], 'subtypeid' => $result['subtype'], 'statementid' => $result['statement'], 'details' => $result['details'], 'action' => $result['action'], 'reference' => $result['reference'], 'installationtype' => $installationtype[0]['name'], 'subtype' => $subtype[0]['name'], 'statement' => $statement[0]['statement']
				];
			}
			$jsonData['page_lables'] = [ 'heading' => 'Pre-existing Non Compliance Conditions', 'installation' => 'Installation Type', 'subtype' => 'Sub Type', 'statement' => 'Statement', 'nc_details' => 'Non compliance details', 'remedi' => 'Possible remedial actions', 'sans' => 'SANS / Regulation / Bylaw Reference', 'img' => 'images', 'addimg' => 'Add images'
			];
			$jsonArray 		= array("status"=>'1', "message"=>$message, "result"=>$jsonData);

		}elseif ($this->input->post() && $this->input->post('user_id') && $this->input->post('id') && $this->input->post('pagetype') =='delete') {

			$id 	= $this->input->post('id');
			$userid = $this->input->post('user_id');
			$result = $this->Noncompliance_Model->delete($id);
			if ($result) {
				$message 		= 'Non Compliance Deleted Sucessfully';
			}
			$jsonArray 		= array("status"=>'1', "message"=>$message, "result"=>['user_id' => $userid]);
		}
		else{
			$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
		}
		echo json_encode($jsonArray);
	}

	public function noncompliance_coc_action(){
		if ($this->input->post() && $this->input->post('user_id') && $this->input->post('coc_id')) {

			$this->form_validation->set_rules('installationtype','installationtype','trim|required');
			$this->form_validation->set_rules('subtype','subtype','trim|required');
			$this->form_validation->set_rules('statement','statement','trim|required');
			$this->form_validation->set_rules('details','details','trim|required');
			$this->form_validation->set_rules('action','action','trim|required');
			$this->form_validation->set_rules('reference','reference','trim|required');

			if ($this->form_validation->run()==FALSE) {
				$errorMsg = validation_errors();
				$jsonArray = array("status"=>'0', "message"=>$errorMsg, 'result' => []);
			}else{
				$post 			= 	$this->input->post();
				$userid			= 	$post['user_id'];
				$id 			= 	$post['id']; //noncompliance id
				$datetime		= 	date('Y-m-d H:i:s');
				
				$request		=	[
					'updated_at' 		=> $datetime,
					'updated_by' 		=> $userid
				];

				$request['user_id'] 													= $userid;
				$request['coc_id'] 														= $post['coc_id'];
				if(isset($post['installationtype'])) 	$request['installationtype'] 	= $post['installationtype'];
				if(isset($post['subtype'])) 			$request['subtype'] 			= $post['subtype'];
				if(isset($post['statement'])) 			$request['statement'] 			= $post['statement'];
				if(isset($post['details'])) 			$request['details'] 			= $post['details'];
				if(isset($post['action'])) 				$request['action'] 				= $post['action'];
				if(isset($post['reference'])) 			$request['reference'] 			= $post['reference'];
				
				$request['file'] 	= (isset($post['file'])) ? implode(',', $post['file']) : '';
				$request['status'] 	= (isset($post['status'])) ? $post['status'] : '0';
				
				if($id==''){
					$request['created_at'] = $datetime;
					$request['created_by'] = $userid;
					$this->db->insert('noncompliance', $request);
					$insertid = $this->db->insert_id();
				}else{
					$this->db->update('noncompliance', $request, ['id' => $id]);
					$insertid = $id;
				}

			}
		}else{
				$jsonArray 		= array("status"=>'0', "message"=>'invalid request', "result"=>[]);
			}
		echo json_encode($jsonArray);
	}

	public function getInstallationTypeList_api($data = []){

		if (!isset($data['id']) && !isset($data['type'])) {
			$results = $this->Installationtype_Model->getList('all', ['status' => ['1']]);
			if(count($results) > 0){
				foreach ($results as $key => $value) {
					$arraydata[] = ['id' => $value['id'], 'name' => $value['name']];
				}
			}else{
				$arraydata[] = [];
			}
		}else{
			$results = $this->Installationtype_Model->getList('all', ['status' => ['1'], 'id' => $data['id']]);
			if(count($results) > 0){
				foreach ($results as $key => $value) {
					$arraydata[] = ['id' => $value['id'], 'name' => $value['name']];
				}
			}else{
				$arraydata[] = [];
			}
		}
		
		return $arraydata;
	}
	public function getSubTypeList_api($data = []){

		if (!isset($data['id']) && !isset($data['type'])) {
			$results = $this->Subtype_Model->getList('all', ['status' => ['1'], 'installationtypeid' => $data['installationtypeid']]);
			if(count($results) > 0){
				foreach ($results as $key => $value) {
					$arraydata[] = ['id' => $value['id'], 'installationtypeid' => $value['installationtype_id'], 'name' => $value['name']];
				}
			}else{
				$arraydata[] = [];
			}
		}else{
			$data = $this->Subtype_Model->getList('all', ['status' => ['1'], 'id' => $data['id']]);
			if(count($data) > 0){
				foreach ($data as $key => $value) {
					$arraydata[] = ['id' => $value['id'], 'installationtypeid' => $value['installationtype_id'], 'name' => $value['name']];
				}
			}else{
				$arraydata[] = [];
			}
		}
		
		return $arraydata;
	}
	public function getreportlisting_api($data =[]){

		if (!isset($data['id']) && !isset($data['type'])) {
			$results = $this->Reportlisting_Model->getList('all', ['status' => ['1'], 'installationtypeid' => $data['installationtypeid'], 'subtypeid' => $data['subtypeid']]);
			if(count($results) > 0){
				foreach ($results as $key => $value) {
					$arraydata[] = ['id' => $value['id'], 'installationtypeid' => $value['installation_id'], 'subtype_id' => $value['subtype_id'], 'statement' => $value['statement'], 'regulation' => $value['regulation'], 'regulation' => $value['regulation'], 'compliment' => $value['compliment'], 'cautionary' => $value['cautionary'], 'refix_complete' => $value['refix_complete'], 'refix_incomplete' => $value['refix_incomplete'], 'ncn_details' => 'Details', 'pub_remedial_ac' => 'Actions', 'pub_remedial_ac' => 'Actions', 'reference' => 'Reference'];
				}
			}else{
				$arraydata[] = [];
			}
		}else{
			$results = $this->Reportlisting_Model->getList('all', ['status' => ['1'], 'id' => $data['id']]);
			if(count($results) > 0){
				foreach ($results as $key => $value) {
					$arraydata[] = ['id' => $value['id'], 'installationtypeid' => $value['installation_id'], 'subtype_id' => $value['subtype_id'], 'statement' => $value['statement'], 'regulation' => $value['regulation'], 'regulation' => $value['regulation'], 'compliment' => $value['compliment'], 'cautionary' => $value['cautionary'], 'refix_complete' => $value['refix_complete'], 'refix_incomplete' => $value['refix_incomplete'], 'ncn_details' => 'Details', 'pub_remedial_ac' => 'Actions', 'reference' => 'Reference'];
				}
			}else{
				$arraydata[] = [];
			}
		}
		
		return $arraydata;
	}

	// public function electroniccocreport_api($id, $userid)
	// {	
	// 	$this->pdfelectroniccocreport_apdi($id, $userid);
	// }
	// public function noncompliancereport_adi($id, $userid)
	// {	
	// 	$this->pdfnoncompliancereport_api($id, $userid);
	// }

	public function pdfelectroniccocreport_api($id, $userid){

		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
		$pagedata['userdata']	 		= $userdata;
		$pagedata['specialisations']	= explode(',', $pagedata['userdata']['specialisations']);
		$pagedata['result']		    	= $this->Coc_Model->getCOCList('row', ['id' => $id]);
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$specialisations 				= explode(',', $userdata['specialisations']);
		$pagedata['installationtype']	= $this->getInstallationTypeList();
		$pagedata['installation'] 		= $this->Installationtype_Model->getList('all', ['ids' => ['1','2','3','5','6','7']]);
		$pagedata['specialisations']	= $this->Installationtype_Model->getList('all', ['ids' => ['4','8']]);

		$html = $this->load->view('pdf/electroniccocreport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		$this->pdf->stream('Electronic COC Report '.$id);
	}
	
	public function pdfnoncompliancereport_api($id, $userid, $save=''){		

		$pagedata['result']			= $this->Coc_Model->getCOCList('row', ['id' => $id, 'coc_status' => ['2']]);
		$pagedata['noncompliance'] 	= $this->Noncompliance_Model->getList('all', ['coc_id' => $id, 'user_id' => $userid]);	

		$html = $this->load->view('pdf/noncompliancereport', (isset($pagedata) ? $pagedata : ''), true);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		
		if($save==''){
			$this->pdf->stream('Non Compliance Report '.$id);
		}else{
			file_put_contents($save, $output);
			return $save;
		}
	}	

	public function ranking($data = []){

		if ($data['type'] == 'province') {
			$userdetail		= $this->getUserDetails($data['id']);
			$province 		= $this->Managearea_Model->getListProvince('row', ['id' => $userdetail['province']]);
			$rollingavg 	= $this->getRollingAverage();
			$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
			$ranking 		= $this->Plumber_Model->performancestatus('all', ['date' => $date, 'archive' => '0', 'province' => $userdetail['province']]);
		}else{
			$rollingavg 	 = $this->getRollingAverage();
			$date			 = date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
			$ranking  = $this->Plumber_Model->performancestatus('all', ['date' => $date, 'archive' => '0', 'overall' => '1']);
		}
		return $ranking;
	}

	public function country_ranking(){

		if ($this->input->post('user_id')) {
			$jsonData = [];

			$id 				= $this->input->post('user_id');
			$userdata 			= $this->getUserDetails($id);
			$countryrank  = 0;
			

			$countryranking 	= $this->ranking(['id' => $id, 'type' => 'country']);

			// country and industry
			foreach ($countryranking as $key1 => $user_country_ranking) {
				if ($user_country_ranking['userid'] == $id) {
					$countryrank = $key1+1;
				}
			}
			$jsonData['plumber_data'] = [ 'id' => $id, 'rank' => $countryrank
			];

			$jsonArray = array("status"=>'1', "message"=>'Country Ranking', "result"=> $jsonData);
		}else{
			$jsonArray = array("status"=>'0', "message"=>'Invalid API', "result"=> []);
		}
		echo json_encode($jsonArray);
	}

	public function province_ranking(){

		if ($this->input->post('user_id')) {
			$jsonData = [];

			$id 										= $this->input->post('user_id');
			$userdata 									= $this->getUserDetails($id);
			$regionalrank = 0;

			$regionalranking 	= $this->ranking(['id' => $id, 'type' => 'province']);
			
			// province
			foreach ($regionalranking as $key1 => $user_province_ranking) {
				if ($user_province_ranking['userid'] == $id) {
					$regionalrank = $key1+1;
				}
			}
			$jsonData['plumber_data'] = [ 'id' => $id, 'rank' => $regionalrank
			];

			$jsonArray = array("status"=>'1', "message"=>'Province Ranking', "result"=> $jsonData);
		}else{
			$jsonArray = array("status"=>'0', "message"=>'Invalid API', "result"=> []);
		}
		echo json_encode($jsonArray);
	}

	public function fileupload($data = []){

		$userid 	 = $data['user_id'];
		$base64files = $data['files'];
		$base_url 	 = base_url();
		$page 		 = $data['page'];
		$file_name 	 = $data['file_name'];
		$directory 	 = dirname(__DIR__, 3);

		// $file_size	=  $base64files['image']['size'];
    	$files		=  explode(',', $base64files);
    	$countfiles = count($files);

		if ($page == 'plumbercpd') {
			$path = FCPATH.'assets/uploads/cpdqueue/';
		}elseif($page == 'plumberlogcoc'){
			$path = FCPATH.'assets/uploads/cpdqueue/';
		}elseif($page == 'noncompliance_coc_image'){
			$path = FCPATH.'assets/uploads/plumber/'.$userid.'/log/';
			
			if(!is_dir($path)){
				mkdir($directory.'/assets/uploads/plumber/'.$userid.'/log', 0755, true);
			}
		}
		
		if ($countfiles > 1) {
			$file_names = explode(',', $file_name);
			for($i=0;$i<$countfiles;$i++){
				
				$base64		= $files[$i];
				$file_name 	= $file_names[$i];
	            $extension 	= explode('.', $file_name)[1];
	            $image 		= base64_decode($base64);
	            $image_name = md5(uniqid(rand(), true).$i);
	            $filename 	= $image_name . '.' . $extension;
				$filearray[] 	= $filename;
	            file_put_contents($path . $filename, $image);
			}
		}
		else{

			$base64		= $base64files;
			$extension 	= explode('.', $file_name)[1];
	        $image 		= base64_decode($base64);
	        $image_name = md5(uniqid(rand(), true));
	        $filename 	= $image_name . '.' . $extension;
	        $filearray 	= $filename;

			file_put_contents($path . $filename, $image);
		}
		if (is_array($filearray) && (count($filearray) > 1)) {
			$file[] = implode(",",$filearray);
		}else{
			$file[] = $filearray;
		}
		return $file;
	}

	public function ajaxprovince(){
		$jsonData = [];
		$data = $this->Managearea_Model->getListProvince('all', ['status' => ['1']]);
		
		if(count($data) > 0){
			foreach ($data as $key => $value) {
				$jsonData['provincedata'][] = [ 'id' => $value['id'], 'name' => $value['name']
				];
			}
			$jsonArray = ['status' => '1', 'result' => $jsonData];
		}else{
			$jsonArray = ['status' => '0', 'result' => []];
		}
		echo json_encode($jsonArray);
	}

	public function ajaxcity(){

		if ($this->input->post()) {
			$jsonData 			= [];
			$post['provinceid']	= $this->input->post('provinceid'); 
			$post['orderby'] 	= "c.name asc";
			$result 			= $this->Managearea_Model->getListCity('all', $post);

			if(count($result)){
				foreach ($result as $key => $value) {
					$jsonData['citydata'][] = [ 'id' => $value['id'], 'province_id' => $value['province_id'], 'name' => $value['name'], 
					];
				}
				$jsonArray = ['status' => '1', 'result' => $jsonData];
			}else{
				$jsonArray = ['status' => '0', 'result' => []];
			}
		}else{
			$jsonArray = array("status"=>'0', "message"=>'Invalid API', "result"=> []);
		}
		echo json_encode($jsonArray);
	}

	public function ajaxsuburb(){

		if ($this->input->post()) {
			$jsonData 			= [];
			$post['provinceid'] = $this->input->post('provinceid');  
			$post['cityid'] 	= $this->input->post('cityid');  
			$post['orderby'] 	= "name asc";
			$result 			= $this->Managearea_Model->getListSuburb('all', $post);
			
			if(count($result)){
				foreach ($result as $key => $value) {
					$jsonData['suburbdata'][] = [ 'id' => $value['id'], 'province_id' => $value['province_id'], 'city_id' => $value['city_id'], 'name' => $value['name'], 
					];
				}
				$jsonArray = ['status' => '1', 'result' => $jsonData];
			}else{
				$jsonArray = ['status' => '0', 'result' => []];
			}
		}else{
			$jsonArray = array("status"=>'0', "message"=>'Invalid API', "result"=> []);
		}
		echo json_encode($jsonArray);
	}

	public function featchcity(){
		$getcity = $this->Managearea_Model->getListCity('all', ['status' => ['1']]);
		if(count($getcity) > 0) {
			$citydata=  ['' => 'Select City']+array_column($getcity, 'name', 'id');
		}else{
			$citydata = [];
		}
		return $citydata;
	}

	public function featchsuburb(){
		$getsuburb = $this->Managearea_Model->getListSuburb('all', ['status' => ['1']]);
		if(count($getsuburb) > 0) {
			$suburbdata=  ['' => 'Select City']+array_column($getsuburb, 'name', 'id');
		}
		else {
			$suburbdata = [];
		}
		return $suburbdata;
	}
// Selvamani
	public function get_cocplumber(){

		if ($this->input->post('COCno')) {
			$jsonData = [];
			$id = $this->input->post('COCno');
			$userdata = $this->Coc_Model->getCOCList('row', ['id' => $id]);
			if(!empty($userdata)){
				if($userdata['coc_status'] == '4' || $userdata['coc_status'] == '2'){
					$jsonData['pName']  = $userdata['u_name'];
					$jsonData['pRegNo'] = $userdata['plumberregno'];
					$jsonArray = array("status"=>'1', "message"=>'Plumber Detail', "result"=> $jsonData);
				}else{
					if($userdata['user_id'] == '0'){
						$jsonArray = array("status"=>'1', "message"=>'There is no plumber assigned to this COC.', "result"=> $jsonData);
					}else{
						$jsonArray = array("status"=>'1', "message"=>'Error: plumber cannot be found', "result"=> $jsonData);
					}
				}
			}else{
				$jsonArray = array("status"=>'1', "message"=>'There is no COC with the number '.$id, "result"=> $jsonData);
			}
		}else{
			$jsonArray = array("status"=>'0', "message"=>'Invalid API', "result"=> []);
		}
		echo json_encode($jsonArray);
	}

}