<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resellers_Model');
	}
	
	public function index()
	{
		$this->checkUserPermission('29', '1');

		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['checkpermission'] = $this->checkUserPermission('29', '2');

		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask'];
		$data['content'] 			= $this->load->view('admin/resellers/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}	
	
	public function DTResellers()
	{
		
		$post 			= $this->input->post();		
		$totalcount 	= $this->Resellers_Model->getList('count', ['type' => '6', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);
		$results 		= $this->Resellers_Model->getList('all', ['type' => '6', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);

		$checkpermission	=	$this->checkUserPermission('29', '2');

		$status = 1;

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){	

			if($checkpermission){
					$action = 	'<div class="table-action">
									<a href="'.base_url().'admin/resellers/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								</div>';
				}else{
					$action = '';
				}

				if($result['count'] > 0){
					$stockcount = $result['count'];
				}
				else{
					$stockcount = 0;
				}
				
				$totalrecord[] = 	[										
										'name' 			=> 	$result['name'],
										'email' 		=> 	$result['email'],										
										'contactnumber' => 	$result['mobile_phone'],
										'stockcount' 	=> 	$stockcount,
										'action'		=> 	$action
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

	public function action($id='')
	{
		$this->checkUserPermission('29', '2', '1');

		$this->resellersprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'applications'], ['redirect' => 'admin/resellers/index','adminvalue' => '1']);
	}
}

