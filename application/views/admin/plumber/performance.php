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
				
				<?php if(count($results) > 0 && $pagestatus!='1'){ ?>0
					<div id="performancechart"></div>
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
				}
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
		
		var chartdata = [];
		$(results).each(function(i, v){
			chartdata.push({y: v.date, item1: v.point});
		})
		
		var chart = {
			element: 'performancechart',
			resize: true,
			data: chartdata,
			xkey: 'y',
			ykeys: ['item1'],
			labels: ['Point'],
			gridLineColor: '#000',
			lineColors: ['#000'],
			lineWidth: 1,
			hideHover: 'auto',
			xLabelFormat: function (x) { return formatdate(x, 1).toString(); },
			continuousLine:true
		}
		
		if(warning.length){
			var goalarray 	= [];
			var max 		= '';
			$(warning).each(function(i,v){
				goalarray.push(v.point);
				max = v.point;
			})
			chart['goals'] 				= goalarray;
			chart['goalLineColors'] 	= ['#FFF8E3', '#FFEEB9', '#FBB596', '#FF0000'];
			chart['ymin'] 				= max;
		}
		
		var line = new Morris.Line(chart);
				
		enddate();
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
