<?php
echo $customview;

$vat 					= $settings["vat_percentage"];
$cocpaperwork 			= currencyconvertor($cocpaperwork["amount"]);
$cocelectronic 			= currencyconvertor($cocelectronic["amount"]);
$postage 				= currencyconvertor($postage["amount"]);
$couriour 				= currencyconvertor($couriour["amount"]);
$collectedbypirb 		= currencyconvertor($collectedbypirb["amount"]);

$created_at 			= (isset($result['created_at']) && date('d-m-Y', strtotime($result['created_at']))!='01-01-1970') ? date('d-m-Y', strtotime($result['created_at'])) : '';

$coc_type 				= isset($result['coc_type']) ? $result['coc_type'] : '';
$id 					= isset($result['id']) ? $result['id'] : '';
// $inv_id 				= isset($result['inv_id']) && $result['created_by']!='' ? $result['inv_id'] : '';
$inv_id 				= isset($result['inv_id']) ? $result['inv_id'] : '';
$inv_id_display			= isset($result['created_by']) && $result['created_by']!='' ? 1 : 0;
$delivery_type 			= isset($result['delivery_type']) ? $result['delivery_type'] : '';
$quantity 				= isset($result['quantity']) ? $result['quantity'] : '1';
$internalinv 			= isset($result['internal_inv']) ? $result['internal_inv'] : '';
$trackingno 			= isset($result['tracking_no']) ? $result['tracking_no'] : '';
$emailtrack 			= isset($result['email_track']) ? $result['email_track'] : '';
$smstrack 				= isset($result['sms_track']) ? $result['sms_track'] : '';
$status 				= isset($result['status']) ? $result['status'] : '';

$type 					= isset($result['type']) ? $result['type'] : '';
$full_name				= isset($result['name']) && isset($result['surname']) ? $result['name'].' '.$result['surname'] : '';
$user_id				= isset($result['user_id']) ? $result['user_id'] : '';
$count					= isset($result['count']) ? $result['count'] : '';

$comment_all = '';
if(!empty($comments)){
	foreach($comments as $key=>$val){
		$comment_all .=  $val['comment'].PHP_EOL;
	}
}

$stock = (isset($stock)) ? $stock : '';
$allocate_button_disbled = ($coc_type==2 && $stock=='') ? 'disabled' : '';


$tracking_display = ($delivery_type=='' || $delivery_type=='1') ? 'displaynone' : '';

?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Orders</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Orders</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			<?php if($checkpermission){ ?>
				<form class="form" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Date of Order</label>
								<div class="input-group">
									<input type="text" autocomplete="off" class="form-control created_at" name="created_at" data-date="datepicker" value="<?php echo $created_at; ?>">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Order ID</label>
								<input type="text" class="form-control" name="order_id" id="order_id" value="<?php echo $id; ?>" readonly>
							</div>
						</div>
						<input type="hidden" value="<?php echo $inv_id; ?>" name="inv_id">
						<?php if($inv_id_display==1){ ?>
						<div class="col-md-6">
							<div class="form-group">
								<label>Inv Number</label>
								<input type="text" class="form-control" name="inv_display_id" value="<?php echo $inv_id; ?>" readonly>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row form-group">
								<div class="col-md-3">
									<div class="custom-control custom-radio">

				                        <input type="radio" id="plumber" name="purchase_type" class="custom-control-input" value="3" <?php if($type=='3'){ echo 'checked="checked"'; } if($id!=''){ echo 'disabled'; } ?>>
				                        <label class="custom-control-label" for="plumber">Plumber</label>
				                    </div>
			                	</div>
			                	<div class="col-md-3">
				                    <div class="custom-control custom-radio">
				                        <input type="radio" id="reseller" name="purchase_type" class="custom-control-input" value="6" <?php if($type=='6'){ echo 'checked="checked"'; } if($id!=''){ echo 'disabled'; } ?>>
				                        <label class="custom-control-label" for="reseller">Reseller</label>
				                    </div>
				                </div>
			            	</div>
						</div>
					</div>
					<div class="row user_wrapper <?php if($id==''){ echo 'displaynone'; } ?>">
						<div class="col-md-6">
							<div class="form-group">
								<label></label>
								<input type="search" autocomplete="off" class="form-control" name="user_search" id="user_search" <?php if($id!=''){ echo 'disabled'; } ?> value="<?php echo $full_name; ?>">
								<div id="user_suggestion" class="<?php if(!isset($id)){ echo 'displaynone'; } ?>"></div>
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
								<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
							</div>
						</div>
					</div>

					<div class="row">						
						<div class="col-md-6">
							<div class="form-group">
								<label>Number of COC's Permitted to be purchased</label>
								<input type="text" class="form-control" id="user_limit" name="user_limit" readonly value="<?php echo $count; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Number Of COC's Requested</label>
								<input type="number" id="quantity" class="form-control" min="<?php echo $quantity; ?>" value="<?php echo $quantity; ?>" name="quantity" for="quantity" <?php if($id > 0){ ?>readonly="true"<?php } ?>>							  
							</div>
						</div>
					</div>
						
						<div class="col-md-6 comments <?php if($id!=''){}else {echo 'displaynone'; }?>">							
							<div class="form-group coment_section">
								<label>Comments</label>
								<textarea class="form-control" id="comments" name="comments" disabled="" placeholder=""><?php echo $comment_all; ?></textarea>
								<input type="text" class="form-control" placeholder="Type your Comment here" name="comment" id="comment">
								<button type="button" id="comment_btn" name="comment_btn" value="" class="btn btn-primary">Add Comment</button>
							</div>							
						</div>					
					</div>

					<div class="row add_top_value add_left_value">
						<h4 class="card-title add_left_value">Type of COC</h4>
						<div class="col-md-12">
							<div class="form-group">
								<div class="row mt_40">
									<div class="col-md-4">
										<label>Type of COC</label>		
									</div>
									<div class="col-md-8">
										<div class="row">
											<?php
												foreach($coctype as $key => $value){
													
													if($key==1){
														$class = "electronic";
													} else {
														$class = "paper";														
													}
											?>
													<div class="col-md-5 <?php echo $class; ?>">
														<div class="custom-control custom-radio">
															<input type="radio" name="coc_type" id="<?php echo $key.'-'.$value; ?>" class="custom-control-input coc_type <?php if($key=='1'){ echo 'electronic_radio';} ?>" value="<?php echo $key; ?>" <?php if($coc_type==$key){ echo 'checked="checked"'; } ?>>
															<label class="custom-control-label" for="<?php echo $key.'-'.$value; ?>"><?php echo $value; ?></label>
														</div>
													</div>
											<?php
												}
											?>
										</div>
					            	</div>
					            </div>
				        	</div>
						</div>

						<div class="col-md-12 delivery_type_wrapper <?php if($coc_type==2){ echo ''; } else { echo 'displaynone'; } ?>">
							<div class="form-group col-md-6 row">
								<label>Method Of Delivery</label>
								<?php 
									echo form_dropdown('delivery_type', $deliverycard, $delivery_type, ['id' => 'delivery_type', 'class' => 'form-control delivery_type']); 
								?>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Payment Status</label>
									</div>								
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-5">
												<div class="custom-control custom-radio">
							                        <input type="radio" id="paid" name="status" class="custom-control-input" value="1" <?php if($status=='1'){ echo 'checked="checked"'; } ?>>
							                        <label class="custom-control-label" for="paid">Paid</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="unpaid" name="status" class="custom-control-input" value="0" <?php if($status=='0'){ echo 'checked="checked"'; } ?>>	
							                        <label class="custom-control-label" for="unpaid">Unpaid</label>
							                    </div>
							                </div>
						            	</div>
						            </div>
					        	</div>
				        	</div>
						</div>
						<div class="col-md-12">
							<div class="form-group col-md-6 row">
								<label>Internal Acc Invocie Number</label>
								<input type="text" autocomplete="off" class="form-control" name="internal_inv" value="<?php echo $internalinv; ?>">
							</div>
						</div>
						<div class="col-md-12 tracking_wrapper <?php echo $tracking_display; ?>">
							<div class="form-group col-md-6 row">
								<label>Tracking No</label>
								<input type="text" autocomplete="off" class="form-control" name="tracking_no" value="<?php echo $trackingno; ?>">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="sms_notifi" name="sms_track" value="1" <?php if($smstrack=='1'){ echo 'checked="checked"'; } ?>>
									<label class="custom-control-label" for="sms_notifi">Send a SMS Tracking Notification</label>
								</div>

								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="email_trak_notifi" name="email_track" value="1" <?php if($emailtrack=='1'){ echo 'checked="checked"'; } ?>>
									<label class="custom-control-label" for="email_trak_notifi">Send an Email Tracking Notifiation</label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 row order_cancelled <?php if($id!=''){}else { echo 'displaynone'; } ?>">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="email_notifi" name="admin_status">
										<label class="custom-control-label" for="email_notifi">Order Cancelled</label>
			                        </div>
		                    	</div>
		                    	<div class="col-md-12 row text-right">
		                    		<button type="submit" name="submit" value="submit" class="btn btn-primary">Update/Add</button>
		                    	</div>
	                    	</div>
						</div>					
					</div>
					<input type="hidden" id="cost_value" class="form-control" name="cost_value">
					<input type="hidden" id="delivery_cost" class="form-control" name="delivery_cost">
					<input type="hidden" id="vat" class="form-control" name="vat">
					<input type="hidden" id="total_due" class="form-control" name="total_due">
				</form>

				<form method="POST" class="allocate_form">
					<div class="row mt_20 <?php if($id!=''){}else {echo 'displaynone'; }?>">
						<div class="col-md-12">
							<div class="form-group">
								<div class="cert_start_range">
									<label>Certificate Range</label>
									<input type="text" value="<?php echo $stock; ?>" disabled class="form-control">
									<input type="hidden" name="stock" value="<?php echo $stock; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="start_notifi" name="sms_coc_track" value="1" checked>
		                            <label class="custom-control-label" for="start_notifi">Send a SMS COC Allocation Notification</label>
		                        </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="end_notifi" name="email_coc_track" value="1" checked>
		                            <label class="custom-control-label" for="end_notifi">Send a Email COC Allocation Notification</label>
		                        </div>
							</div>
						</div>
						<div class="row text-right">
							<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
							<input type="hidden" name="coc_count" value="<?php echo $quantity; ?>">
							<input type="hidden" class="form-control" name="order_id" id="order_id" value="<?php echo $id; ?>">
							<input type="hidden" class="form-control" name="type" value="<?php echo $type; ?>">
							<input type="hidden" name="coc_type" value="<?php echo $coc_type; ?>">
							<button type="submit" name="allocate_certificate" value="submit" class="btn btn-primary" <?php echo $allocate_button_disbled; ?>>Allocate Certificates</button>
							<?php if($allocate_button_disbled=='disabled'){ echo '<p>COC\'S is out of stock. Please allocate in paper management.</p>'; } ?> 
						</div>
					</div>					
				</form>
			<?php } ?>
				<div class="row add_top_value add_left_value">
					<div class="row mb_20">
						<a href="<?php echo base_url(); ?>/admin/cocstatement/cocorders/index" class="active_link_btn">PENDING</a>
						<a href="<?php echo base_url(); ?>/admin/cocstatement/cocorders/index/index/closed" class="archive_link_btn">CLOSED</a>
					</div>
				</div>
				<div class="table-responsive">
						<table class="table table-bordered table-striped datatables fullwidth">
							<thead>
								<tr>
									<th>OrderID</th>
									<th>Inv Number</th>
									<th>Date of order</th>
									<th>Payment Status</th>
									<th>Internal Inv Number</th>
									<th>Plumber Name and Surname/Reseller</th>
									<th>COC Type</th>
									<th>Total COC</th>
									<th>Delivery Method</th>
									<th>Delivery Address</th>
									<th>Tracking Number</th>
									<?php if($closed_status!='closed'){ ?>
									<th>Action</th>
									<?php } ?>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			
			

			
		</div>
	</div>
</div>

<script type="text/javascript">
var vatpercentage 	= '<?php echo $vat; ?>';
var cocpaperwork 	= '<?php echo $cocpaperwork; ?>';
var cocelectronic 	= '<?php echo $cocelectronic; ?>';
var postage 		= '<?php echo $postage; ?>';
var couriour 		= '<?php echo $couriour; ?>';
var collectedbypirb = '<?php echo $collectedbypirb; ?>';

$(function(){
	datepicker('.created_at');

	validation(
		'.form',
		{
			created_at : {
				required	: true,
			},
			quantity : {
				required	: true,
			},
			coc_type : {
				required	: true,
			},
			status : {
				required	: true,
			},
			internal_inv : {
				required	: true,
			},
			tracking_no : {
				required:  	function() {
								return ($("#delivery_type").val() == "2" || $("#delivery_type").val() == "3");
							}			
			},
			purchase_type : {
				required	: true,
			},
			user_id : {
				required	: true,
			}			
		},
		{
			created_at 	: {
				required	: "Date of order field is required."
			},
			quantity 	: {
				required	: "Number of COC's You Wish to Purchase field is required."
			},			
			coc_type 	: {
				required	: "Please Select Your COC Type."
			},
			status 	: {
				required	: "Please Select Your Payment Type."
			},
			internal_inv 	: {
				required	: "Internal In voice Number is required."
			},
			tracking_no 	: {
				required	: "Tracking Number is required."
			},
			purchase_type 	: {
				required	: "Please select user."
			},
			user_id 	: {
				required	: "Please select user."
			}
		},
		{
			ignore : []
		}
	);


	var options = {
		url 	: 	'<?php echo base_url()."admin/cocstatement/cocorders/index/DTCocOrder"; ?>',
		data 	: 	{admin_status : '<?php echo $closed_status; ?>'},
		columns : 	[
						{ "data": "id" },
						{ "data": "inv_id" },
						{ "data": "created_at" },
						{ "data": "status" },
						{ "data": "internal_inv" },
						{ "data": "user_id" },
						{ "data": "coc_type" },
						{ "data": "quantity" },
						{ "data": "delivery_type" },
						{ "data": "address" },
						{ "data": "tracking_no" },
						<?php if($closed_status!='closed'){ ?>
						{ "data": "action" }
						<?php } ?>
					],
					
	};
	<?php if($closed_status!='closed'){ ?>
	options['target']=	[11];
	options['sort'] =	'0';
	<?php } ?>
	options['order'] = [[0, 'desc']];
	ajaxdatatables('.datatables', options);

	// $(".order_cancelled").hide();
	// $(".comments, .order_cancelled").hide();
	allocation_show();
	cert_range_show();
	coc_type_show();

	$("input[name='purchase_type']").click(function(){
		coc_type_show();
	});

});

function coc_type_show(){
	purchase_type_val = $('input[name="purchase_type"]:checked').val();
	if(purchase_type_val==6){
		$('.electronic input').prop("checked",false);	
		$('.electronic input').attr('disabled',true);
	} else {
		$('.electronic input').removeAttr('disabled');		
	}
}

$("#plumber, #reseller").click(function(){
	userwrapper($(this).val())
});

// $('input[name="status"]').click(function(){
// 	allocation_show();
// })

// $('input[name="coc_type"]').click(function(){
// 	cert_range_show();
// })

function cert_range_show(){
	$('.cert_start_range, .cert_end_range').hide();
	paid_status = $('input[name="coc_type"]:checked').val();
	if(paid_status==2){
		$('.cert_start_range, .cert_end_range').show();
	}
}

function allocation_show(){
	$('.allocate_form').hide();
	paid_status = $('input[name="status"]:checked').val();
	if(paid_status==1){
		$('.allocate_form').show();
	}
}

function userwrapper(value){
	var title = (value==3) ? 'Plumber' : 'Reseller'; 
	$(".user_wrapper").removeClass('displaynone').find('label').text(title);
	$("#user_search, #user_id").val('');
}


$('#user_search').keyup(function(){
	
	var strlength = $.trim($('#user_search').val()).length;	
	if(strlength > 0)  {
		userautocomplete(["#user_search", "#user_id", "#user_suggestion"], [$(this).val(), $('[name="purchase_type"]:checked').val()], custom_user_select);
		console.log(strlength);
		$("#user_suggestion").show();
	}
	else{
		console.log(strlength);
		$("#user_suggestion").hide();
		$("#user_suggestion").html('');
	}
})

function custom_user_select(name, id, limit, electronic) {
	$("#user_limit").val(limit);
	$('#quantity').attr('max', limit);
	
	if(electronic=='1') $('.electronic_radio').parent().parent().show();
	else $('.electronic_radio').parent().parent().hide();
}


$('#comment_btn').click(function(){
	if($('#comment').val()!=''){
		add_comments();
	}
})

function add_comments()
{
	ajax('<?php echo base_url()."admin/cocstatement/cocorders/index/add_comments"; ?>', {'comment' : $('#comment').val(), 'order_id' : $('#order_id').val()}, comments_display);
}

function comments_display(data){	
	comments_txt = $('#comments').text();
	comment = $('#comment').val();
	new_line = '';
	if(comments_txt!=''){
		new_line = '\n';
	}
	comment_all = comments_txt+new_line+comment;
	$('#comments').text(comment_all);
}

$('#quantity').keyup(function(e){
	if(parseInt($(this).val()) > $('#user_limit').val()){
		$(this).val($('#user_limit').val())
	} 
})	

$(".coc_type").click(function(){
	deliverytype($(this).val())
});

function deliverytype(value){
	if(value==2){
		$('.delivery_type_wrapper').removeClass('displaynone');
	}else{
		$('.delivery_type_wrapper').addClass('displaynone');
	}
}

$(".delivery_type").change(function(){
	trackingno($(this).val())
});

function trackingno(value){
	if(value==1){
		$('.tracking_wrapper').addClass('displaynone');
	}else{
		$('.tracking_wrapper').removeClass('displaynone');
	}
}

$('.form').submit(function(){
	coccalculation();
})

function coccalculation(){
	var coctype = $('.coc_type:checked').val();
	var deliverytype = $('.delivery_type').val();
	var quantity = $('#quantity').val();
	
	var coctypeval = 0;
	if(coctype==1) coctypeval = parseFloat(cocelectronic) * quantity;
	else if(coctype==2) coctypeval = parseFloat(cocpaperwork) * quantity;
	
	var deliverytypeval = 0;
	if(coctype==2){
		if(deliverytype==1) deliverytypeval = parseFloat(collectedbypirb);
		else if(deliverytype==2) deliverytypeval = parseFloat(couriour);
		else if(deliverytype==3) deliverytypeval = parseFloat(postage);
	}
	
	var vat 	= parseFloat(vatpercentage);
	var vatval 	= 0;
	if(coctypeval!=0){
		vatval = parseFloat(((coctypeval + deliverytypeval) * vat)/100);
	}
	
	var totalval = parseFloat(coctypeval + deliverytypeval + vatval);
	
	$('#cost_value').val(currencyconvertor(coctypeval));
	$('#delivery_cost').val(currencyconvertor(deliverytypeval));
	$('#vat').val(currencyconvertor(vatval));
	$('#total_due').val(currencyconvertor(totalval));
}


</script>

