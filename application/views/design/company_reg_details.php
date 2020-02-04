<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company Registration Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Company Registration Details</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

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