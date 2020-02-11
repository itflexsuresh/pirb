<?php

class Coc_Ordermodel extends CC_Model
{
	public function getCocorderList($type, $requestdata){

		$this->db->select('t1.*,t2.name,t2.surname,t3.type, t3.address');
		$this->db->from('coc_orders t1');
		$this->db->join('users_detail t2', 't1.user_id=t2.user_id', 'left');
		$this->db->join('users_address t3', 't1.user_id=t3.user_id AND t3.type="2"', 'left');

		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id','inv_id','created_at','status','user_id','coc_type','delivery_type'];
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

	public function adminadd($data){



		if(isset($data['created_at'])) 	    $requestdata['created_at'] 	= date('Y-m-d H:i:s', strtotime($data['created_at']));

		if(isset($data['user_id']))			$requestdata['user_id'] 	= $data['user_id'];	

		if(isset($data['coc_type'])) 		$requestdata['type'] 		= $data['coc_type'];

		if(isset($data['delivery_type'])) 	$requestdata['delivery_type'] 	= $data['delivery_type'];

		if(isset($data['status'])) 			$requestdata['status'] 		= $data['status'];
		
		if(isset($data['internal_inv'])) 	$requestdata['internal_inv'] = $data['internal_inv'];

		if(isset($data['totaldue'])) 		$requestdata['total_cost'] 	 = $data['totaldue'];

		if(isset($data['tracking_no'])) 	$requestdata['tracking_no']  = $data['tracking_no'];

		
		
		
		// $requestdata1['coc_type'] 	= $coc_type;
		
		
//print_r($requestdata);die;
		if(isset($requestdata)){

			
			$result1 = $this->db->insert('invoice', $requestdata);

			$inv_id 		= $this->db->insert_id();

unset($requestdata['type']);
unset($requestdata['total_cost']);
			$requestdata1=$requestdata;
		
			$requestdata1['inv_id']=$inv_id;

			if(isset($data['coc_type'])) 		$requestdata1['coc_type'] 		= $data['coc_type'];
			
			if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];

			if(isset($data['coc_cost'])) 		$requestdata1['cost_value'] 	= $data['coc_cost'];

			if(isset($data['cost_f_delivery'])) $requestdata1['delivery_cost'] 	= $data['cost_f_delivery'];

			if(isset($data['vat'])) 		    $requestdata1['vat'] 			= $data['vat'];

			if(isset($data['totaldue'])) 		$requestdata1['total_due'] 		= $data['totaldue'];

			$result = $this->db->insert('coc_orders', $requestdata1);

		}
	}

	
	public function autosearchPlumber($postData){
		
		$this->db->select('u1.name,u1.surname,u2.id,u1.coc_purchase_limit');
		$this->db->from('users_detail u1');
		$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','inner');
		$this->db->like('u1.name',$postData['search_keyword']);
		$this->db->or_like('u1.surname',$postData['search_keyword']);
		$this->db->group_by("u1.id");
		
			$query = $this->db->get();
			$result = $query->result_array();
			// echo $this->db->last_query();
		return $result;

	}

	public function autosearchReseller($postData){
		
		$this->db->select('u1.company as name,u2.id,u1.coc_purchase_limit');
		$this->db->from('users_detail u1');
		$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="6" and u2.status="1"','inner');
		$this->db->like('u1.name',$postData['search_keyword']);
		$this->db->or_like('u1.surname',$postData['search_keyword']);
		$this->db->or_like('u1.company',$postData['search_keyword']);
		$this->db->group_by("u1.id");
		
			$query = $this->db->get();
			$result = $query->result_array();
			
		return $result;

	}

	
}