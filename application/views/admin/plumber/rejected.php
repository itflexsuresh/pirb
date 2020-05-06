<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Reject Applications</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Reject Applications</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Reject Applications</h4>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date of application received</th>
								<th>Name & Surname</th>
								<th>Reason for Rejection</th>
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
		datatable();
	});
		
	function datatable(){

		var options = {
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTRejectedPlumber"; ?>',
			data    :   { page : 'adminplumberrejectedlist'},
			columns : 	[
							{ "data": "applicationreceived" },
							{ "data": "name" },
							{ "data": "reason" },
							{ "data": "action" }
						],
			target	:	[2,3],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	}
</script>
