<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    public function insert_message($insert_vals){
    	// print_r($insert_vals);
    	// die;
    	$this->db->insert('MessageListsItems',$insert_vals);
    }
    public function delete($msg_id){
        $sql = "UPDATE MessageListsItems SET IsActive='0' WHERE MessageListID='".$msg_id."'";
        // echo $sql;
        // die()
        $query = $this->db->query($sql);

    //     $status = array('IsActive' => '0');
    //     $this->db->set($status); 
    // 	    $this->db->where('MessageListID', $msg_id);
    // //$this->db->delete('MessageListsItems');
    //         $this->db->update("MessageListsItems",$status);
    }
    public function edit_msg($edit_msgs,$msg_id){
        //$msg_id = $this->session->userdata('msg_id');
        $this->db->set($edit_msgs); 
        $this->db->where("MessageListID",$msg_id); 
        $this->db->update("MessageListsItems",$edit_msgs); 

    }
    public function getMessage_ajax($postData=null){
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
        $searchQuery = " (MessageGroup like '%".$searchValue."%' or MessageStart like '%".$searchValue."%' or MessageEnd like'%".$searchValue."%' or Message like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
     // $this->db->select('count(*) as allcount');
     // $this->db->order_by("MessageListID", "DESC");
     // $records = $this->db->get('MessageListsItems')->result();
     // $totalRecords = $records[0]->allcount;
    $this->db->select('count(MessageListID) as allcount');
    $this->db->where('IsActive','1');
    //$this->db->where('MessageStart <=',date('Y-m-d'));
    $this->db->where('MessageEnd >=',date('Y-m-d'));
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('MessageListsItems')->result();
    $totalRecords = $tot_records[0]->allcount;
    // print "<pre>";
    // print_r($totalRecords);
    // print"</pre>";
    // exit;

     ## Total number of record with filtering
    // $this->db->select('count(*) as allcount');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by("MessageListID", "DESC");
    // $records = $this->db->get('MessageListsItems')->result();
    // $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
    $this->db->select('MessageListID,Message,MessageStart,MessageEnd,MessageGroup');
    $this->db->where('IsActive','1');
    //$this->db->where('MessageStart <=',date('Y-m-d'));
    $this->db->where('MessageEnd >=',date('Y-m-d'));
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    //  $this->db->order_by("AssessmentTypeID", "DESC");
    $records = $this->db->get('MessageListsItems')->result();
    // $this->db->select('*');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by($columnName, $columnSortOrder);
    // $this->db->limit($rowperpage, $start);
    // $this->db->order_by("MessageListID", "DESC");
    // $records = $this->db->get('MessageListsItems')->result();

    $data = array();

    foreach($records as $record ){
        $end_date = strtotime($record->MessageEnd);
        $current_date = strtotime("now");
        //if ($record->IsActive==1 && $end_date >= $current_date) {
        $id = $record->MessageListID;
        $base_url  = base_url();
        $msgGRP="";
        if ($record->MessageGroup==1) {
            $msgGRP = 'Plumber Message';
        }elseif($record->MessageGroup==2){
            $msgGRP = 'Auditor Message';
        }
        elseif($record->MessageGroup==3){
            $msgGRP = 'Reseller Message';
        }
        elseif($record->MessageGroup==3){
            $msgGRP = 'Company Message';
        }
        // $action = "<a href='edit_view/$id'><img src='$base_url assets/images/edit.png' height='25' width='25'></a><a href='delete_msgs/$id' "."onclick='return confirm('you want to delete?');'><img src='$base_url assets/images/delete.png height='25' width='25'></a>";
//  $action = "<a onclick="'return confirm('you want to delete?'".");'".">Delete</a>";
        $test = "'".'you want to delete?'."'";
//$action = "<a onclick='return confirm("."'"."Test"."')'"'>Del</a>";
        $action = '<a href="'.$base_url.'message/edit_view/'.$id.'"data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>';
        $data[] = array( 
         "MessageGroup"=>$msgGRP,
         "MessageStart"=>$record->MessageStart,
         "MessageEnd"=>$record->MessageEnd,
         "Message"=>$record->Message,
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
    /// History

public function getMessage_ajax_history($postData=null){
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
        $searchQuery = " (MessageGroup like '%".$searchValue."%' or MessageStart like '%".$searchValue."%' or MessageEnd like'%".$searchValue."%' or Message like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(MessageListID) as allcount');
    $this->db->where('IsActive','1');        
    $this->db->where('MessageEnd <=',date('Y-m-d'));
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('MessageListsItems')->result();
    $totalRecords = $tot_records[0]->allcount;
    // $this->db->select('count(*) as allcount');

    // $records = $this->db->get('MessageListsItems')->result();
    // $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    // $this->db->select('count(*) as allcount');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    
    // $records = $this->db->get('MessageListsItems')->result();
    // $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('MessageListID,Message,MessageStart,MessageEnd,MessageGroup');
    $this->db->where('IsActive','1');    
    $this->db->where('MessageEnd <=',date('Y-m-d'));
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    //  $this->db->order_by("AssessmentTypeID", "DESC");
    $records = $this->db->get('MessageListsItems')->result();
    // $this->db->select('*');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by($columnName, $columnSortOrder);
    // $this->db->limit($rowperpage, $start);

    //  //$records = $this->db->get('MessageListsItems')->result();
    // $sql = "SELECT * FROM MessageListsItems WHERE MessageEnd < CURDATE()";
    // $query  = $this->db->query($sql);
    // $records = $query->result();

    $data = array();

    foreach($records as $record ){
        $end_date = strtotime($record->MessageEnd);
        $current_date = strtotime("now");
       // if ($end_date < $current_date) {
        $id = $record->MessageListID;
        $base_url  = base_url();
        $msgGRP="";
        if ($record->MessageGroup==1) {
            $msgGRP = 'Plumber Message';
        }elseif($record->MessageGroup==2){
            $msgGRP = 'Auditor Message';
        }
        elseif($record->MessageGroup==3){
            $msgGRP = 'Reseller Message';
        }
        elseif($record->MessageGroup==3){
            $msgGRP = 'Company Message';
        }
        // $action = "<a href='edit_view/$id'><img src='$base_url assets/images/edit.png' height='25' width='25'></a><a href='delete_msgs/$id' "."onclick='return confirm('you want to delete?');'><img src='$base_url assets/images/delete.png height='25' width='25'></a>";
//  $action = "<a onclick="'return confirm('you want to delete?'".");'".">Delete</a>";
        $test = "'".'you want to delete?'."'";
//$action = "<a onclick='return confirm("."'"."Test"."')'"'>Del</a>";
        // $action = '<a href="edit_view/'.$id.'"><img src="'.$base_url.'assets/images/edit.png" height="25" width="25"></a><a href="delete_msgs/'.$id.'" onclick="return confirm('.$test.');"><img src="'.$base_url.'assets/images/delete.png" height="25" width="25"></a>';
        $action = '<a href="'.$base_url.'message/delete_msgs/'.$id.'"data-original-title="Close" onclick="return confirm('.$test.');"><i class="fa fa-close text-danger"></i></a>';
        $data[] = array( 
         "MessageGroup"=>$msgGRP,
         "MessageStart"=>$record->MessageStart,
         "MessageEnd"=>$record->MessageEnd,
         "Message"=>$record->Message,
         "action"=>$action,

     ); 
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
} 