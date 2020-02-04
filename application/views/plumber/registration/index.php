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
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-md-12">
					<a href="javascript:void(0);" class="stepbar" data-id="1">Welcome</a>
					<a href="javascript:void(0);" class="stepbar" data-id="2">Personal Details</a>
					<a href="javascript:void(0);" class="stepbar" data-id="3">Billing Details</a>
					<a href="javascript:void(0);" class="stepbar" data-id="4">Employment Details</a>
					<a href="javascript:void(0);" class="stepbar" data-id="5">Designation</a>
					<a href="javascript:void(0);" class="stepbar" data-id="6">Declaration</a>
				</div>
				
				<div class="col-md-12">
					<a href="javascript:void(0);" id="previous">Previous</a>
					<a href="javascript:void(0);" id="next">Next</a>
				</div>
				
				<div class="steps active" data-id="1">
					<h4 class="card-title">Registered Plumber Details</h4>
					<p>
						Donec augue enim, volutpat at ligula et, dictum laoreet sapien. Sed maximus feugiat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla eu mollis leo, eu elementum nisl. Curabitur cursus turpis nibh, egestas efficitur diam tristique non. Proin faucibus erat ligula, nec interdum odio rhoncus vel. Nulla facilisi. Nulla vehicula felis lorem, sed molestie lacus maximus quis. Mauris dolor enim, fringilla ut porta sed, ullamcorper id quam. Integer in eleifend justo, quis cursus odio. Pellentesque fermentum sapien elit, aliquam rhoncus neque semper in. Duis id consequat nisl, vitae semper elit. Nulla tristique lorem sem, et pretium magna cursus sit amet. Maecenas malesuada fermentum mauris, at vestibulum arcu vulputate a.
					</p>
				</div>
				
				<div class="steps displaynone" data-id="2">
					<form class="form2">
						<h4 class="card-title">Registered Plumber Details</h4>
					
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
							<div class="col-md-6">
								<h4 class="card-title">Identity Document *</h4>
								<div class="form-group">
									<div>
										<img src="<?php echo ($file1!='') ? $filepath.$file1 : base_url().'assets/images/profile.jpg'; ?>" class="document_image" width="100">
									</div>
									<input type="file" class="document_file">
									<input type="hidden" name="image1" class="document" value="<?php echo $file1; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
							<div class="col-md-3">
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
							<div class="col-md-3">
								<ul>
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
								<a>See Examples</a>
							</div>
						</div>

						<h4 class="card-title">Registration Card</h4>
						<p>Due to the high number of card returns and cost incurred the registration fees do not include a registration card. Registration cards are available but must be requested separately.  If registration card is selected you will be billed accordingly.</p>

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
									<label>Email Address *</label>
									<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
									<p>Note: this email will be used as your user profile name and all emails notifications will be sent to it</p>
								</div>
							</div>
						</div>
						<button type="button" id="submit2" class="btn btn-primary">Save</button>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="3">
					<form class="form3">
						<h4 class="card-title">Billing Details</h4>
						<p>All invocies genreated will used this billing information.</p>
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
						<button type="button" id="submit3" class="btn btn-primary">Save</button>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="4">
					<form class="form4">
						<div class="row">
							<div class="col-md-12">
								<h4 class="card-title">Employment Details</h4>
								<div class="form-group">
									<label>Your Employment Status</label>
									<?php
										echo form_dropdown('employment_details', $employmentdetail, $employmentdetailsid,['class'=>'form-control', 'id' => 'employment_details']);
									?>
								</div>
							</div>
							<div class="col-md-12 companydetailsbox">
								<h4 class="card-title">Company Details</h4>
								<div class="form-group">
									<label>Company *</label>
									<?php
										echo form_dropdown('company_details', $company, $companydetailsid,['class'=>'form-control']);
									?>
									<p>If the Compnay does not appear on this listing please ask the company to Register with the PIRB.  Once they have been apporved and registered return to the listing and select the company</p>
									<a href="javascript:void(0)">Register Company with the PIRB</a>
								</div>
							</div>
						</div>
						<button type="button" id="submit4" class="btn btn-primary">Save</button>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="5">
					<form class="form5">
						<h4 class="card-title">Designation</h4>
						<p>Applications for Master Plumber and or specialisations can only be done once your registration has been verified and approved. See Application for further designations/specializations</p>
						<p>Please select the relevant designation being applied for. <a style="margin-left: 10px;" href="javascript:void()">View the designation requirements</a></p>                    	
						<?php 
							foreach($designation1 as $k => $design){
								echo sprintf($design, $plumberrates[$k]);
							}
						?>
						<div class="designationattachment displaynone">
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
							<div>
								<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#skillmodal">Add Cert/Skill</button>
							</div>
							<input type="hidden" class="attachmenthidden" name="attachmenthidden"> 
							<?php echo $criminalact; ?>
						</div>
						<button type="button" id="submit5" class="btn btn-primary">Save</button>
					</form>
				</div>
				
				<div class="steps displaynone" data-id="6">
					<form class="form6" method="post">
						<div class="row">
							<?php echo $registerprocedure; ?>
							<div>
								<input type="checkbox" name="registerprocedure">
								I declare that I have fully read and understood the Procedure of Registration
							</div>
							<?php echo $acknowledgement; ?>
							<div>
								<input type="checkbox" name="acknowledgement">
								I declare that I have fully read and understood the Procedure of Acknowledgement
							</div>
							<?php echo $codeofconduct; ?>
							<div>
								<input type="checkbox" name="codeofconduct">
								I declare that I have fully read and understood the PIRB's Code of Conduct
							</div>
							<div>
								<input type="checkbox" name="declaration">
								I <input type="text" class="declarationname" disabled> identity number <input type="text" class="declarationidno" disabled>
							</div>
							<?php echo $declaration; ?>
							<div class="col-md-12 text-right">
								<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">
								<input type="hidden" name="usersplumberid" id="usersplumberid" value="<?php echo $usersplumberid; ?>">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Submit Application</button>
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
var pdfimg		= '<?php echo base_url()."assets/images/pdf.png"?>';

$(function(){
	checkstep();
	datepicker('.dob');
	datepicker('.skill_date');
	fileupload([ajaxfileurl, ".document_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf']], ['.document', '.document_image', filepath, pdfimg]);
	fileupload([ajaxfileurl, ".photo_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf']], ['.photo', '.photo_image', filepath, pdfimg]);
	fileupload([ajaxfileurl, ".skill_attachment_file", "./assets/uploads/plumber/"+userid+"/", ['jpg','gif','jpeg','png','pdf']], ['.skill_attachment', '.skill_attachment_image', filepath, pdfimg]);
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
								return $("#employment_details").val() == "4";
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
				required	: "Please add one skill.",
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

$('#submit2,#submit3,#submit4,#submit5').click(function(){
	var data = $(this).parent('form').serialize()+'&'+$.param({ 'usersdetailid': $('#usersdetailid').val(), 'usersplumberid': $('#usersplumberid').val() });
	ajax('<?php echo base_url()."/plumber/registration/index/ajaxregistration"; ?>', data, registration);
})

$('#submit').click(function(e){
	var formvalid = 0;
	for(var i=2; i<=6; i++){
		if($('.form'+i).valid()==false){
			if(formvalid==0) formvalid = i; 
		}
	}
	
	if(formvalid==0){		
		return true;
	}else{
		alert('Before submitting please check the form');
		$('.stepbar[data-id="'+formvalid+'"]').click();
		return false;
	}
})

$('.stepbar').click(function(){
	var step = $(this).attr('data-id');
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
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
	}else if(step=='6'){
		$('#next').addClass('displaynone');
		
		$('.declarationname').val($('input[name="name"]').val());
		$('.declarationidno').val($('input[name="idcard"]').val());
	}
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
</script>

