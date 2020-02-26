<?php 
	$sitename	= $this->config->item('sitename');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url().'assets/images/logo.png'; ?>">
		<title><?php echo $sitename; ?></title>
		<link href="<?php echo base_url().'assets/css/style.min.css'; ?>" rel="stylesheet">
		<?php
			if(in_array('datatables', $plugins)){ 
				echo '<link href="'.base_url().'assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">';
			}
			if(in_array('datatablesresponsive', $plugins)){ 
				echo '<link href="'.base_url().'assets/plugins/datatables/css/responsive.dataTables.min.css" rel="stylesheet">';
			}
			if(in_array('sweetalert', $plugins)){ 
				echo '<link href="'.base_url().'assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">';
			}
			if(in_array('select2', $plugins)){ 
				echo '<link href="'.base_url().'assets/plugins/select2/select2.min.css" rel="stylesheet">';
			}
			if(in_array('datepicker', $plugins)){ 
				echo '<link href="'.base_url().'assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">';
			}
		?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="<?php echo base_url().'assets/css/custom.css'; ?>" rel="stylesheet">
		<script src="<?php echo base_url().'assets/plugins/jquery/jquery-3.2.1.min.js'; ?>"></script>
	</head>

	<body class="skin-blue fixed-layout">
		<div class="preloader">
			<div class="loader">
				<div class="loader__figure"></div>
				<p class="loader__label">PIRB</p>
			</div>
		</div>
		<div id="main-wrapper">
			<header class="topbar">
				<nav class="navbar top-navbar navbar-expand-md navbar-dark">
					<div class="navbar-header">
						<a class="navbar-brand" href="<?php echo base_url(); ?>">
							<b>
								<img src="<?php echo base_url().'assets/images/logo.png'; ?>" alt="Auditit"/>
							</b>
							<span class="hidden-xs"><span class="font-bold">Auditit</span></span>
						</a>
					</div>
					<div class="navbar-collapse">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
							<li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
						</ul>
						<ul class="navbar-nav my-lg-0">
							<li class="nav-item dropdown u-pro">
								<a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url().'assets/images/profile.jpg'; ?>" alt="profile" class=""> <span class="hidden-md-down">&nbsp;<i class="fa fa-angle-down"></i></span> </a>
								<div class="dropdown-menu dropdown-menu-right animated flipInY">
									<a href="<?php echo base_url('authentication/logout'); ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<?php echo (isset($sidebar) ? $sidebar : ''); ?>
			<div class="page-wrapper">
				<div class="container-fluid">
					<?php echo (isset($content) ? $content : ''); ?>
				</div>
			</div>
			<footer class="footer">
				<?php echo $sitename; ?>
			</footer>
		</div>
		
		<script src="<?php echo base_url().'assets/plugins/popper/popper.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/perfect-scrollbar.jquery.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/waves.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/sidebarmenu.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/sticky-kit-master/dist/sticky-kit.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/sparkline/jquery.sparkline.min.js'; ?>"></script>
		
		<?php
			if(in_array('datatables', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/datatables/js/jquery.dataTables.min.js"></script>';
			}
			if(in_array('datatablesresponsive', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/datatables/js/dataTables.responsive.min.js"></script>';
			}
			if(in_array('sweetalert', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/sweetalert2/sweetalert2.min.js"></script>';
			}
			if(in_array('select2', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/select2/select2.min.js"></script>';
			}
			if(in_array('validation', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/jquery-validation/jquery.validate.min.js"></script>';
			}
			if(in_array('datepicker', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>';
			}
			if(in_array('inputmask', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/inputmask/jquery.inputmask.bundle.min.js"></script>';
			}
			if(in_array('tinymce', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/tinymce/js/tinymce.min.js"></script>';
			}
		?>
		
		<script src="<?php echo base_url().'assets/js/custom.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/custom.js?vers=1.0'; ?>"></script>
	</body>
</html>