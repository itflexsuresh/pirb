<?php if($this->session->has_userdata('success')){ ?>
	<div class="alert alert-success alert-rounded"> 
		<?php echo $this->session->userdata('success'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	</div>
<?php }elseif($this->session->has_userdata('error')){ ?>
	<div class="alert alert-danger  alert-rounded"> 
		<?php echo $this->session->userdata('error'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	</div>
<?php } ?>