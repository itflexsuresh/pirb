
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumber register</li>
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
					<h4 class="card-title">Registered Plumber Details</h4>
				</div>
				
				<div class="steps displaynone"  data-id="2">
					<form>
						<h4 class="card-title">Registered Plumber Details</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Name *</label>
									<input type="text" class="form-control"  name="company_name">
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
									<input type="text" class="form-control"  name="vat">
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
								<small style="color: red">Note all delivery services will be sent to this address</small>	
								</h4>
								
								<div class="form-group">
									<label>Physical Address *</label>
									<input type="text" class="form-control" name="phy_address">
								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title">Postal Address
</br>
								<small style="color: red">Note all delivery services will be sent to this address</small>	
								</h4>
								
								<div class="form-group">
									<label>Postal Address *</label>
									<input type="text" class="form-control" name="post_address">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="phy_suburb">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="post_suburb">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="phy_city">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="post_city">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('phy_province', $province, '',['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('post_province', $province, '',['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control" name="phy_postal">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control" name="post_postal">
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
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile Phone of Primary Contact *</label>
									<input type="text" class="form-control">
										</br>
										<small style="color: red">Note: all sms and OTP notifications will be sent to this mobile number above</small>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address *
									</label>
									<input type="text" class="form-control" name="email">
										</br>
										<small style="color: red">Note: this email will be used as your user profile name and all emails notifications will be sent to it</small>
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6">
							<h4 class="card-title">Type of work Company Undertakes</h4>
							<div class="col-md-6">
							<?php foreach ($worktype as $key => $value) {?>
								<input type="checkbox" name="<?php echo $value ?>" value="<?php echo $key ?>"><?php echo $value ?><br>
							<?php };?>
							</div>
						</div>
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
</script>

