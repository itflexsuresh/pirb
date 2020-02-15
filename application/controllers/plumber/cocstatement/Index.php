<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Installationtype_Model');
		$this->load->model('Noncompliance_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 			= $this->load->view('plumber/cocstatement/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTCocStatement()
	{
		$userid 		= $this->getUserID();
		$post 			= $this->input->post();
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['2','4','5']]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['user_id' => $userid, 'coc_status' => ['2','4','5']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				if($result['coc_status']=='5'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
				}elseif($result['coc_status']=='2'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/view/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				}
				
				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'cocstatus' 		=> 	$this->config->item('cocstatus')[$result['coc_status']],
										'purchased' 		=> 	date('d-m-Y', strtotime($result['purchased_at'])),
										'coctype' 			=> 	$this->config->item('coctype')[$result['type']],
										'customer' 			=> 	$result['customer_name'],
										'address' 			=> 	$result['customer_address'],
										'company' 			=> 	$result['company'],
										'action'			=> 	'
																	<div class="table-action">
																		'.$action.'
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
	
	public function view($id)
	{
		$this->coclogaction($id, ['pagetype' => 'view'], ['redirect' => 'plumber/cocstatement/index']);
	}
	
	public function action($id)
	{
		$this->coclogaction($id, ['pagetype' => 'action'], ['redirect' => 'plumber/cocstatement/index']);
	}
	
	public function coclogaction($id, $pagedata=[], $extras=[])
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			$data 	=  $this->Coc_Model->actionCocLog($requestData);
		
			if($data) $this->session->set_flashdata('success', 'Thanks for Logging the COC.');
			else $this->session->set_flashdata('error', 'Try Later.');
		
			redirect($extras['redirect']); 
		}
		
		$userid							= $this->getUserID();
		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid]);
		$specialisations 				= explode(',', $userdata['specialisations']);
		
		$pagedata['userdata'] 			= $userdata;
		$pagedata['cocid'] 				= $id;
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['installationtype']	= $this->getInstallationTypeList();
		$pagedata['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => []]);
		$pagedata['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => $userdata['designation'], 'specialisations' => $specialisations]);
		$pagedata['noncompliance']		= $this->Noncompliance_Model->getList('all', ['user_id' => $userdata['id']]);
		$pagedata['coclist']			= $this->Coc_Model->getCOCList('row', ['id' => $id]);
		$pagedata['result']				= $this->Coc_Model->getCOCLog('row', ['coc_id' => $id]);
	
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker', 'inputmask'];
		$data['content'] 				= $this->load->view('plumber/cocstatement/action', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
}
