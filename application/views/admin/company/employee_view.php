<?php
if(!empty($employee)){
    $reg_no					= isset($employee[0]['registration_no']) ? $employee[0]['registration_no'] : '';
    $name 		            = isset($employee[0]['name']) ? $employee[0]['name'] : ''; 
    $surname 	            = isset($employee[0]['surname']) ? $employee[0]['surname'] : ''; 
    $status 				= isset($employee[0]['status']) ? $employee[0]['status'] : ''; 
    $email 				    = isset($employee[0]['email']) ? $employee[0]['email'] : '';
    $mobile_phone 		    = isset($employee[0]['mobile_phone']) ? $employee[0]['mobile_phone'] : '';
    $user_id 		        = isset($employee[0]['user_id']) ? $employee[0]['user_id'] : '';
    $file2 		            = isset($employee[0]['file2']) ? $employee[0]['file2'] : '';
    $specialisations 	    = isset($employee[0]['specialisations']) ? explode(',',$employee[0]['specialisations']) : '';


} 
?>
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Employee Details</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Registration Number</label>
							<input type="text" class="form-control" name=""  value="<?php echo $reg_no?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Plumbers Name and Surname</label>
							<input type="text" class="form-control" name=""  value="<?php echo  $name.' '.$surname?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone (Mobile)</label>
							<input type="text" class="form-control" name=""  value="<?php echo  $mobile_phone?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" name=""  value="<?php echo  $email?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Plumbers Image</label>
							<img src="<?php echo base_url().'/assets/uploads/plumber/'.$user_id.'/'.$file2; ?>" alt="" width="42" height="42">
						</div>
					</div>
				</div>
				<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<?php
									echo form_dropdown('status', ['' => 'Select Status']+$companystatus, "$status", ['id'=>'companystatus', 'class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>PIRB Designation:</label>
							<input type="text" class="form-control" name=""  value="">
						</div>
					</div>
				</div>
				<div class="col-md-6">
							<h4 class="card-title">Specilisations</h4>
							<div class="col-md-6">
							<?php foreach ($specialization as $key => $value) { 
								?>
								<input type="checkbox" name="specilisations[]" value="<?php echo $key ?>"<?php echo (in_array($key, $specialisations)) ? 'checked="checked"' : ''; ?>> <?php echo $value ?><br>
							<?php }; ?>
								
							</div>
						</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Number of Logged COC's:</label>
							<input type="text" class="form-control" name=""  value="">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Number Audits Done to Date:</label>
							<input type="text" class="form-control" name=""  value="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label></label>
							<input type="text" class="form-control" name=""  value="">
						</div>
					</div>