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
			$requestData['users'] 					= 	$this->Plumber_Model->getList('row', ['id' => $requestData2['user_id']], ['users', 'usersdetail']);
			$name 									= 	$requestData['users']['name'];
			$surname 								= 	$requestData['users']['surname'];
			$email 									= 	$requestData['users']['email'];
			$item_description 						= 	$requestData1['item_description']; 
			$payment_method 						= 	$requestData1['payment_method'];
			$m_payment_id 							= 	$requestData1['m_payment_id'];
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
		}

	}

	public function return(){
		$userid 				=	$this->getUserID();
		$settings = $this->Systemsettings_Model->getList('row');


		$requestData = $this->session->userdata('pay_purchaseorder');
		if ($requestData['delivery_type']=='') {
			$delivery_type = '0';
		}else{
			$delivery_type = $requestData['delivery_type'];
		}
				// $requestData0['count'] = $requestData['permittedcoc'] - $requestData['quantity'];
				
				 //print_r($requestData);die;

				$requestData1['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
				$requestData1['user_id']		= 	$userid;
				$requestData1['vat']			= 	$requestData['vat'];
				$requestData1['delivery_type'] 	= 	$delivery_type;
				$requestData1['total_cost'] 	= 	$requestData['total_due'];
				$requestData1['created_at']		= 	date('Y-m-d H:i:s');
				$requestData1['inv_type']		= 	1;
				$requestData1['coc_type']		= 	$requestData['coc_type'];
				
				// $result1 = $this->Coc_Model->action($requestData1, 1);
				// $this->CC_Model->diaryactivity(['plumberid' => $this->getUserID(), 'action' => '5', 'type' => '2']);
				
					$requestData2['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
					$requestData2['user_id']			= 	$this->getUserID();
					$requestData2['created_by']		= 	$this->getUserID();
					$requestData2['created_at']		= 	date('Y-m-d H:i:s');
					$requestData2['updated_at']		=	$requestData2['created_at'];
					$requestData2['status']			= 	'0';
					$requestData2['inv_id']			= 	$result1;
					$requestData2['coc_type']		= 	$requestData['coc_type'];
					$requestData2['delivery_type'] 	= 	$delivery_type;
					$requestData2['cost_value']		= 	$requestData['cost_value'];
					$requestData2['quantity']		= 	$requestData['quantity'];
					$requestData2['delivery_cost']	= 	$requestData['delivery_cost'];
					$requestData2['delivery_cost']	= 	$requestData['delivery_cost'];
					$requestData2['vat']			= 	$requestData['vat'];
					$requestData2['total_due']		= 	$requestData['total_due'];

					//$result_coc = $this->Coc_Model->action($requestData2, 2);

					$requestData0['count'] 			= 	$requestData['permittedcoc'] - $requestData['quantity'];
					$requestData0['user_id']		= 	$this->getUserID();
					$requestData0['created_by']		= 	$this->getUserID();
					$requestData0['created_at']		= 	date('Y-m-d H:i:s');

			
					$result0 = $this->Coc_Model->action($requestData0, 3);
					
				




		$insert_id 				= 	$this->db->select('id,inv_id')->from('coc_orders')->order_by('id','desc')->get()->row_array();
		$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail']);
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
			
			$inid 				= $insert_id['id'];
			$inv_id 			= $insert_id['inv_id'];
			// $inid 				= $result_coc;
			// $inv_id 			= $result1;
		 	$result 			= $this->db->update('coc_orders', $request, ['id' => $inid,'user_id' => $userid ]);
			if(isset($request['admin_status'])) unset($request['admin_status']);
			
			$result 			= $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $userid]);
			
		 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

		 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $userid])->order_by('id','desc')->get()->row_array();
		 	$currency    = $this->config->item('currency');


		 	// invoice PDF

		 	$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);

					$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
					$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);

           			$amount 		=	$rowData['total_due']*$rowData['quantity'];

           			$invoiceDate 	= date("d-m-Y", strtotime($rowData['created_at']));

           			if ($rowData['coc_type'] == '1') {
           				$coc_type_id = 14;
           				$delivery_rate['amount'] = 0;
           				$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
           				$courierdetails = "";

           			}elseif($rowData['coc_type'] == '2'){
           				$coc_type_id = 13;
           				if ($rowData['delivery_type'] == '1') {
           					$delivery_method = 24;
           				}elseif ($rowData['delivery_type'] == '2') {
           					$delivery_method = 17;
           				}elseif ($rowData['delivery_type'] == '3') {
           					$delivery_method = 2;
           				}

           				if ($delivery_rate['amount']=='0' || $delivery_rate['amount']== 0) {
           					$currency2 = $currency;
           				}else{
           					$currency2 = "";
           				}

           				$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
           				$delivery_rate =  $this->db->select('amount')->from('rates')->where('id',$delivery_method)->get()->row_array();
						
           				$courierdetails = '<tr>
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Courier/Regsitered Post Fee</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;"></td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency2.$delivery_rate['amount'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$delivery_rate['amount'].'</td>
					</tr>';

           			}
           			$total_subtotal = $delivery_rate['amount']+$rowData['cost_value'];

           				
           			
           			

           			$base_url= base_url();

         

      if($rowData["status"]=='1'){

        	 $paid = '<img class="paid" style="width: 250px;" src="'.$this->base64conversion(base_url()."assets/images/paid.png").'">';

        	 $paid_status = "PAID";
        	
        }
        else{

        	$paid ='<img class="paid" style="width: 250px;" src="'.$this->base64conversion(base_url()."assets/images/unpaid.png").'">';

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
					<img class="logo" style="width: 250px; margin-top:10px;" src="'.$this->base64conversion(base_url()."assets/images/pitrb-logo.png").'">
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
					<th style="padding: 10px;   font-size: 14px; text-align: center;">Customer Company Reg</th>
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
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$PDF_rate['amount'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$rowData['cost_value'].'</td>
					</tr>

					'.$courierdetails.'

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
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$currency.$total_subtotal.'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">VAT '.$settings["vat_percentage"].'%</td>
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$currency.$rowData['vat'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 5px 50px; border: 1px solid #000;">'.$currency.$rowData['total_due'].'</td>
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

                $file_pointer = $filePath.$pdfFilePath;

                if (file_exists($file_pointer))  
				{ 
					unlink($file_pointer);
				    $this->pdf->loadHtml($html);
					$this->pdf->setPaper('A4', 'portrait');
					$this->pdf->render();
					$output = $this->pdf->output();
					file_put_contents($filePath.$pdfFilePath, $output);
				} 
				else 
				{ 
				    $this->pdf->loadHtml($html);
					$this->pdf->setPaper('A4', 'portrait');
					$this->pdf->render();
					$output = $this->pdf->output();
					file_put_contents($filePath.$pdfFilePath, $output);
					//$this->pdf->stream($pdfFilePath);
				} 

				// $this->pdf->loadHtml($html);
				// $this->pdf->setPaper('A4', 'portrait');
				// $this->pdf->render();
				// $output = $this->pdf->output();
				// file_put_contents($filePath.$pdfFilePath, $output);
				// //$this->pdf->stream($pdfFilePath);

			 $cocTypes = $orders['coc_type'];
			 $mail_date = date("d-m-Y", strtotime($orders['created_at']));
			  
		 	
		 	 $array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];
			 

			$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

			$body = str_replace($array1, $array2, $template['email_body']);

		 	if ($template['email_active'] == '1') {

		 		$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$filePath.$pdfFilePath);

		 		if($this->config->item('otpstatus')!='1'){
		 			$smsdata 	= $this->Communication_Model->getList('row', ['id' => '17', 'smsstatus' => '1']);
					
					if($smsdata){
						$sms = str_replace(['{number of COC}'], [$orders['quantity']], $smsdata['sms_body']);
						$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
					}
				}
		 	}
			$this->session->unset_userdata('pay_purchaseorder');
			redirect('plumber/purchasecoc/index/notify');
		 }
		
	}

	public function cancel(){
		echo "Your Payement Sucessfully Done.";
		redirect('plumber/registration/index');
	}

	public function notify(){
		$this->session->set_flashdata('success','COC Purchase Sucessfully.');
		redirect('plumber/myaccounts/index');
	}
}
