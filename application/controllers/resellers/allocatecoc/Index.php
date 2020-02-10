<?php
//Resellers Controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resellers_allocatecoc_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Coc_Model');
	}
	
	public function index()
	{
		if($this->input->post()){						
			$requestData 	= 	$this->input->post();

			if(isset($requestData['submit'])=='submit'){
				$pagedata['result'] 	=  $this->Plumber_Model->getList('row',$requestData);
				$resultid['user_id'] = $pagedata['result']['id'];				
				$pagedata['array_orderqty']	=  $this->Resellers_allocatecoc_Model->getqty('row',$resultid);

				$Array_rangeData['coc_status']=['3'];
			 	$Array_rangeData['coctype']=['2'];			 	
			 	$Array_rangeData['userid'] = $this->getUserID();

				$pagedata['array_range'] =  $this->Coc_Model->getCOCList('all',$Array_rangeData);				
				$pagedata['rangedata']= ['' => 'Select Range']+array_column($pagedata['array_range'], 'id', 'id');
			}

			if(isset($requestData['plumberid']) > 0){
				// print_r($requestData);
				$plumberid = $requestData['plumberid'];
				$this->insertOrders();
				$data 	=  $this->Resellers_allocatecoc_Model->action($requestData);
				if($data) $message = 'Resellers Allocated Coc'.(($plumberid=='') ? 'created' : 'updated').' successfully.';
			}

		}

		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask', 'validation'];
		$data['content'] 			= $this->load->view('resellers/allocatecoc/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}

	public function ajaxOTP(){
		if ($this->input->post()) {
			$requestData1 = $this->input->post();
			$requestData2['user_id'] 				=	$this->getUserID();			
			$requestData2['otp'] 					= 	rand ( 10000 , 99999 );
			$result = $this->Coc_Model->ajaxOTP($requestData2);
			$data = array('otp' => $requestData2['otp']);
			echo json_encode($data);
		}

	}

	public function OTPVerification(){
		if ($this->input->post()) {
			$requestData 						= $this->input->post();
			$requestData['user_id'] 			=	$this->getUserID();			
			$result 							= $this->Coc_Model->OTPVerification($requestData);
			echo $result;
		}
	}

	public function insertOrders(){
		if ($this->input->post()) {

			$requestData = $this->input->post();
			$user_id	= 	$this->getUserID();

			$startrange = $requestData['startrange'];
			$endrange = $requestData['endrange'];
			$range = $endrange - $startrange + 1;			
			$requestData1['description'] 	= 	'Allocated (Reseller) '.$range.' PIRB Certificate of Compliance';

			$plumberid = $requestData['plumberid'];
			$requestData1['user_id']		= 	$plumberid;

			$requestData1['type'] 	= 'paper';
			$requestData1['delivery_type'] 	= '3';
			$requestData1['status'] 	= 'unpaid';

			$array_supplyitem['supplyitem'] = 'Certificate Of Compliance Paper';				
			$pagedata['array_amount']	=  $this->Resellers_allocatecoc_Model->getamount('row',$array_supplyitem);
			$amount = $pagedata['array_amount']['amount'];

			$array_settingid['settingid'] = '1';
			$pagedata1['array_vat']	=  $this->Resellers_allocatecoc_Model->getvat('row',$array_settingid);
			$vatper = $pagedata1['array_vat']['vat_percentage'];

			$vatamount = ($amount * $vatper * $range)/100;			
			
			$requestData1['total_cost'] = round(($amount + $vatamount),2);
			$requestData1['created_at']		= 	date('Y-m-d H:i:s');

			$result1 = $this->Coc_Model->action($requestData1, 1);

			if ($result1) {				
			
				$requestData2['description'] 	= 	'Allocated (Reseller) '.$range.' PIRB Certificate of Compliance';
				$requestData2['user_id']		= $plumberid;
				$requestData2['created_by']		= 	$this->getUserID();
				$requestData2['created_at']		= 	date('Y-m-d H:i:s');
				$requestData2['status']			= 	'0';
				$requestData2['inv_id']			= $result1;
				$requestData2['quantity'] = $range;
				$requestData2['cost_value'] = $amount;
				$requestData2['vat'] = $vatamount;
				$requestData2['total_due'] = round(($amount + $vatamount),2);

				$result = $this->Coc_Model->action($requestData2, 2);
				// echo $result;
			}
			
		}
	}
	
}
