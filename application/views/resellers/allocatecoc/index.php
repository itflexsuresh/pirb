<?php
$id = isset($result['id']) ? $result['id'] : '';
$search_reg_no = isset($result['registration_no']) ? $result['registration_no'] : '';
$name = isset($result['name']) ? $result['name'] : '';
$surname = isset($result['surname']) ? $result['surname'] : '';
$mobilephone = isset($result['mobile_phone']) ? $result['mobile_phone'] : '';
$designationtemp = isset($result['designation']) ? $result['designation'] : '';
$designation = "";
if(isset($designationtemp) && $designationtemp > 0) {
	$designation	=	$this->config->item('designation2')[$designationtemp];
}
$companyname = isset($result['companyname']) ? $result['companyname'] : 'Unemployed';
$company_details = isset($result['company_details']) ? $result['company_details'] : '';
$balace_coc = 0 ;

if(isset($id) && $id >0){
	$balace_coc = $array_orderqty['sumqty'];
}

$startrange= isset($result['startrange']) ? $result['startrange'] : '';
$endrange= isset($result['endrange']) ? $result['endrange'] : '';

if(isset($id) && $id >0)
{
	if($user_id_hide == '1')
		$searchbox = $name." ".$surname;
	else
		$searchbox = $search_reg_no;
}
?>



<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Allocate COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="breadcrumb-item active">Allocate COC</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">	
				<form form class="mt-4 form" action="" method="post">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Plumber / Reg Number</label>  
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="search" autocomplete="off" class="form-control"  name="search_reg_no" id="search_reg_no"  value="<?php if(isset($id) && $id >0){ echo $searchbox; }?>" placeholder="Type in Plumbers reg number; name or surname">
								<input type="hidden" id="user_id_hide" name="user_id_hide" value="0">
								<div id="plumber_suggesstion" style="display: none;"></div>
								<?php if(isset($emptyvalue) && $emptyvalue == 0){ echo '<span style="color:red">Record was not found</span>'; }?>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<input type="hidden" class="form-control"  name="customsearch" id="customsearch"  value="listsearch1" >
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Search</button>
							</div>							
						</div>
					</div>
				</form>	
				
		<?php		
			if(isset($id) && $id >0)
			{ 
		?>
			<form form class="mt-4 form2" action="" method="post">
				<input type="hidden" class="form-control"  name="plumberid" id="plumberid"  value="<?php echo $id;?>" >	
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Details of Licesend Plumber : </label>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label><?php echo $name." ".$surname." (".$search_reg_no.")";?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<?php echo $card ;?>
				</div>
				</br>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Current Licesed Plumbers Employer : </label>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label><?php echo $companyname;?></label>
							<input type="hidden" name="company_details" value="<?php echo $company_details; ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Number of COC's Permitted to be allocated to the Plumber : </label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" class="form-control"  name="balace_coc" id="balace_coc"  value="<?php echo $balace_coc;?>" disabled>
							<input type="hidden" class="form-control"  name="balace_coc1" id="balace_coc1"  value="<?php echo $balace_coc;?>">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 align-self-center">
						<h5 class="card-title">Allocted COC from My Stock</h5>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Number of COC's to be Allocated to Licensed Plumber : </label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" class="form-control"  name="rangebalace_coc" id="rangebalace_coc"  value="">
							<span id="checklimit" style="color:red"></span>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Certificate No Start Range : </label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" value="" readonly name="startrange" id="startrange">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Certificate No End Range : </label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">							
							<input type="text" value="" readonly name="endrange" id="endrange">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Reseller Invoice Number : </label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" class="form-control"  name="invoiceno" id="invoiceno"  value="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<h4 class="card-title add_top_value">Disclaimer</h4>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" id="disclaimer" name="disclaimer" class="custom-control-input">
							<label class="custom-control-label" for="disclaimer">I declare and understand</label>
						</div>
						<p class="info_text">
							That I have allocated/sold the relevant COC to a valid PIRB Licensed Plumber, and that if I am found to have allocated/sold any COC to non-valid PIRB Licensed Plumber I will be held accountable for my actions.
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<button type="submit" id="submit2" name="submit2" value="submit2" class="btn btn-primary">Allocate Certificates</button>
						</div>
					</div>
				</div>
			</form>

			<div id="skillmodal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form class="skillform">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="form-group">
											<h4 class="mb-15">A One Time Pin (OTP) was sent to the Licensed Plumber with the following Mobile Number :</h4>
											<h4><?php echo $name." / ".$surname." - ".$mobilephone; ?></h4>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input id="sampleOtp" type="text" class="form-control skill_training displaynone" readonly>
											<label>Enter OTP</label>
											<input name="otpnumber" id="otpnumber" type="text" class="form-control skill_training">
											<div class="invalidOTP" style="color: red;"> Given OTP is Invalid ! </div>
										</div>
										<div class="otp-status"></div>
									</div>
									<div class="col-md-12 text-center">
										<input type="hidden" name="skill_id" class="skill_id">
										<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-success resend">Resend</button>
										<button type="button" class="btn btn-success verify">Verify</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		<?php
			}
		?>
			</div>			
		</div>
	</div>
</div>



<script type="text/javascript">

$('#search_reg_no').keyup(function(){
	
	var strlength = $.trim($('#search_reg_no').val()).length;	
	if(strlength > 0)  {
		userautocomplete(["#search_reg_no", "#user_id_hide", "#plumber_suggesstion"], [$(this).val(), '3']);
		$("#plumber_suggesstion").show();
	}
	else{
		$("#plumber_suggesstion").hide();
		$("#plumber_suggesstion").html('');
	}
})

$(function(){
	numberonly('#rangebalace_coc');
	
	validation(
		'.form',
		{	
			search_reg_no : {
				required	: true,
			}
		},
		{	
			search_reg_no 	: {
				required	: "Register No field is required.",
			}
		}
	);

	validation(
		'.form2',
		{	
			startrange : {
				required	: true,
			},
			endrange : {
				required	: true,
			},
			invoiceno : {
				required	: true,
			}
		},
		{	
			startrange 	: {
				required	: "Startrange field is required.",
			},
			endrange 	: {
				required	: "Endrange field is required.",
			},
			invoiceno 	: {
				required	: "Invoiceno field is required.",
			}			
		}
	);

	$('#submit2').prop('disabled', true);
	$('#disclaimer').on('click',function(){
		if($('#disclaimer').prop('checked') == true){
			$('#submit2').prop('disabled', false);
		}
		else{
			$('#submit2').prop('disabled', true);	
		}
	});
	
	$('#submit2').on('click',function(){	
		if(!$('.form2').valid()) return false;
		ajaxotp();
		$('#skillmodal').modal('show');
		$('.invalidOTP').hide();
		event.preventDefault();
	});

	$('.resend').on('click',function(){
		ajaxotp();
	});

	function ajaxotp(){
		ajax('<?php echo base_url().'ajax/index/ajaxotp'; ?>', { 'mobile' : '<?php echo $mobilephone; ?>' }, '', { 
			success:function(data){
				if(data!=''){
					$('#sampleOtp').removeClass('displaynone').val(data);
				}
			}
		})
	}

	$('.verify').on('click',function(){
		var otpver = $('#otpnumber').val();
		
		ajax('<?php echo base_url().'ajax/index/ajaxotpverification'; ?>', {otp: otpver}, '', { 
			success:function(data){
				if (data == 0) {
					$('.invalidOTP').show();
				}else{
					$('.form2').submit();
				}
			}
		})
	});
	
})

$('#rangebalace_coc').on('keyup',function(){
	var permitval = parseInt($('#balace_coc1').val());
	var allocateval = parseInt($('#rangebalace_coc').val());
	
	if(allocateval=='' || isNaN(allocateval)){
		$('#checklimit').text("");
		$('#startrange').val('');
		$('#endrange').val('');
		return false;
	}
	
	if(permitval >= allocateval){
		$('#checklimit').text("");
		$('#startrange').val('');
		$('#endrange').val('');

		ajax('<?php echo base_url()."resellers/allocatecoc/index/allocate_coc_range"; ?>', {'rangebalace_coc' : $(this).val()}, allocate_coc_range_set,{'asynchronous':1});
	}
	else{
		$('#checklimit').text("The value you entered is greater than the number of COCs that can be allocated to this plumber");
		$('#startrange').val('');
		$('#endrange').val('');
	}
});

function allocate_coc_range_set(data){
	if(parseInt(data.allocate_start) > 0){
		$('#checklimit').text("");
		$('#startrange').val(data.allocate_start);
		$('#endrange').val(data.allocate_end);	
	}
	else{
		$('#checklimit').text("The value you have entered is greater than the available quantity of COC's in Reseller's Stock.");
		$('#startrange').val('');
		$('#endrange').val('');
	}
	
}
</script>
