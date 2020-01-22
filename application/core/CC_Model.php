<?php

class CC_Model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function sentMail($to, $subject, $message)
	{
		$sitename	=	$this->config->item('sitename');
		
		$this->load->library('email');
		
		$config['mailtype'] 	= 'html';
		$config['protocol'] 	= 'sendmail';
		$config['mailpath'] 	= '/usr/sbin/sendmail';
		$config['charset'] 		= 'iso-8859-1';
		$config['wordwrap'] 	= TRUE;

		$this->email->initialize($config);
		$this->email->from('icomeagain@gmail.com', $sitename);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);


		if($this->email->send()){
			return 'true';
		}else{
			//print_r($this->email->print_debugger());
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
			//return $this->upload->display_errors();
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
			$result = $this->db->select('*')->from('users')->where('u_id', $userid)->where_in('u_status', ['1'])->get()->row_array();
			
			if($result){
				return $result['u_id'];
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
}
