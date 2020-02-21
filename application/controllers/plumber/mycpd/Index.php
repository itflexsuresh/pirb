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
		
		if($id!=''){
			$result = $this->Mycpd_Model->getQueueList('row', ['id' => $id, 'pagestatus' => $pagestatus]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('plumber/mycpd/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			
			if($requestData['submit']=='submit'){

				$data 	=  $this->Mycpd_Model->actionInsert($requestData);
				if($data) $message = 'CPD Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}elseif($requestData['submit']=='save'){
				//print_r($requestData);die;

				$data 	=  $this->Mycpd_Model->actionSave($requestData);
				if($data) $message = 'My CPD '.(($id=='') ? 'save' : 'updated').' successfully.';
			}
			else{
				$data 			= 	$this->Mycpd_Model->changestatus($requestData);
				$message		= 	'CPD Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('plumber/mycpd/index'); 
		}
		
		$userid 					= $this->getUserID();
		$userdata1					= $this->Plumber_Model->getList('row', ['id' => $userid]);
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['cpdstreamID'] 	= $this->config->item('cpdstream');
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);
		$pagedata['id'] 			= $userid;
		$pagedata['user_details'] 	= $userdata1;
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('plumber/mycpd/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
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

				$totalrecord[] = 	[
					'date' 					=> 	date("m-d-Y", strtotime($result['cpd_start_date'])),
					'acivity' 				=> 	$result['cpd_activity'],
					'streams' 				=> 	$this->config->item('cpdstream')[$result['cpd_stream']],
					'comments' 				=> 	$result['comments'],
					'points' 				=> 	$awardPts,
					'attachment' 			=> 	'<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/getAttachment/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Download"><i class="fa fa-download"></i></a>
					</div>',
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

		$user_id  			= $this->getUserID();
		$userdetails 		= $this->Plumber_Model->getList('row', ['id' => $user_id]);
		$designationID  	= $this->getUserDetails($user_id);
		$designationDB 	  	= $this->config->item('designation2')[$designationID['designation']];
		$currentDate 		= date('m-d-Y');
		$currentMonth 		= date('m');
		$lastMonth 			= date('m', strtotime($currentMonth.' -1'));
		$settingsplumberDetails[] = '';
		$plumberCPDDetails[] = '';
		$cpdTable = '';
		$dev 	= '';
		$work 	= '';
		$indi 	= '';
		$total 	= '';
		$totalDB 	= '';

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

		$template 			= $this->db->select('*')->from('email_notification')->where('category_id','6')->where('sms_active','1')->get()->row_array();
		

		$plumberCPD 		= $this->db->select('*')->from('cpd_activity_form')->where('MONTH(cpd_start_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND status="1" OR status="2"')->get()->result_array();

		$settingsCPD 		= $this->db->select('*')->from('settings_cpd')->get()->result_array();

		if (count($plumberCPD)>0) {
				foreach ($settingsCPD as $key => $value) {
				$settingsplumberDetails[] = $value[$designation];
			}
			foreach ($plumberCPD as $key1 => $value1) {

				if($value1['cpd_stream']=='1'){
					$dev .= $value1['points'];
				}elseif($value1['cpd_stream']=='2'){
					$work .= $value1['points'];
				}
				elseif($value1['cpd_stream']=='3'){
					$indi .= $value1['points'];
				}
				if($dev==''){
					$dev .= '0';				
					
				}elseif ($work=='') {
					$work .= '0';
				}
				elseif ($indi=='') {
					$indi .= '0';
				}
			
			}

			$total .= $dev+$work+$indi;
			$totalDB .= $settingsplumberDetails[1]+$settingsplumberDetails[2]+$settingsplumberDetails[3];

			$cpdTable .= '<table style="width:40%; border-collapse:collapse;" class="tablcpd">
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

			$array1 = ['{Plumbers Name and Surname}','{TODAYS DATE}', 'Points Table'];
			$array2 = [$userdetails['name'].' '.$userdetails['surname'], $currentDate, $cpdTable];
			$body = str_replace($array1, $array2, $template['email_body']);

			if ($template['email_active'] == '1') {

		 		$this->CC_Model->sentMail($userdetails['email'],$template['subject'],$body);
		 	}
		}
		
	}
}
