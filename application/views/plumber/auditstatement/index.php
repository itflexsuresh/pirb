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
							<div>COC being Audited</div>
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
								<th>Refix Date</th>
								<th>Auditor</th>
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
							{ "data": "auditor" },
							{ "data": "action" }
						],
			target	:	[6],
			sort	:	'0'
		};
		
		ajaxdatatables('.datatables', options);
	});
</script>
