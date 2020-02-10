<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coc_Orders extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Ordermodel');
		$this->load->model('CC_Model');
	}
	
	public function index()
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

//echo '<pre>';print_r($requestData ); die;

				$this->form_validation->set_rules('created_at', '* Date','required');
				// $this->form_validation->set_rules('inv_id', '* Invoice No','required');
				$this->form_validation->set_rules('purchaser_type', '* Plumber or Reseller','required');
				$this->form_validation->set_rules('plumber_name', '* Fill name','required');
				$this->form_validation->set_rules('reseller_name', '* Fill name','required');
				$this->form_validation->set_rules('quantity', '* No of Coc','required');
				//$this->form_validation->set_rules('coc_type', '* Coc Type is','required');
				//$this->form_validation->set_rules('delivery_type', '* Delivary Type','required');
				
				$this->form_validation->set_rules('status', '* Payment Status','required');
				$this->form_validation->set_rules('internal_inv', '* Internal Invoice','required');
				$this->form_validation->set_rules('tracking_no', '* Tracking No is','required');
				
				if($this->form_validation->run() != FALSE)
				{
					
			//echo '<pre>';print_r($requestData ); die;
					$data 				=  	$this->Coc_Ordermodel->adminadd($requestData);			
				}
	}

		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();	
		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$data['plugins']			= 	['validation', 'datepicker','datatables', 'datatablesresponsive', 'sweetalert'];

		$pagedata['result'] 		= $this->Coc_Ordermodel->getCocorderList('row', ['status' => ['0','1']]);
 		
		$data['content'] 			= 	$this->load->view('admin/cocmanagement/cocmanagementstatement/coc_order_index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}


public function cocorderType()
	{ 

		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Ordermodel->getCocorderList('count', ['status' => ['0','1']]+$post);

		$results 		= $this->Coc_Ordermodel->getCocorderList('all', ['status' => ['0','1']]+$post);


		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				
				$coctype = isset($this->config->item('coctype')[$result['coc_type']]) ? $this->config->item('coctype')[$result['coc_type']] : '';

				if ($result['delivery_type'] == 0) {
						$result2['new_delivery'] = ' ';
				}
				else{
						$result2['new_delivery'] = $this->config->item('purchasecocdelivery')[$result['delivery_type']];
				}
				$result['created_at']	= 	date('d-m-Y');
				$totalrecord[] = 	[
										'id' 			=> 	$result['id'],

										'user_id' 		=> 	$result['name']." ".$result['surname'],
										//'coc_type'	=> 	$result['coc_type'],
										'coc_type' 		=> 	$coctype,

										'delivery_type'=> 	$result2['new_delivery'],

										 'quantity' 	=> 	$result['quantity'],	
										 'status' 		=> 	$this->config->item('payment_status')[$result['status']],
										'inv_id' 		=> 	$result['inv_id'],
										'internal_inv' 	=> 	$result['internal_inv'],
									
										'created_at'	=> 	$result['created_at'],

										'address' 		=> 	$result['address'],
										'tracking_no' 	=> 	$result['tracking_no'],
																				
										'action'	=> 	'<div class="table-action">
																<a href="'.base_url().'admin/cocmanagement/cocmanagementstatement/coc_order_index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit">
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
 
		  $postData = $this->input->post();

		  $this->load->model('Coc_Ordermodel');

		  if($postData['type'] == 3)
		  {
		  	$data 	=   $this->Coc_Ordermodel->autosearchPlumber($postData);
		  }
		  else
		   $data 	=   $this->Coc_Ordermodel->autosearchReseller($postData);

		//print_r($data); exit;

		  //echo json_encode($data);

		   if(!empty($data)) {
			?>
			<ul id="name-list">
			<?php
			foreach($data as $key=>$val) {
				$name = $val["name"];
				if(isset($val["surname"]))
					$name = $name.' '.$val["surname"];
			?>
			<li onClick="selectuser('<?php echo $val["name"]; ?>','<?php echo $val["id"]; ?>','<?php echo $val["coc_purchase_limit"]; ?>');"><?php echo $name; ?></li>
			<?php } ?>
			</ul>
			<?php } 
		}

	}
