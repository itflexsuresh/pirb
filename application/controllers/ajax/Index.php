<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crawl_Model');
	}
	
	public function getCrawlData()
	{
		$post 			= $this->input->post();
		$result 		= $this->Crawl_Model->getCrawl('row', ['id' => $post['id']]);
		echo json_encode($result);
	}
}
