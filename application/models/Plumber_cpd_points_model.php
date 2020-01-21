<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class plumber_cpd_points_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();

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
      $searchQuery = " (CreateDate like '%".$searchValue."%' or Activity like '%".$searchValue."%' or CPD_Stream like '%".$searchValue."%' or NoPoints like '%".$searchValue."%' or isApproved like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(AssessmentID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('assessments')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('*');
    $this->db->where('UserID',$postData['UserID']);
    $this->db->where('isActive','1');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('assessments')->result();

    $data = array();

    foreach($records as $record ){
     $id = $record->AssessmentID;
         $staus='';
     //$id = $record->CPDActivityID;
     if ($record->isApproved==1) {
       $staus = 'Approved';
     }elseif($record->isApproved==2) {
        $staus = 'Pending';
     }else{
        $staus = 'Reject';
     }
     $base_url  = base_url();
     $test = "'".'You Want Move This To Archive ?'."'";
     $action = '<a href="'.$base_url.'plumber_cpd/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a><div class="col-sm-6 col-md-4 col-lg-6"><a href="'.$base_url.'plumber_cpd/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $PDFaction = '<a href="'.$base_url.'plumber_cpd/get_ajax_PDF/'.$id.'" class="generate-PDF" data-id="'.$id.'" data-original-title="Edit"><i class="fa fa-file-pdf-o"></i></a>';
     $data[] = array( 
       "CreateDate"=>$record->CreateDate,
       "Activity"=>$record->Activity,
       "CPD_Stream"=>$record->CPD_Stream,
       "NoPoints"=>$record->NoPoints,
       "isApproved"=>$staus,       
       "PDF"=>$PDFaction,
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
       $searchQuery = " (CreateDate like '%".$searchValue."%' or Activity like '%".$searchValue."%' or CPD_Stream like '%".$searchValue."%' or NoPoints like '%".$searchValue."%' or isApproved like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering    
     $this->db->select('count(AssessmentID) as allcount');
     $this->db->where('isActive','0');
     if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('assessments')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
     //  ## Fetch records
    $this->db->select('*');
    $this->db->where('UserID',$postData['UserID']);
    $this->db->where('isActive','0');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);    
    $records = $this->db->get('assessments')->result();

    $data = array();
    foreach($records as $record ){
    $staus='';
     $id = $record->CPDActivityID;
     if ($record->isApproved==1) {
       $staus = 'Approved';
     }elseif($record->isApproved==2) {
        $staus = 'Pending';
     }else{
        $staus = 'Reject';
     }
     $base_url  = base_url();
     $test = "'".'You Want Move This To Active ?'."'";
     $test1 = "'".'You Want Delete This ?'."'";
     $action = '<div class="col-sm-3 col-md-3"><a href="'.$base_url.'plumber_cpd/addToActive/'.$id.'" data-toggle="tooltip" data-original-title="At To Active" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div><div class="col-sm-3 col-md-3"><a href="'.$base_url.'plumber_cpd/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a></div><div class="col-sm-3 col-md-3"><a href="'.$base_url.'plumber_cpd/delete/'.$id.'" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('.$test1.');"><i class="fa fa-close text-danger"></i></a></div>';
     $PDFaction = '<a href="'.$base_url.'plumber_cpd/get_ajax_PDF/'.$id.'" class="generate-PDF" data-id="'.$id.'" data-original-title="Edit"><i class="fa fa-file-pdf-o"></i></a>';
     $data[] = array( 
       "CreateDate"=>$record->CreateDate,
       "Activity"=>$record->Activity,
       "CPD_Stream"=>$record->CPD_Stream,
       "NoPoints"=>$record->NoPoints,
       "isApproved"=>$staus,       
       "action"=>$action,
       "PDF"=>$PDFaction,
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