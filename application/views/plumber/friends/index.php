<?php 
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Friends</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'plumber/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Friends</li>
			</ol>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<form action="" method="post">
					<div class="row">
						<div class="col-md-1">
							<div class="form-group">
								<label>Search</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="search" value="<?php echo isset($post['search']) ? $post['search'] : ''; ?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="submit" value="Search">
							</div>
						</div>
					</div>
				</form>		
				
			</div>
		</div>
			
			
			<?php 
				if(isset($friendslist)){
			?>
				<div class="card">
					<div class="card-body">
						
						<div class="row">
							<?php 
								foreach($friendslist as $list){ 
									$userid					= $list['id'];
									$filepath				= base_url().'assets/uploads/plumber/'.$userid.'/';
									$file2 					= isset($list['file2']) ? $list['file2'] : '';
									if($file2!=''){
										$explodefile2 	= explode('.', $file2);
										$extfile2 		= array_pop($explodefile2);
										$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
										$photoidurl		= $filepath.$file2;
									}else{
										$photoidimg 	= $profileimg;
										$photoidurl		= 'javascript:void(0);';
									}
							?>
								<div class="col-md-4">
									<form action="" method="post">
										<div class="row">
											<div class="col-md-4">
												<img src="<?php echo $photoidimg; ?>" class="photo_image" width="100">
											</div>
											<div class="col-md-8">
												<p><?php echo $list['name']; ?></p>
												<input type="hidden" name="search" value="<?php echo isset($post['search']) ? $post['search'] : ''; ?>">
												<input type="hidden" name="toid" value="<?php echo $userid; ?>">
												<input type="submit" value="Add Friend" name="submit" class="btn btn-primary">
											</div>
										</div>
									</form>	
								</div>
							<?php } ?>
						</div>
						
					</div>
				</div>
			<?php
				}
			?>
	</div>
</div>
