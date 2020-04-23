<?php

class Noncompliancelisting_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('nl.*, it.name as installationname, ist.name as subtypename');
		$this->db->from('noncompliance_listing nl');
		$this->db->join('installationtype it','it.id=nl.installationtype and it.status!="2"','left');
		$this->db->join('installationsubtype ist','ist.id=nl.subtype and ist.status!="2"','left');
	 	
		if(isset($requestdata['id'])) $this->db->where('nl.id', $requestdata['id']);				
		if(isset($requestdata['installationtype'])) $this->db->where('nl.installationtype', $requestdata['installationtype']);		
		if(isset($requestdata['subtype'])) $this->db->where('nl.subtype', $requestdata['subtype']);		
		if(isset($requestdata['statement'])) $this->db->where('nl.statement', $requestdata['statement']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['nl.id', 'it.name', 'ist.name', 'nl.details',  'nl.status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}

		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower((trim($requestdata['search']['value'])));
			$this->db->like('it.name', $searchvalue);			
			$this->db->or_like('ist.name', $searchvalue);			
			$this->db->or_like('nl.details', $searchvalue);		
		}
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();

			if($type=='all') $result = $query->result_array();
			elseif($type=='row') $result = $query->row_array();
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

		if(isset($data['installationtype'])) 	$request['installationtype'] 		= $data['installationtype'];
		if(isset($data['subtype'])) 			$request['subtype'] 				= $data['subtype'];
		if(isset($data['statement'])) 			$request['statement'] 				= $data['statement'];
		if(isset($data['details'])) 			$request['details'] 				= $data['details'];
		if(isset($data['action'])) 				$request['action'] 					= $data['action'];
		if(isset($data['reference'])) 			$request['reference'] 				= $data['reference'];

		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

		if($id=='')
		{
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			
			$this->db->insert('noncompliance_listing', $request);
		}
		else
		{
			$this->db->update('noncompliance_listing', $request, ['id' => $id]);
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
			'noncompliance_listing', 
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