<?php
$id 					= isset($result['calid']) ? $result['calid'] : ''; 
if(isset($result['name']) && isset($result['surname'])) $name =  $result['name'].' '.$result['surname'];
else $name = ''; 
$allocation 			= isset($result['allocation']) ? $result['allocation'] : ''; 

$user_id 				= isset($result['uid']) ? $result['uid'] : ''; 
$registration_no 		= isset($result['registration_no']) ? $result['registration_no'] : ''; 

$heading				= isset($result['calid']) ? 'Update' : 'Add'; 
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Compulsory Audit Listing</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Compulsory Audit Listing</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Compulsory Audit Listing</h4>
				<?php if($checkpermission){  ?>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							<label for="activity">Plumber</label>
								<input type="search" autocomplete="off" class="form-control" <?php if($id!='') echo 'readonly'; ?> id="search_name" name="search_name" placeholder="Search Plumber" onkeyup="search_func(this.value);" value="<?php echo $name; ?>">
								<div id="plumber_suggesstion" style="display: none;"></div>		
							</div>			
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="activity">Number of Compulsory Audit Allocations:</label>
								<input type="number" autocomplete="off" class="form-control" id="allocation" name="allocation" value="<?php echo $allocation; ?>" min='1'>
							</div>			
						</div>
					</div>

					<div class="row">
						
						<div class="col-md-12 text-right">
							<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
							<input type="hidden" id="user_id_hide" name="user_id_hide" value="<?php echo $user_id; ?>">
							<input type="hidden" id="user_reg" name="user_reg" value="<?php echo $registration_no; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
						</div>
					</div>
				</form>
			<?php } ?>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Plumber</th>
								<th>Reg Number</th>
								<th>Active Compulsory Allocations</th>
								<th>Completed Compulsory Allocations</th>
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


	var options = {
			url 	: 	'<?php echo base_url()."admin/audits/Compulsory_audit/DTListings"; ?>',
			columns : 	[
			{ "data": "name" },
			{ "data": "reg" },
			{ "data": "allocation" },
			{ "data": "complete" },
			{ "data": "action" }
			],
			target : [4],
			sort : '0'
		};
		
		ajaxdatatables('.datatables', options);

			validation(
			'.form',
			{
				search_name : {
					required	: true,
				},
				allocation : {
					required	: true,
				},			
			},
			{
				search_name 	: {
					required	: "Plumber name field is required."
				},
				allocation 	: {
					required	: "Compulsory audit allocations field is required."
				},			
			}
			);
});
	var req = null;
	function search_func(value)
	{
		if ($.isNumeric(value)) {
			return false;
		}else{
			
			if (req != null) req.abort();
		    
		    var type1 = 3;
		    var strlength = $.trim($('#search_name').val()).length;
		    if(strlength > 0)  { 
			    req = $.ajax({
			        type: "POST",
			        url: '<?php echo base_url()."admin/audits/compulsory_audit/userRegDetails"; ?>',
			        data: {'search_keyword' : value,type:type1},        
			        beforeSend: function(){
						// $("#search_reg_no").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
			        success: function(data){          	
			        	$("#plumber_suggesstion").html('');
			        	$("#name_surname").val('');
			        	$("#plumber_suggesstion").show();      	
						$("#plumber_suggesstion").html(data);			
						$("#search_name").css("background","#FFF");
			        }
			    });
			}
			else{
				console.log(strlength);
				$("#plumber_suggesstion").hide();
			}
		}
	    
	}

	function selectuser(val,id,nameSurname) {
		$("#search_name").val(nameSurname);
		$("#user_reg").val(val);
		$("#user_id_hide").val(id);
		$("#plumber_suggesstion").hide();
	}
</script>
