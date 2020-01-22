<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
	</li>
	<li class="breadcrumb-item active">Profile</li>
	<li class="breadcrumb-item active">Change Password</li>
</ol>
<div class="card mb-3">
	<div class="card-header">
		Change Password
	</div>
	<div class="card-body">
		<form method="post" action="">
			<div class="form-group">
				<label for="oldpassword">Old Password *</label>
				<input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Old Password">
				<?php echo (form_error('oldpassword')) ? form_error('oldpassword') : ''; ?>
			</div>
			<div class="form-group">
				<label for="newpassword">New Password *</label>
				<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password">
				<?php echo (form_error('newpassword')) ? form_error('newpassword') : ''; ?>
			</div>
			<div class="form-group">
				<label for="confirmnewpassword">Confirm New Password *</label>
				<input type="password" class="form-control" name="confirmnewpassword" id="confirmnewpassword" placeholder="Confirm New Password">
				<?php echo (form_error('confirmnewpassword')) ? form_error('confirmnewpassword') : ''; ?>
			</div>
			<div class="mt-4">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
</div>