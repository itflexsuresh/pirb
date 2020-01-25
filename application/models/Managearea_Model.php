<?php

class Managearea_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('t1.*,t2.id,t2.name city_name,t3.id,t3.name suburb');
		$this->db->from('province t1');
		$this->db->join('city t2','t2.province_id=t1.id','left');
		$this->db->join('suburb t3','t3.province_id=t1.id','left');
		
		if(isset($requestdata['id'])) 		$this->db->where('t1.id',$requestdata['id']);
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
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		// $request		=	[
		// 						'updated_at' 		=> $datetime,
		// 						'updated_by' 		=> $userid
		// 					];
		$request1		=	[
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
							$request2		=	[
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
							
							
		if(isset($data['name'])) 	$request['name'] 	= $data['name'];
		if(isset($data['status'])) 	$request['status'] 	= $data['status'];

		if(isset($data['city'])) 	$request1['name'] 	= $data['city'];
        if(isset($data['status'])) 	$request1['status'] = $data['status'];

        if(isset($data['suburb'])) 	$request2['name'] 	= $data['suburb'];
        if(isset($data['status'])) 	$request2['status'] = $data['status'];

		//$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';
	
		if($id==''){
			 $request['id'] = $id;
			// $request['created_by'] = $userid;
			$this->db->insert('province', $request);
			   $insert_id = $this->db->insert_id();

					}else{
			$this->db->update('province', $request, ['id' => $id]);
		}

		if($id==''){
			$request1['created_at'] = $datetime;
			$request1['created_by'] = $userid;
			$request1['province_id'] =$insert_id ;
			$this->db->insert('city', $request1);
			$insert_id1 = $this->db->insert_id();
		}else{
			$this->db->update('city', $request1, ['id' => $id]);
		}

		if($id==''){
			$request2['created_at'] = $datetime;
			$request2['created_by'] = $userid;
			$request2['province_id'] =$insert_id  ;
			$request2['city_id'] =$insert_id1 ;
			$this->db->insert('suburb', $request2);
		}else{
			$this->db->update('suburb', $request2, ['id' => $id]);
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
							'province', 
							['status' => $status, 'name' => $name], 
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
	
	public function getProvinceList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('province');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
}