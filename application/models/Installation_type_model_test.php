<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Installation_type_model_test extends CI_Model
{
  function __construct()
  {
    parent::__construct();

  }

  public function action($data)
  {
    $this->db->trans_begin();
    
    $userid     =   $this->getUserID();
    $id       =   $data['id'];
    $datetime   =   date('Y-m-d H:i:s');
    
    $request    = [
      'updated_at'    => $datetime,
      'updated_by'    => $userid
    ];

    if(isset($data['name']))  $request['name']  = $data['name'];
    if(isset($data['status']))  $request['status']  = $data['status'];

    if($id==''){
      $request['created_at'] = $datetime;
      $request['created_by'] = $userid;
      $this->db->insert('installationtype', $request);
    }else{
      $this->db->update('installationtype', $request, ['id' => $id]);
    }

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
