<?php
// echo "<pre>";
// print_r($result);die;
$id 					= isset($result['id']) ? $result['id'] : '';
$reg_number 			= isset($result['reg_number']) ? $result['reg_number'] : '';
$name_surname 			= isset($result['name_surname']) ? $result['name_surname'] : '';
$cpd_activity 			= isset($result['cpd_activity']) ? $result['cpd_activity'] : '';
$cpd_start_date 		= isset($result['cpd_start_date']) ? date("d-m-Y", strtotime($result['cpd_start_date'])) : '';
$comments 				= isset($result['comments']) ? $result['comments'] : '';
$points 				= isset($result['points']) ? $result['points'] : '';
$cpd_stream 			= isset($result['cpd_stream']) ? $result['cpd_stream'] : '';
$status 				= isset($result['status']) ? $result['status'] : '';
$admin_comments 		= isset($result['admin_comments']) ? $result['admin_comments'] : '';
$user_id 				= isset($result['user_id']) ? $result['user_id'] : '';
$streamname 			= isset($strem_id) ? $strem_id : '';


$profileimg 			= base_url().'assets/images/profile.jpg';
$profileimg_ad 			= base_url().'assets/images/profile.jpg';
$pdfimg 				= base_url().'assets/images/pdf.png';
$image 					= isset($result['file1']) ? $result['file1'] : '';
$image_ad 				= isset($result['file2']) ? $result['file2'] : '';
$filepath 				= base_url().'assets/uploads/cpdqueue/';
$filepath1				= (isset($result['file1']) && $result['file1']!='') ? $filepath.$result['file1'] : base_url().'assets/uploads/cpdqueue/profile.jpg';

$filepath_ad				= (isset($result['file2']) && $result['file2']!='') ? $filepath.$result['file2'] : base_url().'assets/uploads/cpdqueue/profile.jpg';

$heading 				= isset($result['id']) ? 'Update' : 'Add';

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
	//echo $photoidimg;
	//print_r($photoidimg2);die;
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">CPD Activity Form</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">CPD Activity Form</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">CPD Activity Form</h4>
				<?php if ($checkpermission) { ?>
				<form class="mt-4 form" action="index_queue" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="activity">Reg Number:</label>
							<input type="search" autocomplete="off" class="form-control" id="search_reg_no" name="search_reg_no" placeholder="Search Reg Number" onkeyup="search_func(this.value);" value="<?php echo $reg_number; ?>">
							<input type="hidden" id="user_id_hide" name="user_id_hide" value="<?php echo $user_id ; ?>">
							<div id="plumber_suggesstion" style="display: none;"></div>					
						</div>
						<div class="form-group col-md-6">
							<label for="name_surname">Plumber Name and Surname:</label>
							<input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Plumber Name and Surname" readonly value="<?php echo $name_surname; ?>">						
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="points">PIRB CPD Activity:</label>
							<input type="search" class="form-control" id="activity" name="activity" placeholder = "Enter CPD Activity" autocomplete="off" onkeyup="search_activity(this.value);" value="<?php echo $cpd_activity; ?>">
							<input type="hidden" id="activity_id_hide" name="activity_id_hide" value="<?php echo $cpd_activity; ?>">
							<div id="activity_suggesstion" style="display: none;"></div>								
						</div>					
						<div class="form-group col-md-6">
							<label for="enddate">The Date on which the Activity took place or started:</label>
							<input type="text" class="form-control" id="startdate" autocomplete="off" name="startdate" placeholder="Enter Start Date *" value="<?php echo $cpd_start_date; ?>">						
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="productcode">Comments</label>
							<textarea class="form-control" id="comments" placeholder="Enter Comments" name="comments" ><?php echo $comments; ?></textarea>
						</div>
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
									<?php
									if ($id=='') { ?>
										<input type="file" id="file" class="document_file">
										<label for="file" class="choose_file">Choose File</label>
										<input type="hidden" name="image1" class="document_picture" value="<?php echo $image; ?>">
										<p>(Image/File Size Smaller than 5mb)</p>
									<?php }
									?>
									
								</div>
						</div>
						<div class="form-group col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="declaration" id="declaration"  value="1">
								<label class="custom-control-label" for="declaration">I declare that the information contained in this CPD Activity form is complete, accurate and true.  I further decalre that I understadn that I must keep verifiable evidence of all the CPD activities for at least 2 years and the PRIB may conduct a random audit of my activity(s) which would require me to submit the evidence to the PIRB.</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="card-title">Admin Supporting Document:</h4>
								<div class="form-group">
									<div>
										<a href="<?php echo $filepath_ad; ?>" target="_blank">
										    <img src="<?php echo $photoidimg2; ?>" class="document_image_ad" width="100">
										</a>
										
									</div>
										<input type="file" id="file" class="document_file_ad">
										<label for="file" class="choose_file">Choose File</label>
										<input type="hidden" name="image_ad" class="document_picture_ad" value="<?php echo $image; ?>">
										<p>(Image/File Size Smaller than 5mb)</p>
								</div>
						</div>						
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label for="points">Activity Points</label>
							<input type="number" readonly class="form-control" id="points" name="points" placeholder="Enter CPD Points *" value="<?php echo $points; ?>">
						</div>			
						<div class="form-group col-md-6">
							<label for="cpdstream">CPD Stream</label>
							<input type="text" readonly class="form-control" id="cpdstream" name="cpdstream" placeholder="CPD Stream" value="<?php echo $streamname; ?>">
							<input type="hidden" readonly class="form-control" id="hidden_stream_id" name="hidden_stream_id" value="<?php echo $cpd_stream; ?>">
						</div>
					</div>

					<div class="row">
							<label for="productcode">CPD Activity Approval Status:</label>
								<div class="form-group col-md-6">
									<div class="row">
										<div class="col-md-3">
											<div class="custom-control custom-radio">
												<input type="radio" id="aprooved" name="status" value="1" <?php if ($status==1) {
													echo 'checked="checked"';
												} ?> class="custom-control-input" >
												<label class="custom-control-label" for="aprooved">Approved</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="custom-control custom-radio">
												<input type="radio" id="rejected" name="status" value="2" <?php if ($status==2) {
													echo 'checked="checked"';
												} ?> class="custom-control-input" >
												<label class="custom-control-label" for="rejected">Rejected</label>
											</div>
										</div>
									</div>
								</div>
						<div class="form-group col-md-6">
							<label for="productcode">Admin Comments:</label>
							<textarea class="form-control" id="admin_comments" placeholder="Enter Comments" name="admin_comments" ><?php echo $admin_comments; ?></textarea>
							<button type="submit" id="addupdate" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Plumber CPD</button>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
							<input type="hidden" id="hidden_regnumber" name="hidden_regnumber" value="<?php echo $reg_number; ?>">
							<input type="hidden" id="hidden_activity" name="hidden_activity" value="<?php echo $cpd_activity; ?>">
							
						</div>
					</div>
					
				</form>
			<?php } ?>
				<div class="row">
					<div class="col-md-6">
						<a href="<?php echo base_url().'admin/cpd/cpdtypesetup/index_queue/1'; ?>" class="active_link_btn">PENDING</a>  <a href="<?php echo base_url().'admin/cpd/cpdtypesetup/index_queue/2'; ?>" class="archive_link_btn">COMPLETED</a>
					</div>					
				</div>

				<div id="active" class="table-responsive m-t-40">
					<h4 class="card-title">CPD Activity Queue</h4>
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date</th>
								<th>Name & Surname</th>
								<th>Registration Number</th>
								<th>Activity</th>
								<th>Points</th>
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
		$('#addupdate').prop('disabled',true);
		$('#aprooved').prop('disabled', true);
		approve_check();

		if($('#id').val()!= ''){
			$('#declaration').prop('checked',true);
			$('#addupdate').prop('disabled', false);
		}

		$('#activity').keyup(function(){
				approve_check();
		});
		$('#startdate').on('change',function(){
				approve_check();
		});

		


		var click_count = 0;
		$('#declaration').on('click',function(){
			click_count += 1;
			if($(this).is(':checked')){
		       $('#addupdate').prop('disabled', false);
		    } else {
		       $('#addupdate').prop('disabled', true);
		    }
				
		});

		var filepath 	= '<?php echo $filepath; ?>';
		var pdfimg		= '<?php echo $pdfimg; ?>';

		fileupload([".document_file", "./assets/uploads/cpdqueue", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.document_picture', '.document_image', filepath, pdfimg]);

		fileupload([".document_file_ad", "./assets/uploads/cpdqueue", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.document_picture_ad', '.document_image_ad', filepath, pdfimg]);
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/cpd/cpdtypesetup/DTCpdQueue"; ?>',
			columns : 	[
			{ "data": "date" },
			{ "data": "namesurname" },
			{ "data": "reg_number" },
			{ "data": "acivity" },
			{ "data": "points" },
			{ "data": "status" },
			{ "data": "action" }
			],
			data : {pagestatus : '<?php echo $pagestatus; ?>'},
			target : [6],
			sort : '0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				search_reg_no : {
					required	: true,
				},				
				aproval : {
					required	: true,
				},				
			},
			{
				search_reg_no 	: {
					required	: "Reg number field is required."
				},
				aproval 	: {
					required	: "Approval is required."
				},				
			}
			);
		
	});

	$( document ).ready(function() {
		
		datepicker('#startdate', ['enddate']);
	});
	

	var req = null;
	function search_func(value)
	{
		if ($.isNumeric(value)) {
				if (req != null) req.abort();
		    
		    var type1 = 3;
		    var strlength = $.trim($('#search_reg_no').val()).length;
		    if(strlength > 0)  { 
			    req = $.ajax({
			        type: "POST",
			        url: '<?php echo base_url()."admin/cpd/Cpdtypesetup/userRegDetails"; ?>',
			        data: {'search_keyword' : value,type:type1},        
			        beforeSend: function(){
						// $("#search_reg_no").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
			        success: function(data){          	
			        	$("#plumber_suggesstion").html('');
			        	$("#name_surname").val('');
			        	$("#plumber_suggesstion").show();      	
						$("#plumber_suggesstion").html(data);			
						$("#search_reg_no").css("background","#FFF");
			        }
			    });
			}
			else{
				console.log(strlength);
				$("#plumber_suggesstion").hide();
			}
		}else{
			return false;
		}
	    
	}

	function selectuser(val,id,nameSurname) {
		$("#search_reg_no").val(val);
		$("#name_surname").val(nameSurname);
		$("#user_id_hide").val(id);
		$("#plumber_suggesstion").hide();
	}

	// Search activity

	var req2 = null;
	function search_activity(value)
	{
	    if (req2 != null) req2.abort();
	    var strlength2 = $.trim($('#activity').val()).length;
	    if(strlength2 > 0)  { 
		    req2 = $.ajax({
		        type: "POST",
		        url: '<?php echo base_url()."admin/cpd/Cpdtypesetup/activityDetails"; ?>',
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
			$("#activity_suggesstion").html('');
        	$("#activity").val('');
			$("#points").val('');
			$("#cpdstream").val('');
		}
	}

	function selectActivity(activity,id,strt_date,streams,cpdPoints,streamID) {
		$("#activity").val(activity);
		//$("#startdate").val(strt_date);
		$("#points").val(cpdPoints);
		$("#cpdstream").val(streams);
		$("#activity_id_hide").val(id);
		$("#hidden_stream_id").val(streamID);
		$("#activity_suggesstion").hide();
	}


	function approve_check(){
		var acti = $('#activity').val();
		var dates = $('#startdate').val();
		var pts = $('#points').val();
		var stream = $('#cpdstream').val();
		
		if (acti!='' && dates!='' && pts!='' && stream!='') {
			$('#aprooved').prop('disabled', false);
		}else{
			$('#aprooved').prop('disabled', true);
		}
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
