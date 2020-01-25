<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reportlist_Model');
	}
	
	public function index($id='')
	{

		if($id!=''){
			$result = $this->Reportlist_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				//redirect('plumber/registration'); 
			}
		}
		
		if($this->input->post()){

			$requestData 	= 	$this->input->post();

			if($requestData['submit'] == 'submit')

			{	

				$data 	=  $this->Reportlist_Model->action($requestData);

				
				if($data) $message = 'Report '.(($id == '') ? 'created' : 'updated').' successfully.';
			}

			// else
			// {
			// 	$data 			= 	$this->Reportlist_Model->changestatus($requestData);
			// 	$message		= 	'Installation Type deleted successfully.';
			// }

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('auditor/reportlisting/index'); 
		}
		
		

		$pagedata['notification'] 	= $this->getNotification();
		//$pagedata['province'] 		= $this->getProvinceList();
		//$pagedata['installationtype'] = $this->getInstallationTypeList();		

		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/reportlisting/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	
	
	public function DTReportlist()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Reportlist_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Reportlist_Model->getList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'name' 		=> 	$result['installationtype'],
										'name' 		=> 	$result['subtype'],
										//'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'	=> 	'
															<div class="table-action">
																<a href="'.base_url().'auditor/reportlisting/index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
}
