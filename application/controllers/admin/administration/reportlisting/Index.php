<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reportlisting_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Subtype_Model');
		
		$this->checkUserPermission('1', '1');
	}
	
	public function index($id='')
	{ 
		if($id!=''){		
			$this->checkUserPermission('1', '2', '1');
			
			$result = $this->Reportlisting_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/reportlisting/index'); 
			}
		}
		
		if($this->input->post()){
			$this->checkUserPermission('1', '2', '1');
			
			$requestData 	= 	$this->input->post();
			$id				=	$requestData['id'];			
			if(isset($requestData['submit']) && $requestData['submit']=='submit'){
				
				$data 	=  $this->Reportlisting_Model->action($requestData);
				
				if($data) $message = 'Report Statement '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Reportlisting_Model->changestatus($requestData);
				$message		= 	'Report Statement deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/reportlisting/index'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['installationtypelist'] 	= $this->getInstallationTypeList(); 
		$pagedata['checkpermission'] 		= $this->checkUserPermission('1', '2');

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/administration/reportlisting/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTReportListing()
	{
		$post 			= $this->input->post();		
		$totalcount 	= $this->Reportlisting_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Reportlisting_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('1', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				
				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/administration/reportlisting/Index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}
				
				$totalrecord[] = 	[
										'id' 			  	=> $result['id'],
										'installation_id' 	=> $result['insname'],
										'subtype_id' 	  	=> $result['name'],
										'compliment'	  	=> $result['compliment'],
										'cautionary' 	  	=> $result['cautionary'],
										'refix_complete'  	=> $result['refix_complete'],
										'refix_incomplete'	=> $result['refix_incomplete'],
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
