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
								<input type="number" class="form-control" name="startrange" id="startrange">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>End COC Range</label>
								<input type="number" class="form-control" name="endrange" id="endrange">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<h5 class="card_sub_title">COC Status</h5>
							<?php foreach($cocstatus as $key => $value){ ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input cocstatus" name="cocstatus[]" value="<?php echo $key; ?>" id="<?php echo $key.'-'.$value; ?>">
									<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
								</div>
							<?php } ?>
						</div>

						<div class="col-md-4">
							<h5 class="card_sub_title">Audit Status</h5>
							<?php foreach($auditstatus as $key => $value){ ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input auditstatus" name="auditstatus[]" value="<?php echo $key; ?>" id="<?php echo $key.'-'.$value; ?>">
									<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
								</div>
							<?php } ?>
						</div>

						<div class="col-md-4">
							<h5 class="card_sub_title">COC Type</h5>
							<?php foreach($coctype as $key => $value){ ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input coctype" name="coctype[]" value="<?php echo $key; ?>" id="<?php echo $key.'-'.$value; ?>">
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
									<input type="text" class="form-control startdate" name="startdate" id="startdate">
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
									<input type="text" class="form-control enddate" name="enddate" id="enddate">
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
						<button type="button" name="submit" id="filter" class="btn btn-primary">Apply Filters</button>
					</div>
				</form>
				
				<div class="row add_top_value table_wrapper displaynone">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th style="text-align: center;">CoC Number</th>
								<th style="text-align: center;">CoC Types</th>
								<th style="text-align: center;">Status</th>
								<th style="text-align: center;">Plumber</th>
								<th style="text-align: center;">Reseller</th>
								<th style="text-align: center;">Auditor</th>
								<th style="text-align: center;"></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>	
			

		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	datepicker('.startdate, .enddate');
	citysuburb(['#province','#city']);
})

$('#filter').on('click',function(){		
	$('.table_wrapper').removeClass('displaynone');
	datatable(1);
});
	
function datatable(destroy=0){
	var data = {
		startrange 	: $('#startrange').val(),
		endrange 	: $('#endrange').val(),
		coc_status 	: $('.cocstatus:checked').map(function(){return $(this).val();}).get(),            
		auditstatus : $('.auditstatus:checked').map(function(){return $(this).val();}).get(),
		coctype 	: $('.coctype:checked').map(function(){return $(this).val();}).get(),
		startdate 	: $('#startdate').val(),
		enddate 	: $('#enddate').val(),
		province 	: $('#province').val(),
		city 		: $('#city').val()
	};
	console.log(data);
	var options = {
		url 	: 	'<?php echo base_url()."admin/cocstatement/cocdetails/index/DTCocDetails"; ?>',
		data    :   data,  			
		destroy :   destroy,  			
		columns : 	[
						{ "data": "cocno" },
						{ "data": "coctype" },
						{ "data": "status" },
						{ "data": "plumber" },
						{ "data": "reseller" },
						{ "data": "auditor" },
						{ "data": "action" }
					]
	};
	
	ajaxdatatables('.datatables', options);
}
</script>