<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Index extends CC_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
		$this->load->model('Plumber_Model');
	 	$this->load->model('Coc_Model');

	 	$this->checkUserPermission('23', '1');

	}

	public function index($pagestatus='',$id='')
	{	
		
		if($this->input->post()){

			$this->checkUserPermission('23', '2', '1');

			$requestData 	= 	$this->input->post();	
			$requestData['status']	= '1';	
			$id	= $requestData['editid'];			
			$data 	=  $this->Auditor_Model->action2($requestData);
			if($data) $message = 'Records '.(($id=='') ? 'created' : 'updated').' successfully.';	

			if(isset($data)){
				$this->session->set_flashdata('success', $message);
				$this->generatepdf($id);
			}			
			else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			redirect('admin/accounts/auditorsinvoices/index'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/accounts/auditorsinvoices/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	
	public function DTAccounts()
	{
		$post 			= $this->input->post();
		// $post['adminsearch'] = '1';
		
		$totalcount 	= $this->Auditor_Model->getInvoiceList('count',$post);
		$results 		= $this->Auditor_Model->getInvoiceList('all', $post);

		$checkpermission	=	$this->checkUserPermission('23', '2');

		// echo json_encode($totalcount); die;
		$totalrecord 	= [];
		if(count($results) > 0)
		{	
			foreach($results as $result)
			{
				$internal_inv = "";	
				$originalDate = isset($result['created_at']) && $result['created_at']!='1970-01-01' && $result['created_at']!='0000-00-00' ? date('d-m-Y', strtotime($result['created_at'])) : '';
				if($result['status'] == '0'){

					if($checkpermission){
					$internal_inv = '<form class="form" method="post"><div class="table-action"><input type="text" name="internal_inv"><input type="hidden" name="editid" value="'.$result['inv_id'].'"><a href="'.base_url().'admin/accounts/auditorsinvoices/index/index" data-toggle="tooltip" data-placement="top" title="Update"><input type="submit" value="Update"></i></a></div></form>';
				}else{
					$internal_inv = '';
				}

					$status = "Unpaid";
					
				}
				elseif($result['status'] == '1'){
					$status = "Paid";
					$internal_inv = $result['internal_inv'];
				}

				$action = '
					<div class="col-md-6">
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf"  target="_blank">
					<img src="'.base_url().'assets/images/pdf.png" height="50" width="50">
					</div></a>
					';

					if ($result['total_cost']!='') {
      $amt = $this->config->item('currency').' '.$result['total_cost'];
      }else{
      	$amt = $result['total_cost'];
      }
				
				if($result['status'] != '2'){
					$totalrecord[] = 	[      
						'inv_id' 		=> 	$result['inv_id'],
						'created_at'    =>  $originalDate,
						'name' 		    => 	$result['name'].' '.$result['surname'],
						'description'   =>  $result['description'],
						'total_cost'    => 	$amt,
						'action'	    => 	$action,

						'status'    		=> 	$status,
						'internal_inv' 		=> 	$internal_inv

					];
				}
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

	public function generatepdf($inv_id)
	{

		$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
		$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $inv_id, 'status' => ['0','1']]);
		$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id, 'status' => ['0','1']]);
		$amount =	$rowData['total_due']*$rowData['quantity'];
		$invoiceDate = date("d-m-Y", strtotime($rowData['invoice_date']));
		
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

				$paid = "<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/paid.png>";
				$paid_status = "PAID";

			}
			else{

				$paid ="<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/unpaid.png>";
				$paid_status = "UNPAID";

			}

			$stringaarr = explode("@@@",$rowData['areas']);
			$stringaarr6 = isset($stringaarr[6]) ? $stringaarr[6] : '';
			$stringaarr5 = isset($stringaarr[5]) ? $stringaarr[5] : '';
			$stringaarr4 = isset($stringaarr[4]) ? $stringaarr[4] : '';
			$provincesettings = explode("@@@",$rowData2['provincesettings']);

			$designation	=	$this->config->item('designation2')[$rowData['designation']];
			$currency    = $this->config->item('currency');
			$html = '<!DOCTYPE html>
					<html>
					<head>
					<title>PDF Invoice Auditor</title>
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
						<img class="paid" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/uploads/auditor/'.$rowData['file2'].'">
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
					<td>
					<table class="bill_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
						<thead>
							<tr>
							<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">'.$rowData['company_name'].'</th>
							</tr>
						</thead>

					<tbody>
					<tr><td>'.$rowData['address'].'</td></tr>            
					<tr><td>'.$rowData['suburb'].'</td></tr>
					<tr><td>'.$rowData['city'].'</td></tr>
					<tr><td>'.$rowData['province'].'</td></tr>
					<tr><td>'.$rowData['home_phone'].'</td></tr>
					<tr><td>'.$rowData['email2'].'</td></tr>
						</tbody>
					</table>
					
					</td>

					<td>
						<img class="paid" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/paid.png">
					</td>
					</tr>

					<tr>
					<td style="vertical-align: top;">
					<table class="comp_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 200px;">
						<thead>
							<tr>
								<th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Name / Address</th>
							</tr>
						</thead>

						<tbody>
					<tr><td>Plumbing Industry Registration Board</td></tr>
					<tr><td>'.$rowData2['address'].'</td></tr>            
					<tr><td>'.$rowData2['name'].'</td></tr>
					<tr><td>'.$rowData2['suburb'].'</td></tr>
					<tr><td>'.$rowData2['city'].'</td></tr>
					<tr><td>'.$rowData1['work_phone'].'</td></tr>
					<tr><td>'.$rowData1['email'].'</td></tr>															
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
								<th style="border-bottom: 1px solid #000; padding:5px 20px;text-align: center;">
								Terms
								</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center; padding:5px 20px;">
									30 Days	
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
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">'.$rowData['description'].'</td>
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">1</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$rowData['cost_value'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$rowData['cost_value'].'</td>
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
								<tr><td>'.$rowData['bank_name'].'</td></tr>            
								<tr><td>'.$rowData['branch_code'].'</td></tr>
								<tr><td>'.$rowData['account_name'].'</td></tr>
								<tr><td>'.$rowData['account_no'].'</td></tr>
								<tr><td>'.$rowData['account_type'].'</td></tr>
							</tbody>
						</table>
					</td>

					<td style="vertical-align: top;">
					<table align="right" class="total_uniq" style="margin-top: 10px;">
					<tbody>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Sub Total</td>					
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$currency.$rowData['cost_value'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">VAT Total</td>
					<td style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$currency.$rowData['vat'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 5px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 10px 15px; border: 1px solid #000; padding: 0 30px 0 30px;">'.$currency.$rowData['total_due'].'</td>
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
	}

}


