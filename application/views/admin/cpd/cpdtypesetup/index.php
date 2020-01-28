<?php
if(isset($result) && $result){
	$id 				= $result['id'];
	$activity 			= (set_value('activity')) ? set_value('activity') : $result['activity'];
	$startdate 			= (set_value('startdate')) ? set_value('startdate') : $result['startdate'];
	$points 			= (set_value('points')) ? set_value('points') : $result['points'];
	$cpdstream 			= (set_value('cpdstream')) ? set_value('cpdstream') : $result['cpdstream'];
	$enddate 			= (set_value('enddate')) ? set_value('enddate') : $result['enddate'];
	$productcode 		= (set_value('productcode')) ? set_value('productcode') : $result['productcode'];
		//$cpdstream 			= (set_value('cpdstream')) ? set_value('cpdstream') : $result['cpdstream'];
	$status 			= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading			= 'Update';
}else{
	$id 				= '';
	$activity			= set_value('activity');
	$startdate			= set_value('startdate');
	$points				= set_value('points');
	$enddate			= set_value('enddate');
	$productcode		= set_value('productcode');
	$cpdstream			= set_value('cpdstream');
	$status				= set_value('status');

	$heading			= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">CPD Types</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">CPD Types</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">CPD Types</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="activity">Activity *</label>
							<input type="text" class="form-control" id="activity" name="activity" placeholder="Enter Activity *" value="<?php echo $activity; ?>">						
						</div>
						<div class="form-group col-md-6">
							<label for="startdate">CPD Start Date</label>
							<input type="text" class="form-control" id="startdate" name="startdate" placeholder="Enter CPD Start Date *" value="<?php echo $startdate; ?>">						
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="points">CPD Points</label>
							<input type="text" class="form-control" id="points" name="points" placeholder="Enter CPD Points *" value="<?php echo $points; ?>">						
						</div>					
						<div class="form-group col-md-6">
							<label for="enddate">CPD End Date</label>
							<input type="text" class="form-control" id="enddate" name="enddate" placeholder="Enter End Date *" value="<?php echo $enddate; ?>">						
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="productcode">Product Code</label>
							<input type="text" class="form-control" id="productcode" name="productcode" placeholder="Enter Product Code *" value="<?php echo $productcode; ?>">						
						</div>
						<div class="form-group col-md-6">
							<label for="cpdstream">CPD Stream</label>
							<?php echo form_dropdown('cpdstream', $cpdstreamID, $cpdstream, ['id' => 'cpdstream', 'class' => 'form-control']); ?>					
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> CPD Type</button>
						</div>
					</div>
				</form>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Product Code</th>
								<th>Activity</th>
								<th>CPD Start Date</th>
								<th>CPD End Date</th>
								<th>CPD Stream</th>
								<th>CPD Points</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/cpd/cpdtypesetup/DTCpdType"; ?>',
			columns : 	[
			{ "data": "productcode" },
			{ "data": "activity" },
			{ "data": "startdate" },
			{ "data": "enddate" },
			{ "data": "cpdstream" },
			{ "data": "points" },
			{ "data": "action" }
			]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				activity : {
					required	: true,
				},
				startdate : {
					required	: true,
				},
				points : {
					required	: true,
				},
				enddate : {
					required	: true,
				},
				productcode : {
					required	: true,
				},
				stream : {
					required	: true,
				}
			},
			{
				activity 	: {
					required	: "Activity field is required."
				},
				startdate 	: {
					required	: "Start Date field is required."
				},
				points 	: {
					required	: "Points field is required."
				},
				enddate 	: {
					required	: "End Date field is required."
				},
				productcode 	: {
					required	: "Product Code field is required."
				},
				stream 	: {
					required	: "CPD Stream field is required."
				}
			}
			);
		
	});
	$( document ).ready(function() {
		datepicker('#startdate', ['currentdate']);
		datepicker('#enddate', ['currentdate']);
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/cpd/cpdtypesetup'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
