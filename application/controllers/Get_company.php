<?php
  error_reporting(0);

   Class get_company extends CI_Controller { 

   		function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session', 'email', 'pagination'));
		$this->load->model('company_model');
		$this->load->helper('string');
		}
	
      	public function index() { 
//          /* Load form helper */             
			$this->load->view('company/view_company');			
      
   		}
   		public function view()
        {	  
           
        	$this->db->order_by("CompanyID","DESC");
            $slect = $this->db->get('companies');
                        
            $data['records'] = $slect->result();
            
            $data['page_title'] = "Company Listing";
            $data['main_content'] = $this->load->view('company/view_company', $data, TRUE);
             
         	$this->load->view('admin/index', $data);
        }
			        
		public function edit()
		{
   		
        $subtype_data_id = $this->uri->segment('3');        

        $query = $this->db->get_where("companies",array("CompanyID"=>$subtype_data_id));         
        $temp_sel['data'] = $query->result();        
         
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
         /* Set validation rule for name field in the form */ 
         $this->form_validation->set_rules('company_name', 'Company Name', 'required|min_length[5]|max_length[15]'); 
         $this->form_validation->set_rules('reg_number', 'Company Registration Number', 'required' );
         $this->form_validation->set_rules('vat_number', 'VAT Number', 'required');
         $this->form_validation->set_rules('prim_person', 'Primary Contact Person', 'required');
         $this->form_validation->set_rules('com_message', 'Company Specific Message', 'required');
         $this->form_validation->set_rules('phy_address', 'Physical Address', 'required');
         $this->form_validation->set_rules('work_phone', 'Work Phone', 'required');
         $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required');
         $this->form_validation->set_rules('email', 'Email Address', 'required');
         // $this->form_validation->set_rules('second_mobile', 'Secondary Mobile Phone', 'required');
         // $this->form_validation->set_rules('email_1', 'Secondary Email Address', 'required');
         
		//$this->load->helper('url');
			
         
         if ($this->form_validation->run() == TRUE) { 
         	
         	
			$work = $this->input->post('type');
			$spec = $this->input->post('types');
            $data = array(

            			'Password' => $this->input->post('pass'),
            			'Status' =>$this->input->post('choose'),	
						'CompanyName' => $this->input->post('company_name'),
						'CompanyRegNo' => $this->input->post('reg_number'),
						'VatNo' => $this->input->post('vat_number'),
						'PrimaryContact' => $this->input->post('prim_person'),
						'CompMessage' => $this->input->post('com_message'),
						'PhysicalAddress' => $this->input->post('phy_address'),
						'Province' => $this->input->post('province'),
						'City' => $this->input->post('city'),
						'Suburb' => $this->input->post('suburb'),
						'PostalAddress' => $this->input->post('post_address'),
						'PostalProvince' => $this->input->post('province_state'),
						'PostalCity' => $this->input->post('city_ci'),
						'PostalSuburb' => $this->input->post('suburb_si'),
						'PostalCode' => $this->input->post('post_code'),
						'BusinessPhone' => $this->input->post('work_phone'),
						'Mobile' => $this->input->post('mobile_phone'),
						'CompanyEmail' => $this->input->post('email'),
						'SecondaryMobilePh' => $this->input->post('second_mobile'),
						'SecondaryEmail' => $this->input->post('email_1'),						 
						'WorkType' =>implode(",", $work),
						'Specialisations' => implode(",", $spec));
					

            $data['CompanyID'] = $this->uri->segment('3');
            
            if($this->company_model->update($data))
            {
			// $data['message'] = 'Data updated successfully';

			}			
			$this->session->set_flashdata('success','Company Updated Sucessfully');
      		redirect('get_company/view');


			// function get_user()
	

		} else {
				$data['page_title'] = "Company Update";
				$data['main_content'] =$this->load->view('company/update_company',$temp_sel, TRUE);	

			$this->load->view('admin/index', $data);

		}


         
}


		public function update() { 	

      	
         /* Load form helper */ 
         //	$this->load->helper(array('form'));
			
         /* Load form validation library */ 
         //	$this->load->library('form_validation');
         $this->load->helper('form'); 
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
         /* Set validation rule for name field in the form */ 
         $this->form_validation->set_rules('company_name', 'Company Name', 'required|min_length[5]|max_length[15]'); 
         $this->form_validation->set_rules('reg_number', 'Company Registration Number', 'required' );
         $this->form_validation->set_rules('vat_number', 'VAT Number', 'required');
         $this->form_validation->set_rules('prim_person', 'Primary Contact Person', 'required');
         $this->form_validation->set_rules('com_message', 'Company Specific Message', 'required');
         $this->form_validation->set_rules('phy_address', 'Physical Address', 'required');
         $this->form_validation->set_rules('work_phone', 'Work Phone', 'required');
         $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required');
         $this->form_validation->set_rules('email', 'Email Address', 'required');
         $this->form_validation->set_rules('second_mobile', 'Secondary Mobile Phone', 'required');
         $this->form_validation->set_rules('email_1', 'Secondary Email Address', 'required');
         
		$this->load->helper('url');
			
         if ($this->form_validation->run() == FALSE) { 
         $this->load->view('company/view_company'); 
         } 
         else { 

			$work = $this->input->post('type');
			$spec = $this->input->post('types');
            $data = array(

						'Password' => $this->input->post('pass'),
            			'Status' => $this->input->post('choose'),
						'CompanyName' => $this->input->post('company_name'),						
						'CompanyRegNo' => $this->input->post('reg_number'),
						'VatNo' => $this->input->post('vat_number'),
						'PrimaryContact' => $this->input->post('prim_person'),
						'CompMessage' => $this->input->post('com_message'),
						'PhysicalAddress' => $this->input->post('phy_address'),
						'Province' => $this->input->post('province'),
						'City' => $this->input->post('city'),
						'Suburb' => $this->input->post('suburb'),
						'PostalAddress' => $this->input->post('post_address'),
						'PostalProvince' => $this->input->post('province_state'),
						'PostalCity' => $this->input->post('city_ci'),
						'PostalSuburb' => $this->input->post('suburb_si'),
						'PostalCode' => $this->input->post('post_code'),
						'BusinessPhone' => $this->input->post('work_phone'),
						'Mobile' => $this->input->post('mobile_phone'),
						'CompanyEmail' => $this->input->post('email'),
						'SecondaryMobilePh' => $this->input->post('second_mobile'),
						'SecondaryEmail' => $this->input->post('email_1'),						 
						'WorkType' =>implode(",", $work),
						'Specialisations' => implode(",", $spec));

$province_update = $this->input->post('province');
   	$city_update = $this->input->post('city');
   	$subrub_update = $this->input->post('suburb');   	

 $data = array('City' => $city_update, 'Suburb'=> $subrub_update, 'Province'=> $province_update);
 $this->company_model->update($data);
 //$this->session->set_flashdata('suburb_update','Suburb updated sucessfully');
 redirect('get_company/view');

    
            


            
            if($this->company_model->update($data))
            {
			$data['message'] = 'Data updated successfully';
			}
					
      		redirect('Get_company');


			// function get_user()
	

}

}
					public function employeelist($id)
        			{          

        				$subtype_data_id = $this->uri->segment('3');
        				$query = $this->db->get_where("companies",array("CompanyID"=>$subtype_data_id));         
        				$data['dataaa'] = $query->result();        
        

   						// $query = $this->db->get('users');
   						// $data['records1'] = $query->result();

        				//SELECT * FROM `users` WHERE role=2 AND company>0 ORDER BY `UserID` DESC

        				

        				$query6 = $this->db->query("SELECT * FROM users WHERE role = 2 and company = $id");
						$data['list_emp'] = $query6->result();




   						$data['page_title'] = "Employee Listing";
   						$data['main_content'] = $this->load->view("company/view_employee",$data, TRUE);						

							$this->load->view('admin/index', $data);

   						} 
				

					function get_select1()
					{
    					$data['recsel'] = $this->company_model->get_select();
    					 $this->load->view('company/update_company', $data);
    					

					}

				public function fetch_city(){
				    if($this->input->post('ajaxprovince_id'))
				  {
				    $this->company_model->fetch_city($this->input->post('ajaxprovince_id'));
				  }

				   }

					public function fetch_suburb(){
					    if($this->input->post('ajaxcity_id'))
					  {
					    $this->company_model->fetch_suburb($this->input->post('ajaxcity_id'));
					  }

					   }
					   		public function get_check1()
					   		{
							$data['Specialisations']=$query->row_array();
							$this->load->view('company/update_company', $data);			   	
							$this->company_model->get_check();
							}

							
						
   	  
					   	


}

?>




