<?php 
$type = $userdata['type']; 
$flag = $userdata['flag']; 
?>

<aside class="left-sidebar">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<?php if($type=='1'){ ?>
					<li> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Administration</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/administration/installationtype'; ?>">Installation Type</a></li>
							<li><a href="<?php echo base_url().'admin/administration/subtype'; ?>">Sub Type</a></li>
						</ul>
					</li>
					<li> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">System Setup</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/systemsetup/rates/rates'; ?>">Rates</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/systemsettings/systemsettings'; ?>">System Settings</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/qualificationroutes/qualificationroute'; ?>">Qualification Routes</a></li>
							<li><a href="<?php echo base_url().'admin/systemsetup/message/message'; ?>">Messages</a></li>
						</ul>
					</li>
					<li> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">CPD</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/cpd/cpdtypesetup'; ?>">CPD Types</a></li>							
						</ul>
					</li>
					<li> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Plumber</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/plumber/index'; ?>">Plumber</a></li>
						</ul>
					</li>
					<li> 
						<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Company</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?php echo base_url().'admin/company/index'; ?>">Company</a></li>
						</ul>
					</li>
				<?php }elseif($type=='3'){ ?>
					<li><a href="<?php echo base_url().'plumber/registration/index'; ?>">Dashboard</a></li>
					<?php if($flag=='1'){ ?>
						
					<?php }elseif($flag=='0'){ ?>
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