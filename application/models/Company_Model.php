<?php

class Company_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$users 			= 	[ 
								'u.id','u.email','u.formstatus','u.expirydate','u.type','u.status','u.created_at' 
							];
		$usersdetail 	= 	[ 
								'ud.id as usersdetailid','ud.company','ud.reg_no','ud.vat_no','ud.contact_person','ud.work_phone','ud.mobile_phone','ud.specialisations','ud.email2','ud.mobile_phone2','ud.home_phone','ud.status as companystatus'
							];
		$userscompany 	= 	[ 
								'uc.id as userscompanyid','uc.work_type','uc.message','uc.approval_status','uc.reject_reason','uc.reject_reason_other'
							];
				
		$this->db->select('
			'.implode(',', $users).',
			'.implode(',', $usersdetail).',
			'.implode(',', $userscompany).',
			concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress,
			concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress,
			count(lm.id) as lmcount,
			count(lttq.id) as lttqcount
		');
		$this->db->from('users u');
		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		$this->db->join('users_company uc', 'uc.user_id=u.id', 'left');
		$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');		
		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		$this->db->join('users_plumber lm', 'lm.company_details=u.id and (lm.designation="4" or lm.designation="6")', 'left');
		$this->db->join('users_plumber lttq', 'lttq.company_details=u.id and (lttq.designation="1" or lttq.designation="2" or lttq.designation="3" or lttq.designation="5")', 'left');
		
		if(isset($requestdata['id'])) 					$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['type'])) 				$this->db->where('u.type', $requestdata['type']);
		if(isset($requestdata['formstatus']))			$this->db->where_in('u.formstatus', $requestdata['formstatus']);
		if(isset($requestdata['status']))				$this->db->where_in('u.status', $requestdata['status']);
		if(isset($requestdata['companystatus']))		$this->db->where_in('ud.status', $requestdata['companystatus']);
		if(isset($requestdata['approvalstatus']))		$this->db->where_in('uc.approval_status', $requestdata['approvalstatus']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['u.id', 'ud.company', 'u.status', 'ud.name', 'ud.name', 'ud.name'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start(); // Open bracket
			$this->db->like('u.id', $searchvalue);
			$this->db->or_like('ud.company', $searchvalue);
			$this->db->or_like('u.status', $searchvalue);
			$this->db->group_end(); // Open bracket
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
	
	public function action($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$datetime		= 	date('Y-m-d H:i:s');
				
		if(isset($data['name'])) 				$request1['company'] 			= $data['name'];
		if(isset($data['reg_no'])) 				$request1['reg_no'] 			= $data['reg_no'];
		if(isset($data['vat_no'])) 				$request1['vat_no'] 			= $data['vat_no'];
		if(isset($data['contact_person'])) 		$request1['contact_person'] 	= $data['contact_person'];
		if(isset($data['work_phone'])) 			$request1['work_phone'] 		= $data['work_phone'];
		if(isset($data['mobile_phone'])) 		$request1['mobile_phone'] 		= $data['mobile_phone'];

		if(isset($data['home_phone'])) 			$request1['home_phone'] 		= $data['home_phone'];
		if(isset($data['secondary_phone'])) 	$request1['mobile_phone2'] 		= $data['secondary_phone'];
		if(isset($data['email'])) 				$request1['email2'] 			= $data['email'];

		if(isset($data['specilisations'])) 		$request1['specialisations']	= implode(',', $data['specilisations']);
		if(isset($data['companystatus'])) 		$request1['status'] 			= $data['companystatus'];
		
		if(isset($request1)){
			$usersdetailid	= 	$data['usersdetailid'];
			if(isset($data['user_id'])) $request1['user_id'] = $data['user_id'];
			
			if($usersdetailid==''){
				$usersdetail = $this->db->insert('users_detail', $request1);
			}else{
				$usersdetail = $this->db->update('users_detail', $request1, ['id' => $usersdetailid]);
			}
		}
		
		if(isset($data['address']) && count($data['address'])){
			$usersaddressinsertids = [];
			foreach($data['address'] as $key => $request2){
				if(isset($data['user_id'])) $request2['user_id'] = $data['user_id'];
				if($request2['id']==''){
					$usersaddress = $this->db->insert('users_address', $request2);
				}else{
					$usersaddress = $this->db->update('users_address', $request2, ['id' => $request2['id']]);
				}
			}
		}
		
		if(isset($data['worktype'])) 				$request3['work_type'] 				= implode(',', $data['worktype']);
		if(isset($data['approval_status']))			$request3['approval_status'] 		= '0';
		if(isset($data['message'])) 				$request3['message'] 				= $data['message'];
		if(isset($data['approval_status'])) 		$request3['approval_status'] 		= $data['approval_status'];
		if(isset($data['reject_reason'])) 			$request3['reject_reason'] 			= implode(',', $data['reject_reason']);
		if(isset($data['reject_reason_other'])) 	$request3['reject_reason_other'] 	= $data['reject_reason_other'];
		
		if(isset($request3)){
			$userscompanyid	= 	$data['userscompanyid'];
			if(isset($data['user_id'])) $request3['user_id'] = $data['user_id'];
			
			if($userscompanyid==''){
				$usersdetail = $this->db->insert('users_company', $request3);
			}else{
				$usersdetail = $this->db->update('users_company', $request3, ['id' => $userscompanyid]);
			}
		}
		
		if(isset($data['formstatus'])) 		$request4['formstatus'] 	= $data['formstatus'];
		if(isset($data['companystatus'])) 	$request4['status']			= $data['companystatus'];
		if(isset($data['approval_status'])) $request4['status']			= '1';
		//if(isset($data['companystatus']) && $data['companystatus']=='2') 	$request4['status'] 		= '2';
		if(isset($request4)){
			if(isset($data['user_id'])){
				$userid = $data['user_id'];	
				$users = $this->db->update('users', $request4, ['id' => $userid]);
			}
		}
		
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

		public function ajaxOTP($requestdata){
		$query = $this->db->get_where('otp', array('user_id' => $requestdata['user_id']) );
		$count = $query->num_rows();
		if ($count == 1) {
			$this->db->set('otp',$requestdata['otp']);
			$this->db->where('user_id', $requestdata['user_id']);
			$this->db->update('otp');
		}else{
			$result = $this->db->insert('otp',$requestdata);
		}

	}

	public function OTPVerification($requestdata){
		$result = $this->db->select('*')
		->from('otp')
		->where('user_id',$requestdata['user_id'])
		->where('otp',$requestdata['otp'])
		->order_by('id', 'DESC')
		->limit(1)
		->get()
		->row_array();
		if ($result) {
			return '1';
		}else{
			return '0';
		}
	}
}