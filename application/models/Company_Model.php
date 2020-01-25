<?php

class Company_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('t1.status,t2.company_name,t2.id AS id');
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
		if(isset($data['contact'])) 			$request3['contact_person'] 			= $data['contact'];
		if(isset($data['work_phone'])) 			$request3['work_phone'] 		= $data['work_phone'];
		if(isset($data['primary_phone'])) 		$request3['mobile_phone'] 		= $data['primary_phone'];
		if(isset($data['email_address']))		$request3['email'] 				= $data['email_address'];

		if(isset($request3)){
			
			
			if(isset($data['id_user'])){
				$request2['user_id'] = $data['id_user'];
				$company_details = $this->db->update('users_detail', $request3, ['user_id' => $data['id_user']]);
			}else{
				$request3['user_id'] 	= $userid;
				$company_details = $this->db->insert('users_detail', $request3);
				$company_details = $this->db->update('users', ['flag' => '1'], ['id' => $request3['user_id']]);
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
		$this->db->select('created_at');
		$this->db->from('users');
		$this->db->where('id', "$id");
		
		$query = $this->db->get();
		$result = $query->row_array();

		return $result;
		}
	}
}