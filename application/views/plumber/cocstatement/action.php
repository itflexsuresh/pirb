<?php
	$userid					= $userdata['id'];
	$id 					= isset($result['id']) ? $result['id'] : '';
	
	$completiondate 		= isset($result['completion_date']) && $result['completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['completion_date'])) : '';
	$orderno 				= isset($result['order_no']) ? $result['order_no'] : '';
	$name 					= isset($result['name']) ? $result['name'] : '';
	$address 				= isset($result['address']) ? $result['address'] : '';
	$street 				= isset($result['street']) ? $result['street'] : '';
	$number 				= isset($result['number']) ? $result['number'] : '';
	$provinceid 			= isset($result['province']) ? $result['province'] : '';
	$cityid 				= isset($result['city']) ? $result['city'] : '';
	$suburbid 				= isset($result['suburb']) ? $result['suburb'] : '';
	$contactno 				= isset($result['contact_no']) ? $result['contact_no'] : '';
	$alternateno 			= isset($result['alternate_no']) ? $result['alternate_no'] : '';
	$email 					= isset($result['email']) ? $result['email'] : '';
	$installationtypeid 	= isset($result['installationtype']) ? explode(',', $result['installationtype']) : [];
	$specialisationsid 		= isset($result['specialisations']) ? explode(',', $result['specialisations']) : [];
	$installationdetail 	= isset($result['installation_detail']) ? $result['installation_detail'] : '';
	$file1 					= isset($result['file1']) ? $result['file1'] : '';
	$file2 					= isset($result['file2']) ? explode(',', $result['file2']) : [];
	$agreementid 			= isset($result['agreement']) ? explode(',', $result['agreement']) : [];
	
	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/log/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	
	if($file1!=''){
		$explodefile1 	= explode('.', $file1);
		$extfile1 		= array_pop($explodefile1);
		$file1img 		= (in_array($extfile1, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file1;
	}else{
		$file1img 		= $profileimg;
	}
	
	$coctypeid 				= isset($coclist['type']) ? $coclist['type'] : '';
	
	if($pagetype=='action'){
		$heading 	= 'Log ';
		$actionbtn 	= '1';
	}elseif($pagetype=='view'){
		$heading 	= 'View ';
		$actionbtn 	= '0';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor"><?php echo $heading; ?> COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active"><?php echo $heading; ?> COC</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title"><?php echo $heading; ?> COC</h4>
					<h4 class="sup_title">Certificate: <label><?php echo $coclist['id']; ?></label></h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumbing Work Completion Date *</label>
								<div class="input-group">
									<input type="text" class="form-control completion_date" name="completion_date" data-date="datepicker" value="<?php echo $completiondate; ?>">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Insurance Claim/Order no: (if relevant)</label>
								<input type="text" class="form-control" name="order_no" value="<?php echo $orderno; ?>">
							</div>
						</div>
					</div>

					<h4 class="card-title add_top_value">Physical Address Details of Installation</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Owners Name *</label>
								<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Name of Complex/Flat (if applicable)</label>
								<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Street *</label>
								<input type="text" class="form-control" name="street" value="<?php echo $street; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Number *</label>
								<input type="text" class="form-control" name="number" value="<?php echo $number; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Province *</label>
								<?php
									echo form_dropdown('province', $province, $provinceid, ['id' => 'province', 'class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<?php 
									echo form_dropdown('city', [], $cityid, ['id' => 'city', 'class' => 'form-control']); 
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<?php
									echo form_dropdown('suburb', [], $suburbid, ['id' => 'suburb', 'class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Contact Mobile *</label>
								<input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contactno; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Alternate Contact</label>
								<input type="text" class="form-control" name="alternate_no" id="alternate_no" value="<?php echo $alternateno; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th colspan="2">Type of Installation Carried Out by <?php echo $designation2[$userdata['designation']]; ?></th>
								<th style="text-align: center;">Code</th>
								<th style="text-align: center;">Tick</th>
							</tr>
							<tr>
								<td colspan="4">(Clearly tick the appropriate Installation Category Code and complete the installation details below)</td>
							</tr>
							<?php
								foreach ($installation as $key => $value) {
							?>
									<tr>
										<td colspan="2"><?php echo $value['name']; ?></td>
										<td style="text-align: center;"><?php echo $value['code']; ?></td>
										<td style="text-align: center;">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="installationtype[]" class="custom-control-input" id="<?php echo 'installationtype-'.$key.'-'.$value['code']; ?>" value="<?php echo $key; ?>" <?php echo (in_array($key, $installationtypeid)) ? 'checked="checked"' : ''; ?>>
												<label class="custom-control-label" for="<?php echo 'installationtype-'.$key.'-'.$value['code']; ?>"></label>
											</div>
										</td>
									</tr>
							<?php
								}
							?>
						</table>

						<?php if(count($specialisations) > 0){ ?>
							<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
								<tr>
									<th colspan="2">Specialisations: To be Carried Out by <?php echo $designation2[$userdata['designation']]; ?> Only Registered to do the Specialised work</th>
									<th style="text-align: center;">Code</th>
									<th style="text-align: center;">Tick</th>
								</tr>
								<tr>
									<td colspan="4">(Clearly tick the appropriate Installation Category Code and complete the installation details below)</td>
								</tr>
								<?php
									foreach ($specialisations as $key => $value) {
								?>
										<tr>
											<td colspan="2"><?php echo $value['name']; ?></td>
											<td style="text-align: center;"><?php echo $value['code']; ?></td>
											<td style="text-align: center;">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="specialisations[]" class="custom-control-input" id="<?php echo 'specialisations-'.$key.'-'.$value['code']; ?>" value="<?php echo $key; ?>" <?php echo (in_array($key, $specialisationsid)) ? 'checked="checked"' : ''; ?>>
													<label class="custom-control-label" for="<?php echo 'specialisations-'.$key.'-'.$value['code']; ?>"></label>
												</div>
											</td>
										</tr>
								<?php
									}
								?>
							</table>
						<?php } ?>
						
						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="2">Installation Details</th>
							</tr>
							<tr>
								<td colspan="2">(Details of the work undertaken or scope of work for which the COC is being issued for)</td>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="installation_detail" rows="10" cols="100"><?php echo $installationdetail; ?></textarea>
								</td>
							</tr>
						</table>

						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2 noncompliancetable">
							<tr>
								<th colspan="3">Pre- Existing Non Compliance Conditions</th>			
							</tr>
							<tr class="noncompliancenotfound">
								<td colspan="3">No Record Found</td>			
							</tr>
						</table>
						<?php if($actionbtn=='1'){ ?>
							<div class="row text-right">
								<button type="button" data-toggle="modal" data-target="#noncompliancemodal" class="btn btn-primary">Add a Non Compliance</button>
							</div>
						<?php } ?>
					</div>

					<div class="row">
						<div class="col-md-6">
							<h4 class="card-title add_top_value">Image of COC (Paper)</h4>
							<div class="form-group">
								<div>
									<img src="<?php echo $file1img; ?>" class="file1_img" width="100">
								</div>
								<input type="file" id="file1_file" class="file1_file">
								<input type="hidden" name="file1" class="file1" value="<?php echo $file1; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>

						<div class="col-md-12">
							<h4 class="card-title add_top_value">Installation Images</h4>
							<div class="form-group">
								<div>
									<img src="<?php echo $profileimg; ?>" width="100">
								</div>
								<input type="file" id="file2_file" class="file2_file">
								<p>(Image/File Size Smaller than 5mb)</p>
								<div class="file2append">
									<?php 
										if(count($file2)){
											foreach ($file2 as $key => $value) {												
												$explodefile2 	= explode('.', $value);
												$extfile2 		= array_pop($explodefile2);
												$file1img 		= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$value;
											
									?>
												<div class="multipleupload">
													<input type="hidden" value="<?php echo $value; ?>" name="file2[]">
													<img src="<?php echo $file1img; ?>" width="100">
													<i class="fa fa-times"></i>
												</div>
									<?php
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>

					<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
						<tr>
							<th colspan="3">I <?php echo $userdata['name'].' '.$userdata['surname']; ?>, Licensed registration number <?php echo $userdata['registration_no']; ?>, certify that, the above compliance certifcate details are true and correct and will be logged in accordance with the prescribed requirements as defned by the PIRB. Select either A or B as appropriate</th>			
						</tr>
						<tr>
							<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
								<div class="table-action">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" id="agreement1" name="agreement[]" value="1" class="custom-control-input" <?php echo (in_array('1', $agreementid)) ? 'checked="checked"' : ''; ?>>
										<label class="custom-control-label" for="agreement1"></label>
									</div>
								</div>	
							</td>
							<td colspan="2">A: The above plumbing work was carried out by me or under my supervision, and that it complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
						</tr>
						<tr>
							<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
								<div class="table-action">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" id="agreement2" name="agreement[]" value="2" class="custom-control-input" <?php echo (in_array('2', $agreementid)) ? 'checked="checked"' : ''; ?>>
										<label class="custom-control-label" for="agreement2"></label>
									</div>
								</div>	
							</td>
							<td colspan="2">B: I have fully inspected and tested the work started but not completed by another Licensed plumber. I further certify that the inspected and tested work and the necessary completion work was carried out by me or under my supervision- complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
						</tr>
					</table>

					<div class="ro text-right">
						<input type="hidden" value="<?php echo $id; ?>" name="id">
						<input type="hidden" value="<?php echo $cocid; ?>" name="coc_id">
						<input type="hidden" id="coctypeid" value="<?php echo $coctypeid; ?>">
						<?php if($actionbtn=='1'){ ?>
							<input type="submit" value="" name="submit" id="submitbtn" class="displaynone">
							<button type="button" class="btn btn-primary savecocbtn">Save COC</button>
							<button type="button" class="btn btn-primary logcocbtn">Log  COC</button>
						<?php } ?>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<div id="noncompliancemodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="noncomplianceform">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Non Compliance</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Installation Type</label>
								<?php
									echo form_dropdown('installationtype', $installationtype, '', ['id' => 'nc_installationtype', 'class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Sub Type</label>
								<?php
									echo form_dropdown('subtype', [], '', ['id' => 'nc_subtype', 'class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Statement</label>
								<textarea name="statement" rows="6" class="form-control" id="nc_statement"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Non compliance details</label>
								<textarea name="details" rows="6" class="form-control" id="nc_details"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Possible remedial actions</label>
								<textarea name="action" rows="6" class="form-control" id="nc_action"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>SANS/Regulation/Bylaw Reference</label>
								<textarea name="reference" rows="6" class="form-control" id="nc_reference"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<img src="<?php echo $profileimg; ?>" width="100">
								</div>
								<input type="file" id="nc_file">
								<p>(Image/File Size Smaller than 5mb)</p>
								<div class="ncfileappend"></div>
							</div>						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="nc_id">
					<input type="hidden" name="user_id" value="<?php echo $userid; ?>">
					<button type="button" class="btn btn-success noncompliancesubmit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="otpmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div>
						<h3>IMPORTANCE NOTICE</h3>
						<ul>
							<li>An incorrect statement of fact, including an omission, is an offence in terms of the PIRB Code of conduct, and will be subjected to PIRB disciplinary procedures.</li>
							<li>A completed Certifcate of Compliance must be provided to the owner/consumer within 5 days of the completion of the plumbing works.</li>
							<li>The relevant plumbing work that was certifed as complaint through the issuing of this certifcate may be possibly be audited by a PIRB Auditor for compliance to the regulations, workmanship and health and safety of the plumbing works.</li>
							<li>If this Certifcate of Compliance has been chosen for an audit you must cooperated fully with the PIRB Auditor in allowing them to carry out the relevant audit.</li>
						</ul>
					</div>
					<p>A One Time Pin (OTP) was sent to the Licensed Plumber with the following Mobile Number:</p>
					<p><?php echo $userdata['name'].' '.$userdata['surname']; ?> - <?php echo $userdata['mobile_phone']; ?></p>
					<div>
						<p>Enter OTP</p>
						<div class="testotp"></div>
						<input type="text" name="otp" id="otp">
					</div>
				</div>
				<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success resendotp">Resend</button>
				<button type="button" class="btn btn-success verifyotp">Verify</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var actionbtn					= '<?php echo $actionbtn; ?>';
var userid						= '<?php echo $userid; ?>';
var filepath 					= '<?php echo $filepath; ?>';
var pdfimg						= '<?php echo $pdfimg; ?>';
var installationcount			= '<?php echo count($installation); ?>';
var specialisationscount		= '<?php echo count($specialisations); ?>';

$(function(){
	datepicker('.completion_date', ['enddate']);
	citysuburb(['#province','#city', '#suburb'], ['<?php echo $cityid; ?>', '<?php echo $suburbid; ?>']);
	fileupload([".file1_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.file1', '.file1_img', filepath, pdfimg]);
	fileupload([".file2_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['file2[]', '.file2append', filepath, pdfimg], 'multiple');
	fileupload(["#nc_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['file[]', '.ncfileappend', filepath, pdfimg], 'multiple');
	subtype(['#nc_installationtype','#nc_subtype'], ['']);
	inputmask('#contact_no, #alternate_no', 1);
	
	var noncompliancelists = $.parseJSON('<?php echo json_encode($noncompliance); ?>');
	if(noncompliancelists.length > 0){
		$(noncompliancelists).each(function(i, v){
			var noncompliancedata 	= {status : 1, result : { id: v.id, details: v.details }}
			noncompliance(noncompliancedata);
		})
	}
	
	validation(
		'.form',
		{
			completion_date : {
				required	: true
			},
			name : {
				required    : true
			},
			street:{
				required    : true
			},
			number:{
				required    : true
			},
			province:{
				required    : true
			},
			city:{
				required    : true
			},
			suburb:{
				required    : true
			},
			contact_no:{
				required    : true
			},
			email:{
				email : true
			},
			installation_detail:{
				required    : true
			},
			file1:{
				required:  	function() {
								return ($("#coctypeid").val() == "2");
							}			
			},
			'installationtype[]':{
				required    : true
			},
			'specialisations[]':{
				required    : true
			},
			'agreement[]':{
				required    : true,
				maxlength	: 2
			}
			
		},
		{
			completion_date 	: {
				required	: "Please select completion date"
			},
			name : {
				required    : "Please fill the owner name"
			},
			street : {
				required    : "Please fill the street"
			},
			number:{
				required    : "Please fill the number"
			},
			province:{
				required    : "Please select the province"
			},
			city:{
				required    : "Please select the city"
			},
			suburb:{
				required    : "Please select the suburb"
			},
			contact_no:{
				required    : "Please fill the contact no"
			},
			email:{
				email : 'Please fill email with valid email address'
			},
			installation_detail:{
				required    : "Please fill the installation details"
			},
			file1:{
				required    : "Please select the coc"
			},
			'installationtype[]':{
				required    : "Please check the installation type",
				maxlength	: "Please check the installation type"
			},
			'specialisations[]':{
				required    : "Please check the specialisations",
				maxlength	: "Please check the specialisations"
			},
			'agreement[]':{
				required    : "Please check the agreement",
				maxlength   : "Please check the agreement"
			}
		},
		{
			ignore : []
		}
	);
	
	validation(
		'.noncomplianceform',
		{
			installationtype: {
				required	: true
			},
			subtype: {
				required    : true
			},
			statement: {
				required    : true
			},
			details:{
				required    : true
			},
			action:{
				required    : true
			},
			reference:{
				required    : true
			}
			
		},
		{
			installationtype 	: {
				required	: "Please select installation type"
			},
			subtype : {
				required    : "Please select subtype"
			},
			statement : {
				required    : "Please fill the statement"
			},
			details:{
				required    : "Please fill the non compliance details"
			},
			action:{
				required    : "Please fill the possible remedial actions"
			},
			reference:{
				required    : "Please fill the SANS/Regulation/Bylaw Reference"
			}
		}
	);
})

$('.file2_file').click(function(e){
	if($(document).find('.file2append .multipleupload').length >= 10){
		$(this).val('');
		sweetalertautoclose('Reached maxmium limit.');
		return false;
	}
})

$(document).on('click', '.savecocbtn', function(){
	$('#submitbtn').attr('name', 'save').click();
})

$(document).on('click', '.logcocbtn', function(){
	if($('.form').valid()){
		$('#otpmodal').modal('show');
	}
})

function otpgeneration(type=''){
	var randno = Math.floor(1000 + Math.random() * 9000);
	if(localstorage('get', 'logotp')!=null && type==''){
		localstorage('set', 'logotp', randno);
	}else{
		localstorage('set', 'logotp', randno);
	}

	$('.testotp').text(localstorage('get', 'logotp'));
}

$('#otpmodal').on('show.bs.modal', function () {
	otpgeneration();
})

$(document).on('click', '.resendotp', function(){
	$('.error_otp').remove();
	otpgeneration(1);
})

$(document).on('click', '.verifyotp', function(){
	$('.error_otp').remove();
	
	if($('#otp').val()==localstorage('get', 'logotp')){
		$('#submitbtn').attr('name', 'log').click();
	}else{
		$('#otp').parent().append('<p class="tagline error_otp">Incorrect OTP</p>');
	}
})

$('#noncompliancemodal').on('hidden.bs.modal', function () {
    noncomplianceclear();
})

$('.noncompliancesubmit').click(function(){
	if($('.noncomplianceform').valid())
	{
		var data = $('.noncomplianceform').serialize();
		ajax('<?php echo base_url()."ajax/index/ajaxnoncomplianceaction"; ?>', data, noncompliance);
	}
})

function noncompliance(data){
	if(data.status==1){		
		var result 		= 	data.result; 
		
		if(actionbtn=='1'){
			var complianceaction 	= 	'<td>\
											<a href="javascript:void(0);" class="noncomplianceedit" data-id="'+result.id+'"><i class="fa fa-pencil-alt"></i></a>\
											<a href="javascript:void(0);" class="noncomplianceremove" data-id="'+result.id+'"><i class="fa fa-trash"></i></a>\
										</td>';
			var detailcol			=	'1';
		}else{
			var complianceaction 	= 	'';
			var detailcol			=	'2';
		}
		
		$(document).find('.noncomplianceappend[data-id="'+result.id+'"]').remove();
		
		var appenddata 	= 	'\
								<tr class="noncomplianceappend" data-id="'+result.id+'">\
									<td colspan="'+detailcol+'">'+result.details+'</td>'+complianceaction+'\
								</tr>\
							';
					
		$('.noncompliancetable').append(appenddata);
	}
	
	$('#noncompliancemodal').modal('hide');
	
	noncomplianceextras();
}

$(document).on('click', '.noncomplianceedit', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxnoncomplianceaction"; ?>', {'id' : $(this).attr('data-id'), 'action' : 'edit'}, noncomplianceedit);
})

function noncomplianceedit(data){
	if(data.status==1){
		var result 	= 	data.result;
		
		$('#nc_installationtype').val(result.installationtype);		
		$('#nc_statement').val(result.statement);
		$('#nc_details').val(result.details);
		$('#nc_action').val(result.action);
		$('#nc_reference').val(result.reference);
		$('#nc_id').val(result.id);
		
		subtype(['#nc_installationtype','#nc_subtype'], [result.subtype]);
		
		if(result.file!=''){
			var filesplit = result.file.split(',');
			
			$(filesplit).each(function(i, v){
				
				var ext 		= v.split('.').pop().toLowerCase();
				if(ext=='jpg' || ext=='jpeg' || ext=='png'){
					var filesrc = filepath+v;	
				}else if(ext=='pdf'){
					var filesrc = '<?php echo base_url()."assets/images/pdf.png"?>';	
				}
				
				$('.ncfileappend').append('<div class="multipleupload"><input type="hidden" value="'+v+'" name="file[]"><img src="'+filesrc+'" width="100"><i class="fa fa-times"></i></div>');
			})
			
		} 
		
		$('#noncompliancemodal').modal('show');
	} 
}

$(document).on('click', '.noncomplianceremove', function(){
	ajax('<?php echo base_url()."ajax/index/ajaxnoncomplianceaction"; ?>', {'id' : $(this).attr('data-id'), 'action' : 'delete'}, noncomplianceremove);
	$(this).parent().parent().remove();
	noncomplianceextras();
})

function noncomplianceremove(data){}

function noncomplianceclear(){
	$('#nc_installationtype,#nc_subtype,#nc_statement,#nc_details,#nc_action,#nc_reference,#nc_id').val('');
	$('.ncfileappend .multipleupload').remove();
	$('.noncomplianceform').find("p.error_class_1").remove();
	$('.noncomplianceform').find(".error_class_1").removeClass('error_class_1');
}

function noncomplianceextras(){
	if($(document).find('.noncomplianceappend').length){
		$('.noncompliancenotfound').hide();
	}else{
		$('.noncompliancenotfound').show();
	}
}
</script>