<?php
$customstockno	= $this->config->item('customstockno');
$id 			= (isset($result['id']) && $result['id']!='' && $result['id'] >= $customstockno) ? $result['id']+1 : $customstockno;
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Paper Certificate Stock Management</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Paper Certificate Stock Management</li>
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
				<form class="form" method="post">
					<h4 class="card-title">Paper Certificate Stock Management</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="row add_top_value stockwrapper">
								<div class="col-md-6">
									<div class="form-group">
										<label>Number of COC Available for Allocation</label>
										<input type="text" class="form-control"  name="allocate" value="<?php echo $count; ?>" readonly="readonly">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Number of Paper COC to be added to Stock</label>
										<input type="text" class="form-control" id="cocstock" name="cocstock" value="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>New COC Range Number will start at</label>
										
										<input type="text" class="form-control"  id="range_start" name="range_start" value="<?php echo $id; ?>" readonly="readonly">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>New COC Range Number will end at</label>
										<input type="text" class="form-control"  id="range_end" name="range_end" value=""  readonly="readonly">
									</div>
								</div>
							</div>

							<div class="row add_top_value displaynone customstockwrapper">
								<div class="col-md-6">
									<div class="form-group">
										<label>Start Range</label>
										<input type="text" class="form-control" id="startrange" name="startrange">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>End Range</label>
										<input type="text" class="form-control" id="endrange" name="endrange">
									</div>
								</div>
							</div>

							<div class="row">	
								<div class="col-md-6">	
									<?php /*if($id!=$customstockno){ ?>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" id="oldstock" name="oldstock" value="1" class="custom-control-input">
											<label class="custom-control-label" for="oldstock">Add stock below <?php echo $customstockno; ?></label>
										</div>
									<?php }*/ ?>
								</div>
								<div class="col-md-6 text-right">	
									<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary btn-rounded">Generate COC Stock</button>		
								</div>	
							</div>	
						</div>	
					</div>															
				</form>
			<?php } ?>
				<div class="table-responsive mt_20">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Stock</th>
								<th>Start Range</th>
								<th>End Range</th>
								<th>Created At</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	var customstockno = parseInt('<?php echo $customstockno; ?>');
	
	$(function(){

		var options = {
			url 	: 	'<?php echo base_url()."admin/cocstatement/papermanagement/index/DTStocklog"; ?>',
			columns : 	[
				{ "data": "stock" },
				{ "data": "range_start" },
				{ "data": "range_end" },
				{ "data": "createdat" }
			]
		};
		ajaxdatatables('.datatables', options);
		
		$.validator.addMethod("rangecheck", function(value, element){
			return value < customstockno ;
		}, "Please enter values below stock.");
	   
		$.validator.addMethod("startrangecheck", function(value, element){
			return ($('#endrange').val()!='') ? value <= parseInt($('#endrange').val()) : true;
		}, "Please enter values less than or equal to end range.");
	   
		$.validator.addMethod("endrangecheck", function(value, element){
			return value >= parseInt($('#startrange').val());
		}, "Please enter values greater than or equal to start range.");
	   
		validation(
			'.form',
			{	
				cocstock : {
					required		: true,
				},
				startrange : {
					required		: true,
					number			: true,
					rangecheck		: true,
					startrangecheck	: true,
					remote		: 	{
										url		: 	"<?php echo base_url().'admin/cocstatement/papermanagement/index/stockvalidation'; ?>",
										type	: 	"post",
										async	: 	false,
										data	: 	{
														endrange : function () { return $('#endrange').val(); }
													}
									}
				},
				endrange : {
					required		: true,
					number			: true,
					rangecheck		: true,
					endrangecheck	: true,
					remote		: 	{
										url		: 	"<?php echo base_url().'admin/cocstatement/papermanagement/index/stockvalidation'; ?>",
										type	: 	"post",
										async	: 	false,
										data	: 	{
														startrange : function () { return $('#startrange').val(); }
													}
									}
				}
			},
			{
				cocstock 	: {
					required	: 	"Please enter the cocstock."
				},
				startrange 	: {
					required	: 	"Please enter start range.",
					number		: 	"Enter number only.",
					remote		: 	"Stock in range already exists"
				},
				endrange 	: {
					required	: 	"Please enter end range.",
					number		: 	"Enter number only.",
					remote		: 	"Stock in range already exists"
				}										
			}
		);

		
		$('#cocstock').keyup(function()
		{
			var cocstock = $(this).val()!='' && $(this).val()!=undefined ? parseInt($(this).val()) : '';				
			var rangestart = parseInt($('#range_start').val());
			
			if(cocstock!='') $('#range_end').val((cocstock+rangestart)-1);
			else $('#range_end').val('');
		});
		
		oldstock();
	});
	
	$('#startrange, #endrange').blur(function(){
		if($('#startrange').val()!='' && $('#endrange').val()!='') $('.form').valid();
	}) 
	
	
	$('#oldstock').click(function(){
		oldstock();
	});
	
	function oldstock(){
		$('#startrange, #endrange').val('')
		
		if($('#oldstock').is(':checked')){
			$('.customstockwrapper').removeClass('displaynone');
			$('.stockwrapper').addClass('displaynone');
		}else{
			$('.customstockwrapper').addClass('displaynone');
			$('.stockwrapper').removeClass('displaynone');
		}
	}
</script>