<?php
if(isset($result) && $result)
{
$id = $result['id'];
// $id 			= isset($result['id']) ? $result['id'] : set_value ('id');
//$name  			= isset($result['name']) ? $result['name'] : set_value ('name');
$subject  		= isset($result['subject']) ? $result['subject'] : set_value ('subject');
$email  		= isset($result['email_body']) ? $result['email_body'] : set_value ('email_body');
$sms  			= isset($result['sms_body']) ? $result['sms_body'] : set_value ('sms_body');
$heading = 'Update';
} 
?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Notification and SMS Templates</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/communication/notification/index'; ?>">Notification and SMS Templates</a></li>
				<li class="breadcrumb-item active">Update Notification and SMS Templates</li>
			</ol>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
				<form class="form" method="post" enctype="multipart/form-data">

					
								
										<h4 class="card-title"><?php echo $result['name']; ?></h4>


										<p>Email Notice</p>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Subject</label>
															<input type="text" class="form-control"  name="subject" value="<?php echo $result['subject']; ?>">
														</div>
													</div>
													<div class="col-md-6">
															
														

															<input type="checkbox" name="email_notify" id="email_notification" value="1"  <?php echo ($result['email_active'] == '1') ? 'checked="checked"' : ''; ?>>
															<label>Email Active</label>

															<input type="checkbox" name="sms_notify" id="sms_notification" value="1" <?php echo ($result['sms_active'] == '1') ? 'checked="checked"' : ''; ?>>
															<label>SMS Active</label>
															
													</div>

												</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<textarea rows="10" cols="50" class="email_body" name="email_body"><?php echo $result['email_body']; ?></textarea>

																</div>	
															</div>
															
																<div class="col-md-6">
																	<label><b>SMS</b></label>
																		<div class="form-group">
																		
																		<textarea rows="10" cols="60" class="sms_body" name="sms_body"><?php echo $result['sms_body']; ?></textarea>
																	</div>
																</div>
															</div>
														</div>

													</div>
											
													<div class="col-md-6 text-right">
														<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
														<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
													</div>
													
													
													<div class="col-md-12 emailnotificationnotes">
														<h4>Allowed Meta Tag on this template: </h4>
														<?php echo $result['notes']; ?>
													</div>
												

											</form>

										</div>
									</div>
								</div>
							</div>		
							<script type="text/javascript">
								$(function(){
									editor('.email_body')
								})
							</script>