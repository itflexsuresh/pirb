<?php

class Users_Model extends CC_Model
{
	public function login($data)
	{
		$email 		= $data['email'];
		$password 	= md5($data['password']);

		$query = $this->db->get_where('users', ['u_email' => $email, 'u_password' => $password, 'u_status !=' => '2']);
	
		if($query->num_rows() > 0){
			$result = $query->row_array();
			$status = $result['u_status'];
			
			if($status=='1'){
				return ['status' => '1', 'result' => $result['u_id']];
			}elseif($status=='0'){
				return ['status' => '0', 'result' => '0'];
			}else{
				return ['status' => '0', 'result' => ''];
			}
		}else{
			return ['status' => '0', 'result' => ''];
		}
	}
	
	public function forgotPassword($data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('u_email', $data['email']);
		$this->db->where('u_status', '1');
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
	
	public function checkEncryptUserID($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('u_id', $id);
		$this->db->where('u_status', '1');
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
						'u_password' 		=> md5($newpassword),
						'u_password_raw' 	=> $newpassword,
						'updated_at'		=> date('Y-m-d'),
						'updated_by'		=> $id
					];
					
		$result 	= $this->db->update('users', $userdata, ['u_id' => $id]);
	
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	public function getUserDetails($type, $status, $userid='', $usertype=[], $search=[], $orderby=[])
	{
		$this->db->select('u.*, up.*');
		$this->db->from('users u');
		$this->db->join('users_profile up', 'up.up_u_id=u.u_id', 'left');
		$this->db->where_in('u.u_status', $status);
		
		if($userid!='') $this->db->where('u.u_id', $userid);
		if(count($usertype) > 0) $this->db->where_in('u.u_type', $usertype);
		
		if(count($search) > 0){
			foreach($search as $k => $v){
				if($k=='shop') $this->db->like('up_company', $v, 'both');
			}
		}
		
		if(count($orderby) > 0){
			foreach($orderby as $k => $v){
				$this->db->order_by($k, $v);
			}
		}
		
		$query = $this->db->get();
		
		if($type=='all') 		$result = $query->result_array();
		elseif($type=='row') 	$result = $query->row_array();
		
		return $result;
	}
	
	public function actionUsers($data, $userid)
	{
		$this->db->trans_begin();
		
		$id 		= 	$data['id'];
		$name 		= 	$data['name'];
		$phone 		= 	$data['phone'];
		$address 	= 	$data['address'];
		$shop 		= 	(isset($data['shop']) ? $data['shop'] : '');
		$email 		= 	$data['email'];
		$password 	= 	(isset($data['password']) ? $data['password'] : '');
		$type 		= 	$data['type'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$users		=	[
							'u_name' 		=> $name,
							'u_email' 		=> $email,
							'u_type' 		=> $type,
							'u_status' 		=> '1',
							'updated_at' 	=> $datetime,
							'updated_by' 	=> $userid
						];
		
		if($password!=''){
			$users['u_password_raw'] 	= $password;
			$users['u_password'] 		= md5($password);
		}
		
		if($id==''){
			$users['created_at'] = $datetime;
			$users['created_by'] = $userid;
			$this->db->insert('users', $users);
			$insertid = $this->db->insert_id();
		}else{
			$this->db->update('users', $users, ['u_id' => $id]);
			$insertid = $id;
		}
			
		if($insertid){
			$usersprofile		=	[
										'up_u_id' 			=> $insertid,
										'up_company' 		=> $shop,
										'up_address' 		=> $address,
										'up_phone' 			=> $phone,
										'up_logo' 			=> '',
										'updated_at' 		=> $datetime,
										'updated_by' 		=> $userid
									];
			
			$source 			= './assets/uploads/temp/';
			$logodestination 	= './assets/uploads/admin/'.$insertid.'/logo/';
				
			if(isset($data['unlink']) && $data['unlink']!=''){
				$unlinks = $data['unlink'];
				foreach($unlinks as $unlink){
					if(isset($unlink['logo']) && $unlink['logo']!=''){
						if(is_file($logodestination.$unlink['logo'])) unlink($logodestination.$unlink['logo']);
					}
				}
			}
			
			if(isset($data['logo']) && $data['logo']!=''){
				$logo = $data['logo'];
				$this->createDirectory($logodestination);
				if(is_file($source.$logo))	rename($source.$logo, $logodestination.$logo);
				$usersprofile['up_logo'] = $logo;
			}
			
			if($id==''){
				$usersprofile['created_at'] = $datetime;
				$usersprofile['created_by'] = $userid;
				$result = $this->db->insert('users_profile', $usersprofile);
			}else{
				$result = $this->db->update('users_profile', $usersprofile, ['up_u_id' => $id]);
			}
		}
		
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
			if((md5($oldpassword)==$userdata['u_password']) && ($newpassword==$confirmnewpassword) && ($oldpassword!=$newpassword)){
				$userdata = [	
								'u_password' 		=> md5($newpassword),
								'u_password_raw' 	=> $newpassword,
								'updated_at'		=> date('Y-m-d'),
								'updated_by'		=> $userid
							];
				$result 	= $this->db->update('users', $userdata, ['u_id' => $userid]);
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
	
	public function changestatus($data, $userid)
	{
		$id			= 	$data['id'];
		$status		= 	$data['status'];
		$datetime	= 	date('Y-m-d H:i:s');
		
		$this->db->trans_begin();
		
		$userDelete 		= 	$this->db->update(
									'users', 
									['u_status' => $status, 'updated_at' => $datetime, 'updated_by' => $userid], 
									['u_id' => $id]
								);
		
		$discountDelete 	= 	$this->db->update(
									'discounts', 
									['d_status' => $status, 'updated_at' => $datetime, 'updated_by' => $userid], 
									['d_u_id' => $id]
								);
								
		$discount 			= 	$this->db->select('GROUP_CONCAT(d_id SEPARATOR ",") as discountid')
								->where(['d_u_id' => $id, 'd_status !=' => '2'])
								->get('discounts')
								->row_array();
		
		$discountid			=	$discount['discountid'];
		if($discountid){
			$this->db->where_in('dl_d_id', explode(',', $discount['discountid']));
			$discountlistDelete = 	$this->db->update(
										'discounts_list', 
										['dl_status' => $status, 'updated_at' => $datetime, 'updated_by' => $userid]
									);
		}

		if(!$userDelete || !$discountDelete || ($discountid && !$discountlistDelete) || $this->db->trans_status() === FALSE)
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
	
	public function emailvalidation($data)
	{
		$id 	= $data['id'];
		$email 	= $data['email'];
		
		$this->db->where('u_email', $email);
		if($id!='') $this->db->where('u_id !=', $id);
		$this->db->where('u_status !=', '2');
		$query = $this->db->get('users');
		
		if($query->num_rows() > 0){
			return 'false';
		}else{
			return 'true';
		}
	}
	
	public function forgotPasswordMail($data)
	{
		$sitename	=	$this->config->item('sitename');
		
		$this->load->library('encryption');
		
		$id 		=	$this->encryption->encrypt($data['u_id']);
		$name 		=	$data['u_name'];
		$email 		= 	$data['u_email'];
		$link		=	base_url().'authentication/forgotpassword/verification?id='.$id;
		
		$subject 	= 	$sitename.' Forgot Password';
		$message	= 	'
							<h4>Hi '.$name.'</h4>
							<p>We got a request to reset your '.$sitename.' Password.</p>
							<p>Below you can find the link to reset your password.</p>
							<a href="'.$link.'">Reset Password</a>
							<p style="margin-top:30px;">Regards</p>
							<p>'.$sitename.'</p>
						';
						
		return $this->sentMail($email, $subject, $message);
	}
}