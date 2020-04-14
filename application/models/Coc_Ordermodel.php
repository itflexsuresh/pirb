<?php

class Coc_Ordermodel extends CC_Model
{
	public function getCocorderList($type, $requestdata){

		// $this->db->select('t1.*');
		$this->db->select('t1.*,inv.email_track,inv.sms_track,t2.name,t2.surname,t3.type, concat(t3.address, ",", t5.name) as address, t2.company, t4.type, cc.count');
		$this->db->from('coc_orders t1');
		$this->db->join('invoice inv', 'inv.inv_id=t1.inv_id', 'left');
		$this->db->join('users_detail t2', 't1.user_id=t2.user_id', 'left');
		$this->db->join('users_address t3', 't1.user_id=t3.user_id AND t3.type="2"', 'left');
		$this->db->join('users t4', 't1.user_id=t4.id', 'left');
		$this->db->join('coc_count cc', 't1.user_id=cc.user_id');		
		$this->db->join('city t5', 't3.city=t5.id','left');		


		$this->db->where_in('inv.inv_type', ['1','2']);

		if(isset($requestdata['id'])) 				$this->db->where('t1.id', $requestdata['id']);
		if(isset($requestdata['userid'])) 			$this->db->where('t1.user_id', $requestdata['userid']);
		if(isset($requestdata['admin_status']) && $requestdata['admin_status']=='closed'){
			$this->db->where('admin_status!="0"');
		} else {
			$this->db->where('admin_status', '0');
		}

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id','inv_id','created_at','status','user_id','coc_type','delivery_type'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);	
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = strtolower(trim($requestdata['search']['value']));
			if($searchvalue=='paid'){
				$this->db->where('t1.status', '1');
			}
			else if($searchvalue=='not paid'){
				$this->db->where('t1.status', '0');
			}
			else if($searchvalue=='electronic'){
				$this->db->where('t1.coc_type', '1');
			}
			else if($searchvalue=='paper based'){
				$this->db->where('t1.coc_type', '2');
			}
			else if($searchvalue=='collected at pirb'){
				$this->db->where('t1.delivery_type', '1');
			}
			else if($searchvalue=='by courier'){
				$this->db->where('t1.delivery_type', '2');
			}
			else if($searchvalue=='by register post'){
				$this->db->where('t1.delivery_type', '3');
			}			
			else {
				$this->db->like('concat(t2.name, " ", t2.surname)', $searchvalue);
				$this->db->or_like('concat(t3.address, ",", t5.name)', $searchvalue);
				$this->db->or_like('cc.count', $searchvalue);
				$this->db->or_like('t1.id', $searchvalue);
				$this->db->or_like('t1.inv_id', $searchvalue);
				$this->db->or_like('t1.internal_inv', $searchvalue);
				$this->db->or_like('t1.tracking_no', $searchvalue);
				$this->db->or_like('t1.created_at', date('Y-m-d',strtotime($searchvalue)));
			}
		}
					
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		// echo $this->db->last_query();
		// foreach ($result as $key => $value) {
		// 	if(!strpos($value[''],$str)){
		// 	    echo 0;
		// 	}
		// }
		// exit;
		return $result;
	}

	public function action($data){
		
		$settings = $this->db->get('settings_details')->row_array();
		
		// echo "<pre>"; print_r($data);die;
		if(isset($data['quantity'])) 		$requestdata['description'] 	= 'Purchase of '.$data['quantity'].' PIRB Certificate of Compliance';	
		if(isset($data['created_at'])) 	    $requestdata['created_at'] 		= date('Y-m-d H:i:s', strtotime($data['created_at']));
		if(isset($data['user_id']))			$requestdata['user_id'] 		= $data['user_id'];	
		if(isset($data['inv_id']))			$requestdata['inv_id'] 			= $data['inv_id'];	
		if(isset($data['coc_type'])) 		$requestdata['coc_type'] 		= $data['coc_type'];
		if(isset($data['delivery_type'])) 	$requestdata['delivery_type'] 	= $data['delivery_type'];
		if(isset($data['status'])) 			$requestdata['status'] 			= $data['status'];
		if(isset($data['internal_inv'])) 	$requestdata['internal_inv'] 	= $data['internal_inv'];
		if(isset($data['total_due'])) 		$requestdata['total_cost'] 	 	= $data['total_due'];
		if(isset($data['tracking_no'])) 	$requestdata['tracking_no']  	= $data['tracking_no'];
		if(isset($data['email_track'])) 	$requestdata['email_track']  	= $data['email_track'];
		if(isset($data['sms_track'])) 		$requestdata['sms_track']  		= $data['sms_track'];


		if(isset($requestdata)){	

			if(isset($data['total_due'])) unset($requestdata['total_cost']);

			$requestdata1 			= 	$requestdata;			
			if(isset($data['quantity'])) 		$requestdata1['quantity'] 		= $data['quantity'];
			if(isset($data['cost_value'])) 		$requestdata1['cost_value'] 	= $data['cost_value'];
			if(isset($data['delivery_cost'])) 	$requestdata1['delivery_cost'] 	= $data['delivery_cost'];
			if(isset($data['vat'])) 		    $requestdata1['vat'] 			= $data['vat'];
			if(isset($data['total_due'])) 		$requestdata1['total_due'] 		= $data['total_due'];
			$requestdata1['admin_status'] 	= (isset($data['admin_status']) && $data['admin_status']='on') ? '2' : '0';
			if(isset($data['order_id']))		$requestdata1['id'] 				= $data['order_id'];	
			if(isset($data['email_track'])) 	unset($requestdata1['email_track']);
			if(isset($data['sms_track'])) 		unset($requestdata1['sms_track']);
			
			if(isset($requestdata['inv_id']) && $requestdata['inv_id']!=''){
				
				$result1 = $this->db->update('invoice', $requestdata,['inv_id'=>$requestdata['inv_id']]);				
		
				$result = $this->db->update('coc_orders', $requestdata1,['id'=>$requestdata1['id']]);

				// $counnt = "count + 1";
				// $increase_count = $this->db->update('coc_count', $counnt,['user_id'=>$data['user_id']]);
				if (isset($data['admin_status'])) {
					$this->db->set('count', 'count + '.$data['quantity'].'',FALSE); 
					$this->db->where('user_id', $data['user_id']); 
					$increase_count = $this->db->update('coc_count'); 
				}
				
				// echo $this->db->last_query();exit;
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

				
				$this->db->set('count', 'count - '.$data['quantity'].'',FALSE); 
				$this->db->where('user_id', $data['user_id']); 
				$decrease_count = $this->db->update('coc_count'); 

				$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $requestdata['user_id']], ['users', 'usersdetail']);

				$request['status'] 		= 	'1';
				 if ($inv_id) {
					$result 			= $this->db->update('invoice', $request, ['inv_id' => $inv_id,'user_id' => $requestdata['user_id']]);
				 	$result 			= $this->db->update('coc_orders', $request, ['inv_id' => $inv_id,'user_id' => $requestdata['user_id'] ]);

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

		        	 $paid = '<img class="paid" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/paid.png">';

		        	 $paid_status = "PAID";
		        	
		        }
		        else{

		        	$paid ='<img class="paid" style="width: 250px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/unpaid.png">';

		        	$paid_status = 'UNPAID';
		        	
		        }

		        $stringaarr = explode("@@@",$rowData['areas']);
		        $provincesettings = explode("@@@",$rowData2['provincesettings']);
		        $province_arr = explode('@-@', $provincesettings[1]);
		        $province = $province_arr[0];



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
					<tr><td>'.$province.'</td></tr>
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
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$PDF_rate['amount'].'</td>
					<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$rowData['cost_value'].'</td>
					</tr>

					<tr>
					<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Courier/Regsitered Post Fee</td>				
					<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">'.$delivery_rate['amount'].'</td>
					<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$delivery_rate['amount'].'</td>
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
					<td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Sub Total</td>
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$rowData['cost_value'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">VAT '.$settings["vat_percentage"].'%</td>
					<td style="margin: 0; padding: 5px 50px; border: 1px solid #000; ">'.$rowData['vat'].'</td>
					</tr>

					<tr style="text-align: center;">
					<td bgcolor="#ccc" style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Total</td>
					<td bgcolor="#ccc" style="margin: 0; padding: 5px 50px; border: 1px solid #000;">'.$rowData['total_due'].'</td>
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
		}
		return $result;
	}

	
	public function autosearchPlumber($postData){
		
		$this->db->select('concat(ud.name, " ", ud.surname) as name,cc.count,u.type,ud.status,u.id,up.coc_electronic');
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');
		$this->db->join('users_plumber up', 'up.user_id=ud.user_id','inner');
		$this->db->join('coc_count cc', 'cc.user_id=ud.user_id','inner');
		$this->db->where(['ud.status' => '1', 'u.type' => '3']);
		$this->db->where_in('up.designation', ['4', '6']);

		$this->db->group_start();
			$this->db->like('ud.name',$postData['search_keyword']);
			$this->db->or_like('ud.surname',$postData['search_keyword']);		
			$this->db->or_like('up.registration_no',$postData['search_keyword']);
		$this->db->group_end();

		$this->db->group_by("ud.id");		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	public function autosearchReseller($postData){
		
		$this->db->select('ud.status,ud.company as name,cc.count,u.id, "0" as coc_electronic');
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

		$result_new = array();
		foreach ($result as $key => $value) {
			if($value['name']!='' && $value['status']==1){
				$result_new[] = $value;
			}
		}
		
		return $result_new;
	}

	public function autosearchAuditor($postData){
		$openaudit = 	',(
							select count(sm.id) 
							from stock_management sm
							left join auditor_statement as ars on ars.coc_id=sm.id
							where sm.auditorid=ud.user_id and (ars.auditcomplete=0 or ars.auditcomplete IS NULL)
						) as openaudit';
						
		$mtd 		= 	',(
							select count(sm.id) 
							from stock_management sm
							where sm.auditorid=ud.user_id and month(audit_allocation_date) = '.date('m').' and year(audit_allocation_date) = '.date('Y').'
						) as mtd';
		
		$this->db->select('u.id, concat(ud.name, " ", ud.surname) as name'.$openaudit.$mtd);
		$this->db->from('users_detail ud');
		$this->db->join('users u', 'u.id=ud.user_id','inner');		
		$this->db->join('auditor_availability aa', 'aa.user_id=ud.user_id','left');
		$this->db->join('users_address ua', 'ua.user_id=ud.user_id and ua.type="3"','left');
		$this->db->join('province p1', 'ua.province=p1.id','left');		
		$this->db->join('city c1', 'ua.city=c1.id','left');				
		$this->db->join('suburb s1', 'ua.suburb=s1.id','left');		
		$this->db->join('users_auditor_area uaa', 'uaa.user_id=ud.user_id','left');
		$this->db->join('province p2', 'uaa.province=p2.id','left');		
		$this->db->join('city c2', 'uaa.city=c2.id','left');				
		$this->db->join('suburb s2', 'uaa.suburb=s2.id','left');			
		
		$this->db->where(['u.status' => '1','u.type' => '5','aa.status' => '1']);
		
		$this->db->group_start();
			$this->db->where(['ud.name !=' => '']);
			$this->db->or_where(['ud.surname !=' => '']);
		$this->db->group_end();
		
		$this->db->group_start();
			$this->db->like('ud.name', $postData['search_keyword'], 'both');
			$this->db->or_like('ud.surname', $postData['search_keyword'], 'both');
		$this->db->group_end();

		$this->db->group_start();
			if(isset($postData['province']) && $postData['province']!='') 	$this->db->like('p1.name', $postData['province'], 'both');
			if(isset($postData['city']) && $postData['city']!='') 			$this->db->or_like('c1.name', $postData['city'], 'both');
			if(isset($postData['suburb']) && $postData['suburb']!='') 		$this->db->or_like('s1.name', $postData['suburb'], 'both');
			if(isset($postData['province']) && $postData['province']!='') 	$this->db->or_like('p2.name', $postData['province'], 'both');
			if(isset($postData['city']) && $postData['city']!='') 			$this->db->or_like('c2.name', $postData['city'], 'both');
			if(isset($postData['suburb']) && $postData['suburb']!='') 		$this->db->or_like('s2.name', $postData['suburb'], 'both');
		$this->db->group_end();

		$this->db->group_by("ud.id");
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	
}
