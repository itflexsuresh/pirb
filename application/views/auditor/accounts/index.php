<?php 
	// echo '<pre>'; print_r($auditordet);
	$billingname = isset($auditordetail['company_name']) ? $auditordetail['company_name'] : '';
	$billingaddress = explode("@-@",$auditordetail['billingaddress']);
	$address2 = isset($billingaddress[2]) ? $billingaddress[2] : '';
	$address3 = isset($auditordetail['suburb']) ? $auditordetail['suburb'] : '';
	$address4 = isset($auditordetail['city']) ? $auditordetail['city'] : '';
	$address5 = isset($auditordetail['province']) ? $auditordetail['province'] : '';
	$work_phone = isset($auditordetail['work_phone']) ? $auditordetail['work_phone'] : '';
	$email = isset($auditordetail['email']) ? $auditordetail['email'] : '';

	$bank_name = isset($bankdetail['bank_name']) ? $bankdetail['bank_name'] : '';
	$branch_code = isset($bankdetail['branch_code']) ? $bankdetail['branch_code'] : '';
	$account_name = isset($bankdetail['account_name']) ? $bankdetail['account_name'] : '';
	$account_no = isset($bankdetail['account_no']) ? $bankdetail['account_no'] : '';
	$account_type = isset($bankdetail['account_type']) ? $bankdetail['account_type'] : '';

	$editid = isset($result['inv_id']) ? $result['inv_id'] : '';
?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Invocie Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Invocie Details</li>
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

					<h4 class="card-title">Invocie Details</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $billingname;?></label>
							</div>
						</div>
						<div class="col-md-6">
						<div class="form-group ">
							<label for="name">Invoice Date</label>
							<input type="text" class="form-control invoicedate" name="invoicedate" id="invoicedate" data-date="datepicker" value="">
						</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $address2;?></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name">Invoice number</label>
								<input type="text" autocomplete="off" class="form-control" id="invoiceno" name="invoiceno" value="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $address3;?></label>								
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $address4;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $address5;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $work_phone;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $email;?></label>
							</div>
						</div>						
					</div>
				
					<div class="row">
						<div class="col-md-12">	
							<input type="hidden" name="editid" id="editid" value="<?php echo $editid;?>">
							<table id="table" class="table table-bordered table-striped datatables fullwidth">
								<thead>
									<tr>
										<th>Description</th>
										<th>QTY</th>        
										<th>Rate</th>
										<th>Amount</th>										
									</tr>									
								</thead>
							</table>							
						</div>

					</div>
					
					</br>
					<div class="row">					
						<h5 class="card-title">Banking Detail</h5>
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $bank_name;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $branch_code;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $account_name;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $account_no;?></label>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $account_type;?></label>
							</div>
						</div>						
					</div>


					<div class="row" style="float: right;">
						<div class="col-md-12">
							<button type="submit" style="float: right;" name="submit" id="submit" value="submit" class="btn btn-block btn-primary btn-rounded">Submit Invoice</button>
						</div>
					</div>


						<h4 class="card-title" style="clear: both;">My Accounts</h4>
						<div class="row">
						<div class="col-md-12">							
							<table id="table2" class="table table-bordered table-striped datatables2 fullwidth">
								<thead>
									<tr>
										<th>Description</th>
										<th>Inv Number</th>        
										<th>Invocie Date</th>
										<th>Invoice Value</th>
										<th>Status</th>	
										<th>Action</th>									
									</tr>
								</thead>
							</table>							
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	
$(function(){
	datepicker('.invoicedate');

	validation(
		'.form',
		{
			invoicedate : {
				required	: true,
			},
			invoiceno : {
				required	: true,
			},
			editid : {
				required	: true,
			}
						

		},

		{
			invoicedate 	: {
				required	: "Please enter the Invoice date."
			},
			invoiceno 	: {
				required	: "Please enter the Invoice No."
			},
			editid 	: {
				required	: "Please Select the Invoice."
			}
		}
	);

	var options = {
		url 	: '<?php echo base_url()."auditor/accounts/Index/DTAccounts"; ?>',
		columns : 	[
		{ "data": "description" },
		{ "data": "inv_id" },
		{ "data": "created_at" },
		{ "data": "total_cost" },		
		{ "data": "status" },
		{ "data": "action" },	
		
		],
		
	};
	
	ajaxdatatables('.datatables2', options);

	var editid = $("#editid").val();
	if( editid > 0){
		var options = {
			url 	: '<?php echo base_url()."auditor/accounts/Index/DTAccounts2/"; ?>'+editid,
			columns : 	[
			{ "data": "description" },
			{ "data": "qty" },
			{ "data": "total_cost" },
			{ "data": "total_cost" }
			
			],			
			paging :   false,
			ordering: false,
			info:     false
			
		};

		ajaxdatatables('.datatables', options);
	}


});
</script>