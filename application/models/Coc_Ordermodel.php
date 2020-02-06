<?php

class Coc_Ordermodel extends CC_Model
{
	public function getCocorderList($type, $requestdata){

		//print_r($requestdata);die;
		$this->db->select('t1.*,t2.name,t2.surname,t3.address');
		$this->db->from('coc_orders t1');
		$this->db->join('users_detail t2', 't1.user_id=t2.user_id', 'left');
		$this->db->join('users_address t3', 't1.user_id=t3.user_id', 't3.type="3"', 'left');

		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'order_id', 'inv_id','created_at','status','internal_inv','user_id','coc_type','coc_purchase','delivery_type','tracking_no'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('name', $searchvalue);
		}
		
		 			
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}
		else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		return $result;
	}

	public function adminadd($requestdata){
		$result = $this->db->insert('coc_orders',$requestdata);
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
	
	
	
	
}