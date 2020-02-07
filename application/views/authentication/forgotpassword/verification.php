<div class="row add_space">
	<div class="col-sm-6 offset-sm-3">
		<?php echo $notification; ?>
	</div>
	<div class="col-sm-6 offset-sm-3">
		<div class="card card-body">
			<h4 class="card-title">Forgot Password</h4>
			<form method="post" action="" class="form-horizontal mt-4 form">
				<div class="form-group">
					<label for="newpassword">New Password *</label>
					<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password">
				</div>
				<div class="form-group">
					<label for="confirmnewpassword">Confirm New Password *</label>
					<input type="password" class="form-control" name="confirmnewpassword" id="confirmnewpassword" placeholder="Confirm New Password">
				</div>
				<div class="text-center">
					<div><a href="<?php echo base_url('login/'.$usertypename); ?>">Already have an account?</a></div>
				</div>
				<button type="submit" name="submit" class="btn btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>

	
<script>
	$(function(){
		validation(
			'.form',
			{
				newpassword 			: {
					required	: true,
					minlength	: 5
				},
				confirmnewpassword 		: {
					required	: true,
					equalTo		: "#newpassword"
				}
			},
			{
				newpassword 			: {
					required	: "New Password field is required.",
					minlength	: "New Password must be minium 5 character.."
				},
				confirmnewpassword 		: {
					required	: "Confirm Password field is required.",
					equalTo		: "New Password is not matched."
				}
			}
		);
	});
</script>
