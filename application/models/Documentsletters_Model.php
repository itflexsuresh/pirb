<?php

class Documentsletters_Model extends CC_Model
{
	
	public function getList($type, $requestdata=[])
	{ 
		

		$this->db->select('*');

		$this->db->from('documentsletters');
		
		if(isset($requestdata['plumberid']))
			$this->db->where('user_id', $requestdata['plumberid']);

		if(isset($requestdata['id']))
			$this->db->where('id', $requestdata['id']);

		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id','description','created_at' ];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('description', $searchvalue);
			$this->db->or_like('created_at', $searchvalue);
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
	
	public function action($data)
	{
		$idarray				= 	[];
		$datetime				= 	date('Y-m-d H:i:s');		
		$request['created_at'] = $datetime;
		if(isset($data['description'])) $request['description'] = $data['description'];
		if(isset($data['file1'])) $request['file'] 			= $data['file1'];
		if(isset($data['plumberid'])) $request['user_id'] = $data['plumberid'];
		
		if(isset($request)){	
			$documentsid	= 	$data['documentsid'];			
			if($documentsid==''){					
				$documents_result = $this->db->insert('documentsletters', $request);
				$documentsid = $this->db->insert_id();
			}
			else{
				$documents_result = $this->db->update('documentsletters', $request, ['id' => $documentsid]);
			}					
		}
				
		return $documentsid;

	}

	public function deleteid($id)
	{ 
		// $url = FCPATH."assets/uploads/plumber/".$id.".pdf";
		// unlink($url);
			
		$this->db->where('id', $id);		
		$result = $this->db->delete('documentsletters');	

		return $result;

	}

	/// For Company 
	public function getcompanyList($type, $requestdata=[])
	{ 
		//print_r($requestdata);die;
		

		$this->db->select('*');

		$this->db->from('company_documentsletters');
		
		if(isset($requestdata['companyid']))
			$this->db->where('user_id', $requestdata['companyid']);

		if(isset($requestdata['id']))
			$this->db->where('id', $requestdata['id']);

		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id','description','created_at' ];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('description', $searchvalue);
			$this->db->or_like('created_at', $searchvalue);
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


	public function action2($data)
	{
		$idarray				= 	[];
		$datetime				= 	date('Y-m-d H:i:s');
		
		if(isset($data['description'])) $request['description'] = $data['description'];
		if(isset($data['file1'])) $request['file'] 			= $data['file1'];
		if(isset($data['companyid'])) $request['user_id'] = $data['companyid'];
		
		if(isset($request)){	
			$documentsid	= 	$data['documentsid'];			
			if($documentsid==''){	
				$request['created_at'] = $datetime;				
				$documents_result = $this->db->insert('company_documentsletters', $request);
				$documentsid = $this->db->insert_id();
				return 1;
			}
			else{
				$request['updated_at'] = $datetime;
				$documents_result = $this->db->update('company_documentsletters', $request, ['id' => $documentsid]);
				return 2;
			}					
		}
				
		return $documentsid;

	}

	public function deleteid_comp($id)
	{ 
		// $url = FCPATH."assets/uploads/plumber/".$id.".pdf";
		// unlink($url);
			
		$this->db->where('id', $id);		
		$result = $this->db->delete('company_documentsletters');	

		return $result;

	}
	
}