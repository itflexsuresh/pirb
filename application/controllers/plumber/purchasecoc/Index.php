<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Rates_Model');
		$this->load->model('Systemsettings_Model');
		$this->load->model('Plumber_Model');
	}
	
	public function index()
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			print_r($requestData);die;
		}




		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();
		$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid]);

		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['username']		= 	$userdata1;
		$pagedata['deliverycard']	= 	$this->config->item('purchasecocdelivery');
		$pagedata['coctype']		= 	$this->config->item('coctype');
		$pagedata['settings']		= 	$this->Systemsettings_Model->getList('row');
		$pagedata['cocpermitted']	=	$this->Coc_Model->checkcocpermitted($userid);
		$pagedata['logcoc']			=	$this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'status' => '1', 'log_status' => '0']);
		$pagedata['cocpaperwork']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork'), 'status' => ['1']]);
		$pagedata['cocelectronic']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic'), 'status' => ['1']]);
		$pagedata['postage']			= $this->Rates_Model->getList('row', ['id' => $this->config->item('postage'), 'status' => ['1']]);
		$pagedata['couriour']			= $this->Rates_Model->getList('row', ['id' => $this->config->item('couriour'), 'status' => ['1']]);
		$pagedata['collectedbypirb']	= $this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb'), 'status' => ['1']]);

		$data['plugins']			= 	['validation', 'datepicker'];
		//$pagedata['result'] 		= $this->Coc_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
		$data['content'] 			= 	$this->load->view('plumber/purchasecoc/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}

	public function insertOrders(){
		if ($this->input->post()) {
			$requestData = $this->input->post();

			$oderID 						= $this->genreateOrderID();
			$invID 							= $this->genreateInvID();

			$requestData['user_id']			= 	$this->getUserID();
			$requestData['created_by']		= 	$this->getUserID();
			$requestData['created_at']		= 	date('Y-m-d H:i:s');
			$requestData['updated_at']		=	$requestData['created_at'];
			$requestData['updated_by']		= 	$requestData['created_by'];
			$requestData['status']			= 	'0';
			$requestData['order_id']		= 	$oderID;
			$requestData['inv_id']			= 	$invID ;

			$result = $this->Coc_Model->action($requestData);
			echo $result;
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

	public function ajaxOTP(){
		if ($this->input->post()) {
			$requestData1 = $this->input->post();
			$requestData2['user_id'] 				=	$this->getUserID();
			$requestData['users'] 					= 	$this->Plumber_Model->getList('row', ['id' => $requestData2['user_id']]);
			$name 									= $requestData['users']['name'];
			$surname 								= $requestData['users']['surname'];
			$email 									= $requestData['users']['email'];
			$item_description 						= $requestData1['item_description']; 
			$payment_method 						= $requestData1['payment_method'];
			$m_payment_id 							= $requestData1['m_payment_id'];

			$requestData2['mobile'] 				= 	$requestData['users']['mobile_phone'];
			$requestData2['otp'] 					= 	rand ( 10000 , 99999 );
			$ammount 								= 	$requestData1['ammount'];

			$param = array(
				'merchant_id' 		=> '10016054', 
				'merchant_key' 		=> 'uwfiy08dfb6jn', 
				'item_name' 		=> 'coc', 
				'amount' 			=> $ammount,
				'name' 				=> $name,
				'surname' 			=> $surname,
				'email' 			=> $email,
				'item_description' 	=> $item_description,
				'payment_method' 	=> $payment_method,
				'm_payment_id' 		=> $m_payment_id,
				'return_url' 		=> 'http://diyesh.com/auditit_new/pirb/return',
				'cancel_url' 		=> 'http://diyesh.com/auditit_new/pirb/cancel',
				'notify_url' 		=> 'http://diyesh.com/auditit_new/pirb/notify',


			);
			//print_r($param);die;
			$pfOutput = '';
			foreach( $param as $key => $val )
			{
				if(!empty($val))
				{
					$pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
				}
			}
			// Remove last ampersand

			$getString = substr( $pfOutput, 0, -1 );

			$pfSignature = md5( $getString );

			
			$result = $this->Coc_Model->ajaxOTP($requestData2);

			$data = array('otp' => $requestData2['otp'], 'signature' => $pfSignature );
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

	public function return(){
		$userid 				=	$this->getUserID();
		$insert_id 				= 	$this->db->select('id')->from('coc_orders')->order_by('id','desc')->get()->row_array();
		$request['status'] 		= 	'1';
		 if ($insert_id) {
			$inid 				= $insert_id['id'];
		 	$result 			= $this->db->update('coc_orders', $request, ['id' => $inid,'user_id' => $userid ]);
			redirect('plumber/purchasecoc/index/notify');
		 }
		
	}

	public function cancel(){
		echo "Your Payement Sucessfully Done.";
		redirect('plumber/registration/index');
	}

	public function notify(){
		echo "Your Payement Sucessfully Done.";
		redirect('plumber/registration/index');
	}
}
