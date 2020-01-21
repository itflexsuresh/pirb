<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register_plumber_list_model extends CI_Model
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
public function plumber_ajax_register($postData=null){
  $response = array();

     ## Read value
  $draw = $postData['draw'];
  $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value

     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
      $searchQuery = " (fname like '%".$searchValue."%' or lname like '%".$searchValue."%' or regno like '%".$searchValue."%' or email like '%".$searchValue."%' or email like '%".$searchValue."%' or status like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(UserID) as allcount');
    $this->db->where('role','2');
    $this->db->where('status!=','2');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('users')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('UserID,fname,lname,email,regno,status');
    $this->db->where('role','2');
    $this->db->where('status!=','2');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    // $this->db->order_by("LocationID", "AES");
    $records = $this->db->get('users')->result();

    $data = array();

    foreach($records as $record ){
     $id = $record->UserID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Active ?'."'";
     // $action = '<a href="'.$base_url.'qualification_route/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a> <div class="col-sm-6 col-md-4 col-lg-3"><a href="'.$base_url.'qualification_route/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $action = '<a href="'.$base_url.'register_plumber_list/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>';
     $data[] = array(
      "regno"=>$record->regno,
      "fname"=>$record->fname,
      "lname"=>$record->lname,      
      "email"=>$record->email,
      "Designation"=>'test designations',
      "status"=>$record->status,
      "action"=>$action,
    ); 
     // }
   }


     ## Response
   $response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecords,
    "aaData" => $data
  );

   return $response; 
 }

 public function plumber_ajax_register_test($postData=null){
  $response = array();

     ## Read value
  $draw = $postData['draw'];
  $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value

     // Custom search filter 
     $searchReg = $postData['searchReg'];
     $searchMOB = $postData['searchMOB'];
     $searchIDno = $postData['searchIDno'];
     $statusPlumb = $postData['statusPlumb'];
     // if ($searchReg!='') {
     //   print_r($searchReg);
     // }
     //$searchID = $postData['searchID'];
     //$searchName = $postData['searchName'];

     ## Search 
     $search_arr = array();
     $searchQuery = "";
     if($searchValue != ''){
      $search_arr[] = " (fname like '%".$searchValue."%' or lname like '%".$searchValue."%' or regno like '%".$searchValue."%' or email like '%".$searchValue."%' or email like '%".$searchValue."%' or status like '%".$searchValue."%' ) ";
    }
    if($searchReg != ''){
     // $search_arr[] = " regno='".$searchReg."' ";
     $search_arr[] = " regno like '%".$searchReg."%' or fname like '%".$searchReg."%' or lname like '%".$searchReg."%' ";
    }
    if($searchMOB != ''){
      $search_arr[] = " contact='".$searchMOB."' ";
    }
    if($searchIDno != ''){
      $search_arr[] = " IdNo='".$searchIDno."' ";
    }
    if($searchReg != ''){
     $search_arr[] = " status='".$statusPlumb."' ";
    }
    
    if(count($search_arr) > 0){
      $searchQuery = implode(" and ",$search_arr);
    }
    

     ## Total number of records without filtering
    $this->db->select('count(UserID) as allcount');
    $this->db->where('role','2');
    $this->db->where('status!=','2');
    if($searchQuery != ''){
      // print_r($searchQuery);exit;
      $this->db->where($searchQuery);
      
    }
    $tot_records = $this->db->get('users')->result();
    //print_r($tot_records);
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('UserID,fname,lname,email,regno,status,contact,company,IdNo,DateofBirth');
    $this->db->where('role','2');
    $this->db->where('status!=','2');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }

     ## Fetch records
   $this->db->select('UserID,fname,lname,email,regno,status');
   if($searchQuery != ''){
     $this->db->where($searchQuery);
   }
   
   $this->db->order_by($columnName, $columnSortOrder);
   $this->db->limit($rowperpage, $start);
   $records = $this->db->get('users')->result();

   $data = array();

   foreach($records as $record ){

    $id = $record->UserID;
    $base_url  = base_url();         
    $action = '<a href="'.$base_url.'register_plumber_list/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>';
    $data[] = array(
      "regno"=>$record->regno,
      "fname"=>$record->fname,
      "lname"=>$record->lname,      
      "email"=>$record->email,
      "Designation"=>'test designations',
      "status"=>$record->status,
      "action"=>$action,
    ); 
  }

     ## Response
  $response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecords,
   "aaData" => $data
 );

  return $response; 
}

   // Get cities array
   // public function getCities(){

   //   ## Fetch records
   //   $this->db->distinct();
   //   $this->db->select('city');
   //   $this->db->order_by('city','asc');
   //   $records = $this->db->get('users')->result();

   //   $data = array();

   //   foreach($records as $record ){
   //      $data[] = $record->city;
   //   }

   //   return $data;
   // }

//}
}
?>