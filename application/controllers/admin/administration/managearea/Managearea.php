<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managearea extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Managearea_Model');
	}
	
	public function index($id='')
	{
		if($id!=''){
			$result = $this->Managearea_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/managearea/managearea'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Managearea_Model->action($requestData);
				if($data) $message = 'Managearea Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Managearea_Model->changestatus($requestData);
				$message		= 	'Managearea Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/managearea/managearea'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/administration/managearea/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTManagearea()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Managearea_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Managearea_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'name' 		=> 	$result['name'],
										'city' 		=> 	$result['city_name'],
										'province'  =>  $result['province_name'],
										'action'	=> 	'
															<div class="table-action">
																<a href="'.base_url().'admin/administration/managearea/managearea/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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

