<?php

class Systemsettings_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('
			sd.*,
			GROUP_CONCAT(CONCAT_WS("@-@", sa1.id,  sa1.address, sa1.suburb, sa1.city, sa1.province, sa1.postal_code, sa1.type) SEPARATOR "@@@") as address,
			GROUP_CONCAT(CONCAT_WS("@-@", cpd.id,  cpd.cpd_id, cpd.master, cpd.licensed, cpd.operating, cpd.assistant, cpd.learner) SEPARATOR "@@@") as cpd
		');
		$this->db->from('settings_details sd');
		$this->db->join('settings_address sa1','1=1', 'left');
		$this->db->join('settings_address sa2','1=1', 'left');
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
		
		$address_id 			= 	$data['address_id'];
		$details_id 			= 	$data['details_id'];
		$cpd_id 				= 	$data['cpd_id'];
		
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
		if(isset($data['work_phone'])) 				$request1['work_phone']		 			= $data['work_phone'];
		if(isset($data['plumber_certificate'])) 	$request1['plumber_certificate'] 		= $data['plumber_certificate'];
		if(isset($data['reseller_certificate'])) 	$request1['reseller_certificate'] 		= $data['reseller_certificate'];
		if(isset($data['refix_period'])) 			$request1['refix_period'] 				= $data['refix_period'];
		if(isset($data['audit_percentage'])) 		$request1['audit_percentage'] 			= $data['audit_percentage'];
		if(isset($data['penalty'])) 				$request1['penalty'] 					= $data['penalty'];
		if(isset($data['expired'])) 				$request1['expired']				 	= $data['expired'];

		if(isset($request1)){
			if($details_id==''){
				$settingsdetails = $this->db->insert('settings_details', $request1, ['id' => $details_id]);
			}else{
				$settingsdetails = $this->db->update('settings_details', $request1);
			}
		}

		if(isset($data['address1']) && count($data['address1'])){
			foreach($data['address1'] as $key => $request2){
				$request2['type'] = $key;
				$settingsaddress = $this->db->insert('settings_address', $request2);
			}
		}

		if(isset($data['address']) && count($data['address'])){
			foreach($data['address'] as $key => $request3){
				$settingsaddress = $this->db->insert('settings_cpd', $request3);
			}
		}

		if(isset($request2)){
			if($address_id==''){
				$settingsaddress = $this->db->insert('settings_address', $request2, ['id' => $address_id]);
			}else{
				$settingsaddress = $this->db->update('settings_address', $request2);
			}
		}

		if(isset($data['cpd']) && count($data['cpd'])){
			foreach($data['cpd'] as $key => $value){
				if(isset($value[0])) 	$request3['master']		= $value[0];
				if(isset($value[1])) 	$request3['licensed']	= $value[1];
				if(isset($value[2])) 	$request3['operating']	= $value[2];
				if(isset($value[3])) 	$request3['assistant']	= $value[3];
				if(isset($value[4])) 	$request3['learner']	= $value[4];

				if(isset($request3)){
					
						$settingsaddress = $this->db->insert('settings_cpd', $request3);
					
				}
			}
		}

		if((isset($settingsdetails) || isset($settingsaddress) || isset($settingscpd)) && $this->db->trans_status() === FALSE)
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
}