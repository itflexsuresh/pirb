
<?php 

class cpd_points extends CI_Controller {

  function __construct() { 
   parent::__construct(); 
   $this->load->library('phpqrcode/qrlib');
   $this->load->library(array('form_validation', 'session', 'email', 'pagination'));
   $this->load->model(array('Cpd_points_model'));        
   $this->load->library('pdf');
   $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
   $this->load->database(); 

 }
 public function view()
 {
   $data['page_title'] = "CPD Types";
   $data['main_content'] = $this->load->view("cpd_types/cpd_types_view",$data,TRUE);
   $this->load->view('admin/index', $data);

 }
 public function insert(){
  $activity = $this->input->post('activity');
  $start_date = $this->input->post('start_date');
  $end_date = $this->input->post('end_date');
  $cpdPoints = $this->input->post('cpdPoints');
  $productCode = $this->input->post('product_code');
  $CPDStream = $this->input->post('CPDstreams');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  /////////////////// QR CODE 

  $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/auditit_new/auditit/qrcodes/images/';
  $text = $productCode;
  $text1= substr($text, 0,9);
  $folder = $SERVERFILEPATH;
  $file_name1 = $text1."-Qrcode".rand(2,200).".png";
  $file_name = $folder.$file_name1;
  define('IMAGE_WIDTH',1000);
  define('IMAGE_HEIGHT',1000);
  QRcode::png($text,$file_name,'L', '10', '10');
  $baseURL = base_url();
  $qr_code = $file_name1;

  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $str_start_date = strtotime($start_date);
  $str_end_date = strtotime($end_date);
  $db_date_start = date("Y-m-d",$str_start_date);
  $db_date_end = date("Y-m-d",$str_end_date);
  $data = array('Activity' => $activity,'StartDate' => $db_date_start,'EndDate' => $db_date_end,'Points' => $cpdPoints,'ProductCode' => $productCode,'CPDStream' => $CPDStream,'isActive' => $check_val,'isApproved' => '0','isRejected' => '0','QRCode' => $qr_code );
  // print_r($data);die;
  $this->Cpd_points_model->insert($data);
  $this->session->set_flashdata('CPD_add_sucess','CPD Types Added Sucessfully');
  redirect('cpd_points/view');

}
public function edit_view(){
  $data['CPD_Id'] = $this->uri->segment(3);
  //$this->session->set_userdata('Cpd_ID',$CPD_Id);
  $select = "SELECT `ProductCode`,`Activity`,`StartDate`,`EndDate`,`CPDStream`,`Points`,`isActive` FROM `cpdactivities` WHERE `CPDActivityID`='".$data['CPD_Id']."'";
  
  // echo $select;die;
  $data['records'] = $this->db->query($select)->result();
  $data['page_title'] = "CPD Types";
  $data['main_content'] = $this->load->view("cpd_types/cpd_types_update",$data,TRUE);
  $this->load->view('admin/index', $data);
}
public function get_udpate($CPDID){

  $activity = $this->input->post('activity');
  $start_date = $this->input->post('start_date');
  $end_date = $this->input->post('end_date');
  $cpdPoints = $this->input->post('cpdpoints');
  $productCode = $this->input->post('product_code');
  $CPDStream = $this->input->post('CPDstreams');
  $checked = $this->input->post('ContentPlaceHolder1isActive');
  /////////////////// QR CODE 

  $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/auditit_new/auditit/qrcodes/images/';
  $text = $productCode;
  $text1= substr($text, 0,9);
  $folder = $SERVERFILEPATH;
  $file_name1 = $text1."-Qrcode".rand(2,200).".png";
  $file_name = $folder.$file_name1;
  QRcode::png($text,$file_name);
  $baseURL = base_url();
  $qr_code = $file_name1;

  if(isset($checked)==1){
    $check_val = '1';
  }else{
    $check_val = '0';
  }
  $str_start_date = strtotime($start_date);
  $str_end_date = strtotime($end_date);
  $db_date_start = date("Y-m-d",$str_start_date);
  $db_date_end = date("Y-m-d",$str_end_date);
  $data = array('Activity' => $activity,'StartDate' => $db_date_start,'EndDate' => $db_date_end,'Points' => $cpdPoints,'ProductCode' => $productCode,'CPDStream' => $CPDStream,'isActive' => $check_val,'isApproved' => '0','isRejected' => '0','QRCode' => $qr_code );
  $this->Cpd_points_model->update($data,$CPDID);
  $this->session->set_flashdata('CPD_update_sucess','CPD Types Updated Sucessfully');
  redirect('cpd_points/view');

}

public function get_ajaxpagination_view_active(){
        // POST data
  $postData = $this->input->post();
     // Get data
  $data = $this->Cpd_points_model->getAssessment_ajax_active($postData);

  echo json_encode($data);
}
public function get_ajaxpagination_view_archive(){
       // POST data
 $postData = $this->input->post();
     // Get data
 $data = $this->Cpd_points_model->getAssessment_ajax_archive($postData);

 echo json_encode($data);
}
////
public function get_ajax_PDF($cpdId){

  $select_query = "SELECT `Activity`,`ProductCode`,`Points`,`StartDate`,`EndDate`,`CPDStream`,`QRCode` FROM `cpdactivities` WHERE `CPDActivityID`='".$cpdId."'";
  $records = $this->db->query($select_query)->result();
  $img_url = base_url()."qrcodes/images/";
  $img = rawurlencode($records[0]->QRCode);
  $QR = "<img width='500' height='500' src=".$img_url.$img.">";
  //echo $QR;
  $start_date1 = strtotime($records[0]->StartDate);
  $end_date1 = strtotime($records[0]->EndDate);
  $start_date = date('m/d/Y',$start_date1);
  $end_date = date('m/d/Y',$end_date1);
  // echo $start_date;
  //   echo $end_date;
  // die;
  // $html = '<center>CPD Acvity</center><br>
  // Acvity:          '.$records[0]->Activity.'<br>
  // Code:            '.$records[0]->ProductCode.'<br>
  // Point Allocated: '.$records[0]->Points.'<br>
  // Start Date:      '.$start_date.'<br>
  // End Date:        '.$end_date.'<br>
  // CPD Stream:      '.$records[0]->CPDStream.'<br><br>
  // QR Code:  <br>
  // '.$QR.'';
//   $tiii = '
//   <html>
//       <style type="text/css">
        
// @font-face {
//   font-family: "Poppins";
//   font-style: normal;
//   font-weight: 400;
//   src: url("../fonts/poppins-v9-latin-regular.eot");
//   src: local("Poppins Regular"), local("Poppins-Regular"),
//        url("../fonts/poppins-v9-latin-regular.eot?#iefix") format("embedded-opentype"),
//        url("../fonts/poppins-v9-latin-regular.woff2") format("woff2"),
//        url("../fonts/poppins-v9-latin-regular.woff") format("woff"),
//        url("../fonts/poppins-v9-latin-regular.ttf") format("truetype"),
//        url("../fonts/poppins-v9-latin-regular.svg#Poppins") format("svg");
// }      
//         body{
//             font-family: "Poppins";            
//         }
//     </style>
//   <body>
//   <h2>CPD Activity</h2>
//   </body>
//   </html>';

  $html = '
  <h2 style="text-align:center; margin-bottom:50px;font-family:Poppins;font-weight:bold">CPD Activity</h2>
  <table>
  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  Activity:
  </td>
 
  <td class="col-md-6">
  '.$records[0]->Activity.'
  </td>
  </tr>

  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  Code:
  </td>
  &nbsp;
  <td class="col-md-6">
  '.$records[0]->ProductCode.'
  </td>
  </tr>

  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  Point Allocated:
  </td>
  &nbsp;
  <td class="col-md-6">
  '.$records[0]->Points.'
  </td>
  </tr>

  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  Start Date:
  </td>
  &nbsp;
  <td class="col-md-6">
  '.$start_date.'
  </td>
  </tr>

  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  End Date:
  </td>
  &nbsp;
  <td class="col-md-6">
  '.$end_date.'
  </td>
  </tr>

  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  CPD Stream:
  </td>
  &nbsp;
  <td class="col-md-6">
  '.$records[0]->CPDStream.'
  </td>
  </tr>

  <tr class="col-md-12" style="text-align:left;">
  <td class="col-md-6" style="font-weight:bold">
  QR Code:
  </td>
  </tr>
  <tr>
  <td>
  '.$QR.'
  </td>
  </tr>
  </table>';

  $pdfFilePath = "output_pdf_name.pdf";
  $this->pdf->loadHtml($html);
  $this->pdf->setPaper('A4', 'portrait');
  $this->pdf->render();
  $this->pdf->stream($pdfFilePath);  
}
public function addToArchive($cpdID_id){
  $update_query = "UPDATE `cpdactivities` SET `isActive`='0' WHERE `CPDActivityID`='".$cpdID_id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Archive_cpd','CPD Type Added To Archive sucessfully');
  redirect('cpd_points/view');
}
public function addToActive($cpdID_id){
  $update_query = "UPDATE `cpdactivities` SET `isActive`='1' WHERE `CPDActivityIDCPDActivityID`='".$cpdID_id."'";
  $query = $this->db->query($update_query);
  $this->session->set_flashdata('Active_cpd','CPD Type Added To Active sucessfully');
  redirect('cpd_points/view');
}
public function deleteisntallation($cpdID_id){
  $delete_query = "DELETE FROM `cpdactivities` WHERE `CPDActivityID`='".$cpdID_id."'";
  $query = $this->db->query($delete_query);
  $this->session->set_flashdata('delete_cpd','CPD Type Deleted sucessfully');
  redirect('cpd_points/view');
}

}

