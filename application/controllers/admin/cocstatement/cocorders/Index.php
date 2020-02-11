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

	}
	
	public function index()
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

					//echo '<pre>';print_r($requestData ); die;

					$data 				=  	$this->Coc_Ordermodel->adminadd($requestData);			
				
	}

		$userid 					=	$this->getUserID();
		$userdata					= 	$this->getUserDetails();	
		$pagedata['notification'] 	= 	$this->getNotification();
		$pagedata['province'] 		= 	$this->getProvinceList();		
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$userdata1					= 	$this->Plumber_Model->getList('row', ['id' => $userid]);
		$pagedata['userid']			= 	$userid;
		$pagedata['userdata']		= 	$userdata;
		$pagedata['userdata1']		= 	$userdata1;
		$pagedata['username']		= 	$userdata1;
		$pagedata['deliverycard']	= 	$this->config->item('purchasecocdelivery');
		$pagedata['coctype']		= 	$this->config->item('coctype');
		$pagedata['settings']		= 	$this->Systemsettings_Model->getList('row');
		$pagedata['logcoc']			=	$this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['1']]);
		$pagedata['cocpaperwork']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocpaperwork')]);
		$pagedata['cocelectronic']	=	$this->Rates_Model->getList('row', ['id' => $this->config->item('cocelectronic')]);
		$pagedata['postage']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('postage')]);
		$pagedata['couriour']		= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('couriour')]);
		$pagedata['collectedbypirb']= 	$this->Rates_Model->getList('row', ['id' => $this->config->item('collectedbypirb')]);

		$data['plugins']			= 	['validation', 'datepicker','datatables', 'datatablesresponsive', 'sweetalert'];

		$pagedata['result'] 		= $this->Coc_Ordermodel->getCocorderList('row', ['status' => ['0','1']]);
 		
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
				$name = $val["name"].' '.$val["surname"];
			?>
				<li onClick="selectuser('<?php echo $name; ?>','<?php echo $val["id"]; ?>','<?php echo $val["coc_purchase_limit"]; ?>');"><?php echo $name; ?></li>
			<?php } ?>
			</ul>
			<?php } 
		}

	}
