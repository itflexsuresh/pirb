<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Paper_Model');

		$this->checkUserPermission('8', '1');
	}
	
	public function index()
	{
		$this->checkUserPermission('8', '2', '1');

		$userid 				= $this->getUserID();
		$pagedata['count'] 		= $this->Paper_Model->getList('count', ['cocstatus' => '1']);		
		$pagedata['result'] 	= $this->Paper_Model->getList('row');

		if($this->input->post()){
			$this->checkUserPermission('8', '2', '1');

			$requestData 	= 	$this->input->post();				
			$data 			=  	$this->Paper_Model->action($requestData);			

			if(isset($data)) $this->session->set_flashdata('success', ' COC '.(($id =='') ? 'Generated' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/cocstatement/papermanagement/index'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['userid']			= $userid;		
		$pagedata['checkpermission'] = $this->checkUserPermission('8', '2');

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('admin/cocstatement/papermanagement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function DTStocklog(){
		$post 			= $this->input->post();
		$totalcount 	= $this->Paper_Model->getLogList('count',$post);
		$results 		= $this->Paper_Model->getLogList('all',$post);

		$checkpermission	=	$this->checkUserPermission('8', '2');

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				$totalrecord[] = 	[
										'createdat' 	=> 	date('d-m-Y', strtotime($result['created_at'])),
										'stock' 		=> 	$result['stock'],
										'range_start' 	=> 	$result['range_start'],
										'range_end'		=> 	$result['range_end']
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
