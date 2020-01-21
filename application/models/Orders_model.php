<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();

  }

  public function get_ajax_active($postData=null){
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
      $searchQuery = " (InvoiceNumber like '%".$searchValue."%' or CreateDate like '%".$searchValue."%' or isPaid like '%".$searchValue."%' or InternalInvoiceNumber like '%".$searchValue."%' or plumbername like '%".$searchValue."%' or COCType like '%".$searchValue."%' or Total like '%".$searchValue."%' or Delivery like '%".$searchValue."%' or TrackingNo like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(OrderID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('orders')->result();
    $totalRecords = $tot_records[0]->allcount;

    //  ## Fetch records
    $this->db->select('*');
    $this->db->where('isActive','1');
    $this->db->where('PlumberID >','0');
    if($searchQuery != ''){
      $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('orders')->result();

    $data = array();
    foreach($records as $record ){
      $plumberID = $record->PlumberID;
      $id = $record->OrderID;
      $base_url  = base_url();
      //if ($plumberID!='0') {
       // echo $plumberID;

       $test = "'".'You Want Move This To Archive ?'."'";
       $plumber_name = "SELECT `UserID`,`fname`,`lname`,`PostalAddress` FROM `users` WHERE  `UserID`='".$record->PlumberID."'";
       $plumber_result = $this->db->query($plumber_name)->result();
       $methods = '';
       if ($record->Method==1) {
         $methods = 'Collect at PIRB Supplier';
       }elseif($record->Method==2){
        $methods = 'courier';
       }elseif($record->Method==3){
        $methods ='Postage';
       }
       $name_and_surname = $plumber_result[0]->fname.$plumber_result[0]->lname;
       $address = $plumber_result[0]->PostalAddress;
     //$action = '<a href="'.$base_url.'cda_types/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit" ><i class="fa fa-pencil text-inverse m-r-10"></i></a><div class="col-sm-6 col-md-4 col-lg-6"><a href="'.$base_url.'cda_types/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
       $action = '<a href="'.$base_url.'oders/edit_view/'.$id.'" data-toggle="tooltip" data-original-title="Edit" ><i class="fa fa-pencil text-inverse m-r-10"></i></a>';
       $data[] = array( 
         "OrderID"=>$record->OrderID,
         "InvoiceNumber"=>$record->InvoiceNumber,
         "CreateDate"=>$record->CreateDate,
         "isPaid"=>$record->isPaid,
         "InternalInvoiceNumber"=>$record->InternalInvoiceNumber,
         "plumbername"=>$name_and_surname,
         "COCType"=>$record->COCType,
         "TotalNoItems"=>$record->TotalNoItems,
         "Delivery"=>$methods,
         "Delivery_address" => $address,
         "TrackingNo"=>$record->TrackingNo,
         "action"=>$action,
       ); 
     // }
     //}

     
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

 public function getUsers($postData){
  $response = array();
// print_r($postData);
// die;
     if(isset($postData['user_id']) ){
       // Select record
       $this->db->select('*');
       $this->db->where("UserID like '%".$postData['user_id']."%' ");

       $records = $this->db->get('users')->result();

       foreach($records as $row ){
          $response[] = $row->NoCOCpurchases;
       }

     }

     return $response;
  }

 
}