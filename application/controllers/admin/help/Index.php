<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Help_Model');

		$this->checkUserPermission('31', '1');
	}
	
	public function index($id='')
	{
		if($id!=''){
			$this->checkUserPermission('31', '2', '1');

			$result = $this->Help_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
			if($result){
				$pagedata['result'] = $result;
			}else{
				$this->session->set_flashdata('error', 'No Record Found.');
				redirect('admin/help/index'); 
			}
		}
		
		if($this->input->post()){
			$this->checkUserPermission('31', '2', '1');

			$requestData 	= 	$this->input->post();

			if($requestData['submit']=='submit'){
				$data 	=  $this->Help_Model->action($requestData);
				if($data) $message = 'Help '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Help_Model->changestatus($requestData);
				$message		= 	'Help deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/help/index'); 
		}
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['helpgroup'] 			= $this->config->item('helpgroup');
		$pagedata['checkpermission'] 	= $this->checkUserPermission('31', '2');
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'tinymce'];
		$data['content'] 				= $this->load->view('admin/help/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTHelp()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Help_Model->getList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Help_Model->getList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('31', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/help/index/index/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
									<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
								</div>';
				}else{
					$action = '';
				}

				$totalrecord[] = 	[
										'title' 	=> 	$result['title'],
										'typename' 	=> 	$result['typename'],
										'status' 	=> 	$this->config->item('statusicon')[$result['status']],
										'action'	=> 	$action
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
