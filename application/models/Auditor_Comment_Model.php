<?php

class Auditor_Comment_Model  extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('ac.*, concat(ud.name, " ", ud.surname) as username');
		$this->db->from('auditor_comment ac');
		$this->db->join('users_detail ud', 'ud.user_id=ac.user_id', 'left');
		
		if(isset($requestdata['id'])) 		$this->db->where('ac.id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 	$this->db->where('ac.user_id', $requestdata['user_id']);
		if(isset($requestdata['coc_id'])) 	$this->db->where('ac.coc_id', $requestdata['coc_id']);
		
		$this->db->order_by('id', 'asc');
		
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
		$datetime		= 	date('Y-m-d H:i:s');
		
		if($data['comments']!=''){
			$request		=	[
				'comments' 			=> $data['comments'],
				'user_id' 			=> $data['user_id'],
				'coc_id' 			=> $data['coc_id'],
				'created_at' 		=> $datetime,
				'created_by' 		=> $userid,
				'updated_at' 		=> $datetime,
				'updated_by' 		=> $userid
			];

			$this->db->insert('auditor_comment', $request);
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

}