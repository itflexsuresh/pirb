<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpdtypesetup extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cpdtypesetup_Model');
	}
	
	public function index($id='')
	{
		if($id!=''){
			$result = $this->Cpdtypesetup_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/cpd/Cpdtypesetup'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Cpdtypesetup_Model->action($requestData);
				if($data) $message = 'CPD Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Cpdtypesetup_Model->changestatus($requestData);
				$message		= 	'CPD Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/cpd/Cpdtypesetup'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['cpdstreamID'] 	= $this->config->item('cpdstream');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/cpd/cpdtypesetup/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTCpdType()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Cpdtypesetup_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Cpdtypesetup_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'productcode' 		=> 	$result['productcode'],
										'activity' 			=> 	$result['activity'],
										'startdate' 		=> 	date('m-d-Y',strtotime($result['startdate'])),
										'enddate' 			=> 	date('m-d-Y',strtotime($result['enddate'])),
										'cpdstream' 		=> 	$this->config->item('cpdstream')[$result['cpdstream']],
										'points' 			=> 	$result['points'],
										//'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'			=> 	'
															<div class="table-action">
																<a href="'.base_url().'admin/cpd/cpdtypesetup/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
