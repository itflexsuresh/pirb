<?php
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	
	$cocid 					= isset($result['id']) ? $result['id'] : '';
	
	$plumberid 				= isset($result['u_id']) ? $result['u_id'] : '';
	$plumberregno 			= isset($result['plumberregno']) ? $result['plumberregno'] : '';
	$plumbername 			= isset($result['u_name']) ? $result['u_name'] : '';
	$plumberwork 			= isset($result['u_work']) ? $result['u_work'] : '';
	$plumbermobile 			= isset($result['u_mobile']) ? $result['u_mobile'] : '';
	$plumberfile 			= isset($result['u_file']) ? $result['u_file'] : '';
	
	$filepath				= base_url().'assets/uploads/plumber/'.$plumberid.'/';
	
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
			<form class="mt-4 form resellers" action="" method="post">
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
										<input type="text" class="form-control dateofaudit" name="dateofaudit" data-date="datepicker" value="<?php echo ''; ?>">
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
										echo form_dropdown('workmanship', $workmanship, '', ['id' => 'workmanship', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Licensed Plumber Present</label>
									<?php
										echo form_dropdown('plumberpresent', $yesno, '', ['id' => 'plumberpresent', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Was COC Completed Correctly</label>
									<?php
										echo form_dropdown('wascompleted', $yesno, '', ['id' => 'wascompleted', 'class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group custom-control custom-radio">							
									<input type="radio" class="custom-control-input" name="audithold" id="audithold" value="1">
									<label class="custom-control-label" for="audithold">Place Audit on hold</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Why was Audit placed on hold?</label>	
									<textarea class="form-control"  name="whyaudithold" id="whyaudithold" rows="4" cols="50"><?php echo ''; ?></textarea>			
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row form-group">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Review Type</th>
										<th>Statement</th>
										<th>Comments</th>
										<th>Images</th>
										<th>Performance Points</th>
										<th>Refix Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="6">No Record Found</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row text-right">
						<button type="button" data-toggle="modal" data-target="#reviewmodal" class="btn btn-primary">Add a Review</button>
					</div>
				</div>
								
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Refix Period (Days)</label>
									<input type="text" class="form-control" name="refixperiod" id="refixperiod" value="<?php echo ''; ?>" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Date and Time of Report submitted:</label>
									<input type="text" class="form-control" name="reportdate" id="reportdate" value="<?php echo ''; ?>" >
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" id="auditcomplete" class="custom-control-input auditcomplete" name="auditcomplete" value="1">
							<label class="custom-control-label" for="auditcomplete">Audit Complete</label>
						</div>											
					</div>
				</div>
				
				<div class="col-md-12 text-right">					
					<button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">Submit Report</button>
					<button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">Save/Update</button>
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
					<h4 class="modal-title">Non Compliance</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Installation Type</label>
								<?php
									echo form_dropdown('installationtype', $installationtype, '', ['id' => 'r_installationtype', 'class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Sub Type</label>
								<?php
									echo form_dropdown('subtype', [], '', ['id' => 'r_subtype', 'class'=>'form-control']);
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
								<textarea name="reference" rows="6" class="form-control" id="r_reference"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>SANS/Regulation/Bylaw Reference</label>
								<input type="text" name="reference"class="form-control" id="r_reference">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Knowledge Reference link</label>
								<input type="text" name="link"class="form-control" id="r_link">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Comments</label>
								<textarea name="comments" rows="6" class="form-control" id="r_comments"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<img src="<?php echo $profileimg; ?>" width="100">
								</div>
								<input type="file" id="r_file">
								<p>(Image/File Size Smaller than 5mb)</p>
								<div class="rfileappend"></div>
							</div>						
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Performance Point Allocation</label>
								<input type="text" name="point" class="form-control" id="r_point">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="r_id">
					<button type="button" class="btn btn-success reviewsubmit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">


$(function(){
	
	select2('#workmanship, #plumberpresent, #wascompleted');
	datepicker('.dateofaudit');	
	citysuburb(['#province','#city', '#suburb'], ['<?php echo $cityid; ?>', '<?php echo $suburbid; ?>']);
	subtypereportinglist(['#r_installationtype','#r_subtype','#r_statement'], ['', '']);
});
</script>