<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Noncompliancelisting_Model');
		
		$this->checkUserPermission('30', '1');
	}
	
	public function index($id='')
	{ 
		if($id!=''){		
			$this->checkUserPermission('30', '2', '1');
			
			$result = $this->Noncompliancelisting_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/noncompliancelisting/index'); 
			}
		}
		
		if($this->input->post()){
			$this->checkUserPermission('30', '2', '1');
			
			$requestData 	= 	$this->input->post();
			$id				=	$requestData['id'];		
			
			if(isset($requestData['submit']) && $requestData['submit']=='submit'){
				$data 	=  $this->Noncompliancelisting_Model->action($requestData);
				if($data) $message = 'Non Compliance Statement '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Noncompliancelisting_Model->changestatus($requestData);
				$message		= 	'Non Compliance Statement deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/noncompliancelisting/index'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['installationtypelist'] 	= $this->getInstallationTypeList(); 
		$pagedata['checkpermission'] 		= $this->checkUserPermission('30', '2');

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/administration/noncompliancelisting/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTComplianceListing()
	{
		$post 			= $this->input->post();		
		$totalcount 	= $this->Noncompliancelisting_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Noncompliancelisting_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('30', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				
				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/administration/noncompliancelisting/index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}
				
				$totalrecord[] = 	[
										'id' 			  	=> $result['id'],
										'installationname' 	=> $result['installationname'],
										'subtypename' 	  	=> $result['subtypename'],
										'details'	  		=> $result['details'],
										'status' 		  	=> $this->config->item('statusicon')[$result['status']],
										'action'			=> $action
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
