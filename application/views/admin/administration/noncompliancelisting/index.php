<?php
if(isset($result) && $result)
{	
	$id 				= $result['id'];	 	
	$installationtype 	= isset($result['installationtype']) ? $result['installationtype'] : set_value ('installationtype');	
	$subtype 			= isset($result['subtype']) ? $result['subtype'] : set_value ('subtype');	
	$statement 			= isset($result['statement']) ? $result['statement'] : set_value ('statement');	
	$details 			= isset($result['details']) ? $result['details'] : set_value ('details');	
	$action 			= isset($result['action']) ? $result['action'] : set_value ('action');	
	$reference 			= isset($result['reference']) ? $result['reference'] : set_value ('reference');	
	$status 			= isset($result['status']) ? $result['status'] : set_value ('status');	
	$heading			= 'Update';
}
else
{
	$id 				= '';	
	$installationtype 	= set_value('installationtype');
	$subtype 			= set_value('subtype');
	$statement 			= set_value('statement');
	$details 			= set_value('details');
	$action 			= set_value('action');
	$reference 			= set_value('reference');
	$status 			= set_value('status');
	$heading			= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Non Compliance Statement Listings</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Non Compliance Statement Listings</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Non Compliance Statement Listings</h4>
				<?php if($checkpermission){ ?>
					<form class="mt-4 form" action="" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group"> 
									<label for="installationtype">Installation Type</label>
									<?php echo form_dropdown('installationtype', $installationtypelist, $installationtype, ['id' => 'installationtype', 'class' => 'form-control']); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group"> 
									<label for="subtype">Sub Type</label>
									<?php echo form_dropdown('subtype', [], '', ['id' => 'subtype', 'class' => 'form-control']); ?>
								</div>
							</div>								
							<div class="col-md-12">
								<div class="form-group">
									<label for="statement">Statement</label>
									<?php echo form_dropdown('statement', [], '', ['id' => 'statement', 'class' => 'form-control']); ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="details">Non compliance details</label>
									<textarea class="form-control" id="details" name="details" placeholder="Non compliance details"><?php echo $details; ?></textarea>						
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="action">Possible remedial actions</label>
									<textarea class="form-control" id="action" name="action" placeholder="Possible remedial actions"><?php echo $action; ?></textarea>						
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="reference">SANS/Regulation/Bylaw Reference</label>
									<input type="text" class="form-control" id="reference" name="reference" placeholder="SANS/Regulation/Bylaw Reference" value="<?php echo $reference; ?>">
								</div>
							</div>
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
								<th>Non Compliance Listing Number</th>
								<th>Installation Type</th>
								<th>Sub Type</th>
								<th>Non Compliance Details</th>
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
		subtypereportinglist(['#installationtype','#subtype','#statement'], ['<?php echo $subtype; ?>', '<?php echo $statement; ?>']);

		var options = {
			url 	: 	'<?php echo base_url()."admin/administration/noncompliancelisting/index/DTComplianceListing"; ?>',
			columns : 	[	
				{ "data": "id" },
				{ "data": "installationname" },
				{ "data": "subtypename" },
				{ "data": "details" },
				{ "data": "status" },
				{ "data": "action"}
			],
			target	:	[5],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				installationtype : {
					required	: true
				},
				subtype: {
					required: true,
				},
				statement: {
					required: true,
				},
				details : {
					required : true,
				},
				action :{
					required : true,
				},
				reference : {
					required : true,
				}
			},
			{
				installationtype : {
					required	: "Please choose the installationtype."
				},
				subtype : {
					required	: "Please choose the subtype"
				},
				statement: {
					required	: "Please choose the statement"
				},
				details : {
					required 	: "Please enter the Non compliance details"
				},
				action : {
					required 	: "Please enter the Possible remedial actions"
				},
				reference : {
					required	: "Please enter the SANS/Regulation/Bylaw Reference"
				},
				status :{
					required 	: "Please check the status"
				}
			}
		);
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/administration/noncompliancelisting/index'; ?>';
		var data	= 	'\
			<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
			<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
