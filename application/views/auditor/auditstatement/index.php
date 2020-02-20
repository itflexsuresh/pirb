<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'auditor/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Statement</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Audit Statement</h4>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Plumber</th>
								<th>Phone (Mobile)</th>
								<th>Refix Date</th>
								<th>Suburb</th>
								<th>Owners Name and Surname</th>
								<th>Owners Tel Number</th>
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
			url 	: 	'<?php echo base_url()."auditor/auditstatement/index/DTAuditStatement"; ?>',
			data 	: 	{ page : 'auditorstatement' },
			columns : 	[
							{ "data": "cocno" },
							{ "data": "status" },
							{ "data": "plumber" },
							{ "data": "plumbermobile" },
							{ "data": "refixdate" },
							{ "data": "suburb" },
							{ "data": "ownername" },
							{ "data": "ownermobile" },
							{ "data": "action" }
						],
			target	:	[8],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
