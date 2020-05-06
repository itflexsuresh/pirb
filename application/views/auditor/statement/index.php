<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'auditor/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Statement</li>
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

					<h4 class="card-title">Audit Statement</h4>
					<div class="row">
						<div class="col-md-12">							
							<table id="table" class="table table-bordered table-striped datatables fullwidth">
								<thead>
									<tr>
										<th>COC Number</th>
										<th>Status</th>        
										<th>Plumber</th>
										<th>Phone (Mobile)</th>
										<th>Refix Date</th>
										<th>Suburb</th>
										<th>Owners Name and Surname</th>
										<th>Owners Name and Surname</th>
										<th>Owners Tel Number</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr >    
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>

									</tr>
								</tbody>
							</table>
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
		
		fileupload([".auditor_image", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.auditor_picture', '.auditor_photo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);
	
		fileupload([".comp_emb", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.comp_photo', '.comp_logo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);
		

	validation(
			'.form',
			{
				name : {
					required	: true,
				},
				surname : {
					required	: true,
				},
				idnumber : {
					required	: true,
				},
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
				idnumber : {
					required	: "Please enter the ID"
				},
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