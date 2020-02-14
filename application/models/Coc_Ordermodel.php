<?php

class Coc_Ordermodel extends CC_Model
{
	public function getCocorderList($type, $requestdata){

		$this->db->select('t1.*');
		// $this->db->select('t1.*,t2.name,t2.surname,t3.type, t3.address, t4.type, cc.count');
		$this->db->from('coc_orders t1');
		$this->db->join('users_detail t2', 't1.user_id=t2.user_id', 'left');
		$this->db->join('users_address t3', 't1.user_id=t3.user_id AND t3.type="2"', 'left');
		$this->db->join('users t4', 't1.user_id=t4.id', 'left');
		$this->db->join('coc_count cc', 'cc.user_id=t1.user_id','left');		

		if(isset($requestdata['id'])) 				$this->db->where('inv_id', $requestdata['id']);
		$this->db->where('admin_status', '0');

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id','inv_id','created_at','status','user_id','coc_type','delivery_type'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);	
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('name', $searchvalue);
		}
			 			
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function action($data){

		if(isset($data['quantity'])) 		$requestdata['description'] 	= 'Purchase of '.$data['quantity'].' PIRB Certificate of Compliance';	
		if(isset($data['created_at'])) 	    $requestdata['created_at'] 		= date('Y-m-d H:i:s', strtotime($data['created_at']));
		if(isset($data['user_id']))			$requestdata['user_id'] 		= $data['user_id'];	
		if(isset($data['order_id']))			$requestdata['inv_id'] 		= $data['order_id'];	
		if(isset($data['coc_type'])) 		$requestdata['coc_type'] 		= $data['coc_type'];
		if(isset($data['delivery_type'])) 	$requestdata['delivery_type'] 	= $data['delivery_type'];
		if(isset($data['status'])) 			$requestdata['status'] 			= $data['status'];
		if(isset($data['internal_inv'])) 	$requestdata['internal_inv'] 	= $data['internal_inv'];
		if(isset($data['total_due'])) 		$requestdata['total_cost'] 	 	= $data['total_due'];
		if(isset($data['tracking_no'])) 	$requestdata['tracking_no']  	= $data['tracking_no'];

		
		if(isset($requestdata)){	

			if(isset($data['total_due'])) unset($requestdata['total_cost']);

			$requestdata1 			= 	$requestdata;			
			if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];
			if(isset($data['cost_value'])) 		$requestdata1['cost_value'] 	= $data['cost_value'];
			if(isset($data['delivery_cost'])) 	$requestdata1['delivery_cost'] 	= $data['delivery_cost'];
			if(isset($data['vat'])) 		    $requestdata1['vat'] 			= $data['vat'];
			if(isset($data['total_due'])) 		$requestdata1['total_due'] 		= $data['total_due'];
			$requestdata1['admin_status'] 	= (isset($data['admin_status']) && $data['admin_status']='on') ? '2' : '0';

			if(isset($requestdata['inv_id']) && $requestdata['inv_id']!=''){		
				$result1 = $this->db->update('invoice', $requestdata,['inv_id'=>$requestdata['inv_id']]);				
				
				$result = $this->db->update('coc_orders', $requestdata1,['inv_id'=>$requestdata['inv_id']]);
			} else {
				$result1 = $this->db->insert('invoice', $requestdata);
				$inv_id = $this->db->insert_id();

				if(isset($data['total_due'])) unset($requestdata['total_cost']);
			
				$requestdata1 			= 	$requestdata;			
				$requestdata1['inv_id']	=	$inv_id;	
				if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];
				if(isset($data['cost_value'])) 		$requestdata1['cost_value'] 	= $data['cost_value'];
				if(isset($data['delivery_cost'])) 	$requestdata1['delivery_cost'] 	= $data['delivery_cost'];
				if(isset($data['vat'])) 		    $requestdata1['vat'] 			= $data['vat'];
				if(isset($data['total_due'])) 		$requestdata1['total_due'] 		= $data['total_due'];
				
				$result = $this->db->insert('coc_orders', $requestdata1);

				$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $requestdata['user_id']]);

				$request['status'] 		= 	'1';
				 if ($inv_id) {
					$result 			= $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $requestdata['user_id']]);
				 	$result 			= $this->db->update('coc_orders', $request, ['id' => $inv_id,'user_id' => $requestdata['user_id'] ]);

				 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

				 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $requestdata['user_id']])->order_by('id','desc')->get()->row_array();
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

		        	 $paid = "<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/paid.jpg>";
		        	 $paid_status = "PAID";
		        	
		        }
		        else{

		        	$paid ="<img style='width: 290px' src='".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/unpaid2.jpg>";
		        	$paid_status = "UNPAID";
		        	
		        }
		        $stringaarr = explode("@@@",$rowData['areas']);
		        $provincesettings = explode("@@@",$rowData2['provincesettings']);
		        $province_arr = explode('@-@', $provincesettings[1]);
		        $province = $province_arr[0];



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
							<p>'.$province.'</p>
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
			}
		}
		return $result;
	}

	
	public function autosearchPlumber($postData){
		
		$this->db->select('concat(ud.name, " ", ud.surname) as name,cc.count,u.id,up.coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3']);
		$this->db->where_in('up.designation', ['4','5','6']);
		$this->db->like('ud.name',$postData['search_keyword']);
		$this->db->or_like('ud.surname',$postData['search_keyword']);
		$this->db->group_by("ud.id");
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	public function autosearchReseller($postData){
		
		// $this->db->select('concat(ud.name, " ", ud.surname) as name,cc.count,u.id, "0" as coc_electronic');
		$this->db->select('ud.company as name,cc.count,u.id, "0" as coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '6']);
		$this->db->like('ud.name',$postData['search_keyword']);
		$this->db->or_like('ud.surname',$postData['search_keyword']);
		$this->db->or_like('ud.company',$postData['search_keyword']);
		$this->db->group_by("ud.id");
		
		$query = $this->db->get();
		$result = $query->result_array();
			
		return $result;
	}

	
}
