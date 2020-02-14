<?php

class Renewal_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		
        $query=$this->db->select ('t1.*,t1.user_id, t1.inv_id, t1.description, t1.status, t1.created_at, t2.id,
        	 t3.reg_no, t3.id, t3.name name, t3.surname surname, t3.email2, t3.vat_no, t4.registration_no, t5.supplyitem, t5.amount, t6.total_due, t6.quantity, t6.cost_value, t6.delivery_cost, t7.address, t7.province, t7.city, t7.suburb');
         

        $this->db->from('invoice t1');
        $this->db->order_by("inv_id", "desc");

        $this->db->join('users as t2', 't2.id=t1.user_id', 'left');        
        $this->db->join('users_detail t3', 't3.user_id = t2.id', 'left');
        $this->db->join('users_plumber t4', 't4.user_id = t3.user_id', 'left');        
        $this->db->join('rates t5','t5.id = t4.user_id', 'left');
   		$this->db->join('coc_orders t6','t6.user_id = t4.user_id', 'left');        
   		$this->db->join('users_address t7', 't7.user_id = t6.user_id AND t7.type="3"', 'left');


       if(isset($requestdata['id'])) $this->db->where('t1.inv_id', $requestdata['id']);
       
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length']))
		{
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['t1.inv_id','t1.status','t1.total_due','t1.total_cost','t1.created_at', 't1.internal_inv','t1.description','t2.inv_id','t2.total_due','t2.quantity','t2.cost_value','t2.delivery_cost','t3.name','t3.surname','t3.company_name','t3.reg_no','t3.vat_no','t3.email2','t3.home_phone','t4.address','t4.city','t4.suburb'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}


		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			
			$this->db->like('t1.inv_id', $searchvalue);
			$this->db->like('t1.created_at', $searchvalue);
			$this->db->like('t1.total_cost', $searchvalue);
			$this->db->or_like('t1.internal_inv', $searchvalue);
			$this->db->or_like('t1.description', $searchvalue);
            $this->db->or_like('t1.status', $searchvalue);
            $this->db->or_like('t2.inv_id', $searchvalue);  
           
            
            $this->db->or_like('t2.total_due', $searchvalue);        
            $this->db->or_like('t2.quantity', $searchvalue);
            $this->db->or_like('t2.cost_value', $searchvalue);
            $this->db->or_like('t2.delivery_cost', $searchvalue);

			$this->db->or_like('t3.name', $searchvalue);
			$this->db->or_like('t3.surname', $searchvalue);
			$this->db->or_like('t3.company_name', $searchvalue);
			$this->db->or_like('t3.reg_no', $searchvalue);
			$this->db->or_like('t3.vat_no', $searchvalue);
			$this->db->or_like('t3.email2', $searchvalue);
			$this->db->or_like('t3.home_phone', $searchvalue);
		
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
	
	public function getUserids()
	{
		
		$this->db->select('id, created_at');		
		$this->db->from('users');
		$this->db->where('type', '3' );
		$result = $this->db->get()->result_array();

		$userid_array = array();
		$currentdate = date('Y-m-d h:i:s');	
		
		foreach($result as $rows)
		{	
			$createdate = $rows['created_at'];
			$userid = $rows['id'];			
			$datetime1 = new DateTime($createdate);
			$datetime2 = new DateTime($currentdate);
			$interval = $datetime1->diff($datetime2);
			$month = $interval->format('%m');

			if($month > 10){
				$userid_array[] = $userid; 
			}
		}

		$result = array();
		if(!empty($userid_array)){
			$this->db->select('us.id, us.created_at, up.designation');		
			$this->db->from('users us');
			$this->db->join('users_plumber as up', 'up.user_id=us.id', 'inner');
			$this->db->where_in('us.id', $userid_array );			
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function insertdata($userid,$designation)
	{
		$this->db->select('amount');
		$this->db->from('rates');
		if($designation == '4')
			$this->db->where('id', '6');
		elseif($designation == '5')
			$this->db->where('id', '5');
		elseif($designation == '6')
			$this->db->where('id', '7');
		else
			$this->db->where('supplyitem', 'Registration Rates');
		
		$rates = $this->db->get()->result_array(); 
		$rate = $rates[0]['amount'];


		$this->db->select('vat_percentage');
		$this->db->from('settings_details');
		$this->db->where('id', '1');
		$vats = $this->db->get()->result_array();
		$vat = $vats[0]['vat_percentage'];

		$vat_amount = $rate * $vat / 100;
		$total = $vat_amount + $rate;
		$currentdate = date('Y-m-d h:i:s');

		
		$this->db->insert('invoice', ['description' => "Registration Fee", 'user_id' => $userid, 'status' => '0', 'inv_type' => '2',  'coc_type' => '2',  'delivery_type' => '2', 'total_cost' => $rate, 'vat'=>$vat_amount, 'created_at' => $currentdate]) ;
		$result['invoice_id'] = $this->db->insert_id();
		
		$this->db->insert('coc_orders', ['user_id' => $userid, 'description' => "Registration Fee",'quantity' => '1', 'status' => '0',  'cost_value' => $rate, 'coc_type' => '2',  'delivery_type' => '2', 'total_due' => $total, 'vat'=>$vat_amount, 'inv_id' => $result['invoice_id'], 'created_at' => $currentdate, 'created_by' => $userid]);
		$result['cocorder_id']  = $this->db->insert_id();	
		
		$this->db->set('created_at',$currentdate);
		$this->db->where('id', $userid);
		$this->db->update('users');

		return $result;

	}

	
	public function getPermissions($type1)
	{ 
		$this->db->select('*');
		$this->db->from('settings_details');
		
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
		$this->db->select('*');
		$this->db->from('settings_address');
		
      if($type2=='count'){
			$result = $this->db->count_all_results();
			
		}else{
			$query = $this->db->get();
			
			
			if($type2=='all') 		$result = $query->result_array();
			elseif($type2=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->update(
			'installationtype', 
			['status' => $status, 'updated_at' => $datetime, 'updated_by' => $userid], 
			['id' => $id]
		);

		if(!$delete || $this->db->trans_status() === FALSE)
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