<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Coc_Details_Comment_Model');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		$pagedata['coctype'] 		= $this->config->item('coctype');	
		$pagedata['cocstatus'] 		= $this->config->item('cocstatus');	
		$pagedata['auditstatus'] 	= $this->config->item('auditstatus');	
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'validation', 'datepicker'];
		$data['content'] 			= $this->load->view('admin/cocstatement/cocdetails/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTCocDetails()
	{
		$post 			= $this->input->post();
		
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['status' => ['0','1']]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$coctype 	= isset($this->config->item('coctype')[$result['type']]) ? $this->config->item('coctype')[$result['type']] : '';
				$status 	= isset($this->config->item('cocstatus')[$result['coc_status']]) ? $this->config->item('cocstatus')[$result['coc_status']] : '';
				
				$totalrecord[] = 	[
										'cocno' 		=> 	$result['id'],
										'coctype' 		=> 	$coctype,
										'status' 		=> 	$status,
										'plumber' 		=> 	($result['usertype']=='3') ? $result['name'] : '-',
										'reseller' 		=> 	($result['usertype']=='6') ? $result['name'] : '-',
										'auditor' 		=> 	($result['usertype']=='5') ? $result['name'] : '-',
										'action'		=> 	'
																<div class="table-action">
																	<a href="'.base_url().'admin/cocstatement/cocdetails/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
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
		$userid = $this->getUserID();
		
		if($this->input->post()){
			$requestData 	= 	$this->input->post();
			
			if(isset($requestData['submit']) && $requestData['submit']=='comment'){
				$requestData['user_id'] = $userid;
				$requestData['coc_id'] 	= $id;
				
				$data 	  =  $this->Coc_Details_Comment_Model->action($requestData);
				$message  =	'Comment is successfully added.';
				$redirect = 'admin/cocstatement/cocdetails/index/action/'.$id;
			}elseif(isset($requestData['submit']) && $requestData['submit']=='details'){
				$requestData['coc_id'] 	= $id;
				
				$data 	  =  $this->Coc_Model->actionCocDetails($requestData);
				$message  =	'Successfully saved.';
				$redirect = 'admin/cocstatement/cocdetails/index';
			}
		
			if($data) $this->session->set_flashdata('success', $message);
			else $this->session->set_flashdata('error', 'Try Later.');
		
			redirect($redirect); 
		}
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		$pagedata['certificateno']	= $id;
		$pagedata['cocrecall']		= $this->config->item('cocrecall');
		$pagedata['cocreason']		= $this->config->item('cocreason');
		$pagedata['comments']		= $this->Coc_Details_Comment_Model->getList('all', ['coc_id' => $id]);
		$pagedata['result']			= $this->Coc_Model->getCOCLog('row', ['coc_id' => $id]);
		
		$data['plugins']			= ['validation'];
		$data['content'] 			= $this->load->view('admin/cocstatement/cocdetails/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction($id, ['pagetype' => 'view', 'roletype' => $this->config->item('roleadmin')], ['redirect' => 'admin/cocstatement/cocdetails/index/action/'.$id, 'userid' => $plumberid]);
	}
	

}
