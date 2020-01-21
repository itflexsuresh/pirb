<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajax extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function get_data()
	{
		extract($_REQUEST);
		$res = '';
		switch ($action) {
	    	case 'get_city':
    			$res = $this->ajaxModel->get_city();
	    // 		$city_arg = array('field'=>'city','sel_val'=>$id,'method'=>'json',);
 				// $res = $this->commonModel->set_selectbox_data($city_arg);
	    		break;
    		case 'get_area':
	    		$res = $this->ajaxModel->get_area();	
	    		break;
	    }
	    echo $res;
	}

	public function exists()
	{
		extract($_REQUEST);
		// echo $table.'<br>';
		// echo $field;

		// $field_name = $table.'.'.$field;
		$res = 0;
		if(!$this->form_validation->is_unique($value, "$table.$field")) {
        // set the json object as output                  
         //	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'This value already exists')));
			$res=1;
        } 
        echo $res;
    }

    public function exists_test()
	{
		extract($_REQUEST);
		// echo $table.'<br>';
		// echo $field;

		// $field_name = $table.'.'.$field;
		$res = 0;
		if(!$this->form_validation->edit_unique($value, "$table.$field.$id")) {
        // set the json object as output                  
         //	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'This value already exists')));
			$res=1;
        } 
        echo $res;
    }

    function exists_update() {
    	extract($_REQUEST);
    	//	$this->db->select("COUNT($pk)");
        $this->db->where($field, $value);
        if($pk_val) {
            $this->db->where_not_in($pk, $pk_val);
        }
        $res = $this->db->get($table)->num_rows();
        echo $res;
        return $res;
    }

}
