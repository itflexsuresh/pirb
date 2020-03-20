<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Import extends CC_Controller {
  
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Managearea_Model');
	}

    public function province()
	{
		$data = $this->db->get('importprovince')->result_array();

		foreach ($data as $value) {
			
			$result  	= 	[
								'name' => $value['Name']
							];
							
			$this->Managearea_Model->insertprovince($result);			
		}
    }
}

	
  
