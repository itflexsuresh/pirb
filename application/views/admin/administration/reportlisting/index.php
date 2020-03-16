<?php
if(isset($result) && $result)
{	
	$id 			= $result['id'];	 	
	$installation 	= isset($result['installation_id']) ? $result['installation_id'] : set_value ('installation');	
	$regulation 	= isset($result['regulation']) ? $result['regulation'] : set_value ('regulation');
	$subtype 		= isset($result['subtype_id']) ? $result['subtype_id'] : set_value ('subtype');

	$knowledge 		= isset($result['knowledge_link']) ? $result['knowledge_link'] : set_value ('knowledge');	
	$statement 		= isset($result['statement']) ? $result['statement'] : set_value ('statement');
	$comment 		= isset($result['comments']) ? $result['comments'] : set_value ('comment');	
	$compliment 	= isset($result['compliment']) ? $result['compliment'] : set_value ('compliment');
	$refix_complete = isset($result['refix_complete']) ? $result['refix_complete'] : set_value ('refix_complete');
	$caution 		= isset($result['cautionary']) ? $result['cautionary'] : set_value ('caution');
	$refix_incomp 	= isset($result['refix_incomplete']) ? $result['refix_incomplete'] : set_value ('refix_in');
	$status 		= isset($result['status']) ? $result['status'] : set_value ('status');	
	$heading		= 'Update';
}
else
{
	$id 			= '';	
	$installation 	= set_value('installation');
	$regulation 	= set_value('regulation');
	$subtype 		= set_value('subtype');
	$knowledge 		= set_value('knowledge');
	$statement 		= set_value('statement');
	$comment 		= set_value('comment');
	$compliment 	= set_value('compliment');
	$refix_complete = set_value('refix_complete');
	$caution 		= set_value('caution');
	$refix_incomp 	= set_value('refix_in');	
	$status 		= set_value('status');
	$heading		= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Report Statement Listings</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Report Statement Listings</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Report Statement Listings</h4>
				<?php if($checkpermission){ ?>
					<form class="mt-4 form" action="" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Installation Type</label>
									<?php echo form_dropdown('installation', $installationtypelist, $installation, ['id' => 'repo_installation', 'class' => 'form-control']); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">SANS/Regulation/Bylaw Reference</label>
									<input type="text" class="form-control" id="regulation" name="regulation" value="<?php echo $regulation; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group"> 
									<label>Sub Type</label>
									<?php echo form_dropdown('subtype', [], $subtype, ['id' => 'repo_subtype', 'class' => 'form-control']); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Knowledge Reference link</label>
									<input type="text" class="form-control" id="knowledge" name="knowledge" value="<?php echo $knowledge; ?>">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Statement</label>
									<textarea class="form-control" id="statement" name="statement" placeholder="Statement" ><?php echo $statement;?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Comments</label>
									<textarea class="form-control" id="comment" name="comment" placeholder="Comments"><?php echo $comment; ?></textarea>						
								</div>
							</div>
						</div>

						<h5>Performance Point Allocation</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Compliment</label>
									<input type="number" class="form-control" id="compliment" name="compliment" value="<?php echo $compliment; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Refix (Complete)</label>
									<input type="number" class="form-control" id="refix_complete" name="refix_complete" value="<?php echo $refix_complete; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Cautionary</label>
									<input type="number" class="form-control" id="caution" name="caution" value="<?php echo $caution; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Refix (In-Complete)</label>
									<input type="number" class="form-control" id="refix_in" name="refix_in" value="<?php echo $refix_incomp; ?>">
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
									<input type="checkbox" class="custom-control-input" <?php echo ($status=='1') ? 'checked="checked"' : ''; ?> value="1" name="status" id="vatvendor">
									<label class="custom-control-label" for="vatvendor">Active</label>
								</div>
							</div>
							<div class="col-md-6 text-right">
								<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
							</div>
						</div>
					</form>
				<?php } ?>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Report Listing ID Number</th>
								<th>Installation Type</th>
								<th>Sub Type</th>
								<th>Compliment</th>
								<th>Cautionary</th>
								<th>Refix (Complete)</th>
								<th>Refix (In-Complete)</th>
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
		
		subtypereportinglist(['#repo_installation','#repo_subtype'], ['', '']);

		var options = {
			url 	: 	'<?php echo base_url()."admin/administration/reportlisting/index/DTReportListing"; ?>',
			columns : 	[	

			{ "data": "id" },
			{ "data": "installation_id" },
			{ "data": "subtype_id" },
			{ "data": "compliment" },
			{ "data": "cautionary" },
			{ "data": "refix_complete"},
			{ "data": "refix_incomplete"},
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
					// remote		: 	{
					// 	url	: "<?php //echo base_url().//'admin/administration/reportlisting/InstallationTypeValidation'; ?>",
					// 	type: "post",
					// 	async: false,
					// 	data: {
					// 		name: function() {
					// 			return $( "#name" ).val();
					// 		},
					// 		id: function() {
					// 			return $( "#id" ).val();
					// 		}
					// 	}

					// }
				},

				regulation: {
					required: true,
				},
				// subtype : {
				// 	required: true,	
				// },
				knowledge :{
					required : true,
				},
				statement: {
					required: true,
				},
				comment : {
					required : true,
				},
				compliment :{
					required : true,
				},
				refix_complete : {
					required : true,
				},
				caution : {
					required : true,
				},
				refix_in : {
					required : true,
				}
			},
			{
				installation 	: {
					required	: "Please choose the installationtype.",
					//remote		: "Installation Type Already Exists."
				},
				regulation : {
					required: "Please enter the SANS/Regulation/Bylaw Reference"

				},
				// subtype : {
				// 	required: "Please choose the subtype"
				// },
				knowledge : {
					required : "Please enter the Knowledge Reference Link"
				},
				statement : {
					required : "Please enter the statement"
				},
				comment : {
					required : "Please enter the comments"
				},
				compliment : {
					required : "Please enter the compliment" 
				},
				refix_complete :{
					required : "Please enter the refix Complete"
				},
				caution :{
					required : "Please enter the caution"
				},
				refix_in :{
					required : "Please enter the Refix In-Complete"
				}

			},[],'1'
			);
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/administration/reportlisting/index'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
