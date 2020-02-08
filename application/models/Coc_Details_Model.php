<?php

class Coc_Details_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		$this->db->select('sm.*, concat(ud.name, " ", ud.surname) as name, u.type as usertype');
		$this->db->from('stock_management sm');
		$this->db->join('users_address ua', 'ua.user_id=sm.user_id and ua.type="3"', 'left');
		$this->db->join('users_detail ud', 'ud.user_id=sm.user_id', 'left');
		$this->db->join('users u', 'u.id=sm.user_id', 'left');
		
		if(isset($requestdata['cocstatus']) && count($requestdata['cocstatus']) > 0)		$this->db->where_in('sm.coc_status', $requestdata['cocstatus']);
		if(isset($requestdata['auditstatus']) && count($requestdata['auditstatus']) > 0)	$this->db->where_in('sm.audit_status', $requestdata['auditstatus']);
		if(isset($requestdata['coctype']) && count($requestdata['coctype']) > 0)			$this->db->where_in('sm.type', $requestdata['coctype']);
		if(isset($requestdata['startrange']) && $requestdata['startrange']!='')				$this->db->where('sm.id >=', $requestdata['startrange']);
		if(isset($requestdata['endrange']) && $requestdata['endrange']!='')					$this->db->where('sm.id <=', $requestdata['endrange']);
		if(isset($requestdata['startdate']) && $requestdata['startdate']!='')				$this->db->where('sm.allocation_date >=', date('Y-m-d', strtotime($requestdata['startdate'])));
		if(isset($requestdata['enddate']) && $requestdata['enddate']!='')					$this->db->where('sm.allocation_date <=', date('Y-m-d', strtotime($requestdata['enddate'])));
		if(isset($requestdata['province']) && $requestdata['province']!='')					$this->db->where('ua.province', $requestdata['province']);
		if(isset($requestdata['city']) && $requestdata['city']!='')							$this->db->where('ua.city', $requestdata['city']);
				
		$this->db->group_by('sm.id');
		
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