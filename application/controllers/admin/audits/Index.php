<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	//////////////////
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
	}
	
	public function index($pagestatus='')
	{
		$this->checkUserPermission('25', '1');

		$pagedata['notification'] 	= $this->getNotification();		
		$pagedata['checkpermission'] = $this->checkUserPermission('25', '2');
		$pagedata['pagestatus'] 	= $this->getAuditorPageStatus($pagestatus);
		//$pagedata['company'] 		= $this->getCompanyList();
		
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker', 'inputmask'];
		$data['content'] 			= $this->load->view('admin/audits/index', (isset($pagedata) ? $pagedata : ''), true);
		
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

		$checkpermission	=	$this->checkUserPermission('25', '2');

		$status = 1;

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){	

							if($checkpermission){
					$action = 	'<div class="table-action">
																	<a href="'.base_url().'admin/audits/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																</div>';
				}else{
					$action = '';
				}
							
				$stockcount = 0;
				$totalrecord[] = 	[										
										'name' 			=> 	$result['name']." ".$result['surname'],
										'email' 		=> 	$result['work_phone'],										
										'contactnumber' 		=> 	$result['mobile_phone'],
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
	{
		$this->auditorprofile($id);
	}
	
	public function DTAuditHistory()
	{
		$post 			= $this->input->post();	
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['coc_status' => ['2']]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['coc_status' => ['2']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){	

				$totalrecord[] = 	[										
										'cocno' 			=> 	$result['id'],
										'auditdate' 		=> 	date('d-m-Y', strtotime($result['as_audit_date'])),
										'plumber' 			=> 	$result['u_name'],
										'suburb' 			=> 	$result['cl_suburb_name'],
										'city' 				=> 	$result['cl_city_name'],
										'province' 			=> 	$result['cl_province_name'],
										'cautionary' 		=> 	$result['ar_cautionary_point'],
										'refixcomplete' 	=> 	$result['ar_incomplete_point'],
										'refixincomplete' 	=> 	$result['ar_complete_point'],
										'noaudit' 			=> 	$result['ar_noaudit_point']
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

