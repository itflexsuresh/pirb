
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Dashboard</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'resellers/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4 cpd_section_sec">
								<div class="cpd_points_sec">
									<p class="cus_my_cpd">My COC Stock</p>
									<div class="text-center">
										<img src="<?php echo base_url().'assets/images/note1.png'; ?>" alt=""> 
										<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#ff0000" data-angleOffset=-125 data-angleArc=250 value="<?php echo $cocstock; ?>" readonly/>
									</div>
								</div>
							</div>
							<div class="col-md-8 coc_sectiom_cus" style="text-align:center;">
								<div class="coc_sec" style="height:400px">
									<p class="cus_my_coc">My COC History (last 6 Months)</p>
									<div id="mycocs" style="width:100%; height:290px;" class="cus_line"></div>
									<img src="<?php echo base_url().'assets/images/note2.png'; ?>" alt="" style="position: absolute;top: 40%;left: 70%;width: 79px;"> 
									<span style="background:#4472c4;padding: 0px 5px;margin-right: 5px;">&nbsp;</span><span style="margin-right: 5px;">COC Purchased</span><span style="background:#b4c7e7;padding: 0px 5px;margin-right: 5px;">&nbsp;</span><span>COC Allocated</span>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8">
						<div class="col-md-12 message_sec">
							<div class="cus_msg">
								<p>My Pirb Messages</p>
								<?php 
									$data 	= $this->db->where("groups='3' AND status='1'")->get('messages')->result_array();
									$msg 	= "";
									foreach ($data as $key => $value) {
										$currentDate = date('Y-m-d');
										$startdate   = date('Y-m-d',strtotime($value['startdate']));
										$enddate = date('Y-m-d',strtotime($value['enddate']));
										if ($currentDate>= $startdate && $currentDate<=$enddate){
											$msg = $msg.$value['message'].'</br></br>'; 
										}
									}
									
									echo '<div class="col-md-12">'.$msg.'</div>';
								?>
							</div>
						</div>
					</div>
				</div>
				<div id="myCharts"></div>
			</div>
		</div>
	</div>
</div>

<script>
	
	var month1 					= '<?php echo $coc_purchase["1"]["month"]; ?>';
	var month2 					= '<?php echo $coc_purchase["2"]["month"]; ?>';
	var month3 					= '<?php echo $coc_purchase["3"]["month"]; ?>';
	var month4 					= '<?php echo $coc_purchase["4"]["month"]; ?>';
	var month5 					= '<?php echo $coc_purchase["5"]["month"]; ?>';
	var month6 					= '<?php echo $coc_purchase["6"]["month"]; ?>';

	var month1_purchase 		= '<?php echo $coc_purchase["1"]["value"]; ?>';
	var month1_allocate 		= '<?php echo $coc_purchase["2"]["value"]; ?>';
	var month2_purchase 		= '<?php echo $coc_purchase["3"]["value"]; ?>';
	var month2_allocate 		= '<?php echo $coc_purchase["4"]["value"]; ?>';
	var month3_purchase 		= '<?php echo $coc_purchase["5"]["value"]; ?>';
	var month3_allocate 		= '<?php echo $coc_purchase["6"]["value"]; ?>';
	var month4_purchase 		= '<?php echo $coc_allocated["1"]["value"]; ?>';
	var month4_allocate 		= '<?php echo $coc_allocated["2"]["value"]; ?>';
	var month5_purchase 		= '<?php echo $coc_allocated["3"]["value"]; ?>';
	var month5_allocate 		= '<?php echo $coc_allocated["4"]["value"]; ?>';
	var month6_purchase 		= '<?php echo $coc_allocated["5"]["value"]; ?>';
	var month6_allocate 		= '<?php echo $coc_allocated["6"]["value"]; ?>';
	var performancestatus 		= '<?php echo $cocstock; ?>';

	
	$(function(){
		knobchart();
		
		barchart2(
			'mycocs',
			{
				xaxis : [
					'',
					month1,
					'',
					month2,
					'',
					month3,
					'',
					month4,
					'',
					month5,
					'',
					month6
				],
				series : [{
					name : 'My COC’s',
					yaxis : [
						month1_purchase,
						month1_allocate,
						month2_purchase,
						month2_allocate,
						month3_purchase,
						month3_allocate,
						month4_purchase,
						month4_allocate,
						month5_purchase,
						month5_allocate,
						month6_purchase,
						month6_allocate
						
					],
					colors : ['#4472c4','#b4c7e7','#4472c4','#b4c7e7','#4472c4','#b4c7e7','#4472c4','#b4c7e7','#4472c4','#b4c7e7','#4472c4','#b4c7e7']
				}]
			}
		);
		
		gaugechart(
			'performancechart',
			{
				name : 'Performance Chart',
				data : [{value: performancestatus, name: ''}],
				colors : [[0.2, '#55ce63'],[0.5, '#FBB596'],[0.8, '#009efb'],[1, '#f62d51']]
				
			}
		);
		//meterchart('performancechart', performancestatus);
	});
</script>
