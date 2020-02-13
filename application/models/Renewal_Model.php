<?php

class Renewal_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		
        $query=$this->db->select ('t1.*,t1.user_id, t1.inv_id, t1.description, t1.status, t1.created_at, t2.id,
        	 t3.reg_no, t3.id, t3.name name, t3.surname surname, t5.supplyitem, t5.amount');

        $this->db->from('invoice t1');

        $this->db->join('users as t2', 't2.id=t1.user_id', 'left');
        // $this->db->join('coc_orders t2','t2.user_id = t1.user_id', 'left');        
        $this->db->join('users_detail t3', 't3.user_id = t2.id', 'left');
        //$this->db->join('users_address t4', 't4.user_id = t1.user_id', 'left');
        $this->db->join('rates t5','t5.id = t3.user_id', 'left');
   
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
	
	public function getCronDate($id)
		{
			
		$id			= 	$this->getUserID();
		//$datetime	= 	date('Y-m-d H:i:s');		
		$this->db->select('id, created_at');		
		$this->db->from('users');	
		//$this->db->where('id', $id);
		$this->db->where('type', '3' );
		$query11 = $this->db->get()->result_array();
		
		
		$this->db->select('amount');
		$this->db->from('rates');
		$this->db->where('supplyitem', 'Registration Rates');
		//$this->db->where('type', '3');
		$rate = $this->db->get()->result_array(); 
		

		$this->db->select('vat_percentage');
		$this->db->from('settings_details');
		$this->db->where('vat_percentage', '11');
		$vat = $this->db->get()->result_array();
		
		$total = $rate[0]['amount'] * $vat[0]['vat_percentage'] / 100;

		foreach ($query11 as $key => $value) 
		{	
		$end_date = date('Y-m-d', strtotime("+11 months", strtotime($value['created_at'])));
		echo $end_date;
		// echo '<pre>';
		// print_r($end_date); 
		// echo '</pre>';
		// exit;

		$sd = $this->db->insert('invoice', ['description' => "Registration Fee", 'user_id' => $value['id'], 'status' => 1, 'inv_type' => 2,  'total_cost' => $rate[0]['amount'], 'vat'=>$total, 'created_at' => $end_date]) ;
		

		$invid= $this->db->insert_id();

		
		$this->db->insert('coc_orders', ['user_id' => $value['id'], 'description' => "Registration Fee",  'status' => 1, 'total_due' => $rate[0]['amount'], 'vat'=>$total, 'inv_id' => $invid, 'created_at' => $end_date, 
			'created_by' => $value['id']]);
		}
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