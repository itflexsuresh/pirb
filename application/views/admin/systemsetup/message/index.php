<?php
if(isset($result) && $result){
	$id 			= $result['id'];
	$msgid 			= (set_value('groups')) ? set_value('groups') : $result['groups'];
	$message 		= (set_value('message')) ? set_value('message') : $result['message'];
	$startdate 		= isset($result['startdate']) && $result['startdate']!='1970-01-01' ? date('d-m-Y', strtotime($result['startdate'])) : '';
	$enddate 		= isset($result['enddate']) && $result['enddate']!='1970-01-01' ? date('d-m-Y', strtotime($result['enddate'])) : '';
	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	$DBendDate 		= (set_value('enddate')) ? set_value('enddate') : strtotime($result['enddate']);

	
	$heading		= 'Update';
}else{
	$id 			= '';
	$msgid			= set_value('groups');		
	$message		= set_value('message');
	$startdate		= set_value('startdate');
	$enddate		= set_value('enddate');
	$status			= set_value('status');
	$DBendDate		= set_value('enddate');

	$heading		= 'Add';
}
			$crrrentDate = strtotime(date('Y-m-d'));
			if ($crrrentDate<=$DBendDate) {
				$activeStatus = '1';
			//print_r(date('Y-m-d',$DBendDate));
			}else{
				$activeStatus = '0';
			}

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Global Messages</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Global Messages</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Global Messages</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="groups">Message Group</label>
								<?php echo form_dropdown('groups', $msggrp, $msgid, ['id' => 'groups', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="startdate">Message Start Date</label>
								<input type="text" autocomplete="off" class="form-control" id="startdate" name="startdate" placeholder="Enter Start date *" value="<?php echo $startdate; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="enddate">Message End Date</label>
								<input type="text" autocomplete="off" class="form-control" id="enddate" name="enddate" placeholder="Enter End date *" value="<?php echo $enddate; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="message">Message</label>
								<textarea type="text" class="form-control" id="message" name="message" placeholder="Enter Message"><?php echo $message; ?></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1' && $activeStatus=='1') echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?> Message</button>
						</div>
					</div>
				</form>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Message Group</th>
								<th>Message Start Date</th>
								<th>Message End Date</th>
								<th>Message Text</th>
								<th>Status</th>
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
			url 	: 	'<?php echo base_url()."admin/systemsetup/message/Message/DTMessage"; ?>',
			columns : 	[
			{ "data": "groups" },
			{ "data": "start_date" },
			{ "data": "end_date" },
			{ "data": "message" },
			{ "data": "status" },
			{ "data": "action" }
			]
		};
		
		ajaxdatatables('.datatables', options);
		
		validation(
			'.form',
			{				
				startdate: {
					required	: true,
				},
				end_date : {
					required	: true,
				}
			},
			{				
				startdate 	: {
					required	: "Start Date field is required."
				},
				end_date 	: {
					required	: "End Date field is required."
				}
			}
		);

		datepicker('#startdate', ['currentdate'])
		datepicker('#enddate', ['currentdate'])
		
	});
	
	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/systemsetup/message/message'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
