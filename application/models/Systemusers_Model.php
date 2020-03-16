<?php

class Systemusers_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('ist.name, ist.surname, ist.comments, ist.read_permission, ist.write_permission, it.id, it.type, it.email, it.status, it.roletype,  it.password_raw, it.type as userdetails')->order_by('it.id','desc');
        $this->db->from('users_detail as ist');
        $query = $this->db->join('users as it', 'it.id = ist.user_id', 'left');

		if(isset($requestdata['id'])) $this->db->where('it.id', $requestdata['id']);
		if(isset($requestdata['status'])) $this->db->where_in('it.status', $requestdata['status']);
		if(isset($requestdata['u_type'])) $this->db->where_in('it.type', $requestdata['u_type']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['it.id', 'ist.name', 'ist.surname', 'it.password_raw', 'ist.email', 'it.type', 'it.status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();
				$this->db->like('ist.name', $searchvalue);
				$this->db->or_like('ist.surname', $searchvalue);
				$this->db->or_like('it.password_raw', $searchvalue);
				$this->db->or_like('it.type', $searchvalue);
				$this->db->or_like('it.status', $searchvalue);
				$this->db->or_like('it.id', $searchvalue);
			$this->db->group_end();
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
		
		$request = 	[
						'type' 				=> '2',
						'mailstatus' 		=> '1',
						'formstatus' 		=> '1',
						'created_at' 		=> $datetime,
						'created_by' 		=> $userid
					];
					
	    if(isset($data['type']))   		$request['roletype'] 		= $data['type'];
		if(isset($data['email'])) 	  	$request['email'] 			= $data['email'];
        if(isset($data['password']))   	$request['password'] 		= md5($data['password']); 
        if(isset($data['password']))   	$request['password_raw'] 	= $data['password']; 
        $request['status'] 	= (isset($data['status'])) ? $data['status'] : '2';

        if(isset($data['name']))		$request1['name'] = $data['name'];
        if(isset($data['surname']))     $request1['surname'] = $data['surname'];
        if(isset($data['comments']))   	$request1['comments'] = $data['comments'];
        if(isset($data['read']))   		$request1['read_permission'] = implode(',',$data['read']);
        if(isset($data['write']))   	$request1['write_permission'] = implode(',',$data['write']);
         

        if($id!=''){
			if(isset($request)) $this->db->update('users', $request, ['id' => $id]);
			if(isset($request1)) $this->db->update('users_detail', $request1, ['user_id' => $id]);
        }else{
			if(isset($request)){
				$this->db->insert('users', $request);
				if(isset($request1)){
					$request1['user_id'] = $this->db->insert_id();
					$usersdetail = $this->db->insert('users_detail', $request1);
				}
			}       
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
	
	public function emailValidator($data)
	{	  
		$id = $data['id'];
		$this->db->where_in('type', array('1', '2'));
		$this->db->where('email', $data['email']);

		if($id!='') $this->db->where('id !=', $id);
		$query = $this->db->get('users');

		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
		}
	}


	public function getPermissions()
	{ 
		$this->db->select('system_user_permission.*,system_user_category.name as cat_name');
		$this->db->from('system_user_permission');
		$this->db->join('system_user_category', 'system_user_permission.category_id = system_user_category.id');

		
		$query = $this->db->get();

		return $query->result();
	}
}



