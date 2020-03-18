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
					<?php $overallpoint = array_sum(array_column($results, 'point')); ?>
					<h5>Current Performance Status = <?php echo $overallpoint; ?></h5>
					<div id="performancelinechart" style="width:100%; height:400px;"></div>
					<div id="performancechart" style="width:100%; height:400px;"></div>
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
	var overallpoint = '<?php echo isset($overallpoint) ? $overallpoint : "0"; ?>';
	
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
		
		var chartxaxis 		= [];
		var chartyaxis 		= [];
		var chartseries 	= [];
		var warningcolor 	= ['#FFF8E3', '#FFEEB9', '#FBB596', '#FF0000'];
		
		$(results).each(function(i, v){
			chartxaxis.push(v.date);
			chartyaxis.push(v.point);
		})
		
		chartseries.push({name : 'Performance Chart', yaxis : chartyaxis, symbol : 2 });
		
		$(warning).each(function(i, v){
			var warningarray = [];
			$(results).each(function(){
				warningarray.push(v.point);
			})
			
			chartseries.push({name : v.name, yaxis : warningarray, symbol : 0, color : warningcolor[i]});
		})
		
		linechart(
			'performancelinechart',
			{
				xaxis 	: 	chartxaxis,
				series 	: 	chartseries,
				colors 	: 	['#4472C4', '#FFF8E3', '#FFEEB9', '#FBB596', '#FF0000']
			}
		);
		
		gaugechart(
			'performancechart',
			{
				name : 'Performance Chart',
				data : [{value: overallpoint, name: 'Performance Chart'}],
				colors : [[0.2, '#55ce63'],[0.5, '#FBB596'],[0.8, '#009efb'],[1, '#f62d51']]
				
			}
		);
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
