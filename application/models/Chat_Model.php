<?php

class Chat_Model extends CC_Model
{	
	public function getList($type, $requestdata=[])
	{
		$this->db->select('c.*, concat(ud1.name, " ", ud1.surname) name');
		$this->db->from('chat c');
		$this->db->join('users_detail ud1', 'ud1.user_id = c.from_id', 'left');
	
		if(isset($requestdata['id']))		$this->db->where('c.id', $requestdata['id']);
		if(isset($requestdata['cocid']))	$this->db->where('c.coc_id', $requestdata['cocid']);
			
		if(isset($requestdata['fromto'])){
			$this->db->group_start();
				$this->db->group_start();
					$this->db->where('c.from_id', $requestdata['fromto']);
					$this->db->where('c.state1', '1');
				$this->db->group_end();
				$this->db->or_group_start();
					$this->db->where('c.to_id', $requestdata['fromto']);
					$this->db->where('c.state2', '1');
				$this->db->group_end();
			$this->db->group_end();
		}
		
		if(isset($requestdata['checkfrom'])){
			$this->db->group_start();
				$this->db->where('c.from_id', $requestdata['checkfrom']);
				$this->db->where('c.state1', '0');
			$this->db->group_end();
		}
		
		if(isset($requestdata['checkto'])){
			$this->db->group_start();
				$this->db->where('c.to_id', $requestdata['checkto']);
				$this->db->where('c.state2', '0');
			$this->db->group_end();
		}
		
		$this->db->order_by('c.created_at', 'asc');
		
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
		
		$id 			= 	(isset($data['id'])) ? $data['id'] : '';
		$datetime		= 	date('Y-m-d H:i:s');
		
		if(isset($data['cocid']))		 			$request['coc_id'] 			= $data['cocid'];
		if(isset($data['fromid']))		 			$request['from_id'] 		= $data['fromid'];
		if(isset($data['toid']))		 			$request['to_id'] 			= $data['toid'];
		if(isset($data['message']))		 			$request['message'] 		= $data['message'];
		if(isset($data['attachment']))		 		$request['attachment'] 		= $data['attachment'];
		if(isset($data['quote']))		 			$request['quote'] 			= $data['quote'];
		if(isset($data['quoteattachment']))		 	$request['quoteattachment'] = $data['quoteattachment'];
		if(isset($data['state1']))		 			$request['state1'] 			= $data['state1'];
		if(isset($data['state2']))		 			$request['state2'] 			= $data['state2'];
		if(isset($data['type']))		 			$request['type'] 			= $data['type'];
		
		if($id==''){
			$request['created_at'] 	= $datetime;
			$this->db->insert('chat', $request);
			$insertid = $this->db->insert_id();
		}else{
			$this->db->update('chat', $request, ['id' => $id]);
			$insertid = $id;
		}
		
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $insertid;
		}
	}
	
	public function delete($data)
	{
		return $this->db->delete('chat', ['id' => $data['id']]);
	}

}