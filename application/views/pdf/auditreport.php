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

$auditorname 			= isset($result['auditorname']) ? $result['auditorname'] : '';
$auditormobile 			= isset($result['auditormobile']) ? $result['auditormobile'] : '';
$auditoremail 			= isset($result['auditoremail']) ? $result['auditoremail'] : '';
?>

<div class="">
	<h3>COC DETAILS</h3>
	<div class="row">					
		<div class="">
			<label>Certificate No</label>
			<input type="text" value="<?php echo $cocid; ?>">
		</div>					
		<div class="">			
			<label>Plumbing Work Completion Date</label>
			<input type="text" value="<?php echo $completiondate; ?>">
		</div>						
		<div class="">			
			<label>Owners Name</label>
			<input type="text" value="<?php echo $name; ?>">
		</div>								
		<div class="">			
			<label>Name of Complex/Flat (if applicable)</label>
			<input type="text" value="<?php echo $address; ?>">
		</div>								
		<div class="">			
			<label>Street</label>
			<input type="text" value="<?php echo $street; ?>">
		</div>								
		<div class="">			
			<label>Number</label>
			<input type="text" value="<?php echo $number; ?>">
		</div>							
		<div class="">			
			<label>Province</label>
			<input type="text" value="<?php echo $province; ?>">
		</div>							
		<div class="">			
			<label>City</label>
			<input type="text" value="<?php echo $city; ?>">
		</div>							
		<div class="">			
			<label>Suburb</label>
			<input type="text" value="<?php echo $suburb; ?>">
		</div>	
	</div>
	
	<h3>AUDITOR DETAILS</h3>
	<div class="row">							
		<div class="">			
			<label>Auditors Name and Surname</label>
			<input type="text" value="<?php echo $auditorname; ?>">
		</div>	
		<div class="">			
			<label>Phone (Mobile)</label>
			<input type="text" value="<?php echo $auditormobile; ?>">
		</div>	
		<div class="">			
			<label>Email</label>
			<input type="text" value="<?php echo $auditoremail; ?>">
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
		<?php foreach($reviewlist as $list){ ?>
			<tr>
				<td><?php echo isset($this->config->item('reviewtype')[$list['reviewtype']]) ? $this->config->item('reviewtype')[$list['reviewtype']] : ''; ?></td>
				<td><?php echo $list['statementname']; ?></td>
				<td><?php echo $list['reference']; ?></td>
				<td><?php echo $list['comments']; ?></td>
				<td>
					<?php 
						$filelist = array_filter(explode(',', $list['file'])); 
						foreach($filelist as $file){
					?>
							<img src="<?php echo base_url().'assets/uploads/auditor/statement/'.$file; ?>" width="50">
					<?php
						}
					?>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>