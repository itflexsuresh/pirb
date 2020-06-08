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
		$this->load->model('CC_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Diary_Model');
	}
	
	public function index()
	{	
		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();
		$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail', 'usersplumber']);
		$userdatacoc_count			= 	$this->Coc_Model->COCcount(['user_id' => $userid]);

		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['userdata1']		= 	$userdata1;
		$pagedata['username']		= 	$userdata1;
		$pagedata['coc_count']		= 	$userdatacoc_count;
		$pagedata['deliverycard']	= 	$this->config->item('purchasecocdelivery');
		$pagedata['coctype']		= 	$this->config->item('coctype');
		$pagedata['settings']		= 	$this->Systemsettings_Model->getList('row');
		$pagedata['logcoc']			=	$this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['4','5']]);
		$pagedata['cocpaperwork']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
		$pagedata['cocelectronic']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
		$pagedata['postage']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
		$pagedata['couriour']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
		$pagedata['collectedbypirb']= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb')]);
		$orderquantity 				= $this->Coc_Ordermodel->getCocorderList('all', ['admin_status' => '0', 'userid' => $userid]);
		$pagedata['userorderstock']	= array_sum(array_column($orderquantity, 'quantity'));

		$data['plugins']			= 	['validation', 'datepicker'];
		//$pagedata['result'] 		= $this->Coc_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
		$pagedata['customview'] 	= 	$this->load->view('common/custom',  '', true);
		$data['content'] 			= 	$this->load->view('plumber/purchasecoc/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}

	public function insertOrders(){
			if ($this->input->post()) {
				$this->session->set_userdata('pay_purchaseorder', $this->input->post());	
				echo '1';		
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

	public function paymentsuccess(){
		$this->session->set_flashdata('success','COC Purchase Sucessfully.');
		redirect('plumber/myaccounts/index');
	}
	
	public function paymentnotify(){
		$this->output->set_header('HTTP/1.0 200 OK');
		flush();
		
		$result = $_POST;
		
		if($result['payment_status']=='COMPLETE'){
			$settings 		= 	$this->Systemsettings_Model->getList('row');
			$requestData 	= 	json_decode($result['custom_str1']);
			$userid 		=	$requestData['userid'];

			$requestData1['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
			$requestData1['user_id']		= 	$userid;
			$requestData1['vat']			= 	$requestData['vat'];
			$requestData1['delivery_type'] 	= 	$requestData['delivery_type'];
			$requestData1['total_cost'] 	= 	$requestData['total_due'];
			$requestData1['created_at']		= 	date('Y-m-d H:i:s');
			$requestData1['inv_type']		= 	1;
			$requestData1['coc_type']		= 	$requestData['coc_type'];
			
			$this->db->insert('invoice',$requestData1);
			$inv_id 		= $this->db->insert_id();

			$this->CC_Model->diaryactivity(['plumberid' => $this->getUserID(), 'action' => '5', 'type' => '2']);
				
			$requestData2['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
			$requestData2['user_id']			= 	$this->getUserID();
			$requestData2['created_by']		= 	$userid;
			$requestData2['created_at']		= 	date('Y-m-d H:i:s');
			$requestData2['updated_at']		=	$requestData2['created_at'];
			$requestData2['status']			= 	'0';
			$requestData2['inv_id']			= 	$inv_id;
			$requestData2['coc_type']		= 	$requestData['coc_type'];
			$requestData2['delivery_type'] 	= 	$requestData['delivery_type'];
			$requestData2['cost_value']		= 	$requestData['cost_value'];
			$requestData2['quantity']		= 	$requestData['quantity'];
			$requestData2['delivery_cost']	= 	$requestData['delivery_cost'];
			$requestData2['delivery_cost']	= 	$requestData['delivery_cost'];
			$requestData2['vat']			= 	$requestData['vat'];
			$requestData2['total_due']		= 	$requestData['total_due'];

			$this->db->insert('coc_orders',$requestData2);
			$coc_order_id 	= $this->db->insert_id();

			$requestData0['count'] 			= 	$requestData['permittedcoc'] - $requestData['quantity'];
			$requestData0['user_id']		= 	$userid;
			$requestData0['created_by']		= 	$userid;
			$requestData0['created_at']		= 	date('Y-m-d H:i:s');

			$this->db->update('coc_count', $requestData0, ['user_id' => $userid]);
				
			$insert_id 				= 	$this->db->select('id,inv_id')->from('coc_orders')->order_by('id','desc')->get()->row_array();
			$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $userid]);
			$request['status'] 		= 	'1';
			
			if ($insert_id) {

				if($requestData['coc_type']=='1'){
					for($m=1;$m<=$requestData['quantity'];$m++){
						$stockmanagement = $this->db->get_where('stock_management', ['user_id' => '0', 'coc_status' => '1', 'coc_orders_status' => '6', 'type' => '1'])->row_array();
						
						$cocrequestdata = [
							'coc_status' 				=> '4',
							'type' 						=> $requestData['coc_type'],
							'coc_orders_status' 		=> null,
							'user_id' 					=> $userid,
						];
						
						if($stockmanagement){
							$this->db->update('stock_management', $cocrequestdata, ['id' => $stockmanagement['id']]);
							$cocinsertid = $stockmanagement['id'];
						}else{
							$this->db->insert('stock_management', $cocrequestdata);
							$cocinsertid = $this->db->insert_id();
						}
						
						$this->diaryactivity(['adminid' => '1', 'plumberid' => $userid, 'cocid' => $cocinsertid, 'action' => '6', 'type' => '1']);		
					}	

					$request['admin_status']	= '1';
				}


				$inid 			= $coc_order_id;				
				$result_order 	= $this->db->update('coc_orders', $request, ['id' => $inid,'user_id' => $userid ]);

				if(isset($request['admin_status'])) unset($request['admin_status']);

				$result_invoice = $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $userid]);

				$template 	= $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();
				$orders 	= $this->db->select('*')->from('coc_orders')->where(['user_id' => $userid])->order_by('id','desc')->get()->row_array();
				$currency   = $this->config->item('currency');
				$cocreport 	= $this->cocreport($inv_id, 'PDF Invoice Plumber COC');					
				$cocTypes 	= $orders['coc_type'];
				$mail_date 	= date("d-m-Y", strtotime($orders['created_at']));
				
				$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];		
				$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];
				$body 	= str_replace($array1, $array2, $template['email_body']);

				if ($template['email_active'] == '1') {
					$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$cocreport);

					if($this->config->item('otpstatus')!='1'){
						$smsdata 	= $this->Communication_Model->getList('row', ['id' => '17', 'smsstatus' => '1']);
						
						if($smsdata){
							$sms = str_replace(['{number of COC}'], [$orders['quantity']], $smsdata['sms_body']);
							$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
						}
					}
				}
			}
		}
		
		$file = fopen("assets/payment.txt","a");
		fwrite($file,$_POST);
		fclose($file);
	}

	public function paymentcancel(){
		echo "Your Payment Is Cancelled.";
		redirect('plumber/purchasecoc/index');
	}
}
