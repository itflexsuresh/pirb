<?php

if($roletype=='1'){
	$heading = 'Manage Allocted Audits';
}else if($roletype=='3' || $roletype=='5'){
	$heading = 'Audit Report';
}

$plumberid	 = '';
$auditorid	 = '';

$logged 	 = isset($logged) ? $logged : '';
$allocated 	 = isset($allocated) ? $allocated : '';
$nonlogged 	 = isset($nonlogged) ? $nonlogged : '';
if($logged == '')
	$logged = 0;

if($allocated == '')
	$allocated = 0;

if($nonlogged == '')
	$nonlogged = 0;


$count 			 = isset($history['count']) ? $history['count'] : '';
$total 			 = isset($history['total']) ? $history['total'] : '';
$refixincomplete = isset($history['refixincomplete']) ? $history['refixincomplete'] : '';
$refixcomplete 	 = isset($history['refixcomplete']) ? $history['refixcomplete'] : '';

if($refixincomplete > 0)
	$refixincompletepercentage 	= round(($refixincomplete/$total)*100,2).'%'; 
else
	$refixincompletepercentage = 0;

if($refixcomplete > 0)
	$refixcompletepercentage 	= round(($refixcomplete/$total)*100,2).'%'; 
else
	$refixcompletepercentage = 0;

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC</li>
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
				<h4 class="card-title">COC Details for <?php echo $user_details['name']." ".$user_details['surname']?></h4>

				<div id="reviewchart" style="width:100%; height:400px;"></div>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Date of Allocated/Logged COC</th>
								<th>COC Type</th>
								<th>Customer</th>
								<th>Address</th>
								<th>Plumber Company</th>
								<!-- <th>Reseller Name</th> -->
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
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTCocStatement"; ?>',			
			data    : { page : 'plumbercocstatement', user_id : '<?php echo $id; ?>'},
			columns : 	[
							{ "data": "cocno" },
							{ "data": "cocstatus" },
							{ "data": "purchased" },
							{ "data": "coctype" },
							{ "data": "customer" },
							{ "data": "address" },
							{ "data": "company" },
							// { "data": "reseller" },
							{ "data": "action" }
						],
			target	:	[7],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);


		var auditorid 		= '<?php echo $auditorid; ?>';
		var plumberid 		= '<?php echo $plumberid; ?>';
		var total 			= '<?php echo $total; ?>';
		var refixincomplete = '<?php echo $refixincomplete; ?>';
		var refixcomplete 	= '<?php echo $refixcomplete; ?>';
		var logged 			= '<?php echo $logged; ?>';
		var nonlogged 		= '<?php echo $nonlogged; ?>';		
		var allocated 		= '<?php echo $allocated; ?>';
		
		barchart(
			'reviewchart',
			{
				xaxis : [
					'Non Logged Coc`s',
					'Non Logged Coc`s Allocated',
					'Coc`s Logged',
					'Coc`s Audited to Date',
					'Refix (Complete)',
					'Refix(In Complete)'
				],
				series : [{
					name : 'COC',
					yaxis : [
						nonlogged,
						allocated,
						logged,
						total,
						refixcomplete,
						refixincomplete
					],
					colors : ['#4472C4','#843C0C','#FF0000','#ED7D31','#333F50','#4472C4']
				}]
			}
		);
	});
</script>
