<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Dashboard</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
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
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6">
								<p>My CPD Points</p>
								<div id="mycpdpoints" style="width:100%; height:400px;"></div>
							</div>
							<div class="col-md-6">
								<p>My COC’s</p>
								<div id="mycocs" style="width:100%; height:400px;"></div>
							</div>
							<div class="col-md-8">
								<p>My Audits</p>
								<div id="myaudits" style="width:100%; height:400px;"></div>
							</div>
							<div class="col-md-4">
								<div id="myaudits" style="width:100%; height:400px;"></div>
								<p>Audit Ratio</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<p>My Performance Status</p>
						<p>My Performance Score</p>
						<p><?php echo $performancestatus; ?></p>
						<p>My Country Ranking</p>
						<p><?php echo $myprovinceperformancestatus; ?></p>
						<p>My Regional  Ranking</p>
						<p><?php echo $mycityperformancestatus; ?></p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6">
								<p>Current Top 3 Regional Ranking (Country)</p>
								<div id="provinceperformancestatus" style="width:100%; height:400px;"></div>
							</div>
							<div class="col-md-6">
								<p>Current Top 3 Regional Ranking (City)</p>
								<div id="cityperformancestatus" style="width:100%; height:400px;"></div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
	
	var mycpd 			= '<?php echo $mycpd; ?>';
	var nonlogcoc 		= '<?php echo $nonlogcoc; ?>';
	var adminstock 		= '<?php echo $adminstock; ?>';
	var coccount 		= '<?php echo $coccount; ?>';
	
	var provinceperformancestatusxaxis =[], provinceperformancestatusyaxis = [];
	var provinceperformancestatus = $.parseJSON('<?php echo str_replace("'", "\'", json_encode($provinceperformancestatus)); ?>');
	$(provinceperformancestatus).each(function(i,v){
		provinceperformancestatusxaxis.push(v.point);
		provinceperformancestatusyaxis.push(v.point);
	})
	
	var cityperformancestatusxaxis =[], cityperformancestatusyaxis = [];
	var cityperformancestatus = $.parseJSON('<?php echo str_replace("'", "\'", json_encode($cityperformancestatus)); ?>');
	$(cityperformancestatus).each(function(i,v){
		cityperformancestatusxaxis.push(v.point);
		cityperformancestatusyaxis.push(v.point);
	})
	
	$(function(){
		
		piechart2(
			'mycpdpoints',
			{
				name : 'My CPD',
				yaxis : [{value: mycpd, name: 'cpd'},{value: mycpd, name: 'cpd'}]
			}
		)
		
		barchart3(
			'mycocs',
			{
				xaxis : [
					'Number of \n Non Logged \n COCs',
					'COC’s yet \n to allocated',
					'Permitted COCs \n that you are \n able to purchase'
				],
				series : [{
					name : 'My COC’s',
					yaxis : [
						nonlogcoc,
						adminstock,
						coccount
					],
					colors : ['#C4E0B2','#CEF57F','#9ADD11']
				}]
			}
		)
		
		barchart2(
			'provinceperformancestatus',
			{
				xaxis : provinceperformancestatusxaxis,
				series : [{
					name : 'Audit',
					yaxis : provinceperformancestatusyaxis,
					colors : ['#FFC000','#D0CECE','#BF9000']
				}]
			}
		)
		
		barchart2(
			'cityperformancestatus',
			{
				xaxis : cityperformancestatusxaxis,
				series : [{
					name : 'Audit',
					yaxis : cityperformancestatusyaxis,
					colors : ['#FFC000','#D0CECE','#BF9000']
				}]
			}
		)
		
	});
</script>
