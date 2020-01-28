<?php
	$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
	$usersplumberid 		= isset($result['usersplumberid']) ? $result['usersplumberid'] : '';
	
	$titleid 				= isset($result['title']) ? $result['title'] : '';
	$dob 					= isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
	$name 					= isset($result['name']) ? $result['name'] : '';
	$surname 				= isset($result['surname']) ? $result['surname'] : '';
	$genderid 				= isset($result['gender']) ? $result['gender'] : '';
	$racialid 				= isset($result['racial']) ? $result['racial'] : '';
	$nationality 			= isset($result['nationality']) ? $result['nationality'] : '';
	$idcard 				= isset($result['idcard']) ? $result['idcard'] : '';
	$othernationality 		= isset($result['othernationality']) ? $result['othernationality'] : '';
	$otheridcard 			= isset($result['otheridcard']) ? $result['otheridcard'] : '';
	$homelanguageid 		= isset($result['homelanguage']) ? $result['homelanguage'] : '';
	$disabilityid 			= isset($result['disability']) ? $result['disability'] : '';
	$citizenid 				= isset($result['citizen']) ? $result['citizen'] : '';
	$file1 					= isset($result['file1']) ? $result['file1'] : '';
	$file2 					= isset($result['file2']) ? $result['file2'] : '';
	$registrationcard 		= isset($result['registration_card']) ? $result['registration_card'] : '';
	$deliverycard 			= isset($result['delivery_card']) ? $result['delivery_card'] : '';
	$homephone 				= isset($result['home_phone']) ? $result['home_phone'] : '';
	$mobilephone 			= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';
	$workphone 				= isset($result['work_phone']) ? $result['work_phone'] : '';
	$email 					= isset($result['email']) ? $result['email'] : '';
	$companyname 			= isset($result['company_name']) ? $result['company_name'] : '';
	$regno 					= isset($result['reg_no']) ? $result['reg_no'] : '';
	$vatno 					= isset($result['vat_no']) ? $result['vat_no'] : '';
	$employmentdetailsid	= isset($result['employment_details']) ? $result['employment_details'] : '';
	$companydetailsid		= isset($result['company_details']) ? $result['company_details'] : '';
	$designation			= isset($result['designation']) ? $result['designation'] : '';
	
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
	
	$billingaddress 		= isset($result['billingaddress']) ? explode('@-@', $result['billingaddress']) : [];
	$addressid3 			= isset($billingaddress[0]) ? $billingaddress[0] : '';
	$address3				= isset($billingaddress[2]) ? $billingaddress[2] : '';
	$suburb3 				= isset($billingaddress[3]) ? $billingaddress[3] : '';
	$city3 					= isset($billingaddress[4]) ? $billingaddress[4] : '';
	$province3 				= isset($billingaddress[5]) ? $billingaddress[5] : '';
	$postalcode3 			= isset($billingaddress[6]) ? $billingaddress[6] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumbers Registration Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumbers Registration Details</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Application Status</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<div class="row">
							<div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="id_attached">
		                            <label class="custom-control-label" for="id_attached">ID Attached</label>
		                        </div>
		                    </div>
		                    <div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="qualification_verified">
		                            <label class="custom-control-label" for="qualification_verified">Qualification Verified</label>
		                        </div>
		                    </div>
	                    </div> 
	                    <div class="row">
							<div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="proof_of_experience">
		                            <label class="custom-control-label" for="proof_of_experience">Proof of Experience</label>
		                        </div>
		                    </div>
		                    <div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="declaration_signed">
		                            <label class="custom-control-label" for="declaration_signed">Declaration Signed</label>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="row">
							<div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="initial_each_page">
		                            <label class="custom-control-label" for="initial_each_page">Initial each page</label>
		                        </div>
		                    </div>
		                    <div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="photo_correct">
		                            <label class="custom-control-label" for="photo_correct">Photo Correct</label>
		                        </div>
		                    </div>
	                    </div>  
	                    <div class="row">
							<div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="company_details_correct">
		                            <label class="custom-control-label" for="company_details_correct">Company Details Correct</label>
		                        </div>
		                    </div>
		                    <div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="induction_completed">
		                            <label class="custom-control-label" for="induction_completed">Induction Completed</label>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="row">
							<div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="payment_recieved">
		                            <label class="custom-control-label" for="payment_recieved">Payment Recieved</label>
		                        </div>
		                    </div>
	                    </div>                 
	                    </div>
	                    <div class="form-group">
		                    <div class="row">
		                    		<div class="col-md-6">
			                    		<label>Approval Status *</label>
			                    	</div>
		                    		<div class="col-md-3">
					                    <div class="custom-control custom-radio">
					                        <input type="radio" id="approve" name="approve" class="custom-control-input">
					                        <label class="custom-control-label" for="approve">Approve</label>
					                    </div>
				                    </div>
		                    		<div class="col-md-3">
					                    <div class="custom-control custom-radio">
					                        <input type="radio" id="reject" name="approve" class="custom-control-input">
					                        <label class="custom-control-label" for="reject">Reject</label>
					                    </div>
				                    </div>
		                    </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="row">
		                    		<div class="col-md-6">
			                    		<label>Reason for Rejection</label>
			                    	</div>
		                    		<div class="col-md-6">
					                    <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="no_supporting_evidence">
				                            <label class="custom-control-label" for="no_supporting_evidence">No Supporting Evidence</label>
				                        </div>
				                        <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="cannot_verifiy">
				                            <label class="custom-control-label" for="cannot_verifiy">Cannot Verifiy Qualification/Certificates</label>
				                        </div>
				                        <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="no_payment">
				                            <label class="custom-control-label" for="no_payment">No Payment Recieved</label>
				                        </div>
				                        <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="other">
				                            <label class="custom-control-label" for="other">Other</label>
				                        </div>
				                        <div class="form-group">
											<input type="text" class="form-control" placeholder="If Other specify">		
										</div>
				                    </div>
		                    </div>
	                    </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Comments</label>
							<textarea class="form-control" rows="5"></textarea>
						</div>
						<form method="post">
							<div class="form-group">
								<div class="row">
									<input type="text" class="form-control" name="" placeholder="Type your comments here">
								</div>
								<div class="text-right">
									<button type="submit" name="add_comment" value="submit" class="btn btn-primary">Add comment</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<form class="mt-4 form" action="" method="post">				
				<div class="col-md-12">
					<h4 class="card-title">Plumber register</h4>
				
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Registration Number</label>
								<input type="text" class="form-control" name="reg_no" value="<?php echo $regno; ?>">								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>First Registration Date</label>
								<input type="text" class="form-control first_reg_date">								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Next Renewal Date</label>
								<input type="text" class="form-control next_renewal_date">								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<?php
									echo form_dropdown('status', $plumberstatus, '', ['class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>PIRB Designation</label>
								<?php
									echo form_dropdown('designation', $designation2, $designation, ['class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
					<div class="form-group row">
							<div class="col-md-12">
								<label>PIRB Specialisations:</label>
							</div>
							<div class="col-md-4">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="solar">
	                                <label class="custom-control-label" for="solar">- Solar</label>
	                            </div>
                            </div>
							<div class="col-md-4">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="gas">
	                                <label class="custom-control-label" for="gas">- Gas</label>
	                            </div>
                            </div>
							<div class="col-md-4">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="plumbing_estimator">
	                                <label class="custom-control-label" for="plumbing_estimator">- Plumbing estimator</label>
	                            </div>
                            </div>
							<div class="col-md-4">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="heat_pump">
	                                <label class="custom-control-label" for="heat_pump">- Heat Pump</label>
	                            </div>
                            </div>
                            <div class="col-md-4">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="plumbing_training_assessor">
	                                <label class="custom-control-label" for="plumbing_training_assessor">- Plumbing Training Assessor</label>
	                            </div>
                            </div>
							<div class="col-md-4">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="plumbing_arbitrator">
	                                <label class="custom-control-label" for="plumbing_arbitrator">- Plumbing Arbitrator</label>
	                            </div>
                            </div>
                    </div>
                    <div class="form-group row">
						<div class="col-md-6">
							<label>Number of CoC's Able to purchase:</label>
                    		<input type="number" class="form-control">
						</div>
						<div class="col-md-6">
							<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="electronic_coc_loging">
                                <label class="custom-control-label" for="electronic_coc_loging">Allow for Electronic COC's loging</label>
                            </div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<label>Specific Message to Plumber</label>
							<textarea class="form-control" rows="5"></textarea>
						</div>
					</div>
					<div class="accordion" id="accordionExample">
					  <div class="card">
					    <div class="card-header" id="headingOne">
					      <h2 class="mb-0">
					        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Personal Details
					        </button>
					      </h2>
					    </div>

					    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					      <div class="card-body">
					        <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Title *</label>
										<?php
											echo form_dropdown('title', $titlesign, $titleid, ['id'=>'title', 'class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Date of Birth *</label>
										<input type="text" class="form-control dob" name="dob" value="<?php echo $dob; ?>">
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name *</label>
									<input type="text" class="form-control"  name="name"  value="<?php echo $name; ?>">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Surname *</label>
									<input type="text" class="form-control"  name="surname"  value="<?php echo $surname; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<?php
										echo form_dropdown('gender', $gender, $genderid, ['id'=>'gender', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Racial Status *</label>
									<?php
										echo form_dropdown('racial', $racial, $racialid,['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>South African National *</label>
									<?php
										echo form_dropdown('nationality', $yesno, $nationality,['class'=>'form-control']);
									?>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ID Number</label>
									<input type="text" class="form-control" name="idcard" value="<?php echo $idcard; ?>">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Other Nationality *</label>
									<input type="text" class="form-control" name="othernationality" value="<?php echo $othernationality; ?>">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Alternate ID</label>
									<input type="text" class="form-control" name="otheridcard" value="<?php echo $otheridcard; ?>">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Language *</label>
									<?php
										echo form_dropdown('homelanguage', $homelanguage, $homelanguageid, ['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Disability *</label>
									<?php
									echo form_dropdown('disability', $disability, $disabilityid,['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Citizen Residential Status *</label>
									<?php
									echo form_dropdown('citizen', $citizen, $citizenid,['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Photo ID *</h4>
								<div class="form-group">
									<div>
										<img src="<?php echo ($file2!='') ? $filepath.$file2 : base_url().'assets/images/profile.jpg'; ?>" class="photo_image" width="100">
									</div>
									<input type="file" class="photo_file">
									<input type="hidden" name="image2" class="photo" value="<?php echo $file2; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
						</div>

						<h4 class="card-title">Registration Card</h4>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Registration Card Required *</label>
									<?php
									echo form_dropdown('registration_card', $yesno, $registrationcard,['class'=>'form-control']);
									?>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Method of Delivery of Card *</label>
									<?php
									echo form_dropdown('delivery_card', $deliverycard, $deliverycard,['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingTwo">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          Plumbers Contact Details
					        </button>
					      </h2>
					    </div>
					    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					      <div class="card-body">
					        <div class="row">
								<div class="col-md-6">
									<h4 class="card-title">Physical Address</h4>
									<p class="tagline">Note all delivery services will be sent to this address</p>
									<div class="form-group">
										<label>Physical Address *</label>
										<input type="hidden" class="form-control" name="address[1][id]" value="<?php echo $addressid1; ?>">
										<input type="hidden" class="form-control" name="address[1][type]" value="1">
										<input type="text" class="form-control" name="address[1][address]"  value="<?php echo $address1; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<h4 class="card-title">Postal Address</h4>
									<p class="tagline">Note all postal services will be sent to this address</p>
									<div class="form-group">
										<label>Postal Address *</label>
										<input type="hidden" class="form-control" name="address[2][id]" value="<?php echo $addressid2; ?>">
										<input type="hidden" class="form-control" name="address[2][type]" value="2">
										<input type="text" class="form-control" name="address[2][address]" value="<?php echo $address2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<input type="text" class="form-control" name="address[1][suburb]" value="<?php echo $suburb1; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<input type="text" class="form-control" name="address[2][suburb]" value="<?php echo $suburb2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<input type="text" class="form-control" name="address[1][city]" value="<?php echo $city1; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<input type="text" class="form-control" name="address[2][city]" value="<?php echo $city2; ?>">
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
									<div class="form-group">
										<label>Postal Code *</label>
										<input type="text" class="form-control" name="address[2][postal_code]" value="<?php echo $postalcode2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Home Phone:</label>
										<input type="text" class="form-control" name="home_phone" value="<?php echo $homephone; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Mobile Phone *</label>
										<input type="text" class="form-control" name="mobile_phone" value="<?php echo $mobilephone; ?>">
										<p>Note all SMS and OTP notifications will be sent to this mobile number above</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Work Phone:</label>
										<input type="text" class="form-control" name="work_phone" value="<?php echo $workphone; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email Address *</label>
										<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
										<p>Note: this email will be used as your user profile name and all emails notifications will be sent to it</p>
									</div>
								</div>
							</div>
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingThree">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          Plumbers Employment Details
					        </button>
					      </h2>
					    </div>
					    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					      <div class="card-body">
					        <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Your Employment Status</label>
										<?php
										echo form_dropdown('employment_details', $employmentdetail, $employmentdetailsid,['class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Company</label>
										<?php
										echo form_dropdown('company_details', [], $companydetailsid,['class'=>'form-control']);
										?>
									</div>
								</div>
							</div>
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingFour">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
					          Plumbers Qualification/Certificate Details
					        </button>
					      </h2>
					    </div>
					    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
					      <div class="card-body">
					      	<div class="row">
						        <h4 class="card-title">Attachements</h4>
								<p>Please Attach ALL your relevant trade certificates, course certificates, evidence that supports your registration application:</p>
								<table class="table table-bordered skilltable">
									<tr>
										<td>Date of Qualification/Skill Obtained</td>
										<td>Certificate Number</td>
										<td>Qualification Route</td>
										<td>Training Provider</td>
										<td>Attachement</td>
										<td>Action</td>
									</tr>
									<tr class="skillnotfound"><td colspan="6">No Record Found</td></tr>
								</table>
								<div class="">
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#skillmodal">Add Cert/Skill</button>
								</div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>
				</div>	
				<div class="col-md-12 text-right">
					<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">
					<input type="hidden" name="usersplumberid" id="usersplumberid" value="<?php echo $usersplumberid; ?>">
					<input type="submit" name="submit" value="submit" class="btn btn-primary">
				</div>				
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	datepicker('.first_reg_date');	
	datepicker('.next_renewal_date');
	datepicker('.dob');
	fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".photo_file", "./assets/uploads/plumber/<?php echo $userid; ?>/"], ['.photo', '.photo_image', '<?php echo base_url()."assets/uploads/plumber/".$userid; ?>']);
});

$('.skillsubmit').click(function(){
	var data = $('.skillform').serialize();
	ajax('<?php echo base_url()."/plumber/registration/index/ajaxskillregistration"; ?>', data, skills);
})

</script>

