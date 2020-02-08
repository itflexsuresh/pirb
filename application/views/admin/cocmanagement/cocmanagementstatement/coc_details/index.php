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
								<input type="number" class="form-control" name="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>End COC Range</label>
								<input type="number" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<h5 class="card_sub_title">COC Status</h5>
							<?php foreach($cocstatus as $key => $value){ ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="cocstatus[]" id="<?php echo $key.'-'.$value; ?>">
									<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
								</div>
							<?php } ?>
						</div>

						<div class="col-md-4">
							<h5 class="card_sub_title">Audit Status</h5>
							<?php foreach($auditstatus as $key => $value){ ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="auditstatus[]" id="<?php echo $key.'-'.$value; ?>">
									<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
								</div>
							<?php } ?>
						</div>

						<div class="col-md-4">
							<h5 class="card_sub_title">COC Type</h5>
							<?php foreach($coctype as $key => $value){ ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="coctype[]" id="<?php echo $key.'-'.$value; ?>">
									<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
								</div>
							<?php } ?>
						</div>
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Date Range</h4>
						<div class="col-md-6">
							<div class="form-group">
								<label>Start Date Range</label>
								<div class="input-group">
									<input type="text" class="form-control startdate" name="startdate" value="">
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
									<input type="text" class="form-control enddate" name="enddate" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Province</label>
								<?php 
									echo form_dropdown('province', $province, '', ['id' => 'province', 'class' => 'form-control']); 
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<?php 
									echo form_dropdown('city', [], '', ['id' => 'city', 'class' => 'form-control']); 
								?>
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
	datepicker('.startdate, .enddate');
	citysuburb(['#province','#city'], ['<?php echo ''; ?>']);
})
</script>