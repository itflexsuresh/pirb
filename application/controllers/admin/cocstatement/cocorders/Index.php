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
	}
	
	public function index($id='')
	{
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
			$requestData 	= 	$this->input->post();
			
			if($this->input->post('submit')){

				$data 			=  	$this->Coc_Ordermodel->action($requestData);
				if($data) $this->session->set_flashdata('success', 'Order saved successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
			
				redirect('admin/cocstatement/cocorders/index'); 			
			} 
			if($this->input->post('allocate_certificate')){
				$data 			=  	$this->Stock_Model->action($requestData);	

				if($data) $this->session->set_flashdata('success', 'Order allocated successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
			
				redirect('admin/cocstatement/cocorders/index'); 			
			}
		}

		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();	
		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();
		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['deliverycard']	= 	$this->config->item('purchasecocdelivery');
		$pagedata['coctype']		= 	$this->config->item('coctype');
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
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/cocstatement/cocorders/index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit">
																	<i class="fa fa-pencil-alt"></i></a>																	
																</div>
															'														
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
