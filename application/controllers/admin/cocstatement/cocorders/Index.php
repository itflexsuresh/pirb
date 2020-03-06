<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Ordermodel');
		$this->load->model('CC_Model');
		$this->load->model('Rates_Model');
		$this->load->model('Systemsettings_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Coc_Model');
		$this->load->model('Ordercomments_Model');
		$this->load->model('Stock_Model');
	}
	
	public function index($id='')
	{
		$pagedata['closed_status'] = '';
		if($id!='' && $id!='closed'){
			$result = $this->Coc_Ordermodel->getCocorderList('row', ['id' => $id]);
			$comments = $this->Ordercomments_Model->getCommentsList('all', ['order_id' => $id]);
			
			if($result['coc_type']=='2'){
				$stock = $this->Stock_Model->getRange('all',[],$result['quantity']);
				if($stock){
					$pagedata['stock'] = $stock;
				}
			} 

			if($comments){
				$pagedata['comments'] = $comments;
			}
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/cocstatement/cocorders/index'); 
			}
		} else if($id!='' && $id=='closed'){
			$pagedata['closed_status'] = 'closed';
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			//print_r($requestData);die;
			if($this->input->post('submit')){

				$data 			=  	$this->Coc_Ordermodel->action($requestData);
				if($data) $this->session->set_flashdata('success', 'Order saved successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
			
				redirect('admin/cocstatement/cocorders/index'); 			
			} 
			if($this->input->post('allocate_certificate')){
				$data 			=  	$this->Stock_Model->action($requestData);	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $requestData['user_id']]);

				 if ($data) {

				 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

				 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $requestData['user_id']])->order_by('id','desc')->get()->row_array();

				// invoice PDF
				 	$rowData = $this->Coc_Model->getListPDF('row', ['id' => $data, 'status' => ['0','1']]);

							$rowData1 = $this->Coc_Model->getPermissions('row', ['id' => $data, 'status' => ['0','1']]);
							$rowData2 = $this->Coc_Model->getPermissions1('row', ['id' => $data, 'status' => ['0','1']]);

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
		           			if(!isset($delivery_rate['amount'])){
		           				$delivery_rate['amount'] = 0;
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
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$PDF_rate['amount'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.$rowData['cost_value'].'</td>
					</tr>

					<tr>
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Courier/Regsitered Post Fee</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$delivery_rate['amount'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$delivery_rate['amount'].'</td>
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
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$currency.$rowData['cost_value'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">VAT Total</td>
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

		          
		                $pdfFilePath = ''.$data.'.pdf';
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
			 	}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if($data) $this->session->set_flashdata('success', 'Order allocated successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
			
				redirect('admin/cocstatement/cocorders/index'); 			
			}
		}

		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();	
		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();
		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['deliverycard']	= 	$this->config->item('purchasecocdelivery');
		$pagedata['coctype']		= 	$this->config->item('coctype');
		$pagedata['settings']		= 	$this->Systemsettings_Model->getList('row');
		$pagedata['cocpaperwork']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
		$pagedata['cocelectronic']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
		$pagedata['postage']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
		$pagedata['couriour']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
		$pagedata['collectedbypirb']= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb')]);

		$data['plugins']			= 	['validation', 'datepicker','datatables', 'datatablesresponsive', 'sweetalert'];
		$data['content'] 			= 	$this->load->view('admin/cocstatement/cocorders/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}


	public function DTCocOrder()
	{ 
		$post 			= $this->input->post();

		$totalcount 	= $this->Coc_Ordermodel->getCocorderList('count', ['status' => [$post['admin_status']]]+$post);
		$results 		= $this->Coc_Ordermodel->getCocorderList('all', ['status' => [$post['admin_status']]]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				$payment_status_1 = isset($this->config->item('payment_status')[$result['status']]) ? $this->config->item('payment_status')[$result['status']] : '';				
				$coctype = isset($this->config->item('coctype')[$result['coc_type']]) ? $this->config->item('coctype')[$result['coc_type']] : '';
				$deliverytype = isset($this->config->item('purchasecocdelivery')[$result['delivery_type']]) ? $this->config->item('purchasecocdelivery')[$result['delivery_type']] : '';
				if($result['type']=='6'){
					$name = $result['company'];
				} else {
					$name = $result['name']." ".$result['surname'];					
				}
				$totalrecord[] 	= 	[
										'id' 			=> 	$result['id'],
										'user_id' 		=> 	$name,
										'coc_type' 		=> 	$coctype,
										'delivery_type'	=> 	$deliverytype,
										'quantity' 		=> 	$result['quantity'],	
										'status' 		=> 	$payment_status_1,
										'inv_id' 		=> 	$result['inv_id'],
										'internal_inv' 	=> 	$result['internal_inv'],									
										'created_at'	=> 	date('d-m-Y', strtotime($result['created_at'])),
										'address' 		=> 	$result['address'],
										'tracking_no' 	=> 	$result['tracking_no'],																	
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/cocstatement/cocorders/index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit">
																	<i class="fa fa-pencil-alt"></i></a>																	
																</div>
															'														
									];

				
			}

			foreach ($totalrecord as $key => $value) {
				if($post['admin_status']=='closed'){
					unset($totalrecord[$key]['action']);	
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

	public function add_comments()
	{ 
		$post = $this->input->post();		
		$data 	=   $this->Ordercomments_Model->action($post);
		
		echo json_encode($data);
	}

}
