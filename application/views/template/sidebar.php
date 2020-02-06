<?php 
print_r($userdata1);die;
//$designation = $userdata1;
$type 		= $userdata['type']; 
$formstatus = $userdata['formstatus']; 
?>

<aside class="left-sidebar">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<?php if($type=='1'){ ?>
					<li class="setp one"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Administration</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/administration/installationtype'; ?>">Installation Type</a></li>
							<li><a href="<?php echo base_url().'admin/administration/subtype'; ?>">Sub Type</a></li>
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

					<li> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Coc Management</span></a>
						<ul aria-expanded="false" class="collapse">							
							<li> 
								<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Coc Management (Statement)</span></a>
								<ul aria-expanded="false" class="collapse">
									<li><a href="<?php echo base_url().''; ?>">Coc Management (Statement)</a></li>
									<li><a href="<?php echo base_url().'admin/cocmanagement/cocmanagementstatement/coc_orders/index'; ?>">Coc Orders</a></li>
								</ul>
							</li>
						</ul>						
					</li>

					<li class="step three"> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">CPD</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/cpd/cpdtypesetup'; ?>">CPD Types</a></li>							
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
				<?php }elseif($type=='3'){ ?>
					<li><a href="<?php echo base_url().'plumber/registration/index'; ?>">Dashboard</a></li>
					<?php if($formstatus=='1'){ ?>
						<li><a href="<?php echo base_url().'plumber/profile/index'; ?>">My Profile</a></li>
						<?php //if ($designation == '4' || $designation == '6') {
							?>
							<li><a href="<?php echo base_url().'plumber/purchasecoc/index'; ?>">Purchase COC</a></li>
							<?php
						//} ?>
					<?php }elseif($formstatus=='0'){ ?>
						<li><a href="<?php echo base_url().'plumber/registration/index'; ?>">My Profile</a></li>
					<?php } ?>
				<?php }elseif($type=='4'){ ?>
					<li><a href="javascript:void(0);">Dashboard</a></li>
					<li><a href="<?php echo base_url().'company/registration/company'; ?>">My Profile</a></li>
				<?php }elseif($type=='5'){ ?>
					<li><a href="javascript:void(0);">Dashboard</a></li>
					<li><a href="<?php echo base_url().'auditor/profile/index'; ?>">My Profile</a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</aside>
