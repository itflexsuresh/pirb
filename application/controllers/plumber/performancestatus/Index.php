<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plumber_Model');
		$this->load->model('Global_performance_Model');
	}
	
	public function index($pagestatus='')
	{
		$userdata 									= $this->getUserDetails();
		$pagedata['myprovinceperformancestatus'] 	= $this->userperformancestatus(['province' => $userdata['province']]);
		$pagedata['performancestatus'] 				= $this->userperformancestatus();
		$pagedata['mycityperformancestatus'] 		= $this->userperformancestatus(['city' => $userdata['city']]);
		
		
		$userid 					= $this->getUserID();
		$rollingavg 				= $this->getRollingAverage();
		$date						= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		$pagestatus					= ($pagestatus=='2' ? '1' : '0');
		$extraparam					= $pagestatus=='0' ? ['date' => $date] : [];
		
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['pagestatus'] 	= $pagestatus;
		$pagedata['warning']		= $this->Global_performance_Model->getWarningList('all', ['status' => ['1']]);
		$pagedata['results']		= $this->Plumber_Model->performancestatus('all', ['plumberid' => $userid, 'archive' => $pagestatus]+$extraparam);
		
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation', 'echarts'];
		$data['content'] 			= $this->load->view('plumber/performancestatus/index', (isset($pagedata) ? $pagedata : ''), true);
		
		$this->layout2($data);
	}
	
	public function DTPerformancestatus()
	{
		$userid 		= $this->getUserID();
		$rollingavg 	= $this->getRollingAverage();
		$date			= date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));
		
		$post 			= $this->input->post();
		if($post['archive']=='0'){
			$post['date'] = $date;
		}
		$totalcount 	= $this->Plumber_Model->performancestatus('count', ['plumberid' => $userid]+$post);
		$results 		= $this->Plumber_Model->performancestatus('all', ['plumberid' => $userid]+$post);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			$filepath	= base_url().'assets/uploads/cpdqueue/';
			$pdfimg 	= base_url().'assets/images/pdf.png';
			
			foreach($results as $result){	
				$attachment = $result['attachment'];
				if($attachment!=''){						
					$explodeattachment 	= explode('.', $attachment);
					$extfile 			= array_pop($explodeattachment);
					$file 				= (in_array($extfile, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$attachment;
					$attachment 		= '<a href="'.$filepath.$attachment.'" target="_blank"><img src="'.$file.'" width="50"></a>';
				}else{
					$attachment 		= '';
				}
							
				$totalrecord[] = 	[
										'date' 				=> 	date('d-m-Y', strtotime($result['date'])),
										'type' 				=> 	$result['type'],
										'comments' 			=> 	$result['comments'],
										'point' 			=> 	$result['point'],
										'attachment' 		=> 	$attachment,
										'action'			=> 	'
																	<div class="table-action">	
																		<a href="javascript:void(0);" class="archive" data-id="'.$result['id'].'" data-flag="'.$result['flag'].'"><i class="fa fa-archive"></i></a>
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
	
	public function action()
	{
		$requestData	=	$this->input->post();
		$data 			= 	$this->Plumber_Model->performancestatusaction($requestData);
		
		if(isset($data)) $this->session->set_flashdata('success', 'Successfully archived.');
		else $this->session->set_flashdata('error', 'Try Later.');
			
		redirect('plumber/performancestatus/index'); 
	}
}
