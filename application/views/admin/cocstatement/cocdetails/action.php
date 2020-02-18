<?php
	$id 					= isset($result['id']) ? $result['id'] : '';
	
	$cocid 					= isset($result['coc_id']) ? $result['coc_id'] : '';	
	$cocstatusid			= $result['coc_status'];
	$cocstatus 				= isset($this->config->item('cocstatus')[$result['coc_status']]) ? $this->config->item('cocstatus')[$result['coc_status']] : '';
	$auditstatus 			= isset($this->config->item('auditstatus')[$result['audit_status']]) ? $this->config->item('auditstatus')[$result['audit_status']] : '';
	$coctypeid 				= $result['coc_type'];
	$coctype 				= isset($this->config->item('coctype')[$result['coc_type']]) ? $this->config->item('coctype')[$result['coc_type']] : '';
	
	$companyname 			= isset($result['companyname']) ? $result['companyname'] : '';
	$allocationdate 		= isset($result['createddate']) && $result['createddate']!='1970-01-01' ? date('d-m-Y', strtotime($result['createddate'])) : '';
	
	$plumberid 				= isset($result['plumberid']) ? $result['plumberid'] : '';
	$plumberregno 			= isset($result['registration_no']) ? $result['registration_no'] : '';
	$plumbername 			= isset($result['plumbername']) ? $result['plumbername'] : '';
	$plumberstatus 			= isset($this->config->item('plumberstatus')[$result['plumberstatus']]) ? $this->config->item('plumberstatus')[$result['plumberstatus']] : '';
	
	$logdate 				= isset($result['log_date']) && $result['log_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['log_date'])) : '';
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
	
	$filepath				= base_url().'assets/uploads/coc/cocdetails/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Details</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">COC Status</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Certificate No</label>
							<input type="text" class="form-control" value="<?php echo $certificateno; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>CoC Type</label>
							<input type="text" class="form-control" value="<?php echo $coctype; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>CoC Status</label>
							<input type="text" class="form-control" value="<?php echo $cocstatus; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Audit Status</label>
							<input type="text" class="form-control" value="<?php echo $auditstatus; ?>" disabled>
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Reseller Details</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" value="<?php echo $companyname; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date and Time of Allocation to Plumber</label>
							<input type="text" class="form-control" value="<?php echo $allocationdate; ?>" disabled>
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Plumber Details</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Registration Number</label>
							<input type="text" class="form-control" value="<?php echo $plumberregno; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name and Surname</label>
							<input type="text" class="form-control" value="<?php echo $plumbername; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Current Status</label>
							<input type="text" class="form-control" value="<?php echo $plumberstatus; ?>" disabled>
						</div>
					</div>
				</div>
				
				
				<h4 class="card-title">COC Details</h4>
				<p><a target="blank" href="<?php echo base_url().'admin/cocstatement/cocdetails/index/viewcoc/'.$cocid.'/'.$plumberid; ?>">View COC Details in full</a></p>
				<div class="row">					
					<div class="col-md-12">
						<div class="form-group">
							<label>Date and Time of Logging COC</label>
							<input type="text" class="form-control" name="logdate" value="<?php echo $logdate; ?>" disabled>
						</div>
					</div>					
					<div class="col-md-6">
						<div class="form-group">
							<label>Certificate No</label>
							<input type="text" class="form-control" name="name" value="<?php echo $certificateno; ?>" disabled>
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
				
				<h4 class="card-title">Diary of Activities and Comments</h4>
				<div class="row">	
					<form action="" method="post" class="form1">
						<div class="col-md-12 comment_list">
							<?php
								foreach($comments as $comment){
							?>
									<p><?php echo date('d-m-Y', strtotime($comment['created_at'])).' - '.$comment['username'].' : '.$comment['comments']; ?></p>
							<?php
								}
							?>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" name="comments" id="comments" value="">
								<button type="submit" class="btn btn-primary" value="comment" name="submit">Add Comment</button>
							</div>
						</div>
					</form>
				</div>
				
				<?php if($cocstatusid=='2'){ ?>
					<h4 class="card-title">Recalled/Reallocate/Cancel a COC</h4>
					<form action="" method="post" class="form2">
					<div class="row">				
						<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<?php
										foreach($cocrecall as $key => $value){
											if($coctypeid=='1' && $key=='2') continue; 
									?>
											<div class="col-md-2">
												<div class="custom-control custom-radio">
													<input type="radio" name="cocrecall" data-id="<?php echo $key; ?>" id="cocrecall<?php echo $key; ?>" class="custom-control-input cocrecall" value="<?php echo $key; ?>">
													<label class="custom-control-label" for="cocrecall<?php echo $key; ?>"><?php echo $value; ?></label>
												</div>
											</div>
									<?php
										}
									?>
								</div>
							</div>
						</div>	
						<div class="col-md-12 coc_reallocate displaynone">
							<div class="col-md-12">
								<div class="form-group">
									<label>Reseller</label>
									<input type="text" class="form-control" id="autocompleteresellertext">
									<input type="hidden" id="autocompleteresellerid" name="resellerid">
									<div id="autocompleteresellersuggestion"></div>
								</div>
							</div>				
							<div class="col-md-12">
								<div class="form-group">
									<label>Plumber</label>
									<input type="text" class="form-control" id="autocompleteplumbertext">
									<input type="hidden" id="autocompleteplumberid" name="plumberid">
									<div id="autocompleteplumbersuggestion"></div>
								</div>
							</div>		
						</div>		
						<div class="col-md-12 coc_cancel displaynone">
							<div class="col-md-12">
								<div class="form-group">
									<label>Reason Canceling COC</label>
									<div class="row">
										<?php
											foreach($cocreason as $key => $value){
										?>
												<div class="col-md-2">
													<div class="custom-control custom-radio">
														<input type="radio" name="cocreason" id="cocreason<?php echo $key.'-'.$value; ?>" class="custom-control-input" value="<?php echo $key; ?>">
														<label class="custom-control-label" for="cocreason<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
													</div>
												</div>
										<?php
											}
										?>
									</div>
								</div>
							</div>	
							<div class="col-md-3">
								<label>Add Document</label>
								<div class="form-group">
									<div>
										<img src="<?php echo $profileimg; ?>" class="document_image" width="100">
									</div>
									<input type="file" class="document_file">
									<input type="hidden" name="document" class="photo" value="">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
						</div>							
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary">Cancel/Reallocate/Recalled</button>
						</div>
					</div>
					</form>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>

<script>
	var filepath 	= '<?php echo $filepath; ?>';
	var pdfimg		= '<?php echo $pdfimg; ?>';

	$(function(){
		citysuburb(['#province','#city', '#suburb'], ['<?php echo $cityid; ?>', '<?php echo $suburbid; ?>']);
		fileupload([".document_file", "./assets/uploads/coc/cocdetails/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.document', '.document_image', filepath, pdfimg]);
	
		validation(
			'.form1',
			{
				comments : {
					required	: true
				}
			},
			{
				comments 	: {
					required	: "Comment field is required."
				}
			}
		);
			
		validation(
			'.form2',
			{
				cocrecall : {
					required	: true
				},
				cocreason : {
					required:  	function() {
									return $('.cocrecall:checked').val() == "2";
								}
				},
				document : {
					required:  	function() {
									return $('.cocrecall:checked').val() == "2";
								}
				},
				plumberid : {
					required:  	function() {
									return $('.cocrecall:checked').val() == "3" && $('#autocompleteresellerid').val() == '';
								}
				},
				resellerid : {
					required:  	function() {
									return $('.cocrecall:checked').val() == "3" && $('#autocompleteplumberid').val() == '';
								}
				}
			},
			{
				cocrecall 	: {
					required	: "Please select one option."
				},
				cocreason 	: {
					required	: "Please select one option."
				},
				document 	: {
					required	: "Please upload document."
				},
				plumberid 	: {
					required	: "Please select plumber."
				},
				resellerid 	: {
					required	: "Please select reseller."
				}
			},
			{
				ignore : []
			}
		);
			
	});
	
	
	$('#autocompleteplumbertext').keyup(function(){
		userautocomplete(["#autocompleteplumbertext", "#autocompleteplumberid", "#autocompleteplumbersuggestion"], [$(this).val(), 3]);
	})
	
	$('#autocompleteresellertext').keyup(function(){
		userautocomplete(["#autocompleteresellertext", "#autocompleteresellerid", "#autocompleteresellersuggestion"], [$(this).val(), 6]);
	})
	
	$('.cocrecall').click(function(){
		cocrecall($(this).val())
	})
	
	function cocrecall(value){
		$('.coc_reallocate, .coc_cancel').addClass('displaynone');
		if(value=='2'){
			$('.coc_cancel').removeClass('displaynone');
		}else if(value=='3'){
			$('.coc_reallocate').removeClass('displaynone');
		}
	}
</script>
