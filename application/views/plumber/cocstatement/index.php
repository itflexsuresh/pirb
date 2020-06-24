<?php 
	if(in_array($result['plumberstatus'], $this->config->item('psidconfig'))){
		$psidconfig = '1';
	}else{
		$psidconfig = '0';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Statement</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Date of Allocation</th>
								<th>Logged COC</th>
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
			url 	: 	'<?php echo base_url()."plumber/cocstatement/index/DTCocStatement"; ?>',
			data 	: 	{ page : 'plumbercocstatement', psidconfig : '<?php echo $psidconfig; ?>' },
			columns : 	[
							{ "data": "cocno" },
							{ "data": "cocstatus" },
							{ "data": "purchased" },
							{ "data": "logdate" },
							{ "data": "coctype" },
							{ "data": "customer" },
							{ "data": "address" },
							{ "data": "company" },
							{ "data": "reseller" },
							{ "data": "action" }
						],
			target	:	[9],
			sort	:	'0',
			order 	: 	[[0, 'desc']]
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
