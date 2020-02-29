<div class="row add_space">
	<div class="col-sm-12">
		<?php echo $notification; ?>
	</div>
	<div class="col-sm-6 <?php if($usertype=='' || $usertype=='5' || $usertype=='6'){ echo 'offset-3';} ?>">
		<div class="card card-body">
			<h4 class="card-title">Already Registered</h4>
			<h5 class="card-subtitle"> If you are already registered please enter your login details </h5>
			<form method="post" action="<?php echo base_url().'login/'.$usertypename; ?>" class="form-horizontal mt-4 login">
				<div class="form-group">
					<label for="email">Email ID</label>
					<input class="form-control" name="email" id="email1" type="text" value="<?php echo set_value('email'); ?>" placeholder="Email ID">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" id="password1" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
				</div>
				<div class="text-center">
					<div><a href="<?php echo base_url('forgotpassword/'.$usertypename); ?>">Forgot Password</a></div>
					<?php if($usertype!=''){ ?>
						<?php if($usertype=='3'){ ?><div><a href="<?php echo base_url('login/company'); ?>">PIRB Company Login</a></div><?php } ?>		
						<?php if($usertype=='4'){ ?><div><a href="<?php echo base_url('login/plumber'); ?>">Login as PIRB Individual</a></div><?php } ?>		
					<?php } ?>					
				</div>
				<button type="submit" name="submit" value="login" class="btn btn-success">Login</button>
			</form>
		</div>
	</div>
	<?php if($usertype!='' && $usertype!='5' && $usertype!='6'){ ?>
		<div class="col-sm-6">
			<div class="card card-body">
				<?php
					if ($usertype=='4') {
						$header_title = "Company Registration with the PIRB";
						$header_title2 = "Register a Plumbing Company with the Plumbing Registration Board";
						$footer = "Register as an Individual with the PIRB"; 
						$footer2 = "Login as PIRB Individual"; 
						$pointer_title = "Why Register my Company with the PIRB?";
					}else{
						$header_title = "Individual Registration with the PIRB";
						$header_title2 = "Register as a Individaul with the Plumbing Regsitration Board";
						$footer = "Register Plumber with the PIRB"; 
						$footer2 = "PIRB Plumber Login";
						$pointer_title = "About the Registration Process";
					}
				?>
				<h4 class="card-title"><?php echo $header_title; ?></h4>
				<h5 class="card-subtitle"> <?php echo $header_title2; ?> </h5>
				<a style="cursor: pointer;"><?php echo $pointer_title; ?></a>
				<form method="post" action="<?php echo base_url().'login/'.$usertypename; ?>" class="form-horizontal mt-4 register">
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
							<div class="form-group mb_0">
								<label for="password2">Password</label>
								<input class="form-control" name="password" id="password2" type="password" placeholder="Password">

							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb_0">
								<label for="verifypassword2">Verify Password</label>
								<input class="form-control" name="verifypassword" id="verifypassword2" type="password" placeholder="Verify Password">
							</div>
						</div>
						<p>Password must be 8 to 24 characters, is case sensitive, and cannot contain spaces.</p>
					</div>
					<div class="text-center">
						<?php if($usertype=='3'){ ?><a href="<?php echo base_url('login/company'); ?>"><?php echo $footer2; ?></a><?php } ?>
						<?php if($usertype=='4'){ ?><a href="<?php echo base_url('login/plumber'); ?>"><?php echo $footer; ?></a><?php } ?>
					</div>
					<input type="hidden" value="<?php echo $usertype; ?>" name="type">
					<button type="submit" name="submit" value="register" class="btn btn-success">Register</button>
				</form>
			</div>
		</div>
	<?php } ?>
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
