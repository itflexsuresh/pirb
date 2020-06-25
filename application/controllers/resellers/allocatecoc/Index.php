<?php
//Resellers Controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resellers_allocatecoc_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Coc_Model');
		$this->load->model('Stock_Model');
		$this->load->model('Communication_Model');
		$this->load->model('Systemsettings_Model');
	}
	
	public function index()
	{
		if($this->input->post()){						
			$requestData 	= 	$this->input->post();

			if(isset($requestData['submit'])=='submit'){								
				if($requestData['user_id_hide'] > 0){
					$requestData1['id'] = $requestData['user_id_hide'];
					$pagedata['result'] 	=  $this->Plumber_Model->getList('row',$requestData1, ['users', 'usersdetail', 'usersplumber', 'company']);
					$pagedata['user_id_hide'] = '1';
				}
				else{
					$pagedata['user_id_hide'] = '0';
					$pagedata['result'] 	=  $this->Plumber_Model->getList('row',$requestData, ['users', 'usersdetail', 'usersplumber', 'company']);
					if(empty($pagedata['result']))
						$pagedata['emptyvalue'] = 0;
					else
						$pagedata['emptyvalue'] = 1;
				}

				// echo '<pre>'; print_r($pagedata['result']); exit;
				$resultid['user_id'] = $pagedata['result']['id'];						
				$pagedata['array_orderqty']	=  $this->Resellers_allocatecoc_Model->getqty('row',$resultid);

				$Array_rangeData['coc_status']=['3'];
			 	$Array_rangeData['coctype']=['2'];			 	
			 	$Array_rangeData['user_id'] = $this->getUserID();

				$pagedata['array_range'] =  $this->Coc_Model->getCOCList('all',$Array_rangeData);				
				$pagedata['rangedata']= ['' => 'Select Range']+array_column($pagedata['array_range'], 'id', 'id');

				$pagedata['card'] 	= $this->plumbercard($resultid['user_id']);
			}

			if(isset($requestData['plumberid']) > 0){
				// print_r($requestData);
				$plumberid = $requestData['plumberid'];
				$data 	=  $this->Resellers_allocatecoc_Model->action($requestData);
				if($data) $message = 'Resellers Allocated Coc'.(($plumberid=='') ? 'created' : 'updated').' successfully.';				
				redirect('resellers/cocstatement/index');

			}

		}

		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['company'] 			= $this->getCompanyList();
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['specialisations'] 	= $this->config->item('specialisations');
		$pagedata['userid'] 			= $this->getUserID();
		$pagedata['userdetails'] 		= $this->getUserDetails();

		
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask', 'validation'];
		$data['content'] 			= $this->load->view('resellers/allocatecoc/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
	
	public function userDetails()
	{

		$postData = $this->input->post();		  
		if($postData['type'] == 3)
		{
			$data 	=   $this->Resellers_allocatecoc_Model->autosearchPlumber($postData);
		}
	  	// echo json_encode($data); exit;

		if(!empty($data)) {
		?>
			<ul id="name-list">
			<?php
			foreach($data as $key=>$val) {
				$name = $val["name"];
				if(isset($val["surname"])){
					$name = $name.' '.$val["surname"];
				}
			?>
			<li onClick="selectuser('<?php echo $name; ?>','<?php echo $val["id"]; ?>','<?php echo $val["coc_purchase_limit"]; ?>');"><?php echo $name; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}


	public function pdfgenerate($plumberid){
			
	}

	public function allocate_coc_range(){
		$post = $this->input->post();		  		
		$user_id = $this->getUserID();
		// $rangebalace_coc = isset($post['rangebalace_coc']) && is_int($post['rangebalace_coc']) ? $post['rangebalace_coc'] : 0;
		$stock = $this->Stock_Model->getResellerRange('all',['user_id'=>$user_id],$post['rangebalace_coc']);
		$allocate_start = isset($stock['allocate_start']) ? $stock['allocate_start'] : '';
		$allocate_end = isset($stock['allocate_end']) ? $stock['allocate_end'] : '';

		echo json_encode(['allocate_start'=>$allocate_start,'allocate_end'=>$allocate_end]);
	}
	
}
