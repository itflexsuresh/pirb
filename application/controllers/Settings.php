<?php 

class settings extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Settings_model'));        
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view()
 {
   $query = $this->db->get("settings");
   $data['records'] = $query->result();

   $province_val_db = $data['records'][0]->Province;
   if($data['records'][0]->Province !='')
   {
     $city_data  = $this->Settings_model->get_city($province_val_db);

   } else {
     $city_data = array();
     $postal_city_data = array();
   }
   $data['city_data'] = $city_data; 

        /// physical suburb
   $suburb_val_db = $data['records'][0]->City;
   if($data['records'][0]->City!='')
   {
     $suburb_data  = $this->Settings_model->get_suburb($suburb_val_db);

   } else {
     $suburb_data = array();

   }
   $data['suburb_data'] = $suburb_data;

        //// postal city

   $postal_province_val_db = $data['records'][0]->PostalProvince;
   if($data['records'][0]->PostalProvince !='')
   {
     $postal_city_data  = $this->Settings_model->postal_get_city($postal_province_val_db);

   } else {
     $postal_city_data = array();
   }
   $data['postal_city_data'] = $postal_city_data; 
         /// postal suburb
   $postal_suburb_val_db = $data['records'][0]->PostalCity;
   if($data['records'][0]->PostalCity!='')
   {
     $psotal_suburb_data  = $this->Settings_model->postal_get_suburb($postal_suburb_val_db);

   } else {
     $psotal_suburb_data = array();

   }
   $data['postal_suburb_data'] = $psotal_suburb_data;

   $data['page_title'] = "Settings";
   $data['main_content'] = $this->load->view("settings/settings_view",$data,TRUE);
   $this->load->view('admin/index', $data);

 }
 public function update(){

   $ajax_vals = $this->input->post();
  // print_r($ajax_vals['comp_compName']);die;

  //if ($this->input->post('ContentPlaceHolder1btn_add')) { 


    $company_name = $ajax_vals['comp_compName'];
    $company_registration_number = $ajax_vals['comp_RegNum'];
    $vat_number = $ajax_vals['comp_VAT'];
        ///physical
    $physical_addr = $ajax_vals['phy_Addrs'];
    $physical_province = $ajax_vals['phy_province'];
    $physical_city = $ajax_vals['phy_city'];
    $physical_suburb = $ajax_vals['phy_suburb'];
        ///postal
    $postal_addr = $ajax_vals['post_Addrs'];
    $postal_province = $ajax_vals['post_province'];
    $postal_city = $ajax_vals['post_city'];
    $postal_suburb = $ajax_vals['post_suburb'];

    $postal_code = $ajax_vals['comp_postcode'];
    $work_phone = $ajax_vals['comp_pone'];
    $email = $ajax_vals['comp_Email'];

        //Banking details
    $bank_name = $ajax_vals['bnk_Bname'];
    $account_name = $ajax_vals['bnk_AcName'];
    $branch_code = $ajax_vals['bnk_Bcode'];
    $account_number = $ajax_vals['bnk_AcNo'];
    $account_type = $ajax_vals['bnk_AcType'];

        //global settings
    $VAT_percentage = $ajax_vals['Glb_percentage'];
    $system_email = $ajax_vals['Glb_SysEmail'];
    $deafult_plumber_max = $ajax_vals['Glb_plumbermax'];
    $deafult_reseller_max = $ajax_vals['Glb_Reseller_max'];
    $deafult_company_max = $ajax_vals['Glb_Company_max'];
    $deafult_refix_period = $ajax_vals['Glb_REfix'];
    $auto_ratio = $ajax_vals['Glb_AuditRatio'];
    $days_allowed = $ajax_vals['Glb_DayAllowed'];
    $plumberexpired_expired = $ajax_vals['Glb_plumberExpired'];

        // echo $company_name;echo "<br>";
        // echo $company_registration_number;echo "<br>";
        // echo $vat_number;echo "<br>";
        // //physical
        // echo $physical_addr;echo "<br>";
        // echo $physical_province;echo "<br>";
        // echo $physical_city;echo "<br>";
        // echo $physical_suburb;echo "<br>";
        // //postal
        // echo $postal_addr;echo "<br>";
        // echo $postal_province;echo "<br>";
        // echo $postal_city;echo "<br>";
        // echo $postal_suburb;echo "<br>";
        // echo $postal_code;echo "<br>";
        // echo $work_phone;echo "<br>";
        // echo $email;echo "<br>";
        // //bank
        // echo $bank_name;echo "<br>";
        // echo $account_name;echo "<br>";
        // echo $branch_code;echo "<br>";
        // echo $account_number;echo "<br>";
        // echo $account_type;echo "<br>";
        // //global
        // echo $VAT_percentage;echo "<br>";
        // echo $system_email;echo "<br>";
        // echo $deafult_plumber_max;echo "<br>";
        // echo $deafult_reseller_max;echo "<br>";
        // echo $deafult_company_max;echo "<br>";
        // echo $deafult_refix_period;echo "<br>";
        // echo $auto_ratio;echo "<br>";
        // echo $days_allowed;echo "<br>";
        // echo $plumberexpired_expired;echo "<br>";
    $update_data = array('CompanyName' =>$company_name, 'CompanyRegistrationNumber' =>$company_registration_number, 'CompanyVatNumber' =>$vat_number, 'PhysicalAddress' =>$physical_addr, 'Province' =>$physical_province, 'City' =>$physical_city, 'Suburb' =>$physical_suburb, 'PostalAddress' =>$postal_addr, 'PostalProvince' =>$postal_province, 'PostalCity' =>$postal_city, 'PostalSuburb' =>$postal_suburb, 'PostalCode' =>$postal_code, 'CompanyTelephoneNumber' =>$work_phone, 'CompEmailAddress' =>$email, 'BankName' =>$bank_name, 'AccountName' =>$account_name, 'BranchCode' =>$branch_code, 'AccountNumber' =>$account_number, 'AccountType' =>$account_type, 'VatPercentage' =>$VAT_percentage, 'SystemEmailAddress' =>$system_email, 'PlumberMaxNonLoggedCertificates' =>$deafult_plumber_max, 'ResellerMaxNonLoggedCertificates' =>$deafult_reseller_max, 'CompanyMaxNonLoggedCertificates' =>$deafult_company_max, 'RefixPeriod' =>$deafult_refix_period, 'AuditPercentage' =>$auto_ratio, 'latepayment' =>$days_allowed, 'plumberexpirelimit' =>$plumberexpired_expired );
        // print_r('<pre>');
        // print_r($update_data);
        // print_r('</pre>');
        // exit;
    $this->Settings_model->update($update_data);

    $developmental1 = $ajax_vals['dev_Direct'];
    $developmental2 = $ajax_vals['dev_Master'];
    $developmental3 = $ajax_vals['dev_License'];
    $developmental4 = $ajax_vals['dev_TechOp'];
    $developmental5 = $ajax_vals['dev_TechAss'];
    $developmental6 = $ajax_vals['dev_Learner'];

    $workbased1 = $ajax_vals['work_Direct'];
    $workbased2 = $ajax_vals['work_Master'];
    $workbased3 = $ajax_vals['work_License'];
    $workbased5 = $ajax_vals['work_TechOp'];
    $workbased4 = $ajax_vals['work_TechAss'];
    $workbased6 = $ajax_vals['work_Learner'];

    $individual1 = $ajax_vals['indi_Direct'];
    $individual2 = $ajax_vals['indi_Master'];
    $individual3 = $ajax_vals['indi_License'];
    $individual4 = $ajax_vals['indi_TechOp'];
    $individual5 = $ajax_vals['indi_TechAss'];
    $individual6 = $ajax_vals['indi_Learner'];
    
        // $update_data_cpd = array('' => , );
        // $this->Settings_model->update_CPD($update_data_cpd);
    // Direct plumber
    $direct = "UPDATE `plumberdesignationpoints` SET `Developmental`='".$developmental1."', `WorkBased`='".$workbased1."', `Individual`='".$individual1."' WHERE `DesignationID`='1' ";
    $direct_query = $this->db->query($direct);
// Master plumber
    $master = "UPDATE `plumberdesignationpoints` SET `Developmental`='".$developmental2."', `WorkBased`='".$workbased2."', `Individual`='".$individual2."' WHERE `DesignationID`='2' ";
    $master_query = $this->db->query($master);
// Licensed plumber
    $license = "UPDATE `plumberdesignationpoints` SET `Developmental`='".$developmental3."', `WorkBased`='".$workbased3."', `Individual`='".$individual3."' WHERE `DesignationID`='3' ";
    $license_query = $this->db->query($license);
// Technical operator plumber
    $techinical_op = "UPDATE `plumberdesignationpoints` SET `Developmental`='".$developmental4."', `WorkBased`='".$workbased4."', `Individual`='".$individual4."' WHERE `DesignationID`='4' ";
    $techinical_op_query = $this->db->query($techinical_op);
// Technical assissting plumber
    $techinical_ass = "UPDATE `plumberdesignationpoints` SET `Developmental`='".$developmental5."', `WorkBased`='".$workbased5."', `Individual`='".$individual5."' WHERE `DesignationID`='5' ";
    $techinical_ass_query = $this->db->query($techinical_ass);
// Learner plumber
    $learn = "UPDATE `plumberdesignationpoints` SET `Developmental`='".$developmental6."', `WorkBased`='".$workbased6."', `Individual`='".$individual6."' WHERE `DesignationID`='6' ";
    $learn_query = $this->db->query($learn);

    if(isset($_REQUEST['id'])){
      $this->session->set_flashdata('updateMSG','updated Sucessfully');
    }
    $this->session->set_flashdata('updateMSG','updated Sucessfully');
    echo "Sucess";
    //redirect('settings/view');
  //}
      //$this->load->view("settings/settings_view",$update_data);
}



/////physical
public function fetch_city(){
  if($this->input->post('ajaxprovince_id'))
  {

    $this->Settings_model->fetch_city($this->input->post('ajaxprovince_id'));
  }

}

public function fetch_suburb(){
  if($this->input->post('ajaxcity_id'))
  {

    $this->Settings_model->fetch_suburb($this->input->post('ajaxcity_id'));
  }

}

   //////////////////psotal ///////////////////////
public function psotal_fetch_city(){
  if($this->input->post('ajaxpostal_province_id'))
  {

    $this->Settings_model->psotal_fetch_city($this->input->post('ajaxpostal_province_id'));
  }

}
public function postal_fetch_suburb(){
  if($this->input->post('ajaxpostal_city_id'))
  {

    $this->Settings_model->postal_fetch_suburb($this->input->post('ajaxpostal_city_id'));
  }

}
}
?>