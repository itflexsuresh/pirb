<?php
	$id						= $result['id'];
	$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
	$userscompanyid 		= isset($result['userscompanyid']) ? $result['userscompanyid'] : '';
	
	$email 					= isset($result['email']) ? $result['email'] : '';
	$email2 				= isset($result['email2']) ? $result['email2'] : '';
	$createdat 				= isset($result['created_at']) ? $result['created_at'] : '';
	
	$company 				= isset($result['company']) ? $result['company'] : '';
	$reg_no 				= isset($result['reg_no']) ? $result['reg_no'] : '';
	$vat_no 				= isset($result['vat_no']) ? $result['vat_no'] : '';
	$contact_person 		= isset($result['contact_person']) ? $result['contact_person'] : '';
	$mobilephone 			= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';
	$mobile_phone2 			= isset($result['mobile_phone2']) ? $result['mobile_phone2'] : '';
	$workphone 				= isset($result['work_phone']) ? $result['work_phone'] : '';
	$home_phone 			= isset($result['home_phone']) ? $result['home_phone'] : '';
	$companystatusid 		= isset($result['status']) ? $result['status'] : '';
	
	$physicaladdress 		= isset($result['physicaladdress']) ? explode('@-@', $result['physicaladdress']) : [];
	$addressid1 			= isset($physicaladdress[0]) ? $physicaladdress[0] : '';
	$address1				= isset($physicaladdress[2]) ? $physicaladdress[2] : '';
	$suburb1 				= isset($physicaladdress[3]) ? $physicaladdress[3] : '';
	$city1 					= isset($physicaladdress[4]) ? $physicaladdress[4] : '';
	$province1 				= isset($physicaladdress[5]) ? $physicaladdress[5] : '';
	$postalcode1 			= isset($physicaladdress[6]) ? $physicaladdress[6] : '';
	
	$postaladdress 			= isset($result['postaladdress']) ? explode('@-@', $result['postaladdress']) : [];
	$addressid2 			= isset($postaladdress[0]) ? $postaladdress[0] : '';
	$address2				= isset($postaladdress[2]) ? $postaladdress[2] : '';
	$suburb2 				= isset($postaladdress[3]) ? $postaladdress[3] : '';
	$city2 					= isset($postaladdress[4]) ? $postaladdress[4] : '';
	$province2 				= isset($postaladdress[5]) ? $postaladdress[5] : '';
	$postalcode2 			= isset($postaladdress[6]) ? $postaladdress[6] : '';
	
	$work_type 				= isset($result['work_type']) ? array_filter(explode(',', $result['work_type'])) : [];
	$specialisations 		= isset($result['specialisations']) ? array_filter(explode(',', $result['specialisations'])) : [];
	
	$message 				= isset($result['message']) ? $result['message'] : '';
	$approval_status 		= isset($result['approval_status']) ? $result['approval_status'] : '0';
	$reject_reason 			= isset($result['reject_reason']) ? explode(',', $result['reject_reason']) : [];
	$reject_reason_other 	= isset($result['reject_reason_other']) ? $result['reject_reason_other'] : '';	
	
	if($roletype=='4' && $approval_status=='0'){
		$disabled1 			= 'disabled';
		$disabled1array 	= ['disabled' => 'disabled'];
		$disabled2 			= '';
		$disabled2array 	= [];
		
		$disablebtn			= '1';
	}elseif($roletype=='4' && $approval_status=='1'){
		$disabled1 			= '';
		$disabled1array 	= [];
		$disabled2 			= 'disabled';
		$disabled2array 	= ['disabled' => 'disabled'];
	}elseif($roletype=='4' && $approval_status=='2'){
		$disabled1 			= 'disabledrej';
		$disabled1array 	= ['disabled' => 'disabled'];
		$disabled2 			= '';
		$disabled2array 	= [];
		
		$disablebtn			= '1';
	}else{
		$disabled1 			= '';
		$disabled1array 	= [];
		$disabled2 			= '';
		$disabled2array 	= [];
	}
	
	if($roletype=='1'){
		$dynamictabtitle 	= 'Plumbers';
		$dynamicheading 	= 'Plumber Register';
		$dynamictitle 		= 'Plumbers Registration Details';
	}elseif($roletype=='3'){
		$dynamictabtitle 	= 'My';
		$dynamicheading 	= 'My Profile';
		$dynamictitle 		= 'My PIRB Registration Details';
	}
?>


<?php if($pagetype!='registration'){ ?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Company Details</li>
			</ol>
		</div>
	</div>
</div>

<?php echo $notification; ?>

<h5 class="card-title app_status">Application Status:</h5>
<?php if($roletype=='1' && ($approval_status=='0' || $approval_status=='2')){ ?>
	<form class="form1" method="post">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label>Approval Status *</label>
										</div>
										<?php
											foreach($approvalstatus as $key => $value){
										?>
												<div class="col-md-3">
													<div class="custom-control custom-radio">
														<input type="radio" name="approval_status" id="<?php echo $key.'-'.$value; ?>" class="custom-control-input approvalstatus" value="<?php echo $key; ?>" <?php echo ($key==$approval_status) ? 'checked="checked"' : ''; ?>>
														<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
													</div>
												</div>
										<?php
											}
										?>
									</div>
								</div>
								<div class="form-group reject_wrapper displaynone">
									<div class="row">
										<div class="col-md-6">
											<label>Reason for Rejection</label>
										</div>
										<div class="col-md-6">
											<?php
												foreach ($companyrejectreason as $key => $value) {
											?>
													<div class='custom-control custom-checkbox'>
														<input type='checkbox' class='custom-control-input reject_reason' name='reject_reason[]' id="<?php echo $key.'-'.$value; ?>" value="<?php echo $key; ?>" <?php echo (in_array($key, $reject_reason)) ? 'checked="checked"' : ''; ?>>
														<label class='custom-control-label' for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
													</div>
											<?php
												}
											?>
											<div class="form-group reject_reason_other_wrapper displaynone">
												<input type="text" class="form-control" placeholder="If Other specify" name="reject_reason_other" value="<?php echo $reject_reason_other; ?>">		
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Comments</label>
									<div id="commentdisplay">
										<?php
											foreach($comments as $comment){
										?>
												<p><?php echo date('d-m-Y', strtotime($comment['created_at'])).' '.$comment['createdby'].' '.$comment['comments']; ?></p>
										<?php
											}
										?>
									</div>
									<input type="text" class="form-control" placeholder="Type your comments here" name="comments">		
									<div class="text-right">
										<input type="hidden" name="usersdetailid" value="<?php echo $usersdetailid; ?>">										
										<input type="hidden" name="userscompanyid" value="<?php echo $userscompanyid; ?>">
										<button type="submit" name="submit" value="approvalsubmit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</div>
						</div>
				
					</div>
				</div>
			</div>
		</div>
	</form>
<?php } ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">			
<?php } ?>			
				<form class="form" id="reg_forms" method="post" action="">					
					<?php if(($roletype=='1' && $approval_status=='1') || ($pagetype!='registration' && $roletype=='4' && $result['formstatus'] !='0')){ ?>
						<div class="col-md-12 application_field_wrapper mb-15">
							<?php if($disabled1=='disabled'){ ?>
								<div class="application_field_status">
									<p>Application Pending</p>
								</div>
							<?php } ?>
							<?php if($disabled1=='disabledrej'){ ?>
								<div class="application_field_status">
									<p>Application Rejected</p>
								</div>
							<?php } ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>PIRB Company ID</label>
										<input type="text" class="form-control" value="<?php echo $id; ?>" disabled>						
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Registration Date</label>
										<input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($createdat)); ?>" disabled>						
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Status</label>
										<?php
											echo form_dropdown('companystatus', $companystatus, $companystatusid, ['id' => 'companystatus', 'class'=>'form-control']+$disabled2array);
										?>
									</div>
								</div>
								<div class="col-md-12">
									<label>Specific Message to Company</label>
									<textarea class="form-control" rows="5" name="message" <?php echo $disabled2; ?>><?php echo $message; ?></textarea>
								</div>
							</div>					
						</div>
					<?php } ?>
					
					<h4 class="card-title">Company Details</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Name *</label>
								<input type="text" class="form-control" id="name" name="name" value="<?php echo $company; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Registration Number *</label>
								<input type="text" class="form-control" id="reg_no" name="reg_no" value="<?php echo $reg_no; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>VAT Number</label>
								<input type="text" class="form-control" id="vat_no" name="vat_no" value="<?php echo $vat_no; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Primary Contact Person *</label>
								<input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo $contact_person; ?>">
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4 class="card-title">Physical Address</h4>
							<p class="tagline">Note all delivery services will be sent to this address</p>
							<div class="form-group">
								<label>Physical Address *</label>
								<input type="hidden" class="form-control" name="address[1][id]" value="<?php echo $addressid1; ?>">
								<input type="hidden" class="form-control" name="address[1][type]" value="1">
								<input type="text" class="form-control" id="physicallsaddr" name="address[1][address]"  value="<?php echo $address1; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<h4 class="card-title">Postal Address</h4>
							<p class="tagline">Note all postal services will be sent to this address</p>
							<div class="form-group">
								<label>Postal Address *</label>
								<input type="hidden" class="form-control" name="address[2][id]" value="<?php echo $addressid2; ?>">
								<input type="hidden" class="form-control" name="address[2][type]" value="2">
								<input type="text" class="form-control" id="postalarrs" name="address[2][address]" value="<?php echo $address2; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">								
							<div class="form-group"> 
								<label>Province *</label>
								<?php 
									echo form_dropdown('address[1][province]', $province, $province1, ['id' => 'province1', 'class' => 'form-control']); 
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Province *</label>
								<?php
									echo form_dropdown('address[2][province]', $province, $province2, ['id' => 'province2', 'class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<?php 
									echo form_dropdown('address[1][city]', [], $city1, ['id' => 'city1', 'class' => 'form-control']); 
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<?php 
									echo form_dropdown('address[2][city]', [], $city2, ['id' => 'city2', 'class' => 'form-control']); 
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<?php
									echo form_dropdown('address[1][suburb]', [], $suburb1, ['id' => 'suburb1', 'class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<?php
									echo form_dropdown('address[2][suburb]', [], $suburb2, ['id' => 'suburb2', 'class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 offset-6">
							<div class="form-group">
								<label>Postal Code *</label>
								<input type="text" class="form-control" id="postaladdrcomp" name="address[2][postal_code]" value="<?php echo $postalcode2; ?>">
							</div>
						</div>
					</div>
					<h4 class="card-title">Contact Details</h4>
					<div class="row">
						<?php if ($pagetype!='registration') { ?>
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Phone:</label>
									<input type="text" class="form-control" name="home_phone" id="home_phone" value="<?php echo $home_phone; ?>">
								</div>
							</div>
						<?php } ?>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Work Phone:</label>
								<input type="text" class="form-control" name="work_phone" id="work_phone" value="<?php echo $workphone; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<?php if ($pagetype=='registration') {
									$mobile_lable = "Mobile Phone of Primary Contact*:";
								}else{
									$mobile_lable = "Mobile Phone*:";
								}
								?>
								<label><?php echo $mobile_lable; ?></label>
								<input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="<?php echo $mobilephone; ?>">
								<p>Note all SMS and OTP notifications will be sent to this mobile number above</p>
							</div>
						</div>
						<?php if ($pagetype!='registration') { ?>
							<div class="col-md-6">
								<div class="form-group">
									<label>Secondary Mobile Phone:</label>
									<input type="text" class="form-control" name="secondary_phone" id="secondary_phone" value="<?php echo $mobile_phone2; ?>">
								</div>
							</div>
						<?php } ?>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email Address *</label>
								<input type="text" class="form-control" value="<?php echo $email; ?>" readonly>
								<p>Note: this email will be used as your user profile name and all emails notifications will be sent to it</p>
							</div>
						</div>
						<?php if ($pagetype!='registration') { ?>
							<div class="col-md-6">
								<div class="form-group">
									<label>Secondary Email Address:</label>
									<input type="text" class="form-control" name="email" id="email" value="<?php echo $email2; ?>">
								</div>
							</div>
						<?php } ?>
					</div>					
					<div class="row">
						<div class="col-md-6">
							<h4 class="card-title">Type of work Company Undertakes</h4>
							<div class="col-md-6">
							<?php foreach ($worktype as $key => $value) {?>
								<input type="checkbox" name="worktype[]" value="<?php echo $key ?>"<?php echo (in_array($key, $work_type)) ? 'checked="checked"' : ''; ?> > <?php echo $value ?><br>
							<?php };?>
							</div>
						</div>
						<div class="col-md-6">
							<h4 class="card-title">Specialisations</h4>
							<div class="col-md-6">
							<?php foreach ($specialization as $key => $value) { 
								?>
								<input type="checkbox" name="specilisations[]" value="<?php echo $key ?>"<?php echo (in_array($key, $specialisations)) ? 'checked="checked"' : ''; ?>> <?php echo $value ?><br>
							<?php }; ?>
								
							</div>
						</div>
					</div>
					<div class="col-md-6 text-right">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="user_id" value="<?php echo $id; ?>">
						<input type="hidden" name="usersdetailid" value="<?php echo $usersdetailid; ?>">
						<input type="hidden" name="userscompanyid" value="<?php echo $userscompanyid; ?>">
						<?php if ($roletype!='1') { 
							if(!isset($disablebtn) or $pagetype=='registration'){ ?>
							<button type="button" id="save" name="save" value="save" class="btn btn-primary">Save</button>
							<button type="button" id="sub-reg" name="submit" value="submit" class="btn btn-primary">Submit</button>
							<button type="submit" id="hid_sub_reg" name="submit" value="submit" class="btn btn-primary" style="display: none;">Submit</button>
						<?php }
						 }else{ ?> 
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
						<?php } ?>
					</div>
				</form>

<div id="skillmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="skillform">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">A One Time Pin (OTP) was sent to the Licensed Plumber with the following Mobile Number`</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label><?php // echo $username['name']." ".$username['surname']; ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input id="sampleOtp" type="text" class="form-control skill_training" readonly>
								<div class="invalidOTP" style="color: red;"> Given OTP is Invalid ! </div>
								<label>Enter OTP</label>
								<input name="otpnumber" id="otpnumber" type="text" class="form-control skill_training">
							</div>
							<div class="otp-status"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="skill_id" class="skill_id">
					<button type="button" class="btn btn-success verify">Verify</button>
					<button type="button" class="btn btn-success resend">Resend</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
				
<?php if($pagetype!='registration'){ ?>			
			</div>
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">

$(function(){

	

	$('#skillmodal').modal('hide');

		$('#sub-reg').on('click',function(){
			var formvalid = 0;
			if($('.form').valid()==false){
				if(formvalid==0) formvalid = 0; 
			}else{
				ajaxotp();			
				$('#skillmodal').modal('show');
				$('.invalidOTP').hide();
			}
		});

		$('#save').on('click',function(){			
			 // $('#reg_forms').removeAttr('novalidate');
			 // $('#reg_forms').removeClass("form");
			 $(".form").validate().settings.ignore = "*";
			 $("#hid_sub_reg"). prop("name", "save1");
			 $( "#hid_sub_reg" ).trigger( "click" );
		});

		$('.resend').on('click',function(){
			ajaxotp();
		});
		$('.verify').on('click',function(){
			var otpver = $('#otpnumber').val();
			ajaxOTPVerify(otpver);
		});


	$("#contact_person").keyup(function(e) {
 	  var regex = /^[A-Za-z]+$/;
  	if (regex.test(this.value) === true)
   		return  false;
	});

		 //     $("#contact_person").filter(function(value) {
			// 		return /^[A-Za-z]+$/.test(value); // Allow digits only, using a RegExp
			// });
		

	select2('#province1, #city1, #suburb1, #province2, #city2, #suburb2');
	inputmask('#work_phone, #mobile_phone,#home_phone,#secondary_phone', 1);
	citysuburb(['#province1','#city1', '#suburb1'], ['<?php echo $city1; ?>', '<?php echo $suburb1; ?>'], ['#addcity1', '#addcitysubmit1', '#addsuburb1', '#addsuburbsubmit1']);
	citysuburb(['#province2','#city2', '#suburb2'], ['<?php echo $city2; ?>', '<?php echo $suburb2; ?>'], ['#addcity2', '#addcitysubmit2', '#addsuburb2', '#addsuburbsubmit2']);
	
	var approvalstatus = '<?php echo $approval_status; ?>';
	if(approvalstatus!='') $('.approvalstatus[value="'+approvalstatus+'"]').data('approvalStatusValue', true);
	rejectwrapper(approvalstatus);
	
	rejectother();

	validation( 
		'.form',
		{
			name : {
				required	: true,
			},
			reg_no : {
				required	: true,
			},
			email : {
				email		: true,
				remote		: 	{
								url	: "<?php echo base_url().'authentication/login/emailvalidation'; ?>",
								type: "post",
								async: false,
								data: {
										id 		: '<?php echo $id; ?>',
										type 	: '4'
										}
									}
								},
			vat_no : {
				required	: true,
			},
			contact_person : {
				required	: true,
			},
			'address[1][address]' : {
				required	: true,
			},
			'address[2][address]' : {
				required	: true,
			},
			 'address[1][province]' : {
				required	: true,
			},
			'address[2][province]' : {
				required	: true,
			},
			'address[1][city]' : {
				required	: true,
			},
			'address[2][city]' : {
				required	: true,
			},
			'address[1][suburb]' : {
				required	: true,
			},
			'address[2][suburb]' : {
				required	: true,
			},
			'address[2][postal_code]' : {
				required	: true,
			},
			'worktype[]' : {
				required	: true,
			},
			'specilisations[]' : {
				required	: true,
			},
			 work_phone : {
				required	: true,
			},
			mobile_phone : {
				required	: true,
			},
			
		},
		{
			name : {
				required	: "Company name field is required.",
			},
			reg_no : {
				required	: "Registration number field is required.",
			},
			vat_no : {
				required	: "VAT field is required.",
			},
			contact_person : {
				required	: "Contact preson field is required.",
			},
			'address[1][address]' : {
				required	: "Phydical address field is required.",
			},
			'address[2][address]' : {
				required	: "Postal address field is required.",
			},
			email : {
					remote		: "Email already exists."
				},
			'address[1][province]' : {
				required	: "Physical Province field is required.",
			},
			'address[2][province]' : {
				required	: "Postal Province field is required.",
			},
			'address[1][city]' : {
				required	: "Physical City field is required.",
			},
			'address[2][city]' : {
				required	: "Postal City field is required.",
			},
			'address[1][suburb]' : {
				required	: "Physical Suburb field is required.",
			},
			'address[2][suburb]' : {
				required	: "Postal Suburb field is required.",
			},
			'address[2][postal_code]' : {
				required	: "Postal Code field is required.",
			},
			'worktype[]' : {
				required	: "Worktype is required.",
			},
			'specilisations[]' : {
				required	: "Specilisations is required.",
			},
			work_phone : {
				required	: "Work phone field is required.",
			},
			mobile_phone : {
				required	: "Mobile phone field is required.",
			},
		}

			
	);
})
	
	
$('.approvalstatus').click(function(){

	var previousValue = $(this).data('approvalStatusValue');
    if (previousValue){
		$(this).prop('checked', !previousValue);
		$(this).data('approvalStatusValue', !previousValue);
    }else{
		$(this).data('approvalStatusValue', true);
		$(".approvalstatus:not(:checked)").data("approvalStatusValue", false);
    }

	rejectwrapper((($(this).is(':checked')) ? $(this).val() : 0));
})


function rejectwrapper(value){
	$('.reject_wrapper').addClass('displaynone');
	$('.pending_approval_status').remove();
	
	if(value=='0'){
		$('.reject_wrapper').append('<input type="hidden" value="0" name="approval_status" class="pending_approval_status">');
	}else if(value=='2'){
		$('.reject_wrapper').removeClass('displaynone');
	}
}

$('.reject_reason').click(function(){
	rejectother();
})

function rejectother(){
	var flag = 0;
	
	$('.reject_reason').each(function(){
		if($(this).is(':checked') && $(this).val()=='2'){
			flag = 1;
		}
	})
	
	if(flag==1){
		$('.reject_reason_other_wrapper').removeClass('displaynone');
	}else{
		$('.reject_reason_other_wrapper').addClass('displaynone');
	}
}

function ajaxotp(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo base_url().'company/registration/Index/ajaxOTP'; ?>',
			async : true,
			dataType : 'json',
			method 	: 'POST',
			data: {user_id:'<?php echo $id; ?>', mobile_phone: $('#mobile_phone').val(), },
			success: function(data) {
				$('#sampleOtp').val(data.otp);
			}
		});
	}


	
	function ajaxOTPVerify(data){
		var otpver = data;
		$.ajax({
				type  		: 'ajax',
				url   		: '<?php echo base_url().'company/registration/Index/OTPVerification'; ?>',
				async 		: true,
				dataType 	: 'json',
				method 		: 'POST',
				data 		: {user_id:'<?php echo $id; ?>', otp: otpver},
				success: function(data) {
					if (data == 0) {
						$('.invalidOTP').show();
					}else{
						//$('#reg_forms').submit();
						$( "#hid_sub_reg" ).trigger( "click" );

					}

					console.log(data);
				}
			});

	}

</script>

