<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'auditor/dashboard'; ?>">Home</a></li>
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
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Plumber</th>
								<th>Phone (Mobile)</th>
								<th>Date Allocated to Plumber</th>
								<th>Refix Date</th>
								<th>Refix Complete Date</th>
								<th>Suburb</th>
								<th>Owners Name and Surname</th>
								<th>Owners Tel Number</th>
								<th>Action</th>
								<th class="displaynone">Notification</th>
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
							{ "data": "allocateddate" },
							{ "data": "refixdate" },
							{ "data": "refixcompletedate" },
							{ "data": "suburb" },
							{ "data": "ownername" },
							{ "data": "ownermobile" },
							{ "data": "action" },
							{ "data": "notification" }
						],
			target	:	[10],
			sort	:	'0',
			order 	: 	[[0, 'desc']],
			target1	:	[11],
			visible1:	'0',
			createdrow : createdrow
		};
		
		ajaxdatatables('.datatables', options);
	});
	
	function createdrow(row, data, dataIndex){
		if(data.notification=='2'){
			$(row).addClass('tablestripe');
		}
	}
</script>
