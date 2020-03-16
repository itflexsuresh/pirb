<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualificationroute extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Qualificationroute_Model');

		$this->checkUserPermission('10', '1');
	}
	
	public function index($id='')
	{
		if($id!=''){

			$this->checkUserPermission('10', '2', '1');

			$result = $this->Qualificationroute_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/systemsetup/qualificationroutes/Qualificationroute'); 
			}
		}
		
		if($this->input->post()){

			$this->checkUserPermission('10', '2', '1');

			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Qualificationroute_Model->action($requestData);
				if($data) $message = 'Qualification Route '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Qualificationroute_Model->changestatus($requestData);
				$message		= 	'Qualification Route deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/systemsetup/qualificationroutes/Qualificationroute'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['checkpermission'] = $this->checkUserPermission('10', '2');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/systemsetup/qualificationroutes/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTQualificationroute()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Qualificationroute_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Qualificationroute_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('10', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if ($checkpermission) {
					$action = '<div class="table-action">
									<a href="'.base_url().'admin/systemsetup/qualificationroutes/qualificationroute/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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

	public function QualificationRouteValidation()
	{
		$requestData 		= $this->input->post();
		//$requestData['id'] 	= '';
		$data 				= $this->Qualificationroute_Model->QualificationRouteValidator($requestData);
		
		echo $data;
	}

}
