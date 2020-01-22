<?php
	$id 		= $result['u_id'];
	$name 		= (set_value('name')) ? set_value('name') : $result['u_name'];
	$phone 		= (set_value('phone')) ? set_value('phone') : $result['up_phone'];
	$address 	= (set_value('address')) ? set_value('address') : $result['up_address'];
	$email 		= (set_value('email')) ? set_value('email') : $result['u_email'];
	$logo 		= ($result['up_logo']!='') ? json_encode(['id' => $id, 'file' => [$result['up_logo']], 'path' => base_url('assets/uploads/admin/'.$id.'/logo/')]) : '';
	
	$heading	= 'Update';
?>

<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
	</li>
	<li class="breadcrumb-item active">Profile</li>
	<li class="breadcrumb-item active"><?php echo $heading;?> Profile</li>
</ol>
<div class="card mb-3">
	<div class="card-header">
		<?php echo $heading;?> Profile
	</div>
	<div class="card-body">
		<form method="post" action="">
			<div class="form-group">
				<label for="name">Name *</label>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Name">
				<?php echo (form_error('name')) ? form_error('name') : ''; ?>
			</div>
			<div class="form-group">
				<label for="phone">Phone Number *</label>
				<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Phone Number">
				<?php echo (form_error('phone')) ? form_error('phone') : ''; ?>
			</div>
			<div class="form-group">
				<label for="address">Address *</label>
				<textarea class="form-control" name="address" id="address" placeholder="Address"><?php echo $address; ?></textarea>
				<?php echo (form_error('address')) ? form_error('address') : ''; ?>
			</div>
			<div class="form-group">
				<label for="email">Email ID *</label>
				<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email ID">
				<?php echo (form_error('email')) ? form_error('email') : ''; ?>
			</div>
			<div class="form-group">
				<label for="logo">Logo</label>
				<div class="admin_logo">
					<div class="dz-default dz-message"><span>Drop files here to upload</span></div>
				</div>
			</div>
			<div class="mt-4">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="type" value="1">
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</form>
	</div>
</div>

<script>
	var logoList 	= new Array;
	var logoCount 	= 0;
	
	$(function(){
		dropzone(
			'.admin_logo', 
			'<?php echo base_url().'admin/profile/adminUpload'; ?>', 
			logosuccess, 
			logoremove, 
			logoList,
			logoCount,
			'<?php echo $logo; ?>'
		)
	})
	
	function logosuccess(response)
	{
		$('.admin_logo').parent().append('<input type="hidden" name="logo" value="'+response+'" class="logo">');
	}
	
	function logoremove(response, result)
	{
		$('.logo[value="'+response+'"]').remove();
		if(result!='') $('.admin_logo').parent().append('<input type="hidden" name="unlink[][logo]" value="'+result+'">');
	}
</script>