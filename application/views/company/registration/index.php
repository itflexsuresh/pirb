<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Plumber register</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Plumber register</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col-md-12 breadcrumb_tab">
					<a href="javascript:void(0);" class="stepbar" data-id="1">Welcome</a>
					<a href="javascript:void(0);" class="stepbar" data-id="2">Declaration</a>
				</div>
				
				<div class="col-md-12 pagination">
					<a href="javascript:void(0);" id="previous">Previous</a>
					<div class="progress-circle p10" data-id="1">
					   <span>10%</span>
					   <div class="left-half-clipper">
						  <div class="first50-bar"></div>
						  <div class="value-bar"></div>
					   </div>
					</div>

					<div class="progress-circle over50 p100" data-id="2">
					   <span>100%</span>
					   <div class="left-half-clipper">
						  <div class="first50-bar"></div>
						  <div class="value-bar"></div>
					   </div>
					</div>
					<a href="javascript:void(0);" id="next">Next</a>
				</div>
				
				<div class="steps active" data-id="1">
					<h4 class="card-title">Registered Plumber Details</h4>
					<p>
						Donec augue enim, volutpat at ligula et, dictum laoreet sapien. Sed maximus feugiat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla eu mollis leo, eu elementum nisl. Curabitur cursus turpis nibh, egestas efficitur diam tristique non. Proin faucibus erat ligula, nec interdum odio rhoncus vel. Nulla facilisi. Nulla vehicula felis lorem, sed molestie lacus maximus quis. Mauris dolor enim, fringilla ut porta sed, ullamcorper id quam. Integer in eleifend justo, quis cursus odio. Pellentesque fermentum sapien elit, aliquam rhoncus neque semper in. Duis id consequat nisl, vitae semper elit. Nulla tristique lorem sem, et pretium magna cursus sit amet. Maecenas malesuada fermentum mauris, at vestibulum arcu vulputate a.
					</p>
				</div>
				<div class="steps displaynone" data-id="2">
					<?php echo $commoncompany; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="otpmodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<p>Please confirm that you wish to sumbit your PIRB Registation Application.</p>
					<p>A One Time Pin (OTP) was sent to the following Mobile Number: {***-*** *123}</p>
					<div>
						<p>Enter OTP</p>
						<p class="enterotp"></p>
						<input type="text" name="otp" id="otp">
					</div>
				</div>
				<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success resendotp">Resend</button>
				<button type="button" class="btn btn-success verifyotp">Verify</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">


$(function(){
	checkstep();
})

$('#submit').click(function(e){	
	if($('.form').valid()==false){			
		$('#otpmodal').modal('show');
		return true;
	}
})

$('.progress-circle[data-id="1"]').addClass('active');
$('a.stepbar[data-id="1"]').addClass('active');

$('.stepbar').click(function(){
	var step = $(this).attr('data-id');
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	$('.stepbar.active').addClass('un_active').removeClass('active');
	$('.stepbar[data-id="'+step+'"]').removeClass('un_active').addClass('active');

	$('.progress-circle.active').addClass('prog_hide').removeClass('active');
	$('.progress-circle[data-id="'+step+'"]').removeClass('prog_hide').addClass('active');
	checkstep();
})

$('#next').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))+1;
	
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	$('.stepbar.active').addClass('un_active').removeClass('active');	
	$('.stepbar[data-id="'+step+'"]').removeClass('un_active').addClass('active');	

	$('.progress-circle.active').addClass('prog_hide').removeClass('active');	
	$('.progress-circle[data-id="'+step+'"]').removeClass('prog_hide').addClass('active');
	checkstep();
})

$('#previous').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))-1;
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	$('.stepbar.active').addClass('un_active').removeClass('active');	
	$('.stepbar[data-id="'+step+'"]').removeClass('un_active').addClass('active');	
	
	$('.progress-circle.active').addClass('prog_hide').removeClass('active');	
	$('.progress-circle[data-id="'+step+'"]').removeClass('prog_hide').addClass('active');
	checkstep();
})

function checkstep(){
	$('#next, #previous').removeClass('not_working');
	
	var step = $('.steps.active').attr('data-id');
		
	if(step=='1'){
		$('#previous').addClass('not_working');
	}else if(step=='2'){
		$('#next').addClass('not_working');
	}
}
</script>

