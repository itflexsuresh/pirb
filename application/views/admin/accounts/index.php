<?php
if(isset($result) && $result){
	$id 				= $result['id'];
	$activity 			= (set_value('activity')) ? set_value('activity') : $result['activity'];
	$startdate 			= (set_value('startdate')) ? set_value('startdate') : $result['startdate'];
	$points 			= (set_value('points')) ? set_value('points') : $result['points'];
	$cpdstream 			= (set_value('cpdstream')) ? set_value('cpdstream') : $result['cpdstream'];
	$enddate 			= (set_value('enddate')) ? set_value('enddate') : $result['enddate'];
	$productcode 		= (set_value('productcode')) ? set_value('productcode') : $result['productcode'];
	$qrcode 			= (set_value('qrcode')) ? set_value('qrcode') : $result['qrcode'];
	$status 			= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading			= 'Update';
}else{
	$id 				= '';
	$activity			= set_value('activity');
	$startdate			= set_value('startdate');
	$points				= set_value('points');
	$enddate			= set_value('enddate');
	$productcode		= set_value('productcode');
	$qrcode				= set_value('qrcode');
	$cpdstream			= set_value('cpdstream');
	$status				= set_value('status');

	$heading			= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber COC Invoices</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumber COC Invoices</li>
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
								<th>Plumber Name and Surname</th>
								<th>Plumber Reg Number </th>
								<th>Invoice Description </th>
								<th>Total Invoice Value</th>
								<th>Internal Inv Number</th>	
								<th></th>		
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
			url 	: '<?php echo base_url()."admin/accounts/Accounts/DTAccounts"; ?>',
			columns : 	[
				{ "data": "inv_id" },
				{ "data": "created_at" },
				{ "data": "name" },
				{ "data": "registration_no" },
				{ "data": "description" },
				{ "data": "total_cost" },
				{ "data": "internal_inv" },
				{ "data": "action" }
			],
			target	:	[7],
			sort	:	'0'
			
		};
		
		ajaxdatatables('.datatables', options);
		
	
	});
	
	// Delete
	
	
</script>
