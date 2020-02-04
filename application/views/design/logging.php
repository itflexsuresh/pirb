<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My Profile</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My Profile</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
				<form class="form" method="post">

					<h4 class="card-title">My Profile</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name *</label>
										<input type="text" class="form-control"  name="name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Surname *</label>
										<input type="text" class="form-control"  name="surname">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>ID Number *</label>
										<input type="text" class="form-control"  name="idnumber">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Photo</label>
								<div>
									<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="auditor_photo" width="100">
								</div>
								<input type="file" class="auditor_image" >
								<input type="hidden" name="auditor_picture" class="auditor_picture">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email *</label>
								<input type="email" class="form-control"  name="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Password *</label>
								<input type="password" class="form-control"  name="pass">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Work) *</label>
								<input type="text" class="form-control"  name="phonework">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Mobile) *</label>
								<input type="text" class="form-control"  name="phonemobile">
							</div>
						</div>
					</div>

					<h4 class="card-title">Billing Details</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Billing Name *</label>
								<input type="text" class="form-control" name="billingname">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Company Reg Number *</label>
								<input type="text" class="form-control" name="regnumber">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Company VAT *</label>
								<input type="text" class="form-control" name="vat">
							
								<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">	
									<input type="checkbox" class="custom-control-input" name="vatvendor" id="vatvendor">
									<label class="custom-control-label" for="vatvendor">VAT Vendor</label>
								</div>
							</div>
						</div>
					</div>

					<h4 class="card-title">Billing Address</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Billing Address *</label>
								<input type="text" class="form-control" name="billingaddress">
							</div>
							<div class="form-group"> 
								<label>Province *</label>
								<?php
									echo form_dropdown('address[1][province]', $province, '',['class'=>'form-control']);
									?>
							</div>
							<div class="form-group">
								<label>City *</label>
								<!-- <?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?> -->
								<input type="text" name="city" id="city_name" class="form-control" value="">
							</div>
							<div class="form-group">
								<label>Suburb *</label>
								<!-- <?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?> -->
								<input type="text" name="suburb" id="suburb_name" class="form-control" value="">
							</div>
							<div class="form-group">
								<label>Postal Code *</label>
								<input type="text" class="form-control" name="postalcode">
							</div>
						</div>						
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Logo</label>
								<div>
									<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="comp_logo" width="100">
								</div>
								<input type="file" class="comp_emb">
								<input type="hidden" name="comp_photo" class="comp_photo">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>
					
					<h4 class="card-title">Banking Details</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Bank Name *</label>
								<input type="text" class="form-control" name="bankname">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Name *</label>
								<input type="text" class="form-control" name="accountname">
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Branch Code *</label>
								<input type="text" class="form-control" name="branchcode">
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Number *</label>
								<input type="text" class="form-control" name="accountnumber">
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Type *</label>
								<input type="text" class="form-control" name="accounttype">
							</div>
						</div>
					</div>
					
					<h4 class="card-title">My Auditting Areas</h4>
					<div class="row">
						<div class="col-md-12">							
							<table id="table" class="table table-bordered table-striped datatables fullwidth">
								<thead>
									<tr>
										<th>Province</th>
										<th>City</th>        
										<th>Suburb</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr >    
										<!-- <td class="ptty"></td>
										<td class="cccty"></td>
										<td class="qqty"></td>
										<td></td> -->
									</tr>
								</tbody>
							</table>
						</div>
					</div>
						
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Province *</label>
								<!-- <?php
									echo form_dropdown('address[1][province]', $province, '',['class'=>'form-control']);
									?> -->
									<input type="text" name="audit_city" id="audit_provin" class="form-control" value="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<!-- <?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?> -->
								<input type="text" name="audit_city" id="audit_city" class="form-control" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<!-- <?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?> -->
								<input type="text" name="audit_suburb" id="audit_suburb" class="form-control" value="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
							<button type="submit" name="addarea" id="addarea" class="btn btn-block btn-primary btn-rounded">Add Area</button>
						</div>

						<div class="col-md-3">
							<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary btn-rounded">Save/Update</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
	datepicker();
})
</script>