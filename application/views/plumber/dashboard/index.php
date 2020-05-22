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
								<div class="text-center">
									<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#FEC806" data-angleOffset=-125 data-angleArc=250 value="<?php echo $mycpd; ?>" readonly/>
								</div>
								<p><a href="<?php echo base_url().'plumber/mycpd/index'; ?>">View CPD Activities</a></p>
							</div>
							<div class="col-md-6">
								<p>My COC’s</p>
								<div id="mycocs" style="width:100%; height:400px;"></div>
							</div>
							<div class="col-md-8">
								<p>My Audits</p>
								<div style="position:relative;height:250px;">
									<div style="position:absolute;left:10px;top:10px">
										<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#53C2BF" data-displayInput=false data-angleOffset=-125 data-angleArc=250 value="<?php echo $auditcoc; ?>" readonly/>
									</div>
									<div style="position:absolute;left:30px;top:30px">
										<input data-plugin="knob" data-width="160" data-height="160" data-min="0" data-thickness="0.2" data-fgColor="#FF0000" data-displayInput=false data-angleOffset=-125 data-angleArc=250 value="<?php echo $auditrefixincomplete; ?>" readonly/>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<p>Audit Ratio</p>
								<p><?php echo $auditorratio; ?></p>
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
	var provinceperformancestatus = $.parseJSON('<?php echo str_replace("'", "\'", addslashes(json_encode($provinceperformancestatus))); ?>');
	$(provinceperformancestatus).each(function(i,v){
		provinceperformancestatusxaxis.push(v.point);
		provinceperformancestatusyaxis.push(v.point);
	})
	
	var cityperformancestatusxaxis =[], cityperformancestatusyaxis = [];
	var cityperformancestatus = $.parseJSON('<?php echo str_replace("'", "\'", addslashes(json_encode($cityperformancestatus))); ?>');
	$(cityperformancestatus).each(function(i,v){
		cityperformancestatusxaxis.push(v.point);
		cityperformancestatusyaxis.push(v.point);
	})
	
	$(function(){
		knobchart();
		
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