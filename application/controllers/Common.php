<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class common extends CI_Controller {

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
	    		break;
    		case 'get_area':
	    		$res = $this->ajaxModel->get_area();	
	    		break;
	    }
	    echo $res;
	}
}
