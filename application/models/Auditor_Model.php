<?php

class Auditor_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		
		$user 			= ['u.id as id', 'u.email', 'u.password_raw'];
		$usersdetail 	= ['ud.id as userdetailid','ud.name','ud.surname','ud.company_name','ud.reg_no','ud.vat_no','ud.vat_vendor','ud.mobile_phone','ud.work_phone','ud.file1','ud.file2','ud.identity_no'];		
		$useraddress 	= ['ua.id as useraddressid', 'ua.address', 'ua.province', 'ua.city', 'ua.suburb', 'ua.postal_code'];

		$userbank 		= ['ub.id as userbankid', 'ub.bank_name', 'ub.branch_code', 'ub.account_name', 'ub.account_no', 'account_type'];
		$auditor 		= ['ub1.id as available', 'ub1.user_id', 'ub1.allocation_allowed', 'ub1.status'];

		$this->db->select('
			'.implode(',', $user).',
			'.implode(',', $usersdetail).',
			'.implode(',', $useraddress).',
			'.implode(',', $auditor).',
			'.implode(',', $userbank).',
			group_concat(concat_ws("@@@", uaa.id, uaa.province, uaa.city, uaa.suburb, p.name, c.name, s.name, uaa.city) separator "@-@") as areas'
		);
		$this->db->from('users as u');
		$this->db->join('users_detail as ud','ud.user_id=u.id', 'left');
		$this->db->join('users_address as ua', 'ua.user_id=u.id and ua.type="3"', 'left');		
		$this->db->join('users_bank as ub', 'ub.user_id=u.id', 'left');
		$this->db->join('auditor_availability as ub1', 'ub1.user_id=u.id', 'left');
		$this->db->join('users_auditor_area as uaa', 'uaa.user_id=u.id', 'left');
		$this->db->join('province as p', 'p.id=uaa.province', 'left');
		$this->db->join('city as c', 'c.id=uaa.city', 'left');
		$this->db->join('suburb as s', 's.id=uaa.suburb', 'left');
		
		if(isset($requestdata['id'])) 			$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['status'])) 		$this->db->where_in('u.status', $requestdata['status']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}
		else
		{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;	
	}
	

	// Admin Auditor 

	public function getAuditorList($type, $requestdata=[]){
		$users 			= 	[ 
								'u.id','u.email','u.formstatus','u.status' ,'u.password_raw'
							];
		$usersdetail 	= 	[ 
								'ud.id as usersdetailid','ud.user_id as usersid','ud.title','ud.name','ud.surname','ud.dob','ud.gender','ud.company_name','ud.company','ud.reg_no','ud.vat_no','ud.contact_person','ud.home_phone','ud.mobile_phone','ud.mobile_phone2','ud.work_phone','ud.email2','ud.file1','ud.file2','ud.coc_purchase_limit', 'ud.vat_vendor'
							];

		$this->db->select('
			'.implode(',', $users).',
			'.implode(',', $usersdetail).',
			concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress,
			concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress,
			concat_ws("@-@", ua3.id, ua3.user_id, ua3.address, ua3.suburb, ua3.city, ua3.province, ua3.postal_code, ua3.type)  as billingaddress');

		$this->db->from('users u');
		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');
		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');		
		
		if(isset($requestdata['id'])) 					$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['type'])) 				$this->db->where('u.type', $requestdata['type']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['ud.name', 'ud.home_phone', 'ud.surname', 'ud.mobile_phone'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('ud.name', $searchvalue);
			$this->db->or_like('ud.surname', $searchvalue);
			$this->db->or_like('ud.home_phone', $searchvalue);
			$this->db->or_like('ud.mobile_phone', $searchvalue);
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

	public function action($data)
	{
		$this->db->trans_begin();

		$userid			= 	$this->getUserID();		
		$datetime		= 	date('Y-m-d H:i:s');
		$id				= 	$data['id'];

		if(isset($data['email'])) 				$request1['email'] 				= $data['email'];
		if(isset($data['password'])) 			$request1['password_raw'] 		= $data['password'];
		if(isset($data['password'])) 			$request1['password'] 			= md5($data['password']);

		
		if(isset($request1)){
			if($id==''){
				$request1['type']	 		= '5';
				$request1['created_at']		= 	date('Y-m-d H:i:s');

				$userdata = $this->db->insert('users', $request1);
				//print_r($request1);die;
				$id = $this->db->insert_id();
			}else{
				$request1['updated_at']		= 	date('Y-m-d H:i:s');
				$userdata = $this->db->update('users', $request1, ['id' => $id]);
			}
		}

		if(isset($id)) 							$request0['user_id'] 			= $id;
		if(isset($data['allowed'])) 			$request0['allocation_allowed']	= $data['allowed'];
		if(isset($data['coc_type'])) 			$request0['status'] 			= $data['coc_type'];
												
		if (isset($request0)) {
			$auditoravaid			= $data['auditoravaid'];
			if($auditoravaid==''){
				$request0['created_at'] 		= $datetime;
				$auditoravaid1 = $this->db->insert('auditor_availability', $request0);
			}else{
				$request0['updated_at'] 		= $datetime;
				$auditoravaid1 = $this->db->update('auditor_availability', $request0, ['id' => $auditoravaid]);
			}
		}
	
		
		if(isset($data['name'])) 				$request2['name'] 				= $data['name'];
		if(isset($data['surname'])) 			$request2['surname'] 			= $data['surname'];
		if(isset($data['company_name'])) 		$request2['company_name'] 		= $data['company_name'];
		if(isset($data['reg_no'])) 				$request2['reg_no'] 			= $data['reg_no']; 
		if(isset($data['vat_no'])) 				$request2['vat_no'] 			= $data['vat_no'];
		if(isset($data['vat_vendor'])) 			$request2['vat_vendor'] 		= $data['vat_vendor'];
		if(isset($data['work_phone'])) 			$request2['work_phone'] 		= $data['work_phone'];
		if(isset($data['mobile_phone'])) 		$request2['mobile_phone'] 		= $data['mobile_phone'];	
		if(isset($data['file1'])) 				$request2['file1'] 				= $data['file1'];
		if(isset($data['file2'])) 				$request2['file2'] 				= $data['file2'];
		if(isset($data['idno'])) 				$request2['identity_no'] 		= $data['idno'];
		
		if(isset($request2)){
			$request2['user_id'] 	= $id;
			$userdetailid			= $data['userdetailid'];

			if($userdetailid==''){
				$userdetaildata = $this->db->insert('users_detail', $request2);
			}else{
				$userdetaildata = $this->db->update('users_detail', $request2, ['id' => $userdetailid]);
			}
		}
	

		if(isset($data['address'])) 			$request3['address'] 		= $data['address'];
		if(isset($data['province'])) 			$request3['province'] 		= $data['province'];
		if(isset($data['city'])) 				$request3['city'] 			= $data['city'];		
		if(isset($data['suburb'])) 				$request3['suburb'] 		= $data['suburb'];
		if(isset($data['postal_code'])) 		$request3['postal_code'] 	= $data['postal_code']; 
		
		if(isset($request3)){
			$request3['user_id'] 	= $id;
			$request3['type'] 		= '3'; 
			$useraddressid			= $data['useraddressid'];

			if($useraddressid==''){
				$useraddressdata = $this->db->insert('users_address', $request3);
			}else{
				$useraddressdata = $this->db->update('users_address', $request3, ['id' => $useraddressid]);
			}
		}

		
		if(isset($data['bank_name'])) 				$request4['bank_name'] 		= $data['bank_name'];
		if(isset($data['branch_code'])) 			$request4['branch_code'] 	= $data['branch_code'];
		if(isset($data['account_name'])) 			$request4['account_name'] 	= $data['account_name'];	
		if(isset($data['account_no'])) 				$request4['account_no'] 	= $data['account_no'];
		if(isset($data['account_type'])) 			$request4['account_type'] 	= $data['account_type']; 
		

		if(isset($request4)){
			$request4['user_id'] 	= $id;
			$userbankid				= $data['userbankid'];

			if($userbankid==''){
				$userbankdata = $this->db->insert('users_bank', $request4);
			}else{
				$userbankdata = $this->db->update('users_bank', $request4, ['id' => $userbankid]);
			}
		}

		if(isset($data['area']) && count($data['area'])){
			$auditorids = array_column($data['area'], 'id');
			$this->db->where('user_id', $id)->where_not_in('id', $auditorids)->delete('users_auditor_area');

			foreach($data['area'] as $key => $request5){
				$request5['user_id'] = $id;

				if($request5['id']==''){
					$usersarea = $this->db->insert('users_auditor_area', $request5);
				}else{
					$usersarea = $this->db->update('users_auditor_area', $request5, ['id' => $request5['id']]);
				}
			}
		}
		
		if((!isset($userdata) && !isset($userdetaildata) && !isset($useraddressdata) && !isset($userbankdata) && !isset($usersarea)) && $this->db->trans_status() === FALSE)
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