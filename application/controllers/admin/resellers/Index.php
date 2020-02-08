<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resellers_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/resellers/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}	
	
	public function DTResellers()
	{
		
		$post 			= $this->input->post();		
		$totalcount 	= $this->Resellers_Model->getList('count', ['type' => '6', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);
		$results 		= $this->Resellers_Model->getList('all', ['type' => '6', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);

		$status = 1;

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){				

				$totalrecord[] = 	[										
										'name' 			=> 	$result['name'],
										'email' 		=> 	$result['email'],										
										'contactnumber' 		=> 	$result['mobile_phone'],
										'stockcount' 		=> 	$result['coc_purchase_limit'],
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/resellers/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																</div>
															'
									];
			}
		}
		
		$json = array(
			// "draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}

	public function action($id='')
	{
			
		if($id!=''){
			$result = $this->Resellers_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;

			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/resellers/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Resellers_Model->action($requestData);
				if($data) $message = 'Resellers '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Resellers_Model->changestatus($requestData);
				$message		= 	'Resellers deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/resellers/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/resellers/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
}

