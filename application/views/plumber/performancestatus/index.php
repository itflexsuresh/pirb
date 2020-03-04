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
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Performance Status</h4>
				
				<?php if(count($results) > 0 && $pagestatus!='1'){ ?>
					<h5>Current Performance Status = <?php echo array_sum(array_column($results, 'point')); ?></h5>
					<div id="performancechart"></div>
				<?php } ?>
				
				<div class="row m-t-30">
					<div class="col-md-12">
						<a href="<?php echo base_url().'plumber/performancestatus/index'; ?>" class="btn btn-primary">Active</a>
						<a href="<?php echo base_url().'plumber/performancestatus/index/index/2'; ?>" class="btn btn-primary">Archived</a>
					</div>
				</div>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date of Performance</th>
								<th>Performance Type</th>
								<th>Comments</th>
								<th>Point Allocation</th>
								<th>Attachment</th>
							</tr>							
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	var results = $.parseJSON('<?php echo json_encode($results); ?>');
	var warning = $.parseJSON('<?php echo json_encode($warning); ?>');
	var pagestatus = '<?php echo $pagestatus; ?>';
	
	$(function(){
		var column	= 	[
							{ "data": "date" },
							{ "data": "type" },
							{ "data": "comments" },
							{ "data": "point" },
							{ "data": "attachment" }
						];
		
		var options = {
			url 	: 	'<?php echo base_url()."plumber/performancestatus/index/DTPerformancestatus"; ?>',
			data 	: 	{ page : 'plumberperformancestatus', archive : pagestatus},
			columns : 	column,
			target	:	[4],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
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
	
	$(document).on('click', '.archive', function(){
		var action 	= 	'<?php echo base_url().'plumber/performancestatus/index/action'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="'+$(this).attr('data-flag')+'" name="flag">\
		';

		sweetalert(action, data);
	})
</script>
