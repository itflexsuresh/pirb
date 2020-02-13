<?php

class Company_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('t2.status,t2.company_name,t2.id AS id');
		$this->db->from('users t1');
		$this->db->join('users_detail t2', 't1.id=t2.user_id', 'INNER');
		$this->db->where('type', '4');

		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		//if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'company_name'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('company_name', $searchvalue);
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

	public function get_plumber_List($type, $requestdata=[])
	{
		
		$this->db->select('t1.registration_no,t1.designation,t1.status,t1.id,t1.user_id,t2.name,t2.surname,t2.mobile_phone,t3.email,t2.file2,t1.specialisations');
		$this->db->from('users_plumber t1');
		$this->db->join('users_detail t2', 't2.user_id = t1.user_id', 'INNER');
		$this->db->join('users t3', 't3.id = t1.user_id', 'INNER');
		if($type=='employee'){
			//print_r
			$this->db->where('t1.id', $requestdata['id']);
		}else{
			$this->db->where('t1.company_details', $requestdata['id']);
		}
		

		// if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		// //if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		// if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
		// 	$column = ['id', 'company_name'];
		// 	$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		// }
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('t2.name', $searchvalue);
		}

		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}
		elseif($type=='employee'){
			$query = $this->db->get();
			
			$result = $query->result_array();
		}
		else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	// public function get_plumber($id)
	// {
	// 	$this->db->select('t1.registration_no,t1.designation,t1.status,t1.user_id,t2.name,t2.surname');
	// 	$this->db->from('users_plumber t1');
	// 	$this->db->join('users_detail t2', 't2.user_id = t1.user_id', 'INNER');
	// 	$this->db->where('t1.company_details', $id);


	// }
	
	public function action($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$datetime		= 	date('Y-m-d H:i:s');

		if(isset($data['address']) && count($data['address'])){

			foreach($data['address'] as $key => $request2){
			$request2['type'] = $key;
			
			if(isset($data['id_user'])){
			$request2['user_id'] = $data['id_user'];
				
			$company_details = $this->db->update('users_address', $request2, ['user_id' => $data['id_user'],'type' => $request2['type']]);
			}
			else{
			$request2['user_id'] 	= $userid;	
			$company_address= $this->db->insert('users_address', $request2);
			}
		 }
		}
	
		if(isset($data['name'])) 				$request3['company_name'] 		= $data['name'];
		if(isset($data['reg_num'])) 			$request3['reg_no'] 			= $data['reg_num'];
		if(isset($data['vat_num'])) 			$request3['vat_no'] 			= $data['vat_num'];
		if(isset($data['contact'])) 			$request3['contact_person'] 	= $data['contact'];
		if(isset($data['work_phone'])) 			$request3['work_phone'] 		= $data['work_phone'];
		if(isset($data['primary_phone'])) 		$request3['mobile_phone'] 		= $data['primary_phone'];
		if(isset($data['worktype'])) 			$request3['work_type'] 			= $data['worktype'];
		if(isset($data['specilisations'])) 		$request3['specialisations']	= $data['specilisations'];
		if(isset($data['status'])) 				$request3['status']				= $data['status'];
		if(isset($data['company_message'])) 	$request3['comments']			= $data['company_message'];

		//if(isset($data['email_address']))		$request3['email'] 				= $data['email_address'];

		if(isset($request3)){
			
			
			if(isset($data['id_user'])){
				$request2['user_id'] = $data['id_user'];
				$company_details = $this->db->update('users_detail', $request3, ['user_id' => $data['id_user']]);
			}else{
				$request3['user_id'] 	= $userid;
				$company_details = $this->db->insert('users_detail', $request3);
				$company_details = $this->db->update('users', ['formstatus' => '1'], ['id' => $request3['user_id']]);
			}
		}
		if((isset($company_address) || isset($company_details)) && $this->db->trans_status() === FALSE)
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

	public function edit_company($id)
	{
		if($id!=''){
		$this->db->select('*');
		$this->db->from('users_detail');
		$this->db->where('id', "$id");

		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
		}
	}
	public function get_user_details($id)
	{
		if($id!=''){
		$this->db->select('*');
		$this->db->from('users_address');
		$this->db->where('user_id', "$id");

		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
		}
	}
	public function get_register_date($id)
	{
		if($id!=''){
		$this->db->select('email,created_at');
		$this->db->from('users');
		$this->db->where('id', "$id");
		
		$query = $this->db->get();
		$result = $query->row_array();

		return $result;
		}
	}
	public function get_company($id)
	{
		if($id!=''){
		$this->db->select('*');
		$this->db->from('users_detail');
		$this->db->where('user_id', "$id");
		
		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
		}
	}
}