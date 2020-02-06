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
					<h4 class="card-title">My Profile</h4>
					<div class="row">
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Surname</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>ID Number</label>
										<input type="number" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Phone (Work)</label>
										<input type="number" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Phone (Mobile)</label>
										<input type="number" class="form-control" name="">
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="col-md-12 form-group mt_20" style="text-align: center;">
								<img class="plumber_profile" src="<?php echo base_url() ?>assets/images/profile.jpg">
								<p class="mt_20">(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Billing Details</h4>
						<div class="col-md-4">
							<div class="form-group">
								<label>Billing Name</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Company Reg Number</label>
								<input type="number" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Company Vat</label>
								<input type="number" class="form-control" name="">
								<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
									<input type="checkbox" class="custom-control-input" name="vat_num" id="vat_num" value="1" checked="">
									<label class="custom-control-label" for="vat_num">VAT Vendor</label>
								</div>
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12">
									<h4 class="card-title">Billing Address</h4>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Billing Address</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Province</label>
										<select name="" id="" class="form-control">
											<option value="" selected="selected">data from settings</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>City</label>
										<select name="" id="" class="form-control">
											<option value="" selected="selected">data from setting and subject to Provience</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb</label>
										<select name="" id="" class="form-control">
											<option value="" selected="selected">data from suburb and subject to City</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Postal Code</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3" style="text-align: center;">
							<div class="form-group">
								<h4 class="card-title">Company Logo</h4>
								<img class="plumber_profile mt_20" src="<?php echo base_url()?>assets/images/profile.jpg"><img src="">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Add Images</button>
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">My Auditting Areas</h4>
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th style="text-align: center;">Province</th>
								<th style="text-align: center;">City</th>
								<th style="text-align: center;">Suburb</th>
								<th style="text-align: center;"></th>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>

					<div class="row add_top_value">
						<div class="col-md-6">
							<div class="form-group">
								<label>Province</label>
								<select name="" id="" class="form-control">
									<option value="" selected="selected">data from settings</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<select name="" id="" class="form-control">
									<option value="" selected="selected">data from setting and subject to Provience</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb</label>
								<select name="" id="" class="form-control">
									<option value="" selected="selected">data from suburb and subject to City</option>
								</select>
							</div>
						</div>

						<div class="col-md-6 text-right mt_40">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Add Area</button>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-12 text-right">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Save/Update</button>
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