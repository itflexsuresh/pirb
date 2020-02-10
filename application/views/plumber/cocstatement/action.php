<?php
	$userid					= $userdata['id'];
	$id 					= isset($result['id']) ? $result['id'] : '';
	
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
	$email 					= isset($result['email']) ? $result['email'] : '';
	$installationtypeid 	= isset($result['installationtype']) ? explode(',', $result['installationtype']) : [];
	$specialisationsid 		= isset($result['specialisations']) ? explode(',', $result['specialisations']) : [];
	$installationdetail 	= isset($result['installation_detail']) ? $result['installation_detail'] : '';
	$file1 					= isset($result['file1']) ? $result['file1'] : '';
	$file2 					= isset($result['file2']) ? explode(',', $result['file2']) : [];
	$agreementid 			= isset($result['agreement']) ? explode(',', $result['agreement']) : [];
	
	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/log/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	
	if($file1!=''){
		$explodefile1 	= explode('.', $file1);
		$extfile1 		= array_pop($explodefile1);
		$file1img 		= (in_array($extfile1, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file1;
	}else{
		$file1img 		= $profileimg;
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Log COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Log COC</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">Log COC</h4>
					<h4 class="sup_title">Certificate: <label>2222</label></h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumbing Work Completion Date *</label>
								<div class="input-group">
									<input type="text" class="form-control completion_date" name="completion_date" value="<?php echo $completiondate; ?>">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Insurance Claim/Order no: (if relevant)</label>
								<input type="text" class="form-control" name="order_no" value="<?php echo $orderno; ?>">
							</div>
						</div>
					</div>

					<h4 class="card-title add_top_value">Physical Address Details of Installation</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Owners Name *</label>
								<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Name of Complex/Flat (if applicable)</label>
								<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Street *</label>
								<input type="text" class="form-control" name="street" value="<?php echo $street; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Number *</label>
								<input type="text" class="form-control" name="number" value="<?php echo $number; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Province *</label>
								<?php
									echo form_dropdown('province', $province, $provinceid, ['id' => 'province', 'class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City *</label>
								<?php 
									echo form_dropdown('city', [], $cityid, ['id' => 'city', 'class' => 'form-control']); 
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb *</label>
								<?php
									echo form_dropdown('suburb', [], $suburbid, ['id' => 'suburb', 'class'=>'form-control']);
								?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Contact Mobile *</label>
								<input type="text" class="form-control" name="contact_no" value="<?php echo $contactno; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Alternate Contact</label>
								<input type="text" class="form-control" name="alternate_no" value="<?php echo $alternateno; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
							</div>
						</div>
					</div>

					<div class="row add_top_value">
						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th colspan="2">Type of Installation Carried Out by Licensed Plumber</th>
								<th style="text-align: center;">Code</th>
								<th style="text-align: center;">Tick</th>
							</tr>
							<?php
								foreach ($installation as $key => $value) {
							?>
									<tr>
										<td colspan="2"><?php echo $value['name']; ?></td>
										<td style="text-align: center;"><?php echo $value['code']; ?></td>
										<td style="text-align: center;">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="installationtype[]" class="custom-control-input" id="<?php echo $key.'-'.$value['code']; ?>" value="<?php echo $key; ?>" <?php echo (in_array($key, $installationtypeid)) ? 'checked="checked"' : ''; ?>>
												<label class="custom-control-label" for="<?php echo $key.'-'.$value['code']; ?>"></label>
											</div>
										</td>
									</tr>
							<?php
								}
							?>
						</table>


						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="2">Specialisations: To be Carried Out by Licensed Plumber Only Registered to do the Specialised work</th>
								<th style="text-align: center;">Code</th>
								<th style="text-align: center;">Tick</th>
							</tr>
							<?php
								foreach ($specialisations as $key => $value) {
							?>
									<tr>
										<td colspan="2"><?php echo $value['name']; ?></td>
										<td style="text-align: center;"><?php echo $value['code']; ?></td>
										<td style="text-align: center;">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="specialisations[]" class="custom-control-input" id="<?php echo $key.'-'.$value['code']; ?>" value="<?php echo $key; ?>" <?php echo (in_array($key, $specialisationsid)) ? 'checked="checked"' : ''; ?>>
												<label class="custom-control-label" for="<?php echo $key.'-'.$value['code']; ?>"></label>
											</div>
										</td>
									</tr>
							<?php
								}
							?>
						</table>

						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="2">Installation Details</th>
							</tr>
							<tr>
								<td colspan="2">(Details of the work undertaken or scope of work for which the COC is being issued for)</td>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="installation_detail" rows="10" cols="100"><?php echo $installationdetail; ?></textarea>
								</td>
							</tr>
						</table>

						<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
							<tr>
								<th colspan="3">Pre- Existing Non Compliance Conditions</th>			
							</tr>
							<tr>
								<td colspan="2">Non compliance details</td>
								<td style="text-align: center;">
									<div class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
										<a href="#"><i class="fa fa-trash"></i></a>
									</div>	
								</td>
							</tr>
							<tr>
								<td colspan="2">Non compliance details</td>	
								<td style="text-align: center;">
									<div class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
										<a href="#"><i class="fa fa-trash"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Non compliance details</td>	
								<td style="text-align: center;">
									<div class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
										<a href="#"><i class="fa fa-trash"></i></a>
									</div>
								</td>
							</tr>
						</table>
						<div class="row text-right">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Add a Non Compliance</button>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<h4 class="card-title add_top_value">Image of COC (Paper)</h4>
							<div class="form-group">
								<div>
									<img src="<?php echo $file1img; ?>" class="file1_img" width="100">
								</div>
								<input type="file" id="file1_file" class="file1_file">
								<input type="hidden" name="file1" class="file1" value="<?php echo $file1; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>

						<div class="col-md-12">
							<h4 class="card-title add_top_value">Installation Images</h4>
							<div class="form-group">
								<div>
									<img src="<?php echo $profileimg; ?>" width="100">
								</div>
								<input type="file" id="file2_file" class="file2_file">
								<p>(Image/File Size Smaller than 5mb)</p>
								<div class="file2append">
									<?php 
										if(count($file2)){
											foreach ($file2 as $key => $value) {												
												$explodefile2 	= explode('.', $value);
												$extfile2 		= array_pop($explodefile2);
												$file1img 		= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$value;
											
									?>
												<div class="multipleupload">
													<input type="hidden" value="<?php echo $value; ?>" name="file2[]">
													<img src="<?php echo $file1img; ?>" width="100">
													<i class="fa fa-times"></i>
												</div>
									<?php
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>

					<table class="table table-bordered table-striped datatables fullwidth add_top_value_v2">
						<tr>
							<th colspan="3">I <?php echo $userdata['name'].' '.$userdata['surname']; ?>, Licensed registration number <?php echo $userdata['registration_no']; ?>, certify that, the above compliance certifcate details are true and correct and will be logged in accordance with the prescribed requirements as defned by the PIRB. Select either A or B as appropriate</th>			
						</tr>
						<tr>
							<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
								<div class="table-action">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" id="agreement1" name="agreement[]" value="1" class="custom-control-input" <?php echo (in_array('1', $agreementid)) ? 'checked="checked"' : ''; ?>>
										<label class="custom-control-label" for="agreement1"></label>
									</div>
								</div>	
							</td>
							<td colspan="2">A: The above plumbing work was carried out by me or under my supervision, and that it complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
						</tr>
						<tr>
							<td style="text-align: center; background-color: #ffeae5; vertical-align: middle;">
								<div class="table-action">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" id="agreement2" name="agreement[]" value="2" class="custom-control-input" <?php echo (in_array('2', $agreementid)) ? 'checked="checked"' : ''; ?>>
										<label class="custom-control-label" for="agreement2"></label>
									</div>
								</div>	
							</td>
							<td colspan="2">B: I have fully inspected and tested the work started but not completed by another Licensed plumber. I further certify that the inspected and tested work and the necessary completion work was carried out by me or under my supervision- complies in all respects to the plumbing regulations, laws, National Compulsory Standards and Local bylaws.</td>
						</tr>
					</table>

					<div class="ro text-right">
						<input type="hidden" value="<?php echo $id; ?>" name="id">
						<input type="hidden" value="<?php echo $cocid; ?>" name="coc_id">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Save COC</button>
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Log  COC</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

var userid		= '<?php echo $userid; ?>';
var filepath 	= '<?php echo $filepath; ?>';
var ajaxfileurl	= '<?php echo base_url("ajax/index/ajaxfileupload"); ?>';
var pdfimg		= '<?php echo $pdfimg; ?>';

$(function(){
	datepicker('.completion_date');
	citysuburb(['#province','#city', '#suburb'], ['<?php echo ''; ?>', '<?php echo ''; ?>']);
	fileupload([".file1_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.file1', '.file1_img', filepath, pdfimg]);
	fileupload([".file2_file", "./assets/uploads/plumber/"+userid+"/log/", ['jpg','gif','jpeg','png','pdf','tiff']], ['file2[]', '.file2append', filepath, pdfimg], 'multiple');
	
	validation(
		'.form',
		{
			completion_date : {
				required	: true
			},
			owner_name : {
				required    : true
			},
			street:{
				required    : true
			},
			number:{
				required    : true
			},
			province:{
				required    : true
			},
			city:{
				required    : true
			},
			suburb:{
				required    : true
			},
			contact_no:{
				required    : true
			},
			'agreement[]':{
				required    : true
			}
			
		},
		{
			completion_date 	: {
				required	: "Please select completion date"
			},
			owner_name : {
				required    : "Please fill the owner name"
			},
			street : {
				required    : "Please fill the street field"
			},
			number:{
				required    : "Please fill the number"
			},
			province:{
				required    : "Please select the province"
			},
			city:{
				required    : "Please select the city"
			},
			suburb:{
				required    : "Please select the suburb"
			},
			contact_no:{
				required    : "Please fill the contact no"
			},
			'agreement[]':{
				required    : "Please check the agreement"
			}
		}
	);
})

$('.file2_file').click(function(e){
	if($(document).find('.multipleupload').length >= 4){
		$(this).val('');
		sweetalertautoclose('Reached maxmium limit.');
		return false;
	}
})
</script>