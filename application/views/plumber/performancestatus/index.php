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
				
				<div id="performancechart"></div>
				 
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date of Performance</th>
								<th>Performance Type</th>
								<th>Comments</th>
								<th>Point Allocation</th>
								<th>Attachment</th>
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
	var results = $.parseJSON('<?php echo json_encode($results); ?>');
	var warning = $.parseJSON('<?php echo json_encode($warning); ?>');
	
	$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."plumber/performancestatus/index/DTPerformancestatus"; ?>',
			data 	: 	{ page : 'plumberperformancestatus' },
			columns : 	[
							{ "data": "date" },
							{ "data": "type" },
							{ "data": "comments" },
							{ "data": "point" },
							{ "data": "attachment" },
							{ "data": "action" }
						],
			target	:	[4,5],
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
			behaveLikeLine : true,
			xLabelFormat: function (x) { return formatdate(x, 1).toString(); }
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
		
		var line = new Morris.Area(chart);
	});
</script>
