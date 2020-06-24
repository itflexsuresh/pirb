<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coc_Model');
		$this->load->model('Coc_Details_Comment_Model');

		$this->checkUserPermission('6', '1');
	}
	
	public function index()
	{
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();
		$pagedata['coctype'] 		= $this->config->item('coctype');	
		$pagedata['cocstatus'] 		= $this->config->item('cocstatus');	
		$pagedata['auditstatus'] 	= $this->config->item('auditstatus');	
		$pagedata['checkpermission'] = $this->checkUserPermission('6', '2');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'validation', 'datepicker', 'select2'];
		$data['content'] 			= $this->load->view('admin/cocstatement/cocdetails/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	public function DTCocDetails()
	{
		$post 			= $this->input->post();
		
		$totalcount 	= $this->Coc_Model->getCOCList('count', ['status' => ['0','1']]+$post);
		$results 		= $this->Coc_Model->getCOCList('all', ['status' => ['0','1']]+$post);

		$checkpermission	=	$this->checkUserPermission('6', '2');
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){

				if($checkpermission){
					$coctype 	= isset($this->config->item('coctype')[$result['type']]) ? $this->config->item('coctype')[$result['type']] : '';
					$status 	= isset($this->config->item('cocstatus')[$result['coc_status']]) ? $this->config->item('cocstatus')[$result['coc_status']] : '';
					
					if($result['coc_status']=='1' && $result['coc_orders_status']=='6'){
						$status = 'Recalled';
					}
					
					if($result['coc_status']!='1'){
						$action		= 	'<div class="table-action">
											<a href="'.base_url().'admin/cocstatement/cocdetails/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
										</div>';
					}else{
						$action 	= 	'';
					}

				}else{
					$action = '';
				}



				
				$totalrecord[] = 	[
										'cocno' 		=> 	$result['id'],
										'coctype' 		=> 	$coctype,
										'status' 		=> 	$status,
										'plumber' 		=> 	($result['u_type']=='3') ? $result['u_name'] : '-',
										'reseller' 		=> 	($result['resellername']!='') ? $result['resellername'] : (($result['u_type']=='6') ? $result['u_name'] : '-'),
										'auditor' 		=> 	($result['auditorname']!='') ? $result['auditorname'] : '-',
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
	
	
	public function action($id)
	{
		$this->checkUserPermission('6', '2', '1');
		
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
				
				if($data=='4') $message = 'User has less permitted coc.';
				elseif($data=='5') $message = 'Same user cannot be selected.';
				else $message  = 'Successfully saved.';
				
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
		$pagedata['result']			= $this->Coc_Model->getCOCList('row', ['id' => $id]);
		$pagedata['cocdetails']		= $this->Coc_Model->getCOcDetails('row', ['coc_id' => $id]);
		
		$data['plugins']			= ['validation', 'select2'];
		$data['content'] 			= $this->load->view('admin/cocstatement/cocdetails/action', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);
	}
	
	
	public function viewcoc($id, $plumberid)
	{
		$this->coclogaction(
			$id, 
			['pagetype' => 'view', 'roletype' => $this->config->item('roleadmin'), 'electroniccocreport' => 'admin/cocstatement/cocdetails/index/electroniccocreport/'.$id.'/'.$plumberid, 'noncompliancereport' => 'admin/cocstatement/cocdetails/index/noncompliancereport/'.$id.'/'.$plumberid], 
			['redirect' => 'admin/cocstatement/cocdetails/index/action/'.$id, 'userid' => $plumberid]
		);
	}
	
	public function electroniccocreport($id, $userid)
	{	
		$this->pdfelectroniccocreport($id, $userid);
	}
	
	public function noncompliancereport($id, $userid)
	{	
		$this->pdfnoncompliancereport($id, $userid);
	}
}
