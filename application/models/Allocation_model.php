<?php

Class allocation_model extends CI_Model {
function __construct() {
parent::__construct();

}


public function form_insert($data)
{

$this->db->insert('cocstatements', $data);

$insert_id = $this->db->insert_id();
return $insert_id;

}



				

}
?>



 
