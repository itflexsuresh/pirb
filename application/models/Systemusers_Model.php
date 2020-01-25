<?php

class Systemusers_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('users');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'name', 'surname', 'password', 'email', 'type', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('name', $searchvalue);
			$this->db->or_like('surname', $searchvalue);
			$this->db->or_like('password', $searchvalue);
			$this->db->or_like('type', $searchvalue);
			$this->db->or_like('status', $searchvalue);
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
	
	public function action($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['name'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request1		=	[
								'created_at' 		=> $datetime,
								'created_by' 		=> $userid
							];
	    if(isset($data['role_id'])) 	$request['role_id'] 	= $data['role_id'];
		if(isset($data['name'])) 	   $request['name'] 	= $data['name'];
		if(isset($data['surname']))    $request['surname'] 	= $data['surname'];
		if(isset($data['email'])) 	   $request['email'] 	= $data['email'];

		if(isset($data['email'])) 	   $request1['email'] 	= $data['email'];
		if(isset($data['password']))   $request1['password'] = $data['password'];
		if(isset($data['type'])) 	   $request1['type'] 	= $data['type'];
		if(isset($data['status']))     $request1['status'] 	= $data['status'];
	
		
		
		if(isset($request)){

$request['user_id'] = $userid;
$audior_details = $this->db->insert('users_detail', $request);
}

	if(isset($request)){

$request['user_id'] = $userid;
$audior_details1 = $this->db->insert('users', $request1);
}
		// if($id==''){

		// 	$request['created_at'] = $datetime;
		// 	$request['created_by'] = $userid;
		// 	$this->db->insert('users', $request1);
		// }else{
		// 	$this->db->update('users', $request1, ['id' => $id]);
		// }

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