<?php 
class manage_area extends CI_Controller {

 function __construct() { 
  parent::__construct(); 
  $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
  $this->load->model(array('Managearea_Model'));        
  $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
  $this->load->database(); 

}
public function view(){
    // $this->db->order_by("SuburbID", "desc");
    // $query = $this->db->get('areasuburbs');

  $sql = "SELECT * FROM areasuburbs ORDER BY SuburbID desc";
  $query = $this->db->query($sql);
  $data['records'] = $query->result();
  $data['page_title'] = "Manage Area";
  $data['main_content'] = $this->load->view("area/manage_area_view",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function insert_records(){


//else{
  $radio = $this->input->post('allthings');
  $active = $this->input->post('ContentPlaceHolder1isActive');


  if(isset($active)==1){
    $check_val = '1';

  }else{
    $check_val = '0';
  }

  if ($radio=='Newcity') {
      //echo "hiii";exit;
    $form_validate_rules = array(
      array('field' => 'managecity', 'label' => 'City', 'rules' => 'trim|required|callback_city_check'));
    $province_id = $this->input->post('province_down');
    $text_city =  $this->input->post('managecity');

    $this->form_validation->set_rules($form_validate_rules);
    if ($this->form_validation->run() == FALSE ) {


      $query = $this->db->get('areasuburbs');
      $data['records'] = $query->result();

      $this->load->view("area/manage_area_view",$data);
    }else{
      $data = array('Name' => $text_city,
        'ProvinceID' => $province_id
      );
        // print_r($data);die;
      $this->Managearea_Model->insert_new($data);
      $this->session->set_flashdata('city_sucess','City inserted sucessfully');
      redirect('manage_area/view');

    }

  }
  ///////////////////// EXISTITNG CITY
  else{
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('province_down', 'Province', 'required');
    $this->form_validation->set_rules('city_down', 'City', 'required');
    //$this->form_validation->set_rules('managesuburb', 'Suburb', 'required');
    $form_validate_rules1 = array(
      array('field' => 'managesuburb', 'label' => 'Suburb', 'rules' => 'trim|required|callback_suburb_check'));
    $this->form_validation->set_rules($form_validate_rules1);
                      if ($this->form_validation->run() == FALSE ) {

                        $province_validate = $this->input->post('province_down');
                        $city_validate = $this->input->post('city_down');
                        $suburb_validate = $this->input->post('managesuburb');
                        $this->session->set_flashdata('province_validate',$province_validate);
                        $this->session->set_flashdata('city_validate',$city_validate);
                        $this->session->set_flashdata('suburb_validate',$suburb_validate);

                        $query = $this->db->get('areasuburbs');
                        $data['records'] = $query->result();

                        $data['main_content'] = $this->load->view("area/manage_area_view",$data,TRUE);
                        $this->load->view('admin/index', $data);
                      }
                      /////////// VALIDATION FALSE FOR SUBURB
                      else{
                        $province = $this->input->post('province_down');
                        $city = $this->input->post('city_down');
                        $subrub = $this->input->post('managesuburb');
                        $data = array('CityID' => $city,
                          'Name' => $subrub,
                          'ProvinceID' => $province,
                          'isActive' => $check_val
                        );
                      // print_r($data);die;
                        $this->Managearea_Model->insert_exist($data);
                        $this->session->set_flashdata('suburb_sucess','Suburb inserted sucessfully');
                        redirect('manage_area/view');

                      }


  }

//}
}
public function city_check(){
        //echo "hi";exit;
  $province_id = $this->input->post('province_down');
  $radio = $this->input->post('allthings');
  $ciy_alone = $this->input->post('managecity');
  $rows = $this->Managearea_Model->city_chks($ciy_alone);
  if ($rows != 0)
  {
    $this->session->set_flashdata('radio_flash',$radio);
    $this->session->set_flashdata('city_flash',$ciy_alone);
    $this->session->set_flashdata('province_citychk',$province_id);
    $this->session->set_flashdata('city_check', 'Please try different city.');
    redirect('manage_area/view');
    return false;
    
  }
  return true;

}

public function suburb_check(){
      // echo "hi";exit;
  $province_id = $this->input->post('province_down');
  $radio = $this->input->post('allthings');
  $suburb_alone = $this->input->post('managesuburb');
  $city_alone = $this->input->post('city_down');
  $rows = $this->Managearea_Model->suburb_chks($suburb_alone);
  if ($rows != 0)
  {
    $this->session->set_flashdata('radio_flash',$radio);
    $this->session->set_flashdata('suburb_flash',$suburb_alone);
    $this->session->set_flashdata('province_citychk',$province_id);
    $this->session->set_flashdata('city_citychk',$city_alone);
    $this->session->set_flashdata('suburb_check', 'Please try different Suburb.');
    redirect('manage_area/view');
    return false;
    
  }else{
    return true;  
  }
  

}

public function fetch_city(){
  if($this->input->post('ajaxprovince_id'))
  {
    $this->Managearea_Model->fetch_city($this->input->post('ajaxprovince_id'));
  }

}

public function update(){
  $this->load->helper('form'); 
  $temp_sel['areasuburb_id'] = $this->uri->segment('3'); 
         //$this->session->set_flashdata('$areasuburb_id',$areasuburb_id);
  //$this->session->set_userdata('areasuburb_id', $areasuburb_id);
  $query = $this->db->get_where("areasuburbs",array("SuburbID"=>$temp_sel['areasuburb_id']));
  $temp_sel['data'] = $query->result();
  $temp_sel['page_title'] = "Manage Area";
  $temp_sel['main_content'] = $this->load->view('area/area_update',$temp_sel,TRUE);
  $this->load->view('admin/index', $temp_sel);
          //redirect('manage_area/view');

}
public function getupdate($areasubID){
  $province_update = $this->input->post('Province_down');
  $city_update = $this->input->post('city_down');
  $subrub_update = $this->input->post('Suburb_update');
  $active_update = $this->input->post('ContentPlaceHolder1isActive');
       $form_validate_rules = array(
      array('field' => 'Suburb_update', 'label' => 'Suburb', 'rules' => 'trim|required|callback_suburb_check_update'));
    $this->form_validation->set_rules($form_validate_rules);

  if(isset($active_update)==1){           
    $check_val = '1';
  }else{
    $check_val = '0';
  }

  $data = array('CityID' => $city_update, 'Name'=> $subrub_update, 'ProvinceID'=> $province_update, 'isActive'=> $check_val);
  $this->Managearea_Model->update($data,$areasubID);
  $this->session->set_flashdata('suburb_update','Suburb updated sucessfully');
  redirect('manage_area/view');

}

///// suburb update unique

public function suburb_check_update(){
      echo "hi";exit;
  $suburb_alone = $this->input->post('Suburb_update');
    $rows = $this->Managearea_Model->suburb_chks_update($suburb_alone);
  if ($rows != 0)
  {
    $this->session->set_flashdata('radio_flash',$radio);
    $this->session->set_flashdata('suburb_flash',$suburb_alone);
    $this->session->set_flashdata('province_citychk',$province_id);
    $this->session->set_flashdata('city_citychk',$city_alone);
    $this->session->set_flashdata('suburb_check', 'Please try different Suburb.');
    redirect('manage_area/view');
    return false;
    
  }else{
    return true;  
  }
  

}

public function addToArchive($ManageID){
  $update_query = "UPDATE `areasuburbs` SET `isActive`='0' WHERE `SuburbID`='".$ManageID."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Archive_suburb','Suburb Added To Archive sucessfully');
  redirect('manage_area/view');
}
public function addToActive($ManageID){
  $update_query = "UPDATE `areasuburbs` SET `isActive`='1' WHERE `SuburbID`='".$ManageID."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Active_suburb','Suburb Added To Active sucessfully');
  redirect('manage_area/view');
}
public function deleteArea($ManageID){
  $delete_query = "DELETE FROM `areasuburbs` WHERE `SuburbID`='".$ManageID."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('delete_suburb','Suburb Deleted sucessfully');
  redirect('manage_area/view');
}
}
?>