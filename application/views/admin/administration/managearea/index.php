<?php
	if(isset($result) && $result){
		$id 			= $result['id'];
		$province 		= (isset($result['province_id'])) ? $result['province_id'] : set_value('province');
		$city 			= (isset($result['city_id'])) ? $result['city_id'] : set_value('city_id');
		$suburb 		= (isset($result['name'])) ? $result['name'] : set_value('suburb');
		$status 		= (isset($result['status'])) ? $result['status'] : set_value('status');
		$heading		= 'Update';
	}else{
		$id 			= '';
		$province        = set_value('province');
		$city           = set_value('city');
		$suburb         = set_value('suburb');
		$status			= set_value('status');
		$heading		= 'Add';
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
				<?php if($checkpermission){ ?>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="form-group col-6">
						 	<div class="form-group">
							<label for="id">Province*</label>
							<?php echo form_dropdown('province', $provincelist, $province, ['id' => 'province', 'class' => 'form-control province_name']); ?>
	                        </div>
						</div>
	                    <div class="form-group col-6 mt_40">
	                        <input type="radio" class="radio-control box1" id="choice1" name="choice1" value="choice">
	                        <label class="radio-button">New city</label>
						
	                        <input type="radio" class="radio-control" id="choice1" name="choice1" value="other" checked="checked" >
	                        <label class="radio-button">Existing city</label>
						</div>
					</div>

					<div class="existing-city" >
						<div class="row">
		                    <div class="form-group col-6">
								<label for="city">City</label>
		                        <?php echo form_dropdown('city', [], $city, ['id' => 'city', 'class' => 'form-control city_name']); ?>
							</div>
							<div class="form-group col-6">
								<label class="Subrub">Suburb</label>
		                        <input type="text" class="form-control suburb" id="suburb" name="suburb" value="<?php echo $suburb; ?>" placeholder="suburb">
							</div>
						</div>
					</div>
					<div class="form-group col-6 new-city" style="display:none;">
						<label class="city1">City</label>
                        <input type="text" class="form-control" id="city1" name="city1" placeholder="Please enter the city">
					</div>

					<div class="row ">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1')echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Area </button>
							
						</div>
					</div>
				</form>
			<?php } ?>
								<div class="table-responsive mt_20">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Province</th>
								<th>City</th>
								<th>Suburb</th>
								<th>Active</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="suburb"></div>
<script>
	$(function(){
		
		citysuburb(['#province','#city'], ['<?php echo $city; ?>']);

		var options = {
			url 	: 	'<?php echo base_url()."admin/administration/managearea/managearea/DTManagearea"; ?>',
			columns : 	[
							{ "data": "province_id" },
                            {"data" :"city_id"},
                            {"data" :"name"},
                            { "data": "status" },	
							{ "data": "action" }
						],

						target	:	[4],
						sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{
				province : {
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
				province 	: {
					required	: "Please Select the province ."
				},
				city : {
					required    : "Please Select the city",
				},
				suburb : {
					required    : "Please enter the suburb",
				},
				city1:{
					required    :"Please enter the city",
				}


			}
		);
	});
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

	$('.province_name').on('change', function(){
		citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $(this).val()}, '#city']);	
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/administration/managearea/managearea'; ?>';
		var data	= 	'\
							<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
							<input type="hidden" value="2" name="status">\
						';
		sweetalert(action, data);
	});
</script>

