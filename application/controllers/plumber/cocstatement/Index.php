<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Noncompliance_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('plumber/cocstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTCocStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['2','4','5']]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['user_id' => $userid, 'coc_status' => ['2','4','5']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			$action = '';
			foreach($results as $result){
				if($result['coc_status']=='5' || $result['coc_status']=='4'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
					$allocation_log_date = date('d-m-Y', strtotime($result['allocation_date']));
				}elseif($result['coc_status']=='2'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
					$allDate = date('d-m-Y', strtotime($result['allocation_date']));
					$logDate = date('d-m-Y', strtotime($result['cl_log_date']));
					$allocation_log_date = $logDate.'/'.$allDate;
				}
				
				$cocstatus = isset($this->config->item('cocstatus')[$result['coc_status']]) ? $this->config->item('cocstatus')[$result['coc_status']] : '';
				$coctype = isset($this->config->item('coctype')[$result['type']]) ? $this->config->item('coctype')[$result['type']] : '';
				
				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'cocstatus' 		=> 	$cocstatus,
										'purchased' 		=> 	$allocation_log_date,
										'coctype' 			=> 	$coctype,
										'customer' 			=> 	$result['cl_name'],
										'address' 			=> 	$result['cl_address'],
										'company' 			=> 	$result['plumbercompany'],
										'reseller' 			=> 	$result['resellername'],
										'action'			=> 	'
																	<div class="table-action">
																		'.$action.'
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
	
	public function view($id)
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleplumber'), 'electroniccocreport' => 'plumber/cocstatement/index/electroniccocreport/'.$id, 'noncompliancereport' => 'plumber/cocstatement/index/noncompliancereport/'.$id], 
			['redirect' => 'plumber/cocstatement/index', 'userid' => $this->getUserID()]
		);
	}
	
	public function action($id)
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'action', 'roletype' => $this->config->item('roleplumber'), 'electroniccocreport' => 'plumber/cocstatement/index/electroniccocreport/'.$id, 'noncompliancereport' => 'plumber/cocstatement/index/noncompliancereport/'.$id], 
			['redirect' => 'plumber/cocstatement/index', 'userid' => $this->getUserID()]
		);
	}
	
	public function electroniccocreport($id)
	{	
		$userid = $this->getUserID();
		$this->pdfelectroniccocreport($id, $userid);
	}
	
	public function noncompliancereport($id)
	{	
		$userid = $this->getUserID();
		$this->pdfnoncompliancereport($id, $userid);
	}
}
