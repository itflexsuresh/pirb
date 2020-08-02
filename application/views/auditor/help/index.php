<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Help</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'auditor/dashboard'; ?>">Home</a></li>
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
						<h5>Auditor Help Section</h5>
						<?php foreach($results as $result){ ?>
							<p><a href="javascript:void(0);" data-id="<?php echo $result['id']; ?>" class="helpsection"><?php echo $result['title']; ?></a></p>
						<?php } ?>
					</div>
					
					<?php foreach($results as $result){ ?>
						<div class="col-md-12" id="helpsection<?php echo $result['id']; ?>">
							<h5><?php echo $result['title']; ?></h5>
							<?php if($result['file']!=''){ ?>
								<div class="text-center">
									<video width="800" controls>
										<source src="<?php echo base_url().'assets/uploads/help/'.$result['file']; ?>" type="video/mp4">
									</video>
								</div>
							<?php } ?>
							<div><?php echo $result['description']; ?></div>
							<?php
							$images 		= isset($result['image']) ? $result['image'] : '';	
							if($images!=''){
								$images = explode(',', $images);
								foreach($images as $image){
									$filepath				= base_url().'assets/uploads/help/';
									$pdfimg 				= base_url().'assets/images/pdf.png';
								
									$explodefile2 	= explode('.', $image);
									$extfile2 		= array_pop($explodefile2);
									$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$image;
									$photoidurl		= $filepath.$image;
							?>
									<div class="text-center mb-5">
										<a href="<?php echo $photoidurl; ?>" target="_blank"><img src="<?php echo $photoidimg; ?>" class="help_photo img-responsive"></a>
									</div>
							<?php
								}
							}
							?>

						</div>
					<?php } ?>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
$('.helpsection').on('click', function(){  
	var el = $('#helpsection'+$(this).attr('data-id'));
	var elOffset = el.offset().top;
	var elHeight = el.height();
	var windowHeight = $(window).height();
	var offset;

	if (elHeight < windowHeight) {
		offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
	}else {
		offset = elOffset - 300;
	}
	
	$('html, body').animate({scrollTop:offset}, 700);
});
</script>
