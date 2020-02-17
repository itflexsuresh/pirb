<?php
	$id 					= isset($result['id']) ? $result['id'] : '';
	
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
							<input type="text" class="form-control" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>CoC Status</label>
							<input type="text" class="form-control" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Audit Status</label>
							<input type="text" class="form-control" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Reseller Details</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" value="<?php echo $certificateno; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date and Time of Allocation to Plumber</label>
							<input type="text" class="form-control" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Plumber Details</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Registration Number</label>
							<input type="text" class="form-control" value="<?php echo $certificateno; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name and Surname</label>
							<input type="text" class="form-control" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Current Status</label>
							<input type="text" class="form-control" value="<?php echo $number; ?>" disabled>
						</div>
					</div>
				</div>
				
				
				<h4 class="card-title">COC Details</h4>
				<a href="">View COC Details in full</a>
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
					<div class="col-md-12 comment_list"></div>
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" class="form-control" name="alternate_no" id="alternate_no" value="<?php echo $alternateno; ?>" disabled>
							<input type="submit" value="Add Comment">
						</div>
					</div>
				</div>
				
				<h4 class="card-title">Recalled/Reallocate/Cancel a COC</h4>
				<div class="row">				
					<div class="col-md-12">
						<div class="form-group">
							<label>Reseller</label>
							<input type="text" class="form-control">
						</div>
					</div>	
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		citysuburb(['#province','#city', '#suburb'], ['<?php echo $cityid; ?>', '<?php echo $suburbid; ?>']);
		
		validation(
			'.form',
			{
				name : {
					required	: true,
					remote		: 	{
							url	: "<?php echo base_url().'admin/administration/installationtype/InstallationTypeValidation'; ?>",
							type: "post",
							async: false,
							data: {
								name: function() {
									return $( "#name" ).val();
								},
								id: function() {
									return $( "#id" ).val();
								}
							}

						}
				}
			},
			{
				name 	: {
					required	: "Installation Type field is required.",
					remote		: "Installation Type Already Exists."
				}
			},[],'1'
			);
			
	});
</script>
