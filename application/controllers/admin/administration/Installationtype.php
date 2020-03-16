<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Installationtype extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Installationtype_Model');

		$this->checkUserPermission('2', '1');
	}
	
	public function index($id='')
	{
		if($id!=''){
			$this->checkUserPermission('2', '2', '1');

			$result = $this->Installationtype_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/administration/installationtype'); 
			}
		}
		
		if($this->input->post()){
			$this->checkUserPermission('2', '2', '1');

			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Installationtype_Model->action($requestData);
				if($data) $message = 'Installation Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Installationtype_Model->changestatus($requestData);
				$message		= 	'Installation Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/administration/installationtype'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['checkpermission'] = $this->checkUserPermission('2', '2');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/administration/installationtype/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTInstallationType()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Installationtype_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Installationtype_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('2', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/administration/installationtype/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}

				$totalrecord[] = 	[
										'name' 		=> 	$result['name'],
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

		public function InstallationTypeValidation()
	{
		$requestData 		= $this->input->post();		
		$data 				= $this->Installationtype_Model->installationtypeValidator($requestData);
		
		echo $data;
	}
}
