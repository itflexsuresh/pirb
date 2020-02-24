<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Manage Allocted Audits</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'auditor/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Manage Allocted Audits</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Manage Allocted Audits</h4>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Auditor</th>
								<th>Auditor Phone (Mobile)</th>
								<th>Allocated Assigned Date</th>
								<th>Refix Date</th>
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
			url 	: 	'<?php echo base_url()."admin/audits/auditstatement/index/DTAuditStatement"; ?>',
			data 	: 	{ page : 'adminauditorstatement' },
			columns : 	[
							{ "data": "cocno" },
							{ "data": "status" },
							{ "data": "auditorname" },
							{ "data": "auditormobile" },
							{ "data": "auditordate" },
							{ "data": "refixdate" },
							{ "data": "action" }
						],
			target	:	[6],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
