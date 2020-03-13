<?php
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
		<h4 class="text-themecolor">Dashboard</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'auditor/dashboard/index'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
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
					<div class="col-md-12">
						<div id="auditbar" style="width:100%; height:400px;"></div>
						<div id="auditpie" style="width:100%; height:400px;"></div>
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
					<div class="col-md-6">
						<div class="form-group">
							<label>Compliment Audit Findings</label>
							<div class=" col-md-12">
								<div class="row">
									<input type="text" class="form-control col-md-7" value="<?php echo $compliment; ?>" disabled>
									<input type="text" class="form-control col-md-4 offset-md-1" value="<?php echo $complimentpercentage; ?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
	var count 			= '<?php echo $count; ?>';
	var total 			= '<?php echo $total; ?>';
	var refixincomplete = '<?php echo $refixincomplete; ?>';
	var refixcomplete 	= '<?php echo $refixcomplete; ?>';
	var compliment 		= '<?php echo $compliment; ?>';
	var cautionary 		= '<?php echo $cautionary; ?>';
	var noaudit 		= '<?php echo $noaudit; ?>';

	$(function(){
		
		barchart(
			'auditbar',
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
		
		piechart(
			'auditpie',
			{
				name : 'Audit',
				xaxis : [
					'Compliments',
					'Cautionary',
					'Refix (Complete)',
					'Refix(In Complete)',
					'No Audit'
				],
				yaxis : [
					{value : compliment, name : 'Compliments'},
					{value : cautionary, name : 'Cautionary'},
					{value : refixcomplete, name : 'Refix (Complete)'},
					{value : refixincomplete, name : 'Refix(In Complete)'},
					{value : noaudit, name : 'No Audit'}
				],
				colors : ['#843C0C','#FF0000','#ED7D31','#333F50','#4472C4']				
			}
		)
		
	});
</script>
