<?php

class company extends CI_Controller { 

 function __construct() {
  parent::__construct();
  $this->load->model('company_model');
}

public function index() { 


 /* Load form helper */ 
 $this->load->helper(array('form'));
 $this->load->database();
         //$this->load->helper('url');

 /* Load form validation library */ 
 $this->load->library('form_validation');
 $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

 
// $form_validate_rules = array(
//     array('field' => 'CompanyName', 'label' => 'City', 'rules' => 'trim|required|callback_check_company'));
//        $this->form_validation->set_rules($form_validate_rules);

  $this->form_validation->set_rules('company_name', 'Company Name', 'required|is_unique[companies.CompanyName]');

$this->form_validation->set_rules('email', 'Eamil ID', 'required|is_unique[companies.CompanyEmail]');

 //$this->form_validation->set_rules('email','CompanyEmail','required|valid_email|callback_check_CompanyEmail');



 







         // $this->form_validation->set_rules('reg_number', 'Company Registration Number', 'required|numeric');
         // $this->form_validation->set_rules('vat_number', 'VAT Number', 'required|numeric');
         // $this->form_validation->set_rules('prim_person', 'Primary Contact Person', 'required|alpha');
         // $this->form_validation->set_rules('com_message', 'Company Specific Message', 'required');
         // $this->form_validation->set_rules('phy_address', 'Physical Address', 'required|alpha_numeric');


         // $this->form_validation->set_rules('post_address', 'Postal Address', 'required|alpha_numeric');
         // $this->form_validation->set_rules('post_code', 'Postal Code', 'required|numeric');         
         // $this->form_validation->set_rules('work_phone', 'Work Phone', 'required|numeric|exact_length[10]');
         // $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required|numeric|exact_length[10]');
 // $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[companies.CompanyEmail]');
 // $this->form_validation->set_message('is_unique', 'EmailID is already Exists.');
 //         // $this->form_validation->set_rules('second_mobile', 'Secondary Mobile Phone', 'required|numeric|exact_length[10]');
         // $this->form_validation->set_rules('email_1', 'Secondary Email Address', 'required|valid_email');
         // $this->form_validation->set_message('is_unique', 'EmailID is already Exists.');


 $data = array();

 $pro_data = array();
 $pro_data  = $this->company_model->get_province();
 $data['province_data'] = $pro_data;

 $province_val = set_value('province');


 if($province_val !='')
 {

  $city_data  = $this->company_model->get_city($province_val);
} else {
  $city_data = array();
}

$data['city_data'] = $city_data;


$city_val = set_value('city');
$suburb_val = set_value('suburb');


if($city_val!='')
{
  $suburb_data  = $this->company_model->get_suburb($city_val);
} 
else {
  $suburb_data = array();
}         
$data['suburb_data'] = $suburb_data;



$province_state_val = set_value('province_state');

if($province_state_val!='')
{

  $city_dataa  = $this->company_model->get_city($province_state_val);
} else {

  $city_dataa = array();
}
$data['city_dataa'] = $city_dataa;

$city_vall = set_value('city_ci');
         //$suburb_val = set_value('suburb');



if($city_vall!='')
{
  $suburb_dataa  = $this->company_model->get_suburb($city_vall);
} 
else {
  $suburb_dataa = array();
}
$data['suburb_dataa'] = $suburb_dataa;



$this->load->helper('url');

if ($this->form_validation->run() == false) 
{ 

} 

else { 

  $work = $this->input->post('type');      
  $spec = $this->input->post('types');

  $i=0;

  foreach ($work as $key) {

    $i = $i+1;              
  }

  $j=0;            

  foreach ($spec as $key) {

    $j = $j+1;              
  }


  $data = array(



   'Status' => 3,
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
   'WorkType' => implode(",", $work),
   'Specialisations' => implode(",", $work));

  $ins = $this->company_model->form_insert($data);



  $data['city_data'] = $city_data;
  $data['suburb_data'] = $suburb_data;

           // $data['message'] = 'Data Inserted Successfully';

  if ($this->form_validation->run() == FALSE)
  {

    $data2 = array(

      'company' => $ins,
      'fname' => $this->input->post('company_name'),

      'role' => 5);


    $this->company_model->insert_form($data2);

  }

  if ($this->form_validation->run() == FALSE)
  {

    $data3 = array(


      'CompId' => $ins);


    $this->company_model->inse_form($data3);

  }               



  $this->session->set_flashdata('success','Company Registered Sucessfully');  
  redirect('get_company/view'); 
}


$data['page_title'] = "Company Registration";
$data['main_content'] = $this->load->view('company/register_company', $data, TRUE);
$this->load->view('admin/index', $data);



}
public function fetch_city(){
  if($this->input->post('ajaxprovince_id'))
  {
    $this->company_model->fetch_city($this->input->post('ajaxprovince_id'));
  }

}

public function fetch_suburb() {
  if($this->input->post('ajaxcity_id'))
  {
    $this->company_model->fetch_suburb($this->input->post('ajaxcity_id'));
  }

} 

// public function check_company()
// {
//     $this->load->model('company_model');

// $rows = $this->company_model->checkUsernameAvailability();


// if($rows != 0)
// {
//     $this->session->set_flashdata('company_name', 'Already CompanyName Exists.');
//     //redirect('get_company/view'); 
//     return false;
    
//   }
//   return true;

// }





// public function check_CompanyEmail(){
  
//   $row1 = $this->load->model('company_model');

//   if ($row1 != 0)
//   {
//     $this->session->set_flashdata('email', 'Email Already Exists.');
//     return false;
    
//   }
//   return true;

// }
//for testing
}

?>




