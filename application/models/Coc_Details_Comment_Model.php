<?php

class Coc_Details_Comment_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('cdc.*, concat(ud.name, " ", ud.surname) as username');
		$this->db->from('coc_details_comment cdc');
		$this->db->join('users_detail ud', 'ud.user_id=cdc.user_id', 'left');
		
		if(isset($requestdata['id'])) 		$this->db->where('cdc.id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 	$this->db->where('cdc.user_id', $requestdata['user_id']);
		if(isset($requestdata['coc_id'])) 	$this->db->where('cdc.coc_id', $requestdata['coc_id']);
		
		$this->db->order_by('cdc.id', 'desc');
		
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

			$this->db->insert('coc_details_comment', $request);
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