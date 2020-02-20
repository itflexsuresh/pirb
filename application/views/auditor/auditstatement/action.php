<?php
// print_r($result);
$base_url = base_url();
$cocid 			= isset($result['cocid']) ? $result['cocid'] : '';
$reg_no 				= isset($result['reg_no']) ? $result['reg_no'] : '';
$plumbername 				= isset($result['plumbername']) ? $result['plumbername'] : '';
$plumbersurname 				= isset($result['plumbersurname']) ? $result['plumbersurname'] : '';
$plumberworkph 				= isset($result['plumberworkph']) ? $result['plumberworkph'] : '';
$plumbermobile 				= isset($result['plumbermobile']) ? $result['plumbermobile'] : '';

$userid 			= isset($result['userid']) ? $result['userid'] : '';
$certificateid 			= isset($result['certificateid']) ? $result['certificateid'] : '';
$completion_date 				= isset($result['completion_date']) ? $result['completion_date'] : '';	
$ownername 				= isset($result['name']) ? $result['name'] : '';

$contact_no 				= isset($result['contact_no']) ? $result['contact_no'] : '';	
$alternate_no 				= isset($result['alternate_no']) ? $result['alternate_no'] : '';	
$auditstatus1 				= isset($result['auditstatus']) ? $result['auditstatus'] : '';
$auditstatus 				= $this->config->item('auditstatus')[$auditstatus1];	
$auditorname 				= isset($result['auditorname']) ? $result['auditorname'] : '';	
$auditorsurname 				= isset($result['auditorsurname']) ? $result['auditorsurname'] : '';	
$auditorphone 				= isset($result['auditorphone']) ? $result['auditorphone'] : '';
$dateofaudit 				= isset($result['dateofaudit']) ? $result['dateofaudit'] : '';
$workmanship1 				= isset($result['workmanship']) ? $result['workmanship'] : '';
$plumberpresent 				= isset($result['plumberpresent']) ? $result['plumberpresent'] : '';
$wascompleted 				= isset($result['wascompleted']) ? $result['wascompleted'] : '';
$audithold 				= isset($result['audithold']) ? $result['audithold'] : '';
$whyaudithold 				= isset($result['whyaudithold']) ? $result['whyaudithold'] : '';


$consumeraddress 		= isset($result['consumeraddress']) ? explode('@-@', $result['consumeraddress']) : [];
$addressid1 			= isset($consumeraddress[0]) ? $consumeraddress[0] : '';
$address1				= isset($consumeraddress[2]) ? $consumeraddress[2] : '';
$suburb1 				= isset($consumeraddress[3]) ? $consumeraddress[3] : '';
$city1 					= isset($consumeraddress[4]) ? $consumeraddress[4] : '';
$province1 				= isset($consumeraddress[5]) ? $consumeraddress[5] : '';
$street1 				= isset($consumeraddress[6]) ? $consumeraddress[6] : '';
$number1				= isset($consumeraddress[7]) ? $consumeraddress[7] : '';

 
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
				<div class="row">
					<h4 class="card-title">Plumbers Details</h4>
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
				</div>
				<div class="row">
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
														
						</div>
					</div>
				</div>

				<h4 class="card-title">COC Details</h4>
				<a href="#"><h4 class="card-title">View COC Details in full</h4></a>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Certificate No</label>
							<input type="text" class="form-control"  name="certificateid" id="certificateid"  value="<?php echo $certificateid; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Plumbing Work Completion Date</label>							
							<input type="text" autocomplete="off" class="form-control completion_date" name="completion_date" data-date="datepicker" value="<?php if(isset($completion_date)){ echo $completion_date; }?>">
							<div class="input-group-append">
								<span class="input-group-text"><i class="icon-calender"></i></span>
							</div>
						</div>
					</div>
				</div>

				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Owners Name</label>
							<input type="text" class="form-control"  name="ownername" id="ownername"  value="<?php echo $ownername; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name of Complex/Flat (if applicable)</label>
							<input type="text" class="form-control"  name="address[1][address]" id="address1"  value="<?php echo $address1; ?>">
							</div>
					</div>
				</div>

				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Street</label>
							<input type="text" class="form-control"  name="address[1][street]" id="street1" value="<?php echo $street1; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Number</label>
							<input type="text" class="form-control" name="address[1][number]"  id="number1"  value="<?php echo $number1; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Province</label>							
							<?php 
								echo form_dropdown('address[1][province]', $province, $province1, ['id' => 'province1', 'class' => 'form-control']); 
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>City</label>
							<?php 
								echo form_dropdown('address[1][city]', [], $city1, ['id' => 'city1', 'class' => 'form-control']); 
							?>							
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Suburb</label>
							<?php
								echo form_dropdown('address[1][suburb]', [], $suburb1, ['id' => 'suburb1', 'class'=>'form-control']);
							?>
						</div>
					</div>	
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Mobile</label>
							<input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contact_no; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Alternate Contact</label>
							<input type="text" class="form-control" name="alternate_no" id="alternate_no" value="<?php echo $alternate_no; ?>">
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h4 class="card-title">Audit Review</h4>							
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label>Date of Audit</label>							
						<input type="text" autocomplete="off" class="form-control dateofaudit" name="dateofaudit" data-date="datepicker" value="<?php echo $dateofaudit; ?>">
						<div class="input-group-append">
							<span class="input-group-text"><i class="icon-calender"></i></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">							
							<input type="radio" class=""  name="audithold" id="audithold"  value="<?php echo $audithold; ?>">
							<label>Place Audit on hold</label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Overall Workmanship</label>
							<?php
								echo form_dropdown('workmanship', $workmanship, $workmanship1, ['id' => 'workmanship', 'class'=>'form-control']);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Why was Audit placed on hold?</label>	
							<textarea class="form-control"  name="whyaudithold" id="whyaudithold" rows="4" cols="50"><?php echo $whyaudithold; ?></textarea>			
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Licensed Plumber Present</label>
							<?php
								echo form_dropdown('plumberpresent', $yesno, $plumberpresent, ['id' => 'plumberpresent', 'class'=>'form-control']);
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Was COC Completed Correctly</label>
							<?php
								echo form_dropdown('wascompleted', $yesno, $wascompleted, ['id' => 'wascompleted', 'class'=>'form-control']);
							?>
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