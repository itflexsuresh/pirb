<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Statement</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">COC Statement</h4>

					<h5 class="card_sub_title">COC Range</h5>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start COC Range</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>End COC Range</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

						<div class="row">
							<div class="col-md-4">
								<h5 class="card_sub_title">COC Status</h5>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="stock" checked="">
								    <label class="custom-control-label" for="stock">Admin Stock</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="logged">
								    <label class="custom-control-label" for="logged">Logged</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="allocated">
								    <label class="custom-control-label" for="allocated">Allocated (Reseller)</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="allocated_plumber" checked="">
								    <label class="custom-control-label" for="allocated_plumber">Allocated (Plumber)</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="non_logged">
								    <label class="custom-control-label" for="non_logged">Non-Logged Allocated (Customer)</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="recalled">
								    <label class="custom-control-label" for="recalled">Recalled (unallocated)</label>
								</div>
							</div>

							<div class="col-md-4">
								<h5 class="card_sub_title">Audit Status</h5>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="audited_com">
								    <label class="custom-control-label" for="audited_com">Audited (Completed)</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="auditor_allo" checked="">
								    <label class="custom-control-label" for="auditor_allo">Auditor allocated</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="refix_required">
								    <label class="custom-control-label" for="refix_required">Refix Required</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="refix_renege" checked="">
								    <label class="custom-control-label" for="refix_renege">Refix Reneged</label>
								</div>
							</div>

							<div class="col-md-4">
								<h5 class="card_sub_title">COC Type</h5>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="electronic">
								    <label class="custom-control-label" for="electronic">Electronic</label>
								</div>
								<div class="custom-control custom-checkbox">
								    <input type="checkbox" class="custom-control-input" name="" id="paper_based" checked="">
								    <label class="custom-control-label" for="paper_based">Paper-based</label>
								</div>
							</div>
						</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Date Range</h4>
						<div class="col-md-6">
							<div class="form-group">
								<label>Start Date Range</label>
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
								<label>End Date Range</label>
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
								<label>Province</label>
								<select name="status" class="form-control">
									<option value="0">Date from Settings</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Province</label>
								<select name="status" class="form-control">
									<option value="0">Date from Settings and subject to Prc</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row text-right">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Apply Filters</button>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th style="text-align: center;">CoC Number</th>
								<th style="text-align: center;">CoC Types</th>
								<th style="text-align: center;">Status</th>
								<th style="text-align: center;">Plumber</th>
								<th style="text-align: center;">Reseller</th>
								<th style="text-align: center;">Auditor</th>
								<th style="text-align: center;"></th>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<div style="text-align: center;" class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
									</div>
								</td>
								<td></td>
							</tr>
							<tr>
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