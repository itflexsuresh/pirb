<?php

class purchase_coc extends CI_Controller { 

  function __construct() {
   parent::__construct();
   $this->load->model('purchase_model');
 }

 public function index() { 
   /* Load form helper */ 
   $this->load->helper(array('form'));
   $this->load->database();
   /* Load form validation library */ 
   $this->load->view('company/purchase_coc');

   

 

    //   public function edit()
    // {

    //            
    //     //$query = $this->db->get_where("cocstatements",array("CompId"=>$subtype_data_id));         
    //     $temp_sel['data'] = $this->purchase_model->get_noncoc($COCStatementID)
    //     //$data['CompId'] = $this->uri->segment('3');        
    //     $this->load->view('purchase_coc/purchase_coc',$temp_sel);

    //         }


// public function get_noncoc($CompId)
//         { 
//             $this->db->select('CompId');            
//             $query = $this->db->get('cocstatements');
//             $result = $this->db->where('CompId', $CompId);
//             return $query->result;
//         }



}

 public function pur_coc($id)
 {
      
  //$data['non_all'] = $this->purchase_model->non_allocate();

        $subtype_data_id = $this->uri->segment('3');        
        $query9 = $this->db->get_where("companies",array("CompanyID"=>$subtype_data_id));         
        $data['dataaa'] = $query9->result();

           
  $this->db->select('NoCOCpurchases');
  //$query2 = $this->db->get_where();
  //$this->db->join('companies AS t2', 't2.CompanyName = t1.fname');
  //$this->db->where("CompanyID", $id );  
  $this->db->where("company", $id );
  $query = $this->db->get('users AS t1');
  $data['res'] = $query->row_array();
  

    // $this->db->select_sum('CompId');//standard codeigniter method for getting sum
    // $t= $this->db->get('cocstatements')->row_array();
    // $data['nonall'] =$t->CompId;
    
  
    $query2 = $this->db->query("SELECT count(CompId) AS num_of_time FROM cocstatements WHERE CompId = $id and DateLogged is null");
    //$this->db->where("CompId", $id);
    $data['non_all'] = $query2->row_array();


    $first = $data['non_all'];
    $second = $data['res'];
    $data['total'] = $second['NoCOCpurchases'] - $first['num_of_time'];
      


      $query3 = $this->db->query("SELECT Amount FROM rates");
      //$this->db->where("CompId", $id);
      $data['amou'] = $query3->row_array();

    

      if (!empty($_POST)) {

            $data5 = array (

						//'' => $this->input->post('non_loggedcoc'),
						// '' => $this->input->post('total'),
						//'' => $this->input->post('permitted'),
						'COCType' => $this->input->post('rad'),
						'TotalNoItems' => $this->input->post('no_coc'),
						'SubTotal' => $this->input->post('cost'),						
						'Delivery' => $this->input->post('delivery'),
						'Vat' => $this->input->post('vat'),
						'Total' => $this->input->post('due'));


      //       if ($permitted >= $no_coc)
      // {
      //   $this->form_validation->set_message('check_equal_less', 'The First &amp;/or Second fields have errors.');
      //   return false;       
      // }

            		$this->purchase_model->form_insert($data5);

                $this->session->set_flashdata('success','COC Purchased Sucessfully'); 
                //redirect('purchase_coc/pur_coc');
          }



            //       if ($this->form_validation->run() == FALSE)


            // {
               
            //     $data3 = array(


            //     'CompId' => $ins);

                 
            //    $this->purchase_model->form_insert($data3);
               
            //    }

         
				          $data['page_title'] = " COC Purchase";
				  
         
				    $data['main_content'] = $this->load->view("company/purchase_coc", $data, TRUE);
				  	$this->load->view('admin/index', $data);

			
				

}


}

?>




