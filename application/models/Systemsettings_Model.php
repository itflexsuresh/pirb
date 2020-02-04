<?php

class Systemsettings_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('
			sd.*,
			CONCAT_WS("@-@", sa1.id,  sa1.address, sa1.suburb, sa1.city, sa1.province, sa1.postal_code, sa1.type) as physical,
			CONCAT_WS("@-@", sa2.id,  sa2.address, sa2.suburb, sa2.city, sa2.province, sa2.postal_code, sa2.type) as postal,
			GROUP_CONCAT(CONCAT_WS("@-@", cpd.id,  cpd.cpd_id, cpd.master, cpd.licensed, cpd.operating, cpd.assistant, cpd.learner) SEPARATOR "@@@") as cpd
			');
		$this->db->from('settings_details sd');
		$this->db->join('settings_address sa1', 'sa1.type="1"', 'left');
		$this->db->join('settings_address sa2', 'sa2.type="2"', 'left');
		$this->db->join('settings_cpd cpd','1=1', 'left');
		

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
		
		$physical_id 			= 	$data['physical_id'];
		$postal_id 				= 	$data['postal_id'];
		$cpd_id1				=	$data['cpd_id1'];
		$cpd_id2				=	$data['cpd_id2'];
		$cpd_id3				=	$data['cpd_id3'];
		$details_id 			= 	$data['details_id'];
		
		if(isset($data['company_name'])) 			$request1['company_name'] 				= $data['company_name'];
		if(isset($data['reg_no'])) 					$request1['reg_no'] 					= $data['reg_no'];
		if(isset($data['vat_no'])) 					$request1['vat_no'] 					= $data['vat_no'];
		if(isset($data['bank_name'])) 				$request1['bank_name'] 					= $data['bank_name'];
		if(isset($data['branch_code'])) 			$request1['branch_code'] 				= $data['branch_code'];
		if(isset($data['account_name'])) 			$request1['account_name'] 				= $data['account_name'];
		if(isset($data['account_no'])) 				$request1['account_no'] 				= $data['account_no'];
		if(isset($data['account_type'])) 			$request1['account_type'] 				= $data['account_type'];
		if(isset($data['vat_percentage'])) 			$request1['vat_percentage'] 			= $data['vat_percentage'];
		if(isset($data['system_email'])) 			$request1['system_email']		 		= $data['system_email'];
		if(isset($data['email']))		 			$request1['email']		 				= $data['email'];
		if(isset($data['work_phone'])) 				$request1['work_phone']		 			= $data['work_phone'];
		if(isset($data['plumber_certificate'])) 	$request1['plumber_certificate'] 		= $data['plumber_certificate'];
		if(isset($data['reseller_certificate'])) 	$request1['reseller_certificate'] 		= $data['reseller_certificate'];
		if(isset($data['refix_period'])) 			$request1['refix_period'] 				= $data['refix_period'];
		if(isset($data['audit_percentage'])) 		$request1['audit_percentage'] 			= $data['audit_percentage'];
		if(isset($data['penalty'])) 				$request1['penalty'] 					= $data['penalty'];
		if(isset($data['expired'])) 				$request1['expired']				 	= $data['expired'];


		if(isset($data['address1'][1]['address'])) 			$physical['address']				= $data['address1'][1]['address'];
		if(isset($data['address1'][1]['suburb'])) 			$physical['suburb']				 	= $data['address1'][1]['suburb'];
		if(isset($data['address1'][1]['city'])) 			$physical['city']				 	= $data['address1'][1]['city'];
		if(isset($data['address1'][1]['province'])) 		$physical['province']				= $data['address1'][1]['province'];
		if(isset($data['address1'][1]['type'])) 			$physical['type']				 	= $data['address1'][1]['type'];

		if(isset($data['address1'][2]['address'])) 			$postal['address']					= $data['address1'][2]['address'];
		if(isset($data['address1'][2]['suburb'])) 			$postal['suburb']				 	= $data['address1'][2]['suburb'];
		if(isset($data['address1'][2]['city'])) 			$postal['city']				 		= $data['address1'][2]['city'];
		if(isset($data['address1'][2]['province'])) 		$postal['province']					= $data['address1'][2]['province'];
		if(isset($data['address1'][2]['postal_code'])) 		$postal['postal_code']				= $data['address1'][2]['postal_code'];
		if(isset($data['address1'][2]['type'])) 			$postal['type']				 		= $data['address1'][2]['type'];

		/// CPD POINTS

		if(isset($data['cpd'][1]['master'])) 			$developemental['master']				= $data['cpd'][1]['master'];
		if(isset($data['cpd'][1]['licensed'])) 			$developemental['licensed']				= $data['cpd'][1]['licensed'];
		if(isset($data['cpd'][1]['operating'])) 		$developemental['operating']			= $data['cpd'][1]['operating'];
		if(isset($data['cpd'][1]['assistant'])) 		$developemental['assistant']			= $data['cpd'][1]['assistant'];
		if(isset($data['cpd'][1]['learner'])) 			$developemental['learner']				= $data['cpd'][1]['learner'];

		if(isset($data['cpd'][2]['master'])) 			$workbased['master']					= $data['cpd'][2]['master'];
		if(isset($data['cpd'][2]['licensed'])) 			$workbased['licensed']					= $data['cpd'][2]['licensed'];
		if(isset($data['cpd'][2]['operating'])) 		$workbased['operating']					= $data['cpd'][2]['operating'];
		if(isset($data['cpd'][2]['assistant'])) 		$workbased['assistant']					= $data['cpd'][2]['assistant'];
		if(isset($data['cpd'][2]['learner'])) 			$workbased['learner']					= $data['cpd'][2]['learner'];

		if(isset($data['cpd'][3]['master'])) 			$individual['master']					= $data['cpd'][3]['master'];
		if(isset($data['cpd'][3]['licensed'])) 			$individual['licensed']					= $data['cpd'][3]['licensed'];
		if(isset($data['cpd'][3]['operating'])) 		$individual['operating']				= $data['cpd'][3]['operating'];
		if(isset($data['cpd'][3]['assistant'])) 		$individual['assistant']				= $data['cpd'][3]['assistant'];
		if(isset($data['cpd'][3]['learner'])) 			$individual['learner']					= $data['cpd'][3]['learner'];
// echo "<pre>";
// 		print_r($request1);die;

		if(isset($request1)){
			if($details_id==''){
				$settingsdetails = $this->db->insert('settings_details', $request1);
			}else{
				$settingsdetails = $this->db->update('settings_details', $request1, ['id' => $details_id]);
			}
		}

		if(isset($physical)){
			if($physical_id==''){
				$settingsaddress = $this->db->insert('settings_address', $physical);
			}else{
				$settingsaddress = $this->db->update('settings_address', $physical, ['id' => $physical_id]);
			}			
		}
		if(isset($postal)){
			if($postal_id==''){
				$settingsaddress1 = $this->db->insert('settings_address', $postal);
			}else{
				$settingsaddress1 = $this->db->update('settings_address', $postal, ['id' => $postal_id]);
			}
		}

		/// CPD POINTS

		if(isset($developemental)){
			if($cpd_id1==''){
				$points1 = $this->db->insert('settings_cpd', $developemental);
			}else{
				$points1 = $this->db->update('settings_cpd', $developemental, ['id' => $cpd_id1]);
			}
		}

		if(isset($workbased)){
			if($cpd_id2==''){
				$points2 = $this->db->insert('settings_cpd', $workbased);
			}else{
				$points2 = $this->db->update('settings_cpd', $workbased, ['id' => $cpd_id2]);
			}
		}

		if(isset($individual)){
			if($cpd_id2==''){
				$points3 = $this->db->insert('settings_cpd', $individual);
			}else{
				$points3 = $this->db->update('settings_cpd', $individual, ['id' => $cpd_id3]);
			}
		}

		if((isset($settingsdetails) || isset($settingsaddress) || isset($points1) || isset($points2) || isset($points3)) && $this->db->trans_status() === FALSE)
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