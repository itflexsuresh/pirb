<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Accounts_Model');
	}
	
	public function index()
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Accounts_Model->action($requestData);
				if($data) $message = 'Plumber COC Invoices Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Accounts_Model->changestatus($requestData);
				$message		= 	'Plumber COC Invoices deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/accounts/Accounts/'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('plumber/myaccounts/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTAccounts()
	{
		$post 			= $this->input->post();
		
		$userid 		= $this->getUserID();

		$userdata1		= $this->Plumber_Model->getList('row', ['id' => $userid]);
		
		$totalcount 	= $this->Accounts_Model->getList('count', ['user_id' => $userid]+$post);
		$results 		= $this->Accounts_Model->getList('all', ['user_id' => $userid]+$post);
		
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$invoicestatus = 	isset($this->config->item('payment_status2')[$result['status']]) ? $this->config->item('payment_status2')[$result['status']] : '';
				
				if($result['status']=='0'){
					$this->session->set_userdata('pay_purchaseorder', $result['inv_id']);

					$action = 	'
									<input type="hidden" id="feeamt" value="'.$result['total_cost'].'">
									<input type="hidden" id="name" value="'.$userdata1['name'].'">
									<input type="hidden" id="surname" value="'.$userdata1['surname'].'">
									<input type="hidden" id="usremail" value="'.$userdata1['email'].'">
									<i class="fa fa-credit-card payfastpayment">									
									<script>
									$(".payfastpayment").click(function(){
									$("#name_first").val($("#name").val());
									$("#name_last").val($("#surname").val());
									$("#totaldue1").val($("#feeamt").val());
									$("#email_address").val($("#usremail").val());
									$( "#paymentsubmit" ).trigger( "click" );								
									
								});
								</script></i>
								';
				}else{
					$action = 	'';	
				}
				
				$totalrecord[] = 	[      
										'description' 	=> 	$result['description'],
										'invoiceno' 	=> 	$result['inv_id'],
										'invoicedate' 	=> 	date('d-m-Y', strtotime($result['created_at'])),
										'invoicevalue' 	=> 	$result['total_cost'],
										'invoicestatus' => 	$invoicestatus,
										'orderstatus' 	=> 	'',			
							     		'action'	    => 	'
																<div class="col-md-6">
																	<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf" ><img src="'.base_url().'assets/images/pdf.png" height="50" width="50"></a>
																	'.(isset($action) ? $action : '').'
																</div>'
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
	
	public function getPDF1($id){
		
 
		if($id!=''){
		
			$rowData = $this->Accounts_Model->getList('row', ['id' => $id, 'status' => ['0','1','7','8','9']]);

			$rowData1 = $this->Accounts_Model->getPermissions('row', ['id' => $id, 'status' => ['0','1','7','8','9']]);
			$rowData2 = $this->Accounts_Model->getPermissions1('row', ['id' => $id, 'status' => ['0','1','7','8','9']]);

           $amount=$rowData['total_due']*$rowData['quantity'];

           $invoiceDate = date("d-m-Y", strtotime($rowData['created_at']));


           $base_url= base_url();

         

        if($rowData["status"]=='paid'){

        	 $paid = "<img src='".$base_url."/assets/images/paid.jpg'>";
        	
        }
        else{

        	$paid ="<img style='width: 290px' src='".$base_url."/assets/images/unpaid.jpg'>";
        	
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

<table style="width: 70%; margin: 0 auto; border: 1px solid #000; padding: 0 10px 0 10px;">
	<tbody>
		<tr>
			<td style="text-align: left;">
				<img class="logo" style="width: 250px;" src="'.$base_url.'/assets/images/pitrb-logo.png">
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
           '.$paid.'
        
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
						<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">Purchase of {number} PIRB Certificate of Compliance</p>
						<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;">'.$rowData['quantity'].'</p>
						<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;">'.$rowData['total_due'].'</p>
						<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$amount.'</p>
					</div>
					<div style="padding: 0 20px 0 20px;">
						<p style="width: 50%; display: inline-block; border-right: 1px solid #000; margin: 0;    padding: 10px 0 10px 0;">Courier/Regsitered Post Fee</p>
						<p style="width: 10%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000;text-align: center;"></p>
						<p style="width: 19%;display: inline-block; margin: 0; padding: 10px 0 10px 0;    border-right: 1px solid #000; text-align: center;"></p>
						<p style="width: 18%; display: inline-block; margin: 0; padding: 10px 0 10px 0;    text-align: center;"></p>
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
				<div style="text-align: center; border: 1px solid #000; width: 50%; float: right; margin-right: 20px;">
					<div style="border-bottom: 1px solid #000;">
						<p style="width: 47%; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">Sub Total</p>
						<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;"></p>
					</div>
					<div style="border-bottom: 1px solid #000;">
						<p style="width: 47%; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">VAT Total</p>
						<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;"></p>
					</div>
					<div>
						<p style="width: 47%; display: inline-block; margin: 0; padding: 6px 0 6px 0;    border-right: 1px solid #000;">Total</p>
						<p style="width: 50%; display: inline-block; margin: 0; padding: 6px 0 6px 0;">'.$amount.'</p>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>


</body>
</html>';

          
                $pdfFilePath = "download.pdf";
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				$this->pdf->stream($pdfFilePath);
			//}
		}		
	}

	/// Payments

	public function returnurl(){
		$userid = $this->getUserID();
		$invId 	= $this->session->userdata('pay_purchaseorder');
		$requestData['status'] = '1';
		$query = $this->db->update('invoice', $requestData, ['inv_id' => $invId,'user_id' => $userid]);
		if ($query) {
			$this->session->set_flashdata('success','Registration Renewed Sucessfully.');
			redirect('plumber/profile/Index');
		}
		
	}
	public function cancelurl(){
		$this->session->set_flashdata('success','Payement Cancel.');
		redirect('plumber/profile/Index');
	}
	public function notifyurl(){
		$this->session->set_flashdata('success','Registration Renewed Sucessfully.');
		redirect('plumber/profile/Index');
	}
}
