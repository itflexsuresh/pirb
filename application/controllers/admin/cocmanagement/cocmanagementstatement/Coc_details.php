<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coc_details extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Details_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		$pagedata['coctype'] 		= $this->config->item('coctype');	
		$pagedata['cocstatus'] 		= $this->config->item('cocstatus');	
		$pagedata['auditstatus'] 	= $this->config->item('auditstatus');	
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/cocmanagement/cocmanagementstatement/coc_details/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTCocDetails()
	{
		$post 			= $this->input->post();
		
		$totalcount 	= $this->Coc_Details_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Coc_Details_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'cocno' 		=> 	$result['id'],
										'coctype' 		=> 	$this->config->item('coctype')[$result['type']],
										'status' 		=> 	'-',
										'plumber' 		=> 	($result['usertype']=='3') ? $result['name'] : '-',
										'reseller' 		=> 	($result['usertype']=='6') ? $result['name'] : '-',
										'auditor' 		=> 	($result['usertype']=='5') ? $result['name'] : '-',
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/cocmanagement/cocmanagementstatement/coc_details/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
	
	
	public function action()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['validation'];
		$data['content'] 			= $this->load->view('admin/cocmanagement/cocmanagementstatement/coc_details/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	

}
