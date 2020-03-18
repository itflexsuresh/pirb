<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compulsory_audit extends CC_Controller 
{
	//////////////////
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');

		$this->checkUserPermission('26', '1');
	}
	
	public function index($id='')
	{
		if($id!=''){

			$this->checkUserPermission('26', '2', '1');

			$result = $this->Auditor_Model->getlisting('row', ['id' => $id]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/audits/Compulsory_audit/index'); 
			}
		}
		if($this->input->post()){
			$this->checkUserPermission('26', '2', '1');

			$requestData 	= 	$this->input->post();

			if(isset($requestData['user_id_hide'])) 	$user_id 	= $requestData['user_id_hide'];
			
			if($requestData['submit']=='submit'){

				$recordcheck = $this->Auditor_Model->recordcheck($user_id);
				//print_r($recordcheck);die;
				if ($recordcheck) {
					$extraparam = $recordcheck['allocation'];
				}else{
					$extraparam = 0;
				}
				
				$data 	=  $this->Auditor_Model->audit_compulsory($requestData, $extraparam);
				if($data) $message = 'Compulsory Audit Listing '.(($id=='') ? 'created' : 'updated').' successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/audits/Compulsory_audit/index'); 
		}

		$pagedata['notification'] 	= $this->getNotification();		
		$pagedata['checkpermission'] = $this->checkUserPermission('26', '2');
		
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/audits/compulsoryaudit/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}	
	
	public function DTListings()
	{
		
		$post 			= $this->input->post();	
		$totalcount 	= $this->Auditor_Model->getlisting('count',$post);
		$results 		= $this->Auditor_Model->getlisting('all',$post);

		$checkpermission	=	$this->checkUserPermission('26', '2');

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){	

			if($checkpermission){
					$action = 	'<div class="table-action">
																	<a href="'.base_url().'admin/audits/Compulsory_audit/index/'.$result['uid'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																</div>';
				}else{
					$action = '';
				}
							
				$stockcount = 0;
				$totalrecord[] = 	[										
										'name' 			=> 	$result['name']." ".$result['surname'],
										'reg' 			=> 	$result['registration_no'],										
										'allocation' 	=> 	$result['allocation'],
										'complete' 		=> 	$result['completed'],
										'action'		=> 	$action
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

