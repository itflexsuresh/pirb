
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Statement</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">	
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<input type="hidden" name="usersid" id="usersid" value="<?php echo $usersid; ?>">
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Date and Time of</br>Allocation</th>
								<th>Reseller</br>Invoice Number</th>
								<th>Licensed Plumber</br>Name Surname</th>
								<th>Licensed Plumbers</br>Employer</th>
							</tr>
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>
		
<script>
	$(function(){
		datatable();
	});
	
	$('.search').on('click',function(){		
		datatable(1);
	});
	
	function datatable(destroy=0){
		var user_id		= $('#usersid').val();
		var options = {
			url 	: 	'<?php echo base_url()."ajax/index/ajaxdtresellers"; ?>',
			data    :   { customsearch : 'listsearch1',roletype:6,user_id : user_id, search_reg_no:$('#reg_no').val(), search_plumberstatus:$('#plumberstatus').val(), search_idcard:$('#idcard').val(), search_mobile_phone:$('#mobile_phone').val(), search_dob:$('#dob').val(), search_company_details:$('#company_details').val()},  			
			destroy :   destroy,  			
			columns : 	[							
							{ "data": "cocno" },
							{ "data": "status" },
							{ "data": "datetime" },
							{ "data": "invoiceno" },
							{ "data": "name" },
							{ "data": "company" },
						]
		};
		
		ajaxdatatables('.datatables', options);
	}
	
	
</script>
