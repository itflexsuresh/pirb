<?php

class Stock_Model extends CC_Model
{
	public function getRange($type, $requestdata){

		$this->db->select('t1.*');
		$this->db->from('stock_management t1');	

		// if(isset($requestdata['id'])) 				$this->db->where('order_id', $requestdata['id']);
		$this->db->where("user_id=0");
		$this->db->where("user_id='NULL'",'OR');
		$this->db->limit(1,0);
		$this->db->order_by('id', 'ASC');	

		// SELECT * FROM `stock_management` WHERE user_id=0 || user_id=NULL ORDER BY id ASC LIMIT 0,1

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['id','inv_id','created_at','status','user_id','coc_type','delivery_type'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);	
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
			$this->db->like('name', $searchvalue);
		}
			 			
		if ($type=='count') {
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}

	public function action($data){
		$requestdata['allocation_date'] = date('Y-m-d H:i:s');
		// if(isset($data['created_at'])) 	    $requestdata['created_at'] 		= date('Y-m-d H:i:s', strtotime($data['created_at']));
		$requestdata['coc_status'] 		= '4';	
		if(isset($data['coc_type'])) $requestdata['type']	= $data['coc_type'];
		if(isset($data['user_id'])) $requestdata['user_id']	= $data['user_id'];

		$requestdata1['admin_status']	= '1';

		if(isset($requestdata)){
			for($i=$data['allocate_start'];$i<=$data['allocate_end'];$i++){
				$result1 = $this->db->update('stock_management', $requestdata, ['id' => $i]);
			}
			$this->db->update('coc_orders', $requestdata1, ['id' => $data['order_id']]);			
		}
	}

}