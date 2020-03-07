<p>Diary of Activities</p>
<div class="row">
	<div class="col-12 diarybar">
		<?php			
			foreach($results as $result){
				$id 			= isset($result['id']) ? $result['id'] : '';
				$adminname 		= isset($result['adminname']) ? $result['adminname'] : '';
				$plumbername 	= isset($result['plumbername']) ? $result['plumbername'] : '';
				$companyname 	= isset($result['companyname']) ? $result['companyname'] : '';
				$auditorname 	= isset($result['auditorname']) ? $result['auditorname'] : '';
				$cocid 			= isset($result['coc_id']) ? $result['coc_id'] : '';
				$action 		= isset($result['action']) ? $result['action'] : '';
				$type 			= isset($result['type']) ? $result['type'] : '';
				$datetime 		= isset($result['datetime']) && $result['datetime']!='1970-01-01' ? date('d-m-Y', strtotime($result['datetime'])) : '';
				$diary			= $this->config->item('diary');
		?>
			<div>
				<?php echo ($datetime!='') ? $datetime.' -  ' : ''; ?>
				<?php 
					if($type!=''){
						if($type=='1') echo $adminname;
						elseif($type=='2') echo $plumbername;
						elseif($type=='3') echo $companyname;
						elseif($type=='4') echo $auditorname;
						
						echo ' : ';
					}
				?>
				<?php echo isset($diary[$action]) ? $diary[$action] : ''; ?>
				<?php echo ($cocid!='') ? ' - '.$cocid : ''; ?>
			</div>
		<?php 
			}
		?>
	</div>
</div>