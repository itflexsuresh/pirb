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

		$this->checkUserPermission('7', '1');
	}
	
	public function index($id='')
	{
		$this->checkUserPermission('7', '2', '1');
		$deliverycard 	= $this->config->item('purchasecocdelivery');
		$coctype		= $this->config->item('coctype');
		
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
			$this->checkUserPermission('7', '2', '1');

			$requestData 	= 	$this->input->post();
			
			if($this->input->post('submit')){

				$data 		=  	$this->Coc_Ordermodel->action($requestData);
				if($data){
					$this->session->set_flashdata('success', 'Order saved successfully.');										
				}else{
					$this->session->set_flashdata('error', 'Try Later.');
				}
					
				redirect('admin/cocstatement/cocorders/index'); 			
			} 
			
			if($this->input->post('allocate_certificate')){
				$data 			=  	$this->Stock_Model->action($requestData);	

				if($data){
					$inv_id = $this->db->select('*')->from('coc_orders')->where(['id' => $requestData['order_id']])->get()->row_array();
					$userdata1				= 	$this->Plumber_Model->getList('row', ['id' => $requestData['user_id']]);
					
					if ($inv_id) {
						
						$invoicedata = $this->db->select('*')->from('invoice')->where(['inv_id' => $inv_id['inv_id']])->get()->row_array();
						if($invoicedata['email_track']!='0'){
							$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '8', 'emailstatus' => '1']);
					
							if($notificationdata){
								$body 	= str_replace(['{Plumbers Name and Surname}', '{order type}', '{method of delivery}', '{tracking number}'], [$userdata1['name'].' '.$userdata1['surname'], $coctype[$invoicedata['coc_type']],  $deliverycard[$invoicedata['delivery_type']], $invoicedata['tracking_no']], $notificationdata['email_body']);
								$this->CC_Model->sentMail($userdata1['email'], $notificationdata['subject'], $body);
							}
						}	
						
						if($invoicedata['sms_track']!='0'){
							if($this->config->item('otpstatus')!='1'){
								$smsdata 	= $this->Communication_Model->getList('row', ['id' => '8', 'smsstatus' => '1']);
					
								if($smsdata){
									$sms = str_replace(['{order type}', '{method of delivery}', '{tracking number}'], [$coctype[$invoicedata['coc_type']], $deliverycard[$invoicedata['delivery_type']], $invoicedata['tracking_no']], $smsdata['sms_body']);
									$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
								}
							}
						}
						
						$template = $this->db->select('id,email_active,category_id,email_body,subject')->from('email_notification')->where(['email_active' => '1', 'id' => '17'])->get()->row_array();
						$orders = $this->db->select('*')->from('coc_orders')->where(['user_id' => $requestData['user_id']])->order_by('id','desc')->get()->row_array();

						if(isset($requestData['email_coc_track'])){
							
							$pagedata['rowData'] = $this->Coc_Model->getListPDF('row', ['id' => $inv_id['inv_id'], 'status' => ['0','1']]);
							$pagedata['settings']		= 	$this->Systemsettings_Model->getList('row');
							$pagedata['currency']    = $this->config->item('currency');
							$pagedata['rowData1'] = $this->Coc_Model->getPermissions('row', ['id' => $inv_id['inv_id'], 'status' => ['0','1']]);
							$pagedata['rowData2'] = $this->Coc_Model->getPermissions1('row', ['id' => $inv_id['inv_id'], 'status' => ['0','1']]);
							$html = $this->load->view('pdf/coc', (isset($pagedata) ? $pagedata : ''), true);
						  
							$pdfFilePath = ''.$inv_id['inv_id'].'.pdf';
							$filePath = FCPATH.'assets/inv_pdf/';
							$this->pdf->loadHtml($html);
							$this->pdf->setPaper('A4', 'portrait');
							$this->pdf->render();
							$output = $this->pdf->output();
							file_put_contents($filePath.$pdfFilePath, $output);
							
							$cocTypes = $orders['coc_type'];
							$mail_date = date("d-m-Y", strtotime($orders['created_at']));
							 
							
							$array1 = ['{Plumbers Name and Surname}','{date of purchase}', '{Number of COC}','{COC Type}'];
							$array2 = [$userdata1['name']." ".$userdata1['surname'], $mail_date, $orders['quantity'], $this->config->item('coctype')[$cocTypes]];

							$body = str_replace($array1, $array2, $template['email_body']);

							if ($template['email_active'] == '1') {

								$this->CC_Model->sentMail($userdata1['email'],$template['subject'],$body,$filePath.$pdfFilePath);
							}
						}
						
						if(isset($requestData['sms_coc_track'])){
							if($this->config->item('otpstatus')!='1'){
								$smsdata 	= $this->Communication_Model->getList('row', ['id' => '17', 'smsstatus' => '1']);
								
								if($smsdata){
									$sms = str_replace(['{number of COC}'], [$orders['quantity']], $smsdata['sms_body']);
									$this->sms(['no' => $userdata1['mobile_phone'], 'msg' => $sms]);
								}
							}
						}
						

					}
					$this->session->set_flashdata('success', 'Order allocated successfully.');
				} 
				else{
					$this->session->set_flashdata('error', 'Try Later.');
				} 
				redirect('admin/cocstatement/cocorders/index'); 			
			}
		}

		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();	
		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();
		$pagedata['checkpermission'] = $this->checkUserPermission('7', '2');
		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['deliverycard']	= 	$deliverycard; 
		$pagedata['coctype']		= 	$coctype;
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

		$checkpermission	=	$this->checkUserPermission('7', '2');

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

				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/cocstatement/cocorders/index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit">
									<i class="fa fa-pencil-alt"></i></a>																	
								</div>';
				}else{
					$action = '';
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
										'action'		=> 	$action														
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
