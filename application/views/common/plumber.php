<?php
	$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
	$usersplumberid 		= isset($result['usersplumberid']) ? $result['usersplumberid'] : '';
	
	$email 					= isset($result['email']) ? $result['email'] : '';
	
	$titleid 				= isset($result['title']) ? $result['title'] : '';
	$dob 					= isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
	$name 					= isset($result['name']) ? $result['name'] : '';
	$surname 				= isset($result['surname']) ? $result['surname'] : '';
	$genderid 				= isset($result['gender']) ? $result['gender'] : '';
	$racialid 				= isset($result['racial']) ? $result['racial'] : '';
	$nationality 			= isset($result['nationality']) ? $result['nationality'] : '';
	$idcard 				= isset($result['idcard']) ? $result['idcard'] : '';
	$othernationalityid 	= isset($result['othernationality']) ? $result['othernationality'] : '';

	$otheridcard 			= isset($result['otheridcard']) ? $result['otheridcard'] : '';
	$homelanguageid 		= isset($result['homelanguage']) ? $result['homelanguage'] : '';
	$disabilityid 			= isset($result['disability']) ? $result['disability'] : '';
	$citizenid 				= isset($result['citizen']) ? $result['citizen'] : '';
	$file1 					= isset($result['file1']) ? $result['file1'] : '';
	$file2 					= isset($result['file2']) ? $result['file2'] : '';
	$registrationcard 		= isset($result['registration_card']) ? $result['registration_card'] : '';
	$deliverycardid 		= isset($result['delivery_card']) ? $result['delivery_card'] : '';
	$homephone 				= isset($result['home_phone']) ? $result['home_phone'] : '';
	$mobilephone 			= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';
	$workphone 				= isset($result['work_phone']) ? $result['work_phone'] : '';
	$companyname 			= isset($result['company_name']) ? $result['company_name'] : '';
	$regno 					= isset($result['reg_no']) ? $result['reg_no'] : '';
	$vatno 					= isset($result['vat_no']) ? $result['vat_no'] : '';
	$employmentdetailsid	= isset($result['employment_details']) ? $result['employment_details'] : '';
	$companydetailsid		= isset($result['company_details']) ? $result['company_details'] : '';
	$designationid			= isset($result['designation']) ? $result['designation'] : '';
	
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

	$skills 				= isset($result['skills']) ? array_filter(explode('@-@', $result['skills'])) : [];
	
	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	
	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	
	if($file2!=''){
		$explodefile2 	= explode('.', $file2);
		$extfile2 		= array_pop($explodefile2);
		$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
	}else{
		$photoidimg 	= $profileimg;
	}
	
	$email2 				= isset($result['email2']) ? $result['email2'] : '';
	$mobilephone2 			= isset($result['mobile_phone2']) ? $result['mobile_phone2'] : '';
	
	$application_status 	= isset($result['application_status']) ? explode(',', $result['application_status']) : [];
	$approval_status 		= isset($result['approval_status']) ? $result['approval_status'] : '';
	$reject_reason 			= isset($result['reject_reason']) ? explode(',', $result['reject_reason']) : [];
	$reject_reason_other 	= isset($result['reject_reason_other']) ? $result['reject_reason_other'] : '';
	
	$registration_no 		= isset($result['registration_no']) ? $result['registration_no'] : '';
	$registration_date 		= isset($result['registration_date']) && $result['registration_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['registration_date'])) : '';
	$renewal_date 			= $registration_date!='' ? date('d-m-Y', strtotime($result['registration_date']. ' +365 days')) : '';
	$plumberstatusid 		= isset($result['plumberstatus']) ? $result['plumberstatus'] : '';
	$designation2id 		= isset($result['designation']) ? $result['designation'] : '';
	$qualificationyear 		= isset($result['qualification_year']) ? $result['qualification_year'] : '';
	$specialisationsid 		= isset($result['specialisations']) ? explode(',', $result['specialisations']) : '';
	$cocpurchaselimit 		= isset($result['coc_purchase_limit']) && $result['coc_purchase_limit']!='0' ? $result['coc_purchase_limit'] : $defaultsettings['plumber_certificate'];
	$cocelectronic 			= isset($result['coc_electronic']) ? $result['coc_electronic'] : '';
	$message 				= isset($result['message']) ? $result['message'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber register</h4>
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

<?php if($approval_status=='0'){ ?>
	<form class="form1" method="post">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Application Status</label>
									<?php
										foreach($applicationstatus as $key => $value){
											if($key%2==1){						
												echo "<div class='row'>";
											}
									?>
												<div class="col-md-6">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" id="<?php echo $key.'-'.$value; ?>" class="custom-control-input" name="application_status[]" value="<?php echo $key; ?>" <?php echo (in_array($key, $application_status)) ? 'checked="checked"' : ''; ?>>
														<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
													</div>
												</div>
									<?php
											if($key%2==0 || count($applicationstatus)==$key){						
												echo "</div>";
											}
										}
									?>
								</div>
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
												foreach ($rejectreason as $key => $value) {
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
										<input type="hidden" name="usersplumberid" value="<?php echo $usersplumberid; ?>">
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

<form class="form2" method="post" action="">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					
					<h4 class="card-title">Plumbers Registration Details</h4>
					
					<?php if($approval_status=='1'){ ?>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 add_full_width">
									<div class="form-group">
										<label>Registration Number</label>
										<input type="text" class="form-control" value="<?php echo $registration_no; ?>" disabled>								
										<input type="hidden" value="<?php echo $registration_no; ?>" name="registration_no">								
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Registration Date</label>
										<input type="text" class="form-control" value="<?php echo $registration_date; ?>" disabled>						
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Next Renewal Date</label>
										<input type="text" class="form-control" value="<?php echo $renewal_date; ?>" disabled>			
									</div>
								</div>
							</div>					
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Status</label>
										<?php
											echo form_dropdown('plumberstatus', $plumberstatus, $plumberstatusid, ['class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>PIRB Designation</label>
										<?php
											echo form_dropdown('designation2', $designation2, $designation2id, ['class' => 'form-control', 'id' => 'designation2']);
										?>
									</div>
								</div>
								<div class="col-md-6 offset-md-6 qualificationyear_wrapper displaynone">
									<div class="form-group">
										<label>Year in which Plumbing Qualification was obtained</label>
										<input type="text" class="form-control" name="qualification_year" value="<?php echo $qualificationyear; ?>">
									</div>
								</div>
							</div>						
							<div class="form-group row specialisations_wrapper displaynone">
									<div class="col-md-12">
										<label>PIRB Specialisations:</label>
									</div>
									<?php
										foreach ($specialisations as $key => $value) {
									?>
											<div class='col-md-4'>
												<div class='custom-control custom-checkbox'>
													<input type='checkbox' class='custom-control-input' name='specialisations[]' id='<?php echo $key.'-'.$value; ?>' value='<?php echo $key; ?>' <?php echo (in_array($key, $specialisationsid)) ? 'checked="checked"' : ''; ?>>
													<label class='custom-control-label' for='<?php echo $key.'-'.$value; ?>'><?php echo $value; ?></label>
												</div>
											</div>
									<?php
										}
									?>
							</div>						
							<div class="form-group row">
								<div class="col-md-6">
									<label>Number of CoC's Able to purchase:</label>
									<input type="number" class="form-control" name="coc_purchase_limit" value="<?php echo $cocpurchaselimit; ?>">
								</div>
								<div class="col-md-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="coc_electronic" name="coc_electronic" value="1" <?php echo ($cocelectronic=='1') ? 'checked="checked"' : ''; ?>>
										<label class="custom-control-label" for="coc_electronic">Allow for Electronic COC's loging</label>
									</div>
								</div>
							</div>						
							<div class="form-group row">
								<div class="col-md-12">
									<label>Specific Message to Plumber</label>
									<textarea class="form-control" rows="5" name="message"><?php echo $message; ?></textarea>
								</div>
							</div>
						</div>
					<?php } ?>
					
					<div class="accordion" id="plumberaccordion">
						<div class="card">
							<div class="card-header" id="PlumbersPersonalDetails">
								<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab1" aria-expanded="true" aria-controls="tab1">
										Plumbers Personal Details
									</button>
								</h2>
							</div>
							<div id="tab1" class="collapse show" aria-labelledby="PlumbersPersonalDetails" data-parent="#plumberaccordion">
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
											<label>Date of Birth *</label>
											<div class="form-group">
												<div class="input-group">
													<input type="text" class="form-control dob" name="dob" value="<?php echo $dob; ?>">
													<div class="input-group-append">
														<span class="input-group-text"><i class="icon-calender"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Name *</label>
												<input type="text" class="form-control"  id="name" name="name" value="<?php echo $name; ?>">
												</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Surname *</label>
												<input type="text" class="form-control" name="surname" id="surname" value="<?php echo $surname; ?>">
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
													echo form_dropdown('nationality', $yesno, $nationality,['class'=>'form-control', 'id' => 'nationality']);
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
									<div class="row othernationalityidcardbox">
										<div class="col-md-6">
											<div class="form-group">
												<label>Other Nationality <span class="othernationality_required">*</span></label>
												<?php
													echo form_dropdown('othernationality', $othernationality, $othernationalityid, ['class'=>'form-control']);
												?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Alternate ID *</label>
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
										<div class="col-md-12">
											<h4 class="card-title">Photo ID *</h4>
											<div class="form-group">
												<div>
													<img src="<?php echo $photoidimg; ?>" class="photo_image" width="100">
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
													echo form_dropdown('registration_card', $yesno, $registrationcard,['class'=>'form-control', 'id' => 'registration_card']);
												?>
												</div>
										</div>
										<div class="col-md-6 deliverycardbox">
											<div class="form-group">
												<label>Method of Delivery of Card <span class="delivery_card_required">*</span></label>
												<?php
													echo form_dropdown('delivery_card', $deliverycard, $deliverycardid,['class'=>'form-control']);
												?>
											</div>
										</div>
									</div>
																
								</div>
							</div>
						</div>	

						<div class="card">
							<div class="card-header" id="PlumbersContactDetails">
								<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab2" aria-expanded="true" aria-controls="tab2">
										Plumbers Contact Details
									</button>
								</h2>
							</div>
							<div id="tab2" class="collapse" aria-labelledby="PlumbersContactDetails" data-parent="#plumberaccordion">
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
										<div class="col-md-6 col-md-offset-6">
											<div class="form-group">
												<label>Postal Code *</label>
												<input type="text" class="form-control" name="address[2][postal_code]" value="<?php echo $postalcode2; ?>">
											</div>
										</div>
									</div>
									<h4 class="card-title">Contact Details</h4>
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
												<label>Secondary Mobile Phone *</label>
												<input type="text" class="form-control" name="mobile_phone2" value="<?php echo $mobilephone2; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Email Address *</label>
												<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
												<p>Note: this email will be used as your user profile name and all emails notifications will be sent to it</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Secondary Email Address *</label>
												<input type="text" class="form-control" name="email2" value="<?php echo $email2; ?>">
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>


						<div class="card">
							<div class="card-header" id="PlumbersBillingDetails">
								<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab3" aria-expanded="true" aria-controls="tab3">
										Plumbers Billing Details
									</button>
								</h2>
							</div>
							<div id="tab3" class="collapse" aria-labelledby="PlumbersBillingDetails" data-parent="#plumberaccordion">
								<div class="card-body">

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Billing Name *</label>
												<input type="text" class="form-control" name="company_name" value="<?php echo $companyname; ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Company Reg Number</label>
												<input type="text" class="form-control" name="reg_no" value="<?php echo $regno; ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Company Vat</label>
												<input type="text" class="form-control" name="vat_no" value="<?php echo $vatno; ?>">
											</div>
										</div>                            
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Billing Address *</label>
												<input type="hidden" class="form-control" name="address[3][id]" value="<?php echo $addressid3; ?>">
												<input type="hidden" class="form-control" name="address[3][type]" value="3">
												<input type="text" class="form-control" name="address[3][address]" value="<?php echo $address3; ?>">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Province *</label>
												<?php
													echo form_dropdown('address[3][province]', $province, $province3, ['id' => 'province3', 'class'=>'form-control']);
												?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>City *</label>
												<?php 
													echo form_dropdown('address[3][city]', [], $city3, ['id' => 'city3', 'class' => 'form-control']); 
												?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Suburb *</label>
												<?php 
													echo form_dropdown('address[3][suburb]', [], $suburb3, ['id' => 'suburb3', 'class'=>'form-control']);
												?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Postal Code *</label>
												<input type="text" class="form-control" name="address[3][postal_code]" value="<?php echo $postalcode3; ?>">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>


						<div class="card">
							<div class="card-header" id="PlumbersEmloymentDetails">
								<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab4" aria-expanded="true" aria-controls="tab4">
										Plumbers Emloyment Details
									</button>
								</h2>
							</div>
							<div id="tab4" class="collapse" aria-labelledby="PlumbersEmloymentDetails" data-parent="#plumberaccordion">
								<div class="card-body">
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Your Employment Status</label>
												<?php
													echo form_dropdown('employment_details', $employmentdetail, $employmentdetailsid,['class'=>'form-control', 'id' => 'employment_details']);
												?>
											</div>
										</div>
										<div class="col-md-12 companydetailsbox">
											<div class="form-group">
												<label>Company *</label>
												<?php
													echo form_dropdown('company_details', $company, $companydetailsid,['class'=>'form-control']);
												?>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>


						<div class="card qualification_tab_wrapper displaynone">
							<div class="card-header" id="PlumbersQualificationCertificateDetails">
								<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab5" aria-expanded="true" aria-controls="tab5">
										Plumbers Qualification/Certificate Details
									</button>
								</h2>
							</div>
							<div id="tab5" class="collapse" aria-labelledby="PlumbersQualificationCertificateDetails" data-parent="#plumberaccordion">
								<div class="card-body">
									
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
									<div>
										<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#skillmodal">Add Cert/Skill</button>
									</div>
									<input type="hidden" class="attachmenthidden" name="attachmenthidden"> 

								</div>
							</div>
						</div>									
					</div>
					
					<div class="col-md-12">
						<input type="hidden" name="usersdetailid" value="<?php echo $usersdetailid; ?>">
						<input type="hidden" name="usersplumberid" value="<?php echo $usersplumberid; ?>">
						<button type="button" id="plumbersubmit" class="btn btn-primary">Submit</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</form>

<div id="skillmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="skillform">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add a Qualification/Skill</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label>Date of Qualification/Skill Obtained</label>
									<div class="input-group">
										<input type="text" class="form-control skill_date" name="skill_date" data-date='datepicker'>
										<div class="input-group-append">
											<span class="input-group-text"><i class="icon-calender"></i></span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label>Certificate Number</label>
									<input type="text" class="form-control skill_certificate" name="skill_certificate">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Qualification/Skills Route</label>
								<?php
								echo form_dropdown('skill_route', $qualificationroute, '', ['class'=>'form-control skill_route']);
								?>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Training Provider</label>
								<input name="skill_training" type="text" class="form-control skill_training">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="skill_attachment_image" width="100">
								</div>
								<input type="file" class="skill_attachment_file">
								<input type="hidden" name="skill_attachment" class="skill_attachment">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="skill_id" class="skill_id">
					<button type="button" class="btn btn-success skillsubmit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

var userid		= '<?php echo $userid; ?>';
var filepath 	= '<?php echo $filepath; ?>';
var ajaxfileurl	= '<?php echo base_url("ajax/index/ajaxfileupload"); ?>';
var pdfimg		= '<?php echo $pdfimg; ?>';

$(function(){
	datepicker('.dob');
	datepicker('.skill_date');
	fileupload([ajaxfileurl, ".document_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.document', '.document_image', filepath, pdfimg]);
	fileupload([ajaxfileurl, ".photo_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.photo', '.photo_image', filepath, pdfimg]);
	fileupload([ajaxfileurl, ".skill_attachment_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.skill_attachment', '.skill_attachment_image', filepath, pdfimg]);
	citysuburb(['#province1','#city1', '#suburb1'], ['<?php echo $city1; ?>', '<?php echo $suburb1; ?>']);
	citysuburb(['#province2','#city2', '#suburb2'], ['<?php echo $city2; ?>', '<?php echo $suburb2; ?>']);
	citysuburb(['#province3','#city3', '#suburb3'], ['<?php echo $city3; ?>', '<?php echo $suburb3; ?>']);
	
	var nationality = $('#nationality').val();
	othernationalityidcardbox(nationality);
	
	var registrationcard = $('#registration_card').val();
	deliverycardbox(registrationcard);
	
	var employmentdetails = $('#employment_details').val();
	companydetailsbox(employmentdetails);
	
	var designationid = '<?php echo $designationid; ?>';
	if(designationid!='') $('input[name="designation"][value="'+designationid+'"]').prop('checked', true);
	designationattachment(designationid);
	
	var designation2id = '<?php echo $designation2id; ?>';
	designationcondition(designation2id);
	
	var approvalstatus = '<?php echo $approval_status; ?>';
	rejectwrapper(approvalstatus);
	
	rejectother();
	
	var skill = $.parseJSON('<?php echo json_encode($skills); ?>');
	if(skill.length > 0){
		$(skill).each(function(i, v){
			var skillsplit 	= v.split('@@@');
			var skilldata 	= {status : 1, result : { id: skillsplit[0], date: skillsplit[2], certificate: skillsplit[3], skillname: skillsplit[7], training: skillsplit[5], attachment: skillsplit[6] }}
			skills(skilldata);
		})
	}
	
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
			othernationality : {
				required:  	function() {
								return $('#nationality').val() == "2";
							}
			},
			otheridcard 	: {
				required:  	function() {
								return $('#nationality').val() == "2";
							}
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
			delivery_card : {
				required:  	function() {
								return $('#registration_card').val() == "1";
							}
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
				maxlength: 20,
				minlength: 10,
			},
			email : {
				required	: true,
				email		: true,
				remote		: 	{
									url		: 	"<?php echo base_url().'authentication/login/emailvalidation'; ?>",
									type	: 	"post",
									async	: 	false,
									data	: 	{
													id : userid
												}
								}
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
			},
			
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
			},
			
			company_details : {
				required:  	function() {
								return $("#employment_details").val() == "1";
							}
			},
			
			attachmenthidden 	: {
				required:  	function() {
								return $(".designation:checked").val() == "4";
							}
			},
			
			
			qualification_year 	: {
				required:  	function() {
								return ($("#designation2").val() == "4" || $("#designation2").val() == "5" || $("#designation2").val() == "6");
							}
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
				required	: "Mobile phone  field is required.",
				maxlength: "Please Enter 20 Numbers Only.",
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
			},
			
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
				number 		: "Numbers Only",
			},
			
			company_details 	: {
				required	: "Please select company.",
			},
			
			attachmenthidden 	: {
				required	: "Please add one skill.",
			},
			
			qualification_year 	: {
				required	: "Please select qualification year.",
			}
		},
		{
			ignore : []
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

$('#nationality').change(function(){
	othernationalityidcardbox($(this).val());
})

function othernationalityidcardbox(value){
	if(value=='2'){
		$('.othernationalityidcardbox').show();
	}else{
		$('.othernationalityidcardbox').hide();
	}
}

$('#registration_card').change(function(){
	deliverycardbox($(this).val());
})

function deliverycardbox(value){
	if(value=='1'){
		$('.deliverycardbox').show();
	}else{
		$('.deliverycardbox').hide();
	}
}

$('#employment_details').change(function(){
	companydetailsbox($(this).val());
})

function companydetailsbox(value){
	if(value=='1'){
		$('.companydetailsbox').show();
	}else{
		$('.companydetailsbox').hide();
	}
}

$('.designation').click(function(){
	designationattachment($(this).val());
})

function designationattachment(value){
	if(value=='4'){
		$('.designationattachment').removeClass('displaynone');
	}else{
		$('.designationattachment').addClass('displaynone');
	}	
}

$('#skillmodal').on('hidden.bs.modal', function () {
    skillsclear();
})

$('.skillsubmit').click(function(){
	if($('.skillform').valid())
	{
		var data = $('.skillform').serialize();
		ajax('<?php echo base_url()."ajax/index/ajaxskillaction"; ?>', data, skills);
	}
})

function skills(data){
	if(data.status==1){		
		var result 		= 	data.result; 
		
		$(document).find('.skillappend[data-id="'+result.id+'"]').remove();
		
		if(result.attachment!=''){
			var ext 		= result.attachment.split('.').pop().toLowerCase();
			if(ext=='jpg' || ext=='jpeg' || ext=='png'){
				var attachment = '<img src="'+filepath+(result.attachment)+'" width="50">';
			}else if(ext=='pdf'){
				var attachment = '<?php echo base_url()."assets/images/pdf.png"?>';
			}
		}else{
			var attachment = '';
		} 
		
		var appenddata 	= 	'\
								<tr class="skillappend" data-id="'+result.id+'">\
									<td>'+formatdate(result.date,1)+'</td>\
									<td>'+result.certificate+'</td>\
									<td>'+result.skillname+'</td>\
									<td>'+result.training+'</td>\
									<td>'+attachment+'</td>\
									<td>\
										<a href="javascript:void(0);" class="skilledit" data-id="'+result.id+'"><i class="fa fa-pencil-alt"></i></a>\
										<a href="javascript:void(0);" class="skillremove" data-id="'+result.id+'"><i class="fa fa-trash"></i></a>\
									</td>\
								</tr>\
							';
					
		$('.skilltable').append(appenddata);
	}
	
	$('#skillmodal').modal('hide');
	
	skillsextras();
}

$(document).on('click', '.skilledit', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxskillaction"; ?>', {'skillid' : $(this).attr('data-id'), 'action' : 'edit'}, skillsedit);
})

function skillsedit(data){
	if(data.status==1){
		var result 	= 	data.result;
		
		$('.skill_date').val(formatdate(result.date, 1));
		$('.skill_certificate').val(result.certificate);
		$('.skill_route').val(result.skills);
		$('.skill_training').val(result.training);
		$('.skill_attachment').val(result.attachment);
		
		if(result.attachment!=''){
			var ext 		= result.attachment.split('.').pop().toLowerCase();
			if(ext=='jpg' || ext=='jpeg' || ext=='png'){
				$('.skill_attachment_image').attr('src', filepath+(result.attachment));	
			}else if(ext=='pdf'){
				$('.skill_attachment_image').attr('src', '<?php echo base_url()."assets/images/pdf.png"?>');	
			}
		} 
		
		$('.skill_id').val(result.id);
		$('#skillmodal').modal('show');
	} 
}


$(document).on('click', '.skillremove', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxskillaction"; ?>', {'skillid' : $(this).attr('data-id'), 'action' : 'delete'}, skillsremove);
	$(this).parent().parent().remove();
	skillsextras();
	
	$('.attachmenthidden').valid();
})

function skillsremove(data){}

function skillsclear(){
	$('.skill_date, .skill_certificate, .skill_route, .skill_training, .skill_attachment').val('');
	$('.skill_attachment_image').attr("src", "<?php echo base_url().'assets/images/profile.jpg'; ?>");
	$('.skillform').find("p.error_class_1").remove();
	$('.skillform').find(".error_class_1").removeClass('error_class_1');
	
	$('.attachmenthidden').valid();
}

function skillsextras(){
	if($(document).find('.skillappend').length){
		$('.skillnotfound').hide();
		$('.attachmenthidden').val('1');
	}else{
		$('.skillnotfound').show();
		$('.attachmenthidden').val('');
	}
}



$('#plumbersubmit').click(function(){
	if($('.form2').valid() && $('.form2').valid()){
		$('.form2').submit();
	}else{
		$('.error_class_1').parents('.collapse').addClass('show');
	}
})

$('.approvalstatus').click(function(){
	rejectwrapper($(this).val());
})

function rejectwrapper(value){
	if(value=='2'){
		$('.reject_wrapper').removeClass('displaynone');
	}else{
		$('.reject_wrapper').addClass('displaynone');
	}	
}

$('.reject_reason').click(function(){
	rejectother();
})

function rejectother(){
	var flag = 0;
	
	$('.reject_reason').each(function(){
		if($(this).is(':checked') && $(this).val()=='4'){
			flag = 1;
		}
	})
	
	if(flag==1){
		$('.reject_reason_other_wrapper').removeClass('displaynone');
	}else{
		$('.reject_reason_other_wrapper').addClass('displaynone');
	}
}

$('#designation2').change(function(){
	designationcondition($(this).val());
})

function designationcondition(value){
	if(value=='4' || value=='5' || value=='6'){
		$('.qualificationyear_wrapper').removeClass('displaynone');
		$('.specialisations_wrapper').removeClass('displaynone');
		$('.qualification_tab_wrapper').removeClass('displaynone');
	}else{
		$('.qualificationyear_wrapper').addClass('displaynone');
		$('.specialisations_wrapper').addClass('displaynone');
		$('.qualification_tab_wrapper').addClass('displaynone');
	}	
}

</script>

