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
		<h4 class="text-themecolor">Managearea Type</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Managearea Type</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Managearea Type</h4>
				<form class="mt-4 form" action="" method="post">
					<!-- <div class="form-group">
						<label for="installationtype_id">Managearea Type *</label>
						<select>
						<option></option>
						</select>
						<?php //echo form_dropdown('installationtype_id', $installationtypelist, $itid, ['id' => 'installationtype_id', 'class' => 'form-control']); ?> -->
					<!-- </div> -->
					 <div class="form-group col-6">
						<label for="name">Managearea Type*</label>
						<!-- <textarea class="form-control" id="name" name="name" placeholder="Enter Installation Type *"><?php echo $name; ?></textarea> -->
                         <select class="form-control" id="name" name="name" placeholder="select*">
                         	<option value="">Select </option>
                         </select>
                       
					</div>
                    <div class="form-group col-6">
                        <input type="radio" class="radio-control" id="choice1" name="choice1">
                        <label class="radio-button">New city</label>
					
                        <input type="radio" class="radio-control" id="choice1" name="choice1">
                        <label class="radio-button">Existing city</label>
					</div>
                    <div class="form-group col-6">
						<label for="name">City*</label>
						<!-- <textarea class="form-control" id="name" name="name" placeholder="Enter Installation Type *"><?php echo $name; ?></textarea> -->
                         <select class="form-control" id="name" name="name" placeholder="select*">
                         	<option value="">Select City</option>
                         </select>
                       
					</div>
					<div class="form-group col-6">
						<label class="Suburb">Suburb</label>
                        <input type="text" class="form-control" id="Suburb" name="Suburb" placeholder="Suburb">
					</div>
					<div class="form-group col-6">
						<label class="city">city</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="city">
					</div>

					<div class="row ">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Managearea Type</button>
							
						</div>
					</div>
				</form>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Managearea Type</th>
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
			url 	: 	'<?php echo base_url()."admin/systemsetup/managearea/DTManagearea"; ?>',
			columns : 	[
							{ "data": "name" },
							{ "data": "status" },
							{ "data": "action" }
						]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				name : {
					required	: true,
				}
			},
			{
				name 	: {
					required	: "Managearea Type field is required."
				}
			}
		);
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/systemsetup/managearea'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
