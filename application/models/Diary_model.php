<?php
Class diary_model extends CI_Model{
function __construct() {
parent::__construct();
}


public function form_insert($data)
{
$this->db->insert('companycomments', $data);

}
			public function get_name()
				{	
				    $this->db->select('fname, lname');
				    $this->db->where('role', '1');
				    $query5 = $this->db->get('users');				    	    
				    $result1 = $query5->result();				    
				    return $result1;
				}

				public function get_audit()
				{
				    $this->db->select('fname, lname, CreateDate, Comments');
				    $this->db->where('role', '3');				    
				    $query2 = $this->db->get('users');				    	    
				    $result2 = $query2->result();		

				    return $result2;
				}

				public function get_comp()
				{
				    $this->db->select('fname, lname, CreateDate, Comments');
				    $this->db->where('role', '5');				    
				    $query6 = $this->db->get('users');				    	    
				    $result3 = $query6->result();		

				    return $result3;
				}



}
?>