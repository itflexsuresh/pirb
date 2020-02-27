
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


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">CPD Activties for <?php echo $user_details['name']." ".$user_details['surname']?></h4>
				
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
