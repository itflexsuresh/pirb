<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Manage Allocated Audits</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Manage Allocated Audits</li>
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

<div id="cancelcocmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<form action="" method="post" class="cancelcocform">
					<div class="row">						
						<div class="col-md-12">
							<label class="checkbox">
								<input type="checkbox" name="cancelcoc">
								<p>Cancel COC</p>
							</label>
						</div>
						<div class="col-md-12">
							<input type="hidden" name="coc_id" id="coc_id">
							<button type="submit" name="cancelcocsubmit" class="btn btn-success cancelcocsubmit">Confirm</button>
							<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		
		validation(
			'.cancelcocform',
			{
				cancelcoc : {
					required:  	true
				}
			},
			{
				cancelcoc 	: {
					required	: "Please check checkbox.",
				}
			},
			{
				ignore : [],
			}
		);
		
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
	
	$(document).on('click', '#cancelcoc', function(){
		$('#coc_id').val($(this).attr('data-id'));
		$('#cancelcocmodal').modal('show');
	})
</script>
