<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coc_details extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Installationtype_Model');
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
	
	public function DTInstallationType()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Installationtype_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Installationtype_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'name' 		=> 	$result['name'],
										'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'	=> 	'
															<div class="table-action">
																<a href="'.base_url().'admin/administration/installationtype/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
	
	
	public function action()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('admin/cocmanagement/cocmanagementstatement/coc_details', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	

}
