<?php

class Plumberperformance_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('plumber_performance_type');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		if(isset($requestdata['pagestatus']))	$this->db->where_in('status', $requestdata['pagestatus']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'type', 'allocation', 'period_date', 'period_date', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('type', $searchvalue);
			$this->db->or_like('allocation', $searchvalue);
			$this->db->or_like('period_date', $searchvalue);
			$this->db->or_like('status', $searchvalue);
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
		// print_r($data);die;
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
		
		if(isset($data['type'])) 	$request['type'] 	= $data['type'];
		if(isset($data['allocation'])) 	$request['allocation'] 	= $data['allocation'];
		$request['period'] 	= (isset($data['period'])) ? $data['period'] : '0';
		if(isset($data['period_date']) && isset($data['period'])) 	$request['period_date'] = date('Y-m-d',strtotime($data['period_date']));
		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';
	
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('plumber_performance_type', $request);
		}else{
			$this->db->update('plumber_performance_type', $request, ['id' => $id]);
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
	
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->update(
							'plumber_performance_type', 
							['status' => $status, 'updated_at' => $datetime, 'updated_by' => $userid], 
							['id' => $id]
						);
		
		if(!$delete || $this->db->trans_status() === FALSE)
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