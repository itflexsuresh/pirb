<?php

class Stock_Model extends CC_Model
{
	public function getRange($type, $requestdata,$count=0){

		$this->db->select('t1.*');
		$this->db->from('stock_management t1');	

		// if(isset($requestdata['id'])) 				$this->db->where('order_id', $requestdata['id']);
		$this->db->where("user_id=0");
		$this->db->where("type='2'");
		// $this->db->where("user_id='NULL'",'OR');
		// $this->db->limit(1,0);
		// $this->db->order_by('id', 'ASC');	

		// SELECT * FROM `stock_management` WHERE user_id=0 || user_id=NULL ORDER BY id ASC LIMIT 0,1

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
			// elseif($type=='row') 	$result = $query->row_array();
			if($result){
			if($count>0){
				if($count==1){
					$result['allocate_start'] = $result[0]['id']; 
					$result['allocate_end'] = $result[0]['id']; 
				} else {
					
					$res_arr = array_column($result, 'id');
					foreach ($res_arr as $key => $val) {
						$arr_end = $val+($count-1);
					    $new_arr = range($val,$arr_end);    
					    $c = 0;
					    foreach($new_arr as $key1=>$val1){
					        if(in_array($val1,$res_arr)){
					            $c++;
					        }
					    }
					    if($c==$count){
					        $result['allocate_start'] = $val; 
							$result['allocate_end'] = $arr_end;
					        break;
					    }
					}
				}
			}
			}
		}
		
		return $result;
	}

	public function getResellerRange($type, $requestdata,$count=0){

		$this->db->select('t1.*');
		$this->db->from('stock_management t1');	
		// $user_id = $this->getUserId();
		// if(isset($requestdata['id'])) 				$this->db->where('order_id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 				$this->db->where('user_id', $requestdata['user_id']);
		// $this->db->where("user_id=$user_id");
		$this->db->where("coc_status='3'");
		$this->db->where("type='2'");
		// $this->db->where("user_id='NULL'",'OR');
		// $this->db->limit(1,0);
		// $this->db->order_by('id', 'ASC');	

		// SELECT * FROM `stock_management` WHERE user_id=0 || user_id=NULL ORDER BY id ASC LIMIT 0,1

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
			// elseif($type=='row') 	$result = $query->row_array();
			if($result){
			if($count>0){
				if($count==1){
					$result['allocate_start'] = $result[0]['id']; 
					$result['allocate_end'] = $result[0]['id']; 
				} else {
					
					$res_arr = array_column($result, 'id');
					foreach ($res_arr as $key => $val) {
						$arr_end = $val+($count-1);
					    $new_arr = range($val,$arr_end);    
					    $c = 0;
					    foreach($new_arr as $key1=>$val1){
					        if(in_array($val1,$res_arr)){
					            $c++;
					        }
					    }
					    if($c==$count){
					        $result['allocate_start'] = $val; 
							$result['allocate_end'] = $arr_end;
					        break;
					    }
					}
				}
			}
			}
		}
		
		return $result;
	}

	public function action($data){
		$requestdata['allocation_date'] = date('Y-m-d H:i:s');
		// if(isset($data['created_at'])) 	    $requestdata['created_at'] 		= date('Y-m-d H:i:s', strtotime($data['created_at']));
		if($data['type']=='3'){
			$requestdata['coc_status'] 		= '4';	
		} 
		else if($data['type']=='6'){
			$requestdata['coc_status'] 		= '3';	
		}
		if(isset($data['coc_type'])) $requestdata['type']	= $data['coc_type'];
		if(isset($data['user_id'])) $requestdata['user_id']	= $data['user_id'];
		// if(isset($data['coc_count'])) $requestdata['coc_count']	= $data['coc_count'];

		$requestdata1['admin_status']	= '1';

		if(isset($data['order_id'])) $inv_id	= $data['order_id'];

		if(isset($requestdata)){
			if(isset($data['coc_type'])){
				if($data['coc_type']==1){
					for($i=1;$i<=$data['coc_count'];$i++){
						$result1 = $this->db->insert('stock_management', $requestdata);
						$this->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $data['user_id'], 'action' => '6', 'type' => '1']);
					}		
				} else if($data['coc_type']==2) {
					for($i=$data['allocate_start'];$i<=$data['allocate_end'];$i++){
					 	$result1 = $this->db->update('stock_management', $requestdata, ['id' => $i]);
						$this->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $data['user_id'], 'action' => '6', 'type' => '1']);
					}
				}
			}			
			
			$this->db->update('coc_orders', $requestdata1, ['id' => $data['order_id']]);

			$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $requestdata['user_id']]);

				 if ($inv_id) {

				 	$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();

				 	$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $requestdata['user_id']])->order_by('id','desc')->get()->row_array();
				 	$currency    = $this->config->item('currency');
				 	$delivery_rate = array();


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
		        // $stringaarr = explode("@@@",$rowData['areas']);
		        // $provincesettings = explode("@@@",$rowData2['provincesettings']);
		        // $province_arr = explode('@-@', $provincesettings[1]);
		        // $province = $province_arr[0];
		        // $billing_province = isset($stringaarr[6]) ? $stringaarr[6] : "";

		        $stringaarr = explode("@@@",$rowData['areas']);
        		$provincesettings = explode("@@@",$rowData2['provincesettings']);
		        //print_r($stringaarr);die;


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
		return $result1;
	}

}