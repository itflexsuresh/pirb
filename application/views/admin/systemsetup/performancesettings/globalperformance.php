<?php
if(isset($result) && $result){
	$heading		= 'Update';
}else{
	$id 			= '';
	$name			= set_value('name');
	$status			= set_value('status');

	$heading		= 'Save';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Global Performance Settings</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Global Performance Settings</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive m-t-40">
					<h4 class="card-title">Global Performance Settings - Point Allocations</h4>
					<form class="mt-4 form" action="" method="post">
					    <table class="table  fullwidth" border="1">
					    	<thead>
							<tr>
								<th>Description</th>
								<th>Point Allocation</th>
								<th>Performance Wording</th>
							</tr>
					 		</thead>
					 		<tbody>
					 			<?php foreach($results as $key=>$val){
					 			
					 		  ?>
							<tr>
                                <?php if($val['type'] == 1 || $val['type'] == 3 || $val['type'] == 5|| $val['type'] == 7 ){
                                     
                                	?>
				        		<td class="key" style="font-weight:bold; text-align:left;"><?php echo $val['description'];?></td>
				        	<?php }
				        	else { 

                                   if($val['id']!=13){
				        		?>
				        		<td class="key" style="text-align:right;" ><?php echo $val['description'];?></td>
				        		<?php }}if($val['id']!=13){ ?>
								<td class="point">
									<?php if($val['type']!=1 && $val['type']!=3 && $val['type']!=5 ){
                                        
										?>
									<input type="text" size="2" min="0" id="points" name="points[<?php echo $val['id']; ?>]"  value="<?php echo $val['point'];?>" style="margin: 0px 20px;width: 40%;">
								<?php }}?>
								</td>
                                <?php if($val['id']!=13){?>
								<td class="wording" ><?php echo $val['wording'];?></td>
							<?php }?>
							</tr>
						<?php 	}?>
						</tbody>
					    </table></br></br>
					
			   
				<h4 class="card-title">Global Performance Settings - Warning Notifications to Plumbers</h4>
					    <table class="table  fullwidth" border="1">
					    	<thead>
							<tr>
								<th>Performance Warning Status</th>
								<th>Point threshold at which the warning notificaton is sent</th>
								<th>Active</th>
							</tr>
					 		</thead>
					 		
					 		<tbody>
					 			<?php 
                               // echo '<pre>';print_r($result);exit();
					 			foreach($result as $key1=>$val1){

					 				
					 			?>
					 			
							<tr>
								<td class="key1"><?php echo $val1['warning'];?></td>
								<td class="point">
									<input type="text" size="2" min="0" id="points" name="points1[<?php echo $val1['id'];?>]"  value="<?php echo $val1['point'];?>" style="margin: 0px 20px;width: 10%;">
								</td>

								<td>
                                <div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status[<?php echo $val1['id'];?>]" id="status_<?php echo $val1['id'];?>" <?php echo ($val1['status']=='1') ? 'checked="checked"' : ''; ?>>
								<label class="custom-control-label" for="status_<?php echo $val1['id'];?>"></label>
							    </div></td>
							    
							</tr>
							<?php }?>
						</tbody>
					    </table></br>
                <div class="form-group">
					<label style="font-weight:bold;">Performance Rolling Averages</label>&nbsp&nbsp&nbsp &nbsp &nbsp  

					<?php foreach($results1 as $key2=>$val2){}?>

					<input type="text" class="form-group" id="avg" name="points[<?php echo $val2['id']; ?>]"  value="<?php echo $val2['point']; ?>" placeholder="months" >	
									
		        </div>			
                <div class="col-md-11 text-right">
				       <input type="hidden" name="id" value="<?php //echo $id; ?>">
					   <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?>
					   </button>
				    </div>
			      </form>		
		    </div>
	    </div>
    </div>
</div>



