<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		$data['plugins'] = [];
		$data['content'] = $this->load->view('admin/dashboard/index', '', true);
		$this->layout2($data);
	}
}
