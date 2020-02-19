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
       if($id!=''){
			$result = $this->Systemusers_Model->getList('row', ['id' => $id, 'u_status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/systemsetup/systemusers/systemusers');
			}
		}



		// if($this->input->post()){
		// 	$requestData 	= 	$this->input->post();
		// 	$data 			=  $this->Designation_Model->action($requestData);
          
		// 	if($data) $this->session->set_flashdata('success', 'System Settings '.(($id=='') ? 'updated' : 'updated').' successfully.');
		// 	else $this->session->set_flashdata('error', 'Try Later.');
			
		// 	redirect('admin/gamification/Designation'); 
		// }
		$permission_list = $this->Designation_Model->getPermissions(); 
        $fotmatted_list = array();
        for($k=0;$k<count($permission_list);$k++) 
        {
	        $fotmatted_list[$permission_list[$k]->deg_name][$k]['id'] = $permission_list[$k]->id;
	        $fotmatted_list[$permission_list[$k]->deg_name][$k]['design_id'] = $permission_list[$k]->design_id;
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['name'] = $permission_list[$k]->name;
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['points'] = $permission_list[$k]->points;
        }
		$pagedata['permission_list'] = $fotmatted_list;	
		$pagedata['notification'] 			= $this->getNotification();
		// $pagedata['result']	 				= $this->Designation_Model->getList('all');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/gamification/Designation', (isset($pagedata) ? $pagedata : ''), true);

		$this->layout2($data);


		

       
	}

public function edit_check()
{
$post = $this->input->post();
$data 			=  $this->Designation_Model->edit_check($post);

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
redirect('admin/gamification/designation'); 

}

}

}
	
}




