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
		
		$heading		= 'Save';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Add Edit System Users</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Add Edit System Users</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Add Edit System Users</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
					<div class="form-group col-md-6">
						<label for="name">Name *</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enthe the name*"><?php echo $name; ?>
					</div>
					<div class="form-group  col-md-6">
						<label for="surname">Surname *</label>
						<input type="text" class="form-control" id="surname" name="surname" placeholder="Enthe the surname*">
					</div>
			
					<div class="form-group col-md-6">
						<label for="email">Email Address*</label>
						<input type="email" class="form-control" id="email " name="email" placeholder="Enthe the Email*">
					</div>
					<div class="form-group col-md-6">
						<label for="Password">Password *</label>
						<input type="Password" class="form-control" id="Password" name="Password" placeholder="Enthe the Password*">
					</div>
					<div class="form-group col-md-6">
						<label for="role_type">Role Type *</label>
						<input type="role" class="form-control" id="role" name="role" placeholder="Select*">
						<?php //echo form_dropdown('installationtype_id', $installationtypelist, $itid, ['id' => 'installationtype_id', 'class' => 'form-control']); ?>
				    </div>
				    <div>
						<label for="comments">Comments *</label>
						<textarea class="form-control" id="comments" name="comments" placeholder="Enter the comments *"></textarea>
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
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
						</div>
					</div>
				</form>
				<!-- <div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Installation Type</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div> -->

			</div>
		</div>
	</div>
</div>
		
<script>
	$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/systemsetup/systemusers/systemuseredit/DTsystemuseredit"; ?>',
			columns : 	[
							{ "data": "name" },
							{ "data": "surname" },
							{ "data": "email"},
							{ "data": "Password"},
							{ "data": "role"},
                            { "data": "comments"},
							{ "data": "action" }
						]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				name : {
					required	: true,
				},
				surname:{
					required    : true,
				},
				email  :{
					required    : true,
				},
				Password:{
					required    : true,
				}

			},
			{
				name : {
					required	: "Please enter the name",
				},
				surname:{
					required    : "Please enter the surname",
				},
				email  :{
					required    : "Please enter the email",
				},
				Password:{
					required    : "Please enter the password",
				}
			}
		);
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/systemsetup/systemusers'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
