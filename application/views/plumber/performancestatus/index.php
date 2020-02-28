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
		
		var line = new Morris.Line({
		element: 'performancechart',
		resize: true,
		data: [
			{y: '2011 Q1', item1: 2666},
			{y: '2011 Q2', item1: 2778},
			{y: '2011 Q3', item1: 4912},
			{y: '2011 Q4', item1: 3767},
			{y: '2012 Q1', item1: 6810},
			{y: '2012 Q2', item1: 5670},
			{y: '2012 Q3', item1: 4820},
			{y: '2012 Q4', item1: 15073},
			{y: '2013 Q1', item1: 10687},
			{y: '2013 Q2', item1: 8432}
		],
		xkey: 'y',
		ykeys: ['item1'],
		labels: ['Item 1'],
		gridLineColor: '#eef0f2',
		lineColors: ['#009efb'],
		lineWidth: 1,
		hideHover: 'auto'
		});
	});
</script>
