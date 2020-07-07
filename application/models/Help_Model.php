<?php

class Help_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('h.*, c1.name as typename');
		$this->db->from('help h');
		$this->db->join('custom c1', 'c1.c_id=h.type and c1.type="8"', 'left');
		
		if(isset($requestdata['id'])) 				$this->db->where('h.id', $requestdata['id']);
		if(isset($requestdata['type']))				$this->db->where_in('h.type', $requestdata['type']);
		if(isset($requestdata['status']))			$this->db->where_in('h.status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['h.id', 'h.title', 'c1.name', 'h.status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('h.title', $searchvalue);
			$this->db->or_like('c1.name', $searchvalue);
			$this->db->or_like('h.status', $searchvalue);
		}
		
		if(isset($requestdata['orderby'])) $this->db->order_by($requestdata['orderby']);
		
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

		if(isset($data['title'])) 				$request['title'] 			= $data['title'];
		if(isset($data['description'])) 		$request['description'] 	= $data['description'];
		if(isset($data['file'])) 				$request['file'] 			= $data['file'];
		if(isset($data['order'])) 				$request['order'] 			= $data['order'];
		if(isset($data['type'])) 				$request['type'] 			= $data['type'];
		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('help', $request);
		}else{
			$this->db->update('help', $request, ['id' => $id]);
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
		$id			= 	$data['id'];
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->delete(
			'help', 
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