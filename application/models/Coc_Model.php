<?php
// 
// echo "<pre>";
// print_r(base_url());die;
$plumberstatus 			= $userdata1['plumberstatus'];
$mobile_phone 			= $username['mobile_phone'];
$userid		 			= $username['id'];
$log_coc 				= $logcoc;
$VAT 					= $settings["vat_percentage"];
$coc_purchase_limit   	= $username["coc_purchase_limit"];
$electronic_coc_log   	= $username["coc_electronic"];
$cocpaperwork 			= $cocpaperwork["amount"];
$cocelectronic 			= $cocelectronic["amount"];

$postage 				= $postage["amount"];
$couriour 				= $couriour["amount"];
$collectedbypirb 		= $collectedbypirb["amount"];
?>
<?php
$plumber_status = array(3, 4, 5);
if (in_array($plumberstatus, $plumber_status)) {
	echo " Access denied ";
}else{

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Purchase COC</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Purchase COC</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<!-- action="https://sandbox.payfast.co.za/eng/process" -->
				
				<form class="form" method="post">

					<h4 class="card-title">Purchase COC</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="add_max_height">Number of Non Logged COC's</label>
								<input type="text" id="log_coc" class="form-control" name="log_coc" value="<?php  echo $log_coc; ?>" readonly>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="add_max_height">Total Number COC's You are Permitted</label>
								<input type="text" class="form-control" id="coc_permitted" name="coc_permitted" readonly value="<?php echo $coc_purchase_limit; ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="add_max_height">Number of Permitted COC's that you are able to purchase</label>
								<input type="text" class="form-control" id="number_of_purchase_coc" name="number_of_purchase_coc" readonly>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label style="margin-left: 16px;">Select type of COC you wish to purchase</label>
								</div>
								<?php
								if($electronic_coc_log==1){	
									$methodof_delivery = 'style="display:none;"';
									$i = 1;							
									foreach($coctype as $key => $type){
										if ($i == 1) {
											$check  = 'checked="checked"';
										}else{
											$check  = '';
										}
										?>
										<div class="col-md-3">
											<div class="custom-control custom-radio">
												<input type="radio" id="<?php echo $key.'-'.$type; ?>" name="coc_type" <?php echo $check; ?> value="<?php echo $key; ?>" class="coc_type custom-control-input" onclick="typeclick();">
												<label class="custom-control-label" for="<?php echo $key.'-'.$type; ?>"><?php echo $type; ?></label>
											</div>
										</div>
										<?php 
										$i++;
									}
									?>
										<script> 
										$(document).ready(function(){
											typeclick();
										}); 
									</script>
									<?php
									
								}else{ 
									$methodof_delivery = '';
									?>
									<div class="col-md-3">
										<div class="custom-control custom-radio">
											<input type="radio" id="2-Paper_Based" checked="checked" name="coc_type" value="2" class="coc_type custom-control-input">
											<label class="custom-control-label" for="coc_type">Paper Based</label>
										</div>
									</div>
									<script> 
										$(document).ready(function(){
											coctype1(2);
										}); 
									</script>
								<?php }
								?>
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-md-6 methodofdelivery" <?php echo $methodof_delivery; ?>>
							<div class="form-group">
								<label>Method Of Delivery</label>
								<?php 
								echo form_dropdown('delivery_card', $deliverycard, '', ['id' => 'delivery_card', 'class' => 'form-control delivery_card']); 
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Number of COC's You wish to Purchase</label>
								<input onchange="modifycost();" type="number" id="coc_purchase" class="form-control" min="1" value="1" name="coc_purchase" for="coc_purchase" max="<?php echo $coc_purchase_limit; ?>">
							</div>
						</div>
						<div class="alert-msg">Your Purchase Limit is Reached</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Cost of COC Type</label>
								<input type="number" id="coc_cost" class="form-control coc_cost" readonly name="coc_cost">
							</div>
						</div>
						<div class="col-md-6 deliverygroupdiv">
							<div class="form-group">
								<label>Cost of Delivery</label>
								<input type="text" id="cost_f_delivery" class="form-control deliveryclass" readonly name="cost_f_delivery">
								<input type="hidden" name="deliveryclass1" id="deliveryclass1" value="<?php echo $collectedbypirb; ?>">
								<input type="hidden" name="deliveryclass2" id="deliveryclass2" value="<?php echo $couriour; ?>">
								<input type="hidden" name="deliveryclass3" id="deliveryclass3" value="<?php echo $postage; ?>">



							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>VAT @<?php echo $VAT; ?>%</label>
								<input type="number" id="vat" class="form-control" readonly name="vat">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Total Due</label>
								<input type="text" id="totaldue" class="form-control" readonly name="totaldue">
							</div>
						</div>
					</div>
					<?php if ($plumberstatus != 2) { ?>
					
					<h4 class="card-title add_top_value">Disclaimer</h4>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" id="disclaimer" name="disclaimer" class="custom-control-input">
						<label class="custom-control-label" for="disclaimer">I declare and understand</label>
					</div>
					<p class="info_text">
						That all the plumbing works comply in all respect to the plumbing regulations and laws as defined by the National Compulsory Standards and Local By-Laws. The PIRB's auditing, rectification and disciplinary policy and procedures and that I fully comply to them. If I fail to comply with the policy and procedures it may result in disciplinary action being taken against me, which could result in my suspension from the PIRB.  As a professional plumber I abide by the PIRB Code of Conduct as a professional Plumber
					</div>

					<input type="hidden" id="dbvat" name="dbvat" value="<?php echo $VAT; ?>">
					<input type="hidden" id="dbcocpaperwork" name="dbcocpaperwork" value="<?php echo $cocpaperwork; ?>">
					<input type="hidden" id="dbcocelectronic" name="dbcocelectronic" value="<?php echo $cocelectronic; ?>">
					<!-- 					<input type="hidden" id="description" name="description" value="Purchase of {number} PIRB Certificate of Compliance"> -->
					<div class="row text-right">
						<div class="col-md-12">
							<button type="submit" name="cancel" id="cancel" class="btn btn-block btn-primary btn-rounded">Cancel</button>

							<button type="button" id="purchase" name="purchase" value="purchase" class="btn btn-block btn-primary btn-rounded">Purchase</button>
						</div>
					</div>
					<!---	Payment	--->
					<input id="merchant_id" name="merchant_id" value="10016054" type="hidden">
					<input id="merchant_key" name="merchant_key" value="uwfiy08dfb6jn" type="hidden">
					<input id="return_url" name="return_url" value="<?php echo base_url().'plumber/purchasecoc/index/return'; ?>" type="hidden">
					<input id="cancel_url" name="cancel_url" value="<?php echo base_url().'plumber/purchasecoc/index/cancel'; ?>" type="hidden">
					<input id="notify_url" name="notify_url" value="<?php echo base_url().'plumber/purchasecoc/index/notify'; ?>" type="hidden">
					<input id="name_first" name="name_first" value="<?php echo $username['name']; ?>" type="hidden">
					<input id="name_last" name="name_last" value="<?php echo $username['surname']; ?>" type="hidden">
					<input id="email_address" name="email_address" value="<?php echo $username['email']; ?>" type="hidden">
					<input id="m_payment_id" name="m_payment_id" value="TRN1481493600" type="hidden">
					<input type="hidden" id="totaldue1" class="form-control" readonly name="amount">
					<input id="item_name" name="item_name" value="Coc Purchase" type="hidden">
					<input id="item_description" name="item_description" value="coc" type="hidden">
					<input id="payment_method" name="payment_method" value="cc" type="hidden">
					
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
													<label><?php echo $username['name']." ".$username['surname']; ?></label>
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
								<?php } ?>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function(){
		$('.deliverygroupdiv').hide();
		$('#skillmodal').modal('hide');
		$('#purchase').prop('disabled', true);
		coctype1($('.coc_type:checked').val());
		delivery($('.delivery_card').val());

		$('.alert-msg').hide();

		validation(
			'.form',
			{
				coc_purchase : {
					required	: true,
				},
				disclaimer : {
					required	: true,
				},
				coc_type : {
					required	: true,
				},
				
			},
			{
				coc_purchase 	: {
					required	: "Number of COC wish to Purchase field is required."
				},
				disclaimer 	: {
					required	: "Disclaimer is required."
				},
				coc_type 	: {
					required	: "Please Select Your COC Type."
				},
			}
			);
		
		if ($('#log_coc').val()!='') {
			var coccount = 0
			coccount = Math.abs(parseInt($('#log_coc').val())-parseInt($('#coc_permitted').val()));
			$('#number_of_purchase_coc').val(coccount);
			$("#coc_purchase").attr('max', coccount);
		}
		$("#coc_purchase").keyup(function(e){

			calc();
			delivery($('.delivery_card').val());
		});


		$('#purchase').on('click',function(){
			if(!$('.form').valid()) return false;
			ajaxotp();
			
			$('#skillmodal').modal('show');
			$('.invalidOTP').hide();

			
		});

		$('.resend').on('click',function(){
			ajaxotp();
		});

		var disclimerClickCount = 0;
		$('#disclaimer').on('click',function(){
			disclimerClickCount += 1;
			if (disclimerClickCount%2 == 1) {
				$('#purchase').prop('disabled', false);
			}else{
				$('#purchase').prop('disabled', true);
			}	
		});
		

		$('.verify').on('click',function(){
			var otpver = $('#otpnumber').val();

			var delivery_type = 0;
			var cocType = 0;
			var delivery_cost = 0;
			if ($('#1-Electronic').is(":checked")) {
				delivery_type = 0;
				delivery_cost = 0;
				cocType = 1;
			}else{
				delivery_type = $('#delivery_card').val();
				cocType = 2;
				delivery_cost = $('#cost_f_delivery').val();
			}

			$.ajax({
				type  		: 'ajax',
				url   		: '<?php echo base_url().'plumber/purchasecoc/Index/OTPVerification'; ?>',
				async 		: true,
				dataType 	: 'json',
				method 		: 'POST',
				data 		: { otp: otpver},
				success: function(data) {
					if (data == 0) {
						$('.invalidOTP').show();
						//alert('Given OTP is Invalid !');
					}else{
						ajaxInsert(delivery_type, cocType, delivery_cost);

					}

					console.log(data);
				}
			});
		});

		$('.coc_type').click(function(){
		coctype1($(this).val());
	});

			$('.delivery_card').change(function(){
				delivery($(this).val());
				
			});

	});

	function typeclick(){
			
			
			
			var coc_types = $("input[name='coc_type']:checked").val();
			
			if (coc_types == '1') {
				$('.methodofdelivery').hide();
			}else{
				$('.methodofdelivery').show();
			}

			delivery($('.delivery_card').val());
		}


	function ajaxInsert(delivery_type, cocType, delivery_cost){
		$.ajax({
			type  		: 'ajax',
			url   		: '<?php echo base_url().'plumber/purchasecoc/Index/insertOrders'; ?>',
			async 		: true,
			dataType 	: 'json',
			method 		: 'POST',
			data 		: { coc_type: cocType, delivery_type: delivery_type, cost_value: $('#coc_cost').val(), quantity: $('#coc_purchase').val(), vat: $('#vat').val(), total_due: $('#totaldue').val(), delivery_cost: delivery_cost,},
			success: function(data) {
				if (data == 1) {
					$('.form').prop('action','https://sandbox.payfast.co.za/eng/process');
					$('.form').submit();
				}else{
					alert('Something Went Wrong Please Try Again !');
				}
			}
		});
	}


	
	var coc = 0;
	var coc_amount = 0;
	function coctype1(value){
		if(value=='1'){
			//coc_purchase
			//$('.coc_cost').val('<?php // echo $cocelectronic; ?>')	
			coc_amount = $('#dbcocelectronic').val();
			$('.deliverygroupdiv').hide();
			//alert(coc_amount);
			$('#cost_f_delivery').val('0');
		}else if(value=='2'){
			//coc_purchase
			coc_amount = $('#dbcocpaperwork').val();
			$('.deliverygroupdiv').show();
			//alert(coc_amount);
			//$('.coc_cost').val('<?php // echo $cocelectronic; ?>')
			//$('#cost_f_delivery').val('<?php //echo $cocpaperwork; ?>');
		}

	}





	function ajaxotp(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo base_url().'plumber/purchasecoc/Index/ajaxOTP'; ?>',
			async : true,
			dataType : 'json',
			method 	: 'POST',
			data: {generate:'otp', ammount: $('#totaldue1').val(), item_description: $('#item_description').val(),payment_method: $('#payment_method').val(), m_payment_id: $('#m_payment_id').val(), },
			success: function(data) {
				$('#sampleOtp').val(data.otp);
			}
		});
	}

	// function calculations(data,value){
		

	// 		var count = $('#number_of_purchase_coc').val();			
	// 		var numberOdCoc = parseFloat($('#coc_purchase').val());
	// 		var cocCost = parseFloat(coc_amount)*numberOdCoc;
	// 		$('.coc_cost').val(cocCost);

	// 		if (count > parseFloat(data)) {
	// 			$("#coc_purchase").val((data));
	// 			//console.log($("#coc_purchase").val((data)));
	// 			$('.alert-msg').hide();
	// 		}else{
	// 			if ($("#coc_purchase").val() != '') {
	// 				$('.alert-msg').show();
	// 				$("#coc_purchase").val(count);
	// 			}
				
	// 		}

	// 		var count 	= data;
	// 		var coctype = $('#coc_cost').val();
	// 		if (coctype!='') {
	// 			var typecoc = $("input[name='coc_type']:checked").val();
	// 			var dbvat = parseFloat($('#dbvat').val());
				
	// 			var allvat = (((parseFloat($('#coc_cost').val())+parseFloat($('#cost_f_delivery').val()))*dbvat)/100);

	// 			$('#vat').val(allvat.toFixed(2));
				
	// 			var total = parseFloat(coctype)+parseFloat(allvat)+parseFloat($('#cost_f_delivery').val())
				

	// 			$('#totaldue').val(total.toFixed(2));
	// 			$('#totaldue1').val(total.toFixed(2));
	// 		}

	// 	}




	function calc(){
		

		var coc_cost 	= parseFloat($('#coc_cost').val());
		var costdelivery 	= parseFloat($('#cost_f_delivery').val());

		var vat 			= parseFloat($('#dbvat').val());


		var vat1 = (((costdelivery + coc_cost ) * vat) / 100);

		var total = vat1 + coc_cost + costdelivery;

		$('#vat').val(vat1.toFixed(2));
		$('#totaldue').val(total.toFixed(2));
		$('#totaldue1').val(total.toFixed(2));

	}

	function modifycost()
	{
		
		var quan = $("#coc_purchase").val();

		var coc_types = $("input[name='coc_type']:checked").val();
		if(coc_types == 1)
			var cost = parseFloat($("#dbcocelectronic").val());
		else
		var cost = parseFloat($("#dbcocpaperwork").val());
		var total = cost * quan;
		$("#coc_cost").val(total.toFixed(2));

		calc();
	}

		function delivery(value){

		$('.deliveryclass').val($('#deliveryclass'+value).val());
		modifycost();

	}
</script>

<?php

	}
?>
