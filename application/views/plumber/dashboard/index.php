<?php 
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Dashboard</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
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
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 cpd_section_sec">
								<div class="cpd_points_sec">
									<p class="cus_my_cpd">My CPD Points</p>
									<div class="text-center">
										<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#FEC806" data-angleOffset=-125 data-angleArc=250 value="<?php echo $mycpd; ?>" readonly/>
									</div>
									<p class="cus_view_cpd"><a href="<?php echo base_url().'plumber/mycpd/index'; ?>">View CPD Activities</a></p>
								</div>
							</div>
							<div class="col-md-6 coc_sectiom_cus">
								<div class="coc_sec">
									<p class="cus_my_coc">My COC’s</p>
									<div id="mycocs" style="width:100%; height:400px;" class="cus_line"></div>
								</div>
							</div>
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
						</div>
					</div>
					<div class="col-md-4 my_perform_sec displaynone">
						<div class="cus_perform"> 
							<p class="perf_hed">My Performance Status</p>
							<div id="performancechart" style="width:100%; height:300px;"></div>
							<div class="perform_graph">
                             <img src="<?php echo base_url().'assets/images/graph_icon.png'; ?>">
                            </div>
							<p class="per_scr_hed">My Performance Score</p>	
							<p class="per_scr_box"><?php echo $performancestatus; ?></p>
							<div class="my_Rank">
								<p class="per_coun_hed">My Country Ranking</p>
								<p class="cus_co_rank"><?php echo $overallperformancestatus; ?></p>
							</div>
							<div class="my_Rank">
								<p class="per_coun_hed">My Regional  Ranking</p>
								<p class="cus_co_rank"><?php echo $provinceperformancestatus; ?></p>
							</div>
						</div>
					</div>
						<div class="col-md-4 friend_list_section">
							<div class="frd_list">
								<p class="frd_head">Friends</p>
								<ul class="custom_friend_list">
									<?php 
										if(count($friends) > 0){
										foreach($friends as $key => $list){ 
											$id						= $list['id'];
											$userid					= $list['userid'];
											$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
											$file2 					= isset($list['file2']) ? $list['file2'] : '';
											if($file2!=''){
												$explodefile2 	= explode('.', $file2);
												$extfile2 		= array_pop($explodefile2);
												$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
												$photoidurl		= $filepath.$file2;
											}else{
												$photoidimg 	= $profileimg;
												$photoidurl		= 'javascript:void(0);';
											}
											
											$rank = $list['rank'];
									?>
									<li>
										<div class="frd_ord">
											<div class="cus_frnd">
												<img src="<?php echo $photoidimg; ?>" class="frd_prof">
												<div class="frd_det">
													<p class="frd_name"><?php echo $list['name']; ?></p>
													<p class="frd_num"><?php echo $list['registration_no']; ?></p> 
												</div>
												<p class="frd_rank">
													<?php 
														echo $rank; 
														if($rank=='1')		echo 'st'; 
														elseif($rank=='2') 	echo 'nd'; 
														elseif($rank=='3') 	echo 'rd'; 
														else 				echo 'th'; 
													?>
												</p>
											</div>
											<div class="cus_frnd_edit">
												<a href="<?php echo base_url().'plumber/friends/index'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											</div>
										</div>
									</li>
									<?php }}else{ echo '<li><p class="frd_head">-</p></li>'; } ?>
								</ul>
							</div>
						</div>

				</div>
				
				<div class="row">
					<div class="col-md-8">
						<div class="col-md-12 message_sec">
							<div class="cus_msg">
								<p>My Pirb Messages</p>
								<?php 
									$data 	= $this->db->where("groups='1' AND status='1'")->get('messages')->result_array();
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
						<div class="row displaynone">
							<div class="col-md-6 cus_reg_sec">
								<div class="cus_regt">
									<p class="reg_he">Current Top 3 Regional Ranking (Country)</p>
									<div class="row reg_grap">
										<?php 
											foreach($overallperformancestatuslimit as $key => $performance){ 
												$userid					= $performance['userid'];
												$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
												$file2 					= isset($performance['image']) ? $performance['image'] : '';
												if($file2!=''){
													$explodefile2 	= explode('.', $file2);
													$extfile2 		= array_pop($explodefile2);
													$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
													$photoidurl		= $filepath.$file2;
												}else{
													$photoidimg 	= $profileimg;
													$photoidurl		= 'javascript:void(0);';
												}
										?>
												<div class="col-md-4 cus_bar_">
													<div class="bar_img">
														<img src="<?php echo $photoidimg; ?>" class="bar_profil">
														<span class="ver_name<?php echo $key+1; ?>"><?php echo $performance['name']; ?></span>
														<img src="<?php echo base_url().'assets/images/bar'.($key+1).'.png'; ?>" class="bar_3d cus_pirb<?php echo $key+1; ?>">
														<span class="bar_bot"><?php echo $performance['point']; ?></span>
													</div>
												</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="col-md-6 cus_reg_sec">
								<div class="cus_regt">
									<p class="reg_he">Current Top 3 Regional Ranking (Province)</p>
									<div class="row reg_grap">
										<?php 
											foreach($provinceperformancestatuslimit as $key => $performance){ 
												$userid					= $performance['userid'];
												$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
												$file2 					= isset($performance['image']) ? $performance['image'] : '';
												if($file2!=''){
													$explodefile2 	= explode('.', $file2);
													$extfile2 		= array_pop($explodefile2);
													$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
													$photoidurl		= $filepath.$file2;
												}else{
													$photoidimg 	= $profileimg;
													$photoidurl		= 'javascript:void(0);';
												}
										?>
												<div class="col-md-4 cus_bar_">
													<div class="bar_img">
														<img src="<?php echo $photoidimg; ?>" class="bar_profil">
														<span class="ver_name<?php echo $key+1; ?>"><?php echo $performance['name']; ?></span>
														<img src="<?php echo base_url().'assets/images/bar'.($key+1).'.png'; ?>" class="bar_3d cus_pirb<?php echo $key+1; ?>">
														<span class="bar_bot"><?php echo $performance['point']; ?></span>
													</div>
												</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 friend_list_section displaynone">
						<div class="frd_list">
							<p class="frd_head">Friends</p>
							<ul class="custom_friend_list">
								<?php 
									if(count($friends) > 0){
									foreach($friends as $key => $list){ 
										$id						= $list['id'];
										$userid					= $list['userid'];
										$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
										$file2 					= isset($list['file2']) ? $list['file2'] : '';
										if($file2!=''){
											$explodefile2 	= explode('.', $file2);
											$extfile2 		= array_pop($explodefile2);
											$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
											$photoidurl		= $filepath.$file2;
										}else{
											$photoidimg 	= $profileimg;
											$photoidurl		= 'javascript:void(0);';
										}
										
										$rank = $list['rank'];
								?>
								<li>
									<div class="frd_ord">
										<div class="cus_frnd">
											<img src="<?php echo $photoidimg; ?>" class="frd_prof">
											<div class="frd_det">
												<p class="frd_name"><?php echo $list['name']; ?></p>
												<p class="frd_num"><?php echo $list['registration_no']; ?></p> 
											</div>
											<p class="frd_rank">
												<?php 
													echo $rank; 
													if($rank=='1')		echo 'st'; 
													elseif($rank=='2') 	echo 'nd'; 
													elseif($rank=='3') 	echo 'rd'; 
													else 				echo 'th'; 
												?>
											</p>
										</div>
										<div class="cus_frnd_edit">
											<a href="<?php echo base_url().'plumber/friends/index'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										</div>
									</div>
								</li>
								<?php }}else{ echo '<li><p class="frd_head">-</p></li>'; } ?>
							</ul>
						</div>
					</div>
				</div>
				<div id="myCharts"></div>
			</div>
		</div>
	</div>
</div>

<script>
	
	var nonlogcoc 				= '<?php echo $nonlogcoc; ?>';
	var adminstock 				= '<?php echo $adminstock; ?>';
	var coccount 				= '<?php echo $coccount; ?>';
	var performancestatus 		= '<?php echo $performancestatus; ?>';
	
	$(function(){
		knobchart();
		
		barchart2(
			'mycocs',
			{
				xaxis : [
					'Number of \n Non Logged \n COCs',
					'COC’s yet \n to allocated',
					'Permitted COCs \n that you are \n able to purchase'
				],
				series : [{
					name : 'My COC’s',
					yaxis : [
						nonlogcoc,
						adminstock,
						coccount
					],
					colors : ['#C4E0B2','#CEF57F','#9ADD11']
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