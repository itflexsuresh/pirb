<?php
//Reseller View File

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Resellers register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Resellers register</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">				
			
					<form class="form2">
						<h4 class="card-title">Reseller Details</h4>
					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Name</label>
									<input type="text" class="form-control"  name="comapny_name"  value="<?php //echo $company_name; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Contact Person Name</label>
									<input type="text" class="form-control"  name="name"  value="<?php //echo $name; ?>">
								</div>
							</div>	
							<div class="col-md-6">	
								<div class="form-group">
									<label>Contact Person Surname *</label>
									<input type="text" class="form-control"  name="surname"  value="<?php //echo $surname; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone (Work)</label>
									<input type="text" class="form-control"  name="work_phone"  value="<?php //echo $work_phone; ?>">
								</div>
							</div>	
							<div class="col-md-6">	
								<div class="form-group">
									<label>Primary Contact Mobile Number</label>
									<input type="text" class="form-control"  name="mobile_phone"  value="<?php //echo $mobile_phone; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Primary Email</label>
									<input type="text" class="form-control"  name="email"  value="<?php //echo $email; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Physical Address</h4>
								<p class="tagline">Note all delivery services will be sent to this address</p>
								<div class="form-group">
									<label>Physical Address *</label>
									<input type="hidden" class="form-control" name="address[1][id]" value="<?php //echo $addressid1; ?>">
									<input type="hidden" class="form-control" name="address[1][type]" value="1">
									<input type="text" class="form-control" name="address[1][address]"  value="<?php // echo $address1; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title">Postal Address</h4>
								<p class="tagline">Note all postal services will be sent to this address</p>
								<div class="form-group">
									<label>Postal Address *</label>
									<input type="hidden" class="form-control" name="address[2][id]" value="<?php// echo $addressid2; ?>">
									<input type="hidden" class="form-control" name="address[2][type]" value="2">
									<input type="text" class="form-control" name="address[2][address]" value="<?php //echo $address2; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="address[1][suburb]" value="<?php // echo $suburb1; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="address[2][suburb]" value="<?php //echo $suburb2; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="address[1][city]" value="<?php // echo $city1; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="address[2][city]" value="<?php //echo $city2; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('address[1][province]', $province, $province1,['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('address[2][province]', $province, $province2,['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control" name="address[2][postal_code]" value="<?php //echo $postalcode2; ?>">
								</div>
							</div>
						</div>
						<h4 class="card-title">Invoice Details</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Name:</label>
									<input type="text" class="form-control" name="billing_name" value="<?php //echo $homephone; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Reg Number *</label>
									<input type="text" class="form-control" name="reg_num" value="<?php //echo $mobilephone; ?>">
									<p>Note all SMS and OTP notifications will be sent to this mobile number above</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Vat:</label>
									<input type="text" class="form-control" name="vat_num" value="<?php //echo $workphone; ?>">
								</div>
							</div>
						</div>
						<button type="button" id="submit2" class="btn btn-primary">Save</button>
					</form>
				</div>
				
			

			</div>
		</div>
	</div>
</div>



<script type="text/javascript">

var filepath = '<?php echo $filepath; ?>';

$(function(){
	checkstep();
	datepicker('.dob');
	datepicker('.skill_date');
	fileupload([".document_file", "./assets/uploads/plumber/<?php echo $userid; ?>/"], ['.document', '.document_image', '<?php echo base_url()."assets/uploads/plumber/".$userid; ?>']);
	
	
	validation(
		'.form2',
		{
			title : {
				required	: true,
			},
			dob : {
				required	: true,
			},
			name : {
				required	: true,
			},
			surname : {
				required	: true,
			},
			gender : {
				required	: true,
			},
			racial : {
				required	: true,
			},
			nationality : {
				required	: true,
			},
			homelanguage : {
				required	: true,
			},
			disability : {
				required	: true,
			},
			citizen : {
				required	: true,
			},
			image1 : {
				required	: true,
			},
			image2 : {
				required	: true,
			},
			registration_card : {
				required	: true,
			},
			'address[1][address]' : {
				required	: true,
			},
			'address[2][address]' : {
				required	: true,
			},
			'address[1][suburb]' : {
				required	: true,
			},
			'address[2][suburb]' : {
				required	: true,
			},
			'address[1][city]' : {
				required	: true,
			},
			'address[2][city]' : {
				required	: true,
			},
			'address[1][province]' : {
				required	: true,
			},
			'address[2][province]' : {
				required	: true,
			},
			'address[2][postal_code]' : {
				required	: true,
				number 	: true,
			},
			mobile_phone : {
				required	: true,
				maxlength: 10,
				minlength: 10,
			},
			idcard : {
				maxlength: 13,
				minlength: 13,
			},
			home_phone : {
				maxlength: 10,
				minlength: 10,
			},
			work_phone : {
				maxlength: 10,
				minlength: 10,
			}
		},
		{
			title : {
				required	: "Tittle field is required.",
			},
			name 	: {
				required	: "Name field is required."
			},
			dob : {
				required	: "DOB field is required.",
			},
			surname : {
				required	: "Surname field is required.",
			},
			gender : {
				required	: "Gender field is required.",
			},
			racial : {
				required	: "Racial field is required.",
			},
			nationality : {
				required	: "nationality field is required.",
			},
			othernationality : {
				required	: "Other nationality field is required.",
			},
			otheridcard : {
				required	: "Alternate ID Card  field is required.",
			},
			homelanguage : {
				required	: "Homelanguage field is required.",
			},
			disability : {
				required	: "Disability field is required.",
			},
			citizen : {
				required	: "Citizen field is required.",
			},
			image1 : {
				required	: "Identity Document field is required.",
			},
			image2 : {
				required	: "Photo ID field is required.",
			},
			registration_card : {
				required	: "Registration Card field is required.",
			},
			delivery_card : {
				required	: "Delivery_card field is required.",
			},
			'address[1][address]' : {
				required	: "Address  field is required.",
			},
			'address[2][address]' : {
				required	: "Address  field is required.",
			},
			'address[1][suburb]' : {
				required	: "Suburb  field is required.",
			},
			'address[2][suburb]' : {
				required	: "Suburb  field is required.",
			},
			'address[1][city]' : {
				required	: "City  field is required.",
			},
			'address[2][city]' : {
				required	: "City  field is required.",
			},
			'address[1][province]' : {
				required	: "Province  field is required.",
			},
			'address[2][province]' : {
				required	: "Province  field is required.",
			},
			'address[2][postal_code]' : {
				required	: "Postal code field is required.",
				number 	: "Numbers Only.",
			},
			mobile_phone : {
				required	: "Mobile_phone  field is required.",
				maxlength: "Please Enter 10 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			},
			email : {
				required	: "Email  field is required.",
				email       : "Please Enter Valid Mail",
				remote		: "Email already exists."
			},
			idcard : {
				maxlength: "Please Enter 13 Numbers Only.",
				minlength: "Please Enter 13 Numbers Only.",
			},
			home_phone : {
				maxlength: "Please Enter 10 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			},
			work_phone : {
				maxlength: "Please Enter 10 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			}

		}
	);

	validation(
		'.form3',
		{
			company_name : {
				required	: true,
			},
			'address[3][address]' : {
				required	: true,
			},
			'address[3][suburb]' : {
				required	: true,
			},
			'address[3][city]' : {
				required	: true,
			},
			'address[3][province]' : {
				required	: true,
			},
			'address[3][postal_code]' : {
				required	: true,
				number 	: true
			}
		},
		{
			company_name 	: {
				required	: "Billing name field is required.",
			},
			'address[3][address]' 	: {
				required	: "Address field is required.",
			},
			'address[3][suburb]' 	: {
				required	: "Suburb field is required.",
			},
			'address[3][city]' 	: {
				required	: "City field is required.",
			},
			'address[3][province]' 	: {
				required	: "province field is required.",
			},
			'address[3][postal_code]' 	: {
				required	: "Postal Code field is required.",
				number 	: "Numbers Only",
			}
		}
	);

	validation(
		'.form4',
		{
			company_details 	: {
				required	: "Please select company.",
			}
		}
	);
	
	validation(
		'.form5',
		{
			designation 		: {
				required	: true,
			},
		},
		{
			designation 		: {
				required	: "Please select designation.",
			},
			attachmenthidden 	: {
				required	: "Please add one skill.",
			},
			criminalact 		: {
				required	: "Please check skill are correct.",
			}
		},
		{
			ignore : ':hidden:not(.attachmenthidden)'
		}
	);
	
	validation(
		'.form6',
		{
			registerprocedure : {
				required	: true,
			},
			acknowledgement : {
				required	: true,
			},
			codeofconduct : {
				required	: true,
			},
			declaration : {
				required	: true,
			}
		},
		{
			registerprocedure 	: {
				required	: "Please Check registration process.",
			},
			acknowledgement 	: {
				required	: "Please Check acknowledgement.",
			},
			codeofconduct 	: {
				required	: "Please Check code of conduct.",
			},
			declaration 	: {
				required	: "Please Check declaration.",
			}
		}
	);

	validation(
		'.skillform',
		{
			skill_date : {
				required	: true,
			},
			skill_certificate : {
				required	: true,
			},
			skill_route : {
				required	: true,
			},
			skill_training : {
				required	: true,
			},
			skill_attachment : {
				required	: true,
			}
		},
		{
			skill_date 	: {
				required	: "Please Enter Skill Date.",
			},
			skill_certificate 	: {
				required	: "Please Enter Skill certificate Number.",
			},
			skill_route : {
				required	: "Please Enter Employment Status.",
			},
			skill_training : {
				required	: "Please Enter Training Provider.",
			},
			skill_attachment : {
				required	: "Choose File Please",
			}
		}
	);
})


</script>

