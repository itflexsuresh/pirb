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
	$fileimgurl		= '';
}


$image 					= isset($result['image']) ? $result['image'] : set_value ('image');	
$filepath				= base_url().'assets/uploads/help/';
$pdfimg 				= base_url().'assets/images/pdf.png';
$profileimg 			= base_url().'assets/images/profile.jpg';
$photoidimg 			= $profileimg;
$photoidurl				= 'javascript:void(0);';
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
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Title *</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title*" value="<?php echo $title; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Video</label>
									<div>
										<video width="320" height="240" controls class="filevideotag displaynone">
											<source src="<?php echo $fileimg; ?>" type="video/mp4">
										</video>
										<img src="<?php echo $fileimg; ?>" class="fileimgtag displaynone" width="100">
									</div>
									<input type="file" class="file_file">
									<input type="hidden" name="file" class="file">
								</div>
								<p class="tagline">(Allowed extension mp4)</p>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Description *</label>
									<textarea class="form-control" id="description" name="description" placeholder="Enter Description*" data-editor="editor"><?php echo $description; ?></textarea>
								</div>	
							</div>	
							<div class="col-md-12">								
								<div class="form-group">
									<label>Photo</label>
									<div>
										<a href="<?php echo $photoidurl; ?>" target="_blank"><img src="<?php echo $photoidimg; ?>" class="help_photo" width="100"></a>
									</div>
									<input type="file" class="help_image">
									<p>(Image/File Size Smaller than 5mb)</p>
									<div class="help_picture"></div>
								</div>								
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Type *</label>
									<?php
										echo form_dropdown('type', $helpgroup, $type, ['id' => 'type', 'class' => 'form-control']);
									?>
								</div>	
							</div>	
							<div class="col-md-12">
								<div class="form-group">
									<label for="order">Order</label>
									<input type="text" class="form-control" id="order" name="order" placeholder="Enter Order" value="<?php echo $order; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
										<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; if($status=='') echo 'checked'; ?> value="1">
										<label class="custom-control-label" for="status">Active</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
									<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
								</div>
							</div>
						</div>
					</form>
				<?php } ?>
				<div class="table-responsive mt_20">
					<table class="table table-bordered table-striped datatables fullwidth text_left">
						<thead>
							<tr>
								<th>Title</th>
								<th>Type</th>
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
	var filepath 	= '<?php echo $filepath; ?>';
	var pdfimg		= '<?php echo $pdfimg; ?>';
	
	$(function(){
		editor('#description');
		fileupload([".file_file", "./assets/uploads/help/", ["mp4"]], ['.file', '.fileimgtag'], "", videoupload);
		fileupload([".help_image", "./assets/uploads/help/", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['image[]', '.help_picture', filepath, pdfimg], 'multiple');
		videoupload('<?php echo $file; ?>');
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/help/index/DTHelp"; ?>',
			columns : 	[
				{ "data": "title" },
				{ "data": "typename" },
				{ "data": "status" },
				{ "data": "action" }
			],
			target	:	[3],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		multiimage();
		
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
			},
			{
				ignore : []
			}
		);
	});
	
	function videoupload(data){
		$('.filevideotag, .fileimgtag').addClass('displaynone');
		
		if(data==''){
			$('.fileimgtag').removeClass('displaynone');
		}else{
			$('.filevideotag').removeClass('displaynone');
			$('.filevideotag source').attr('src', filepath+data);
		}
		
		$('.file').val(data);
	}
	
	function multiimage(){
		var image = '<?php echo $image; ?>';
		
		if(image!=''){
			var filesplit = image.split(',');
			
			$(filesplit).each(function(i, v){
				
				var ext 		= v.split('.').pop().toLowerCase();
				if(ext=='jpg' || ext=='jpeg' || ext=='png'){
					var filesrc = filepath+v;	
				}else if(ext=='pdf'){
					var filesrc = '<?php echo base_url()."assets/images/pdf.png"?>';	
				}
				
				$('.help_picture').append('<div class="multipleupload"><input type="hidden" value="'+v+'" name="image[]"><img src="'+filesrc+'" width="100"><i class="fa fa-times"></i></div>');
			})
		} 
	}
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/help/index'; ?>';
		var data	= 	'\
			<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		';

		sweetalert(action, data);
	})
</script>
