<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My Report Listings</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My Report Listings</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">
					<h4 class="card-title">My Report Listings</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Installation Type</label>
								<select name="" id="" class="form-control">
									<option value="" selected="selected">data from Installtion types</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Sub Type</label>
								<select name="" id="" class="form-control">
									<option value="" selected="selected">data from Sub types</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Statement</label>
								<select name="" id="" class="form-control">
									<option value="" selected="selected">data from statements</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Comments</label>
								<textarea class="form-control" id="" name="" value=""></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>My Report Listings/Favourates Name</label>
								<textarea class="form-control" id="" name="" value=""></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
									<input type="checkbox" class="custom-control-input" name="status" id="status" value="1" checked="">
									<label class="custom-control-label" for="status">Active</label>
								</div>
							</div>
						</div>

						<div class="col-md-6 text-right">
							<div class="form-group">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Add/Update</button>
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th style="text-align: center;">Report Name</th>
								<th style="text-align: center;">Installation Type</th>
								<th style="text-align: center;">Sub Type</th>
								<th style="text-align: center;">Comments</th>
								<th style="text-align: center;">Active</th>
							</tr>
							<tr>
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