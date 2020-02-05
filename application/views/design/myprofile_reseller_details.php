<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My Profile Reseller Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My Profile Reseller Details</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">My Profile Reseller Details</h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Name</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Contact Person Name</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Contact Person Surname</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Work)</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Primary Contact Mobile Number</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Primary Email</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="">
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="pass_active">
		                            <label class="custom-control-label" for="pass_active">Active</label>
		                        </div>
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-6">
							<div class="row">
								<h4 class="card-title add_left_value">Postal Address</h4>
								<div class="col-md-12">
									<div class="form-group">
										<label>Postal Address</label>
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
										<label>City</label>
										<select name="designation" class="form-control">
											<option value="1">Data from Setting and Subject to Provience</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Suburb</label>
										<select name="designation" class="form-control">
											<option value="1">Data from Setting and Subject to Cit</option>
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


						<div class="col-md-6">
							<div class="row">
								<h4 class="card-title add_left_value">Physical Address</h4>
								<div class="col-md-12">
									<div class="form-group">
										<label>Address</label>
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
										<label>City</label>
										<select name="designation" class="form-control">
											<option value="1">Data from Setting and Subject to Provience</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Suburb</label>
										<select name="designation" class="form-control">
											<option value="1">Data from Setting and Subject to Cit</option>
										</select>
									</div>
								</div>	
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Invoice Details</h4>
						<div class="col-md-4">
							<div class="form-group">
								<label>Billing Name</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Company Reg Number</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Company Vat</label>
								<input type="text" class="form-control" name="">
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="var_reg">
		                            <label class="custom-control-label" for="var_reg">Company Vat Registered</label>
		                        </div>
							</div>
						</div>
					</div>

					<div class="row text-right">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Save/Update</button>
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