<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalperformance extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_performance_Model');
	}
		
	public function index($id='')
	{		
		$permission_list = $this->Global_performance_Model->getPermissions(); 
        $fotmatted_list = array();
        for($k=0;$k<count($permission_list);$k++) 
        {
	        $fotmatted_list[$permission_list[$k]->deg_name][$k]['id'] = $permission_list[$k]->id;
	        
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['description'] = $permission_list[$k]->description;
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['point'] = $permission_list[$k]->point;
         	$fotmatted_list[$permission_list[$k]->deg_name][$k]['wording'] = $permission_list[$k]->wording;
        }
		$pagedata['permission_list'] = $fotmatted_list;	


		$permission_list1 = $this->Global_performance_Model->getPermissions1(); 
        $fotmatted_list1 = array();
        for($k1=0;$k1<count($permission_list1);$k1++) 
        {
	        $fotmatted_list1[$permission_list1[$k1]->gps_n][$k1]['id'] = $permission_list1[$k1]->id;
	        
         	$fotmatted_list1[$permission_list1[$k1]->gps_n][$k1]['warning'] = $permission_list1[$k1]->warning;
         	$fotmatted_list1[$permission_list1[$k1]->gps_n][$k1]['point'] = $permission_list1[$k1]->point;
         	$fotmatted_list1[$permission_list1[$k1]->gps_n][$k1]['status'] = $permission_list1[$k1]->status;
        }
		$pagedata['permission_list1'] = $fotmatted_list1;	

		$pagedata['notification'] 			= $this->getNotification();
		$data['plugins']					= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
		$data['content'] 					= $this->load->view('admin/systemsetup/performancesettings/globalperfomance', (isset($pagedata) ? $pagedata : ''), true);

		$this->layout2($data);
       
	}
	
}




