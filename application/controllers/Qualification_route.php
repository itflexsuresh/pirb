<?php 

class qualification_route extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Qualification_route_model'));        
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view()
 {  
  $data['page_title'] = "Qualification Routes";
  $data['main_content'] = $this->load->view("qualification_route/qualification_route_view",$data,TRUE);
  $this->load->view('admin/index', $data);

}
public function insert(){
  $route = $this->input->post('QualificaionRoutes');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $data = array('Route' => $route, 'isActive' => $check_val );
  $this->Qualification_route_model->insert($data);
  $this->session->set_flashdata('Route_add','Qualification Route Added Sucessfully');
  redirect('qualification_route/view');
}
public function edit_view(){
  $data['RoutID'] = $this->uri->segment(3);
  $select = "SELECT `QualificationID`,`Route`,`isActive` FROM `qualificationroute` WHERE `QualificationID`='".$data['RoutID']."'";
  $data['records'] = $this->db->query($select)->result();
  $data['page_title'] = "Qualification Routes";
  $data['main_content'] = $this->load->view("qualification_route/qualification_route_update",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function get_update($qualificationID){
  $route = $this->input->post('QualificaionRoutes');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $data = array('Route' => $route, 'isActive' => $check_val );
  $this->Qualification_route_model->update($data,$qualificationID);
  $this->session->set_flashdata('Route_update','Qualification Route Updated Sucessfully');
  redirect('qualification_route/view');
}

public function get_ajaxpagination_view_active(){
        // POST data
 $postData = $this->input->post();
     // Get data
 $data = $this->Qualification_route_model->getAssessment_ajax_active($postData);

 echo json_encode($data);
}
public function get_ajaxpagination_view_archive(){
       // POST data
 $postData = $this->input->post();
     // Get data
 $data = $this->Qualification_route_model->getAssessment_ajax_archive($postData);

 echo json_encode($data);
}
public function addToArchive($QId){
  // print_r($QId);
  // die;
  $update_query = "UPDATE `qualificationroute` SET `isActive`='0' WHERE `QualificationID`='".$QId."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Route_archive','Qualification Route Added To Archive Sucessfully');
  redirect('qualification_route/view');

}
public function addToActive($QId){
  // print_r($QId);
  // die;
  $update_query = "UPDATE `qualificationroute` SET `isActive`='1' WHERE `QualificationID`='".$QId."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Route_acive','Qualification Route Added To Active Sucessfully');
  redirect('qualification_route/view');

}
public function delet_Record($QId){
  $delete_query = "DELETE FROM `qualificationroute` WHERE `QualificationID`='".$QId."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('Route_delete','Qualification Route Deleted Sucessfully');
  redirect('qualification_route/view');
}


}
?>