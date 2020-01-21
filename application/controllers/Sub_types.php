<?php 
class sub_types extends CI_Controller {

 function __construct() { 
  parent::__construct(); 
  $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
  $this->load->model(array('Subtype_model'));        
  $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
  $this->load->database(); 

}
public function view(){
  $this->db->order_by("subID", "desc");
 $query = $this->db->get("installationtypessub");      	
 $data['records'] = $query->result();
 $this->db->order_by("installationtype_id", "desc");
 $query1 = $this->db->get("InstallationTypes");
 $data['install_records'] = $query1->result();
 $data['page_title'] = "Sub Types";
 $data['main_content'] = $this->load->view("sub_type/sub_type_view",$data,TRUE);
 $this->load->view('admin/index', $data);
}

public function addsubtypes(){
 $query = $this->db->get("InstallationTypes");         
 $data['install_records'] = $query->result();
 $drop_val = $this->input->post('subType_down');
 $subType = $this->input->post('InstallationSubType');
 $active_status = $this->input->post('ContentPlaceHolder1isActive');
 if(isset($active_status)==1){
  $check_val = '1';

}else{
  $check_val = '0';
}
if ($drop_val==0) {
 $check_empty['empty'] = "Please select Installation type";
 $messages = array_merge($data,$check_empty);
 $this->load->view('sub_type_view',$messages);
}
elseif (strlen($subType)>30) {
 $check_len['empty'] = "Only 30 character allowed";
 $messages = array_merge($data,$check_len);
 $this->load->view('sub_type_view',$data);
}else{
  $data = array('InstallationTypeID' => $drop_val,
   'Name' => $subType,
   'isActive' => $check_val
 );
  $installationsub_type = $this->Subtype_model->insert_sub_type($data);
  //$data['subtype_sucess'] = 'Installation subtype created successfully';
  $query = $this->db->get("installationtypessub");
  $data['records'] = $query->result();
  $this->session->set_flashdata('subtype_sucess','Subtype created successfully');
  //$this->load->view("sub_type/sub_type_view",$data); 
  redirect("sub_types/view");

}

}

public function sub_type_update(){
 $this->load->helper('form'); 
 $temp_sel['subtype_data_id'] = $this->uri->segment('3'); 
 //$this->session->set_flashdata('sub_ids',$subtype_data_id);

 $query = $this->db->get_where("installationtypessub",array("subID"=>$temp_sel['subtype_data_id']));
 $temp_sel['data'] = $query->result(); 
 
 //redirect("sub_types/view");
 $temp_sel['page_title'] = "Sub Types";
 $temp_sel['main_content'] = $this->load->view('sub_type/subtype_update',$temp_sel,TRUE);
 $this->load->view('admin/index', $temp_sel);
}

public function sub_type_addupdate($subtypeId){
 $query = $this->db->get("InstallationTypes");         
 $data['install_records1'] = $query->result();
 $drop_val = $this->input->post('subType_down');
 $subType = $this->input->post('InstallationSubType');
 $active_status = $this->input->post('ContentPlaceHolder1isActive');
 if(isset($active_status)==1){
  $check_val = '1';

}else{
  $check_val = '0';
}
if ($drop_val==0) {
 $check_empty['empty'] = "Please select Installation type";
 $messages = array_merge($data,$check_empty);
 $this->load->view('subtype_update',$messages);
}
elseif (strlen($subType)>30) {
 $check_len['empty'] = "Only 30 character allowed";
 $messages = array_merge($data,$check_len);
 $this->load->view('subtype_update',$data);
}else{
  $data = array('InstallationTypeID' => $drop_val,
   'Name' => $subType,
   'isActive' => $check_val
 );
  //print_r($data);exit;
  $installationsub_type = $this->Subtype_model->subtype_update_model($data,$subtypeId);
  //$data['subtype_update_sucess'] = 'subtype updated successfully';
  $query1 = $this->db->get("installationtypessub");
  $data1['records'] = $query1->result();
  $this->session->set_flashdata('subtype_update','subtype updated successfully');
  redirect("sub_types/view");

}
}
public function addToArchive($subTypeID){
  $update_query = "UPDATE `installationtypessub` SET `isActive`='0' WHERE `subID`='".$subTypeID."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Archive_subtype','Sub Type Added To Archive sucessfully');
  redirect("sub_types/view");
}
public function addToActive($subTypeID){
  $update_query = "UPDATE `installationtypessub` SET `isActive`='1' WHERE `subID`='".$subTypeID."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Active_subtype','Sub Type Added To Active sucessfully');
  redirect("sub_types/view");
}
public function deletesub($subTypeID){
  $delete_query = "DELETE FROM `installationtypessub` WHERE `subID`='".$subTypeID."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('delete_subtype','Sub Type Deleted sucessfully');
  redirect("sub_types/view");
}
}
?>