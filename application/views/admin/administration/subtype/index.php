<?php
	if(isset($result) && $result){
		$id 			= $result['id'];
		$itid 			= (set_value('installationtype_id')) ? set_value('installationtype_id') : $result['installationtype_id'];
		$name 			= (set_value('name')) ? set_value('name') : $result['name'];
		$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
		$heading		= 'Update';
	}else{
		$id 			= '';
		$itid			= set_value('installationtype_id');			
		$name			= set_value('name');
		$status			= set_value('status');
		
		$heading		= 'Add';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Sub Type</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Sub Type</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Sub Type</h4>
				<?php if($checkpermission){ ?>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="installationtype_id">Installation Type *</label>
								<?php echo form_dropdown('installationtype_id', $installationtypelist, $itid, ['id' => 'installationtype_id', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Sub Type *</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter Sub Type *" value="<?php echo $name; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; if($status=='') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" id="DBId" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Sub Type</button>
						</div>
					</div>
				</form>
			<?php } ?>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Installation Type</th>
								<th>Sub Type</th>
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
			url 	: 	'<?php echo base_url()."admin/administration/subtype/DTSubtype"; ?>',
			columns : 	[
							{ "data": "installationtypename" },
							{ "data": "name" },
							{ "data": "status" },
							{ "data": "action" }
						],
						target	:	[3],
						sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				installationtype_id : {
					required	: true,
				},
				name : {
					required	: true,
					remote		: 	{
							url	: "<?php echo base_url().'admin/administration/subtype/SubTypeValidation'; ?>",
							type: "post",
							async: false,
							data: {
								name: function() {
									return $( "#name" ).val();
								},
								id: function() {
									return $( "#DBId" ).val();
								}
							}
						}
				}
			},
			{
				installationtype_id 	: {
					required	: "Installation Type field is required."
				},
				name 	: {
					required	: "Sub Type field is required.",
					remote		: "Sub Type Already Exists."
				}
			}
		);
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/administration/subtype'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
