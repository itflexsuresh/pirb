<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Statement</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">Audit Statement</h4>

					<div class="row">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Plumber Audit History</span></a> </li>
							<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Audit Review</span></a> </li>
							<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Diary/Comments</span></a> </li>
						</ul>
					</div>

					<div class="tab-content tabcontent-border add_top_value">
						<div class="tab-pane active p-20" id="tab1" role="tabpanel">
							<h4 class="card-title">Plumber Audit History</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Number Audits Done to Date</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Total Number of Audit Findings</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label>Cautionary Audit Findings</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-3 form-group">
											<label></label>
											<input type="text" class="form-control mt_7" name="">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label>Refix (In-Complete) Audit Findings</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-3 form-group">
											<label></label>
											<input type="text" class="form-control mt_7" name="">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label>Refix (Complete) Audit Findings</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-3 form-group">
											<label></label>
											<input type="text" class="form-control mt_7" name="">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label>No Audit Findings Audit Findings</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-3 form-group">
											<label></label>
											<input type="text" class="form-control mt_7" name="">
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="row add_top_value">
										<table class="table table-bordered table-striped datatables fullwidth">
											<tr>
												<th style="text-align: center;">Audit Date</th>
												<th style="text-align: center;">Auditor</th>
												<th style="text-align: center;">Installatation Type</th>
												<th style="text-align: center;">Sub Type</th>
												<th style="text-align: center;">Statements</th>
												<th style="text-align: center;">Audit Finding</th>
											</tr>
											<tr>
												<td></td>
												<td></td>
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
												<td></td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane p-20" id="tab2" role="tabpanel">
							<h4 class="card-title">Audit Review</h4>
							<div class="row">
								<div class="col-md-9">
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
												<label>Phone (Work)</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Phone (Mobile)</label>
												<input type="text" class="form-control" name="">
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="col-md-12 form-group">
										<img class="plumber_profile" src="<?php echo base_url() ?>assets/images/profile.jpg">
									</div>
								</div>
							</div>

							<div class="row add_top_value">
								<div class="col-md-7">
									<h4 class="card-title">COC Details</h4>
								</div>

								<div class="col-md-5">
									<a href="#" target="_blank">View COC Details in full</a>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Certificate No</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Plumbing Work Completion Date</label>
										<div class="input-group">
											<input type="text" class="form-control dob valid" name="dob" value="" aria-invalid="false">
											<div class="input-group-append">
												<span class="input-group-text"><i class="icon-calender"></i></span>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Owners Name</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Name of Complex/Flat (if applicable)</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Street</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Number</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Province</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>City</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Suburb</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Contact Mobile</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Alternate Contact</label>
										<input type="text" class="form-control" name="">
									</div>
								</div>
							</div>

							<div class="row add_top_value">
							<h4 class="card-title add_left_value">Audit Review</h4>
							<div class="col-md-6 form-group">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Date of Audit</label>
											<div class="input-group">
												<input type="text" class="form-control dob valid" name="dob" value="" aria-invalid="false">
												<div class="input-group-append">
													<span class="input-group-text"><i class="icon-calender"></i></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Overall Workmanship</label>
											<select name="" id="" class="form-control">
												<option value="" selected="selected">Very Poor</option>
												<option value="0">Poor</option>
												<option value="0">Good</option>
												<option value="0">Excellent</option>
											</select>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Licensed Plumber Present</label>
											<select name="" id="" class="form-control">
												<option value="" selected="selected">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Was COC Completed Correctly</label>
											<select name="" id="" class="form-control">
												<option value="" selected="selected">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="row add_top_value">
									<div class="col-md-12">
										<div class="form-group">
											<div class="custom-control custom-radio">
						                        <input type="radio" id="hold" name="purchaser_type" class="custom-control-input">
						                        <label class="custom-control-label" for="hold">Place Audit on hold</label>
						                    </div>
						                </div>
				                	</div>

				                	<div class="col-md-12">
				                		<div class="form-group">
											<label>Why was Audit placed on hold?</label>
											<textarea class="form-control" id="" name="" value=""></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<h4 class="card-title mb_0 add_left_value">Audit Report</h4>
											<div class="export_pdf">
											</div>
											<button type="submit" name="submit" value="submit" class="btn btn-primary export_btn">Audit Report</button>
										</div>
									</div>
			                	</div>
							</div>
						</div>

						<div class="row add_top_value">
							<div class="col-md-12">
								<table class="table table-bordered table-striped datatables fullwidth">
									<tr>
										<th style="text-align: center;">Review Type</th>
										<th style="text-align: center;">Statement</th>
										<th style="text-align: center;">Comments</th>
										<th style="text-align: center;">Images</th>
										<th style="text-align: center;">Performance Points</th>
										<th style="text-align: center;">Refix Status</th>
									</tr>
									<tr>
										<td></td>
										<td></td>
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
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>

							<div class="col-md-12 text-right">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Add a Review</button>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Refix Period (Days)</label>
									<input type="number" class="form-control" name="">
								</div>
							</div>

							<div class="col-md-6 mt_40">
								<div class="form-group">
									<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
										<input type="checkbox" class="custom-control-input" name="audit_complete" id="audit_complete" value="1" checked="">
										<label class="custom-control-label" for="audit_complete">Audit Complete</label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Date and Time of Report submitted</label>
									<input type="text" class="form-control" name="">
								</div>
							</div>

							<div class="col-md-12 text-right">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit Report</button>
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Save/Update</button>
							</div>
						</div>
					</div>


						<div class="tab-pane p-20" id="tab3" role="tabpanel">
							<h4 class="card-title">Diary/Comments</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Diary of Activities</label>
										<textarea class="form-control" id="" value=""></textarea>
									</div>
								</div>

								<div class="col-md-12 mt_20">
									<div class="form-group">
										<label>Audit Comments (Comments related specifically to this Audit)</label>
										<textarea class="form-control" id="" value=""></textarea>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label></label>
										<input type="text" class="form-control" placeholder="Type your Comment here" name="">
									</div>
								</div>

								<div class="col-md-4 mt_20">
									<button type="submit" name="submit" value="submit" class="btn btn-primary">Add Comment</button>
								</div>
							</div>
						</div>

					</div>  <!--  tab overall end  -->


					
					
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