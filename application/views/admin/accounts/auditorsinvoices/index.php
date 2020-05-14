
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Auditors Invoices</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Auditors Invoices</li>
			</ol>
		</div>
	</div>
</div>

<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="mt-4 form" action="" method="post">
					<div class="col-md-6">					
			    	</div>					
				</form>
				
				<div id="active" class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Invoice Number</th>
								<th>Date</th>
								<th>Auditor</th>
								<th>Invoice Description</th>
								<th>Total Invoice Value</th>
								<th></th>
								<th>Payment Status</th>
								<th>Internal Inv Number</th>		
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
			url 	: '<?php echo base_url()."admin/accounts/auditorsinvoices/Index/DTAccounts"; ?>',
			columns : 	[
			{ "data": "inv_id" },
			{ "data": "created_at" },
			{ "data": "name" },
			{ "data": "description" },
			{ "data": "total_cost" },
			{ "data": "action" },			
			{ "data": "status" },
			{ "data": "internal_inv" }
			
			],
			
		};
		
		ajaxdatatables('.datatables', options);
		
	
	});
	
	// Delete
	
	
</script>
