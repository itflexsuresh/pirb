<?php
if(isset($result) && $result){
	$id 			= $result['id'];
	$name 			= (set_value('name')) ? set_value('name') : $result['name'];
	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading		= 'Update';
}else{
	$id 			= '';
	$name			= set_value('name');
	$status			= set_value('status');

	$heading		= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">My Report Listings</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">My Report Listings</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">				
				<form class="form" action="" method="post">

					<h4 class="card-title">My Report Listings</h4>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Installation Type *</label>
							<!-- <?php
							echo form_dropdown('address[1][installationtype]', $installationtype, '',['class'=>'form-control']);
							?> -->
							<input type="text" class="form-control"  name="insta_type">
						</div>
					</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Sub Type *</label>
								<input type="text" class="form-control"  name="subtype">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Statement *</label>
								<input type="text" class="form-control"  name="statement">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Comments *</label>
								<textarea class="form-control" rows="2" cols="10" name="comments"> </textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>My Report Listings/Favourates Name *</label>
								<textarea class="form-control" rows="2" cols="10" name="reportlist"> </textarea>
							</div>
						</div>
					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
						</div>
					</div>
				</form>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Report Name</th>
								<th>Installation Type</th>
								<th>Sub Type</th>
								<th>Comments</th>
								<th>Active</th>
								<th>Action</th>
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
		
		var options = {
			url 	: 	'<?php echo base_url()."auditor/reportlisting/index/DTReportlist"; ?>',
			columns : 	[
			{ "data": "reportlist" },
			{ "data": "installationtype" },
			{ "data": "subtype" },
			{ "data": "comments" },
			{ "data": "status" }
			]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				installationtype : {
					required	: true,
				}
				subtype : {
					required	: true,
				}
				statement : {
					required	: true,
				}
				comments : {
					required	: true,
				}
				reportlist : {
					required	: true,
				}
			},
			{
				installationtype 	: {
					required	: "Please select installation type."
				}
				subtype 	: {
					required	: "Please select subtype."
				}
				statement 	: {
					required	: "Please select statement."
				}
				comments 	: {
					required	: "Please enter the comment."
				}
				reportlist 	: {
					required	: "Please enter the reportlist."
				}
			}
			);
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'auditor/reportlist/index'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
