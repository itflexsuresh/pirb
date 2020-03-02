<?php 
 $compid = isset($id) ? $id : '';
 	// Employee Details
 	if(!empty($employee)){
	 	$reg_no					= isset($employee[0]['registration_no']) ? $employee[0]['registration_no'] : '';
	    $name 		            = isset($employee[0]['name']) ? $employee[0]['name'] : ''; 
	    $surname 	            = isset($employee[0]['surname']) ? $employee[0]['surname'] : ''; 
	    $status 				= isset($employee[0]['status']) ? $plumberstatus[$employee[0]['status']] : ''; 
	    $email 				    = isset($employee[0]['email']) ? $employee[0]['email'] : '';
	    $designation 			= isset($employee[0]['designation']) ? $designation2[$employee[0]['designation']] : '';
	    $mobile_phone 		    = isset($employee[0]['mobile_phone']) ? $employee[0]['mobile_phone'] : '';
	    $user_id 		        = isset($employee[0]['user_id']) ? $employee[0]['user_id'] : '';
	    $file2 		            = isset($employee[0]['file2']) ? $employee[0]['file2'] : '';
	    $specialisations 	    = isset($employee[0]['specialisations']) ? explode(',',$employee[0]['specialisations']) : '';
 	}

 	

	$plumberid			= '';
	$auditorid			= '';
	$developmental1 = '';
	$workbased1 = '';
	$individual1 = '';

	if (isset($settings_cpd)) {
		$cpdarray 	= explode("@@@", $settings_cpd[0]['cpd']);
	}
	if (isset($cpdarray)) {
		$devarray 	= explode("@-@", $cpdarray[0]);
	}
	if (isset($cpdarray)) {
		$workarray 	= explode("@-@", $cpdarray[1]);
	}
	if (isset($cpdarray)) {
		$indarray 	= explode("@-@", $cpdarray[2]);
	}
	if (isset($user_details)) {
		if($user_details['designation'] == '1'){
		$developmental1 = isset($devarray[6]) ? $devarray[6] : '';
		$workbased1 = isset($workarray[6]) ? $workarray[6] : '';
		$individual1 = isset($indarray[6]) ? $indarray[6] : '';
		}
		elseif($user_details['designation'] == '2'){
			$developmental1 = isset($devarray[5]) ? $devarray[5] : '';
			$workbased1 = isset($workarray[5]) ? $workarray[5] : '';
			$individual1 = isset($indarray[5]) ? $indarray[5] : '';
		}
		elseif($user_details['designation'] == '3'){
			$developmental1 = isset($devarray[4]) ? $devarray[4] : '';
			$workbased1 = isset($workarray[4]) ? $workarray[4] : '';
			$individual1 = isset($indarray[4]) ? $indarray[4] : '';
		}
		elseif($user_details['designation'] == '4'){
			$developmental1 = isset($devarray[3]) ? $devarray[3] : '';
			$workbased1 = isset($workarray[3]) ? $workarray[3] : '';
			$individual1 = isset($indarray[3]) ? $indarray[3] : '';
		}
		elseif($user_details['designation'] == '6'){
			$developmental1 = isset($devarray[2]) ? $devarray[2] : '';
			$workbased1 = isset($workarray[2]) ? $workarray[2] : '';
			$individual1 = isset($indarray[2]) ? $indarray[2] : '';
		}
	}

	

	$developmental = isset($history['developmental']) ? $history['developmental'] : '';
	$workbased 	   = isset($history['workbased']) ? $history['workbased'] : '';
	$individual    = isset($history['individual']) ? $history['individual'] : '';

	if($developmental == '')
		$developmental = 0;

	if($workbased == '')
		$workbased = 0;

	if($individual == '')
		$individual = 0;


	if($developmental1 == '')
		$developmental1 = 0;

	if($workbased1 == '')
		$workbased1 = 0;

	if($individual1 == '')
		$individual1 = 0;

	$total = $developmental + $workbased + $individual;
	$total1 = $developmental1 + $workbased1 + $individual1;

	//Adudit


	// $loggedcoc 		 = isset($loggedcoc) ? $loggedcoc : '';
	// $count 			 = isset($history['count']) ? $history['count'] : '';
	// $total1 		= isset($history['total']) ? $history['total'] : '';
	// $refixincomplete = isset($history['refixincomplete']) ? $history['refixincomplete'] : '';
	// $refixcomplete 	 = isset($history['refixcomplete']) ? $history['refixcomplete'] : '';
	// $compliment 	 = isset($history['compliment']) ? $history['compliment'] : '';
	// $cautionary 	 = isset($history['cautionary']) ? $history['cautionary'] : '';
	// $noaudit 		 = isset($history['noaudit']) ? $history['noaudit'] : '';

	// if($loggedcoc > 0 && $count > 0)
	// 	$percentage 	= round(($count/$loggedcoc)*100,2).'%'; 
	// else
	// 	$percentage = 0;

	// if($refixincomplete > 0)
	// 	$refixincompletepercentage 	= round(($refixincomplete/$total)*100,2).'%'; 
	// else
	// 	$refixincompletepercentage = 0;

	// if($refixcomplete > 0)
	// 	$refixcompletepercentage 	= round(($refixcomplete/$total)*100,2).'%'; 
	// else
	// 	$refixcompletepercentage = 0;

	// if($compliment > 0)
	// 	$complimentpercentage 		= round(($compliment/$total)*100,2).'%';
	// else
	// 	$complimentpercentage = 0;

	// if($cautionary > 0)
	// 	$cautionarypercentage 		= round(($cautionary/$total)*100,2).'%';
	// else
	// 	$cautionarypercentage = 0;

	// if($noaudit > 0)
	// 	$noauditpercentage 			= round(($noaudit/$total)*100,2).'%';
	// else
	// 	$noauditpercentage = 0;

 ?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Employee Listing</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="breadcrumb-item active">Employee Listing</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Employee Listing</h4>
				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Registration Number</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Plumbers Name and Surname</th>
								<th>CPD Status</th>
								<th>Performance Status</th>
								<th>Overall Industry Rating</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
				<?php if (isset($employee) && $employee!='') { ?>
					<div class="row">
						<div class="col-md-5 align-self-center">
						<h4 class="card-title app_status">Average Industry Rating of Company Employees</h4>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<label>Licensed Plumber and above</label>
						<input type="text" class="form-control" readonly name="">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Non Licensed Plumbers</label>
						<input type="text" class="form-control" readonly name="">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Employee Details</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Registration Number</label>
							<input type="text" class="form-control" readonly name=""  value="<?php echo $reg_no;?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Plumbers Name and Surname</label>
							<input type="text" class="form-control" readonly name=""  value="<?php echo  $name.' '.$surname;?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone (Mobile)</label>
							<input type="text" class="form-control" readonly name=""  value="<?php echo  $mobile_phone;?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" readonly name=""  value="<?php echo  $email;?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Plumbers Image</label>
							<img src="<?php echo base_url().'/assets/uploads/plumber/'.$user_id.'/'.$file2; ?>" alt="" width="42" height="42">
						</div>
					</div>
				</div>
				<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<input type="text" class="form-control" readonly name=""  value="<?php echo  $status;?>">
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>PIRB Designation:</label>
							<input type="text" class="form-control" readonly name=""  value="<?php  echo $designation;?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
							<h4 class="card-title">Specilisations</h4>
							<div class="col-md-6">
							<?php foreach ($specialization as $key => $value) { 
								?>
								<input type="checkbox" readonly name="specilisations[]" value="<?php echo $key ?>"<?php echo (in_array($key, $specialisations)) ? 'checked="checked"' : ''; ?>> <?php echo $value ?><br>
							<?php }; ?>
								
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Number of Logged COC's:</label>
							<input type="text" class="form-control" readonly name=""  value="">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Number Audits Done to Date:</label>
							<input type="text" class="form-control" readonly name=""  value="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label></label>
							<input type="text" class="form-control" readonly name=""  value="">
						</div>
					</div>
				</div>
					<h4 class="card-title">CPD Overview</h4>
				<div id="reviewchart"></div>
				
				<div class="target"></div><label>Target</label>				
				<div class="achieved"></div><label>Achieved</label>
				<?php } ?>
				
				
			</div>
			
		</div>
	</div>
</div>
		
<script>
	$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."company/employee_listing/DTemplist"; ?>',
			data 	: {"comp_id": "<?php echo $compid; ?>"},
			columns : 	[
							{ "data": "reg" },
							{ "data": "designation" },
							{ "data": "status" },
							{ "data": "namesurname" },
							{ "data": "cpdstatus" },
							{ "data": "perstatus" },
							{ "data": "rating" },
							{ "data": "action" }
						],
						
		};
		
		ajaxdatatables('.datatables', options);

			var auditorid 	= '<?php echo $auditorid; ?>';
	var plumberid 	= '<?php echo $plumberid; ?>';
	var developmental = '<?php echo $developmental; ?>';
	var workbased 	= '<?php echo $workbased; ?>';
	var individual 	= '<?php echo $individual; ?>';
	var total 		= '<?php echo $total; ?>';
	var developmental1 = '<?php echo $developmental1; ?>';
	var workbased1 	= '<?php echo $workbased1; ?>';
	var individual1 	= '<?php echo $individual1; ?>';
	var total1		= '<?php echo $total1; ?>';

	// var barcolor1 = ['#4472C4','#843C0C','#FF0000','#ED7D31','#333F50','#4472C4'];
	var barcolor = ['#4472C4','#ED7D31','#4472C4','#ED7D31'];
	
	Morris.Bar({
		barSizeRatio:0.4,
        element: 'reviewchart',
        data: [
			{
				y: 'Development',
				a: developmental1,
				b: developmental
			}, 
			{
				y: 'Work-Base',
				a: workbased1,
				b: workbased
			}, 
			{
				y: 'Individual',
				a: individual1,
				b: individual
			}, 
			{
				y: 'Total',
				a: total1,
				b: total
			}
		],
        xkey: 'y',
		xLabelMargin : 1,
        ykeys: ['a','b'],
        
        labels: ['Target','Achieved'],
		barColors: function (row, series, type) {			
			if(series.key == "a") return "#4472C4";
			if(series.key == "b") return "#ED7D31";
			// return barcolor[row.x];
		}, 
        hideHover: 'auto',
        gridLineColor: '#000',
        resize: true
    });
    
	});

</script>
