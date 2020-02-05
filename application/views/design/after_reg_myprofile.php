<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My Profile</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My Profile</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">My PIRB Registration Details</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Registration Number</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Next Renewal Date</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>PIRB Designation</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-12">
							<h4 class="card-title">PIRB Specialisations</h4>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="solar">
	                                <label class="custom-control-label" for="solar">-Solar</label>
	                            </div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="gas">
	                                <label class="custom-control-label" for="gas">-Gas</label>
	                            </div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="plumbing_estimator">
	                                <label class="custom-control-label" for="plumbing_estimator">-Plumbing estimator</label>
	                            </div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="hp">
	                                <label class="custom-control-label" for="hp">-Heat Pump</label>
	                            </div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="pta">
	                                <label class="custom-control-label" for="pta">-Plumbing Training Assessor</label>
	                            </div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="pa">
	                                <label class="custom-control-label" for="pa">-Plumbing Arbitrator</label>
	                            </div>
							</div>
						</div>
					</div>

					<div class="row mt_20">
						<div class="col-md-6">	
							<table id="id_Card">
								<tbody>
									<tr>
										<td>
											<img class="id_logo" src="<?php echo base_url();?>assets/images/pitrb-logo.png">
											<p>Reg No: 7077/16</p>
											<p>Renewal Date: 07/08/2020</p>
										</td>
										<td>
											<img class="id_admin" src="<?php echo base_url();?>assets/images/profile.jpg">
											<p>Admin Name</p>
										</td>
									</tr>
									<tr style="background-color: #E4010C">
										<td>
											<img class="plum_lic" src="<?php echo base_url()?>assets/images/Plumber_License.png">
										</td>
										<td>
											<p class="license">Licensed Plumber</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-md-6">
							<table id="id_Card_back">
									<tbody style="width: 90%; display: inline-block;">
										<tr>
											<td colspan="2">
												<p>This card holder is only entitled to purchase and issue Plumbing COC’s for the following categories of plumbing and plumbing specialisations</p>
											</td>
										</tr>
										<tr>
											<td>
												<ul>
													<li>Above Ground Drainage</li>
													<li>Below Ground Drainage</li>
													<li>Rain Water Drainage</li>
												</ul>
											</td>
											<td>
												<ul>
													<li>Cold Water</li>
													<li>Hot Water</li>
												</ul>
											</td>
										</tr>
										<tr style="border-top: 1px solid #000;">
											<td style="border-right: 1px solid #000; height: 92px;">
												<span>Current Employer: </span> <p class="plumber_name">C.W. Plumbers</p>
											</td>
											<td>
												<p>Specialisations</p>
											</td>
										</tr>
									</tbody>
									<tbody style="width: 10%; display: inline-block;">
										<tr style="height: 266px;">
											<td colspan="2" style="text-align: center; padding: 0px;  background-color: #e4010c; color: #fff;">
												<p class="back_license" style="transform: rotate(-90deg);margin: -66px;">Licensed Plumber</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							
						</div>

					<div class="row add_top_value">
						<div class="col-md-6">
							<div class="form-group">
								<label>Number of CoC's Able to purchase</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6 mt_40">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="coc_login">
	                                <label class="custom-control-label" for="coc_login">Allow for Electronic COC's loging</label>
	                            </div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Specific Message</label>
								<textarea class="form-control" name="" id=""></textarea>
							</div>
						</div>

						<div class="col-md-12 text-right">
							<div class="form-group">
								<a href="#">View the PIRB's Code of Conduct and Terms</a>
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-12">
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
										<select name="title" id="title" class="form-control">
											<option value="1">Mr</option>
											<option value="2">Mrs</option>
											<option value="3">Miss</option>
											<option value="4">Other</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Date of Birth *</label>
										<input type="text" class="form-control dob" name="dob" value="">
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name *</label>
									<input type="text" class="form-control"  name="name"  value="">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Surname *</label>
									<input type="text" class="form-control" name="" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<select name="gender" id="gender" class="form-control">
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Racial Status *</label>
									<select name="racial" class="form-control">
										<option value="1">African</option>
										<option value="2">Indian</option>
										<option value="3">Coloured</option>
										<option value="4">White</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>South African National *</label>
									<select name="nationality" class="form-control">
										<option value="1">Yes</option>
										<option value="2">No</option>
									</select>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ID Number</label>
									<input type="text" class="form-control" name="" value="">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Other Nationality *</label>
									<input type="text" class="form-control" name="othernationality" value="">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Alternate ID</label>
									<input type="text" class="form-control" name="" value="">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Language *</label>
									<select name="homelanguage" class="form-control">
										<option value="1">Afrikaans</option>
										<option value="2">English</option>
										<option value="3">isiNdebele</option>
										<option value="4">isiXhosa</option>
										<option value="5">isiZulu</option>
										<option value="6">Other</option>
										<option value="7">sePedi</option>
										<option value="8">seSotho</option>
										<option value="9">seTswana</option>
										<option value="10">siSwati</option>
										<option value="11">South African Sign Language</option>
										<option value="12">tshiVenda</option>
										<option value="13">Unknown</option>
										<option value="14">xiTsonga</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Disability *</label>
									<select name="disability" class="form-control">
										<option value="1">Communication(talk/listen)</option>
										<option value="2">Disabled but unspecified</option>
										<option value="3">Emotional (behav/psych)</option>
										<option value="4">Hearing (even with h. aid)</option>
										<option value="5">Intellectual (learn etc)</option>
										<option value="6">Multiple</option>
										<option value="7">None</option>
										<option value="8">None now - was Communic</option>
										<option value="9">None now - was Disabled but unspecified</option>
										<option value="10">None now - was Emotional</option>
										<option value="11">None now - was Hearing</option>
										<option value="12">None now - was Intellect</option>
										<option value="13">None now - was Multiple</option>
										<option value="14">None now - was Physical</option>
										<option value="15">None now - was Sight</option>
										<option value="16">Physical (move/stand etc)</option>
										<option value="17">Sight (even with glasses)</option>
									</select>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Citizen Residential Status *</label>
									<select name="citizen" class="form-control">
										<option value="1">Dual (South African &amp; Other)</option>
										<option value="2">Permanent</option>
										<option value="3">South African</option>
										<option value="4">Other</option>
									</select>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Photo ID *</h4>
								<div class="form-group">
									<div class="photo_upload">
										<img src="http://localhost/new/pirb/assets/images/profile.jpg" class="photo_image" width="100">
									</div>
									<input type="file" id="file" class="photo_file" data-multiple-caption="{count} files selected" multiple="">
									<label for="file" class="choose_file">Choose File</label>
									<input type="hidden" name="image2" class="photo" value="">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
						</div>

						<h4 class="card-title">Registration Card</h4>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Registration Card Required *</label>
									<select name="registration_card" class="form-control">
										<option value="1">Yes</option>
										<option value="2">No</option>
									</select>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Method of Delivery of Card *</label>
									<select name="delivery_card" class="form-control">
										<option value="0"></option>
									</select>
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
										<input type="hidden" class="form-control" name="address[1][id]" value="">
										<input type="hidden" class="form-control" name="address[1][type]" value="1">
										<input type="text" class="form-control" name="address[1][address]"  value="">
									</div>
								</div>
								<div class="col-md-6">
									<h4 class="card-title">Postal Address</h4>
									<p class="tagline">Note all postal services will be sent to this address</p>
									<div class="form-group">
										<label>Postal Address *</label>
										<input type="hidden" class="form-control" name="address[2][id]" value="">
										<input type="hidden" class="form-control" name="address[2][type]" value="2">
										<input type="text" class="form-control" name="address[2][address]" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<input type="text" class="form-control" name="address[1][suburb]" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<input type="text" class="form-control" name="address[2][suburb]" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<input type="text" class="form-control" name="address[1][city]" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<input type="text" class="form-control" name="address[2][city]" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Province *</label>
										<select name="address[2][province]" class="form-control">
											<option value="" selected="selected">Select Province</option>
											<option value="1">muthukumar</option>
											<option value="3">demo</option>
											<option value="4">tesing_project</option>
											<option value="5">demo_files</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Province *</label>
										<select name="address[1][province]" class="form-control">
											<option value="" selected="selected">Select Province</option>
											<option value="1">muthukumar</option>
											<option value="3">demo</option>
											<option value="4">tesing_project</option>
											<option value="5">demo_files</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Postal Code *</label>
										<input type="text" class="form-control" name="address[2][postal_code]" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Home Phone:</label>
										<input type="text" class="form-control" name="home_phone" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Mobile Phone *</label>
										<input type="text" class="form-control" name="mobile_phone" value="">
										<p>Note all SMS and OTP notifications will be sent to this mobile number above</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Work Phone:</label>
										<input type="text" class="form-control" name="work_phone" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email Address *</label>
										<input type="text" class="form-control" name="email" value="">
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
										<select name="employment_details" class="form-control">
											<option value="1">Employed</option>
											<option value="2">Unemployed</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Company</label>
										<select name="company_details" class="form-control">
										</select>
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
								<div class="text-right">
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#skillmodal">Add Cert/Skill</button>
								</div>
							</div>
					      </div>
					    </div>
					  </div>



					</div>
				</div>
					</div>
					<div class="col-md-12 text-right">
						<input type="submit" id="right_align" name="submit" value="submit" class="btn btn-primary">
					</div>

					</div>

					

				</div>	
			</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
	datepicker('.dob');
	datepicker('.skill_date');
})
</script>