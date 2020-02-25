<?php
$cocid 					= isset($result['id']) ? $result['id'] : '';
	
$completiondate 		= isset($result['cl_completion_date']) && $result['cl_completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_completion_date'])) : '';
$name 					= isset($result['cl_name']) ? $result['cl_name'] : '';
$address 				= isset($result['cl_address']) ? $result['cl_address'] : '';
$street 				= isset($result['cl_street']) ? $result['cl_street'] : '';
$number 				= isset($result['cl_number']) ? $result['cl_number'] : '';
$province 				= isset($result['cl_province_name']) ? $result['cl_province_name'] : '';
$city 					= isset($result['cl_city_name']) ? $result['cl_city_name'] : '';
$suburb 				= isset($result['cl_suburb_name']) ? $result['cl_suburb_name'] : '';

?>

<div class="">
	<h3>COC DETAILS</h3>
	<div class="row">					
		<div class="">
			<label>Certificate No</label>
			<input type="text" class="" name="name" value="<?php echo $cocid; ?>">
		</div>					
		<div class="">			
			<label>Plumbing Work Completion Date</label>
			<input type="text" class="" name="name" value="<?php echo $cocid; ?>">
		</div>					
		<div class="col-md-12">
			<div class="">
				<label>Owners Name</label>
				<input type="text" class="" name="name" value="<?php echo $name; ?>" disabled>
			</div>
		</div>
		<div class="col-md-12">
			<div class="">
				<label>Name of Complex/Flat (if applicable)</label>
				<input type="text" class="" name="address" value="<?php echo $address; ?>" disabled>
			</div>
		</div>
		<div class="">
			<div class="">
				<label>Street</label>
				<input type="text" class="" name="street" value="<?php echo $street; ?>" disabled>
			</div>
		</div>
		<div class="">
			<div class="">
				<label>Number</label>
				<input type="text" class="" name="number" value="<?php echo $number; ?>" disabled>
			</div>
		</div>
		<div class="col-md-4">
			<div class="">
				<label>Province</label>
				<?php
					echo form_dropdown('province', $province, $provinceid, ['id' => 'province', 'class'=>'', 'disabled' => 'disabled']);
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="">
				<label>City</label>
				<?php 
					echo form_dropdown('city', [], $cityid, ['id' => 'city', 'class' => '', 'disabled' => 'disabled']); 
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="">
				<label>Suburb</label>
				<?php
					echo form_dropdown('suburb', [], $suburbid, ['id' => 'suburb', 'class'=>'', 'disabled' => 'disabled']);
				?>
			</div>
		</div>
		<div class="">
			<div class="">
				<label>Contact Mobile</label>
				<input type="text" class="" name="contact_no" id="contact_no" value="<?php echo $contactno; ?>" disabled>
			</div>
		</div>
		<div class="">
			<div class="">
				<label>Alternate Contact</label>
				<input type="text" class="" name="alternate_no" id="alternate_no" value="<?php echo $alternateno; ?>" disabled>
			</div>
		</div>
	</div>
	
	<h3>AUDITOR DETAILS</h3>
	<div class="row">
		<div class="">
			<div class="">
				<label>Auditors Name and Surname</label>
				<input type="text" class="" value="<?php echo $auditorname; ?>" disabled>
			</div>
		</div>
		<div class="">
			<div class="">
				<label>Phone (Mobile)</label>
				<input type="text" class="" value="<?php echo $auditormobile; ?>" disabled>
			</div>
		</div>
		<div class="">
			<div class="">
				<label>Email</label>
				<input type="text" class="" value="<?php echo $auditorstatus; ?>" disabled>
			</div>
		</div>
	</div>
	
	<div>
		<h3>NOTICE TO LICENSED PLUMBER</h3>
		<p>It is your responsible to complete your refix's with in the allocted time. Failure to do so within the alloated time will result in the refix being marked as Audit Complete (with Refix(s)) and relevant remedial action will follow.</p>
		<p>Please login into your PIRB Profile for further details pertaining to this audit review.</p>
	</div>
	
	<h3>AUDIT REVIEW</h3>
	<table class="table table-bordered reviewtable">								
		<tr>
			<th>Review Type</th>
			<th>Statement</th>
			<th>SANS/Regulation/Bylaw Reference</th>
			<th>Comments</th>
			<th>Images</th>
		</tr>
		<tr class="reviewnotfound">
		</tr>
	</table>
</div>