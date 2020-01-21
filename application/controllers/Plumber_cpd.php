<?php 

class plumber_cpd extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library('phpqrcode/qrlib');
   $this->load->library('pdf');
  // $this->load->library('phpqrcode/qrlib');
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Plumber_cpd_points_model'));        
   //$this->load->library('pdf');
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view($usrID = '83'){
  $select = "SELECT `UserID`,`status`,`fname`,`lname` FROM `users` WHERE `UserID`='".$usrID."' AND `role`='2' AND `status`='1'";
  $data['plumber_details'] = $this->db->query($select)->result();
    // print_r($data['plumber_details']);
    // die;
  $data['page_title'] = "Plumber Details for ".$data['plumber_details'][0]->fname." ".$data['plumber_details'][0]->lname."";
  $data['main_content'] = $this->load->view("plumber_cpd/plumber_cpd_view",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function get_ajaxpagination_view_active(){
    //     print_r($ID);
    // die;
        // POST data
  $postData = $this->input->post();
  //print_r($postData);die;
     // Get data
  $data = $this->Plumber_cpd_points_model->getAssessment_ajax_active($postData);

  echo json_encode($data);

}
public function get_ajaxpagination_view_archive(){

            // POST data
  $postData = $this->input->post();
     // Get data
  $data = $this->Plumber_cpd_points_model->getAssessment_ajax_archive($postData);

  echo json_encode($data);

}
public function get_ajax_PDF($AssessmentID){
  $select = "SELECT * FROM `assessments` WHERE `AssessmentID`='".$AssessmentID."'";
  $records = $this->db->query($select)->result();
  /////////// PLUMBER NAME AND SURNAME USERS TABLE
  $select_user = "SELECT `fname`,`lname` FROM `users` WHERE `UserID`='".$records[0]->UserID."'";
  $records_user = $this->db->query($select_user)->result();
  $plumber_name = $records_user[0]->fname;
  $plumber_surname = $records_user[0]->lname;

  //////////////////// ASSESSMENT TABLE
  $plumber_activity = $records[0]->Activity;
  $plumber_product_Code = $records[0]->ProductCode;
  $plumber_points = $records[0]->NoPoints;
  $plumber_CPD_stream = $records[0]->CPD_Stream;

////// Get the CPDACTIVITY TABLE DETAILS
  $select_CPD_activity = "SELECT * FROM `cpdactivities` WHERE `CPDActivityID`='".$records[0]->CPDActivityID."'";
  $records_CPD_activity = $this->db->query($select_CPD_activity)->result();
  $img_url = base_url()."qrcodes/images/";
  $img = rawurlencode($records_CPD_activity[0]->QRCode);
  $QR = "<img width='500' height='500' src=".$img_url.$img.">";
  ///////////// PDF GNERATION

  $html = '<h2>Plumber CPD</h2>
  Name: '.$plumber_name.'<br>
  Surname: '.$plumber_surname.'<br>
  Activity: '.$plumber_activity.'<br>
  Product Code: '.$plumber_product_Code.'<br>
  No of points: '.$plumber_points.'<br>
  CPD Stream: '.$plumber_CPD_stream.'<br>
  QR CODE: <br>
  '.$QR.'';

  $pdfFilePath = "Plumber CPD.pdf";
  $this->pdf->loadHtml($html);
  $this->pdf->setPaper('A4', 'portrait');
  $this->pdf->render();
  $this->pdf->stream($pdfFilePath); 

}
}