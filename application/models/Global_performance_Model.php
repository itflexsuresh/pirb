<?php

class Global_performance_Model extends CC_Model
{
	public function getPointList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('gps_point');
		
		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function getWarningList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('gps_notification');
		
		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		
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



