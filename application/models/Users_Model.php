<?php

class Users_Model extends CC_Model
{
	public function login($data)
	{
		$email 		= $data['email'];
		$password 	= md5($data['password']);
		$type 		= $data['type'];

		$query = $this->db->get_where('users', ['email' => $email, 'password' => $password, 'type' => $type, 'status !=' => '2']);
	
		if($query->num_rows() > 0){
			$result = $query->row_array();
			return ['status' => '1', 'result' => $result['id']];
		}else{
			return ['status' => '0', 'result' => ''];
		}
	}
	
	public function forgotPassword($data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where_in('status', ['0', '1']);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result = $query->row_array();
			$mail = $this->forgotPasswordMail($result);
			if($mail=='true') return '1';
			else return '2';
		}else{
			return '3';
		}
	}
	
	public function checkEncryptUserID($id, $requestdata=[])
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		if(isset($requestdata['type']))	$this->db->where_in('type', $requestdata['type']);
		$this->db->where_in('status', ['0', '1']);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return '1';
		}else{
			return '2';
		}
	}
	
	public function resetPassword($data)
	{
		$id 					= 	$data['id'];
		$newpassword 			= 	$data['newpassword'];
		
		$userdata = [	
						'password' 		=> md5($newpassword),
						'password_raw' 	=> $newpassword,
						'updated_at'	=> date('Y-m-d'),
						'updated_by'	=> $id
					];
					
		$result 	= $this->db->update('users', $userdata, ['id' => $id]);
	
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	public function getUserDetails($type, $requestdata=[])
	{
		$this->db->select('u.*,up.designation');
		$this->db->from('users u');
		$this->db->join('users_plumber up', 'u.id=up.user_id', 'left');
		
		if(isset($requestdata['id'])) 		$this->db->where('u.id', $requestdata['id']);
		if(isset($requestdata['type']))		$this->db->where_in('u.type', $requestdata['type']);
		if(isset($requestdata['status']))	$this->db->where_in('u.status', $requestdata['status']);
		
		$query = $this->db->get();
		
		if($type=='all') 		$result = $query->result_array();
		elseif($type=='row') 	$result = $query->row_array();
		
		return $result;
	}
	
	public function actionUsers($data)
	{
		$this->db->trans_begin();
		
		$id 		= 	$data['id'];
		$email 		= 	$data['email'];
		$password 	= 	(isset($data['password']) ? $data['password'] : '');
		$type 		= 	$data['type'];
		$status 	= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$users		=	[
							'email' 		=> $email,
							'type' 			=> $type,
							'status' 		=> $status
						];
		
		if($password!=''){
			$users['password_raw'] 	= $password;
			$users['password'] 		= md5($password);
		}
		
		if($id==''){
			$result 	= $this->db->insert('users', $users);
			$insertid 	= $this->db->insert_id();
		}else{
			$result = $this->db->update('users', $users, ['id' => $id]);
			$insertid 	= $id;
		}
			
		if(!$result || $this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $insertid;
		}
	}
	
	public function verification($id)
	{
		$this->db->trans_begin();
		
		$id 		= 	$id;
		$datetime	= 	date('Y-m-d H:i:s');
		
		$users		=	[
							'mailstatus' 	=> '1'
						];
		
		$result = $this->db->update('users', $users, ['id' => $id]);

		if((!isset($result)) || !$result || $this->db->trans_status() === FALSE)
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
	
	public function changepassword($data, $userid)
	{
		$this->db->trans_begin();
		
		$oldpassword 			= 	$data['oldpassword'];
		$newpassword 			= 	$data['newpassword'];
		$confirmnewpassword 	= 	$data['confirmnewpassword'];
		
		$userdata = $this->getUserDetails('row', ['1'], $userid);
		
		if($userdata){
			if((md5($oldpassword)==$userdata['password']) && ($newpassword==$confirmnewpassword) && ($oldpassword!=$newpassword)){
				$userdata = [	
								'password' 		=> md5($newpassword),
								'password_raw' 	=> $newpassword,
								'updated_at'	=> date('Y-m-d'),
								'updated_by'	=> $userid
							];
				$result 	= $this->db->update('users', $userdata, ['id' => $userid]);
				$message	= '1';
			}elseif($oldpassword==$newpassword){
				$message	= '2';
			}else{
				$message	= '3';
			}
		}else{
			$message = '4';
		}
		
		if((!isset($result)) || !$result || $this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
		
		return $message;
	}
		
	public function emailvalidation($data)
	{
		$id 	= $data['id'];
		$email 	= $data['email'];
		
		$this->db->where('email', $email);
		if(isset($data['type'])) $this->db->where('type', $data['type']);
		if($id!='') $this->db->where('id !=', $id);
		$this->db->where('status !=', '2');
		$query = $this->db->get('users');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
		}
	}
	
	public function forgotPasswordMail($data)
	{
		$sitename		=	$this->config->item('sitename');
		
		if($data['type']!='1'){
			$usertypename	=	$this->config->item('usertype2')[$data['type']];
		}else{
			$usertypename	= '';
		}
		
		$this->load->library('encryption');
		
		$id 		=	$data['id'];
		$email 		= 	$data['email'];
		$link		=	base_url().'forgotpassword/verification/'.$id.'/'.$usertypename;
		
		$subject 	= 	$sitename.' Forgot Password';
		$message	= 	'
							<h4>Hi</h4>
							<p>We got a request to reset your '.$sitename.' Password.</p>
							<p>Below you can find the link to reset your password.</p>
							<a href="'.$link.'">Reset Password</a>
							<p style="margin-top:30px;">Regards</p>
							<p>'.$sitename.'</p>
						';
						
		return $this->sentMail($email, $subject, $message);
	}
}