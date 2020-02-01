<?php
if(isset($result) && $result){
	$id 						= $result['id'];
	$type 						= (set_value('type')) ? set_value('type') : $result['type'];
	$allocation 				= (set_value('allocation')) ? set_value('allocation') : $result['allocation'];
	$period 					= (set_value('period')) ? set_value('period') : $result['period'];
	$period_date 				= (set_value('period_date')) ? set_value('period_date') : $result['period_date'];
	$status 					= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading					= 'Update';
}else{
	$id 						= '';
	$type						= set_value('type');
	$allocation					= set_value('allocation');
	$period						= set_value('period');
	$type						= set_value('type');
	$status						= set_value('status');
$period_date					= set_value('period_date');
	$heading					= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber Performance Types</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumber Performance Types</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Plumber Performance Types</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="type">Performance Type *</label>
								<input type="text" class="form-control" id="type" name="type" placeholder="Enter Plumber Performance Type *" value="<?php echo $type; ?>">						
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="allocation">Performance Point Allocation *</label>
								<input type="number" class="form-control" id="allocation" name="allocation" placeholder="Enter Performance Point *" value="<?php echo $allocation; ?>">						
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="period" id="period" <?php if($period=='1') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="period">This Performance Type has limited period to it</label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group datewrapper displaynone">
								<label for="period_date">Select date when Performance type is archived*</label>
								<input type="text" autocomplete="off" class="form-control" id="period_date" name="period_date" placeholder="Enter Select date when Performance type is archived *" value="<?php echo $period_date; ?>">						
							</div>
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
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Plumber Performance Type</button>
						</div>
					</div>
				</form>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Performance Type</th>
								<th>Points</th>
								<th>Status</th>
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
			url 	: 	'<?php echo base_url()."admin/systemsetup/performancesettings/Plumberperformance/DTPlumberPerformance"; ?>',
			columns : 	[
			{ "data": "type" },
			{ "data": "allocation" },
			{ "data": "status" },
			{ "data": "action" }
			]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				type : {
					required	: true,
				},
				allocation : {
					required	: true,
				}
				
			},
			{
				type 	: {
					required	: "Performance Type field is required."
				},
				allocation 	: {
					required	: "Allocation field is required."
				}
			}
		);

		performance();
		
	});
$(document).ready(function(){
	datepicker('#period_date', ['currentdate'])
})
	

	$('#period').click(function(){
		performance();
	})
	
	function performance(){
		if($('#period').is(':checked')){
			$('.datewrapper').removeClass('displaynone');
		}else{
			$('.datewrapper').addClass('displaynone');
		}
	}
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/systemsetup/performancesettings/plumberperformance'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
