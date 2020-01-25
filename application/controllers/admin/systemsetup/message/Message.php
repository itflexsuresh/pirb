<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Message_Model');
	}
	
	public function index($id='')
	{
		if($id!=''){
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
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'groups' 		=> 	$this->config->item('messagegroup')[$result['groups']],
										'start_date' 	=>  date('m-d-Y',strtotime($result['startdate'])),
										'end_date' 		=>  date('m-d-Y',strtotime($result['enddate'])),
										'message' 		=>  $result['message'],
										'status' 		=> 	$this->config->item('status')[$result['status']],
										'action'		=> 	'
															<div class="table-action">
																<a href="'.base_url().'admin/systemsetup/message/message/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
}
