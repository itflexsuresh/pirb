<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Import extends CC_Controller {
  
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
		$this->load->model('Company_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Resellers_Model');
		$this->load->model('Documentsletters_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Subtype_Model');
		$this->load->model('Reportlisting_Model');
		$this->load->model('Noncompliancelisting_Model');
		$this->load->model('CC_Model');
		$this->load->model('Auditor_Model');
	}

    public function timezone()
	{
		echo date('Y-m-d H:i:s');
	}
	
    public function checkmail()
	{
		$subject 	= 	'Email Verification';
		$message 	= 	'<div>Hi,</div>

						<div>Please Click the below link to verify your account.</div>
						<div><a href="'.base_url().'login/verification/1">Click Here</a></div>
						<br>
						<div>Best Regards</div>
						<br>
						<div>Lea Smith</div>
						Chairman of the PIRB';
	
		$this->CC_Model->sentMail('itflexsolutions@pirb.co.za', $subject, $message);
	}
	/*
    public function province()
	{
		$data = $this->db->get('importprovince')->result_array();

		foreach ($data as $value) {
			
			$result  	= 	[
								'id' 		=> $value['ID'],
								'name' 		=> $value['Name'],
								'status' 	=> '1'
							];
				
			$this->db->insert('province', $result);			
		}
    }
	
    public function city()
	{
		$datetime 	= date('Y-m-d H:i:s');
		$userid		= $this->getUserID();
		
		$data 		= $this->db->get('importcity')->result_array();
		
		foreach ($data as $value) {
			
			$result  	= 	[
								'id' 				=> $value['ID'],
								'province_id' 		=> $value['ProvinceID'],
								'name' 				=> $value['Name'],
								'code' 				=> $value['Code'],
								'status' 			=> '1',
								'created_at' 		=> $datetime,
								'created_by' 		=> $userid,
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
				
			$this->db->insert('city', $result);			
		}
    }
	
    public function suburb()
	{
		$datetime 	= date('Y-m-d H:i:s');
		$userid		= $this->getUserID();
		
		$data 		= $this->db->get('importsuburb')->result_array();
		
		foreach ($data as $value) {
			
			$result  	= 	[
								'id' 				=> $value['SuburbID'],
								'province_id' 		=> $value['ProvinceID'],
								'city_id' 			=> $value['CityID'],
								'name' 				=> $value['Name'],
								'status' 			=> $value['isActive'],
								'created_at' 		=> $datetime,
								'created_by' 		=> $userid,
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
				
			$this->db->insert('suburb', $result);			
		}
    }
	*/
	
	public function province()
	{
		$file 	= './assets/import/pcs.xls';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		
		foreach($datas as $key => $data){
			
			$checkProvince = $this->db->get_where('province', ['name' => $data[2]])->row_array();
			
			if(!$checkProvince){
				$this->db->insert('province', ['name' => $data[2], 'status' => '1']);
			}
		}
    }
	
	public function city()
	{
		$file 	= './assets/import/pcs.xls';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		
		foreach($datas as $key => $data){			
			$getProvince = $this->db->get_where('province', ['name' => $data[2]])->row_array();
			
			$checkCity = $this->db->get_where('city', ['name' => $data[1], 'province_id' => $getProvince['id']])->row_array();
			
			if(!$checkCity){
				$citydata = [
					'province_id' 		=> $getProvince['id'],
					'name' 				=> $data[1],
					'status'			=> '1',
					'created_at'		=> date('Y-m-d H:i:s'),
					'created_by'		=> '1',
					'updated_at'		=> date('Y-m-d H:i:s'),
					'updated_by'		=> '1'
				];
				
				$this->db->insert('city', $citydata);
			}
		}
    }
	
	public function suburb()
	{
		$file 	= './assets/import/pcs.xls';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		
		foreach($datas as $key => $data){
			$getProvince 	= $this->db->get_where('province', ['name' => $data[2]])->row_array();
			$getCity 		= $this->db->get_where('city', ['name' => $data[1]])->row_array();
				
			$checkSuburb = $this->db->get_where('suburb', ['name' => $data[0], 'province_id' => $getProvince['id'], 'city_id' => $getCity['id']])->row_array();
			
			if(!$checkSuburb){
				$citydata = [
					'province_id' 		=> $getProvince['id'],
					'city_id' 			=> $getCity['id'],
					'name' 				=> $data[0],
					'status'			=> '1',
					'created_at'		=> date('Y-m-d H:i:s'),
					'created_by'		=> '1',
					'updated_at'		=> date('Y-m-d H:i:s'),
					'updated_by'		=> '1'
				];
				
				$this->db->insert('suburb', $citydata);
			}
		}
    }
	
    public function company()
	{
		$datetime 	= date('Y-m-d H:i:s');
		
		$data 		= $this->db->get('importcompany')->result_array();
		
		foreach ($data as $value) {
			if($value['Email']=='') continue;
				
			$user = [
				'id' 				=> '',
				'email' 			=> $value['Email'],
				'password' 			=> '12345678',
				'type'				=> '4',
				'mailstatus'		=> '1',
				'formstatus'		=> '1',
				'status'			=> $value['Active']
			];
			
			$userid = $this->Users_Model->actionUsers($user);
			
			$physicalprovince 	= $this->db->get_where('province', ['name' => $value['ProvinceID']])->row_array();
			$physicalcity 		= $this->db->get_where('city', ['name' => $value['ResidentialCity']])->row_array();
			$physicalsuburb 	= $this->db->get_where('suburb', ['name' => $value['ResidentialSuburb']])->row_array();
			
			$postalcity 		= $this->db->get_where('suburb', ['name' => $value['PostalCity']])->row_array();
			
			$address[0] 	=	[
									'id' 				=> '',
									'address' 			=> $value['ResidentialStreet'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'],
									'city' 				=> ($physicalcity) ? $physicalcity['id'] : $value['ResidentialCity'],
									'suburb' 			=> ($physicalsuburb) ? $physicalsuburb['id'] : $value['ResidentialSuburb'],
									'postal_code' 		=> $value['ResidentialCode'],
									'type' 				=> '1'
								];
							
			$address[1] 	=	[
									'id' 				=> '',
									'address' 			=> $value['PostalAddress'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'], //Extras
									'city' 				=> ($postalcity) ? $postalcity['id'] : $value['PostalCity'],
									'suburb' 			=> ($physicalsuburb) ? $physicalsuburb['id'] : $value['ResidentialSuburb'], //Extras
									'postal_code' 		=> $value['PostalCode'],
									'type' 				=> '2'
								];
							
			$result  	= 	[
								'user_id' 					=> $userid,
								'name' 						=> $value['Name'],
								'reg_no' 					=> $value['RegNo'],
								'contact_person' 			=> $value['PrimaryContact'],
								'work_phone' 				=> $value['BusinessPhone'],
								'mobile_phone' 				=> $value['Fax'],
								'address' 					=> $address,
								'insurancepolicyno' 		=> $value['InsurancePolicyNo'],
								'insurancecompany' 			=> $value['InsuranceCompany'],
								'insurancepolicyholder' 	=> $value['InsurancePolicyHolder'],
								'insurancestartdate' 		=> $value['InsuranceStartDate'],
								'insuranceenddate' 			=> $value['InsuranceEndDate'],
								'status'					=> $value['Active'],
								'approval_status'			=> '1',
								'usersdetailid' 			=> '',
								'userscompanyid' 			=> '',
								'created_at' 				=> $datetime,
								'created_by' 				=> $userid,
								'updated_at' 				=> $datetime,
								'updated_by' 				=> $userid
							];
							
			$this->Company_Model->action($result);		
		}
    }
	
    public function plumber()
	{
		$titlesign		= 	[
								'Mr' 	=> '1',
								'Mrs' 	=> '2',
								'Miss' 	=> '3',
								'Other' => '4'
							];
		
		$designation	= 	[
								'Learner Plumber' 	=> '1',
								'Technical Assistant Practitioner' 	=> '2',
								'Technical Operator Practitioner' 	=> '3',
								'Licensed Plumber' => '4',
								'Qualified Plumber' => '5',
								'Master Plumber' => '6',
								'Director Plumber' => '7',
								'Plumbing Inspector' => '8',
								'Probationary Plumber' => '9',
								'Technical Assisting Practitioner' => '10',
								'Technical Operator Plumber' => '11'
							];
							
		$datetime 	= date('Y-m-d H:i:s');
		
		$data 		= 	$this->db->select('ip.*, pd.Designation')
						->join('importplumberdesignations pd', 'pd.PlumberID=ip.ID', 'left')
						->get('importplumber ip')
						->result_array();

		foreach ($data as $value) {
			$user = [
				'id' 				=> '',
				'email' 			=> 'test'.$value['Email'],
				'password' 			=> $value['PIN'],
				'type'				=> '3',
				'mailstatus'		=> '1',
				'formstatus'		=> '1',
				'status'			=> '1'
			];
			
			$userid = $this->Users_Model->actionUsers($user);
			
			$physicalprovince 	= $this->db->get_where('province', ['name' => $value['ProvinceID']])->row_array();
			$physicalcity 		= $this->db->get_where('city', ['name' => $value['ResidentialCity']])->row_array();
			$physicalsuburb 	= $this->db->get_where('suburb', ['name' => $value['ResidentialSuburb']])->row_array();
			
			$postalcity 		= $this->db->get_where('suburb', ['name' => $value['PostalCity']])->row_array();
			
			$importcompany 		= $this->db->get_where('importcompany', ['id' => $value['CompanyID']])->row_array();
			$company 			= $this->db->get_where('users_detail', ['company' => $importcompany['Name']])->row_array();
			
			$address[0] 	=	[
									'id' 				=> '',
									'address' 			=> $value['ResidentialStreet'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'],
									'city' 				=> ($physicalcity) ? $physicalcity['id'] : $value['ResidentialCity'],
									'suburb' 			=> ($physicalsuburb) ? $physicalsuburb['id'] : $value['ResidentialSuburb'],
									'postal_code' 		=> $value['ResidentialCode'],
									'type' 				=> '1'
								];
							
			$address[1] 	=	[
									'id' 				=> '',
									'address' 			=> $value['PostalAddress'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'], // Extras
									'city' 				=> ($postalcity) ? $postalcity['id'] : $value['PostalCity'],
									'suburb' 			=> ($physicalsuburb) ? $physicalsuburb['id'] : $value['ResidentialSuburb'], // Extras
									'postal_code' 		=> $value['PostalCode'],
									'type' 				=> '2'
								];
					
			// Start Extras
			
			$address[2] 	=	[
									'id' 				=> '',
									'address' 			=> $value['ResidentialStreet'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'],
									'city' 				=> ($physicalcity) ? $physicalcity['id'] : $value['ResidentialCity'],
									'suburb' 			=> ($physicalsuburb) ? $physicalsuburb['id'] : $value['ResidentialSuburb'],
									'postal_code' 		=> $value['ResidentialCode'],
									'type' 				=> '3'
								];
			// End Extras
			
			$result  	= 	[
								'user_id' 					=> $userid,
								'title' 					=> isset($titlesign[$value['Title']]) ? $titlesign[$value['Title']] : '',
								'name' 						=> $value['FirstName'],
								'surname' 					=> $value['Surname'],
								'dob' 						=> $value['BirthDate'],
								'gender' 					=> $value['GenderID'],
								'home_phone' 				=> '999'.$value['HomePhone'],
								'mobile_phone' 				=> '999'.$value['MobilePhone'],
								'work_phone' 				=> '999'.$value['BusinessPhone'],
								'racial' 					=> $value['EquityID'],
								'nationality' 				=> $value['NationalityID'],
								'othernationality' 			=> $value['AlternativeIDTypeID'],
								'idcard' 					=> $value['IdNo'],
								'otheridcard' 				=> $value['AlternateID'],
								'homelanguage' 				=> $value['LanguageID'],
								'disability' 				=> $value['DisabilityStatusID'],
								'citizen' 					=> $value['CitizenResidentStatusID'],
								'employment_details' 		=> $value['SocioeconomicStatusID'],
								'company_details' 			=> $company ? $company['id'] : '',
								'insurancepolicyno' 		=> $value['InsurancePolicyNo'],
								'insurancecompany' 			=> $value['InsuranceCompany'],
								'insurancepolicyholder' 	=> $value['InsurancePolicyHolder'],
								'insurancestartdate' 		=> $value['InsuranceStartDate'],
								'insuranceenddate' 			=> $value['InsuranceEndDate'],
								'status'					=> '1',
								'customregno'				=> $value['RegNo'],
								'registration_date'			=> $value['RegistrationStart'],
								'expirydate'				=> $value['ExpiryNotificationDate'],
								'application_received'		=> $value['DateCreated'],
								'designation'				=> isset($designation[$value['Designation']]) ? $designation[$value['Designation']] : '',
								'approval_status'			=> '1',
								'usersdetailid'				=> '',
								'usersplumberid'			=> '',
								'registration_card'			=> '2',
								'company_name'				=> $value['FirstName'].' '.$value['Surname'],
								'address' 					=> $address,
								'migrateid' 				=> $value['ID'],
								'created_at' 				=> $datetime,
								'created_by' 				=> $userid,
								'updated_at' 				=> $datetime,
								'updated_by' 				=> $userid
							];
							
			$this->Plumber_Model->action($result);	
		}
    }
	
    public function plumberimage($id, $userid)
	{
		$sourceimg 			= './assets/plumbermigration/'.$id.'_7.*';
		$checkimg			= glob($sourceimg);  
		
		if(count($checkimg) && isset($checkimg[0])){
			$destinationimg 	= './assets/uploads/plumber/'.$userid.'/';
			$this->CC_Model->createDirectory($destinationimg);
			
			$explodeimg1 = explode('/', $checkimg[0]);
			$explodeimg2 = explode('.', $explodeimg1[count($explodeimg1)-1]);
			$image2 = md5($explodeimg2[0]).'.'.$explodeimg2[1];
			rename($checkimg[0], $destinationimg.$image2);
		}else{
			$image2 = '';
		}
		
		return $image2;
	}
	
	public function plumberimageupdate()
	{
		$plumbers 	= $this->db->get_where('users', ['type' => '3', 'migrateid !=' => ''])->result_array();
		
		foreach($plumbers as $plumber){
			$migrateid 	= $plumber['migrateid'];
			$userid		= $plumber['id'];
			
			$data = [
						'file2' => $this->plumberimage($migrateid, $userid)
					];
			
			$this->db->update('users_detail', $data, ['user_id' => $userid]);
		}
	}
	
	public function plumberimagerename()
	{
		$path = './assets/plumbermigration/';
		
		$this->load->helper('directory');
		$files = directory_map($path);
		
		foreach($files as $file){
			$explodefile = explode('_', $file);
			if(isset($explodefile[0])){
				unset($explodefile[0]);
				$name = implode('_', $explodefile);
				rename($path.$file, $path.$name);
			}
			
		}
	}
	
	public function plumberimagefolder()
	{
		$this->load->helper('directory');
		
		for($i=64; $i<1000000; $i++){
			$dir = 'assets/uploads/plumber/'.$i;
			$del = './assets/uploads/plumber/'.$i.'/';
			
			if(is_dir($dir)){
				$files = directory_map($del);
				foreach($files as $file){
					unlink($dir.'/'.$file);
				}
				rmdir($del);
			}
		}
	}
	
    public function plumberdocument()
	{
		$plumbers 	= $this->db->get_where('users', ['type' => '3', 'migrateid !=' => ''])->result_array();
		
		foreach($plumbers as $plumber){
			$migrateid 	= $plumber['migrateid'];
			$userid		= $plumber['id'];
			for($i=1; $i<3; $i++){
				$sourcefile 		= './assets/plumbermigration/'.$migrateid.'_'.$i.'.*';
				$checkfile			= glob($sourcefile);  
				
				if(count($checkfile) && isset($checkfile[0])){
					$destinationimg 	= './assets/uploads/plumber/'.$userid.'/';
					$this->CC_Model->createDirectory($destinationimg);
					
					$explode1 	= explode('/', $checkfile[0]);
					$explode2 	= explode('.', $explode1[count($explode1)-1]);
					$file 		= md5($explode2[0]).'.'.$explode2[1];
					rename($checkfile[0], $destinationimg.$file);
					
					$data = [
						'file1' 		=> $file,
						'plumberid' 	=> $userid,
						'documentsid' 	=> ''
					];
					
					$this->Documentsletters_Model->action($data);
				}
			}
		}
	}
	
	public function updategender()
	{
		$file 	= './assets/import/gender.xlsx';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		
		foreach($datas as $key => $data){
			
			$checkUser = $this->db->get_where('users', ['email' => 'test'.$data[5]])->row_array();
			
			if($checkUser){
				$this->db->update('users_detail', ['gender' => '2'], ['user_id' => $checkUser['id']]);
			}
		}
	}
	
    public function resellers()
	{
		$datetime 	= date('Y-m-d H:i:s');
		
		$data 		= $this->db->get('importreseller')->result_array();
		
		foreach ($data as $value) {
			$physicalprovince 	= $this->db->get_where('province', ['name' => $value['ProvinceID']])->row_array();
			$physicalcity 		= $this->db->get_where('city', ['name' => $value['BusinessCity']])->row_array();
			$postalcity 		= $this->db->get_where('suburb', ['name' => $value['PostalCity']])->row_array();
			
			$address[0] 	=	[
									'id' 				=> '',
									'address' 			=> $value['BusinessAddressLine1'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'],
									'city' 				=> ($physicalcity) ? $physicalcity['id'] : $value['BusinessCity'],
									'suburb' 			=> '',
									'postal_code' 		=> $value['BusinessCode'],
									'type' 				=> '1'
								];
							
			$address[1] 	=	[
									'id' 				=> '',
									'address' 			=> $value['PostalAddress'],
									'province' 			=> ($physicalprovince) ? $physicalprovince['id'] : $value['ProvinceID'], // Extras
									'city' 				=> ($postalcity) ? $postalcity['id'] : $value['PostalCity'],
									'suburb' 			=> '', // Extras
									'postal_code' 		=> $value['PostalCode'],
									'type' 				=> '2'
								];
				
			$result  	= 	[
								'company' 					=> $value['CompanyName'],
								'name' 						=> $value['ContactName'],
								'surname' 					=> $value['ContactSurname'],
								'work_phone' 				=> '999'.$value['BusinessPhone'],
								'mobile_phone' 				=> '999'.$value['ContactMobilePhone'],
								'email' 					=> 'test'.$value['Email'],
								'password' 					=> $value['Password'],
								'company_name' 				=> $value['Username'],
								'reg_no' 					=> $value['CompanyRegNo'],
								'vat_no' 					=> $value['VatRegNo'],
								'status' 					=> $value['Active'],
								'address' 					=> $address,
								'coc_purchase_limit' 		=> '50',
								'coccountid' 				=> '',
								'usersid' 					=> '',
								'usersdetailid' 			=> ''
							];
							
			$this->Resellers_Model->action($result);		
		}
    }
	
	public function resellerscoc()
	{
		$file 	= './assets/import/resellerscoc.xlsx';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		
		foreach($datas as $key => $data){
			$name 		= trim($data[0]);
			$coc 		= trim($data[1]);
			$created 	= date('Y-m-d', strtotime(trim($data[2])));
			
			$getUser = $this->db->get_where('users_detail', ['trim(company)' => $name])->row_array();
			
			if($getUser){
				$userid = $getUser['user_id'];
				
				$stock = [
					'user_id' 		=> $userid,
					'coc_status' 	=> '3',
					'type' 			=> '2',
					'purchased_at' 	=> $created,
				];
				
				$checkCOC = $this->db->get_where('stock_management', ['id' => $coc])->row_array();
				if($checkCOC){
					$this->db->update('stock_management', $stock, ['id' => $coc]);
				}else{
					$stock['id'] = $coc;
					$this->db->insert('stock_management', $stock);
				}
				
				$this->db->update('coc_count',['count' => 'count - 1'], ['user_id' => $userid]); 
			}
		}
		
    }
	
    public function auditor()
	{
		$file 	= './assets/import/auditor.xlsx';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		
		$area =  	[
						[
							'province' 		=> '3',
							'city' 			=> '159',
							'suburb' 		=> '19745',
							'id' 			=> ''
						]
					];
															   
		foreach ($datas as $data) {
			$result  	= 	[
								'name' 						=> $data[2],
								'surname' 					=> $data[3],
								'idno' 						=> $data[4],
								'email' 					=> 'test'.$data[6],
								'password' 					=> $data[7],
								'work_phone' 				=> '999'.$data[8],
								'mobile_phone' 				=> '999'.$data[9],
								'company_name' 				=> $data[10],
								'reg_no' 					=> $data[11],
								'vat_no' 					=> $data[12],
								'vat_vendor' 				=> ($data[12]!='') ? '1' : '0',
								'bank_name' 				=> $data[20],
								'account_name' 				=> $data[21],
								'account_no' 				=> $data[22],
								'branch_code' 				=> $data[23],
								'account_type' 				=> $data[24],
								'status' 					=> '1',
								'allowed' 					=> '50',
								'auditstatus' 				=> '1',
								'address' 					=> '164 Ruimte road',
								'province' 					=> '3',
								'city' 						=> '159',
								'suburb' 					=> '19745',
								'postal_code' 				=> '0012',
								'area' 						=> $area,
								'id' 						=> '',
								'auditoravaid' 				=> '',
								'userdetailid' 				=> '',
								'useraddressid' 			=> '',
								'userbankid' 				=> ''
							];
						
			$this->Auditor_Model->action($result);		
		}
    }
	
	public function reportlisting()
	{
		$file 	= './assets/import/reportlisting.xlsx';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		
		$installtiontypes 	= array_unique(array_column($datas, 0));
		foreach($installtiontypes as $key => $data){
			$installationaction = $this->Installationtype_Model->getList('row', ['name' => $data, 'status' => ['0', '1']]);
			if(!$installationaction){
				$this->Installationtype_Model->action(['id' => '', 'name' => $data, 'status' => '1']);
			}
		}
		
		foreach($datas as $key => $data){
			$installation 	= $this->Installationtype_Model->getList('row', ['name' => $data[0], 'status' => ['0', '1']]);
			$installationid = $installation['id'];
			
			$subtypeaction 	= $this->Subtype_Model->getList('row', ['name' => $data[1], 'installationtypeid' => $installationid, 'status' => ['0', '1']]);
			if($subtypeaction){
				$subtypeid = $subtypeaction['id'];
			}else{
				$subtypeid = $this->Subtype_Model->action(['id' => '', 'name' => $data[1], 'installationtype_id' => $installationid, 'status' => '1']);
			}
			
			$reportdatas = [
				'id' 				=> '',
				'installation' 		=> $installationid,
				'subtype' 			=> $subtypeid,
				'statement' 		=> $data[2],
				'comment' 			=> $data[3],
				'regulation' 		=> $data[4],
				'knowledge' 		=> $data[5],
				'refix_in'			=> $data[6],
				'refix_complete'	=> $data[7],
				'caution'	 		=> $data[8],
				'compliment' 		=> $data[9],
				'status'			=> '1'
			];
			
			$this->Reportlisting_Model->action($reportdatas);
		}
	}
	
	public function noncompliancelisting()
	{
		$file 	= './assets/import/noncompliancelisting.xlsx';
		$type 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($type);
		$spreadsheet = $reader->load($file);
		
		$datas 	= $spreadsheet->getActiveSheet()->toArray();
		unset($datas[0]);
		unset($datas[1]);
		unset($datas[2]);
		
		$installtiontypes 	= array_unique(array_column($datas, 0));
		foreach($installtiontypes as $key => $data){
			$installationaction = $this->Installationtype_Model->getList('row', ['name' => $data, 'status' => ['0', '1']]);
			if(!$installationaction){
				$this->Installationtype_Model->action(['id' => '', 'name' => $data, 'status' => '1']);
			}
		}
		
		foreach($datas as $key => $data){
			$installation 	= $this->Installationtype_Model->getList('row', ['name' => $data[0], 'status' => ['0', '1']]);
			$installationid = $installation['id'];
			
			$subtypeaction 	= $this->Subtype_Model->getList('row', ['name' => $data[1], 'installationtypeid' => $installationid, 'status' => ['0', '1']]);
			if($subtypeaction){
				$subtypeid = $subtypeaction['id'];
			}else{
				$subtypeid = $this->Subtype_Model->action(['id' => '', 'name' => $data[1], 'installationtype_id' => $installationid, 'status' => '1']);
			}
			
			$statementlist 	= $this->Reportlisting_Model->getList('row', ['name' => $data[2], 'reference' => $data[4], 'installationtypeid' => $installationid, 'subtypeid' => $subtypeid, 'status' => ['0', '1']]);
			if($statementlist){
				$statementid 	= $statementlist['id'];
			}else{
				$statementlist 	= $this->Reportlisting_Model->getList('row', ['name' => $data[2], 'installationtypeid' => $installationid, 'subtypeid' => $subtypeid, 'status' => ['0', '1']]);
				$statementid 	= ($statementlist) ? $statementlist['id'] : '';
			}
			
			$reportdatas = [
				'id' 				=> '',
				'installationtype' 	=> $installationid,
				'subtype' 			=> $subtypeid,
				'statement' 		=> $statementid,
				'details' 			=> $data[3],
				'reference' 		=> $data[4],
				'action' 			=> $data[5],
				'status'			=> '1'
			];
			
			$this->Noncompliancelisting_Model->action($reportdatas);
		}
	}
	
	public function citysuburb(){
		
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("assets/import/citysuburb.xlsx");
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'User');
		$sheet->setCellValue('B1', 'Email');
		$sheet->setCellValue('C1', 'Type');
		$sheet->setCellValue('D1', 'City'); 
		$sheet->setCellValue('E1', 'Suburb'); 

		$cityarray = [
			'Amalinda, East London' 				=> 'East London',
			'Ashley, Pinetown' 						=> 'Pinetown',
			'Amazimtoti' 							=> 'Amanzimtoti',
			'Bela - Bela' 							=> 'Bela-Bela',
			'Bela Bela' 							=> 'Bela-Bela',
			'Betlhehem' 							=> 'Bethlehem',
			'Britz' 								=> 'Brits',
			'Bronkhostspruit' 						=> 'Bronkhorstspruit',
			'Burgersford' 							=> 'Burgersfort',
			'Burgersfort.Limpopo' 					=> 'Burgersfort',
			'Capetown' 								=> 'Cape Town',
			'East Londen' 							=> 'East London',
			'Empamgeni' 							=> 'Empangeni',
			'Germinston' 							=> 'Germiston',
			'Graaff-Reinet' 						=> 'Graaff Reinet',
			'Groblersdaal' 							=> 'Groblersdal',
			'Jeffreys Bay' 							=> 'Jeffrey\'s Bay',
			'JeffreysBay' 							=> 'Jeffrey\'s Bay',
			'Johanusburg' 							=> 'Johannesburg',
			'Kimberly' 								=> 'Kimberley',
			'King Williams Town' 					=> 'King William\'s Town',
			'Krugerdorp' 							=> 'Krugersdorp',
			'Kuilsriver' 							=> 'Kuils River',
			'Kuilsrivier' 							=> 'Kuils River',
			'Middelburg' 							=> 'Middleburg',
			'Mooi River' 							=> 'Mooi Rivier',
			'Pietermaritsburg' 						=> 'Pietermaritzburg',
			'Pietermaritzburg(Kwazulu Natal)' 		=> 'Pietermaritzburg',
			'Plettenbergbay' 						=> 'Plettenberg bay',
			'Plettenburg Bay' 						=> 'Plettenberg bay',
			'Pletternberg bay' 						=> 'Plettenberg bay',
			'Ranburg' 								=> 'Randburg',
			'Riversdal' 							=> 'Riversdale',
			'Thohoyadou' 							=> 'Thohoyandou',
			'Pietermaritsburg' 						=> 'Pietermaritzburg',
			'Pietermaritzburg(Kwazulu Natal)' 		=> 'Pietermaritzburg',
			'Port Sphepstone' 						=> 'Port Shepstone',
			'Portshepstone' 						=> 'Port Shepstone'
		];
		
		$suburbarray = [
			'Albermarle' 							=> 'Albemarle',
			'Albertsdale' 							=> 'Albertsdal',
			'Amanzintoti' 							=> 'Amanzimtoti',
			'Anlin' 								=> 'Annlin',
			'Arconpark' 							=> 'Arcon Park',
			'118 Die Hoewes' 						=> 'Die Hoewes',
			'2 Garden Crescent,The Wolds'			=> 'The Wolds',
			'4 Diepkloof' 							=> 'Diepkloof',
			'625 Gezina' 							=> 'Gezina',
			'Albermarle'						 	=> 'Albemarle',
			'Ashley, Pinetown' 						=> 'Ashley',
			'Avairy Hill' 							=> 'Aviary Hill',
			'Bayview,Chatsworth' 					=> 'Bayview',
			'Belverdere' 							=> 'Belvedere',
			'Birds Wood' 							=> 'Birdwood',
			'Birdswood' 							=> 'Birdwood',
			'Bo Dorp' 								=> 'Bodorp',
			'Bo-Dorp' 								=> 'Bodorp',
			'Boiatong' 								=> 'Boitekong',
			'Bonanng' 								=> 'Bonanne',
			'Boston,Bellville' 						=> 'Boston',
			'Bridgetown, Athlone' 					=> 'Bridgetown',
			'Bucchleuch' 							=> 'Buccleuch',
			'Bucclevch' 							=> 'Buccleuch',
			'Buccluech' 							=> 'Buccleuch',
			'Chroompark' 							=> 'Chroom Park',
			'Club View' 							=> 'Clubview',
			"Colorado,Mitchell's plain" 			=> 'Colorado',
			'Cosmocity' 							=> 'Cosmo City',
			'Crestholme, Waterfall,' 				=> 'Crestholme',
			'De Tuin,Brackenfell' 					=> 'De Tuin',
			'Delville,Germiston' 					=> 'Delville',
			'Denne-Oord' 							=> 'Denneoord',
			'Discovery,Roodeport' 					=> 'Discovery',
			'Eindhoven, Delft' 						=> 'Eindhoven',
			'Farramere, Delft' 						=> 'Farrarmere',
			'Ferndale, Brackenfell' 				=> 'Ferndale',
			'Four Ways' 							=> 'Fourways',
			'Framsby' 								=> 'Framesby',
			'Grobler Park' 							=> 'Groblerpark',
			'Groblers Park' 						=> 'Groblerpark',
			'Groenvallei,Bellville' 				=> 'Groenvallei',
			'Hospital Park' 						=> 'Hospitaalpark',
			'Jukskeipark' 							=> 'Jukskei Park',
			'Jukskie Park' 							=> 'Jukskei Park',
			'Kilnerpark' 							=> 'Kilner Park',
			'Kirstenhoff' 							=> 'Kirstenhof',
			'Klipportjie' 							=> 'Klippoortjie',
			'Lansdown' 								=> 'Lansdowne',
			'Louwrille' 							=> 'Louwville',
			'Lytelton' 								=> 'Lyttelton',
			'Lyttleton' 							=> 'Lyttelton',
			'Montford, Chatswoth' 					=> 'Montford',
			'Montford,Chatsworth' 					=> 'Montford',
			'Myburg Park' 							=> 'Myburgh Park',
			'Northdene,Queensburg' 					=> 'Northdene',
			'Oos Einde' 							=> 'Oos-uinde',
			'Orlando East,Soweto' 					=> 'Orlando East',
			'Phillipi' 								=> 'Philippi',
			'Primerose' 							=> 'Primrose',
			'Robinhills,Randburg' 					=> 'Robin Hills',
			"Rocklands Mitchell's Plain" 			=> 'Rocklands',
			"Rocklands,Mitchell's Plain" 			=> 'Rocklands',
			'Silverglade,Fish Hoek' 				=> 'Silverglade',
			'Sinoville, Pretoria' 					=> 'Sinoville',
			"Strandfontein,Mitchell's Plain" 		=> 'Strandfontein',
			'Suiderood' 							=> 'Suideroord',
			'Thembalcthu' 							=> 'Thembalethu',
			'Uvango' 								=> 'Uvongo',
			'Valhalha' 								=> 'Valhalla',
			'Valhalla,Centurion' 					=> 'Valhalla',
			'Villeria' 								=> 'Villieria',
			'Warner Beach,Kingsway' 				=> 'Warner Beach',
			'Waverly' 								=> 'Waverley',
			'Weavindpark' 							=> 'Weavind Park'
		];
		
		$addressdata = $this->db->select('ua.*, concat(ud.name, " ", ud.surname) as name, u.email, u.type as usertype')
		->from('users_address ua')
		->join('users_detail ud', 'ud.user_id=ua.user_id', 'left')
		->join('users u', 'u.id=ua.user_id', 'left')
		->get()
		->result_array();
		
		$i=2;
		foreach($addressdata as $key1 => $data)
		{
			$iddata 		= $data['id'];
			$citydata 		= trim($data['city']);
			$suburbdata 	= trim($data['suburb']);
			$cityexcel 		= '';
			$suburbexcel 	= '';
			
			if (!is_numeric($citydata)){
				$city = isset($cityarray[$citydata]) ? $cityarray[$citydata] : $citydata;
				
				$cityresult = $this->db->get_where('city', ['name' => $city])->row_array();
				if($cityresult){
					$this->db->update('users_address', ['city' => $cityresult['id']], ['id' => $iddata]);
				}else{
					$cityexcel = $citydata;
				}
			}
			
			if (!is_numeric($suburbdata)){
				$suburb = isset($suburbarray[$suburbdata]) ? $suburbarray[$suburbdata] : $suburbdata;
				
				$suburbresult = $this->db->get_where('suburb', ['name' => $suburb])->row_array();
				if($suburbresult){
					$this->db->update('users_address', ['suburb' => $suburbresult['id']], ['id' => $iddata]);
				}else{
					$suburbexcel = $suburbdata;
				}
			}
			
			if($cityexcel!='' || $suburbexcel!=''){
				$sheet->setCellValue('A'.$i, $data['name']);
				$sheet->setCellValue('B'.$i, $data['email']);
				$sheet->setCellValue('C'.$i, $this->config->item('usertype2')[$data['usertype']]);
				$sheet->setCellValue('D'.$i, $cityexcel);
				$sheet->setCellValue('E'.$i, $suburbexcel);
				$i++;
			}
		}
		
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->save("assets/import/citysuburb.xlsx");
	}
}