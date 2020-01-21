<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //  check_login_user();
    }

    public function index(){
        $data = array();
        $data['page_title'] = 'Calender';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	 public function form_basic(){
        $data = array();
        $data['page_title'] = 'Basic Form';
        $data['main_content'] = $this->load->view('admin/form/form_basic', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function form_layout(){
        $data = array();
        $data['page_title'] = 'Form Layout';
        $data['main_content'] = $this->load->view('admin/form/form_layout', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_addon(){
        $data = array();
        $data['page_title'] = 'Form Addon';
        $data['main_content'] = $this->load->view('admin/form/form_addon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_material(){
        $data = array();
        $data['page_title'] = 'Form Material';
        $data['main_content'] = $this->load->view('admin/form/form_material', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_float(){
        $data = array();
        $data['page_title'] = 'Form Float';
        $data['main_content'] = $this->load->view('admin/form/form_float', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	 public function file_upload(){
        $data = array();
        $data['page_title'] = 'Form Upload';
        $data['main_content'] = $this->load->view('admin/form/file_upload', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_mask(){
        $data = array();
        $data['page_title'] = 'Form Mask';
        $data['main_content'] = $this->load->view('admin/form/form_mask', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_cropping(){
        $data = array();
        $data['page_title'] = 'Form Cropping';
        $data['main_content'] = $this->load->view('admin/form/form_cropping', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_validation(){
        $data = array();
        $data['page_title'] = 'Form Validation';
        $data['main_content'] = $this->load->view('admin/form/form_validation', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

 public function form_dropzone(){
        $data = array();
        $data['page_title'] = 'Form Dropzone';
        $data['main_content'] = $this->load->view('admin/form/form_dropzone', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_picker(){
        $data = array();
        $data['page_title'] = 'Form Picker';
        $data['main_content'] = $this->load->view('admin/form/form_picker', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_icheck(){
        $data = array();
        $data['page_title'] = 'Form Icheck';
        $data['main_content'] = $this->load->view('admin/form/form_icheck', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_wizard(){
        $data = array();
        $data['page_title'] = 'Form Wizard';
        $data['main_content'] = $this->load->view('admin/form/form_wizard', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

 public function form_typehead(){
        $data = array();
        $data['page_title'] = 'Form Typehead';
        $data['main_content'] = $this->load->view('admin/form/form_typehead', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_editable(){
        $data = array();
        $data['page_title'] = 'Form Editable';
        $data['main_content'] = $this->load->view('admin/form/form_editable', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_summernote(){
        $data = array();
        $data['page_title'] = 'Form Summernote';
        $data['main_content'] = $this->load->view('admin/form/form_summernote', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_wysihtml5(){
        $data = array();
        $data['page_title'] = 'Form Wysihtml5';
        $data['main_content'] = $this->load->view('admin/form/form_wysihtml5', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	public function form_tinymyce(){
        $data = array();
        $data['page_title'] = 'Form Tinymyce';
        $data['main_content'] = $this->load->view('admin/form/form_tinymyce', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



}