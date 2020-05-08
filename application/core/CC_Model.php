<?php

class CC_Model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function sentMail($to, $subject, $message, $file='')
	{
		$settings 	= 	$this->db->get('settings_details')->row_array();
		$sitename	=	$this->config->item('sitename');
		
		$this->load->library('email');
		
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] 	= 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		/*
		$config['protocol']    	= 'mail';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_user']    = 'norwin.kairo5@gmail.com';
        $config['smtp_pass']    = 'jedczpvjwxdyhqlo';
		$config['mailtype'] 	= 'html';
		$config['charset'] 		= 'iso-8859-1';
		$config['newline']      = '\r\n';
		$config['wordwrap'] 	= TRUE;
		*/
		
		$this->email->initialize($config);
		$this->email->from($settings['system_email'], $sitename);
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
		$settings 	= 	$this->db->get('settings_details')->row_array();
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$settings['system_email'].'>' . "\r\n";
		
		if(mail($to,$subject,$message,$headers)){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	public function sentMail3()
	{
		$to 		= "itflexsolutions@pirb.co.za";
		$subject 	= "subject";
		$message 	= "message";
		
		if(mail($to,$subject,$message)){
			echo 'true';
		}else{
			echo 'false';
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
			$data = $this->upload->data();
			if(in_array($data['image_type'], array('png','jpeg','jpg'))){
				//$this->fileResize($data['file_name'], $path);
				$path = rtrim($path, '/').'/';
				$this->fileResizeCore($path.$data['file_name'], $path.$data['file_name'], 80);
			}
			return $data;
		}
	}
	
	public function fileResizeCore($source, $destination, $quality)
	{
		$info = getimagesize($source);
		if ($info['mime'] == 'image/jpeg') 		$image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') 	$image = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png') 	$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);
	}
	
	public function fileResize($file, $path)
	{
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= $path.$file;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= FALSE;
		$config['quality'] 			= 10;

		$this->load->library('image_lib', $config);
		
		if(!$this->image_lib->resize()){
			//echo $this->image_lib->display_errors();
			return '';
		}

		$this->image_lib->clear();
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
		if(isset($data['actionid'])) 	$request['action_id']	= $data['actionid'];
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
	
	public function cocreport($id, $title, $extras=[])
	{		
		$pagedata['settings']	= $this->Systemsettings_Model->getList('row');
		$pagedata['currency']   = $this->config->item('currency');
		$pagedata['rowData'] 	= $this->Coc_Model->getListPDF('row', ['id' => $id, 'status' => ['0','1']]);
		$pagedata['rowData1'] 	= $this->Coc_Model->getPermissions('row', ['id' => $id, 'status' => ['0','1']]);
		$pagedata['rowData2'] 	= $this->Coc_Model->getPermissions1('row', ['id' => $id, 'status' => ['0','1']]);
		$pagedata['title'] 		= $title;
		$pagedata['extras'] 	= $extras;
		
		$html 			= $this->load->view('pdf/coc', (isset($pagedata) ? $pagedata : ''), true);						  
		$pdfFilePath 	= $id.'.pdf';
		$filePath 		= FCPATH.'assets/inv_pdf/';
		
		if(file_exists($filePath.$pdfFilePath)) unlink($filePath.$pdfFilePath);  
			
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		$output = $this->pdf->output();
		file_put_contents($filePath.$pdfFilePath, $output);
		
		return $filePath.$pdfFilePath;
	}
	
	function base64conversion($path){
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		return 'data:image/' . $type . ';base64,' . base64_encode($data);
	}
	
	
	function currencyconvertor($currency){
		$amount 	= number_format(floor($currency*100)/100, 2,".","");
		$lastchr	= $amount[strlen($amount)-1];
		
		if($lastchr < 5){
			$amount[strlen($amount)-1] = '0';
		}else{
			$amount[strlen($amount)-1] = '5';
		}
		
		return $amount;
	}
}
