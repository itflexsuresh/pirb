<div class="row add_space">
	<div class="col-sm-12">
		<?php echo $notification; ?>
	</div>
	<div class="col-sm-6">
		<div class="card card-body">
			<h4 class="card-title">Already Registered</h4>
			<h5 class="card-subtitle"> If you are already registered please enter your login details </h5>
			<form method="post" action="" class="form-horizontal mt-4 login">
				<div class="form-group">
					<label for="email">Email ID</label>
					<input class="form-control" name="email" id="email1" type="text" value="<?php echo set_value('email'); ?>" placeholder="Email ID">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" id="password1" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
				</div>
				<div class="text-center">
					<div><a href="<?php echo base_url('authentication/forgotpassword'); ?>">Forgot Password</a></div>
					<div><a href="javascript:void(0);">PIRB Company Login</a></div>					
				</div>
				<button type="submit" name="submit" value="login" class="btn btn-success">Login</button>
			</form>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card card-body">
			<h4 class="card-title">Individual Registration with the PIRB</h4>
			<h5 class="card-subtitle"> Register as a Individaul with the Plumbing Regsitration Board </h5>
			<a style="cursor: pointer;">About the Registration Process</a>
			<form method="post" action="" class="form-horizontal mt-4 register">
				<div class="form-group">
					<label for="email2">Email ID</label>
					<input class="form-control" name="email" id="email2" type="text" placeholder="Email ID">
				</div>
				<div class="form-group">
					<label for="verifyemail2">Verify Email ID</label>
					<input class="form-control" name="verifyemail" id="verifyemail2" type="text" placeholder="Verify Email ID">
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="password2">Password</label>
							<input class="form-control" name="password" id="password2" type="password" placeholder="Password">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="verifypassword2">Verify Password</label>
							<input class="form-control" name="verifypassword" id="verifypassword2" type="password" placeholder="Verify Password">
						</div>
					</div>
				</div>
				<div class="text-center">
					<a href="javascript:void(0)">Register Company with the PIRB</a>
				</div>
				<button type="submit" name="submit" value="register" class="btn btn-success">Register</button>
			</form>
		</div>
	</div>
</div>

	
<script>
	$(function(){
		validation(
			'.login',
			{
				email 		: {
					required	: true
				},
				password 	: {
					required	: true
				}
			},
			{
				email 		: {
					required	: "Email field is required."
				},
				password 	: {
					required	: "Password field is required."
				}
			}
		);
		
		validation(
			'.register',
			{
				email 				: {
					required	: true,
					email		: true,
					remote		: 	{
										url	: "<?php echo base_url().'authentication/login/emailvalidation'; ?>",
										type: "post",
										data: {
											email: function() {
												return $( "#email2" ).val();
											}
										}
									}
				},
				verifyemail 		: {
					required	: true,
					equalTo		: "#email2"
				},
				password 			: {
					required	: true,
					minlength	: 5
				},
				verifypassword 		: {
					required	: true,
					equalTo		: "#password2"
				}
			},
			{
				email 				: {
					required	: "Email field is required.",
					email		: "Enter Valid Email Address.",
					remote		: "Email already exists."
				},
				verifyemail 		: {
					required	: "Verify Email field is required.",
					equalTo		: "Email is not matched."
				},
				password 			: {
					required	: "Password field is required.",
					minlength	: "Password must be minium 5 character.."
				},
				verifypassword 		: {
					required	: "Verify Password field is required.",
					equalTo		: "Password is not matched."
				}
			}
		);
		
	});
</script>
