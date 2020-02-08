<?php

class Communication_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{ 
		
		$query=$this->db->select('t1.*,
			t2.id,
			t2.category_id,
			t2.name,
			t2.email_active,
			t2.sms_active');
		$this->db->from('email_notification_category t1');


		$this->db->join('email_notification t2', 't2.category_id = t1.id', 'left');
		//$this->db->join('users_detail t3', 't3.user_id = t1.user_id', 'left');

		if(isset($requestdata['id'])) $this->db->where('t2.category_id', $requestdata['id']);

		// if(isset($requestdata['status'])) 		$this->db->where_in('status', $requestdata['status']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length']))
		{
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		// if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir']))
		// {
		// 	$column = ['t1.inv_id', 't1.total_due','t1.total_cost','t1.created_at', 't1.internal_inv','t1. description','t2.quantity','t2.cost_value','t2.delivery_cost','t3.name','t3.surname','t3.company_name','t3.reg_no','t3.vat_no','t3.email2','t3.home_phone'];
		// 	$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		// }

		
		//if(isset($requestdata['id'])) 			$this->db->where('id', $requestdata['id']);
		//if(isset($requestdata['status'])) 		$this->db->where_in('status', $requestdata['status']);

		if($type=='count'){
			$result = $this->db->count_all_results();
		}
		else
		{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;	
		
	}

	public function getPermissions()
	{ 
		$this->db->select('email_notification.name,email_notification.category_id,email_notification.id,email_notification.email_active,email_notification.sms_active,email_notification_category.name as cat_name');
		$this->db->from('email_notification');
		$this->db->join('email_notification_category', 'email_notification.category_id = email_notification_category.id');

		
		$query = $this->db->get();

		return $query->result();
	}





	public function action($data)
	{
		$this->db->trans_begin();

		$userid			= 	$this->getUserID();		
		$datetime		= 	date('Y-m-d H:i:s');
		$id				= 	$data['id'];

		
		//if(isset($data['password'])) 			$request1['email_active'] 		= $data['password'];
		//if(isset($data['password'])) 			$request1['sms_active'] 		= $data['password'];
		if(isset($data['subject'])) 			$request['subject'] 			= $data['subject'];
		if(isset($data['email_body'])) 			$request['email_body'] 			= $data['email_body'];
		if(isset($data['sms_body'])) 			$request['sms_body'] 			= $data['sms_body'];

		
		
			if($id != '')
			{ 
				$request['created_at'] = $datetime;
			 	$this->db->update('email_notification', $request, ['id' => $id]);

			}
		


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