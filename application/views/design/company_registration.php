<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<style type="text/css">
	.cpd_body input[type="number"] {
		width: 105px;
	}

	input#individual1, input#individual2, input#individual3, input#individual4, input#individual5, input#individual6 {
		width: 105px;
	}

	input#direct-plumber, input#master-plumber, input#license-plumber, input#techinical-plumber, input#assisting-plumber, input#learner-plumber {
		width: 105px;
		max-width: 100%;
	}
	input#workphone::-webkit-inner-spin-button {
    	-webkit-appearance: none;
	}
	input#vat_no::-webkit-inner-spin-button {
    	-webkit-appearance: none;
	}
</style>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company Registration</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Company Registration</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Company Registration</h4>
				<form class="mt-4 form" action="" method="post">
					<ul class="nav nav-tabs com_reg_page" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Company Profile</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Empolyee Lisitings</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Dcoument and Letter</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab4" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Diary/Comments</span></a> </li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content tabcontent-border add_top_value">

						<div class="tab-pane active p-20" id="tab1" role="tabpanel">
							
							<h4 class="card-title">Company Registration Details</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>PIRB Company ID</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Registration Date</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Status</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>	

								<div class="col-md-12">				
									<div class="form-group">
										<label>Specific Message to Company</label>
										<textarea class="form-control" id="" name="name" placeholder=""></textarea>
									</div>
								</div>
							</div>

							<div class="row add_top_value">
								<h4 class="card-title add_left_value">Company Details</h4>
								<div class="col-md-6">
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Company Registration Number</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>VAT Number</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Primary Contact Person</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>
							</div>

							<div class="row add_top_value">
								<div class="col-md-6">
									<div class="row">
									<h4 class="card-title add_left_value">Physical Address</h4>
									<p class="note_red add_left_value">Note all delivery services will be sent to this address</p>
										<div class="col-md-12">
											<div class="form-group">
												<label>Physical Address</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Subjecturb</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>	

										<div class="col-md-12">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Province</label>
												<select name="designation" class="form-control">
													<option value="1">Data from Setting and Subject to Provience</option>
												</select>
											</div>
										</div>
									</div>
								</div>


								<div class="col-md-6">
									<div class="row">
										<h4 class="card-title add_left_value">Postal Address</h4>
										<p class="note_red add_left_value">Note all postal services will be sent to this address</p>
										<div class="col-md-12">
											<div class="form-group">
												<label>Postal Address</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Suburb</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>	

										<div class="col-md-12">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Province</label>
												<select name="designation" class="form-control">
													<option value="1">Data from Settings</option>
												</select>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Postal Code</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>								
									</div>
								</div>
							</div>

							<div class="row">
								<h4 class="card-title add_left_value">Contact Details</h4>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Home Phone</label>
												<input type="number" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Work Phone</label>
												<input type="number" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Email Address*</label>
												<input type="text" class="form-control" name="">
												<p class="note_red">Note all emails notifications will be sent to this email address above</p>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
										<div class="col-md-12">
											<div class="form-group">
												<label>Secondary Mobile Phone</label>
												<input type="number" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Secondary Email Address</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Mobile Phone*</label>
												<input type="number" class="form-control" name="">
												<p class="note_red">Note all SMS and OTP notifications will be sent to this mobile number above</p>
											</div>
										</div>
								</div>
							</div>

							<div class="row add_top_value">
								<div class="col-md-12">
									<h4 class="card-title">Type of work Company Undertakes</h4>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="mr">
				                            <label class="custom-control-label" for="mr">Maintenance-Residential</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="mi">
				                            <label class="custom-control-label" for="mi">Maintenance-Industrial</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="mc">
				                            <label class="custom-control-label" for="mc">Maintenance-Commercial</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="cr">
				                            <label class="custom-control-label" for="cr">Construction-Residential</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="ci">
				                            <label class="custom-control-label" for="ci">Construction-Industrial</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="cc">
				                            <label class="custom-control-label" for="cc">Construction-Commercial</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="ccw">
				                            <label class="custom-control-label" for="ccw">Construction-Civil Works</label>
				                        </div>
									</div>
								</div>
							</div>

							<div class="row add_top_value">
								<div class="col-md-12">
									<h4 class="card-title">Specialisations</h4>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="ld">
				                            <label class="custom-control-label" for="ld">Leak Detection</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="dc">
				                            <label class="custom-control-label" for="dc">Drain Cleaning</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="sw">
				                            <label class="custom-control-label" for="sw">Solar Water Heating</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="hp">
				                            <label class="custom-control-label" for="hp">Heat Pumps</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="gas">
				                            <label class="custom-control-label" for="gas">Gas</label>
				                        </div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="br">
				                            <label class="custom-control-label" for="br">Bathroom renovations</label>
				                        </div>
									</div>
								</div>
							</div>

							<div class="row text-right">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Update</button>
							</div>


						</div>

						<div class="tab-pane p-20" id="tab2" role="tabpanel">
							
							<h4 class="card-title">Employee Details</h4>
								<div class="row">
									<table class="table table-bordered table-striped datatables fullwidth">
										<tr>
											<th>Registration Number</th>
											<th>Designation</th>
											<th>Status</th>
											<th>Plumbers Name and Surname</th>
											<th>CPD Status</th>
											<th>Reg NumbePerformance Statusr</th>
											<th>Overall Industry Rating</th>
											<th></th>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="#">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</table>
								</div>

								<div class="row add_top_value">
									<h4 class="card-title add_left_value">Average Industry Rating of Company Employees</h4>
									<div class="col-md-6">
										<div class="form-group">
											<label>Licensed Plumber and above</label>
											<input type="text" class="form-control" name="">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Non Licensed Plumbers</label>
											<input type="text" class="form-control" name="">
										</div>
									</div>
								</div>

								<div class="row add_top_value">
									<div class="col-md-9">
										<h4 class="card-title add_left_value">Employee Details forms</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Registration Number</label>
													<input type="text" class="form-control" name="">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Plumbers Name and Surname</label>
													<input type="text" class="form-control" name="">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Phone (Mobile)</label>
													<input type="number" class="form-control" name="">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Email</label>
													<input type="text" class="form-control" name="">
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3" style="text-align: center;">
										<h4 class="card-title full_width">Plumbers Image</h4>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group mt_20">
													<img src="<?php echo base_url()?>/assets/images/profile.jpg" class="document_image" width="100">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
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
					                            <label class="custom-control-label" for="solar">Solar</label>
					                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<div class="custom-control custom-checkbox">
					                            <input type="checkbox" class="custom-control-input" id="gas">
					                            <label class="custom-control-label" for="gas">Gas</label>
					                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<div class="custom-control custom-checkbox">
					                            <input type="checkbox" class="custom-control-input" id="pe">
					                            <label class="custom-control-label" for="pe">Plumbing Estimator</label>
					                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<div class="custom-control custom-checkbox">
					                            <input type="checkbox" class="custom-control-input" id="hp">
					                            <label class="custom-control-label" for="hp">Heat Pump</label>
					                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<div class="custom-control custom-checkbox">
					                            <input type="checkbox" class="custom-control-input" id="pta">
					                            <label class="custom-control-label" for="pta">Plumbing Training Assessor</label>
					                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<div class="custom-control custom-checkbox">
					                            <input type="checkbox" class="custom-control-input" id="pa">
					                            <label class="custom-control-label" for="pa">Plumbing Arbitrator</label>
					                        </div>
										</div>
									</div>
								</div>

								<div class="row add_top_value">
									<div class="col-md-6">
										<h4 class="card-title">Audit Overview</h4>
									</div>

									<div class="col-md-6">
										<h4 class="card-title">CPD Overview</h4>
									</div>
								</div>
							</div>	

							<div class="tab-pane p-20" id="tab3" role="tabpanel">
								<div class="row">
									<h4 class="card-title">Diary/Comments for {Company}</h4>

									<div class="col-md-12">
										<div class="form-group">
											<label>Diary of Activities</label>
											<textarea class="form-control" name="" id="" value=""></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group mb_0">
											<label>Admin Comment</label>
											<textarea class="form-control" name="" id="" value=""></textarea>
										</div>
									</div>

									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Type your Comment here" name="">
									</div>

									<div class="col-md-4">
										<button type="submit" name="submit" value="submit" class="btn btn-primary mt_0">Add Comment</button>
									</div>
								</div>
						</div>

						<div class="tab-pane p-20" id="tab4" role="tabpanel">
							<div class="row">
									<h4 class="card-title">Diary/Comments for {Company}</h4>

									<div class="col-md-12">
										<div class="form-group">
											<label>Diary of Activities</label>
											<textarea class="form-control" name="" id="" value=""></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group mb_0">
											<label>Admin Comment</label>
											<textarea class="form-control" name="" id="" value=""></textarea>
										</div>
									</div>

									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Type your Comment here" name="">
									</div>

									<div class="col-md-4">
										<button type="submit" name="submit" value="submit" class="btn btn-primary mt_0">Add Comment</button>
									</div>
								</div>
						</div>

						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>