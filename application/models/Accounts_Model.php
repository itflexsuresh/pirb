<?php

class Accounts_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{		
        $query=$this->db->select('
			t1.*,
        	t2.inv_id as inv_id2, t2.total_due, t2.quantity, t2.cost_value, t2.delivery_cost,
			t3.reg_no, t3.id, t3.name name, t3.surname surname, t3.company_name company_name, t3.vat_no vat_no, t3.email2, t3.home_phone,
			t4.type,t4.address,t4.province, t4.suburb, t4.city,t5.registration_no,
			c1.name as orderstatusname
		');
        $this->db->from('invoice t1');
        $this->db->join('coc_orders t2','t2.inv_id = t1.inv_id', 'left');
        $this->db->join('users_detail t3', 't3.user_id = t1.user_id', 'left');
        $this->db->join('users_address t4', 't4.user_id = t1.user_id AND t4.type=1', 'left');
		$this->db->join('users_plumber t5', 't5.user_id = t1.user_id', 'left');
		$this->db->join('users u', 'u.id=t1.user_id', 'inner');
		$this->db->join('custom c1', 'c1.c_id=t1.order_status and c1.type="7"', 'left');
		$this->db->where('u.type', '3');
		
		if(isset($requestdata['id'])) 		$this->db->where('t1.inv_id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 	$this->db->where('t1.user_id', $requestdata['user_id']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];
				if($page=='plumberaccount'){
					$column = ['t1.description', 't1.inv_id', 't1.created_at', 't2.total_due', 't1.status', 'c1.name'];
				}
			}else{
				$column = ['inv_id', 'created_at', 'name', 'registration_no', 'description', 'total_cost', 'internal_inv'];
			}
			
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}

		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();			
				if(isset($requestdata['page'])){
					$page = $requestdata['page'];
					if($page=='plumberaccount'){
						$this->db->like('t1.description', $searchvalue);
						$this->db->or_like('t1.inv_id', $searchvalue);
						$this->db->or_like('DATE_FORMAT(t1.created_at,"%d-%m-%Y")', $searchvalue);
						$this->db->or_like('t2.total_due', $searchvalue);
					}
				}else{
					$this->db->like('t1.inv_id', $searchvalue);
					$this->db->or_like('t1.description', $searchvalue);
					$this->db->or_like('DATE_FORMAT(t1.created_at,"%d-%m-%Y")', $searchvalue);
					$this->db->or_like('t1.total_cost', $searchvalue);
					$this->db->or_like('t1.internal_inv', $searchvalue);
					$this->db->or_like('t3.name', $searchvalue);
					$this->db->or_like('t3.surname', $searchvalue);
					$this->db->or_like('t5.registration_no', $searchvalue);
				}
			$this->db->group_end();
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



	
	public function action($data)
	{
		//print_r($data);die;
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'updated_at' 		=> $datetime,
			'updated_by' 		=> $userid
		];
							//print_r($data);die;
		
		if(isset($data['activity'])) 		$request['activity'] 		= $data['activity'];
		if(isset($data['points'])) 			$request['points'] 			= $data['points'];
		if(isset($data['productcode'])) 	$request['productcode'] 	= $data['productcode'];
		if(isset($data['cpdstream'])) 		$request['cpdstream'] 		= $data['cpdstream'];
		if(isset($data['qrcode'])) 			$request['qrcode'] 			= $data['qrcode'];
		$request['status'] 												= (isset($data['status'])) ? $data['status'] : '0';
		if(isset($data['startdate'])) 		$request['startdate'] 		= date('Y-m-d',strtotime($data['startdate'])); 
		if(isset($data['enddate'])) 		$request['enddate'] 		= date('Y-m-d',strtotime($data['enddate']));
		
		if($id==''){
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			$this->db->insert('cpdtypes', $request);
		}else{
			$this->db->update('cpdtypes', $request, ['id' => $id]);
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
	public function getCronDate(){
		$this->db->select('id, enddate, status');
		$this->db->from('cpdtypes');
		$this->db->where('enddate <', date('Y-m-d'));
		$query = $this->db->get()->result_array();
		foreach ($query as $key => $value) {
			//print_r($value);
			$this->db->update('cpdtypes', ['status' => '0'], ['id' => $value['id']]);
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
