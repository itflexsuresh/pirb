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
	public function getList($type, $requestdata=[])
	{ 
			
		// $this->db->select('*');user_id
		// $this->db->from('users u');
		// $this->db->where('u.type', '6');

		$users 			= 	[ 
								'u.id','u.email','u.formstatus','u.status' ,'u.password_raw'
							];
		$usersdetail 	= 	[ 
								'ud.id as usersdetailid','ud.user_id as usersid','ud.title','ud.name','ud.surname','ud.dob','ud.gender','ud.company_name','ud.company','ud.reg_no','ud.vat_no','ud.contact_person','ud.home_phone','ud.mobile_phone','ud.mobile_phone2','ud.work_phone','ud.email2','ud.file1','ud.file2','ud.coc_purchase_limit', 'ud.vat_vendor'
							];
		$coccountnt 			= 	[ 
								'cc.id as coccountid'
							];

		$this->db->select('
			'.implode(',', $users).',
			'.implode(',', $usersdetail).',
			'.implode(',', $coccountnt).',
			concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress,
			concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress,
			concat_ws("@-@", ua3.id, ua3.user_id, ua3.address, ua3.suburb, ua3.city, ua3.province, ua3.postal_code, ua3.type)  as billingaddress');

		$this->db->from('users u');
		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');
		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');	
		$this->db->join('coc_count cc', 'cc.user_id=u.id', 'left');	
		
		if(isset($requestdata['id'])) 					$this->db->where('u.id', $requestdata['id']);

		$this->db->where('u.type', '6');

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['ud.id','ud.id','ud.id','ud.id' ];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('ud.name', $searchvalue);
			$this->db->or_like('u.email', $searchvalue);
			$this->db->or_like('ud.mobile_phone', $searchvalue);
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
		$this->db->trans_begin();

		// print_r($data); exit;
		
		$datetime				= 	date('Y-m-d H:i:s');
		$idarray				= 	[];

		if(isset($data['email'])) 			$request['email'] 			= $data['email'];
		if(isset($data['password'])) 			$request['password'] 			= md5($data['password']);
		if(isset($data['password'])) 			$request['password_raw'] 			= $data['password'];
		// if(isset($data['status'])) 			$request['status'] 		= $data['status'];
		
		$request['status'] = (isset($data['status'])) ? $data['status'] : '0';

		$request['type'] = '6';
		$request['mailstatus'] = '1';
		$request['formstatus'] = '1';
		
		if(isset($request)){	
			$usersid	= 	$data['usersid'];			
			if($usersid==''){					
				$users = $this->db->insert('users', $request);
				$usersid = $this->db->insert_id();

				if(isset($data['coc_purchase_limit']) && ($data['coc_purchase_limit'] > 0) ) {
					$count = $data['coc_purchase_limit'];
					for($i=0; $count > $i; $i++){				
						$updata['user_id'] = $usersid;	
						$updata['type'] = '2';	
						$updata['coc_status']='3';		
						$this->db->limit(1);
						$this->db->update('stock_management', $updata, ['user_id' => '0']);
					}
				}

			}
			else{
				$users = $this->db->update('users', $request, ['id' => $usersid]);
			}					
		}
		
		if(isset($data['title'])) 				$request1['title'] 				= $data['title'];
		if(isset($data['name'])) 				$request1['name'] 				= $data['name'];
		if(isset($data['surname'])) 			$request1['surname'] 			= $data['surname'];
		if(isset($data['dob'])) 				$request1['dob'] 				= date('Y-m-d', strtotime($data['dob']));
		if(isset($data['gender'])) 				$request1['gender'] 			= $data['gender'];		
		if(isset($data['company_name'])) 		$request1['company_name'] 		= $data['company_name'];
		if(isset($data['reg_no'])) 				$request1['reg_no'] 			= $data['reg_no']; 
		if(isset($data['vat_no'])) 				$request1['vat_no'] 			= $data['vat_no'];
		if(isset($data['vat_vendor'])) 				$request1['vat_vendor'] 			= $data['vat_vendor'];
		if(isset($data['home_phone'])) 			$request1['home_phone'] 		= $data['home_phone'];
		if(isset($data['mobile_phone'])) 		$request1['mobile_phone'] 		= $data['mobile_phone'];
		if(isset($data['work_phone'])) 			$request1['work_phone'] 		= $data['work_phone'];
		if(isset($data['image1'])) 				$request1['file1'] 				= $data['image1'];
		if(isset($data['image2'])) 				$request1['file2'] 				= $data['image2'];
		if(isset($data['mobile_phone2'])) 		$request1['mobile_phone2'] 		= $data['mobile_phone2'];
		if(isset($data['email2'])) 				$request1['email2'] 			= $data['email2'];
		if(isset($data['company'])) 				$request1['company'] 			= $data['company'];
		if(isset($data['coc_purchase_limit'])) 				$request1['coc_purchase_limit'] 			= $data['coc_purchase_limit'];

		$request1['vat_vendor'] = (isset($data['vat_vendor'])) ? $data['vat_vendor'] : '0';
		
		if(isset($request1)){
			$usersdetailid	= 	$data['usersdetailid'];
			
			$request1['user_id'] = $usersid;
			$request1['status'] = (isset($data['status'])) ? $data['status'] : '0';			
			if($usersdetailid==''){
				$usersdetail = $this->db->insert('users_detail', $request1);
				$usersdetailinsertid = $this->db->insert_id();
			}else{
				$usersdetail = $this->db->update('users_detail', $request1, ['id' => $usersdetailid]);
				$usersdetailinsertid = $usersdetailid;
			}
			
			$idarray['usersdetailid'] = $usersdetailinsertid;
		}
		
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


		// $request10['count']  = $data['coc_purchase_limit'];
		// $request10['user_id'] = $usersid;
		// $request10['created_by'] = $usersid;
		// $request10['created_at'] = $datetime;
		// $coccountid	= 	$data['coccountid'];
		// echo $request10; exit;
		// if($coccountid==''){
		// 	$coccount = $this->db->insert('coc_count', $request10);
		// 	$coccountinsertid = $this->db->insert_id();
		// }else{
		// 	$coccount = $this->db->update('coc_count', $request10, ['id' => $coccountid]);
		// 	$coccountinsertid = $coccountid;
		// }
				
		// if(isset($data['province'])) 				$request3['province'] 			= $data['province'];
		// if(isset($data['city'])) 				$request3['city'] 			= $data['city'];
		// if(isset($data['suburb'])) 				$request3['suburb'] 			= $data['suburb'];
		// $request3['user_id'] = $usersid;
		// $request3['type'] = 1;
		// if($request3['id']==''){
		// 	$usersaddress = $this->db->insert('users_address', $request3);
		// 	$usersaddressinsertids[$request3['type']] = $this->db->insert_id();
		// }else{
		// 	$usersaddress = $this->db->update('users_address', $request3, ['id' => $request3['id']]);
		// 	$usersaddressinsertids[$request3['type']] = $request3['id'];
		// }	
		// $idarray['usersaddressinsertid'] = $usersaddressinsertids;
		

		// if(isset($data['pprovince'])) 				$request4['province'] 			= $data['pprovince'];
		// if(isset($data['pcity'])) 				$request4['city'] 			= $data['pcity'];
		// if(isset($data['psuburb'])) 				$request4['suburb'] 			= $data['psuburb'];
		// if(isset($data['ppostcode'])) 				$request4['postal_code'] 			= $data['ppostcode'];
		// $request4['user_id'] = $usersid;
		// $request4['type'] = 2;

		// if($request4['id']==''){
		// 	$usersaddress1 = $this->db->insert('users_address', $request4);
		// 	$usersaddressinsertids[$request4['type']] = $this->db->insert_id();
		// }else{
		// 	$usersaddress1 = $this->db->update('users_address', $request4, ['id' => $request4['id']]);
		// 	$usersaddressinsertids[$request4['type']] = $request4['id'];
		// }
		// $idarray['usersaddressinsertid1'] = $usersaddressinsertids;
		
				
				
		if((isset($usersdetail) || isset($usersaddress) || isset($usersaddress1) || isset($users)) && $this->db->trans_status() === FALSE)
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