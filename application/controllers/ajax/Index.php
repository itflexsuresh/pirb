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
	
	public function ajaxuserautocomplete()
	{ 
		$post = $this->input->post();

		if($post['type']== 3){
			$data 	=   $this->Coc_Ordermodel->autosearchPlumber($post);
		}else{
			$data 	=   $this->Coc_Ordermodel->autosearchReseller($post);
		}
		
		echo json_encode($data);
	}
	
}
