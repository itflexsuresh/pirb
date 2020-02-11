<?php

$id 			= '';
$userid		 			= $username['id'];
$VAT 					= $settings["vat_percentage"];
$coc_purchase_limit   	= $username["coc_purchase_limit"];
$electronic_coc_log   	= $username["coc_electronic"];
$cocpaperwork 			= $cocpaperwork["amount"];
$cocelectronic 			= $cocelectronic["amount"];

$postage 				= $postage["amount"];
$couriour 				= $couriour["amount"];
$collectedbypirb 		= $collectedbypirb["amount"];


?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Orders</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
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
						<div class="col-md-6">
							<div class="form-group">
								<label>Date of Order</label>
								<div class="input-group">
									<input type="text" autocomplete="off" class="form-control dob" name="created_at" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
								
							</div>

						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Order ID</label>
								<input type="text" class="form-control" name=""  readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Inv Number</label>
								<input type="text"class="form-control" name="inv_id" readonly>
							</div>

						</div>

						<div class="col-md-6">
							<div class="row add_top_value">
								<div class="col-md-3">
									<div class="custom-control custom-radio">
				                        <input type="radio" id="plumber" name="purchaser_type" class="custom-control-input" value="3">
				                        <label class="custom-control-label" for="plumber">Plumber</label>
				                    </div>
			                	</div>

			                	<div class="col-md-3">
				                    <div class="custom-control custom-radio">
				                        <input type="radio" id="reseller" name="purchaser_type" class="custom-control-input" value="6">
				                        <label class="custom-control-label" for="reseller">Reseller</label>
				                    </div>
				                </div>
			            	</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 plumber">
							<div class="form-group" >
								<label>Plumber</label>
								<input type="search" autocomplete="off" class="form-control" name="plumber_name" id="plumber_name">
								<div id="plumber_suggesstion" style="display: none;"></div>
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
							<input type="hidden" name="user_id" id="user_id">
							<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
						</div>

						<div class="col-md-6 reseller">
							<div class="form-group">
								<label>Reseller</label>
								<input type="search" autocomplete="off" class="form-control" name="reseller_name" id="reseller_name">
								<div id="reseller_suggestion" style="display: none;"></div>
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
							<input type="hidden" name="user_id_hide" id="user_id_hide" value="0">
							<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

						</div>
					</div>

					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Number of COC's Permitted to be allocated</label>
								<input type="text" class="form-control" id="user_limit" name="user_limit" readonly>
							</div>

							<div class="form-group">
								<label>Number Of COC's Requested</label>
									<input onchange="modifycost();" type="number" id="quantity" class="form-control" min="1" value="1" name="quantity" for="quantity">
								  
							</div>
						</div>
						
						<div class="col-md-6 comments">
							
							<div class="form-group coment_section">
								<label>Comments</label>
								<textarea class="form-control" id="comments" name="comments" disabled="" placeholder=""></textarea>
								<input type="text" class="form-control" placeholder="Type your Comment here" name="">
								<button type="button" name="comment_btn" value="" class="btn btn-primary">Add Comment</button>
							</div>
							
						</div>
					
					</div>

					<div class="row add_top_value">
						<h4 class="card-title add_left_value">Type of COC</h4>
						<div class="col-md-6">
							<div class="form-group">
								<div class="row mt_40">
									<div class="col-md-4">
										<label>Type of COC</label>		
									</div>

									<div class="col-md-8">
										<div class="row">
											<div class="col-md-5">
												<div class="custom-control custom-radio">
							                        <input type="radio" id="electronic" name="coc_type" class="custom-control-input" value="1">
							                        <label class="custom-control-label" for="electronic">Electronic</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="paper_based" name="coc_type" class="custom-control-input" value="2">
							                        <label class="custom-control-label" for="paper_based">Paper Based</label>
							                    </div>
							                </div>
						            	</div>
					            	</div>
					            </div>
				        	</div>
						</div>

						<div class="col-md-6 method">
							<div class="form-group" >
								<label>Method Of Delivery</label>
								<?php 
								echo form_dropdown('delivery_type', $deliverycard, '', ['id' => 'delivery_type', 'class' => 'form-control delivery_type']); 
								?>
							</div>
						</div>

						<input type="hidden" id="cost_f_delivery" class="form-control deliveryclass" name="cost_f_delivery">
								<input type="hidden" name="deliveryclass1" id="deliveryclass1" value="<?php echo $collectedbypirb; ?>">
								<input type="hidden" name="deliveryclass2" id="deliveryclass2" value="<?php echo $couriour; ?>">
								<input type="hidden" name="deliveryclass3" id="deliveryclass3" value="<?php echo $postage; ?>">
								<input type="hidden" id="coc_cost" class="form-control coc_cost" readonly name="coc_cost">
								<input type="hidden" id="vat" class="form-control" name="vat">
								<input type="hidden" id="totaldue" class="form-control" name="totaldue">


								<input type="hidden" id="dbvat" name="dbvat" value="<?php echo $VAT; ?>">
					<input type="hidden" id="dbcocpaperwork" name="dbcocpaperwork" value="<?php echo $cocpaperwork; ?>">
					<input type="hidden" id="dbcocelectronic" name="dbcocelectronic" value="<?php echo $cocelectronic; ?>">

						<div class="col-md-6">
							<div class="form-group">
								<div class="row mt_40">
									<div class="col-md-4">
										<label>Payment Status</label>
									</div>
								
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-5">
												<div class="custom-control custom-radio">
							                        <input type="radio" id="paid" name="status" class="custom-control-input" value="1">
							                        <label class="custom-control-label" for="paid">Paid</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="unpaid" name="status" class="custom-control-input" value="0">	
							                        <label class="custom-control-label" for="unpaid">Unpaid</label>
							                    </div>
							                </div>
						            	</div>
						            </div>
					        	</div>
				        	</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Internal Acc Invocie Number</label>
								<input type="text" autocomplete="off" class="form-control" name="internal_inv">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Tracking No</label>
								<input type="text" autocomplete="off" class="form-control" name="tracking_no">
							</div>
						</div>

						<div class="col-md-12" >
							<div class="row">
								<div class="col-md-6 order_cancelled">
									<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="email_notifi" name="order_canceld">
				                            <label class="custom-control-label" for="email_notifi">Order Cancelled</label>
			                        </div>
		                    	</div>

		                    	<div class="col-md-6 text-right">
		                    		<button type="submit" name="" value="" class="btn btn-primary">Update/Add</button>
		                    	</div>
	                    	</div>
						</div>
					
				</div>
				

						<div class="col-md-6 mt_20">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="sms_notifi" name="sms_track">
		                            <label class="custom-control-label" for="sms_notifi">Send a SMS Tracking Notification</label>
		                        </div>

		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="email_trak_notifi" name="email_track">
		                            <label class="custom-control-label" for="email_trak_notifi">Send an Email Tracking Notifiation</label>
		                        </div>
							</div>
						</div>
					</form>

					<form>

					<div class="row mt_20" style="display:none">
						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate Start Range</label>
								<select name="designation" class="form-control">
									<option value="1">Select from COC data range</option>
								</select>
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="start_notifi">
		                            <label class="custom-control-label" for="start_notifi">Send a SMS COC Allocation Notification</label>
		                        </div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate End Range</label>
								<select name="designation" class="form-control">
									<option value="1">Select from COC data range</option>
								</select>
								<div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="end_notifi">
		                            <label class="custom-control-label" for="end_notifi">Send an Email Tracking Notifiation</label>
		                        </div>
							</div>
						</div>
						<div class="row text-right">
							<button type="submit" name="submit" value="submit" class="btn btn-primary">Allocate Certificates</button>
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
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>


				</div>	
			</form>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	datepicker('.dob');

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
				required	: true,
			},

			
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
		}
	);



	var options = {
		url 	: 	'<?php echo base_url()."admin/cocmanagement/cocmanagementstatement/coc_orders/cocorderType"; ?>',
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
		{ "data": "action" }
		]
	};
	ajaxdatatables('.datatables', options);


	$(".plumber, .reseller, .method, .comments, .order_cancelled").hide();
});


$("#plumber").click(function(){
	$(".plumber").show();
	$(".reseller").hide();
	$('#plumber_name, #reseller_name').val('');
});


$("#reseller").click(function(){
	$(".reseller").show();
	$(".plumber").hide();
	$('#plumber_name, #reseller_name').val('');
});


$("#paper_based").click(function(){
	$(".method").show();
});

$("#electronic").click(function(){
	$(".method").hide();
});

$('#plumber_name, #reseller_name').keyup(function(){
	search_func($(this).val())
})

function search_func(value)
{
	ajax('<?php echo base_url()."admin/cocmanagement/cocmanagementstatement/coc_orders/userDetails"; ?>', {'search_keyword' : value,type:$('[name="purchaser_type"]:checked').val()}, search_func_result);
}

function search_func_result(data){
	console.log(data)
	$("#plumber_suggesstion").html('');
	$("#reseller_suggestion").html('');
    $("#plumber_suggesstion").show();
    $("#reseller_suggestion").show();
	$("#plumber_suggesstion").html(data);
	$("#reseller_suggestion").html(data);
	$("#plumber_name").css("background","#FFF");
	$("#reseller_name").css("background","#FFF");
}

function selectuser(val,id,limit) {
	$("#plumber_name").val(val);
	$("#plumber_suggesstion").hide();
	$("#user_id").val(id);
	$("#reseller_name").val(val);
	$("#reseller_suggestion").hide();
	$("#user_id_hide").val(id);
	$("#user_limit").val(limit);
	$('#quantity').attr('max', limit);
}

$('#quantity').keyup(function(e){
	if($(this).val() > $('#user_limit').val()){
		$(this).val($('#user_limit').val())
	} 
})	
</script>

