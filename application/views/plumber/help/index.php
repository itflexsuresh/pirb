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
					<?php foreach($result as $data){ ?>
						<div class="col-md-12">
							<h5><?php echo $data['title']; ?></h5>
							<video width="320" height="240" controls>
								<source src="<?php echo base_url().'assets/uploads/help/'.$data['file']; ?>" type="video/mp4">
							</video>
							<div><?php echo $data['description']; ?></div>
						</div>
					<?php } ?>
				</div>
				
			</div>
		</div>
	</div>
</div>
