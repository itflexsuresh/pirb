<?php

class Chat_Model extends CC_Model
{	
	public function getList($type, $requestdata=[])
	{ 
		$this->db->select('*');
		$this->db->from('chat');
	
		if(isset($requestdata['id']))		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['coc_id']))	$this->db->where('cocid', $requestdata['coc_id']);
		if(isset($requestdata['state1']))	$this->db->where('state1', $requestdata['state1']);
		if(isset($requestdata['state2']))	$this->db->where('state2', $requestdata['state2']);
		
		if(isset($requestdata['fromto'])){
			$this->db->group_start();
				$this->db->group_start();
					$this->db->where('from_id', $requestdata['fromto']);
					$this->db->where('state1', '1');
				$this->db->group_end();
				$this->db->or_group_start();
					$this->db->where('to_id', $requestdata['fromto']);
					$this->db->where('state2', '1');
				$this->db->group_end();
			$this->db->group_end();
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
		
		$id 			= 	(isset($data['id'])) ? $data['id'] : '';
		$datetime		= 	date('Y-m-d H:i:s');
		
		if(isset($data['cocid']))		 			$request['coc_id'] 			= $data['cocid'];
		if(isset($data['fromid']))		 			$request['from_id'] 		= $data['fromid'];
		if(isset($data['toid']))		 			$request['to_id'] 			= $data['toid'];
		if(isset($data['message']))		 			$request['message'] 		= $data['message'];
		if(isset($data['attachment']))		 		$request['attachment'] 		= $data['attachment'];
		if(isset($data['state1']))		 			$request['state1'] 			= $data['state1'];
		if(isset($data['state2']))		 			$request['state2'] 			= $data['state2'];
		if(isset($data['type']))		 			$request['type'] 			= $data['type'];
		
		if($id==''){
			$request['created_at'] 	= $datetime;
			$this->db->insert('chat', $request);
		}else{
			$this->db->update('chat', $request, ['id' => $id]);
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