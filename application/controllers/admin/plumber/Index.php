<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1', '2']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1', '2']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$designation 	= isset($this->config->item('designation2')[$result["designation"]]) ? $this->config->item('designation2')[$result["designation"]] : '';
				$status 		= isset($this->config->item('plumberstatus')[$result["plumberstatus"]]) ? $this->config->item('plumberstatus')[$result["plumberstatus"]] : '';

				$totalrecord[] = 	[
										'reg_no' 		=> 	$result['registration_no'],
										'name' 			=> 	$result['name'],
										'surname' 		=> 	$result['surname'],
										'designation' 	=> 	$designation,
										'email' 		=> 	$result['email'],
										'status' 		=> 	$status,
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
	
	public function action($id)
	{
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'applications'], ['redirect' => 'admin/plumber/index']);
	}
	
	public function rejected()
	{
		$pagedata['notification'] 	= $this->getNotification();
		
		$data['plugins']			= ['datatables', 'datatablesresponsive'];
		$data['content'] 			= $this->load->view('admin/plumber/rejected', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTRejectedPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['2'], 'status' => ['1']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['2'], 'status' => ['1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$rejectreason 	= $this->config->item('rejectreason');
				
				$reasonforrejection = [];
				$exploderejectreasons 	= explode(',', $result['reject_reason']);
				foreach($exploderejectreasons as $exploderejectreason){
					$rejectreasondata = isset($rejectreason[$exploderejectreason]) ? $rejectreason[$exploderejectreason] : '';
					if($exploderejectreason==4){
						$reasonforrejection[] = $rejectreasondata.' - '.$result['reject_reason_other'];
					}else{
						$reasonforrejection[] = $rejectreasondata;
					}
				}
				
				$totalrecord[] = 	[
										'applicationreceived' 	=> 	date('d-m-Y', strtotime($result['application_received'])),
										'name' 					=> 	$result['name'].' '.$result['surname'],
										'reason' 				=> 	implode(', ', $reasonforrejection),
										'action'				=> 	'
																		<div class="table-action">
																			<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
	
	public function rejectedaction($id)
	{
		$this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'rejectedapplications'], ['redirect' => 'admin/plumber/index/rejected']);
	}
	
}

