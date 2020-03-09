 <style>
.target {
  width: 8px;
    height: 9px;
    background-color: #4472c4;
}
.achieved {
     width: 8px;
    height: 9px;
    background-color: #ed7d31;
}
</style>

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

 	// Plumber CPD

 	if($roletype=='1'){
		$heading = 'Manage Allocted Audits';
	}else if($roletype=='3' || $roletype=='5'){
		$heading = 'Audit Report';
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


	//Adudit


	$loggedcoc 		 = isset($loggedcoc) ? $loggedcoc : '';
	$count 			 = isset($history['count']) ? $history['count'] : '';
	$totals 			= isset($history['total']) ? $history['total'] : '';
	$refixincomplete = isset($history['refixincomplete']) ? $history['refixincomplete'] : '0';
	$refixcomplete 	 = isset($history['refixcomplete']) ? $history['refixcomplete'] : '0';
	$compliment 	 = isset($history['compliment']) ? $history['compliment'] : '0';
	$cautionary 	 = isset($history['cautionary']) ? $history['cautionary'] : '0';
	$noaudit 		 = isset($history['noaudit']) ? $history['noaudit'] : '0';

	if($loggedcoc > 0 && $count > 0)
		$percentage 	= round(($count/$loggedcoc)*100,2).'%'; 
	else
		$percentage = 0;


	if($refixincomplete > 0 && $total>0 && $total!='')
		$refixincompletepercentage 	= round(($refixincomplete/$total)*100,2).'%'; 
	else
		$refixincompletepercentage = 0;


	if($refixcomplete > 0 && $total>0 && $total!='')
		$refixcompletepercentage 	= round(($refixcomplete/$total)*100,2).'%'; 
	else
		$refixcompletepercentage = 0;


	if($compliment > 0 && $total>0 && $total!='')
		$complimentpercentage 		= round(($compliment/$total)*100,2).'%';
	else
		$complimentpercentage = 0;


	if($cautionary > 0 && $total>0 && $total!='')
		$cautionarypercentage 		= round(($cautionary/$total)*100,2).'%';
	else
		$cautionarypercentage = 0;


	if($noaudit > 0 && $total>0 && $total!='')
		$noauditpercentage 			= round(($noaudit/$total)*100,2).'%';
	else
		$noauditpercentage = 0;

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
<?php if($roletype=='1'){ echo isset($menu) ? $menu : ''; } ?>
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
				<div class="row">
						<div class="col-md-5 align-self-center">
						<h4 class="card-title app_status">Average Industry Rating of Company Employees</h4>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
						<label>Licensed Plumber and above</label>
						<input type="text" class="form-control" readonly id="lm_plumber" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Non Licensed Plumbers</label>
						<input type="text" class="form-control" id="others" readonly name="">
					</div>
				</div>
				<?php if (isset($employee) && $employee!='') { ?>

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
							<img src="<?php echo base_url().'/assets/uploads/plumber/'.$user_id.'/'.$file2; ?>" id="plumber_profile" alt="" width="42" height="42">
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
								<input type="checkbox" disabled name="specilisations[]" value="<?php echo $key ?>"<?php echo (in_array($key, $specialisations)) ? 'checked="checked"' : ''; ?>> <?php echo $value ?><br>
							<?php }; ?>
								
							</div>
						</div>
					</div>
					<h4 class="card-title">CPD Overview</h4>
					
				<div id="reviewchart" style="width:100%; height:400px;"></div>
				
				<div class="target" style="width: 8px;height: 9px;background-color: #4472c4;"></div><label>Target</label>				
				<div class="achieved" style="width: 8px;height: 9px;background-color: #ed7d31;"></div><label>Achieved</label>
				<div id="reviewchart1" style="width:100%; height:400px;"></div>
				<div class="row">
					<div class="col-md-2">
						<label >Number of Logged COC's</label>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="loggedcoc" value="<?php echo $loggedcoc; ?>">
					</div>
					<div class="col-md-2">
						<label>Number Audits Done to Date</label>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="auditdone" value="<?php echo $count; ?>">
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" name="percentage" value="<?php echo $percentage; ?>">
					</div>
				</div>
				<div class="target" style="width: 8px;height: 9px;background-color: #4472c4;"></div><label>Target</label>				
				<div class="achieved" style="width: 8px;height: 9px;background-color: #ed7d31;"></div><label>Achieved</label>
				<?php } ?>
				
				
			</div>
			
		</div>
	</div>
</div>
		
<script>
	$(function(){

		$('#plumber_profile').click(function() {
		   	var loc = $(this).attr("src");
     		window.open(loc, '_blank');
		});

		setTimeout(function(){
			var lmcount =  $('.lm').length
			var sum = 0;	
			$('.lm').each(function(){	
	        	sum += Number($(this).val());
	    	});
	    	$('#lm_plumber').val(sum/lmcount);

	    	var others1 =  $('.other').length
			var sum1 = 0;	
			$('.other').each(function(){	
	        	sum1 += Number($(this).val());
	    	});
	    	$('#others').val(sum1/others1);

		}, 1000);

		
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/company/index/DTemplist"; ?>',
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
		
		
		barchart(
			'reviewchart',
			{
				xaxis : [
					'Development',
					'Work-Base',
					'Individual',
					'Total'
				],
				series : [
					{
						name : 'CPD',
						yaxis : [
							developmental1,
							workbased1,
							individual1,
							total1
						],
						color : '#4472C4'
					},
					{
						name : 'CPD',
						yaxis : [
							developmental,
							workbased,
							individual,
							total
						],
						color : '#ED7D31'
					}
				]
			}
		);

		var auditorid 		= '<?php echo $auditorid; ?>';
		var totals 			= '<?php echo $total; ?>';
		var refixincomplete = '<?php echo $refixincomplete; ?>';
		var refixcomplete 	= '<?php echo $refixcomplete; ?>';
		var compliment 		= '<?php echo $compliment; ?>';
		var cautionary 		= '<?php echo $cautionary; ?>';
		var noaudit 		= '<?php echo $noaudit; ?>';
		
		barchart(
			'reviewchart1',
			{
				xaxis : [
					'Total No of Audit Findings',
					'Compliments',
					'Cautionary',
					'Refix (Complete)',
					'Refix(In Complete)',
					'No Audit'
				],
				series : [{
					name : 'Audit',
					yaxis : [
						total,
						compliment,
						cautionary,
						refixcomplete,
						refixincomplete,
						noaudit
					],
					colors : ['#4472C4','#843C0C','#FF0000','#ED7D31','#333F50','#4472C4']
				}]
			}
		);
    
	});



	
	

</script>
