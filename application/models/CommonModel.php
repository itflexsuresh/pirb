<?php
class commonModel extends CI_Model{

	public $empty_arr = array(''=>'Select');
	function __construct() {
		parent::__construct();

		$empty_arr = $this->config->item('empty_arr');
	}

	// function get_province(){
	// 	extract($_REQUEST);
	// 	$this->db->select('ID AS id, Name AS val');
	//     $this->db->from('province');
	//     $query = $this->db->get();
	//     $res = $query->result_array();
	//     return $res;
	// }

	// function get_city($id){
	// 	extract($_REQUEST);
	// 	$this->db->select('ID AS id, Name AS val');
	//     $this->db->from('area');
	//     $this->db->where('ProvinceID', $id);
	//     $query = $this->db->get();
	//     $res = $query->result_array();
	//     return $res;
	// }

	// function get_area($id){
	// 	extract($_REQUEST);
	// 	$this->db->select('SuburbID AS id, Name AS val');
	//     $this->db->from('areasuburbs');
	//     $this->db->where('CityID', $id);
	//     $query = $this->db->get();
	//     $res = $query->result_array();
	//     return $res;
	// }

	//	function get_data($type='',$sel_val=''){
	function get_data($arg){
		extract($arg);
		$type_arr = array(
						'company'=>array('table'=>'companies','id'=>'CompanyID','val'=>'CompanyName',),
						'province'=>array('table'=>'province','id'=>'ID','val'=>'Name',),
						'city'=>array('table'=>'area','id'=>'ID','val'=>'Name','sel_field'=>'ProvinceID',),
						'area'=>array('table'=>'areasuburbs','id'=>'SuburbID','val'=>'Name','sel_field'=>'CityID','status'=>'isActive'),
					);
		$type_arr_res = $type_arr[$field];

		extract($type_arr_res);
		// if($type=='company'){
		// 	$id = 'CompanyID';
		// 	$val = 'CompanyName';
		// 	$table = 'companies';
			
		// } else if($type=='province'){
		// 	$id = 'ID';
		// 	$val = 'Name';
		// 	$table = 'province';
		// }
		$res = array();
		extract($_REQUEST);
		if($table!=''){
			if(!isset($status)){
				$status = 'status';				
			}
			$where_cond = array($status=>1,);
			if(isset($sel_val)){
				$where_cond[$sel_field] = $sel_val;
			}
			$this->db->select("$id AS id, $val AS val");
		    $this->db->from($table);	    
		    $this->db->where($where_cond);
		    $this->db->order_by($val, "ASC");

		    $query = $this->db->get();

		    $res = $query->result_array();		

	    }
	    return $res;
	}

	// function set_selectbox($data=array()){
	// 	extract($_REQUEST);
	// 	$res = array();		
	// 	//$first_elem = array('Select');
	// 	$res = array(''=>'Select')+array_column($data, 'val', 'id');

		
	// 	//	exit;
	// 	//	array_unshift($res, "Select");
	// 	return $res;
	// }

	function set_selectbox_data($arg=array()){
		extract($arg);
		$data = $this->get_data($arg);
		$array_res = array_column($data, 'val', 'id');
		if(isset($method) && $method=='json'){
			$res = json_encode($array_res);
		} else {
			$res = $this->empty_arr+$array_res;
		}

		//	$res = $this->empty_arr+array_column($data, 'val', 'id');
		return $res;
	}

	// function selectbox_arr($sel_val,$type=''){
	// 	$fun_name = 'get_'.$type;
	// 	$empty_arr = $this->config->item('empty_arr');
	// 	if($sel_val>0){
	// 		// $data = $this->$fun_name($sel_val);
	// 		// $data = $this->set_selectbox($data);
	// 		$data = $this->set_selectbox_data($type);
	// 	} else {
	// 		$data = $empty_arr;
	// 	}
	// 	return $data;
	// }

	function config_data($arr=array()){
		$res = array_combine(range(1, count($arr)), array_values($arr));
		return $res;
	}

	function config($field,$type='select'){
		if($type=='select'){
			$pref = $this->empty_arr;
		} else {
			$pref = array();
		}
		$res = $pref+$this->config_data($this->config->item($field));
		return $res;
	}

	function config1($field,$typ){
		$data = $this->config->item($field);
		print '<pre>';
		print_r($data);
		print '</pre>';
		exit;
		// if($type=='select'){
		// 	$pref = $this->empty_arr;
		// } else {
		// 	$pref = '';
		// }
		$res = $this->empty_arr+$this->config_data();
		return $res;
	}

	function slug($str,$delimiter='_'){
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
	}

}

?>