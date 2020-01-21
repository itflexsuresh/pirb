<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qualification_route_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function insert($insert_vals){
    	$this->db->insert('qualificationroute',$insert_vals);

    }

    public function update($update_vals,$qualificationID){
        $this->db->set($update_vals); 
        $this->db->where("QualificationID", $qualificationID); 
        $this->db->update("qualificationroute", $update_vals);
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
        $searchQuery = " (Route like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(QualificationID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('qualificationroute')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('QualificationID,Route');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    // $this->db->order_by("LocationID", "AES");
    $records = $this->db->get('qualificationroute')->result();

    $data = array();

    foreach($records as $record ){
     $id = $record->QualificationID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Active ?'."'";
     $action = '<a href="'.$base_url.'qualification_route/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a> <div class="col-sm-6 col-md-4 col-lg-3"><a href="'.$base_url.'qualification_route/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $data[] = array( 
         "Route"=>$record->Route,         
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
        $searchQuery = " (Route like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering    
    $this->db->select('count(QualificationID) as allcount');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('qualificationroute')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
     //  ## Fetch records
    $this->db->select('QualificationID,Route');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);    
    $records = $this->db->get('qualificationroute')->result();

    $data = array();
    foreach($records as $record ){
     $id = $record->QualificationID;
     $base_url  = base_url();
     $test = "'".'You Want To Delete This ?'."'";
     $test1 = "'".'You Want Move This To Active ?'."'";
     $action = '<a href="'.$base_url.'qualification_route/edit_view/'.$id.'"data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a> <div class="col-sm-6 col-md-4 col-lg-2"><a href="'.$base_url.'qualification_route/addToActive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test1.');"><i class="fa fa-check-circle"></i></a></div> <a href="'.$base_url.'qualification_route/delet_Record/'.$id.'"data-original-title="Delete" onclick="return confirm('.$test.');"><i class="fa fa-close text-danger"></i></a>';
     $data[] = array( 
         "Route"=>$record->Route,
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