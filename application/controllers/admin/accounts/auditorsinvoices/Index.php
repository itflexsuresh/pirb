<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Index extends CC_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
		$this->load->model('Plumber_Model');
	 	$this->load->model('Coc_Model');
	 	$this->load->model('Systemsettings_Model');

	 	$this->checkUserPermission('23', '1');

	}

	public function index($pagestatus='',$id='')
	{	
		
		if($this->input->post()){

			$this->checkUserPermission('23', '2', '1');

			$requestData 	= 	$this->input->post();	
			$requestData['status']	= '1';	
			$id	= $requestData['editid'];			
			$data 	=  $this->Auditor_Model->action2($requestData);
			if($data) $message = 'Records '.(($id=='') ? 'created' : 'updated').' successfully.';	

			if(isset($data)){
				$this->session->set_flashdata('success', $message);
				$this->generatepdf($id);
			}			
			else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			redirect('admin/accounts/auditorsinvoices/index'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['msggrp'] 				= $this->config->item('messagegroup');
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/accounts/auditorsinvoices/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}

	
	public function DTAccounts()
	{
		$post 			= $this->input->post();
		// $post['adminsearch'] = '1';
		
		$totalcount 	= $this->Auditor_Model->getInvoiceList('count',['statuslist' => ['0','1']]+$post);
		$results 		= $this->Auditor_Model->getInvoiceList('all', ['statuslist' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('23', '2');

		// echo json_encode($totalcount); die;
		$totalrecord 	= [];
		if(count($results) > 0)
		{	
			foreach($results as $result)
			{
				$internal_inv = "";	
				$originalDate = isset($result['created_at']) && $result['created_at']!='1970-01-01' && $result['created_at']!='0000-00-00' ? date('d-m-Y', strtotime($result['created_at'])) : '';
				if($result['status'] == '0'){

					if($checkpermission){
					$internal_inv = '<form class="form" method="post"><div class="table-action"><input type="text" name="internal_inv"><input type="hidden" name="editid" value="'.$result['inv_id'].'"><a href="'.base_url().'admin/accounts/auditorsinvoices/index/index" data-toggle="tooltip" data-placement="top" title="Update"><input type="submit" value="Update"></i></a></div></form>';
				}else{
					$internal_inv = '';
				}

					$status = "Unpaid";
					
				}
				elseif($result['status'] == '1'){
					$status = "Paid";
					$internal_inv = $result['internal_inv'];
				}

				$action = '
					<div class="col-md-6">
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf"  target="_blank">
					<img src="'.base_url().'assets/images/pdf.png" height="50" width="50">
					</div></a>
					';

					if ($result['total_cost']!='') {
      $amt = $this->config->item('currency').' '.$result['total_cost'];
      }else{
      	$amt = $result['total_cost'];
      }
				
				if($result['status'] != '2'){
					$totalrecord[] = 	[      
						'inv_id' 		=> 	$result['invoice_no'],
						'created_at'    =>  $originalDate,
						'name' 		    => 	$result['name'].' '.$result['surname'],
						'description'   =>  $result['description'],
						'total_cost'    => 	$amt,
						'action'	    => 	$action,

						'status'    		=> 	$status,
						'internal_inv' 		=> 	$internal_inv

					];
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

	public function generatepdf($inv_id)
	{
		$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
		$designation =	$this->config->item('designation2')[$rowData['designation']];					
		$cocreport = $this->cocreport($inv_id, 'PDF Invoice Auditor', [
			'description' => $rowData['description'], 
			'type' => '2', 
			'logo' => base_url()."assets/uploads/auditor/".$rowData["file2"],
			'sublogo' => base_url()."assets/images/paid.png",
			'terms' => "30 Days"
		]);
	}

}


