<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Log COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Log COC</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">Log COC</h4>
					<h4 class="sup_title">Certificate: <label>2222</label></h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumbing Work Completion Date</label>
								<div class="input-group">
									<input type="text" class="form-control dob" name="dob" value="<?php echo $dob; ?>">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Insurance Claim/Order no: (if relevant)</label>
								<input type="text" class="form-control insurance_number" name="">
							</div>
						</div>
					</div>

					<h4 class="card-title add_top_value">Physical Address Details of Installation</h4>
					<div class="row">
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

						<div class="col-md-6">
							<div class="form-group">
								<label>Province</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

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

						<div class="col-md-6">
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th colspan="2">Type of Installation Carried Out by Licensed Plumber</th>
								<th style="text-align: center;">Code</th>
								<th style="text-align: center;">Tick</th>
							</tr>
							<tr>
								<td colspan="2">Installation, Replacement and/or Repair of a Hot water System</td>
								<td style="text-align: center;">1</td>
								<td style="text-align: center;">
									<div class="custom-control custom-checkbox">
			                            <input type="checkbox" class="custom-control-input" id="checkbox_1">
			                            <label class="custom-control-label" for="checkbox_1"></label>
		                        	</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Installation, Replacement and/or Repair of a Cold water System</td>
								<td style="text-align: center;">2</td>
								<td style="text-align: center;">
									<div class="custom-control custom-checkbox">
			                            <input type="checkbox" class="custom-control-input" id="checkbox_2">
			                            <label class="custom-control-label" for="checkbox_2"></label>
		                        	</div>
								</td>
							</tr>
						</table>


						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="2">Specialisations: To be Carried Out by Licensed Plumber Only Registered to do the Specialised work</th>
								<th style="text-align: center;">Code</th>
								<th style="text-align: center;">Tick</th>
							</tr>
							<tr>
								<td colspan="2">Installation, Replacement and/or Repair of a Solar water Heating System</td>
								<td style="text-align: center;">4</td>
								<td style="text-align: center;">
									<div class="custom-control custom-checkbox">
			                            <input type="checkbox" class="custom-control-input" id="checkbox_3">
			                            <label class="custom-control-label" for="checkbox_3"></label>
		                        	</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Installation, Replacement and/or Repair of a Heat Pump</td>
								<td style="text-align: center;">8</td>
								<td style="text-align: center;">
									<div class="custom-control custom-checkbox">
			                            <input type="checkbox" class="custom-control-input" id="checkbox_4">
			                            <label class="custom-control-label" for="checkbox_4"></label>
		                        	</div>
								</td>
							</tr>
						</table>

						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="2">Installation Details</th>
							</tr>
							<tr>
								<td colspan="2">(Details of the work undertaken or scope of work for which the COC is being issued for)</td>
							</tr>
						</table>

						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="3">Pre- Existing Non Compliance Conditions</th>			
							</tr>
							<tr>
								<td colspan="2">Non compliance details</td>
								<td style="text-align: center;">
									<div class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
										<a href="#"><i class="fa fa-trash"></i></a>
									</div>	
								</td>
							</tr>
							<tr>
								<td colspan="2">Non compliance details</td>	
								<td style="text-align: center;">
									<div class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
										<a href="#"><i class="fa fa-trash"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Non compliance details</td>	
								<td style="text-align: center;">
									<div class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
										<a href="#"><i class="fa fa-trash"></i></a>
									</div>
								</td>
							</tr>
						</table>
						<div class="row text-right">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Add a Non Compliance</button>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<h4 class="card-title add_top_value">Image of COC (Paper)</h4>
							<div class="form-group">
								<div>
									<img src="<?php echo ($file1!='') ? $filepath.$file1 : base_url().'assets/images/profile.jpg'; ?>" class="document_image" width="100">
								</div>
								<input type="file" id="file" class="document_file">
								<label for="file" class="choose_file">Add Images</label>
								<input type="hidden" name="image1" class="document" value="<?php echo $file1; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>

						<div class="col-md-6">
							<h4 class="card-title add_top_value">Installation Images</h4>
							<div class="form-group">
								<div>
									<img src="<?php echo ($file1!='') ? $filepath.$file1 : base_url().'assets/images/profile.jpg'; ?>" class="document_image" width="100">
								</div>
								<input type="file" id="file" class="document_file">
								<label for="file" class="choose_file">Add Images</label>
								<input type="hidden" name="image1" class="document" value="<?php echo $file1; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>

						


					<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="3">I Lea Smith, Licensed registration number 0205/12, certify that, the above compliance certifcate details are true and correct and will be logged in accordance with the prescribed requirements as defned by the PIRB. Select either A or B as appropriate</th>			
							</tr>
							<tr>
								<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
									<div class="table-action">
										<div class="custom-control custom-radio">
					                        <input type="radio" id="custom_radio" name="status" class="custom-control-input">
					                        <label class="custom-control-label" for="custom_radio"></label>
					                    </div>
									</div>	
								</td>
								<td colspan="2">A: The above plumbing work was carried out by me or under my supervision, and that it complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
							</tr>
							<tr>
								<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
									<div class="table-action">
										<div class="custom-control custom-radio">
					                        <input type="radio" id="custom_radio_1" name="status" class="custom-control-input">
					                        <label class="custom-control-label" for="custom_radio_1"></label>
					                    </div>
									</div>	
								</td>
								<td colspan="2">B: I have fully inspected and tested the work started but not completed by another Licensed plumber. I further certify that the inspected and tested work and the necessary completion work was carried out by me or under my supervision- complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
							</tr>
						</table>

						<div class="ro text-right">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Save COC</button>
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Log  COC</button>
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