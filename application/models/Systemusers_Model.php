<?php

class Systemusers_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{

		$this->db->select('ist.name, ist.surname, ist.comments, ist.read_permission, ist.write_permission, it.id, it.type, it.email, it.status,  it.password_raw, it.type as userdetails')->order_by('it.id','desc');
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
			$this->db->like('ist.name', $searchvalue);
            $this->db->or_like('ist.surname', $searchvalue);
            $this->db->or_like('it.password_raw', $searchvalue);
            $this->db->or_like('it.type', $searchvalue);
            $this->db->or_like('it.status', $searchvalue);
            $this->db->or_like('it.id', $searchvalue);
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
		$id = $data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request = [
                      'created_at' => $datetime,
                       'created_by' => $userid
                   ];
        $md5pass = md5($data['password']);
	    if(isset($data['type']))   $request['type'] = $data['type'];
		if(isset($data['email'])) 	   $request['email'] 	= $data['email'];
		if(isset($md5pass))   $request['password'] = $md5pass;
        if(isset($data['password']))   $request['password_raw'] = $data['password']; 
        if(isset($data['status']))   $request['status'] = $data['status'];
        if(isset($data['name']))   $request1['name'] = $data['name'];
        if(isset($data['surname']))     $request1['surname'] = $data['surname'];
        if(isset($data['comments']))   $request1['comments'] = $data['comments'];

        if(isset($data['read']))   $request1['read_permission'] = implode(',',$data['read']);
        if(isset($data['write']))   $request1['write_permission'] = implode(',',$data['write']);


if($id!=''){
$this->db->update('users', $request, ['id' => $id]);
$this->db->update('users_detail', $request1, ['user_id' => $id]);
}else{
	if(isset($request)){
$audior_details = $this->db->insert('users', $request);
$request1['user_id'] = $this->db->insert_id();
}
if (isset($request1)) {
$usersdetail = $this->db->insert('users_detail', $request1);
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
	public function emailValidator($data)
{
$id = $data['id'];
$user_email = $data['email'];
$this->db->where('email', $user_email);
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
