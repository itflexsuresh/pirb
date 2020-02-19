<?php

class Designation_Model extends CC_Model
{
	
	

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
	public function getList($type, $requestdata=[])
	{

	$this->db->select('s1.*,d1.name deg_name');
        $this->db->from('specialisation as s1');
        $query = $this->db->join('designation as d1', 's1.design_id = d1.id', 'left');

       if(isset($requestdata['id'])) $this->db->where('s1.id', $requestdata['id']);
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['s1.id', 's1.name', 's1.points'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
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
	
	public function edit_check($post)
	{

	   $id = $post['id'];
       if($id!='')
    {

	   $this->db->select('*');
       $this->db->from('specialisation as s1');
       $query=$this->db->where('s1.id',$id);
       $query = $this->db->get();
       $edit = $query->row_array();
    }
      echo json_encode($edit);
	}
	
	public function getPermissions()
	{ 
		$this->db->select('specialisation.*,designation.name as deg_name');
		$this->db->from('specialisation');
		$this->db->join('designation', 'specialisation.design_id = designation.id');
		
		$query = $this->db->get();

		return $query->result();
	}
}



