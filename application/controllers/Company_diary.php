<?php
  
   class company_diary extends CI_Controller { 

      function __construct() {
    parent::__construct();
    $this->load->model('diary_model');

    }

  
      public function index() { 
        $data = array();

        

         /* Load form helper */ 
         $this->load->helper(array('form'));
          $this->load->database();
         /* Load form validation library */ 
         

    //$this->load->library('form_validation');
         //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      
          
          //$this->form_validation->set_rules('admin_comment', 'Type your comment', 'required');
         
   // $this->load->helper('url');
      
         if ($this->form_validation->run() == false) {  
                   
               

            $data = array(               
                    
                    'Comments' => $this->input->post('admin_comment'));
        
                    $this->diary_model->form_insert($data); 
                    
          
      }
           
            $data['main_content'] = $this->load->view('company/diary_act', $data, TRUE);
            $this->load->view('admin/index', $data);
            redirect("company_diary/load_comment");

   }
       
              public function load_comment()
              {            
            
                $subtype_data_id = $this->uri->segment('3');        
              $query9 = $this->db->get_where("companies",array("CompanyID"=>$subtype_data_id));         
              $data['dataaa'] = $query9->result();



            $this->db->order_by("CommentsDate","DESC");
            
            $slect = $this->db->get('companycomments');

            $data['rec_comment'] = $slect->result();  

            $data['get_adm'] = $this->diary_model->get_name();

            $data['get_aud'] = $this->diary_model->get_audit(); 

            $data['get_com'] = $this->diary_model->get_comp();                                    
            $data['page_title'] = "Diary & Comments";
            $data['main_content'] = $this->load->view('company/diary_act', $data, TRUE);
            $this->load->view('admin/index', $data);
            


        }

          
                
             

                
                

              




}
?>




