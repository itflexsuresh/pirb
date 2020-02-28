<?php
$description 	= isset($result['description']) ? $result['description'] : '';
$documentsid 	= isset($result['id']) ? $result['id'] : '';
$file 			= isset($result['file']) ? $result['file'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Documents/Letters</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Documents/Letters</li>
			</ol>
		</div>
	</div>
</div>

<?php echo $notification; ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<form class="mt-4 form documents" action="" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Description *</label>
							<input type="text" class="form-control"  name="description" id="description"  value="<?php echo $description; ?>">
							</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Attachments</h4>
						<div class="form-group">
							<div class="photo_upload">
								<img src="<?php echo ($file!='') ? $filepath.$file : base_url().'assets/images/profile.jpg'; ?>" class="photo_image" width="100">
							</div>
							<input type="file" class="photo_file">
							<input type="hidden" name="image" class="photo" value="<?php echo $file; ?>">
							<p>(Image/File Size Smaller than 5mb)</p>
						</div>
					</div>
				</div>

				<div class="col-md-12 text-left">
					<input type="hidden" name="documentsid" id="documentsid" value="<?php echo $documentsid; ?>">
					<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">
				</div>				
			</form>	

			<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date of </br>Upload/Update</th>
								<th>Description</th>
								<th>Attachment</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>		
		</div>
	</div>
</div>



<script type="text/javascript">


$(function(){

	datatable();

	fileupload([".photo_file", "./assets/uploads/documents/<?php echo $id; ?>/",['jpg','gif','jpeg','png','pdf','tiff']], ['.photo', '.photo_image', '<?php echo base_url()."assets/uploads/documents/".$id; ?>', '<?php echo base_url()."assets/images/pdf.png"?>']);
	
	validation(
		'.documents',
		{
			
			description : {
				required	: true,
			},
			image : {
				required	: true,
			}
		},
		{
			
			description 	: {
				required	: "Description field is required.",
			}
		},
		{
			ignore : '.test',
		}
	);


	$('#submit').click(function(e){
		
		if($('form.documents').valid()==false){
			accord = $('.error_class_1').parents('.collapse').addClass('show');			
		}
		
	})




});

$('.search').on('click',function(){		
		datatable(1);
});

function datatable(destroy=0){
	var documentsid		= $('#documentsid').val();
	var options = {
		url 	: 	'<?php echo base_url()."resellers/cocstatement/index/DTResellers"; ?>',
		data    :   { customsearch : 'listsearch1',documentsid : documentsid},  			
		destroy :   destroy,  			
		columns : 	[							
						{ "data": "datetime" },
						{ "data": "description" },
						{ "data": "file" },
						{ "data": "action" },
					]
	};
	
	ajaxdatatables('.datatables', options);
}

</script>

<style type="text/css">
.progress-circle span {
    display: none;
}
</style>