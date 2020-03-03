<?php

class Diary_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('
			d.*, 
			concat(ud1.name, " ", ud1.surname) as adminname, 
			concat(ud2.name, " ", ud2.surname) as plumbername,
			concat(ud3.name, " ", ud3.surname) as companyname,
			concat(ud4.name, " ", ud4.surname) as auditorname,
		');
		$this->db->from('diary d');
		$this->db->join('users_detail ud1', 'ud1.user_id = d.admin_id', 'left');
		$this->db->join('users_detail ud2', 'ud2.user_id = d.plumber_id', 'left');
		$this->db->join('users_detail ud3', 'ud3.user_id = d.company_id', 'left');
		$this->db->join('users_detail ud4', 'ud4.user_id = d.auditor_id', 'left');
		
		if(isset($requestdata['id'])) 			$this->db->where('d.id', $requestdata['id']);		
		if(isset($requestdata['adminid'])) 		$this->db->where('d.admin_id', $requestdata['adminid']);
		if(isset($requestdata['plumberid'])) 	$this->db->where('d.plumber_id', $requestdata['plumberid']);
		if(isset($requestdata['companyid'])) 	$this->db->where('d.company_id', $requestdata['companyid']);
		if(isset($requestdata['auditorid'])) 	$this->db->where('d.auditor_id', $requestdata['auditorid']);
		if(isset($requestdata['cocid'])) 		$this->db->where('d.coc_id', $requestdata['cocid']);
		if(isset($requestdata['actionid'])) 	$this->db->where('d.action_id', $requestdata['actionid']);
		if(isset($requestdata['action'])) 		$this->db->where('d.action', $requestdata['action']);
		
		$this->db->order_by('d.id', 'desc');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
}