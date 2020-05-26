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
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="<?php echo base_url().'assets/css/custom.css?version=5.0'; ?>" rel="stylesheet">
		<script src="<?php echo base_url().'assets/plugins/jquery/jquery-3.2.1.min.js'; ?>"></script>
	</head>

	<body class="skin-default card-no-border">
		<div class="preloader">
			<div class="loader">
				<div class="loader__figure"></div>
				<p class="loader__label">PIRB</p>
			</div>
		</div>
		<section id="wrapper">	
			<div class="col-sm-12 authenticationlogo">
				<img src="<?php echo base_url().'assets/images/authenticationlogo.png'; ?>" width="100">
			</div>
			<?php echo (isset($content) ? $content : ''); ?>				
		</section>
		
		<script src="<?php echo base_url().'assets/plugins/popper/popper.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
		<?php
			if(in_array('validation', $plugins)){ 
				echo '<script src="'.base_url().'assets/plugins/jquery-validation/jquery.validate.min.js"></script>';
			}
		?>
		<script src="<?php echo base_url().'assets/js/custom.js?version=5.0'; ?>"></script>
		<script type="text/javascript">
			$(function() {
				$(".preloader").fadeOut();
			});
		</script>
	</body>
</html>