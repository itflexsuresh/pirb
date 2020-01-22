<div class="card card-login mx-auto mt-5">
	<div class="card-header">Login</div>
	<div class="card-body">
		<form method="post" action="">
			<div class="form-group">
				<label for="email">Email ID</label>
				<input class="form-control" name="email" id="email" type="text" value="<?php echo set_value('email'); ?>" placeholder="Email ID">
				<?php echo (form_error('email')) ? form_error('email') : ''; ?>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input class="form-control" name="password" id="password" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
				<?php echo (form_error('password')) ? form_error('password') : ''; ?>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Login</button>
		</form>
		<div class="text-center">
			<a class="d-block small mt-3" href="<?php echo base_url('authentication/forgotpassword'); ?>">Forgot Password?</a>
		</div>
	</div>
</div>
