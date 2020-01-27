<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CC_Controller 
{
	public function index()
	{
		///$this->curlRequest($this->config->item('wcdetect'), 'GET', ['key' => $this->config->item('wckey'), 'url' => 'en.wikipedia.org']);
		//die;
		$data['content'] = $this->load->view('admin/dashboard/index', '', true);
		$this->layout2($data);
	}
}