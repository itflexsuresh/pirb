<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

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

    public function payment_invoice(){
        $data = array();
        $data['page_title'] = 'Payment Invoice';
        $data['main_content'] = $this->load->view('admin/payment/payment_invoice', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function all_payments(){
        $data = array();
        $data['page_title'] = 'All Payments';
        $data['main_content'] = $this->load->view('admin/payment/all_payments', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function create_payment(){
        $data = array();
        $data['page_title'] = 'New payment';
        $data['main_content'] = $this->load->view('admin/payment/create_payment', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


}