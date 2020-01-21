<?php

Class plumbercoc_model extends CI_Model {
function __construct() {
parent::__construct();

}


public function form_insert($data)
{

$this->db->insert('orders', $data);

$insert_id = $this->db->insert_id();
return $insert_id;

}

public function insert_form($data)
{

$this->db->insert('smslog', $data);

				

}
}
?>



 
