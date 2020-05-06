<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="breadcrumb-item active">Company Register List</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Company Registrar</h4>
				<div class="table-responsive">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>PIRB Company ID</th>
								<th>Company Name</th>
								<th>Status</th>
								<th>Number of Employed Licensed and Master Plumbers</th>
								<th>Number of Employed Learner,Technical Assistants,Technical Operators and Qualified Plumbers</th>
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
			url 	: 	'<?php echo base_url()."admin/company/index/DTcompanylist"; ?>',
			columns : 	[
							{ "data": "id" },
							{ "data": "company" },
							{ "data": "status" },
							{ "data": "lmcount" },
							{ "data": "lttqcount" },
							{ "data": "action" }
						],
			target 	: [5],
			sort 	: '0',
			order 	: [['2', 'asc']]
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
