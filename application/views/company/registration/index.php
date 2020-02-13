<!-- Company front view file -->
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Company register</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-md-12">
					<a href="javascript:void(0);" id="previous">Previous</a>
					<a href="javascript:void(0);" id="next">Next</a>
				</div>
				
				<div class="steps active" data-id="1">
					<h4 class="card-title">Registered Company Details</h4>
				</div>
				
				<div class="steps displaynone"  data-id="2">
					<form class="form" method="post" action="">
						<h4 class="card-title">Registered Company Details</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Name *</label>
									<input type="text" class="form-control"  name="name">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Registration Number *</label>
									<input type="text" class="form-control"  name="reg_num">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>VAT Number</label>
									<input type="text" class="form-control"  name="vat_num">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Primary Contact Person *</label>
									<input type="text" class="form-control"  name="contact">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Physical Address</br>
								<small class="tagline">Note all delivery services will be sent to this address</small>	
								</h4>
								
								<div class="form-group">
									<label>Physical Address *</label>
									<input type="text" class="form-control" name="address[1][address]">
								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title">Postal Address
</br>
								<small class="tagline">Note all delivery services will be sent to this address</small>	
								</h4>
								
								<div class="form-group"> 
									<label>Postal Address *</label>
									<input type="text" class="form-control" name="address[2][address]">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="address[1][suburb]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="address[2][suburb]">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="address[1][city]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="address[2][city]">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('address[1][province]', $province, '',['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('address[2][province]', $province, '',['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- <div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control" name="address[1][postal_code]">
									</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control" name="address[2][postal_code]">
									</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6">
								<h4 class="card-title">Contact Details:</h4>

						</div>
						</div>
						<div class="row">
							
							<div class="col-md-6">
								<div class="form-group">
									<label>Work Phone:</label>
									<input type="text" class="form-control" name="work_phone">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile Phone of Primary Contact *</label>
									<input type="text" class="form-control"  name="primary_phone">
										</br>
										<small class="tagline">Note: all sms and OTP notifications will be sent to this mobile number above</small>
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address *
									</label>
									<input type="text" class="form-control" name="email_address">
										</br>
										<small class="tagline">Note: this email will be used as your user profile name and all emails notifications will be sent to it</small>
								</div>
							</div>
						</div> -->
						<div class="row">
						<div class="col-md-6">
							<h4 class="card-title">Type of work Company Undertakes</h4>
							<div class="col-md-6">
							<?php foreach ($worktype as $key => $value) {?>
								<input type="checkbox" name="worktype[]" value="<?php echo $key ?>"> <?php echo $value ?><br>
							<?php };?>
							</div>
						</div>
						<div class="col-md-6">
							<h4 class="card-title">Specilisations</h4>
							<div class="col-md-6">
							<?php foreach ($specialization as $key => $value) {?>
								<input type="checkbox" name="specilisations[]" value="<?php echo $key ?>"> <?php echo $value ?><br>
							<?php };?>
								
							</div>
						</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="user_id" value="<?php if(isset($id)) echo $id ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
	checkstep();
})

$('#next').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))+1;		
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	checkstep();
})

$('#previous').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))-1;
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	checkstep();
})

function checkstep(){
	$('#next, #previous').removeClass('displaynone');
	
	var step = $('.steps.active').attr('data-id');
		
	if(step=='1'){
		$('#previous').addClass('displaynone');
	}else if(step=='2'){
		$('#next').addClass('displaynone');
	}
}
	$(function(){

			validation(
				'.form',
				{				
					name : {
						required	: true,
					},
					vat_num : {
						number: true,
					},
					reg_num : {
						required	: true,
						number: true,
					},
					'address[1][address]' : {
						required	: true,
					},
					'address[1][suburb]' : {
						required	: true,
					},
					'address[1][city]' : {
						required	: true,
					},
					phy_province : {
						required	: true,
					},
					'address[2][address]' : {
						required	: true,
					},
					'address[2][suburb]' : {
						required	: true,
					},
					'address[2][city]' : {
						required	: true,
					},
					post_province : {
						required	: true,
					},
					'address[2][postal_code]' : {
						required	: true,
						number: true,
					},
					primary_phone : {
						required	: true,
						number: true,
						minlength: 10,
						maxlength: 10,
					},
					contact : {
						required	: true,
					},
					email_address : {
						required	: true,
						email: true,
					},
					work_phone : {
						number: true,
						minlength:  10,
						maxlength:  10,
					},
				},
				{				
					name : {
						required	: "Name field is required."
					},
					reg_num :{
						required	: "Registration Number is required.",
						number: "Enter Numbers Only",
					},
					'address[1][address]' : {
						required	: "Physical Address field is required.",
					},
					'address[1][suburb]' : {
						required	: "Suburb field is required.",
					},
					'address[1][city]' : {
						required	: "City field is required.",
					},
					phy_province : {
						required	: "Province field is required.",
					},
					'address[2][address]' : {
						required	: "Postal Address field is required.",
					},
					'address[2][suburb]' : {
						required	: "Suburb field is required.",
					},
					'address[2][city]' : {
						required	: "City field is required.",
					},
					'address[2][postal_code]' : {
						required	: "Postal Code field is required.",
						number: "Enter Numbers Only",
					},
					primary_phone : {
						required	: "Primary Contact Number field is required.",
						number: "Enter Numbers Only",
						minlength: "Enter 10Digits Only.",
						maxlength: "Enter 10Digits Only.",
					},
					contact : {
						required	: "Primary Contact field is required.",
					},
					email_address : {
						required	: "Email field is required.",
						email: "Please Enter Valid Email.",
					},
					vat_num : {
						number: "Enter Numbers Only.",
					},
					work_phone : {
						number: "Enter Numbers Only.",
						minlength:  "Enter 10Digits Only.",
						maxlength:  "Enter 10Digits Only.",
					},
				}
				);

	
	});


</script>

