<?php
if(isset($result) && $result){

	$id 			= $result['id'];
	$title 			= (set_value('title')) ? set_value('title') : $result['title'];
	$description 	= (set_value('description')) ? set_value('description') : $result['description'];
	$file 			= (set_value('file')) ? set_value('file') : $result['file'];
	$order 			= (set_value('order')) ? set_value('order') : $result['order'];
	$type 			= (set_value('type')) ? set_value('type') : $result['type'];
	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading		= 'Update';
}else{
	$id 			= '';
	$title			= set_value('title');
	$description	= set_value('description');
	$file			= set_value('file');
	$order			= set_value('order');
	$type			= set_value('type');
	$status			= set_value('status');

	$heading		= 'Add';
}

$filepath				= base_url().'assets/uploads/help/';
$uploadimg 				= base_url().'assets/images/upload.png';

if($file!=''){
	$fileimg 		= $filepath.$file;
	$fileimgurl		= $filepath.$file;
}else{
	$fileimg 		= $uploadimg;
	$fileimgurl		= 'javascript:void(0);';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Help</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Help</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if($checkpermission){ ?>
					<form class="mt-4 form" action="" method="post">
						<div class="row">
							<div class="form-group">
								<label for="title">Title *</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title*" value="<?php echo $title; ?>">
							</div>
							<div class="form-group">
								<label for="title">Description *</label>
								<textarea class="form-control" id="description" name="description" placeholder="Enter Description*"><?php echo $description; ?></textarea>
							</div>	
							<div class="form-group">
								<label>Type *</label>
								<?php
									echo form_dropdown('type', $helpgroup, $type, ['id' => 'type', 'class' => 'form-control']);
								?>
							</div>	
							<div class="form-group">
								<label>Video</label>
								<div>
									<a href="<?php echo $file1imgurl; ?>" target="_blank"><img src="<?php echo $fileimg; ?>" class="photo_image" width="100"></a>
								</div>
								<input type="file" class="photo_file">
								<input type="hidden" name="image2" class="photo" value="<?php echo $file2; ?>">
							</div>
							<div class="form-group">
								<label for="order">Order</label>
								<input type="text" class="form-control" id="order" name="order" placeholder="Enter Order*" value="<?php echo $order; ?>">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
									<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; if($status=='') echo 'checked'; ?> value="1">
									<label class="custom-control-label" for="status">Active</label>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
							</div>
						</div>
					</form>
				<?php } ?>
				<div class="table-responsive mt_20">
					<table class="table table-bordered table-striped datatables fullwidth text_left">
						<thead>
							<tr>
								<th>Name</th>
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

<script>
	$(function(){
		editor('#description');
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/help/DTHelp"; ?>',
			columns : 	[
				{ "data": "name" },
				{ "data": "status" },
				{ "data": "action" }
			],
			target	:	[2],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				title : {
					required	: true
				},
				description : {
					required	: true
				},
				type : {
					required	: true
				}
			},
			{
				title 	: {
					required	: "Title field is required."
				},
				description 	: {
					required	: "Description field is required."
				},
				type 	: {
					required	: "Type field is required."
				}
			}
		);
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/administration/installationtype'; ?>';
		var data	= 	'\
			<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		';

		sweetalert(action, data);
	})
</script>
