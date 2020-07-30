<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Audit Statement</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Audit Statement</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
	
				<div class="row col-md-12 my_audit_section_cus">
					<div class="col-md-7 my_audit_sec">
						<p class="my_au_name">My Audits</p>
						<div style="position:relative;height:250px;" class="my_au_gram">
							<div style="position:absolute;left:10px;top:10px">
								<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#53C2BF" data-displayInput=false data-angleOffset=-125 data-angleArc=250 value="<?php echo $auditcoc; ?>" readonly/>
							</div>
							<div style="position:absolute;left:30px;top:30px">
								<input data-plugin="knob" data-width="160" data-height="160" data-min="0" data-thickness="0.2" data-fgColor="#FF0000" data-displayInput=false data-angleOffset=-125 data-angleArc=250 value="<?php echo $auditrefixincomplete; ?>" readonly/>
							</div>
						</div>
						<div class="myaudit_legend">
							<div class="legend1"></div>
							<div>COC's Being Audited</div>
							<div class="legend2"></div>
							<div>Refixes Required</div>
						</div>
					</div>
					<div class="col-md-5 audit_ratio_cus">
						<div class="aud_rati">
							<p class="rat_box"><?php echo $auditorratio; ?></p>
							<p>Audit Ratio</p>
						</div>
					</div>
				</div>
				
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>COC Number</th>
								<th>Status</th>
								<th>Consumer</th>
								<th>Address</th>
								<th>Refix Due Date</th>
								<th>Refix Complete Date</th>
								<th>Date Allocated to Auditor</th>
								<th>Auditor</th>
								<th>Action</th>
								<th class="displaynone">Notification</th>
							</tr>							
						</thead>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<div id="ratingmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="ratingform" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Rating</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Rate your experience with <span class="ratingauditor"></span></label>
								<div id="ratingwrapper"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Comments</label>
								<textarea name="comments" id="comments" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer ratingfooter">
					<input type="hidden" name="rating" id="rating">
					<input type="hidden" name="cocid" class="cocid">
					<input type="hidden" name="auditorid" class="auditorid">
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(function(){
		
		knobchart();
		
		var options = {
			url 	: 	'<?php echo base_url()."plumber/auditstatement/index/DTAuditStatement"; ?>',
			data 	: 	{ page : 'plumberauditorstatement' },
			columns : 	[
							{ "data": "cocno" },
							{ "data": "status" },
							{ "data": "consumer" },
							{ "data": "address" },
							{ "data": "refixdate" },
							{ "data": "refixcompletedate" },
							{ "data": "auditordate" },
							{ "data": "auditor" },
							{ "data": "action" },
							{ "data": "notification" }
						],
			target	:	[8],
			sort	:	'0',
			order 	: 	[[0, 'desc']],
			target1	:	[9],
			visible1:	'0',
			createdrow : createdrow
		};
		
		ajaxdatatables('.datatables', options);
	});
	
	function createdrow(row, data, dataIndex){
		if(data.notification=='1'){
			$(row).addClass('tablestripe');
		}
	}
	
	$(document).on('click', '.starrating', function(){
		var cocid 		= $(this).attr('data-cocid');
		var auditorid 	= $(this).attr('data-auditorid');
		
		$('.cocid').val(cocid);
		$('.auditorid').val(auditorid);
		$('.ratingfooter').show();
		$('#comments').val('');
		rating('#ratingwrapper', '#rating', '0');
		
		ajax('<?php echo base_url()."ajax/index/ajaxreviewrating"; ?>', {'cocid' : cocid, 'auditorid' : auditorid}, '', { success : function(data){ 
			if(data.status=='1'){
				$('.ratingfooter').hide();
				$('#comments').val(data.result.comments);
				rating('#ratingwrapper', '#rating', data.result.rating);
			}
		}});
	})
</script>
