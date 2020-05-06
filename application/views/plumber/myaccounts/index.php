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
		<h4 class="text-themecolor">My Accounts</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My Accounts</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>

				
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				<form id="pyamentform" action="https://sandbox.payfast.co.za/eng/process" method="post">
					<!---	Payment	--->
					<input id="merchant_id" name="merchant_id" value="10016054" type="hidden">
					<input id="merchant_key" name="merchant_key" value="uwfiy08dfb6jn" type="hidden">
					<input id="return_url" name="return_url" value="<?php echo base_url().'plumber/myaccounts/index/returnurl'; ?>" type="hidden">
					<input id="cancel_url" name="cancel_url" value="<?php echo base_url().'plumber/myaccounts/index/cancelurl'; ?>" type="hidden">
					<input id="notify_url" name="notify_url" value="<?php echo base_url().'plumber/myaccounts/index/notifyurl'; ?>" type="hidden">
					<input id="name_first" name="name_first" type="hidden">
					<input id="name_last" name="name_last" type="hidden">
					<input id="email_address" name="email_address" type="hidden">
					<input id="m_payment_id" name="m_payment_id" value="TRN1481493600" type="hidden">
					<input type="hidden" id="totaldue1" class="form-control" readonly name="amount">
					<input id="item_name" name="item_name" value="registration" type="hidden">
					<input id="item_description" name="item_description" value="registration" type="hidden">
					<input id="payment_method" name="payment_method" value="cc" type="hidden">
					<input type="submit" name="submit" id="paymentsubmit" value="submit" style="display: none;">
				</form>

				
			
				<h4 class="card-title">My Accounts</h4>
				<div id="active" class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Description</th>
								<th>Invoice Number</th>
								<th>Invoice Date</th>
								<th>Invoice Value</th>
								<th>Invoice Status</th>
								<th>Order Status</th>
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
			url 	: 	'<?php echo base_url()."plumber/myaccounts/index/DTAccounts"; ?>',
			data	: 	{page : 'plumberaccount'},
			columns : 	[
							{ "data": "description" },
							{ "data": "invoiceno" },
							{ "data": "invoicedate" },
							{ "data": "invoicevalue" },
							{ "data": "invoicestatus" },
							{ "data": "orderstatus" },
							{ "data": "action" }
						],
			target : [4, 5, 6],
			sort : '0'
		};
		
		ajaxdatatables('.datatables', options);
	
	});

	// $(document).ready(function(){
	// 	$('#paymentsubmit').click(function(){
	// 		alert('submit');
	// 		$('#pyamentform').submit();
	// 	});
	// });
</script>
