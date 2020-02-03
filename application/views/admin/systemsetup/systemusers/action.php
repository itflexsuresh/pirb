<?php
	if(isset($result) && $result){
		$id 			= $result['id'];
		$role_id        = (set_value('type')) 			? set_value('type') 			: $result['type'];
		$name 			= (set_value('name')) ? set_value('name') : $result['name'];
		$surname        = (set_value('surname')) ? set_value('surname') : $result['surname'];
		$email          = (set_value('email')) ? set_value('email') : $result['email'];
		$password       = (set_value('password_raw')) 	? set_value('password_raw') 	: $result['password_raw'];
		$type           = (set_value('type')) ? set_value('type') : $result['type'];
		$comments       = (set_value('comments')) ? set_value('comments') : $result['comments'];
		$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	    $read 		    = (set_value('read')) 		? set_value('read') 			: $result['read_permission'];
	    $write 		        = (set_value('write')) 		? set_value('write') 			: $result['write_permission'];
		$heading		= 'Update';
	}else{
		$id 			= '';
		$role_id        = set_value('role_id'); 
		$name			= set_value('name');
		$surname        = set_value('surname');
		$password       = set_value('password_raw');
		$email          = set_value('email');
		$type           = set_value('type');
		$comments       = set_value('comments');
		$status			= set_value('status');
		$read       = set_value('read');
     	$write			= set_value('write');
		
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

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Add Edit System Users</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
					<div class="form-group col-md-6">
						<label for="name">Name *</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter the name*" value="<?php echo $name; ?>">
					</div>
					<div class="form-group  col-md-6">
						<label for="surname">Surname *</label>
						<input type="text" class="form-control" id="surname" name="surname" placeholder="Enthe the surname*" value="<?php echo $surname; ?>">
					</div>
			
					<div class="form-group col-md-6">
						<label for="email">Email Address*</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enthe the Email*" value="<?php echo $email; ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="password">Password *</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enthe the Password*" value="<?php echo $password; ?>">
					</div>
					<div class="form-group col-md-6">
						
						<label for="role_id">Role Type *</label>
						<?php echo form_dropdown('type', $roletype, $role_id, ['id' => 'role_id', 'class' => 'form-control']); ?>
				    </div>
				    <div class="form-group col-md-6">
						<label for="comments">Comments </label>
							<textarea class="form-control" id="comments" name="comments" placeholder="Enter the comments "><?php echo $comments; ?></textarea>
					</div>
				</div>


					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1')echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>

						<div class="table-responsive m-t-40">
					
					<table class="table table-bordered table-striped  fullwidth">
						<?php //if($key=='Administration'){?>
						<thead>
							<tr>
								<th>Permissions</th>
								<th>Read</th>
								<th>Write</th>
							</tr>
						</thead>
					<?php// }?>
					<?php 
					if(count($permission_list) > 0)
					{
						foreach($permission_list as $key=>$val)
						{

							?>
						<tbody>
							<tr style="background-color:lightgray">
								<td ><?php echo $key;?></td>
								<td>&nbsp;<input type="checkbox" name="checkbox"></td>
								<td>&nbsp;<input type="checkbox" name="checkbox"></td>
							</tr>
							<?php // print_r($val); exit;
							foreach($val as $k=>$v)
							{
								?>
							<tr >
								<td ><?php echo $v['name'];?></td>
								<?php 
								$read_permission = explode(',', $read);
								$write_permission = explode(',', $write);

								if(in_array($v['id'],$read_permission))
								{ ?>
								<td><input checked="checked" type="checkbox" name="read[]" value="<?php echo $v['id'];?>"></td>	
								<?php } else { ?>
								<td><input type="checkbox" name="read[]" value="<?php echo $v['id'];?>"></td>
							<?php }
								if(in_array($v['id'],$write_permission))
								{
								 ?>							
								<td><input checked="checked" type="checkbox" name="write[]" value="<?php echo $v['id'];?>"></td>
							<?php } else { ?>
 								<td><input type="checkbox" name="write[]" value="<?php echo $v['id'];?>"></td>
						<?php	} ?>
							</tr>
								<?php
										}
								?>
						</tbody>
						<?php } } ?>
					</table>
				
				</div>
						<div class="col-md-6 text-right">
							<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
						</div>
					</div>
				</form>
			</div>
			</div>
	</div>
</div>
		
			</div>
		</div>
	</div>
</div>
		
<script>
	$(function(){
		
		
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
					remote		: 	{
						url	: "<?php echo base_url().'admin/systemsetup/systemusers/systemusers/DTemailValidation'; ?>",
						type: "post",
						data: {
							email: function() {
								return $( "#email" ).val();
							},
							id: function() {
								return $( "#id" ).val();
							}
						}

					}
				},
				password:{
					required    : true,
				},
				type   :{
					required    :true,
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
					remote		: "Please enter the differene email",
				},
				password:{
					required    : "Please enter the password",
				},
				type    :{
					required    : "Please Select the type",
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




