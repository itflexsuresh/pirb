<?php

class Company_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('installationtype');
		
		if(isset($requestdata['id'])) 		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'name', 'status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
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
		$datetime		= 	date('Y-m-d H:i:s');
		
		if(isset($data['title'])) 				$request1['title'] 				= $data['title'];
		if(isset($data['dob'])) 				$request1['dob'] 				= $data['dob'];
		if(isset($data['name'])) 				$request1['name'] 				= $data['name'];
		if(isset($data['surname'])) 			$request1['surname'] 			= $data['surname'];
		if(isset($data['gender'])) 				$request1['gender'] 			= $data['gender'];
		if(isset($data['racial'])) 				$request1['racial'] 			= $data['racial'];
		if(isset($data['nationality'])) 		$request1['nationality'] 		= $data['nationality'];
		if(isset($data['othernationality'])) 	$request1['othernationality'] 	= $data['othernationality'];
		if(isset($data['idcard'])) 				$request1['idcard'] 			= $data['idcard'];
		if(isset($data['otheridcard'])) 		$request1['otheridcard'] 		= $data['otheridcard'];
		if(isset($data['homelanguage'])) 		$request1['homelanguage'] 		= $data['homelanguage'];
		if(isset($data['disability'])) 			$request1['disability'] 		= $data['disability'];
		if(isset($data['citizen'])) 			$request1['citizen'] 			= $data['citizen'];
		
		if(isset($request1)){
			$plumber 				= $this->checkPlumber('1');
			$request1['user_id'] 	= $plumber['userid'];
			
			if(isset($plumber['id'])){
				$plumber = $this->db->update('plumber', $request1, ['id' => $plumber['id']]);
			}else{
				$plumber = $this->db->insert('plumber', $request1);
			}
		}
		
		if(isset($data['registration_card'])) 	$request2['registration_card'] 	= $data['registration_card'];
		if(isset($data['delivery_card'])) 		$request2['delivery_card'] 		= $data['delivery_card'];
		if(isset($data['employment_details'])) 	$request2['employment_details'] = $data['employment_details'];
		if(isset($data['company_details'])) 	$request2['company_details'] 	= $data['company_details'];
		if(isset($data['home_phone'])) 			$request2['home_phone'] 		= $data['home_phone'];
		if(isset($data['mobile_phone'])) 		$request2['mobile_phone'] 		= $data['mobile_phone'];
		if(isset($data['work_phone'])) 			$request2['work_phone'] 		= $data['work_phone'];
		if(isset($data['email'])) 				$request2['email'] 				= $data['email'];
		
		if(isset($request2)){
			$plumberdetails 		= $this->checkPlumber('2');
			$request2['user_id'] 	= $plumberdetails['userid'];
			
			if(isset($plumberdetails['id'])){
				$plumberdetails = $this->db->update('plumber_details', $request2, ['id' => $plumberdetails['id']]);
			}else{
				$plumberdetails = $this->db->insert('plumber_details', $request2);
			}
		}

		if(isset($data['name'])) 				$request3['name'] 		= $data['name'];
		if(isset($data['number'])) 				$request3['number'] 	= $data['number'];
		if(isset($data['vat'])) 				$request3['vat'] 		= $data['vat'];
		if(isset($data['address'])) 			$request3['address'] 	= $data['address'];
		if(isset($data['suburb'])) 				$request3['suburb'] 	= $data['suburb'];
		if(isset($data['city'])) 				$request3['city'] 		= $data['city'];
		if(isset($data['province'])) 			$request3['province'] 	= $data['province'];		
		if(isset($data['postal_code'])) 		$request3['postal_code']= $data['postal_code'];
		$request3['type'] 		=	3;

		if(isset($request3)){
			$plumberaddress 		= $this->checkPlumber('3','3');
			$request3['user_id'] 	= $plumberaddress['userid'];
			
			if(isset($plumberaddress['id'])){
				$plumberaddress = $this->db->update('plumber_address', $request3, ['id' => $plumberaddress['id']]);
			}else{
				$plumberaddress = $this->db->insert('plumber_address', $request3);
			}
		}

		if(isset($data['phy_address'])) 			$request4['address'] 	= $data['phy_address'];
		if(isset($data['phy_suburb'])) 				$request4['suburb'] 	= $data['phy_suburb'];
		if(isset($data['phy_city'])) 				$request4['city'] 		= $data['phy_city'];
		if(isset($data['phy_province'])) 			$request4['province'] 	= $data['phy_province'];
		$request4['type'] 		=	1;

		if(isset($request4)){
			$plumberaddress_phy 		= $this->checkPlumber('3','1');
			$request4['user_id'] 		= $plumberaddress_phy['userid'];
			
			if(isset($plumberaddress_phy['id'])){
				$plumberaddress_phy = $this->db->update('plumber_address', $request4, ['id' => $plumberaddress_phy['id']]);
			}else{
				$plumberaddress_phy = $this->db->insert('plumber_address', $request4);
			}
		}

		if(isset($data['post_address'])) 			$request5['address'] 	= $data['post_address'];
		if(isset($data['post_suburb'])) 			$request5['suburb'] 	= $data['post_suburb'];
		if(isset($data['post_city'])) 				$request5['city'] 		= $data['post_city'];
		if(isset($data['post_province'])) 			$request5['province'] 	= $data['post_province'];
		$request5['type'] 		=	2;

		if(isset($request5)){
			$plumberaddress_post 		= $this->checkPlumber('3','2');
			$request5['user_id'] 		= $plumberaddress_post['userid'];
			
			if(isset($plumberaddress_post['id'])){
				$plumberaddress_post = $this->db->update('plumber_address', $request5, ['id' => $plumberaddress_post['id']]);
			}else{
				$plumberaddress_post = $this->db->insert('plumber_address', $request5);
			}
		}
		
			
		if((isset($plumber) || isset($plumberdetails)) && $this->db->trans_status() === FALSE)
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
	
	public function checkPlumber($type,$type_val='')
	{
		$userid		= 	$this->getUserID();
		
		if($type=='1'){
			$data = $this->db->where('user_id', $userid)->get('plumber')->row_array();
		}elseif($type=='2'){
			$data = $this->db->where('user_id', $userid)->get('plumber_details')->row_array();
		}elseif($type=='3'){
			$data = $this->db->where(array('user_id'=>$userid,'type'=>$type_val))->get('plumber_address')->row_array();			
		}elseif($type=='4'){
			$data = $this->db->where('user_id', $userid)->get('plumber_skills')->row_array();
		}
		
		if($data){
			return ['id' => $data['id'], 'userid' => $data['user_id']];
		}else{
			return ['userid' => $userid];
		}
	}
}