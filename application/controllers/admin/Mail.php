<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user(); 
    }
    
    public function index(){
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function inbox(){
        $data = array();
        $data['page_title'] = 'inbox';
        $data['main_content'] = $this->load->view('admin/mail/inbox', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function inbox_details(){
        $data = array();
        $data['page_title'] = 'inbox Details';
        $data['main_content'] = $this->load->view('admin/mail/inbox_details', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function compose_message(){
        $data = array();
        $data['page_title'] = 'Compose Message';
        $data['main_content'] = $this->load->view('admin/mail/compose_message', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


}