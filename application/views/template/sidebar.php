<?php 
$userid 		= $userdata['id'];
$username 		= $userdata['name'];
$designation 	= $userdata['designation'];
$approvalstatus = $userdata['approvalstatus'];
$type 		 	= $userdata['type']; 
$formstatus  	= $userdata['formstatus']; 
$file2  		= $userdata['file2']; 
$registrationno = $userdata['registration_no']; 
$expirydate 	= $userdata['expirydate']; 

if(count($permission) > 0){
	$readpermission 	= explode(',', $permission['readpermission']);
	$writepermission 	= explode(',', $permission['writepermission']);
	$parent 			= explode(',', $permission['parent']);
	$menu 				= '2';
}else{
	$menu 				= '1';
}
?>
<aside class="left-sidebar">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<?php if($type=='1' || $type=='2'){ ?>
					<li><a href="<?php echo base_url().'admin/dashboard/index'; ?>">Dashboard</a></li>
					<?php if($menu=='1' || ($menu=='2' && in_array('1', $parent))){ ?>
						<li class="setp one"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Administration</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('30', $readpermission) || in_array('30', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/administration/noncompliancelisting/index'; ?>">Non Compliance Listings</a></li>
								<?php }if($menu=='1' || ($menu=='2' && (in_array('1', $readpermission) || in_array('1', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/administration/reportlisting/index'; ?>">Report Listings</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('2', $readpermission) || in_array('2', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/administration/installationtype'; ?>">Installation Type</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('3', $readpermission) || in_array('3', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/administration/subtype'; ?>">Sub Type</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('4', $readpermission) || in_array('4', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/administration/managearea/managearea'; ?>">Manage Area</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('2', $parent))){ ?>
						<li class="step three"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu"></span>Communication Management</a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('5', $readpermission) || in_array('5', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/communication/notification/index'; ?>">Notification and SMS Templates</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('3', $parent))){ ?>
						<li class="step coc_manage"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu" style="white-space: nowrap;">COC Management</span></a>
							<ul aria-expanded="false" class="collapse">	
								<?php if($menu=='1' || ($menu=='2' && (in_array('6', $readpermission) || in_array('6', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/cocstatement/cocdetails/index'; ?>">COC Details</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('7', $readpermission) || in_array('7', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/cocstatement/cocorders/index'; ?>">COC Orders</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('8', $readpermission) || in_array('8', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/cocstatement/papermanagement/index'; ?>">Paper Management</a></li>
								<?php } ?>
							</ul>						
						</li>	
					<?php } if($menu=='1' || ($menu=='2' && in_array('4', $parent))){ ?>					
						<li class="step two"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">System Setup</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('9', $readpermission) || in_array('9', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/systemusers/systemusers'; ?>">System Users</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('10', $readpermission) || in_array('10', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/rates/rates'; ?>">Rates</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('11', $readpermission) || in_array('11', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/systemsettings/systemsettings'; ?>">System Settings</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('12', $readpermission) || in_array('12', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/qualificationroutes/qualificationroute'; ?>">Qualification Routes</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('13', $readpermission) || in_array('13', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/message/message'; ?>">Messages</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('14', $readpermission) || in_array('14', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/performancesettings/plumberperformance'; ?>">Plumber Performance Types</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('15', $readpermission) || in_array('15', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/systemsetup/performancesettings/globalperformance'; ?>">Global Performance Settings</a></li>
								<?php } ?>
							</ul>						
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('5', $parent))){ ?>
						<li class="step three"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">CPD</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('16', $readpermission) || in_array('16', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/cpd/cpdtypesetup'; ?>">CPD Types</a></li>		
								<?php } if($menu=='1' || ($menu=='2' && (in_array('17', $readpermission) || in_array('17', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/cpd/cpdtypesetup/index_queue'; ?>">CPD Queue</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('6', $parent))){ ?>
						<li class="step four"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Plumber</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('18', $readpermission) || in_array('18', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/plumber/index'; ?>">Plumber Registration</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('19', $readpermission) || in_array('19', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/plumber/index/rejected'; ?>">Rejected Applications</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('7', $parent))){ ?>
						<li class="step five"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Company</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('20', $readpermission) || in_array('20', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/company/index'; ?>">Company</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('21', $readpermission) || in_array('21', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/company/index/rejected'; ?>">Rejected Applications</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('8', $parent))){ ?>
						<li class="step three"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Accounts</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('22', $readpermission) || in_array('22', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/accounts/renewal_plumber/index'; ?>">Renewal Plumber Registration Invoices</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('23', $readpermission) || in_array('23', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/accounts/auditorsinvoices/index'; ?>">Auditors Invoices for Payment</a></li>							
								<?php } if($menu=='1' || ($menu=='2' && (in_array('24', $readpermission) || in_array('24', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/accounts/accounts'; ?>">Plumber COC Invocies</a></li>		
								<?php } ?>
							</ul>
						</li>
					<?php } if($menu=='1' || ($menu=='2' && in_array('9', $parent))){ ?>
						<li class="step five"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Audits</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('25', $readpermission) || in_array('25', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/audits/index'; ?>">Manage Auditors</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('26', $readpermission) || in_array('26', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/audits/compulsory_audit/index'; ?>">Compulsory Audit Listing</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('27', $readpermission) || in_array('27', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/audits/cocallocate/index'; ?>">Manage COC Allocation for Audit</a></li>
								<?php } if($menu=='1' || ($menu=='2' && (in_array('28', $readpermission) || in_array('28', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/audits/auditstatement/index'; ?>">Manage Allocated Audits</a></li>
								<?php } ?>
							</ul>
						</li>		
					<?php } if($menu=='1' || ($menu=='2' && in_array('10', $parent))){ ?>
						<li class="step five"> 
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Resellers</span></a>
							<ul aria-expanded="false" class="collapse">
								<?php if($menu=='1' || ($menu=='2' && (in_array('29', $readpermission) || in_array('29', $writepermission)))){ ?>
									<li><a href="<?php echo base_url().'admin/resellers/index'; ?>">Resellers</a></li>
								<?php } ?>
							</ul>
						</li>				      
					<?php } ?>
				<?php 
					}elseif($type=='3'){ 
						$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
						$pdfimg 				= base_url().'assets/images/pdf.png';
						$profileimg 			= base_url().'assets/images/profile.jpg';
						
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
					<?php 
						if ($approvalstatus=='1'){
					?>
					<div class="row pro_section">
						<div class="col-sm-9 col-md-9 col-lg-9 side_pro">
							<a href="<?php echo $photoidurl; ?>" target="_blank" class="side_img">
								<img src="<?php echo $photoidimg; ?>" class="photo_image" width="100">
							</a>
							<p class="cus_username"><?php echo $username; ?></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<p class="cus_icon">
								<a href="<?php echo base_url().'plumber/profile/index'; ?>" target="_blank">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</p>
						</div>
						<div class="reg_sec">
							<?php if($registrationno!=''){ ?>
								<p class="cus_reg">Reg No:<?php echo $registrationno; ?></p>
							<?php } ?>
							<p class="cus_ren">Renewal Date: <?php echo date('jS F Y', strtotime($expirydate)); ?></p>
						</div>
					</div>
					<div class="row side_table displaynone">
						<div class="col-sm-7 col-md-7 col-lg-7 tab_right">  
							<p class="cus_perf"> Performance Score: </p><span class="per_num"><?php echo $performancestatus; ?></span>
						</div>
						<div class="col-sm-5 col-md-5 col-lg-5 tab_left">  
							<div class="tab_top">
								<p class="cus_cou"> Country Ranking: </p><span class="coun_num"><?php echo $overallperformancestatus; ?></span>
							</div>
							<div class="tab_bot">
								<p class="cus_reg_tab"> Regional Ranking: </p> <span class="reg_num"><?php echo $provinceperformancestatus; ?></span>
							</div>
						</div>
					</div>
					
					<li>
						<div class="row side_list">
							<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
								<a href="<?php echo base_url().'plumber/dashboard/index'; ?>"><i class="fa fa-tachometer" aria-hidden="true"></i></a>
							</div>
							<div class="col-sm-9 col-md-9 col-lg-9 list_name">
								<a href="<?php echo base_url().'plumber/dashboard/index'; ?>" class="cus_li_name"><p class="custom_li">Dashboard</p></a>
							</div>
						</div>
					</li>
					
					<?php } ?>
					
					<?php if($formstatus=='1'){ ?>
					<?php 
                       $this->db->select('*');
                       $this->db->from('messages');                  
                       $this->db->where("groups='1' AND status='1'");
                       $query=$this->db->get();
                       $data= $query->result_array();
                       $msg = "";
                       foreach ($data as $key => $value) {
                       		       				            
                       $currentDate = date('Y-m-d');
                       $startdate   = date('Y-m-d',strtotime($value['startdate']));
                       $enddate = date('Y-m-d',strtotime($value['enddate']));
                       if ($currentDate>= $startdate && $currentDate<=$enddate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
                    ?>
                      
						<?php 
						if (($designation == '4' || $designation == '6') && $approvalstatus=='1'){
						?>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/purchasecoc/index'; ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/purchasecoc/index'; ?>" class="cus_li_name"><p class="custom_li">Purchase COC</p></a>
									</div>
								</div>
							</li>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/cocstatement/index'; ?>"><i class="fa fa-file-text" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/cocstatement/index'; ?>" class="cus_li_name"><p class="custom_li">COC Statement</p></a>										
									</div>
								</div>
							</li>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/auditstatement/index'; ?>"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/auditstatement/index'; ?>" class="cus_li_name"><p class="custom_li">Audit Statement</p></a>
									</div>
								</div>
							</li>
						<?php
						} 
						?>
						
						<?php 
						if ($approvalstatus=='1') {							
						?>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/myaccounts/index'; ?>"><i class="fa fa-database" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/myaccounts/index'; ?>" class="cus_li_name"><p class="custom_li">My Accounts</p></a>
									</div>
								</div>
							</li>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/mycpd/index'; ?>"><i class="fa fa-book" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/mycpd/index'; ?>" class="cus_li_name"><p class="custom_li">My CPD</p></a>
									</div>
								</div>
							</li>
							<li class="displaynone">
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/performancestatus/index'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/performancestatus/index'; ?>" class="cus_li_name"><p class="custom_li">Performance Status</p></a>
									</div>
								</div>
							</li>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/friends/index'; ?>"><i class="fa fa-users" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/friends/index'; ?>" class="cus_li_name"><p class="custom_li">Friends</p></a>
									</div>
								</div>
							</li>
						<?php
						}else{ 
						?>
							<li>
								<div class="row side_list">
									<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
										<a href="<?php echo base_url().'plumber/profile/index'; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
									</div>
									<div class="col-sm-9 col-md-9 col-lg-9 list_name">
										<a href="<?php echo base_url().'plumber/profile/index'; ?>" class="cus_li_name"><p class="custom_li">My Profile</p></a>
									</div>
								</div>
							</li>
						<?php }?>
						
						<?php if($msg!='' && $approvalstatus=='1'){?>
							<div id="message">
								<?php echo $msg;?>
							</div>
						<?php }?>

					<?php }elseif($formstatus=='0'){ ?>
						<li>
							<div class="row side_list">
								<div class="col-sm-3 col-md-3 col-lg-3 list_icon">
									<a href="<?php echo base_url().'plumber/registration/index'; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
								</div>
								<div class="col-sm-9 col-md-9 col-lg-9 list_name">
									<a href="<?php echo base_url().'plumber/registration/index'; ?>" class="cus_li_name"><p class="custom_li">My Profile</p></a>
								</div>
							</div>
						</li>
					<?php } ?>
				<?php }elseif($type=='4'){

				 ?>
					<li><a href="<?php echo base_url().'company/dashboard/index'; ?>">Dashboard</a></li>
					<?php if($formstatus=='1'){ ?>
						<li><a href="<?php echo base_url().'company/profile/index'; ?>">My Profile</a></li>
						<li><a href="<?php echo base_url().'company/employee_listing'; ?>">Employee Listing</a></li>
					<?php }elseif($formstatus=='0'){ ?>
						<li><a href="<?php echo base_url().'company/registration/index'; ?>">My Profile</a></li>
					<?php } ?>
                    <?php 
                        
                       $this->db->select('*');
                       $this->db->from('messages');                  
                       $this->db->where("groups='4' AND status='1'");
                       $query=$this->db->get();
                       $data= $query->result_array();
                       $msg = "";
                       foreach ($data as $key => $value) {
                       		       				            
                       $currentDate = date('Y-m-d');
                       $startdate   = date('Y-m-d',strtotime($value['startdate']));
                       $enddate = date('Y-m-d',strtotime($value['enddate']));
                       if ($currentDate>= $startdate && $currentDate<=$enddate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
                    
						?>
						<?php if($msg!=''){?>

						<div id="message">
							<?php echo $msg;?>
						</div><?php }?>
						 
				<?php }elseif($type=='5'){ 
                      $this->db->select('*');
                       $this->db->from('messages');                  
                       $this->db->where("groups='2' AND status='1'");
                       $query=$this->db->get();
                       $data= $query->result_array();
                       $msg = "";
                       foreach ($data as $key => $value) {
                       		       				            
                       $currentDate = date('Y-m-d');
                       $startdate   = date('Y-m-d',strtotime($value['startdate']));
                       $enddate = date('Y-m-d',strtotime($value['enddate']));
                       if ($currentDate>= $startdate && $currentDate<=$enddate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
					?>
					<li><a href="<?php echo base_url().'auditor/dashboard/index'; ?>">Dashboard</a></li>					
					<li><a href="<?php echo base_url().'auditor/auditstatement/index'; ?>">Audit Statement</a></li>
					<li><a href="<?php echo base_url().'auditor/accounts/index'; ?>">Accounts</a></li>
					<li><a href="<?php echo base_url().'auditor/reportlisting/index'; ?>">My Report Listing</a></li>
					<li><a href="<?php echo base_url().'auditor/profile/index'; ?>">My Profile</a></li>
					<?php if($msg!='' && $approvalstatus=='1'){?>
						<div id="message">
							<?php echo $msg;?>
						</div><?php }?>

				<?php }elseif($type=='6'){
					
                      $this->db->select('*');
                       $this->db->from('messages');                  
                       $this->db->where("groups='3' AND status='1'");
                       $query=$this->db->get();
                       $data= $query->result_array();
                       $msg = "";
                       foreach ($data as $key => $value) {
                       		       				            
                       $currentDate = date('Y-m-d');
                       $startdate   = date('Y-m-d',strtotime($value['startdate']));
                       $enddate = date('Y-m-d',strtotime($value['enddate']));
                      if ($currentDate>= $startdate && $currentDate<=$enddate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
				 ?>
					<li><a href="<?php echo base_url().'resellers/dashboard/index'; ?>">Dashboard</a></li>
                    <li><a href="<?php echo base_url().'resellers/cocstatement/index'; ?>">COC Statement</a></li>
					<li><a href="<?php echo base_url().'resellers/allocatecoc/index'; ?>">Allocate COC</a></li>
					<li><a href="<?php echo base_url().'resellers/profile/index'; ?>">My Profile</a></li>
					 <?php if($msg!=''){?>

						<div id="message">
							<?php echo $msg;?>
						</div><?php }?>
					
				<?php } ?>	
							
			</ul>
		</nav>
	</div>
</aside>
