<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Location_types_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function insert($insert_vals){
    	$this->db->insert('locationtypes',$insert_vals);

    }

    public function update($update_vals,$locationID){
        $this->db->set($update_vals); 
        $this->db->where("LocationID", $locationID); 
        $this->db->update("locationtypes", $update_vals); 
    }
    
    public function getAssessment_ajax_active($postData=null){
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
        $searchQuery = " (Location like '%".$searchValue."%' or Address like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(LocationID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('locationtypes')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('LocationID,Location,Address');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    // $this->db->order_by("LocationID", "AES");
    $records = $this->db->get('locationtypes')->result();

    $data = array();

    foreach($records as $record ){
     $id = $record->LocationID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Archive ?'."'";
     $action = '<a href="'.$base_url.'location_types/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a><div class="col-sm-6 col-md-4 col-lg-3"><a href="'.$base_url.'location_types/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $data[] = array( 
         "Location"=>$record->Location,
         "Address"=>$record->Address,
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
    //// Archive

public function getAssessment_ajax_archive($postData=null){
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
        $searchQuery = " (Location like '%".$searchValue."%' or Address like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering    
    $this->db->select('count(LocationID) as allcount');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('locationtypes')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
     //  ## Fetch records
    $this->db->select('LocationID,Location,Address');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);    
    $records = $this->db->get('locationtypes')->result();

    $data = array();
    foreach($records as $record ){
     $id = $record->LocationID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Active ?'."'";
     $test1 = "'".'You Want Delete This ?'."'";
     $action = '<a href="'.$base_url.'location_types/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a> <a href="'.$base_url.'location_types/delete/'.$id.'" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('.$test1.');"><i class="fa fa-close text-danger"></i></a><div class="col-sm-6 col-md-4 col-lg-3"><a href="'.$base_url.'location_types/addToActive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $data[] = array( 
         "Location"=>$record->Location,
         "Address"=>$record->Address,
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
}