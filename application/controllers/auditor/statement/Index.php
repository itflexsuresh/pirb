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
	
}
