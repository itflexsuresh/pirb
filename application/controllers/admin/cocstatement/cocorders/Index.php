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
		if($id!=''){
			$result = $this->Coc_Ordermodel->getCocorderList('row', ['id' => $id]);
			$comments = $this->Ordercomments_Model->getCommentsList('all', ['order_id' => $id]);
			
			$stock = $this->Stock_Model->getRange('row',[]);

			if($comments){
				$pagedata['comments'] = $comments;
			}
			if($stock){
				$pagedata['stock'] = $stock;
			}
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/cocstatement/cocorders/index'); 
			}
		}
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			if($this->input->post('submit')){

				$data 			=  	$this->Coc_Ordermodel->action($requestData);

				if($data) $this->session->set_flashdata('success', 'order saved successfully.');
				else $this->session->set_flashdata('error', 'Try Later.');
			
				redirect('admin/cocstatement/cocorders/index'); 			
			} 
			if($this->input->post('allocate_certificate')){
				$data 			=  	$this->Stock_Model->action($requestData);	

				if($data) $this->session->set_flashdata('success', 'order allocated successfully.');
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
		$totalcount 	= $this->Coc_Ordermodel->getCocorderList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Coc_Ordermodel->getCocorderList('all', ['status' => ['0','1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				
				$coctype = isset($this->config->item('coctype')[$result['coc_type']]) ? $this->config->item('coctype')[$result['coc_type']] : '';
				$deliverytype = isset($this->config->item('deliverytype')[$result['delivery_type']]) ? $this->config->item('coctype')[$result['delivery_type']] : '';

				$totalrecord[] 	= 	[
										'id' 			=> 	$result['id'],
										'user_id' 		=> 	$result['name']." ".$result['surname'],
										'coc_type' 		=> 	$coctype,
										'delivery_type'	=> 	$deliverytype,
										'quantity' 		=> 	$result['quantity'],	
										'status' 		=> 	$this->config->item('payment_status')[$result['status']],
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
		}
		
		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
		
	}

	public function userDetails()
	{ 
		$post = $this->input->post();

		if($post['type']== 3){
			$data 	=   $this->Coc_Ordermodel->autosearchPlumber($post);
		}else{
			$data 	=   $this->Coc_Ordermodel->autosearchReseller($post);
		}
		
		echo json_encode($data);
	}

	public function add_comments()
	{ 
		$post = $this->input->post();		
		$data 	=   $this->Ordercomments_Model->action($post);
		
		echo json_encode($data);
	}

}
