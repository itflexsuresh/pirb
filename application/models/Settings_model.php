<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    public function update($update_vals){
        // print_r('<pre>');
        // print_r($update_vals);
        // print_r('</pre>');
        // echo "string";
        // die;
        $this->db->where('ID', '1');
        $this->db->update('settings', $update_vals);

    }
    // public function update_CPD($update_vals_cpd){

    // }



////physical ajax
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

            public function fetch_suburb($cityid){
            
        $query1 = $this->db->get_where('areasuburbs', array('CityID' => $cityid));
        $result1 = $query1->result();        
        echo '<option value="">Select Suburb</option>';
          foreach($result1 as $row1)
  {
   echo '<option value="'.$row1->SuburbID.'">'.$row1->Name.'</option>';
  }
    }
    //////////////// postal ///////////////////

                public function psotal_fetch_city($postal_provinceId){
            
        $query2 = $this->db->get_where('area', array('ProvinceID' => $postal_provinceId));
        $result2 = $query2->result();        
        echo '<option value="">Select City</option>';
          foreach($result2 as $row2)
  {
   echo '<option value="'.$row2->ID.'">'.$row2->Name.'</option>';
  }
    }

                public function postal_fetch_suburb($postal_cityid){
            
        $query3 = $this->db->get_where('areasuburbs', array('CityID' => $postal_cityid));
        $result3 = $query3->result();        
        echo '<option value="">Select Suburb</option>';
          foreach($result3 as $row3)
  {
   echo '<option value="'.$row3->SuburbID.'">'.$row3->Name.'</option>';
  }
    }
    public function get_province(){
           $this->db->select('ID,Name');
   $query = $this->db->get_where('province');
   $result = $query->result();
   return $result;
    }
    public function  get_city($id){
           $this->db->select('ID,Name');
   $query = $this->db->get_where('area', array('ProvinceID' => $id));
   $result = $query->result();
   return $result;
    }

        public function get_suburb($c_id){
           $this->db->select('SuburbID,Name');
   $query = $this->db->get_where('areasuburbs', array('CityID' => $c_id));
   $result = $query->result();
            //    print_r($result);
            // exit;
   return $result;
    }
        public function  postal_get_city($id){
           $this->db->select('ID,Name');
   $query = $this->db->get_where('area', array('ProvinceID' => $id));
   $result = $query->result();
   return $result;
    }
            public function postal_get_suburb($c_id){
           $this->db->select('SuburbID,Name');
   $query = $this->db->get_where('areasuburbs', array('CityID' => $c_id));
   $result = $query->result();
            //    print_r($result);
            // exit;
   return $result;
    }


    
      
}
?>