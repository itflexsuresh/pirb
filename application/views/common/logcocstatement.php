<?php
	$userid					= $userdata['id'];
	$id 					= isset($result['cl_id']) ? $result['cl_id'] : ''; 
	$cocid					= $result['id'];
	
	$logdate 				= isset($result['cl_log_date']) && date('Y-m-d', strtotime($result['cl_log_date']))!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_log_date'])) : '';
	$completiondate 		= isset($result['cl_completion_date']) && $result['cl_completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_completion_date'])) : '';
	$orderno 				= isset($result['cl_order_no']) ? $result['cl_order_no'] : '';
	$name 					= isset($result['cl_name']) ? $result['cl_name'] : '';
	$address 				= isset($result['cl_address']) ? $result['cl_address'] : '';
	$street 				= isset($result['cl_street']) ? $result['cl_street'] : '';
	$number 				= isset($result['cl_number']) ? $result['cl_number'] : '';
	$provinceid 			= isset($result['cl_province']) ? $result['cl_province'] : '';
	$cityid 				= isset($result['cl_city']) ? $result['cl_city'] : '';
	$suburbid 				= isset($result['cl_suburb']) ? $result['cl_suburb'] : '';
	$contactno 				= isset($result['cl_contact_no']) ? $result['cl_contact_no'] : '';
	$alternateno 			= isset($result['cl_alternate_no']) ? $result['cl_alternate_no'] : '';
	$email 					= isset($result['cl_email']) ? $result['cl_email'] : '';
	$installationtypeid 	= isset($result['cl_installationtype']) ? explode(',', $result['cl_installationtype']) : [];
	$specialisationsid 		= isset($result['cl_specialisations']) ? explode(',', $result['cl_specialisations']) : [];
	$installationdetail 	= isset($result['cl_installation_detail']) ? $result['cl_installation_detail'] : '';
	$file1 					= isset($result['cl_file1']) ? $result['cl_file1'] : '';
	$file2 					= isset($result['cl_file2']) ? array_filter(explode(',', $result['cl_file2'])) : [];
	$agreementid 			= isset($result['cl_agreement']) ? $result['cl_agreement'] : '';
	$ncnoticeid 			= isset($result['cl_ncnotice']) ? $result['cl_ncnotice'] : '';
	$ncemail				= isset($result['cl_ncemail']) ? $result['cl_ncemail'] : '';
	
	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/log/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$uploadimg 				= base_url().'assets/images/upload.png';
	
	if($file1!=''){
		$explodefile1 	= explode('.', $file1);
		$extfile1 		= array_pop($explodefile1);
		$file1img 		= (in_array($extfile1, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file1;
		$file1imgurl	= $filepath.$file1;
	}else{
		$file1img 		= $uploadimg;
		$file1imgurl	= 'javascript:void(0);';
	}
	
	$coctypeid 				= isset($result['type']) ? $result['type'] : '';
	
	if($pagetype=='action'){
		$heading 			= 'Log ';
		$actionbtn 			= '1';
		$disablefield 		= '';
		$disablefieldarray 	= [];
	}elseif($pagetype=='view'){
		$heading 			= 'View ';
		$actionbtn 			= '0';
		$disablefield 		= 'disabled="disabled"';
		$disablefieldarray 	= ['disabled' => 'disabled'];
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor"><?php echo $heading; ?> COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Home</li>
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

					<h4 class="card-title"></h4>
					<h4 class="sup_title">Certificate Number: <label><?php echo $cocid; ?></label></h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumbing Work Completion Date *</label>
								<div class="input-group">
									<input type="text" class="form-control completion_date" name="completion_date" data-date="datepicker" value="<?php echo $completiondate; ?>" <?php echo $disablefield; ?>>
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Insurance Claim/Order no: (if relevant)</label>
								<input type="text" class="form-control" name="order_no" value="<?php echo $orderno; ?>" <?php echo $disablefield; ?>>
							</div>
						</div>
					</div>

					<h4 class="card-title add_top_value">Physical Address Details of Installation</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Owners Name *</label>
								<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" <?php echo $disablefield; ?>>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Name of Complex/Flat (if applicable)</label>
								<input type="text" class="form-control" name="address" value="<?php echo $address; ?>" <?php echo $disablefield; ?>>
							</div>
						</div>

						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Street *</label>
										<input type="text" class="form-control" name="street" value="<?php echo $street; ?>" <?php echo $disablefield; ?>>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Number *</label>
										<input type="text" class="form-control" name="number" value="<?php echo $number; ?>" <?php echo $disablefield; ?>>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Province *</label>
										<?php
											echo form_dropdown('province', $province, $provinceid, ['id' => 'province', 'class'=>'form-control']+$disablefieldarray);
										?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<?php 
											echo form_dropdown('city', [], $cityid, ['id' => 'city', 'class' => 'form-control']+$disablefieldarray); 
										?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<?php
											echo form_dropdown('suburb', [], $suburbid, ['id' => 'suburb', 'class'=>'form-control']+$disablefieldarray);
										?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Contact Mobile *</label>
										<input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contactno; ?>" <?php echo $disablefield; ?>>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Alternate Contact</label>
										<input type="text" class="form-control" name="alternate_no" id="alternate_no" value="<?php echo $alternateno; ?>" <?php echo $disablefield; ?>>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Email Address</label>
										<input type="text" class="form-control email" name="email" value="<?php echo $email; ?>" <?php echo $disablefield; ?>>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div id="addressmap" style="height:100%"></div>
						</div>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th colspan="2" class="table_title">Type of Installation Carried Out by <?php echo $designation2[$userdata['designation']]; ?><span>(Clearly tick the appropriate Installation Category Code and complete the installation details below)</span></th>
								<th style="text-align: center;">Code</th>
								<th style="text-align: center;">Tick</th>
							</tr>
							<?php
								foreach ($installation as $key => $value) {
							?>
									<tr>
										<td colspan="2" style="text-align: left;"><?php echo $value['name']; ?></td>
										<td style="text-align: center;"><?php echo $value['code']; ?></td>
										<td style="text-align: center;">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="installationtype[]" class="custom-control-input installationtypebox" id="<?php echo 'installationtype-'.$key.'-'.$value['code']; ?>" value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'], $installationtypeid)) ? 'checked="checked"' : ''; ?> <?php echo $disablefield; ?>>
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
									<th colspan="2" class="table_title">Specialisations: To be Carried Out by <?php echo $designation2[$userdata['designation']]; ?> Only Registered to do the Specialised work<span>(Clearly tick the appropriate Installation Category Code and complete the installation details below)</span></th>
									<th style="text-align: center;">Code</th>
									<th style="text-align: center;">Tick</th>
								</tr>
								<?php
									foreach ($specialisations as $key => $value) {
								?>
										<tr>
											<td colspan="2" style="text-align: left;"><?php echo $value['name']; ?></td>
											<td style="text-align: center;"><?php echo $value['code']; ?></td>
											<td style="text-align: center;">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="specialisations[]" class="custom-control-input specialisationsbox" id="<?php echo 'specialisations-'.$key.'-'.$value['code']; ?>" value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'], $specialisationsid)) ? 'checked="checked"' : ''; ?> <?php echo $disablefield; ?>>
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
								<th colspan="2" class="table_title">Installation Details<span>(Details of the work undertaken or scope of work for which the COC is being issued for)</span></th>
							</tr>

							<tr class="logcoc_textarea_wrapper">
								<td colspan="2">
									<textarea name="installation_detail" <?php echo $disablefield; ?>><?php echo $installationdetail; ?></textarea>
								</td>
							</tr>
						</table>

						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2 noncompliancetable">
							<tr>
								<th colspan="3" class="table_title">Pre- Existing Non Compliance Conditions<span>(Details of any non-compliance of the pre-existing plumbing installation on which work was done that needs to be brought to the attention of owner/user)</span></th>			
							</tr>
							<tr class="noncompliancenotfound">
								<td colspan="3">No Record Found</td>			
							</tr>
						</table>
						
						<div class="col-md-12">
							<div class="row">
								<div  class="col-md-4">
									<div class="form-group ">
										<label>Was the Non-compliance Notice issued to the Owner*</label>
										<?php
											echo form_dropdown('ncnotice', $ncnotice, $ncnoticeid, ['id' => 'ncnotice', 'class'=>'form-control']+$disablefieldarray);
										?>
									</div>
								</div>
								<div  class="col-md-8 text-right">
									<div class="ncemail_wrapper">
										<div class="custom-control custom-radio">
											<input type="radio" id="ncemail" name="ncemail" value="1" class="custom-control-input" <?php echo ($ncemail=='1') ? 'checked="checked"' : ''; ?> <?php echo $disablefield; ?>>
											<label class="custom-control-label" for="ncemail">Email* Non Compliance Notice to Owner</label>
										</div>
										<p>(Non-compliance Notice will be sent to email address as noted above)</p>
									</div>
									<?php if($actionbtn=='1'){ ?>
										<button type="button" data-toggle="modal" data-target="#noncompliancemodal" class="btn btn-primary">Add a Non Compliance</button>
									<?php } ?>
								</div>
							</div>
						</div>
						
						<?php if(count($noncompliance) > 0 && $logdate!=''){ ?>
							<div class="col-md-12 text-right mt_20">
								<a href="<?php echo base_url().$noncompliancereport;?>">
									<span>Non Compliance Notice</span>
									<img src="<?php echo $pdfimg; ?>" width="50">
								</a>
							</div>
						<?php } ?>
					</div>

					<div class="row">
						<?php if($coctypeid=='2'){ ?>
							<div class="col-md-4 add_top_value">
								<h4 class="card-title add_top_value">Image of COC (Paper)</h4>
								<div class="form-group">
									<div>
										<a href="<?php echo $file1imgurl; ?>" target="_blank">
											<img src="<?php echo $file1img; ?>" class="file1_img" width="100">
										</a>
									</div>
									<input type="file" id="file1_file" class="file1_file">
									<input type="hidden" name="file1" class="file1" value="<?php echo $file1; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
						<?php } ?>
						<?php if($coctypeid=='1' && $logdate!=''){ ?>
							<div class="col-md-6">
								<h4 class="card-title add_top_value">View Electronic COC</h4>
								<div class="form-group">
									<div>
										<a href="<?php echo base_url().$electroniccocreport;?>" target="_blank">
											<img src="<?php echo $pdfimg; ?>" width="50">
										</a>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="col-md-4 add_top_value">
							<h4 class="card-title add_top_value">Installation Images</h4>
							<div class="form-group">
								<div class="installation_default_image">
									<img src="<?php echo $uploadimg; ?>" width="100">
								</div>
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
													<a href="<?php echo $filepath.$value; ?>" target="_blank">
														<img src="<?php echo $file1img; ?>" width="100">
													</a>
													<?php if($logdate==''){ ?>
														<i class="fa fa-times"></i>
													<?php } ?>
												</div>
									<?php
											}
										}
									?>
								</div>
								<input type="file" id="file2_file" class="file2_file" <?php echo $disablefield; ?>>
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>

					<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
						<tr>
							<th colspan="3" style="text-align: left;">I <?php echo $userdata['name'].' '.$userdata['surname']; ?>, Licensed registration number <?php echo $userdata['registration_no']; ?>, certify that, the above compliance certifcate details are true and correct and will be logged in accordance with the prescribed requirements as defned by the PIRB. Select either A or B as appropriate</th>			
						</tr>
						<tr>
							<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
								<div class="table-action">
									<div class="custom-control custom-radio">
										<input type="radio" id="agreement1" name="agreement" value="1" class="custom-control-input" <?php echo ($agreementid=='1') ? 'checked="checked"' : ''; ?> <?php echo $disablefield; ?>>
										<label class="custom-control-label" for="agreement1"></label>
									</div>
								</div>	
							</td>
							<td colspan="2" style="text-align: left;">A: The above plumbing work was carried out by me or under my supervision, and that it complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
						</tr>
						<tr>
							<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
								<div class="table-action">
									<div class="custom-control custom-radio">
										<input type="radio" id="agreement2" name="agreement" value="2" class="custom-control-input" <?php echo ($agreementid=='2') ? 'checked="checked"' : ''; ?> <?php echo $disablefield; ?>>
										<label class="custom-control-label" for="agreement2"></label>
									</div>
								</div>	
							</td>
							<td colspan="2" style="text-align: left;">B: I have fully inspected and tested the work started but not completed by another Licensed plumber. I further certify that the inspected and tested work and the necessary completion work was carried out by me or under my supervision- complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
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
								<?php
									echo form_dropdown('statement', [], '', ['id' => 'nc_statement', 'class'=>'form-control']);
								?>
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
									<img src="<?php echo $uploadimg; ?>" width="100">
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
					<input type="hidden" value="<?php echo $cocid; ?>" name="coc_id">
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
						<input id="sampleotp" type="text" class="form-control displaynone" readonly>
						<p>Enter OTP</p>
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
	datepicker('.completion_date', ['pastfivedate', 'enddate']);
	citysuburb(['#province','#city', '#suburb'], ['<?php echo $cityid; ?>', '<?php echo $suburbid; ?>']);
	fileupload([".file1_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.file1', '.file1_img', filepath, pdfimg]);
	fileupload([".file2_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['file2[]', '.file2append', filepath, pdfimg], 'multiple');
	fileupload(["#nc_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['file[]', '.ncfileappend', filepath, pdfimg], 'multiple');
	subtypereportinglist(['#nc_installationtype','#nc_subtype','#nc_statement'], ['', ''], noncompliancedata);
	inputmask('#contact_no, #alternate_no', 1);
	
	var noncompliancelists = $.parseJSON('<?php echo addslashes(json_encode($noncompliance)); ?>');
	if(noncompliancelists.length > 0){
		$(noncompliancelists).each(function(i, v){
			var noncompliancedata 	= {status : 1, result : { id: v.id, details: v.details, file: v.file }}
			noncompliance(noncompliancedata);
		})
	}
	
	installationdefaultimage();
	noncomplianceextras();
	
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
				required:  	function() {
								return $(".specialisationsbox:checked").length == 0;
							}
			},
			'specialisations[]':{
				required:  	function() {
								return $(".installationtypebox:checked").length == 0;
							}
			},
			ncnotice:{
				required    : true
			},
			agreement:{
				required    : true
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
			ncnotice:{
				required    : "Please check the non compliance notice"
			},
			agreement:{
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

function installationdefaultimage(){
	if($(document).find('.file2append .multipleupload').length){
		$('.installation_default_image').hide();
	}else{
		$('.installation_default_image').show();
	}
}

$(document).on('click', '.savecocbtn', function(){
	$('#submitbtn').attr('value', 'save').click();
})

$(document).on('click', '.logcocbtn', function(){
	if($('.form').valid()){
		ajaxotp();
		$('#otpmodal').modal('show');
	}
})


$(document).on('click', '.resendotp', function(){
	ajaxotp();
});

function ajaxotp(){
	ajax('<?php echo base_url().'ajax/index/ajaxotp'; ?>', {}, '', { 
		success:function(data){
			if(data!=''){
				$('#sampleotp').removeClass('displaynone').val(data);
			}
		}
	})
}

$(document).on('click', '.verifyotp', function(){
	$('.error_otp').remove();
	var otp = $('#otp').val();
	
	ajax('<?php echo base_url().'ajax/index/ajaxotpverification'; ?>', {otp: otp}, '', { 
		success:function(data){
			if (data == 0) {
				$('#otp').parent().append('<p class="tagline error_otp">Incorrect OTP</p>');
			}else{
				$('#submitbtn').attr('value', 'log').click();
			}
		}
	})
});

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
		
		if(result.file!=''){
			var filesplit 			= result.file.split(',');
			var attachmentarray 	= [];
			
			$(filesplit).each(function(i, v){
				var ext 		= v.split('.').pop().toLowerCase();
				if(ext=='jpg' || ext=='jpeg' || ext=='png'){
					attachmentarray.push('<a href="'+filepath+v+'" target="_blank"  class="noncomplianceappendimg"><img src="'+filepath+v+'" width="80"></a>');
				}else if(ext=='pdf'){
					attachmentarray.push('<a href="'+filepath+v+'" target="_blank"  class="noncomplianceappendimg"><?php echo base_url()."assets/images/pdf.png"?></a>');
				}
			})
			
			var attachment = attachmentarray.join('');
		}else{
			var attachment = '';
		} 
		
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
									<td style="text-align:left" colspan="'+detailcol+'">'+result.details+'</td><td>'+attachment+'</td>'+complianceaction+'\
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
		
		subtypereportinglist(['#nc_installationtype','#nc_subtype','#nc_statement'], [result.subtype, result.statement], noncompliancedata);
		
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
		$('.ncemail_wrapper').show();
	}else{
		$('.noncompliancenotfound').show();
		$('.ncemail_wrapper').hide();
	}
}

function noncompliancedata(){
	setTimeout(function(){
		var installationtype 	= $('#nc_installationtype').val();
		var subtype 			= $('#nc_subtype').val();
		var statement 			= $('#nc_statement').val();
		
		if(installationtype!=null && subtype!=null && statement!=null){
			ajax('<?php echo base_url()."ajax/index/ajaxnoncompliancelisting"; ?>', {'installationtype' : installationtype,'subtype' : subtype,'statement' : statement}, '', { success : function(data){
				if(data.status==1){
					var result = data.result;
					
					if($('#nc_details').val()=='') $('#nc_details').val(result.details)
					if($('#nc_action').val()=='') $('#nc_action').val(result.action)
					if($('#nc_reference').val()=='') $('#nc_reference').val(result.reference)
				}	
			}});
		}
	}, 1000);
}

$('#ncemail').click(function(){
	if($('.email').val()==''){
		$('#ncemail').prop('checked', false);
		$('.email').focus();
	}
})


$('[name="address"], [name="street"], [name="number"]').keyup(function(){
	addressmap();
})

$('#province, #city, #suburb').change(function(){
	addressmap();
})

function formaddress(){
	return new Promise((resolve, reject) => {
		setTimeout(function(){
			var address = [];
		
			if($('[name="address"]').val()!='') 	address.push($('[name="address"]').val());
			if($('[name="street"]').val()!='') 		address.push($('[name="street"]').val());
			if($('[name="number"]').val()!='') 		address.push($('[name="number"]').val());
			if($('#province').val()!='') 			address.push($('#province option:selected').text());
			if($('#city').val()!='') 				address.push($('#city option:selected').text());
			if($('#suburb').val()!='') 				address.push($('#suburb option:selected').text());
			
			if(address.join('')!=''){
				address.push('South Africa');
				var result = address.join(', ');
			}else{
				var result = '';
			}
			
			resolve(result);
		}, 1000);
	});
}

async function addressmap(){
	var address 	= await formaddress();
	var geocoder 	= new google.maps.Geocoder();

	geocoder.geocode({'address': address}, function(results, status){
		if (status == google.maps.GeocoderStatus.OK){
			var latitude 		= results[0].geometry.location.lat();
			var longitude 		= results[0].geometry.location.lng();
			var markertoggle 	= 1;
		}else{
			var latitude 		= -26.195246;
			var longitude 		= 28.034088;
			var markertoggle 	= 0;
		} 
		
		var myLatLng = {lat: latitude, lng: longitude};
		
		var map = new google.maps.Map(document.getElementById('addressmap'), {
			zoom: 9,
			center: myLatLng,
			scrollwheel: false,
			draggable:false,
			disableDefaultUI: true
		});
		
		if(markertoggle==1){
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map
			});
		}
	});
}

$(window).on('load', function(){
	addressmap();
})
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('googleapikey'); ?>"></script>