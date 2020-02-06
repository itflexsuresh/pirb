<?php

	$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
	$usersplumberid 		= isset($result['usersplumberid']) ? $result['usersplumberid'] : '';
	
	$titleid 				= isset($result['title']) ? $result['title'] : '';
	$dob 					= isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
	$registered_date 		= isset($result['registered_date']) && $result['registered_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['registered_date'])) : '';

	$renewal_date 			= isset($result['registered_date']) && $result['registered_date']!='1970-01-01' ? date('d-m-Y', strtotime(date("Y-m-d", strtotime($result['registered_date'])) . " + 1 year")) : '';
	$name 					= isset($result['name']) ? $result['name'] : '';
	// $name 					= isset($result['status']) ? $result['status'] : '';
	$surname 				= isset($result['surname']) ? $result['surname'] : '';
	$genderid 				= isset($result['gender']) ? $result['gender'] : '';
	$racialid 				= isset($result['racial']) ? $result['racial'] : '';
	$nationality 			= isset($result['nationality']) ? $result['nationality'] : '';
	$idcard 				= isset($result['idcard']) ? $result['idcard'] : '';
	$othernationalityid		= isset($result['othernationality']) ? $result['othernationality'] : '';
	$otheridcard 			= isset($result['otheridcard']) ? $result['otheridcard'] : '';
	$homelanguageid 		= isset($result['homelanguage']) ? $result['homelanguage'] : '';
	$disabilityid 			= isset($result['disability']) ? $result['disability'] : '';
	$citizenid 				= isset($result['citizen']) ? $result['citizen'] : '';
	$file1 					= isset($result['file1']) ? $result['file1'] : '';
	$file2 					= isset($result['file2']) ? $result['file2'] : '';
	$registrationcard 		= isset($result['registration_card']) ? $result['registration_card'] : '';
	$deliverycardid 		= isset($result['delivery_card']) ? $result['delivery_card'] : '';
	$homephone 				= isset($result['home_phone']) ? $result['home_phone'] : '';
	$mobilephone 			= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';
	$workphone 				= isset($result['work_phone']) ? $result['work_phone'] : '';
	$email 					= isset($result['email']) ? $result['email'] : '';
	$companyname 			= isset($result['company_name']) ? $result['company_name'] : '';
	$regno 					= isset($result['reg_no']) ? $result['reg_no'] : '';
	$vatno 					= isset($result['vat_no']) ? $result['vat_no'] : '';
	$employmentdetailsid	= isset($result['employment_details']) ? $result['employment_details'] : '';
	$companydetailsid		= isset($result['company_details']) ? $result['company_details'] : '';
	$designation			= isset($result['designation']) ? $result['designation'] : '';
	$message				= isset($result['message']) ? $result['message'] : '';
	$status					= isset($result['status']) ? $result['status'] : '';
	$application_status_id	= isset($result['application_status']) ? $result['application_status'] : '';
	$specialisations_id		= isset($result['specialisations']) ? $result['specialisations'] : '';
	$reject_reason_id		= isset($result['reject_reason']) ? $result['reject_reason'] : '';
	$reject_reason_other	= isset($result['reject_reason_other']) ? $result['reject_reason_other'] : '';
	$coc_purchase_limit		= isset($result['coc_purchase_limit']) ? $result['coc_purchase_limit'] : '';
	$electronic_coc_log		= isset($result['electronic_coc_log']) && $result['electronic_coc_log']==1 ? 'checked' : '';

	
	$physicaladdress 		= isset($result['physicaladdress']) ? explode('@-@', $result['physicaladdress']) : [];
	$addressid1 			= isset($physicaladdress[0]) ? $physicaladdress[0] : '';
	$address1				= isset($physicaladdress[2]) ? $physicaladdress[2] : '';
	$suburb1 				= isset($physicaladdress[3]) ? $physicaladdress[3] : '';
	$city1 					= isset($physicaladdress[4]) ? $physicaladdress[4] : '';
	$province1 				= isset($physicaladdress[5]) ? $physicaladdress[5] : '';
	$postalcode1 			= isset($physicaladdress[6]) ? $physicaladdress[6] : '';
	
	$postaladdress 			= isset($result['postaladdress']) ? explode('@-@', $result['postaladdress']) : [];
	$addressid2 			= isset($postaladdress[0]) ? $postaladdress[0] : '';
	$address2				= isset($postaladdress[2]) ? $postaladdress[2] : '';
	$suburb2 				= isset($postaladdress[3]) ? $postaladdress[3] : '';
	$city2 					= isset($postaladdress[4]) ? $postaladdress[4] : '';
	$province2 				= isset($postaladdress[5]) ? $postaladdress[5] : '';
	$postalcode2 			= isset($postaladdress[6]) ? $postaladdress[6] : '';
	
	$billingaddress 		= isset($result['billingaddress']) ? explode('@-@', $result['billingaddress']) : [];
	$addressid3 			= isset($billingaddress[0]) ? $billingaddress[0] : '';
	$address3				= isset($billingaddress[2]) ? $billingaddress[2] : '';
	$suburb3 				= isset($billingaddress[3]) ? $billingaddress[3] : '';
	$city3 					= isset($billingaddress[4]) ? $billingaddress[4] : '';
	$province3 				= isset($billingaddress[5]) ? $billingaddress[5] : '';
	$postalcode3 			= isset($billingaddress[6]) ? $billingaddress[6] : '';

	$skills 				= isset($result['skills']) ? array_filter(explode('@-@', $result['skills'])) : [];


	$filepath				= base_url().'assets/uploads/plumber/'.$id.'/';

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumbers Registration Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumbers Registration Details</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<?php
				if($status=='0'){
			?>
			<div class="card-body">
				<h4 class="card-title">Application Status</h4>
				<div class="row">

					<div class="col-md-6">
						<form method="post" id="application_status">
						<input type="hidden" value="<?php echo $id; ?>" name="user_id">
						<div class="form-group app_checkbox">
							<?php
							$application_status_id_arr = explode(',', $application_status_id);


							foreach($application_status as $key=>$val){
								$name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $val)));
								if(in_array($key,$application_status_id_arr)){
									$checked = 'checked';
								} else {
									$checked = '';
								}
								if($key%2==1){						
									echo "<div class='row'>";
								}
							?>
							<div class="col-md-6">
		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="<?php echo $name; ?>" name="application_status[<?php echo $key ?>]" <?php echo $checked; ?>>
		                            <label class="custom-control-label" for="<?php echo $name; ?>"><?php echo $val; ?></label>
		                        </div>
		                    </div>
							<?php
								if($key%2==0 || end($application_status)==$val){						
									echo "</div>";
								}
								$key++;
							}
							?>
	                                    
	                    </div>
	                    <div class="form-group">
		                    <div class="row">
		                    		<div class="col-md-6">
			                    		<label>Approval Status *</label>
			                    	</div>
		                    		<div class="col-md-3 approve_box">
					                    <div class="custom-control custom-radio">
					                        <input type="radio" id="approve" name="status" class="custom-control-input" value="3" <?php 
    echo $status == '3' ? "checked" : ""; ?>>
					                        <label class="custom-control-label" for="approve">Approve</label>
					                    </div>
				                    </div>
		                    		<div class="col-md-3">
					                    <div class="custom-control custom-radio">
					                        <input type="radio" id="reject" name="status" class="custom-control-input" value="2" <?php 
    echo $status == '2' ? "checked" : ""; ?>>
					                        <label class="custom-control-label" for="reject">Reject</label>
					                    </div>
				                    </div>
		                    </div>
	                    </div>
	                    <div class="form-group reject_box">
		                    <div class="row">
		                    		<div class="col-md-6">
			                    		<label>Reason for Rejection</label>
			                    	</div>
		                    		<div class="col-md-6">
		                    			<?php
		                    			$reject_reason_id_arr = explode(',', $reject_reason_id);
		                    			foreach ($reject_reason as $key => $value) {
		                    				$name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $value)));
											if(in_array($key,$reject_reason_id_arr)){
												$checked = 'checked';
											} else {
												$checked = '';
											}
											echo "<div class='custom-control custom-checkbox'>
					                            <input type='checkbox' class='custom-control-input' id='$name' name='reject_reason[$key]' $checked>
					                            <label class='custom-control-label' for='$name'>$value</label>
					                        </div>";
		                    			}
		                    			?>
					                    <!-- <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="no_supporting_evidence">
				                            <label class="custom-control-label" for="no_supporting_evidence">No Supporting Evidence</label>
				                        </div>
				                        <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="cannot_verifiy">
				                            <label class="custom-control-label" for="cannot_verifiy">Cannot Verifiy Qualification/Certificates</label>
				                        </div>
				                        <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="no_payment">
				                            <label class="custom-control-label" for="no_payment">No Payment Recieved</label>
				                        </div>
				                        <div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="other">
				                            <label class="custom-control-label" for="other">Other</label>
				                        </div> -->
				                        <div class="form-group">
											<input type="text" class="form-control" placeholder="If Other specify" name="reject_reason_other" value="<?php echo $reject_reason_other; ?>">		
										</div>
				                    </div>
		                    </div>
	                    </div>
	                    <div class="form-group">
	                    	<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">
							<input type="hidden" name="usersplumberid" id="usersplumberid" value="<?php echo $usersplumberid; ?>">
							<input type="hidden" value="<?php echo $id; ?>" name="user_id">							
							<input type="submit" name="submit" value="submit" class="btn btn-primary">
	                    </div>
	                	</form>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Comments</label>
							<?php

							$comments_merge = '';
							foreach($comments_result as $key=>$value){
								$comment_date	= isset($value['created_at']) && $value['created_at']!='1970-01-01' ? date('d-m-Y', strtotime($value['created_at'])) : '';
								$comments_merge .= $comment_date.' - Admin : '.trim($value['comments']).PHP_EOL;
							}
							?>
							<textarea class="form-control" rows="5"><?php echo $comments_merge; ?></textarea>
						</div>
						<form method="post" class="comments_section">
							<input type="hidden" value="<?php echo $id; ?>" name="user_id">
							<div class="form-group">
								<div class="row">
									<input type="text" class="form-control" name="comments" placeholder="Type your comments here">
								</div>
								<div class="text-right">
									<button type="submit" name="submit" value="submit" class="btn btn-primary">Add comment</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php } ?>
				<form class="mt-4 form plumber" action="" method="post">				
				<div class="col-md-12">
					<h4 class="card-title">Plumber register</h4>
				
					<div class="row">
						<div class="col-md-12 add_full_width">
							<div class="form-group">
								<label>Registration Number</label>
								<input type="text" class="form-control" name="reg_no" value="<?php echo $id; ?>" disabled>								
							</div>
						</div>
					</div>

					<?php 
					if($status=='1' || $status=='3'){
					?>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>First Registration Date</label>
								<input type="text" class="form-control first_reg_date" value="<?php echo $registered_date; ?>" disabled>						
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Next Renewal Date</label>
								<input type="text" class="form-control next_renewal_date" value="<?php echo $renewal_date; ?>" disabled>			
							</div>
						</div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<?php
									echo form_dropdown('status', $plumberstatus, '', ['class'=>'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>PIRB Designation</label>
								<?php
									echo form_dropdown('designation', $designation2, $designation, ['class'=>'form-control','id'=>'designation']);
								?>
							</div>
						</div>
					</div>
					<div class="form-group row specialisation_section">
							<div class="col-md-12">
								<label>PIRB Specialisations:</label>
							</div>
							<?php
							$specialisations_id_arr = explode(',', $specialisations_id);
							foreach ($specialisations as $key => $value) {
								$name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $value)));
								if(in_array($key,$specialisations_id_arr)){
									$checked = 'checked';
								} else {
									$checked = '';
								}
								echo "<div class='col-md-4'>
			                            <div class='custom-control custom-checkbox'>
			                                <input type='checkbox' class='custom-control-input' name='specialisations[$key]' id='$name' $checked>
			                                <label class='custom-control-label' for='$name'>- $value</label>
			                            </div>
		                            </div>";
							}
							?>
                    </div>
                    <div class="form-group row">
						<div class="col-md-6">
							<label>Number of CoC's Able to purchase:</label>
                    		<input type="number" class="form-control" name="coc_purchase_limit" value="<?php echo $coc_purchase_limit ?>">
						</div>
						<div class="col-md-6 mt_40">
							<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="electronic_coc_log" name="electronic_coc_log" <?php echo $electronic_coc_log ?> value="1">
                                <label class="custom-control-label" for="electronic_coc_log">Allow for Electronic COC's loging</label>
                            </div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<label>Specific Message to Plumber</label>
							<textarea class="form-control" rows="5" name="message"><?php echo $message; ?></textarea>
						</div>
					</div>


					<div class="row add_top_value">
						<div class="col-md-6">	
							<table id="id_Card">
								<tbody>
									<tr>
										<td>
											<img class="id_logo" src="<?php echo base_url();?>assets/images/pitrb-logo.png">
											<p>Reg No: 7077/16</p>
											<p>Renewal Date: 07/08/2020</p>
										</td>
										<td>
											<img class="id_admin" src="<?php echo base_url();?>assets/images/profile.jpg">
											<p>Admin Name</p>
										</td>
									</tr>
									<tr style="background-color: #E4010C">
										<td>
											<img class="plum_lic" src="<?php echo base_url()?>assets/images/Plumber_License.png">
										</td>
										<td>
											<p class="license">Licensed Plumber</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-md-6">
							<table id="id_Card_back">
									<tbody style="width: 90%; display: inline-block;">
										<tr>
											<td colspan="2">
												<p>This card holder is only entitled to purchase and issue Plumbing COC’s for the following categories of plumbing and plumbing specialisations</p>
											</td>
										</tr>
										<tr>
											<td>
												<ul>
													<li>Above Ground Drainage</li>
													<li>Below Ground Drainage</li>
													<li>Rain Water Drainage</li>
												</ul>
											</td>
											<td>
												<ul>
													<li>Cold Water</li>
													<li>Hot Water</li>
												</ul>
											</td>
										</tr>
										<tr style="border-top: 1px solid #000;">
											<td style="border-right: 1px solid #000; height: 92px;">
												<span>Current Employer: </span> <p class="plumber_name">C.W. Plumbers</p>
											</td>
											<td>
												<p>Specialisations</p>
											</td>
										</tr>
									</tbody>
									<tbody style="width: 10%; display: inline-block;">
										<tr style="height: 266px;">
											<td colspan="2" style="text-align: center; padding: 0px;  background-color: #e4010c; color: #fff;">
												<p class="back_license" style="transform: rotate(-90deg);margin: -66px;">Licensed Plumber</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
					</div>


					<div class="accordion add_top_value" id="accordionExample">
					  <div class="card">
					    <div class="card-header" id="headingOne">
					      <h2 class="mb-0">
					        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Personal Details
					        </button>
					      </h2>
					    </div>

					    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					      <div class="card-body">
					        <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Title *</label>
										<?php
											echo form_dropdown('title', $titlesign, $titleid, ['id'=>'title', 'class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Date of Birth *</label>
										<input type="text" class="form-control dob" name="dob" value="<?php echo $dob; ?>">
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name *</label>
									<input type="text" class="form-control"  name="name"  value="<?php echo $name; ?>">
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Surname *</label>
									<input type="text" class="form-control"  name="surname"  value="<?php echo $surname; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<?php
										echo form_dropdown('gender', $gender, $genderid, ['id'=>'gender', 'class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Racial Status *</label>
									<?php
										echo form_dropdown('racial', $racial, $racialid,['class'=>'form-control']);
									?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>South African National *</label>
									<?php
										echo form_dropdown('nationality', $yesno, $nationality,['class'=>'form-control','id'=>'nationality']);
									?>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ID Number</label>
									<input type="text" class="form-control" name="idcard" value="<?php echo $idcard; ?>">
									</div>
							</div>
						</div>
						<div class="row othernationalityidcardbox">
							<div class="col-md-6">
								<div class="form-group">
									<label>Other Nationality *</label>
									<?php
										echo form_dropdown('othernationality', $othernationality, $othernationalityid,['class'=>'form-control']);
									?>
									<!-- <input type="text" class="form-control" name="othernationality" value="<?php //echo $othernationality; ?>"> -->
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Alternate ID</label>
									<input type="text" class="form-control" name="otheridcard" value="<?php echo $otheridcard; ?>">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Home Language *</label>
									<?php
										echo form_dropdown('homelanguage', $homelanguage, $homelanguageid, ['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Disability *</label>
									<?php
									echo form_dropdown('disability', $disability, $disabilityid,['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Citizen Residential Status *</label>
									<?php
									echo form_dropdown('citizen', $citizen, $citizenid,['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title">Photo ID *</h4>
								<div class="form-group">
									<div class="photo_upload">
										<img src="<?php echo ($file2!='') ? $filepath.$file2 : base_url().'assets/images/profile.jpg'; ?>" class="photo_image" width="100">
									</div>
									<input type="file" class="photo_file">
									<input type="hidden" name="image2" class="photo" value="<?php echo $file2; ?>">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
						</div>

						<h4 class="card-title">Registration Card</h4>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Registration Card Required *</label>
									<?php
									echo form_dropdown('registration_card', $yesno, $registrationcard,['class'=>'form-control']);
									?>
									</div>
							</div>
							<div class="col-md-6 deliverycardbox">
								<div class="form-group">
									<label>Method of Delivery of Card *</label>
									<?php
									echo form_dropdown('delivery_card', $deliverycard, $deliverycardid,['class'=>'form-control']);
									?>
									</div>
							</div>
						</div>
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingTwo">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          Plumbers Contact Details
					        </button>
					      </h2>
					    </div>
					    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					      <div class="card-body">
					        <div class="row">
								<div class="col-md-6">
									<h4 class="card-title">Physical Address</h4>
									<p class="tagline">Note all delivery services will be sent to this address</p>
									<div class="form-group">
										<label>Physical Address *</label>
										<input type="hidden" class="form-control" name="address[1][id]" value="<?php echo $addressid1; ?>">
										<input type="hidden" class="form-control" name="address[1][type]" value="1">
										<input type="text" class="form-control" name="address[1][address]"  value="<?php echo $address1; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<h4 class="card-title">Postal Address</h4>
									<p class="tagline">Note all postal services will be sent to this address</p>
									<div class="form-group">
										<label>Postal Address *</label>
										<input type="hidden" class="form-control" name="address[2][id]" value="<?php echo $addressid2; ?>">
										<input type="hidden" class="form-control" name="address[2][type]" value="2">
										<input type="text" class="form-control" name="address[2][address]" value="<?php echo $address2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<input type="text" class="form-control" name="address[1][suburb]" value="<?php echo $suburb1; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Suburb *</label>
										<input type="text" class="form-control" name="address[2][suburb]" value="<?php echo $suburb2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<input type="text" class="form-control" name="address[1][city]" value="<?php echo $city1; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>City *</label>
										<input type="text" class="form-control" name="address[2][city]" value="<?php echo $city2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Province *</label>
										<?php
										echo form_dropdown('address[1][province]', $province, $province1,['class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Province *</label>
										<?php
										echo form_dropdown('address[2][province]', $province, $province2,['class'=>'form-control']);
										?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Postal Code *</label>
										<input type="text" class="form-control" name="address[2][postal_code]" value="<?php echo $postalcode2; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Home Phone:</label>
										<input type="text" class="form-control" name="home_phone" value="<?php echo $homephone; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Mobile Phone *</label>
										<input type="text" class="form-control" name="mobile_phone" value="<?php echo $mobilephone; ?>">
										<p>Note all SMS and OTP notifications will be sent to this mobile number above</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Work Phone:</label>
										<input type="text" class="form-control" name="work_phone" value="<?php echo $workphone; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email Address *</label>
										<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
										<p>Note: this email will be used as your user profile name and all emails notifications will be sent to it</p>
									</div>
								</div>
							</div>
					      </div>
					    </div>
					  </div>
					  <div class="card">
					  	<div class="card-header" id="billing">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#billing" aria-expanded="false" aria-controls="collapsebilling">
					          Plumbers Billing Details
					        </button>
					      </h2>
					    </div>
					    <div id="billing" class="collapse" aria-labelledby="billing" data-parent="#accordionExample">
					      	<div class="card-body">
					      		<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Billing Name *</label>
									<input type="text" class="form-control" name="company_name" value="<?php echo $companyname; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Company Reg Number</label>
									<input type="text" class="form-control" name="reg_no" value="<?php echo $regno; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Company Vat</label>
									<input type="text" class="form-control" name="vat_no" value="<?php echo $vatno; ?>">
								</div>
							</div>                            
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Billing Address *</label>
									<input type="hidden" class="form-control" name="address[3][id]" value="<?php echo $addressid3; ?>">
									<input type="hidden" class="form-control" name="address[3][type]" value="3">
									<input type="text" class="form-control" name="address[3][address]" value="<?php echo $address3; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Suburb *</label>
									<input type="text" class="form-control" name="address[3][suburb]" value="<?php echo $suburb3; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>City *</label>
									<input type="text" class="form-control" name="address[3][city]" value="<?php echo $city3; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Province *</label>
									<?php
									echo form_dropdown('address[3][province]', $province, $province3,['class'=>'form-control']);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code *</label>
									<input type="text" class="form-control" name="address[3][postal_code]" value="<?php echo $postalcode3; ?>">
								</div>
							</div>
						</div>
				      		</div>
				      	</div>
					  </div>	
					  <div class="card">
					    <div class="card-header" id="headingThree">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          Plumbers Employment Details
					        </button>
					      </h2>
					    </div>
					    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					      <div class="card-body">
					        <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Your Employment Status</label>
										<?php
										echo form_dropdown('employment_details', $employmentdetail, $employmentdetailsid,['class'=>'form-control', 'id' => 'employment_details']);
										?>
									</div>
								</div>
								<div class="col-md-6 companydetailsbox">
									<div class="form-group">
										<label>Company</label>
										<?php
										echo form_dropdown('company_details', $company, $companydetailsid,['class'=>'form-control']);
										?>
									</div>
								</div>
							</div>
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingFour">
					      <h2 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
					          Plumbers Qualification/Certificate Details
					        </button>
					      </h2>
					    </div>
					    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
					      <div class="card-body">
					      	<div class="row designationattachment ">
						        <h4 class="card-title">Attachements</h4>
								<p>Please Attach ALL your relevant trade certificates, course certificates, evidence that supports your registration application:</p>
								<table class="table table-bordered skilltable">
									<tr>
										<td>Date of Qualification/Skill Obtained</td>
										<td>Certificate Number</td>
										<td>Qualification Route</td>
										<td>Training Provider</td>
										<td>Attachement</td>
										<td>Action</td>
									</tr>
									<tr class="skillnotfound"><td colspan="6">No Record Found</td></tr>

								</table>
								<div class="text-right">
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#skillmodal">Add Cert/Skill</button>
								</div>
								<input type="hidden" class="attachmenthidden" name="attachmenthidden"> 
							</div>
					      </div>
					    </div>
					  </div>
					</div>
				</div>	
				<div class="col-md-12 text-right">
					<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">
					<input type="hidden" name="usersplumberid" id="usersplumberid" value="<?php echo $usersplumberid; ?>">
					<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">
				</div>				
				</form>
			</div>
		</div>
	</div>
</div>

<div id="skillmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="skillform">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add a Qualification/Skill</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label>Date of Qualification/Skill Obtained</label>
									<div class="input-group">
										<input type="text" class="form-control skill_date" name="skill_date" data-date='datepicker'>
										<div class="input-group-append">
											<span class="input-group-text"><i class="icon-calender"></i></span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label>Certificate Number</label>
									<input type="text" class="form-control skill_certificate" name="skill_certificate">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Qualification/Skills Route</label>
								<?php
								echo form_dropdown('skill_route', $qualificationroute, '', ['class'=>'form-control skill_route']);
								?>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Training Provider</label>
								<input name="skill_training" type="text" class="form-control skill_training">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="skill_attachment_image" width="100">
								</div>
								<input type="file" class="skill_attachment_file">
								<input type="hidden" name="skill_attachment" class="skill_attachment">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="skill_id" class="skill_id">
					<input type="hidden" name="user_id" class="user_id" value="<?php echo $id; ?>">
					<button type="button" class="btn btn-success skillsubmit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

var filepath = '<?php echo $filepath; ?>';

$(function(){
	// $('#headingTwo').click();
	// $('#headingTwo').trigger('click');
	datepicker('.first_reg_date');	
	datepicker('.next_renewal_date');
	datepicker('.skill_date');
	datepicker('.dob');
	fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".photo_file", "./assets/uploads/plumber/<?php echo $id; ?>/",['jpg','gif','jpeg','png','pdf','tiff']], ['.photo', '.photo_image', '<?php echo base_url()."assets/uploads/plumber/".$id; ?>', '<?php echo base_url()."assets/images/pdf.png"?>']);
	fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".skill_attachment_file", "./assets/uploads/plumber/<?php echo $id; ?>/",['jpg','gif','jpeg','png','pdf','tiff']], ['.skill_attachment', '.skill_attachment_image', '<?php echo base_url()."assets/uploads/plumber/".$id; ?>', '<?php echo base_url()."assets/images/pdf.png"?>']);
	
	var nationality = '<?php echo $nationality; ?>';
	othernationalityidcardbox(nationality);
	
	var registrationcard = '<?php echo $registrationcard; ?>';
	deliverycardbox(registrationcard);
	
	var employmentdetails = '<?php echo $employmentdetailsid; ?>';
	companydetailsbox(employmentdetails);

	// var designationid = '<?php //	echo $designationid; ?>';
	// if(designationid!='') $('input[name="designation"][value="'+designationid+'"]').prop('checked', true);
	// designationattachment(designationid);

	var skill = $.parseJSON('<?php echo json_encode($skills); ?>');
	if(skill.length > 0){
		$(skill).each(function(i, v){
			var skillsplit 	= v.split('@@@');
			var skilldata 	= {status : 1, result : { id: skillsplit[0], date: skillsplit[2], certificate: skillsplit[3], skillname: skillsplit[7], training: skillsplit[5], attachment: skillsplit[6] }}
			skills(skilldata);
		})
	}

	validation(
		'.plumber',
		{
			title : {
				required	: true,
			},
			dob : {
				required	: true,
			},
			name : {
				required	: true,
			},
			surname : {
				required	: true,
			},
			gender : {
				required	: true,
			},
			racial : {
				required	: true,
			},
			nationality : {
				required	: true,
			},
			othernationality : {
				required:  	function() {
								if($('#nationality').val() == "2"){
									return true;
								}else{
									return false;
								}
							}
			},
			otheridcard 	: {
				required:  	function() {
								if($('#nationality').val() == "2"){
									return true;
								}else{
									return false;
								}
							}
			},
			homelanguage : {
				required	: true,
			},
			disability : {
				required	: true,
			},
			citizen : {
				required	: true,
			},
			image2 : {
				required	: true,
			},
			registration_card : {
				required	: true,
			},
			delivery_card : {
				required:  	function() {
								if($('#registration_card').val() == "1"){
									return true;
								}else{
									return false;
								}
							}
			},
			'address[1][address]' : {
				required	: true,
			},
			'address[2][address]' : {
				required	: true,
			},
			'address[1][city]' : {
				required	: true,
			},
			'address[2][city]' : {
				required	: true,
			},
			'address[1][province]' : {
				required	: true,
			},
			'address[2][province]' : {
				required	: true,
			},
			'address[2][postal_code]' : {
				required	: true,
			},
			mobile_phone : {
				required	: true,
				maxlength: 20,
				minlength: 10,
			},
			email : {
				required	: true,
				email		: true,
				remote		: 	{
									url	: "<?php echo base_url().'authentication/login/emailvalidation'; ?>",
									type: "post",
									async: false,
									data: {
										email: function() {
											return $( "#email" ).val();
										},
										id : '<?php echo $id; ?>'
									}
								}
			},
			home_phone : {
				maxlength: 20,
				minlength: 10,
			},
			company_name : {
				required	: true,
			},
			'address[3][address]' : {
				required	: true,
			},
			'address[3][suburb]' : {
				required	: true,
			},
			'address[3][city]' : {
				required	: true,
			},
			'address[3][province]' : {
				required	: true,
			},
			'address[3][postal_code]' : {
				required	: true,
				number 	: true
			}
		},
		{
			title : {
				required	: "Tittle field is required.",
			},
			name 	: {
				required	: "Name field is required."
			},
			dob : {
				required	: "DOB field is required.",
			},
			surname : {
				required	: "Surname field is required.",
			},
			gender : {
				required	: "Gender field is required.",
			},
			racial : {
				required	: "Racial field is required.",
			},
			nationality : {
				required	: "nationality field is required.",
			},
			othernationality : {
				required	: "Other nationality field is required.",
			},
			otheridcard : {
				required	: "Alternate ID Card  field is required.",
			},
			homelanguage : {
				required	: "Homelanguage field is required.",
			},
			disability : {
				required	: "Disability field is required.",
			},
			citizen : {
				required	: "Citizen field is required.",
			},
			image1 : {
				required	: "Identity Document field is required.",
			},
			registration_card : {
				required	: "Registration Card field is required.",
			},
			delivery_card : {
				required	: "Delivery_card field is required.",
			},
			'address[1][address]' : {
				required	: "Physical Address  field is required.",
			},
			'address[2][address]' : {
				required	: "Postal Address  field is required.",
			},
			'address[2][city]' : {
				required	: "Physical City  field is required.",
			},
			'address[2][city]' : {
				required	: "Postal City field is required.",
			},
			'address[1][province]' : {
				required	: "Physical Province field is required.",
			},
			'address[2][province]' : {
				required	: "Postal Province field is required.",
			},
			'address[2][postal_code]' : {
				required	: "Postal code field is required.",
			},
			mobile_phone : {
				required	: "Mobile phone field is required.",
				maxlength: "Please Enter 20 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			},
			email : {
				required: "Email field is required.",
				required: "Email field already exists.",
			},
			home_phone : {
				maxlength: "Please Enter 20 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			},
			company_name 	: {
				required	: "Billing name field is required.",
			},
			'address[3][address]' 	: {
				required	: "Address field is required.",
			},
			'address[3][suburb]' 	: {
				required	: "Suburb field is required.",
			},
			'address[3][city]' 	: {
				required	: "City field is required.",
			},
			'address[3][province]' 	: {
				required	: "province field is required.",
			},
			'address[3][postal_code]' 	: {
				required	: "Postal Code field is required.",
				number 	: "Numbers Only",
			}
		},
		{
			ignore : '.test',
		}
	);

	validation(
		'.skillform',
		{
			skill_date : {
				required	: true,
			},
			skill_certificate : {
				required	: true,
			},
			skill_route : {
				required	: true,
			},
			skill_training : {
				required	: true,
			},
			skill_attachment : {
				required	: true,
			}
		},
		{
			skill_date 	: {
				required	: "Please Enter Skill Date.",
			},
			skill_certificate 	: {
				required	: "Please Enter Skill certificate Number.",
			},
			skill_route : {
				required	: "Please Enter Employment Status.",
			},
			skill_training : {
				required	: "Please Enter Training Provider.",
			},
			skill_attachment : {
				required	: "Choose File Please",
			}
		}
	);

	validation(
		'.comments_section',
		{
			comments : {
				required	: true,
			}
		},
		{
			comments 	: {
				required	: "Please add comment.",
			}
		}
	);

	$('#submit').click(function(e){
		
		if($('form.plumber').valid()==false){
			accord = $('.error_class_1').parents('.collapse').addClass('show');
			// accord = $('.error_class_1').parents('.collapse').attr('aria-labelledby');
			// console.log(accord);
			// $('#'+accord).click();
		}
		
	})

	approve_show();
	$('.app_checkbox input[type="checkbox"]').change(function(){
		approve_show();
	});
	reject_show();
	$('.approve_box input[type="radio"]').change(function(){
		reject_show();
	});
	specialisation_show();
	$('#designation').change(function(){
		specialisation_show();
	});

});


$('#nationality').change(function(){
	othernationalityidcardbox($(this).val());
})

function othernationalityidcardbox(value){
	if(value=='2'){
		$('.othernationalityidcardbox').show();
	}else{
		$('.othernationalityidcardbox').hide();
	}
}

$('#registration_card').change(function(){
	deliverycardbox($(this).val());
})

function deliverycardbox(value){
	if(value=='1'){
		$('.deliverycardbox').show();
	}else{
		$('.deliverycardbox').hide();
	}
}

$('#employment_details').change(function(){
	companydetailsbox($(this).val());
})

function companydetailsbox(value){
	if(value=='1'){
		$('.companydetailsbox').show();
	}else{
		$('.companydetailsbox').hide();
	}
}

$('.designation').click(function(){
	designationattachment($(this).val());
})

function designationattachment(value){
	if(value=='4'){
		$('.designationattachment').removeClass('displaynone');
	}else{
		$('.designationattachment').addClass('displaynone');
	}	
}

$('#skillmodal').on('hidden.bs.modal', function () {
    skillsclear();
})

$('.skillsubmit').click(function(){
	if($('.skillform').valid())
	{
		var data = $('.skillform').serialize();
		ajax('<?php echo base_url()."/admin/plumber/index/ajaxskillaction"; ?>', data, skills);
	}
})

function skills(data){
	if(data.status==1){		
		var result 		= 	data.result; 
		$(document).find('.skillappend[data-id="'+result.id+'"]').remove();
		
		// var attachment	= 	(result.attachment!='') ? '<img src="'+filepath+(result.attachment)+'" width="50">' : '';
		var attachment	= 	(result.attachment!='') ? result.attachment : '';

		var appenddata 	= 	'\
								<tr class="skillappend" data-id="'+result.id+'">\
									<td>'+formatdate(result.date,1)+'</td>\
									<td>'+result.certificate+'</td>\
									<td>'+result.skillname+'</td>\
									<td>'+result.training+'</td>\
									<td>'+attachment+'</td>\
									<td>\
										<a href="javascript:void(0);" class="skilledit" data-id="'+result.id+'"><i class="fa fa-pencil-alt"></i></a>\
										<a href="javascript:void(0);" class="skillremove" data-id="'+result.id+'"><i class="fa fa-trash"></i></a>\
									</td>\
								</tr>\
							';
					
		$('.skilltable').append(appenddata);
	}
	
	$('#skillmodal').modal('hide');

	skillsextras();
}

$(document).on('click', '.skilledit', function(){
	ajax('<?php echo base_url()."/admin/plumber/index/ajaxskillaction"; ?>', {'skillid' : $(this).attr('data-id'), 'action' : 'edit'}, skillsedit);
})

function skillsedit(data){
	if(data.status==1){
		var result 	= 	data.result;
		
		$('.skill_date').val(formatdate(result.date, 1));
		$('.skill_certificate').val(result.certificate);
		$('.skill_route').val(result.skills);
		$('.skill_training').val(result.training);
		$('.skill_attachment').val(result.attachment);
		if(result.attachment!=''){
			var ext 		= result.attachment.split('.').pop().toLowerCase();
			if(ext=='jpg' || ext=='jpeg' || ext=='png'){
				$('.skill_attachment_image').attr('src', filepath+(result.attachment));	
			}else if(ext=='pdf'){
				$('.skill_attachment_image').attr('src', '<?php echo base_url()."assets/images/pdf.png"?>');	
			}
		}
		$('.skill_id').val(result.id);
		$('#skillmodal').modal('show');
	} 
}

$(document).on('click', '.skillremove', function(){
	ajax('<?php echo base_url()."/plumber/registration/index/ajaxskillaction"; ?>', {'skillid' : $(this).attr('data-id'), 'action' : 'delete'}, skillsremove);
	$(this).parent().parent().remove();
	
	skillsextras();
})

function skillsremove(data){}

function skillsclear(){
	$('form.skillform').find("input[type=text],input[type=hidden], textarea, select").val("");
	$('form.skillform').find("p.error_class_1").remove();
	$('form.skillform').find(".error_class_1").removeClass('error_class_1');
	// $('.skill_date, .skill_certificate, .skill_route, .skill_training, .skill_attachment').val('');
	$('.skill_attachment_image').attr("src", "<?php echo base_url().'assets/images/profile.jpg'; ?>");
}

function skillsextras(){
	if($(document).find('.skillappend').length){
		$('.skillnotfound').hide();
		$('.attachmenthidden').val('1');
	}else{
		$('.skillnotfound').show();
		$('.attachmenthidden').val('');
	}	
	
}

function approve_show(){
	app_checkbox = $('.app_checkbox input[type="checkbox"]');
	checkbox_len = app_checkbox.length;
	check_box_check_len = 0;
	app_checkbox.each(function(){
		if($(this).prop('checked')==true){
			check_box_check_len++;
		}
	});
	// console.log(check_box_check_len);
	// return false;

	// checkbox_check_len = $('.app_checkbox checkbox').is(":checked").length;
	// console.log(checkbox_len);
	// console.log(checkbox_check_len);

	if(checkbox_len==check_box_check_len){
		$('.approve_box').show();
	} else {
		$('.approve_box').hide();		
	}
}

function reject_show(){
	approve_radio = $('.approve_box input[type="radio"]');
	$('.reject_box').hide();
	if(approve_radio.is(':visible')==true){
		approve_status = $('.approve_box input[type="radio"]:checked').val();
		if(approve_status=='2'){
			$('.reject_box').show();
		} else {
			$('.reject_box').hide();		
		}
	}
}

function specialisation_show(){
	designation_val = $('#designation').val();
	if(designation_val=='4' || designation_val=='5' || designation_val=='6'){
		$('.specialisation_section').show();
	} else {
		$('.specialisation_section').hide();		
	}
}

</script>

<style type="text/css">
.progress-circle span {
    display: none;
}
</style>