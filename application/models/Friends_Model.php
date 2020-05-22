<?php

class Friends_Model extends CC_Model
{
	public function search($postData){
		
		$this->db->select('u.id, concat(ud.name, " ", ud.surname) as name,ud.file2');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3', 'u.id !=' => $postData['id']]);

		$this->db->group_start();
			$this->db->like('ud.name',$postData['search']);
			$this->db->or_like('ud.surname',$postData['search']);		
			$this->db->or_like('up.registration_no',$postData['search']);
		$this->db->group_end();

		$this->db->group_by("ud.id");		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

}
