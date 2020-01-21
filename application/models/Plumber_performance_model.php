<?php
class Plumber_performance_model extends CI_Model{

	function __construct() {
		parent::__construct();
	}
	public function insert($insert_vals){
		// print_r('<pre>');
		// print_r($insert_vals);
		// print_r('</pre>');
		// die;
		$this->db->insert('performancetypes',$insert_vals);
	}
    public function update($update_vals,$performance_ID){
        // print_r('<pre>');
        // print_r($performance_ID);
        // print_r('</pre>');
        // die;
        $this->db->where('PerformanceID', $performance_ID);
        $this->db->update('performancetypes', $update_vals);
        
        
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
        $searchQuery = " (Type like '%".$searchValue."%' or Points like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(PerformanceID) as allcount');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('performancetypes')->result();
    $totalRecords = $tot_records[0]->allcount;
    // $this->db->select('count(*) as allcount');
    // $this->db->order_by("PerformanceID", "DESC");
    // $records = $this->db->get('performancetypes')->result();
    // $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    // $this->db->select('count(*) as allcount');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by("PerformanceID", "DESC");
    // $records = $this->db->get('performancetypes')->result();
    // $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
    $this->db->select('PerformanceID,Type,Points');
    $this->db->where('isActive','1');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    //  $this->db->order_by("AssessmentTypeID", "DESC");
    $records = $this->db->get('performancetypes')->result();
    // $this->db->select('*');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by($columnName, $columnSortOrder);
    // $this->db->limit($rowperpage, $start);
    // $this->db->order_by("PerformanceID", "DESC");
    // $records = $this->db->get('performancetypes')->result();

    $data = array();

    foreach($records as $record ){        
        // if ($record->isActive==1) {
       $id = $record->PerformanceID;
       $base_url  = base_url();
       $test = "'".'You Want Move This To Archive ?'."'";
       $action = '<a href="'.$base_url.'plumber_performance_type/edit_view/'.$id.'" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a><div class="col-sm-6 col-md-4 col-lg-3"><a href="'.$base_url.'plumber_performance_type/addToArchive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
       $data[] = array( 
           "Type"=>$record->Type,
           "Points"=>$record->Points,
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
    /// Archive
public function get_ajax_archive($postData=null){
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
        $searchQuery = " (Type like '%".$searchValue."%' or Points like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(PerformanceID) as allcount');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $tot_records = $this->db->get('performancetypes')->result();
    $totalRecords = $tot_records[0]->allcount;
    // $this->db->select('count(*) as allcount');
    // $this->db->order_by("PerformanceID", "DESC");
    // $records = $this->db->get('performancetypes')->result();
    // $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    // $this->db->select('count(*) as allcount');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by("PerformanceID", "DESC");
    // $records = $this->db->get('performancetypes')->result();
    // $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('PerformanceID,Type,Points');
    $this->db->where('isActive','0');
    if($searchQuery != ''){
        $this->db->where($searchQuery);
    }
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    //  $this->db->order_by("AssessmentTypeID", "DESC");
    $records = $this->db->get('performancetypes')->result();
    // $this->db->select('*');
    // if($searchQuery != '')
    //     $this->db->where($searchQuery);
    // $this->db->order_by($columnName, $columnSortOrder);
    // $this->db->limit($rowperpage, $start);
    // $this->db->order_by("PerformanceID", "DESC");
    // $records = $this->db->get('performancetypes')->result();

    $data = array();

    foreach($records as $record ){        
        //if ($record->isActive==0) {
           $id = $record->PerformanceID;
           $base_url  = base_url();
           $test = "'".'You Want Move This To Active ?'."'";
           $test1 = "'".'You Want Delete This ?'."'";
           $action = '<a href="'.$base_url.'plumber_performance_type/edit_view/'.$id.'" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a> <a href="'.$base_url.'plumber_performance_type/delete/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-close text-danger"></i></a><div class="col-sm-6 col-md-4 col-lg-3"><a href="'.$base_url.'plumber_performance_type/addToActive/'.$id.'" data-toggle="tooltip" data-original-title="At To Archive" onclick="return confirm('.$test.');"><i class="fa fa-check-circle"></i></a></div>';
           $data[] = array( 
               "Type"=>$record->Type,
               "Points"=>$record->Points,
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