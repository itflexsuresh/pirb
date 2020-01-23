<?php

class Systemusers_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('users');
		
		if(isset($requestdata['u_id'])) 		$this->db->where('u_id', $requestdata['u_id']);
		if(isset($requestdata['u_status']))	$this->db->where_in('u_status', $requestdata['u_status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['u_id', 'u_name', 'u_surname', 'u_password_raw', 'u_email', 'u_type', 'u_status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('u_name', $searchvalue);
			$this->db->or_like('u_surname', $searchvalue);
			$this->db->or_like('u_password_raw', $searchvalue);
			$this->db->or_like('u_type', $searchvalue);
			$this->db->or_like('u_status', $searchvalue);
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
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['u_name'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
							
		if(isset($data['name'])) 	$request['name'] 	= $data['name'];
		if(isset($data['status'])) 	$request['status'] 	= $data['status'];
	
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('installationtype', $request);
		}else{
			$this->db->update('installationtype', $request, ['id' => $id]);
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
							'installationtype', 
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