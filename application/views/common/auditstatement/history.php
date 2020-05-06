<?php

if($roletype=='1'){
	$heading = 'Manage Allocted Audits';
}else if($roletype=='3' || $roletype=='5'){
	$heading = 'Audit Report';
}

$plumberid			= $result['user_id'];
$auditorid			= $result['auditorid'];
	
$count 				= $history['count'];
$total 				= $history['total'];
$refixincomplete 	= $history['refixincomplete'];
$refixcomplete 		= $history['refixcomplete'];
$compliment 		= $history['compliment'];
$cautionary 		= $history['cautionary'];
$noaudit 			= $history['noaudit'];

$refixincompletepercentage 	= ($refixincomplete!=0) ? round(($refixincomplete/$total)*100,2).'%' : '0%'; 
$refixcompletepercentage 	= ($refixcomplete!=0) ? round(($refixcomplete/$total)*100,2).'%' : '0%'; 
$complimentpercentage 		= ($compliment!=0) ? round(($compliment/$total)*100,2).'%' : '0%'; 
$cautionarypercentage 		= ($cautionary!=0) ? round(($cautionary/$total)*100,2).'%' : '0%'; 
$noauditpercentage 			= ($noaudit!=0) ? round(($noaudit/$total)*100,2).'%' : '0%'; 
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor"><?php echo $heading; ?></h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Home</li>
				<li class="breadcrumb-item active"><?php echo $heading; ?></li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<?php if($roletype=='1' || $roletype=='5'){ echo isset($menu) ? $menu : ''; } ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<?php if($roletype=='1'){ ?>
				<div id="reviewchart" style="width:100%; height:400px;"></div>
			<?php } ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Number Audits Done to Date</label>
						<input type="text" class="form-control" value="<?php echo $count; ?>" disabled>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Total Number of Audit Findings</label>
						<input type="text" class="form-control" value="<?php echo $total; ?>" disabled>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Cautionary Audit Findings</label>
						<div class=" col-md-12">
							<div class="row">
								<input type="text" class="form-control col-md-7" value="<?php echo $cautionary; ?>" disabled>
								<input type="text" class="form-control col-md-4 offset-md-1" value="<?php echo $cautionarypercentage; ?>" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Refix (In-Complete) Audit Findings</label>
						<div class=" col-md-12">
							<div class="row">
								<input type="text" class="form-control col-md-7" value="<?php echo $refixincomplete; ?>" disabled>
								<input type="text" class="form-control col-md-4 offset-md-1" value="<?php echo $refixincompletepercentage; ?>" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Refix (Complete) Audit Findings</label>
						<div class=" col-md-12">
							<div class="row">
								<input type="text" class="form-control col-md-7" value="<?php echo $refixcomplete; ?>" disabled>
								<input type="text" class="form-control col-md-4 offset-md-1" value="<?php echo $refixcompletepercentage; ?>" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>No Audit Findings Audit Findings</label>
						<div class=" col-md-12">
							<div class="row">
								<input type="text" class="form-control col-md-7" value="<?php echo $noaudit; ?>" disabled>
								<input type="text" class="form-control col-md-4 offset-md-1" value="<?php echo $noauditpercentage; ?>" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-striped datatables fullwidth">
					<thead>
						<tr>
							<th>Audit Date</th>
							<th>Auditor</th>
							<th>Installatation Type</th>
							<th>Sub Type</th>
							<th>Statements</th>
							<th>Audit Finding</th>
						</tr>
					</thead>
				</table>
			</div>
			
		</div>
	</div>
</div>		


<script>
	var roletype 		= '<?php echo $roletype; ?>';
	var auditorid 		= '<?php echo $auditorid; ?>';
	var plumberid 		= '<?php echo $plumberid; ?>';
	var count 			= '<?php echo $count; ?>';
	var total 			= '<?php echo $total; ?>';
	var refixincomplete = '<?php echo $refixincomplete; ?>';
	var refixcomplete 	= '<?php echo $refixcomplete; ?>';
	var compliment 		= '<?php echo $compliment; ?>';
	var cautionary 		= '<?php echo $cautionary; ?>';
	var noaudit 		= '<?php echo $noaudit; ?>';
	
	$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."ajax/index/ajaxdtaudithistory"; ?>',
			data	:	{plumberid : plumberid, page : 'adminaudithistroy'},
			columns : 	[
				{ "data": "date" },
				{ "data": "auditor" },
				{ "data": "installationtype" },
				{ "data": "subtype" },
				{ "data": "statementname" },
				{ "data": "finding" }
			]
		};
		
		ajaxdatatables('.datatables', options);
		
		if(roletype=='1'){
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
			)
		}
	});
	
</script>
