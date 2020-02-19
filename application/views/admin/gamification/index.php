<?php
if(isset($result) && $result)
{	
	$id 			= isset($result['id']) ? $result['id'] : '';	
	$item 			= isset($result['item']) ? $result['item'] : set_value ('item');	
		
	$points 		= isset($result['points']) ? $result['points'] : set_value ('points');
	$heading		= 'Update';
}

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Company Points</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Company Points</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Company Points</h4>
				
				<form class="mt-4 form" action="" method="post">
					<div class="modal fade" id="edit_user" role="dialog"> 
						<div class="modal-dialog">   
							<div class="modal-content"> 
								<!-- <div class="modal-header"> -->
									<div class="col-md-12">   
										<button type="button" class="close" data-dismiss="modal">&times;</button>   
										<h4 class="modal-title">Edit Item Points</h4> 
									</div> 
									<div class="modal-body">   
										<div class="fetched_user">
											
												
											
											<label>Item</label>
											<input type="text" class="form-control" id="item" name="item" value="" readonly="readonly">									
											<label>Point allocation*:</label>
											<input type="number" min="0" class="form-control"  id="points" name="points" value="">
										
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
										<th>Points</th>								
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if(count($result)) { ?>

										<?php foreach ($result as $key => $value) {  
											?>
											<tr>
																				
												<td><?php echo $value["item"]; ?></td>
												<td><?php echo $value["points"]; ?></td>

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
	$(document).ready(function(){
		$('#item').html('');
        $('#points').html('');
	});

$(document).on('click', '#edit_points', function($user_id)
{
	var point = $(this).attr('data-user_id');
	
	$.ajax({
                url: "<?php echo base_url()."admin/gamification/index/edit_check"; ?>",
                method: "post",
                dataType: "json",
                data : { id : $(this).attr('data-user_id') },
                success: function (jdata) {
                    var jsonData=jdata
                    console.log(jsonData.item)
                    $('#item').val(jsonData.item);
                    $('#points').val(jsonData.points);
                    $('#form_id').val(point);
                }
            });

})


$(document).on('click', '#add_points', function($user_id)
{
	
	var point = $('#form_id').val();
	var item = $('#item').val();	
	var poin = $('#points').val();
	 
	$.ajax({
		url: "<?php echo base_url()."admin/gamification/index/editpoint"; ?>",
		method: "post",
		dataType: "json",
		data : { 'id' : point,'item': item,'poin': poin,},
		success: function (jdata) 
		{
			$('#edit_user').hide();					                    
		}
	});

})



</script>