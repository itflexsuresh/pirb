<?php

class Resellers_Model extends CC_Model
{
	public function getStockCount()
	{
		$this->db->select('COUNT(id) as COUNT');
		$this->db->from('stock_management');
		$this->db->where('user_id', '0');
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;	
	}
	public function getList($type, $requestdata=[], $querydata=[])
	{ 
		$select = [];
		
		if(in_array('users', $querydata)){
			$users 			= 	[ 
									'u.id','u.email','u.formstatus','u.status' ,'u.password_raw'
								];
			
			$select[] 		= 	implode(',', $users);
		}
		
		if(in_array('usersdetail', $querydata)){
			$usersdetail 	= 	[ 
									'ud.id as usersdetailid','ud.user_id as usersid','ud.title','ud.name','ud.surname','ud.dob','ud.gender','ud.company_name','ud.company','ud.reg_no','ud.vat_no','ud.contact_person','ud.home_phone','ud.mobile_phone','ud.mobile_phone2','ud.work_phone','ud.email2','ud.file1','ud.file2','ud.coc_purchase_limit', 'ud.vat_vendor'
								];
								
			$select[] 		= 	implode(',', $usersdetail);
		}
		
		if(in_array('coccount', $querydata)){
			$coccountnt 	= 	[ 
									'cc.id as coccountid, cc.count as count'
								];
			
			$select[] 		= 	implode(',', $coccountnt);
		}
		
		if(in_array('physicaladdress', $querydata)){
			$select[] 		= 	'concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress';
		}
		
		if(in_array('postaladdress', $querydata)){
			$select[]		= 	'concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress';
		}
		
		if(in_array('billingaddress', $querydata)){
			$select[]		= 	'concat_ws("@-@", ua3.id, ua3.user_id, ua3.address, ua3.suburb, ua3.city, ua3.province, ua3.postal_code, ua3.type)  as billingaddress';
		}
		
		$this->db->select(implode(',', $select));
		$this->db->from('users u');
		if(in_array('usersdetail', $querydata))			$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		if(in_array('physicaladdress', $querydata)) 	$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');
		if(in_array('postaladdress', $querydata))		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		if(in_array('billingaddress', $querydata))		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');	
		if(in_array('coccount', $querydata))			$this->db->join('coc_count cc', 'cc.user_id=u.id', 'left');	
		
		if(isset($requestdata['id'])) 					$this->db->where('u.id', $requestdata['id']);

		$this->db->where('u.type', '6');

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['ud.name','u.email','ud.mobile_phone','cc.count' ];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();
				$this->db->like('ud.name', $searchvalue);
				$this->db->or_like('u.email', $searchvalue);
				$this->db->or_like('ud.mobile_phone', $searchvalue);
			$this->db->group_end();
		}

		// if(isset($requestdata['customsearch'])){
		// 	if($requestdata['customsearch']=='listsearch1'){
		// 		if(isset($requestdata['search_reg_no']) && $requestdata['search_reg_no']!='') $this->db->like('up.registration_no', $requestdata['search_reg_no']);
		// 		if(isset($requestdata['search_plumberstatus']) && $requestdata['search_plumberstatus']!='') $this->db->like('up.status', $requestdata['search_plumberstatus']);
		// 		if(isset($requestdata['search_idcard']) && $requestdata['search_idcard']!='') $this->db->like('up.idcard', $requestdata['search_idcard']);
		// 		if(isset($requestdata['search_mobile_phone']) && $requestdata['search_mobile_phone']!='') $this->db->like('ud.mobile_phone', $requestdata['search_mobile_phone']);
		// 		if(isset($requestdata['search_dob']) && $requestdata['search_dob']!='') $this->db->like('ud.dob', date('Y-m-d', strtotime($requestdata['search_dob'])));
		// 		if(isset($requestdata['search_company_details']) && $requestdata['search_company_details']!='') $this->db->like('up.company_details', $requestdata['search_company_details']);
		// 	}
		// }

		// $this->db->group_by('u.id');

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getCocList($type, $requestdata=[])
	{ 

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

		$this->db->where('u.type', '6');

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
		$datetime					= 	date('Y-m-d H:i:s');
		$idarray					= 	[];
		
		if(isset($data['email'])) 				$request['email'] 				= $data['email'];
		if(isset($data['password'])) 			$request['password'] 			= md5($data['password']);
		if(isset($data['password'])) 			$request['password_raw'] 		= $data['password'];
		$request['type'] 		= '6';
		$request['mailstatus'] 	= '1';
		$request['formstatus'] 	= '1';
		$request['status'] 		= (isset($data['status'])) ? $data['status'] : '0';
		
		//users insert & update
		if(isset($request)){	
			$usersid	= 	$data['usersid'];			
			if($usersid==''){					
				$users = $this->db->insert('users', $request);
				$usersid = $this->db->insert_id();
			}
			else{

				$users = $this->db->update('users', $request, ['id' => $usersid]);
			}					
		}

		//coc_count insert & update
		$request10['user_id'] = $usersid;
		$request10['created_by'] = $usersid;
		$request10['created_at'] = $datetime;
		$coccountid	= 	$data['coccountid'];
		if($coccountid==''){
			$request10['count']  = $data['coc_purchase_limit'];
			$coccount = $this->db->insert('coc_count', $request10);
			$coccountinsertid = $this->db->insert_id();
		}else{
			$newcoc = isset($data['coc_purchase_limit']) ? $data['coc_purchase_limit'] : '0';

			$arycoc = $this->db->select('count')->from('coc_count')->where('id', $coccountid)->get()->row_array();
			$coc_count = isset($arycoc['count']) ? $arycoc['count'] : '0';						

			$arydefine = $this->db->select('coc_purchase_limit')->from('users_detail')->where('user_id', $usersid)->get()->row_array();
			$define_coc = isset($arydefine['coc_purchase_limit']) ? $arydefine['coc_purchase_limit'] : '0';

			$diff_coc = $newcoc - $define_coc;

			$request10['count'] = $diff_coc + $coc_count;

			$coccount = $this->db->update('coc_count', $request10, ['id' => $coccountid]);
			$coccountinsertid = $coccountid;
		}
		
		if(isset($data['title'])) 				$request1['title'] 				= $data['title'];
		if(isset($data['name'])) 				$request1['name'] 				= $data['name'];
		if(isset($data['surname'])) 			$request1['surname'] 			= $data['surname'];
		if(isset($data['dob'])) 				$request1['dob'] 				= date('Y-m-d', strtotime($data['dob']));
		if(isset($data['gender'])) 				$request1['gender'] 			= $data['gender'];		
		if(isset($data['company_name'])) 		$request1['company_name'] 		= $data['company_name'];
		if(isset($data['reg_no'])) 				$request1['reg_no'] 			= $data['reg_no']; 
		if(isset($data['vat_no'])) 				$request1['vat_no'] 			= $data['vat_no'];
		if(isset($data['vat_vendor'])) 			$request1['vat_vendor'] 		= $data['vat_vendor'];
		if(isset($data['home_phone'])) 			$request1['home_phone'] 		= $data['home_phone'];
		if(isset($data['mobile_phone'])) 		$request1['mobile_phone'] 		= $data['mobile_phone'];
		if(isset($data['work_phone'])) 			$request1['work_phone'] 		= $data['work_phone'];
		if(isset($data['image1'])) 				$request1['file1'] 				= $data['image1'];
		if(isset($data['image2'])) 				$request1['file2'] 				= $data['image2'];
		if(isset($data['mobile_phone2'])) 		$request1['mobile_phone2'] 		= $data['mobile_phone2'];
		if(isset($data['email2'])) 				$request1['email2'] 			= $data['email2'];
		if(isset($data['company'])) 			$request1['company'] 			= $data['company'];
		if(isset($data['coc_purchase_limit'])) 	$request1['coc_purchase_limit'] = $data['coc_purchase_limit'];

		$request1['vat_vendor'] = (isset($data['vat_vendor'])) ? $data['vat_vendor'] : '0';
		
		//users_detail insert & update
		if(isset($request1)){
			$usersdetailid	= 	$data['usersdetailid'];
			
			$request1['user_id'] = $usersid;
			if(isset($data['roletype']) && $data['roletype']=='1'){
				$request1['status'] = (isset($data['status'])) ? $data['status'] : '0';			
			}else{
				isset($data['status']) ? $request1['status'] = $data['status'] : '0';	
			}
			if($usersdetailid==''){
				$usersdetail = $this->db->insert('users_detail', $request1);
				$usersdetailinsertid = $this->db->insert_id();
			}else{
				$usersdetail = $this->db->update('users_detail', $request1, ['id' => $usersdetailid]);
				$usersdetailinsertid = $usersdetailid;
			}
			
			$idarray['usersdetailid'] = $usersdetailinsertid;
		}
		
		//users_address insert & update
		if(isset($data['address']) && count($data['address'])){
			$usersaddressinsertids = [];
			foreach($data['address'] as $key => $request3){
				// if(isset($data['user_id'])) $request3['user_id'] = $data['user_id'];
				$request3['user_id'] = $usersid;
				if($request3['id']==''){
					$usersaddress = $this->db->insert('users_address', $request3);
					$usersaddressinsertids[$request3['type']] = $this->db->insert_id();
				}else{
					$usersaddress = $this->db->update('users_address', $request3, ['id' => $request3['id']]);
					$usersaddressinsertids[$request3['type']] = $request3['id'];
				}
			}
			
			$idarray['usersaddressinsertid'] = $usersaddressinsertids;
		}	
				
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $idarray;
		}
	}
	
	
}