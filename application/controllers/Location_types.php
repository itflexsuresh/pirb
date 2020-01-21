<?php 

class location_types extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Location_types_model'));        
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view()
 {
  $data['records'] = $this->db->get('locationtypes');
  $data['page_title'] = "Location Types";
  $data['main_content'] = $this->load->view("location_types/location_type_view",$data,TRUE);
  $this->load->view('admin/index', $data);

}
public function insert(){
  $locationType = $this->input->post('location_type');
  $Address = $this->input->post('Address_location');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $data = array('Location' => $locationType, 'Address' => $Address, 'isActive' => $check_val );
  // print_r($data);die;
  $this->Location_types_model->insert($data);
  $this->session->set_flashdata('location_add_sucess','Location Type Added Sucessfully');
  redirect('location_types/view');
}
public function edit_view(){
  $data['LoationID'] = $this->uri->segment(3);
  //$this->session->set_userdata('locID',$LoationID);
  $select = "SELECT `LocationID`,`Location`,`Address`,`isActive` FROM `locationtypes` WHERE `LocationID`='".$data['LoationID']."'";
  $query = $this->db->query($select);
  $data['records'] = $query->result();
  $data['page_title'] = "Location Types";
  $data['main_content'] = $this->load->view("location_types/location_type_update",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function get_update($locID){
  $locationType = $this->input->post('location_type');
  $Address = $this->input->post('Address_location');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $data = array('Location' => $locationType, 'Address' => $Address, 'isActive' => $check_val );
  // print_r($data);die;
  $this->Location_types_model->update($data,$locID);
  $this->session->set_flashdata('location_update_sucess','Location Updated Added Sucessfully');
  redirect('location_types/view');
}

public function get_ajaxpagination_view_active(){
        // POST data
 $postData = $this->input->post();
   //print_r($postData);die;

     // Get data
 $data = $this->Location_types_model->getAssessment_ajax_active($postData);

 echo json_encode($data);
}
public function get_ajaxpagination_view_archive(){
       // POST data
 $postData = $this->input->post();
   //print_r($postData);die;

     // Get data
 $data = $this->Location_types_model->getAssessment_ajax_archive($postData);

 echo json_encode($data);
}
public function addToArchive($LocID){
  $update_query = "UPDATE `locationtypes` SET `isActive`='0' WHERE `LocationID`='".$LocID."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('location_archive_sucess','Location Added To Archive Sucessfully');
  redirect('location_types/view');
}
public function addToActive($LocID){
  $update_query = "UPDATE `locationtypes` SET `isActive`='1' WHERE `LocationID`='".$LocID."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('location_active_sucess','Location Added To Active Sucessfully');
  redirect('location_types/view');
}
public function delete($LocID){
  $delete_query = "DELETE FROM `locationtypes` WHERE `LocationID`='".$LocID."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('location_delete_sucess','Location Delteed Sucessfully');
  redirect('location_types/view');
}

}
?>