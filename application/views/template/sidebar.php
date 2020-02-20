<?php 
$designation 	= $userdata['designation'];
$approvalstatus = $userdata['approvalstatus'];
$type 		 	= $userdata['type']; 
$formstatus  	= $userdata['formstatus']; 
?>
<aside class="left-sidebar">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<?php if($type=='1'){ ?>
					<li class="setp one"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Administration</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/administration/reportlisting/index'; ?>">Report Listings</a></li>
							<li><a href="<?php echo base_url().'admin/administration/installationtype'; ?>">Installation Type</a></li>
							<li><a href="<?php echo base_url().'admin/administration/subtype'; ?>">Sub Type</a></li>
							<li><a href="<?php echo base_url().'admin/administration/managearea/managearea'; ?>">Manage Area</a></li>
						</ul>
					</li>

					<li class="step three"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu"></span>Communication Management</a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/communication/notification/index'; ?>">Notification and SMS Templates</a></li>
						</ul>
					</li>
					
					<li class="step two"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">System Setup</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/systemsetup/systemusers/systemusers'; ?>">System Users</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/rates/rates'; ?>">Rates</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/systemsettings/systemsettings'; ?>">System Settings</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/qualificationroutes/qualificationroute'; ?>">Qualification Routes</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/message/message'; ?>">Messages</a></li>
                             
							<li> 
								
								<a href="javascript:void(0)" aria-expanded="false" class="sub_menu">Performance Settings</a>
								<ul aria-expanded="false" class="collapse">
									<li><a href="<?php echo base_url().'admin/systemsetup/performancesettings/plumberperformance'; ?>">Plumber Performance Settings</a></li>

								</ul>

							</li>
						</ul>						
					</li>

					<li class="step coc_manage"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu" style="white-space: nowrap;">Coc Management</span></a>
						<ul aria-expanded="false" class="collapse">							
							<li> 
								<a class="sub_menu" href="javascript:void(0)" aria-expanded="false"><span class="hide-menu">Coc Management (Statement)</span></a>
								<ul aria-expanded="false" class="collapse">
									<li><a href="<?php echo base_url().'admin/cocstatement/cocdetails/index'; ?>">Coc Details</a></li>
									<li><a href="<?php echo base_url().'admin/cocstatement/cocorders/index'; ?>">Coc Orders</a></li>
									<li><a href="<?php echo base_url().'admin/cocstatement/papermanagement/index'; ?>">Paper Management</a></li>
								</ul>
							</li>
						</ul>						
					</li>

					<li class="step three"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">CPD</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/cpd/cpdtypesetup'; ?>">CPD Types</a></li>		
							<li><a href="<?php echo base_url().'admin/cpd/cpdtypesetup/index_queue'; ?>">CPD Queue</a></li>
						</ul>
					</li>
					<li class="step four"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Plumber</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/plumber/index'; ?>">Plumber Registration</a></li>
							<li><a href="<?php echo base_url().'admin/plumber/index/rejected'; ?>">Rejected Applications</a></li>
						</ul>
					</li>
					

					<li class="step five"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Company</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/company/index'; ?>">Company</a></li>
						</ul>
					</li>
					
					
					<li class="step five"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Resellers</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/resellers/index'; ?>">Resellers</a></li>
						</ul>
					</li>
				       <li class="step three"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Accounts</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/accounts/renewal_plumber/index'; ?>">Renewal Plumber Registration Invoices</a></li>
							<li><a href="<?php echo base_url().'admin/accounts/Accounts'; ?>">Plumber COC Invocies</a></li>							
						</ul>
					</li>
				   <li class="step four"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Gamification</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/gamification/globalsettings'; ?>">Global Settings</a></li>
						</ul>
					</li>
					<li class="step five"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Audits</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/audits/index'; ?>">Manage Auditors</a></li>
							<li><a href="<?php echo base_url().'admin/audits/cocallocate/index'; ?>">Manage COC Allocation for Audit</a></li>
						</ul>
					</li>
				<?php }elseif($type=='3'){ 

					?>
					<li><a href="<?php echo base_url().'plumber/registration/index'; ?>">Dashboard</a></li>
					
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
							<li><a href="<?php echo base_url().'plumber/myaccounts/index'; ?>">My Accounts</a></li>
							<li><a href="<?php echo base_url().'plumber/mycpd/index'; ?>">My CPD</a></li>
							<li><a href="<?php echo base_url().'plumber/auditstatement/index'; ?>">Audit Statement</a></li>

							
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
					<li><a href="<?php echo base_url().'company/registration/company'; ?>">My Profile</a></li>
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
					<li><a href="javascript:void(0);">Dashboard</a></li>
					<li><a href="<?php echo base_url().'auditor/profile/index'; ?>">My Profile</a></li>
					<li><a href="<?php echo base_url().'auditor/auditstatement/index'; ?>">Audit Statement</a></li>
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
