<?php

Class purchase_model extends CI_Model {
function __construct() {
parent::__construct();

}


public function form_insert($data)
{

$this->db->insert('orders', $data);

$insert_id = $this->db->insert_id();
return $insert_id;

}



				// 	public function get_noncoc()
				// {	
				//     $this->db->select('TotalNoItems'); 				    
				//     $query = $this->db->get_where('orders', array('User' => $NULL));
				//     return $query;
				// }
	
			// 	public function get_total()
			// 	{

			// 	    $this->db->select('NoCOCpurchases');
			// 	    $this->db->join('companies', 'companies.CompanyName' = 'users.fname', 'inner');
			// 	    $query8 = $this->db->get('users');
				    
			// 	    return $query8->result();
				
			// }
					// public function non_allocate() {
					
					// $this->db->select('CompId');
    	// 			$this->db->from('cocstatements');
    	// 			$this->db->where('id', $id);
    	// 			$query = $this->db->get();
    	// 			$result3 = $query3->result();
    	// 			return $result3;

    	// 		}



					// public function get_total() {
					
					// $this->db->select('NoCOCpurchases');
    	// 			$query2 = $this->db->get_where('users');
    	// 			$result2 = $query2->result();
    	// 			return $result2;

    	// 		}
		

			
				
				
				// public function cou_coc()
				// {
				// 	$query10 = $this->db->select('CompId')->from('cocstatements')->where('COCStatementID', $COCStatementID)->get();
				//     return $query10->result();
				// 	//return $result6();
				// }
			

				// public function non_allocate()
    //           { 
    //           $this->db->select('count(CompId)');  
    //           $this->db->from('cocstatements');
              
    //           $query5 = $this->db->where('CompId', $CompId);
    //           $result6 = $query5->result();
    //           return $result6; 
    //             }

}
?>



 
