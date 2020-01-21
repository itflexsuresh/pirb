<?php 
class system_users extends CI_Controller {

 function __construct() { 
  parent::__construct(); 
  $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
  $this->load->model(array('System_users_model'));        
  $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
  $this->load->database(); 

}
public function view(){
 // $query = $this->db->get("users");       
 // $data['records'] = $query->result();

 //$this->db->from($this->'users');
  $this->db->order_by("UserID", "desc");
  $query = $this->db->get("users"); 
//return $query->result();
  $data['records'] = $query->result();
  $data['page_title'] = "System Users";
  $data['main_content'] = $this->load->view("system_users/system_user_view",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function addnew_view(){
  $query1 = $this->db->get('menu');
  $data['menu_records'] = $query1->result();
  $data['page_title'] = "System Users";
  $data['main_content'] = $this->load->view("system_users/system_user_addview",$data,TRUE);
  $this->load->view('admin/index', $data);

}
public function add_insert(){
    //model insert
  // $this->load->helper(array('form'));
  // $this->load->helper(array('url'));
  $form_validate_rules = array(
    array('field' => 'user_email', 'label' => 'Email', 'rules' => 'trim|required|callback_useremail_check'));
  $this->form_validation->set_rules('name_surname', 'Surname', 'required');
  $name = $this->input->post('user_name');
  $surname = $this->input->post('name_surname');
  $email = $this->input->post('user_email');
  
  $password = $this->input->post('user_password');
  ///// Password encryption
  $simple_string =$password; 
  
// Store the cipher method 
  $ciphering = "AES-128-CTR"; 
  
// Use OpenSSl Encryption method 
  $iv_length = openssl_cipher_iv_length($ciphering); 
  $options = 0; 
  
// Non-NULL Initialization Vector for encryption 
  $encryption_iv = '1234567891011121'; 
  
// Store the encryption key 
  $encryption_key = "GeeksforGeeks"; 
  
// Use openssl_encrypt() function to encrypt the data 
  $encryption = openssl_encrypt($simple_string, $ciphering, 
    $encryption_key, $options, $encryption_iv);


  $passwordMD5 = $encryption;
  $role = $this->input->post('role_type');
  $comments = $this->input->post('comment_area');
  $active = $this->input->post('ContentPlaceHolder1isActive');
  $read_permission = $this->input->post('read_box');
  $write_permission = $this->input->post('write_box');
  // Permissions variables:


  if(isset($active)==1){
    $check_val = '1';

  }else{
    $check_val = '0';
  }

  $this->session->set_flashdata('name',$name);
  $this->session->set_flashdata('surname',$surname);
  $this->session->set_flashdata('Exmail',$email);
  $this->session->set_flashdata('commentBox',$comments);
  $this->session->set_flashdata('userRole',$role);

  $this->form_validation->set_rules($form_validate_rules);
  if ($this->form_validation->run() == TRUE)
  {
    $data = array('fname' => $name, 'lname' => $surname, 'email' => $email, 'password' => $passwordMD5, 'role' => $role, 'Comments' => $comments, 'status' => $check_val );

    $this->System_users_model->insert($data);
    $this->session->set_flashdata('insert_sucess','User added sucessfully');

  }
  if( $this->session->userdata('userId')){

    foreach ($read_permission as $key) {

      $permission = 1;
      $this->System_users_model->insert_permissions($key,$permission);
    }
    foreach ($write_permission as $key1) {

      $permission2 = 2;
      $this->System_users_model->insert_permissions($key1,$permission2);
    }


  }
  $this->session->unset_userdata('userId');
  
  redirect('system_users/view');

}
public function useremail_check(){
  $email = $this->input->post('user_email');

  $rows = $this->System_users_model->email_chks($email);
  if ($rows != 0)
  {
    $this->session->set_flashdata('email_check', 'Email is already taken. Please try again.');
    redirect('system_users/addnew_view');
    return false;
    
  }
  return true;

}

public function update_view(){
  $temp_sel['usr_id'] = $this->uri->segment('3');
  //$this->session->set_userdata('update_userId',$usr_id);

  $query = $this->db->get_where("users",array("UserID"=>$temp_sel['usr_id']));
  $temp_sel['data'] = $query->result();
  $temp_sel['page_title'] = "System Users";
  $temp_sel['main_content'] = $this->load->view("system_users/system_user_updateview",$temp_sel,TRUE);
  $this->load->view('admin/index', $temp_sel);

}
public function add_update($userID){
    //model update

 $form_validate_rules = array(
  array('field' => 'user_email', 'label' => 'Email', 'rules' => 'trim|required'));
 $this->form_validation->set_rules($form_validate_rules);

 $name = $this->input->post('user_name');
 $surname = $this->input->post('name_surname');
 $email = $this->input->post('user_email');

 $password = $this->input->post('user_password');
 $role = $this->input->post('role_type');
 $comments = $this->input->post('comment_area');
 $active = $this->input->post('ContentPlaceHolder1isActive');
 // password encrypt
 $simple_string =$password; 
  
// Store the cipher method 
$ciphering = "AES-128-CTR"; 
  
// Use OpenSSl Encryption method 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
  
// Non-NULL Initialization Vector for encryption 
$encryption_iv = '1234567891011121'; 
  
// Store the encryption key 
$encryption_key = "GeeksforGeeks"; 
  
// Use openssl_encrypt() function to encrypt the data 
$encryption = openssl_encrypt($simple_string, $ciphering, 
            $encryption_key, $options, $encryption_iv);

 $passMd5 = $encryption;
 $read_permissions = $this->input->post('read_box');
 $write_permissions = $this->input->post('write_box');
 if(isset($active)==1){
  $check_val = '1';

}else{
  $check_val = '0';
}

$this->session->set_flashdata('name',$name);
$this->session->set_flashdata('surname',$surname);
$this->session->set_flashdata('Exmail',$email);
$this->session->set_flashdata('commentBox',$comments);
$this->session->set_flashdata('userRole',$role);




  // if ($this->form_validation->run() == TRUE)
  // {
$data = array('fname' => $name, 'lname' => $surname, 'email' => $email, 'password' => $passMd5, 'role' => $role, 'Comments' => $comments, 'status' => $check_val );
$this->System_users_model->update($data,$userID);    
$this->session->set_flashdata('update_sucess','User updated sucessfully');
//
$read_updated = 0;
  //} 
if (!empty($read_permissions)) {
  //die;
  // print_r($read_permissions);
  // die;
  foreach ($read_permissions as $keyread) {

    $permission_updateread = 1;
    $this->System_users_model->update_permission($keyread,$permission_updateread,$userID);
    $read_updated = 1;
  }
}else{
  // echo "string";
  // die;
  $permission_updates = "UPDATE `page_rights` SET `permission`='0' WHERE `UserID`='".$userID."'";
  $this->db->query($permission_updates);
}

if (!empty($write_permissions)) {
  //die;
  foreach ($write_permissions as $key3) {

    $permission_update2 = 2;
    $this->System_users_model->update_permission($key3,$permission_update2,$userID);
  }
}else{
  // echo "string";
  // die;
  if($read_updated==0){
    $permission_updates = "UPDATE `page_rights` SET `permission`='0' WHERE `UserID`='".$userID."'";
    $this->db->query($permission_updates);
  }
}

////// READ
$select = "SELECT `UserID`,`menu_id`,`permission` FROM `page_rights` WHERE `UserID`='".$userID."'";
$res = $this->db->query($select)->result();
$DBarr = array();
foreach ($res as $DBkey => $value) {
  $dbMenuID[] = $value->menu_id;
    //$tyy = implode(", ", $dbMenuID);
    //$DBarr = $dbMenuID;
}
if(!empty($read_permissions)){
  foreach ($read_permissions as $key20) {      
    $check_box_arr[] = $key20;
  }
  $resultSame = array_intersect($dbMenuID,$check_box_arr);
  $resultDiff = array_diff($dbMenuID,$check_box_arr);

  if($resultSame!=''){
    foreach ($resultSame as $samekey => $samevalue) {
      $permission_updates_same = "UPDATE `page_rights` SET `permission`='1' WHERE `menu_id`='".$samevalue."'";
      $this->db->query($permission_updates_same);
    }
  }
  if ($resultDiff!='') {
    foreach ($resultDiff as $Diffkey => $Diffvalue) {
      $permission_updates_diff = "UPDATE `page_rights` SET `permission`='0' WHERE `menu_id`='".$Diffvalue."'";
        //print_r($permission_updates_diff);
      $this->db->query($permission_updates_diff);
    }
  }
}



  ///// WRITE
$selectWrite = "SELECT `UserID`,`menu_id`,`permission` FROM `page_rights` WHERE `UserID`='".$userID."'";
$resWrite = $this->db->query($selectWrite)->result();
$check_box_arr_Write = array();
$dbMenuID_Write = array();
foreach ($resWrite as $DBkeyWrite => $valueWrite) {
  $dbMenuID_Write[] = $valueWrite->menu_id;
}
foreach ($write_permissions as $keyWrite) {      
  $check_box_arr_Write[] = $keyWrite;
}

$resultSameWrite = array_intersect($dbMenuID_Write,$check_box_arr_Write);
$resultDiffWrite = array_diff($dbMenuID_Write,$check_box_arr_Write);
  // print_r($resultDiffWrite);
  // die;
if ($resultSameWrite!='') {
  foreach ($resultSameWrite as $samekeywrite => $samevalueWrite) {
    $permission_updates_same_wite = "UPDATE `page_rights` SET `permission`='2' WHERE `menu_id`='".$samevalueWrite."'";
    $this->db->query($permission_updates_same_wite);
  }
}
  // if ($resultDiffWrite!='') {
  //    foreach ($resultDiffWrite as $Diffkeywrite => $DiffvalueWrite) {
  //     if ($DiffvalueWrite==0) {
  //      $permission_updates_diff_wite = "UPDATE `page_rights` SET `permission`='0' WHERE `menu_id`='".$DiffvalueWrite."'";
  //      print_r($permission_updates_diff_wite);
  //     }else{
  //       $permission_updates_diff_wite = "UPDATE `page_rights` SET `permission`='1' WHERE `menu_id`='".$DiffvalueWrite."'";

  //       print_r($permission_updates_diff_wite);
  //     }

  //     //$this->db->query($permission_updates_diff_wite);
  //   }
  // }
  // //die;



redirect('system_users/view');

}

public function addToArchive($systemUSER_id){
  // print_r($systemUSER_id);
  // die;
  $update_query = "UPDATE `users` SET `status`='0' WHERE `UserID`='".$systemUSER_id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Archive_userss','User Added To Archive sucessfully');
  redirect('system_users/view');
}
public function addToActive($systemUSER_id){

  $update_query = "UPDATE `users` SET `status`='1' WHERE `UserID`='".$systemUSER_id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Active_userss','User Added To Active sucessfully');
  redirect('system_users/view');
}
public function deleteisntallation($systemUSER_id){
  $delete_query = "DELETE FROM `users` WHERE `UserID`='".$systemUSER_id."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('delete_userss','User Deleted sucessfully');
  redirect('system_users/view');
}


}
?>