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
	}
	
	public function index()
	{

		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();
		$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid]);

		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['userdata1']		= 	$userdata1;
		$pagedata['username']		= 	$userdata1;
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

				$requestData = $this->input->post();
				$user_id	= 	$this->getUserID();

				$requestData1['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
				$requestData1['user_id']		= 	$user_id;
				$requestData1['delivery_type'] 	= 	$requestData['delivery_type'];
				$requestData1['total_cost'] 	= 	$requestData['total_due'];
				$requestData1['created_at']		= 	date('Y-m-d H:i:s');
				$requestData1['inv_type']		= 	1;
				$requestData1['type']			= 	$requestData['coc_type'];
				
				$result1 = $this->Coc_Model->action($requestData1, 1);
				if ($result1) {
					
				
					$requestData['description'] 	= 	'Purchase of '.$requestData['quantity'].' PIRB Certificate of Compliance';
					$requestData['user_id']			= 	$this->getUserID();
					$requestData['created_by']		= 	$this->getUserID();
					$requestData['created_at']		= 	date('Y-m-d H:i:s');
					$requestData['updated_at']		=	$requestData['created_at'];
					$requestData['status']			= 	'0';
					$requestData['inv_id']			= $result1;

					$result = $this->Coc_Model->action($requestData, 2);
					
					echo $result;


				}
				
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
		$insert_id 				= 	$this->db->select('id,inv_id')->from('coc_orders')->order_by('id','desc')->get()->row_array();
		$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $userid]);
		$request['status'] 		= 	'1';
		 if ($insert_id) {
			$inid 				= $insert_id['id'];
			$inv_id 			= $insert_id['inv_id'];
			$result 			= $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $userid]);
		 	$result 			= $this->db->update('coc_orders', $request, ['id' => $inid,'user_id' => $userid ]);

		 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

		 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $userid])->get()->row_array();

		 	// invoice PDF

		 	$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);

					$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
					$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);

           			$amount 		=	$rowData['total_due']*$rowData['quantity'];

           			$invoiceDate 	= date("d-m-Y", strtotime($rowData['created_at']));

           			

           			if ($rowData['type'] == 'electronic') {
           				$coc_type_id = 14;
           				$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
           			}
           			else{

           				if ($rowData['type'] == 'paper' && $rowData['delivery_type'] == 2) {
           				$del_method = 17;
	           				
	           			}elseif($rowData['type'] == 'paper' && $rowData['delivery_type'] == 3){
	           				$del_method = 2;
	           				// $db_paper_type = $this->db->select('amount')->from('rates')->where('id',$del_method)->get()->row_array();
	           			}else{
	           				$db_paper_type['amount'] = 0;
	           				
	           				$db_paper_type['amount'] = 0;
           				}

           				$coc_type_id = 13;
           				$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
           				$db_paper_type = $this->db->select('amount')->from('rates')->where('id',$del_method)->get()->row_array();
           				$total_pdf = ($rowData['cost_value']+$db_paper_type['amount']);
           				
           			}
           			

           			$base_url= base_url();

         

        if($rowData["status"]=='paid'){

        	 $paid = "<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/paid.jpg>";
        	 $paid_status = "PAID";
        	
        }
        else{

        	$paid ="<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/unpaid2.jpg>";
        	$paid_status = "UNPAID";
        	
        }

				$html = '<!DOCTYPE html>
<html>
<head>
	<title>PDF Invoice Plumber COC</title>
</head>

<style type="text/css">
td {
    width: 50%;
}
</style>
<body>

<table style="width: 100%; margin: 0 auto; border: 1px solid #000; padding: 0 10px 0 10px;">
	<tbody>
		<tr>
			<td style="text-align: left;">
				<img class="logo" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png">
			</td>
			<td style="text-align: right;">
					<p style="width: auto; display: inline-block; border: 1px solid #000; padding: 8px 30px 8px 30px;">Invoice Number</p>
					<p style="width: auto; display: inline-block; padding: 8px 30px 8px 30px; border: 1px solid #000; margin-left: -5px; border-left: none;">'.$rowData['inv_id'].'</p>
			</td>
		</tr>
		<tr>
			<td>
				<div style="border: 1px solid; width: 70%; margin-top: 40px; margin-left: 20px;">
					<p style="border-bottom: 1px solid #000; margin-top: 10px; padding: 0 10px 10px 10px; font-weight: 600;">Company Details</p>
					<p>'.$rowData2['address'].'</p>
					<p>'.$rowData2['suburb'].'</p>
					<p>'.$rowData2['city'].'</p>
					<p>'.$rowData1['email'].'</p>
					<p>'.$rowData1['work_phone'].'</p>
					<p>'.$rowData1['email'].'</p>
					<p>'.$rowData1['reg_no'].'</p>
					<p>'.$rowData1['vat_no'].'</p>
				</div>
			</td>
			<td style="text-align: right;">
           '.$paid_status.'
        
        </td>

		</tr>
		<tr>
			<td>
				<div style="border: 1px solid; width: 70%; margin-top: 40px; margin-left: 20px;">
					<p style="border-bottom: 1px solid #000; margin-top: 10px; padding: 0 10px 10px 10px; font-weight: 600;">Billing Details</p>
					<p>'.$rowData['address'].'</p>
					<p>'.$rowData['suburb'].'</p>
					<p>'.$rowData['city'].'</p>
					<p>'.$rowData['email2'].'</p>
					<p>'.$rowData['reg_no'].'</p>
					<p>'.$rowData['vat_no'].'</p>
				</div>
			</td>
			<td style="vertical-align: top;">
				<div style="margin-top: 40px; border: 1px solid #000;">
					<p style="width: 140px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;   font-size: 14px; font-weight: 600; border-right: 1px solid #000; text-align: center;">Customer Compnay Reg</p>
					<p style="width: 110px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;    font-size: 14px; font-weight: 600; border-right: 1px solid #000;">Customer VAT Reg</p>
					<p style="width: 89px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;    font-size: 14px; font-weight: 600;">Invoice Date</p>
				</div>
				<div style="border: 1px solid #000; margin-top: -1px;">
					<p style="width: 140px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;   font-size: 14px; border-right: 1px solid #000; text-align: center;">'.$rowData['reg_no'].'</p>
					<p style="width: 110px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;   font-size: 14px; border-right: 1px solid #000;">'.$rowData['vat_no'].'</p>
					<p style="width: 89px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;   font-size: 14px;">'.$invoiceDate.'</p>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="margin-left: 20px; border: 1px solid; width: 30%; margin-top: 20px; text-align: center;">
					<p style="padding: 3px; margin-top: 0; margin-bottom: 10px; border-bottom: 1px solid #000;">Terms</p>
					<p style="padding: 3px; margin-top: 0; margin-bottom: 10px;">COD</p>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="border: 1px solid #000; margin: 20px;">
					<div style="border-bottom: 1px solid #000; padding: 0 20px 0 20px;">
						<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">Description</p>
						<p style="    width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">QTY</p>
						<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">Rate</p>
						<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">Amount</p>
					</div>
					<div style="border-bottom: 1px solid #000; padding: 0 20px 0 20px;">
						<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">Purchase of '.$rowData['quantity'].' PIRB Certificate of Compliance</p>
						<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">'.$rowData['quantity'].'</p>
						<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$PDF_rate['amount'].'</p>
						<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</p>
					</div>
					<div style="padding: 0 20px 0 20px;">
						<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">Courier/Regsitered Post Fee</p>
						<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">1</p>
						<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$db_paper_type['amount'].'</p>
						<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$db_paper_type['amount'].'</p>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="margin-left: 20px;">
					<p style="font-weight: 600;">Banking Detail</p>
					<p>'.$rowData1['bank_name'].'</p>            
					<p>'.$rowData1['branch_code'].'</p>
					<p>'.$rowData2['address'].'</p>
					<p>'.$rowData2['suburb'].'</p>
					<p>'.$rowData2['city'].'</p>
				</div>
			</td>
			<td>
				<p style="text-align: center; border: 1px solid #000; width: 50%; float: right; margin-right: 20px;">
					<p style="border-bottom: 1px solid #000;">
						<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">Sub Total</p>
						<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$total_pdf.'</p>
					</p>
					<p style="border-bottom: 1px solid #000;">
						<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">VAT Total</p>
						<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$rowData['vat'].'</p>
					</p>
					<p>
						<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">Total</p>
						<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$rowData['total_due'].'</p>
					</p>
				</p>
			</td>
		</tr>
	</tbody>
</table>


</body>
</html>';

          
                $pdfFilePath = ''.$inv_id.'.pdf';
                $filePath = FCPATH.'assets/qrcode/';
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				$output = $this->pdf->output();
				file_put_contents($filePath.$pdfFilePath, $output);
				//$this->pdf->stream($pdfFilePath);
		 	
		 	 $array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];

			$array2 = [$userdata1['name']." ".$userdata1['surname'], $orders['created_at'], $orders['quantity'], $orders['coc_type']];

			$body = str_replace($array1, $array2, $template['email_body']);

		 	if ($template['email_active'] == '1') {

		 		$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body);
		 	}
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
