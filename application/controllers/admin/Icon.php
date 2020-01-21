<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Icon extends CI_Controller {

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

    public function font_awesome(){
        $data = array();
        $data['page_title'] = 'Font Awesome';
        $data['main_content'] = $this->load->view('admin/icon/font_awesome', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function themifyIcon(){
        $data = array();
        $data['page_title'] = 'Themify Icon';
        $data['main_content'] = $this->load->view('admin/icon/themifyIcon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function simpleLineIcon(){
        $data = array();
        $data['page_title'] = 'Simple Line';
        $data['main_content'] = $this->load->view('admin/icon/simpleLineIcon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	 public function lineIcon(){
        $data = array();
        $data['page_title'] = 'Line Icon';
        $data['main_content'] = $this->load->view('admin/icon/lineIcon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function weatherIcon(){
        $data = array();
        $data['page_title'] = 'Weather Icon';
        $data['main_content'] = $this->load->view('admin/icon/weatherIcon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


}