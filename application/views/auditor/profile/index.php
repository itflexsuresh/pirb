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
<!-- <?php echo $notification; ?> -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
				<form>
					<!-- <h4 class="card-title">Registered Plumber Details</h4> -->

					
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
								<input type="text" class="form-control"  name="id_Number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Photo</label>
								<input type="file" name="userfile"/>
								<div class="col-md-4">
									<button type="submit" name="add_photo" class="btn btn-block btn-primary btn-rounded" value="upload">Add File/Images</button>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Email *</label>
								<input type="email" class="form-control"  name="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Password *</label>
								<input type="password" class="form-control"  name="password">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Work) *</label>
								<input type="text" class="form-control"  name="phone_work">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Mobile) *</label>
								<input type="password" class="form-control"  name="phone_mobile">
							</div>
						</div>
					</div>

					<h5><u>Billing Details</u></h5>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Billing Name *</label>
								<input type="text" class="form-control" name="billing_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Reg Number *</label>
								<input type="text" class="form-control" name="reg_number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Company VAT *</label>
								<input type="text" class="form-control" name="vat">
								<input type="checkbox" class="custom-control-input" name="vat_vendor" id="vat_vendor">
								<label class="custom-control-label" for="vat_vendor">VAT Vendor</label>
							</div>
						</div>

					</div>
					<h5><u>Billing Address</u></h5>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Billing Address *</label>
								<input type="text" class="form-control" name="billing_address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Province *</label>
								<?php
								echo form_dropdown('disability', $disability, '',['class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Postal Code *</label>
								<input type="text" class="form-control" name="postal_code">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Company Logo</label>
								<input type="file" name="comp_logo"/>
								<div class="col-md-4">
									<button type="submit" name="add_logo" class="btn btn-block btn-primary btn-rounded">Add Images</button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- <h5>Banking Details</h5> -->
						<div class="col-md-6">
							<div class="form-group">
								<label>Bank Name *</label>
								<input type="text" class="form-control" name="bank_name">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account Name *</label>
								<input type="text" class="form-control" name="account_name">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Branch Code *</label>
								<input type="text" class="form-control" name="branch_code">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account Number *</label>
								<input type="text" class="form-control" name="account_number">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account Type *</label>
								<input type="text" class="form-control" name="account_type">
							</div>
						</div>

					</div>
					<h5><u>My Auditting Areas</u></h5>
					<div class="row">
					<div class="col-md-12">
                      <div class="">
                       <div id="">
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
                                      <tr>    
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      </tr>
                                       </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Province *</label>
								<?php
								echo form_dropdown('disability', $disability, '',['class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?>
								</div>
								<div class="col-md-4">
									<button type="submit" name="add_area" class="btn btn-block btn-primary btn-rounded">Add Area</button>
								</div>
						</div>
					</div>
					
				</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function(){
		datepicker('.dob');
		fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".document_file", "./assets/uploads/temp/"], ['.document', '.document_image', '<?php echo base_url()."assets/uploads/temp"; ?>']);
	})
</script>

