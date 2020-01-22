<?php
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
		<h4 class="text-themecolor">Plumber register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumber register</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="mt-4 form" action="" method="post">
					<h4 class="card-title">Registered Plumber Details</h4>

	                	<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title *</label>
                                	<?php
                                    echo form_dropdown('title', $titlesign, '',['id'=>'title','class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Date of Birth *</label>
                                    <input type="text" class="form-control date_of_birth">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name *</label>
                                	<input type="text" class="form-control">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Surname *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Gender *</label>
                                	<?php
                                    echo form_dropdown('gender', $gender, '',['id'=>'gender','class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Racial Status *</label>
                                	<?php
                                    echo form_dropdown('racialstatus', $racial, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">South African National *</label>
                                	<?php
                                    echo form_dropdown('southafricannational', $yesno, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">ID Number</label>
                                	<input type="text" class="form-control">
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Other Nationality *</label>
                                	<input type="text" class="form-control">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alternate ID</label>
                                	<input type="text" class="form-control">
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Home Language *</label>
                                	<?php
                                    echo form_dropdown('homelanguage', $homelanguage, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Disability *</label>
                                	<?php
                                    echo form_dropdown('disability', $disability, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Citizen Residential Status *</label>
                                	<?php
                                    echo form_dropdown('citizenresidentialstatus', $citizen, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                        </div>

                        <h4 class="card-title">Registration Card</h4>
                        <h6 class="card-subtitle">Due to the high number of card returns and cost incurred the registration fees do not include a registration card. Registration cards are available but must be requested separately.  If registration card is selected you will be billed accordingly.</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Registration Card Required *</label>
                                	<?php
                                    echo form_dropdown('registration', $yesno, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Method of Delivery of Card *</label>
                                	<?php
                                    echo form_dropdown('method', $deliverycard, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Physical Address</h4>
                                <div class="form-group">
                                    <label class="control-label">Physical Address *</label>
                                	<input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">Postal Address</h4>
                                <div class="form-group">
                                    <label class="control-label">Postal Address *</label>
                                	<input type="text" class="form-control">
                            	</div>
                        	</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Suburb *</label>
                                	<?php
                                    echo form_dropdown('suburb', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Suburb *</label>
                                	<?php
                                    echo form_dropdown('suburb', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City *</label>
                                	<?php
                                    echo form_dropdown('city', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City *</label>
                                	<?php
                                    echo form_dropdown('city', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Province *</label>
                                	<?php
                                    echo form_dropdown('province', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Province *</label>
                                	<?php
                                    echo form_dropdown('province', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Postal Code *</label>
                                	<?php
                                    echo form_dropdown('postalcode', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Home Phone:</label>
                                	<input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile Phone *</label>
                                	<input type="text" class="form-control">
                            	</div>
                        	</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Work Phone:</label>
                                	<input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email Address *</label>
                                	<input type="text" class="form-control">
                            	</div>
                        	</div>
                        </div>
                        <h4 class="card-title">Billing Details</h4>
                        <h6 class="card-subtitle">All invocies genreated will used this billing information.</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Billing Name *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Company Reg Number</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Company Vat</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Billing Address *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Suburb *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Province *</label>
                                    <?php
                                    echo form_dropdown('province', $empty_arr, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Postal Code *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                            	<h4 class="card-title">Employment Details</h4>
                                <div class="form-group">
                                    <label class="control-label">Your Employment Status</label>
                                    <?php
                                    echo form_dropdown('employment_status', $employmentdetail, '',['class'=>'form-control']);
                                    ?>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
	                        <div class="col-md-6">
	                            	<h4 class="card-title">Company Details</h4>
	                                <div class="form-group">
	                                    <label class="control-label">Company</label>
	                                    <?php
	                                    echo form_dropdown('company', $empty_arr, '',['class'=>'form-control']);
	                                    ?>
	                                </div>
	                        </div>
                    	</div>

                    	<h4 class="card-title">Designation</h4>
                    	<h6 class="card-subtitle">Applications for Master Plumber and or specialisations can only be done once your registration has been verified and approved. See Application for further designations/specializations</h6>
                    	<h6 class="card-subtitle">Please select the relevant designation being applied for.</h6>                    	

						<div class="row">
							<div class="col-md-12 text-right">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit Application</button>
							</div>
						</div>
				</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
	datepicker('.date_of_birth');
})
</script>
