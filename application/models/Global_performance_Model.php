<?php

class Global_performance_Model extends CC_Model
{

	
	public function getPermissions()
	{ 
		$this->db->select('gps_point.*,gps_point.description as deg_name,gps_point.point,gps_point.wording');
		$this->db->from('gps_point');
		
		
		$query = $this->db->get();

		return $query->result();
	}
	public function getPermissions1()
	{ 
		$this->db->select('gpn.*,gpn.warning as gps_n, gpn.point, gpn.status');
		$this->db->from('gps_notification as gpn');
		
		$query = $this->db->get();

		return $query->result();
	}
}



