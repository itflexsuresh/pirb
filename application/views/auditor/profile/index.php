<?php

	$id 			= isset($result['id']) ? $result['id'] : '';
	$email  		= isset($result['email']) ? $result['email'] : set_value ('email');
	$password  		= isset($result['password_raw']) ? $result['password_raw'] : set_value ('password_raw');
	
	$userdetailid 	= isset($result['userdetailid']) ? $result['userdetailid'] : '';
	$name 			= isset($result['name']) ? $result['name'] : set_value ('name');
	$surname 		= isset($result['surname']) ? $result['surname'] : set_value ('surname');	
	$billingname 	= isset($result['company_name']) ? $result['company_name'] : set_value ('company_name');
	$compreg 		= isset($result['reg_no']) ? $result['reg_no'] : set_value ('reg_no');
	$compvat 		= isset($result['vat_no']) ? $result['vat_no'] : set_value ('vat_no');
	$compvatvendor	= isset($result['vat_vendor']) ? $result['vat_vendor'] : set_value ('vat_vendor');
	$mobile  		= isset($result['mobile_phone']) ? $result['mobile_phone'] : set_value ('mobile_phone');
	$workphone  	= isset($result['work_phone']) ? $result['work_phone'] : set_value ('work_phone');
	$image 			= isset($result['file1']) ? $result['file1'] : set_value ('file1');	
	$complogo 		= isset($result['file2']) ? $result['file2'] : set_value ('file2');
	$idno 			= isset($result['identity_no']) ? $result['identity_no'] : set_value ('idno');

	$useraddressid 	= isset($result['useraddressid']) ? $result['useraddressid'] : '';
	$billaddress 	= isset($result['address']) ? $result['address'] : set_value ('address');
	$province 		= isset($result['province']) ? $result['province'] : set_value ('province');
	$city 			= isset($result['city']) ? $result['city'] : set_value ('city');
	$suburb 		= isset($result['suburb']) ? $result['suburb'] : set_value ('suburb');
	$postal 		= isset($result['postal_code']) ? $result['postal_code'] : set_value ('postal_code');

	$userbankid 	= isset($result['userbankid']) ? $result['userbankid'] : '';
	$bank 			= isset($result['bank_name']) ? $result['bank_name'] : set_value ('bankname');
	$branchcode 	= isset($result['branch_code']) ? $result['branch_code'] : set_value ('branchcode');
	$accountname 	= isset($result['account_name']) ? $result['account_name'] : set_value ('account_name');
	$accno 			= isset($result['account_no']) ? $result['account_no'] : set_value ('account_no');
	$type 			= isset($result['account_type']) ? $result['account_type'] : set_value ('account_type');

	$areas 			= isset($result['areas']) ? $result['areas'] : [];

	$heading 		= isset($result['userid']) ? 'Save' : 'Update'; 

	$filepath 		= base_url().'assets/uploads/auditor/'.$id.'/';
	$filepath1		= (isset($result['file1']) && $result['file1']!='') ? $filepath.$result['file1'] : base_url().'assets/images/auditor/profile.jpg';
	$filepath2		= (isset($result['file2']) && $result['file1']!='')  ? $filepath.$result['file2'] : base_url().'assets/images/auditor/profile.jpg';	
?>

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
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
				<form class="form" method="post" enctype="multipart/form-data">

					<h4 class="card-title">My Profile</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control"  name="name" value="<?php echo $name; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Surname</label>
										<input type="text" class="form-control"  name="surname" value="<?php echo $surname; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>ID Number</label>
										<input type="text" class="form-control"  name="idno" value="<?php echo $idno; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Photo</label>
										<div>
											<img src="<?php echo $filepath1; ?>" class="auditor_photo" width="100">
										</div>
										<input type="file" class="auditor_image">
										<input type="hidden" name="file1" class="auditor_picture" value="<?php echo $image; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
							</div>
						</div>
						
					</div>					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control"  name="email" value="<?php echo $email; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control"  name="password" value="<?php echo $password; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Work)</label>
								<input type="text" class="form-control"  name="work_phone" value="<?php echo $workphone; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Mobile)</label>
								<input type="text" class="form-control"  name="mobile_phone" value="<?php echo $mobile; ?>">
							</div>
						</div>
					</div>

					<h4 class="card-title add_top_value">Billing Details</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Billing Name</label>
								<input type="text" class="form-control" name="company_name" value="<?php echo $billingname; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Company Reg Number</label>
								<input type="text" class="form-control" name="reg_no" value="<?php echo $compreg; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Company VAT</label>
								<input type="text" class="form-control" name="vat_no" value="<?php echo $compvat; ?>">
							
								<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">	
									<input type="checkbox" class="custom-control-input" <?php echo ($compvatvendor=='1') ? 'checked="checked"' : ''; ?> value="1" name="vat_vendor" id="vatvendor">
									<label class="custom-control-label" for="vatvendor">VAT Vendor</label>
								</div>
							</div>
						</div>
					</div>

					<h4 class="card-title add_top_value">Billing Address</h4>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Billing Address</label>
									<input type="text" class="form-control" name="address" value="<?php echo$billaddress; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Province</label>
									<?php echo form_dropdown('province', $provincelist, $province, ['id' => 'province', 'class' => 'form-control province_name']); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City</label>
									<?php echo form_dropdown('city', [], $city, ['id' => 'city', 'class' => 'form-control city_name']); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Suburb</label>
									<?php
									echo form_dropdown('suburb', [], '', ['id' => 'suburb', 'class'=>'form-control']);
									?> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code</label>
									<input type="text" class="form-control" name="postal_code" value="<?php echo $postal; ?>">
								</div>
							</div>

							<div class="col-md-6">
							<div class="form-group">
								<label>Company Logo</label>
								<div>
									<img src="<?php echo $filepath2; ?>" class="comp_logo" width="100">
								</div>
								<input type="file" class="comp_emb">
								<input type="hidden" name="file2" class="comp_photo" value="<?php echo $complogo; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
						</div>						
						
					</div>
					
					<h4 class="card-title add_top_value">Banking Details</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Bank Name</label>
								<input type="text" class="form-control" name="bank_name" value="<?php echo $bank; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account Name</label>
								<input type="text" class="form-control" name="account_name" value="<?php echo $accountname; ?>">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Branch Code</label>
								<input type="text" class="form-control" name="branch_code" value="<?php echo $branchcode; ?>">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account Number</label>
								<input type="text" class="form-control" name="account_no" value="<?php echo $accno; ?>">
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Account Type</label>
								<input type="text" class="form-control" name="account_type" value="<?php echo $type; ?>">
							</div>
						</div>
					</div>
					
					<h4 class="card-title add_top_value">My Auditting Areas</h4>
					<div class="row">
						<div class="col-md-12">							
							<table id="area_table" class="table table-bordered table-striped datatables fullwidth">
								<thead>
									<tr>
										<th>Province</th>
										<th>City</th>        
										<th>Suburb</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="area_body">
									<!--<tr colspan="4" class="area_norecord">No Record Found</tr>-->
								</tbody>
							</table>
						</div>
					</div>
						
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Province</label>
								<?php echo form_dropdown('area_province', $provincelist, '', ['id' => 'area_province', 'class' => 'form-control']); ?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<?php echo form_dropdown('area_city', [], '', ['id' => 'area_city', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb</label>
								<?php
								echo form_dropdown('area_suburb', [], '', ['id' => 'area_suburb', 'class'=>'form-control']);
								?> 
							</div>
						</div>
					</div>

					<div class="row">
						<input type="hidden" name="id" value="<?php echo $userid; ?>">
						<input type="hidden" name="userdetailid" value="<?php echo $userdetailid; ?>">
						<input type="hidden" name="useraddressid" value="<?php echo $useraddressid; ?>">
						<input type="hidden" name="userbankid" value="<?php echo $userbankid; ?>">
						<div class="col-md-2"> 
							<button type="button" name="addarea" id="addarea" value="addarea" class="btn btn-block btn-primary btn-rounded">Add Area</button>
						</div>

						<div class="col-md-3">
							<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary btn-rounded"><?php echo $heading; ?> </button>
						</div>
					</div>					
				</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$(function(){
		
		fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".auditor_image", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.auditor_picture', '.auditor_photo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);
	
		fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".comp_emb", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.comp_photo', '.comp_logo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);

		citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $("#province").val()}, '#city', '<?php echo $city; ?>'], ['<?php echo base_url()."ajax/index/ajaxsuburb"; ?>', {provinceid : $("#province").val(),cityid : '<?php echo $city; ?>'}, '#suburb', '<?php echo $suburb; ?>']);


	validation(
			'.form',
			{
				name : {
					required	: true,
				},
				surname : {
					required	: true,
				},
				// idnumber : {
				// 	required	: true,
				// },
				email : {
					required	: true,
				},
				pass : {
					required	: true,
				},
				phonework : {
					required	: true,
				},
				phonemobile : {
					required	: true,
				},
				billingname : {
					required	: true,
				},
				regnumber : {
					required	: true,
				},
				vat : {
					required	: true,
				},
				billingaddress : {
					required	: true,
				},
				postalcode : {
					required	: true,
				},
				bankname : {
					required	: true,
				},
				accountname : {
					required	: true,
				},
				branchcode : {
					required	: true,	
				},
				accountnumber : {
					required	: true,	
				},
				accounttype : {
					required	: true,	
				}			

			},

			{
				name 	: {
					required	: "Please enter the firstname."
				},
				surname 	: {
					required	: "Please enter the surname."
				},				
				// idnumber : {
				// 	required	: "Please enter the ID"
				// },
				email : {
					required	: "Please enter the email"
				},
				pass : {
					required	: "Please enter the password"
				},
				phonework : {
					required	: "Please enter the work phone"
				},
				phonemobile : {
					required	: "Please enter the mobile phone"
				},
				billingname : {
					required	: "Please enter the billing name"
				},
				regnumber : {
					required	: "Please enter the register number"
				},
				vat : {
					required	: "Please enter the VAT"
				},
				billingaddress : {
					required	: "Please enter the billing address"
				},
				postalcode : {
					required	: "Please enter the postal code"
				},
				bankname : {
					required	: "Please enter the bank name"
				},				
				accountname : {
					required	: "Please enter the account name"
				},
				branchcode : {
					required	: "Please enter the branch code"	
				},
				accountnumber : {
					required	: "Please enter the account number"	
				},
				accounttype : {
					required	: "Please enter the account type"	
				}
			}
		);
	});

	$('.province_name').on('change', function(){
		citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $("#province").val()}, '#city', '<?php echo $city; ?>'], ['<?php echo base_url()."ajax/index/ajaxsuburb"; ?>', {provinceid : $("#province").val(),cityid : '<?php echo $city; ?>'}, '#suburb', '<?php echo $suburb; ?>']);
	});

	var areacount = 0;

	$("#addarea").click(function() { 
        
        var areaprovinceval = $('#area_province').val();
        var areacityval 	= $('#area_city').val();
        var areasuburbval 	= $('#area_suburb').val();

        var areaprovincetxt = $('#area_province :selected').text();
        var areacitytxt 	= $('#area_city :selected').text();
        var areasuburbtxt 	= $('#area_suburb :selected').text();

        areadata([areaprovinceval, areacityval, areasuburbval], [areaprovincetxt, areacitytxt, areasuburbtxt]);
          
    });

    $('#area_province').on('change', function(){
		citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $("#area_province").val()}, '#area_city'], ['<?php echo base_url()."ajax/index/ajaxsuburb"; ?>', {provinceid : $("#area_province").val(), cityid : '<?php echo $city; ?>'}, '#area_suburb']);
	});

    function areadata(data1, data2){
    	var append			= 	'\
        							<tr class="">\
        								<td>'+data2[0]+'</td>\
        								<td>'+data2[1]+'</td>\
        								<td>'+data2[2]+'</td>\
        								<td>\
        									<a href="javascript:void(0);" class="area_remove"><i class="fa fa-trash"></i></a>\
        									<input type="hidden" value="'+data1[0]+'" name="area['+areacount+'][province]">\
        									<input type="hidden" value="'+data1[1]+'" name="area['+areacount+'][city]">\
        									<input type="hidden" value="'+data1[2]+'" name="area['+areacount+'][suburb]">\
        									<input type="hidden" value="'+((data1[3]) ? data1[3] : "")+'" name="area['+areacount+'][id]">\
        								</td>\
        							</tr>\
        						';

        $('#area_table').append(append);
        areacount++;
    }

    $(document).on('click', '.area_remove', function(){
    	$(this).parent().parent().remove();
    })
</script>