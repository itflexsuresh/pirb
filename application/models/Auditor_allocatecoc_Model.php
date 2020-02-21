<?php

class Auditor_allocatecoc_Model extends CC_Model
{

	public function getList($type, $requestdata=[])
	{ 
		$users 			= 	[ 
								'u.id','u.email','u.formstatus','u.type','u.status' 
							];
		$usersdetail 	= 	[ 
								'ud.id as usersdetailid','ud.title','ud.name','ud.surname','ud.dob','ud.gender','ud.company_name','ud.reg_no','ud.vat_no','ud.contact_person','ud.home_phone','ud.mobile_phone','ud.mobile_phone2','ud.work_phone','ud.email2','ud.file1','ud.file2','ud.coc_purchase_limit','ud.specialisations','ud.status as plumberstatus'
							];
		$usersplumber 	= 	[ 
								'up.id as usersplumberid','up.racial','up.nationality','up.othernationality','up.idcard','up.otheridcard','up.homelanguage','up.disability','up.citizen','up.registration_card','up.delivery_card','up.employment_details','up.company_details',
								'up.registration_no','up.registration_date','up.designation','up.qualification_year','up.coc_electronic','up.message',
								'up.application_received','up.application_status','up.approval_status','up.reject_reason','up.reject_reason_other','up.otp'
							];

		$companyname	= 	[ 
								'c.company_name as companyname' 
							];
		
		$this->db->select('
			'.implode(',', $users).',
			'.implode(',', $usersdetail).',
			'.implode(',', $usersplumber).',
			'.implode(',', $companyname).',
			concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress,
			concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress,
			concat_ws("@-@", ua3.id, ua3.user_id, ua3.address, ua3.suburb, ua3.city, ua3.province, ua3.postal_code, ua3.type)  as billingaddress,
			group_concat(concat_ws("@@@", ups.id, ups.user_id, ups.date, ups.certificate, ups.skills, ups.training, ups.attachment, qr.name) separator "@-@") as skills, t5.name as postal_city, t6.name as postal_province
		');
		$this->db->from('coc_log t1');
		$this->db->join('users u', 't1.created_by=u.id', 'left');
		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');
		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');
		$this->db->join('users_plumber up', 'up.user_id=u.id', 'left');
		$this->db->join('users_plumber_skill ups', 'ups.user_id=u.id', 'left');
		$this->db->join('qualificationroute qr', 'qr.id=ups.skills', 'left'); 
		$this->db->join('users_detail c', 'c.id=up.company_details', 'left');
		$this->db->join('city t5', 'ua2.city=t5.id','left');				
		$this->db->join('province t6', 'ua2.province=t6.id','left');				
		$this->db->join('stock_management t7', 't7.id=t1.coc_id','inner');				
				
		$this->db->where('t7.auditorid',0);
		$this->db->where('t7.coc_status','2');

		if(isset($requestdata['user_id']) && $requestdata['user_id']!='')		$this->db->where('u.id', $requestdata['user_id']);
		if(isset($requestdata['start_coc_range']) && $requestdata['start_coc_range']!='')		$this->db->where('t1.coc_id>=', $requestdata['start_coc_range']);
		if(isset($requestdata['end_coc_range']) && $requestdata['end_coc_range']!='') 		$this->db->where('t1.coc_id<=', $requestdata['end_coc_range']);
		if(isset($requestdata['start_date_range']) && $requestdata['start_date_range']!='') 	$this->db->where('t1.log_date >=', date('Y-m-d', strtotime($requestdata['start_date_range'])));
		if(isset($requestdata['end_date_range']) && $requestdata['end_date_range']!='') 		$this->db->where('t1.log_date <=', date('Y-m-d', strtotime($requestdata['end_date_range'])));
		// if((isset($requestdata['start_date_range']) && $requestdata['start_date_range']!='') && (isset($requestdata['end_date_range']) && $requestdata['end_date_range']!='')) {
		// 	$this->db->where('t1.log_date >=', date('Y-m-d', strtotime($requestdata['start_date_range'])));
		// 	$this->db->where('t1.log_date <=', date('Y-m-d', strtotime($requestdata['end_date_range'])));
		// }	
		if(isset($requestdata['city']) && $requestdata['city']>0) 				$this->db->where('t1.city', $requestdata['city']);
		if(isset($requestdata['province']) && $requestdata['province']>0 ) 			$this->db->where('t1.province', $requestdata['province']);
		if(isset($requestdata['type'])) 				$this->db->where('u.type', $requestdata['type']);
		if(isset($requestdata['formstatus']))			$this->db->where_in('u.formstatus', $requestdata['formstatus']);
		if(isset($requestdata['status']))				$this->db->where_in('u.status', $requestdata['status']);
		if(isset($requestdata['approvalstatus']))		$this->db->where_in('up.approval_status', $requestdata['approvalstatus']);
		if(isset($requestdata['plumberstatus']))		$this->db->where_in('ud.status', $requestdata['plumberstatus']);
		if(isset($requestdata['searchregno']))			$this->db->like('up.registration_no', $requestdata['searchregno']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['u.id', 'ud.name'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('ud.name', $searchvalue);
		}
		
		if(isset($requestdata['customsearch'])){
			if($requestdata['customsearch']=='listsearch1'){
				if(isset($requestdata['search_reg_no']) && $requestdata['search_reg_no']!='') $this->db->like('up.registration_no', $requestdata['search_reg_no']);
				if(isset($requestdata['search_plumberstatus']) && $requestdata['search_plumberstatus']!='') $this->db->like('up.status', $requestdata['search_plumberstatus']);
				if(isset($requestdata['search_idcard']) && $requestdata['search_idcard']!='') $this->db->like('up.idcard', $requestdata['search_idcard']);
				if(isset($requestdata['search_mobile_phone']) && $requestdata['search_mobile_phone']!='') $this->db->like('ud.mobile_phone', $requestdata['search_mobile_phone']);
				if(isset($requestdata['search_dob']) && $requestdata['search_dob']!='') $this->db->like('ud.dob', date('Y-m-d', strtotime($requestdata['search_dob'])));
				if(isset($requestdata['search_company_details']) && $requestdata['search_company_details']!='') $this->db->like('up.company_details', $requestdata['search_company_details']);
			}
			elseif($requestdata['customsearch']=='listsearch2'){
				if(isset($requestdata['name'])|| $requestdata['surname']!='') {
					$this->db->like('ud.name', $requestdata['name']);
					$this->db->or_like('ud.surname', $requestdata['surname']);
				}
			}
		}
		
		$this->db->group_by('u.id');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getCOCList($type, $requestdata=[])
	{ 
		
		$this->db->select('t5.name as postal_city, t6.name as postal_province, t7.name as postal_suburb, coc_id, t1.installationtype, t1.specialisations');

		$this->db->from('coc_log t1');
		$this->db->join('users u', 't1.created_by=u.id', 'left');
		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');
		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');
		$this->db->join('users_plumber up', 'up.user_id=u.id', 'left');
		$this->db->join('users_plumber_skill ups', 'ups.user_id=u.id', 'left');
		$this->db->join('qualificationroute qr', 'qr.id=ups.skills', 'left'); 
		$this->db->join('users_detail c', 'c.id=up.company_details', 'left');
		$this->db->join('city t5', 't1.city=t5.id','left');				
		$this->db->join('province t6', 't1.province=t6.id','left');				
		$this->db->join('suburb t7', 't1.suburb=t7.id','left');				
		$this->db->join('stock_management t8', 't8.id=t1.coc_id','inner');	

		$this->db->where('t8.auditorid',0);
		$this->db->where('t8.coc_status','2');				
		
		if(isset($requestdata['user_id'])) 				$this->db->where('u.id', $requestdata['user_id']);
		if(isset($requestdata['start_coc_range']) && $requestdata['start_coc_range']!='')		$this->db->where('t1.coc_id>=', $requestdata['start_coc_range']);
		if(isset($requestdata['end_coc_range']) && $requestdata['end_coc_range']!='') 		$this->db->where('t1.coc_id<=', $requestdata['end_coc_range']);
		if(isset($requestdata['start_date_range']) && $requestdata['start_date_range']!='') 	$this->db->where('t1.log_date >=', date('Y-m-d', strtotime($requestdata['start_date_range'])));
		if(isset($requestdata['end_date_range']) && $requestdata['end_date_range']!='') 		$this->db->where('t1.log_date <=', date('Y-m-d', strtotime($requestdata['end_date_range'])));

		if(isset($requestdata['city']) && $requestdata['city']>0) 				$this->db->where('t1.city', $requestdata['city']);
		if(isset($requestdata['province']) && $requestdata['province']>0 ) 			$this->db->where('t1.province', $requestdata['province']);

		if(isset($requestdata['type'])) 				$this->db->where('u.type', $requestdata['type']);
		if(isset($requestdata['formstatus']))			$this->db->where_in('u.formstatus', $requestdata['formstatus']);
		if(isset($requestdata['status']))				$this->db->where_in('u.status', $requestdata['status']);
		if(isset($requestdata['approvalstatus']))		$this->db->where_in('up.approval_status', $requestdata['approvalstatus']);
		if(isset($requestdata['plumberstatus']))		$this->db->where_in('ud.status', $requestdata['plumberstatus']);
		if(isset($requestdata['searchregno']))			$this->db->like('up.registration_no', $requestdata['searchregno']);
		
		// if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
		// 	$this->db->limit($requestdata['length'], $requestdata['start']);
		// }
		if($type!=='count' && isset($requestdata['max_allocate_plumber']) && $requestdata['max_allocate_plumber']>0){
			$this->db->limit($requestdata['max_allocate_plumber'], 0);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['u.id', 'ud.name'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('ud.name', $searchvalue);
		}
		
		if(isset($requestdata['customsearch'])){
			if($requestdata['customsearch']=='listsearch1'){
				if(isset($requestdata['search_reg_no']) && $requestdata['search_reg_no']!='') $this->db->like('up.registration_no', $requestdata['search_reg_no']);
				if(isset($requestdata['search_plumberstatus']) && $requestdata['search_plumberstatus']!='') $this->db->like('up.status', $requestdata['search_plumberstatus']);
				if(isset($requestdata['search_idcard']) && $requestdata['search_idcard']!='') $this->db->like('up.idcard', $requestdata['search_idcard']);
				if(isset($requestdata['search_mobile_phone']) && $requestdata['search_mobile_phone']!='') $this->db->like('ud.mobile_phone', $requestdata['search_mobile_phone']);
				if(isset($requestdata['search_dob']) && $requestdata['search_dob']!='') $this->db->like('ud.dob', date('Y-m-d', strtotime($requestdata['search_dob'])));
				if(isset($requestdata['search_company_details']) && $requestdata['search_company_details']!='') $this->db->like('up.company_details', $requestdata['search_company_details']);
			}
			elseif($requestdata['customsearch']=='listsearch2'){
				if(isset($requestdata['name'])|| $requestdata['surname']!='') {
					$this->db->like('ud.name', $requestdata['name']);
					$this->db->or_like('ud.surname', $requestdata['surname']);
				}
			}
		}
		
		$this->db->group_by('t1.id');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}

		// if(!empty($result)){
		// 	foreach ($result as $key => &$value) {

		// 		if($value['specialisations']!=''){
		// 			$value['installationtype'] .= ",".$value['specialisations'];
		// 		} 
		// 	}
		// }
		
		return $result;
	}
	
	public function autosearchPlumber($postData){ 
		
		$designations = array('4', '5', '6' );
		$this->db->select('u1.name,u1.surname,u2.id,u1.coc_purchase_limit');
		$this->db->from('users_detail u1');
		$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','inner');
		$this->db->join('users_plumber up', 'up.user_id=u1.user_id','inner');
		$this->db->where_in('up.designation', $designations);
		$this->db->like('u1.name',$postData['search_keyword']);
		// $this->db->or_like('u1.surname',$postData['search_keyword']);
		$this->db->group_by("u1.id");		
		$query = $this->db->get();
		$result1 = $query->result_array(); 

		if (empty($result1)) {
			$this->db->select('u1.name,u1.surname,u2.id,u1.coc_purchase_limit');
			$this->db->from('users_detail u1');
			$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','inner');
			$this->db->join('users_plumber up', 'up.user_id=u1.user_id','inner');
			$this->db->where_in('up.designation', $designations);
			$this->db->like('u1.surname',$postData['search_keyword']);
			$this->db->group_by("u1.id");		
			$query = $this->db->get();
			$result = $query->result_array();
		}
		else{
			$result = $result1;
		}

		// print_r($result);
		// echo $this->db->last_query();

		return $result;

	}

	public function getstockList($type, $requestdata=[]){ 		

		$this->db->select('sm.*,ud.name as name,ud.surname as surname,up.registration_no as registration_no,pa.invoiceno as invoiceno,pd.company_name as company ');
		$this->db->from('stock_management sm');
		$this->db->join('plumberallocate pa', 'pa.stockid=sm.id','left');
		$this->db->join('users_detail ud', 'ud.user_id=sm.user_id','left');
		$this->db->join('users_plumber up', 'up.user_id=sm.user_id','left');
		$this->db->join('users_detail pd', 'pd.id=pa.company_details', 'left');
		$this->db->where('sm.type', '2');
		$this->db->where('sm.coc_status', '3');

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['sm.id','sm.id','sm.id','sm.id','sm.id','sm.id'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower((trim($requestdata['search']['value'])));
			if($searchvalue === 'allocated'){
				$this->db->where('sm.allocatedby',$requestdata['user_id']);
			}
			elseif($searchvalue === 'in stock'){
				$this->db->where('sm.user_id',$requestdata['user_id']);
			}
			else{
				$this->db->like('sm.id', $searchvalue);
				$this->db->or_like('pa.invoiceno', $searchvalue);
				$this->db->or_like('ud.name', $searchvalue);
				$this->db->or_like('ud.surname', $searchvalue);
				$this->db->or_like('up.registration_no', $searchvalue);
				$this->db->or_like('pd.company_name', $searchvalue);
			}
		}
		else{
			$this->db->where('sm.user_id',$requestdata['user_id']);
			$this->db->or_where('sm.allocatedby',$requestdata['user_id']);
		}


		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}		
		return $result;

	}

	public function getqty($type, $requestdata=[])
	{ 
		
		$this->db->select('count as sumqty');
		$this->db->from('coc_count');

		if(isset($requestdata['user_id']))	$this->db->where('user_id', $requestdata['user_id']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getrange($type, $requestdata=[])
	{ 
		
		$this->db->select('*');
		$this->db->from('stock_management');	

		if(isset($requestdata['coc_status']))	$this->db->where('coc_status', $requestdata['coc_status']);
		if(isset($requestdata['type']))	$this->db->where('type', $requestdata['type']);



		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function action($data){

		if(isset($data['auditor_id']))		$requestdata['auditorid'] 		= $data['auditor_id'];	
		$requestdata['audit_status']	=	2;
		$requestdata['allocation_date']	=	date('Y-m-d H:i:s');;
		
		if(isset($requestdata)){			
			$result = $this->db->update('stock_management', $requestdata,['id'=>$data['coc_id']]);
			if($result){
				$plumberdata			= 	$this->userDetails('row', ['user_id' => $data['user_id']]);				
				$auditordata			= 	$this->userDetails('row', ['user_id' => $data['auditor_id']]);				

			 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '20'])->get()->row_array();


			 	 $array1 = ['{Plumbers Name and Surname}','{COC number}', '{Auditors Names and Surname}'];				 

				$array2 = [$plumberdata['name'], $data['coc_id'], $auditordata['name']];

				$body = str_replace($array1, $array2, $template['email_body']);

			 	if ($template['email_active'] == '1') {

			 		$this->CC_Model->sentMail($plumberdata['email'],$template['subject'],$body);
			 	}
		 	}
		}
		return $result;
	}

	
	public function userDetails($type,$requestdata){
		$this->db->select('concat(ud.name, " ", ud.surname) as name, email');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','left');
		$this->db->where(['ud.status' => '1']);		
		if(isset($requestdata['user_id'])) 	$this->db->where('ud.user_id', $requestdata['user_id']);
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		return $result;
	}
	
}