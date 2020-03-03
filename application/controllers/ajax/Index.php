<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CC_Model');
		$this->load->model('Plumber_Model');
		$this->load->model('Managearea_Model');
		$this->load->model('Subtype_Model');
		$this->load->model('Noncompliance_Model');
		$this->load->model('Coc_Ordermodel');
		$this->load->model('Reportlisting_Model');
		$this->load->model('Auditor_Reportlisting_Model');
		$this->load->model('Chat_Model');
	}
	
	public function ajaxfileupload()
	{
		$post 			= $this->input->post();
		$path			= strval($post['path']);
		$type			= strval($post['type']);
		
		$result 		= $this->CC_Model->fileUpload('file', $path, $type);
		echo json_encode($result);
	}
	
	public function ajaxsubtype()
	{
		$post = $this->input->post();
		$result = $this->Subtype_Model->getList('all', $post);

		if(count($result)){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0', 'result' => []];
		}

		echo json_encode($json);
	}

	public function ajaxreportlisting()
	{
		$post = $this->input->post();
		$result = $this->Reportlisting_Model->getList('all', $post);

		if(count($result)){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0', 'result' => []];
		}

		echo json_encode($json);
	}

	public function ajaxcity()
	{
		$post = $this->input->post();
		$result = $this->Managearea_Model->getListCity('all', $post);

		if(count($result)){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0', 'result' => []];
		}

		echo json_encode($json);
	}

	public function ajaxcityaction()
	{
		$post 		= $this->input->post();
		$checkname 	= $this->Managearea_Model->citynamevalidation(['name' => $post['city1']]);
		
		if($checkname=='0'){
			$result 	= $this->Managearea_Model->action($post);

			if($result){
				$resultdata = $this->Managearea_Model->getListCity('row', ['id' => $result]);
				$json 	= ['status' => '1', 'result' => $resultdata];
			}else{
				$json 	= ['status' => '0', 'result' => []];
			}
		}else{
			$json 	= ['status' => '2', 'result' => []];
		}
		
		echo json_encode($json);
	}

	public function ajaxsuburb()
	{
		$post = $this->input->post();  
		$result = $this->Managearea_Model->getListSuburb('all', $post);
		
		if(count($result)){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0', 'result' => []];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxsuburbaction()
	{
		$post 	= $this->input->post();
		$checkname 	= $this->Managearea_Model->suburbnamevalidation(['name' => $post['suburb']]);
		
		if($checkname=='0'){
			$result = $this->Managearea_Model->action($post);

			if($result){
				$resultdata = $this->Managearea_Model->getListSuburb('row', ['id' => $result]);
				$json 	= ['status' => '1', 'result' => $resultdata];
			}else{
				$json 	= ['status' => '0', 'result' => []];
			}
		}else{
			$json 	= ['status' => '2', 'result' => []];
		}
		
		echo json_encode($json);
	}

	public function ajaxskillaction()
	{
		$post 				= $this->input->post();
		
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
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxnoncomplianceaction()
	{
		$post 				= $this->input->post();
		
		if(isset($post['action']) && $post['action']=='delete'){
			$result = $this->Noncompliance_Model->delete($post['id']);
		}else{
			if(isset($post['action']) && $post['action']=='edit'){
				$result = $post['id'];
			}else{
				$result = $this->Noncompliance_Model->action($post);
			}
			
			$result = $this->Noncompliance_Model->getList('row', ['id' => $result]);
		}
		
		if($result){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxreviewaction()
	{
		$post 				= $this->input->post();
		
		if(isset($post['action']) && $post['action']=='delete'){
			$result = $this->Auditor_Model->deleteReview($post['id']);
		}else{
			if(isset($post['action']) && $post['action']=='edit'){
				$result = $post['id'];
			}else{
				$result = $this->Auditor_Model->actionReview($post);
			}
			
			$result = $this->Auditor_Model->getReviewList('row', ['id' => $result]);
		}
		
		if($result){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0'];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxauditorreportinglist()
	{
		$post = $this->input->post();  
		$data = $this->Auditor_Reportlisting_Model->getList('row', ['id' => $post['id'], 'status' => ['1']]);
		
		if($data){
			$json = ['status' => '1', 'result' => $data];
		}else{
			$json = ['status' => '0', 'result' => []];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxuserautocomplete()
	{ 
		$post = $this->input->post();

		if($post['type']== 3){
			$data 	=   $this->Coc_Ordermodel->autosearchPlumber($post);
		}else if($post['type']== 6){
			$data 	=   $this->Coc_Ordermodel->autosearchReseller($post);
		}else if($post['type']== 5){
			$data 	=   $this->Coc_Ordermodel->autosearchAuditor($post);
		}

		
		echo json_encode($data);
	}
	
	
	public function ajaxchat()
	{
		$post = $this->input->post();  
		$result = $this->Chat_Model->getList('all', $post);
		
		if(count($result)){
			$json = ['status' => '1', 'result' => $result];
		}else{
			$json = ['status' => '0', 'result' => []];
		}
		
		echo json_encode($json);
	}
	
	public function ajaxchataction()
	{
		$post 	= $this->input->post();
		$result = $this->Chat_Model->action($post);

		if($result){
			$json 	= ['status' => '1', 'result' => []];
		}else{
			$json 	= ['status' => '0', 'result' => []];
		}
	
		echo json_encode($json);
	}

	public function ajaxdtaudithistory()
	{
		$post 			= $this->input->post();
		$totalcount 	= $this->Auditor_Model->getReviewList('count', $post);
		$results 		= $this->Auditor_Model->getReviewList('all', $post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				$totalrecord[] = 	[
										'date' 				=> 	date('d-m-Y', strtotime($result['created_at'])),
										'auditor' 			=> 	$result['auditorname'],
										'installationtype' 	=> 	$result['installationtypename'],
										'subtype' 			=> 	$result['subtypename'],
										'statementname' 	=> 	$result['statementname'],
										'finding' 			=> 	$this->config->item('reviewtype')[$result['reviewtype']]
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
	
	
	public function ajaxotp(){
		$userdata 	= $this->getUserDetails();
		$userid 	= $userdata['id'];
		$mobile 	= $userdata['mobile_phone'];
		$otp		= rand (10000, 99999);
		
		$query = $this->db->get_where('otp', ['user_id' => $userid]);
		if ($query->num_rows() == 1) {
			$this->db->update('otp', ['otp' => $otp, 'mobile' => $mobile], ['user_id' => $userid]);
		}else{
			$this->db->insert('otp', ['otp' => $otp, 'mobile' => $mobile, 'user_id' => $userid]);
		}		
		
		if($this->config->item('otpstatus')=='1'){
			echo $otp;
		}else{
			$this->sms(['no' => $mobile, 'msg' => 'One Time Password is '.$otp]);
			echo '';
		}
	}

	public function ajaxotpverification($requestdata){
		$result = $this->db->from('otp')->where(['otp' => $requestdata['otp'], 'user_id' => $requestdata['userid']])->get()->row_array();
		if ($result) {
			return '1';
		}else{
			return '0';
		}
	}
}
