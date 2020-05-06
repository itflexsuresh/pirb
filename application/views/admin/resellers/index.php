<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Resellers List</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Resellers List</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">	
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Resellers List</h4>				
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Reseller Name</th>
								<th>Email Address</th>
								<th>Contact Number</th>
								<th>Stock Count</br> (Unallocated)</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>

				<div class="col-md-12 text-right">
					<button type="button" name="submit" value="submit" onclick="window.location.href='<?php echo base_url().'admin/resellers/index/action'; ?>';" class="btn btn-primary">Add New</button>
				</div>

			</div>
		</div>
	</div>
</div>
		
<script>
	$(function(){
		datepicker('.dob');
		datatable();
	});
	
	$('.search').on('click',function(){		
		datatable(1);
	});
	
	function datatable(destroy=0){

		var options = {
			url 	: 	'<?php echo base_url()."admin/resellers/index/DTResellers"; ?>',
			data    :   { customsearch : 'listsearch1', search_reg_no:$('#reg_no').val(), search_plumberstatus:$('#plumberstatus').val(), search_idcard:$('#idcard').val(), search_mobile_phone:$('#mobile_phone').val(), search_dob:$('#dob').val(), search_company_details:$('#company_details').val()},  			
			destroy :   destroy,  			
			columns : 	[							
							{ "data": "name" },
							{ "data": "email" },
							{ "data": "contactnumber" },
							{ "data": "stockcount" },
							{ "data": "action" }
						],
						target : [4],
						sort : '0'
		};
		
		ajaxdatatables('.datatables', options);
	}
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/resellers/index'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
