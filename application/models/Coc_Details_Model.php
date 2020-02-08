<?php

class Coc_Details_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		$this->db->select('*');
		$this->db->from('stock_management sm');
		$this->db->join('users_address ua', 'ua.user_id=sm.user_id and ua3.type="3"', 'left');
		
		if(isset($requestdata['cocstatus']))			$this->db->where_in('sm.coc_status', $requestdata['cocstatus']);
		if(isset($requestdata['auditstatus']))			$this->db->where_in('sm.audit_status', $requestdata['auditstatus']);
		if(isset($requestdata['type']))					$this->db->where_in('sm.type', $requestdata['type']);
		if(isset($requestdata['startrange']))			$this->db->where('sm.id >=', $requestdata['id']);
		if(isset($requestdata['endrange']))				$this->db->where('sm.id <=', $requestdata['id']);
		if(isset($requestdata['startdate']))			$this->db->where('sm.allocation_date >=', date('Y-m-d', strtotime($requestdata['startdate'])));
		if(isset($requestdata['enddate']))				$this->db->where('sm.allocation_date <=', date('Y-m-d', strtotime($requestdata['enddate'])));
		if(isset($requestdata['province']))				$this->db->where('ua.province', $requestdata['province']);
		if(isset($requestdata['city']))					$this->db->where('ua.city', $requestdata['city']);
				
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