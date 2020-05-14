<?php
	if(isset($result) && $result){
		
		$id 			= $result['id'];
		$name 			= (set_value('name')) ? set_value('name') : $result['name'];
		$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
		$heading		= 'Update';
	}else{
		$id 			= '';
		$name			= set_value('name');
		$status			= set_value('status');
		
		$heading		= 'Add';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Qualification Route</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Qualification Route</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if ($checkpermission) { ?>
				<form class="form" action="" method="post">
					<div class="form-group">
						<label for="name">Qualification Route*</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter Qualification Route *" value="<?php echo $name; ?>">						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; ?> value="1" checked>
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" id="DBid" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Qualification Route</button>
						</div>
					</div>
				</form>
			<?php } ?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Qualification Route</th>
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
			url 	: 	'<?php echo base_url()."admin/systemsetup/qualificationroutes/qualificationroute/DTQualificationroute"; ?>',
			columns : 	[
							{ "data": "name" },
							{ "data": "status" },
							{ "data": "action" }
						],
						target : [2],
						sort : '0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				name : {
					required	: true,
					remote		: 	{
							url	: "<?php echo base_url().'admin/systemsetup/qualificationroutes/qualificationroute/QualificationRouteValidation'; ?>",
							type: "post",
							async: false,
							data: {
								name: function() {
									return $( "#name" ).val();
								},
								id: function() {
									return $( "#DBid" ).val();
								}
							}
						}
				}
			},
			{
				name 	: {
					required	: "Qualification Route field is required.",
					remote		: "Qualification Route Already Exists."
				}
			}
		);
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/systemsetup/qualificationroutes/qualificationroute'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
