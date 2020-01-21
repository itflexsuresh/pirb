<?php 
class plumber_performance_type extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->library(array('form_validation', 'session', 'email', 'pagination'));
		$this->load->model(array('Plumber_performance_model'));        
		$this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
		$this->load->database(); 

	}
	public function view(){
		$data = array();
		$data['page_title'] = "PLUMBER PERFORMANCE TYPE";
		$data['main_content'] = $this->load->view('plumber_performance_types/plumber_performance_view',$data,TRUE);
		$this->load->view('admin/index', $data);
	}
	public function insert(){
		$performance_type = $this->input->post('performance_type');
		$points = $this->input->post('Performance_Point_Allocation');
		$performance_check = $this->input->post('limitted_period');
		$date = $this->input->post('start_date');
		$active = $this->input->post('isActive_box');

		if ($performance_check=='on' && $date!='') {
			$performance_check1 = 1;
			$archive_date = $date;
			$date1 = strtotime($archive_date);
			$date2 = date('Y-m-d',$date1);
			
		}else{
			$performance_check1 = 0;
			$archive_date = 0;
		}
		if ($active=='on') {
			$check_val = 1;
		}else{
			$check_val = 0;
		}
		$data = array('Type' =>$performance_type,'Points' =>$points,'isCompany' =>$performance_check1,'isActive' =>$check_val,'Archivedatee' =>$date2,'isDeleted' =>'1' );
		$this->Plumber_performance_model->insert($data);
		$this->session->set_flashdata('insert_sucess','Insert Sucessfully');
		redirect('plumber_performance_type/view');
	}
	public function get_ajaxpagination_view_active(){
		       // POST data
		$postData = $this->input->post();
   //print_r($postData);die;

     // Get data
		$data = $this->Plumber_performance_model->get_ajax_active($postData);

		echo json_encode($data);
	}
	/// Archive
	public function get_ajaxpagination_view_archive(){
		// POST data
		$postData = $this->input->post();
   //print_r($postData);die;

     // Get data
		$data = $this->Plumber_performance_model->get_ajax_archive($postData);

		echo json_encode($data);
	}
	public function edit_view(){
		$data['performance__ID'] = $this->uri->segment(3);
		//$this->session->set_userdata('Per_ID',$performance__ID);
		$sql = "SELECT `Type`,`Points`,`isActive`,`isCompany`,`Archivedatee`  FROM `performancetypes` WHERE `PerformanceID`='".$data['performance__ID']."'";

		$query = $this->db->query($sql);
		$data['page_title'] = "PLUMBER PERFORMANCE TYPE";
		$data['records'] = $query->result();
		$data['main_content'] = $this->load->view('plumber_performance_types/plumber_performance_edit',$data,TRUE);
		$this->load->view('admin/index', $data);
	}
	public function get_update($performanceID){
		$performance_type = $this->input->post('performance_type');
		$points = $this->input->post('Performance_Point_Allocation');
		$performance_check = $this->input->post('limitted_period');
		$date = $this->input->post('start_date');
		$active = $this->input->post('isActive_box');

		if ($performance_check=='on' && $date!='') {
			$performance_check1 = 1;
			$archive_date = $date;
			$date1 = strtotime($archive_date);
			$date2 = date('Y-m-d',$date1);
			
		}else{
			$performance_check1 = 0;
			$date2 = 0;
		}
		if ($active=='on') {
			$check_val = 1;
		}else{
			$check_val = 0;
		}
		$data = array('Type' =>$performance_type,'Points' =>$points,'isCompany' =>$performance_check1,'isActive' =>$check_val,'Archivedatee' =>$date2,'isDeleted' =>'1' );

		// $d1 = strtotime($date);
		// $new_date = date('Y-m-d',$d1);
		$this->Plumber_performance_model->update($data,$performanceID);
		$this->session->set_flashdata('update_sucess','Update Sucessfully');
		$this->session->unset_userdata('Per_ID');
		redirect('plumber_performance_type/view');
	}
	public function addToArchive($plumberperformanceID){
		$upadate_query = "UPDATE `performancetypes` SET `isActive`='0' WHERE `PerformanceID`='".$plumberperformanceID."'";
		$query = $this->db->query($upadate_query);
		$this->session->set_flashdata('performance_Archive_sucess','Added To Archive Sucessfully');
		redirect('plumber_performance_type/view');
	}
	public function addToActive($plumberperformanceID){
		$upadate_query = "UPDATE `performancetypes` SET `isActive`='1' WHERE `PerformanceID`='".$plumberperformanceID."'";
		$query = $this->db->query($upadate_query);
		$this->session->set_flashdata('performance_active_sucess','Added To Active Sucessfully');
		redirect('plumber_performance_type/view');
	}
	public function delete($plumberperformanceID){
		$delete_query = "DELETE FROM `performancetypes` WHERE `PerformanceID`='".$plumberperformanceID."'";
		$query = $this->db->query($upadate_query);
		$this->session->set_flashdata('performance_delete_sucess','Plumber Performance Deleted Sucessfully');
		redirect('plumber_performance_type/view');
	}
}