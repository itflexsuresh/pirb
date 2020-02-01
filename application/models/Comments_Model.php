<?php

class Comments_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('users_comments')->order_by("id", "desc");
		//$this->db->order_by("id", "desc");
		
		// if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 	$this->db->where('user_id', $requestdata['user_id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'name', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('name', $searchvalue);
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
		// $id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		// $request		=	[
		// 	'updated_at' 		=> $datetime,
		// 	'updated_by' 		=> $userid
		// ];
		$request['user_id'] = $data['user_id'];
		$request['comments'] = $data['comments'];
		if(isset($data['name'])) 	$request['name'] 	= $data['name'];
		// $request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

		$request['created_at'] = $datetime;
		$request['created_by'] = $userid;		
		
		$this->db->insert('users_comments', $request);

		// if($id==''){
			
		// }
		// else{
		// 	$this->db->update('users_comments', $request, ['id' => $id]);
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

	public function users_commentsValidator($data)
	{
		$id 				= $data['id'];
		$users_comments 	= $data['name'];		
		$this->db->where('name', $users_comments);
		if($id!='') $this->db->where('id !=', $id);
		//$this->db->where('status !=', '2');
		$query = $this->db->get('users_comments');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
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
			'users_comments', 
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