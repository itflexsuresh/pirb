<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cpd_points_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();

  }

  public function insert($insert_val){
    $this->db->insert('cpdactivities',$insert_val);

  }

  public function update($update_val,$CPDId){
    $this->db->set($update_val); 
    $this->db->where("CPDActivityID", $CPDId); 
    $this->db->update("cpdactivities", $update_val);
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
    $this->db->select('count(CPDActivityID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('cpdactivities')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('CPDActivityID,ProductCode,Activity,StartDate,EndDate,CPDStream,,Points');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('cpdactivities')->result();

    $data = array();

    foreach($records as $record ){
     $id = $record->CPDActivityID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Archive ?'."'";
     $action = '<a href="'.$base_url.'cpd_points/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a><div class="col-sm-6 col-md-4 col-lg-6"><a href="'.$base_url.'cpd_points/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
     $PDFaction = '<a href="'.$base_url.'cpd_points/get_ajax_PDF/'.$id.'" class="generate-PDF" data-id="'.$id.'" data-original-title="Edit"><i class="fa fa-file-pdf-o"></i></a>';
     $data[] = array( 
       "ProductCode"=>$record->ProductCode,
       "Activity"=>$record->Activity,
       "StartDate"=>$record->StartDate,
       "EndDate"=>$record->EndDate,
       "CPDStream"=>$record->CPDStream,
       "Points"=>$record->Points,
       "action"=>$action,
       "pdf"=>$PDFaction,
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
     $this->db->select('count(CPDActivityID) as allcount');
     $this->db->where('isActive','0');
     if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('cpdactivities')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
     //  ## Fetch records
    $this->db->select('CPDActivityID,ProductCode,Activity,StartDate,EndDate,CPDStream,,Points');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);    
    $records = $this->db->get('cpdactivities')->result();

    $data = array();
    foreach($records as $record ){
     $id = $record->CPDActivityID;
     $base_url  = base_url();
     $test = "'".'You Want Move This To Active ?'."'";
     $test1 = "'".'You Want Delete This ?'."'";
     $action = '<div class="col-sm-3 col-md-3"><a href="'.$base_url.'cpd_points/addToActive/'.$id.'" data-toggle="tooltip" data-original-title="At To Active" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div><div class="col-sm-3 col-md-3"><a href="'.$base_url.'cpd_points/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a></div><div class="col-sm-3 col-md-3"><a href="'.$base_url.'cpd_points/delete/'.$id.'" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('.$test1.');"><i class="fa fa-close text-danger"></i></a></div>';
     $PDFaction = '<a href="'.$base_url.'cpd_points/get_ajax_PDF/'.$id.'" class="generate-PDF" data-id="'.$id.'" data-original-title="Edit"><i class="fa fa-file-pdf-o"></i></a>';
     $data[] = array( 
      "ProductCode"=>$record->ProductCode,
      "Activity"=>$record->Activity,
      "StartDate"=>$record->StartDate,
      "EndDate"=>$record->EndDate,
      "CPDStream"=>$record->CPDStream,
      "Points"=>$record->Points,
      "action"=>$action,
      "pdf"=>$PDFaction,
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

 public function cp_ajax_pdf($cpdId){
  $html = '';
    //$img = '';
  include 'phpqrcode/qrlib.php'; 
  $text = "GEEKS FOR GEEKS"; 
//QRcode::png($text);

    //$query = $this->db->get_where('cpdactivities', array('CPDActivityID =' => '$cpdId'))->result();
    // $select = "SELECT * FROM `cpdactivities` WHERE `CPDActivityID`='".$cpdId['C_id']."' ";
    // $query = $this->db->query($select)->result();
  //   $html .= '<div id="content">
  //   Acvity: '.$query[0]->ProductCode.'

  // </div>';
    //echo $img;
         //echo $html;data:image/jpeg;base64,'+ Base64.encode('Koala.jpeg') 

  $img .= 'http://diyesh.com/auditit_new/auditit/uploads/41252.jpg';
  echo $img;

    // print_r($query);
    // die;

}

}

