<?php

if(isset($result) && $result)
{
	$id 		= $result['user_id'];
	$name 		= isset($result['name']) ? $result['name'] : '';
	$surname 	= isset($result['surname']) ? $result['surname'] : '';
	$image 		= isset($result['file1']) ? $result['file1'] : '';	
	$email  	= isset($result['email']) ? $result['email'] : '';
	$password  	= isset($result['password_raw']) ? $result['password_raw'] : '';
	$workphone  = isset($result['work_phone']) ? $result['work_phone'] : '';
	$mobile  	= isset($result['mobile_phone']) ? $result['mobile_phone'] : '';
	$billingname = isset($result['company_name']) ? $result['company_name'] : '';
	$compreg 	= isset($result['reg_no']) ? $result['reg_no'] : '';
	$compvat 	= isset($result['vat_no']) ? $result['vat_no'] : '';
	$billaddress = isset($result['address']) ? $result['address'] : '';
	$complogo 	= isset($result['file2']) ? $result['file2'] : '';
	$id1 		= isset($result['province']) ? $result['province'] : '';
	$id1 		= isset($result['city']) ? $result['city'] : '';
	$suburb 	= isset($result['suburb']) ? $result['suburb'] : '';
	$postal 	= isset($result['postal_code']) ? $result['postal_code'] : '';
	$bank 		= isset($result['bank_name']) ? $result['bank_name'] : '';
	$accountname = isset($result['account_name']) ? $result['account_name'] : '';
	$branchcode = isset($result['branch_code']) ? $result['branch_code'] : '';
	$accno 		= isset($result['account_no']) ? $result['account_no'] : '';
	$type 		= isset($result['account_type']) ? $result['account_type'] : '';

	$heading 	= 'Update';   
	
}
else
{
	$user_id = '';
	
	
	$name     			= set_value ('name');
	$surname			= set_value ('surname');
	$email				= set_value ('email');
	$phonework			= set_value ('phonework');
	$phonemobile 		= set_value ('phonemobile');
	$billingname 		= set_value ('billingname');
	$regnumber 			= set_value ('regnumber');
	$province           = set_value ('province');
	$city     			= set_value ('city');
	$suburb    			= set_value ('suburb');
	$postalcode 		= set_value ('postalcode');
	$bankname			= set_value ('bankname');
	$account 			= set_value ('accountname');
	$branchcode 		= set_value ('branchcode');
	$accno 				= set_value ('accountnumber');
	$acctype 			= set_value ('accounttype');						

	$heading = 'Save';
}
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
				
				<form class="form" method="post">

					<h4 class="card-title">My Profile</h4>
					<div class="row">
						<div class="col-md-6">
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
								<input type="file" class="auditor_image" value="<?php echo $image; ?>">
								<input type="hidden" name="auditor_picture" class="auditor_picture" value="<?php echo $image; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
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
								<input type="password" class="form-control"  name="pass" value="<?php echo $password; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Work)</label>
								<input type="text" class="form-control"  name="phonework" value="<?php echo $workphone; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone (Mobile)</label>
								<input type="text" class="form-control"  name="phonemobile" value="<?php echo $mobile; ?>">
							</div>
						</div>
					</div>

					<h4 class="card-title">Billing Details</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Billing Name</label>
								<input type="text" class="form-control" name="billingname" value="<?php echo $billingname; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Company Reg Number</label>
								<input type="text" class="form-control" name="regnumber" value="<?php echo $compreg; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Company VAT</label>
								<input type="text" class="form-control" name="vat" value="<?php echo $compvat; ?>">
							
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
								<label>Billing Address</label>
								<input type="text" class="form-control" name="billingaddress" value="<?php echo$billaddress; ?>">
							</div>
							<div class="form-group"> 
								<label>Province</label>
								<?php echo form_dropdown('province', $provincelist, $id1, ['id' => 'id', 'class' => 'form-control']); ?>
							</div>
							<div class="form-group">
								<label>City</label>
								<?php echo form_dropdown('city', $CityList, $id1, ['id' => 'id', 'class' => 'form-control']); ?>


							</div>
							<div class="form-group">
								<label>Suburb</label>
								<!-- <?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?> -->
								<input type="text" name="suburb" id="suburb_name" class="form-control" value="<?php echo $suburb; ?>">
							</div>
							<div class="form-group">
								<label>Postal Code</label>
								<input type="text" class="form-control" name="postalcode" value="<?php echo $postal; ?>">
							</div>
						</div>						
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Logo</label>
								<div>
									<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="comp_logo" width="100">
								</div>
								<input type="file" class="comp_emb">
								<input type="hidden" name="comp_photo" class="comp_photo" value="<?php echo $complogo; ?>">
								<p>(Image/File Size Smaller than 5mb)</p>
							</div>
						</div>
					</div>
					
					<h4 class="card-title">Banking Details</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Bank Name</label>
								<input type="text" class="form-control" name="bankname" value="<?php echo $bank; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Name</label>
								<input type="text" class="form-control" name="accountname" value="<?php echo $accountname; ?>">
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Branch Code</label>
								<input type="text" class="form-control" name="branchcode" value="<?php echo $branchcode; ?>">
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Number</label>
								<input type="text" class="form-control" name="accountnumber" value="<?php echo $accno; ?>">
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Account Type</label>
								<input type="text" class="form-control" name="accounttype" value="<?php echo $type; ?>">
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
								<label>Province</label>
								<?php echo form_dropdown('id', $provincelist, $id1, ['id' => 'id', 'class' => 'form-control']); ?>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<?php echo form_dropdown('id', $CityList, $id1, ['id' => 'id', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Suburb</label>
								<!-- <?php
								echo form_dropdown('citizen', $citizen, '',['class'=>'form-control']);
								?> -->
								<input type="text" name="audit_suburb" id="audit_suburb" class="form-control" value="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
							<button type="submit" name="addarea" id="addarea" value="addarea" class="btn btn-block btn-primary btn-rounded">Add Area</button>
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

	$(document).ready(function() {
    $("#addarea").click(function() { 

        // var cty = $("#audit_city").val();
        // var srb = $("#audit_suburb").val();
        
        var val1 = $('input[id="audit_provin"]').val();
        var val2 = $('input[id="audit_city"]').val();
        var val3 = $('input[id="audit_suburb"]').val();

            if(val1 != '')
            {
                //('#table').append('<tr class="prov"><td>' + val1 + '</td></tr>');
                $('#table').append('<td class="ptty">' + val1 + '</td>');
                $('#table').append('<td class="cccty">' + val2 + '</td>');
                $('#table').append('<td class="qqty">' + val3 + '</td>');
            }
        


    });
    
});




	$(function(){
		// datepicker('.dob');

		// fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".document_file", "./assets/uploads/temp/"], ['.document', '.document_image', '<?php echo base_url()."assets/uploads/temp"; ?>']);

		fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".auditor_image", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.auditor_picture', '.auditor_photo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);
	
		fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".comp_emb", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.comp_photo', '.comp_logo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);
		

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
</script>