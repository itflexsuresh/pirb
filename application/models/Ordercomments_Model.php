<?php

class Ordercomments_Model extends CC_Model
{
	public function getCommentsList($type, $requestdata){

		$this->db->select('t1.*');
		$this->db->from('order_comments t1');	

		if(isset($requestdata['order_id'])) 				$this->db->where('order_id', $requestdata['order_id']);

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
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function action($data){

		$requestdata['created_at'] 		= date('Y-m-d H:i:s');
		// if(isset($data['created_at'])) 	    $requestdata['created_at'] 		= date('Y-m-d H:i:s', strtotime($data['created_at']));
		if(isset($data['order_id']))		$requestdata['order_id'] 		= $data['order_id'];	
		if(isset($data['comment']))			$requestdata['comment'] 		= $data['comment'];	

		
		if(isset($requestdata)){			
			$result1 = $this->db->insert('order_comments', $requestdata);
		}
	}

	
	public function autosearchPlumber($postData){
		
		$this->db->select('concat(ud.name, " ", ud.surname) as name,cc.count,u.id,up.coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3']);
		$this->db->where_in('up.designation', ['4','5','6']);
		$this->db->like('ud.name',$postData['search_keyword']);
		$this->db->or_like('ud.surname',$postData['search_keyword']);
		$this->db->group_by("ud.id");
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	public function autosearchReseller($postData){
		
		$this->db->select('ud.company as name,cc.count,u.id, "0" as coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '6']);
		$this->db->like('ud.name',$postData['search_keyword']);
		$this->db->or_like('ud.surname',$postData['search_keyword']);
		$this->db->or_like('ud.company',$postData['search_keyword']);
		$this->db->group_by("ud.id");
		
		$query = $this->db->get();
		$result = $query->result_array();
			
		return $result;
	}

	
}