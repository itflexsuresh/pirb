<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Manage Auditors</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Manage Auditors</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">	
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Manage Auditors</h4>				
				<div class="col-md-6 text-right">
					<!-- <input type="hidden" name="id" value="<?php //echo $id; ?>"> -->
					<button type="button" name="submit" value="submit" onclick="window.location.href='<?php echo base_url().'admin/audits/index/action'; ?>';" class="btn btn-primary">Add New</button>
				</div>
				<div class="row">
					<div class="col-md-6">
						<a href="<?php echo base_url().'admin/audits/index/index/1'; ?>" class="active_link_btn">Active</a>  <a href="<?php echo base_url().'admin/audits/index/index/2'; ?>" class="archive_link_btn">Archive</a>
					</div>					
				</div>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Auditor Name and Surname </th>
								<th>Phone (Work)</th>
								<th>Phone (Mobile)</th>
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
			url 	: 	'<?php echo base_url()."admin/audits/index/DTAuditors"; ?>',
			columns : 	[							
							{ "data": "name" },
							{ "data": "email" },
							{ "data": "contactnumber" },
							{ "data": "action" }
						],
						data : {pagestatus : '<?php echo $pagestatus; ?>'}
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
