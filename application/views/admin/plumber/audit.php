<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Statement</li>
			</ol>
		</div>
	</div>
</div>

<?php 
echo $notification; 
if($roletype=='1'){ echo isset($menu) ? $menu : ''; } 
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Audit Details for <?php echo $user_details['name']." ".$user_details['surname']?></h4>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Consumer</th>
								<th>Address</th>
								<th>Refix Date</th>
								<th>Auditor</th>
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
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTAuditStatement"; ?>',
			data    : 	{ user_id : '<?php echo $id; ?>'},
			columns : 	[
							{ "data": "cocno" },
							{ "data": "status" },
							{ "data": "consumer" },
							{ "data": "address" },
							{ "data": "refixdate" },
							{ "data": "auditor" },
							{ "data": "action" }
						],
			target	:	[6],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
