<?php

class Coc_Model_Api extends CC_Model
{
	public function getCOCList($type, $requestdata=[])
	{ 
		$coclog 			= 	[ 
									'cl.id cl_id','cl.log_date cl_log_date','cl.completion_date cl_completion_date','cl.order_no cl_order_no','cl.name cl_name','cl.address cl_address','cl.street cl_street','cl.number cl_number',
									'cl.province cl_province','cl.city cl_city','cl.suburb cl_suburb','cl.contact_no cl_contact_no','cl.alternate_no cl_alternate_no','cl.email cl_email','cl.installationtype cl_installationtype',
									'cl.specialisations cl_specialisations','cl.installation_detail cl_installation_detail','cl.file1 cl_file1','cl.file2 cl_file2','cl.agreement cl_agreement','cl.ncnotice cl_ncnotice','cl.ncemail cl_ncemail','cl.ncreason cl_ncreason','cl.status cl_status'
								];
							
		$auditorstatement 	= 	[ 
									'aas.id as_id','aas.audit_date as_audit_date','aas.workmanship as_workmanship','aas.plumber_verification as_plumber_verification','aas.coc_verification as_coc_verification','aas.hold as_hold','aas.reason as_reason','aas.auditcomplete as_auditcomplete','aas.refixcompletedate as_refixcompletedate'
								];
							
		$auditorreview 		= 	[ 
									'ar.incomplete_point ar_incomplete_point','ar.complete_point ar_complete_point','ar.cautionary_point ar_cautionary_point','ar.noaudit_point ar_noaudit_point','ar.refix_date ar_refix_date'
								];
		
		$auditorreview1 = [];
		if(isset($requestdata['page']) && (in_array($requestdata['page'], ['adminauditorstatement', 'auditorstatement', 'plumberauditorstatement', 'review']))){
			$auditorreview1 = 	[ 
									'ar1.refix_date ar1_refix_date'
								];
		}
		
		$this->db->select('
			sm.*, 
			u.id as u_id,
			u.type as u_type,
			concat(ud.name, " ", ud.surname) as u_name, 
			u.email as u_email,
			ud.mobile_phone as u_mobile,
			ud.work_phone as u_work,
			ud.file2 as u_file,
			ud.status as u_status,
			'.implode(',', $coclog).',
			p.name as cl_province_name,
			c.name as cl_city_name,
			s.name as cl_suburb_name,
			cd1.company as plumbercompany,
			up.registration_no as plumberregno, 
			pa.createddate as resellercreateddate,
			rd.company as resellercompany,
			rd.user_id as resellersid,
			concat(rd.name, " ", rd.surname) as resellername, 
			concat(ad.name, " ", ad.surname) as auditorname, 
			ad.mobile_phone as auditormobile, 
			a.email as auditoremail, 
			ad.status as auditorstatus, 
			'.implode(',', $auditorstatement).',
			'.implode(',', $auditorreview).',
			'.implode(',', $auditorreview1).'
		');
		$this->db->from('stock_management sm');
		$this->db->join('users_plumber up', 'up.user_id=sm.user_id', 'left');
		$this->db->join('users_detail ud', 'ud.user_id=sm.user_id', 'left');
		$this->db->join('users u', 'u.id=sm.user_id', 'left');
		$this->db->join('coc_log cl', 'cl.coc_id=sm.id', 'left'); // Coc Log
		$this->db->join('province p', 'p.id=cl.province', 'left'); // Coc Log
		$this->db->join('city c', 'c.id=cl.city', 'left'); // Coc Log
		$this->db->join('suburb s', 's.id=cl.suburb', 'left'); // Coc Log
		$this->db->join('users_detail cd1', 'cd1.user_id=cl.company_details', 'left'); // Plumber Details
		$this->db->join('plumberallocate pa', 'pa.stockid=sm.id', 'left'); // Reseller Allocate
		$this->db->join('users_detail rd', 'rd.user_id=pa.resellersid', 'left'); // Reseller Details
		$this->db->join('users_detail ad', 'ad.user_id=sm.auditorid', 'left'); // Auditor
		$this->db->join('users a', 'a.id=sm.auditorid', 'left'); // Auditor
		$this->db->join('auditor_statement aas', 'aas.coc_id=sm.id', 'left'); // Auditor Statement
		$this->db->join('auditor_review ar', 'ar.coc_id=sm.id', 'left'); // Auditor Review
		
		if((isset($requestdata['search']['value']) && $requestdata['search']['value']!='') || (isset($requestdata['order']['0']['column']) && $requestdata['order']['0']['column']!='' && isset($requestdata['order']['0']['dir']) && $requestdata['order']['0']['dir']!='')){
			$this->db->join('custom c1', 'c1.c_id=sm.coc_status and c1.type="1"', 'left');
			$this->db->join('custom c2', 'c2.c_id=sm.audit_status and c2.type="2"', 'left');
			$this->db->join('custom c3', 'c3.c_id=sm.type and c3.type="3"', 'left');
		}
		
		if(isset($requestdata['page']) && (in_array($requestdata['page'], ['adminauditorstatement', 'auditorstatement', 'plumberauditorstatement', 'review']))){
			$this->db->join('auditor_review ar1', 'ar1.coc_id=sm.id and ar1.reviewtype="1"', 'left');
		}
		
		if(isset($requestdata['startrange']) && $requestdata['startrange']!='')				$this->db->where('sm.id >=', $requestdata['startrange']);
		if(isset($requestdata['endrange']) && $requestdata['endrange']!='')					$this->db->where('sm.id <=', $requestdata['endrange']);
		if(isset($requestdata['auditstatus']) && count($requestdata['auditstatus']) > 0){
			$this->db->where_in('sm.audit_status', $requestdata['auditstatus']);
			$this->db->where('sm.coc_status', '2');
			$this->db->where('sm.auditorid !=', '0');
		}
		if(isset($requestdata['coctype']) && count($requestdata['coctype']) > 0)			$this->db->where_in('sm.type', $requestdata['coctype']);
		if(isset($requestdata['startdate']) && $requestdata['startdate']!='')				$this->db->where('sm.purchased_at >=', date('Y-m-d', strtotime($requestdata['startdate'])));
		if(isset($requestdata['enddate']) && $requestdata['enddate']!='')					$this->db->where('sm.purchased_at <=', date('Y-m-d', strtotime($requestdata['enddate'])));
		if(isset($requestdata['province']) && $requestdata['province']!='')					$this->db->where('cl.province', $requestdata['province']);
		if(isset($requestdata['city']) && $requestdata['city']!='')							$this->db->where('cl.city', $requestdata['city']);
		if(isset($requestdata['auditorid']) && $requestdata['auditorid']!='')				$this->db->where('sm.auditorid', $requestdata['auditorid']);
		if(isset($requestdata['noaudit']))													$this->db->where('sm.auditorid !=', '');
		if(isset($requestdata['auditcomplete']))											$this->db->where('aas.auditcomplete', '1');
		
		if(isset($requestdata['user_id']) && $requestdata['user_id']!='')					$this->db->where('sm.user_id', $requestdata['user_id']);
		if(isset($requestdata['id']) && $requestdata['id']!='')								$this->db->where('sm.id', $requestdata['id']);
		
		if(isset($requestdata['coc_status']) && count($requestdata['coc_status']) > 0){
			$this->db->group_start();
				$this->db->where_in('sm.coc_status', $requestdata['coc_status']);
				$this->db->or_where_in('sm.coc_orders_status', $requestdata['coc_status']);
			$this->db->group_end();
		}
		
		if(isset($requestdata['allocated_id'])){
			$this->db->group_start();
				$this->db->where('sm.user_id', $requestdata['allocated_id']);
				$this->db->or_where('sm.allocatedby', $requestdata['allocated_id']);
			$this->db->group_end();
		}

		if(isset($requestdata['monthrange'])){
			$monthArray 	=	explode('-', $requestdata['monthArray']);
			$this->db->where('YEAR(sm.purchased_at) = '.$monthArray[0].' AND '.'MONTH(sm.purchased_at) = '.$monthArray[1]);	
		}
		
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];
				$this->db->group_start();
					if($page=='plumbercocstatement'){					
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(sm.allocation_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(cl.log_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('c3.name', $searchvalue, 'both');
						$this->db->or_like('cl.name', $searchvalue, 'both');
						$this->db->or_like('cl.address', $searchvalue, 'both');
						$this->db->or_like('cd1.company', $searchvalue, 'both');					
						$this->db->or_like('rd.name', $searchvalue, 'both');					
					}elseif($page=='admincocdetails'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c3.name', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('concat(ud.name, " ", ud.surname)', $searchvalue, 'both');
						$this->db->or_like('concat(rd.name, " ", rd.surname)', $searchvalue, 'both');
						$this->db->or_like('concat(ad.name, " ", ad.surname)', $searchvalue, 'both');							
					}elseif($page=='auditorstatement'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('concat(ud.name, " ", ud.surname)', $searchvalue, 'both');		
						$this->db->or_like('ud.mobile_phone', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(sm.audit_allocation_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(ar1.refix_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(aas.refixcompletedate,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('s.name', $searchvalue, 'both');		
						$this->db->or_like('cl.name', $searchvalue, 'both');		
						$this->db->or_like('cl.contact_no', $searchvalue, 'both');		
					}elseif($page=='plumberauditorstatement'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c2.name', $searchvalue, 'both');
						$this->db->or_like('cl.name', $searchvalue, 'both');		
						$this->db->or_like('cl.address', $searchvalue, 'both');		
						$this->db->or_like('DATE_FORMAT(ar1.refix_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(aas.refixcompletedate,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(sm.audit_allocation_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('ad.name', $searchvalue, 'both');		
					}elseif($page=='adminauditorstatement'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('c1.name', $searchvalue, 'both');
						$this->db->or_like('ad.name', $searchvalue, 'both');		
						$this->db->or_like('ad.mobile_phone', $searchvalue, 'both');		
						$this->db->or_like('DATE_FORMAT(sm.audit_allocation_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(ar1.refix_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(aas.refixcompletedate,"%d-%m-%Y")', $searchvalue, 'both');
					}elseif($page=='auditorprofile'){
						$this->db->like('sm.id', $searchvalue, 'both');
						$this->db->or_like('DATE_FORMAT(aas.audit_date,"%d-%m-%Y")', $searchvalue, 'both');
						$this->db->or_like('concat(ud.name, " ", ud.surname)', $searchvalue, 'both');
						$this->db->or_like('s.name', $searchvalue, 'both');		
						$this->db->or_like('c.name', $searchvalue, 'both');		
						$this->db->or_like('p.name', $searchvalue, 'both');		
						$this->db->or_like('ar.incomplete_point', $searchvalue, 'both');		
						$this->db->or_like('ar.complete_point', $searchvalue, 'both');		
						$this->db->or_like('ar.cautionary_point', $searchvalue, 'both');		
						$this->db->or_like('ar.noaudit_point', $searchvalue, 'both');			
					}
				$this->db->group_end();
			}
		}
		if(isset($requestdata['order']['0']['column']) && $requestdata['order']['0']['column']!='' && isset($requestdata['order']['0']['dir']) && $requestdata['order']['0']['dir']!=''){
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];				
				if($page=='plumbercocstatement'){
					$column = ['sm.id', 'c1.name', 'sm.allocation_date', 'cl.log_date', 'c3.name', 'cl.name', 'cl.address', 'cd1.company', 'rd.name'];
				}elseif($page=='admincocdetails'){
					$column = ['sm.id', 'c3.name', 'c1.name', 'ud.name', 'rd.name', 'ad.name'];
				}elseif($page=='auditorstatement'){
					$column = ['sm.id', 'sm.audit_status', 'ud.name', 'ud.mobile_phone', 'sm.audit_allocation_date', 'ar1.refix_date', 'aas.refixcompletedate', 's.name', 'cl.name', 'cl.contact_no'];
				}elseif($page=='plumberauditorstatement'){
					$column = ['sm.id', 'c2.name', 'cl.name', 'cl.address', 'ar1.refix_date', 'aas.refixcompletedate', 'sm.audit_allocation_date', 'ad.name'];
				}elseif($page=='adminauditorstatement'){
					$column = ['sm.id', 'c1.name', 'ad.name', 'ad.mobile_phone', 'sm.audit_allocation_date', 'ar1.refix_date', 'aas.refixcompletedate'];
				}elseif($page=='auditorprofile'){
					$column = ['sm.id', 'aas.audit_date', 'ud.name', 's.name', 'c.name', 'p.name', 'ar.incomplete_point', 'ar.complete_point', 'ar.cautionary_point', 'ar.noaudit_point'];
				}
				
				$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
			}
		}
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if (isset($requestdata['api_data']) && $requestdata['api_data'] =='plumber_coc_statement_api') {
			$this->db->order_by('sm.coc_status', 'DESC');
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
        $query=$this->db->select('t1.*,t1.status,t1.created_at,
        	t2.inv_id, t2.total_due, t2.quantity, t2.cost_value,t2.vat, t2.delivery_cost, t2.total_due, t3.reg_no, t3.id, t3.name username, t3.surname surname, t3.company_name company_name, t3.vat_no vat_no, t3.email2, t3.home_phone, t3.file2, t4.address, t4.suburb, t4.city,t4.province,t4.postal_code, t5.id, t5.name as province,t6.id, t6.province_id, t6.name as city,t7.id, t7.province_id, t7.city_id, t7.name as suburb,t8.registration_no, t8.designation,ub.bank_name, ub.branch_code, ub.account_name, ub.account_no, ub.account_type, t9.type as usertype, t3.billing_email as billingemail, t3.billing_contact as billingcontact');
		$this->db->select('
			group_concat(concat_ws("@@@", t4.id, t4.suburb, t4.city,t4.province, t5.name, t6.name, t7.name) separator "@-@") as areas'
		);

        $this->db->from('invoice t1');

        $this->db->join('coc_orders t2','t2.inv_id = t1.inv_id', 'left');
		
		$this->db->join('users t9', 't9.id=t1.user_id', 'left');
		
        $this->db->join('users_detail t3', 't3.user_id = t1.user_id', 'left');

        $this->db->join('users_address t4', 't4.user_id = t1.user_id AND t4.type="3"', 'left');
		
		$this->db->join('users_plumber t8', 't8.user_id = t1.user_id', 'left');

        $this->db->join('province t5', 't5.id=t4.province', 'left');

        $this->db->join('city t6', 't6.id=t4.city', 'left');

        $this->db->join('suburb t7', 't7.id=t4.suburb', 'left');

        $this->db->join('users_bank ub', 'ub.user_id=t1.user_id', 'left');
   
		if(isset($requestdata['id'])) $this->db->where('t1.inv_id', $requestdata['id']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}

		return $result;
	}

	public function getPermissions($type1)
	{ 
		$this->db->select('*');
		$this->db->from('settings_details');		
		
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
		$this->db->select('group_concat(concat_ws("@@@", st1.province, p1.name) separator "@-@") as provincesettings');
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
		
		if(isset($data['coc_id']) && $id==''){
			$checkcoc = $this->db->get_where('coc_log', ['coc_id' => $data['coc_id']])->row_array();
			if($checkcoc) return true;
		}
		
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
		if(isset($data['agreement'])) 			$request['agreement'] 				= $data['agreement'];
		if(isset($data['file1'])) 				$request['file1'] 					= $data['file1'];
		if(isset($data['company_details'])) 	$request['company_details'] 		= $data['company_details'];
		if(isset($data['ncnotice'])) 			$request['ncnotice'] 				= $data['ncnotice'];
		if(isset($data['ncemail'])) 			$request['ncemail'] 				= $data['ncemail'];
		if(isset($data['ncreason'])) 			$request['ncreason'] 				= $data['ncreason'];
		if(isset($data['submit']) && $data['submit']=='log') $request['log_date'] 	= date('Y-m-d H:i:s');
		
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
				$this->db->set('count', 'count + 1',FALSE); 
				$this->db->where('user_id', $userid); 
				$increase_count = $this->db->update('coc_count'); 
				
				// $checkreseller = $this->getCOCList('row', ['id'=>$data['coc_id']]);
				// if($checkreseller['resellersid'] != ''){
				// 	$this->db->set('count', 'count + 1',FALSE);
				// 	$this->db->where('user_id', $checkreseller['resellersid']);
				// 	$this->db->update('coc_count');
				// }
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
						
		$this->db->order_by('id', 'desc');
		
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
		
		if(isset($data['revoked'])){
			$this->db->update('stock_management', ['coc_status' => '4', 'coc_orders_status' => null], ['id' => $cocid]);
			$return = '1';
		}else{
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
			
			$stock 			= $this->getCOCList('row', ['id' => $cocid]);
			$stockuserid 	= $stock['user_id'];
			
			if($recall=='1'){			
				$this->db->set('count', 'count + 1', FALSE); 
				$this->db->where('user_id', $stockuserid); 
				$this->db->update('coc_count'); 
				
				$this->db->update('stock_management', ['user_id' => '0', 'coc_status' => '1', 'coc_orders_status' => '6'], ['id' => $cocid]);
				$return = '1';
			}elseif($recall=='2'){
				$this->db->update('stock_management', ['coc_status' => '7', 'coc_orders_status' => '7'], ['id' => $cocid]);
				$return = '2';
			}elseif($recall=='3'){
				$cocstatus = (isset($data['user_type']) && $data['user_type']=='3') ? '4' : '3';
				if(isset($data['userid']) && $stockuserid!=$data['userid']){
					$stockcheck = $this->getCOCCount('row', ['user_id' => $data['userid']]);
					if($stockcheck['count'] > 0){
						$this->db->set('count', 'count + 1', FALSE); 
						$this->db->where('user_id', $stockuserid); 
						$this->db->update('coc_count'); 
						
						$this->db->set('count', 'count - 1', FALSE); 
						$this->db->where('user_id', $data['userid']); 
						$this->db->update('coc_count'); 
						
						$this->db->update('stock_management', ['user_id' => $data['userid'], 'coc_status' => $cocstatus, 'coc_orders_status' => '8'], ['id' => $cocid]);
						$return = '3';
					}else{
						$return = '4';
					}
				}else{
					$return = '5';
				}
			}
		}
		
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			if(isset($return)) return $return;
			else return true;
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
	
	// Cancel Coc
	
	
	public function cancelcoc($data)
	{
		$cocid = $data['coc_id'];
		
		$this->db->delete('auditor_statement', ['coc_id' => $cocid]);
		$this->db->delete('auditor_review', ['coc_id' => $cocid]);
		$this->db->update('stock_management', ['auditorid' => '0'], ['id' => $cocid]);
		
		return true;
	}
}
