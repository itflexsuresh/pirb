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
									<label>Title *</label>
									<?php
										echo form_dropdown('title', $titlesign, '', ['id'=>'title', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Date of Birth *</label>
									<input type="text" class="form-control dob" name="dob">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name *</label>
									<input type="text" class="form-control"  name="name">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Surname *</label>
									<input type="text" class="form-control"  name="surname">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<?php
										echo form_dropdown('gender', $gender, '', ['id'=>'gender', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Racial Status *</label>
									<?php
										echo form_dropdown('racial', $racial, '',['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>South African National *</label>
									<?php
										echo form_dropdown('nationality', $yesno, '',['class'=>'form-control']);
									?>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ID Number</label>
									<input type="text" class="form-control" name="idcard">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Other Nationality *</label>
									<input type="text" class="form-control" name="othernationality">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Alternate ID</label>
									<input type="text" class="form-control" name="otheridcard">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Language *</label>
									<?php
										echo form_dropdown('homelanguage', $homelanguage, '', ['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Disability *</label>
									<?php
									echo form_dropdown('disability', $disability, '',['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Citizen Residential Status *</label>
									<?php
									echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Identity Dcoument *</h4>
								<div class="form-group">
									<div>
										<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="document_image" width="100">
									</div>
									<input type="file" class="document_file">
									<input type="hidden" name="document" class="document">
								</div>
							</div>
						</div>

						<h4 class="card-title">Registration Card</h4>
						<h6 class="card-subtitle">Due to the high number of card returns and cost incurred the registration fees do not include a registration card. Registration cards are available but must be requested separately.  If registration card is selected you will be billed accordingly.</h6>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Registration Card Required *</label>
									<?php
									echo form_dropdown('registration_card', $yesno, '',['class'=>'form-control']);
									?>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Method of Delivery of Card *</label>
									<?php
									echo form_dropdown('delivery_card', $deliverycard, '',['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Physical Address</h4>
								<div class="form-group">
									<label>Physical Address *</label>
									<input type="text" class="form-control" name="phy_address">
								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title">Postal Address</h4>
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
									<input type="text" class="form-control">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Phone:</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile Phone *</label>
									<input type="text" class="form-control">
								</div>
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
									<label>Email Address *</label>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="3">
					<form>
						<h4 class="card-title">Billing Details</h4>
						<h6 class="card-subtitle">All invocies genreated will used this billing information.</h6>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Name *</label>
									<input name="name" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Reg Number</label>
									<input name="number" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Vat</label>
									<input name="vat" type="text" class="form-control">
								</div>
							</div>                            
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Address *</label>
									<input type="text" name="address" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input name="suburb" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input name="city" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('province', $province, '',['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input name="postal_code" type="text" class="form-control">
								</div>
							</div>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone"  data-id="4">
					<form>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Employment Details</h4>
								<div class="form-group">
									<label>Your Employment Status</label>
									<?php
									echo form_dropdown('employment_details', $employmentdetail, '',['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Company Details</h4>
								<div class="form-group">
									<label>Company</label>
									<?php
									echo form_dropdown('company_details', $empty_arr, '',['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone"  data-id="5">
					<form>
						<h4 class="card-title">Designation</h4>
						<h6 class="card-subtitle">Applications for Master Plumber and or specialisations can only be done once your registration has been verified and approved. See Application for further designations/specializations</h6>
						<h6 class="card-subtitle">Please select the relevant designation being applied for.</h6>                    	

						<div class="row">
							<div class="col-md-12 text-right">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit Application</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="6">
				</div>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
	datepicker('.dob');
	checkstep();
	fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".document_file", "./assets/uploads/temp/"], ['.document', '.document_image', '<?php echo base_url()."assets/uploads/temp"; ?>']);
})

$('#next').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))+1;
	
	if($('.steps.active form').length){
		ajax('<?php echo base_url()."/plumber/registration/index/ajaxregistration"; ?>', $('.steps.active form').serialize(), registration);
	}
	
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
	}else if(step=='6'){
		$('#next').addClass('displaynone');
	}
}

function registration(data){
	if(data.status=='0'){
		alert('Try Later');
	}
}
</script>

