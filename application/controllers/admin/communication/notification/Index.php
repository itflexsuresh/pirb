<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Communication_Model');

		$this->checkUserPermission('5', '1');
	}
	
	public function index()
	{ 

		$userid = $this->getUserID();
		$result = $this->Communication_Model->getPermissions('all', ['id' => $userid]);
		
		$email_list = array();

        for($k=0; $k<count($result); $k++) 
        {
	        $email_list[$result[$k]->category_id]['cat_name'] 				   = $result[$k]->cat_name;
	        $email_list[$result[$k]->category_id]['data'][$k]['name'] 		   = $result[$k]->name;
	        $email_list[$result[$k]->category_id]['data'][$k]['id'] 		   = $result[$k]->id;
	        $email_list[$result[$k]->category_id]['data'][$k]['sms'] 		   = $result[$k]->sms_active;
	        $email_list[$result[$k]->category_id]['data'][$k]['email'] 		   = $result[$k]->email_active;
	      //  $email_list[$result[$k]->cat_name][$k]['email_active'] = $result[$k]->email_active;
         //	$email_list[$result[$k]->cat_name][$k]['sms_active']   = $result[$k]->sms_active;
        }
      //  echo '<pre>';
       // print_r($email_list); exit;


		if($result){
			$pagedata['result'] = $result;
		}else{
			$this->session->set_flashdata('error', 'No Record Found.');
			//redirect('admin/communication/notification/index'); 
		}
		
		// if($this->input->post())
		// {
		// 	$requestData 	= 	$this->input->post();		
		// 	$id				=	$requestData['id'];		
		// 	$data 			=  	$this->Communication_Model->action($requestData);			

		// 	if(isset($data)) $this->session->set_flashdata('success', 'Records '.(($id=='') ? 'created' : 'updated').' successfully.');
		// 	else $this->session->set_flashdata('error', 'Try Later.');
			
		// 	redirect('admin/communication/notification/index'); 
		// }

		$pagedata['result'] 		= $email_list;	
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['provincelist'] 	= $this->getProvinceList();	
		$pagedata['userid']			= $userid;
		$pagedata['checkpermission'] = $this->checkUserPermission('5', '2');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('admin/communication/notification/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);

		
	}

	public function edit($id ='')
	{
		$this->checkUserPermission('5', '2', '1');

		$notify_id = $this->uri->segment(6, 0);
		$query2 = $this->db->query("SELECT * FROM email_notification where id = $id");	    
	    $edit = $query2->row_array();


	    $userid = $this->getUserID();
		
	    if($this->input->post())
		{
			$requestData 		= 	$this->input->post();		
			$requestData['id']	=	$id;		
			$data 				=  	$this->Communication_Model->action($requestData);


			if(isset($data)) $this->session->set_flashdata('success', 'Records '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/communication/notification/index'); 
		}


		$pagedata['result'] 		= $edit;
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker','tinymce'];
		$data['content'] 			= $this->load->view('admin/communication/notification/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);

	}
	

	
}
