<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Message_Model');

		$this->checkUserPermission('11', '1');
	}
	
	public function index($id='')
	{
		if($id!=''){

			$this->checkUserPermission('11', '2', '1');

			$result = $this->Message_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			// print_r($result);die;
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/systemsetup/message/Message'); 
			}
		}
		
		if($this->input->post()){

			$this->checkUserPermission('11', '2', '1');

			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Message_Model->action($requestData);
				if($data) $message = 'Message '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Message_Model->changestatus($requestData);
				$message		= 	'Message deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/message/Message'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['checkpermission'] 		= $this->checkUserPermission('11', '2');
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 					= $this->load->view('admin/systemsetup/message/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTMessage()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Message_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Message_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('11', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if ($checkpermission) {
					$action = '<div class="table-action">
								<a href="'.base_url().'admin/systemsetup/message/message/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
							</div>';
				}else{
					$action = '';
				}

				$totalrecord[] = 	[
										'groups' 		=> 	$this->config->item('messagegroup')[$result['groups']],
										'start_date' 	=>  date('d-m-Y',strtotime($result['startdate'])),
										'end_date' 		=>  date('d-m-Y',strtotime($result['enddate'])),
										'message' 		=>  $result['message'],
										'status' 		=> 	$this->config->item('status')[$result['status']],
										'action'		=> 	$action
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
}
