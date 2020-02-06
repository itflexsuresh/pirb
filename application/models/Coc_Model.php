<?php

class Coc_Model extends CC_Model
{
	public function getCOCList($type, $requestdata){
		 $result = $this->db
		 			->select('*')
		 			->from('paper_stock_management')
		 			->where($requestdata);
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}
		else{
			$result = $query = $this->db->result_array();
		}
		return $result;
	}

	public function action($requestdata){
		$datetime		= 	date('Y-m-d H:i:s');

		$result 		= $this->db->insert('coc_orders',$requestdata);
		
		if($requestdata['coc_type'] == 1) 		$requestdata2['type'] 			= 'electronic';
		if($requestdata['coc_type'] == 2) 		$requestdata2['type'] 			= 'paper';
		if(isset($requestdata['user_id'])) 		$requestdata2['user_id'] 		= $requestdata['user_id'];
												$requestdata2['coc_status']		= 'admin_stock';
												$requestdata2['audit_status']	=  NULL;
												$request['purchased_at'] 		= $datetime;

		for ($x = 1; $x <= $requestdata['coc_purchase']; $x++) {

    		$stock 			= $this->db->insert('paper_stock_management',$requestdata2);

		}

		if ($result && $stock) {
			return '1';
		}else{
			return '0';
		}
	}

	public function ajaxOTP($requestdata){
		$result = $this->db->insert('otp',$requestdata);

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
				->select('coc_purchase_limit, electronic_coc_log')
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
	
	
}