<?php
	// if(isset($result) && $result){
	// 	$id 			= $result['id'];
	// 	$name 			= (set_value('name')) ? set_value('name') : $result['name'];
	// 	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
	// 	$heading		= 'Update';
	// }else{
	// 	$id 			= '';
	// 	$name			= set_value('name');
	// 	$status			= set_value('status');
		
	// 	$heading		= 'Add';
	// }
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber Register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
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
									echo form_dropdown('status', $plumberstatus, '', ['id'=>'plumberstatus', 'class'=>'form-control']);
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber Id Number:</label>
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
		// idcard = $('#idcard').val();
		datepicker('.dob');
		data_table();
		$('.search').on('click',function(){			
			//	data_table.fnFilter( $("#input1").val(), '0' );
			data_table(1);
			//	ajaxdatatables('.datatables', options);
		});
		
		// validation(
		// 	'.form',
		// 	{
		// 		name : {
		// 			required	: true,
		// 		}
		// 	},
		// 	{
		// 		name 	: {
		// 			required	: "Plumber Register field is required."
		// 		}
		// 	}
		// );

		
	});

	function data_table(destroy=0){

		var options = {
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTPlumber"; ?>',
			// data    :   $('form').serialize(),  			
			data    :   {reg_no:$('#reg_no').val(),plumberstatus:$('#plumberstatus').val(),idcard:$('#idcard').val(),mobile_phone:$('#mobile_phone').val(),dob:$('#dob').val(),company_details:$('#company_details').val()},  			
			destroy :   destroy,  			
			columns : 	[
							{ "data": "reg_no" },
							{ "data": "name" },
							{ "data": "surname" },
							{ "data": "designation" },
							{ "data": "email" },
							{ "data": "status" },
							{ "data": "action" }
						]
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
