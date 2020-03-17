<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Index extends CC_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Renewal_Model');
		$this->load->model('Plumber_Model');
	 	$this->load->model('Coc_Model');
	 	$this->load->model('Communication_Model');
	}
	

	public function index($pagestatus='',$id='')
	{

		$this->checkUserPermission('22', '1');

		if($id!=''){

			$this->checkUserPermission('22', '2', '1');

			$result = $this->Renewal_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/accounts/Accounts/'); 
			}
		}
		
		if($this->input->post()){

			$this->checkUserPermission('22', '2', '1');

			$requestData 	= 	$this->input->post();	
			$requestData['status']	= '1';	
			$id	= $requestData['editid'];			
			$data 	=  $this->Auditor_Model->action2($requestData);
			if($data) $message = 'Records '.(($id=='') ? 'created' : 'updated').' successfully.';	

			if(isset($data)){
				$this->session->set_flashdata('success', $message);
				
				$invtype 		= $this->config->item('invtype');
				$invoicedata 	= $this->db->select('*')->from('invoice')->where(['inv_id' => $id])->get()->row_array();
				$userdata		= $this->Plumber_Model->getList('row', ['id' => $invoicedata['user_id']]);
				
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '15', 'emailstatus' => '1']);
				
				if($notificationdata){
					$body 	= str_replace(['{Plumbers Name and Surname}', '{payment recieved for}'], [$userdata['name'].' '.$userdata['surname'], $invoicedata['description']], $notificationdata['email_body']);
					$this->CC_Model->sentMail($userdata['email'], $notificationdata['subject'], $body);
				}
				
				if($this->config->item('otpstatus')!='1'){
					$smsdata 	= $this->Communication_Model->getList('row', ['id' => '15', 'smsstatus' => '1']);
		
					if($smsdata){
						$sms = str_replace(['{payment recieved for}', $invoicedata['description'], $smsdata['sms_body']]);
						$this->sms(['no' => $userdata['mobile_phone'], 'msg' => $sms]);
					}
				}
				
				$notificationdata 	= $this->Communication_Model->getList('row', ['id' => '16', 'emailstatus' => '1']);
				
				if($notificationdata){
					$body 	= str_replace(['{Plumbers Name and Surname}', '{invocie type}'], [$userdata['name'].' '.$userdata['surname'], $invtype[$invoicedata['inv_type']]], $notificationdata['email_body']);
					$this->CC_Model->sentMail($userdata['email'], $notificationdata['subject'], $body);
				}
				
				if($this->config->item('otpstatus')!='1'){
					$smsdata 	= $this->Communication_Model->getList('row', ['id' => '16', 'smsstatus' => '1']);
		
					if($smsdata){
						$sms = str_replace(['{invocie type}', $invtype[$invoicedata['inv_type']], $smsdata['sms_body']]);
						$this->sms(['no' => $userdata['mobile_phone'], 'msg' => $sms]);
					}
				}
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			redirect('admin/accounts/renewal_plumber/index'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['checkpermission'] 		= $this->checkUserPermission('22', '2');
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/accounts/renewal_plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	public function DTAccounts()
	{
		$post 			= $this->input->post();
		$post['status'] = '1';
		$totalcount 	= $this->Renewal_Model->getList('count',$post);
		$results 		= $this->Renewal_Model->getList('all', $post);
		$checkpermission	=	$this->checkUserPermission('22', '2');
		// echo json_encode($totalcount); die;
		$totalrecord 	= [];
		if(count($results) > 0)
		{	
			foreach($results as $result)
			{
				$internal_inv = "";
				$originalDate=$result['created_at'];
				$newDate = date("d-m-Y", strtotime($originalDate));
				if($result['status'] == '1'){
					$status = "Paid";
					$internal_inv = $result['internal_inv'];
				}
				else{
					$status = "Unpaid";
					if($checkpermission){
						$internal_inv = '<form class="form" method="post"><div class="table-action"><input type="text" name="internal_inv"><input type="hidden" name="editid" value="'.$result['inv_id'].'"><input type="submit" value="Update"></i></div></form>';
					}else{
						$internal_inv = '';
					}
					/*if($result['userstatus'] == '1'){
						
						if($checkpermission){

							$internal_inv = '<div class="table-action"><a href="'.base_url().'admin/accounts/renewal_plumber/Index/Deletefunc/'.$result['inv_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></div>';
						}else{
							$internal_inv = '';
						}						
					}
					*/
				}

				if ($result['total_cost']!='') {
      $amt = $this->config->item('currency').' '.$result['total_cost'];
      }else{
      	$amt = $result['total_cost'];
      }

				$totalrecord[] = 	[      
					'inv_id' 		=> 	$result['inv_id'],
					'created_at'    =>  $newDate,
					'name' 		    => 	$result['name'].' '.$result['surname'],
					'registration_no' => $result['registration_no'],
					'description'   =>  $result['description'],
					'total_cost'    => 	$amt,
					'action'	    => 	'

					<div class="col-md-6">
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf"  target="_blank">
					<img src="'.base_url().'assets/images/pdf.png" height="50" width="50">
					</div></a>

					',

					'status'    		=> 	$status,
					'internal_inv' 		=> 	$internal_inv

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

	public function Deletefunc($id)
	{		
		$result = $this->Renewal_Model->deleteid($id);
		if($result == '1'){
			$url = FCPATH."assets/inv_pdf/".$id.".pdf";
			unlink($url);
			$this->session->set_flashdata('success', 'Record was Deleted');
		}
		else{
			$this->session->set_flashdata('error', 'Error to delete the Record.');		
		}

		$this->index();
		redirect('admin/accounts/renewal_plumber/Index/'); 
	}	
}


