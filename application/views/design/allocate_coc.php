<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Allocate COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Allocate COC</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">Allocate COC</h4>
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