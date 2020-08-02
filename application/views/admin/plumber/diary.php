<?php
	$name 		= isset($result['name']) ?  $result['name'] : '';
	$surname 	= isset($result['surname']) ?  $result['surname'] : '';
	$commentsz 	= isset($comments) ?  $comments : '';
	$diarylist 	= isset($diarylist) ?  $diarylist : '';

	if($roletype=='1'){
		$heading = 'Diary/Comments for '.$name.' '.$surname.'';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor"><?php echo $heading; ?></h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/plumber/index'; ?>">Plumber Register</a></li>
				<li class="breadcrumb-item active"><?php echo $heading; ?></li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<?php if($roletype=='1'){ echo isset($menu) ? $menu : ''; } ?>


<div class="row">
	<div class="col-12">
		<div class="card">			
			<h4 class="card-title">Diary/Comments for <?php echo $name.' '.$surname; ?></h4>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group ">						
						<div class="comment_section">
							<?php echo $diarylist; ?>
						</div>
					</div>
				</div>

				<div class="col-md-12 diarybar">
					<div class="form-group ">
						<label>Admin Comment</label>
						<div class="comment_section">
						<?php
							if ($commentsz!='') {
								
								foreach($comments as $comment){
									echo '<p>'.date('d-m-Y', strtotime($comment['created_at'])).' - '.$comment['createdby'].' : '.$comment['comments'].'</p>';
								}								
							}
						?>
						</div>
					</div>
				</div>

				<div class="col-md-12">	
					<div class="form-group ">
						<label>Comments</label>
						<form action="<?php echo base_url().'admin/plumber/index/diary'; ?>" method="post" class="form">
							<input type="text" class="form-control" placeholder="Type your Comment here" name="comments" id="comments">
							<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
							<button type="submit" name="submit" class="btn btn-primary">Add Comment</button>
						</form>
					</div>							
				</div>				
			</div>				
			
		</div>
	</div>
</div>		

<script>
$(function(){
	
	validation(
		'.form',
		{
			comments : {
				required	: true
			}
		},
		{
			comments 	: {
				required	: "Comments field is required."
			}
		}
	);
})
</script>