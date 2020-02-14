<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
	}
	
	public function index($pagestatus='')
	{
		$pagedata['notification'] 	= $this->getNotification();		
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);
		//$pagedata['company'] 		= $this->getCompanyList();
		
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask'];
		$data['content'] 			= $this->load->view('admin/audits/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}	
	
	public function DTAuditors()
	{
		
		$post 			= $this->input->post();	
		//print_r($post);die;
		$totalcount 	= $this->Auditor_Model->getAuditorList('count', ['type' => '5', 'status' => [$post['pagestatus']]]+$post);
		$results 		= $this->Auditor_Model->getAuditorList('all', ['type' => '5', 'status' => [$post['pagestatus']]]+$post);
		//print_r($results);die;

		$status = 1;

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){				
				$stockcount = 0;
				$totalrecord[] = 	[										
										'name' 			=> 	$result['name']." ".$result['surname'],
										'email' 		=> 	$result['work_phone'],										
										'contactnumber' 		=> 	$result['mobile_phone'],
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/audits/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
		$this->auditorprofile($id);
	}
	
}

