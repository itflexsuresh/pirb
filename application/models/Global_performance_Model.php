<?php

class Global_performance_Model extends CC_Model
{
	public function getPointList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('gps_point');
		
		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function getWarningList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('gps_notification');
		
		if(isset($requestdata['id'])) 				$this->db->where('id', $requestdata['id']);
		if(isset($requestdata['status']))	$this->db->where_in('status', $requestdata['status']);
		
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
		// echo "<pre>";
		// print_r($data);die;
		 $this->db->trans_begin();
		
		$userid	  = 	$this->getUserID();
		$id       =     $data['id'];
		
       $point = $data['points'];

       foreach($point as $k => $v)
    	{
        
    		$this->db->update('gps_point', ['point' => $v],['id' => $k]);

    	}

        $notification_points = $data['points1'];
   
    	  foreach($notification_points as $n => $p)
    	{

    		$this->db->update('gps_notification', ['point' => $p],['id' => $n]);
    	
 
    	}
    	  for ($i=1; $i <= 4; $i++) { 
		    if (isset($data['status'][$i])=='on') {
		   		$vals = '1';
		   		$this->db->update('gps_notification', ['status' => $vals],['id' => $i]);
		   	}else{
				$vals = '0';
				$this->db->update('gps_notification', ['status' => $vals],['id' => $i]);
		   	}
    	  }
        if(isset($data['rolling_avg'])) $request['rolling_avg'] = $data['rolling_avg'];

      
		if($data['rolling_avg']!=''){
			$this->db->update('gps_notification', $request, ['id' => '1']);
		}
        if($data['rolling_avg']!=''){
			$this->db->update('gps_notification', $request, ['id' => '2']);
		}
		if($data['rolling_avg']!=''){
			$this->db->update('gps_notification', $request, ['id' => '3']);
		}
		if($data['rolling_avg']!=''){
			$this->db->update('gps_notification', $request, ['id' => '4']);
		}
    	
		// if($this->db->trans_status() === FALSE || if($notice_point_update))
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



