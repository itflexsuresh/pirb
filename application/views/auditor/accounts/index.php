<?php 
	// echo '<pre>'; print_r($auditordet);
echo $_SERVER['DOCUMENT_ROOT'];
	$billingname = isset($auditordetail['company_name']) ? $auditordetail['company_name'] : '';
	$billingaddress = explode("@-@",$auditordetail['billingaddress']);
	$address2 = isset($billingaddress[2]) ? $billingaddress[2] : '';
	$address3 = isset($auditordetail['suburb']) ? $auditordetail['suburb'] : '';
	$address4 = isset($auditordetail['city']) ? $auditordetail['city'] : '';
	$address5 = isset($auditordetail['province']) ? $auditordetail['province'] : '';
	$work_phone = isset($auditordetail['work_phone']) ? $auditordetail['work_phone'] : '';
	$email = isset($auditordetail['email']) ? $auditordetail['email'] : '';
	$user_id = isset($auditordetail['user_id']) ? $auditordetail['user_id'] : '';


	$bank_name = isset($auditordetail['bank_name']) ? $auditordetail['bank_name'] : '';
	$branch_code = isset($auditordetail['branch_code']) ? $auditordetail['branch_code'] : '';
	$account_name = isset($auditordetail['account_name']) ? $auditordetail['account_name'] : '';
	$account_no = isset($auditordetail['account_no']) ? $auditordetail['account_no'] : '';
	$account_type = isset($auditordetail['account_type']) ? $auditordetail['account_type'] : '';

	$editid = isset($result['inv_id']) ? $result['inv_id'] : '';
	$vat_vendor = isset($result['vat_vendor']) ? $result['vat_vendor'] : '';
	$description = isset($result['description']) ? $result['description'] : '';	
	$total_cost = isset($result['total_cost']) ? $result['total_cost'] : '';
	$vatvalue = '0';
	$total = '0';
	if($editid > 0)	{
		if($vat_vendor > 0){
			$vatper = $vat['vat_percentage'];		
			$vat_amount1 = $total_cost * $vatper / 100;
			$vatvalue = round($vat_amount1,2);

			$total = $total_cost + $vatvalue;
		}
		else{
			$total = $total_cost;
		}
	}
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
				<?php if($editid > 0) { ?>
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
							<label for="name">Your Invoice Date</label>							
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
								<input type="text" class="form-control invoicedate" name="invoicedate" id="invoicedate" data-date="datepicker" value="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $address3;?></label>								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ">								
								<label for="name">Your Invoice Number</label>								
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="name"><?php echo $address4;?></label>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group ">								
								<input type="text" autocomplete="off" class="form-control" id="invoice_no" name="invoice_no" value="">
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
							<input type="hidden" name="total_cost" id="total_cost" value="<?php echo $total_cost;?>">
							<input type="hidden" name="vat" id="vat" value="<?php echo $vatvalue;?>">
							<input type="hidden" name="total" id="total" value="<?php echo $total;?>">
							<table id="table" class="table table-bordered table-striped datatables fullwidth">
								<thead>
									<tr>
										<th>Description</th>
										<th>QTY</th>        
										<th>Rate</th>
										<th>Amount</th>										
									</tr>									
								</thead>
								<tbody>
									
								<?php 
									echo '<tr>'; 
										echo '<td>'.$description.'</td>';
										echo '<td>1</td>';
										echo '<td>'.$total_cost.'</td>';
										echo '<td>'.$total_cost.'</td>';
								
									echo '</tr>';
									echo '<tr>';
										echo '<td colspan="3">Sub Total</td>';
										echo '<td>'.$total_cost.'</td>';
									echo '</tr>';									
									echo '<tr>';
										echo '<td colspan="3">VAT Total</td>';
										echo '<td>'.$vatvalue.'</td>';
									echo '</tr>';									
									echo '<tr>';
										echo '<td colspan="3">Total</td>';
										echo '<td>'.$total.'</td>';
									echo '</tr>';
								?>
									</tr>
								</tbody>
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
				</form>
				<?php } ?>

				</br>
				<div class="row">
					<h4 class="card-title" style="clear: both;">My Accounts</h4>
					<div class="col-md-12">							
						<table id="table" class="table table-bordered table-striped datatables2 fullwidth">
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
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	
$(function(){	
	var userid = <?php echo $user_id;?>;
	datepicker('.invoicedate');	
	validation(
		'.form',
		{
			invoicedate : {
				required	: true,
			},		
			invoice_no : {
				required	: true,				
				remote		: 	{
									url		: 	"<?php echo base_url().'auditor/accounts/index/invoicenovalidation'; ?>",
									type	: 	"post",
									async	: 	false,
									data	: 	{
													id : userid
												}
								}
			}
					

		},

		{
			invoicedate 	: {
				required	: "Please enter the Invoice date."
			},
			invoice_no : {
				required	: "Invoiceno  field is required.",			
				remote		: "Invoiceno already exists."
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

	// var editid = $("#editid").val();
	// if( editid > 0){
	// 	var options = {
	// 		url 	: '<?php //echo base_url()."auditor/accounts/Index/DTAccounts2/"; ?>'+editid,
	// 		columns : 	[
	// 		{ "data": "description" },
	// 		{ "data": "qty" },
	// 		{ "data": "total_cost" },
	// 		{ "data": "total_cost" }
			
	// 		],			
	// 		paging :   false,
	// 		ordering: false,
	// 		info:     false
			
	// 	};

	// 	ajaxdatatables('.datatables', options);
	// }


});
</script>