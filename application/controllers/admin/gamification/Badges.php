<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Badges extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Gamebadges_Model');		
	}
	
	public function index($id='')
	{ 	

		$id			= 	$this->getUserID();

		if($id!='')
		{	
			$result = $this->Gamebadges_Model->getList('all');	
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/gamification/badges'); 
			}
		}

		
		
		
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['installationtypelist'] 	= $this->getInstallationTypeList(); 

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/gamification/badges', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	
	

public function editpoint($id = ''){

	if($this->input->post())
	{	

		$post = $this->input->post();

		if(isset($post['id']) && $post['id']!='')
		{

			$data 	=  $this->Gamebadges_Model->action($post);

			if($data) $this->session->set_flashdata('success', 'Badges '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');

		}
		 
	}

}

public function edit_check()
	{
		$post = $this->input->post();

		$id = $post['id'];

		$edit = array();

		if($id!='')
		{
			$query = $this->db->query("SELECT * FROM badges where id = $id");	    
			$edit = $query->row_array();
		}
		echo json_encode($edit);
}

}

