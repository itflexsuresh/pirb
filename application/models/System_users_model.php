<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System_users_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->library(array('form_validation', 'session', 'email', 'pagination'));

    $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
    $this->load->database(); 

  }
  public function insert($insert_data){
    $this->db->insert('users',$insert_data);
    // Select last inserted userId
    $insert_id = $this->db->insert_id();
    $this->session->set_userdata('userId',$insert_id);
    //$this->session->set_userdata('userId','1');

  }

  public function insert_permissions($permission_val,$status){
    $userID = $this->session->userdata('userId');
    // print_r($permission_val);
    // print_r($status);
    // exit;
    $insert_query = ("INSERT INTO  `page_rights` (`UserID`,`menu_id`,`permission`) VALUES ('".$userID."','".$permission_val."','".$status."')");
    $query = $this->db->query( $insert_query );
    //echo "<br/>";
  }

  function email_chks($usr_email)
  {

    $query = $this->db->get_where('users', array('email' => $usr_email)); 
    $rows = $query->num_rows();
    
    return $rows;
  }

  public function update($update_vals,$User_ID){
    $this->db->set($update_vals); 
    $this->db->where("UserID", $User_ID); 
    $this->db->update("users", $update_vals); 

  }
  public function update_permission($menu_vals,$status){
    //print_r($menu_vals);die;
     $usr_id1 = $this->session->userdata('update_userId');
    // print_r($menu_vals);
    // print_r($status);
    // //print_r($usr_id);
    // exit;
$permission_updates = "UPDATE `page_rights` SET `permission`='".$status."' WHERE `UserID`='".$usr_id1."'";
$this->db->query($permission_updates);

    
  }

}