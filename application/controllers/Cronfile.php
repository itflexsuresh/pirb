<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Cronfile extends CC_Controller {
  
public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Cron_Model');
		$this->load->model('Plumber_Model');
	}


    public function index()
	{
		
	    $data=$this->Cron_Model->display_records();


       foreach ($data as $key => $value) {

                   $id        =$value->id; 
                  if($value->futuredate != '' and !empty($value->futuredate))
                  {
                        $current_date = strtotime(date('Y-m-d'));
                         $futuredate=strtotime($value->futuredate);

                        if($current_date == $futuredate)
                         	$this->Cron_Model->updaterecords($id,$value->futuredate,$value->futureammount);
                         		
                  
                  }
                   	
      }
      	
    }
	
	
    public function performancestatusarchive()
	{
		$this->performancestatusrollingaverage();
	}
	
    public function performancestatuswarning()
	{
		$this->performancestatusmail();
	}
}

	
  
