<?php

class Paper_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 	
		$this->db->select('id');
		$this->db->from('stock_management');
		
		if(isset($requestdata['cocstatus'])) $this->db->where('coc_status', $requestdata['cocstatus']);
		if(isset($requestdata['nococstatus'])) $this->db->where('coc_status !=', $requestdata['nococstatus']);
		if(isset($requestdata['userid'])) $this->db->where('user_id', $requestdata['userid']);
		
		$this->db->order_by('id', 'desc');
				
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
		
		 return $result;		
	}

	public function getLogList($type, $requestdata=[])
	{ 	
		$this->db->select('*');
		$this->db->from('stock_management_log');

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['stock', 'range_start', 'range_end', 'created_at'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('stock', $searchvalue);
			$this->db->or_like('range_start', $searchvalue);
			$this->db->or_like('range_end', $searchvalue);
			$this->db->or_like('DATE_FORMAT(created_at,"%d-%m-%Y")', $searchvalue, 'both');
		}
				
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
		
		 return $result;		
	}
	
	public function action($data)
	{	

		$this->db->trans_begin();

		$userid			= 	$this->getUserID();		
		$datetime		= 	date('Y-m-d H:i:s');

		if(isset($data['cocstock'])) 			$request1['stock'] 					= $data['cocstock'];
		if(isset($data['range_start'])) 		$request1['range_start'] 			= $data['range_start'];
		if(isset($data['range_end'])) 			$request1['range_end'] 				= $data['range_end'];
		
		if(isset($data['startrange']) && isset($data['endrange']) && $data['startrange']!='' && $data['endrange']!=''){
			$request1['stock'] 					= ($data['startrange']==$data['endrange']) ? '1' : ($data['endrange']-$data['startrange'])+1;
			$data['cocstock']					= $request1['stock'];
			$request1['range_start'] 			= $data['startrange'];
			$request1['range_end'] 				= $data['endrange'];
		}
		
		if(isset($request1))
		{	
			$request1['created_at'] = $datetime;
			$userdata = $this->db->insert('stock_management_log', $request1);
			
			if($userdata)
			{
				if($data['cocstock'] > 0)
				{
					for($i =0; $i<$data['cocstock']; $i++)
					{
						$request2['coc_status'] 		= "1";
						$request2['audit_status'] 		= "1";
						$request2['type'] 				= "2";
						$request2['purchased_at'] 		= $datetime;
						$request2['allocation_date'] 	= $datetime;
						
						if(isset($data['startrange']) && isset($data['endrange']) && $data['startrange']!='' && $data['endrange']!=''){
							$request2['id'] = $data['startrange']+$i;
						}else{
							//$request2['id'] = $data['range_start']+$i;
						}
						
						$user_stock = $this->db->insert('stock_management', $request2);
					}
				}
			}
			else
			{
				echo "not inserted";
			}
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
	
	
	public function stockvalidation($data)
	{
		$startrange = $data['startrange'];
		$endrange 	= $data['endrange'];
		
		if($startrange=='' || $endrange=='') return 'true';
		
		$this->db->where('id >=', $startrange);
		$this->db->where('id <=', $endrange);
		$query = $this->db->get('stock_management');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
		}
	}
}