<?php

class Renewal_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		
        $this->db->select ('inv.*, ud.name, ud.surname, ud.status as userstatus, up.registration_no, us.expirydate');
        $this->db->from('invoice inv');    
        $this->db->join('users_detail ud', 'ud.user_id = inv.user_id', 'left');
        $this->db->join('users_plumber up', 'up.user_id = inv.user_id', 'left');
        $this->db->join('users us', 'us.id = inv.user_id', 'left');
        $this->db->where('inv.inv_type', '2');
        $this->db->or_where('inv.inv_type', '3');
        $this->db->or_where('inv.inv_type', '4');
        // $this->db->order_by("inv.inv_id", "desc");        
     
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length']))
		{
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['inv.inv_id'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}

		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = trim($requestdata['search']['value']);
			if($searchvalue == 'Paid'){
				$this->db->where('inv.status', '1');
			}
			elseif($searchvalue == 'Unpaid'){
				$this->db->where('inv.status', '0');	
			}
			else{
				$this->db->like('inv.inv_id', $searchvalue);
				$this->db->or_like('ud.name', $searchvalue);
				$this->db->or_like('ud.surname', $searchvalue);		
				$this->db->or_like('up.registration_no', $searchvalue);
				$this->db->or_like('inv.description', $searchvalue);
				$this->db->or_like('inv.total_cost', $searchvalue);
				$this->db->or_like('inv.internal_inv', $searchvalue);
			}
		}
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}

		// echo $this->db->last_query();
		// exit;

		
		return $result;
	}
	
	public function getUserids()
	{
		
		$this->db->select('id, expirydate');		
		$this->db->from('users');
		$this->db->where('type', '3' );
		$result = $this->db->get()->result_array();

		$userid_array = array();
		$currentdate = date('Y-m-d h:i:s');	
		
		foreach($result as $rows)
		{	
			$createdate = $rows['expirydate'];
			if($createdate == '0000-00-00 00:00:00'){}
			else{
				$userid = $rows['id'];			
				$datetime1 = new DateTime($createdate);
				$datetime2 = new DateTime($currentdate);
				$interval = $datetime1->diff($datetime2);
				$month = $interval->format('%m');
				$year = $interval->format('%y')*12;
				$monthcount = $month+$year+1;

				// $now = time();
				// $your_date = strtotime($createdate);
				// $datediff = $now - $your_date;
				// $monthcount = $datediff / (60 * 60 * 24);
				// echo $monthcount = $monthcount/30;
				if($monthcount == 11){					
					$userid_array[] = $userid; 
				}
			}
		}		

		$result = array();
		if(!empty($userid_array)){
			$this->db->select('us.id, us.expirydate, up.designation');		
			$this->db->from('users us');
			$this->db->join('users_plumber as up', 'up.user_id=us.id', 'inner');
			$this->db->where_in('us.id', $userid_array );			
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function getUserids_alert2()
	{
		
		$this->db->select('us.id, us.expirydate');		
		$this->db->from('users us');
		$this->db->join('invoice inv', 'inv.user_id=us.id', 'inner');
		$this->db->where('inv.inv_type', '2' );
		$this->db->where('inv.status', '0' );
		$this->db->where('us.type', '3' );
		$result = $this->db->get()->result_array();

		$userid_array = array();
		$currentdate = date('Y-m-d h:i:s');			
		foreach($result as $rows)
		{	
			$createdate = $rows['expirydate'];
			if($createdate == '0000-00-00 00:00:00'){}
			else{
				$userid = $rows['id'];			
				// $datetime1 = new DateTime($createdate);
				// $datetime2 = new DateTime($currentdate);
				// $interval = $datetime1->diff($datetime2);
				// $days = $interval->format('%a');								
				// echo $days."- ";
				$now = time();
				$your_date = strtotime($createdate);
				$datediff = $now - $your_date;
				$days = round($datediff / (60 * 60 * 24)) - 1;
				// echo $days;
				if($days == 358){					
					$userid_array[] = $userid; 					
				}
			}
		}		

		$result = array();
		if(!empty($userid_array)){
			$this->db->select('us.id, us.expirydate, up.designation, inv.inv_id');		
			$this->db->from('users us');
			$this->db->join('users_plumber as up', 'up.user_id=us.id', 'inner');
			$this->db->join('invoice inv', 'inv.user_id=us.id', 'inner');
			$this->db->where('inv.inv_type', '2' );
			$this->db->where('inv.status', '0' );
			$this->db->where('us.type', '3' );
			$this->db->where_in('us.id', $userid_array );			
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function getUserids_alert3()
	{
		
		$this->db->select('us.id, us.expirydate');		
		$this->db->from('users us');
		$this->db->join('invoice inv', 'inv.user_id=us.id', 'inner');
		$this->db->where('inv.inv_type', '3' );
		$this->db->where('inv.status', '0' );
		$this->db->where('us.type', '3' );
		$result = $this->db->get()->result_array();

		$penalty = 0;
		$this->db->select('penalty');		
		$this->db->from('settings_details');
		$this->db->where('id', '1' );
		$penalty_result = $this->db->get()->row_array();
		$penalty = $penalty_result['penalty'];
		$settingsdate = $penalty + 365;

		$userid_array = array();
		$currentdate = date('Y-m-d h:i:s');			
		foreach($result as $rows)
		{	
			$createdate = $rows['expirydate'];
			if($createdate == '0000-00-00 00:00:00'){}
			else{
				$userid = $rows['id'];
				$now = time();
				$your_date = strtotime($createdate);
				$datediff = $now - $your_date;
				$days = round($datediff / (60 * 60 * 24)) + 1;
				// echo $userid."(".$settingsdate." : ".$days.") - ";
				if($days >= $settingsdate){					
					$userid_array[] = $userid; 					
				}
			}
		}		

		$result = array();
		if(!empty($userid_array)){
			$this->db->select('us.id, us.expirydate, up.designation, inv.inv_id');		
			$this->db->from('users us');
			$this->db->join('users_plumber as up', 'up.user_id=us.id', 'inner');
			$this->db->join('invoice inv', 'inv.user_id=us.id', 'inner');
			$this->db->where('inv.inv_type', '3' );
			$this->db->where('inv.status', '0' );
			$this->db->where('us.type', '3' );
			$this->db->where_in('us.id', $userid_array );			
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function getUserids_alert4()
	{
		
		$this->db->select('us.id, us.email, us.expirydate, up.designation, inv.inv_id, ud.name, ud.surname');	
		$this->db->from('users us');
		$this->db->join('users_plumber as up', 'up.user_id=us.id', 'inner');
		$this->db->join('users_detail as ud', 'ud.user_id=us.id', 'inner');
		$this->db->join('invoice inv', 'inv.user_id=us.id', 'inner');
		$this->db->where('inv.inv_type', '4' );
		$this->db->where('inv.status', '0' );
		$this->db->where('us.type', '3' );		
		$result = $this->db->get()->result_array();		 
		return $result;
	}


	public function checkinv($userid)
	{
			$this->db->select('*');		
			$this->db->from('invoice');			
			$this->db->where_in('user_id', $userid );		
			$result = $this->db->get()->result_array();
			return $result;
	}

	public function get_lateamount()
	{
		$this->db->select('amount');
		$this->db->from('rates');
		$this->db->where('id', '10');
		$lateamount_result = $this->db->get()->row_array();
		return $lateamount_result;
	}

	public function insertdata($userid,$designation,$inv_type)
	{
		$this->db->select('amount');
		$this->db->from('rates');
		if($designation == '4')
			$this->db->where('id', '6');
		elseif($designation == '5')
			$this->db->where('id', '5');
		elseif($designation == '6')
			$this->db->where('id', '7');
		else
			$this->db->where('supplyitem', 'Registration Rates');
		
		$rates = $this->db->get()->row_array(); 
		$rate = $rates['amount'];


		$this->db->select('vat_percentage');
		$this->db->from('settings_details');
		$this->db->where('id', '1');
		$vats = $this->db->get()->row_array();
		$vat = $vats['vat_percentage'];

		if($inv_type == '4'){
			$this->db->select('amount');
			$this->db->from('rates');
			$this->db->where('id', '10');
			$lateamount_result = $this->db->get()->row_array();
			$lateamount = $lateamount_result['amount'];		

			$rate1 = $rate + $lateamount;
			$vat_amount1 = $rate1 * $vat / 100;
			$vat_amount1 = round($vat_amount1,2);

			$vat_lateamount = $lateamount * $vat / 100;
			$vat_lateamount = round($vat_lateamount,2);
			$total_lateamount = $vat_lateamount + $lateamount;
		}

		$vat_amount = $rate * $vat / 100;
		$vat_amount = round($vat_amount,2);
		$total = $vat_amount + $rate;

		$currentdate = date('Y-m-d h:i:s');		
		
		if($inv_type == '4'){
			$this->db->insert('invoice', ['description' => "Registration Fee", 'user_id' => $userid, 'status' => '0', 'inv_type' => $inv_type,  'coc_type' => '2',  'delivery_type' => '2', 'total_cost' => $rate1, 'vat'=>$vat_amount1, 'created_at' => $currentdate]) ;
			$result['invoice_id'] = $this->db->insert_id();
		}
		else{
			$this->db->insert('invoice', ['description' => "Registration Fee", 'user_id' => $userid, 'status' => '0', 'inv_type' => $inv_type,  'coc_type' => '2',  'delivery_type' => '2', 'total_cost' => $rate, 'vat'=>$vat_amount, 'created_at' => $currentdate]) ;
			$result['invoice_id'] = $this->db->insert_id();
		}
		
		$this->db->insert('coc_orders', ['user_id' => $userid, 'description' => "Registration Fee",'quantity' => '1', 'status' => '0',  'cost_value' => $rate, 'coc_type' => '2',  'delivery_type' => '2', 'total_due' => $total, 'vat'=>$vat_amount, 'inv_id' => $result['invoice_id'], 'created_at' => $currentdate, 'created_by' => $userid]);
		$result['cocorder_id']  = $this->db->insert_id();

		if($inv_type == '4'){
			$this->db->insert('coc_orders', ['user_id' => $userid, 'description' => "Late Penalty Fee",'quantity' => '1', 'status' => '0',  'cost_value' => $lateamount, 'coc_type' => '2',  'delivery_type' => '2', 'total_due' => $total_lateamount, 'vat'=>$vat_lateamount, 'inv_id' => $result['invoice_id'], 'created_at' => $currentdate, 'created_by' => $userid]);
			$result['cocorder_id2']  = $this->db->insert_id();
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

	public function deleteid($id)
	{ 
		$url = FCPATH."assets/inv_pdf/".$id.".pdf";
		unlink($url);
			
		$this->db->where('inv_id', $id);		
		$result = $this->db->delete('invoice');

		$this->db->where('inv_id', $id);		
		$result1 = $this->db->delete('coc_orders');		

		return $result;

	}


	public function getPermissions1($type2)
	{ 
		$this->db->select('*');
		$this->db->from('settings_address');
		
      if($type2=='count'){
			$result = $this->db->count_all_results();
			
		}else{
			$query = $this->db->get();
			
			
			if($type2=='all') 		$result = $query->result_array();
			elseif($type2=='row') 	$result = $query->row_array();
		}
		
		return $result;
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