<?php
//Reseller View File
// print_r($result);

$id = isset($result['id']) ? $result['id'] : '';
$search_reg_no = isset($result['registration_no']) ? $result['registration_no'] : '';
$name = isset($result['name']) ? $result['name'] : '';
$surname = isset($result['surname']) ? $result['surname'] : '';
$designationtemp = isset($result['designation']) ? $result['designation'] : '';
$designation = "";
if(isset($designationtemp) && $designationtemp > 0) {
	$designation	=	$this->config->item('designation2')[$designationtemp];
}
$companyname = isset($result['companyname']) ? $result['companyname'] : '';
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

$designation2id 		= isset($result['designation']) ? $result['designation'] : '';
$registration_date 		= isset($result['registration_date']) && $result['registration_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['registration_date'])) : '';
$renewal_date 			= $registration_date!='' ? date('d-m-Y', strtotime($result['registration_date']. ' +365 days')) : '';
$specialisationsid 		= isset($result['specialisations']) ? array_filter(explode(',', $result['specialisations'])) : '';

$companydetailsid		= isset($result['company_details']) ? $result['company_details'] : '';
$filepath				= base_url().'assets/uploads/plumber/'.$id.'/';
$pdfimg 				= base_url().'assets/images/pdf.png';
$profileimg 			= base_url().'assets/images/profile.jpg';
$file2 					= isset($result['file2']) ? $result['file2'] : '';
if($file2!=''){
	$explodefile2 	= explode('.', $file2);
	$extfile2 		= array_pop($explodefile2);
	$photoidimg 	= (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
}else{
	$photoidimg 	= $profileimg;
}

$filepath				= base_url().'assets/uploads/plumber/'.$id.'/';
$pdfimg 				= base_url().'assets/images/pdf.png';
$profileimg 			= base_url().'assets/images/profile.jpg';

$cardcolor = ['1' => 'learner_plumber', '2' => 'technical_assistant', '3' => 'technical_operator', '4' => 'licensed_plumber', '5' => 'qualified_plumber', '6' => 'master_plumber'];	
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
								<input type="search" autocomplete="off" class="form-control"  name="search_reg_no" id="search_reg_no"  value="<?php if(isset($id) && $id >0){ echo $searchbox; }?>" placeholder="Type in Plumbers reg number; name or surname" onkeyup="search_func(this.value);">
								<input type="hidden" id="user_id_hide" name="user_id_hide" value="0">
								<div id="plumber_suggesstion" style="display: none;"></div>
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


				<div class="row add_top_value <?php echo (isset($cardcolor[$designation2id]) ? $cardcolor[$designation2id] : ''); ?>">
					<div class="col-md-6">	
						<table id="id_Card" style="height: 300px;">
							<tbody>
								<tr>
									<td>
										<img class="id_logo" src="<?php echo base_url();?>assets/images/pitrb-logo.png">
										<p>Reg No: <?php echo ($search_reg_no!='') ? $search_reg_no : '-'; ?></p>
										<p>Renewal Date: <?php echo $renewal_date; ?></p>
									</td>
									<td>
										<img class="id_admin" src="<?php echo $photoidimg; ?>">
										<p><?php echo $name.' '.$surname; ?></p>
									</td>
								</tr>
								<tr class="add_idcard_color" >
									<td>
										<img class="plum_lic" src="<?php echo base_url()?>assets/images/Plumber_License.png">
									</td>
									<td>
										<p class="license"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<table id="id_Card_back">
							<tbody style="width: 90%; display: inline-block;">
								<tr>
									<td colspan="2">
										<p>This card holder is only entitled to purchase and issue Plumbing COC’s for the following categories of plumbing and plumbing specialisations</p>
									</td>
								</tr>
								<tr>
									<?php 
										if(count($specialisationsid) > 0){
											$specialisationskey = 0;
											foreach($specialisationsid as $specialisationsdata){
												if($specialisationskey==0){
									?>
													<td class="add_width">
														<ul>
									<?php
												}
									?>
															<li><?php echo isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-'; ?></li>
									<?php
												if($specialisationskey==2 || (count($specialisationsid)-1)==$specialisationskey){
									?>
														</ul>
													</td>
									<?php
												}
												
												$specialisationskey++;
												if($specialisationskey==3) $specialisationskey=0;
											}
										}else{
									?>
											<td class="add_width" style="vertical-align: top;">-</td>
									<?php 
										}
									?>
								</tr>
								<tr style="border-top: 1px solid #000;">
									<td style="border-right: 1px solid #000; height: 92px;">
										<p class="emp_title">Current Employer: </p> 
										<p class="plumber_name add_style"><?php echo isset($company[$companydetailsid]) ? $company[$companydetailsid] : '-'; ?></p>
									</td>
									<td>
										<p style="width: 100%;">Specialisations</p>
										<?php 
											if(count($specialisationsid) > 0){
												foreach($specialisationsid as $specialisationsdata){
												
										?>
													<div><?php echo isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-'; ?></div>
										<?php	
												}
											}else{
										?>
												<p>-</p>
										<?php 
											}
										?>
									</td>
								</tr>
							</tbody>
							<tbody style="width: 10%; display: inline-block;">
								<tr style="height: 300px;">
									<td class="add_idcard_color" colspan="2" style="text-align: center; padding: 15px;">
										<p class="back_license" style="transform: rotate(-90deg);margin: -66px;"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
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
							<label><?php echo $designation;?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Company : </label>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label><?php echo $companyname;?></label>
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
							<label>Certificate No Start Range : </label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						<?php
							if(count($rangedata) > 0){
								echo form_dropdown('startrange', $rangedata, $startrange, ['id' => 'startrange', 'class'=>'form-control']);
							}
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
						<?php
							if(count($rangedata) > 0){
								echo form_dropdown('endrange', $rangedata, $endrange, ['id' => 'endrange', 'class'=>'form-control']);
							}
						?>
						</div>
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
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Caution: Number of COC that been selected for allocation is greater than the number of permitted COC's that can be allocated to the Plumber.</label>
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
											<input id="sampleOtp" type="text" class="form-control skill_training" readonly>
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

var req = null;
function search_func(value)
{
    if (req != null) req.abort();
    
    var type1 = 3;
    req = $.ajax({
        type: "POST",
        url: '<?php echo base_url()."resellers/allocatecoc/Index/userDetails"; ?>',
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

function selectuser(val,id,limit) {
	$("#search_reg_no").val(val);
	$("#user_id_hide").val(id);
	$("#plumber_suggesstion").hide();
}

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
	$('#startrange').on('change', function() {
		var startrange = parseInt(this.value);
		var endrange = parseInt($('#endrange').val());
		var range = endrange - startrange + 1;		
		$('#rangebalace_coc').val(range);
	});
	$('#endrange').on('change', function() {
		var endrange = parseInt(this.value);
		var startrange = parseInt($('#startrange').val());
		var range = endrange - startrange + 1;		
		$('#rangebalace_coc').val(range);
	});


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
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo base_url().'resellers/allocatecoc/Index/ajaxOTP'; ?>',
			async : true,
			dataType : 'json',
			method 	: 'POST',
			data: {generate:'otp'},
			success: function(data) {
				$('#sampleOtp').val(data.otp);
			}
		});
	}

	$('.verify').on('click',function(){
		var otpver = $('#otpnumber').val();
		$.ajax({
			type  		: 'ajax',
			url   		: '<?php echo base_url().'resellers/allocatecoc/Index/OTPVerification'; ?>',
			async 		: true,
			dataType 	: 'json',
			method 		: 'POST',
			data 		: { otp: otpver},
			success: function(data) {
				if (data == 0) {
					$('.invalidOTP').show();
				}else{
					$('.form2').submit();
				}
				console.log(data);
			}
		});
	});
	
})


</script>

