<?php

class Mycpd_Model extends CC_Model
{
	public function getQueueList($type, $requestdata=[])
	{
		//print_r($requestdata['user_id'][0]);die;
		$datetime	= 	date('Y-m-d H:i:s');
		if ($requestdata['pagestatus'] == '1') {
			$requestdata['pagestatus'] = array('0','1','2','3');
			$requestdata['flag'] = array('1');
			$this->db->select('t1.*, t2.renewal_date');
			$this->db->from('cpd_activity_form t1');
			$this->db->join('users t2', 't2.id = t1.user_id', 'right')->order_by('t1.id','DESC');
			
			if(isset($requestdata['user_id'][0])) 	$this->db->where('t1.user_id', $requestdata['user_id'][0]);
			if(isset($requestdata['user_id'][0])) 	$this->db->where('t2.id', $requestdata['user_id'][0]);
			$this->db->where('t2.renewal_date<=','t1.created_at', false);
			
		}elseif ($requestdata['pagestatus'] == '0') {
			$requestdata['pagestatus'] = array('4');
			$requestdata['flag'] = array('2');
			$this->db->select('t1.*, t2.renewal_date');
			$this->db->from('cpd_activity_form t1');
			$this->db->join('users t2', 't2.id = t1.user_id', 'right')->order_by('t1.id','DESC');
			
			if(isset($requestdata['user_id'][0])) 	$this->db->where('t1.user_id', $requestdata['user_id'][0]);
			if(isset($requestdata['cpd_stream'][0])) 	$this->db->where('t1.cpd_stream', $requestdata['cpd_stream'][0]);
			if(isset($requestdata['status'][0])) 	$this->db->where('t1.status', $requestdata['status'][0]);
			if(isset($requestdata['user_id'][0])) 	$this->db->where('t2.id', $requestdata['user_id'][0]);
			$this->db->where('t2.renewal_date>=','CURDATE()', false);
		}
		//print_r($this->db->where_in('flag', $requestdata['flag']));die;


		// $this->db->select('t1.*, t2.renewal_date');
		// $this->db->from('cpd_activity_form t1');
		// $this->db->join('users t2', 't2.id = t1.user_id', 'right')->order_by('t1.id','DESC');
		
		// if(isset($requestdata['user_id'][0])) 	$this->db->where('t1.user_id', $requestdata['user_id'][0]);
		// if(isset($requestdata['user_id'][0])) 	$this->db->where('t2.id', $requestdata['user_id'][0]);
		// $this->db->where('t2.renewal_date>=','CURDATE()', false);
		//print_r($this->db->last_query());
		// if(isset($requestdata['status']))		$this->db->where_in('flag', $requestdata['flag']);
		// $this->db->where_in('flag', $requestdata['flag']);

		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id', 'reg_number', 'name_surname', 'cpd_activity', 'cpd_start_date', 'points'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->group_start();
				$this->db->like('reg_number', $searchvalue);
				$this->db->or_like('name_surname', $searchvalue);
				$this->db->or_like('cpd_activity', $searchvalue);
				$this->db->or_like('cpd_start_date', $searchvalue);
				$this->db->or_like('points', $searchvalue);
				// $this->db->or_like('status', $searchvalue);
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

	public function actionInsert($requestdata){
		
		$user_id 	= $this->getUserID();
		$id 		= $requestdata['id'];
		$cpd_id 	= $requestdata['cpd_id'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		if(isset($requestdata['hidden_regnumber'])) $requestData1['reg_number']    		= $requestdata['hidden_regnumber'];
		if(isset($requestdata['user_id']))  		$requestData1['user_id'] 	    	= $requestdata['user_id'];
		if(isset($requestdata['name_surname']))  	$requestData1['name_surname']  		= $requestdata['name_surname'];
		if(isset($requestdata['activity'])) 		$requestData1['cpd_activity']  		= $requestdata['activity'];
		if(isset($requestdata['startdate'])) 	 	$requestData1['cpd_start_date'] 	= date("Y-m-d H:i:s", strtotime($requestdata['startdate']));
		if(isset($requestdata['comments'])) 	 	$requestData1['comments'] 			= $requestdata['comments'];
		if(isset($requestdata['image1'])) 		 	$requestData1['file1'] 				= $requestdata['image1'];
		if(isset($requestdata['points'])) 		 	$requestData1['points'] 			= $requestdata['points'];
		if(isset($requestdata['hidden_stream_id'])) $requestData1['cpd_stream'] 		= $requestdata['hidden_stream_id'];
		$requestData1['status'] 														= '0';
		
		// echo "<pre>";
		// print_r($requestData1);die;
		
		if($cpd_id==''){
			$requestData1['created_at'] = 	$datetime;
			$requestData1['created_by']	= 	$user_id;

			$query = $this->db->insert('cpd_activity_form', $requestData1);
		}else{
			$requestData1['updated_at'] = 	$datetime;
			$requestData1['updated_by']	= 	$user_id;

			$query = $this->db->update('cpd_activity_form', $requestData1, ['id' => $cpd_id]);
		}
		return $query;

	}

	public function actionSave($requestdata){
		
		$user_id 	= $this->getUserID();
		//$id 		= $requestdata['id'];
		$cpd_id 	= $requestdata['cpd_id'];
		$datetime	= date('Y-m-d H:i:s');
		// echo "<pre>";
		// print_r($requestdata);die;
		
		if(isset($requestdata['hidden_regnumber'])) 	$requestData1['reg_number']    		= $requestdata['hidden_regnumber'];
		if(isset($requestdata['user_id']))  			$requestData1['user_id']		 	= $requestdata['user_id'];
		if(isset($requestdata['name_surname']))  		$requestData1['name_surname']  		= $requestdata['name_surname'];		
		if(isset($requestdata['activity'])) 			$requestData1['cpd_activity']  		= $requestdata['activity'];		
		if(isset($requestdata['startdate'])) 	 		$requestData1['cpd_start_date'] 	= date('Y-m-d', strtotime($requestdata['startdate']));
		if(isset($requestdata['comments'])) 	 		$requestData1['comments'] 			= $requestdata['comments'];		
		if(isset($requestdata['image1'])) 		 		$requestData1['file1'] 				= $requestdata['image1'];		
		if(isset($requestdata['points'])) 		 		$requestData1['points'] 			= $requestdata['points'];		
		if(isset($requestdata['hidden_stream_id'])) 	$requestData1['cpd_stream'] 		= $requestdata['hidden_stream_id'];
		$requestData1['status'] 															= '3';

		
		if($cpd_id==''){
			$requestData1['created_at'] = 	$datetime;
			$requestData1['created_by']	= 	$user_id;

			$query = $this->db->insert('cpd_activity_form', $requestData1);
		}else{
			$requestData1['updated_at'] = 	$datetime;
			$requestData1['updated_by']	= 	$user_id;

			$query = $this->db->update('cpd_activity_form', $requestData1, ['id' => $cpd_id]);
		}
		return $query;

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

	//Plumber Reg Search
	public function autosearchPlumberReg($postData){ 
		
		$designations = array('4', '5', '6' );
		$this->db->select('u1.reg_no, u2.id, u1.name, u1.surname');
		$this->db->from('users_detail u1');
		$this->db->join('users u2', 'u1.user_id=u2.id and u2.type="3" and u2.status="1"','left');
		$this->db->join('users_plumber up', 'up.user_id=u1.user_id','left');
		$this->db->where_in('up.designation', $designations);
		$this->db->like('u1.reg_no',$postData['search_keyword']);
		// $this->db->or_like('u1.surname',$postData['search_keyword']);
		$this->db->group_by("u1.id");		
		$query = $this->db->get();
		$result1 = $query->result_array(); 

		if (empty($result1)) {
			$this->db->select('u1.name,u1.surname,u2.id');
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

		//CPD Activity Search
	public function autosearchActivity($postData){ 

		$currentDate = date('Y-m-d H:i:s');

		$this->db->select('cp1.id, cp1.activity, cp1.startdate, cp1.points, cp1.cpdstream');
		$this->db->from('cpdtypes cp1');

		$this->db->like('cp1.activity',$postData['search_keyword']);

		$this->db->where('cp1.status="1"');
		$this->db->where('cp1.startdate<="'.$currentDate.'"');
		$this->db->where('cp1.enddate>"'.$currentDate.'"');
		
		$this->db->group_by("cp1.id");		
		$query = $this->db->get();
		$result1 = $query->result_array(); 

		return $result1;
	}

}