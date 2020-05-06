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
<!-- <?php echo $notification; ?> -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
				<form class="form" method="post">

					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><span class="hidden-sm-up"><!-- <i class="ti-home"> </i>--></span> <span class="hidden-xs-down">Plumber Audit History</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab"><span class="hidden-sm-up"><!-- <i class="ti-user"></i> --></span> <span class="hidden-xs-down">Audit Review</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><span class="hidden-sm-up"><!-- <i class="ti-email"> --></i></span> <span class="hidden-xs-down">Diary/Comments</span></a> </li>						
					</ul>

					
					<div class="tab-content tabcontent-border">
						<div class="tab-pane active p-20" id="tab1" role="tabpanel">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Number Audits Done to Date *</label>							
										<input type="text" class="form-control"  name="numberaudits">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Total Number of Audit Findings *</label>
										<input type="text" class="form-control"  name="caution">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Cautionary Audit Findings *</label>
										<input type="text" class="form-control"  name="caution">

									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Refix (In-Complete) Audit Findings *</label>
										<input type="text" class="form-control"  name="caution">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Refix (Complete) Audit Findings *</label>
										<input type="text" class="form-control"  name="caution">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>No Audit Findings Audit Findings *</label>
										<input type="text" class="form-control"  name="caution">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">							
									<table id="table" class="table table-bordered table-striped datatables fullwidth">
										<thead>
											<tr>
												<th>Audit Date</th>
												<th>Auditor</th>        
												<th>Installatation Type</th>
												<th>Sub Type</th>
												<th>Statements</th>
												<th>Audit Finding</th>										
											</tr>
										</thead>
								<!-- <tbody>
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
								</tbody> -->
							</table>
						</div>
					</div>
				</div>	

				<div class="tab-pane p-20" id="tab2" role="tabpanel">
					<h4 class="card-title">Plumbers Details</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Registration Number *</label>
								<input type="text" class="form-control"  name="regnumber">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumbers Name and Surname *</label>
								<input type="text" class="form-control"  name="plumname">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Phone (Work) *</label>
								<input type="text" class="form-control"  name="phonework">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Phone (Mobile) *</label>
								<input type="text" class="form-control"  name="phonemobile">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Plumbers Image</label>
								<div>
									<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="auditor_photo" width="100">
								</div>
								<input type="file" class="plumber_image" >
								<input type="hidden" name="plumber_picture" class="plumber_picture">			
							</div>
						</div>
					</div>
					<h4 class="card-title">COC Details</h4>
					<h4 class="card-title">View COC Details in full</h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Certificate No *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Plumbing Work Completion Date *</label>							
								<input type="date" class="form-control"  name="numberaudits">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Owners Name *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name of Complex/Flat (if applicable) *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Street *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Number *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Province *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">City *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Suburb *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Contact Mobile *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Alternate Contact *</label>							
								<input type="text" class="form-control"  name="numberaudits">
							</div>
						</div>
					</div>

					<h4 class="card-title">Audit Review</h4>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Date of Audit *</label>							
							<input type="date" class="form-control"  name="numberaudits">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Overall Workmanship *</label>							
							<input type="text" class="form-control"  name="numberaudits">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Licensed Plumber Present *</label>							
							<input type="text" class="form-control"  name="numberaudits">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Was COC Completed Correctly *</label>							
							<input type="text" class="form-control"  name="numberaudits">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Place Audit on hold</label>							
							<input type="radio" class="form-control"  name="numberaudits">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Why was Audit placed on hold?</label>							
							<textarea class="form-control"  name="numberaudits"></textarea>
						</div>
					</div>

					<div class="table-responsive m-t-40">
						<table class="table table-bordered table-striped datatables fullwidth">
							<thead>
								<tr>
									<th>Review Type</th>
									<th>Statement</th>
									<th>Comments</th>
									<th>Images</th>
									<th>Performance Points</th>
									<th>Refix Status</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Refix Period (Days) *</label>							
							<input type="number" class="form-control"  name="numberaudits">
						</div>
					</div>
					<div class="col-md-6 text-right">
							
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Add a Review</button>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Date and Time of Report submitted: *</label>							
							<input type="text" class="form-control"  name="numberaudits">
						</div>
					</div>
					

				
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
		
		var options = {
			url 	: 	'<?php echo base_url()."auditor/statement/index/DTReportlist"; ?>',
			columns : 	[
			{ "data": "reportlist" },
			{ "data": "installationtype" },
			{ "data": "subtype" },
			{ "data": "comments" },
			{ "data": "status" }
			]
		};
		

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