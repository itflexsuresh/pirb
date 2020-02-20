<?php

class Coc_Model extends CC_Model
{
	public function getCOCList($type, $requestdata=[])
	{ 
		$coclog 			= 	[ 
									'cl.id cl_id','cl.log_date cl_log_date','cl.completion_date cl_completion_date','cl.order_no cl_order_no','cl.name cl_name','cl.address cl_address','cl.street cl_street','cl.number cl_number',
									'cl.province cl_province','cl.city cl_city','cl.suburb cl_suburb','cl.contact_no cl_contact_no','cl.alternate_no cl_alternate_no','cl.email cl_email','cl.installationtype cl_installationtype',
									'cl.specialisations cl_specialisations','cl.installation_detail cl_installation_detail','cl.file1 cl_file1','cl.file2 cl_file2','cl.agreement cl_agreement','cl.status cl_status'
								];
							
		$auditorstatement 	= 	[ 
									'aas.id as_id','aas.audit_date as_audit_date','aas.workmanship as_workmanship','aas.plumber_verification as_plumber_verification','aas.coc_verification as_coc_verification','aas.hold as_hold','aas.reason as_reason'
								];
			
		$this->db->select('
			sm.*, 
			u.id as u_id,
			u.type as u_type,
			concat(ud.name, " ", ud.surname) as u_name, 
			ud.mobile_phone as u_mobile,
			ud.work_phone as u_work,
			ud.file2 as u_file,
			ud.status as u_status,
			'.implode(',', $coclog).',
			cd1.company as plumbercompany,
			up.registration_no as plumberregno, 
			pa.createddate as resellercreateddate,
			rd.company as resellercompany,
			s.name as cl_suburb_name,
			concat(ad.name, " ", ad.surname) as auditorname, 
			'.implode(',', $auditorstatement).'
		');
		$this->db->from('stock_management sm');
		$this->db->join('users_plumber up', 'up.user_id=sm.user_id', 'left');
		$this->db->join('users_detail ud', 'ud.user_id=sm.user_id', 'left');
		$this->db->join('users u', 'u.id=sm.user_id', 'left');
		$this->db->join('coc_log cl', 'cl.coc_id=sm.id', 'left');
		$this->db->join('users_detail cd1', 'cd1.user_id=cl.company_details', 'left');
		$this->db->join('suburb s', 's.id=cl.suburb', 'left');
		$this->db->join('plumberallocate pa', 'pa.stockid=sm.id', 'left'); // Reseller Allocate
		$this->db->join('users_detail rd', 'rd.user_id=pa.company_details', 'left'); // Reseller Company Details
		$this->db->join('users_detail ad', 'ad.user_id=sm.auditorid', 'left'); // Auditor
		$this->db->join('auditor_statement aas', 'aas.coc_id=sm.id', 'left'); // Auditor Statement
		
		if((isset($requestdata['search']['value']) && $requestdata['search']['value']!='') || (isset($requestdata['order']['0']['column']) && $requestdata['order']['0']['column']!='' && isset($requestdata['order']['0']['dir']) && $requestdata['order']['0']['dir']!='')){
			$this->db->join('custom c1', 'c1.c_id=sm.coc_status', 'left');
			$this->db->join('custom c2', 'c2.c_id=sm.audit_status', 'left');
			$this->db->join('custom c3', 'c3.c_id=sm.type', 'left');
			
			if(isset($requestdata['page']) && $requestdata['page']=='admincocdetails'){
				$this->db->join('users_detail ud1', 'ud1.user_id=sm.user_id', 'left');
				$this->db->join('users u1', 'u1.id=ud1.user_id and u1.type="3"', 'left');
				$this->db->join('users_detail ud2', 'ud2.user_id=sm.user_id', 'left');
				$this->db->join('users u2', 'u2.id=ud2.user_id and u2.type="5"', 'left');
				$this->db->join('users_detail ud3', 'ud3.user_id=sm.user_id', 'left');
				$this->db->join('users u3', 'u3.id=ud3.user_id and u3.type="6"', 'left');
			}
		}
		
		if(isset($requestdata['startrange']) && $requestdata['startrange']!='')				$this->db->where('sm.id >=', $requestdata['startrange']);
		if(isset($requestdata['endrange']) && $requestdata['endrange']!='')					$this->db->where('sm.id <=', $requestdata['endrange']);
		if(isset($requestdata['coc_status']) && count($requestdata['coc_status']) > 0)		$this->db->where_in('sm.coc_status', $requestdata['coc_status']);
		if(isset($requestdata['auditstatus']) && count($requestdata['auditstatus']) > 0)	$this->db->where_in('sm.audit_status', $requestdata['auditstatus']);
		if(isset($requestdata['coctype']) && count($requestdata['coctype']) > 0)			$this->db->where_in('sm.type', $requestdata['coctype']);
		if(isset($requestdata['startdate']) && $requestdata['startdate']!='')				$this->db->where('sm.purchased_at >=', date('Y-m-d', strtotime($requestdata['startdate'])));
		if(isset($requestdata['enddate']) && $requestdata['enddate']!='')					$this->db->where('sm.purchased_at <=', date('Y-m-d', strtotime($requestdata['enddate'])));
		if(isset($requestdata['province']) && $requestdata['province']!='')					$this->db->where('cl.province', $requestdata['province']);
		if(isset($requestdata['city']) && $requestdata['city']!='')							$this->db->where('cl.city', $requestdata['city']);
		if(isset($requestdata['auditorid']) && $requestdata['auditorid']!='')				$this->db->where('sm.auditorid', $requestdata['auditorid']);
		if(isset($requestdata['noaudit']))													$this->db->where('sm.auditorid !=', '');
		
		if(isset($requestdata['user_id']) && $requestdata['user_id']!='')					$this->db->where('sm.user_id', $requestdata['user_id']);
		if(isset($requestdata['id']) && $requestdata['id']!='')								$this->db->where('sm.id', $requestdata['id']);
		
		
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];
				$this->db->group_start();
					if($page=='plumbercocstatement'){					
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(sm.purchased_at,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('c3.name', $searchvalue, 'both');
						$this->db->or_like('cl.name', $searchvalue, 'both');
						$this->db->or_like('cl.address', $searchvalue, 'both');
						$this->db->or_like('cd1.company', $searchvalue, 'both');					
					}elseif($page=='admincocdetails'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c3.name', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('concat(ud1.name, " ", ud1.surname)', $searchvalue, 'both');
						$this->db->or_like('concat(ud2.name, " ", ud2.surname)', $searchvalue, 'both');
						$this->db->or_like('concat(ud3.name, " ", ud3.surname)', $searchvalue, 'both');							
					}elseif($page=='auditorstatement'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('concat(ud.name, " ", ud.surname)', $searchvalue, 'both');		
						$this->db->or_like('ud.mobile_phone', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(sm.allocation_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('s.name', $searchvalue, 'both');		
						$this->db->or_like('cl.name', $searchvalue, 'both');		
						$this->db->or_like('cl.contact_no', $searchvalue, 'both');		
					}elseif($page=='plumberauditorstatement'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('cl.name', $searchvalue, 'both');		
						$this->db->or_like('cl.address', $searchvalue, 'both');		
						$this->db->or_like('DATE_FORMAT(sm.allocation_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('ad.name', $searchvalue, 'both');		
					}
				$this->db->group_end();
			}
		}
		if(isset($requestdata['order']['0']['column']) && $requestdata['order']['0']['column']!='' && isset($requestdata['order']['0']['dir']) && $requestdata['order']['0']['dir']!=''){
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];				
				if($page=='plumbercocstatement'){
					$column = ['sm.id', 'c1.name', 'sm.purchased_at', 'c3.name', 'cl.name', 'cl.address', 'cd1.company'];
				}elseif($page=='admincocdetails'){
					$column = ['sm.id', 'c3.name', 'c1.name', 'ud1.name', 'ud2.name', 'ud3.name'];
				}elseif($page=='auditorstatement'){
					$column = ['sm.id', 'c1.name', 'ud.name', 'ud.mobile_phone', 'sm.allocation_date', 's.name', 'cl.name', 'cl.contact_no'];
				}elseif($page=='plumberauditorstatement'){
					$column = ['sm.id', 'c1.name', 'cl.name', 'cl.address', 'sm.allocation_date', 'ad.name'];
				}
				
				$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
			}
		}
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		
		$this->db->group_by('sm.id');
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;		
	}
	
	public function COCcount($requestdata=[]){
		$query = $this->db->select('*')->from('coc_count')->where('user_id', $requestdata['user_id'])->get()->row_array();
		//print_r($query);die;
		return $query;

	}
	public function getListPDF($type, $requestdata=[]){
		//print_r($requestdata);die;
		        $query=$this->db->select('t1.*,t1.status,t1.created_at,
        	t2.inv_id, t2.total_due, t2.quantity, t2.cost_value,t2.vat, t2.delivery_cost, t2.total_due, t3.reg_no, t3.id, t3.name username, t3.surname surname, t3.company_name company_name, t3.vat_no vat_no, t3.email2, t3.home_phone, t4.address, t4.suburb, t4.city,t4.province, t5.id, t5.name,t6.id, t6.province_id, t6.name,t7.id, t7.province_id, t7.city_id, t7.name,t8.registration_no, t8.designation ');
		        $this->db->select('
			group_concat(concat_ws("@@@", t4.id, t4.suburb, t4.city,t4.province, t5.name, t6.name, t7.name) separator "@-@") as areas'
		);

        $this->db->from('invoice t1');

        $this->db->join('coc_orders t2','t2.inv_id = t1.inv_id', 'left');

        $this->db->join('users_detail t3', 't3.user_id = t1.user_id', 'left');

        $this->db->join('users_address t4', 't4.user_id = t1.user_id AND t4.type="3"', 'left');
		
		$this->db->join('users_plumber t8', 't8.user_id = t1.user_id', 'left');

        $this->db->join('province t5', 't5.id=t4.province', 'left');

        $this->db->join('city t6', 't6.id=t4.city', 'left');

        $this->db->join('suburb t7', 't7.id=t4.suburb', 'left');
   
       if(isset($requestdata['id'])) $this->db->where('t1.inv_id', $requestdata['id']);


       
		// if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
		// 	$this->db->limit($requestdata['length'], $requestdata['start']);
		// }
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}

		// echo $this->db->last_query();
		// die;

		//print_r($result);die;
		
		return $result;
	}

	public function getPermissions($type1)
	{ 
		$this->db->select('*');
		$this->db->from('settings_details ');		
      if($type1=='count'){
			$result = $this->db->count_all_results();
			
		}else{
			$query = $this->db->get();
			
			
			if($type1=='all') 		$result = $query->result_array();
			elseif($type1=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	 public function getPermissions1($type2)
	{ 
		$this->db->select('st1.*, p1.id, p1.name');
		$this->db->select('
			group_concat(concat_ws("@@@", st1.province, p1.name) separator "@-@") as provincesettings');
		$this->db->from('settings_address st1', 'st1.type="2"');
		$this->db->join('province p1', 'p1.id = st1.province', 'left');
		
      if($type2=='count'){
			$result = $this->db->count_all_results();
			
		}else{
			$query = $this->db->get();
			
			
			if($type2=='all') 		$result = $query->result_array();
			elseif($type2=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function action($requestdata, $flag){
		//$datetime		= 	date('Y-m-d H:i:s');

		if ($flag == 1) {
			$result 		= $this->db->insert('invoice',$requestdata);
			$inv_id 		= $this->db->insert_id();
			return $inv_id;
		}elseif($flag == 2){
			$result 		= $this->db->insert('coc_orders',$requestdata);
		}
		else{
			$result 		= $this->db->update('coc_count', $requestdata, ['user_id' => $requestdata['user_id']]);
			
			if ($result) {
				return '1';
			}else{
				return '0';
			}

		}
		

	}

	public function ajaxOTP($requestdata){
		$query = $this->db->get_where('otp', array('user_id' => $requestdata['user_id']) );
		$count = $query->num_rows();
		if ($count == 1) {
			$this->db->set('otp',$requestdata['otp']);
			$this->db->where('user_id', $requestdata['user_id']);
			$this->db->update('otp');
		}else{
			$result = $this->db->insert('otp',$requestdata);

		}
		
	}

	public function OTPVerification($requestdata){
		$result = $this->db->select('*')
		->from('otp')
		->where('user_id',$requestdata['user_id'])
		->where('otp',$requestdata['otp'])
		->order_by('id', 'DESC')
		->limit(1)
		->get()
		->row_array();
		if ($result) {
			return '1';
		}else{
			return '0';
		}

	}
	
	public function checkcocpermitted($userid)
	{
		$query = $this->db
		->select('coc_purchase_limit, coc_electronic')
		->from('users_plumber')
		->where('user_id', $userid)
		->get()
		->row_array();

		if($query){
			return $query;
		}else{
			return '0';
		}
	}
	
	public function actionCocLog($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		if(isset($data['coc_id'])) 				$request['coc_id'] 					= $data['coc_id'];
		if(isset($data['completion_date'])) 	$request['completion_date'] 		= date('Y-m-d', strtotime($data['completion_date']));
		if(isset($data['order_no'])) 			$request['order_no'] 				= $data['order_no'];
		if(isset($data['name'])) 				$request['name'] 					= $data['name'];
		if(isset($data['address'])) 			$request['address'] 				= $data['address'];
		if(isset($data['street'])) 				$request['street'] 					= $data['street'];
		if(isset($data['number'])) 				$request['number'] 					= $data['number'];
		if(isset($data['province'])) 			$request['province'] 				= $data['province'];
		if(isset($data['city'])) 				$request['city'] 					= $data['city'];
		if(isset($data['suburb'])) 				$request['suburb'] 					= $data['suburb'];
		if(isset($data['contact_no'])) 			$request['contact_no'] 				= $data['contact_no'];
		if(isset($data['alternate_no'])) 		$request['alternate_no'] 			= $data['alternate_no'];
		if(isset($data['email'])) 				$request['email'] 					= $data['email'];
		if(isset($data['installationtype'])) 	$request['installationtype'] 		= implode(',', $data['installationtype']);
		if(isset($data['specialisations'])) 	$request['specialisations'] 		= implode(',', $data['specialisations']);
		if(isset($data['installation_detail'])) $request['installation_detail'] 	= $data['installation_detail'];
		if(isset($data['file1'])) 				$request['file1'] 					= $data['file1'];
		if(isset($data['agreement'])) 			$request['agreement'] 				= implode(',', $data['agreement']);
		if(isset($data['file1'])) 				$request['file1'] 					= $data['file1'];
		if(isset($data['company_details'])) 	$request['company_details'] 		= $data['company_details'];
		if(isset($data['submit']) && $data['submit']=='log') $request['log_date'] 	= date('Y-m-d');
		
		$request['file2'] 					= (isset($data['file2'])) ? implode(',', $data['file2']) : '';
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('coc_log', $request);
		}else{
			$this->db->update('coc_log', $request, ['id' => $id]);
		}
		
		if(isset($data['submit'])){
			if($data['submit']=='save'){
				$cocstatus = '5';
			}elseif($data['submit']=='log'){
				$cocstatus = '2';
			}
			
			if(isset($cocstatus)) $this->db->update('stock_management', ['coc_status' => $cocstatus], ['id' => $data['coc_id']]);
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
	
	// Coc Details
	
	public function getCOcDetails($type, $requestdata=[])
	{ 
		$this->db->select('*');
		$this->db->from('coc_details');
	
		if(isset($requestdata['id']))		$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['coc_id']))	$this->db->where('coc_id', $requestdata['coc_id']);
						
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function actionCocDetails($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$datetime		= 	date('Y-m-d H:i:s');
		$cocid			=	$data['coc_id'];
		$recall			=	$data['recall'];
		
		$request		=	[
			'coc_id' 			=> $cocid,
			'recall' 			=> $recall,
			'reason' 			=> isset($data['reason']) && $recall=='2' ? $data['reason'] : '',
			'document' 			=> isset($data['document']) && $recall=='2' ? $data['document'] : '',
			'user_id' 			=> isset($data['userid']) && $recall=='3' ? $data['userid'] : '',
			'created_at' 		=> $datetime,
			'created_by' 		=> $userid,
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		$this->db->insert('coc_details', $request);
		
		if($recall=='1'){
			$this->db->update('stock_management', ['user_id' => '0', 'coc_status' => '6'], ['id' => $cocid]);
		}elseif($recall=='2'){
			$this->db->update('stock_management', ['coc_status' => '7'], ['id' => $cocid]);
		}elseif($recall=='3'){
			$cocstatus = (isset($data['user_type']) && $data['user_type']=='3') ? '4' : '3';
			if(isset($data['userid'])) $this->db->update('stock_management', ['user_id' => $data['userid'], 'coc_status' => $cocstatus], ['id' => $cocid]);
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
	
	// Coc Count
	
	public function getCOCCount($type, $requestdata=[])
	{ 
		$this->db->select('*');
		$this->db->from('coc_count');
	
		if(isset($requestdata['id']))		$this->db->where('id', $requestdata['id']);
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
	
	public function actionCocCount($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'count' 			=> $data['count'],
			'user_id' 			=> $data['user_id'],
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];

		$count = $this->getCOCCount('count', ['user_id' => $data['user_id']]);
		
		if($count=='0'){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('coc_count', $request);
		}else{
			$this->db->update('coc_count', $request, ['user_id' => $data['user_id']]);
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
	
}
