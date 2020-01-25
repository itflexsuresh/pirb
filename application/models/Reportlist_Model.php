<?php

class Reportlist_Model extends CC_Model
{	
	public function getList($type, $requestdata=[])
	{ 
			$this->db->select('installationtype.*,t2.id,t2.name city_name,t3.id,t3.name suburb');
			$this->db->from('installationtype t1');
			$this->db->join('installationsubtype t2','t2.province_id=t1.id','left');
// $this->db->join('suburb t3','t3.province_id=t1.id','left');


		
		if(isset($requestdata['id'])) 		$this->db->where('t1.id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('t1.status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['t1.id', 't1.name', 't1.status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('t1.name', $searchvalue);
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
		//$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
								'created_at' 		=> $datetime,
								'created_by' 		=> $userid
							];
		$request1		=	[
								'created_at' 		=> $datetime,
								'created_by' 		=> $userid
							];
							
		if(isset($data['insta_type'])) 			$request['name'] 	=  $data['insta_type'];
		


		if(isset($data['subtype'])) 					$request1['name'] 	= $data['subtype'];
		


		//$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';
	
		if(isset($request)){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$user = $this->db->insert('installationtype', $request);

		}
		else{
			$this->db->update('installationtype', $request, ['id' => $id]);
		}

		if(isset($request1)){
			$request1['created_at'] = $datetime;
			$request1['created_by'] = $userid;
			$user = $this->db->insert('installationsubtype', $request1);
		}
		else{
			$this->db->update('installationsubtype', $request1, ['id' => $id]);
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
	
	
	
	
}