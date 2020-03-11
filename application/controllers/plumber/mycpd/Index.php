<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mycpd_Model');
		
	}
	
	public function index($pagestatus='',$id='')
	{
		$userid = $this->getUserID();
		$this->mycptindex($pagestatus,$id,$userid);
		
	}

	// Plumber Reg number search
	public function userRegDetails()
	{

		$postData = $this->input->post();		  
		if($postData['type'] == 3)
		{
			$data 	=   $this->Mycpd_Model->autosearchPlumberReg($postData);
		}

	  	// echo json_encode($data); exit;

		if(!empty($data) && count($data)>0 ) {
		?>
			<ul id="name-list">
			<?php
			foreach($data as $key=>$val) {
				$reg_no = $val["registration_no"];
				$name_surname = $val["name"].' '.$val["surname"];
				// if(isset($val["surname"])){
				// 	$name = $name.' '.$val["surname"];
				// }
			?>
			<li onClick="selectuser('<?php echo $reg_no; ?>','<?php echo $val["id"]; ?>','<?php echo $name_surname; ?>');"><?php echo $reg_no; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}

		//CPD Activity search
	public function activityDetails()
	{

		$postData = $this->input->post();		  
		if($postData)
		{
			$data 	=   $this->Mycpd_Model->autosearchActivity($postData);
		}
	  	// echo json_encode($data); exit;

		if(!empty($data)) {
		?>
			<ul id="name-list1">
			<?php
			foreach($data as $key=>$val) {
				//print_r($val['startdate']);die;
				if ($val['startdate']) {
					$startDate1 = date('m-d-Y', strtotime($val['startdate']));
				}
				$activity 		= $val["activity"];
				$startDate 		= $startDate1;
				$cpd_Stream 	= $this->config->item('cpdstream')[$val["cpdstream"]];
				$cpd_Stream_id 	= $val["cpdstream"];
				$cpdPoints 		= $val["points"];
			?>
			<li onClick="selectActivity('<?php echo $activity; ?>','<?php echo $val["id"]; ?>','<?php echo $startDate; ?>','<?php echo $cpd_Stream; ?>','<?php echo $cpdPoints; ?>','<?php echo $cpd_Stream_id; ?>');"><?php echo $activity; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}

	public function DTCpdQueue()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
		$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
		//print_r($results);die;
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				if ($result['status']==0) {
					$statuz 	= 'Pending';
					$awardPts 	= '';
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					';
				}elseif($result['status']==3){
					$statuz 	= 'Not Submited';
					$awardPts 	= '';
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					';
				}
			
				else{
					$statuz 	= $this->config->item('approvalstatus')[$result['status']];
					$awardPts 	= $result['points'];
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
					</div>
					';
				}

				// Attachments
				if ($result['file1']!='') {
					$attach = '<div class="table-action">
					<a href="'.base_url().'assets/uploads/cpdqueue/'.$result['file1'].'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Attachments"><i class="fa fa-download"></i></a>
					</div>';
				}else{
					$attach = '';
				}


				$totalrecord[] = 	[
					'date' 					=> 	date("m-d-Y", strtotime($result['cpd_start_date'])),
					'acivity' 				=> 	$result['cpd_activity'],
					'streams' 				=> 	$this->config->item('cpdstream')[$result['cpd_stream']],
					'comments' 				=> 	$result['comments'],
					'points' 				=> 	$awardPts,
					'attachment' 			=> 	$attach,
					'status' 				=> 	$statuz,
					'action'				=> 	$action
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

	public function year_cron(){
		$userid 					= $this->getUserID();
		$currentyear 				= strtotime(date("Y"));
		$requestData1['flag'] 		= '2';
		
		$date = $this->db->select('*')->from('cpd_activity_form')->where('user_id',$userid)->get()->result_array();
		foreach ($date as $key => $value) {
			$DBYear = date("Y",strtotime($value['created_at']));
			$strDBYear  = strtotime(date("Y",strtotime($value['created_at'])));
			if ($strDBYear<$currentyear) {
				
				$query = $this->db->update('cpd_activity_form', $requestData1, ['id' => $value['id']]);
			}

		}
		
	}

	public function getAttachment($data){
		
		$query = $this->db->select('*')->from('cpd_activity_form')->where('id',$data)->get()->row_array();

		if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $query['file1'])){
        $filepath = FCPATH.'assets/uploads/cpdqueue/'.$query['file1'];
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
	        die();
        }
    } else {
        die("Invalid file name!");
    }

		
	}

	public function monthlyMail(){
		$fileName = 'http://diyesh.com/auditit_new/pirb/plumber/mycpd/index/monthlyMail';
		$cron_start = $this->cronLog($fileName);

		$corn_start_date = date('Y-m-d H:i:s');

		$currentDate 		= date('m-d-Y');
		$currentMonth 		= date('m');
		$lastMonth 			= date('m', strtotime($currentMonth.' -1'));
		$settingsplumberDetails[] = '';
		$plumberCPDDetails[] = '';
		$cpdTable 	= '';
		$dev 		= '';
		$work 		= '';
		$indi 		= '';
		$total 		= '';
		$totalDB 	= '';

		$this->db->select('t1.*, t3.designation, t2.renewal_date, t2.expirydate, t4.mobile_phone, t2.email');
		$this->db->from('cpd_activity_form t1');
		$this->db->join('users t2', 't2.id=t1.user_id','left');
		$this->db->join('users_plumber t3', 't3.user_id=t1.user_id','left');
		$this->db->join('users_detail t4', 't4.user_id=t1.user_id','left');
		$this->db->where('t2.type', '3');
		$this->db->where('t2.status', '1');
		$this->db->where('MONTH(t1.cpd_start_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND t1.status="1" OR t1.status="2"');
		// $this->db->where('t1.status', '1');
		// $this->db->or_where('t1.status', '2');
		//$this->db->group_by('t1.user_id');
		$userQuery = $this->db->get()->result_array();
		$settingsCPD = $this->db->select('*')->from('settings_cpd')->get()->result_array();
		$template 	= $this->db->select('*')->from('email_notification')->where('id','14')->where('sms_active','1')->get()->row_array();	

		
		
		//$designationDB = $this->config->item('designation2')[$userQuery['designation']];
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
			// echo "<pre>";	
			// print_r($settingsplumberDetails);

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
		 	//print_r($body);
		}
		
		if ($cron_start) {
			$requestdata0['	end_time'] 		= date('Y-m-d H:i:s');
			$this->db->update('cron_log',$requestdata0, ['id' => $cron_start]);
		}
	}

}
