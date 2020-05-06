<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber Register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumber Register</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Plumber Register</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber / Reg Number</label>
								<input type="text" class="form-control" id="reg_no" name="reg_no" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status:</label>
								<?php
									echo form_dropdown('status', ['' => 'Select Status']+$plumberstatus, '', ['id'=>'plumberstatus', 'class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber ID Number:</label>
								<input type="text" class="form-control" id="idcard" name="idcard" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber Mobile:</label>
								<input type="text" class="form-control" id="mobile_phone" name="mobile_phone" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber Date of Birth</label>
								<input type="text" class="form-control dob" id="dob" name="dob" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Company:</label>
								<?php
									echo form_dropdown('company_details', $company, '', ['id'=>'company_details', 'class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="submit" value="submit" class="btn btn-primary search">Search</button>
						</div>
					</div>
				</form>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Reg No</th>
								<th>Name</th>
								<th>Surname</th>
								<th>Designation</th>
								<th>Email Address</th>
								<th>Status</th>
								<th></th>
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
		datepicker('.dob');
		datatable();
	});
	
	$('.search').on('click',function(){		
		datatable(1);
	});
	
	function datatable(destroy=0){

		var options = {
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTPlumber"; ?>',
			data    :   { page : 'adminplumberlist', customsearch : 'listsearch1', search_reg_no:$('#reg_no').val(), search_plumberstatus:$('#plumberstatus').val(), search_idcard:$('#idcard').val(), search_mobile_phone:$('#mobile_phone').val(), search_dob:$('#dob').val(), search_company_details:$('#company_details').val()},  			
			destroy :   destroy,  			
			columns : 	[
							{ "data": "reg_no" },
							{ "data": "name" },
							{ "data": "surname" },
							{ "data": "designation" },
							{ "data": "email" },
							{ "data": "status" },
							{ "data": "action" }
						],
			target	:	[6],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	}
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/plumber/index'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
