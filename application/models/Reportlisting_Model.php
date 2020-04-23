<?php

class Reportlisting_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{
		$this->db->select('t1.*, t2.name, t3.name insname');
		$this->db->from('report_listing t1');		

		$this->db->join('installationsubtype t2','t2.installationtype_id=t1.installation_id AND t2.id=t1.subtype_id	and t2.status!="2"','left');
	 	$this->db->join('installationtype t3','t3.id=t1.installation_id	and t3.status!="2"','left');


		if(isset($requestdata['id'])) $this->db->where('t1.id', $requestdata['id']);
		if(isset($requestdata['installationtypeid'])) $this->db->where('t1.installation_id', $requestdata['installationtypeid']);
		if(isset($requestdata['subtypeid'])) $this->db->where('t1.subtype_id', $requestdata['subtypeid']);
		if(isset($requestdata['reference'])) $this->db->where('t1.regulation', $requestdata['reference']);
		if(isset($requestdata['status'])) $this->db->where_in('t1.status', $requestdata['status']);
		

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['t1.id', 't1.installation_id', 't1.subtype_id', 't1.compliment', 't1.cautionary', 't1.refix_complete', 't1.refix_incomplete','t1.status', 't2.name', 't3.insname'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}

		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower((trim($requestdata['search']['value'])));
			$this->db->like('t3.name', $searchvalue);
			// $this->db->or_like('t1.id', $searchvalue);
			// $this->db->or_like('t1.installation_id', $searchvalue);
			// $this->db->or_like('t2.name', $searchvalue);
			// $this->db->like('t1.subtype_id', $searchvalue);
			// $this->db->or_like('t1.compliment', $searchvalue);
			// $this->db->or_like('t1.refix_complete', $searchvalue);
			// $this->db->or_like('t1.refix_incomplete', $searchvalue);
			// $this->db->or_like('t1.cautionary', $searchvalue);
			
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

		if(isset($data['installation'])) 	$request['installation_id'] 		= $data['installation'];
		if(isset($data['regulation'])) 		$request['regulation'] 				= $data['regulation'];
		if(isset($data['subtype'])) 		$request['subtype_id'] 				= $data['subtype'];
		if(isset($data['knowledge'])) 		$request['knowledge_link'] 			= $data['knowledge'];
		if(isset($data['statement'])) 		$request['statement'] 				= $data['statement'];
		if(isset($data['comment'])) 		$request['comments'] 				= $data['comment'];
		if(isset($data['compliment'])) 		$request['compliment'] 				= $data['compliment'];
		if(isset($data['refix_complete'])) 	$request['refix_complete'] 			= $data['refix_complete'];
		if(isset($data['caution'])) 		$request['cautionary'] 				= $data['caution'];
		if(isset($data['refix_in'])) 		$request['refix_incomplete'] 		= $data['refix_in'];

		$request['status'] 	= (isset($data['status'])) ? $data['status'] : '0';

		if($id=='')
		{
			$request['created_at'] = $datetime;
			$request['created_by'] = $id;
			
			$this->db->insert('report_listing', $request);
		}
		else
		{
			$this->db->update('report_listing', $request, ['id' => $id]);
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

	// public function installationtypeValidator($data)
	// {
	// 	$id 				= $data['id'];
	// 	$installationtype 	= $data['name'];		
	// 	$this->db->where('name', $installationtype);
	// 	if($id!='') $this->db->where('id !=', $id);
	// 	//$this->db->where('status !=', '2');
	// 	$query = $this->db->get('installationtype');
		
	// 	if($query->num_rows() > 0){
	// 		return 'false';
	// 	}else{
	// 		return 'true';
	// 	}
	// }
	
	public function changestatus($data)
	{
		$userid		= 	$this->getUserID();
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$delete 	= 	$this->db->update(
			'report_listing', 
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