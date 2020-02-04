<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Comment_Model');
		$this->load->model('Systemsettings_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);		
	}
	
	
	public function DTPlumber()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Plumber_Model->getList('count', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$designation 	= isset($this->config->item('designation2')[$result["designation"]]) ? $this->config->item('designation2')[$result["designation"]] : '';
				$status 		= isset($this->config->item('plumberstatus')[$result["plumberstatus"]]) ? $this->config->item('plumberstatus')[$result["plumberstatus"]] : '';

				$totalrecord[] = 	[
										'reg_no' 		=> 	$result['registration_no'],
										'name' 			=> 	$result['name'],
										'surname' 		=> 	$result['surname'],
										'designation' 	=> 	$designation,
										'email' 		=> 	$result['email'],
										'status' 		=> 	$status,
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/plumber/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
		$result = $this->Plumber_Model->getList('row', ['id' => $id, 'type' => '3', 'approvalstatus' => ['0','1'], 'status' => ['1']]);
		if(!$result){
			redirect('admin/plumber/index');
		}
		
		if($this->input->post()){
			$requestData 			= 	$this->input->post();
			$requestData['user_id'] = 	$id;
			
			$plumberdata 	=  $this->Plumber_Model->action($requestData);
				
			if(isset($requestData['submit']) && $requestData['submit']=='approvalsubmit'){
				$commentdata 	=  $this->Comment_Model->action($requestData);				
			}
			
			if($plumberdata || (isset($commentdata) && $commentdata)){
				$data		= '1';
				$message 	= 'Plumber '.(($id=='') ? 'created' : 'updated').' successfully.';
			}
			
			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/plumber/index'); 
		}
		
		$userid			= 	$result['id'];
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['qualificationroute'] = $this->getQualificationRouteList();
		$pagedata['plumberrates'] 		= $this->getPlumberRates();
		$pagedata['company'] 			= $this->getCompanyList();
		
		$pagedata['titlesign'] 			= $this->config->item('titlesign');
		$pagedata['gender'] 			= $this->config->item('gender');
		$pagedata['racial'] 			= $this->config->item('racial');
		$pagedata['yesno'] 				= $this->config->item('yesno');
		$pagedata['othernationality'] 	= $this->config->item('othernationality');
		$pagedata['homelanguage'] 		= $this->config->item('homelanguage');
		$pagedata['disability'] 		= $this->config->item('disability');
		$pagedata['citizen'] 			= $this->config->item('citizen');
		$pagedata['deliverycard'] 		= $this->config->item('deliverycard');
		$pagedata['employmentdetail'] 	= $this->config->item('employmentdetail');
		$pagedata['userid'] 			= $userid;
		$pagedata['result'] 			= $result;
		
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['applicationstatus'] 	= $this->config->item('applicationstatus');
		$pagedata['approvalstatus'] 	= $this->config->item('approvalstatus');
		$pagedata['rejectreason'] 		= $this->config->item('rejectreason');
		$pagedata['plumberstatus'] 		= $this->config->item('plumberstatus');
		$pagedata['specialisations'] 	= $this->config->item('specialisations');
		$pagedata['comments'] 			= $this->Comment_Model->getList('all', ['user_id' => $id]);
		$pagedata['defaultsettings'] 	= $this->Systemsettings_Model->getList('row');
		
		
		$data['plugins']				= ['validation','datepicker'];
		$data['content'] 				= $this->load->view('common/plumber', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
		
		/*
		// if($id!=''){
		// 	$result = $this->Plumber_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
		// 	if($result){
		// 		$pagedata['result'] = $result;
		// 	}else{
		// 		$this->session->set_flashdata('error', 'No Record Found.');
		// 		redirect('admin/plumber/action'); 
		// 	}
		// }
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			if($requestData['submit']=='submit'){
				if(isset($requestData['comments'])){
					$comments=  $this->Comments_Model->action($requestData);
				}
				$data 	=  $this->Plumber_Model->action($requestData);
				if($data) $message = 'Plumber '.(($id=='') ? 'created' : 'updated').' successfully.';
			}else{
				$data 			= 	$this->Plumber_Model->changestatus($requestData);
				$message		= 	'Plumber deleted successfully.';
			}

			if(isset($data)) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
			
			redirect('admin/plumber/index/action/'.$id); 
		}
		
		$pagedata['notification'] 		= $this->getNotification();
		$pagedata['province'] 			= $this->getProvinceList();
		$pagedata['qualificationroute'] = $this->getQualificationRouteList();

		$pagedata['id'] 				= $id;
		$pagedata['titlesign'] 			= $this->config->item('titlesign');
		$pagedata['company'] 			= $this->getCompanyList();
		$pagedata['gender'] 			= $this->config->item('gender');
		$pagedata['racial'] 			= $this->config->item('racial');
		$pagedata['yesno'] 				= $this->config->item('yesno');
		$pagedata['othernationality'] 	= $this->config->item('othernationality');
		$pagedata['homelanguage'] 		= $this->config->item('homelanguage');
		$pagedata['disability'] 		= $this->config->item('disability');
		$pagedata['citizen'] 			= $this->config->item('citizen');
		$pagedata['deliverycard'] 		= $this->config->item('deliverycard');		
		$pagedata['employmentdetail'] 	= $this->config->item('employmentdetail');
		$pagedata['application_status']	= $this->config->item('application_status');
		$pagedata['reject_reason']		= $this->config->item('reject_reason');
		$pagedata['specialisations']	= $this->config->item('specialisations');
		$pagedata['designation'] 		= $this->config->item('designation');
		$pagedata['criminalact'] 		= $this->config->item('criminalact');
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['plumberstatus'] 		= $this->config->item('plumberstatus');
		$pagedata['registerprocedure'] 	= $this->config->item('registerprocedure');
		$pagedata['acknowledgement'] 	= $this->config->item('acknowledgement');
		$pagedata['codeofconduct'] 		= $this->config->item('codeofconduct');
		$pagedata['declaration'] 		= $this->config->item('declaration');
		$pagedata['result'] 			= $this->Plumber_Model->getList('row', ['id' => $id, 'status' => ['0','1','3']]);
		$pagedata['comments_result'] 	= $this->Comments_Model->getList('all', ['user_id' => $id]);
		
		// if(isset($_REQUEST['exit']) && $_REQUEST['exit']==1){
		
		// }
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('common/plumber', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
		*/
	}
}

