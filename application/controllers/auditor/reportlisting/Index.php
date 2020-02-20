<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Reportlisting_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Subtype_Model');
	}
	
	public function index($id='')
	{ 
	
		if($id!=''){
			
			$result = $this->Auditor_Reportlisting_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('auditor/reportlisting/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			$id				=	$requestData['id'];			
			if($requestData['submit']=='submit'){
				
				$data 	=  $this->Auditor_Reportlisting_Model->action($requestData);
				
				if($data) $message = 'Report Listings '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Auditor_Reportlisting_Model->changestatus($requestData);
				$message		= 	'Report Listings deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('auditor/reportlisting/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['installationtypelist'] 	= $this->getInstallationTypeList(); 

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('auditor/reportlisting/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTReportListing()
	{
		$post 			= $this->input->post();		
		$totalcount 	= $this->Auditor_Reportlisting_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Auditor_Reportlisting_Model->getList('all', ['status' => ['0','1']]+$post);

		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'favour_name' 	  => $result['favour_name'],
										'installation_id' => $result['insname'],
										'subtype_id' 	  => $result['name'],
										'comments'	  	  => $result['comments'],									
										'status' 		  => $this->config->item('statusicon')[$result['status']],
										'action'	=> 	'
															<div class="table-action">
																<a href="'.base_url().'auditor/reportlisting/Index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
