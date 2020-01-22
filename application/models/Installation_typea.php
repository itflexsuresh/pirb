<?php 

class installation_type extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Installation_type_model'));        
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view()
 {

   $query = $this->db->get("InstallationTypes");
   $this->db->order_by("installationtype_id", "desc");
   $data['records'] = $query->result();
   $data['page_title'] = "Installation Types";
   $data['main_content'] = $this->load->view("installation_type/installation_type",$data, TRUE);
   $this->load->view('admin/index', $data);
      	//$this->load->view("installation_type"); 

 }
 public function installationtype_insert(){
      	//echo "hii";exit;
      // 	 if ($this->input->post('ContentPlaceHolder1btn_add'))
      // {
  $form_validate_rules = array(
    array('field' => 'InstallationType', 'label' => 'Installation Type', 'rules' => 'trim|required|callback_install_check'));
  $this->form_validation->set_rules($form_validate_rules);
  if ($this->form_validation->run() == FALSE ) {

    redirect("installation_type/view");
  }
  else{

        //validation true
    $chech_val;
    $InstallationType = $this->input->post('InstallationType');
    $checked = $this->input->post('ContentPlaceHolder1isActive');
    if(isset($checked)==1){
          //echo "Active";exit;
      $check_val = '1';
    }else{
          //echo "Archive";exit;
      $check_val = '0';
    }

    $data = array(
      'installation_type'=>$InstallationType,
      ' is_active'=>$check_val
    );

    
    $installation_type = $this->Installation_type_model->insert_installation_type($data);
        //$data['installtion_sucess'] = 'Installation type created successfully';
    $this->session->set_flashdata('installation_sucess','Installation type created successfully');
    $query = $this->db->get("InstallationTypes");
    $data['records'] = $query->result();
         //$this->load->view("installation_type/installation_type",$data); 
    redirect('installation_type/view');
  }

      // }
}

public function install_check(){
        //echo "hi";exit;
 $valid_InstallationType = $this->input->post('InstallationType');



 $rows = $this->Installation_type_model->installation_ckeck($valid_InstallationType);
 if ($rows != 0)
 {
  $this->session->set_flashdata('install_flash',$valid_InstallationType);
  $this->session->set_flashdata('install_check', 'Please try different installation type.');
  redirect('installation_type/view');
  return false;

}
return true;

}


public function installation_type_update(){

 $this->load->helper('form'); 
 $temp_sel['installation_id'] = $this->uri->segment('3'); 
 //$this->session->set_userdata('install_ids',$installation_id);

 $query = $this->db->get_where("InstallationTypes",array("installationtype_id"=>$temp_sel['installation_id']));

         //$data['update_rec'] = $query->result(); 
 $temp_sel['data'] = $query->result(); 
         //print_r($temp_sel['installationtype_id']);exit;
        // $data['old_roll_no'] = $roll_no; 
 $temp_sel['main_content'] = $this->load->view('installation_type/installation_update',$temp_sel,TRUE);
 $this->load->view('admin/index', $temp_sel);

}

public function installationtype_update($installation_ID){
      // 	if ($this->input->post('ContentPlaceHolder1btn_add'))
      // { 


      	//$installionId = $this->session->flashdata('install_ids');
  $chech_val;
  $InstallationType = $this->input->post('InstallationType');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  if(isset($checked)==1){
      		//echo "Active";exit;
    $check_val = '1';
  }else{
      		//echo "Archive";exit;
    $check_val = '0';
  }

  $data = array(
    'installation_type'=>$InstallationType,
    '	is_active'=>$check_val
  );
        // print_r($data);
        // die;
  $installation_type = $this->Installation_type_model->update_installation_type($data,$installation_ID);
      	//$data['update_sucess'] = 'Installation type updated successfully';
  $this->session->set_flashdata('updation_sucess','Installation type updated successfully');
  $query = $this->db->get("InstallationTypes");
  $data['records'] = $query->result();
      	 //$this->load->view("installation_type/installation_type",$data); 
  redirect('installation_type/view');


      // }

}
public function addToArchive($installationID_id){
  $update_query = "UPDATE `InstallationTypes` SET `is_active`='0' WHERE `installationtype_id`='".$installationID_id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Archive_install','Sub Type Added To Archive sucessfully');
  redirect('installation_type/view');
}
public function addToActive($installationID_id){
  $update_query = "UPDATE `InstallationTypes` SET `is_active`='1' WHERE `installationtype_id`='".$installationID_id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Active_install','Sub Type Added To Active sucessfully');
  redirect('installation_type/view');
}
public function deleteisntallation($installationID_id){
  $delete_query = "DELETE FROM `InstallationTypes` WHERE `installationtype_id`='".$installationID_id."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('delete_install','Sub Type Deleted sucessfully');
  redirect('installation_type/view');
}
}