<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
	}
	
	public function index()
	{
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['company'] 		= $this->getCompanyList();
		$pagedata['plumberstatus'] 	= $this->config->item('plumberstatus');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
		
	}

	public function action($id='')
	{
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
		$pagedata['designation'] 		= $this->config->item('designation');
		$pagedata['criminalact'] 		= $this->config->item('criminalact');
		$pagedata['designation2'] 		= $this->config->item('designation2');
		$pagedata['plumberstatus'] 		= $this->config->item('plumberstatus');
		$pagedata['registerprocedure'] 	= $this->config->item('registerprocedure');
		$pagedata['acknowledgement'] 	= $this->config->item('acknowledgement');
		$pagedata['codeofconduct'] 		= $this->config->item('codeofconduct');
		$pagedata['declaration'] 		= $this->config->item('declaration');
		$pagedata['result'] 		= $this->Plumber_Model->getList('row', ['id' => $id, 'status' => ['0','1']]);
		// if(isset($_REQUEST['exit']) && $_REQUEST['exit']==1){
		
		// }
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/plumber/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTPlumber()
	{
// 		print '<pre>';
// print_r($this->config->item('designation2')[1]);
// print '</pre>';
// exit;
		

		$post 			= $this->input->post();
		// $post['columns'][0]['search']['value'] = 98765432;

		$totalcount 	= $this->Plumber_Model->getList('count', ['status' => ['0','1']]+$post);
		//	$results 		= $this->Plumber_Model->getList('all', ['status' => ['0','1'],'search' =>['value'=>'admin']]+$post);
		$results 		= $this->Plumber_Model->getList('all', ['status' => ['0','1']]+$post);

		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				// isset($this->config->item('designation2')[$result["designation"]]) ? $this->config->item('designation2')[$result["designation"]] : ''
				// ;
				$designation 				= isset($this->config->item('designation2')[$result["designation"]]) ? $this->config->item('designation2')[$result["designation"]] : '';
				$status 				= isset($this->config->item('plumberstatus')[$result["status"]]) ? $this->config->item('plumberstatus')[$result["status"]] : '';

				$totalrecord[] = 	[
										'reg_no' 		=> 	$result['reg_no'],
										'name' 			=> 	$result['name'],
										'surname' 		=> 	$result['surname'],
										//	'designation' 	=> 	$result['designation'],
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

	public function ajaxskillaction()
	{
		$post 				= $this->input->post();
		print '<pre>';
print_r($post);
print '</pre>';
exit;
		
		if(isset($post['action']) && $post['action']=='delete'){
			$result = $this->Plumber_Model->deleteSkillList($post['skillid']);
		}else{
			$post['user_id'] 	= $this->getUserID();
			if(isset($post['action']) && $post['action']=='edit'){
				$result['skillid'] = $post['skillid'];
			}else{
				$result = $this->Plumber_Model->action($post);
			}
			
			$result = $this->Plumber_Model->getSkillList('row', ['id' => $result['skillid']]);
		}
		
		if($result){
			// $result['date'] = date('d-m-Y',strtotime($result['date']));
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
	}
}

