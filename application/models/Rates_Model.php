<?php

class Rates_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('rates');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'name', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}else{
			$this->db->order_by('orders', 'asc');
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
							
		if(isset($data['supplyitem'])) 	$request['supplyitem'] 		= $data['supplyitem'];
		if(isset($data['amount'])) 		$request['amount'] 		= $data['amount'];
		if(isset($data['validfrom'])) 	$request['validfrom'] 	= date('Y-m-d',strtotime($data['validfrom'])); 
	
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('rates', $request);
		}else{
			$this->db->update('rates', $request, ['id' => $id]);
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

	public function actionfuture($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
								'updated_at' 		=> $datetime,
								'updated_by' 		=> $userid
							];
							
		if(isset($data['supplyitem'])) 	$request['supplyitem'] 		= $data['supplyitem'];
		if(isset($data['amount'])) 		$request['futureammount'] 		= $data['amount'];
		if(isset($data['validfrom'])) 	$request['futuredate'] 	= date('Y-m-d',strtotime($data['validfrom'])); 
	
			$this->db->update('rates', $request, ['id' => $id]);
		
			
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
							'rates', 
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
