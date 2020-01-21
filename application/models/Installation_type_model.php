<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Installation_type_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

      public function insert_installation_type($data){
      	//echo "hi"; exit;
      	$this->db->insert('InstallationTypes',$data);
      	
    //return true;
      } 
      public function update_installation_type($select,$installionId){
      	$this->db->set($select); 
         $this->db->where("installationtype_id", $installionId); 
         $this->db->update("InstallationTypes", $select); 

      }

              public function installation_ckeck($data_val){
      $query = $this->db->get_where('InstallationTypes', array('installation_type' => $data_val)); 

    $rows = $query->num_rows();
      //     print_r($rows);
      // exit;
    
    return $rows;
    } 
  }
