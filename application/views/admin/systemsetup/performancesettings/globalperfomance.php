<?php
if(isset($result) && $result){

	//$id 			= $result['id'];
	//$name 			= (set_value('name')) ? set_value('name') : $result['name'];
	//$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
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
					 			
					 			<?php if(count($permission_list) > 0)
					         {
					          	foreach($permission_list as $key=>$val)
					         	{  
                           
								?> 
							<tr>
								<td><?php  echo $key; ?></td>

							<?php foreach($val as $k=>$v){
                           
   							?>
								<td><?php echo $v['point'];?></td>
								<td><?php echo $v['wording'];?></td>

							<?php }?>
								
							</tr>
							
						</tbody>
						<?php }}?>
					    </table>

			        </form>		
			    </div>
               <div class="table-responsive m-t-40">
					<form class="mt-4 form" action="" method="post">
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
					 			
					 			<?php if(count($permission_list1) > 0)
					         {
					          	foreach($permission_list1 as $key1=>$val1)
					         	{  
                             
								?> 
							<tr>
								<td><?php echo $key1; ?></td>

							<?php foreach($val1 as $k1=>$v1){
                           
   							?>
								<td><?php echo $v1['point'];?></td>
								<td>
                                <div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($v1['status']=='1')echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status"></label>
							    </div></td>
							<?php }?>
								
							</tr>
							
						</tbody>
						<?php }}?>
					    </table>

			        </form>		
			    </div></br>
            <div class="form-group">
					<label style="text-align: bold">Performance Rolling Averages</label>&nbsp&nbsp&nbsp &nbsp &nbsp  
					<input type="text" class="form-group" id="avg" name="average"  placeholder="months" value="">							
			</div>
		    </div>
		   
	    </div>

    </div>
</div>



