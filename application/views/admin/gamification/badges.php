<?php
if(isset($result) && $result)
{	

	// $id 			= isset($result['id']) ? $result['id'] : '';	
	// $item 			= isset($result['item']) ? $result['item'] : set_value ('item');	
		
	// $points 		= isset($result['points']) ? $result['points'] : set_value ('points');
	// $heading		= 'Update';


	$image 			= isset($result['badge']) ? $result['badge'] : set_value ('file1');	

	$profileimg 	= base_url().'assets/images/profile.jpg';

	$filepath 		= base_url().'assets/uploads/badge/';
	$filepath1		= (isset($result['badge']) && $result['badge']!='') ? $filepath.$result['badge'] : base_url().'assets/uploads/auditor/profile.jpg';	
	$pdfimg 		= base_url().'assets/uploads/auditor/pdf.png';

	if($image!='')
	{
		$explodefile2 	= explode('.', $image);
		$extfile2 		= array_pop($explodefile2);
		$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath1;
	}
	else
	{
		$photoidimg 	= $profileimg;
	}

}

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Badges</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Badges</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Badges</h4>
				
				<form class="mt-4 form" action="" method="post" enctype="multipart/form-data">
					<div class="modal fade" id="edit_user" role="dialog"> 
						<div class="modal-dialog">   
							<div class="modal-content"> 
								<!-- <div class="modal-header"> -->
									<div class="col-md-12">   
										<button type="button" class="close" data-dismiss="modal">&times;</button>   
										<h4 class="modal-title">Edit Badge</h4> 
									</div> 
									<div class="modal-body">   
										<div class="fetched_user">
											
											<label>Item</label>
											<input type="text" class="form-control" id="item" name="item" value="" readonly="readonly">									
											<div>
											<img src="<?php echo $photoidimg; ?>" class="badge_photo" width="100">
												</div>
											<input type="file" class="badge_image">
											<input type="hidden" name="file1" id="file1" class="badge_picture" value="">
										
										</div>
										<div class="col-md-12 text-right">
											<input type="hidden" name="form_id" id="form_id">
											<button id="add_points" type="submit" name="submit" value="submit" class="btn btn-primary">
											Save</button>
										</div> 

									</div> 


								</div>
							</div>
						</div> 

						<div class="table-responsive m-t-40">
							<table class="table table-bordered table-striped datatables fullwidth">
								<thead>
									<tr>
										<th>Item</th>
										<th>Badge</th>								
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if(count($result)) { ?>

										<?php foreach ($result as $key => $value) {  
											?>
											<tr>
																				
												<td><?php echo $value["item"]; ?></td>
												<td><?php echo $value["badge"]; ?></td>

											    <td> <a href="#edit_user" class="open-edit_user" id="edit_points" data-toggle="modal" data-user_id="<?php echo $value["id"]; ?>"><i class="fa fa-pencil-alt"></i></a></td>

											</tr>
										<?php } ?>

									<?php } ?>

								</tbody>




							</table>
						</div>

						<!-- <div class="row">						
							<div class="col-md-12 text-right">
								<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">
								Update</button>
							</div>
						</div> -->
					</form>


				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">
	
	$(function()
	{
		
		fileupload([".badge_image", "./assets/uploads/badge/", ['jpg','gif','jpeg','png','pdf','tiff','tif']], ['.badge_picture', '.badge_photo', '<?php echo base_url()."assets/uploads/badge/"; ?>']);
	});

	$(document).ready(function(){
		$('#item').html('');
        $('#file1').html('');
	});

$(document).on('click', '#edit_points', function($user_id)
{
	var point = $(this).attr('data-user_id');
	
	$.ajax({
                url: "<?php echo base_url()."admin/gamification/Badges/edit_check"; ?>",
                method: "post",
                dataType: "json",
                data : { id : $(this).attr('data-user_id') },
                success: function (jdata) {
                    var jsonData=jdata
                    console.log(jsonData.item)
                    $('#item').val(jsonData.item);
                    $('#file1').val(jsonData.badge);
                    $('img.badge_photo').attr('src',"<?php echo base_url(); ?>/assets/uploads/badge/"+jsonData.badge);
                    $('#form_id').val(point);
                }
            });

})


$(document).on('click', '#add_points', function($user_id)
{
	
	var point = $('#form_id').val();
	var item = $('#item').val();	
	var poin = $('#file1').val();
	 	
	$.ajax({
		url: "<?php echo base_url()."admin/gamification/Badges/editpoint"; ?>",
		method: "post",
		dataType: "json",
		data : { 'id' : point,'item': item,'file1': poin,},
		success: function (jdata) 
		{
			$('#edit_user').hide();					                    
		}
	});

})



</script>