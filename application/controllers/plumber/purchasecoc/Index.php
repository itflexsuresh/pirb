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
		$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid]);
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
		$pagedata['logcoc']			=	$this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['1']]);
		$pagedata['cocpaperwork']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
		$pagedata['cocelectronic']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
		$pagedata['postage']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
		$pagedata['couriour']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
		$pagedata['collectedbypirb']= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb')]);

		$data['plugins']			= 	['validation', 'datepicker'];
		//$pagedata['result'] 		= $this->Coc_Model->getList('row', ['id' => $userid, 'status' => ['0','1']]);
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

	public function ajaxOTP(){
		if ($this->input->post()) {
			$requestData1 = $this->input->post();
			$requestData2['user_id'] 				=	$this->getUserID();
			$requestData['users'] 					= 	$this->Plumber_Model->getList('row', ['id' => $requestData2['user_id']]);
			$name 									= 	$requestData['users']['name'];
			$surname 								= 	$requestData['users']['surname'];
			$email 									= 	$requestData['users']['email'];
			$item_description 						= 	$requestData1['item_description']; 
			$payment_method 						= 	$requestData1['payment_method'];
			$m_payment_id 							= 	$requestData1['m_payment_id'];

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


		$requestData = $this->session->userdata('pay_purchaseorder');
				// $requestData0['count'] = $requestData['permittedcoc'] - $requestData['quantity'];
				
				 //print_r($requestData);die;

				$requestData1['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
				$requestData1['user_id']		= 	$userid;
				$requestData1['vat']			= 	$requestData['vat'];
				$requestData1['delivery_type'] 	= 	$requestData['delivery_type'];
				$requestData1['total_cost'] 	= 	$requestData['total_due'];
				$requestData1['created_at']		= 	date('Y-m-d H:i:s');
				$requestData1['inv_type']		= 	1;
				$requestData1['coc_type']		= 	$requestData['coc_type'];
				
				$result1 = $this->Coc_Model->action($requestData1, 1);
					
				
					$requestData2['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
					$requestData2['user_id']			= 	$this->getUserID();
					$requestData2['created_by']		= 	$this->getUserID();
					$requestData2['created_at']		= 	date('Y-m-d H:i:s');
					$requestData2['updated_at']		=	$requestData2['created_at'];
					$requestData2['status']			= 	'0';
					$requestData2['inv_id']			= 	$result1;
					$requestData2['coc_type']		= 	$requestData['coc_type'];
					$requestData2['delivery_type'] 	= 	$requestData['delivery_type'];
					$requestData2['cost_value']		= 	$requestData['cost_value'];
					$requestData2['quantity']		= 	$requestData['quantity'];
					$requestData2['delivery_cost']	= 	$requestData['delivery_cost'];
					$requestData2['delivery_cost']	= 	$requestData['delivery_cost'];
					$requestData2['vat']			= 	$requestData['vat'];
					$requestData2['total_due']		= 	$requestData['total_due'];

					$result = $this->Coc_Model->action($requestData2, 2);

					$requestData0['count'] 			= 	$requestData['permittedcoc'] - $requestData['quantity'];
					$requestData0['user_id']		= 	$this->getUserID();
					$requestData0['created_by']		= 	$this->getUserID();
					$requestData0['created_at']		= 	date('Y-m-d H:i:s');

			
					$result0 = $this->Coc_Model->action($requestData0, 3);
					
				$this->CC_Model->diaryactivity(['plumberid' => $this->getUserID(), 'action' => '5', 'type' => '2']);




		$insert_id 				= 	$this->db->select('id,inv_id')->from('coc_orders')->order_by('id','desc')->get()->row_array();
		$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $userid]);
		$request['status'] 		= 	'1';
		 if ($insert_id) {
			$inid 				= $insert_id['id'];
			$inv_id 			= $insert_id['inv_id'];
			$result 			= $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $userid]);
		 	$result 			= $this->db->update('coc_orders', $request, ['id' => $inid,'user_id' => $userid ]);

		 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

		 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $userid])->order_by('id','desc')->get()->row_array();



		 	// invoice PDF

		 	$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);

					$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
					$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);

           			$amount 		=	$rowData['total_due']*$rowData['quantity'];

           			$invoiceDate 	= date("d-m-Y", strtotime($rowData['created_at']));

           			if ($rowData['coc_type'] == '1') {
           				$coc_type_id = 13;
           				$delivery_rate['amount'] = 0;
           				$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();

           			}elseif($rowData['coc_type'] == '2'){
           				$coc_type_id = 14;
           				if ($rowData['delivery_type'] == '1') {
           					$delivery_method = 24;
           				}elseif ($rowData['delivery_type'] == '2') {
           					$delivery_method = 17;
           				}elseif ($rowData['delivery_type'] == '3') {
           					$delivery_method = 2;
           				}

           				$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
           				$delivery_rate =  $this->db->select('amount')->from('rates')->where('id',$delivery_method)->get()->row_array();


           			}
           			$total_subtotal = $delivery_rate['amount']+$rowData['cost_value'];

           				
           			
           			

           			$base_url= base_url();

         

      if($rowData["status"]=='1'){

        	 $paid = '<img class="paid" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/paid.png">';

        	 $paid_status = "PAID";
        	
        }
        else{

        	$paid ='<img class="paid" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/unpaid.png">';

        	$paid_status = 'UNPAID';
        	
        }
        $stringaarr = explode("@@@",$rowData['areas']);
        $provincesettings = explode("@@@",$rowData2['provincesettings']);




				$html = '<html>
					<head>
					<title>PDF Invoice Plumber COC</title>
					</head>

					<style type="text/css">
	
					td {
						width: 50%;
					}
					body {
					    font-family: "Segoe UI";
					}					
					table.custom_reg_uniq th, table.regist_fee_uniq th {
   						border: 1px solid #000;
   						border-bottom: 0;
    					border-right: 0px;
					}
					table.custom_reg_uniq td, table.regist_fee_uniq td {
					    border: 1px solid #000;
    					border-right: 0px;
					}
					table.custom_reg_uniq th:last-child, table.regist_fee_uniq th:last-child{
    					border-right: 1px solid #000;
					}
					table.custom_reg_uniq td:last-child, table.regist_fee_uniq td:last-child{
    					border-right: 1px solid #000;
					}
					table.invoice_uniq, table.custom_reg_uniq, table.regist_fee_uniq, table.total_uniq, table.comp_detail_uniq, 
					table.bill_detail_uniq, table.term_uniq {
					    border-collapse: collapse;
					}
					table.comp_detail_uniq *, table.bill_detail_uniq *{
						padding-left: 10px;
						padding-right: 10px;
					}

					</style>



					<body>

					<table style="width: 100%; margin: 0 auto; border: 1px solid #000; padding: 0 10px 0 10px;">
					<tbody>

					<tr>
					<td>
					<img class="logo" style="width: 250px; margin-top:10px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png">
					</td>

					<td style="vertical-align: top;">
						<table align="right" class="invoice_uniq" style="margin-top:10px;">
							<thead>
								<tr>
					<th style="border: 1px solid #000; padding: 8px 30px 8px 30px;">Invoice Number</th>
					<th style="padding: 8px 30px 8px 30px; border: 1px solid #000;">'.$rowData['inv_id'].'</th>	
								</tr>							
							</thead>
						</table>

					</td>
					</tr>

					<tr>
					<td style="vertical-align: top;">
					<table class="comp_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 250px;">
						<thead>
							<tr>
								<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Company Details</th>
							</tr>
						</thead>

						<tbody>
					<tr><td>'.$rowData2['address'].'</td></tr>            
					<tr><td>'.$rowData2['name'].'</td></tr>
					<tr><td>'.$rowData2['suburb'].'</td></tr>
					<tr><td>'.$rowData2['city'].'</td></tr>
					<tr><td>'.$rowData1['work_phone'].'</td></tr>
					<tr><td>'.$rowData1['email'].'</td></tr>
					<tr><td>'.$rowData1['reg_no'].'</td></tr>
					<tr><td>'.$rowData1['vat_no'].'</td></tr>															
						</tbody>
					</table>
					</td>

					<td>
						<table align="right" style="margin-top: 10px;">
							<thead>
							<tr>
								<th>
							'.$paid.'
								</th>	
							</tr>
							</thead>
						</table>
					
					</td>
					</tr>

					<tr>
					<td>
					<table class="bill_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 250px;">
						<thead>
							<tr>
							<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Billing Details</th>
							</tr>
						</thead>

						<tbody>
					<tr><td>'.$rowData['address'].'</td></tr>            
					<tr><td>'.$stringaarr[6].'</td></tr>
					<tr><td>'.$stringaarr[5].'</td></tr>
					<tr><td>'.$stringaarr[4].'</td></tr>
					<tr><td>'.$rowData['email2'].'</td></tr>
					<tr><td>'.$rowData['reg_no'].'</td></tr>
					<tr><td>'.$rowData['vat_no'].'</td></tr>
						</tbody>
					</table>
					</td>

					<td style="vertical-align: top;">
					<table align="right" class="custom_reg_uniq" style="margin-top: 10px;">
					<thead>
					<tr>
					<th style="padding: 10px;   font-size: 14px; text-align: center;">Customer Compnay Reg</th>
					<th style="padding: 10px;   font-size: 14px; text-align: center;">Customer VAT Reg</th>
					<th style="padding: 10px;   font-size: 14px; text-align: center;">Invoice Date</th>
					</tr>
					</thead>

					<tbody>
					<tr>
					<td style="padding: 10px;   font-size: 14px; text-align: center;">'.$rowData['reg_no'].'</td>
					<td style="padding: 10px;   font-size: 14px; text-align: center;">'.$rowData['vat_no'].'</td>
					<td style="padding: 10px;   font-size: 14px; text-align: center;">'.$invoiceDate.'</td>
					</tr>
					</tbody>

					</table>
					</td>
					</tr>

					<tr>
					<td>
						<table style="border: 1px solid #000;margin-top: 10px;" class="term_uniq">
							<thead>
								<tr>
								<th style="border-bottom: 1px solid #000; padding:5px 30px;text-align: center;">
								Terms
								</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center; padding:10px 30px;">
									COD	
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					</tr>

					<tr>
					<td colspan="2">
					<table class="regist_fee_uniq" style="margin-top: 10px; width: 100%">
					<thead>
					<tr>	
					<th style="width: 50%;  margin: 0; padding: 10px 0 10px 0; text-align: center;">Description</th>
					<th style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">QTY</th>
					<th style="width: 19%; margin: 0; padding: 10px 0 10px 0;text-align: center;">Rate</th>
					<th style="width: 18%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">Amount</th>
					</tr>
					</thead>

					<tbody>
					<tr>
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Purchase of '.$rowData['quantity'].' PIRB Certificate of Compliance</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$rowData['quantity'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$PDF_rate['amount'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
					</tr>

					<tr>
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Courier/Regsitered Post Fee</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$delivery_rate['amount'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$delivery_rate['amount'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
					</tr>

					</tbody>
					</table>	
					</td>
					</tr>

					<tr>
					<td>
					<table style="margin-top: 10px;">
						<thead>
							<tr>
							<th style="text-align: left;">Banking Detail</th>
							</tr>
							</thead>

							<tbody>
								<tr><td>'.$rowData1['bank_name'].'</td></tr>            
								<tr><td>'.$rowData1['branch_code'].'</td></tr>
								<tr><td>'.$rowData1['account_name'].'</td></tr>
								<tr><td>'.$rowData1['account_no'].'</td></tr>
								<tr><td>'.$rowData1['account_type'].'</td></tr>
							</tbody>
						</table>
					</td>

					<td style="vertical-align: top;">
					<table align="right" class="total_uniq" style="margin-top: 10px;">
					<tbody>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Sub Total</td>
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$rowData['cost_value'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">VAT Total</td>
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$rowData['vat'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 5px 50px; border: 1px solid #000;">'.$rowData['total_due'].'</td>
					</tr>

					</tbody>
					</table>
					</td>

					</tr>

					</tbody>
					</table>


					</body>
					</html>';

          
                $pdfFilePath = ''.$inv_id.'.pdf';
                $filePath = FCPATH.'assets/inv_pdf/';
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				$output = $this->pdf->output();
				file_put_contents($filePath.$pdfFilePath, $output);
				//$this->pdf->stream($pdfFilePath);

			 $cocTypes = $orders['coc_type'];
			 $mail_date = date("d-m-Y", strtotime($orders['created_at']));
			  
		 	
		 	 $array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];
			 

			$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

			$body = str_replace($array1, $array2, $template['email_body']);

		 	if ($template['email_active'] == '1') {

		 		$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$filePath.$pdfFilePath);
		 	}
			 
			redirect('plumber/purchasecoc/index/notify');
		 }
		
	}

	public function cancel(){
		echo "Your Payement Sucessfully Done.";
		redirect('plumber/registration/index');
	}

	public function notify(){
		$this->session->set_flashdata('success','COC Purchase Sucessfully.');
		redirect('plumber/profile/Index');
	}
}
