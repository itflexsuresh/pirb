<?php

class Cpdtypesetup_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('cpdtypes')->order_by('id','desc');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'activity', 'startdate', 'enddate', 'points', 'productcode', 'cpdstream', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('activity', $searchvalue);
			$this->db->or_like('startdate', $searchvalue);
			$this->db->or_like('enddate', $searchvalue);
			$this->db->or_like('points', $searchvalue);
			$this->db->or_like('productcode', $searchvalue);
			$this->db->or_like('cpdstream', $searchvalue);
			$this->db->or_like('status', $searchvalue);

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
		//print_r($data);die;
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];
							//print_r($data);die;
		
		if(isset($data['activity'])) 		$request['activity'] 		= $data['activity'];
		if(isset($data['points'])) 			$request['points'] 			= $data['points'];
		if(isset($data['productcode'])) 	$request['productcode'] 	= $data['productcode'];
		if(isset($data['cpdstream'])) 		$request['cpdstream'] 		= $data['cpdstream'];
		if(isset($data['qrcode'])) 			$request['qrcode'] 			= $data['qrcode'];
		$request['status'] 												= (isset($data['status'])) ? $data['status'] : '0';
		if(isset($data['startdate'])) 		$request['startdate'] 		= date('Y-m-d',strtotime($data['startdate'])); 
		if(isset($data['enddate'])) 		$request['enddate'] 		= date('Y-m-d',strtotime($data['enddate']));
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('cpdtypes', $request);
		}else{
			$this->db->update('cpdtypes', $request, ['id' => $id]);
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
	public function getCronDate(){
		$this->db->select('id, enddate, status');
		$this->db->from('cpdtypes');
		$this->db->where('enddate <', date('Y-m-d'));
		$query = $this->db->get()->result_array();
		foreach ($query as $key => $value) {
			//print_r($value);
			$this->db->update('cpdtypes', ['status' => '0'], ['id' => $value['id']]);
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