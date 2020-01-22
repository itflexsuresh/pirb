<div class="card card-login mx-auto mt-5">
	<div class="card-header">Reset Password</div>
	<div class="card-body">
		<form method="post" action="">
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
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</form>
	</div>
</div>