<?php 
	$filepath		= base_url().'assets/uploads/plumber/'.$plumberid.'/performance/';
	$pdfimg 		= base_url().'assets/images/pdf.png';
	$profileimg 	= base_url().'assets/images/profile.jpg';
?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Performance Status</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Performance Status</li>
			</ol>
		</div>
	</div>
</div>
<?php 
echo $notification; 
echo isset($menu) ? $menu : '';
?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Performance Status for <?php echo $userdata['name'].' '.$userdata['surname']; ?></h4>
				
				<form action="" method="post" class="psform">
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Performance Type*</label>
										<?php
											echo form_dropdown('type', $performancelist, '', ['id' => 'type', 'class'=>'form-control']);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Performance Point Allocation*</label>
										<input type="text" name="point" class="form-control" id="point">
									</div>
								</div>
								<div class="col-md-6">
									<label>Date of Performance</label>
									<div class="form-group">
										<div class="input-group">
											<input type="text" class="form-control dateofperformance" name="date">
											<div class="input-group-append">
												<span class="input-group-text"><i class="icon-calender"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Comments</label>
										<textarea class="form-control" name="comments" rows="6"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="checkbox">
											<input type="checkbox" name="verification" class="verification" id="verification" value="1">
											<p>This has an end date</p> 
										</label>
									</div>
								</div>
								<div class="col-md-6 enddate_wrapper displaynone">
									<label>End Date</label>
									<div class="form-group">
										<div class="input-group">
											<input type="text" class="form-control enddate" name="enddate">
											<div class="input-group-append">
												<span class="input-group-text"><i class="icon-calender"></i></span>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>		
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12">
									<h4 class="card-title">Attachement</h4>
									<div class="form-group">
										<div>
											<img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" class="attachment_image" width="100">
										</div>
										<input type="file" id="file" class="attachment_file">
										<label for="file" class="choose_file">Choose File</label>
										<input type="hidden" name="attachment" class="attachment" value="">
										<p>(Image/File Size Smaller than 5mb)</p>
									</div>
								</div>
							</div>
						</div>													
						<div class="col-md-12">
							<input type="hidden" value="<?php echo $plumberid; ?>" name="plumberid">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>			 
				</form>
				
				<?php if(count($results) > 0 && $pagestatus!='1'){ ?>
					<?php $overallpoint = array_sum(array_column($results, 'point')); ?>
					<h5>Current Performance Status = <?php echo $overallpoint; ?></h5>
					<div id="performancelinechart" style="width:100%; height:400px;"></div>
					<div id="performancechart" style="width:100%; height:400px;"></div>
				<?php } ?>
				
				<div class="row m-t-30">
					<div class="col-md-12">
						<a href="<?php echo base_url().'admin/plumber/index/performance/'.$plumberid; ?>" class="btn btn-primary">Active</a>
						<a href="<?php echo base_url().'admin/plumber/index/performance/'.$plumberid.'/2'; ?>" class="btn btn-primary">Archived</a>
					</div>
				</div>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Date of Performance</th>
								<th>Performance Type</th>
								<th>Comments</th>
								<th>Point Allocation</th>
								<th>Attachment</th>
								<?php if($pagestatus!='1'){ ?>
									<th>Action</th>
								<?php } ?>
							</tr>							
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	var results 	= $.parseJSON('<?php echo json_encode($results); ?>');
	var warning 	= $.parseJSON('<?php echo json_encode($warning); ?>');
	var pagestatus 	= '<?php echo $pagestatus; ?>';
	var id		 	= '<?php echo $id; ?>';
	var filepath 	= '<?php echo $filepath; ?>';
	var pdfimg		= '<?php echo $pdfimg; ?>';
	var plumberid	= '<?php echo $plumberid; ?>';
	var overallpoint = '<?php echo isset($overallpoint) ? $overallpoint : "0"; ?>';

	$(function(){
		select2('.type');
		datepicker('.dateofperformance, .enddate', ['currentdate']);
		fileupload([".attachment_file", "./assets/uploads/plumber/"+plumberid+"/performance/", ['jpg','gif','jpeg','png','pdf','tiff']], ['.attachment', '.attachment_image', filepath, pdfimg]);
		
		validation(
			'.psform',
			{
				type : {
					required:  	true
				},
				point : {
					required:  	true
				},
				enddate : {
					required:  	function() {
									return $('#verification').is(':checked');
								}
				}
			},
			{
				type 	: {
					required	: "Please select Performance Type."
				},
				point 	: {
					required	: "Please fill point."
				},
				enddate 	: {
					required	: "Please fill end date."
				}
			}
		);
		
		var column	= 	[
							{ "data": "date" },
							{ "data": "type" },
							{ "data": "comments" },
							{ "data": "point" },
							{ "data": "attachment" }
						];
		
		if(pagestatus!=1){
			column.push({'data' : 'action'});
			var target = [4,5];
		}else{
			var target = [4];
		}
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/plumber/index/DTPerformancestatus"; ?>',
			data 	: 	{ page : 'plumberperformancestatus', archive : pagestatus, id:id},
			columns : 	column,
			target	:	target,
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
		
		enddate();
		
		var chartxaxis 		= [];
		var chartyaxis 		= [];
		var chartseries 	= [];
		var warningcolor 	= ['#FFF8E3', '#FFEEB9', '#FBB596', '#FF0000'];
		
		$(results).each(function(i, v){
			chartxaxis.push(v.date);
			chartyaxis.push(v.point);
		})
		
		chartseries.push({name : 'Performance Chart', yaxis : chartyaxis, symbol : 2 });
		
		$(warning).each(function(i, v){
			var warningarray = [];
			$(results).each(function(){
				warningarray.push(v.point);
			})
			
			chartseries.push({name : v.name, yaxis : warningarray, symbol : 0, color : warningcolor[i]});
		})
		
		linechart(
			'performancelinechart',
			{
				xaxis 	: 	chartxaxis,
				series 	: 	chartseries,
				colors 	: 	['#4472C4', '#FFF8E3', '#FFEEB9', '#FBB596', '#FF0000']
			}
		);
		
		gaugechart(
			'performancechart',
			{
				name : 'Performance Chart',
				data : [{value: overallpoint, name: 'Performance Chart'}],
				colors : [[0.2, '#55ce63'],[0.5, '#FBB596'],[0.8, '#009efb'],[1, '#f62d51']]
				
			}
		);
	});
	
	$(document).on('click', '.archive', function(){
		var action 	= 	'<?php echo base_url().'admin/plumber/index/performanceaction'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="'+id+'" name="plumberid">\
		<input type="hidden" value="'+$(this).attr('data-flag')+'" name="flag">\
		';

		sweetalert(action, data);
	})
	
	
	$('#type').change(function(){
		ajax('<?php echo base_url()."ajax/index/ajaxplumberperformancelist"; ?>', {id : $(this).val()}, '', {
			success:function(data){
				if(data.status=='1'){
					var result = data.result;
					$('#point').val(result.allocation)
				}
			}
		});
	})
	
	$('.verification').click(function(){
		enddate();
	})

	function enddate(){		
		if($('.verification').is(':checked')){
			$('.enddate_wrapper').removeClass('displaynone');
		}else{
			$('.enddate_wrapper').addClass('displaynone');
		}
	}

</script>
