<?php

class Coc_Model extends CC_Model
{
	public function getCOCList($type, $requestdata=[])
	{ 
		$this->db->select('
			sm.*, 
			concat(ud.name, " ", ud.surname) as name, 
			u.type as usertype,
			ua.address,
			concat(pd.name, " ", pd.surname) as company 
		');
		$this->db->from('stock_management sm');
		$this->db->join('users_address ua', 'ua.user_id=sm.user_id and ua.type="3"', 'left');
		$this->db->join('users_detail ud', 'ud.user_id=sm.user_id', 'left');
		$this->db->join('users u', 'u.id=sm.user_id', 'left');
		$this->db->join('users_plumber p', 'p.user_id=sm.user_id', 'left');
		$this->db->join('users_detail pd', 'pd.user_id=p.company_details', 'left');
		
		if(isset($requestdata['auditstatus']) && count($requestdata['auditstatus']) > 0)	$this->db->where_in('sm.audit_status', $requestdata['auditstatus']);
		if(isset($requestdata['coctype']) && count($requestdata['coctype']) > 0)			$this->db->where_in('sm.type', $requestdata['coctype']);
		if(isset($requestdata['startrange']) && $requestdata['startrange']!='')				$this->db->where('sm.id >=', $requestdata['startrange']);
		if(isset($requestdata['endrange']) && $requestdata['endrange']!='')					$this->db->where('sm.id <=', $requestdata['endrange']);
		if(isset($requestdata['startdate']) && $requestdata['startdate']!='')				$this->db->where('sm.allocation_date >=', date('Y-m-d', strtotime($requestdata['startdate'])));
		if(isset($requestdata['enddate']) && $requestdata['enddate']!='')					$this->db->where('sm.allocation_date <=', date('Y-m-d', strtotime($requestdata['enddate'])));
		if(isset($requestdata['province']) && $requestdata['province']!='')					$this->db->where('ua.province', $requestdata['province']);
		if(isset($requestdata['city']) && $requestdata['city']!='')							$this->db->where('ua.city', $requestdata['city']);
		
		if(isset($requestdata['coc_status']) && count($requestdata['coc_status']) > 0)		$this->db->where_in('sm.coc_status', $requestdata['coc_status']);
		if(isset($requestdata['user_id']) && $requestdata['user_id']!='')					$this->db->where('sm.user_id', $requestdata['user_id']);
				
		$this->db->group_by('sm.id');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	/*
	public function getCOCList($type, $requestdata){
		$result = $this->db
		->select('*')
		->from('stock_management')
		->where($requestdata);
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}
		else{
			$result = $query = $this->db->result_array();
		}
		return $result;
	}
	*/

	public function getListPDF($type, $requestdata=[]){
		        $query=$this->db->select('t1.*,t1.status,t1.created_at,
        	t2.inv_id, t2.total_due, t2.quantity, t2.cost_value,t2.vat, t2.delivery_cost, t2.total_due, t3.reg_no, t3.id, t3.name name, t3.surname surname, t3.company_name company_name, t3.vat_no vat_no, t3.email2, t3.home_phone, t4.address, t4.suburb, t4.city,t4.province, t5.id, t5.name,t6.id, t6.province_id, t6.name,t7.id, t7.province_id, t7.city_id, t7.name,t8.registration_no ');
		        $this->db->select('
			group_concat(concat_ws("@@@", t4.id, t4.suburb, t4.city,t4.province, t5.name, t6.name, t7.name) separator "@-@") as areas'
		);

        $this->db->from('invoice t1');

        $this->db->join('coc_orders t2','t2.inv_id = t1.inv_id', 'left');

        $this->db->join('users_detail t3', 't3.user_id = t1.user_id', 'left');

        $this->db->join('users_address t4', 't4.user_id = t1.user_id AND t4.type="3"', 'left');
		
	$this->db->join('users_plumber t8', 't8.user_id = t1.user_id', 'left');

        $this->db->join('province t5', 't5.id=t4.province', 'left');

        $this->db->join('city t6', 't6.id=t4.city', 'left');

        $this->db->join('suburb t7', 't7.id=t4.suburb', 'left');
   
       if(isset($requestdata['id'])) $this->db->where('t1.inv_id', $requestdata['id']);
       
		// if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
		// 	$this->db->limit($requestdata['length'], $requestdata['start']);
		// }
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}

		// echo $this->db->last_query();
		// die;

		//print_r($result);die;
		
		return $result;
	}

	public function getPermissions($type1)
	{ 
		$this->db->select('*');
		$this->db->from('settings_details ');		
      if($type1=='count'){
			$result = $this->db->count_all_results();
			
		}else{
			$query = $this->db->get();
			
			
			if($type1=='all') 		$result = $query->result_array();
			elseif($type1=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	 public function getPermissions1($type2)
	{ 
		$this->db->select('st1.*, p1.id, p1.name');
		$this->db->select('
			group_concat(concat_ws("@@@", st1.province, p1.name) separator "@-@") as provincesettings');
		$this->db->from('settings_address st1');
		$this->db->join('province p1', 'p1.id = st1.province AND st1.type="2"', 'left');
		
      if($type2=='count'){
			$result = $this->db->count_all_results();
			
		}else{
			$query = $this->db->get();
			
			
			if($type2=='all') 		$result = $query->result_array();
			elseif($type2=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function action($requestdata, $flag){
		//$datetime		= 	date('Y-m-d H:i:s');

		if ($flag == 1) {
			$result 		= $this->db->insert('invoice',$requestdata);
			$inv_id 		= $this->db->insert_id();
			return $inv_id;
		}else{
			$result 		= $this->db->insert('coc_orders',$requestdata);
			if ($result) {
				return '1';
			}else{
				return '0';
			}

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
	
	// public function action($data)
	// {	
	// 	$this->db->trans_begin();

	// 	$userid			= 	$this->getUserID();
	// 	$datetime		= 	date('Y-m-d H:i:s');



	// 	if(isset($data['name'])) 	         $request['name'] 	    =    $data['name'];
	// 	if(isset($data['surname'])) 	     $request['surname'] 	=    $data['surname'];
	// 	// if(isset($data['idnumber'])) 	     $request[''] 			= 	 $data['idnumber'];
	// 	if(isset($data['auditor_picture']))  $request['file1'] 		= 	 $data['auditor_picture'];
	// 	if(isset($data['email'])) 			 $request['email']		= 	 $data['email'];		
	// 	if(isset($data['phonework'])) 		 $request['work_phone'] = 	 $data['phonework'];
	// 	if(isset($data['phonemobile'])) 	$request['mobile_phone']=    $data['phonemobile'];
	// 	if(isset($data['billingname'])) 	$request['company_name']=    $data['billingname'];
	// 	if(isset($data['regnumber'])) 		$request['reg_no'] 		= 	 $data['regnumber'];
	// 	if(isset($data['vat'])) 		    $request['vat_no'] 	    = 	 $data['vat'];
	// 	if(isset($data['comp_photo'])) 		$request['file2'] 		= 	 $data['comp_photo'];


	// 	if(isset($data['billingaddress'])) 	$request1['address'] 	= 	 $data['billingaddress'];
	// 	if(isset($data['province'])) 		$request1['province'] 	= 	 $data['province'];
	// 	if(isset($data['city'])) 			$request1['city'] 		= 	 $data['city'];
	// 	if(isset($data['suburb'])) 	 		$request1['suburb']     = 	 $data['suburb'];
	// 	if(isset($data['postalcode'])) 	    $request1['postal_code']=    $data['postalcode'];


	// 	if(isset($data['bankname'])) 		$request2['bank_name'] 	=    $data['bankname'];
	// 	if(isset($data['accountname'])) 	$request2['account_name']=   $data['accountname'];
	// 	if(isset($data['branchcode'])) 		$request2['branch_code'] =   $data['branchcode'];
	// 	if(isset($data['accountnumber'])) 	$request2['account_no']  =   $data['accountnumber'];
	// 	if(isset($data['accounttype'])) 	$request2['account_type'] =  $data['accounttype'];

	// 	if(isset($data['email'])) 			 $request3['email']		= 	 $data['email'];
	// 	if(isset($data['pass'])) 		 	 $request3['password']	=    $data['pass'];

	// 	//$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';


	// 		if(isset($request)){

	// 		$request['user_id'] 	= $userid;
	// 			$audior_details = $this->db->insert('users_detail', $request);
	// 		}



	// 		if(isset($request1)){

	// 		$request1['user_id'] 	= $userid;
	// 			$audior_details = $this->db->insert('users_address', $request1);
	// 		}

	// 		if(isset($request2)){

	// 		$request2['user_id'] 	= $userid;
	// 			$audior_details = $this->db->insert('users_bank', $request2);
	// 		}

	// 		if(isset($request3)){

	// 		//$request3['user_id'] 	= $userid;
	// 			$audior_details = $this->db->insert('users', $request3);
	// 		}


	// 	if($this->db->trans_status() === FALSE)
	// 	{
	// 		$this->db->trans_rollback();
	// 		return false;
	// 	}
	// 	else
	// 	{
	// 		$this->db->trans_commit();
	// 		return true;
	// 	}
	// }
	
	public function checkcocpermitted($userid)
	{
		$query = $this->db
		->select('coc_purchase_limit, coc_electronic')
		->from('users_plumber')
		->where('user_id', $userid)
		->get()
		->row_array();

		if($query){
			return $query;
		}else{
			return '0';
		}
	}
	
	public function getCOCLog($type, $requestdata=[])
	{ 
		$this->db->select('*');
		$this->db->from('coc_log');
	
		if(isset($requestdata['id']))		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['coc_id']))	$this->db->where('coc_id', $requestdata['coc_id']);
						
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function actionCocLog($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['coc_id'])) 				$request['coc_id'] 					= $data['coc_id'];
		if(isset($data['completion_date'])) 	$request['completion_date'] 		= date('Y-m-d', strtotime($data['completion_date']));
		if(isset($data['order_no'])) 			$request['order_no'] 				= $data['order_no'];
		if(isset($data['name'])) 				$request['name'] 					= $data['name'];
		if(isset($data['address'])) 			$request['address'] 				= $data['address'];
		if(isset($data['street'])) 				$request['street'] 					= $data['street'];
		if(isset($data['number'])) 				$request['number'] 					= $data['number'];
		if(isset($data['province'])) 			$request['province'] 				= $data['province'];
		if(isset($data['city'])) 				$request['city'] 					= $data['city'];
		if(isset($data['suburb'])) 				$request['suburb'] 					= $data['suburb'];
		if(isset($data['contact_no'])) 			$request['contact_no'] 				= $data['contact_no'];
		if(isset($data['alternate_no'])) 		$request['alternate_no'] 			= $data['alternate_no'];
		if(isset($data['email'])) 				$request['email'] 					= $data['email'];
		if(isset($data['installationtype'])) 	$request['installationtype'] 		= implode(',', $data['installationtype']);
		if(isset($data['specialisations'])) 	$request['specialisations'] 		= implode(',', $data['specialisations']);
		if(isset($data['installation_detail'])) $request['installation_detail'] 	= $data['installation_detail'];
		if(isset($data['file1'])) 				$request['file1'] 					= $data['file1'];
		if(isset($data['agreement'])) 			$request['agreement'] 				= implode(',', $data['agreement']);
		
		$request['file2'] 					= (isset($data['file2'])) ? implode(',', $data['file2']) : '';
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('coc_log', $request);
		}else{
			$this->db->update('coc_log', $request, ['id' => $id]);
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
	
	
}
