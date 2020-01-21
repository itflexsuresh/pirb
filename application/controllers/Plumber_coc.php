<?php

class plumber_coc extends CI_Controller { 

  public function __construct() {
   parent::__construct();
   $this->load->model('plumbercoc_model');
 }

 public function index() { 
   /* Load form helper */ 
   $this->load->helper(array('form'));
   $this->load->database();
   /* Load form validation library */ 
   $this->load->view('plumber_coc/coc_plumber');

}

 public function pur_coc()
 {
      
  //$data['non_all'] = $this->purchase_model->non_allocate();

        $subtype_data_id = $this->uri->segment('3');        
        $query9 = $this->db->get_where("users",array("UserID"=>$subtype_data_id));         
        $data['dataaa'] = $query9->result();

           
  // $this->db->select('NoCOCpurchases');
  // //$query2 = $this->db->get_where();
  // // $this->db->join('companies AS t2', 't2.CompanyName = t1.fname');
  // // $this->db->where("CompanyID", $id );
  // $this->db->where("UserID", $id );
  // $query = $this->db->get('users AS t1');
  // $data['res'] = $query->row_array();


  $query1 = $this->db->query("SELECT NoCOCpurchases FROM users");
  $data['res'] = $query1->row_array();
  
  $query4 = $this->db->query("SELECT PlumberMaxNonLoggedCertificates FROM settings");
  $data['set_plum'] = $query4->row_array();

  if ($data['res']['NoCOCpurchases'] > $data['set_plum']['PlumberMaxNonLoggedCertificates']) 
  { 
    $data['res12'] = $data['res']['NoCOCpurchases'];  
  }

  elseif ($data['res']['NoCOCpurchases'] < $data['set_plum']['PlumberMaxNonLoggedCertificates']) 
  { 
    $data['res12'] = $data['set_plum']['PlumberMaxNonLoggedCertificates'];
  }

  elseif ($data['res']['NoCOCpurchases'] == $data['set_plum']['PlumberMaxNonLoggedCertificates']) 
  { 
    $data['res12'] = $data['res']['NoCOCpurchases'];
  }

// print_r($data['final_tot']);
// data['res12']exit;


    // $query7 = $this->db->query("SELECT * FROM `users` WHERE role = 2 and `UserID` = $id");
    // //$this->db->where("CompId", $id);
    // $data['sel_plum'] = $query7->result();
    
  
    $query2 = $this->db->query("SELECT count(UserID) AS num_of_time FROM cocstatements");
    //$this->db->where("CompId", $id);
    $data['non_all'] = $query2->row_array();
    
    $first = $data['non_all']['num_of_time'];


    $second = $data['res12'];
    $data['total'] = $second - $first; 

      $query3 = $this->db->query("SELECT Amount FROM rates WHERE ID IN(8,7)");

      // $this->db->where("ID", $id);
      // print_r($query3);
      // exit;
      $data['amou'] = $query3->result_array();
      //$data['amou'] = $query3->result_array();


      $query8 = $this->db->query("SELECT SupplyItem, Amount FROM rates WHERE ID IN(4,5,6)");
      $data['meth'] = $query8->result_array();
      // echo '<pre>';
      // print_r($data['meth']);
      // echo '</pre>';
      // exit;

      $query9 = $this->db->query("SELECT VatPercentage FROM settings");
      $data['vat_cal'] = $query9->result();
      
      // $this->db->select('Amount, SupplyItem');
      // $this->db->where("ID", $id);
      // $query8 = $this->db->get('rates AS t1');
      // $data['ress1'] = $query8->result_array();
      



      if (!empty($_POST)) {

            $data5 = array (

						//'' => $this->input->post('non_loggedcoc'),
						// '' => $this->input->post('total'),
						//'' => $this->input->post('permitted'),
						'COCType' => $this->input->post('rad'),
						'TotalNoItems' => $this->input->post('no_coc'),
            'Method' => $this->input->post('method_delivery'),
						'SubTotal' => $this->input->post('cost'),						
						'Delivery' => $this->input->post('delivery'),
						'Vat' => $this->input->post('vat'),
						'Total' => $this->input->post('due'));


      //       if ($permitted >= $no_coc)
      // {
      //   $this->form_validation->set_message('check_equal_less', 'The First &amp;/or Second fields have errors.');
      //   return false;       
      // }

            		$ins = $this->plumbercoc_model->form_insert($data5);

                $this->session->set_flashdata('success','COC Purchased Sucessfully'); 
                //redirect('purchase_coc/pur_coc');
          }


$rndno=rand(10001, 99999);
$num='8883562173';
//$message = urlencode("OTP number.".$rndno);

$url="http://www.mymobileapi.com/api5/http5.aspx?Type=sendparam&username=PIRB%20Registration&password=Plumber&numto=+91996207&data1=$rndno,$num";
/* init the resource*/
//$url="http://login.smsgatewayhub.com/smsapi/pushsms.aspx?user=test&to=918883562173&sid=senderid&msg=$message";


$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => ''
));
/*,CURLOPT_FOLLOWLOCATION => true));*/
/*Ignore SSL certificate verification*/
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
/*get response*/
$output = curl_exec($ch);

/*Print error if any*/
if(curl_errno($ch))
{
echo 'error:' . curl_error($ch);
}
curl_close($ch);

				if (isset($_POST['purchase'])) {                  
               
                $data = array(


                'SMSMessage ' => $rndno);

                 
               $this->plumbercoc_model->insert_form($data);
               
               
           }
         
				    $data['page_title'] = "Purchase COC";
				  
         
				    $data['main_content'] = $this->load->view("plumber_coc/coc_plumber", $data, TRUE);
				  	$this->load->view('admin/index', $data);

			
				

}



}

?>




