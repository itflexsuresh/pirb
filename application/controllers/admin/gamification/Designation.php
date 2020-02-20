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
       

		$permission_list = $this->Designation_Model->getPermissions(); 
        $fotmatted_list = array();
        for($k=0;$k<count($permission_list);$k++) 
        {
	        $fotmatted_list[$permission_list[$k]->deg_name][$k]['id'] = $permission_list[$k]->id;
	        
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['name'] = $permission_list[$k]->name;
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['points'] = $permission_list[$k]->points;
        }
		$pagedata['permission_list'] = $fotmatted_list;	
		$pagedata['notification'] 			= $this->getNotification();
		// $pagedata['result']	 				= $this->Designation_Model->getList('all');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
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

if($data) $this->session->set_flashdata('success', 'Gamification Specialisation Points '.(($id=='') ? 'updated' : 'updated').' successfully.');
else $this->session->set_flashdata('error', 'Try Later.');


}

}

}
public function edit_check()
{
$post = $this->input->post();
$data 			=  $this->Designation_Model->edit_check($post);

}
	
}




