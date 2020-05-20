<?php
$count 				= $history['count'];
$atotal 			= $history['total'];
$refixincomplete 	= $history['refixincomplete'];
$refixcomplete 		= $history['refixcomplete'];
$compliment 		= $history['compliment'];
$cautionary 		= $history['cautionary'];
$noaudit 			= $history['noaudit'];

$refixincompletepercentage 	= ($refixincomplete!=0) ? round(($refixincomplete/$atotal)*100,2).'%' : '0%'; 
$refixcompletepercentage 	= ($refixcomplete!=0) ? round(($refixcomplete/$atotal)*100,2).'%' : '0%'; 
$complimentpercentage 		= ($compliment!=0) ? round(($compliment/$atotal)*100,2).'%' : '0%'; 
$cautionarypercentage 		= ($cautionary!=0) ? round(($cautionary/$atotal)*100,2).'%' : '0%'; 
$noauditpercentage 			= ($noaudit!=0) ? round(($noaudit/$atotal)*100,2).'%' : '0%'; 
$auditpercentage 			= ($count!=0 && $logged!=0) ? round(($count/$logged)*100,2).'%' : '0%'; 

$developmental1 = 0;
$workbased1 	= 0;
$individual1 	= 0;

$cpdarray 	= explode("@@@", $settings_cpd[0]['cpd']);
$devarray 	= explode("@-@", $cpdarray[0]);
$workarray 	= explode("@-@", $cpdarray[1]);
$indarray 	= explode("@-@", $cpdarray[2]);

if($user_details['designation'] == '1'){
	$developmental1 = isset($devarray[6]) ? $devarray[6] : '';
	$workbased1 	= isset($workarray[6]) ? $workarray[6] : '';
	$individual1 	= isset($indarray[6]) ? $indarray[6] : '';
}
elseif($user_details['designation'] == '2'){
	$developmental1 = isset($devarray[5]) ? $devarray[5] : '';
	$workbased1 	= isset($workarray[5]) ? $workarray[5] : '';
	$individual1 	= isset($indarray[5]) ? $indarray[5] : '';
}
elseif($user_details['designation'] == '3'){
	$developmental1 = isset($devarray[4]) ? $devarray[4] : '';
	$workbased1 	= isset($workarray[4]) ? $workarray[4] : '';
	$individual1 	= isset($indarray[4]) ? $indarray[4] : '';
}
elseif($user_details['designation'] == '4'){
	$developmental1 = isset($devarray[3]) ? $devarray[3] : '';
	$workbased1 	= isset($workarray[3]) ? $workarray[3] : '';
	$individual1 	= isset($indarray[3]) ? $indarray[3] : '';
}
elseif($user_details['designation'] == '6'){
	$developmental1 = isset($devarray[2]) ? $devarray[2] : '';
	$workbased1	 	= isset($workarray[2]) ? $workarray[2] : '';
	$individual1 	= isset($indarray[2]) ? $indarray[2] : '';
}

$developmental 	= isset($history2['developmental']) ? $history2['developmental'] : 0;
$workbased 	   	= isset($history2['workbased']) ? $history2['workbased'] : 0;
$individual    	= isset($history2['individual']) ? $history2['individual'] : 0;

$total 			= $developmental + $workbased + $individual;
$total1 		= $developmental1 + $workbased1 + $individual1;
?>


<style>
.target {
  height: 10px;
  width: 10px;
  background-color: #4472C4;
}
.achieved {
  height: 10px;
  width: 10px;
  background-color: #ED7D31;
}
</style>

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
					'Number of Non Logged COCs',
					'COC’s yet to allocated',
					'Permitted COCs that you are able to purchase'
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
