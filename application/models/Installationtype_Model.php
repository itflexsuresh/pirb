<?php

class Installationtype_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('installationtype');
		
		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['designation'])) 		$this->db->where("FIND_IN_SET('".$requestdata['designation']."', designation)");
		if(isset($requestdata['specialisations']) && count($requestdata['specialisations']) == 0) 	$this->db->where('specialisations', '');
		if(isset($requestdata['status']))			$this->db->where_in('status', $requestdata['status']);
		
		if(isset($requestdata['specialisations']) && count($requestdata['specialisations']) > 0){
			$this->db->group_start();
			foreach($requestdata['specialisations'] as $specialisations){
				$this->db->or_where("FIND_IN_SET('".$specialisations."', specialisations)");
			}
			$this->db->group_end();
		}
		

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

		if(isset($data['name'])) 	$request['name'] 	= $data['name'];
		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

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

	public function installationtypeValidator($data)
	{
		$id 				= $data['id'];
		$installationtype 	= $data['name'];
		$status 			= $data['status'];
		$this->db->where('name', $installationtype);
		$this->db->where('status', $status);
		if($id!='') $this->db->where('id !=', $id);
		$this->db->where('status !=', '2');
		$query = $this->db->get('installationtype');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
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
		
		$subtypedelete 	= 	$this->db->update(
			'installationsubtype', 
			['status' => $status, 'updated_at' => $datetime, 'updated_by' => $userid], 
			['installationtype_id' => $id]
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