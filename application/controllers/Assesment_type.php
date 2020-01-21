<?php 
class assesment_type extends CI_Controller {

 function __construct() { 
  parent::__construct(); 
  $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
  $this->load->model(array('Assesment_model'));        
  $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
  $this->load->database(); 

}
public function view(){
  $data = array();
  $data['page_title'] = "Assesment Types";
  $data['main_content'] = $this->load->view('assesment_type/assesment_add_view',$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function add_assesment(){
	$ass_type = $this->input->post('assesment_type_name');
	$ass_rate = $this->input->post('assesment_rate_name');
 $checked = $this->input->post('ContentPlaceHolder1isActive');
 if(isset($checked)==1){
          //echo "Active";exit;
  $check_val = '1';
}else{
          //echo "Archive";exit;
  $check_val = '0';
}

$data = array('Type' => $ass_type,'Rates' => $ass_rate,'isActive' => $check_val );
$this->Assesment_model->insert($data);
$this->session->set_flashdata('insert_sucess','Assesments Added Sucessfullty');
redirect('assesment_type/view');

}

public function edit_view(){
  $data['assID'] = $this->uri->segment(3);
  $data['page_title'] = "Assesment Types";
  //$this->session->set_userdata('Assesment_ID',$assID);
  $sql = "SELECT `Type`,`Rates`,`isActive`  FROM `assessmenttypes` WHERE `AssessmentTypeID`='".$data['assID']."'";
  $query = $this->db->query($sql);
  $data['records'] = $query->result();
  $data['main_content'] = $this->load->view('assesment_type/assesment_upate_view',$data,TRUE);
  $this->load->view('admin/index', $data);
}

public function udpate($assId){

  $update_assesments = $this->input->post('assesment_type_name_update');
  $update_rates = $this->input->post('assesment_rate_name_update');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
          //echo "Active";exit;
    $check_val = '1';
  }else{
          //echo "Archive";exit;
    $check_val = '0';
  }
  $data = array('Type' => $update_assesments,'Rates' => $update_rates,'isActive' => $check_val );
// print_r($data);
// die;
  $this->Assesment_model->update($data,$assId);

  $this->session->unset_userdata('Assesment_ID');
  $this->session->set_flashdata('sucess_update','Update Sucessfully');
  redirect('assesment_type/view');
}

public function addToArchive($AssessmentID){
  $update_query = "UPDATE `assessmenttypes` SET `isActive`='0' WHERE `AssessmentTypeID`='".$AssessmentID."'";
  $query = $this->db->query($update_query);
  //$this->session->set_flashdata('archive_update','Assesment Type Added To Archive Sucessfully');
  $this->session->set_flashdata('archive_update','Assesment Type Added To Archive Sucessfully');

  //echo $this->session->flashdata('archive_update');die;
  redirect('assesment_type/view');
}
public function addToActive($AssessmentID){
  $update_query = "UPDATE `assessmenttypes` SET `isActive`='1' WHERE `AssessmentTypeID`='".$AssessmentID."'";
  $query = $this->db->query($update_query);
  //$this->session->set_flashdata('active_update','Assesment Type Added To Active Sucessfully');
  $this->session->set_flashdata('active_update','Assesment Type Added To Active Sucessfully');
  redirect('assesment_type/view');
}
public function delete($AssessmentID){
  $delete_query = "DELETE `assessmenttypes` WHERE `AssessmentTypeID`='".$AssessmentID."'";
  $query = $this->db->query($delete_query);
  //$this->session->set_flashdata('delete_update','Assesment Type Deleted Sucessfully');
  $this->session->set_flashdata('delete_update','Assesment Type Deleted Sucessfully');
  redirect('assesment_type/view');
}

public function get_ajaxpagination_view_active(){
        // POST data
 $postData = $this->input->post();
   //print_r($postData);die;

     // Get data
 $data = $this->Assesment_model->getAssessment_ajax_active($postData);

 echo json_encode($data);
}
public function get_ajaxpagination_view_archive(){
        // POST data
 $postData = $this->input->post();
   //print_r($postData);die;

     // Get data
 $data = $this->Assesment_model->getAssessment_ajax_archive($postData);

 echo json_encode($data);
}

}