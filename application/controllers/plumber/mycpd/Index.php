<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mycpd_Model');
		
	}
	
	public function index($pagestatus='',$id='')
	{
		$userid = $this->getUserID();
		$this->mycptindex($pagestatus,$id,$userid);
		
	}

	// Plumber Reg number search
	public function userRegDetails()
	{

		$postData = $this->input->post();		  
		if($postData['type'] == 3)
		{
			$data 	=   $this->Mycpd_Model->autosearchPlumberReg($postData);
		}

	  	// echo json_encode($data); exit;

		if(!empty($data) && count($data)>0 ) {
		?>
			<ul id="name-list">
			<?php
			foreach($data as $key=>$val) {
				$reg_no = $val["registration_no"];
				$name_surname = $val["name"].' '.$val["surname"];
				// if(isset($val["surname"])){
				// 	$name = $name.' '.$val["surname"];
				// }
			?>
			<li onClick="selectuser('<?php echo $reg_no; ?>','<?php echo $val["id"]; ?>','<?php echo $name_surname; ?>');"><?php echo $reg_no; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}

		//CPD Activity search
	public function activityDetails()
	{

		$postData = $this->input->post();		  
		if($postData)
		{
			$data 	=   $this->Mycpd_Model->autosearchActivity($postData);
		}
	  	// echo json_encode($data); exit;

		if(!empty($data)) {
		?>
			<ul id="name-list1">
			<?php
			foreach($data as $key=>$val) {
				//print_r($val['startdate']);die;
				if ($val['startdate']) {
					$startDate1 = date('m-d-Y', strtotime($val['startdate']));
				}
				$activity 		= $val["activity"];
				$startDate 		= $startDate1;
				$cpd_Stream 	= $this->config->item('cpdstream')[$val["cpdstream"]];
				$cpd_Stream_id 	= $val["cpdstream"];
				$cpdPoints 		= $val["points"];
			?>
			<li onClick="selectActivity('<?php echo $activity; ?>','<?php echo $val["id"]; ?>','<?php echo $startDate; ?>','<?php echo $cpd_Stream; ?>','<?php echo $cpdPoints; ?>','<?php echo $cpd_Stream_id; ?>');"><?php echo $activity; ?></li>
			<?php } ?>
			</ul>
<?php 	} 
	}

	public function DTCpdQueue()
	{
		$post 			= $this->input->post();

		$totalcount 	= $this->Mycpd_Model->getQueueList('count', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
		$results 		= $this->Mycpd_Model->getQueueList('all', ['status' => [$post['pagestatus']], 'user_id' => [$post['user_id']]]+$post);
		//print_r($results);die;
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $result){
				if ($result['status']==0) {
					$statuz 	= 'Pending';
					$awardPts 	= '';
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					';
				}elseif($result['status']==3){
					$statuz 	= 'Not Submitted';
					$awardPts 	= '';
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
					</div>
					';
				}
			
				else{
					$statuz 	= $this->config->item('approvalstatus')[$result['status']];
					if ($statuz!='Rejected') {
						$awardPts 	= $result['points'];
					}else{
						$awardPts 	= 0;
					}
					
					$action 	= '
					<div class="table-action">
					<a href="'.base_url().'plumber/mycpd/index/index/'.$post['pagestatus'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
					</div>
					';
				}

				// Attachments
				if ($result['file1']!='') {
					$attach = '<div class="table-action">
					<a href="'.base_url().'assets/uploads/cpdqueue/'.$result['file1'].'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Attachments"><i class="fa fa-download"></i></a>
					</div>';
				}else{
					$attach = '';
				}


				$totalrecord[] = 	[
					'date' 					=> 	date("m-d-Y", strtotime($result['cpd_start_date'])),
					'acivity' 				=> 	$result['cpd_activity'],
					'streams' 				=> 	$this->config->item('cpdstream')[$result['cpd_stream']],
					'comments' 				=> 	$result['comments'],
					'points' 				=> 	$awardPts,
					'attachment' 			=> 	$attach,
					'status' 				=> 	$statuz,
					'action'				=> 	$action
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

	public function year_cron(){
		$userid 					= $this->getUserID();
		$currentyear 				= strtotime(date("Y"));
		$requestData1['flag'] 		= '2';
		
		$date = $this->db->select('*')->from('cpd_activity_form')->where('user_id',$userid)->get()->result_array();
		foreach ($date as $key => $value) {
			$DBYear = date("Y",strtotime($value['created_at']));
			$strDBYear  = strtotime(date("Y",strtotime($value['created_at'])));
			if ($strDBYear<$currentyear) {
				
				$query = $this->db->update('cpd_activity_form', $requestData1, ['id' => $value['id']]);
			}

		}
		
	}

	public function getAttachment($data){
		
		$query = $this->db->select('*')->from('cpd_activity_form')->where('id',$data)->get()->row_array();

		if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $query['file1'])){
        $filepath = FCPATH.'assets/uploads/cpdqueue/'.$query['file1'];
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
	        die();
        }
    } else {
        die("Invalid file name!");
    }

		
	}


}
