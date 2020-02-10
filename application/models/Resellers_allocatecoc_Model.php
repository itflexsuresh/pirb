<?php

class Resellers_allocatecoc_Model extends CC_Model
{
	public function getqty($type, $requestdata=[])
	{ 
		
		$this->db->select('sum(quantity) as sumqty');
		$this->db->from('coc_orders');

		if(isset($requestdata['user_id']))	$this->db->where('user_id', $requestdata['user_id']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getrange($type, $requestdata=[])
	{ 
		
		$this->db->select('*');
		$this->db->from('stock_management');	

		if(isset($requestdata['coc_status']))	$this->db->where('coc_status', $requestdata['coc_status']);
		if(isset($requestdata['type']))	$this->db->where('type', $requestdata['type']);



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
		
		$datetime				= 	date('Y-m-d H:i:s');
		$idarray				= 	[];

		$request['createddate'] = $datetime;
		$request['resellersid'] = $this->getUserID();
		if(isset($data['plumberid'])) 			$request['plumberid'] 			= $data['plumberid'];
		if(isset($data['startrange'])) 			$request['startrange'] 			= $data['startrange'];
		if(isset($data['endrange'])) 			$request['endrange'] 			= $data['endrange'];
		if(isset($data['invoiceno'])) 			$request['invoiceno'] 			= $data['invoiceno'];
		
		if(isset($request)){					
			$users = $this->db->insert('plumberallocate', $request);
			$usersid = $this->db->insert_id();
			$idarray['usersdetailid'] = $usersid;
			
			$range = $data['rangebalace_coc'];
			$startrange = $data['startrange'];
			// echo  $range;		
			for($i=0; $i < $range; $i++){
				$request2['coc_status'] = '4';
				$request2['user_id'] = $data['plumberid'];
				$updateid = $startrange + $i;	
				echo  $updateid.",";	
				$users1 = $this->db->update('stock_management', $request2, ['id' => $updateid]);

			}
			
		}			
				
		if((isset($users)) && $this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $idarray;
		}
	}

	public function getamount($type, $requestdata=[])
	{ 
		
		$this->db->select('amount');
		$this->db->from('rates');

		if(isset($requestdata['supplyitem']))	$this->db->where('supplyitem', $requestdata['supplyitem']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getvat($type, $requestdata=[])
	{ 
		
		$this->db->select('vat_percentage');
		$this->db->from('settings_details');

		if(isset($requestdata['settingid']))	$this->db->where('id', $requestdata['settingid']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
}