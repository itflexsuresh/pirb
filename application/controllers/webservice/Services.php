<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Managearea_Model');
	}
	
	public function national_ranking()
	{
		$extras['extras'] = ['heading' => 'Industry Ranking', 'subheading' => 'National'];
		
		if($this->input->post()){
			$this->form_validation->set_rules('id', 'ID', 'trim|required');
			
			if ($this->form_validation->run()==FALSE) {
				$json = array("status" => "0", "message" => validation_errors(), 'result' => []);
			}else{
				$rollingavg 	= $this->getRollingAverage();
				$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
				$ranking 		= $this->Plumber_Model->performancestatus('all', ['date' => $date, 'archive' => '0', 'overall' => '1']);
				
				if(count($ranking) > 0){
					$result = [];
					
					foreach($ranking as $data){
						$userid = $data['userid'];
						$image 	= $data['image'];
						
						if(file_exists('./assets/uploads/plumber/'.$userid.'/'.$image)){
							$image = base_url().'assets/uploads/plumber/'.$userid.'/'.$image;
						}else{
							$image = '';
						}
						
						$result[] = [
							'id' 		=> $userid,
							'name' 		=> $data['name'],
							'point' 	=> $data['point'],
							'image' 	=> $image
						];
					}
					
					$json = array("status" => "1", "message" => count($result)." Record Found", "result" => $result);
				}else{
					$json = array("status" => "0", "message" => "No Record Found", "result" => []);
				}
			}
		}else{
			$json = array("status" => "0", "message" => "Invalid Request", "result" => []);
		}
		
		echo json_encode($json+$extras);
	}
	
	public function province_ranking()
	{
		$extras['extras'] = ['heading' => 'Industry Ranking', 'subheading' => 'Provincial'];
		
		if($this->input->post()){
			$this->form_validation->set_rules('id', 'ID', 'trim|required');
			
			if ($this->form_validation->run()==FALSE) {
				$json = array("status" => "0", "message" => validation_errors(), 'result' => []);
			}else{
				$post			= $this->input->post();
				
				$userdetail		= $this->getUserDetails($post['id']);
				
				$province 		= $this->Managearea_Model->getListProvince('row', ['id' => $userdetail['province']]);
				$extras['extras']['subheading'] = 'Provincial - '.$province['name'];
				
				$rollingavg 	= $this->getRollingAverage();
				$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
				$ranking 		= $this->Plumber_Model->performancestatus('all', ['date' => $date, 'archive' => '0', 'province' => $userdetail['province']]);
				
				if(count($ranking) > 0){
					$result = [];
					
					foreach($ranking as $data){
						$userid = $data['userid'];
						$image 	= $data['image'];
						
						if(file_exists('./assets/uploads/plumber/'.$userid.'/'.$image)){
							$image = base_url().'assets/uploads/plumber/'.$userid.'/'.$image;
						}else{
							$image = '';
						}
						
						$result[] = [
							'id' 		=> $userid,
							'name' 		=> $data['name'],
							'point' 	=> $data['point'],
							'image' 	=> $image
						];
					}
					
					$json = array("status" => "1", "message" => count($result)." Record Found", "result" => $result);
				}else{
					$json = array("status" => "0", "message" => "No Record Found", "result" => []);
				}
			}
		}else{
			$json = array("status" => "0", "message" => "Invalid Request", "result" => []);
		}
		
		echo json_encode($json+$extras);
	}
}