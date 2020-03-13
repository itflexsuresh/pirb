<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compulsory_audit extends CC_Controller 
{
	//////////////////
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
	}
	
	public function index($id='')
	{
		if($id!=''){
			print($id);die;
		}
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Auditor_Model->audit_compulsory($requestData);
				if($data) $message = 'Compulsory Audit Listing '.(($id=='') ? 'created' : 'updated').' successfully.';
			}
			// else{
			// 	$data 			= 	$this->Installationtype_Model->changestatus($requestData);
			// 	$message		= 	'Installation Type deleted successfully.';
			// }

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/audits/compulsoryaudit/index'); 
		}

		$pagedata['notification'] 	= $this->getNotification();		
		
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/audits/compulsoryaudit/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}	
	
	public function DTAuditors()
	{
		
		$post 			= $this->input->post();	
		/////////////
		// if ($post['pagestatus']=='2') {
		// 	$post['pagestatus'] = '0';
		// }
		$totalcount 	= $this->Auditor_Model->getAuditorList('count', ['type' => '5', 'status' => [$post['pagestatus']]]+$post);
		$results 		= $this->Auditor_Model->getAuditorList('all', ['type' => '5', 'status' => [$post['pagestatus']]]+$post);
		//print_r($results);die;

		$status = 1;

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){				
				$stockcount = 0;
				$totalrecord[] = 	[										
										'name' 			=> 	$result['name']." ".$result['surname'],
										'email' 		=> 	$result['work_phone'],										
										'contactnumber' 		=> 	$result['mobile_phone'],
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/audits/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																</div>
															'
									];
			}
		}
		
		$json = array(
			// "draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}

	public function action($id='')
	{die;
		//$this->auditorprofile($id);
	}

	// Plumber Reg number search
	public function userRegDetails()
	{

		$postData = $this->input->post();		  
		if($postData['type'] == 3)
		{
			$data 	=   $this->Auditor_Model->autosearchPlumberReg($postData);
		}

	  	// echo json_encode($data); exit;

		if(!empty($data) && count($data)>0 ) {
		?>
			<ul id="name-list">
			<?php
			foreach($data as $key=>$val) {
				$reg_no = $val["registration_no"];
				$name_surname = $val["name"].' '.$val["surname"];
				// if(isset($val["surname"])){
				// 	$name = $name.' '.$val["surname"];
				// }
			?>
			<li onClick="selectuser('<?php echo $reg_no; ?>','<?php echo $val["id"]; ?>','<?php echo $name_surname; ?>');"><?php echo $name_surname; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}
	
}

