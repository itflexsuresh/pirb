<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systemusers extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Systemusers_Model');
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
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			if($requestData['submit']=='submit'){
				$data 	=  $this->Systemusers_Model->action($requestData);
				if($data) 
				$message = 'System User '.(($id=='') ? 'created' : 'updated').' successfully.';

			}else{
				$data 			= 	$this->Systemusers_Model->changestatus($requestData);
				$message = 'System User deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/systemusers/systemusers');
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/systemsetup/systemusers/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTSystemusersList()
	{
		$post 			= $this->input->post();
		$totalcount = $this->Systemusers_Model->getList('count', ['u_type' => ['0','1','2','7','8','9']]+$post);
        $results = $this->Systemusers_Model->getList('all', ['u_type' => ['0','1','2','7','8','9']]+$post);
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'u_name' => $result['name'],
                                        'u_surname' => $result['surname'],
                                        'u_email' => $result['email'],
                                        'u_password_raw' => $result['password_raw'],
                                        'u_type' => $this->config->item('roletype')[$result['type']],
										'action'				=> 	'
															<div class="table-action">
																<a href="'.base_url().'admin/systemsetup/systemusers/systemusers/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>	
															</div>
														'
									];
			}
		}
		
		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}
	
	public function action($id='')
	{
		if($id!=''){
			$result = $this->Systemusers_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/systemsetup/systemusers/systemusers/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			if($requestData['submit']=='submit'){
				$data 	=  $this->Systemusers_Model->action($requestData);
				if($data) $message = 'System User '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Systemusers_Model->changestatus($requestData);
				$message = 'System Users deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/systemusers/systemusers'); 
		}

		$permission_list = $this->Systemusers_Model->getPermissions(); 
        $fotmatted_list = array();
        for($k=0;$k<count($permission_list);$k++) 
        {
	        $fotmatted_list[$permission_list[$k]->cat_name][$k]['id'] = $permission_list[$k]->id;
	        $fotmatted_list[$permission_list[$k]->cat_name][$k]['category_id'] = $permission_list[$k]->category_id;
         	$fotmatted_list[$permission_list[$k]->cat_name][$k]['name'] = $permission_list[$k]->name;
        }

        $pagedata['permission_list'] = $fotmatted_list;		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['roletype'] = $this->config->item('roletype');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/systemsetup/systemusers/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function DTemailValidation()
    {
        $requestData = $this->input->post();
        $data = $this->Systemusers_Model->emailValidator($requestData);
        echo $data;
    }
  }
