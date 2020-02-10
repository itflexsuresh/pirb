<?php

class Managearea_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$query=$this->db->select('t1.*,t2.name city_name,t3.name province_name');
		$this->db->from('suburb t1');
		$this->db->join('city t2','t2.province_id=t1.province_id AND t2.id=t1.city_id','left');
		$this->db->join('province t3','t3.id=t1.province_id','left');
		
		if(isset($requestdata['id'])) 		$this->db->where('t1.id',$requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('t1.status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['t1.id', 't1.name', 't1.status','t3.name','t2.name'];
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
		
		if(isset($data['province']) && isset($data['city1']) && $data['city1']!=''){
			$request1		=	[
									'created_at' 		=> $datetime,
									'created_by' 		=> $userid,
									'updated_at' 		=> $datetime,
									'updated_by' 		=> $userid,
									'name'				=> $data['city1'],
									'province_id'		=> $data['province'],
									'status'			=> '1'
								];

			$result = $this->db->insert('city', $request1);
			$insertid = $this->db->insert_id();
		}else{

			$request2		=	[
				'updated_at' 		=> $datetime,
				'updated_by' 		=> $userid
			];

			if(isset($data['province'])) 	$request2['province_id'] 		= $data['province'];
			if(isset($data['city'])) 		$request2['city_id'] 			= $data['city'];
			if(isset($data['suburb'])) 		$request2['name'] 				= $data['suburb'];
			$request2['status'] 												= (isset($data['status'])) ? $data['status'] : '0';
	        
			if($id==''){
				$request2['created_at'] = $datetime;
				$request2['created_by'] = $userid;

				$result = $this->db->insert('suburb', $request2);
				$insertid = $this->db->insert_id();
			}else{
				$result = $this->db->update('suburb', $request2, ['id' => $id]);
				$insertid = $id;
			}
		}	

		if(!isset($result) && $this->db->trans_status() === FALSE)
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
	function checkUsername($username) {

        $this->db->select()->from('city')->where('name', $username);
        $query = $this->db->get();

        return $query->first_row('array'); // returns first row if has record in db
    }
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
	


		$this->db->select('*');
		$this->db->where('id', $id);
       $delete=$this->db->delete('suburb');   
    
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
	
	public function getListProvince($type, $requestdata=[])
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


	public function getListCity($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('city');

		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['name'])) 			$this->db->where('name', $requestdata['name']);
		if(isset($requestdata['provinceid'])) 		$this->db->where('province_id', $requestdata['provinceid']);
		if(isset($requestdata['status']))			$this->db->where_in('status', $requestdata['status']);
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getListSuburb($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('suburb');

		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['name'])) 			$this->db->where('name', $requestdata['name']);
		if(isset($requestdata['provinceid'])) 		$this->db->where('province_id', $requestdata['provinceid']);
		if(isset($requestdata['cityid'])) 			$this->db->where('city_id', $requestdata['cityid']);
		if(isset($requestdata['status']))			$this->db->where_in('status', $requestdata['status']);
		
		if($type=='count'){
			$result = $this->db->count_all_results();			
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	
	public function citynamevalidation($requestData)
	{	
		isset($requestData['id']) ? $requestData['id'] 	= $requestData['id'] : '';
		$data 				= $this->getListCity('row', $requestData);
		
		if($data){
			return '1';
		}else{
			return '0';
		}
	}
	
	public function suburbnamevalidation($requestData)
	{	
		isset($requestData['id']) ? $requestData['id'] 	= $requestData['id'] : '';
		$data 				= $this->getListSuburb('row', $requestData);
		
		if($data){
			return '1';
		}else{
			return '0';
		}
	}
}
