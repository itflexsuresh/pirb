<?php
class plumberModel extends CI_Model{

	function __construct() {
		parent::__construct();
	}

	function insert_data($data){
	// Inserting in Table(students) of Database(college)
			
// 		print '<pre>';
// print_r($data['users']);
// print '</pre>';
// exit;
		if(!empty($data['companies'])){
			$this->db->insert('companies', $data['companies']);
			$company_inserted_id = $this->db->insert_id();
			$data['users']['company'] = $company_inserted_id;
		}
		if(!empty($data['users'])){
			$this->db->insert('users', $data['users']);
			$users_inserted_id = $this->db->insert_id();
			$data['newapplications']['UserID'] = $users_inserted_id;
			
		}
		if(!empty($data['newapplications'])){
			$this->db->insert('newapplications', $data['newapplications']);
		}

		$newapplicationcertificates = array();
		if(!empty($_SESSION['certificate'])){
			$certificate = $_SESSION['certificate'];
			foreach ($certificate as $key => $value) {
				$newapplicationcertificates['Certificate'] = $value;
				$newapplicationcertificates['UserID'] = $users_inserted_id;
				$this->db->insert('newapplicationcertificates', $newapplicationcertificates);
			}
        }
    	unset($_SESSION['certificate']);
		
	}

	function update_data($data){

		if(!empty($data['users'])){
			$this->db->where('UserID', $data['id']);
			$this->db->update('users', $data['users']);
		}
		if(!empty($data['newapplications'])){
			$this->db->where('UserID', $data['id']);
			$this->db->update('newapplications', $data['newapplications']);
		}

		$this->db->where('UserID', $data['id']);		
		$newapplicationcertificates = array();
		if(!empty($_SESSION['certificate'])){
			$certificate = $_SESSION['certificate'];
			foreach ($certificate as $key => $value) {
				$newapplicationcertificates['Certificate'] = $value;
				$newapplicationcertificates['UserID'] = $data['id'];
				$this->db->replace('newapplicationcertificates', $newapplicationcertificates);
			}
        }
    	unset($_SESSION['certificate']);

	}

}
?>