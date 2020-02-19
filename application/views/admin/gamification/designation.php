<?php
if(isset($result) && $result){

	//$id 			= $result['id'];
	//$name 			= (set_value('name')) ? set_value('name') : $result['name'];
	//$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading		= 'Update';
}else{
	$id 			= '';
	$name			= set_value('name');
	$status			= set_value('status');

	$heading		= 'Save';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Designation Specialisation Points</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Designation Specialisation Points</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Designation Specialisation Points</h4>

				<div class="table-responsive m-t-40">
					<form class="mt-4 form" action="" method="post">
					    <table class="table  fullwidth" border="1">
					    	<thead>
							<tr>
								<th>Designation/Specialisation</th>
								<th>Points</th>
								<th></th>
							</tr>
					 		</thead>
					 			<?php if(count($permission_list) > 0)
					         {
					          	foreach($permission_list as $key=>$val)
					         	{  
                            
								?> 
					 		<tbody>
							<tr>
								<td><?php  echo $key; ?></td>
								<td></td>
								<td></td>
							</tr>
							<?php foreach($val as $k=>$v)
							{

   							?>
							<tr>
								<td><?php echo $v['name'];?></td>	
								<td><?php echo $v['points'];?></td>	
                                 <td> <a href="#edit_user" class="open-edit_user" id="edit_points" data-toggle="modal" data-user_id="<?php echo $v['id']; ?>"><i class="fa fa-pencil-alt"></i></a></td>
							</tr>

						<?php }?>
						</tbody>
						<?php }}?>
					    </table>

				      
			        </form>		
			    </div>
		    </div>
	    </div>
    </div>
</div>
<div id="edit_user" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<form class="skillform" >
								<div class="modal-header">
									
								<h4 class="modal-title">Edit Specialisation Points</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input id="name" type="text" class="form-control skill_training" readonly>
												<div class="special" style="color: red;">  </div></br>
												<label>Designation/Spectialisation Point allocation*:</label>
												<input name="points" id="points" type="number" min="0" class="form-control skill_training">
												
											</div>
											<div class="otp-status"></div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="skill_id" class="skill_id" id="form_id">
									<button type="submit" class="btn btn-success save" id="save">Save</button>
								</div>
								
							</form>
						</div>
					</div>
				</div>
   <script type="text/javascript">
$(document).ready(function(){
$('#name').html('');
       $('#points').html('');
});

$(document).on('click', '#edit_points', function($user_id)
{
var point = $(this).attr('data-user_id');

$.ajax({
               url: "<?php echo base_url()."admin/gamification/Designation/edit_check"; ?>",
               method: "post",
               dataType: "json",
               data : { id : $(this).attr('data-user_id') },
               success: function (jdata) {
                   var jsonData=jdata
                   console.log(jsonData.name)
                   $('#name').val(jsonData.name);
                   $('#points').val(jsonData.points);
                   $('#form_id').val(point);
               }
           });

})


$(document).on('click', '#save', function($user_id)
{

var point = $('#form_id').val();
var item = $('#name').val();
var poin = $('#points').val();

$.ajax({
url: "<?php echo base_url()."admin/gamification/Designation/editpoint"; ?>",
method: "post",
dataType: "json",
data : { 'id' : point,'name': item,'points': poin,},
success: function (jdata)
{
 
$('#edit_user').hide();          
}
});

})



</script>



