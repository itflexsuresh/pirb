<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subtype_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    public function insert_sub_type($data){
    	$this->db->insert('installationtypessub',$data);

    }
    public function subtype_update_model($valuesss,$SubId){
    	// echo "hii";
    	// print_r($valuesss);exit;
    	     
      	//echo $installionId; print_r($valuesss);exit;
      	$this->db->set($valuesss); 
         $this->db->where("subID", $SubId); 
         $this->db->update("installationtypessub", $valuesss); 
    }
}