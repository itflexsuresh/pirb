<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Coc_Ordermodel');
		$this->load->model('Auditor_Model');
		$this->load->model('Friends_Model');
		$this->load->model('Resellers_allocatecoc_Model');
	}
	
	public function index()
	{
		$coc_purchase = $coc_allocated = $purchaseArray = $purchaseArray_Result = $allocateArray = $allocateArray_Result = array();
		$user_id 						= 	$this->getUserID();
		$userdata 						= 	$this->getUserDetails();
		$post['allocated_id']			= 	$user_id;
		$post['allocated']				= 	$user_id; 
		$pagedata['cocstock'] 			= 	$this->Coc_Model->getCOCList('count',$post);

		$post['monthrange']				= 	'6';		
		for($i = 1; $i <= 6; $i++){
			$post['monthArray']			= 	date('Y-m', strtotime('-'.$i.' months'));
			$cochistory 				= 	$this->Coc_Model->getCOCList('all',$post);

			foreach ($cochistory as $key => $value) {			
				if($value['user_id'] 		== 	$user_id){
			   		$purchaseArray[] 		= 	date("m", strtotime($value['purchased_at']));
			   	}
			   	if($value['allocatedby'] 	== 	$user_id){
			   		$allocateArray[] 		= 	date("m", strtotime($value['purchased_at']));
			   	}
			}
		}	

		$purchaseArray_Result			= 	array_count_values($purchaseArray);
		$allocateArray_Result			= 	array_count_values($allocateArray);
				
		for($i = 1; $i <= 6; $i++){
			$monthvalue					=	date('m')-$i;
			if($monthvalue < 10){
				$monthvalue 			=  	'0'.$monthvalue; 
			}

			$coc_purchase[$i]['month']	= 	date('F', mktime(0, 0, 0, $monthvalue, 10));
			if (array_key_exists($monthvalue, $purchaseArray_Result)) {
				$coc_purchase[$i]['value']	= 	$purchaseArray_Result[$monthvalue];
			}
			else{
				$coc_purchase[$i]['value']	= 	'0';
			}
			$coc_allocated[$i]['month']	= 	date('F', mktime(0, 0, 0, $monthvalue, 10));
			if (array_key_exists($monthvalue, $allocateArray_Result)) {
				$coc_allocated[$i]['value']	= 	$allocateArray_Result[$monthvalue];
			}
			else{
				$coc_allocated[$i]['value']	= 	'0';
			}			
		}
		$pagedata['coc_purchase'] 			= 	$coc_purchase;
		$pagedata['coc_allocated'] 			= 	$coc_allocated;

		$data['plugins']					= 	['echarts', 'knob', 'zingchart'];
		$data['content'] 					= 	$this->load->view('resellers/dashboard/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
}
