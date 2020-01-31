<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpdtypesetup extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Cpdtypesetup_Model');
		
	}
	
	public function index($pagestatus='',$id='')
	{
		
		if($id!=''){
			$result = $this->Cpdtypesetup_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/cpd/Cpdtypesetup'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$check_code 	= $this->productCode();
				print_r($check_code);die;
				if ($id=='') {
					if ($check_code[0]['productcode']!='') {
						$sequence_number  = explode("-",$check_code[0]['productcode']);
						$product_code = $sequence_number[1]+1;
						$code =  str_pad($product_code,6,'0',STR_PAD_LEFT);
						$full_code = "CPD-".$code;
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
				$requestData['productcode']			= $product_code;
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
		$pagedata['pagestatus'] 	= $this->getPageStatus($pagestatus);
		$pagedata['id'] 			= $this->getUserID();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/cpd/cpdtypesetup/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function productCode(){
		$result = $this->db->select('*')->order_by('id',"desc")->limit(1)->get('cpdtypes')->result_array();
		if (count($result)<=0) {
			$cpd = 'CPD-000001';
			return $cpd;
		}else{
			return $result;
		}
	}

	public function DTCpdType()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Cpdtypesetup_Model->getList('count', ['status' => [$post['pagestatus']]]+$post);
		$results 		= $this->Cpdtypesetup_Model->getList('all', ['status' => [$post['pagestatus']]]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
					'productcode' 		=> 	$result['productcode'],
					'activity' 			=> 	$result['activity'],
					'startdate' 		=> 	date('m-d-Y',strtotime($result['startdate'])),
					'enddate' 			=> 	date('m-d-Y',strtotime($result['enddate'])),
					'cpdstream' 		=> 	$this->config->item('cpdstream')[$result['cpdstream']],
					'points' 			=> 	$result['points'],
										//'status' 	=> 	$this->config->item('statusicon')[$result['status']],
					'action'			=> 	'
					<div class="table-action">
					<a href="'.base_url().'admin/cpd/cpdtypesetup/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					'
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

	public function Cron(){
		$current_date = date('Y-m-d');
		$this->Cpdtypesetup_Model->getCronDate();
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
				<td colspan="2"><img style="width: 200px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/pitrb-logo.png"></td>
				</tr>
				<tr style="text-align: center;">
				<td style="width: 50%; text-align: right;padding: 10px 20px 10px 0; font-weight: 700;">ACTIVITY NAME:</td>
				<td style="text-align: left; padding: 10px 0 10px 0;">'.$rowData['activity'].'</td>
				</tr>
				<tr style="text-align: center;">
				<td style="width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD POINTS FOR THIS ACTVITY:</td>
				<td style="text-align: left; padding: 10px 0 10px 0;">'.$rowData['points'].'</td>
				</tr>
				<tr style="text-align: center;">
				<td style="width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD STREAM:</td>
				<td style="text-align: left; padding: 10px 0 10px 0;">'.$this->config->item('cpdstream')[$rowData['cpdstream']].'</td>
				</tr>
				<tr style="text-align: center;">
				<td style="width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD ACTIVITY END DATE:</td>
				<td style="text-align: left; padding: 10px 0 10px 0;">'.date('m-d-Y',strtotime($rowData['enddate'])).'</td>
				</tr>
				<tr style="text-align: center;">
				<td style="width: 50%; text-align: right; padding: 10px 20px 10px 0; font-weight: 700;">CPD PRODUCT CODE:</td>
				<td style="text-align: left; padding: 10px 0 10px 0;">'.$rowData['productcode'].'</td>
				</tr>
				<tr style="text-align: center;">
				<td colspan="2">
				<img style="width: 210px; padding-top: 70px;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/qrcode/'.$rowData['qrcode'].'">
				<p style="font-size: 12px">Use App Plumber to Scan this QR Code</p>
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
}
