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
		$fileName = 'http://diyesh.com/auditit_new/pirb/cronfile/performancestatusarchive';
		$starttime = date('Y-m-d H:i:s');

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
      $endtime = date('Y-m-d H:i:s');
		if ($starttime && $endtime) {
			$cron_start = $this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
      	
    }
	
	
    public function performancestatusarchive()
	{
		$fileName = 'http://diyesh.com/auditit_new/pirb/cronfile/performancestatusarchive';
		$starttime = date('Y-m-d H:i:s');

		$this->performancestatusrollingaverage();

		$endtime = date('Y-m-d H:i:s');
		if ($starttime && $endtime) {
			$cron_start = $this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}
	
    public function performancestatuswarning()
	{
		$fileName = 'http://diyesh.com/auditit_new/pirb/cronfile/performancestatuswarning';
		$starttime = date('Y-m-d H:i:s');

		$this->performancestatusmail();

		$endtime = date('Y-m-d H:i:s');
		if ($starttime && $endtime) {
			$cron_start = $this->cronLog(['filename' => $fileName, 'start_time' => $starttime, 'end_time' => $endtime]);
		}
	}
}

	
  
