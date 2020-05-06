<?php
if(isset($result) && $result){
    $id 			= $result[0]['id'];
	$award_point    = (set_value('award_point')) ? set_value('award_point') : $result[0]['value'];
    $top 			= (set_value('top')) ? set_value('top') : $result[1]['value'];
    $award 			= (set_value('award')) ? set_value('award') : $result[2]['value'];
	$bonus_points   = (set_value('bonus_points')) ? set_value('bonus_points') :  $result[3]['value'];
	$award1 		= (set_value('award1')) ? set_value('award1') : $result[4]['value'];
	$top1 			= (set_value('top1')) ? set_value('top1') : $result[5]['value'];
	$award2 		= (set_value('award2')) ? set_value('award2') :  $result[6]['value'];
	$month_award 	= (set_value('month_award')) ? set_value('month_award') : $result[7]['value'];
	$it_1 			= (set_value('it_1')) ? set_value('it_1') :  $result[8]['value'];
	$cpd_aquired 	= (set_value('cpd_aquired')) ? set_value('cpd_aquired') :  $result[9]['value'];;
	$it_2 			= (set_value('it_2')) ? set_value('it_2') :  $result[10]['value'];;
	$cpd_aquired1 	= (set_value('cpd_aquired1')) ? set_value('cpd_aquired1') :  $result[11]['value'];;
	$bonus 			= (set_value('bonus')) ? set_value('bonus') :  $result[12]['value'];;
	$employeed 		= (set_value('employeed')) ? set_value('employeed') :  $result[13]['value'];;
	$every_day_award= (set_value('every_day_award')) ? set_value('every_day_award') :  $result[14]['value'];;

	$heading		= 'Save/Update';
}
else{
	$id 			= '';
	$name			= set_value('award_point');
	$top 			= (set_value('top')) ;
	$award 			= (set_value('award')) ;
	$bonus_points 	= (set_value('bonus_points'));
	$award1 	= (set_value('award1')) ;
	$top1 	= (set_value('top1')) ;
	$award2 	= (set_value('award2')) ;
	$month_award 	= (set_value('month_award')) ;
	$it_1 	= (set_value('it_1'));
	$cpd_aquired 	= (set_value('cpd_aquired'));
	$it_2 	= (set_value('it_2'));
	$cpd_aquired1 	= (set_value('cpd_aquired1'));
	$bonus 	= (set_value('bonus'));
	$employeed 	= (set_value('employeed'));
	$every_day_award 	= (set_value('every_day_award'));
	$heading		= 'Save';
}

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Global Settings</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Global Settings</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<form class="form" method="post">
					<h4 class="card-title">Global Settings</h4>
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-group">
								<label>Award points only if</label>
									<input type="number" min="0" id="points" name="award_point" size="2" value="<?php echo $result[0]['value'];?>"   style="margin: 0px 20px;width: 8%;">
									<label> nomination likes are received per post</label>						
							</div>
							<div class="form-group">
								<label>Top</label>
									<input type="number" min="0" id="points" name="top" size="2"  value="<?php echo $result[1]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label> nomination likes for the day,&nbsp award</label>
									<input type="number" min="0" id="points" name="award" size="2"  value="<?php echo $result[2]['value'];?>" style="margin: 0px 20px;width: 8%;">
								<label>bonus points</label>						
							</div>
							<div class="form-group">
									<input type="number" min="0" id="points" name="bonus_points" size="2"  value="<?php echo $result[3]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label> performance points,&nbsp award</label>
									<input type="number" min="0" id="points" name="award1" size="2"  value="<?php echo $result[4]['value'];?>" style="margin: 0px 20px;width: 8%;">
								<label>bonus points</label>						
							</div>
							<div class="form-group">
								<label>Top</label>
									<input type="number" min="0" id="points" name="top1" size="2"  value="<?php echo $result[5]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label> plumbers overall,&nbsp for past 30days,&nbsp award</label>
									<input type="number" min="0" id="points" name="award2" size="2"  value="<?php echo $result[6]['value'];?>" style="margin: 0px 20px;width: 8%;">
								<label>bonus points</label>						
							</div>
							<div class="form-group">
								<label>Most COC issued per month award</label>
									<input type="number" min="0" id="points" name="month_award" size="2"  value="<?php echo $result[7]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label>points</label>						
							</div>
                            <div class="form-group">
								<label>If</label>
									<input type="number" min="0" id="points" name="it_1" size="2"  value="<?php echo $result[8]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label> CPD aquired per month award</label>
									<input type="number" min="0" id="points" name="cpd_aquired" size="2"  value="<?php echo $result[9]['value'];?>" style="margin: 0px 20px;width: 8%;">
								<label>points</label>						
							</div>
							 <div class="form-group">
								<label>If</label>
									<input type="number" min="0" id="points" name="it_2" size="2"  value="<?php echo $result[10]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label> SARS Certificate</label>
									<input type="number" min="0" id="points" name="cpd_aquired1" size="2"  value="<?php echo $result[11]['value'];?>" style="margin: 0px 20px;width: 8%;">
								<label>points</label>						
							</div>
							<div class="form-group">
								<label>Bonus points per the </label>
									<input type="number" min="0" id="points" name="bonus" size="2"  value="<?php echo $result[12]['value'];?>" style="margin: 0px 20px;width: 8%;">
									<label>  of licenced/master plumbers employed</label>
									<input type="number" min="0" id="points" name="employeed" size="2"  value="<?php echo $result[13]['value'];?>" style="margin: 0px 20px;width: 8%;">
								<label>points</label>
							</div>
							<div class="form-group">
								<label> Openinig your account every day,&nbsp award</label>	

								<input type="number"  min="0" id="points" name="every_day_award" size="2" value="<?php echo $result[14]['value'];?>" style="margin: 0px 20px;width: 8%;">		
								<label>points</label>			
							</div>


						</div>
					<div class="col-md-11 text-right">
				       <input type="hidden" name="id" value="<?php echo $id; ?>">
					   <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?>
					   </button>
				    </div>
						
					</div>
				</form>			
			</div>
		</div>
	</div>
</div>





