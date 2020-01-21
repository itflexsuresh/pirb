<?php 
class register_plumber_list extends CI_Controller {

 function __construct() { 
  parent::__construct(); 
  $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
  $this->load->model(array('Register_plumber_list_model'));        
  $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
  $this->load->database(); 

}
public function view(){
    // $this->db->order_by("SuburbID", "desc");
    // $query = $this->db->get('areasuburbs');

  // $sql = "SELECT * FROM areasuburbs ORDER BY SuburbID desc";
  // $query = $this->db->query($sql);
  // $data['records'] = $query->result();
  $data['page_title'] = "Plumber Register";
  $data['main_content'] = $this->load->view("register_plumber_list/register_plumber_view",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function insert_records(){





//}
}


public function update(){
  // $this->load->helper('form'); 
  // $temp_sel['areasuburb_id'] = $this->uri->segment('3'); 
  //        //$this->session->set_flashdata('$areasuburb_id',$areasuburb_id);
  // //$this->session->set_userdata('areasuburb_id', $areasuburb_id);
  // $query = $this->db->get_where("areasuburbs",array("SuburbID"=>$temp_sel['areasuburb_id']));
  // $temp_sel['data'] = $query->result();
  // $temp_sel['page_title'] = "Manage Area";
  // $temp_sel['main_content'] = $this->load->view('area/area_update',$temp_sel,TRUE);
  // $this->load->view('admin/index', $temp_sel);
  //         //redirect('manage_area/view');

}
public function getupdate($areasubID){
  // $province_update = $this->input->post('Province_down');
  // $city_update = $this->input->post('city_down');
  // $subrub_update = $this->input->post('Suburb_update');
  // $active_update = $this->input->post('ContentPlaceHolder1isActive');
  // if(isset($active_update)==1){           
  //   $check_val = '1';
  // }else{
  //   $check_val = '0';
  // }

  // $data = array('CityID' => $city_update, 'Name'=> $subrub_update, 'ProvinceID'=> $province_update, 'isActive'=> $check_val);
  // $this->Managearea_Model->update($data,$areasubID);
  // $this->session->set_flashdata('suburb_update','Suburb updated sucessfully');
  // redirect('manage_area/view');

}
public function get_ajaxpagination_view_list(){
         // POST data
 $postData = $this->input->post();
     // Get data
 $data = $this->Register_plumber_list_model->plumber_ajax_register($postData);

 echo json_encode($data);
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