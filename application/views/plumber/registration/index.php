<?php
	$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
	$usersplumberid 		= isset($result['usersplumberid']) ? $result['usersplumberid'] : '';
	
	$email 					= isset($result['email']) ? $result['email'] : '';
	
	$titleid 				= isset($result['title']) ? $result['title'] : '';
	$dob 					= isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
	$name 					= isset($result['name']) ? $result['name'] : '';
	$surname 				= isset($result['surname']) ? $result['surname'] : '';
	$genderid 				= isset($result['gender']) ? $result['gender'] : '1';
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
	$billingemail 			= isset($result['billing_email']) ? $result['billing_email'] : '';
	$billingcontact 		= isset($result['billing_contact']) ? $result['billing_contact'] : '';
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
	
	if($file1!=''){
		$explodefile1 	= explode('.', $file1);
		$extfile1 		= array_pop($explodefile1);
		$identityimg 	= (in_array($extfile1, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file1;
		$identityurl 	= $filepath.$file1;
	}else{
		$identityimg 	= $profileimg;
		$identityurl	= 'javascript:void(0);';
	}
	
	if($file2!=''){
		$explodefile2 	= explode('.', $file2);
		$extfile2 		= array_pop($explodefile2);
		$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
		$photoidurl		= $filepath.$file2;
	}else{
		$photoidimg 	= $profileimg;
		$photoidurl 	= 'javascript:void(0);';
	}
	
	$email2 				= isset($result['email2']) ? $result['email2'] : '';
	$mobilephone2 			= isset($result['mobile_phone2']) ? $result['mobile_phone2'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
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
				<div class="col-md-12 breadcrumb_tab">
					<a href="javascript:void(0);" class="stepbar" data-id="1">Welcome</a>
					<a href="javascript:void(0);" class="stepbar" data-id="2">Personal Details</a>
					<a href="javascript:void(0);" class="stepbar" data-id="3">Billing Details</a>
					<a href="javascript:void(0);" class="stepbar" data-id="4">Employment Details</a>
					<a href="javascript:void(0);" class="stepbar" data-id="5">Designation</a>
					<a href="javascript:void(0);" class="stepbar" data-id="6">Declaration</a>
				</div>
				
				<div class="col-md-12 pagination plm-reg">
					<div class="progressbar_wrapper">
						<div data-label="10%" class="css-bar css-bar-20 progressbar"></div>
					</div>
					<div class="plum-reg-pre-nxt">
						<a href="javascript:void(0);" id="previous">Previous</a>
						<a href="javascript:void(0);" id="next">Next</a>
					</div>
				</div>
				
				<div class="steps active" data-id="1">
					<h4 class="card-title">Registered Plumber Details</h4>
					<p>Welcome to the Plumbing Industry Registration Board (PIRB)</p>
					<p>We would like to commend you for choosing to register with the PIRB. By registering with the PIRB you are ultimately striving towards better plumbing practices within South Africa. </p>
					<p>The PIRB is a professional board and registrar of plumbers in South Africa, as well as a trusted professional body that is recognised by the South African Qualifications Authority (SAQA). We provide a comprehensive registration system for plumbers and, we encourage and monitor their performance for the purpose of protecting the health and safety of both the community and environment. </p>
					<p>The PIRB’s Continuous Professional Development (CPD) process allows for plumbers to continuously improve their skills and knowledge, and ensures that they remain a source of reliable, trustworthy, and well-respected professional tradespeople within the plumbing industry. It also allows for plumbers who are registered with the PIRB as Learners, Technical Assistant Practitioners and Technical Operator Practitioners, to become qualified and appropriately accredited, which further promotes a sense of pride and accountability within the plumbing industry.</p>
					<p>Read more about the various categories under which plumbing practitioners can register with the PIRB: <a href="http://new.pirb.co.za/pirb-designations" target="_blank">http://new.pirb.co.za/pirb-designations</a></p>
					<p>To find out more about the PIRB and what will be expected from you as a plumber, feel free to watch the video at the following Youtube link: <a href="https://www.youtube.com/watch?v=Hzv0CGyJtAs&t=1s" target="_blank">https://www.youtube.com/watch?v=Hzv0CGyJtAs&t=1s</a></p>
				</div>
				
				<div class="steps displaynone" data-id="2">
					<form class="form2">
						<h4 class="card-title">Registered Plumber Details</h4>
					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Title *</label>
									<?php
										echo form_dropdown('title', $titlesign, $titleid, ['id'=>'title', 'class'=>'form-control percentageslide']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<label>Date of Birth *</label>
								<div class="form-group">
									<div class="input-group">
										<input type="text" class="form-control dob percentageslide" name="dob" data-date="datepicker" value="<?php echo $dob; ?>">
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
									<input type="text" class="form-control percentageslide"  id="name" name="name" value="<?php echo $name; ?>">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Surname *</label>
									<input type="text" class="form-control percentageslide" name="surname" id="surname" value="<?php echo $surname; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<?php
										echo form_dropdown('gender', $gender, $genderid, ['id'=>'gender', 'class'=>'form-control percentageslide']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Racial Status *</label>
									<?php
										echo form_dropdown('racial', $racial, $racialid,['id' => 'racial', 'class'=>'form-control percentageslide', 'data-select' => 'select2']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>South African National *</label>
									<?php
										echo form_dropdown('nationality', $yesno, $nationality,['id' => 'nationality', 'class'=>'form-control percentageslide']);
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
										echo form_dropdown('othernationality', $othernationality, $othernationalityid, ['id'=>'othernationality', 'class'=>'form-control percentageslide']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Alternative ID *</label>
									<input type="text" class="form-control percentageslide" name="otheridcard" value="<?php echo $otheridcard; ?>">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Language *</label>
									<?php
										echo form_dropdown('homelanguage', $homelanguage, $homelanguageid, ['id'=>'homelanguage', 'class'=>'form-control percentageslide', 'data-select' => 'select2']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Disability *</label>
									<?php
									echo form_dropdown('disability', $disability, $disabilityid,['id'=>'disability', 'class'=>'form-control percentageslide']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Citizen Residential Status *</label>
									<?php
									echo form_dropdown('citizen', $citizen, $citizenid,['id'=>'citizen', 'class'=>'form-control percentageslide']);
									?>
									</div>
							</div>
						</div>
						<div class="row add_top_value">
							<div class="col-md-6">
								<h4 class="card-title">Identity Document *</h4>
								<div class="form-group">
									<div>
										<a href="<?php echo $identityurl; ?>" target="_blank"><img src="<?php echo $identityimg; ?>" class="document_image" width="100"></a>
									</div>
									<input type="file" id="file" class="document_file">
									<label for="file" class="choose_file">Choose File</label>
									<input type="hidden" name="image1" class="document percentageslide" value="<?php echo $file1; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
							<div class="col-md-3">
								<h4 class="card-title">Photo ID *</h4>
								<div class="form-group">
									<div>
										<a href="<?php echo $photoidurl; ?>" target="_blank"><img src="<?php echo $photoidimg; ?>" class="photo_image" width="100"></a>
									</div>
									<input type="file" id="file_2" class="photo_file">
									<label for="file_2" class="choose_file">Choose File</label>
									<input type="hidden" name="image2" class="photo percentageslide" value="<?php echo $file2; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
							<div class="col-md-3">
								<ul class="file_up_points">
									<li>Photos must be no more than 6 months old</li>
									<li>Photos must be high quality</li>
									<li>Photos must be in colour</li>
									<li>Photos must have clear preferably white background</li>
									<li>Photos must be in sharp focus and clear</li>
									<li>Photo must be only of your head and shoulders</li>
									<li>You must be looking directly at the camera</li>
									<li>No sunglasses or hats</li>
									<li>File name is your NAME and SURNAME.</li>
								</ul>
								<a href="javascript:void(0);" data-toggle="modal" data-target="#photomodal">See Examples</a>
							</div>
						</div>

						<h4 class="card-title">Registration Card</h4>
						<p>Due to the high number of card returns and cost incurred, the registration fees do not include a registration card. Registration cards are available but must be requested separately.  If the registration card option is selected you will be billed accordingly.</p>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Registration Card Required *</label>
									<?php
										echo form_dropdown('registration_card', $yesno, $registrationcard,['id' => 'registration_card', 'class'=>'form-control percentageslide']);
									?>
									</div>
							</div>
							<div class="col-md-6 deliverycardbox">
								<div class="form-group">
									<label>Method of Delivery of Card <span class="delivery_card_required">*</span></label>
									<?php
										echo form_dropdown('delivery_card', $deliverycard, $deliverycardid,['id' => 'delivery_card', 'class'=>'form-control percentageslide']);
									?>
									</div>
							</div>
						</div>
						<div class="row add_top_value">
							<div class="col-md-6">
								<h4 class="card-title">Physical Address</h4>
								<p class="tagline">Note: All delivery services will be sent to this address.</p>
								<div class="form-group">
									<label>Physical Address *</label>
									<input type="hidden" class="form-control" name="address[1][id]" value="<?php echo $addressid1; ?>">
									<input type="hidden" class="form-control" name="address[1][type]" value="1">
									<input type="text" class="form-control percentageslide" name="address[1][address]"  value="<?php echo $address1; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title">Postal Address</h4>
								<p class="tagline">Note: All postal services will be sent to this address.</p>
								<div class="form-group">
									<label>Postal Address *</label>
									<input type="hidden" class="form-control" name="address[2][id]" value="<?php echo $addressid2; ?>">
									<input type="hidden" class="form-control" name="address[2][type]" value="2">
									<input type="text" class="form-control percentageslide" name="address[2][address]" value="<?php echo $address2; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">								
								<div class="form-group"> 
									<label>Province *</label>
									<?php 
										echo form_dropdown('address[1][province]', $province, $province1, ['id' => 'province1', 'class' => 'form-control percentageslide']); 
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
										echo form_dropdown('address[2][province]', $province, $province2, ['id' => 'province2', 'class'=>'form-control percentageslide']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<?php 
										echo form_dropdown('address[1][city]', [], $city1, ['id' => 'city1', 'class' => 'form-control percentageslide']); 
									?>
									<div>
										<a href="javascript:void(0);" id="addcity1">Add City</a>
										<div class="input-group addcity_wrapper displaynone">
											<input type="text" class="form-control" placeholder="Add City">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" id="addcitysubmit1" type="button">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<?php 
										echo form_dropdown('address[2][city]', [], $city2, ['id' => 'city2', 'class' => 'form-control percentageslide']); 
									?>
									<div>
										<a href="javascript:void(0);" id="addcity2">Add City</a>
										<div class="input-group addcity_wrapper displaynone">
											<input type="text" class="form-control" placeholder="Add City">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" id="addcitysubmit2" type="button">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<?php
										echo form_dropdown('address[1][suburb]', [], $suburb1, ['id' => 'suburb1', 'class'=>'form-control percentageslide']);
									?>
									<div>
										<a href="javascript:void(0);" id="addsuburb1">Add Suburb</a>
										<div class="input-group addsuburb_wrapper displaynone">
											<input type="text" class="form-control" placeholder="Add Suburb">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" id="addsuburbsubmit1" type="button">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<?php
										echo form_dropdown('address[2][suburb]', [], $suburb2, ['id' => 'suburb2', 'class'=>'form-control percentageslide']);
									?>
									
									<div>
										<a href="javascript:void(0);" id="addsuburb2">Add Suburb</a>
										<div class="input-group addsuburb_wrapper displaynone">
											<input type="text" class="form-control" placeholder="Add Suburb">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" id="addsuburbsubmit2" type="button">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 offset-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control percentageslide" name="address[2][postal_code]" value="<?php echo $postalcode2; ?>">
								</div>
							</div>
						</div>
						<h4 class="card-title add_top_value">Contact Details</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Phone:</label>
									<input type="text" class="form-control" name="home_phone" id="home_phone" value="<?php echo $homephone; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile Phone *</label>
									<input type="text" class="form-control percentageslide" name="mobile_phone" id="mobile_phone" value="<?php echo $mobilephone; ?>">
									<p>Note: All SMS and OTP notifications will be sent to this mobile number above.</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Work Phone:</label>
									<input type="text" class="form-control" name="work_phone" id="work_phone" value="<?php echo $workphone; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Secondary Mobile Phone</label>
									<input type="text" class="form-control" name="mobile_phone2" id="mobile_phone2" value="<?php echo $mobilephone2; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address *</label>
									<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" disabled>
									<p>Note: This email will be used as your user profile name and all emails notifications will be sent to it.</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Secondary Email Address</label>
									<input type="text" class="form-control" name="email2" value="<?php echo $email2; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" id="submit2" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="3">
					<form class="form3">
						<h4 class="card-title">Billing Details</h4>
						<p>All invoices generated, will be used this billing information.</p>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Billing Name *</label>
									<input type="text" class="form-control percentageslide" name="company_name" value="<?php echo $companyname; ?>">
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
									<label>Company VAT Number</label>
									<input type="text" class="form-control" name="vat_no" value="<?php echo $vatno; ?>">
								</div>
							</div>                            
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Email *</label>
									<input type="text" class="form-control percentageslide" name="billing_email" value="<?php echo $billingemail; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Contact *</label>
									<input type="text" class="form-control percentageslide" id="billing_contact" name="billing_contact" value="<?php echo $billingcontact; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Address *</label>
									<input type="hidden" class="form-control" name="address[3][id]" value="<?php echo $addressid3; ?>">
									<input type="hidden" class="form-control" name="address[3][type]" value="3">
									<input type="text" class="form-control percentageslide" name="address[3][address]" value="<?php echo $address3; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Province *</label>
									<?php
										echo form_dropdown('address[3][province]', $province, $province3, ['id' => 'province3', 'class'=>'form-control percentageslide']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City *</label>
									<?php 
										echo form_dropdown('address[3][city]', [], $city3, ['id' => 'city3', 'class' => 'form-control percentageslide']); 
									?>
									<div>
										<a href="javascript:void(0);" id="addcity3">Add City</a>
										<div class="input-group addcity_wrapper displaynone">
											<input type="text" class="form-control" placeholder="Add City">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" id="addcitysubmit3" type="button">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb *</label>
									<?php 
										echo form_dropdown('address[3][suburb]', [], $suburb3, ['id' => 'suburb3', 'class'=>'form-control percentageslide']);
									?>
									<div>
										<a href="javascript:void(0);" id="addsuburb3">Add Suburb</a>
										<div class="input-group addsuburb_wrapper displaynone">
											<input type="text" class="form-control" placeholder="Add Suburb">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" id="addsuburbsubmit3" type="button">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control percentageslide" name="address[3][postal_code]" value="<?php echo $postalcode3; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" id="submit3" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="4">
					<form class="form4">
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Employment Details</h4>
								<div class="form-group">
									<label>Your Employment Status</label>
									<?php
										echo form_dropdown('employment_details', $employmentdetail, $employmentdetailsid,['id' => 'employment_details', 'class'=>'form-control percentageslide']);
									?>
								</div>
							</div>
							<div class="col-md-6 companydetailsbox">
								<h4 class="card-title">Company Details</h4>
								<div class="form-group">
									<label>Company *</label>
									<?php
										echo form_dropdown('company_details', $company, $companydetailsid,['id' => 'company_details', 'class'=>'form-control percentageslide']);
									?>									
								</div>
								<p>If the Company does not appear on this list please ask the company to register with the PIRB. Once they have been approved and registered, return to the list and select the company</p>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" id="submit4" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="5">
					<form class="form5">
						<h4 class="card-title">Designation</h4>
						<p>Applications for Master Plumber and/or specialisations can only be done once your registration has been verified and approved.</p>
						<p>Please select the relevant designation being applied for. <a style="margin-left: 10px;" href="http://new.pirb.co.za/pirb-designations/" target="_blank">View the designation requirements</a></p>                    	
						<p class="mt-5">Registation fees can be viewed in <a href="http://new.pirb.co.za/registration-fees/" target="_blank">here</a></p>
						<p>Admin fee : <?php echo $latefee; ?></p>
						<p>Plumber Card cost : <?php echo $cardfee; ?></p>
						<?php 
							foreach($designation1 as $k => $design){
								echo sprintf($design, $plumberrates[$k]);
							}
						?>
						<div class="designationattachment displaynone">
							<h4 class="card-title">Attachments</h4>
							<p>Please attach ALL your relevant trade certificates, course certificates, evidence that supports your registration application:</p>
							<table class="table table-bordered skilltable">
								<tr>
									<td>Date of Qualification/Skill Obtained</td>
									<td>Certificate Number</td>
									<td>Qualification Type</td>
									<td>Qualification Route</td>
									<td>Training Provider</td>
									<td>Attachments</td>
									<td>Action</td>
								</tr>
								<tr class="skillnotfound"><td colspan="7">No Record Found</td></tr>
							</table>
							<div class="col-md-12 text-right">
								<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#skillmodal">Add Cert/Skill</button>
							</div>
							<input type="hidden" class="attachmenthidden" name="attachmenthidden"> 
							<?php echo $criminalact; ?>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" id="submit5" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="6">
					<form class="form6" method="post" action="">
						<div class="row">
							<?php echo $registerprocedure; ?>
							<label class="checkbox">
								<input type="checkbox" name="registerprocedure" data-checkbox="checkbox1">
								<p>I declare that I have fully read and understood the Procedure of Registration</p>
							</label>
							<?php echo $acknowledgement; ?>
							<label class="checkbox">
								<input type="checkbox" name="acknowledgement" data-checkbox="checkbox1">
								<p>I declare that I have fully read and understood the Procedure of Acknowledgement</p>
							</label>
							<?php echo $codeofconduct; ?>
							<div class="col-md-12">
								<label class="checkbox">
									<input type="checkbox" name="codeofconduct" data-checkbox="checkbox1">
									<p>I declare that I have fully read and understood the PIRB's Code of Conduct</p>
								</label>
							</div>
							<div class="col-md-12">
								<label class="checkbox">								
									<input type="checkbox" name="declaration" data-checkbox="checkbox1">
									<p class="inlineblock">I</p>
									<input type="text" class="declarationname" name="declarationname" data-textbox="textbox1" placeholder="Name and surname"> 
									<p> Identity Number</p> 
									<input type="text" class="declarationidno" name="declarationidno" data-textbox="textbox1" placeholder="ID number or alternate id">
								</label>
							</div>
							<?php echo $declaration; ?>
							<div class="col-md-12 text-right">
								<input type="hidden" name="application_received" value="<?php echo date('Y-m-d'); ?>">
								<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">
								<input type="hidden" name="usersplumberid" id="usersplumberid" value="<?php echo $usersplumberid; ?>">
								<button type="button" name="submit" value="submit" id="submit" class="btn btn-primary">Submit Application</button>
								<input type="submit" id="completeapplication" class="displaynone">
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

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
								<label>Qualification Type</label>
								<?php
								echo form_dropdown('skill_qualification_type', $qualificationtype, '', ['id' => 'skill_qualification_type', 'class'=>'form-control skill_qualification_type']);
								?>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Qualification/Skills Route</label>
								<?php
								echo form_dropdown('skill_route', $qualificationroute, '', ['id' => 'skill_route', 'class'=>'form-control skill_route']);
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
					<input type="hidden" name="user_id" value="<?php echo $userid; ?>">
					<button type="button" class="btn btn-success skillsubmit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="photomodal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<img src="<?php echo base_url().'assets/images/photoid.png'; ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="otpmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="form-group">
							<h4 class="mb-15">Please confirm that you wish to submit your PIRB Registation Application.</h4>
							<h4>A One Time Pin (OTP) was sent to the following Mobile Number : <span id="otpmobile"></span></h4>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<input id="sampleotp" type="text" class="form-control displaynone" readonly>
							<label>Enter OTP</label>
							<input type="text" name="otp" id="otp" class="form-control">
						</div>
					</div>
					<div class="col-md-12 text-center">
						<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-success resendotp">Resend</button>
						<button type="button" class="btn btn-success verifyotp">Verify</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var userid				= '<?php echo $userid; ?>';
var filepath 			= '<?php echo $filepath; ?>';
var pdfimg				= '<?php echo $pdfimg; ?>';
var qualificationtype	= $.parseJSON('<?php echo json_encode($qualificationtype); ?>');

$(function(){
	checkstep();
	select2('#title, #gender, #racial, #nationality, #othernationality, #homelanguage, #disability, #citizen, #registration_card, #delivery_card, #province1, #city1, #suburb1, #province2, #city2, #suburb2, #province3, #city3, #suburb3, #employment_details, #company_details, #skill_route');
	datepicker('.dob, .skill_date');
	inputmask('#home_phone, #work_phone, #mobile_phone, #mobile_phone2, #billing_contact', 1);
	fileupload([".document_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.document', '.document_image', filepath, pdfimg]);
	fileupload([".photo_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.photo', '.photo_image', filepath, pdfimg]);
	fileupload([".skill_attachment_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.skill_attachment', '.skill_attachment_image', filepath, pdfimg]);
	citysuburb(['#province1','#city1', '#suburb1'], ['<?php echo $city1; ?>', '<?php echo $suburb1; ?>'], ['#addcity1', '#addcitysubmit1', '#addsuburb1', '#addsuburbsubmit1']);
	citysuburb(['#province2','#city2', '#suburb2'], ['<?php echo $city2; ?>', '<?php echo $suburb2; ?>'], ['#addcity2', '#addcitysubmit2', '#addsuburb2', '#addsuburbsubmit2']);
	citysuburb(['#province3','#city3', '#suburb3'], ['<?php echo $city3; ?>', '<?php echo $suburb3; ?>'], ['#addcity3', '#addcitysubmit3', '#addsuburb3', '#addsuburbsubmit3']);
	
	var nationality = $('#nationality').val();
	othernationalityidcardbox(nationality, 1);
	
	var registrationcard = $('#registration_card').val();
	deliverycardbox(registrationcard);
	
	var employmentdetails = $('#employment_details').val();
	companydetailsbox(employmentdetails);
	
	var designationid = '<?php echo $designationid; ?>';
	if(designationid!='') $('input[name="designation"][value="'+designationid+'"]').prop('checked', true);
	designationattachment(designationid);
	
	var skill = $.parseJSON('<?php echo addslashes(json_encode($skills)); ?>');
	if(skill.length > 0){
		$(skill).each(function(i, v){
			var skillsplit 	= v.split('@@@');
			var skilldata 	= {status : 1, result : { id: skillsplit[0], date: skillsplit[2], certificate: skillsplit[3], qualification: skillsplit[4], skillname: skillsplit[8], training: skillsplit[6], attachment: skillsplit[7] }}
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
				lettersonly	: true
			},
			surname : {
				required	: true,
				lettersonly	: true
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
				required	: false,
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
				required	: true
			},
			email : {
				required	: true,
				email		: true,
				remote		: 	{
									url		: 	"<?php echo base_url().'authentication/login/emailvalidation'; ?>",
									type	: 	"post",
									async	: 	false,
									data	: 	{
													id : userid,
													type: 3
												}
								}
			},
			idcard : {
				maxlength: 13,
				minlength: 13,
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
				required	: "Alternative ID Card  field is required.",
			},
			homelanguage : {
				required	: "Home Language field is required.",
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
				required	: "Mobile phone  field is required."
			},
			email : {
				required	: "Email  field is required.",
				email       : "Please Enter Valid Mail",
				remote		: "Email already exists."
			},
			idcard : {
				maxlength: "Please Enter 13 Numbers Only.",
				minlength: "Please Enter 13 Numbers Only.",
			}
		},
		{
			ignore : []
		}
	);

	validation(
		'.form3',
		{
			company_name : {
				required	: true,
			},
			billing_email : {
				required	: true,
				email		: true
			},
			billing_contact : {
				required	: true
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
			billing_email : {
				required	: "Billing email field is required.",
				email		: "Enter valid email address"
			},
			billing_contact : {
				required	: "Billing contact field is required.",
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
			}
		},
		{
			ignore : []
		}
	);

	validation(
		'.form4',
		{
			company_details : {
				required:  	function() {
								return $("#employment_details").val() == "1";
							}
			}
		},
		{
			company_details 	: {
				required	: "Please select company.",
			}
		},
		{
			ignore : [],
		}
	);
	
	validation(
		'.form5',
		{
			designation 		: {
				required	: true,
			},
			attachmenthidden 	: {
				required:  	function() {
								return $(".designation:checked").val() == "4";
							},
				remote	: 	{
								url		: 	"<?php echo base_url().'ajax/index/ajaxqualificationvalidation'; ?>",
								type	: 	"post",
								async	: 	false,
								data	: 	{
												id 			: 	userid,
												designation	: 	function() {
																	return $(".designation:checked").val();
																}
											}
							}
			},
			criminalact 		: {
				required:  	function() {
								return $(".designation:checked").val() == "4";
							}
			}
		},
		{
			designation 		: {
				required	: "Please select designation.",
			},
			attachmenthidden 	: {
				required	: "No qualifications found",
				remote		: "Add the relevant qualification to the table."
			},
			criminalact 		: {
				required	: "Please check skill are correct.",
			}
		},
		{
			ignore : []
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
			},
			declarationname : {
				required	: true,
			},
			declarationidno : {
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
			},
			declarationname : {
				required	: "Please enter name.",
			},
			declarationidno : {
				required	: "Please enter ID number.",
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
			skill_qualification_type : {
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
			skill_qualification_type 	: {
				required	: "Please Select Qualification Type.",
			},
			skill_route : {
				required	: "Please Select Employment Status.",
			},
			skill_training : {
				required	: "Please Enter Training Provider.",
			},
			skill_attachment : {
				required	: "Choose File Please",
			}
		},
		{
  			ignore : '.test',
   		}
	);
})

$('#submit2,#submit3,#submit4,#submit5').click(function(){
	var _this 	= $(this);
	var data 	= _this.parents('form').serialize()+'&'+$.param({ 'usersdetailid': $('#usersdetailid').val(), 'usersplumberid': $('#usersplumberid').val() });
	ajax('<?php echo base_url()."/plumber/registration/index/ajaxregistration"; ?>', data, registration, { beforesend : function(){ _this.attr('disabled','disabled') }, complete : function(){ _this.removeAttr('disabled'); sweetalertautoclose('Successfully Saved.'); } });
})

$('#submit').click(function(e){
	var formvalid = 0;
	for(var i=2; i<=6; i++){
		if($('.form'+i).valid()==false){
			if(formvalid==0) formvalid = i; 
		}
	}
	
	if(formvalid==0){		
		for(var i=2; i<=5; i++){		
			var data = $('#submit'+i).parents('form').serialize()+'&'+$.param({ 'usersdetailid': $('#usersdetailid').val(), 'usersplumberid': $('#usersplumberid').val() });
			ajax('<?php echo base_url()."/plumber/registration/index/ajaxregistration"; ?>', data, registration, { asynchronous : 1 });				
		}
		
		ajaxotp();
		$('#otpmobile').text($('#mobile_phone').val());
		$('#otpmodal').modal('show');
		return true;
	}else{
		alert('Before submitting please check the form');
		$('.stepbar[data-id="'+formvalid+'"]').click();
		return false;
	}
})

$(document).on('click', '.resendotp', function(){
	ajaxotp();
});

function ajaxotp(){
	ajax('<?php echo base_url().'ajax/index/ajaxotp'; ?>', {}, '', { 
		success:function(data){
			if(data!=''){
				$('#sampleotp').removeClass('displaynone').val(data);
			}
		}
	})
}

$(document).on('click', '.verifyotp', function(){
	$('.error_otp').remove();
	var otp = $('#otp').val();
	
	ajax('<?php echo base_url().'ajax/index/ajaxotpverification'; ?>', {otp: otp}, '', { 
		success:function(data){
			if (data == 0) {
				$('#otp').parent().append('<p class="tagline error_otp">Incorrect OTP</p>');
			}else{
				$('#completeapplication').click();
			}
		}
	})
});

$('a.stepbar[data-id="1"]').addClass('active');

$('.stepbar').click(function(){
	var step = $(this).attr('data-id');
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	$('.stepbar.active').addClass('un_active').removeClass('active');
	$('.stepbar[data-id="'+step+'"]').removeClass('un_active').addClass('active');
	
	checkstep();
})

$('#next').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))+1;
	
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	$('.stepbar.active').addClass('un_active').removeClass('active');	
	$('.stepbar[data-id="'+step+'"]').removeClass('un_active').addClass('active');	
	
	checkstep();
})

$('#previous').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))-1;
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	$('.stepbar.active').addClass('un_active').removeClass('active');	
	$('.stepbar[data-id="'+step+'"]').removeClass('un_active').addClass('active');	
	
	checkstep();
})

function checkstep(){
	$('#next, #previous').removeClass('not_working');
	
	var step = $('.steps.active').attr('data-id');
		
	if(step=='1'){
		$('#previous').addClass('not_working');
	}else if(step=='6'){
		$('#next').addClass('not_working');
		
		if($('#nationality').val()=='1'){
			var declarationidno = $('input[name="idcard"]').val();
		}else{
			var declarationidno = $('input[name="otheridcard"]').val();
		}
		$('.declarationname').val($('input[name="name"]').val()+' '+$('input[name="surname"]').val());
		$('.declarationidno').val(declarationidno);
	}
	
	profilecompleteness()
}


function profilecompleteness(){
	var percentageslide = $('.percentageslide').length+1;
	var fillpercentage 	= 0;
	
	if($('#nationality').val()=='1') percentageslide = percentageslide-2;
	if($('#registration_card').val()=='2') percentageslide = percentageslide-1;
	if($('#employment_details').val()=='2') percentageslide = percentageslide-1;	
	if($('.designation:checked').val()=='4') percentageslide = percentageslide+1;
	
	$('.percentageslide').each(function(){
		if($(this).val()!=''){
			fillpercentage = fillpercentage + 1;
		}
	})
	
	if($('#nationality').val()=='1') fillpercentage = fillpercentage-2;
	if($('#registration_card').val()=='2') fillpercentage = fillpercentage-1;
	if($('#employment_details').val()=='2') fillpercentage = fillpercentage-1;
	if($('.designation').is(':checked')) fillpercentage = fillpercentage + 1;
	if($('.designation:checked').val()=='4' && $('.attachmenthidden').val()!='') fillpercentage = fillpercentage+1;

	var percentage 		= Math.round((fillpercentage / percentageslide) * 100);
	var percentagemod 	= percentage - (percentage % 5);
	
	$(document).find('.progressbar').attr('data-label', percentage).removeClass().addClass('css-bar css-bar-'+percentagemod+' progressbar');
}

function registration(data){
	if(data.status=='0'){
		alert('Try Later');
	}else{
		if(data.result.usersdetailid) $('#usersdetailid').val(data.result.usersdetailid);
		if(data.result.usersplumberid) $('#usersplumberid').val(data.result.usersplumberid);
		if(data.result.usersaddressinsertid){
			$.each(data.result.usersaddressinsertid, function(i, v){
				$('input[name="address['+i+'][id]"]').val(v);
			});
		}
	}
}

$('#nationality').change(function(){
	othernationalityidcardbox($(this).val());
})

function othernationalityidcardbox(value, citizen=''){
	if(value=='2'){
		$('.othernationalityidcardbox').show();
	}else{
		$('.othernationalityidcardbox').hide();
	}
	
	$('#citizen option[value="4"]').removeAttr('disabled');
		
	if(value=='1'){
		$('#citizen').val('4').trigger('change');;
	}else if(value=='2'){
		$('#citizen option[value="4"]').attr('disabled', 'disabled');
		$('#citizen').val('2').trigger('change');
	}
	
	if(citizen==1) $('#citizen').val('<?php echo $citizenid; ?>').trigger('change');
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
				var attachment = '<a href="'+filepath+(result.attachment)+'" target="_blank"><img src="'+filepath+(result.attachment)+'" width="50"></a>';
			}else if(ext=='pdf'){
				var attachment = '<a href="'+filepath+(result.attachment)+'" target="_blank"><?php echo base_url()."assets/images/pdf.png"?></a>';
			}
		}else{
			var attachment = '';
		} 
		
		var appenddata 	= 	'\
								<tr class="skillappend" data-id="'+result.id+'">\
									<td>'+formatdate(result.date,1)+'</td>\
									<td>'+((result.certificate!=undefined && result.certificate!='') ? result.certificate :  "")+'</td>\
									<td>'+((result.qualification!=undefined && result.qualification!='' && qualificationtype[result.qualification]!=undefined) ? qualificationtype[result.qualification] :  "")+'</td>\
									<td>'+((result.skillname!=undefined && result.skillname!='') ? result.skillname :  "")+'</td>\
									<td>'+((result.training!=undefined && result.training!='') ? result.training :  "")+'</td>\
									<td>'+((attachment!=undefined && attachment!='') ? attachment :  "")+'</td>\
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
		$('.skill_certificate').val(((result.certificate!=undefined && result.certificate!='') ? result.certificate :  ""));
		$('.skill_qualification_type').val(((result.qualification!=undefined && result.qualification!='') ? result.qualification :  "")).trigger('change');;
		$('.skill_route').val(((result.skills!=undefined && result.skills!='') ? result.skills :  "")).trigger('change');
		$('.skill_training').val(((result.training!=undefined && result.training!='') ? result.training :  ""));
		$('.skill_attachment').val(((result.attachment!=undefined && result.attachment!='') ? result.attachment :  ""));
		
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
	$('.skill_date, .skill_certificate, .skill_training, .skill_attachment').val('');
	$('.skill_attachment_image').attr("src", "<?php echo base_url().'assets/images/profile.jpg'; ?>");
	$('.skillform').find("p.error_class_1").remove();
	$('.skillform').find(".error_class_1").removeClass('error_class_1');
	$('.skill_route').val('').trigger('change');
	$('.skill_qualification_type').val('').trigger('change');
	
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
	
	$(".attachmenthidden").removeData("previousValue");
}

$('#name').bind('keyup blur', function() { 
    $(this).val(function(i, val) {
        return val.replace(/[^a-z\s]/gi,''); 
    });
});

$('#surname').bind('keyup blur', function() { 
    $(this).val(function(i, val) {
        return val.replace(/[^a-z\s]/gi,''); 
    });
});

</script>

