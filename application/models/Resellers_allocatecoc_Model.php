<?php

class Resellers_allocatecoc_Model extends CC_Model
{
	
	public function autosearchPlumber($postData){ 
		
		$designations = array('4', '5', '6' );
		$this->db->select('u1.name,u1.surname,u2.id,u1.coc_purchase_limit');
		$this->db->from('users_detail u1');
		$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','inner');
		$this->db->join('users_plumber up', 'up.user_id=u1.user_id','inner');
		$this->db->where_in('up.designation', $designations);
		$this->db->like('u1.name',$postData['search_keyword']);
		// $this->db->or_like('u1.surname',$postData['search_keyword']);
		$this->db->group_by("u1.id");		
		$query = $this->db->get();
		$result1 = $query->result_array(); 

		if (empty($result1)) {
			$this->db->select('u1.name,u1.surname,u2.id,u1.coc_purchase_limit');
			$this->db->from('users_detail u1');
			$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','inner');
			$this->db->join('users_plumber up', 'up.user_id=u1.user_id','inner');
			$this->db->where_in('up.designation', $designations);
			$this->db->like('u1.surname',$postData['search_keyword']);
			$this->db->group_by("u1.id");		
			$query = $this->db->get();
			$result = $query->result_array();
		}
		else{
			$result = $result1;
		}

		// print_r($result);
		// echo $this->db->last_query();

		return $result;

	}

	public function getstockList($type, $requestdata=[]){ 		

		$this->db->select('sm.*,ud.name as name,ud.surname as surname,up.registration_no as registration_no,pa.invoiceno as invoiceno,pd.company_name as company ');
		$this->db->from('stock_management sm');
		$this->db->join('plumberallocate pa', 'pa.stockid=sm.id','left');
		$this->db->join('users_detail ud', 'ud.user_id=sm.user_id','left');
		$this->db->join('users_plumber up', 'up.user_id=sm.user_id','left');
		$this->db->join('users_detail pd', 'pd.id=pa.company_details', 'left');
		$this->db->where('sm.type', '2');
		$this->db->where('sm.coc_status', '3');

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['sm.id','sm.id','sm.id','sm.id','sm.id','sm.id'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower((trim($requestdata['search']['value'])));
			if($searchvalue === 'allocated'){
				$this->db->where('sm.allocatedby',$requestdata['user_id']);
			}
			elseif($searchvalue === 'in stock'){
				$this->db->where('sm.user_id',$requestdata['user_id']);
			}
			else{
				$this->db->like('sm.id', $searchvalue);
				$this->db->or_like('pa.invoiceno', $searchvalue);
				$this->db->or_like('ud.name', $searchvalue);
				$this->db->or_like('ud.surname', $searchvalue);
				$this->db->or_like('up.registration_no', $searchvalue);
				$this->db->or_like('pd.company_name', $searchvalue);
			}
		}
		else{
			$this->db->where('sm.user_id',$requestdata['user_id']);
			$this->db->or_where('sm.allocatedby',$requestdata['user_id']);
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

	public function getqty($type, $requestdata=[])
	{ 
		
		$this->db->select('count as sumqty');
		$this->db->from('coc_count');

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
		if(isset($data['company_details'])) 			$request['company_details'] 			= $data['company_details'];
		
		if(isset($request)){
			$range = $data['rangebalace_coc'];	
			$startrange = $data['startrange'];	

			for($i=0; $i < $range; $i++){	
				$request['stockid'] =	$startrange + $i;
				$users = $this->db->insert('plumberallocate', $request);
				$usersid = $this->db->insert_id();
				// $idarray['usersdetailid'] = $usersid;
			}			
						
			for($i=0; $i < $range; $i++){
				$request2['coc_status'] = '4';
				$request2['user_id'] = $data['plumberid'];
				$request2['allocation_date'] = $datetime;
				$request2['allocatedby'] = $this->getUserID();
				$updateid = $startrange + $i;	
				$users1 = $this->db->update('stock_management', $request2, ['id' => $updateid]);

			}

			
			$balace_coc = $data['balace_coc1'];
			$rangebalace_coc = $data['rangebalace_coc'];
			$coccount = $balace_coc-$rangebalace_coc;
			$cocupdateid = $data['plumberid'];
			$request10['count'] = $coccount;
			$users10 = $this->db->update('coc_count', $request10, ['user_id' => $cocupdateid]);

			$resellersid = $this->getUserID();
			$this->db->select('*');
			$this->db->from('coc_count');
			$this->db->where('user_id',$resellersid);
			$query_resel = $this->db->get();
			$result_resel = $query_resel->row_array();

			$balace_coc2 = $result_resel['count'];
			$coccount2 = $balace_coc2-$rangebalace_coc;
			$request11['count'] = $coccount2;
			$users11 = $this->db->update('coc_count', $request11, ['user_id' => $resellersid]);
			
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