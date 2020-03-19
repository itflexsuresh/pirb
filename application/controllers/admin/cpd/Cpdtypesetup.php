<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpdtypesetup extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Cpdtypesetup_Model');

		$this->checkUserPermission('16', '1');
		
	}
	
	public function index($pagestatus='',$id='')
	{
		
		if($id!=''){

			$this->checkUserPermission('16', '2', '1');


			$result = $this->Cpdtypesetup_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/cpd/Cpdtypesetup'); 
			}
		}
		
		if($this->input->post()){

			$this->checkUserPermission('16', '2', '1');

			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$check_code 	= $this->productCode();
				if ($id=='') {
					if ($check_code!='') {
						$full_code = $check_code;
						// QR CODE
						$SERVERFILEPATH 					= $_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/qrcode/';
						$text 								= $full_code;
						$file_name 							= $text ."-Qrcode.png";
						$Qrcode_path 						= $SERVERFILEPATH.$file_name;
						define('IMAGE_WIDTH',1000);
						define('IMAGE_HEIGHT',1000);
						QRcode::png($text,$Qrcode_path,'L', '10', '10');
						$requestData['qrcode']				= $file_name;
					}
				}else{
					$full_code 	= 	$requestData['productcode'];
				}
				
				$requestData['productcode']			= $full_code;
				$data 	=  $this->Cpdtypesetup_Model->action($requestData);
				if($data) $message = 'CPD Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Cpdtypesetup_Model->changestatus($requestData);
				$message		= 	'CPD Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/cpd/Cpdtypesetup'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['cpdstreamID'] 	= $this->config->item('cpdstream');
		$pagedata['checkpermission'] = $this->checkUserPermission('16', '2');
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);
		$pagedata['id'] 			= $this->getUserID();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/cpd/cpdtypesetup/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function productCode(){
		$result = $this->db->order_by('id',"desc")->get('cpdtypes')->row_array();
		if ($result) {
			$sequence_number  = explode("-",$result['productcode']);
			$product_code = $sequence_number[1]+1;						
			$code 		=  str_pad($product_code,6,'0',STR_PAD_LEFT);
			$full_code = "CPD-".$code;
			return $full_code;
		}else{
			$cpd = 'CPD-000001';
			return $cpd;
		}
	}

	public function DTCpdType()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Cpdtypesetup_Model->getList('count', ['status' => [$post['pagestatus']]]+$post);
		$results 		= $this->Cpdtypesetup_Model->getList('all', ['status' => [$post['pagestatus']]]+$post);

		$checkpermission	=	$this->checkUserPermission('16', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if ($checkpermission) {
					$action = '<div class="table-action">
								<a href="'.base_url().'admin/cpd/cpdtypesetup/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								</div>';
				}else{
					$action = '';
				}

				$totalrecord[] = 	[
					'productcode' 		=> 	$result['productcode'],
					'activity' 			=> 	$result['activity'],
					'startdate' 		=> 	date('m-d-Y',strtotime($result['startdate'])),
					'enddate' 			=> 	date('m-d-Y',strtotime($result['enddate'])),
					'cpdstream' 		=> 	$this->config->item('cpdstream')[$result['cpdstream']],
					'points' 			=> 	$result['points'],
										//'status' 	=> 	$this->config->item('statusicon')[$result['status']],
					'action'			=> 	$action
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

	public function getPDF($id){

		if($id!=''){
			$rowData = $this->Cpdtypesetup_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($rowData){
				$fileName = $rowData['productcode'];

				$html = '<!DOCTYPE html>
				<html>
				<head>
				<title>CPD PDF</title>
				</head>
				<body>

				<table style="width: 80%; display: table; margin: 0 auto; ">
				<tbody>
				<tr style="text-align: center;">
				<td colspan="2" style="font-family:Helvetica;"><img style="width: 200px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png"></td>
				</tr>
				<tr style="text-align: center;">
				<td style="width: 50%; text-align: right;padding: 60px 20px 10px 0; font-weight: 700; font-family:Helvetica;">ACTIVITY NAME:</td>
				<td style="font-family:Helvetica; text-align: left; padding: 60px 0 10px 0;">'.$rowData['activity'].'</td>
				</tr>
				<tr style=" font-family:Helvetica; text-align: center;">
				<td style=" font-family:Helvetica;width: 60%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD POINTS FOR THIS ACTVITY:</td>
				<td style="font-family:Helvetica; text-align: left; padding: 10px 0 10px 0;">'.$rowData['points'].'</td>
				</tr>
				<tr style="font-family:Helvetica; text-align: center;">
				<td style="font-family:Helvetica; width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD STREAM:</td>
				<td style="font-family:Helvetica; text-align: left; padding: 10px 0 10px 0;">'.$this->config->item('cpdstream')[$rowData['cpdstream']].'</td>
				</tr>
				<tr style="text-align: center;">
				<td style="font-family:Helvetica; width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD ACTIVITY END DATE:</td>
				<td style="font-family:Helvetica; text-align: left; padding: 10px 0 10px 0;">'.date('d-m-Y',strtotime($rowData['enddate'])).'</td>
				</tr>
				<tr style="text-align: center;">
				<td style="font-family:Helvetica; width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD PRODUCT CODE:</td>
				<td style="font-family:Helvetica; text-align: left; padding: 10px 0 10px 0;">'.$rowData['productcode'].'</td>
				</tr>
				<tr style="text-align: center;">
				<td colspan="2" style="font-family:Helvetica;">
				<img style="width: 210px; padding-top: 70px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/qrcode/'.$rowData['qrcode'].'">
				<p style="font-family:Helvetica; font-size: 12px">Use App Plumber to Scan this QR Code</p>
				</td>
				</tr>
				</tbody>
				</table>
				</body>
				</html>';
				$pdfFilePath = "".$fileName.".pdf";
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				$this->pdf->stream($pdfFilePath);
			}
		}		
	}

	// CPD Queue:

	public function index_queue($pagestatus='',$id=''){
		
		if($id!='' && !$this->input->post()){

			$this->checkUserPermission('17', '2', '1');

			$result = $this->Cpdtypesetup_Model->getQueueList('row', ['id' => $id, 'pagestatus' => [$pagestatus]]);
			if($result){
				$pagedata['result'] = $result;
				if ($result['cpd_activity']!='') {
					$pagedata['strem_id'] = $this->config->item('cpdstream')[$pagedata['result']['cpd_stream']];
				}else{
					$pagedata['strem_id'] = '';
				}
				
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/cpd/cpdtypesetup/index_queue'); 
			}
		}
		
		if($this->input->post()){

			$this->checkUserPermission('17', '2', '1');

			$requestData 	= 	$this->input->post();
			if($requestData['submit']=='submit'){
				// echo "<pre>";
				// print_r($requestData);die;

				$data 	=  $this->Cpdtypesetup_Model->queue_action($requestData);
				if($data) $message = 'CPD Queue '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Installationtype_Model->changestatus($requestData);
				$message		= 	'Installation Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/cpd/cpdtypesetup/index_queue'); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['cpdstreamID'] 	= $this->config->item('cpdstream');
		$status 				 	= $this->getPageStatus($pagestatus);

		if ($status == '1') {
			$pagedata['pagestatus'] = '0';
		}else{
			$pagedata['pagestatus'] = '1';
		}

		$pagedata['id'] 			= $this->getUserID();
		$pagedata['checkpermission'] = $this->checkUserPermission('17', '2');
		$pagedata['approvalstatus'] = $this->config->item('approvalstatus');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/cpd/cpdqueue/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	// Plumber Reg number search
	public function userRegDetails()
	{

		$postData = $this->input->post();		  
		if($postData['type'] == 3)
		{
			$data 	=   $this->Cpdtypesetup_Model->autosearchPlumberReg($postData);
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
			<li onClick="selectuser('<?php echo $reg_no; ?>','<?php echo $val["id"]; ?>','<?php echo $name_surname; ?>');"><?php echo $name_surname; ?></li>
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
			$data 	=   $this->Cpdtypesetup_Model->autosearchActivity($postData);
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
		//print_r($post);die;

		$totalcount 	= $this->Cpdtypesetup_Model->getQueueList('count', ['status' => [$post['pagestatus']]]+$post);
		$results 		= $this->Cpdtypesetup_Model->getQueueList('all', ['status' => [$post['pagestatus']]]+$post);
		//print_r($results);die;
		$checkpermission	=	$this->checkUserPermission('17', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if ($checkpermission) {
					$action = '<div class="table-action">
									<a href="'.base_url().'admin/cpd/cpdtypesetup/index_queue/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								</div>';
				}else{
					$action = '';
				}

				if ($result['status']==0) {
					$statuz = '';
				}else{
					$statuz = $this->config->item('approvalstatus')[$result['status']];
				}

				

				$totalrecord[] = 	[
					'date' 					=> 	date('m-d-Y',strtotime($result['cpd_start_date'])),
					'namesurname' 			=> 	$result['name_surname'],
					'reg_number' 			=> 	$result['reg_number'],
					'acivity' 				=> 	$result['cpd_activity'],
					'points' 				=> 	$result['points'],
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
}
