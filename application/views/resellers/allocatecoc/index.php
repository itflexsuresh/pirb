<?php
//Reseller View File
$id = isset($result['id']) ? $result['id'] : '';
$search_reg_no = isset($result['registration_no']) ? $result['registration_no'] : '';
$name = isset($result['name']) ? $result['name'] : '';
$surname = isset($result['surname']) ? $result['surname'] : '';
$designationtemp = isset($result['designation']) ? $result['designation'] : '';
$designation = "";
if(isset($designationtemp) && $designationtemp > 0) {
	$designation	=	$this->config->item('designation2')[$designationtemp];
}
$companyname = isset($result['companyname']) ? $result['companyname'] : 'Unemployed';
$company_details = isset($result['company_details']) ? $result['company_details'] : '';
$balace_coc = 0 ;
// $orderqty = 0;
// $coc_purchase_limit = 0;
// $coc_purchase_limit = isset($result['coc_purchase_limit']) ? $result['coc_purchase_limit'] : '';
// if(isset($id) && $id >0)
// {	
// 	$orderqty = $array_orderqty['sumqty'];
// 	$balace_coc = $coc_purchase_limit - $orderqty;
// }
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
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
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
					<h4 class="card-title">Allocate COC</h4>
				
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

								<!-- <div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div> -->
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

						<?php
							// if(count($rangedata) > 0){
							// 	echo form_dropdown('startrange', $rangedata, $startrange, ['id' => 'startrange', 'class'=>'form-control']);
							// }

						?>	
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

						<?php
							// if(count($rangedata) > 0){
							// 	echo form_dropdown('endrange', $rangedata, $endrange, ['id' => 'endrange', 'class'=>'form-control']);
							// }
						?>
						</div>
					</div>
				</div>

				

				<!-- <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Caution: Number of COC that been selected for allocation is greater than the number of permitted COC's that can be allocated to the Plumber.</label>
						</div>
					</div>
				</div> -->

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
							That I have allocated/sold the relevant COC to a valid Licensed Plumber, and that if I am found that I have allocated a COC to non valid Licensed Plumbers I will be held accountable for my actions.
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
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">A One Time Pin (OTP) was sent to the Licensed Plumber with the following Mobile Number`</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-12">
											<div class="form-group">
												<label><?php echo $name." ".$surname." (".$search_reg_no.")";?></label>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input id="sampleOtp" type="text" class="form-control skill_training displaynone" readonly>
											<div class="invalidOTP" style="color: red;"> Given OTP is Invalid ! </div>
											<label>Enter OTP</label>
											<input name="otpnumber" id="otpnumber" type="text" class="form-control skill_training">
										</div>
										<div class="otp-status"></div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="skill_id" class="skill_id">
								<button type="button" class="btn btn-success verify">Verify</button>
								<button type="button" class="btn btn-success resend">Resend</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
/*
var req = null;
function search_func(value)
{
    if (req != null) req.abort();
    
    var type1 = 3;
    var strlength = $.trim($('#search_reg_no').val()).length;
    if(strlength > 0)  { 
	    req = $.ajax({
	        type: "POST",
	        url: '<?php //echo base_url()."resellers/allocatecoc/Index/userDetails"; ?>',
	        data: {'search_keyword' : value,type:type1},        
	        beforeSend: function(){
				// $("#search_reg_no").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
			},
	        success: function(data){          	
	        	$("#plumber_suggesstion").html('');
	        	$("#plumber_suggesstion").show();      	
				$("#plumber_suggesstion").html(data);			
				$("#search_reg_no").css("background","#FFF");
	        }
	    });
	}
	else{
		console.log(strlength);
		$("#plumber_suggesstion").hide();
	}
}

function selectuser(val,id,limit) {
	$("#search_reg_no").val(val);
	$("#user_id_hide").val(id);
	$("#plumber_suggesstion").hide();
}
*/
$(function(){

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
	// $('#startrange').on('change', function() {
	// 	var startrange = parseInt(this.value);
	// 	var endrange = parseInt($('#endrange').val());
	// 	var range = endrange - startrange + 1;		
	// 	$('#rangebalace_coc').val(range);
	// });
	// $('#endrange').on('change', function() {
	// 	var endrange = parseInt(this.value);
	// 	var startrange = parseInt($('#startrange').val());
	// 	var range = endrange - startrange + 1;		
	// 	$('#rangebalace_coc').val(range);
	// });


	$('#submit2').on('click',function(){		
		// event.preventDefault();
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
		ajax('<?php echo base_url().'ajax/index/ajaxotp'; ?>', {}, '', { 
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
	var permitval = $('#balace_coc1').val();
	var allocateval = $('#rangebalace_coc').val();

	if(parseInt(permitval) >= parseInt(allocateval)){
		$('#checklimit').text("");
		$('#startrange').val('');
		$('#endrange').val('');
		ajax('<?php echo base_url()."resellers/allocatecoc/index/allocate_coc_range"; ?>', {'rangebalace_coc' : $(this).val()}, allocate_coc_range_set);
	}
	else{
		$('#checklimit').text("Entered value is greater than the Plumber Permitted Coc");
	}
});

function allocate_coc_range_set(data){
	if(parseInt(data.allocate_start) > 0){
		$('#checklimit').text("");
		$('#startrange').val(data.allocate_start);
		$('#endrange').val(data.allocate_end);	
	}
	else{
		$('#checklimit').text("Entered value is greater than the Reseller Permitted Coc");
	}
	
}

</script>
