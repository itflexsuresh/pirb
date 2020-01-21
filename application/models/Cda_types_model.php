<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cda_types_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function insert($insert_val){
        $this->db->insert('cdaactivities',$insert_val);

    }

    public function update($update_val,$CPDId){
        $this->db->set($update_val); 
        $this->db->where("CDAActivityID", $CPDId); 
        $this->db->update("cdaactivities", $update_val);
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
        $searchQuery = " (ProductCode like '%".$searchValue."%' or Activity like '%".$searchValue."%' or StartDate like '%".$searchValue."%' or EndDate like '%".$searchValue."%' or CPDStream like '%".$searchValue."%' or Points like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(CDAActivityID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('cdaactivities')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('CDAActivityID,ProductCode,Activity,StartDate,EndDate,CPDStream,Points');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('cdaactivities')->result();

    $data = array();

    foreach($records as $record ){
     $id = $record->CDAActivityID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Archive ?'."'";
     $action = '<a href="'.$base_url.'cda_types/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit" ><i class="fa fa-pencil text-inverse m-r-10"></i></a><div class="col-sm-6 col-md-4 col-lg-6"><a href="'.$base_url.'cda_types/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $data[] = array( 
         "ProductCode"=>$record->ProductCode,
         "Activity"=>$record->Activity,
         "StartDate"=>$record->StartDate,
         "EndDate"=>$record->EndDate,
         "CPDStream"=>$record->CPDStream,
         "Points"=>$record->Points,
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
         $searchQuery = " (ProductCode like '%".$searchValue."%' or Activity like '%".$searchValue."%' or StartDate like '%".$searchValue."%' or EndDate like '%".$searchValue."%' or CPDStream like '%".$searchValue."%' or Points like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering    
     $this->db->select('count(CDAActivityID) as allcount');
     $this->db->where('isActive','0');
     if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('cdaactivities')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
     //  ## Fetch records
    $this->db->select('CDAActivityID,ProductCode,Activity,StartDate,EndDate,CPDStream,,Points');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);    
    $records = $this->db->get('cdaactivities')->result();

    $data = array();
    foreach($records as $record ){
     $id = $record->CDAActivityID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Active ?'."'";
     $test1 = "'".'You Want Delete This ?'."'";
     $action = '<a href="'.$base_url.'cda_types/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a> <a href="'.$base_url.'cda_types/delete/'.$id.'" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('.$test1.');"><i class="fa fa-close text-danger"></i></a> <div class="col-sm-6 col-md-4 col-lg-6"><a href="'.$base_url.'cda_types/addToActive/'.$id.'" data-toggle="tooltip" data-original-title="At To Active" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $data[] = array( 
        "ProductCode"=>$record->ProductCode,
        "Activity"=>$record->Activity,
        "StartDate"=>$record->StartDate,
        "EndDate"=>$record->EndDate,
        "CPDStream"=>$record->CPDStream,
        "Points"=>$record->Points,
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