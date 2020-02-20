<?php
// print_r($result);
$base_url = base_url();
$cocid 			= isset($result['cocid']) ? $result['cocid'] : '';
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
$workmanship 				= isset($result['workmanship']) ? $result['workmanship'] : '';
$plumberpresent 				= isset($result['plumberpresent']) ? $result['plumberpresent'] : '';
$completed 				= isset($result['completed']) ? $result['completed'] : '';

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
					<div class="col-md-6">
						<div class="form-group">
							<h4 class="card-title">COC Details</h4>
							<a href="#"><h4 class="card-title">View COC Details in full</h4></a>							
						</div>
					</div>
				</div>

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
							<!-- <div class="input-group-append">
								<span class="input-group-text"><i class="icon-calender"></i></span>
							</div> -->
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
						<div class="form-group">
							<label>Audit Status</label>
							<input type="text" class="form-control"  name="auditstatus" id="auditstatus"  value="<?php echo $auditstatus; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Auditors Name and Surname</label>
							<input type="text" class="form-control"  name="auditorname" id="auditorname"  value="<?php echo $auditorname.' '.$auditorsurname; ?>">
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone (Mobile)</label>
							<input type="text" class="form-control"  name="auditorphone" id="auditorphone"  value="<?php echo $auditorphone; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Date of Audit</label>
							<input type="text" class="form-control"  name="dateofaudit" id="dateofaudit"  value="<?php echo $dateofaudit; ?>">
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Overall Workmanship</label>
							<input type="text" class="form-control"  name="workmanship" id="workmanship"  value="<?php echo $workmanship; ?>">
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Licensed Plumber Present</label>
							<input type="text" class="form-control"  name="plumberpresent" id="plumberpresent"  value="<?php echo $plumberpresent; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">		
							<a  href="#" ><img src="<?php echo $base_url;?>/assets/images/pdf.png" height="100" width="100">Audit Report
							</a>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Was COC Completed Correctly</label>
							<input type="text" class="form-control"  name="completed" id="completed"  value="<?php echo $completed; ?>">
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