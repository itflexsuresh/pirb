<?php

class Friends_Model extends CC_Model
{
	public function search($postData){
		
		$this->db->select('u.id as userid, concat(ud.name, " ", ud.surname) as name,ud.file2');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3', 'u.id !=' => $postData['userid']]);

		$this->db->group_start();
			$this->db->like('ud.name',$postData['search']);
			$this->db->or_like('ud.surname',$postData['search']);		
			$this->db->or_like('up.registration_no',$postData['search']);
		$this->db->group_end();

		$this->db->group_by("ud.id");		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}
	
	public function getList($type, $requestdata=[])
	{
		$this->db->select('
			f.*, 
			if(f.from_id='.$requestdata['userid'].', ud1.user_id, ud2.user_id) as userid,
			if(f.from_id='.$requestdata['userid'].', concat(ud1.name, " ", ud1.surname), concat(ud2.name, " ", ud2.surname)) as name,
			if(f.from_id='.$requestdata['userid'].', ud1.file2, ud2.file2) as file2,
			if(f.from_id='.$requestdata['userid'].', up1.registration_no, up2.registration_no) as registration_no
		');
		$this->db->from('friends f');
		$this->db->join('users_detail ud1', 'ud1.user_id=f.to_id', 'left');
		$this->db->join('users_detail ud2', 'ud2.user_id=f.from_id', 'left');
		$this->db->join('users_plumber up1', 'up1.user_id=f.to_id', 'left');
		$this->db->join('users_plumber up2', 'up2.user_id=f.from_id', 'left');
		
		if(isset($requestdata['id'])) 				$this->db->where('f.id', $requestdata['id']);
		if(isset($requestdata['fromid'])) 			$this->db->where('f.from_id', $requestdata['fromid']);
		if(isset($requestdata['toid'])) 			$this->db->where('f.to_id', $requestdata['toid']);
		if(isset($requestdata['status']))			$this->db->where_in('f.status', $requestdata['status']);
		
		if(isset($requestdata['fromto'])){
			$this->db->group_start();
				$this->db->where('f.from_id',$requestdata['fromto']);
				$this->db->or_where('f.to_id',$requestdata['fromto']);	
			$this->db->group_end();
		}
		
		$this->db->group_by("f.id");	
		
		if(isset($requestdata['limit'])) $this->db->limit($requestdata['limit']);
			
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		//echo $this->db->last_query();die;
		return $result;
	}
	
	public function action($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['fromid'])) 				$request['from_id'] 				= $data['fromid'];
		if(isset($data['toid'])) 				$request['to_id'] 					= $data['toid'];
		if(isset($data['status'])) 				$request['status'] 					= $data['status'];
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('friends', $request);
		}else{
			$this->db->update('friends', $request, ['id' => $id]);
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
	
	public function remove($data)
	{
		$id			= 	$data['id'];
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->delete(
			'friends',
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
