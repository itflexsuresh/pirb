<?php

class Subtype_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('ist.*, it.name as installationtypename')->order_by('id','desc');
		$this->db->from('installationsubtype as ist');
		$this->db->join('installationtype as it', 'it.id = ist.installationtype_id', 'left');
		
		if(isset($requestdata['id'])) 						$this->db->where('ist.id', $requestdata['id']);
		if(isset($requestdata['installationtypeid'])) 		$this->db->where('ist.installationtype_id', $requestdata['installationtypeid']);
		if(isset($requestdata['name'])) 					$this->db->where('ist.name', $requestdata['name']);
		if(isset($requestdata['status']))					$this->db->where_in('ist.status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['it.name', 'ist.name', 'ist.status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('ist.name', $searchvalue);
			$this->db->or_like('it.name', $searchvalue);
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
		
		if(isset($data['installationtype_id'])) 	$request['installationtype_id'] 	= $data['installationtype_id'];					
		if(isset($data['name'])) 	$request['name'] 	= $data['name'];
		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('installationsubtype', $request);
			$insertid = $this->db->insert_id();
		}else{
			$this->db->update('installationsubtype', $request, ['id' => $id]);
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
	
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->update(
			'installationsubtype', 
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

	public function subValidator($data)
	{		
		$id 				= $data['id'];
		$subtype 			= $data['name'];
		
		$this->db->where('name', $subtype);
		if($id!='') $this->db->where('id !=', $id);
		//$this->db->where('status !=', '2');
		$query = $this->db->get('installationsubtype');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
		}
	}
}