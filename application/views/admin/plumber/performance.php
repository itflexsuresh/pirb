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
		<h4 class="text-themecolor">Performance Status</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Performance Status</li>
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
				<h4 class="card-title">Performance Status for <?php echo $user_details['name']." ".$user_details['surname']?></h4>

				<?php if(count($results) > 0 && $pagestatus!='1'){ ?>
					<h5>Current Performance Status = <?php echo array_sum(array_column($results, 'point')); ?></h5>
					<div id="performancechart"></div>
				<?php } ?>
				
				<!-- <div class="table-responsive m-t-40">
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
								<th>Action</th>
							</tr>							
						</thead>
					</table>
				</div> -->

			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		
		// var options = {
		// 	url 	: 	'<?php //echo base_url()."admin/plumber/index/DTCocStatement"; ?>',			
		// 	data    : { page : 'plumbercocstatement', user_id : '<?php //echo $id; ?>'},
		// 	columns : 	[
		// 					{ "data": "cocno" },
		// 					{ "data": "cocstatus" },
		// 					{ "data": "purchased" },
		// 					{ "data": "coctype" },
		// 					{ "data": "customer" },
		// 					{ "data": "address" },
		// 					{ "data": "company" },
		// 					{ "data": "action" }
		// 				],
		// 	target	:	[7],
		// 	sort	:	'0'
		// };
		
		// ajaxdatatables('.datatables', options);


		var results = $.parseJSON('<?php echo json_encode($results); ?>');
		var warning = $.parseJSON('<?php echo json_encode($warning); ?>');
		var pagestatus = '<?php echo $pagestatus; ?>';
		
		var chartdata = [];
		$(results).each(function(i, v){
			chartdata.push({y: v.date, item1: v.point});
		})
		
		var chart = {
			element: 'performancechart',
			resize: true,
			data: chartdata,
			xkey: 'y',
			ykeys: ['item1'],
			labels: ['Point'],
			gridLineColor: '#000',
			lineColors: ['#000'],
			lineWidth: 1,
			hideHover: 'auto',
			xLabelFormat: function (x) { return formatdate(x, 1).toString(); },
			continuousLine:true
		}
		
		if(warning.length){
			var goalarray 	= [];
			var max 		= '';
			$(warning).each(function(i,v){
				goalarray.push(v.point);
				max = v.point;
			})
			chart['goals'] 				= goalarray;
			chart['goalLineColors'] 	= ['#FFF8E3', '#FFEEB9', '#FBB596', '#FF0000'];
			chart['ymin'] 				= max;
		}
		
		var line = new Morris.Line(chart);


	});
</script>
