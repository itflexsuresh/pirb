<?php

if($roletype=='1'){
	$heading = 'Manage Allocted Audits';
}else if($roletype=='3' || $roletype=='5'){
	$heading = 'Audit Report';
}

$plumberid			= '';
$auditorid			= '';

$loggedcoc 		 = isset($loggedcoc) ? $loggedcoc : '';
$count 			 = isset($history['count']) ? $history['count'] : '';
$total 			 = isset($history['total']) ? $history['total'] : '';
$refixincomplete = isset($history['refixincomplete']) ? $history['refixincomplete'] : '';
$refixcomplete 	 = isset($history['refixcomplete']) ? $history['refixcomplete'] : '';
$compliment 	 = isset($history['compliment']) ? $history['compliment'] : '';
$cautionary 	 = isset($history['cautionary']) ? $history['cautionary'] : '';
$noaudit 		 = isset($history['noaudit']) ? $history['noaudit'] : '';

if($loggedcoc > 0 && $count > 0)
	$percentage 	= round(($count/$loggedcoc)*100,2).'%'; 
else
	$percentage = 0;

if($refixincomplete > 0)
	$refixincompletepercentage 	= round(($refixincomplete/$total)*100,2).'%'; 
else
	$refixincompletepercentage = 0;

if($refixcomplete > 0)
	$refixcompletepercentage 	= round(($refixcomplete/$total)*100,2).'%'; 
else
	$refixcompletepercentage = 0;

if($compliment > 0)
	$complimentpercentage 		= round(($compliment/$total)*100,2).'%';
else
	$complimentpercentage = 0;

if($cautionary > 0)
	$cautionarypercentage 		= round(($cautionary/$total)*100,2).'%';
else
	$cautionarypercentage = 0;

if($noaudit > 0)
	$noauditpercentage 			= round(($noaudit/$total)*100,2).'%';
else
	$noauditpercentage = 0;
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/plumber/index'; ?>">Plumber Register</a></li>
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
				
				<div class="row">
					<div class="col-md-2">
						<label >Number of Logged COC's</label>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="loggedcoc" value="<?php echo $loggedcoc; ?>">
					</div>
					<div class="col-md-2">
						<label>Number of Audits Done to Date</label>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="auditdone" value="<?php echo $count; ?>">
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" name="percentage" value="<?php echo $percentage; ?>">
					</div>
				</div>
				
				<div id="reviewchart" style="width:100%; height:400px;"></div>
				
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
			data    : 	{ page : 'plumberauditorstatement', user_id : '<?php echo $id; ?>'},
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

	var auditorid 		= '<?php echo $auditorid; ?>';
	var plumberid 		= '<?php echo $plumberid; ?>';
	var count 			= '<?php echo $count; ?>';
	var total 			= '<?php echo $total; ?>';
	var refixincomplete = '<?php echo $refixincomplete; ?>';
	var refixcomplete 	= '<?php echo $refixcomplete; ?>';
	var compliment 		= '<?php echo $compliment; ?>';
	var cautionary 		= '<?php echo $cautionary; ?>';
	var noaudit 		= '<?php echo $noaudit; ?>';
	
	barchart(
		'reviewchart',
		{
			xaxis : [
				'Total No of Audit Findings',
				'Compliments',
				'Cautionary',
				'Refix (Complete)',
				'Refix(In Complete)',
				'No Audit'
			],
			series : [{
				name : 'Audit',
				yaxis : [
					total,
					compliment,
					cautionary,
					refixcomplete,
					refixincomplete,
					noaudit
				],
				colors : ['#4472C4','#843C0C','#FF0000','#ED7D31','#333F50','#4472C4']
			}]
		}
	);
});
</script>
