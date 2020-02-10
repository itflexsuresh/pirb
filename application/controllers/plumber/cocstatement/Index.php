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
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['user_id' => $userid, 'coc_status' => ['2','5']]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['user_id' => $userid, 'coc_status' => ['2','5']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				if($result['coc_status']=='2'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
				}elseif($result['coc_status']=='5'){
					$action = '<a href="'.base_url().'plumber/cocstatement/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>';
				}
				
				$totalrecord[] = 	[
										'cocno' 			=> 	$result['id'],
										'cocstatus' 		=> 	$this->config->item('cocstatus')[$result['coc_status']],
										'purchased' 		=> 	date('d-m-Y', strtotime($result['purchased_at'])),
										'coctype' 			=> 	$this->config->item('coctype')[$result['type']],
										'customer' 			=> 	$result['name'],
										'address' 			=> 	$result['address'],
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
	
	public function action($id)
	{
		if($this->input->post()){
			$requestData 	= 	$this->input->post();

			$data 	=  $this->Coc_Model->actionCocLog($requestData);
		
			if(isset($data)) $this->session->set_flashdata('success', 'Log '.(($id=='') ? 'created' : 'updated').' successfully.');
			else $this->session->set_flashdata('error', 'Try Later.');
		
			redirect('plumber/cocstatement/index'); 
		}
		
		$userid							= $this->getUserID();
		$userdata				 		= $this->Plumber_Model->getList('row', ['id' => $userid]);
		$specialisations 				= explode(',', $userdata['specialisations']);
		
		$pagedata['userdata'] 			= $userdata;
		$pagedata['cocid'] 				= $id;
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['installation'] 		= $this->Installationtype_Model->getList('all', ['designation' => [$userdata['designation']], 'specialisations' => []]);
		$pagedata['specialisations']	= $this->Installationtype_Model->getList('all', ['designation' => [$userdata['designation']], 'specialisations' => $specialisations]);
		$pagedata['result']				= $this->Coc_Model->getCOCLog('row', ['coc_id' => $id]);
	
		$data['plugins']				= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 				= $this->load->view('plumber/cocstatement/action', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
}
