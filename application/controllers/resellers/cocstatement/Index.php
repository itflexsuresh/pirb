<?php
//Resellers Controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Resellers_allocatecoc_Model');
	}
	
	public function index()
	{
		$pagedata['usersid'] = $this->getUserID();
		$pagedata['notification'] 	= $this->getNotification();		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask'];
		$data['content'] 			= $this->load->view('resellers/cocstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}

	public function DTResellers()
	{
		
		$post 		= $this->input->post();	
		// $post['user_id'] = $this->getUserID();
		$totalcount =  $this->Resellers_allocatecoc_Model->getstockList('count',$post);
		$results 	=  $this->Resellers_allocatecoc_Model->getstockList('all',$post);		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){				
				if($result['allocatedby'] > 0){
					$status = "Allocated";
					$name = $result['name']." ".$result['surname'];
					$timestamp = strtotime($result['allocation_date']);
					$newDate = date('d-F-Y h:i', $timestamp);
				}
				else{
					$status = "In stock";
					$name = "";
					$newDate = "";
				}

				

				$stockcount = 0;				
				$totalrecord[] = 	[										
										'cocno' 		=> 	$result['id'],
										'status' 		=> 	$status,										
										'datetime' 		=> 	$newDate,
										'invoiceno' 	=> 	$result['invoiceno'],
										'name' 			=> 	$name,
										'registration_no'=> $result['registration_no'],
										'company'=> $result['company'],
										
									];
			}
		}
		
		$json = array(			  
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}

}
