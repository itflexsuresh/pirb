<?php
	if($roletype=='1'){
		$heading = 'Manage Allocted Audits';
	}else if($roletype=='3' || $roletype=='5'){
		$heading = 'Audit Report';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor"><?php echo $heading; ?></h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url(); ?>">Home</a></li>
				<li class="breadcrumb-item active"><?php echo $heading; ?></li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<?php if($roletype=='1' || $roletype=='5'){ echo isset($menu) ? $menu : ''; } ?>
<div class="row">
	<div class="col-12">
		<div class="card">
		
		</div>
	</div>
</div>		
