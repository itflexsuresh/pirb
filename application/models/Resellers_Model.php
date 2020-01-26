<?php

class Resellers_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		$usersdetail 	= ['ud.id as usersdetailid','ud.title','ud.name','ud.surname','ud.dob','ud.gender','ud.company_name','ud.reg_no','ud.vat_no','ud.contact_person','ud.home_phone','ud.mobile_phone','ud.work_phone','ud.email','ud.file1','ud.file2'];
		$usersplumber 	= ['up.id as usersplumberid','up.racial','up.nationality','up.othernationality','up.idcard','up.otheridcard','up.homelanguage','up.disability','up.citizen','up.registration_card','up.delivery_card','up.employment_details','up.company_details','up.designation'];
		
		$this->db->select('
			u.id,
			u.status,
			'.implode(',', $usersdetail).',
			'.implode(',', $usersplumber).',
			concat_ws("@-@", ua1.id, ua1.user_id, ua1.address, ua1.suburb, ua1.city, ua1.province, ua1.postal_code, ua1.type)  as physicaladdress,
			concat_ws("@-@", ua2.id, ua2.user_id, ua2.address, ua2.suburb, ua2.city, ua2.province, ua2.postal_code, ua2.type)  as postaladdress,
			concat_ws("@-@", ua3.id, ua3.user_id, ua3.address, ua3.suburb, ua3.city, ua3.province, ua3.postal_code, ua3.type)  as billingaddress,
			group_concat(concat_ws("@@@", ups.id, ups.user_id, ups.date, ups.certificate, ups.skills, ups.training, ups.attachment, qr.name) separator "@-@") as skills
		');
		$this->db->from('users u');
		$this->db->join('users_detail ud', 'ud.user_id=u.id', 'left');
		$this->db->join('users_address ua1', 'ua1.user_id=u.id and ua1.type="1"', 'left');
		$this->db->join('users_address ua2', 'ua2.user_id=u.id and ua2.type="2"', 'left');
		$this->db->join('users_address ua3', 'ua3.user_id=u.id and ua3.type="3"', 'left');
		$this->db->join('users_plumber up', 'up.user_id=u.id', 'left');
		$this->db->join('users_plumber_skill ups', 'ups.user_id=u.id', 'left');
		$this->db->join('qualificationroute qr', 'qr.id=ups.skills', 'left');
		
		if(isset($requestdata['id'])) 		$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('u.status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['u.id', 'ud.name'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('ud.name', $searchvalue);
		}
		
		$this->db->group_by('u.id');
		
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

			foreach($data['address'] as $key => $request){
			$request['type'] = $key;
			
			if(isset($data['id_user'])){
			$request['user_id'] = $data['id_user'];
				
			$company_details = $this->db->update('users_address', $request, ['user_id' => $data['id_user'],'type' => $request['type']]);
			}
			else{
			$request['user_id'] 	= $userid;	
			$company_address= $this->db->insert('users_address', $request);
			}
		 }
		}
	
		if(isset($data['comapny_name'])) 				$$request2['company_name'] 		= $data['comapny_name'];
		if(isset($data['name'])) 						$$request2['company_name'] 		= $data['name'];
		if(isset($data['surname'])) 					$$request2['surname'] 			= $data['surname'];
		if(isset($data['work_phone'])) 					$$request2['work_phone'] 		= $data['work_phone'];
		if(isset($data['mobile_phone'])) 				$$request2['mobile_phone'] 		= $data['mobile_phone'];
		if(isset($data['email']))						$$request2['email'] 			= $data['email'];
		if(isset($data['billing_name']))				$$request2['email'] 			= $data['billing_name'];
		if(isset($data['reg_num'])) 					$$request2['reg_no'] 			= $data['reg_num'];
		if(isset($data['vat_num'])) 					$$request2['vat_no'] 			= $data['vat_num'];

		if(isset($$request2)){
			if(isset($data['id_user'])){
				$request['user_id'] 	= $data['id_user'];
				$company_details 		= $this->db->update('users_detail', $$request2, ['user_id' => $data['id_user']]);
			}else{
				$$request2['user_id'] 	= $userid;
				$company_details	    = $this->db->insert('users_detail', $$request2);
				$company_details 		= $this->db->update('users', ['flag' => '1'], ['id' => $$request2['user_id']]);
			}
		}
	}
}