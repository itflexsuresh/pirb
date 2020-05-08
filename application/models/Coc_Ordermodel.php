<?php

class Coc_Ordermodel extends CC_Model
{
	public function getCocorderList($type, $requestdata){

		// $this->db->select('t1.*');
		$this->db->select('t1.*,inv.email_track,inv.sms_track,t2.name,t2.surname,t3.type, concat(t3.address, ",", t5.name) as address, t2.company, t4.type, cc.count');
		$this->db->from('coc_orders t1');
		$this->db->join('invoice inv', 'inv.inv_id=t1.inv_id', 'left');
		$this->db->join('users_detail t2', 't1.user_id=t2.user_id', 'left');
		$this->db->join('users_address t3', 't1.user_id=t3.user_id AND t3.type="2"', 'left');
		$this->db->join('users t4', 't1.user_id=t4.id', 'left');
		$this->db->join('coc_count cc', 't1.user_id=cc.user_id');		
		$this->db->join('city t5', 't3.city=t5.id','left');		


		$this->db->where_in('inv.inv_type', ['1','2']);

		if(isset($requestdata['id'])) 				$this->db->where('t1.id', $requestdata['id']);
		if(isset($requestdata['userid'])) 			$this->db->where('t1.user_id', $requestdata['userid']);
		if(isset($requestdata['admin_status']) && $requestdata['admin_status']=='closed'){
			$this->db->where('admin_status!="0"');
		} else {
			$this->db->where('admin_status', '0');
		}

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['t1.id','t1.inv_id','t1.created_at','t1.status','t1.internal_inv','t2.name','t1.coc_type','t1.quantity','t1.delivery_type','t3.address','t1.tracking_no'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);	
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$this->db->group_start();
				$searchvalue = strtolower(trim($requestdata['search']['value']));
				if($searchvalue=='paid'){
					$this->db->where('t1.status', '1');
				}
				else if($searchvalue=='not paid'){
					$this->db->where('t1.status', '0');
				}
				else if($searchvalue=='electronic'){
					$this->db->where('t1.coc_type', '1');
				}
				else if($searchvalue=='paper based'){
					$this->db->where('t1.coc_type', '2');
				}
				else if($searchvalue=='collected at pirb'){
					$this->db->where('t1.delivery_type', '1');
				}
				else if($searchvalue=='by courier'){
					$this->db->where('t1.delivery_type', '2');
				}
				else if($searchvalue=='by register post'){
					$this->db->where('t1.delivery_type', '3');
				}			
				else {
					$this->db->like('concat(t2.name, " ", t2.surname)', $searchvalue);
					$this->db->or_like('concat(t3.address, ",", t5.name)', $searchvalue);
					$this->db->or_like('cc.count', $searchvalue);
					$this->db->or_like('t1.id', $searchvalue);
					$this->db->or_like('t1.inv_id', $searchvalue);
					$this->db->or_like('t1.internal_inv', $searchvalue);
					$this->db->or_like('t1.tracking_no', $searchvalue);
					$this->db->or_like('t1.created_at', date('Y-m-d',strtotime($searchvalue)));
				}
			$this->db->group_end();
		}
					
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		// echo $this->db->last_query();
		// foreach ($result as $key => $value) {
		// 	if(!strpos($value[''],$str)){
		// 	    echo 0;
		// 	}
		// }
		// exit;
		return $result;
	}

	public function action($data){
		
		$settings 		= $this->db->get('settings_details')->row_array();
		$currency    	= $this->config->item('currency');
		
		// echo "<pre>"; print_r($data);die;
		if(isset($data['quantity'])) 		$requestdata['description'] 	= 'Purchase of '.$data['quantity'].' PIRB Certificate of Compliance';	
		if(isset($data['created_at'])) 	    $requestdata['created_at'] 		= date('Y-m-d H:i:s', strtotime($data['created_at']));
		if(isset($data['user_id']))			$requestdata['user_id'] 		= $data['user_id'];	
		if(isset($data['inv_id']))			$requestdata['inv_id'] 			= $data['inv_id'];	
		if(isset($data['coc_type'])) 		$requestdata['coc_type'] 		= $data['coc_type'];
		if(isset($data['delivery_type'])) 	$requestdata['delivery_type'] 	= $data['delivery_type'];
		if(isset($data['status'])) 			$requestdata['status'] 			= $data['status'];
		if(isset($data['internal_inv'])) 	$requestdata['internal_inv'] 	= $data['internal_inv'];
		if(isset($data['total_due'])) 		$requestdata['total_cost'] 	 	= $data['total_due'];
		if(isset($data['tracking_no'])) 	$requestdata['tracking_no']  	= $data['tracking_no'];
		if(isset($data['email_track'])) 	$requestdata['email_track']  	= $data['email_track'];
		if(isset($data['sms_track'])) 		$requestdata['sms_track']  		= $data['sms_track'];


		if(isset($requestdata)){	

			if(isset($data['total_due'])) unset($requestdata['total_cost']);

			$requestdata1 			= 	$requestdata;			
			if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];
			if(isset($data['cost_value'])) 		$requestdata1['cost_value'] 	= $data['cost_value'];
			if(isset($data['delivery_cost'])) 	$requestdata1['delivery_cost'] 	= $data['delivery_cost'];
			if(isset($data['vat'])) 		    $requestdata1['vat'] 			= $data['vat'];
			if(isset($data['total_due'])) 		$requestdata1['total_due'] 		= $data['total_due'];
			$requestdata1['admin_status'] 	= (isset($data['admin_status']) && $data['admin_status']='on') ? '2' : '0';
			if(isset($data['order_id']))		$requestdata1['id'] 				= $data['order_id'];	
			if(isset($data['email_track'])) 	unset($requestdata1['email_track']);
			if(isset($data['sms_track'])) 		unset($requestdata1['sms_track']);
			
			if(isset($requestdata['inv_id']) && $requestdata['inv_id']!=''){
				
				$result1 = $this->db->update('invoice', $requestdata,['inv_id'=>$requestdata['inv_id']]);				
		
				$result = $this->db->update('coc_orders', $requestdata1,['id'=>$requestdata1['id']]);

				// $counnt = "count + 1";
				// $increase_count = $this->db->update('coc_count', $counnt,['user_id'=>$data['user_id']]);
				if (isset($data['admin_status'])) {
					$this->db->set('count', 'count + '.$data['quantity'].'',FALSE); 
					$this->db->where('user_id', $data['user_id']); 
					$increase_count = $this->db->update('coc_count'); 
				}
				
				// echo $this->db->last_query();exit;
			} else {
				$result1 = $this->db->insert('invoice', $requestdata);
				$inv_id = $this->db->insert_id();

				if(isset($data['total_due'])) unset($requestdata['total_cost']);
			
				$requestdata1 			= 	$requestdata;			
				$requestdata1['inv_id']	=	$inv_id;	
				if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];
				if(isset($data['cost_value'])) 		$requestdata1['cost_value'] 	= $data['cost_value'];
				if(isset($data['delivery_cost'])) 	$requestdata1['delivery_cost'] 	= $data['delivery_cost'];
				if(isset($data['vat'])) 		    $requestdata1['vat'] 			= $data['vat'];
				if(isset($data['total_due'])) 		$requestdata1['total_due'] 		= $data['total_due'];
				if(isset($data['email_track'])) 	unset($requestdata1['email_track']);
				if(isset($data['sms_track'])) 		unset($requestdata1['sms_track']);
			
				$result = $this->db->insert('coc_orders', $requestdata1);

				
				$this->db->set('count', 'count - '.$data['quantity'].'',FALSE); 
				$this->db->where('user_id', $data['user_id']); 
				$decrease_count = $this->db->update('coc_count'); 

				$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $requestdata['user_id']], ['users', 'usersdetail']);

				$request['status'] 		= 	'1';
				 if ($inv_id) {
					$result 			= $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $requestdata['user_id']]);
				 	$result 			= $this->db->update('coc_orders', $request, ['inv_id' => $inv_id,'user_id' => $requestdata['user_id'] ]);

				 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

				 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $requestdata['user_id']])->order_by('id','desc')->get()->row_array();
				// invoice PDF
						
					$cocreport = $this->cocreport($inv_id, 'PDF Invoice Plumber COC');
						
					 $cocTypes = $orders['coc_type'];
					 $mail_date = date("d-m-Y", strtotime($orders['created_at']));
					  
				 	
				 	 $array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];
					 

					$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

					$body = str_replace($array1, $array2, $template['email_body']);

				 	if ($template['email_active'] == '1') {

				 		$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$cocreport);
				 	}
			 	}
			}
		}
		return $result;
	}

	
	public function autosearchPlumber($postData){
		
		$this->db->select('concat(ud.name, " ", ud.surname) as name,cc.count,u.type,ud.status,u.id,up.coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3']);
		$this->db->where_in('up.designation', ['4', '6']);

		$this->db->group_start();
			$this->db->like('ud.name',$postData['search_keyword']);
			$this->db->or_like('ud.surname',$postData['search_keyword']);		
			$this->db->or_like('up.registration_no',$postData['search_keyword']);
		$this->db->group_end();

		$this->db->group_by("ud.id");		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	public function autosearchReseller($postData){
		
		$this->db->select('ud.status, concat(ud.name, " ", ud.surname, " (", ud.company, ")") as name,cc.count,u.id, "0" as coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '6']);
		
		$this->db->group_start();
			$this->db->like('ud.name',$postData['search_keyword']);
			$this->db->or_like('ud.surname',$postData['search_keyword']);
			$this->db->or_like('ud.company',$postData['search_keyword']);
		$this->db->group_end();
		
		$this->db->group_by("ud.id");
		
		$query = $this->db->get();
		$result = $query->result_array();

		$result_new = array();
		foreach ($result as $key => $value) {
			if($value['name']!='' && $value['status']==1){
				$result_new[] = $value;
			}
		}
		
		return $result_new;
	}

	public function autosearchAuditor($postData){
		$openaudit = 	',(
							select count(sm.id) 
							from stock_management sm
							left join auditor_statement as ars on ars.coc_id=sm.id
							where sm.auditorid=ud.user_id and (ars.auditcomplete=0 or ars.auditcomplete IS NULL)
						) as openaudit';
						
		$mtd 		= 	',(
							select count(sm.id) 
							from stock_management sm
							where sm.auditorid=ud.user_id and month(audit_allocation_date) = '.date('m').' and year(audit_allocation_date) = '.date('Y').'
						) as mtd';
		
		$this->db->select('
			u.id, 
			concat(ud.name, " ", ud.surname) as name,
			aa.allocation_allowed as allowedaudit,
			p1.name as province,
			c1.name as city,
			s1.name as suburb,
			group_concat(p2.name separator "@-@") as provincelist,
			group_concat(c2.name separator "@-@") as citylist,
			group_concat(s2.name separator "@-@") as suburblist
		'.$openaudit.$mtd);
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');		
		$this->db->join('auditor_availability aa', 'aa.user_id=ud.user_id','left');
		$this->db->join('users_address ua', 'ua.user_id=ud.user_id and ua.type="3"','left');
		$this->db->join('province p1', 'ua.province=p1.id','left');		
		$this->db->join('city c1', 'ua.city=c1.id','left');				
		$this->db->join('suburb s1', 'ua.suburb=s1.id','left');		
		$this->db->join('users_auditor_area uaa', 'uaa.user_id=ud.user_id','left');
		$this->db->join('province p2', 'uaa.province=p2.id','left');		
		$this->db->join('city c2', 'uaa.city=c2.id','left');				
		$this->db->join('suburb s2', 'uaa.suburb=s2.id','left');			
		
		$this->db->where(['u.status' => '1','u.type' => '5','aa.status' => '1']);
		
		$this->db->group_start();
			$this->db->where(['ud.name !=' => '']);
			$this->db->or_where(['ud.surname !=' => '']);
		$this->db->group_end();
		
		$this->db->group_start();
			$this->db->like('ud.name', $postData['search_keyword'], 'both');
			$this->db->or_like('ud.surname', $postData['search_keyword'], 'both');
		$this->db->group_end();
		
		$this->db->group_by("ud.id");
		
		$query 		= $this->db->get();
		$results 	= $query->result_array();
		
		if(isset($postData['province'])){
			$result		= [];
			
			foreach($results as $k => $res){
				$result[$k] = 0;
				
				if($res['province']==$postData['province'] && $res['city']==$postData['city'] && $res['suburb']==$postData['suburb']){
					$result[$k] = '1';
					continue;
				}
				
				$provincelist 	= array_filter(explode('@-@', $res['provincelist']));
				$citylist 		= array_filter(explode('@-@', $res['citylist']));
				$suburblist 	= array_filter(explode('@-@', $res['suburblist']));
				
				$checklist = '';
				
				for($i=0; $i<count($provincelist); $i++){
					if(isset($provincelist[$i]) && isset($citylist[$i]) && isset($suburblist[$i]) && $provincelist[$i]==$postData['province'] && $citylist[$i]==$postData['city'] && $suburblist[$i]==$postData['suburb']){
						$checklist = '1';
						break;
					}
				}
				
				if($checklist=='1'){
					$result[$k] = '1';
					continue;
				}
			}
			
			array_multisort($result, SORT_DESC, $results);
		}
		
		return $results;
	}
}
