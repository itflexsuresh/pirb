<?php

class Coc_Ordermodel extends CC_Model
{
	public function getCocorderList($type, $requestdata){

		//print_r($requestdata);die;
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

		// if(isset($data['created_at'])) 		$requestdata['created_at'] 		= date('Y-m-d H:i:s');
		if(isset($data['created_at'])){ 
			$created_at 	= date('Y-m-d H:i:s');			
			$requestdata['created_at'] 	= $created_at;
			$requestdata1['created_at'] 	= $created_at;
		}

		// if(isset($data['user_id'])) 		$requestdata['user_id'] 		= $data['user_id'];
		if(isset($data['user_id'])){ 
			$user_id 	= $data['user_id'];			
			$requestdata['user_id'] 	= $user_id;
			$requestdata1['user_id'] 	= $user_id;
		}


		//if(isset($data['coc_type'])) 		$requestdata['type'] 		= $data['coc_type'];
		if(isset($data['coc_type'])){ 
			$coc_type 	= $data['coc_type'];			
			$requestdata['type'] 	= $coc_type;
			$requestdata1['coc_type'] 	= $coc_type;
		}
		
		//if(isset($data['delivery_type'])) 	$requestdata['delivery_type'] 	= $data['delivery_type'];
		if(isset($data['delivery_type'])){ 
			$delivery_type 	= $data['delivery_type'];			
			$requestdata['delivery_type'] 	= $delivery_type;
			$requestdata1['delivery_type'] 	= $delivery_type;
		}
		

		//if(isset($data['status'])) 			$requestdata['status'] 			= $data['status'];
		if(isset($data['status'])){ 
			$status 	= $data['status'];			
			$requestdata['status'] 	= $status;
			$requestdata1['status'] 	= $status;
		}
		
		//if(isset($data['internal_inv'])) 	$requestdata['internal_inv'] 	= $data['internal_inv'];

		if(isset($data['internal_inv'])){ 
			$internal_inv 	= $data['internal_inv'];			
			$requestdata['internal_inv'] 	= $internal_inv;
			$requestdata1['internal_inv'] 	= $internal_inv;
		}

		//if(isset($data['tracking_no'])) 	$requestdata['tracking_no'] 	= $data['tracking_no'];

		if(isset($data['tracking_no'])){ 
			$tracking_no 	= $data['tracking_no'];			
			$requestdata['tracking_no'] 	= $tracking_no;
			$requestdata1['tracking_no'] 	= $tracking_no;
		}

		//if(isset($data['updated_at'])) 		$requestdata['updated_at'] 		= date('Y-m-d H:i:s');
		if(isset($data['updated_at'])){ 
			$updated_at 	= date('Y-m-d H:i:s');	
			$requestdata['updated_at'] 	= $updated_at;
			$requestdata1['updated_at'] 	= $updated_at;
		}
		if(isset($requestdata)){

			// if($requestdata['user_id']==''){
			$result1 = $this->db->insert('invoice', $requestdata);

			$inv_id 		= $this->db->insert_id();

			
			// if(isset($data['coc_type'])) 		$requestdata1['coc_type'] 		= $data['coc_type'];

			$requestdata1['inv_id']=$inv_id;
			
			if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];

			$result = $this->db->insert('coc_orders', $requestdata1);

			// }else{
			// 	$result  = $this->db->update('coc_orders', $requestdata, ['user_id' => $requestdata['user_id']]);
			// }
		}

// 		if(isset($data['created_at'])) 		$requestdata['created_at'] 		= date('Y-m-d H:i:s');

// 		if(isset($data['inv_id'])) 			$requestdata['inv_id'] 			= $data['inv_id'];

// 		if(isset($data['user_id'])) 		$requestdata['user_id'] 		= $data['user_id'];

// 		if(isset($data['coc_type'])) 		$requestdata['coc_type'] 		= $data['type'];

// 		if(isset($data['delivery_type'])) 	$requestdata['delivery_type'] 	= $data['delivery_type'];

// 		if(isset($data['status'])) 			$requestdata['status'] 			= $data['status'];

// 		if(isset($data['internal_inv'])) 	$requestdata['internal_inv'] 	= $data['internal_inv'];
// 		if(isset($data['tracking_no'])) 	$requestdata['tracking_no'] 	= $data['tracking_no'];

// 		if(isset($data['updated_at'])) 		$requestdata['updated_at'] 		= date('Y-m-d H:i:s');

// 		if(isset($requestdata)){

// 			 if($requestdata['user_id']==''){
// 				$result = $this->db->insert('invoice', $requestdata);
// 		}
// }
		// $result = $this->db->insert('coc_orders',$requestdata);
		// if ($result) {
		// 	return '1';
		// }else{
		// 	return '0';
		// }
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