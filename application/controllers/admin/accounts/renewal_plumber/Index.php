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

	public function DTAccounts()
	{
		$post 			= $this->input->post();
		$post['status'] = '1';
		$totalcount 	= $this->Renewal_Model->getList('count',$post);
		$results 		= $this->Renewal_Model->getList('all', $post);
		// echo json_encode($totalcount); die;
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
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf"  target="_blank">
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

	public function Deletefunc($id)
	{		
		$result = $this->Renewal_Model->deleteid($id);
		if($result == '1'){
			$url = FCPATH."assets/inv_pdf/".$id.".pdf";
			unlink($url);
			$this->session->set_flashdata('success', 'Record was Deleted');
		}
		else{
			$this->session->set_flashdata('error', 'Error to delete the Record.');		
		}

		$this->index();
		redirect('admin/accounts/renewal_plumber/Index/'); 
	}

	public function Cron()
	{	
		$result = $this->Renewal_Model->getUserids();
		
		// echo '<pre>'; print_r($result); die;
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
			$renewal_date1 = $data['expirydate'];
			$rdate = strtotime($renewal_date1);
			$new_date = strtotime('+ 1 year', $rdate);
			$renewal_date =  date('d/m/Y', $new_date);


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

					$designation	=	$this->config->item('designation2')[$rowData['designation']];
					
					$html = '<!DOCTYPE html>
					<html>
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
							<img class="logo" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png">					
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
					<table class="comp_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
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

					</tr>

					<tr>
					<td>
					<table class="bill_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
						<thead>
							<tr>
							<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Billing Details</th>
							</tr>
						</thead>

						<tbody>
					<tr><td>'.$rowData['address'].'</td></tr>            
					<tr><td>'.$stringaarr6.'</td></tr>
					<tr><td>'.$stringaarr5.'</td></tr>
					<tr><td>'.$stringaarr4.'</td></tr>
					<tr><td>'.$rowData['home_phone'].'</td></tr>
					<tr><td>'.$rowData['email2'].'</td></tr>
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
								<th style="border-bottom: 1px solid #000; padding:5px 10px;text-align: center;">
								Terms
								</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center; padding:5px 10px;">
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
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">PIRB year registration fee for '.$designation.' for '.$rowData['username'].''.$rowData['surname'].', registration number '.$rowData['registration_no'].'</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$rowData['quantity'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
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
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Sub Total</td>					
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$rowData['cost_value'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">VAT Total</td>
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$rowData['vat'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$rowData['total_due'].'</td>
					</tr>

					</tbody>
					</table>
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

					$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}','{renewal_date}'];

					$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype2')[$cocTypes],$renewal_date];

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

				$designation	=	$this->config->item('designation2')[$rowData['designation']];
				
				$html = '<!DOCTYPE html>
				<html>
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
							<img class="logo" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png">					
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
					<table class="comp_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
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

					</tr>

					<tr>
					<td>
					<table class="bill_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
						<thead>
							<tr>
							<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Billing Details</th>
							</tr>
						</thead>

						<tbody>
					<tr><td>'.$rowData['address'].'</td></tr>            
					<tr><td>'.$stringaarr6.'</td></tr>
					<tr><td>'.$stringaarr5.'</td></tr>
					<tr><td>'.$stringaarr4.'</td></tr>
					<tr><td>'.$rowData['home_phone'].'</td></tr>
					<tr><td>'.$rowData['email2'].'</td></tr>
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
								<th style="border-bottom: 1px solid #000; padding:5px 10px;text-align: center;">
								Terms
								</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center; padding:5px 10px;">
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
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">PIRB year registration fee for '.$designation.' for '.$rowData['username'].''.$rowData['surname'].', registration number '.$rowData['registration_no'].'</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$rowData['quantity'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
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
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Sub Total</td>					
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$rowData['cost_value'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">VAT Total</td>
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$rowData['vat'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$rowData['total_due'].'</td>
					</tr>

					</tbody>
					</table>
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

				$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype2')[$cocTypes]];

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

				$stringaarr1 = explode("@-@",$rowData['areas']);
				$stringaarr = explode("@@@",$stringaarr1[0]);
				$stringaarr6 = isset($stringaarr[6]) ? $stringaarr[6] : '';
				$stringaarr5 = isset($stringaarr[5]) ? $stringaarr[5] : '';				
				$stringaarr4 = isset($stringaarr[4]) ? $stringaarr[4] : '';
				$provincesettings = explode("@@@",$rowData2['provincesettings']);

				$designation	=	$this->config->item('designation2')[$rowData['designation']];
				
				$html = '<!DOCTYPE html>
				<html>
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
							<img class="logo" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png">					
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
					<table class="comp_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
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

					</tr>

					<tr>
					<td>
					<table class="bill_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
						<thead>
							<tr>
							<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Billing Details</th>
							</tr>
						</thead>

						<tbody>
					<tr><td>'.$rowData['address'].'</td></tr>            
					<tr><td>'.$stringaarr6.'</td></tr>
					<tr><td>'.$stringaarr5.'</td></tr>
					<tr><td>'.$stringaarr4.'</td></tr>
					<tr><td>'.$rowData['home_phone'].'</td></tr>
					<tr><td>'.$rowData['email2'].'</td></tr>
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
								<th style="border-bottom: 1px solid #000; padding:5px 10px;text-align: center;">
								Terms
								</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center; padding:5px 10px;">
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
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">PIRB year registration fee for '.$designation.' for '.$rowData['username'].''.$rowData['surname'].', registration number '.$rowData['registration_no'].'</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$rowData['quantity'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
					</tr>
					<tr>
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Late Penalty Fee</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">1</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$lateamount.'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$lateamount.'</td>
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
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Sub Total</td>					
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$total_subtotal.'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">VAT Total</td>
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$total_vatamount.'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$total.'</td>
					</tr>

					</tbody>
					</table>
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

				$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype2')[$cocTypes]];

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
			$request['status'] = '3';
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
	
}


