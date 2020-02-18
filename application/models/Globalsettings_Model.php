<?php

class Globalsettings_Model extends CC_Model
{
	public function getList($type, $requestdata=[])
	{

		$this->db->select('gami_global.*,gami_global.value');
        $this->db->from('gami_global');
     
       if(isset($requestdata['id'])) $this->db->where('gami_global.id', $requestdata['id']);
      
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$this->db->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			$column = ['gami_global.id', 'gami_global.option', 'gami_global.value'];
			$this->db->order_by($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
		}
		
		
		if($type=='count'){
			$result = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			
			if($type=='all') 		$result = $query->result_array();
			elseif($type=='row') 	$result = $query->row_array();
		}
		
		return $result;
	}
	
	public function action($data)
	{ 
		$this->db->trans_begin();
		
		$userid	  = 	$this->getUserID();
		$id       =     $data['id'];
		$datetime = 	date('Y-m-d H:i:s');
		
        $request  = [
                      'updated_at' => $datetime,
                   ];

       if(isset($data['award_point']))     $request['value'] = $data['award_point'];
       if(isset($data['top']))             $request1['value'] = $data['top'];
       if(isset($data['award']))           $request2['value'] = $data['award'];
       if(isset($data['bonus_points']))    $request3['value'] = $data['bonus_points'];
       if(isset($data['award1']))          $request4['value'] = $data['award1'];
       if(isset($data['top1']))            $request5['value'] = $data['top1'];
       if(isset($data['award2']))          $request6['value'] = $data['award2'];
       if(isset($data['month_award']))     $request7['value'] = $data['month_award'];
       if(isset($data['it_1']))            $request8['value'] = $data['it_1'];
       if(isset($data['cpd_aquired']))     $request9['value'] = $data['cpd_aquired'];
       if(isset($data['it_2']))            $request10['value'] = $data['it_2'];
       if(isset($data['cpd_aquired1']))    $request11['value'] = $data['cpd_aquired1'];
       if(isset($data['bonus']))           $request12['value'] = $data['bonus'];
       if(isset($data['employeed']))       $request13['value'] = $data['employeed'];
       if(isset($data['every_day_award'])) $request14['value'] = $data['every_day_award'];

      
		if($data['award_point']!=''){
			$this->db->update('gami_global', $request, ['id' => '1']);
		}
		if($data['top']!=''){
			$this->db->update('gami_global', $request1, ['id' => '2']);
		}
		if($data['award']!=''){
			$this->db->update('gami_global', $request2, ['id' => '3']);
		}
		if($data['bonus_points']!=''){
			$this->db->update('gami_global', $request3, ['id' => '4']);
		}
		if($data['award1']!=''){
			$this->db->update('gami_global', $request4, ['id' => '5']);
		}
		if($data['top1']!=''){
			$this->db->update('gami_global', $request5, ['id' => '6']);
		}
		if($data['award2']!=''){
			$this->db->update('gami_global', $request6, ['id' => '7']);
		}
		if($data['month_award']!=''){
			$this->db->update('gami_global', $request7, ['id' => '8']);
		}
		if($data['it_1']!=''){
			$this->db->update('gami_global', $request8, ['id' => '9']);
		}
		if($data['cpd_aquired']!=''){
			$this->db->update('gami_global', $request9, ['id' => '10']);
		}
		if($data['it_2']!=''){
			$this->db->update('gami_global', $request10, ['id' => '11']);
		}
		if($data['cpd_aquired1']!=''){
			$this->db->update('gami_global', $request11, ['id' => '12']);
		}
		if($data['bonus']!=''){
			$this->db->update('gami_global', $request12, ['id' => '13']);
		}
		if($data['employeed']!=''){
			$this->db->update('gami_global', $request13, ['id' => '14']);
		}
		if($data['every_day_award']!=''){
			$this->db->update('gami_global', $request14, ['id' => '15']);
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



