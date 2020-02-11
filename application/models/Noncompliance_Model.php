<?php

class Noncompliance_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('noncompliance');
		
		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 			$this->db->where_in('user_id', $requestdata['user_id']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'name', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('name', $searchvalue);
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
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['user_id'])) 			$request['user_id'] 			= $data['user_id'];
		if(isset($data['installationtype'])) 	$request['installationtype'] 	= $data['installationtype'];
		if(isset($data['subtype'])) 			$request['subtype'] 			= $data['subtype'];
		if(isset($data['statement'])) 			$request['statement'] 			= $data['statement'];
		if(isset($data['details'])) 			$request['details'] 			= $data['details'];
		if(isset($data['action'])) 				$request['action'] 				= $data['action'];
		if(isset($data['reference'])) 			$request['reference'] 			= $data['reference'];
		
		$request['file'] 	= (isset($data['file'])) ? implode(',', $data['file']) : '';
		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('noncompliance', $request);
			$insertid = $this->db->insert_id();
		}else{
			$this->db->update('noncompliance', $request, ['id' => $id]);
			$insertid = $id;
		}

		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $insertid;
		}
	}
	
	public function delete($id)
	{
		return $this->db->where('id', $id)->delete('noncompliance');
	}
}