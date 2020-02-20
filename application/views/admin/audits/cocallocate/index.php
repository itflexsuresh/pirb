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
				<form class="mt-4 form" action="" method="post">
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
					</div>
					<div class="row">
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
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber Name and Surname</label>
								<input type="search" autocomplete="off" class="form-control" name="user_search" id="user_search">
								<div id="user_suggestion"></div>
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
								<input type="hidden" id="user_id" name="user_id">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Province</label>
								<?php
								echo form_dropdown('province', $province, '',['id' => 'province1', 'class' => 'form-control']);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<?php 
									echo form_dropdown('city', [], '', ['id' => 'city1', 'class' => 'form-control']); 
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Maximum of number of Audits allocated per plumber</label>
								<input type="text" class="form-control" name="max_allocate_plumber" id="max_allocate_plumber" value="">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="submit" value="submit" class="btn btn-primary search">Search</button>
						</div>
					</div>
				</form>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Name</th>
								<th>Reg No</th>
								<th>Company</th>
								<th>City</th>
								<th>Province</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
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
		datatable();
		citysuburb(['#province1','#city1'], ['']);
	});

	$(document).on('click', '.cocmodal', function(){
		user_id = $(this).attr('data-user-id');
		$('#cocmodal').attr('user_id',user_id);
		cocdisplay(1,user_id);
	})	
	
	$('.search').on('click',function(){		
		datatable(1);
	});

	$(document).on('click', '.allocate', function(){
		if($(this).is(':checked')){
			auditor_id = $(this).parents('div.allocate_section').find('.auditor_id').val();
			if(auditor_id!=''){
				coc_id = $(this).parents('tr').find('.coc_id').text();
				user_id = $('#cocmodal').attr('user_id');
				ajax('<?php echo base_url()."admin/audits/cocallocate/index/auditor_allocate"; ?>', {'coc_id' : coc_id,'auditor_id' : auditor_id,'user_id' : user_id}, auditor_allocate);
			} else {
				$(this).prop('checked', false);
				alert('Please select Auditor');
			}
			// $('.allocate:checked').parent('.allocate_section').find('.user_search').attr('disabled',true);
			// $('.allocate:checked').hide();
		}
	});
	
	function auditor_allocate(){
		alert('Auditor Allocated successfully');
		$('.allocate:checked').parent('.allocate_section').find('.user_search').attr('disabled',true);
		$('.allocate:checked').hide();
	}

	$(document).on('keyup', '.user_search', function(){
		user_search = '#'+$(this).attr('id');
		auditor_id = $(this).parent('div').find(".auditor_id");
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
			result.push('<li data-name="'+v.name+'" data-id="'+v.id+'" data-count="'+v.count+'" data-electronic="'+v.coc_electronic+'" class="autocompletelist'+appendclass+'">'+v.name+'</li>');
		})
		
		var append = '<ul class="autocomplete_list">'+result.join('')+'</ul>';
		$(data1[2]).html('').removeClass('displaynone').html(append);
	}
	
	$(document).on('click', '.autocompletelist'+appendclass, function(){
		var id = $(this).attr('data-id');
		var name = $(this).attr('data-name');
		console.log(name);

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
		// user_search = $(this);
		// plumber_id = $(this).parent('div').find("#user_id");
		// user_suggestion = $(this).parent('div').find("#user_suggestion");
		userautocomplete(['#user_search', '#user_id', "#user_suggestion"], [$(this).val(),3], custom_plumber_select);
	})

	function custom_plumber_select() {
		
	}

	function datatable(destroy=0){

		var options = {
			url 	: 	'<?php echo base_url()."admin/audits/cocallocate/index/DTAllocateAudit"; ?>',
			data    :   { user_id:$('#user_id').val(), start_date_range:$('#start_date_range').val(), end_date_range:$('#end_date_range').val(), start_coc_range:$('#start_coc_range').val(), end_coc_range:$('#end_coc_range').val(), province:$('#province1').val(), city:$('#city1').val() },  		
			destroy :   destroy,  			
			columns : 	[
							{ "data": "name" },
							{ "data": "reg_no" },
							{ "data": "company" },
							{ "data": "city" },
							{ "data": "province" },
							{ "data": "coc_link" },
						]
		};
		
		ajaxdatatables('.datatables', options);
	}

	function cocdisplay(destroy=0,user_id=''){		
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
</style>