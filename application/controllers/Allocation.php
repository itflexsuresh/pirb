<?php

class allocation extends CI_Controller { 

  function __construct() {
   parent::__construct();
   $this->load->model('allocation_model');
 }

 public function index() { 
   /* Load form helper */ 
   $this->load->helper(array('form'));
   $this->load->database();
   /* Load form validation library */ 
   $this->load->view('company/coc_allocation');

}

 public function coc_alloc($id)
 {
        $subtype_data_id = $this->uri->segment('3');        
        $query9 = $this->db->get_where("companies",array("CompanyID"=>$subtype_data_id));         
        $data['dataaa'] = $query9->result();




    $query2 = $this->db->query("SELECT role, fname, lname FROM `users` WHERE role = 2 and `company` = $id");
    //$this->db->where("CompId", $id);
    $data['sel_plum'] = $query2->result();
    
    
$query4 = $this->db->query("SELECT count(CompId) AS num_of_time FROM cocstatements WHERE CompId = $id and DateLogged is null");
    //$this->db->where("CompId", $id);
    $data['non_all'] = $query4->row_array();

  $this->db->select('NoCOCpurchases');
  //$query2 = $this->db->get_where();
  $this->db->join('companies AS t2', 't2.CompanyName = t1.fname');
  $this->db->where("CompanyID", $id);
  $query = $this->db->get('users AS t1');
  $data['res'] = $query->row_array();







    
    

    $first = $data['non_all'];
    $second = $data['res'];
    $data['total'] = $second['NoCOCpurchases'] - $first['num_of_time'];





    if (!empty($_POST)) {

            $data = array (

            
            '' => $this->input->post('plumber'),
            '' => $this->input->post('non_loggedcoc'),
            '' => $this->input->post('total'),           
            '' => $this->input->post('permitted'),
            '' => $this->input->post('type_plumber'));
            


      //       if ($permitted >= $no_coc)
      // {
      //   $this->form_validation->set_message('check_equal_less', 'The First &amp;/or Second fields have errors.');
      //   return false;       
      // }

                $ins =  $this->allocation_model->form_insert($data);

                $this->session->set_flashdata('success','COC Purchased Sucessfully'); 

          }


    else {
				    $data['page_title'] = " COC Allocation";
				    $data['main_content'] = $this->load->view("company/coc_allocation", $data, TRUE);
				  	$this->load->view('admin/index', $data);

				}
				

}

}



?>




