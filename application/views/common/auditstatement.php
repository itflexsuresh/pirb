<?php
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	$reviewpath 			= base_url().'assets/uploads/auditor/statement/';
	$datetime 				= date('d-m-Y H:i:s');
	
	$cocid 					= isset($result['id']) ? $result['id'] : '';
	
	$plumberid 				= isset($result['u_id']) ? $result['u_id'] : '';
	$plumberregno 			= isset($result['plumberregno']) ? $result['plumberregno'] : '';
	$plumbername 			= isset($result['u_name']) ? $result['u_name'] : '';
	$plumberwork 			= isset($result['u_work']) ? $result['u_work'] : '';
	$plumbermobile 			= isset($result['u_mobile']) ? $result['u_mobile'] : '';
	$plumberfile 			= isset($result['u_file']) ? $result['u_file'] : '';
	
	$filepath				= base_url().'assets/uploads/'.$plumberid.'/';
	
	if($plumberfile!=''){
		$explodefile2 		= explode('.', $plumberfile);
		$extfile2 			= array_pop($explodefile2);
		$plumberimage 		= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$plumberfile;
	}else{
		$plumberimage 		= $profileimg;
	}
	
	$completiondate 		= isset($result['cl_completion_date']) && $result['cl_completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_completion_date'])) : '';
	$name 					= isset($result['cl_name']) ? $result['cl_name'] : '';
	$address 				= isset($result['cl_address']) ? $result['cl_address'] : '';
	$street 				= isset($result['cl_street']) ? $result['cl_street'] : '';
	$number 				= isset($result['cl_number']) ? $result['cl_number'] : '';
	$provinceid 			= isset($result['cl_province']) ? $result['cl_province'] : '';
	$cityid 				= isset($result['cl_city']) ? $result['cl_city'] : '';
	$suburbid 				= isset($result['cl_suburb']) ? $result['cl_suburb'] : '';
	$contactno 				= isset($result['cl_contact_no']) ? $result['cl_contact_no'] : '';
	$alternateno 			= isset($result['cl_alternate_no']) ? $result['cl_alternate_no'] : '';
	
	
	$statementid 			= isset($result['as_id']) ? $result['as_id'] : '';
	$auditdate 				= isset($result['as_audit_date']) && $result['as_audit_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['as_audit_date'])) : '';
	$workmanshipid 			= isset($result['as_workmanship']) ? $result['as_workmanship'] : '';
	$plumberverification 	= isset($result['as_plumber_verification']) ? $result['as_plumber_verification'] : '';
	$cocverification 		= isset($result['as_coc_verification']) ? $result['as_coc_verification'] : '';
	$hold 					= isset($result['as_hold']) ? $result['as_hold'] : '';
	$reason 				= isset($result['as_reason']) ? $result['as_reason'] : '';
	
	$reviewtableclass		= ['1' => 'review_failure', '2' => 'review_cautionary', '3' => 'review_compliment', '4' => 'review_noaudit'];
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Report</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url(); ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Report</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<form class="mt-4 form" action="" method="post">
				<?php if($roletype=='5'){ ?>
					<h4 class="card-title">Plumber Details</h4>
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Registration Number</label>
										<input type="text" class="form-control" value="<?php echo $plumberregno; ?>" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Plumbers Name and Surname</label>
										<input type="text" class="form-control" value="<?php echo $plumbername; ?>" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone (Work)</label>
										<input type="text" class="form-control" value="<?php echo $plumberwork; ?>" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone (Mobile)</label>
										<input type="text" class="form-control" value="<?php echo $plumbermobile; ?>" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<img src="<?php echo $plumberimage; ?>" width="100">
						</div>
					</div>
				<?php } ?>
				
				<h4 class="card-title">COC Details</h4>
				<p><a target="blank" href="<?php echo base_url().$viewcoc.'/'.$cocid.'/'.$plumberid; ?>">View COC Details in full</a></p>
				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Certificate No</label>
							<input type="text" class="form-control" name="name" value="<?php echo $cocid; ?>" disabled>
						</div>
					</div>					
					<div class="col-md-6">
						<div class="form-group">
							<label>Plumbing Work Completion Date</label>
							<div class="input-group">
								<input type="text" class="form-control completion_date" name="completion_date" data-date="datepicker" value="<?php echo $completiondate; ?>" disabled>
								<div class="input-group-append">
									<span class="input-group-text"><i class="icon-calender"></i></span>
								</div>
							</div>
						</div>
					</div>					
					<div class="col-md-12">
						<div class="form-group">
							<label>Owners Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Name of Complex/Flat (if applicable)</label>
							<input type="text" class="form-control" name="address" value="<?php echo $address; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Street</label>
							<input type="text" class="form-control" name="street" value="<?php echo $street; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Number</label>
							<input type="text" class="form-control" name="number" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Province</label>
							<?php
								echo form_dropdown('province', $province, $provinceid, ['id' => 'province', 'class'=>'form-control', 'disabled' => 'disabled']);
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>City</label>
							<?php 
								echo form_dropdown('city', [], $cityid, ['id' => 'city', 'class' => 'form-control', 'disabled' => 'disabled']); 
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Suburb</label>
							<?php
								echo form_dropdown('suburb', [], $suburbid, ['id' => 'suburb', 'class'=>'form-control', 'disabled' => 'disabled']);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Mobile</label>
							<input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contactno; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Alternate Contact</label>
							<input type="text" class="form-control" name="alternate_no" id="alternate_no" value="<?php echo $alternateno; ?>" disabled>
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Audit Review</h4>					
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Date of Audit</label>
									<div class="input-group">
										<input type="text" class="form-control auditdate" name="auditdate" data-date="datepicker" value="<?php echo $auditdate; ?>">
										<div class="input-group-append">
											<span class="input-group-text"><i class="icon-calender"></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Overall Workmanship</label>
									<?php
										echo form_dropdown('workmanship', $workmanship, $workmanshipid, ['id' => 'workmanship', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Licensed Plumber Present</label>
									<?php
										echo form_dropdown('plumberverification', $yesno, $plumberverification, ['id' => 'plumberverification', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Was COC Completed Correctly</label>
									<?php
										echo form_dropdown('cocverification', $yesno, $cocverification, ['id' => 'cocverification', 'class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group custom-control custom-radio">							
									<input type="radio" class="custom-control-input" name="hold" id="hold" value="1" <?php if($hold=='1'){ echo 'checked'; } ?>>
									<label class="custom-control-label" for="hold">Place Audit on hold</label>
								</div>
							</div>
							<div class="col-md-12 reason_wrapper displaynone">
								<div class="form-group">
									<label>Why was Audit placed on hold?</label>	
									<textarea class="form-control"  name="reason" id="reason" rows="4" cols="50"><?php echo $reason; ?></textarea>			
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row form-group">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered reviewtable">								
								<tr>
									<th>Review Type</th>
									<th>Statement</th>
									<th>Comments</th>
									<th>Images</th>
									<th>Performance Points</th>
									<th>Refix Status</th>
									<th>Action</th>
								</tr>
								<tr class="reviewnotfound">
									<td colspan="7">No Record Found</td>
								</tr>
							</table>
							<input type="hidden" class="attachmenthidden" name="attachmenthidden"> 
						</div>
					</div>
					<div class="row text-right">
						<button type="button" data-toggle="modal" data-target="#reviewmodal" class="btn btn-primary">Add a Review</button>
					</div>
				</div>
								
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12 refix_wrapper displaynone">
								<div class="form-group">
									<label>Refix Period (Days)</label>
									<input type="text" class="form-control" name="refixperiod" id="refixperiod" value="<?php echo $settings['refix_period']; ?>" readonly>
								</div>
							</div>
							<div class="col-md-12 report_wrapper displaynone">
								<div class="form-group">
									<label>Date and Time of Report submitted:</label>
									<input type="text" class="form-control" name="reportdate" id="reportdate" value="<?php echo $datetime; ?>" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 auditcomplete_wrapper displaynone">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" id="auditcomplete" class="custom-control-input auditcomplete" name="auditcomplete" value="1">
							<label class="custom-control-label" for="auditcomplete">Audit Complete</label>
						</div>											
					</div>
				</div>
				
				<div class="col-md-12 text-right">					
					<input type="hidden" value="<?php echo $statementid; ?>" name="id">
					<input type="hidden" value="<?php echo $cocid; ?>" name="cocid">
					<input type="hidden" value="<?php echo $userid; ?>" name="auditorid">
					<input type="hidden" value="<?php echo $plumberid; ?>" name="plumberid">
					<input type="hidden" name="workmanshippoint" id="workmanshippoint">
					<input type="hidden" name="plumberverificationpoint" id="plumberverificationpoint">
					<input type="hidden" name="cocverificationpoint" id="cocverificationpoint">
					<input type="hidden" name="reviewpoint" id="reviewpoint">
					<input type="hidden" name="point" id="point">
					<button type="button" id="submitreport" class="btn btn-primary">Submit Report</button>
					<button type="button" id="save"  class="btn btn-primary">Save/Update</button>
					<input type="submit" name="submit" id="submit" class="displaynone">
				</div>				
			</form>			
		</div>
	</div>
</div>


<div id="reviewmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="reviewform">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Review</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Review Type</label>
								<div class="row">
									<?php
										foreach($reviewtype as $key => $value){
									?>
											<div class="col-md-3">
												<div class="custom-control custom-radio">
													<input type="radio" name="reviewtype" id="r_reviewtype<?php echo $key.'-'.$value; ?>" class="custom-control-input r_reviewtype" value="<?php echo $key; ?>">
													<label class="custom-control-label" for="r_reviewtype<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
												</div>
											</div>
									<?php
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-md-12 section1 displaynone">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>My Report Listings/Favourites</label>
										<?php
											echo form_dropdown('favourites', $auditorreportlist, '', ['id' => 'r_auditorreportlist', 'class'=>'r_auditorreportlist form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Installation Type</label>
										<?php
											echo form_dropdown('installationtype', $installationtype, '', ['id' => 'r_installationtype', 'class'=>'r_installationtype form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Sub Type</label>
										<?php
											echo form_dropdown('subtype', [], '', ['id' => 'r_subtype', 'class'=>'r_subtype form-control']);
										?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Statement</label>
										<?php
											echo form_dropdown('statement', [], '', ['id' => 'r_statement', 'class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>SANS/Regulation/Bylaw Reference</label>
										<input type="text" name="reference" class="r_reference form-control" id="r_reference">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Knowledge Reference link</label>
										<input type="text" name="link" class="r_link form-control" id="r_link">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 section2 displaynone">
							<div class="form-group">
								<label>Comments</label>
								<textarea name="comments" rows="6" class="r_comments form-control" id="r_comments"></textarea>
							</div>
						</div>
						<div class="col-md-12 section3 displaynone">
							<div class="form-group">
								<div>
									<img src="<?php echo $profileimg; ?>" width="100">
								</div>
								<input type="file" id="r_file" class="r_file">
								<p>(Image/File Size Smaller than 5mb)</p>
								<div class="rfileappend"></div>
							</div>						
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Performance Point Allocation</label>
								<input type="text" name="point" class="r_point form-control" id="r_point">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="r_id" class="r_id">
					<input type="hidden" value="<?php echo $cocid; ?>" name="cocid">
					<input type="hidden" value="<?php echo $userid; ?>" name="auditorid">
					<input type="hidden" value="<?php echo $plumberid; ?>" name="plumberid">
					<button type="button" class="btn btn-success reviewsubmit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div id="confirmmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<p>Confirm to submit your Audit report for <?php echo $plumbername; ?> undertaken for COC <?php echo $cocid; ?>?</p>
					<p>The refix for this COC is required by lastests: {today date + number days of refix days}.</p>
					<div class="col-md-12">
						<button type="button" class="btn btn-success confirmsubmit">Confirm</button>
						<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var reviewtype 	= JSON.parse('<?php echo json_encode($reviewtype); ?>');
var reviewclass = JSON.parse('<?php echo json_encode($reviewtableclass); ?>');
var workmanshippt = JSON.parse('<?php echo json_encode($workmanshippt); ?>');
var plumberverificationpt = JSON.parse('<?php echo json_encode($plumberverificationpt); ?>');
var cocverificationpt = JSON.parse('<?php echo json_encode($cocverificationpt); ?>');
var noaudit		= '<?php echo $noaudit; ?>';
var filepath 	= '<?php echo $filepath; ?>';
var reviewpath 	= '<?php echo $reviewpath; ?>';
var pdfimg		= '<?php echo $pdfimg; ?>';
var validator;

$(function(){
	reason()
	
	datepicker('.auditdate');	
	select2('#workmanship, #plumberverification, #cocverification');
	citysuburb(['#province','#city', '#suburb'], ['<?php echo $cityid; ?>', '<?php echo $suburbid; ?>']);
	subtypereportinglist(['#r_installationtype','#r_subtype','#r_statement'], ['', '']);
	fileupload(["#r_file", "./assets/uploads/auditor/statement/", ['jpg','gif','jpeg','png','pdf','tiff']], ['file[]', '.rfileappend', reviewpath, pdfimg], 'multiple');
	
	var reviewlist = $.parseJSON('<?php echo json_encode($reviewlist); ?>');
	if(reviewlist.length > 0){
		$(reviewlist).each(function(i, v){
			var reviewlistdata 	= {status : 1, result : { id: v.id, reviewtype: v.reviewtype, statementname: v.statementname, comments: v.comments, file: v.file, point: v.point, status: v.status, created_at: v.created_at }}
			review(reviewlistdata);
		})
	}
	
	validator = validation(
		'.form',
		{
			auditdate : {
				required	: true
			},
			reason : {
				required:  	function() {
								return $('#hold').is(':checked');
							}
			},
			attachmenthidden : {
				required	: true
			}
		},
		{
			auditdate 	: {
				required	: "Please select Date of Audit."
			},
			reason 	: {
				required	: "Please fill Why was Audit placed on hold?."
			},
			attachmenthidden : {
				required	: "Please fill one review."
			}
		},
		{
			ignore : [],
			callback : 1
		}
	);
	
	validation(
		'.reviewform',
		{
			reviewtype : {
				required	: true,
			},
			favourites : {
				required	: true,
			},
			installationtype : {
				required	: true,
			},
			subtype : {
				required	: true,
			},
			statement : {
				required	: true,
			},
			reference : {
				required	: true,
			},
			link : {
				required	: true,
			},
			comments : {
				required:  	function() {
								return $('.r_reviewtype:checked').val()!=4;
							}
			},
			point : {
				required	: true,
			}
		},
		{
			reviewtype 	: {
				required	: "Please select Review Type.",
			},
			favourites 	: {
				required	: "Please select My Report Listings/Favourites.",
			},
			installationtype : {
				required	: "Please select Installation Type.",
			},
			subtype : {
				required	: "Please select Sub Type.",
			},
			statement : {
				required	: "Please select Statement",
			},
			reference : {
				required	: "Please enter SANS/Regulation/Bylaw Reference.",
			},
			link : {
				required	: "Please enter Knowledge Reference link.",
			},
			comments : {
				required	: "Please enter Comments.",
			},
			point : {
				required	: "Please enter Performance Point Allocation.",
			}
		}
	);
});

$('#save').click(function(){
	validator.destroy();
	$('#submit').attr('value', 'save').click();
})

$('#submitreport').click(function(){
	if($('.form').valid())
	{
		$('#confirmmodal').modal('show');
	}
})

$('.confirmsubmit').click(function(){
	if($('.form').valid())
	{
		$('#submit').attr('value', 'submitreport').click();
	}
})


$('#hold').click(function(){
	reason()
})

function reason(){
	$('.reason_wrapper').addClass('displaynone');
	if($('#hold').is(':checked')){
		$('.reason_wrapper').removeClass('displaynone');
	}
}

$('.r_reviewtype').click(function(){
	reviewtoggle($(this).val());
	//reviewpoint()
})

function reviewtoggle(data){
	$('.section1, .section2, .section3').addClass('displaynone');
	reviewmodalclear(1);
	
	if(data==1 || data==2){
		$('.section1, .section2, .section3').removeClass('displaynone');
	}else if(data==3){
		$('.section2, .section3').removeClass('displaynone');
	}else if(data==4){
		$('.section2').removeClass('displaynone');
	}
}

$('.r_installationtype, .r_subtype, .r_statement').change(function(){
	//reviewpoint();
})

function reviewpoint(){
	var statement = $('.r_statement');
	var reviewtype = $('.r_reviewtype').val();
	
	$('.r_point').val('');
	
	setTimeout(function(){
		if(statement.val()!='' && statement.val()!=undefined){
			if(reviewtype==1){
				$('.r_point').val('0');
			}else if(reviewtype==2){
				$('.r_point').val(statement.attr('data-cautionary'));
			}else if(reviewtype==3){
				$('.r_point').val(statement.attr('data-compliment'));
			}else if(reviewtype==4){
				$('.r_point').val(noaudit)
			} 
		} 
	}, 3000);
}

$('.r_auditorreportlist').change(function(){
	ajax('<?php echo base_url()."ajax/index/ajaxauditorreportinglist"; ?>', {'id' : $(this).val()}, '', { success : function(data){
		if(data.status==1){
			var result = data.result;
			
			$('#r_installationtype').val(result.installationtype_id)
			$('#r_comments').val(result.comments)
			subtypereportinglist(['#r_installationtype','#r_subtype','#r_statement'], [result.subtype_id, result.statement_id]);
		}	
	}});
})

$('#reviewmodal').on('hidden.bs.modal', function(){
    reviewmodalclear();
})

$('.reviewsubmit').click(function(){
	if($('.reviewform').valid())
	{
		//reviewpoint();
		var data = $('.reviewform').serialize();
		ajax('<?php echo base_url()."ajax/index/ajaxreviewaction"; ?>', data, review);
	}
})

function review(data){
	if(data.status==1){		
		var dropdown	= 	'';
		var result 		= 	data.result; 
		
		$(document).find('.reviewappend[data-id="'+result.id+'"]').remove();
		
		if(result.reviewtype==1){
			var status 	= 	result.status;
			dropdown	= 	'<select class="form-control reviewstatus">\
								<option value="0" '+((status=='0') ? "selected" : "")+'>Incomplete</option>\
								<option value="1" '+((status=='1') ? "selected" : "")+'>Complete</option>\
							</select>';			
		}
		
		var appenddata 	= 	'\
								<tr class="reviewappend '+reviewclass[result.reviewtype]+'" data-id="'+result.id+'" data-date="'+result.created_at+'">\
									<td data-reviewtype="'+result.reviewtype+'">'+reviewtype[result.reviewtype]+'</td>\
									<td>'+((result.statementname!=null) ? result.statementname : "")+'</td>\
									<td>'+((result.comments!=null) ? result.comments : "")+'</td>\
									<td class="reviewimageview"></td>\
									<td>'+((result.point!=null) ? result.point : "")+'</td>\
									<td>'+dropdown+'</td>\
									<td>\
										<a href="javascript:void(0);" class="reviewedit" data-id="'+result.id+'"><i class="fa fa-pencil-alt"></i></a>\
										<a href="javascript:void(0);" class="reviewremove" data-id="'+result.id+'"><i class="fa fa-trash"></i></a>\
									</td>\
								</tr>\
							';
					
		$('.reviewtable').append(appenddata);
				
		if(result.file!='') mutiplereviewfile(result.file, 2, result.id);
	}
	
	$('#reviewmodal').modal('hide');
	
	reviewextras();
}

$(document).on('change', '.reviewstatus', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxreviewaction"; ?>', {'id' : $(this).parent().parent().attr('data-id'), 'status' : $(this).val()}, '', { success : function(data){ sweetalertautoclose('successfully saved'); refixcheck(); }} );
})

$(document).on('click', '.reviewedit', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxreviewaction"; ?>', {'id' : $(this).attr('data-id'), 'action' : 'edit'}, reviewedit);
})

function reviewedit(data){
	if(data.status==1){
		var result 	= 	data.result;
		
		reviewtoggle(result.reviewtype);
		
		$('.r_reviewtype[value="'+result.reviewtype+'"]').prop('checked', true);
		$('.r_auditorreportlist').val(result.favourites);
		$('.r_installationtype').val(result.installationtype);
		subtypereportinglist(['#r_installationtype','#r_subtype','#r_statement'], [result.subtype, result.statement]);
		$('.r_reference').val(result.reference);
		$('.r_link').val(result.link);
		$('.r_comments').val(result.comments);
		$('.r_point').val(result.point);
		$('.r_id').val(result.id);
		
		if(result.file!='') mutiplereviewfile(result.file, 1);
		
		$('#reviewmodal').modal('show');
	} 
}

function mutiplereviewfile(file, type, id=''){
	if(file!=''){
		var filesplit = file.split(',');
		
		$(filesplit).each(function(i, v){
			
			var ext 		= v.split('.').pop().toLowerCase();
			if(ext=='jpg' || ext=='jpeg' || ext=='png'){
				var filesrc = reviewpath+v;	
			}else if(ext=='pdf'){
				var filesrc = '<?php echo base_url()."assets/images/pdf.png"?>';	
			}
			
			if(type==1){
				$('.rfileappend').append('<div class="multipleupload"><input type="hidden" value="'+v+'" name="file[]"><img src="'+filesrc+'" width="100"><i class="fa fa-times"></i></div>');
			}else{
				if(id!='') $(document).find('.reviewappend[data-id="'+id+'"] .reviewimageview').append('<img src="'+filesrc+'" width="100">');
			}
		})
		
	} 
}


$(document).on('click', '.reviewremove', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxreviewaction"; ?>', {'id' : $(this).attr('data-id'), 'action' : 'delete'}, reviewremove);
	$(this).parent().parent().remove();
	reviewextras();
	
	$('.attachmenthidden').valid();
})

function reviewremove(data){}

function reviewmodalclear(data=''){
	if(data=='') $('.r_reviewtype').prop('checked', false);
	
	$('.r_auditorreportlist, .r_installationtype, .r_reference, .r_link, .r_comments, .r_file, .r_point, .r_id').val('');
	subtypereportinglist(['#r_installationtype','#r_subtype','#r_statement'], ['', '']);
	$('.rfileappend').html('');
	$('.reviewform').find("p.error_class_1").remove();
	$('.reviewform').find(".error_class_1").removeClass('error_class_1');
	
	$('.attachmenthidden').valid();
}

function reviewextras(){
	if($(document).find('.reviewappend').length){
		$('.reviewnotfound').hide();
		$('.attachmenthidden').val('1');
	}else{
		$('.reviewnotfound').show();
		$('.attachmenthidden').val('');
	}
	
	refixcheck()
}

function refixcheck(){
	$('.refix_wrapper, .report_wrapper, .auditcomplete_wrapper').addClass('displaynone');
	
	var reportcheck = 0;
	
	$(document).find('.reviewappend').each(function(){
		var reviewtypecolumn 	= $(this).find('td:eq(0)').attr('data-reviewtype');
		var statuscolumn		= $(this).find('.reviewstatus').val();
		
		if(reviewtypecolumn==1 && statuscolumn==0){
			reportcheck = 1;
			return false;
		}else if(reviewtypecolumn==1 && statuscolumn==1){
			reportcheck = 2;
		}
	})
	
	if(reportcheck==1){
		$('.refix_wrapper').removeClass('displaynone');
	}else if(reportcheck==2){
		if($('.attachmenthidden').val()!='') $('.report_wrapper, .auditcomplete_wrapper').removeClass('displaynone');
	}
}

$('.form').submit(function(){
	pointcalculation();
})

function pointcalculation(){
	var workmanship = $('#workmanship').val();
	var plumberverification = $('#plumberverification').val();
	var cocverification = $('#cocverification').val();
	
	var workmanshipval 			= (workmanshippt[workmanship]) ? Number(workmanshippt[workmanship]) : 0;
	var plumberverificationval 	= (plumberverificationpt[plumberverification]) ? Number(plumberverificationpt[plumberverification]) : 0;
	var cocverificationval 		= (cocverificationpt[cocverification]) ? Number(cocverificationpt[cocverification]) : 0;
	
	var reviewval = 0;
	$(document).find('.reviewappend').each(function(){
		reviewval += Number($(this).find('td:eq(4)').text());
	})
	
	$('#workmanshippoint').val(workmanshipval);
	$('#plumberverificationpoint').val(plumberverificationval);
	$('#cocverificationpoint').val(cocverificationval);
	$('#reviewpoint').val(reviewval);
	$('#point').val(workmanshipval + plumberverificationval + cocverificationval + reviewval);
}

</script>