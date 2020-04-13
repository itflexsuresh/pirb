<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Allocation for Audit</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Allocation for Audit</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">COC Allocation for Audit</h4>
				<form class="mt-4 form" action="" method="post" id="filter">
					
					<h5 class="card-title">Search Range:</h5>
					<div class="row">
						<div class="col-md-6">						
							<div class="form-group">
								<label>Start Date Range</label>
								<div class="input-group">
									<input type="text" autocomplete="off" class="form-control" id="start_date_range" name="start_date_range" data-date="datepicker" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-md-6">						
							<div class="form-group">
								<label>End Date Range</label>
								<div class="input-group">
									<input type="text" autocomplete="off" class="form-control" id="end_date_range" name="end_date_range" data-date="datepicker" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Start CoC Range</label>
								<input type="text" class="form-control" id="start_coc_range" name="start_coc_range" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>End CoC Range</label>
								<input type="text" class="form-control" id="end_coc_range" name="end_coc_range" value="">
							</div>
						</div>
					</div>
					
					<h5 class="card-title">Filters:</h5>						
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Plumber Name and Surname Registration Number</label>
										<input type="search" autocomplete="off" class="form-control" name="user_search" id="user_search">
										<div id="user_suggestion"></div>
										<div class="search_icon search_icon_user">
											<i class="fa fa-search" aria-hidden="true"></i>
										</div>
										<input type="hidden" id="user_id" name="user_id">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Province</label>
										<?php echo form_dropdown('province', $province, '',['id' => 'province1', 'class' => 'form-control']); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>City</label>
										<?php echo form_dropdown('city', [], '', ['id' => 'city1', 'class' => 'form-control']);  ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<h5 class="card-title">COC Ranking Criteria:</h5>	
					<div class="row">
						<div class="col-md-12">
							<div class="row form-group">
								<div class="col-md-6">
									<label>Compulsory Audit</label>
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="compulsory_audit" id="compulsory_audit" value="1">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row form-group">
								<div class="col-md-6">
									<label>Audit Ratio</label>
								</div>
								<div class="col-md-3">
									<label>Greater than</label>
									<input type="number" class="custom_number_box" name="audit_ratio_start" id="audit_ratio_start">
								</div>
								<div class="col-md-3">
									<label>but less than</label>
									<input type="number" class="custom_number_box" name="audit_ratio_end" id="audit_ratio_end">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row form-group">
								<div class="col-md-6">
									<label>Overall Performance Rating</label>
								</div>
								<div class="col-md-3">
									<label>Greater than</label>
									<input type="number" class="custom_number_box" name="rating_start" id="rating_start">
								</div>
								<div class="col-md-3">
									<label>but less than</label>
									<input type="number" class="custom_number_box" name="rating_end" id="rating_end">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row form-group">
								<div class="col-md-6">
									<label>Number COC for Allocation</label>
									<input type="text" class="form-control" name="no_coc_allocation" id="no_coc_allocation">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row form-group">
								<div class="col-md-6">
									<label>Maximum of number of Audits allocated per plumber</label>
									<input type="number" class="form-control" name="max_allocate_plumber" id="max_allocate_plumber">
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="submit" value="submit" class="btn btn-primary search">Search</button>
							<button type="button" name="reset" value="reset" class="btn btn-primary reset">Reset</button>
						</div>
					</div>
				</form>
				
				<div class="table-responsive m-t-40">
					<h4 class="card-title">Recommend Allocation Results</h4>
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Plumber</th>
								<th>Reg Number</th>
								<th>Employee Company</th>
								<th>Employee City</th>
								<th>Employee Province</th>
								<th>Audit Ratio</th>
								<th>Cautionary Ratio</th>
								<th>Refix (Complete) Ratio</th>
								<th>Refix (In-Complete) Ratio</th>
								<th>Overall Performance Rating</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
				
				<div class="audit_summary displaynone m-t-40">
					<h4 class="card-title">Audit Summary</h4>
					<div class="row">
						<div class="col-md-4">
							<p>Number COC recommended for audit:</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control markedcount" placeholder="Count of all COC marked for allocation" disabled>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control markedcountpercentage" placeholder="Count of all COC marked for allocation as a % of the cocs brought back per date range" disabled>
						</div>
					</div>
					<form action="" method="post">
						<table class="table table-bordered table-striped auditor_table fullwidth m-t-15">
							<thead>
								<tr>
									<th>Auditor Name</th>
									<th>Audit Allocation MTD</th>
									<th>Open Audits</th>
									<th>Allocation for above selection</th>
								</tr>
							</thead>
						</table>
						<div class="text-right">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Allocate Audits</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div id="cocmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-striped coc_table fullwidth">
					<thead>
						<tr>
							<th>COC Number</th>
							<th>Installation Code(s) of COC</th>
							<th>Suburb</th>
							<th>City</th>
							<th>Province</th>
							<th>Auditor Name</th>
							<th>Audit Allocation MTD</th>
							<th>Open Audits</th>
							<th>Allocation</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
		
<script>
	$(function(){
		datepicker('#start_date_range');
		datepicker('#end_date_range');
		citysuburb(['#province1','#city1'], ['']);
		datatable();
	});

	$('.search').on('click',function(){		
		datatable(1);
	});

	$('.reset').on('click',function(){		
		$('#start_date_range,#end_date_range,#start_coc_range,#end_coc_range,#user_search,#user_id,#province1,#city1,#audit_ratio_start,#audit_ratio_end,#rating_start,#rating_end,#rating_end,#no_coc_allocation,#max_allocate_plumber').val('');
		$('#compulsory_audit').prop('checked', false);
		datatable(1);
	});
	
	function datatable(destroy=0){

		var options = {
			url 	: 	'<?php echo base_url()."admin/audits/cocallocate/index/DTAllocateAudit"; ?>',
			data    :   { 
							start_date_range		: $('#start_date_range').val(), 
							end_date_range			: $('#end_date_range').val(), 
							start_coc_range			: $('#start_coc_range').val(), 
							end_coc_range			: $('#end_coc_range').val(), 
							user_id					: $('#user_id').val(), 
							province				: $('#province1').val(), 
							city					: $('#city1').val(), 
							compulsory_audit		: ($('#compulsory_audit').is(':checked')) ? $('#compulsory_audit').val() : '', 
							audit_ratio_start		: $('#audit_ratio_start').val(), 
							audit_ratio_end			: $('#audit_ratio_end').val(), 
							rating_start			: $('#rating_start').val(), 
							rating_end				: $('#rating_end').val(), 
							no_coc_allocation		: $('#no_coc_allocation').val(), 
							max_allocate_plumber	: $('#max_allocate_plumber').val() 
						},  		
			destroy :   destroy,  			
			columns : 	[
							{ "data": "plumbername" },
							{ "data": "regno" },
							{ "data": "company" },
							{ "data": "city" },
							{ "data": "province" },
							{ "data": "audit" },
							{ "data": "cautionary" },
							{ "data": "refix_incomplete" },
							{ "data": "refix_complete" },
							{ "data": "rating" },
							{ "data": "coc_link" },
						]
		};
		
		ajaxdatatables('.datatables', options);
	}
	
	$(document).on('click', '.cocmodal', function(){
		$(document).find('.removecoc').remove();
		
		var userid = $(this).attr('data-user-id');
		
		var data = {
			user_id					: userid, 
			no_coc_allocation		: $('#no_coc_allocation').val(), 
			max_allocate_plumber	: $('#max_allocate_plumber').val() 
		}
		
		ajax('<?php echo base_url()."admin/audits/cocallocate/index/coc"; ?>', data, '', {
			success: function(data){
				if(data.result.length > 0){
					var table = [];
					
					$(data.result).each(function(i, v){
						var summarydata = $(document).find('.postcocid[value="'+v.coc_id+'"]');
						if(summarydata.length > 0){
							var checkallocate 	= 'checked="checked"';
							var postauditorid 	= summarydata.parent().find('.postauditorid').val();
							var postauditorname = summarydata.parent().parent().parent().find('td:nth-child(1)').text();
						}else{
							var checkallocate 	= '';
							var postauditorid 	= '';
							var postauditorname = '';
						}
						
						var data 	= '\
							<tr class="removecoc">\
								<td>'+v.coc_id+'</td>\
								<td>'+v.installationcode+'</td>\
								<td>'+v.suburbname+'</td>\
								<td>'+v.cityname+'</td>\
								<td>'+v.provincename+'</td>\
								<td>\
									<input type="text" autocomplete="off" class="form-control auditor_search" id="auditor_search_'+v.coc_id+'" data-cocid="'+v.coc_id+'" value="'+postauditorname+'" style="width:100px">\
									<input type="hidden" class="auditor_id" id="auditor_id_'+v.coc_id+'" value="'+postauditorid+'">\
									<input type="hidden" class="plumber_id" id="plumber_id_'+v.coc_id+'" value="'+userid+'">\
									<div class="auditor_suggestion" id="auditor_suggestion_'+v.coc_id+'"></div>\
								</td>\
								<td></td>\
								<td></td>\
								<td><input type="checkbox" name="allocate" class="allocate" data-cocid="'+v.coc_id+'" '+checkallocate+'></td>\
							</tr>\
						'; 
						
						table.push(data);
					})
					
					$('.coc_table').append(table);
					$('#cocmodal').modal('show');
				}
			}
		});
	})	
	
	$(document).on('keyup', '.auditor_search', function(){
		var cocid = $(this).attr('data-cocid');
		$("#auditor_id_"+cocid).val('');
		$(this).parent().parent().find('.allocate').prop('checked', false);
		userautocomplete(['#auditor_search_'+cocid, '#auditor_id_'+cocid, '#auditor_suggestion_'+cocid], [$(this).val(), 5]);
	})
	
	$(document).on('keyup', '#user_search', function(){
		$("#user_id").val('');
		userautocomplete(['#user_search', '#user_id', '#user_suggestion'], [$(this).val(), 3]);
	})
	
	$(document).on('click', '.allocate', function(){
		var cocid 			= $(this).attr('data-cocid');
		var auditorid 		= $(this).parent().parent().find('#auditor_id_'+cocid).val();
		var auditorname 	= $(this).parent().parent().find('#auditor_search_'+cocid).val();
		var plumberid 		= $(this).parent().parent().find('#plumber_id_'+cocid).val();
		
		if(auditorid==''){
			$(this).prop('checked', false);
			$(this).parent().parent().find('#auditor_id_'+cocid).focus();
			return false;
		}
		
		if($(this).is(':checked')){
			auditsummary(cocid, plumberid, auditorid, auditorname);
			$('.markedcount').val($(document).find('.auditorcocid').length);
			$('.markedcountpercentage').val()
		}else{
			$(document).find('.auditorcocid[data-auditorcocid="'+cocid+'"]').remove();
			
			if($(document).find('.auditorallocate[data-auditorid="'+auditorid+'"]').find('.auditorcocid').length==0){
				$(document).find('.auditorallocate[data-auditorid="'+auditorid+'"]').remove();
			}else{
				var auditval = $(document).find('.auditorallocate[data-auditorid="'+auditorid+'"] td:nth-child(4) span').text();
				$(document).find('.auditorallocate[data-auditorid="'+auditorid+'"] td:nth-child(4) span').text(parseInt(auditval)-1);			
			}
			
			if($(document).find('.auditorallocate').length==0) $('.audit_summary').addClass('displaynone');
		}
	});
	
	var auditorcount = 1;
	
	function auditsummary(cocid, plumberid, auditorid, auditorname){
		var checkauditor 	= 	$(document).find('.auditorallocate[data-auditorid="'+auditorid+'"]').length;
		var appendfield		= 	'<div class="auditorcocid" data-auditorcocid="'+cocid+'">\
									<input type="hidden" name="allocate['+(auditorcount)+'][auditorid]" class="postauditorid" value="'+auditorid+'">\
									<input type="hidden" name="allocate['+(auditorcount)+'][plumberid]" class="postplumberid" value="'+plumberid+'">\
									<input type="hidden" name="allocate['+(auditorcount++)+'][cocid]" class="postcocid" value="'+cocid+'">\
								</div>';
						
		if(checkauditor > 0){
			var auditval = $(document).find('.auditorallocate[data-auditorid="'+auditorid+'"] td:nth-child(4) span').text();
			$(document).find('.auditorallocate[data-auditorid="'+auditorid+'"] td:nth-child(4) span').text(parseInt(auditval)+1);
			$(document).find('.auditorallocate[data-auditorid="'+auditorid+'"] td:nth-child(4)').append(appendfield);
		}else{
			var auditortable = 	'<tr data-auditorid="'+auditorid+'" class="auditorallocate">\
									<td>'+auditorname+'</td>\
									<td></td>\
									<td></td>\
									<td>\
										<span>1</span>\
										'+appendfield+'\
									</td>\
								</tr>';
								
			$('.auditor_table').append(auditortable);		
			$('.audit_summary').removeClass('displaynone');
		}
	}
</script>