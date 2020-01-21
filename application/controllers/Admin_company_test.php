<?php

class admin_company_test extends CI_Controller { 

 function __construct() {
  parent::__construct();
  $this->load->model('Company_test_model');
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

 $data = array();

 $pro_data = array();
 $pro_data  = $this->Company_test_model->get_province();
 $data['province_data'] = $pro_data;

 $province_val = set_value('province');


 if($province_val !='')
 {

  $city_data  = $this->Company_test_model->get_city($province_val);
} else {
  $city_data = array();
}

$data['city_data'] = $city_data;


$city_val = set_value('city');
$suburb_val = set_value('suburb');


if($city_val!='')
{
  $suburb_data  = $this->Company_test_model->get_suburb($city_val);
} 
else {
  $suburb_data = array();
}         
$data['suburb_data'] = $suburb_data;



$province_state_val = set_value('province_state');

if($province_state_val!='')
{

  $city_dataa  = $this->Company_test_model->get_city($province_state_val);
} else {

  $city_dataa = array();
}
$data['city_dataa'] = $city_dataa;

$city_vall = set_value('city_ci');
         //$suburb_val = set_value('suburb');



if($city_vall!='')
{
  $suburb_dataa  = $this->Company_test_model->get_suburb($city_vall);
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
   'CompMessage' => '',
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

  $ins = $this->Company_test_model->form_insert($data);



  $data['city_data'] = $city_data;
  $data['suburb_data'] = $suburb_data;

           // $data['message'] = 'Data Inserted Successfully';

  if ($this->form_validation->run() == FALSE)
  {

    $data2 = array(

      'company' => $ins,
      'fname' => $this->input->post('company_name'),

      'role' => 5);


    $this->Company_test_model->insert_form($data2);

  }

  if ($this->form_validation->run() == FALSE)
  {

    $data3 = array(


      'CompId' => $ins);


    $this->Company_test_model->inse_form($data3);

  }               



  $this->session->set_flashdata('success','Company Registered Sucessfully');  
  redirect('get_company/view'); 
}


$data['page_title'] = "Company Registration";
$data['main_content'] = $this->load->view('company_test/admin_register_company', $data, TRUE);
$this->load->view('admin/index', $data);



}
public function fetch_city(){
  if($this->input->post('ajaxprovince_id'))
  {
    $this->Company_test_model->fetch_city($this->input->post('ajaxprovince_id'));
  }

}

public function fetch_suburb() {
  if($this->input->post('ajaxcity_id'))
  {
    $this->Company_test_model->fetch_suburb($this->input->post('ajaxcity_id'));
  }

} 
}


?>




