<?php

class Coc_Details_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		$this->db->select('*');
		$this->db->from('stock_management sm');
		$this->db->join('users_address ua', 'ua.user_id=sm.user_id and ua3.type="3"', 'left');
		
		if(isset($requestdata['id'])) 					$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['cocstatus']))			$this->db->where_in('sm.coc_status', $requestdata['cocstatus']);
		if(isset($requestdata['auditstatus']))			$this->db->where_in('sm.audit_status', $requestdata['auditstatus']);
		if(isset($requestdata['type']))					$this->db->where_in('sm.type', $requestdata['type']);
				
		$this->db->group_by('u.id');
		
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