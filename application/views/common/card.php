<?php

	
	$userid					=isset($result['id']) ? $result['id'] : '';

	$name 					= isset($result['name']) ? $result['name'] : '';
	$surname 				= isset($result['surname']) ? $result['surname'] : '';
	
	$designation2id 		= isset($result['designation']) ? $result['designation'] : '';
	$registration_no 		= isset($result['registration_no']) ? $result['registration_no'] : '';
	$registration_date 		= isset($result['registration_date']) && $result['registration_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['registration_date'])) : '';
	$renewal_date 			= $registration_date!='' ? date('d-m-Y', strtotime($result['registration_date']. ' +365 days')) : '';
	$specialisationsid 		= isset($result['specialisations']) ? array_filter(explode(',', $result['specialisations'])) : '';
	$companyname		= isset($result['companyname']) ? $result['companyname'] : '';

	$work_phone			= isset($settings['work_phone']) ? $settings['work_phone'] : '';

	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	$logo  					= base_url().'assets/images/card/logo.png';
	$spl1  					= base_url().'assets/images/card/Solar.png';
	$spl2  					= base_url().'assets/images/card/Gas.png';
	$spl3  					= base_url().'assets/images/card/Estimator.png';
	$spl4  					= base_url().'assets/images/card/Heatpump.png';
	$spl5  					= base_url().'assets/images/card/Training Assessor.png';
	$spl6  					= base_url().'assets/images/card/Arbitrator.png';


	$file2 					= isset($result['file2']) ? $result['file2'] : '';
	if($file2!=''){
		$explodefile2 	= explode('.', $file2);
		$extfile2 		= array_pop($explodefile2);
		$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
	}else{
		$photoidimg 	= $profileimg;
	}
	
	$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';

	$cardcolor = ['1' => 'learner_plumber', '2' => 'technical_assistant', '3' => 'technical_operator', '4' => 'licensed_plumber', '5' => 'qualified_plumber', '6' => 'master_plumber'];
?>


<div class="row add_top_value <?php echo (isset($cardcolor[$designation2id]) ? $cardcolor[$designation2id] : ''); ?>">
	<div class="col-md-6">	
		<table id="id_Card" style="height: 300px;">
			<tbody>
				<tr>
					<td>
						<img class="id_logo" src="<?php echo base_url();?>assets/images/pitrb-logo.png">
						<p>Reg No: <?php echo ($registration_no!='') ? $registration_no : '-'; ?></p>
						<p>Renewal Date: <?php echo $renewal_date; ?></p>
					</td>
					<td>
						<img class="id_admin" src="<?php echo $photoidimg; ?>">
						<p><?php echo $name.' '.$surname; ?></p>
					</td>
				</tr>
				<tr class="add_idcard_color" >
					<td>
						<img class="plum_lic" src="<?php echo base_url()?>assets/images/Plumber_License.png">
					</td>
					<td>
						<p class="license"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<table id="id_Card_back">
			<tbody style="width: 90%; display: inline-block;">
				
				<?php if($designation2id != '1' and $designation2id != '2' and $designation2id != '3'){ ?>
				<tr>
					<td colspan="2">
						<p>This card holder is only entitled to purchase and issue Plumbing COC’s for the following categories of plumbing and plumbing specialisations</p>
					</td>
				</tr>
			
				<tr>
					<?php 
						if(!empty($specialisationsid)){
							$specialisationskey = 0;
							foreach($specialisationsid as $specialisationsdata){
								if($specialisationskey==0){
					?>
									<td class="add_width">
								
					<?php
								}
					?>				
							
							
								<?php
									if($specialisationsdata	 =='1'){ echo "<img src='".$spl1 ."'>";} 
									if($specialisationsdata	 =='2'){ echo "<img src='".$spl2 ."'>";} 
									if($specialisationsdata	 =='3'){ echo "<img src='".$spl3 ."'>";} 
									if($specialisationsdata	 =='4'){ echo "<img src='".$spl4 ."'>";} 
									if($specialisationsdata	 =='5'){ echo "<img src='".$spl5 ."'>";} 
									else{
									if($specialisationsdata	 =='6'){ echo "<img src='".$spl6 ."'>";}
									}
									?>
												<?php echo isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-'; ?>
											
					<?php
								if($specialisationskey==2 || (count($specialisationsid)-1)==$specialisationskey){
					?>
										
										

									</td>
					<?php
								}
								
								$specialisationskey++;
								if($specialisationskey==3) $specialisationskey=0;
							}
						}else{
					?>
							<td class="add_width" style="vertical-align: top;">-</td>
					<?php 
						}
						
					}	else{
						echo "<img src='".$logo."'>";
					}
					?>
				</tr>
				<tr style="border-top: 1px solid #000;">
					<td style="border-right: 1px solid #000; height: 92px;">
						<p class="emp_title">Current Employer: </p> 
						<p class="plumber_name add_style"><?php echo  $companyname; ?></p>
						<p style="width: 100%;">Lost or Found <?php echo $work_phone; ?> <br>
						Verification can be done via www.pirb.co.za</p>
					</td>
					<?php if($designation2id != '1' and $designation2id != '2' and $designation2id != '3'){ ?>
					<td>
						<p style="width: 100%;">Specialisations</p>
						<?php 
							if(count($specialisationsid) > 0){
								foreach($specialisationsid as $specialisationsdata){
								
						?>
									<div><?php echo isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-'; ?></div>
						<?php	
								}
							}else{
							
						?>
								<p>-</p>
						<?php 
							}
						}

						?>
					</td>

				</tr>
				
			</tbody>
			<tbody style="width: 10%; display: inline-block;">
				<tr style="height: 300px;">
					<td class="add_idcard_color" colspan="2" style="text-align: center; padding: 15px;">
						<p class="back_license" style="transform: rotate(-90deg);margin: -66px;"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
