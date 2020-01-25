<?php
	if(isset($result) && $result){
		$id 			= $result['id'];
		$name 			= (set_value('name')) ? set_value('name') : $result['name'];
		$city  			= (set_value('city_name')) ? set_value('city_name') : $result['city_name'];
		$suburb         = (set_value('suburb')) ? set_value('suburb') : $result['suburb'];
		$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
		$heading		= 'Update';
	}else{
		$id 			= '';
		$name			= set_value('name');
		$city           = set_value('city');
		$suburb         = set_value('suburb');
		$status			= set_value('status');
		
		$heading		= 'Save';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Managearea</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Managearea </li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Managearea </h4>
				<form class="mt-4 form" action="" method="post">
					<!-- <div class="form-group">
						<label for="installationtype_id">Managearea Type *</label>
						<?php //echo form_dropdown('installationtype_id', $installationtypelist, $itid, ['id' => 'installationtype_id', 'class' => 'form-control']); ?> -->
					<!-- </div> -->
					 <div class="form-group col-6">
						<label for="name">Province*</label>
						 <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"placeholder="Select">
                        
					</div>
                    <div class="form-group col-6">
                    	
                        <input type="radio" class="radio-control box1" id="choice1" name="choice1" value="choice">
                        <label class="radio-button">New city</label>
					
                        <input type="radio" class="radio-control" id="choice1" name="choice1" value="other" checked="checked" >
                        <label class="radio-button">Existing city</label>


					</div>
					<div class="existing-city" >
                    <div class="form-group col-6">
						<label for="city">City*</label>
						
                         <input type="text"  class="form-control box" id="city" name="city"  value="<?php echo $city; ?>" placeholder="Select">
                       
					</div>
					<div class="form-group col-6">
						<label class="Subrub">Subrub</label>
                        <input type="text" class="form-control" id="suburb" name="suburb" value="<?php echo $suburb; ?>" placeholder="suburb">
                        
					</div>
					</div>
					<div class="form-group col-6 new-city" style="display:none;">
						<label class="city1">city</label>
                        <input type="text" class="form-control" id="city1" name="city1" placeholder="Please enter the city">
					</div>

					<div class="row ">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> </button>
							
						</div>
					</div>
				</form>
								<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Provice</th>
								<th>City</th>
								<th>Subrub</th>
								<!-- <th>Status</th> -->
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

	
	$("input[type='radio']").change(function(){
if($(this).val()=="other")
{
$(".new-city").hide();
}else{
	$(".new-city").show();
}

});
	$("input[type='radio']").change(function(){
if($(this).val()=="choice")
{
$(".existing-city").hide();
}
else
{
$(".existing-city").show(); 
}
});
		var options = {
			url 	: 	'<?php echo base_url()."admin/administration/managearea/managearea/DTManagearea"; ?>',
			columns : 	[
							{ "data": "name" },
                            {"data" :"city"},
                            {"data" :"suburb"},
							//{ "data": "status" },
							{ "data": "action" }
						]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				name : {
					required	: true,
				},
				city : {
					required    : true,
				},
				suburb:{
					required    : true,
				},
				city1:{
					required    : true,
				}
				
			},
			{
				name 	: {
					required	: "Please Select the province ."
				},
				city : {
					required    : "Please Select the city",
				},
				suburb : {
					required    : "Please enter the sub",
				},
				city1:{
					required    :"Please enter the city",
				}


			}
		);
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/administration/managearea/managearea'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
						
		sweetalert(action, data);
	})
</script>
