<?php

class Auditor_Reportlisting_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('t1.*, t2.name, t3.name insname');
		// $this->db->order_by('t1.id','desc');
		$this->db->from('auditor_report_listing t1');		
		// echo $userid;exit;

		$this->db->join('installationsubtype t2','t2.installationtype_id=t1.installationtype_id	AND t2.id=t1.subtype_id	','left');
	 	$this->db->join('installationtype t3','t3.id=t1.installationtype_id','left');
	 	
		// $user_id			= 	$this->getUserID();
		
		
		if(isset($requestdata['id'])) $this->db->where('t1.id', $requestdata['id']);
		if(isset($requestdata['user_id'])) $this->db->where('t1.user_id', $requestdata['user_id']);

		if(isset($requestdata['installationtypeid'])) $this->db->where('t1.installationtype_id', $requestdata['installationtypeid']);
		if(isset($requestdata['subtypeid'])) $this->db->where('t1.subtype_id', $requestdata['subtypeid']);
		//if(isset($requestdata['statementid'])) $this->db->where('t1.statement_id', $requestdata['statementid']);
		if(isset($requestdata['status'])) $this->db->where_in('t1.status', $requestdata['status']);
		

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['t1.favour_name', 't2.name', 't3.name', 't1.comments', 't1.status'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}

		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower((trim($requestdata['search']['value'])));
			$this->db->group_start();
				$this->db->like('t1.favour_name', $searchvalue, 'both');
				$this->db->or_like('t2.name', $searchvalue, 'both');
				$this->db->or_like('t3.name', $searchvalue, 'both');
				$this->db->or_like('t1.comments', $searchvalue, 'both');
			$this->db->group_end();
		}
		
		if($type=='count'){
			$result = $this->db->count_all_results();

		}else{
			$query = $this->db->get();

			if($type=='all') $result = $query->result_array();
			elseif($type=='row') $result = $query->row_array();

		}

		return $result;
		

	}
	
	public function action($data)
	{ 

		$this->db->trans_begin();
		
		
		 
		$userid			= 	$this->getUserID();

		$id 			= 	$data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[

			'updated_at' 		=> $datetime,
			'updated_by' 		=> $id
		];
		
		$request['user_id'] = $userid;	
		if(isset($data['installation'])) 	$request['installationtype_id'] 	= $data['installation'];
		if(isset($data['subtype'])) 		$request['subtype_id'] 				= $data['subtype'];
		if(isset($data['statement'])) 		$request['statement_id'] 			= $data['statement'];
		if(isset($data['comment'])) 		$request['comments'] 				= $data['comment'];
		if(isset($data['favour_name'])) 	$request['favour_name'] 			= $data['favour_name'];
		
		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

		if($id=='')
		{
			$request['created_at'] = $datetime;
			$request['created_by'] = $userid;
			
			
			$this->db->insert('auditor_report_listing', $request);
			// echo $this->db->last_query(); exit;

		}
		else
		{
			$this->db->update('auditor_report_listing', $request, ['id' => $id]);
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

	
	
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->update('auditor_report_listing', 
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