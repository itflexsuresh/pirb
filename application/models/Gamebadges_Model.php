<?php

class Gamebadges_Model extends CC_Model
{
	

	public function action($data)
	{	
		$id = $data['id']; 
		$date = date('Y-m-d');

		$request = ['updated_by' => $data['id'], 'updated_at' => $date ];			
		
		if(isset($data['file1'])) 	$request['badge'] 		= $data['file1'];
		
		if(isset($data['id']) && $data['id'] !='')
		{
			$result = $this->db->update('badges', $request, ['id' => $data['id']]);
		}
		$this->db->last_query();
		
		return $result;
	}



	public function getList($type, $requestdata=[])
	{

		$this->db->select('*');		
		$this->db->from('badges');

		if(isset($requestdata['id'])) $this->db->where('id', $requestdata['id']);
		//if(isset($requestdata['status'])) $this->db->where_in('t1.status', $requestdata['status']);
		

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'item', 'badge'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}

		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower((trim($requestdata['search']['value'])));
			$this->db->like('item', $searchvalue);
			// $this->db->or_like('t1.id', $searchvalue);
			// $this->db->or_like('t1.installation_id', $searchvalue);
			// $this->db->or_like('t2.name', $searchvalue);
			// $this->db->like('t1.subtype_id', $searchvalue);
			// $this->db->or_like('t1.compliment', $searchvalue);
			// $this->db->or_like('t1.refix_complete', $searchvalue);
			// $this->db->or_like('t1.refix_incomplete', $searchvalue);
			// $this->db->or_like('t1.cautionary', $searchvalue);
			
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
	
	

	
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->update(
			'report_listing', 
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