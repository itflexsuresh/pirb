<?php 
	$pdfimg 				= base_url().'assets/images/pdf.png';
	$profileimg 			= base_url().'assets/images/profile.jpg';
	
	$friendids				= array_column($friends, 'userid');
	$fromrequestlistids		= array_column($fromrequestlistids, 'fromrequestlist');
	$torequestlistids		= array_column($torequestlistids, 'torequestlist');
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
			
				<form action="" method="get">
					<div class="row">
						<div class="col-md-1">
							<div class="form-group">
								<label>Search</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="search" value="<?php echo isset($search) ? $search : ''; ?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="submit" class="btn btn-primary" value="Search">
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
							if(count($friendslist) > 0){
							foreach($friendslist as $list){ 
								$userid					= $list['userid'];
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
											<input type="hidden" name="search" value="<?php echo isset($search) ? $search : ''; ?>">
											<input type="hidden" name="toid" value="<?php echo $userid; ?>">
											<input type="hidden" name="id" value="">
											<?php if(in_array($userid, $friendids)){ ?>
												<input type="button" value="Friend" class="btn btn-primary">
											<?php }elseif(in_array($userid, $fromrequestlistids)){ ?>
												<input type="button" value="Request sent" class="btn btn-primary">
											<?php }elseif(in_array($userid, $torequestlistids)){ ?>
												<input type="button" value="Awaiting Response" class="btn btn-primary">
											<?php }else{ ?>
												<input type="submit" value="Add Friend" name="submit" class="btn btn-primary">
											<?php } ?>
										</div>
									</div>
								</form>	
							</div>
						<?php }}else{ ?>
							<div class="col-md-12">
								<p class="tagline">There is not matching plumber name</p>
							</div>
						<?php } ?>
					</div>
					
				</div>
			</div>
		<?php
			}
		?>
		
		<?php 
			if(count($friends) > 0 || count($fromrequestlist) > 0 || count($torequestlist) > 0){
				for($i=0; $i<3; $i++){
					if($i==0 && count($friends) > 0){
						$heading 	= 'Friends List';
						$loop 		= $friends;
					}elseif($i==1 && count($fromrequestlist) > 0){
						$heading 	= 'Request List';
						$loop 		= $fromrequestlist;
					}elseif($i==2 && count($torequestlist) > 0){
						$heading 	= 'Friends Request List';
						$loop 		= $torequestlist;
					}else{
						continue;
					}
		?>
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php echo $heading; ?></h4>
							<div class="row">
								<?php 
									foreach($loop as $list){ 
										$id						= $list['id'];
										$userid					= $list['userid'];
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
													<input type="hidden" name="search" value="<?php echo isset($search) ? $search : ''; ?>">
													<input type="hidden" name="id" value="<?php echo $id; ?>">
													<?php if($i==2){ ?>
														<input type="submit" value="Accept" name="submit" class="btn btn-primary">
													<?php } ?>
													<input type="submit" value="Remove" name="submit" class="btn btn-primary">
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
			}
		?>
	</div>
</div>
