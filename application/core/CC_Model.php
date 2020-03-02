<?php

class CC_Model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function sentMail($to, $subject, $message, $file='')
	{
		$sitename	=	$this->config->item('sitename');
		
		$this->load->library('email');
		
		$config['protocol']    	= 'mail';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_user']    = 'norwin.kairo5@gmail.com';
        $config['smtp_pass']    = 'jedczpvjwxdyhqlo';
		$config['mailtype'] 	= 'html';
		$config['charset'] 		= 'iso-8859-1';
		$config['newline']      = '\r\n';
		$config['wordwrap'] 	= TRUE;

		$this->email->initialize($config);
		$this->email->from('pirb@gmail.com', $sitename);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		
		if($file!="") $this->email->attach($file);


		if($this->email->send()){
			$this->email->clear(true);
			return 'true';
		}else{
			//print_r($this->email->print_debugger());die;
			$this->email->clear(true);
			return 'false';
		}
	}
	
	public function sentMail2($to, $subject, $message)
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <pirb@gmail.com>' . "\r\n";
		
		if(mail($to,$subject,$message,$headers)){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	public function fileUpload($file, $path, $type='')
	{
		$this->createDirectory($path);
		
		$config['upload_path']          = $path;
		$config['allowed_types']        = ($type=='') ? 'jpeg|jpg|png' : $type;
		$config['remove_spaces'] 		= true;
		$config['encrypt_name'] 		= true;

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload($file))
		{
			return $this->upload->display_errors();
			return '';
		}
		else
		{
			return $this->upload->data();
		}
	}
	
	public function createDirectory($path)
	{
		$location = explode('/', $path);
		for($i=0; $i<count($location); $i++)
		{
			if($location[$i]!='.'){
				$dir = implode('/', array_slice($location, 0, $i+1));
				if(!is_dir($dir))
				{
					$mask = umask(0);
					mkdir($dir, 0755);
					umask($mask);
				}
			}
		}
	}
	
	public function getUserID()
	{
		if($this->session->has_userdata('userid')){
			$userid = $this->session->userdata('userid');			
			$result = $this->db->select('*')->from('users')->where('id', $userid)->where_in('status', ['0', '1'])->get()->row_array();
			
			if($result){
				return $result['id'];
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	
	public function diaryactivity($data)
	{
		$this->db->trans_begin();
		
		$datetime		= 	date('Y-m-d H:i:s');
		
		$request		=	[
			'datetime' 		=> $datetime
		];
		
		if(isset($data['adminid'])) 	$request['admin_id'] 	= $data['adminid'];
		if(isset($data['plumberid'])) 	$request['plumber_id'] 	= $data['plumberid'];
		if(isset($data['companyid'])) 	$request['company_id'] 	= $data['companyid'];
		if(isset($data['auditorid'])) 	$request['auditor_id'] 	= $data['auditorid'];
		if(isset($data['cocid'])) 		$request['coc_id'] 		= $data['cocid'];
		if(isset($data['action'])) 		$request['action']	 	= $data['action'];
		if(isset($data['type'])) 		$request['type']	 	= $data['type'];
		
		$this->db->insert('diary', $request);
		
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
}
