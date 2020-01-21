<?php 

class cda_types extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Cda_types_model'));        
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view()
 {
   $data['page_title'] = "CDA Types";
   $data['main_content'] = $this->load->view("cda_types/cda_types_view",$data,TRUE);
   $this->load->view('admin/index', $data);

 }
 public function insert(){
  $activity = $this->input->post('activity');
  $start_date = $this->input->post('start_date');
  $end_date = $this->input->post('end_date');
  $cpdPoints = $this->input->post('cpdPoints');
  $productCode = $this->input->post('product_code');
  $CPDStream = $this->input->post('CPDstreams');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $str_start_date = strtotime($start_date);
  $str_end_date = strtotime($end_date);
  $db_date_start = date("Y-m-d",$str_start_date);
  $db_date_end = date("Y-m-d",$str_end_date);
  $data = array('Activity' => $activity,'StartDate' => $db_date_start,'EndDate' => $db_date_end,'Points' => $cpdPoints,'ProductCode' => $productCode,'CPDStream' => $CPDStream,'isActive' => $check_val,'isApproved' => '0','isRejected' => '0' );
  // print_r($data);die;
  $this->Cda_types_model->insert($data);
  $this->session->set_flashdata('CDA_add_sucess','CDA Types Added Sucessfully');
  redirect('cda_types/view');

}
public function edit_view(){
  $data = array();
  $data['CPD_Id'] = $this->uri->segment(3);
  //$this->session->set_userdata('Cpd_ID',$CPD_Id);
  $select = "SELECT `ProductCode`,`Activity`,`StartDate`,`EndDate`,`CPDStream`,`Points`,`isActive` FROM `cdaactivities` WHERE `CDAActivityID`='".$data['CPD_Id']."'";
  
  // echo $select;die;
  $data['records'] = $this->db->query($select)->result();
  $data['page_title'] = "CDA Types";
  $data['main_content'] = $this->load->view("cda_types/cda_types_update",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function get_udpate($CPDID){

  $activity = $this->input->post('activity');
  $start_date = $this->input->post('start_date');
  $end_date = $this->input->post('end_date');
  $cpdPoints = $this->input->post('cpdpoints');
  $productCode = $this->input->post('product_code');
  $CPDStream = $this->input->post('CPDstreams');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $str_start_date = strtotime($start_date);
  $str_end_date = strtotime($end_date);
  $db_date_start = date("Y-m-d",$str_start_date);
  $db_date_end = date("Y-m-d",$str_end_date);
  $data = array('Activity' => $activity,'StartDate' => $db_date_start,'EndDate' => $db_date_end,'Points' => $cpdPoints,'ProductCode' => $productCode,'CPDStream' => $CPDStream,'isActive' => $check_val,'isApproved' => '0','isRejected' => '0' );
  $this->Cda_types_model->update($data,$CPDID);
  $this->session->set_flashdata('CDA_update_sucess','CDA Types Updated Sucessfully');
  redirect('cda_types/view');

}

public function get_ajaxpagination_view_active(){
        // POST data
  $postData = $this->input->post();
     // Get data
  $data = $this->Cda_types_model->getAssessment_ajax_active($postData);

  echo json_encode($data);
}
public function get_ajaxpagination_view_archive(){
       // POST data
 $postData = $this->input->post();
     // Get data
 $data = $this->Cda_types_model->getAssessment_ajax_archive($postData);

 echo json_encode($data);
}
public function addToArchive($CDA_Id){
  $update_query = "UPDATE `cdaactivities` SET `isActive`='0' WHERE `CDAActivityID`='".$CDA_Id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('CDA_archive_sucess','CDA Types Added to Archive Sucessfully');
  redirect('cda_types/view');
 
}
public function addToActive($CDA_Id){
  $update_query = "UPDATE `cdaactivities` SET `isActive`='1' WHERE `CDAActivityID`='".$CDA_Id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('CDA_active_sucess','CDA Types Added to Active Sucessfully');
  redirect('cda_types/view');
 
}
public function delete($CDA_Id){
  $delete_query = "DELETE FROM `cdaactivities` WHERE `CDAActivityID`='".$CDA_Id."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('CDA_delete_sucess','CDA Types Added to Active Sucessfully');
  redirect('cda_types/view');
 
}

}

