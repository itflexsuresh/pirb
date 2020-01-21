<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Managearea_Model_test extends CI_Model
{
  function __construct()
  {
    parent::__construct();

  }
  public function insert_new($datas){

    	//echo "hii im from new";exit;
   $this->db->insert('area',$datas);
    	//redirect('Manage_Area/index');

 }
 public function city_chks($city){
  $query = $this->db->get_where('area', array('Name' => $city)); 

  $rows = $query->num_rows();
      //     print_r($rows);
      // exit;
  
  return $rows;
}

public function suburb_chks($suburub){
  $query = $this->db->get_where('areasuburbs', array('Name' => $suburub)); 

  $rows = $query->num_rows();
  return $rows;
}

public function suburb_chks_update($suburub){
  $query = $this->db->get_where('areasuburbs', array('Name' => $suburub)); 

  $rows = $query->num_rows();
  return $rows;
}

public function insert_exist($areaSubrub){
    	//echo "hii im from exist";exit;
  $this->db->insert('areasuburbs',$areaSubrub);
    	// redirect('Manage_Area/index');


}
public function fetch_city($provinceId){
 $query = $this->db->get_where('area', array('ProvinceID' => $provinceId));
 $result = $query->result();
    	//print_r($result);
 echo '<option value="">Select City</option>';
 foreach($result as $row)
 {
   echo '<option value="'.$row->ID.'">'.$row->Name.'</option>';
 }
}
public function update($update_val,$update_id){
       // print_r($update_id);
  $this->db->set($update_val); 
  $this->db->where("SuburbID", $update_id); 
  $this->db->update("areasuburbs", $update_val); 
         //redirect('Manage_Area/index');
        // $area_ids;
        // print_r($update_val);exit;

}
}
?>