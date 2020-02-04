<?php

class Paper_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 	
		
		$query2 = $this->db->query("SELECT id FROM paper_stock_management ORDER BY id DESC LIMIT 0,1");	    
	    $result = $data['non_all'] = $query2->row_array();
	    return $result;
		

		if($type=='count')
		{
			$result = $this->db->count_all_results();
		}
		else
		{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		
		
	}
	public function getCount($type, $requestdata=[])
	{ 
		
		$query5 = $this->db->query("SELECT COUNT(coc_status) as total FROM paper_stock_management WHERE coc_status = 'admin_stock' ");
		$result = $data['count_admin'] = $query5->row_array();	
		 
		return $result;

		if($type=='count')
		{
			$result = $this->db->count_all_results();
		}
		else
		{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		
		
	}

	public function action($data)
	{	

		$this->db->trans_begin();

		$userid			= 	$this->getUserID();		
		$datetime		= 	date('Y-m-d H:i:s');
		//$id				= 	$data['id'];

		//if(isset($data['allocate'])) 			$request1['allocate'] 				= $data['allocate'];
		if(isset($data['cocstock'])) 			$request1['stock'] 					= $data['cocstock'];
		if(isset($data['range_start'])) 		$request1['range_start'] 			= $data['range_start'];
		if(isset($data['range_end'])) 			$request1['range_end'] 				= $data['range_end'];
		
		if(isset($request1))
		{	

			$request1['created_at'] = $datetime;
			// print_r($request1); exit;
			$userdata = $this->db->insert('paper_stock_management_log', $request1);
			//print_r($userdata); exit;			
			
		}
		
		if($this->db->trans_status() == FALSE)
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

	
	


