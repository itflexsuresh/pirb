<?php

Class Company_test_model extends CI_Model{
  function __construct() {
    parent::__construct();
  }
  public function form_insert($data){
// Inserting in Table(students) of Database(college)
  // echo "hiii";


    $this->db->insert('companies', $data);

    $insert_id = $this->db->insert_id();
    return $insert_id;

  }

  public function insert_form($data2)
  {

    $this->db->insert('users', $data2);

  }

  public function inse_form($data3)
  {
    $this->db->insert('cocstatements', $data3);
    

  }

  public function get_province(){

    $this->db->select('ID,Name');
    $query = $this->db->get_where('province');
    $result = $query->result();
    return $result;
  }

  public function get_check(){

    $this->db->select('WorkType, Specialisations');
    $query5 = $this->db->get('companies');
    $result = $query5->result();
    return $result;
  }

  public function get_city($id){
    $this->db->select('ID,Name');
    $query = $this->db->get_where('area', array('ProvinceID' => $id));
    $result = $query->result();
    return $result;
  }

  public function get_suburb($id){
    $this->db->select('SuburbID, Name');
    $query1 =$this->db->get_where('areasuburbs', array('CityID' => $id));
    $result1 =$query1->result();
    return $result1;
  }


// public function select_data($data)
//         {
//             $sql = "SELECT * FROM companies";
//             $query = $this->db->query( $sql );
//             return $query->result();
//         }

  public function update($data)
  {
    $this->db->where('CompanyID', $data['CompanyID']);    
    $this->db->set($data);
    return $this->db->update('companies');
  }

  public function fetch_city($provinceId){

    $query = $this->db->get_where('area', array('ProvinceID' => $provinceId));
    $result = $query->result();
        //print_r($result);
    echo '<option value="">Select City</option>';

    foreach($result as $row)
    {
    //$selected = ($row->ID==$cityid) ? 'selected="selected"' : '';
      echo '<option value="'.$row->ID.'">'.$row->Name.'</option>';
    }
  }    

  public function fetch_suburb($cityId){
    $query2 = $this->db->get_where('areasuburbs', array('CityID' => $cityId));
    $result1 = $query2->result();
      //print_r($result);
    echo '<option value="">Select Suburb</option>';
    foreach($result1 as $row1)
    {
    //$selected = ($row->ID==$suburbid) ? 'selected="selected"' : '';
     echo '<option value="'.$row1->SuburbID.'">'.$row1->Name.'</option>';
   }
 }



 public function checkUsernameAvailability()
 {
    
  $this->db->where('CompanyName', $this->input->post('company_name'));
  $query_companyname = $this->db->get('companies');
  
  if($query_companyname->num_rows() == 1){
    return false;
  }

  else
  {
    return true;
  }
}

public function checkEmailAvailability()
{

  $this->db->where('CompanyEmail', $this->input->post('email'));
  $query_email = $this->db->get('companies');
  

  
  if($query_email->num_rows() == 1){
    return false;
  }
  else
  {
    return true;
  }
}    


}
?>