<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Allocate COC Confirmation</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Allocate COC Confirmation</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">Allocate COC Confirmation</h4>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 mt_10">
										<label>Plumber / Reg Number</label>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<select name="" id="" class="form-control">
												<option value="0"></option>
											</select>
										</div>
									</div>

									<div class="col-md-2">
										<button type="submit" name="submit" value="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">

							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-6">
							<div class="form-group mb_0">
								<p class="user_name">Details of Licesend Plumber :</p>
								<p class="user_name">Lea Smith (Reg No 0205/12)</p>
							</div>
						</div>
					</div>

					<div class="row">
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

							<div class="col-md-6 mt_20">
								<div class="form-group">
									<p class="user_name">Current Licesed Plumbers Employer</p>
									<p class="user_name">0860Plumber</p>
								</div>
							</div>

						</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Number of COC's Permitted to be allocated to the Plumber</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Allocted COC from My Stock</h4>
						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate No Start Range</label>
								<select name="" id="" class="form-control">
									<option value="0">Select from COC data range in stock</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate No End Range</label>
								<select name="" id="" class="form-control">
									<option value="0">Select from COC data range in stock</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Number of COC's to be Allocated to Licensed Plumber</label>
								<input type="text" class="form-control" name="">
								<p class="note_red">Caution: Number of COC that been selected for allocation is greater than the number of permitted COC's that can be allocated to the Plumber.</p>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Reseller Invoice Number</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Disclaimer</h4>
						<div class="col-md-12">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="" id="disclaimer" value="">
								<label class="custom-control-label" for="disclaimer">I declare and understand</label>
							</div>
							<p>That I have allocated/sold the relevant COC to a valid Licensed Plumber, and that if I am found that I have allocated a COC to non valid Licensed Plumbers I will be held accountable for my actions.</p>
						</div>
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