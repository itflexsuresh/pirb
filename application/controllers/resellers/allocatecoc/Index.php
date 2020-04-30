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
		$this->load->model('Stock_Model');
		$this->load->model('Communication_Model');
		$this->load->model('Systemsettings_Model');
	}
	
	public function index()
	{
		if($this->input->post()){						
			$requestData 	= 	$this->input->post();

			if(isset($requestData['submit'])=='submit'){								
				if($requestData['user_id_hide'] > 0){
					$requestData1['id'] = $requestData['user_id_hide'];
					$pagedata['result'] 	=  $this->Plumber_Model->getList('row',$requestData1, ['users', 'usersdetail', 'usersplumber', 'company']);
					$pagedata['user_id_hide'] = '1';
				}
				else{
					$pagedata['user_id_hide'] = '0';
					$pagedata['result'] 	=  $this->Plumber_Model->getList('row',$requestData, ['users', 'usersdetail', 'usersplumber', 'company']);
					if(empty($pagedata['result']))
						$pagedata['emptyvalue'] = 0;
					else
						$pagedata['emptyvalue'] = 1;
				}

				// echo '<pre>'; print_r($pagedata['result']); exit;
				$resultid['user_id'] = $pagedata['result']['id'];						
				$pagedata['array_orderqty']	=  $this->Resellers_allocatecoc_Model->getqty('row',$resultid);

				$Array_rangeData['coc_status']=['3'];
			 	$Array_rangeData['coctype']=['2'];			 	
			 	$Array_rangeData['user_id'] = $this->getUserID();

				$pagedata['array_range'] =  $this->Coc_Model->getCOCList('all',$Array_rangeData);				
				$pagedata['rangedata']= ['' => 'Select Range']+array_column($pagedata['array_range'], 'id', 'id');

				$pagedata['card'] 	= $this->plumbercard($resultid['user_id']);
			}

			if(isset($requestData['plumberid']) > 0){
				// print_r($requestData);
				$plumberid = $requestData['plumberid'];
				//$this->insertOrders();
				$data 	=  $this->Resellers_allocatecoc_Model->action($requestData);
				if($data) $message = 'Resellers Allocated Coc'.(($plumberid=='') ? 'created' : 'updated').' successfully.';				
				redirect('resellers/cocstatement/index');

			}

		}

		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['specialisations'] 	= $this->config->item('specialisations');
		$pagedata['userid'] 	= $this->getUserID();

		
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask', 'validation'];
		$data['content'] 			= $this->load->view('resellers/allocatecoc/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
	
	/*
	public function insertOrders(){
		if ($this->input->post()) {
			$settings = $this->Systemsettings_Model->getList('row');
			$requestData = $this->input->post();
			$user_id	= 	$this->getUserID();

			$startrange = $requestData['startrange'];
			$endrange = $requestData['endrange'];
			$range = $endrange - $startrange + 1;			
			$requestData1['description'] 	= 	'Allocated (Reseller) '.$range.' PIRB Certificate of Compliance';

			$plumberid = $requestData['plumberid'];
			$requestData1['user_id']		= 	$plumberid;

			$requestData1['coc_type'] 	= '2';
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

			$invoiceid = $this->Coc_Model->action($requestData1, 1);

			if ($invoiceid) {				
			
				$requestData2['description'] 	= 	'Allocated (Reseller) '.$range.' PIRB Certificate of Compliance';
				$requestData2['user_id']		= $plumberid;
				$requestData2['created_by']		= 	$this->getUserID();
				$requestData2['created_at']		= 	date('Y-m-d H:i:s');
				$requestData2['status']			= 	'0';
				$requestData2['coc_type']			= 	'2';
				$requestData2['delivery_type']			= 	'3';
				$requestData2['inv_id']			= $invoiceid;
				$requestData2['quantity'] = $range;
				$requestData2['cost_value'] = $amount;
				$requestData2['vat'] = $vatamount;
				$requestData2['total_due'] = round(($amount + $vatamount),2);

				$cocorderid = $this->Coc_Model->action($requestData2, 2);
				
			}

			

			//pdf generation
			$userid 				=	$plumberid;
			$insert_id 				= 	$cocorderid;
			$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $plumberid], ['users', 'usersdetail']);			
			if ($insert_id) 
			{
				$inid 				= $cocorderid;
				$inv_id 			= $invoiceid;				
				
				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoiceid])->get()->row_array();
				

				// invoice PDF
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$amount 		=	$rowData['total_due']*$rowData['quantity'];
				$invoiceDate 	= date("d-m-Y", strtotime($rowData['created_at']));

				if ($rowData['coc_type'] == '1') 
				{
					$coc_type_id = 13;
					$delivery_rate['amount'] = 0;
					$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();

				}
				elseif($rowData['coc_type'] == '2')
				{
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

		        	 $paid = "<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/paid.jpg>";
		        	 $paid_status = "PAID";
		        	
		        }
		        else{

		        	$paid ="<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/unpaid2.jpg>";
		        	$paid_status = "UNPAID";
		        	
		        }
		        $stringaarr = explode("@@@",$rowData['areas']);
		        $provincesettings = explode("@@@",$rowData2['provincesettings']);


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
					<img class="logo" style="width: 250px;" src="'.$this->base64conversion(base_url()."assets/images/pitrb-logo.png").'">
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
						<p>'.$addrpirb[1].'</p>
						<p>'.$rowData2['suburb'].'</p>
						<p>'.$rowData2['city'].'</p>
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
						<p>'.$stringaarr[6].'</p>
						<p>'.$stringaarr[5].'</p>
						<p>'.$stringaarr[4].'</p>
						<p>'.$rowData['email2'].'</p>
						<p>'.$rowData['reg_no'].'</p>
						<p>'.$rowData['vat_no'].'</p>
					</div>
				</td>
				<td style="vertical-align: top;">
					<div style="margin-top: 40px; border: 1px solid #000;">
						<p style="width: 140px; display: inline-block; margin: 0px 5px 0 5px; padding: 10px;   font-size: 14px; font-weight: 600; border-right: 1px solid #000; text-align: center;">Customer Company Reg</p>
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
							<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$delivery_rate['amount'].'</p>
							<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$delivery_rate['amount'].'</p>
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
						<p>'.$rowData1['account_name'].'</p>
						<p>'.$rowData1['account_no'].'</p>
						<p>'.$rowData1['account_type'].'</p>
					</div>
				</td>
				<td>
					<p style="text-align: center; border: 1px solid #000; width: 50%; float: right; margin-right: 20px;">
						<p style="border-bottom: 1px solid #000;">
							<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">Sub Total</p>
							<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$total_subtotal.'</p>
						</p>
						<p style="border-bottom: 1px solid #000;">
							<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">VAT '.$settings["vat_percentage"].'%</p>
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
                $filePath = FCPATH.'assets/inv_pdf/';
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				$output = $this->pdf->output();
				file_put_contents($filePath.$pdfFilePath, $output);
				//$this->pdf->stream($pdfFilePath);

				$cocTypes = $orders['coc_type'];
				$mail_date = date("d-m-Y", strtotime($orders['created_at']));				  
			 	
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '17', 'emailstatus' => '1']);
				
				if($notificationdata){
					$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];	
					$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];
					$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
					$this->CC_Model->sentMail($userdata1['email'], $notificationdata['subject'], $body, $filePath.$pdfFilePath);
				}
				
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
	*/
	
	public function userDetails()
	{

		$postData = $this->input->post();		  
		if($postData['type'] == 3)
		{
			$data 	=   $this->Resellers_allocatecoc_Model->autosearchPlumber($postData);
		}
	  	// echo json_encode($data); exit;

		if(!empty($data)) {
		?>
			<ul id="name-list">
			<?php
			foreach($data as $key=>$val) {
				$name = $val["name"];
				if(isset($val["surname"])){
					$name = $name.' '.$val["surname"];
				}
			?>
			<li onClick="selectuser('<?php echo $name; ?>','<?php echo $val["id"]; ?>','<?php echo $val["coc_purchase_limit"]; ?>');"><?php echo $name; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}


	public function pdfgenerate($plumberid){
			
	}

	public function allocate_coc_range(){
		$post = $this->input->post();		  		
		$user_id = $this->getUserID();
		// $rangebalace_coc = isset($post['rangebalace_coc']) && is_int($post['rangebalace_coc']) ? $post['rangebalace_coc'] : 0;
		$stock = $this->Stock_Model->getResellerRange('all',['user_id'=>$user_id],$post['rangebalace_coc']);
		$allocate_start = isset($stock['allocate_start']) ? $stock['allocate_start'] : '';
		$allocate_end = isset($stock['allocate_end']) ? $stock['allocate_end'] : '';

		echo json_encode(['allocate_start'=>$allocate_start,'allocate_end'=>$allocate_end]);
	}
	
}
