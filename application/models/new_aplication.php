<?php
class plumber extends CI_Model{

	function __construct() {
		parent::__construct();
	}

	function insert_new_application($data){
	// Inserting in Table(students) of Database(college)
		$this->db->insert('company_application', $data);
	}

}
?>