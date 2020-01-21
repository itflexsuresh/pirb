<?php
class ajaxModel extends CI_Model{

	function __construct() {
		parent::__construct();
	}

	function get_city(){
		extract($_REQUEST);
		$this->db->select('ID AS id, Name AS val');
	    $this->db->from('area');
	    $this->db->order_by('Name','ASC');
	    $this->db->where('ProvinceID', $id);
	    $query = $this->db->get();
	    $res = $query->result_array();
	    echo json_encode($res);
	}

	function get_area(){
		extract($_REQUEST);
		$this->db->select('SuburbID AS id, Name AS val');
	    $this->db->from('areasuburbs');
	    //	$this->db->where('CityID', $id);
	    $this->db->where(array('CityID'=>$id,'isActive'=>1));
	    $this->db->order_by('Name','ASC');
	    $query = $this->db->get();
	    $res = $query->result_array();
	    echo json_encode($res);
	}

}
?>