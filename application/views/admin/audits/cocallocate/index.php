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
				
				<div class="audit_summary displaynone">
					<h4 class="card-title">Audit Summary</h4>
					<div class="row">
						<div class="col-md-4">
							<p>Number COC recommended for audit:</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Count of all COC marked for allocation">
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Count of all COC marked for allocation as a % of the cocs brought back per date range">
						</div>
					</div>
					<table class="table table-bordered table-striped fullwidth m-t-15">
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
						<button type="button" name="submit" value="submit" class="btn btn-primary">Allocate Audits</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div id="cocmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-striped coc_datatable fullwidth">
					<thead>
						<tr>
							<th>COC Number</th>
							<th>Installation Code(s) of COC</th>
							<th>Suburb</th>
							<th>City</th>
							<th>Province</th>
							<th>Allocate</th>
						</tr>
					</thead>
				</table>
			</div>
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
		user_id = $(this).attr('data-user-id');
		$('#cocmodal').attr('user_id',user_id);
		cocdisplay(1,user_id);
	})	
	
	$(document).on('click', '.allocate', function(){
		if($(this).is(':checked')){
			auditor_id = $(this).parents('div.allocate_section').find('.auditor_id').val();
			if(auditor_id!=''){
				coc_id = $(this).parents('tr').find('.coc_id').text();
				user_id = $('#cocmodal').attr('user_id');
				ajax('<?php echo base_url()."admin/audits/cocallocate/index/auditor_allocate"; ?>', {'coc_id' : coc_id,'auditor_id' : auditor_id,'user_id' : user_id}, auditor_allocate);
			} else {
				$(this).prop('checked', false);
				// alert('Please select Auditor');
				// $('div.message').text('Please select Auditor').css('color','red').show();				
				$('div.message').remove();				
				$("#DataTables_Table_1_length").after("<div class='message' style='color:red'>Please select Auditor</div>");
			}
			// $('.allocate:checked').parent('.allocate_section').find('.user_search').attr('disabled',true);
			// $('.allocate:checked').hide();
		}
	});
	
	function auditor_allocate(){
		// alert('Auditor Allocated successfully');
		$('div.message').remove();				
		$("#DataTables_Table_1_length").after("<div class='message' style='color:green'>Auditor Allocated successfully</div>");
		$('.allocate:checked').parent('.allocate_section').find('.user_search').attr('disabled',true);
		$('.allocate:checked').hide();
		location.reload();
	}

	$(document).on('keyup', '.user_search', function(){
		$('div.message').remove();
		user_search = '#'+$(this).attr('id');
		auditor_id = $(this).parent('div').find(".auditor_id");
		auditor_id.attr('value','');
		user_suggestion = $(this).parent('div').find(".user_suggestion");
		userautocomplete1([user_search, auditor_id, user_suggestion], [$(this).val(),5], custom_auditor_select);
	})

	function userautocomplete1(data1=[], data2=[], customfunction=''){
	var userurl 		= baseurl()+"ajax/index/ajaxuserautocomplete";
	var appendclass 	= data1[0].substring(1);
	
	ajax(userurl, {'search_keyword' : data2[0], type : data2[1]}, user_search_result);
	
	function user_search_result(data)
	{
		var result = [];
		
		$(data).each(function(i, v){
			result.push('<li data-name="'+v.name+'" data-id="'+v.id+'" class="autocompletelist'+appendclass+'">'+v.name+'</li>');
		})
		
		var append = '<ul class="autocomplete_list">'+result.join('')+'</ul>';
		$(data1[2]).html('').removeClass('displaynone').html(append);
	}
	
	$(document).on('click', '.autocompletelist'+appendclass, function(){
		$('div.message').remove();
		var id = $(this).attr('data-id');
		var name = $(this).attr('data-name');

		var count = $(this).attr('data-count');
		var electronic = $(this).attr('data-electronic');
		
		$(data1[0]).val(name);
		$(data1[1]).val(id);
		$(data1[2]).html('');
		
		if(customfunction!='') customfunction(name, id, count, electronic);
	})
}

	function custom_auditor_select() {
		
	}

	$(document).on('keyup', '#user_search', function(){
		$("#user_id").attr('value','');
		// user_search = $(this);
		// plumber_id = $(this).parent('div').find("#user_id");
		// user_suggestion = $(this).parent('div').find("#user_suggestion");
		userautocomplete(['#user_search', '#user_id', "#user_suggestion"], [$(this).val(),3], custom_plumber_select);
	})

	function custom_plumber_select() {
		
	}


	function cocdisplay(destroy=0,user_id=''){		
		$('div.message').remove();
		var options = {
			url 	: 	'<?php echo base_url()."admin/audits/cocallocate/index/DTcoc"; ?>',		
			data    :   { user_id : user_id, start_date_range:$('#start_date_range').val(), end_date_range:$('#end_date_range').val(), start_coc_range:$('#start_coc_range').val(), end_coc_range:$('#end_coc_range').val(), max_allocate_plumber:$('#max_allocate_plumber').val(),province:$('#province1').val(), city:$('#city1').val() }, 
			destroy :   destroy,  		
			lengthmenu: [50],	
			search: 0,
			target : [0,1,2,3,4,5],
			sort : '0',
			columns : 	[
							{ "data": "coc_id" },
							{ "data": "installationtype" },
							{ "data": "suburb" },
							{ "data": "city" },
							{ "data": "province" },
							{ "data": "allocate" },
						]
		};
		
		ajaxdatatables('.coc_datatable', options);
		$('#cocmodal').modal('show');
	}
	
</script>
<style type="text/css">
.dataTables_filter,
#DataTables_Table_1_info
 {
	display: none;
}
div.message {
	text-align: right;
	padding-right: 10px;
	padding-top: 20px;
}
</style>