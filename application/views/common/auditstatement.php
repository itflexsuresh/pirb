<?php
	$id 					= isset($result['cl_id']) ? $result['cl_id'] : '';
	$cocid					= $result['id'];
	
	$logdate 				= isset($result['cl_log_date']) && $result['cl_log_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_log_date'])) : '';
	$completiondate 		= isset($result['cl_completion_date']) && $result['cl_completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_completion_date'])) : '';
	$orderno 				= isset($result['cl_order_no']) ? $result['cl_order_no'] : '';
	$name 					= isset($result['cl_name']) ? $result['cl_name'] : '';
	$address 				= isset($result['cl_address']) ? $result['cl_address'] : '';
	$street 				= isset($result['cl_street']) ? $result['cl_street'] : '';
	$number 				= isset($result['cl_number']) ? $result['cl_number'] : '';
	$provinceid 			= isset($result['cl_province']) ? $result['cl_province'] : '';
	$cityid 				= isset($result['cl_city']) ? $result['cl_city'] : '';
	$suburbid 				= isset($result['cl_suburb']) ? $result['cl_suburb'] : '';
	$contactno 				= isset($result['cl_contact_no']) ? $result['cl_contact_no'] : '';
	$alternateno 			= isset($result['cl_alternate_no']) ? $result['cl_alternate_no'] : '';
	$email 					= isset($result['cl_email']) ? $result['cl_email'] : '';
	
	$coctypeid 				= isset($result['type']) ? $result['type'] : '';
	
	if($pagetype=='action'){
		$heading 	= 'Log ';
		$actionbtn 	= '1';
	}elseif($pagetype=='view'){
		$heading 	= 'View ';
		$actionbtn 	= '0';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Report</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Report</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<form class="mt-4 form resellers" action="" method="post">
				
				<h4 class="card-title">Plumbers Details</h4>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Registration Number</label>
							<input type="text" class="form-control"  name="reg_no" id="reg_no"  value="<?php echo $reg_no; ?>">
							</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Plumbers Name and Surname</label>							
							<input type="text" class="form-control"  name="plumbername" id="plumbername"  value="<?php echo $plumbername." ".$plumbersurname; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<img src="<?php echo $base_url;?>/assets/images/pdf.png" height="100" width="100">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Phone (Work)</label>
							<input type="text" class="form-control"  name="plumberworkph" id="plumberworkph"  value="<?php echo $plumberworkph; ?>">
							</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Phone (Mobile)</label>							
							<input type="text" class="form-control"  name="plumbermobile" id="plumbermobile"  value="<?php echo $plumbermobile; ?>">
						</div>
					</div>					
				</div>
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Owners Name *</label>
							<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name of Complex/Flat (if applicable)</label>
							<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Street *</label>
							<input type="text" class="form-control" name="street" value="<?php echo $street; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Number *</label>
							<input type="text" class="form-control" name="number" value="<?php echo $number; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Province *</label>
							<?php
								echo form_dropdown('province', $province, $provinceid, ['id' => 'province', 'class'=>'form-control']);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>City *</label>
							<?php 
								echo form_dropdown('city', [], $cityid, ['id' => 'city', 'class' => 'form-control']); 
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Suburb *</label>
							<?php
								echo form_dropdown('suburb', [], $suburbid, ['id' => 'suburb', 'class'=>'form-control']);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Mobile *</label>
							<input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contactno; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Alternate Contact</label>
							<input type="text" class="form-control" name="alternate_no" id="alternate_no" value="<?php echo $alternateno; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email Address</label>
							<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
						</div>
					</div>
				</div>




				

				<div class="col-md-12 text-right">					
					<input type="hidden" name="cocid" id="cocid" value="<?php echo $cocid; ?>">	
					<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">
				</div>				
			</form>			
		</div>
	</div>
</div>



<script type="text/javascript">


$(function(){
	datepicker('.completion_date');	
	datepicker('.dateofaudit');
	// select2('#plumberstatus, #designation2, #title, #gender, #racial, #nationality, #othernationality, #homelanguage, #disability, #citizen, #registration_card, #delivery_card, #province1, #city1, #suburb1, #province2, #city2, #suburb2, #province3, #city3, #suburb3, #employment_details, #company_details, #skill_route');
	inputmask('#home_phone, #mobile_phone', 1);
	citysuburb(['#province1','#city1', '#suburb1'], ['<?php echo $city1; ?>', '<?php echo $suburb1; ?>']);
	
	
	// validation(
	// 	'.resellers',
	// 	{
			
	// 		company : {
	// 			required	: true,
	// 		},
	// 		name : {
	// 			required	: true,
	// 		},			
	// 		surname : {
	// 			required	: true,
	// 		},
	// 		mobile_phone : {
	// 			required	: true,
	// 			maxlength: 20,
	// 			minlength: 10,
	// 		},
			
	// 		home_phone : {
	// 			required	: true,
	// 			maxlength: 20,
	// 			minlength: 10,
	// 		},
	// 		password : {
	// 			required	: true,
	// 		},
	// 		company_name : {
	// 			required	: true,
	// 		},
	// 		reg_no : {
	// 			required	: true,
	// 		},
	// 		vat_no : {
	// 			required	: true,
	// 		},
	// 		coc_purchase_limit : {
	// 			required	: true,
	// 		}
	// 	},
	// 	{
			
	// 		name 	: {
	// 			required	: "Company Name field is required.",
	// 		},
	// 		name 	: {
	// 			required	: "Name field is required.",
	// 		},
	// 		surname : {
	// 			required	: "Surname field is required.",
	// 		},
	// 		mobile_phone : {
	// 			required	: "Mobile phone field is required.",
	// 			maxlength: "Please Enter 20 Numbers Only.",
	// 			minlength: "Please Enter 10 Numbers Only.",
	// 		},
	// 		email : {
	// 			required	: "Email  field is required.",
	// 			email       : "Please Enter Valid Mail",
	// 			remote		: "Email already exists."
	// 		},
	// 		home_phone : {
	// 			maxlength: "Please Enter 20 Numbers Only.",
	// 			minlength: "Please Enter 10 Numbers Only.",
	// 		},
	// 		company_name 	: {
	// 			required	: "Billing name field is required.",
	// 		},
	// 		password 	: {
	// 			required	: "Password field is required.",
	// 		},
	// 		reg_no 	: {
	// 			required	: "Company Reg Number field is required.",
	// 		},
	// 		vat_no 	: {
	// 			required	: "Company Vat field is required.",
	// 		},
	// 		coc_purchase_limit 	: {
	// 			required	: "Purchase number field is required.",
	// 		}
	// 	},
	// 	{
	// 		ignore : '.test',
	// 	}
	// );


	$('#submit').click(function(e){
		
		if($('form.resellers').valid()==false){
			accord = $('.error_class_1').parents('.collapse').addClass('show');			
		}
		
	})


});


</script>

<style type="text/css">
.progress-circle span {
    display: none;
}
</style>