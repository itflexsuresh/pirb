<?php
///////
class Auditor_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 		
		$user 			= ['u.id as id', 'u.email','u.type','u.status as usstatus', 'u.password_raw'];
		$usersdetail 	= ['ud.id as userdetailid','ud.name','ud.surname','ud.company_name','ud.reg_no','ud.vat_no','ud.vat_vendor','ud.billing_email','ud.billing_contact','ud.mobile_phone','ud.work_phone','ud.file1','ud.file2','ud.identity_no'];		
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
		//if(isset($requestdata['status'])) 		$this->db->where_in('u.status', $requestdata['status']);

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
		/////////////print_r($requestdata['pagestatus']);die;
		$users 			= 	[ 
			'u.id','u.email','u.formstatus','u.status' ,'u.password_raw','u.type'
		];
		$auditor 		= ['av.id as auditavailable', 'av.user_id', 'av.allocation_allowed', 'av.status as avstatus'];
		$usersdetail 	= 	[ 
			'ud.id as usersdetailid','ud.user_id as usersid','ud.title','ud.name','ud.surname','ud.dob','ud.gender','ud.company_name','ud.company','ud.reg_no','ud.vat_no','ud.contact_person','ud.home_phone','ud.mobile_phone','ud.mobile_phone2','ud.work_phone','ud.email2','ud.file1','ud.file2','ud.coc_purchase_limit', 'ud.vat_vendor'
		];
		$billingaddress	= 	[ 
			'p.name as province, c.name as city, s.name as suburb'
		];
		$bankdetails	= 	[ 
			'ub.bank_name, ub.branch_code, ub.account_name, ub.account_no, ub.account_type'
		];


		$this->db->select('
			'.implode(',', $users).',
			'.implode(',', $auditor).',
			'.implode(',', $usersdetail).',
			'.implode(',', $billingaddress).',
			'.implode(',', $bankdetails).',
			concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress,
			concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress,
			concat_ws("@-@", ua3.id, ua3.user_id, ua3.address, ua3.suburb, ua3.city, ua3.province, ua3.postal_code, ua3.type)  as billingaddress');

		$this->db->from('users u');

		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');

		$this->db->join('users_address ua1', 'ua1.user_id=u.id', 'left');

		$this->db->join('auditor_availability as av', 'av.user_id=u.id', 'left');

		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');

		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');

		$this->db->join('users_bank ub', 'ub.user_id=u.id', 'left');

		$this->db->join('province as p', 'p.id=ua3.province', 'left');
		$this->db->join('city as c', 'c.id=ua3.city', 'left');
		$this->db->join('suburb as s', 's.id=ua3.suburb', 'left');
		
		if(isset($requestdata['id'])) 					$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['type'])) 				$this->db->where('u.type', $requestdata['type']);
		//$this->db->where('u.type', '5');
		if(isset($requestdata['pagestatus'])) 			$this->db->where('u.status', $requestdata['pagestatus']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['ud.name', 'ud.work_phone', 'ud.surname', 'ud.mobile_phone'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();
			$this->db->like('ud.name', $searchvalue);
			$this->db->or_like('ud.surname', $searchvalue);
			$this->db->or_like('ud.work_phone', $searchvalue);
			$this->db->or_like('ud.mobile_phone', $searchvalue);
			$this->db->group_end();

		}

		$this->db->group_by('u.id');

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		//print_r($this->db->last_query());die;
		
		return $result;

	}

	public function getInvoiceList($type, $requestdata=[]){
		
		$this->db->select('inv.*, ud.name, ud.surname, ud.vat_vendor');
		$this->db->from('invoice inv');	
		$this->db->join('users_detail ud', 'ud.user_id=inv.user_id', 'left');
		$this->db->join('users u', 'u.id=inv.user_id', 'inner');
		$this->db->where('u.type', '5');

		if(isset($requestdata['status'])) $this->db->where('inv.status', $requestdata['status']);
		if(isset($requestdata['statuslist'])) $this->db->where_in('inv.status', $requestdata['statuslist']);
		if(isset($requestdata['id'])) $this->db->where('inv.inv_id', $requestdata['id']);
		if(isset($requestdata['user_id'])) $this->db->where('inv.user_id', $requestdata['user_id']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['inv.invoice_no', 'inv.created_at', 'ud.name', 'inv.description', 'inv.total_cost', 'inv.status', 'inv.internal_inv'];
			//$column = ['inv.inv_id', 'inv.description', 'inv.invoice_no', 'inv.invoice_date', 'inv.total_cost', 'inv.total_cost', 'inv.internal_inv', 'ud.name'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = trim($requestdata['search']['value']);
			if(strtolower($searchvalue) == 'paid'){
				$this->db->where('inv.status', '1');
			}
			elseif(strtolower($searchvalue) == 'unpaid'){
				$this->db->where('inv.status', '0');
			}
			elseif(strtolower($searchvalue) == 'not submitted'){
				$this->db->where('inv.status', '2');
			}
			
			else{
				$this->db->group_start();
				$this->db->like('inv.inv_id', $searchvalue);
				$this->db->or_like('inv.description', $searchvalue);
				$this->db->or_like('inv.invoice_no', $searchvalue);					
				$this->db->or_like('inv.invoice_date', $searchvalue);
				// $this->db->or_like('inv.created_at', $searchvalue);
				$this->db->or_like('inv.total_cost', $searchvalue);
				$this->db->or_like('inv.internal_inv', $searchvalue);
				$this->db->or_like('ud.name', $searchvalue);
				$this->db->group_end();
			}

		}

		// $this->db->group_by('u.id');

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		// print_r($this->db->last_query());die;
		
		return $result;

	}
	
	public function action2($data)
	{
		$id	= $data['editid'];
		$request1['status'] = $data['status'];
		if(isset($data['invoicedate']) && $data['invoicedate']!='1970-01-01') $request1['invoice_date'] = date('Y-m-d', strtotime($data['invoicedate']));
		if(isset($data['invoice_no'])) $request1['invoice_no'] = $data['invoice_no'];
		if(isset($data['total_cost'])) $request1['total_cost'] = $data['total_cost'];
		if(isset($data['vat'])) $request1['vat'] = $data['vat'];
		if(isset($data['internal_inv'])) $request1['internal_inv'] = $data['internal_inv'];
		if(isset($request1)){	
			$userdata = $this->db->update('invoice', $request1, ['inv_id' => $id]);	
		}

		if(isset($data['total_cost'])) $request2['cost_value'] = $data['total_cost'];
		if(isset($data['vat'])) $request2['vat'] = $data['vat'];		
		if(isset($data['total'])) $request2['total_due'] = $data['total'];
		if(isset($request2)){	
			$userdata = $this->db->update('coc_orders', $request2, ['inv_id' => $id]);	
		}

				
		return $userdata;	
	}

	public function invoicenovalidation($data)
	{
		$id 	= $data['id'];
		$invoiceno 	= $data['invoice_no'];		
		$this->db->where('invoice_no', $invoiceno);
		if(isset($data['userid'])) $this->db->where('user_id', $data['userid']);	
		if($id!='') $this->db->where('inv_id !=', $id);
		$query = $this->db->get('invoice');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
		}
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
		if(isset($data['status'])) 				$request1['status'] 			= $data['status'];
		$request1['mailstatus'] = '1';
		$request1['status'] 					= isset($data['status']) ? $data['status'] : '2';
		
		if(isset($request1)){
			if($id==''){
				$request1['type']	 		= '5';
				$request1['created_at']		= 	date('Y-m-d H:i:s');

				$userdata = $this->db->insert('users', $request1);
				$id = $this->db->insert_id();

			}else{
				$request1['updated_at']		= 	date('Y-m-d H:i:s');
				$userdata = $this->db->update('users', $request1, ['id' => $id]);
			}
		}

		if(isset($id)) 							$request0['user_id'] 			= $id;
		if(isset($data['allowed'])) 			$request0['allocation_allowed']	= $data['allowed'];
		if(isset($data['auditstatus'])) 		$request0['status'] 			= $data['auditstatus'];

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
		
		$request2['vat_vendor'] 				= isset($data['vat_vendor']) ? $data['vat_vendor'] : '0';
		
		if(isset($data['billing_email'])) 		$request2['billing_email'] 		= $data['billing_email'];
		if(isset($data['billing_contact'])) 	$request2['billing_contact'] 	= $data['billing_contact'];
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
		}else{
			$this->db->where('user_id', $id)->delete('users_auditor_area');
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

	public function profileAction($data)
	{
		$this->db->trans_begin();

		$userid			= 	$this->getUserID();		
		$datetime		= 	date('Y-m-d H:i:s');
		$id				= 	$data['id'];

		if(isset($data['email'])) 				$request1['email'] 				= $data['email'];
		if(isset($data['password'])) 			$request1['password_raw'] 		= $data['password'];
		if(isset($data['password'])) 			$request1['password'] 			= md5($data['password']);
		if(isset($data['status'])) 				$request1['status'] 			= $data['status'];		

		
		if(isset($request1)){
			if($id==''){
				$request1['type']	 		= '5';
				$request1['created_at']		= 	date('Y-m-d H:i:s');

				$userdata = $this->db->insert('users', $request1);
				$id = $this->db->insert_id();
			}else{
				$request1['updated_at']		= 	date('Y-m-d H:i:s');
				$userdata = $this->db->update('users', $request1, ['id' => $id]);
			}
		}

		if(isset($id)) 							$request0['user_id'] 			= $id;
		if(isset($data['allowed'])) 			$request0['allocation_allowed']	= $data['allowed'];
		if(isset($data['auditstatus'])) 			$request0['status'] 			= $data['auditstatus'];

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

		$request2['vat_vendor'] 				= isset($data['vat_vendor']) ? $data['vat_vendor'] : '0';
		
		if(isset($data['billing_email'])) 		$request2['billing_email'] 		= $data['billing_email'];
		if(isset($data['billing_contact'])) 	$request2['billing_contact'] 	= $data['billing_contact'];		
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
		}else{
			$this->db->where('user_id', $id)->delete('users_auditor_area');
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

	
	
	public function getReviewList($type, $requestdata=[])
	{
		$this->db->select('ar.*,rl.statement statementname,i.name installationtypename,s.name subtypename,concat(ad.name, " ", ad.surname) auditorname');
		$this->db->from('auditor_review ar');
		$this->db->join('report_listing rl', 'rl.id=ar.statement', 'left');
		$this->db->join('installationtype i', 'i.id=ar.installationtype', 'left');
		$this->db->join('installationsubtype s', 's.id=ar.subtype', 'left');
		$this->db->join('users_detail ad', 'ad.user_id=ar.auditor_id', 'left');
		$this->db->join('custom c4', 'c4.c_id=ar.reviewtype and c4.type="4"', 'left');
		
		if(isset($requestdata['id'])) 			$this->db->where('ar.id', $requestdata['id']);
		if(isset($requestdata['coc_id'])) 		$this->db->where('ar.coc_id', $requestdata['coc_id']);
		if(isset($requestdata['reviewtype'])) 	$this->db->where('ar.reviewtype', $requestdata['reviewtype']);
		if(isset($requestdata['auditorid'])) 	$this->db->where('ar.auditor_id', $requestdata['auditorid']);
		if(isset($requestdata['plumberid'])) 	$this->db->where('ar.plumber_id', $requestdata['plumberid']);
		if(isset($requestdata['status'])) 		$this->db->where('ar.status', $requestdata['status']);
		
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];
				$this->db->group_start();
					if($page=='adminaudithistroy'){					
						$this->db->like('DATE_FORMAT(ar.created_at,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('ad.name', $searchvalue, 'both');
						$this->db->or_like('i.name', $searchvalue, 'both');
						$this->db->or_like('s.name', $searchvalue, 'both');
						$this->db->or_like('rl.statement', $searchvalue, 'both');
						$this->db->or_like('c4.name', $searchvalue, 'both');					
					}
				$this->db->group_end();
			}
		}
		if(isset($requestdata['order']['0']['column']) && $requestdata['order']['0']['column']!='' && isset($requestdata['order']['0']['dir']) && $requestdata['order']['0']['dir']!=''){
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];				
				if($page=='adminaudithistroy'){
					$column = ['ar.created_at', 'ad.name', 'i.name', 's.name', 'rl.statement', 'c4.name'];
					$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
				}
			}
		}
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
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
	
	public function actionReview($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['cocid']))		 				$request['coc_id'] 				= $data['cocid'];
		if(isset($data['auditorid']))		 			$request['auditor_id'] 			= $data['auditorid'];
		if(isset($data['plumberid']))					$request['plumber_id'] 			= $data['plumberid'];
		if(isset($data['reviewtype']))		 			$request['reviewtype'] 			= $data['reviewtype'];
		if(isset($data['favourites'])) 					$request['favourites'] 			= $data['favourites'];
		if(isset($data['installationtype'])) 			$request['installationtype'] 	= $data['installationtype'];
		if(isset($data['subtype'])) 					$request['subtype'] 			= $data['subtype'];
		if(isset($data['statement'])) 					$request['statement'] 			= $data['statement'];
		if(isset($data['reference'])) 					$request['reference'] 			= $data['reference'];
		if(isset($data['link'])) 						$request['link'] 				= $data['link'];
		if(isset($data['comments'])) 					$request['comments'] 			= $data['comments'];
		if(isset($data['file'])) 						$request['file'] 				= implode(',', $data['file']);
		if(isset($data['incompletepoint'])) 			$request['incomplete_point'] 	= $data['incompletepoint'];
		if(isset($data['completepoint'])) 				$request['complete_point'] 		= $data['completepoint'];
		if(isset($data['cautionarypoint'])) 			$request['cautionary_point'] 	= $data['cautionarypoint'];
		if(isset($data['complimentpoint'])) 			$request['compliment_point'] 	= $data['complimentpoint'];
		if(isset($data['noauditpoint'])) 				$request['noaudit_point'] 		= $data['noauditpoint'];
		if(isset($data['point'])) 						$request['point'] 				= $data['point'];
		if(isset($data['status'])) 						$request['status'] 				= $data['status'];
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('auditor_review', $request);
			$insertid = $this->db->insert_id();
		}else{
			$this->db->update('auditor_review', $request, ['id' => $id]);
			$insertid = $id;
		}

		if(isset($data['refixperiod']) && isset($data['status'])){
			$list = $this->getReviewList('row', ['id' => $insertid]);
			
			if($list['reviewtype']=='1'){
				$reviewstatus			= $data['status'];
				$listrefixdate 			= $list['refix_date'];
				
				if($listrefixdate=='' && $reviewstatus=='0'){
					$refixdate 			= date('Y-m-d', strtotime(date('d-m-Y').' +'.$data['refixperiod'].'days'));
					$this->db->update('auditor_review', ['refix_date' => $refixdate], ['id' => $insertid]);
				}
				
				/*
				$reviewstatus			= $data['status'];
				$refixdate 				= date('Y-m-d', strtotime(date('d-m-Y').' +'.$data['refixperiod'].'days'));
				$refixcompletedate 		= date('Y-m-d');
				
				$listrefixdate 			= $list['refix_date'];
				$listrefixcompletedate 	= $list['refix_complete_date'];
				
				if((($listrefixdate!='' && $listrefixcompletedate!='') || ($listrefixdate=='' && $listrefixcompletedate=='')) && $reviewstatus=='0'){
					$this->db->update('auditor_review', ['refix_date' => $refixdate, 'refix_complete_date' => NULL], ['id' => $insertid]);
				}elseif($listrefixdate!='' && $listrefixcompletedate=='' && $reviewstatus=='1'){
					$this->db->update('auditor_review', ['refix_complete_date' => $refixcompletedate], ['id' => $insertid]);
				}
				*/
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
			return $insertid;
		}
	}
	
	public function deleteReview($id)
	{
		return $this->db->where('id', $id)->delete('auditor_review');
	}
	
	
	public function getReviewRating($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('auditor_rating');
		
		if(isset($requestdata['id'])) 			$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['cocid'])) 		$this->db->where('coc_id', $requestdata['cocid']);
		if(isset($requestdata['auditorid'])) 	$this->db->where('auditor_id', $requestdata['auditorid']);
		if(isset($requestdata['plumberid'])) 	$this->db->where('plumber_id', $requestdata['plumberid']);
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function actionReviewRating($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'plumber_id' 		=> $userid,
			'created_at' 		=> $datetime,
			'created_by' 		=> $userid,
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['cocid']))		 				$request['coc_id'] 				= $data['cocid'];
		if(isset($data['auditorid']))		 			$request['auditor_id'] 			= $data['auditorid'];
		if(isset($data['rating'])) 						$request['rating'] 				= $data['rating'];
		if(isset($data['comments'])) 					$request['comments'] 			= $data['comments'];
		
		$this->db->insert('auditor_rating', $request);
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
	
	public function getReviewHistoryCount($requestdata=[])
	{
		$plumberdata1 = isset($requestdata['plumberid']) ? ['user_id' => $requestdata['plumberid'], 'auditorid !=' => '0'] : [];
		$auditordata1 = isset($requestdata['auditorid']) ? ['auditorid' => $requestdata['auditorid']] : [];
		$plumberdata2 = isset($requestdata['plumberid']) ? ['ar.plumber_id' => $requestdata['plumberid']] : [];
		$auditordata2 = isset($requestdata['auditorid']) ? ['ar.auditor_id' => $requestdata['auditorid']] : [];
		
		$count = $this->db->select('count(id) as count')->where($plumberdata1+$auditordata1)->get('stock_management')->row_array();
		
		$openaudits = $this->db->select('count(id) as count')->where(['audit_status' => '2']+$plumberdata1+$auditordata1)->get('stock_management')->row_array();
		
		$total 	= 	$this->db->select('count(ar.id) as count')
					->join('auditor_statement as', 'as.coc_id=ar.coc_id', 'left')
					->where(['as.auditcomplete' => '1']+$plumberdata2+$auditordata2)
					->get('auditor_review ar')
					->row_array();

		$refixincomplete 	= 	$this->db->select('count(ar.id) as count')
								->join('auditor_statement as', 'as.coc_id=ar.coc_id', 'left')
								->where(['as.auditcomplete' => '1', 'ar.reviewtype' => '1', 'ar.status' => '0']+$plumberdata2+$auditordata2)
								->get('auditor_review ar')
								->row_array();

		$refixcomplete 		= 	$this->db->select('count(ar.id) as count')
								->join('auditor_statement as', 'as.coc_id=ar.coc_id', 'left')
								->where(['as.auditcomplete' => '1', 'ar.reviewtype' => '1', 'ar.status' => '1']+$plumberdata2+$auditordata2)
								->get('auditor_review ar')
								->row_array();

		$cautionary 		= 	$this->db->select('count(ar.id) as count')
								->join('auditor_statement as', 'as.coc_id=ar.coc_id', 'left')
								->where(['as.auditcomplete' => '1', 'ar.reviewtype' => '2']+$plumberdata2+$auditordata2)
								->get('auditor_review ar')
								->row_array();

		$compliment 		= 	$this->db->select('count(ar.id) as count')
								->join('auditor_statement as', 'as.coc_id=ar.coc_id', 'left')
								->where(['as.auditcomplete' => '1', 'ar.reviewtype' => '3']+$plumberdata2+$auditordata2)
								->get('auditor_review ar')
								->row_array();

		$noaudit 			= 	$this->db->select('count(ar.id) as count')
								->join('auditor_statement as', 'as.coc_id=ar.coc_id', 'left')
								->where(['as.auditcomplete' => '1', 'ar.reviewtype' => '4']+$plumberdata2+$auditordata2)
								->get('auditor_review ar')
								->row_array();

		$result = [
			'count' => $count['count'],
			'openaudits' => $openaudits['count'],
			'total' => $total['count'],
			'refixincomplete' => $refixincomplete['count'],
			'refixcomplete' => $refixcomplete['count'],
			'cautionary' => $cautionary['count'],
			'compliment' => $compliment['count'],
			'noaudit' => $noaudit['count']
		];
		
		return $result;
	}

	public function getReviewHistory2Count($requestdata=[])
	{
		$plumberid = $requestdata['plumberid'];
		
		$developmental = $this->db->select('sum(points) as count')->where(['user_id' => $plumberid, 'cpd_stream' => '1', 'status' => '1'])->get('cpd_activity_form')->row_array();
		$workbased = $this->db->select('sum(points) as count')->where(['user_id' => $plumberid, 'cpd_stream' => '2', 'status' => '1'])->get('cpd_activity_form')->row_array();
		$individual = $this->db->select('sum(points) as count')->where(['user_id' => $plumberid, 'cpd_stream' => '3', 'status' => '1'])->get('cpd_activity_form')->row_array();
		
		$result = [
			'developmental' => $developmental['count'],
			'workbased' => $workbased['count'],
			'individual' => $individual['count']
		];
		
		return $result;
	}
	
	
	public function actionStatement($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['cocid']))		 				$request['coc_id'] 						= $data['cocid'];
		if(isset($data['auditorid']))		 			$request['auditor_id'] 					= $data['auditorid'];
		if(isset($data['plumberid']))		 			$request['plumber_id'] 					= $data['plumberid'];
		if(isset($data['auditdate']))		 			$request['audit_date'] 					= date('Y-m-d', strtotime($data['auditdate']));
		if(isset($data['workmanship'])) 				$request['workmanship'] 				= $data['workmanship'];
		if(isset($data['plumberverification'])) 		$request['plumber_verification'] 		= $data['plumberverification'];
		if(isset($data['cocverification'])) 			$request['coc_verification'] 			= $data['cocverification'];
		if(isset($data['workmanshippoint'])) 			$request['workmanship_point'] 			= $data['workmanshippoint'];
		if(isset($data['plumberverificationpoint']))	$request['plumberverification_point'] 	= $data['plumberverificationpoint'];
		if(isset($data['cocverificationpoint'])) 		$request['cocverification_point'] 		= $data['cocverificationpoint'];
		if(isset($data['reviewpoint'])) 				$request['review_point'] 				= $data['reviewpoint'];
		if(isset($data['point'])) 						$request['point'] 						= $data['point'];
		if(isset($data['reason'])) 						$request['reason'] 						= $data['reason'];
		if(isset($data['reportdate']))		 			$request['reportdate'] 					= date('Y-m-d H:i:s');
		if(isset($data['auditcomplete']) && isset($data['submit']) && $data['submit']=='submitreport')	$request['auditcomplete'] 		= $data['auditcomplete'];
		if(isset($data['auditcomplete']) && isset($data['submit']) && $data['submit']=='submitreport') 	$request['status'] 				= '1';
		if(isset($data['auditcomplete']) && isset($data['submit']) && $data['submit']=='submitreport') 	$request['auditcompletedate'] 	= date('Y-m-d');

		$request['refixcompletedate'] 	= (isset($data['refixcompletedate']) && $data['refixcompletedate']!='') ? date('Y-m-d', strtotime($data['refixcompletedate'])) : NULL;	
		$request['hold'] 				= (isset($data['hold'])) ? $data['hold'] : '0';
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('auditor_statement', $request);
		}else{
			$this->db->update('auditor_statement', $request, ['id' => $id]);
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
	
	public function getAuditorRatio($type, $requestdata=[])
	{ 		
		$this->db->select('*');
		$this->db->from('auditor_ratio');
		
		if(isset($requestdata['userid'])) 			$this->db->where('plumber_id', $requestdata['userid']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;	
	}
	
	public function actionRatio($id)
	{
		$this->db->trans_begin();
		
		$noofaudit 	= $this->db->select('count(id) as noofaudit')->get_where('stock_management', ['user_id' => $id, 'coc_status' => '2', 'auditorid !=' => '0'])->row_array();
		$nooflogged = $this->db->select('count(id) as nooflogged')->get_where('stock_management', ['user_id' => $id, 'coc_status' => '2'])->row_array();
		
		$reviewhistory = $this->getReviewHistoryCount(['plumberid' => $id]);
		
		$total 				= $reviewhistory['total'];
		$refixincomplete 	= $reviewhistory['refixincomplete'];
		$refixcomplete 		= $reviewhistory['refixcomplete'];
		$cautionary 		= $reviewhistory['cautionary'];

		$noofaudit 	= round(($noofaudit['noofaudit']/$nooflogged['nooflogged'])*100,2);
		$incomplete = ($refixincomplete!=0) ? round(($refixincomplete/$total)*100,2) : '0'; 
		$complete 	= ($refixcomplete!=0) ? round(($refixcomplete/$total)*100,2) : '0';
		$cautionary = ($cautionary!=0) ? round(($cautionary/$total)*100,2) : '0';
		
		$request		=	[
			'plumber_id' 		=> $id,
			'audit' 			=> $noofaudit,
			'refix_incomplete' 	=> $incomplete,
			'refix_complete' 	=> $complete,
			'cautionary' 		=> $cautionary
		];
		
		$ratio = $this->db->where('plumber_id', $id)->get('auditor_ratio')->row_array();
		
		if($ratio){
			$this->db->update('auditor_ratio', $request, ['id' => $ratio['id']]);
		}else{
			$this->db->insert('auditor_ratio', $request);
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
	/// Complsory Audit
	public function audit_compulsory($data, $pageData){
		//print_r($extraparam);die;
		if(isset($data['user_id_hide'])) 	$request['user_id'] 	= $data['user_id_hide'];
		if(isset($data['allocation'])) 		$request['allocation'] 	= $data['allocation'];

		if ($data['id']=='' && $pageData==0) {
			$request['created_at'] = date("Y-m-d H:i:s");
			$request['created_by'] = $this->getUserID();
			$this->db->insert('compulsory_audit_listing',$request);
			return true;
		}
		// elseif($data['id']=='' && $pageData!=0){

		// 	if(isset($data['allocation'])) 		$dataall 					= $data['allocation'];
		// 	if(isset($pageData)) 				$updaterec['allocation'] 	= $pageData+$dataall;
		// 	$user_id = $request['user_id'];
		// 	$request['created_at'] = date("Y-m-d H:i:s");
		// 	$request['created_by'] = $this->getUserID();
		// 	$this->db->update('compulsory_audit_listing',$updaterec, ['user_id' => $user_id]);
			
		// 	return true;
		// }
		else{
			$request['updated_at'] = date("Y-m-d H:i:s");
			$request['updated_by'] = $this->getUserID();
			$this->db->update('compulsory_audit_listing',$request, ['id' => $data['id']]);
			return true;
		}
	}
	// compusory auditor

	public function getlisting($type, $requestdata=[]){
		//print_r($requestdata);die;
		$this->db->select('u1.id as uid, cal.id as calid, up.registration_no, ud.name, ud.surname, cal.allocation, 
			(
				SELECT
				count(ast.auditcomplete)
				FROM auditor_statement ast
				WHERE u1.id = ast.plumber_id  and ast.auditcomplete = "1"
			) as completed');
		$this->db->from('users u1');
		$this->db->join('users_plumber up', 'u1.id = up.user_id', 'LEFT');
		$this->db->join('users_detail ud', 'u1.id = ud.user_id', 'LEFT');
		$this->db->join('compulsory_audit_listing cal', 'u1.id = cal.user_id', 'LEFT');
		//$this->db->join('auditor_statement ast', 'u1.id = ast.plumber_id', 'LEFT');
		$this->db->where('u1.id = cal.user_id');
		//$this->db->group_by('cal.user_id');
		if(isset($requestdata['id'])) $this->db->where('cal.id', $requestdata['id']);


		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['ud.name', 'up.registration_no', 'cal.allocation', 'cal.allocation', 'ud.surname'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();
			$this->db->like('ud.name', $searchvalue);
			$this->db->or_like('up.registration_no', $searchvalue);
			$this->db->or_like('cal.allocation', $searchvalue);
			$this->db->or_like('cal.allocation', $searchvalue);
			$this->db->group_end();

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


	public function recordcheck($id){

		if(isset($id)) 						$request['user_id'] 	= $id;

		$this->db->select('*');
		$this->db->from('compulsory_audit_listing');
		$this->db->where('user_id',$request['user_id']);
		$result = $this->db->get()->row_array();
		
		if ($result!='') {
			return $result;
		}else{
			return 0;
		}
	}

//Plumber Reg Search for compusory auditor
	public function autosearchPlumberReg($postData){ 
		
		$designations = array('4', '6' );
		//$this->db->select('up.registration_no, up.designation, u2.id, u1.name, u1.surname');
		$this->db->select('up.registration_no, up.designation, u.id, ud.name, ud.surname');

		// $this->db->from('users u2');
		// $this->db->join('users_detail u1', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','left');		
		// $this->db->join('users_plumber up', 'up.user_id=u1.user_id','left');
		// $this->db->where_in('up.designation', $designations);
		// $this->db->group_by("u1.id");		
		// $query = $this->db->get();
		// $result1 = $query->result_array(); 

		// if (empty($result1)) {
		// 	$this->db->select('u1.name,u1.surname,u2.id');
		// 	$this->db->from('users_detail u1');
		// 	$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','inner');
		// 	$this->db->join('users_plumber up', 'up.user_id=u1.user_id','inner');
		// 	$this->db->where_in('up.designation', $designations);
		// 	$this->db->like('u1.surname',$postData['search_keyword']);
		// 	$this->db->group_by("u1.id");		
		// 	$query = $this->db->get();
		// 	$result = $query->result_array();
		// }
		// else{
		// 	$result = $result1;
		// }
		// return $result;

		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3']);
		$this->db->where_in('up.designation', ['4', '6']);

		$this->db->group_start();
			$this->db->like('ud.name',$postData['search_keyword']);
			$this->db->or_like('ud.surname',$postData['search_keyword']);		
			$this->db->or_like('up.registration_no',$postData['search_keyword']);
		$this->db->group_end();

		$this->db->group_by("ud.id");		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;

	}
	
	public function auditorinvoicevalidation($data)
	{
		$internalinv 	= $data['internalinv'];
		
		$this->db->where('i.internal_inv', $internalinv);
		$this->db->join('users u', 'u.id=i.user_id and type="5"', 'inner');
		$query = $this->db->get('invoice i');
		
		if($query->num_rows() > 0){
			return '0';
		}else{
			return '1';
		}
	}
}