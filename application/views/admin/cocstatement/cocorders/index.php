<?php
$vat 					= $settings["vat_percentage"];
$cocpaperwork 			= $cocpaperwork["amount"];
$cocelectronic 			= $cocelectronic["amount"];
$postage 				= $postage["amount"];
$couriour 				= $couriour["amount"];
$collectedbypirb 		= $collectedbypirb["amount"];

$created_at 			= (isset($result['created_at']) && date('d-m-Y', strtotime($result['created_at']))!='01-01-1970') ? date('d-m-Y', strtotime($result['created_at'])) : '';

$coc_type 				= isset($result['coc_type']) ? $result['coc_type'] : '';
$id 					= isset($result['id']) ? $result['id'] : '';
$inv_id 				= isset($result['inv_id']) && $result['created_by']!='' ? $result['inv_id'] : '';
$delivery_type 			= isset($result['delivery_type']) ? $result['delivery_type'] : '';
$quantity 				= isset($result['quantity']) ? $result['quantity'] : '1';
$internalinv 			= isset($result['internal_inv']) ? $result['internal_inv'] : '';
$trackingno 			= isset($result['tracking_no']) ? $result['tracking_no'] : '';
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

$allocate_start			= isset($stock['id']) ? $stock['id'] : 0;
$allocate_end			= ($allocate_start>0) ? ($allocate_start+$quantity)-1 : 0;

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

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<form class="form" method="post">
					<h4 class="card-title">COC Orders</h4>
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
						<div class="col-md-6">
							<div class="form-group">
								<label>Inv Number</label>
								<input type="text"class="form-control" name="inv_id" value="<?php echo $inv_id; ?>" readonly>
							</div>
						</div>
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
					<div class="row user_wrapper <?php if(!isset($id)){ echo 'displaynone'; } ?>">
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
								<label>Number of COC's Permitted to be allocated</label>
								<input type="text" class="form-control" id="user_limit" name="user_limit" readonly value="<?php echo $count; ?>">
							</div>
							<div class="form-group">
								<label>Number Of COC's Requested</label>
								<input type="number" id="quantity" class="form-control" min="<?php echo $quantity; ?>" value="<?php echo $quantity; ?>" name="quantity" for="quantity">							  
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

					<div class="row add_top_value">
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
											?>
													<div class="col-md-5">
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
						<div class="col-md-12 tracking_wrapper <?php  if(!isset($deliverytype) || $delivery_type=='1'){ echo 'displaynone'; } else { echo ''; }  ?>">
							<div class="form-group col-md-6 row">
								<label>Tracking No</label>
								<input type="text" autocomplete="off" class="form-control" name="tracking_no" value="<?php echo $trackingno; ?>">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="sms_notifi" name="sms_track" value="1">
									<label class="custom-control-label" for="sms_notifi">Send a SMS Tracking Notification</label>
								</div>

								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="email_trak_notifi" name="email_track" value="1">
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
		                    	<div class="col-md-12 row">
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

				<form method="POST">
					<div class="row mt_20 <?php if($id!=''){}else {echo 'displaynone'; }?>">
						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate Start Range</label>
								<input type="text" value="<?php echo $allocate_start; ?>" disabled>
								<input type="hidden" name="allocate_start" value="<?php echo $allocate_start; ?>">
								<!-- <select name="designation" class="form-control">
									<option value="1">Select from COC data range</option>
								</select> -->
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="start_notifi">
		                            <label class="custom-control-label" for="start_notifi">Send a SMS COC Allocation Notification</label>
		                        </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate End Range</label>
								<input type="text" value="<?php echo $allocate_end; ?>" disabled>
								<input type="hidden" name="allocate_end" value="<?php echo $allocate_end; ?>">
								<!-- <select name="designation" class="form-control">
									<option value="1">Select from COC data range</option>
								</select> -->
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="end_notifi">
		                            <label class="custom-control-label" for="end_notifi">Send an Email Tracking Notifiation</label>
		                        </div>
							</div>
						</div>
						<div class="row text-right">
							<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
							<input type="hidden" class="form-control" name="order_id" id="order_id" value="<?php echo $id; ?>">
							<input type="hidden" name="coc_type" value="<?php echo $coc_type; ?>">
							<button type="submit" name="allocate_certificate" value="submit" class="btn btn-primary">Allocate Certificates</button>
						</div>
					</div>					
				</form>

				<div class="row add_top_value add_scroll">
					<div class="row mb_20">
						<a href="#" class="active_link_btn">PENDING</a>
						<a href="#" class="archive_link_btn">CLOSED</a>
					</div>
				</div>				
			</div>
			
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-striped datatables fullwidth">
					<thead>
						<tr>
							<th>OrderID</th>
							<!-- <th>Inv Number</th>
							<th>Date of order</th>
							<th>Payment Status</th>
							<th>Internal Inv Number</th>
							<th>Plumber Name and Surname/Reseller</th>
							<th>COC Type</th>
							<th>Total COC</th>
							<th>Delivery Method</th>
							<th>Delivery Address</th>
							<th>Tracking Number</th>
							<th>Action</th> -->
						</tr>
					</thead>
				</table>
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
				required	: "Number of COC wish to Purchase field is required."
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
		columns : 	[
						{ "data": "id" },
						// { "data": "inv_id" },
						// { "data": "created_at" },
						// { "data": "status" },
						// { "data": "internal_inv" },
						// { "data": "user_id" },
						// { "data": "coc_type" },
						// { "data": "quantity" },
						// { "data": "delivery_type" },
						// { "data": "address" },
						// { "data": "tracking_no" },
						// { "data": "action" }
					]
	};
	
	ajaxdatatables('.datatables', options);

	// $(".order_cancelled").hide();
	// $(".comments, .order_cancelled").hide();
});


$("#plumber, #reseller").click(function(){
	userwrapper($(this).val())
});

function userwrapper(value){
	var title = (value==3) ? 'Plumber' : 'Reseller'; 
	$(".user_wrapper").removeClass('displaynone').find('label').text(title);
	$("#user_search, #user_id").val('');
}

$('#user_search').keyup(function(){
	user_search($(this).val())
})



function user_search(value)
{
	ajax('<?php echo base_url()."admin/cocstatement/cocorders/index/userDetails"; ?>', {'search_keyword' : value, type : $('[name="purchase_type"]:checked').val()}, user_search_result);
}

function user_search_result(data)
{
	var result = [];
	
	$(data).each(function(i, v){
		var fn = "user_select('"+v.name+"', '"+v.id+"', '"+v.count+"', '"+v.coc_electronic+"')";
		result.push('<li onclick="'+fn+'">'+v.name+'</li>');
	})
	
	var append = '<ul class="autocomplete_list">'+result.join('')+'</ul>';
	$("#user_suggestion").html('').removeClass('displaynone').html(append);
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

function user_select(name, id, limit, electronic) {
	$("#user_suggestion").html('');
	$("#user_search").val(name);
	$("#user_id").val(id);
	$("#user_limit").val(limit);
	$('#quantity').attr('max', limit);
	
	if(electronic=='1') $('.electronic_radio').parent().parent().show();
	else $('.electronic_radio').parent().parent().hide();
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
	
	$('#cost_value').val(coctypeval.toFixed(2));
	$('#delivery_cost').val(deliverytypeval.toFixed(2));
	$('#vat').val(vatval.toFixed(2));
	$('#total_due').val(totalval.toFixed(2));
}


</script>

