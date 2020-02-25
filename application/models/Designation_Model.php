<?php

class Designation_Model extends CC_Model
{

	public function getPointList($type, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('specialisation');
		
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

	public function action($data)
	{
		$this->db->trans_begin();
		
		$userid			= 	$this->getUserID();
		$id = $data['id'];
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request = [
                      'updated_at' => $datetime,
                       
                   ];
       
	    if(isset($data['points']))   $request['points'] = $data['points'];
		
        if($id!=''){
          $this->db->update('specialisation', $request, ['id' => $id]);
          
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
	

	
}



