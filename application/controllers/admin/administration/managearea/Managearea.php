<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managearea extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Managearea_Model');

		$this->checkUserPermission('4', '1');
	}
	
	public function index($id='', $citydata='')
	{
		if($id!=''){
			$this->checkUserPermission('4', '2', '1');
			
			if($citydata!=''){
				$result = $this->Managearea_Model->getListCity('row', ['id' => $id, 'status' => ['0','1']]);
			}else{
				$result = $this->Managearea_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			}
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/managearea/managearea'); 
			}
		}
				
		if($this->input->post()){
			$this->checkUserPermission('4', '2', '1');

			$requestData 				= 	$this->input->post();
			$requestData['citydata']	=	$citydata;

			if($requestData['submit']=='submit'){
				if($requestData['city1']!=''){
					$data=$this->Managearea_Model->checkUsername($requestData);
					if($data)
					{ 
						$this->session->set_flashdata('error', 'City is already exists.');
						redirect('admin/administration/managearea/managearea'); 
					}  
				}else{
					$data=$this->Managearea_Model->checkUsername1($requestData);	
					if($data)
					{ 
						$this->session->set_flashdata('error', 'Suburb is already exists.');
						redirect('admin/administration/managearea/managearea'); 
					} 
				}
				
				$data 		=  $this->Managearea_Model->action($requestData);
				$message 	= ($requestData['city1']!='' ? 'City' : 'Suburb').' '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Managearea_Model->changestatus($requestData);
				$message		= 	'Record deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/managearea/managearea'); 
		}
		
		$pagedata['iddata'] 				= $id;
		$pagedata['citydata'] 				= $citydata;
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['checkpermission'] 		= $this->checkUserPermission('4', '2');
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

		$checkpermission	=	$this->checkUserPermission('4', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/administration/managearea/managearea/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}
				
				$totalrecord[] = 	[
										'name' 		=> 	$result['name'],
										'city_id' 		=> 	$result['city_name'],
										'province_id'  =>  $result['province_name'],
										'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'	=> 	$action
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
	
	public function DTCity()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Managearea_Model->getListCity('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Managearea_Model->getListCity('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('4', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/administration/managearea/managearea/index/'.$result['id'].'/city" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" data-city="1" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}
				
				$totalrecord[] = 	[
										'name' 			=> 	$result['name'],
										'provincename'  =>  $result['provincename'],
										'status' 		=> 	$this->config->item('statusicon')[$result['status']],
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
