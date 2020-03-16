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

			if($requestData['submit']=='submit'){
				$data 	=  $this->Renewal_Model->action($requestData);
				if($data) $message = 'Managearea Type '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Renewal_Model->changestatus($requestData);
				$message		= 	'Managearea Type deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/accounts/Index/'); 
		}
		
		$pagedata['notification'] 			= $this->getNotification();
		$pagedata['provincelist'] 			= $this->getProvinceList();
		$pagedata['checkpermission'] = $this->checkUserPermission('22', '2');
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
					if($result['userstatus'] == '1'){
						$internal_inv = '<div class="table-action"><a href="'.base_url().'admin/accounts/renewal_plumber/Index/Deletefunc/'.$result['inv_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></div>';
					}
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


