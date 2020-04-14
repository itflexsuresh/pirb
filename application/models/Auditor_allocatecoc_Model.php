<?php

class Auditor_allocatecoc_Model extends CC_Model
{

	public function getList($type, $requestdata=[])
	{ 
		$this->db->select('
			sm.id,
			sm.user_id,
			concat(ud.name, " ", ud.surname) as plumbername,
			up.registration_no as regno,
			cd.company,
			c.name as cityname,
			p.name as provincename,
			s.name as suburbname,
			ar.audit,
			ar.refix_incomplete,
			ar.refix_complete,
			ar.cautionary
		');
		$this->db->from('stock_management sm');
		$this->db->join('users u', 'sm.user_id=u.id', 'left');
		$this->db->join('users_detail ud', 'sm.user_id=ud.user_id', 'left');
		$this->db->join('users_plumber up', 'sm.user_id=up.user_id', 'left');
		$this->db->join('users_detail cd', 'cd.id=up.company_details', 'left');
		$this->db->join('users_address ua2', 'sm.user_id=ua2.user_id and ua2.type="2"', 'left');
		$this->db->join('suburb s', 'ua2.suburb=s.id','left');				
		$this->db->join('city c', 'ua2.city=c.id','left');				
		$this->db->join('province p', 'ua2.province=p.id','left');				
		$this->db->join('auditor_ratio ar', 'sm.user_id=ar.plumber_id','left');		
		if(isset($requestdata['compulsory_audit']) && $requestdata['compulsory_audit']!='') $this->db->join('compulsory_audit_listing cal', 'sm.user_id=cal.user_id','inner');			
		if((isset($requestdata['start_date_range']) && $requestdata['start_date_range']!='') || (isset($requestdata['end_date_range']) && $requestdata['end_date_range']!='')) $this->db->join('coc_log cl', 'sm.user_id=cl.created_by','left');
		
		if(isset($requestdata['start_date_range']) && $requestdata['start_date_range']!='') 			$this->db->where('DATE(cl.log_date) >=', date('Y-m-d', strtotime($requestdata['start_date_range'])));
		if(isset($requestdata['end_date_range']) && $requestdata['end_date_range']!='') 				$this->db->where('DATE(cl.log_date) <=', date('Y-m-d', strtotime($requestdata['end_date_range'])));
		if(isset($requestdata['start_coc_range']) && $requestdata['start_coc_range']!='')				$this->db->where('sm.id>=', $requestdata['start_coc_range']);
		if(isset($requestdata['end_coc_range']) && $requestdata['end_coc_range']!='') 					$this->db->where('sm.id<=', $requestdata['end_coc_range']);
		if(isset($requestdata['user_id']) && $requestdata['user_id']!='')								$this->db->where('sm.user_id', $requestdata['user_id']);
		if(isset($requestdata['province']) && $requestdata['province']!='') 							$this->db->where('ua2.province', $requestdata['province']);
		if(isset($requestdata['city']) && $requestdata['city']!='') 									$this->db->where('ua2.city', $requestdata['city']);
		if(isset($requestdata['audit_ratio_start']) && $requestdata['audit_ratio_start']!='') 			$this->db->where('ar.audit >=', $requestdata['audit_ratio_start']);
		if(isset($requestdata['audit_ratio_end']) && $requestdata['audit_ratio_end']!='') 				$this->db->where('ar.audit <=', $requestdata['audit_ratio_end']);
		//if(isset($requestdata['max_allocate_plumber']) && $requestdata['max_allocate_plumber']!='') 	$this->db->where('ar.audit <=', $requestdata['max_allocate_plumber']);
		
		if(($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])) || (isset($requestdata['start']) && isset($requestdata['no_coc_allocation']))){
			if(isset($requestdata['no_coc_allocation']) && $requestdata['no_coc_allocation']!='') $this->db->limit($requestdata['no_coc_allocation'], $requestdata['start']);
			else $this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['ud.name', 'up.registration_no', 'cd.company', 'c.name', 'p.name', 'ar.audit', 'ar.refix_incomplete', 'ar.refix_complete', 'ar.ar.cautionary'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();
				$this->db->like('ud.name', $searchvalue);
				$this->db->or_like('up.registration_no', $searchvalue);
				$this->db->or_like('cd.company', $searchvalue);
				$this->db->or_like('c.name', $searchvalue);
				$this->db->or_like('p.name', $searchvalue);
			$this->db->group_end();
		}
		
		$this->db->where(['sm.auditorid' => '0', 'sm.coc_status' => '2']);
		
		$this->db->group_by('sm.user_id');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function getCOCList($type, $requestdata=[])
	{ 
		$this->db->select('cl.coc_id, IF(cl.specialisations = "", cl.installationtype, concat(cl.installationtype, ",", cl.specialisations)) as installationcode, p.name as provincename, c.name as cityname, s.name as suburbname');
		$this->db->from('coc_log cl');		
		$this->db->join('province p', 'cl.province=p.id','left');	
		$this->db->join('city c', 'cl.city=c.id','left');					
		$this->db->join('suburb s', 'cl.suburb=s.id','left');	
		$this->db->join('stock_management sm', 'sm.id=cl.coc_id','left');	
		
		$this->db->where(['sm.auditorid' => '0', 'sm.coc_status' => '2']);
		
		if(isset($requestdata['user_id']) && $requestdata['user_id']!='') 	$this->db->where('sm.user_id', $requestdata['user_id']);
		
		$this->db->group_by('cl.id');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
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

	public function action($data){

		$requestdata['auditorid'] 				= 	$data['auditor_id'];	
		$requestdata['audit_status']			=	2;
		$requestdata['audit_allocation_date']	=	date('Y-m-d H:i:s');;
				
		$result = $this->db->update('stock_management', $requestdata, ['id' => $data['coc_id']]);
		return $result;	
	}	
}