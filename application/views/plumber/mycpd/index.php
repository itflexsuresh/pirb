<?php
$cpd_id 				= isset($result['id']) ? $result['id'] : '';
$user_id 				= isset($result['user_id']) ? $result['user_id'] : $id;
$reg_number 			= isset($result['reg_number']) ? $result['reg_number'] : $user_details['registration_no'];
$name_surname 			= isset($result['name_surname']) ? $result['name_surname'] : $user_details['name'].' '.$user_details['surname'];
$cpd_activity 			= isset($result['cpd_activity']) ? $result['cpd_activity'] : '';
$cpd_start_date 		= isset($result['cpd_start_date']) ? date("d-m-Y",strtotime($result['cpd_start_date'])) : '';
$comments 				= isset($result['comments']) ? $result['comments'] : '';
$admincomments 			= isset($result['admin_comments']) ? $result['admin_comments'] : '';
$points 				= isset($result['points']) ? $result['points'] : '';
$cpd_stream 			= isset($result['cpd_stream']) ? $result['cpd_stream'] : '';
$status 				= isset($result['status']) ? $result['status'] : '';
$admin_comments 		= isset($result['admin_comments']) ? $result['admin_comments'] : '';

$streamname 			= isset($strem_id) ? $strem_id : '';


$profileimg 			= base_url().'assets/images/profile.jpg';
$profileimg_ad 			= base_url().'assets/images/profile.jpg';
$pdfimg 				= base_url().'assets/images/pdf.png';
$image 					= isset($result['file1']) ? $result['file1'] : '';
$image_ad 				= isset($result['file2']) ? $result['file2'] : '';
$filepath 				= base_url().'assets/uploads/cpdqueue/';
$filepath1				= (isset($result['file1']) && $result['file1']!='') ? $filepath.$result['file1'] : base_url().'assets/uploads/cpdqueue/profile.jpg';

$filepath_ad				= (isset($result['file2']) && $result['file2']!='') ? $filepath.$result['file2'] : base_url().'assets/uploads/cpdqueue/profile.jpg';

$heading 				= isset($result['id']) ? 'Submit' : 'Submit';

	if($image!=''){
		$explodefile2 	= explode('.', $image);
		$extfile2 		= array_pop($explodefile2);
		$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath1;
	}else{
		$photoidimg 	= $profileimg;
	}

	if($image_ad!=''){
		$explodefile_ad 	= explode('.', $image_ad);
		$extfile_ad 		= array_pop($explodefile_ad);
		$photoidimg2 		= (in_array($extfile_ad, ['pdf', 'tiff'])) ? $pdfimg : $filepath_ad;
	}else{
		$photoidimg2 	= $profileimg_ad;
	}
	
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My CPD</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My CPD</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="mt-4 form" method="post" enctype="multipart/form-data">

					<div class="row">
						<div class="col-md-6">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="points">PIRB CPD Activity:</label>
								<div class="customdropdownarrow">
								<input type="text" class="form-control" id="activity" name="activity" placeholder = "Enter CPD Activity" <?php if ($status=='1' || $status=='2') {
									echo "readonly";
								}else{ echo 'onclick="search_activity();"'; } ?> autocomplete="off" onkeyup="search_activity(this.value);" value="<?php echo $cpd_activity; ?>">
								</div>
								<input type="hidden" id="activity_id_hide" name="activity_id_hide" value="<?php echo $cpd_activity; ?>">
								<div id="activity_suggesstion" style="display: none;"></div>								
							</div>	
							<div class="form-group col-md-12">
								<label for="enddate">The Date on which the Activity took place or started:</label>
								<input type="text" <?php if ($status=='1' || $status=='2') {
									echo "readonly";
								} ?> autocomplete="off" class="form-control" id="startdate" name="startdate" placeholder="Enter Start Date *" value="<?php echo $cpd_start_date; ?>">						
							</div>							
							<div class="form-group col-md-12">
								<label for="productcode">Comments</label>
								<textarea class="form-control" <?php if ($status=='1' || $status=='2') {
									echo "readonly";
								} ?> id="comments" placeholder="Enter Comments" name="comments" ><?php echo $comments; ?></textarea>
							</div>

						</div>	
						</div>	
						<div class="col-md-6 cpd_section_sec">
							<div class="cpd_points_sec">
								<p class="cus_my_cpd">My CPD Points</p>
								<div class="text-center">
									<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#FEC806" data-angleOffset=-125 data-angleArc=250 value="<?php echo $mycpd; ?>" readonly/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<!-- PIRB OFFICE SECTION -->

						<?php if ($status=='1' || $status=='2') { ?>
							<div class="form-group col-md-6" id="add_bg">
								<div class="row">
									<label for="office1">PIRB Office Purpose</label>
								</div>
								<div class="form-group col-md-6">
									<label for="office2">CPD Activity Approval Status:</label>
									<div class="row">
										<div class="col-md-6">											
											<div class="custom-control custom-radio">
												<input type="radio" id="aprooved" disabled name="status" value="1" <?php if ($status==1) {
													echo 'checked="checked"';
												} ?> class="custom-control-input" >
												<label class="custom-control-label" for="aprooved">Approved</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="custom-control custom-radio">
												<input type="radio" id="rejected" disabled name="status" value="2" <?php if ($status==2) {
													echo 'checked="checked"';
												} ?> class="custom-control-input" >
												<label class="custom-control-label" for="rejected">Rejected</label>
											</div>
										</div>
										</div>
									</div>

							<label for="office2">Admin Comments:</label>
							<textarea class="form-control" <?php if ($status=='1' || $status=='2') {
								echo "readonly";
							} ?> id="admincomments" placeholder="Enter Comments" name="admincomments" ><?php echo $admincomments; ?></textarea>
							</div>
						<?php } ?>
						<!-- PIRB OFFICE SECTION END -->	

					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="card-title">Supporting Document:</h4>
								<div class="form-group">
									<div>
										<a href="<?php echo $filepath1; ?>" target="_blank">
										   <img src="<?php echo $photoidimg; ?>" class="document_image" width="100">
										</a>
										
									</div>
									<?php if ($status!='1' && $status!='2') { ?>

									<input type="file" id="file" class="document_file">
									<label for="file" class="choose_file">Choose File</label>
									<input type="hidden" name="image1" class="document_picture" value="<?php echo $image; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>

							<?php } ?>
							<?php
							if ($image_ad!='') { ?>
								<h4 class="card-title">Admin Supporting Document:</h4>
								<div class="form-group">
								<a href="<?php echo $filepath_ad; ?>" target="_blank">
									    <img src="<?php echo $photoidimg2; ?>" class="document_image_ad" width="100">
									</a>
								</div>
							<?php }
							?>
									
									
								</div>
						</div>
						
					</div>
				<?php if ($status!='1' && $status!='2') { ?>
					<div class="row">
						<div class="form-group col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" <?php if ($status=='0') { echo "checked='checked'"; } ?> name="declaration" id="declaration"  value="1">
								<label class="custom-control-label" for="declaration">I declare that the information contained in this CPD Activity form is complete, accurate and true.  I further decalre that I understadn that I must keep verifiable evidence of all the CPD activities for at least 2 years and the PRIB may conduct a random audit of my activity(s) which would require me to submit the evidence to the PIRB.</label>
							</div>
						</div>
					</div>
				<?php } ?>

					<div class="row">
						<div class="form-group col-md-6">
							<input type="hidden" readonly class="form-control" id="points" name="points" placeholder="Enter CPD Points *" value="<?php echo $points; ?>">
						</div>			
						<div class="form-group col-md-6">
							<input type="hidden" readonly class="form-control" id="cpdstream" name="cpdstream" placeholder="CPD Stream" value="<?php echo $streamname; ?>">
							<input type="hidden" readonly class="form-control" id="hidden_stream_id" name="hidden_stream_id" value="<?php echo $cpd_stream; ?>">
						</div>
					</div>

					
						<div class="col-md-6 text-right">
							<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
							<input type="hidden" name="cpd_id" value="<?php echo $cpd_id; ?>">
							<input type="hidden" id="name_surname" name="name_surname" value="<?php  echo $name_surname; ?>">
							<input type="hidden" id="hidden_regnumber" name="hidden_regnumber" value="<?php echo $reg_number; ?>">
							
						</div>
					<?php if ($status!='1' && $status!='2') { ?>
						<div class="row">
						<button type="submit" id="addupdate" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
						<?php if ($status!='0') { ?>
						<button type="submit" id="addupdate1" name="submit" value="save" class="btn btn-primary">Save</button>
					<?php } ?>
					</div>
				<?php } ?>
					
				</form>
				<div class="row add_top_value">
					<div class="col-md-6">
						<a href="<?php echo base_url().'plumber/mycpd/index/index/1'; ?>" class="active_link_btn">CURRENT YEAR</a>  <a href="<?php echo base_url().'plumber/mycpd/index/index/2'; ?>" class="archive_link_btn">PREVIOUS YEARS</a>
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
		knobchart();
		
		$('#addupdate').prop('disabled',true);
		
		if($('#declaration').is(':checked')){
				$('#addupdate').prop('disabled', false);
			}else{
				$('#addupdate').prop('disabled', true);
			}

		var click_count = 0;
		$('#declaration').on('click',function(){
			click_count += 1;
			if($(this).is(':checked')){
				$('#addupdate').prop('disabled', false);
			}else{
				$('#addupdate').prop('disabled', true);
			}	
		});

		var filepath 	= '<?php echo $filepath; ?>';
		var pdfimg		= '<?php echo $pdfimg; ?>';

		fileupload([".document_file", "./assets/uploads/cpdqueue", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.document_picture', '.document_image', filepath, pdfimg]);
		
		var options = {
			url 	: 	'<?php echo base_url()."plumber/mycpd/index/DTCpdQueue"; ?>',
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
			data : {pagestatus : '<?php echo $pagestatus; ?>',user_id : '<?php echo $id; ?>'},
			target	:	[5, 7],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{				
				activity_id_hide : {
					required	: true,
				},
				startdate : {
					required	: true,
				},	
			},
			{
				activity_id_hide 	: {
					required	: "Activity field is required & choose correct option."
				},
				startdate 	: {
					required	: "Activity date is required."
				},			
			},
			{
				ignore : []
			}
		);
		
	});
	
	$('.form').submit(function(){
		if(!$(this).valid()){
			if($('#activity_id_hide').hasClass('error_class_1')){
				$('#activity').val('');
			}
		}
	})
	
	$( document ).ready(function() {
		
		datepicker('#startdate', ['enddate']);
	});

	// Search activity

	var req2 = null;
	function search_activity(value='')
	{
		$("#activity_suggesstion").html('');
		$("#points, #cpdstream, #activity_id_hide").val('');
		//if($.trim($('#activity').val()).length > 3) $("#activity, #activity_id_hide").val('');
	    //if (req2 != null) req2.abort();
	   // var strlength2 = $.trim($('#activity').val()).length;
	    //if(strlength2 > 0)  { 
		    req2 = $.ajax({
		        type: "POST",
		        url: '<?php echo base_url()."plumber/mycpd/index/activityDetails"; ?>',
		        data: {'search_keyword' : value},        
		        beforeSend: function(){
					// $("#search_reg_no").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
		        success: function(data){          	
		        	$("#activity_suggesstion").html('');
		        	//if($.trim($('#activity').val()).length > 3) $("#activity").val('');
					$("#points").val('');
					$("#cpdstream").val('');
		        	$("#activity_suggesstion").show();      	
					$("#activity_suggesstion").html(data);			
					$("#activity").css("background","#FFF");
		        }
		    });
		//}
		//else{
			//console.log(strlength2);
			//$("#activity_suggesstion").hide();
		//}
	}

	function selectActivity(activity,id,strt_date,streams,cpdPoints,streamID) {
		$("#activity").val(activity);
		$("#points").val(cpdPoints);
		$("#cpdstream").val(streams);
		$("#activity_id_hide").val(id);
		$("#hidden_stream_id").val(streamID);
		$("#activity_suggesstion").hide();
	}
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/cpd/cpdtypesetup'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
