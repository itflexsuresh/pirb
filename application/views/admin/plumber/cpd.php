<?php

if($roletype=='1'){
	$heading = 'Manage Allocted Audits';
}else if($roletype=='3' || $roletype=='5'){
	$heading = 'Audit Report';
}

$plumberid			= '';
$auditorid			= '';
$developmental1 = '';
$workbased1 = '';
$individual1 = '';

$cpdarray = explode("@@@", $settings_cpd[0]['cpd']);
$devarray = explode("@-@", $cpdarray[0]);
$workarray = explode("@-@", $cpdarray[1]);
$indarray = explode("@-@", $cpdarray[2]);

if($user_details['designation'] == '1'){
	$developmental1 = isset($devarray[6]) ? $devarray[6] : '';
	$workbased1 = isset($workarray[6]) ? $workarray[6] : '';
	$individual1 = isset($indarray[6]) ? $indarray[6] : '';
}
elseif($user_details['designation'] == '2'){
	$developmental1 = isset($devarray[5]) ? $devarray[5] : '';
	$workbased1 = isset($workarray[5]) ? $workarray[5] : '';
	$individual1 = isset($indarray[5]) ? $indarray[5] : '';
}
elseif($user_details['designation'] == '3'){
	$developmental1 = isset($devarray[4]) ? $devarray[4] : '';
	$workbased1 = isset($workarray[4]) ? $workarray[4] : '';
	$individual1 = isset($indarray[4]) ? $indarray[4] : '';
}
elseif($user_details['designation'] == '4'){
	$developmental1 = isset($devarray[3]) ? $devarray[3] : '';
	$workbased1 = isset($workarray[3]) ? $workarray[3] : '';
	$individual1 = isset($indarray[3]) ? $indarray[3] : '';
}
elseif($user_details['designation'] == '6'){
	$developmental1 = isset($devarray[2]) ? $devarray[2] : '';
	$workbased1 = isset($workarray[2]) ? $workarray[2] : '';
	$individual1 = isset($indarray[2]) ? $indarray[2] : '';
}

$developmental = isset($history['developmental']) ? $history['developmental'] : '';
$workbased 	   = isset($history['workbased']) ? $history['workbased'] : '';
$individual    = isset($history['individual']) ? $history['individual'] : '';

if($developmental == '')
	$developmental = 0;

if($workbased == '')
	$workbased = 0;

if($individual == '')
	$individual = 0;


if($developmental1 == '')
	$developmental1 = 0;

if($workbased1 == '')
	$workbased1 = 0;

if($individual1 == '')
	$individual1 = 0;

$total = $developmental + $workbased + $individual;
$total1 = $developmental1 + $workbased1 + $individual1;

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My CPD</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My CPD</li>
			</ol>
		</div>
	</div>
</div>

<?php 
echo $notification; 
if($roletype=='1'){ echo isset($menu) ? $menu : ''; } 
$pagestatus = isset($pagestatus) ? $pagestatus : '';
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

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">CPD Activties for <?php echo $user_details['name']." ".$user_details['surname']?></h4>

				<div id="reviewchart" style="width:100%; height:400px;"></div>
				
				<div class="target"></div><label>Target</label>				
				<div class="achieved"></div><label>Achieved</label>
				
				<div class="row add_top_value">
					<div class="col-md-6">
						<a href="<?php echo base_url()."admin/plumber/index/cpd/".$id."/1"; ?>" class="active_link_btn">CURRENT YEAR</a>  <a href="<?php echo base_url()."admin/plumber/index/cpd/".$id."/2"; ?>" class="archive_link_btn">PREVIOUS YEARS</a>
					</div>					
				</div>

				<div id="active" class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date of Activity</th>
								<th>CPD Activty</th>
								<th>CPD Stream</th>
								<th>Comments</th>
								<th>CPD Points Awarded</th>
								<th>Attachment</th>
								<th>Status</th>
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
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTCpdQueue"; ?>',
			columns : 	[
			{ "data": "date" },
			{ "data": "acivity" },
			{ "data": "streams" },
			{ "data": "comments" },
			{ "data": "points" },
			{ "data": "attachment" },
			{ "data": "status" },
			{ "data": "action" }
			],
			data : {pagestatus : '<?php echo $pagestatus; ?>',user_id : '<?php echo $id; ?>'}
		};
		
		ajaxdatatables('.datatables', options);
	
	var auditorid 	= '<?php echo $auditorid; ?>';
	var plumberid 	= '<?php echo $plumberid; ?>';
	var developmental = '<?php echo $developmental; ?>';
	var workbased 	= '<?php echo $workbased; ?>';
	var individual 	= '<?php echo $individual; ?>';
	var total 		= '<?php echo $total; ?>';
	var developmental1 = '<?php echo $developmental1; ?>';
	var workbased1 	= '<?php echo $workbased1; ?>';
	var individual1 	= '<?php echo $individual1; ?>';
	var total1		= '<?php echo $total1; ?>';
	
	barchart(
		'reviewchart',
		{
			xaxis : [
				'Development',
				'Work-Base',
				'Individual',
				'Total'
			],
			series : [
				{
					name : 'CPD',
					yaxis : [
						developmental1,
						workbased1,
						individual1,
						total1
					],
					color : '#4472C4'
				},
				{
					name : 'CPD',
					yaxis : [
						developmental,
						workbased,
						individual,
						total
					],
					color : '#ED7D31'
				}
			]
		}
	);
		
});

	var req2 = null;
	function search_activity(value)
	{
	    if (req2 != null) req2.abort();
	    var strlength2 = $.trim($('#activity').val()).length;
	    if(strlength2 > 0)  { 
		    req2 = $.ajax({
		        type: "POST",
		        url: '<?php echo base_url()."plumber/mycpd/index/activityDetails"; ?>',
		        data: {'search_keyword' : value},        
		        beforeSend: function(){
					// $("#search_reg_no").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
		        success: function(data){          	
		        	$("#activity_suggesstion").html('');
		        	$("#activity").val('');
					$("#points").val('');
					$("#cpdstream").val('');
		        	$("#activity_suggesstion").show();      	
					$("#activity_suggesstion").html(data);			
					$("#activity").css("background","#FFF");
		        }
		    });
		}
		else{
			console.log(strlength2);
			$("#activity_suggesstion").hide();
		}
	}

	function selectActivity(activity,id,strt_date,streams,cpdPoints,streamID) {
		$("#activity").val(activity);
		$("#points").val(cpdPoints);
		$("#cpdstream").val(streams);
		$("#activity_id_hide").val(id);
		$("#hidden_stream_id").val(streamID);
		$("#activity_suggesstion").hide();
	}

	
		
</script>
