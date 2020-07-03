<?php

class Stock_Model extends CC_Model
{
	public function getRange($quantity){

		$this->db->select('*');
		$this->db->from('stock_management');
		$this->db->where(["id >=" => $this->config->item('customstockno')]);
		$this->db->where(["user_id" => "0", "type" => "2"]);
		$result = $this->db->get()->result_array();
		
		$ids 		= '';
		$checkarray = [];
		
		if(count($result) > 0){
			for($i=0; $i<$quantity; $i++){
				if($i==0){
					$ids .= $result[$i]['id'];
				}else{
					if($i==($quantity-1)){		
						if(($result[$i]['id']-$result[$i-1]['id'])=='1'){
							$ids .= '-'.$result[$i]['id'];
						}else{
							$ids .= ','.$result[$i]['id'];
						}			
					}else{
						if(isset($result[$i+1]['id'])){
							$currentprevious 	= abs($result[$i]['id']-$result[$i-1]['id']);
							$currentnext 		= abs($result[$i]['id']-$result[$i+1]['id']);
							
							if(($currentprevious!='1' || $currentnext!='1') && !in_array($result[$i]['id'], $checkarray)){
								if($currentprevious!='1'){
									$ids .= ','.$result[$i]['id'];
								}elseif($currentnext!='1'){
									$ids .= '-'.$result[$i]['id'];
									$checkarray[] = $result[$i+1]['id'];
								}
							}elseif(in_array($result[$i]['id'], $checkarray)){
								$ids .= ','.$result[$i]['id'];
							}
						}
					}
				}
				
			}
		}
		
		return $ids;
	}

	public function getResellerRange($type, $requestdata,$count=0){

		$this->db->select('t1.*');
		$this->db->from('stock_management t1');	
		// $user_id = $this->getUserId();
		// if(isset($requestdata['id'])) 				$this->db->where('order_id', $requestdata['id']);
		if(isset($requestdata['user_id'])) 				$this->db->where('user_id', $requestdata['user_id']);
		// $this->db->where("user_id=$user_id");
		$this->db->where("coc_status='3'");
		$this->db->where("type='2'");
		// $this->db->where("user_id='NULL'",'OR');
		// $this->db->limit(1,0);
		// $this->db->order_by('id', 'ASC');	

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
			// elseif($type=='row') 	$result = $query->row_array();
			if($result){
			if($count>0){
				if($count==1){
					$result['allocate_start'] = $result[0]['id']; 
					$result['allocate_end'] = $result[0]['id']; 
				} else {
					
					$res_arr = array_column($result, 'id');
					foreach ($res_arr as $key => $val) {
						$arr_end = $val+($count-1);
					    $new_arr = range($val,$arr_end);    
					    $c = 0;
					    foreach($new_arr as $key1=>$val1){
					        if(in_array($val1,$res_arr)){
					            $c++;
					        }
					    }
					    if($c==$count){
					        $result['allocate_start'] = $val; 
							$result['allocate_end'] = $arr_end;
					        break;
					    }
					}
				}
			}
			}
		}
		
		return $result;
	}

	public function action($data){
		$requestdata['allocation_date'] = date('Y-m-d H:i:s');
		
		if($data['type']=='3'){
			$requestdata['coc_status'] 		= '4';	
		} 
		else if($data['type']=='6'){
			$requestdata['coc_status'] 		= '3';	
		}
		
		if(isset($data['coc_type'])) $requestdata['type']	= $data['coc_type'];
		if(isset($data['user_id'])) $requestdata['user_id']	= $data['user_id'];
		$requestdata['coc_orders_status']	= null;
		
		$requestdata1['admin_status']	= '1';

		if(isset($data['order_id'])) $inv_id	= $data['order_id'];

		if(isset($requestdata)){
			if(isset($data['coc_type'])){
				if($data['coc_type']==1){
					for($i=1;$i<=$data['coc_count'];$i++){
						$stockmanagement = $this->db->get_where('stock_management', ['user_id' => '0', 'coc_status' => '1', 'coc_orders_status' => '6', 'type' => '1'])->row_array();
						
						if($stockmanagement){
							$result1 = $this->db->update('stock_management', $requestdata, ['id' => $stockmanagement['id']]);
							$insertid = $stockmanagement['id'];
						}else{
							$result1 = $this->db->insert('stock_management', $requestdata);
							$insertid = $this->db->insert_id();
						}
						
						$this->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $data['user_id'], 'cocid' => $insertid, 'action' => '6', 'type' => '1']);		
					}		
				} else if($data['coc_type']==2) {
					$stockexplode1 = explode(',', $data['stock']);
					foreach($stockexplode1 as $explode1){
						$stockexplode2 = explode('-', $explode1);
						if(isset($stockexplode2[1])){
							for($i=$stockexplode2[0];$i<=$stockexplode2[1];$i++){
								$result1 = $this->db->update('stock_management', $requestdata, ['id' => $i]);
								$this->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $data['user_id'], 'cocid' => $i, 'action' => '6', 'type' => '1']);
							}
						}else{
							$result1 = $this->db->update('stock_management', $requestdata, ['id' => $stockexplode2[0]]);
							$this->diaryactivity(['adminid' => $this->getUserID(), 'plumberid' => $data['user_id'], 'cocid' => $stockexplode2[0], 'action' => '6', 'type' => '1']);					
						}
					}
				}
			}			
		
			$this->db->update('coc_orders', $requestdata1, ['id' => $data['order_id']]);
		}
		return $inv_id;
	}

}