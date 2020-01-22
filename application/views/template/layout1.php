<?php 
	$sitename	= $this->config->item('sitename');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $sitename; ?></title>
		<link href="<?php echo base_url().'assets/plugins/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">
		<link href="<?php echo base_url().'assets/plugins/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url().'assets/css/sb-admin.css'; ?>" rel="stylesheet">
		<link href="<?php echo base_url().'assets/css/custom.css'; ?>" rel="stylesheet">
	</head>

	<body class="bg-dark">
		<div class="container">
			<?php if($this->session->has_userdata('success')){ ?>
				<div class="alert alert-success alert-dismissible alert1">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo $this->session->userdata('success'); ?>
				</div>
			<?php }elseif($this->session->has_userdata('error')){ ?>
				<div class="alert alert-danger alert-dismissible alert1">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo $this->session->userdata('error'); ?>
				</div>
			<?php } ?>
			<?php echo (isset($content) ? $content : ''); ?>
		</div>
		<script src="<?php echo base_url().'assets/plugins/jquery/jquery.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/plugins/jquery-easing/jquery.easing.min.js'; ?>"></script>
		<script src="<?php echo base_url().'assets/js/custom.js'; ?>"></script>
	</body>
</html>
