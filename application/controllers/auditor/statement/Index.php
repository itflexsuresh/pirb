<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
	}
	
	public function index($id='')
	{

		if($id!=''){
			$result = $this->Auditor_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('auditor/statement/index'); 
			}
		}
		
		if($this->input->post()){

			$requestData 	= 	$this->input->post();



			if($requestData['submit']=='submit'){
				$data 	=  $this->Auditor_Model->action($requestData);
				
				if($data) $message = 'Records '.(($id=='') ? 'created' : 'updated').' successfully.';
			}
			// else
			// {
			// 	$data 			= 	$thsis->Auditor_Model->changestatus($requestData);
			// 	$message		= 	'Installation Type deleted successfully.';
			// }

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('auditor/statement/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();		
		$pagedata['userid']			= 	$this->getUserID();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/statement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);


	
	}


	public function audithistory(){



		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/statement/audithistory/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);


	}


	public function auditreport(){


		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/statement/auditreport/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);


	}
	
	public function diary(){


		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/statement/diary/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);


	}
	
	// public function DTAudithistory()
	// {
	// 	$post 			= $this->input->post();
	// 	$totalcount 	= $this->Plumber_Model->getList('count', ['status' => ['0','1']]+$post);
	// 	$results 		= $this->Plumber_Model->getList('all', ['status' => ['0','1']]+$post);
		
	// 	$totalrecord 	= [];
	// 	if(count($results) > 0){
	// 		foreach($results as $result){
	// 			$totalrecord[] = 	[
	// 									'name' 		=> 	$result['name'],
	// 									'name' 		=> 	$result['name'],
	// 									'status' 	=> 	$this->config->item('statusicon')[$result['status']],
	// 									// 'action'	=> 	'
	// 									// 					<div class="table-action">
	// 									// 						<a href="'.base_url().'plumber/registration/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
	// 									// 						<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
	// 									// 					</div>'
	// 								];
	// 		}
	// 	}
		
	// 	$json = array(
	// 		"draw"            => intval($post['draw']),   
	// 		"recordsTotal"    => intval($totalcount),  
	// 		"recordsFiltered" => intval($totalcount),
	// 		"data"            => $totalrecord
	// 	);

	// 	echo json_encode($json);
	// }
}
