<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Report</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Report</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">Audit Report</h4>

					<div class="row">
						<div class="col-md-2">
							<h5 class="card_sub_title">COC Details</h5>
						</div>

						<div class="col-md-3 mt_25">
							<a href="#">View COC Details in full</a>
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
									<input type="text" class="form-control dob" name="dob" value="">
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
						<div class="col-md-6">
							<div class="form-group">
								<label>Audit Status</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Auditors Name and Surname</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Mobile)</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Date of Audit</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Overall Workmanship</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Licensed Plumber Present</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Was COC Completed Correctly</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<h4 class="card-title mb_0">Audit Report</h4>
							<div class="export_pdf"></div>
							<button type="submit" name="submit" value="submit" class="btn btn-primary btn_alter">Download PDF</button>
						</div>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th style="text-align: center;">Review Type</th>
								<th style="text-align: center;">Statement</th>
								<th style="text-align: center;">Comments</th>
								<th style="text-align: center;">SANS/Regulation/Bylaw Reference</th>
								<th style="text-align: center;">Knowledge Reference link</th>
								<th style="text-align: center;">Images</th>
								<th style="text-align: center;">Performance Points</th>
								<th style="text-align: center;">Refix Status</th>
							</tr>
							<tr style="background-color: #00ffff;">
								<td>No Audit Findings</td>
								<td>Info from Auditors report</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr style="background-color: #9f9;">
								<td>Compliment</td>
								<td>Info from Auditors report</td>
								<td>Info from Auditors report</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr style="background-color: #ffc;">
								<td>Cautionary</td>
								<td>Info from Auditors report</td>
								<td>Info from Auditors report</td>
								<td>Data from Auditors report selection</td>
								<td>Data from Auditors report selection</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr style="background-color: #ffa18a;">
								<td>Failure</td>
								<td>Info from Auditors report</td>
								<td>Info from Auditors report</td>
								<td>Data from Auditors report selection</td>
								<td>Data from Auditors report selection</td>
								<td></td>
								<td>Data from Auditors report selection</td>
								<td>
									<i class="fa fa-times" aria-hidden="true"></i>
									<p>Incomplete</p>
								</td>
							</tr>
							<tr style="background-color: #ffa58f;">
								<td>Failure</td>
								<td>Info from Auditors report</td>
								<td>Info from Auditors report</td>
								<td>Data from Auditors report selection</td>
								<td>Data from Auditors report selection</td>
								<td></td>
								<td>Data from Auditors report selection</td>
								<td>
									<i class="fa fa-check" aria-hidden="true"></i>
									<p>Complete</p>
								</td>
							</tr>
						</table>
					</div>

					<div class="row mt_20">
						<div class="col-md-5 mt_10">
							<div class="form-group">
								<label>Refix's to this Audit review are to be completed by latest</label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 p-0 notice_overall">
							<h4 class="notice_title">NOTICE TO LICENSED PLUMBER</h4>
							<p>It is your responsible to complete your refix's with in the allocted time. Failure to do so within the alloated time will result in the refix being marked as Audit Complete (with Refix(s)) and relevant remedial action will follow.</p>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title">Chat (Histroy)</h4>
						<div class="col-md-12">
							<!-- developer side -->
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