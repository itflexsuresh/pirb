<?php

class Performancestatus_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('performance_status');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);

		$this->db->order_by('id','desc');

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
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['plumberid'])) 		$request['plumber_id'] 		= $data['plumberid'];
		if(isset($data['type'])) 			$request['type'] 			= $data['type'];
		if(isset($data['point'])) 			$request['point'] 			= $data['point'];
		if(isset($data['date'])) 			$request['date'] 			= date('Y-m-d', strtotime($data['date']));
		if(isset($data['comments'])) 		$request['comments'] 		= $data['comments'];
		if(isset($data['verification'])) 	$request['verification'] 	= $data['verification'];
		if(isset($data['enddate'])) 		$request['enddate'] 		= date('Y-m-d', strtotime($data['enddate']));
		if(isset($data['attachment'])) 		$request['attachment'] 		= $data['attachment'];
		if(isset($data['status'])) 			$request['status'] 			= $data['status'];
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('performance_status', $request);
		}else{
			$this->db->update('performance_status', $request, ['id' => $id]);
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