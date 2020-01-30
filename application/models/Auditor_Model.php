<?php

class Auditor_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		
		$usersdetail 	= ['ud.user_id as usersdetailid','ud.name','ud.surname','ud.company_name','ud.reg_no','ud.vat_no','ud.mobile_phone','ud.work_phone','ud.email','ud.file1','ud.file2'];
		
		$useraddress = ['ua.user_id', 'ua.address', 'ua.province', 'ua.city', 'ua.suburb', 'ua.postal_code'];
		$userbank = ['ub.user_id', 'ub.bank_name', 'ub.branch_code', 'ub.account_name', 'ub.account_no', 'account_type'];
		$user = ['uc.id', 'uc.email', 'uc.password_raw'];

		$this->db->select('*');
		$this->db->from('users as u');
		$this->db->join('users_detail as ud','ud.user_id=u.id', 'left');
		$this->db->join('users_address as ua1', 'ua1.user_id=ud.user_id', 'left');		
		$this->db->join('users_bank as ua3', 'ua3.user_id=ua1.user_id', 'left');
		$this->db->where('ud.user_id', $requestdata['user_id']);
		// $query=	$this->db->get()->result_array();
		// return $query;

			if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	

	}


		// if(isset($requestdata['id'])) 			
		// 	$this->db->where('u.id', $requestdata['id']);
		// if(isset($requestdata['idcard']) && $requestdata['idcard']!='')				$this->db->where('up.idcard', $requestdata['idcard']);
		// if(isset($requestdata['dob']) && $requestdata['dob']!='')					$this->db->where('ud.dob', $requestdata['dob']);
		// if(isset($requestdata['reg_no']) && $requestdata['reg_no']!='')				$this->db->where('up.reg_no', $requestdata['reg_no']);
		// if(isset($requestdata['company_details']) && $requestdata['company_details']!='')				$this->db->where('up.company_details', $requestdata['company_details']);
		// if(isset($requestdata['mobile_phone']) && $requestdata['mobile_phone']!='')	$this->db->where('ud.mobile_phone', $requestdata['mobile_phone']);
		// if(isset($requestdata['mobile_phone'])) $this->db->where('ud.mobile_phone', $requestdata['mobile_phone']);
		//if(isset($requestdata['status']))		$this->db->where_in('u.status', $requestdata['status']);
		
		

	//  		public function getDetails($type, $requestdata=[])
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('users');
	// 	$this->db->join('users_detail', 'users_detail.user_id = users.id', 'left');
	// 	$this->db->join('users_address', 'users_address.user_id = users_detail.user_id');
	// 	$this->db->join('users_bank', ;'users_bank.user_id = users_address.user_id');


	// 	if(isset($requestdata['id'])) 		
	// 		$this->db->where('ups.id', $requestdata['id']);
		
	// 	if($type=='count'){
	// 		$result = $this->db->count_all_results();
	// 	}else{
	// 		$query = $this->db->get();
			
	// 		if($type=='all') 		$result = $query->result_array();
	// 		elseif($type=='row') 	$result = $query->row_array();
	// 	}
		
	// 	return $result;
	// }

	
	public function action($data)
	{	
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		
		$datetime		= 	date('Y-m-d H:i:s');


		if(isset($data['email'])) 			 $request3['email']			= 	 $data['email'];
		if(isset($data['pass'])) 		 	 $request3['password_raw']	=    $data['pass'];
		if(isset($data['pass'])) 		     $request3['password']	=    md5($data['pass']);

		if(isset($request3))
		{
			//$request3['id'] = $id;
			$this->db->insert('users', $request3);
			$insert_id = $this->db->insert_id();
		}
		else
		{
			$this->db->update('users', $request, ['id' => $id]);
		}



		if(isset($data['name'])) 	         $request['name'] 	    =    $data['name'];
		if(isset($data['surname'])) 	     $request['surname'] 	=    $data['surname'];
		// if(isset($data['idnumber'])) 	     $request[''] 			= 	 $data['idnumber'];
		if(isset($data['auditor_picture']))  $request['file1'] 		= 	 $data['auditor_picture'];
		if(isset($data['email'])) 			 $request['email']		= 	 $data['email'];		
		if(isset($data['phonework'])) 		 $request['work_phone'] = 	 $data['phonework'];
		if(isset($data['phonemobile'])) 	$request['mobile_phone']=    $data['phonemobile'];
		if(isset($data['billingname'])) 	$request['company_name']=    $data['billingname'];
		if(isset($data['regnumber'])) 		$request['reg_no'] 		= 	 $data['regnumber'];
		if(isset($data['vat'])) 		    $request['vat_no'] 	    = 	 $data['vat'];
		if(isset($data['comp_photo'])) 		$request['file2'] 		= 	 $data['comp_photo'];
		

		if(isset($request))
		{
			$request['user_id'] = $insert_id;
			$this->db->insert('users_detail', $request);
			//$insert_id = $this->db->insert_id();
		}
		else
		{
			$this->db->update('users_detail', $request, ['user_id' => $user_id]);
		}



		// if(isset($request))
		// {	
		// 	$user_id	= 	$userid;
		// 	if(isset($data['user_id'])) $request['user_id'] = $data['user_id'];
			
		// 	if($user_id=='')
		// 	{
		// 		$usersdetail = $this->db->insert('users_detail', $request);
		// 		$usersdetailinsertid = $this->db->insert_id();
		// 	}
		// 	else
		// 	{
		// 		$usersdetail = $this->db->update('users_detail', $request, ['id' => $user_id]);
		// 		$usersdetailinsertid = $user_id;
		// 	}
			
		// 	$idarray['user_id'] = $usersdetailinsertid;
		// }

		
		if(isset($data['billingaddress'])) 	$request1['address'] 	= 	 $data['billingaddress'];
		if(isset($data['province'])) 		$request1['province'] 	= 	 $data['province'];
		if(isset($data['city'])) 				$request1['city'] 		= 	 $data['city'];
		if(isset($data['suburb'])) 	 		$request1['suburb']     = 	 $data['suburb'];
		if(isset($data['postalcode'])) 	    $request1['postal_code']=    $data['postalcode'];

		if(isset($request1))
		{
			$request1['user_id'] = $insert_id;
			$this->db->insert('users_address', $request1);

			//$insert_id = $this->db->insert_id();
		}
		else
		{
			$this->db->update('users_address', $request1, ['user_id' => $user_id]);
		}
		// if(isset($request1))
		// {
		// 	$user_id	= 	$userid;
		// 	if(isset($data['user_id'])) $request1['user_id'] = $data['user_id'];
			
		// 	if($user_id=='')
		// 	{
		// 		$usersdetail = $this->db->insert('users_address', $request1);
		// 		$usersdetailinsertid = $this->db->insert_id();
		// 	}
		// 	else
		// 	{
		// 		$usersdetail = $this->db->update('users_address', $request1, ['id' => $user_id]);
		// 		$usersdetailinsertid = $user_id;
		// 	}
			
		// 	$idarray['user_id'] = $usersdetailinsertid;
		// }

		if(isset($data['bankname'])) 		$request2['bank_name'] 	=    $data['bankname'];
		if(isset($data['accountname'])) 	$request2['account_name']=   $data['accountname'];
		if(isset($data['branchcode'])) 		$request2['branch_code'] =   $data['branchcode'];
		if(isset($data['accountnumber'])) 	$request2['account_no']  =   $data['accountnumber'];
		if(isset($data['accounttype'])) 	$request2['account_type'] =  $data['accounttype'];

		if(isset($request2))
		{
			$request2['user_id'] = $insert_id;
			$this->db->insert('users_bank', $request2);
			//$insert_id = $this->db->insert_id();
		}
		else
		{
			$this->db->update('users_bank', $request2, ['user_id' => $user_id]);
		}
		// if(isset($request2)){
		// 	$user_id	= 	$userid;
		// 	if(isset($data['user_id'])) $request2['user_id'] = $data['user_id'];
			
		// 	if($user_id=='')
		// 	{
		// 		$usersdetail = $this->db->insert('users_bank', $request2);
		// 		$usersdetailinsertid = $this->db->insert_id();
		// 	}
		// 	else
		// 	{
		// 		$usersdetail = $this->db->update('users_bank', $request2, ['id' => $user_id]);
		// 		$usersdetailinsertid = $user_id;
		// 	}
			
		// 	$idarray['user_id'] = $usersdetailinsertid;
		// }


		
		// if(isset($request3))
		// {
		// 	$$user_id	= 	$userid;
		// 	if(isset($data['user_id'])) $request3['user_id'] = $data['user_id'];
			
		// 	if($usersdetailid=='')
		// 	{
		// 		$usersdetail = $this->db->insert('users', $request3);
		// 		$usersdetailinsertid = $this->db->insert_id();
		// 	}
		// 	else
		// 	{
		// 		$usersdetail = $this->db->update('users', $request3, ['id' => $user_id]);
		// 		$usersdetailinsertid = $user_id;
		// 	}
			
		// 	$idarray['user_id'] = $usersdetailinsertid;
		// }

		// if(isset($request2)){
			
		// 	$request2['user_id'] 	= $userid;
		// 	$audior_details = $this->db->insert('users_bank', $request2);
		// }
		
		// if(isset($request3)){
			
		// 	$request3['id'] 	= $id;
		// 	$audior_details = $this->db->insert('users', $request3);
		// }
		

		if($this->db->trans_status() === FALSE)
		{
			$this->dsb->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}


	// public function action1($data)
	// {	
	// 	$this->db->trans_begin();
		
	// 	$userid			= 	$this->getUserID();
	// 	$datetime		= 	date('Y-m-d H:i:s');
		
		
	// 	if(isset($data['province'])) 	     	 $request4['name'] 	    =    $data['province'];
	// 	if(isset($data['audit_city'])) 	     	 $request5['name'] 		=    $data['audit_city'];
	// 	if(isset($data['audit_suburb'])) 	     $request6['name'] 		=    $data['audit_suburb'];
		

	// 	if(isset($request4)){
			
	// 		$request4['id'] 	= $id;
	// 		$audior_details = $this->db->insert('province', $request4);
	// 	}

	// 	if(isset($request5)){
			
	// 		$request5['user_id'] 	= $userid;
	// 		$audior_details = $this->db->insert('city', $request5);
	// 	}
	// 	if(isset($request6)){
			
	// 		$request6['user_id'] 	= $userid;
	// 		$audior_details = $this->db->insert('suburb', $request6);
	// 	}
	// }

	public function getListProvince($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('province');

		if(isset($requestdata['id'])) $this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status'])) $this->db->where_in('status', $requestdata['status']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();

			if($type=='all') $result = $query->result_array();
			elseif($type=='row') $result = $query->row_array();
		}

		return $result;
	}

	public function getListCity($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('city');

		if(isset($requestdata['id'])) $this->db->where('id', $requestdata['id']);
		if(isset($requestdata['provinceid'])) $this->db->where('province_id', $requestdata['provinceid']);
		//if(isset($requestdata['status'])) $this->db->where_in('status', $requestdata['status']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();

			if($type=='all') $result = $query->result_array();
			elseif($type=='row') $result = $query->row_array();
		}

		return $result;
	}
	public function getListSuburb($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('suburb');

		if(isset($requestdata['id'])) $this->db->where('id', $requestdata['id']);
		if(isset($requestdata['cityid'])) $this->db->where('id', $requestdata['id']);
		//if(isset($requestdata['status'])) $this->db->where_in('status', $requestdata['status']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();

			if($type=='all') $result = $query->result_array();
			elseif($type=='row') $result = $query->row_array();
		}

		return $result;
	}
}