<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Cron extends CC_Controller {
  
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cron_Model');
		$this->load->model('Cpdtypesetup_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Renewal_Model');
		$this->load->model('Coc_Model');
		$this->load->model('Auditor_Model');
		$this->load->model('Systemsettings_Model');
		
		$this->load->model('Communication_Model');
		$this->load->model('CC_Model');
	}

    public function rate()
	{
		$fileName 	= base_url().'common/cron/rate';
		$starttime 	= date('Y-m-d H:i:s');

	    $data	=	$this->Cron_Model->display_records();

		foreach ($data as $key => $value) {

			$id = $value->id; 
			if($value->futuredate != '' and !empty($value->futuredate))
			{
				$current_date 	= 	strtotime(date('Y-m-d'));
				$futuredate		=	strtotime($value->futuredate);

				if($current_date == $futuredate) $this->Cron_Model->updaterecords($id,$value->futuredate,$value->futureammount);
			}				
		}
	  
		$endtime = date('Y-m-d H:i:s');
		
		if($starttime && $endtime){
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}      	
    }
		
	public function cpdtype(){
		
		$fileName 	= base_url().'common/cron/cpdtype';
		$starttime 	= date('Y-m-d H:i:s');
		
		$this->Cpdtypesetup_Model->getCronDate();
		
		$endtime = date('Y-m-d H:i:s');

		if ($starttime && $endtime) {
			 $this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}
	
	public function monthlycpdtype(){
	
		$fileName 	= base_url().'common/cron/monthlycpdtype';
		$starttime 	= date('Y-m-d H:i:s');

		$currentDate 		= date('m-d-Y');
		$currentMonth 		= date('m');
		$lastMonth 			= date('m', strtotime($currentMonth.' -1'));
		
		$settingsplumberDetails = [];
		$cpdTable 				= '';
		$dev 					= '';
		$work 					= '';
		$indi 					= '';
		$total 					= '';
		$totalDB 				= '';

		$this->db->select('t1.*, t3.designation, t2.renewal_date, t2.expirydate, t4.mobile_phone, t2.email');
		$this->db->from('cpd_activity_form t1');
		$this->db->join('users t2', 't2.id=t1.user_id','left');
		$this->db->join('users_plumber t3', 't3.user_id=t1.user_id','left');
		$this->db->join('users_detail t4', 't4.user_id=t1.user_id','left');
		$this->db->where('t2.type', '3');
		$this->db->where('t2.status', '1');
		$this->db->where('MONTH(t1.cpd_start_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND t1.status="1" OR t1.status="2"');
		$userQuery = $this->db->get()->result_array();
		$settingsCPD = $this->db->select('*')->from('settings_cpd')->get()->result_array();
		$template 	= $this->db->select('*')->from('email_notification')->where('id','14')->where('sms_active','1')->get()->row_array();	

		foreach ($userQuery as $key => $value) {
			$designationDB = $this->config->item('designation2')[$value['designation']];

			if ($designationDB == 'Learner Plumber') {
				$designation = 'learner';
			}elseif($designationDB == 'Technical Assistant Practitioner'){
				$designation = 'assistant';
			}elseif($designationDB == 'Technical Operator Practitioner'){
				$designation = 'operating';
			}elseif($designationDB == 'Licensed Plumber'){
				$designation = 'licensed';
			}elseif($designationDB == 'Qualified Plumber'){
				$designation = '';
			}elseif($designationDB == 'Master Plumber'){
				$designation = 'master';				
			}

			if($value['cpd_stream']=='1'){
					$dev = $value['points'];
				}elseif($value['cpd_stream']=='2'){
					$work = $value['points'];
				}
				elseif($value['cpd_stream']=='3'){
					$indi = $value['points'];
				}
				if($dev==''){
					$dev = 0;				
					
				}if ($work=='') {
					$work = 0;
				}if ($indi=='') {
					$indi = 0;
				}
				
				foreach ($settingsCPD as $key1 => $value1) {
				$settingsplumberDetails[] = $value1[$designation];
			}
			

			$total = $dev+$work+$indi;
			$totalDB = $settingsplumberDetails[1]+$settingsplumberDetails[2]+$settingsplumberDetails[3];

			$cpdTable = '<table style="width:40%; border-collapse:collapse;" class="tablcpd">
			<tr>
			<th style="border: 1px solid #000;padding:5px 10px;text-align:center;">CPD Stream</th>
			<th style="border: 1px solid #000;padding:5px 10px;text-align:center;">Your Points (YTD)</th>
			<th style="border: 1px solid #000;padding:5px 10px;text-align:center;">Preferred Points Required</th>
			
			</tr>
			<tr>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">Developmental</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$dev.'</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$settingsplumberDetails[1].'</td>
			</tr>
			<tr>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">Work-based</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$work.'</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$settingsplumberDetails[2].'</td>
			</tr>
			<tr>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">Individual</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$indi.'</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$settingsplumberDetails[3].'</td>
			</tr>
			<tr>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">Total</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$total.'</td>
			<td style="border: 1px solid #000;padding:5px 10px;text-align:center;">'.$totalDB.'</td>
			</tr>
			</table>';

			$array1 = ['{Plumbers Name and Surname}','{TODAYS DATE}', 'Points Table', '{plumbers registration renewal date}'];
			$array2 = [$value['name_surname'], $currentDate, $cpdTable, date('m-d-Y', strtotime($value['renewal_date']))];
			$body = str_replace($array1, $array2, $template['email_body']);

			if ($template['email_active'] == '1') {

				$this->CC_Model->sentMail($value['email'],$template['subject'],$body);

				$smsbody1 = ['{total Points}','{total points required}', '{next registration date}'];
				$smsbody2 = [$total, $totalDB, date('m-d-Y', strtotime($value['expirydate']))];

				$smsdata 	= $this->Communication_Model->getList('row', ['id' => '14', 'smsstatus' => '1']);
					
				if($smsdata){
					$sms = str_replace([$smsbody1, $smsbody2, $smsdata['sms_body']]);
					$this->sms(['no' => $userQuery['mobile_phone'], 'msg' => $sms]);
				}
			}
		}
		
		$endtime = date('Y-m-d H:i:s');
		
		if ($starttime && $endtime) {
			$cron_start = $this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}

    public function performancestatusarchive()
	{
		$fileName 	= base_url().'common/cron/performancestatusarchive';
		$starttime 	= date('Y-m-d H:i:s');

		$this->performancestatusrollingaverage();

		$endtime = date('Y-m-d H:i:s');
		
		if ($starttime && $endtime) {
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}
	
    public function performancestatuswarning()
	{
		$fileName 	= base_url().'common/cron/performancestatuswarning';
		$starttime 	= date('Y-m-d H:i:s');

		$this->performancestatusmail();

		$endtime = date('Y-m-d H:i:s');
		
		if ($starttime && $endtime) {
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}
	
	public function renewalreminder1()
	{	
		$fileName 	= base_url().'common/cron/renewalreminder1';
		$starttime 	= date('Y-m-d H:i:s');

		$result = $this->Renewal_Model->getUserids();		
		$settings = $this->Systemsettings_Model->getList('row');
		
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


			$result = $this->Renewal_Model->updatedata($userid,$designation,'2');			
			$invoice_id = $result['invoice_id'];
			$cocorder_id = $result['cocorder_id'];
			
			if ($invoice_id) {
				$inid 				= $cocorder_id;
				$inv_id 			= $invoice_id;

				$userdata1	= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail']);

				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoice_id])->get()->row_array();

				// invoice PDF
				
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$designation =	$this->config->item('designation2')[$rowData['designation']];					
				$cocreport = $this->cocreport($inv_id, 'PDF Invoice Plumber COC', ['description' => 'PIRB year registration fee for '.$designation.' for '.$rowData['username'].' '.$rowData['surname'].', registration number '.$rowData['registration_no']]);
					
					$cocTypes = $orders['coc_type'];
					$mail_date = date("d-m-Y", strtotime($orders['created_at']));
					
					
					//$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '1', 'emailstatus' => '1']);
					$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '1']);
					
					if($notificationdata){
						$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}','{renewal_date}'];
						$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype2')[$cocTypes],$renewal_date];
						$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
						//$this->CC_Model->sentMail($userdata1['email'], $notificationdata['subject'], $body, $cocreport);
						$this->CC_Model->sentMail('suresh@itflexsolutions.com', $notificationdata['subject'], $body, $cocreport);
					}
					
					if($this->config->item('otpstatus')!='1'){
						$smsdata 	= $this->Communication_Model->getList('row', ['id' => '1', 'smsstatus' => '1']);
			
						if($smsdata){
							$sms = $smsdata['sms_body'];
							$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
						}
					}

				}			 

			}
			
		}
		
		$endtime = date('Y-m-d H:i:s');
		
		if ($starttime && $endtime) {
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}		
	}

	public function renewalreminder2()
	{	
		$fileName 	= base_url().'common/cron/renewalreminder2';
		$starttime 	= date('Y-m-d H:i:s');

		$result = $this->Renewal_Model->getUserids_alert2();	
		$settings = $this->Systemsettings_Model->getList('row');
		
		foreach($result as $data)
		{
			
			$userid = $data['id'];
			$designation = $data['designation'];
			$invoice_id = $data['inv_id'];
			$cocid = $data['cocid'];

			$designation = $data['designation'];
			$insert_result = $this->Renewal_Model->updatedata($userid,$designation,'3',$invoice_id,$cocid);
			$invoice_id = $insert_result['invoice_id'];
			$cocorder_id = $insert_result['cocorder_id'];
			
			if ($invoice_id) {
				$inv_id 			= $invoice_id;

				$userdata1	= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail']);

				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoice_id])->get()->row_array();

				// invoice PDF
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$designation =	$this->config->item('designation2')[$rowData['designation']];					
				$cocreport = $this->cocreport($inv_id, 'PDF Invoice Plumber COC', ['description' => 'PIRB year registration fee for '.$designation.' for '.$rowData['username'].' '.$rowData['surname'].', registration number '.$rowData['registration_no'], 'type' => '2']);
				
				$cocTypes = $orders['coc_type'];
				$mail_date = date("d-m-Y", strtotime($orders['created_at']));
							
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '2', 'emailstatus' => '1']);
				
				if($notificationdata){
					$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];
					$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype2')[$cocTypes]];
					$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
					$this->CC_Model->sentMail($userdata1['email'], $notificationdata['subject'], $body, $cocreport);
				}
				
				if($this->config->item('otpstatus')!='1'){
					$smsdata 	= $this->Communication_Model->getList('row', ['id' => '2', 'smsstatus' => '1']);
		
					if($smsdata){
						$sms = $smsdata['sms_body'];
						$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
					}
				}
			}
			
		}
		
		$endtime = date('Y-m-d H:i:s');
		
		if ($starttime && $endtime) {
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
		
	}

	public function renewalreminder3()
	{	
		$fileName 	= base_url().'common/cron/renewalreminder3';
		$starttime 	= date('Y-m-d H:i:s');

		$result = $this->Renewal_Model->getUserids_alert3();	
		$settings = $this->Systemsettings_Model->getList('row');
		foreach($result as $data)
		{						
			$userid = $data['id'];
			$designation = $data['designation'];
			$invoice_id = $data['inv_id'];
			$cocid = $data['cocid'];

			$designation = $data['designation'];
			$insert_result = $this->Renewal_Model->updatedata($userid,$designation,'4',$invoice_id,$cocid);
			
			$invoice_id = $insert_result['invoice_id'];
			$cocorder_id = $insert_result['cocorder_id'];
			$cocorder_id2 = $insert_result['cocorder_id2'];
			
			if ($invoice_id) {
				$inv_id 			= $invoice_id;

				$userdata1	= 	$this->Plumber_Model->getList('row', ['id' => $userid], ['users', 'usersdetail']);

				$orders = $this->db->select('*')->from('coc_orders')->where(['inv_id' => $invoice_id])->get()->row_array();

				$lateamount_result = $this->db->select('*')->from('coc_orders')->where(['id' => $cocorder_id2])->get()->row_array();
				$lateamount = $lateamount_result['cost_value'];
				$total_lateamount = $lateamount_result['total_due'];
				$vat_lateamount = $lateamount_result['vat'];

				// invoice PDF
				$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
				$designation =	$this->config->item('designation2')[$rowData['designation']];					
				$cocreport = $this->cocreport($inv_id, 'PDF Invoice Plumber COC', ['description' => 'PIRB year registration fee for '.$designation.' for '.$rowData['username'].' '.$rowData['surname'].', registration number '.$rowData['registration_no'], 'type' => '2', 'latesubtotalamount' => $lateamount, 'latevatamount' => $vat_lateamount, 'latetotalamount' => $total_lateamount]);
			
				$cocTypes = $orders['coc_type'];
				$mail_date = date("d-m-Y", strtotime($orders['created_at']));
				
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '3', 'emailstatus' => '1']);
				
				if($notificationdata){
					$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];
					$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype2')[$cocTypes]];
					$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
					$this->CC_Model->sentMail($userdata1['email'], $notificationdata['subject'], $body, $cocreport);
				}
				
				if($this->config->item('otpstatus')!='1'){
					$smsdata 	= $this->Communication_Model->getList('row', ['id' => '3', 'smsstatus' => '1']);
		
					if($smsdata){
						$sms = $smsdata['sms_body'];
						$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
					}
				}

			}
			
		}
		$endtime = date('Y-m-d H:i:s');
		if ($starttime && $endtime) {
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
		
	}

	public function renewalreminder4()
	{	
		$fileName 	= base_url().'common/cron/renewalreminder4';
		$starttime = date('Y-m-d H:i:s');

		$result = $this->Renewal_Model->getUserids_alert4();		
		
		foreach($result as $data)
		{						
			$userid = $data['id'];  
			$request['status'] = '3';
			$this->db->update('users_detail', $request, ['user_id' => $userid]);
			
			$request1['status'] = '2';
			$this->db->update('users', $request1, ['id' => $userid]);

			$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '3'])->get()->row_array();
			 
			$mail_date = date("d-m-Y");
			$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '3', 'emailstatus' => '1']);
				
			if($notificationdata){
				$array1 = ['{Plumbers Name and Surname}','{date of purchase}'];
				$array2 = [$data['name']." ".$data['surname'], $mail_date];
				$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
				$this->CC_Model->sentMail($data['email'], $notificationdata['subject'], $body);
			}
			
			if($this->config->item('otpstatus')!='1'){
				$smsdata 	= $this->Communication_Model->getList('row', ['id' => '3', 'smsstatus' => '1']);
	
				if($smsdata){
					$sms = $smsdata['sms_body'];
					$this->sms(['no' => $data['mobile_phone'], 'msg' => $sms]);
				}
			}
			
		}
		$endtime = date('Y-m-d H:i:s');
		if ($starttime && $endtime) {
			$this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}
	
	public function monthlyperformance()
	{	
		$plumbers	= 	$this->Plumber_Model->getList('all', ['plumberstatus' => ['1']], ['users', 'usersdetail']);
		$date		= 	date('d-m-Y');
		
		foreach($plumbers as $plumber){
			$id 			= $plumber['id'];
			
			$result 		= $this->Plumber_Model->performancestatus('all', ['plumberid' => $id, 'archive' => '0']);
			$performance 	= array_sum(array_column($result, 'point'));
			
			$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '13', 'emailstatus' => '1']);
				
			if($notificationdata){
				$array1 = ['{Plumbers Name and Surname}', '{todays dates}', '{total value of performance}'];
				$array2 = [$plumber['name'].' '.$plumber['surname'], $date, $performance];
				
				$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
				$this->CC_Model->sentMail($plumber['email'], $notificationdata['subject'], $body);
			}
			
			if($this->config->item('otpstatus')!='1'){
				$smsdata 	= $this->Communication_Model->getList('row', ['id' => '13', 'smsstatus' => '1']);
	
				if($smsdata){
					$sms = str_replace(['{performance warning status}'], [$performance], $smsdata['sms_body']);
					$this->sms(['no' => $plumber['mobile_phone'], 'msg' => $sms]);
				}
			}
		}
	}

	public function monthlycoc()
	{	
		$plumbers	= 	$this->Plumber_Model->getList('all', ['plumberstatus' => ['1']], ['users', 'usersdetail']);
		$date		= 	date('d-m-Y');
		
		foreach($plumbers as $plumber){
			$id 			= $plumber['id'];
			$history		= $this->Auditor_Model->getReviewHistoryCount(['plumberid' => $id]);
			$logged			= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['2']]);
			$allocated		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['4']]);
			$nonlogged		= $this->Coc_Model->getCOCList('count', ['user_id' => $id, 'coc_status' => ['5']]);
			
			$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '19', 'emailstatus' => '1']);
				
			if($notificationdata){
				$array1 = ['{Plumbers Name and Surname}', '{todays date}', '{number1}', '{number2}', '{number3}', '{number4}'];
				$array2 = [$plumber['name'].' '.$plumber['surname'], $date, $nonlogged, $allocated, $logged, $history['count']];
				
				$body 	= str_replace($array1, $array2, $notificationdata['email_body']);
				$this->CC_Model->sentMail($plumber['email'], $notificationdata['subject'], $body);
			}
			
			if($this->config->item('otpstatus')!='1'){
				$smsdata 	= $this->Communication_Model->getList('row', ['id' => '19', 'smsstatus' => '1']);
	
				if($smsdata){
					$sms = str_replace(['{number}'], [$nonlogged], $smsdata['sms_body']);
					$this->sms(['no' => $plumber['mobile_phone'], 'msg' => $sms]);
				}
			}
		}
	}

}

	
  
