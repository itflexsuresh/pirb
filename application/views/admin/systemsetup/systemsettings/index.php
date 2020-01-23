<?php
// print_r($cpdstream);die;
if(isset($result) && $result){
	$id 			= $result['id'];
	$name 			= (set_value('name')) ? set_value('name') : $result['name'];
	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading		= 'Update';
}else{
	$id 			= '';
	$name			= set_value('name');
	$status			= set_value('status');

	$heading		= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Installation Type</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Installation Type</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Installation Type</h4>
				<form class="mt-4 form" action="" method="post">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">PIRB Company Details</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Physical Address</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Contact Details</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab4" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Banking Details</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab5" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Global Settings</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab6" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">CPD Points Settings</span></a> </li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content tabcontent-border">
						<div class="tab-pane active" id="tab1" role="tabpanel">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Company Registration Number *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Company Name *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">VAT Number *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter VAT Number *" value="<?php echo $name; ?>">
								</div>
							</div>
						</div>
						<div class="tab-pane  p-20" id="tab2" role="tabpanel">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Physical Address *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Postal Address *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Suburb *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Suburb *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">City *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">City *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Province *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Province *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">									
								</div>
								<div class="form-group col-md-6">
									<label for="name">Postal Code *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="tab3" role="tabpanel">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Work Phone *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Email Address *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="tab4" role="tabpanel">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Bank Name *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Branch Code *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Account Name *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">									
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Account Number *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Account Type *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="tab5" role="tabpanel">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="name">Vat as a Percentage *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Registration Number *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">System Email Address *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Default Plumber Max Non - Logged Certificates *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Default  Resellers Max Non - Logged Certificates *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Defult Refix Period in days *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Audit Ratio as a Percentage *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">Days allowed after regsitration date has passed to apply Late Date Payment penalty *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="name">DDays allowed after regsitration date has passed before making registration expired *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name *" value="<?php echo $name; ?>">
								</div>
							</div>
						</div>
						<div class="tab-pane p-20" id="tab6" role="tabpanel">
							<div class="col-md-12">
							<table id="mainTable" class="table table-bordered">
								<thead>
									<tr>
										<th>CPD Stream</th>
										<th>Master Plumber</th>
										<th>Licsensed Plumber</th>
										<th>Operating Technician</th>
										<th>Assistant Technician</th>
										<th>Learner</th>
									</tr>
								</thead>
								<tbody class="cpd_body">
									<tr>
										<td>Developmental</td>
										<td><input id="developmental1" type="number"></td>
										<td><input  id="developmental2" type="number"></td>
										<td><input  id="developmental3" type="number"></td>
										<td><input  id="developmental4" type="number"></td>
										<td><input  id="developmental5" type="number"></td>
										<td><input  id="developmental6" type="number"></td>
									</tr>
									<tr>
										<td>WorkBased</td>
										<td><input id="workbased1" type="number"></td>
										<td><input id="workbased2" type="number"></td>
										<td><input id="workbased3" type="number"></td>
										<td><input id="workbased4" type="number"></td>
										<td><input id="workbased5" type="number"></td>
										<td><input id="workbased6" type="number"></td>
									</tr>
									<tr>
										<td>Individual</td>
										<td><input id="individual1" name="individual1"></td>
										<td><input id="individual2" name="individual2"></td>
										<td><input id="individual3" name="individual3"></td>
										<td><input id="individual4" name="individual4"></td>
										<td><input id="individual5" name="individual5"></td>
										<td><input id="individual6" name="individual6"></td>
									</tr>
									<tr>
										<td>Total</td>
										<td><input id="direct-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
										<td><input id="master-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
										<td><input id="license-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
										<td><input id="techinical-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
										<td><input id="assisting-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
										<td><input id="learner-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>      
									</tr>

								</tbody>
							</table>
							</div>
						</div>
						</div>
						<div class="row">						
							<div class="col-md-12 text-right">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Installtion Type</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
	</script>
