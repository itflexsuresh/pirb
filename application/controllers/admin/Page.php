<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller { 

    public function __construct(){
        parent::__construct();
        //  check_login_user();
    }
    
    public function index(){
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function starter(){
        $data = array();
        $data['page_title'] = 'Starter';
        $data['main_content'] = $this->load->view('admin/page/starter', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function blank(){
        $data = array();
        $data['page_title'] = 'Blank';
        $data['main_content'] = $this->load->view('admin/page/blank', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function email_basic(){
        $data = array();
        $data['page_title'] = 'Email Basic';
        $data['main_content'] = $this->load->view('admin/page/email_basic', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function email_alert(){
        $data = array();
        $data['page_title'] = 'Email Alert';
        $data['main_content'] = $this->load->view('admin/page/email_alert', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function email_billing(){
        $data = array();
        $data['page_title'] = 'Email Billing';
        $data['main_content'] = $this->load->view('admin/page/email_billing', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function reset_password(){
        $data = array();
        $data['page_title'] = 'Reset Password';
        $data['main_content'] = $this->load->view('admin/page/reset_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function lightBox(){
        $data = array();
        $data['page_title'] = 'LightBox';
        $data['main_content'] = $this->load->view('admin/page/lightBox', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function treeview(){
        $data = array();
        $data['page_title'] = 'Treeview';
        $data['main_content'] = $this->load->view('admin/page/treeview', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function search_result(){
        $data = array();
        $data['page_title'] = 'Search Result';
        $data['main_content'] = $this->load->view('admin/page/search_result', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function utility_class(){
        $data = array();
        $data['page_title'] = 'Utility Class';
        $data['main_content'] = $this->load->view('admin/page/utility_class', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function login_page(){
        $data = array();
        $data['page_title'] = 'Login Page';
        $data['main_content'] = $this->load->view('admin/page/login_page', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function second_login(){
        $data = array();
        $data['page_title'] = 'Second Login';
        $data['main_content'] = $this->load->view('admin/page/second_login', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function animation(){
        $data = array();
        $data['page_title'] = 'Animation';
        $data['main_content'] = $this->load->view('admin/page/animation', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function profile(){
        $data = array();
        $data['page_title'] = 'Profile';
        $data['main_content'] = $this->load->view('admin/page/profile', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function invoice(){
        $data = array();
        $data['page_title'] = 'Invoice';
        $data['main_content'] = $this->load->view('admin/page/invoice', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function faq(){
        $data = array();
        $data['page_title'] = 'Faq';
        $data['main_content'] = $this->load->view('admin/page/faq', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function gallery(){
        $data = array();
        $data['page_title'] = 'Gallery';
        $data['main_content'] = $this->load->view('admin/page/gallery', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function pricing(){
        $data = array();
        $data['page_title'] = 'Pricing';
        $data['main_content'] = $this->load->view('admin/page/pricing', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	
	
	 public function register(){
        $data = array();
        $data['page_title'] = 'Register';
        $data['main_content'] = $this->load->view('admin/page/register', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function second_register(){
        $data = array();
        $data['page_title'] = 'Second Register';
        $data['main_content'] = $this->load->view('admin/page/second_register', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function step_registration(){
        $data = array();
        $data['page_title'] = 'Step Registration';
        $data['main_content'] = $this->load->view('admin/page/step_registration', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function recover_password(){
        $data = array();
        $data['page_title'] = 'Recover Password';
        $data['main_content'] = $this->load->view('admin/page/recover_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function lock_screen(){
        $data = array();
        $data['page_title'] = 'Lock Screen';
        $data['main_content'] = $this->load->view('admin/page/lock_screen', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	  public function custom_scroll(){
        $data = array();
        $data['page_title'] = 'Custom Scroll';
        $data['main_content'] = $this->load->view('admin/page/custom_scroll', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function error_400(){
        $data = array();
        $data['page_title'] = 'Error 400';
        $data['main_content'] = $this->load->view('admin/page/error_400', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function error_403(){
        $data = array();
        $data['page_title'] = 'Error 403';
        $data['main_content'] = $this->load->view('admin/page/error_403', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function error_404(){
        $data = array();
        $data['page_title'] = 'Error 404';
        $data['main_content'] = $this->load->view('admin/page/error_404', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function error_500(){
        $data = array();
        $data['page_title'] = 'Error 500';
        $data['main_content'] = $this->load->view('admin/page/error_500', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function error_503(){
        $data = array();
        $data['page_title'] = 'Error 503';
        $data['main_content'] = $this->load->view('admin/page/error_503', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

}