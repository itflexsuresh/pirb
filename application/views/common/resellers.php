<?php
$usersdetailid 			= isset($result['usersdetailid']) ? $result['usersdetailid'] : '';
$usersid 				= isset($result['usersid']) ? $result['usersid'] : '';
$coccountid 			= isset($result['coccountid']) ? $result['coccountid'] : '';
$company_name 			= isset($result['company_name']) ? $result['company_name'] : '';	
$company 				= isset($result['company']) ? $result['company'] : '';
$name 					= isset($result['name']) ? $result['name'] : '';	
$surname 				= isset($result['surname']) ? $result['surname'] : '';	
$work_phone 			= isset($result['work_phone']) ? $result['work_phone'] : '';	
$mobile_phone 			= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';	
$email 					= isset($result['email']) ? $result['email'] : '';	
$password 				= isset($result['password_raw']) ? $result['password_raw'] : '';	
$active 				= isset($result['active']) ? $result['active'] : '';	
$address 				= isset($result['address']) ? $result['address'] : '';	
$paddress 				= isset($result['paddress']) ? $result['paddress'] : '';	
$reg_no 				= isset($result['reg_no']) ? $result['reg_no'] : '';
$vat_no 				= isset($result['vat_no']) ? $result['vat_no'] : '';
$vatreg 				= isset($result['vatreg']) ? $result['vatreg'] : '';
$coc_purchase_limit 	= isset($result['coc_purchase_limit']) ? $result['coc_purchase_limit'] : '';
$status 				= isset($result['status']) ? $result['status'] : '';
$vat_vendor 			= isset($result['vat_vendor']) ? $result['vat_vendor'] : '';

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

$roletype 				= isset($roletype) ? $roletype : '';
$pagetype 				= isset($pagetype) ? $pagetype : '';

$adminvalue 			= isset($adminvalue) ? $adminvalue : '';

$stock_count = isset($stock_count) ? $stock_count : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Reseller Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Home</li>
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
							<input type="text" class="form-control"  name="company" id="company"  value="<?php echo $company; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Person Name *</label>
							<input type="text" class="form-control"  name="name" id="name"  value="<?php echo $name; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Contact Person Surname *</label>
							<input type="text" class="form-control"  name="surname" id="surname"  value="<?php echo $surname; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone (Work) *</label>
							<input type="text" class="form-control"  name="work_phone" id="work_phone"  value="<?php echo $work_phone; ?>">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Primary Contact Mobile Number *</label>
							<input type="text" class="form-control"  name="mobile_phone" id="mobile_phone" value="<?php echo $mobile_phone; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Primary Email *</label>
							<input type="text" class="form-control" id="email" name="email"  value="<?php echo $email; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Password *</label>
							<input type="password" class="form-control"  name="password" id="password"  value="<?php echo $password; ?>">
							</div>
					</div>
					<?php if($adminvalue==0){}else{ ?>
						<div class="col-md-6">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="status" name="status" value="1" <?php echo ($status=='1') ? 'checked="checked"' : ''; ?>>
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
					<?php } ?>
				</div>

				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Postal Address</h4>
						<div class="form-group">
							<label>Postal Address</label>
							<input type="hidden" class="form-control" name="address[2][id]" value="<?php echo $addressid2; ?>">
							<input type="hidden" class="form-control" name="address[2][type]" value="2">
							<input type="text" class="form-control" name="address[2][address]" value="<?php echo $address2; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<h4 class="card-title">Physical Address</h4>
						<div class="form-group">
							<label>Physical Address</label>
							<input type="hidden" class="form-control" name="address[1][id]" value="<?php echo $addressid1; ?>">
							<input type="hidden" class="form-control" name="address[1][type]" value="1">
							<input type="text" class="form-control" name="address[1][address]"  value="<?php echo $address1; ?>">
						</div>
					</div>					
				</div>

				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Province</label>
							<?php
								echo form_dropdown('address[2][province]', $province, $province2, ['id' => 'province2', 'class'=>'form-control']);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Province</label>							
							<?php 
								echo form_dropdown('address[1][province]', $province, $province1, ['id' => 'province1', 'class' => 'form-control']); 
							?>
						</div>
					</div>
				</div>

				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>City</label>
							<?php 
								echo form_dropdown('address[2][city]', [], $city2, ['id' => 'city2', 'class' => 'form-control']); 
							?>							
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>City</label>
							<?php 
								echo form_dropdown('address[1][city]', [], $city1, ['id' => 'city1', 'class' => 'form-control']); 
							?>							
						</div>
					</div>
				</div>

				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Suburb</label>
							<?php
								echo form_dropdown('address[2][suburb]', [], $suburb2, ['id' => 'suburb2', 'class'=>'form-control']);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Suburb</label>
							<?php
								echo form_dropdown('address[1][suburb]', [], $suburb1, ['id' => 'suburb1', 'class'=>'form-control']);
							?>
						</div>
					</div>					
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Postal Code</label>
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
							<label>Billing Name *</label>
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
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="vat_vendor" name="vat_vendor" value="1" <?php echo ($vat_vendor=='1') ? 'checked="checked"' : ''; ?>>
							<label class="custom-control-label" for="vat_vendor">Company Vat Registered</label>
						</div>
					</div>
				</div>
<?php if($adminvalue==0){}else{ ?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Number of CoC's Able to purchase number *</label>	
							<input type="text" class="form-control" id="coc_purchase_limit" name="coc_purchase_limit"  value="<?php echo $coc_purchase_limit; ?>">
							<input type="hidden" id="totalstockcount" name="totalstockcount" value="<?php echo $stock_count;?>">							
							<span id="stockcountlimet" style="color:red"></span>
							</div>						
							</div>
					</div>
				</div>
<?php } ?>
				<div class="col-md-12 text-right">
					<input type="hidden" name="usersdetailid" id="usersdetailid" value="<?php echo $usersdetailid; ?>">	
					<input type="hidden" name="coccountid" id="coccountid" value="<?php echo $coccountid; ?>">
					<input type="hidden" name="usersid" id="usersid" value="<?php echo $usersid; ?>">			
					<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">
				</div>				
			</form>
<?php if($adminvalue==0){}else{ 
	if($usersid > 0){	?>
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-striped datatables fullwidth">
					<thead>
						<tr>
							<th>COC Number</th>
							<th>Status</th>
							<th>Date and Time of </br> Allocation</th>
							<th>Plumber Name/Surname</th>
							<th>Plumber Company</th>
							<th>Reg Number</th>
						</tr>
					</thead>
				</table>
			</div>
<?php } } ?>
		</div>		
	</div>	
</div>




<script type="text/javascript">


$("#coc_purchase_limit").keyup(function(){
  var limitval = $("#coc_purchase_limit").val();
  var stockcount = $("#totalstockcount").val();
  var totalcount = limitval-stockcount;
  if(totalcount < 0){  	
  	$('#stockcountlimet').text("Already has "+stockcount+" coc without logged to Plumber");
  }
  else{
  	$('#stockcountlimet').text("");	
  }
});

$(function(){
	datatable();

	var userid		= '<?php echo $usersid; ?>';
	// select2('#plumberstatus, #designation2, #title, #gender, #racial, #nationality, #othernationality, #homelanguage, #disability, #citizen, #registration_card, #delivery_card, #province1, #city1, #suburb1, #province2, #city2, #suburb2, #province3, #city3, #suburb3, #employment_details, #company_details, #skill_route');
	inputmask('#work_phone, #mobile_phone', 1);
	citysuburb(['#province1','#city1', '#suburb1'], ['<?php echo $city1; ?>', '<?php echo $suburb1; ?>']);
	citysuburb(['#province2','#city2', '#suburb2'], ['<?php echo $city2; ?>', '<?php echo $suburb2; ?>']);
	
	jQuery.validator.addMethod("noSpace", function(value, element) { 
		return value.indexOf(" ") < 0 && value != ""; 
	}, "No space please and don't leave it empty");
	
	validation(
		'.resellers',
		{
			
			company : {
				required	: true,
			},
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
									url		: 	"<?php echo base_url().'authentication/login/emailvalidation'; ?>",
									type	: 	"post",
									async	: 	false,
									data	: 	{
													id : userid
												}
								}
			},
			home_phone : {
				required	: true,
				maxlength: 20,
				minlength: 10,
			},
			password : {
				required	: true,
				minlength	: 8,
				maxlength	: 24,
				noSpace		: true
			},
			company_name : {
				required	: true,
			},			
			coc_purchase_limit : {
				required	: true,
			}
		},
		{
			
			name 	: {
				required	: "Company Name field is required.",
			},
			name 	: {
				required	: "Name field is required.",
			},
			surname : {
				required	: "Surname field is required.",
			},
			mobile_phone : {
				required	: "Mobile phone field is required.",
				maxlength: "Please Enter 20 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			},
			email : {
				required	: "Email  field is required.",
				email       : "Please Enter Valid Mail",
				remote		: "Email already exists."
			},
			home_phone : {
				maxlength: "Please Enter 20 Numbers Only.",
				minlength: "Please Enter 10 Numbers Only.",
			},
			company_name 	: {
				required	: "Billing name field is required.",
			},
			password 	: {
				required	: "Password field is required.",
				minlength	: "Password must be minium 8 character..",
				maxlength	: "Password must be maximum 24 character..",
			},			
			coc_purchase_limit 	: {
				required	: "Purchase number field is required.",
			}
		},
		{
			ignore : '.test',
		}
	);


	$('#submit').click(function(e){
		
		var limitval = $("#coc_purchase_limit").val();
		var stockcount = $("#totalstockcount").val();
		var totalcount = limitval-stockcount;
		if(totalcount < 0){  	
			event.preventDefault();
			$('#stockcountlimet').text("Already has "+stockcount+" coc without logged to Plumber");
		}
		else{
			$('#stockcountlimet').text("");	
		}		
		
		if($('form.resellers').valid()==false){
			accord = $('.error_class_1').parents('.collapse').addClass('show');			
		}
		
	})

});

$('.search').on('click',function(){		
	datatable(1);
});

function datatable(destroy=0){
	var user_id		= $('#usersid').val();	
	var options = {
		url 	: 	'<?php echo base_url()."ajax/index/ajaxdtresellers"; ?>',
		data    :   { customsearch : 'listsearch1',user_id : user_id,search_reg_no:$('#reg_no').val(), search_plumberstatus:$('#plumberstatus').val(), search_idcard:$('#idcard').val(), search_mobile_phone:$('#mobile_phone').val(), search_dob:$('#dob').val(), search_company_details:$('#company_details').val()},  			
		destroy :   destroy,  			
		columns : 	[							
						{ "data": "cocno" },
						{ "data": "status" },
						{ "data": "datetime" },
						{ "data": "name" },
						{ "data": "company" },
						{ "data": "registration_no" }
					]
	};
	
	ajaxdatatables('.datatables', options);
}


</script>

<style type="text/css">
.progress-circle span {
    display: none;
}
</style>