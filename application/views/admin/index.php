<?php

$base_path = '../';
if(!isset($page_title)){
    $page_title = 'Auditit';
}
 include 'layout/css.php'; ?>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper"> 
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon-grid"></i></a>
                <div class="top-left-part"><a class="logo" href="<?php echo base_url('dashboard') ?>"><b><img src="<?php echo base_url();?>assets/images/small.png" alt="Auditit" /></b><span class="hidden-xs">Auditit</span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-grid"></i></a></li>
                   
                </ul>
				
				<ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- /.dropdown -->
					
					
				

 
										
						
						
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
					
					
					
					
					
					
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>optimum/images/admin.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php // echo $this->session->userdata('name'); ?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i>  My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i>  Account Setting</a></li>
                            <li><a href="<?php echo base_url('login/logout') ?>"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    	<!--<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>-->
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search<?php echo base_url();?>optimum."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="<?php echo base_url();?>optimum/images/admin.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?php // echo $this->session->userdata('name'); ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <!-- <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li> -->
                            <li><a href="<?php echo base_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url('dashboard') ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
                    <li><a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Administration<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php  echo base_url('installation_type/view') ?>">Installation Types</a></li>
                            <li><a href="<?=  base_url('sub_types/view') ?>">Sub type</a></li>
                            <li><a href="<?=  base_url('manage_area/view') ?>">Manage Area</a></li>   
                        </ul>
                    </li>
                    
                    <li> <a href="#" class="waves-effect"><i data-icon="O" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">System Setup<span class="fa arrow"></span><span class="label label-rouded label-info pull-right"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= base_url('system_users/view') ?>">System users</a></li>
                        	<li><a href="<?=  base_url('settings/view') ?>">Settings</a></li>                        	
                            <li><a href="<?=  base_url('rates/view') ?>">Rates</a></li>                    
                            <li><a href="<?php  echo base_url('message/view') ?>">Messages</a></li>
                            <li><a href="<?php  echo base_url('assesment_type/view') ?>">Assessment Types</a></li>                        	
                            <li><a href="<?php  echo base_url('plumber_performance_type/view') ?>">Plumber performance types</a></li>
                            <li><a href="<?php  echo base_url('location_types/view') ?>">Location types</a></li>
                            <li><a href="<?php  echo base_url('cpd_points/view') ?>">CPD TYPES</a></li>
                            <li><a href="<?php  echo base_url('cda_types/view') ?>">CDA TYPES</a></li>
                            <li><a href="<?php  echo base_url('qualification_route/view') ?>">Qualification Routes</a></li>
                        </ul>
                    </li>

                    <!-- <li><a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Registra<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php // echo base_url('get_company/view') ?>">Company Registra</a></li>
                        </ul>
                    </li> -->

                    <li><a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Plumber Register<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php  echo base_url('register_plumber_list/view') ?>">List</a></li>
                        </ul>
                    </li>

					
					<!-- <li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php //   echo base_url('admin/ui/card') ?>">Cards</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/panel_well') ?>">Panels and Wells</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/panel_block') ?>">Panels With BlockUI</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/drag_panel') ?>">Draggable Panel</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/dragPortlet') ?>">Draggable Portlet</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/buttons') ?>">Buttons</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/bootsrap_switch') ?>">Bootstrap Switch</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/date_pagination') ?>">Date Paginator</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/sweet_alert') ?>">Sweat alert</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/typography') ?>">Typography</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/grid') ?>">Grid</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/tabs') ?>">Tabs</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/stylish') ?>">Stylish Tabs</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/modals') ?>">Modals</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/progressbar') ?>">Progress Bars</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/notification') ?>">Notifications</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/carousel') ?>">Carousel</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/list_media') ?>">List & Media object</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/user_card') ?>">User Cards</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/timeline') ?>">Timeline</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/horizontal_timeline') ?>">Horizontal Timeline</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/nestable') ?>">Nesteble</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/range_slider') ?>">Range Slider</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/ribbon') ?>">Ribbons</a></li>
                            <li><a href="<?php //   echo base_url('admin/ui/steps') ?>">Steps</a></li>
                        </ul>
                    </li>
                   
					
					 <li> <a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Forms<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php //   echo base_url('admin/form/form_basic') ?>">Basic Forms</a></li>
                            <li><a href="<?php //   echo base_url('admin/form/form_layout') ?>">Form Layout</a></li>
                            <li><a href="<?php //   echo base_url('admin/form/file_upload') ?>">File Upload</a></li>
                            <li><a href="<?php //   echo base_url('admin/form/form_validation') ?>">Form Validation</a></li>
                        </ul>
                    </li>
                    
                    <li> <a href="#" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-purple pull-right">29</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php //   echo base_url('admin/page/starter') ?>">Starter Page</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/blank') ?>">Blank Page</a></li>
                            <li><a href="javascript:void(0)" class="waves-effect">Email Templates
            <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="<?php //   echo base_url('admin/page/email_basic') ?>">Basic</a></li>
                                    <li><a href="<?php //   echo base_url('admin/page/email_alert') ?>">Alert</a></li>
                                    <li><a href="<?php //   echo base_url('admin/page/email_billing') ?>">Billing</a></li>
                                    <li><a href="<?php //   echo base_url('admin/page/reset_password') ?>">Reset Password</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php //   echo base_url('admin/page/lightBox') ?>">Lightbox Popup</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/treeview') ?>">Treeview</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/search_result') ?>">Search Result</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/utility_class') ?>">Utility Classes</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/custom_scroll') ?>">Custom Scrolls</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/login_page') ?>">Login Page</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/second_login') ?>">Login v2</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/animation') ?>">Animations</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/profile') ?>">Profile</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/invoice') ?>">Invoice</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/faq') ?>">FAQ</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/gallery') ?>">Gallery</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/pricing') ?>">Pricing</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/register') ?>">Register</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/second_register') ?>">Register v2</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/step_registration') ?>">3 Step Registration</a></li>
                            <li><a href="<?php //   echo base_url('admin/page/recover_password') ?>">Recover Password</a></li>
                        </ul>
                    </li> -->
                   
                    <!-- <li> <a href="tables.html" class="waves-effect"><i data-icon="O" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Tables<span class="fa arrow"></span><span class="label label-rouded label-info pull-right">7</span></span></a>
                        <ul class="nav nav-second-level"> -->
                            <!-- <li><a href="<?php // echo base_url('admin/table/basic_table') ?>">Basic Tables</a></li>
                            <li><a href="<?php // echo base_url('admin/table/table_layout') ?>">Table Layouts</a></li> -->
                            <!-- <li><a href="<?php  // echo base_url('admin/table/data_table') ?>">Data Table</a></li> -->
                            <!-- <li><a href="<?php // echo base_url('admin/table/bootsrap_table') ?>">Bootstrap Tables</a></li>
                            <li><a href="<?php // echo base_url('admin/table/responsive_table') ?>">Responsive Tables</a></li>
                            <li><a href="<?php // echo base_url('admin/table/editable_table') ?>">Editable Tables</a></li>
                            <li><a href="<?php // echo base_url('admin/table/footable') ?>">FooTables</a></li> -->
                        <!-- </ul>
                    </li> -->
                    
                    <!-- <li><a href="<?php //  echo base_url('logout') ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li> -->
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
       
	   
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
			<div class="row bg-title">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title; ?></h4>
                    </div>
                    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard/">Home</a></li>
                            <li class="active"> <?php echo $page_title; ?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 	
				
				
				
				
				
               <?php echo $main_content; ?>
                
			
            </div>
            <!-- /.container-fluid -->
           <?php include 'layout/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   <?php include 'layout/js.php'; ?>
