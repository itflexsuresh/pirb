<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Performance Status</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Performance Status</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Performance Status</h4>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Date of Allocation/Logged COC</th>
								<th>COC Type</th>
								<th>Customer</th>
								<th>Address</th>
								<th>Plumber Company</th>
								<th>Reseller Name</th>
								<th>Action</th>
							</tr>							
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."plumber/performancestatus/index/DTPerformancestatus"; ?>',
			data 	: 	{ page : 'plumbercocstatement' },
			columns : 	[
							{ "data": "cocno" },
							{ "data": "cocstatus" },
							{ "data": "purchased" },
							{ "data": "coctype" },
							{ "data": "customer" },
							{ "data": "address" },
							{ "data": "company" },
							{ "data": "reseller" },
							{ "data": "action" }
						],
			target	:	[7],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
