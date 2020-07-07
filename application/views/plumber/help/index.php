<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Help</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Help</li>
			</ol>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<div class="row">
					<div class="col-md-12 plumberhelpsection">
						<h5>Plumber Help Section</h5>
						<?php foreach($results as $result){ ?>
							<p><a href="javascript:void(0);" data-id="<?php echo $result['id']; ?>" class="helpsection"><?php echo $result['title']; ?></a></p>
						<?php } ?>
					</div>
					
					<?php foreach($results as $result){ ?>
						<div class="col-md-12" id="helpsection<?php echo $result['id']; ?>">
							<h5><?php echo $result['title']; ?></h5>
							<?php if($result['file']!=''){ ?>
								<video width="320" height="240" controls>
									<source src="<?php echo base_url().'assets/uploads/help/'.$result['file']; ?>" type="video/mp4">
								</video>
							<?php } ?>
							<div><?php echo $result['description']; ?></div>
						</div>
					<?php } ?>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
$('.helpsection').on('click', function(){  
	var id = $(this).attr('data-id');
	$('html, body').animate({
      scrollTop: $('#helpsection'+id).offset().top
    }, 500);
});
</script>
