<?php
if(isset($result) && $result)
	{	

	$id 			= $result['id'];	 	
	$installation 	= isset($result['installationtype_id']) ? $result['installationtype_id'] : set_value ('installation');
	$subtype 		= isset($result['subtype_id']) ? $result['subtype_id'] : set_value ('subtype');	
	$statement 		= isset($result['statement_id']) ? $result['statement_id'] : set_value ('statement');
	$comment 		= isset($result['comments']) ? $result['comments'] : set_value ('comment');	
	$favour 		= isset($result['favour_name']) ? $result['favour_name'] : set_value ('favour_name');	
	$status 		= isset($result['status']) ? $result['status'] : set_value ('status');	
	$heading		= 'Update';

}
else
{
	$id 			= '';	
	$installation 	= set_value('installation');	
	$subtype 		= set_value('subtype');	
	$statement 		= set_value('statement');
	$comment 		= set_value('comment');
	$favour 		= set_value('favour_name');
	$status 		= set_value('status');
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
				<h4 class="card-title">My Report Listings</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"> 
								<label for="installation">Installation Type</label>
								<?php echo form_dropdown('installation', $installationtypelist, $installation, ['id' => 'repo_installation', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="subtype">Sub Type</label>
								<?php echo form_dropdown('subtype', [], $subtype, ['id' => 'repo_subtype', 'class' => 'form-control']); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"> 
								<label for="statement">Statement</label>
								<?php echo form_dropdown('statement', [], $statement, ['id' => 'repo_statement', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="comment">Comments</label>
								<textarea class="form-control" id="comment" name="comment" placeholder="Comments"><?php echo $comment; ?></textarea>						
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">My Report Listings/Favourates Name</label>
								<input type="text" class="form-control" name="favour_name" id="favour_name" value="<?php echo $favour; ?>" placeholder="Favourates Name">								
							</div>
						</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" <?php echo ($status=='1') ? 'checked="checked"' : ''; ?> value="1" name="status" id="status">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
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
		
		//subtype(['#repo_installation','#repo_subtype', 'repo_statement'], ['']);
		subtypereportinglist(['#repo_installation','#repo_subtype','#repo_statement'], ['', '']);

		var options = {
			url 	: 	'<?php echo base_url()."auditor/reportlisting/Index/DTReportListing"; ?>',
			columns : 	[	

			{ "data": "favour_name" },
			{ "data": "installation_id" },
			{ "data": "subtype_id" },
			{ "data": "comments" },
			{ "data": "status" },			
			{ "data": "action" }
			]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				installation : {
					required	: true,				
				},				
				subtype : {
					required: true,	
				},				
				// statement: {
				// 	required: true,
				// },
				comment : {
					required : true,
				},
				favour_name : {
					required : true,
				}
			},
			{
				installation 	: {
					required	: "Please choose the installationtype."					
				},				
				subtype : {
					required: "Please choose the subtype"
				},
				
				// statement : {
				// 	required : "Please choose the statement"
				// },
				comment : {
					required : "Please enter the comments"
				},
				favour_name : {
					required : "Please enter the name"
				}

			},[],'1'
			);
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'auditor/reportlisting/index'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
