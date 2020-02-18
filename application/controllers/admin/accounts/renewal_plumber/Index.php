<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Index extends CC_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Renewal_Model');
		$this->load->model('Plumber_Model');
	 	$this->load->model('Coc_Model');
	}

	public function index($pagestatus='',$id='')
	{
		if($id!=''){
			$result = $this->Renewal_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/accounts/Accounts/'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Renewal_Model->action($requestData);
				if($data) $message = 'Managearea Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Renewal_Model->changestatus($requestData);
				$message		= 	'Managearea Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/accounts/Index/'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/accounts/renewal_plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function Deletefunc($id)
	{

		$result = $this->Renewal_Model->deleteid($id);
		if($result == '1')
			$this->session->set_flashdata('success', 'Record was Deleted');
		else
			$this->session->set_flashdata('error', 'Error to delete the Record.');

		$url = FCPATH."assets/inv_pdf/".$id.".pdf";
		unlink($url);

		$this->index();
		redirect('admin/accounts/renewal_plumber/Index/'); 
	}

	public function Cron()
	{	
		$result = $this->Renewal_Model->getUserids();
		// echo'<pre>'; print_r($result); die;					
		foreach($result as $data)
		{
			$inv_type = '1';
			$userid = $data['id'];
			$checkinv_result = $this->Renewal_Model->checkinv($userid);					

			if(!empty($checkinv_result)){				
				foreach($checkinv_result as $checkinv_data){					
					$inv_type = $checkinv_data['inv_type'];
				}
			}
			

			if($inv_type == '2' || $inv_type == '3' || $inv_type == '4'){
				continue;
			}
			else{

			$designation = $data['designation'];
			$result = $this->Renewal_Model->insertdata($userid,$designation,'2');
			$invoice_id = $result['invoice_id'];
			$cocorder_id = $result['cocorder_id'];
			
			if ($invoice_id) {
				$inid 				= $cocorder_id;
				$inv_id 			= $invoice_id;

				$userdata1	= 	$this->Plumber_Model->getList('row', ['id' => $userid]);

				$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '1'])->get()->row_array();

				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoice_id])->get()->row_array();

		 		// invoice PDF
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$amount =	$rowData['total_due']*$rowData['quantity'];
				$invoiceDate = date("d-m-Y", strtotime($rowData['created_at']));
				
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
					$total_subtotal = $rowData['total_due'];

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
					$stringaarr6 = isset($stringaarr[6]) ? $stringaarr[6] : '';
					$stringaarr5 = isset($stringaarr[5]) ? $stringaarr[5] : '';
					$stringaarr4 = isset($stringaarr[4]) ? $stringaarr[4] : '';
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
					<p>'.$rowData2['name'].'</p>
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
					<p>'.$stringaarr6.'</p>
					<p>'.$stringaarr5.'</p>
					<p>'.$stringaarr4.'</p>
					<p>'.$rowData['home_phone'].'</p>
					<p>'.$rowData['email2'].'</p>
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
					<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">PIRB year registration fee for {catagory Desigantion} for '.$rowData['name'].''.$rowData['surname'].', registration number '.$rowData['registration_no'].'</p>				
					<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">'.$rowData['quantity'].'</p>
					<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$rowData['cost_value'].'</p>
					<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</p>
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

									

					$pdfFilePath = $inv_id.'.pdf';
					$filePath = FCPATH.'assets/inv_pdf/';
			
					$dompdf = new DOMPDF();

					$dompdf->loadHtml($html);
					$dompdf->setPaper('A4', 'portrait');
					$dompdf->render();
					$output = $dompdf->output();
					file_put_contents($filePath.$pdfFilePath, $output);
					//$this->pdf->stream($pdfFilePath);

									
					$cocTypes = $orders['coc_type'];
					$mail_date = date("d-m-Y", strtotime($orders['created_at']));

					$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];

					$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

					$body = str_replace($array1, $array2, $template['email_body']);

					if ($template['email_active'] == '1') {
						// echo $userdata1['email'].": ".$filePath.$pdfFilePath."</br>";
						$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$filePath.$pdfFilePath);						
					}	

				}			 

			}
			
		}
		
	}

	public function Alert2()
	{	
		$result = $this->Renewal_Model->getUserids_alert2();	
		// echo '<pre>'; print_r($result); die;	
		foreach($result as $data)
		{
			
			$userid = $data['id'];
			$designation = $data['designation'];
			$invoice_id = $data['inv_id'];

			$delete_result = $this->Renewal_Model->deleteid($invoice_id);

			$designation = $data['designation'];
			$insert_result = $this->Renewal_Model->insertdata($userid,$designation,'3');
			$invoice_id = $insert_result['invoice_id'];
			$cocorder_id = $insert_result['cocorder_id'];
			
			if ($invoice_id) {
				$inv_id 			= $invoice_id;

				$userdata1	= 	$this->Plumber_Model->getList('row', ['id' => $userid]);

				$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '2'])->get()->row_array();

				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoice_id])->get()->row_array();

		 		// invoice PDF
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$amount =	$rowData['total_due']*$rowData['quantity'];
				$invoiceDate = date("d-m-Y", strtotime($rowData['created_at']));
				
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
				$total_subtotal = $rowData['total_due'];

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
				$stringaarr6 = isset($stringaarr[6]) ? $stringaarr[6] : '';
				$stringaarr5 = isset($stringaarr[5]) ? $stringaarr[5] : '';
				$stringaarr4 = isset($stringaarr[4]) ? $stringaarr[4] : '';
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
				<p>'.$rowData2['name'].'</p>
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
				<p>'.$stringaarr6.'</p>
				<p>'.$stringaarr5.'</p>
				<p>'.$stringaarr4.'</p>
				<p>'.$rowData['home_phone'].'</p>
				<p>'.$rowData['email2'].'</p>
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
				<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">PIRB year registration fee for {catagory Desigantion} for '.$rowData['name'].''.$rowData['surname'].', registration number '.$rowData['registration_no'].'</p>				
				<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">'.$rowData['quantity'].'</p>
				<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$rowData['cost_value'].'</p>
				<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</p>
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

								

				$pdfFilePath = $inv_id.'.pdf';
				$filePath = FCPATH.'assets/inv_pdf/';
		
				$dompdf = new DOMPDF();

				$dompdf->loadHtml($html);
				$dompdf->setPaper('A4', 'portrait');
				$dompdf->render();
				$output = $dompdf->output();
				file_put_contents($filePath.$pdfFilePath, $output);
				//$this->pdf->stream($pdfFilePath);

								
				$cocTypes = $orders['coc_type'];
				$mail_date = date("d-m-Y", strtotime($orders['created_at']));

				$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];

				$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

				$body = str_replace($array1, $array2, $template['email_body']);

				if ($template['email_active'] == '1') {
					// echo $userdata1['email'].": ".$filePath.$pdfFilePath."</br>";
					$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$filePath.$pdfFilePath);						
				}	

			}
			
		}
		
	}

	public function Alert3()
	{	
		$result = $this->Renewal_Model->getUserids_alert3();			
		// echo '<pre>'; print_r($result); die;	
		foreach($result as $data)
		{						
			$userid = $data['id'];
			$designation = $data['designation'];
			$invoice_id = $data['inv_id'];

			$delete_result = $this->Renewal_Model->deleteid($invoice_id);

			$designation = $data['designation'];
			$insert_result = $this->Renewal_Model->insertdata($userid,$designation,'4');
			$invoice_id = $insert_result['invoice_id'];
			$cocorder_id = $insert_result['cocorder_id'];
			$cocorder_id2 = $insert_result['cocorder_id2'];
			
			if ($invoice_id) {
				$inv_id 			= $invoice_id;

				$userdata1	= 	$this->Plumber_Model->getList('row', ['id' => $userid]);

				$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '3'])->get()->row_array();

				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoice_id])->get()->row_array();

				$lateamount_result = $this->db->select('*')->from('coc_orders')->where(['id' => $cocorder_id2])->get()->row_array();
				$lateamount = $lateamount_result['cost_value'];
				$total_lateamount = $lateamount_result['total_due'];
				$vat_lateamount = $lateamount_result['vat'];

		 		// invoice PDF
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$amount =	$rowData['total_due']*$rowData['quantity'];
				$invoiceDate = date("d-m-Y", strtotime($rowData['created_at']));
				
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
				$total_subtotal = $rowData['cost_value']+$lateamount;
				$total_vatamount = $rowData['vat']+$vat_lateamount;
				$total = $rowData['total_due']+$total_lateamount;

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
				$stringaarr6 = isset($stringaarr[6]) ? $stringaarr[6] : '';
				$stringaarr5 = isset($stringaarr[5]) ? $stringaarr[5] : '';
				$stringaarr4 = isset($stringaarr[4]) ? $stringaarr[4] : '';
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
				<p>'.$rowData2['name'].'</p>
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
				<p>'.$stringaarr6.'</p>
				<p>'.$stringaarr5.'</p>
				<p>'.$stringaarr4.'</p>
				<p>'.$rowData['home_phone'].'</p>
				<p>'.$rowData['email2'].'</p>
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
				<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">PIRB year registration fee for {catagory Desigantion} for '.$rowData['name'].''.$rowData['surname'].', registration number '.$rowData['registration_no'].'</p>				
				<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">'.$rowData['quantity'].'</p>
				<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$rowData['cost_value'].'</p>
				<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</p>
				</div>
				
				<div style="border-bottom: 1px solid #000; padding: 0 20px 0 20px;">
				<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">Late Penalty Fee</p>				
				<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">1</p>
				<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$lateamount.'</p>
				<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$lateamount.'</p>
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
				<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">VAT Total</p>
				<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$total_vatamount.'</p>
				</p>
				<p>
				<p style="width: auto; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">Total</p>
				<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$total.'</p>
				</p>
				</p>
				</td>
				</tr>
				</tbody>
				</table>


				</body>
				</html>';

								

				$pdfFilePath = $inv_id.'.pdf';
				$filePath = FCPATH.'assets/inv_pdf/';
		
				$dompdf = new DOMPDF();

				$dompdf->loadHtml($html);
				$dompdf->setPaper('A4', 'portrait');
				$dompdf->render();
				$output = $dompdf->output();
				file_put_contents($filePath.$pdfFilePath, $output);
				//$this->pdf->stream($pdfFilePath);

								
				$cocTypes = $orders['coc_type'];
				$mail_date = date("d-m-Y", strtotime($orders['created_at']));

				$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];

				$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

				$body = str_replace($array1, $array2, $template['email_body']);

				if ($template['email_active'] == '1') {
					// echo $userdata1['email'].": ".$filePath.$pdfFilePath."</br>";
					$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$filePath.$pdfFilePath);						
				}	

			}
			
		}
		
	}

	public function Alert4()
	{	
		$result = $this->Renewal_Model->getUserids_alert4();		
		// echo '<pre>'; print_r($result); die;	
		foreach($result as $data)
		{						
			$userid = $data['id'];  
			$request['status'] = '0';
			$this->db->update('users_detail', $request, ['user_id' => $userid]);
			
			$request1['status'] = '2';
			$this->db->update('users', $request1, ['id' => $userid]);

			$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '3'])->get()->row_array();
			 
			$mail_date = date("d-m-Y");
			$array1 = ['{Plumbers Name and Surname}','{date of purchase}'];
			$array2 = [$data['name']." ".$data['surname'], $mail_date];

			$body = str_replace($array1, $array2, $template['email_body']);

			if ($template['email_active'] == '1') {					
				$this->CC_Model->sentMail($data['email'],$template['subject'],$body);						
			}	
			
		}
		
	}
	
	public function DTAccounts()
	{
		$post 			= $this->input->post();
		$post['status'] = '1';
		$totalcount 	= $this->Renewal_Model->getList('count',$post);
		$results 		= $this->Renewal_Model->getList('all', $post);
		
		$totalrecord 	= [];
		if(count($results) > 0)
		{	
			foreach($results as $result)
			{
				$internal_inv = "";
				$originalDate=$result['created_at'];
				$newDate = date("d-m-Y", strtotime($originalDate));
				if($result['status'] == '1'){
					$status = "Paid";
					$internal_inv = $result['internal_inv'];
				}
				else{
					$status = "Unpaid";
					if($result['userstatus'] == '1'){
						$internal_inv = '<div class="table-action"><a href="'.base_url().'admin/accounts/renewal_plumber/Index/Deletefunc/'.$result['inv_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></div>';
					}
				}

				$totalrecord[] = 	[      
					'inv_id' 		=> 	$result['inv_id'],
					'created_at'    =>  $newDate,
					'name' 		    => 	$result['name'].' '.$result['surname'],
					'registration_no' => $result['registration_no'],
					'description'   =>  $result['description'],
					'total_cost'    => 	$result['total_cost'],
					'action'	    => 	'

					<div class="col-md-6">
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf" >
					<img src="'.base_url().'assets/images/pdf.png" height="50" width="50">
					</div></a>

					',

					'status'    		=> 	$status,
					'internal_inv' 		=> 	$internal_inv

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


