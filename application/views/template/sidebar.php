<?php 
$designation 	= $userdata['designation'];
$approvalstatus = $userdata['approvalstatus'];
$type 		 	= $userdata['type']; 
$formstatus  	= $userdata['formstatus']; 

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
				<?php }elseif($type=='3'){ ?>
					<li><a href="<?php echo base_url().'plumber/dashboard/index'; ?>">Dashboard</a></li>
					
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
                       if ($currentDate>= $startdate && $startdate<=$currentDate && $enddate>=$currentDate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
                    ?>
                      
						
						<?php if (($designation == '4' || $designation == '6') && $approvalstatus=='1') {
							?>
							<li><a href="<?php echo base_url().'plumber/purchasecoc/index'; ?>">Purchase COC</a></li>
							<li><a href="<?php echo base_url().'plumber/cocstatement/index'; ?>">COC Statement</a></li>
							<li><a href="<?php echo base_url().'plumber/auditstatement/index'; ?>">Audit Statement</a></li>
							<?php
						} ?>
						
						
						<?php if ($approvalstatus=='1') {
							?>
							<li><a href="<?php echo base_url().'plumber/myaccounts/index'; ?>">My Accounts</a></li>
							<li><a href="<?php echo base_url().'plumber/mycpd/index'; ?>">My CPD</a></li>
							<li><a href="<?php echo base_url().'plumber/performancestatus/index'; ?>">Performance Status</a></li>
							<?php
						} ?>
						
						<li><a href="<?php echo base_url().'plumber/profile/index'; ?>">My Profile</a></li>
						<?php if($msg!=''){?>
						<div id="message">
							<?php echo $msg;?>
						</div><?php }?>

					<?php }elseif($formstatus=='0'){ ?>
						<li><a href="<?php echo base_url().'plumber/registration/index'; ?>">My Profile</a></li>
						
					<?php } ?>
				<?php }elseif($type=='4'){

				 ?>
					<li><a href="javascript:void(0);">Dashboard</a></li>
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
                       if ($currentDate>= $startdate && $startdate<=$currentDate && $enddate>=$currentDate){
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
                       if ($currentDate>= $startdate && $startdate<=$currentDate && $enddate>=$currentDate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
					?>
					<li><a href="<?php echo base_url().'auditor/dashboard/index'; ?>">Dashboard</a></li>					
					<li><a href="<?php echo base_url().'auditor/auditstatement/index'; ?>">Audit Statement</a></li>
					<li><a href="<?php echo base_url().'auditor/accounts/index'; ?>">Accounts</a></li>
					<li><a href="<?php echo base_url().'auditor/reportlisting/index'; ?>">My Report Listing</a></li>
					<li><a href="<?php echo base_url().'auditor/profile/index'; ?>">My Profile</a></li>
					<?php if($msg!=''){?>
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
                       if ($currentDate>= $startdate && $startdate<=$currentDate && $enddate>=$currentDate){
                       	$msg = $msg.$value['message'].'</br></br>'; 
							
                            }
                       }
				 ?>
					<li><a href="javascript:void(0);">Dashboard</a></li>
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
