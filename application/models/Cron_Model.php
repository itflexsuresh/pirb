<?php

class Cron_Model extends CC_Model
{
public function display_records(){

  $query=$this->db->query("select * from rates");
  return $query->result();


}
public function updaterecords($id,$futuredate,$amount){


	$query="UPDATE `rates` 
		SET `validfrom`='".$futuredate."',
		`amount`='".$amount."',
		`futuredate` = '',
		`futureammount` = '0'
		 WHERE `id`=".$id;
		$this->db->query($query);
}


}
?>
