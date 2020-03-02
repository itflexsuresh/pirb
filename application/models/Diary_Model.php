<?php

class Diary_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('diary');
		
		if(isset($requestdata['id'])) 			$this->db->where('id', $requestdata['id']);		
		if(isset($requestdata['plumberid'])) 	$this->db->where('plumber_id', $requestdata['plumberid']);
		if(isset($requestdata['companyid'])) 	$this->db->where('company_id', $requestdata['companyid']);
		if(isset($requestdata['auditorid'])) 	$this->db->where('auditor_id', $requestdata['auditorid']);
		if(isset($requestdata['cocid'])) 		$this->db->where('coc_id', $requestdata['cocid']);
		if(isset($requestdata['action'])) 		$this->db->where('action', $requestdata['action']);
		
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
		
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'datetime' 		=> $datetime
		];
		
		if(isset($data['plumberid'])) 	$request['plumber_id'] 	= $data['plumberid'];
		if(isset($data['companyid'])) 	$request['company_id'] 	= $data['companyid'];
		if(isset($data['auditorid'])) 	$request['auditor_id'] 	= $data['auditorid'];
		if(isset($data['cocid'])) 		$request['coc_id'] 		= $data['cocid'];
		if(isset($data['action'])) 		$request['action']	 	= $data['action'];
		
		$this->db->insert('diary', $request);
		
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