<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Designation_Model');
	}
	
	public function index($id='')
	{
		
		if($this->input->post()){
			
                $requestData 	= 	$this->input->post();

            	$data 	=  $this->Designation_Model->action($requestData);
			if($data) $this->session->set_flashdata('success', 'Designation Specialisation Points
 '.(($id=='') ? 'updated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/gamification/designation'); 
		}
		$post 			= $this->input->post();
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$pagedata['results'] 				= $this->Designation_Model->getPointList('all');
	//	$pagedata['result'] 		= $this->Designation_Model->getWarningList('all', ['status' => ['0','1']]+$post);
		
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];

		$data['content'] 					= $this->load->view('admin/gamification/designation', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	public function editpoint($id = ''){

if($this->input->post())
{

$post = $this->input->post();
if(isset($post['id']) && $post['id']!='')
{

$data =  $this->Designation_Model->action($post);

if($data) $this->session->set_flashdata('success', 'Designation Specialisation Points
 '.(($id=='') ? 'updated' : 'updated').' successfully.');
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
$query = $this->db->query("SELECT * FROM specialisation where id = $id");    
$edit = $query->row_array();

}
echo json_encode($edit);

// $post = $this->input->post();
// $data 			=  $this->Designation_Model->edit_check($post);

}
}
