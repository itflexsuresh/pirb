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



