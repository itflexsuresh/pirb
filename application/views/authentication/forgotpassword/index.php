<div class="card card-login mx-auto mt-5">
	<div class="card-header">Reset Password</div>
	<div class="card-body">
		<div class="text-center mt-4 mb-5">
			<h4>Forgot your password?</h4>
			<p>Enter your email id and we will send you instructions on how to reset your password.</p>
		</div>
		<form method="post" action="">
			<div class="form-group">
				<input class="form-control" name="email" id="email" type="email" placeholder="Email ID">
				<?php echo (form_error('email')) ? form_error('email') : ''; ?>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Reset Password</button>
		</form>
		<div class="text-center">
			<a class="d-block small mt-3" href="<?php echo base_url(''); ?>">Login</a>
		</div>
	</div>
</div>