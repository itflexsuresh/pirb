<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coc_Orders extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Ordermodel');
		//$this->load->model('Rates_Model');
		//$this->load->model('Systemsettings_Model');
		//$this->load->model('Plumber_Model');
	}
	
	public function index()
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			//print_r($requestData);die;
			$data 			=  	$this->Coc_Ordermodel->adminadd($requestData);
			print_r($data);die;
		}




		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();
		//$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid]);

		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$data['plugins']			= 	['validation', 'datepicker','datatables', 'datatablesresponsive', 'sweetalert'];

		$pagedata['result'] 		= $this->Coc_Ordermodel->getCocorderList('row', ['status' => ['0','1']]);


		$data['content'] 			= 	$this->load->view('admin/cocmanagement/cocmanagementstatement/coc_order_index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}


public function CocorderType()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Ordermodel->getCocorderList('count', ['status' => ['0','1']]+$post);

		$results 		= $this->Coc_Ordermodel->getCocorderList('all', ['status' => ['0','1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'order_id' 		=> 	$result['order_id'],
										'inv_id' 		=> 	$result['inv_id'],
										'created_at'	=> 	$result['created_at'],
										'status' 		=> 	$this->config->item('payment_status')[$result['status']],
										'internal_inv' 	=> 	$result['internal_inv'],
										'user_id' 		=> 	$result['name']." ".$result['surname'],
										'coc_type' 		=> 	$this->config->item('coctype')[$result['coc_type']],
										'coc_purchase' 	=> 	$result['coc_purchase'],

										 'delivery_type' 		=> 	$this->config->item('purchasecocdelivery')[$result['delivery_type']],
										//'delivery_type' => 	$result['delivery_type'],

										'address' 		=> 	$result['address'],
										//'tracking_no' 	=> 	$result['tracking_no'],
										'tracking_no' 		=> 	$this->config->item('payment_status')[$result['status']],
										'action'	=> 	'<div class="table-action">
																<a href="'.base_url().'admin/cocmanagement/cocmanagementstatement/coc_order_index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit">
																<i class="fa fa-pencil-alt"></i></a>
																
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


	public function insertOrders(){
		if ($this->input->post()) {
			$requestData = $this->input->post();

			$orderID 						= $this->genreateOrderID();
			$invID 							= $this->genreateInvID();

			$requestData['user_id']			= 	$this->getUserID();
			$requestData['created_by']		= 	$this->getUserID();
			$requestData['created_at']		= 	date('Y-m-d H:i:s');
			$requestData['updated_at']		=	$requestData['created_at'];
			$requestData['updated_by']		= 	$requestData['created_by'];
			$requestData['status']			= 	'0';
			$requestData['order_id']		= 	$orderID;
			$requestData['inv_id']			= 	$invID ;

			$result = $this->Coc_Ordermodel->adminadd($requestData);
			echo $result;die;
		}
	}

	public function genreateOrderID(){
		$result = $this->db->order_by('id',"desc")->get('coc_orders')->row_array();
		if ($result) {
			$sequence_number  	= $result['order_id'];
			$product_code 		= $sequence_number+1;						
			$code 				=  str_pad($product_code,6,'0',STR_PAD_LEFT);
			$full_code 			= $code;
			return $full_code;
		}else{
			$oderID = '000001';
			return $oderID;
		}
	}

	public function genreateInvID(){
		$result = $this->db->order_by('id',"desc")->get('coc_orders')->row_array();
		if ($result) {
			$sequence_number  	= $result['inv_id'];
			$product_code 		= $sequence_number[1]+1;						
			$code 				=  str_pad($product_code,6,'0',STR_PAD_LEFT);
			$full_code 			= $code;
			return $full_code;
		}else{
			$invID = '000001';
			return $invID;
		}
	}


}
