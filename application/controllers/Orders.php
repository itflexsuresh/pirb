<?php 
class orders extends CI_Controller {

 function __construct() { 
  parent::__construct(); 
  $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
  $this->load->model(array('Orders_model'));        
  $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
  $this->load->database(); 

}
public function view(){
    // $this->db->order_by("SuburbID", "desc");
    // $query = $this->db->get('areasuburbs');

  $plumber_sql = "SELECT `UserID`,`fname`,`lname`,`role`,`regno`,`status` FROM `users` WHERE `role`=2 AND `status`=1";
  $query = $this->db->query($plumber_sql);
  $data['plumber_records'] = $query->result();
  $data['page_title'] = "Orders";
  $data['main_content'] = $this->load->view("orders/orders_view",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function insert_records(){
echo "Hii this is insert";die;
$dateOfOrders = $this->post->input('dateOfOrders');
$radioPlumberResseller = $this->post->input('radio');
$plumberName = $this->post->input('Plumber_name');
$CoCPermitted = $this->post->input('coc_clacs');
$CoCRequest = $this->post->input('number_of_coc');
$CoCTypes = $this->post->input('COC_Types');
$delivey_method = $this->post->input('delivey_method');
$intl_inovioce = $this->post->input('internal_inv_no');
$trckingNo = $this->post->input('tracking_no');


//}
}

public function edit_view($ordersID){

}

public function get_ajaxpagination_view_active(){
 $postData = $this->input->post();
     // Get data
 $data = $this->Orders_model->get_ajax_active($postData);

 echo json_encode($data);
}

public function fetch_user_details(){
  $usrID = $this->input->post();
  // print_r($usrID);
  // die;
  $data = $this->Orders_model->getUsers($usrID);

  echo json_encode($data);
}

public function update(){


}
public function getupdate($areasubID){


}
public function addToArchive($ManageID){
  // $update_query = "UPDATE `areasuburbs` SET `isActive`='0' WHERE `SuburbID`='".$ManageID."'";
  // $query = $this->db->query($update_query);
  // $this->session->set_flashdata('Archive_suburb','Suburb Added To Archive sucessfully');
  // redirect('manage_area/view');
}
public function addToActive($ManageID){
  // $update_query = "UPDATE `areasuburbs` SET `isActive`='1' WHERE `SuburbID`='".$ManageID."'";
  // $query = $this->db->query($update_query);
  // $this->session->set_flashdata('Active_suburb','Suburb Added To Active sucessfully');
  // redirect('manage_area/view');
}
public function deleteArea($ManageID){
  // $delete_query = "DELETE FROM `areasuburbs` WHERE `SuburbID`='".$ManageID."'";
  // $query = $this->db->query($delete_query);
  // $this->session->set_flashdata('delete_suburb','Suburb Deleted sucessfully');
  // redirect('manage_area/view');
}
}
?>