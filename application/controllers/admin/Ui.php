<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //	check_login_user();
    }
    
    public function index(){
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function tabs(){
        $data = array();
        $data['page_title'] = 'Tabs';
        $data['main_content'] = $this->load->view('admin/ui/tabs', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function stylish(){
        $data = array();
        $data['page_title'] = 'Stylish';
        $data['main_content'] = $this->load->view('admin/ui/stylish', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function modals(){
        $data = array();
        $data['page_title'] = 'Modals';
        $data['main_content'] = $this->load->view('admin/ui/modals', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function progressbar(){
        $data = array();
        $data['page_title'] = 'Progressbar';
        $data['main_content'] = $this->load->view('admin/ui/progressbar', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function notification(){
        $data = array();
        $data['page_title'] = 'Notification';
        $data['main_content'] = $this->load->view('admin/ui/notification', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function carousel(){
        $data = array();
        $data['page_title'] = 'Carousel';
        $data['main_content'] = $this->load->view('admin/ui/carousel', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function list_media(){
        $data = array();
        $data['page_title'] = 'List Media';
        $data['main_content'] = $this->load->view('admin/ui/list_media', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function user_card(){
        $data = array();
        $data['page_title'] = 'User Card';
        $data['main_content'] = $this->load->view('admin/ui/user_card', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function timeline(){
        $data = array();
        $data['page_title'] = 'Timeline';
        $data['main_content'] = $this->load->view('admin/ui/timeline', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function horizontal_timeline(){
        $data = array();
        $data['page_title'] = 'Horizontal Timeline';
        $data['main_content'] = $this->load->view('admin/ui/horizontal_timeline', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function nestable(){
        $data = array();
        $data['page_title'] = 'Nestable';
        $data['main_content'] = $this->load->view('admin/ui/nestable', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function range_slider(){
        $data = array();
        $data['page_title'] = 'Range Slider';
        $data['main_content'] = $this->load->view('admin/ui/range_slider', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function ribbon(){
        $data = array();
        $data['page_title'] = 'Ribbon';
        $data['main_content'] = $this->load->view('admin/ui/ribbon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function steps(){
        $data = array();
        $data['page_title'] = 'Steps';
        $data['main_content'] = $this->load->view('admin/ui/steps', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function session_idle_timeout(){
        $data = array();
        $data['page_title'] = 'Session Idle Timeout';
        $data['main_content'] = $this->load->view('admin/ui/session_idle_timeout', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function session_timeout(){
        $data = array();
        $data['page_title'] = 'Session Timeout';
        $data['main_content'] = $this->load->view('admin/ui/session_timeout', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function stylish_tooltip(){
        $data = array();
        $data['page_title'] = 'Stylish Tooltip';
        $data['main_content'] = $this->load->view('admin/ui/stylish_tooltip', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function bootstrap(){
        $data = array();
        $data['page_title'] = 'Bootstrap';
        $data['main_content'] = $this->load->view('admin/ui/bootstrap', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	
	
	 public function grid(){
        $data = array();
        $data['page_title'] = 'Grid';
        $data['main_content'] = $this->load->view('admin/ui/grid', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function typography(){
        $data = array();
        $data['page_title'] = 'Typography';
        $data['main_content'] = $this->load->view('admin/ui/typography', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function sweet_alert(){
        $data = array();
        $data['page_title'] = 'Sweet Alert';
        $data['main_content'] = $this->load->view('admin/ui/sweet_alert', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function date_pagination(){
        $data = array();
        $data['page_title'] = 'Date Pagination';
        $data['main_content'] = $this->load->view('admin/ui/date_pagination', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function bootsrap_switch(){
        $data = array();
        $data['page_title'] = 'Bootsrap Switch';
        $data['main_content'] = $this->load->view('admin/ui/bootsrap_switch', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function buttons(){
        $data = array();
        $data['page_title'] = 'Buttons';
        $data['main_content'] = $this->load->view('admin/ui/buttons', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function dragPortlet(){
        $data = array();
        $data['page_title'] = 'Drag Portlet';
        $data['main_content'] = $this->load->view('admin/ui/dragPortlet', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function drag_panel(){
        $data = array();
        $data['page_title'] = 'Drag Panel';
        $data['main_content'] = $this->load->view('admin/ui/drag_panel', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function panel_block(){
        $data = array();
        $data['page_title'] = 'Panel Block';
        $data['main_content'] = $this->load->view('admin/ui/panel_block', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function panel_well(){
        $data = array();
        $data['page_title'] = 'Panel Well';
        $data['main_content'] = $this->load->view('admin/ui/panel_well', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function card(){
        $data = array();
        $data['page_title'] = 'Card';
        $data['main_content'] = $this->load->view('admin/ui/card', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    


}