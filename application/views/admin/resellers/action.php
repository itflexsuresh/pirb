<?php
// print_r($result);
$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
$usersid 			= isset($result['usersid']) ? $result['usersid'] : '';

$company_name 				= isset($result['company_name']) ? $result['company_name'] : '';	
$company 				= isset($result['company']) ? $result['company'] : '';
$name 				= isset($result['name']) ? $result['name'] : '';	
$surname 				= isset($result['surname']) ? $result['surname'] : '';	
$home_phone 				= isset($result['home_phone']) ? $result['home_phone'] : '';	
$mobile_phone 				= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';	
$email 				= isset($result['email']) ? $result['email'] : '';	
$password 				= isset($result['password_raw']) ? $result['password_raw'] : '';	
$active 				= isset($result['active']) ? $result['active'] : '';	
$address 				= isset($result['address']) ? $result['address'] : '';	
$paddress 				= isset($result['paddress']) ? $result['paddress'] : '';	
$reg_no 				= isset($result['reg_no']) ? $result['reg_no'] : '';
$vat_no 				= isset($result['vat_no']) ? $result['vat_no'] : '';
$vatreg 				= isset($result['vatreg']) ? $result['vatreg'] : '';
$purchaseno 				= isset($result['purchaseno']) ? $result['purchaseno'] : '';
$status 				= isset($result['status']) ? $result['status'] : '';
$vat_vendor 				= isset($result['vat_vendor']) ? $result['vat_vendor'] : '';

// $status = 1;

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

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Reseller Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Reseller Details</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<form class="mt-4 form resellers" action="" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Company Name *</label>
							<input type="text" class="form-control"  name="company"  value="<?php echo $company; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Person Name</label>
							<input type="text" class="form-control"  name="name"  value="<?php echo $name; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Person Surname</label>
							<input type="text" class="form-control"  name="surname"  value="<?php echo $surname; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone (Work)</label>
							<input type="text" class="form-control"  name="home_phone"  value="<?php echo $home_phone; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Primary Contact Mobile Number</label>
							<input type="text" class="form-control"  name="mobile_phone"  value="<?php echo $mobile_phone; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Primary Email</label>
							<input type="text" class="form-control"  name="email"  value="<?php echo $email; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control"  name="password"  value="<?php echo $password; ?>">
							</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Active</label>														
							<input type="checkbox" class="form-control"  name="status"  value="1" <?php if($status == '1'){?> checked <?php } ?>>
							</div>
					</div>
				</div>

				<div class="row">

					<div class="col-md-6">
						<h4 class="card-title">Physical Address</h4>
						<!-- <p class="tagline">Note all delivery services will be sent to this address</p> -->
						<div class="form-group">
							<label>Physical Address *</label>
							<input type="hidden" class="form-control" name="address[1][id]" value="<?php echo $addressid1; ?>">
							<input type="hidden" class="form-control" name="address[1][type]" value="1">
							<input type="text" class="form-control" name="address[1][address]"  value="<?php echo $address1; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<h4 class="card-title">Postal Address</h4>
						<!-- <p class="tagline">Note all postal services will be sent to this address</p> -->
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
						<div class="form-group">
							<label>Postal Code *</label>
							<input type="text" class="form-control" name="address[2][postal_code]" value="<?php echo $postalcode2; ?>">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h4 class="card-title">Invoice Details</h4>							
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Billing Name</label>
							<input type="text" class="form-control"  name="company_name"  value="<?php echo $company_name; ?>">
							</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Company Reg Number</label>
							<input type="text" class="form-control"  name="reg_no"  value="<?php echo $reg_no; ?>">
							</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Company Vat</label>
							<input type="text" class="form-control"  name="vat_no"  value="<?php echo $vat_no; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-3">
						
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Company Vat Registered</label>
							<input type="checkbox" class="form-control" name="vat_vendor"  value="1"  <?php if($vat_vendor == '1'){?> checked <?php } ?>>
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Number of CoC's Able to purchase number</label>	
							<input type="text" class="form-control"  name="purchaseno"  value="<?php echo $purchaseno; ?>">
							</div>						
							</div>
					</div>
				</div>

				<div class="col-md-12 text-right">
					<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">	
					<input type="hidden" name="usersid" id="usersid" value="<?php echo $usersid; ?>">				
					<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">
				</div>				
			</form>			
		</div>
	</div>
</div>



<script type="text/javascript">


$(function(){
	
	validation(
		'.resellers',
		{
			
			name : {
				required	: true,
			},
			surname : {
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
			}
		},
		{
			
			name 	: {
				required	: "Name field is required."
			}
			surname : {
				required	: "Surname field is required.",
			}
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
			}
		},
		{
			ignore : '.test',
		}
	);


	$('#submit').click(function(e){
		
		if($('form.resellers').valid()==false){
			accord = $('.error_class_1').parents('.collapse').addClass('show');			
		}
		
	})


});


</script>

<style type="text/css">
.progress-circle span {
    display: none;
}
</style>