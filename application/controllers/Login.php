<?php 

class Login extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
          //	$this->load->library(array('form_validation', 'session', 'email', 'pagination'));
      $this->load->model(array('Login_model'));        
      $this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
         $this->load->database(); 

      } 
  
      public function index() { 
         //$this->load->helper('url');
      	$data = array();
      	$data['base_path'] = '../';
      	$err = 0;
      	//$register_rules = array('field' => 'email', 'label' => 'email', 'rules' => 'required');
	  //      $this->form_validation->set_rules('email', 'Email address','is_unique[users.email]',
			//         array(
			//                 'is_unique'     => 'This %s already exists.'
			//         )
			// );
	       //	$this->form_validation->set_rules($form_validate_rules);
   		$form_validate_rules = array(
		        array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
		        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|callback_password_check')
	    	  );
	       	$this->form_validation->set_rules($form_validate_rules);
      	// if ($this->input->post('SignIN'))
      	// {

	     	
		       
	   		
	       	if ($this->form_validation->run() == TRUE)
	       	{
	       		
	         //echo "hii";exit;
	       		$user_data = $this->Login_model->login();
	      	}        
//    	}

    // if ($this->input->post('register'))
    // {
    // 	//	if($this->form_validation->run() == TRUE){
    	
	   //    $this->load->config('email');
	      
	   //    $from = $this->config->item('smtp_user');
	   //    $to = $this->input->post('email');
	   //    $subject = 'Plumber registration Details';
	   //    $message = 'Hi,

	   //    Plumber is registered successfully.

	   //    Your email address is your username.';

	   //    $this->email->set_newline("\r\n");
	   //    $this->email->from($from);
	   //    $this->email->to($to);
	   //    $this->email->subject($subject);
	   //    $this->email->message($message);

	   //    if ($this->email->send()) {
	   //        echo 'Email has been sent successfully';
	   //        $users = array();
	   //        $users['email'] = $to;
	   //        $users['password'] = md5($this->input->post('password'));
	   //        $users['role'] = 2;
	   //        $data['users'] = $users;
	   //        $this->db->insert('users', $data['users']);
	   //    } else {
	   //        show_error($this->email->print_debugger());
	   //    }
    //   	//	}
    // } else {
    // 	//	$this->load->view('login',$data);
    // }
  //  $this->load->helper('url');    
		//	if($err==0){
	    	$this->load->view('login',$data);
	    //	}
         //$this->load->view('Sample_views'); 
      }

       function password_check()
 {
   $rows = $this->Login_model->password_chks();
   if ($rows == 0)
   {
    //exit;
    $this->form_validation->set_message('password_check', 'Invalid Password. Please try again.');
    return false;
  }
  return true;
}

function Forgot_password(){
  $this->load->view('Forgot_password');
}
function Forgot_password_update(){
  //$this->load->view('Forgot_password');
  //load model for updateyion
  //$user_data = $this->Login_model->Forgot_password_update();
}

      function dashboard()
{
 // $this->user_log_out_check();
 // $admin_id = $this->session->userdata('adminId');
 // $data['view_user'] = $this->invoice_model->getTableData('tbl_users')->row();
 // $customer_details = $this->db->query('select * from tbl_customers');
 // $data['customer_count'] = $customer_details->num_rows();
 
 $this->load->view('dashboard');   
}
public function logout()
{
           //destroy all sessions
  $this->session->sess_destroy();
  redirect('Login/index/');
}


   }


?>
    
   