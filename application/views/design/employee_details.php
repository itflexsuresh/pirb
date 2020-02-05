<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Employee Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Employee Details</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

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