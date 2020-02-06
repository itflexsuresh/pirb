<?php
// $dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
// $file1 = isset($result['file1']) ? $result['file1'] : '';

// if(isset($result) && $result){
// 	$id 			= $result['id'];
// 	$name 			= (set_value('name')) ? set_value('name') : $result['name'];
// 	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
// 	$heading		= 'Update';
// }else{
// 	$id 			= '';
// 	$order_id		= set_value('order_id');
// 	$name			= set_value('name');
// 	$status			= set_value('status');
// 	$name			= set_value('name');
// 	$status			= set_value('status');
// 	$heading		= 'Add';
// }

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
									<input type="text" class="form-control dob" name="created_at" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Order ID</label>
								<input type="text" class="form-control" name="order_id">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Inv Number</label>
								<input type="text" class="form-control" name="inv_id">
							</div>
						</div>

						<div class="col-md-6">
							<div class="row add_top_value">
								<div class="col-md-3">
									<div class="custom-control custom-radio">
				                        <input type="radio" id="plumber" name="purchaser_type" class="custom-control-input">
				                        <label class="custom-control-label" for="plumber">Plumber</label>
				                    </div>
			                	</div>

			                	<div class="col-md-3">
				                    <div class="custom-control custom-radio">
				                        <input type="radio" id="reseller" name="purchaser_type" class="custom-control-input" value="plumber">
				                        <label class="custom-control-label" for="reseller">Reseller</label>
				                    </div>
				                </div>
			            	</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group" display="none">
								<label>Plumber</label>
								<input type="search" class="form-control" name="plumber_reseller">
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Reseller</label>
								<input type="search" class="form-control" name="plumber_reseller">
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Number of COC's Permitted to be allocated</label>
								<input type="text" class="form-control" name="coc_permited">
							</div>

							<div class="form-group">
								<label>Number Of COC's Requested</label>
								<input type="number" class="form-control" name="coc_request">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group coment_section">
								<label>Comments</label>
								<textarea class="form-control" id="comments" name="comments" disabled="" placeholder=""></textarea>
								<input type="text" class="form-control" placeholder="Type your Comment here" name="">
								<button type="submit" name="comment_btn" value="comment_btn" class="btn btn-primary">Add Comment</button>
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
							                        <input type="radio" id="electronic" name="coc_type" class="custom-control-input">
							                        <label class="custom-control-label" for="electronic">Electronic</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="paper_based" name="coc_type" class="custom-control-input">
							                        <label class="custom-control-label" for="paper_based">Paper Based</label>
							                    </div>
							                </div>
						            	</div>
					            	</div>
					            </div>
				        	</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Method Of Delivery</label>
								<select name="delivary_type" class="form-control">
									<option value="1">Collect form PIRB</option>
									<option value="2">By Courier</option>
									<option value="3">By Registered Post</option>
								</select>
							</div>
						</div>

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
							                        <input type="radio" id="paid" name="status" class="custom-control-input">
							                        <label class="custom-control-label" for="paid">Paid</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="unpaid" name="status" class="custom-control-input">
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
								<input type="text" class="form-control" name="Internal_inv">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Tracking No</label>
								<input type="text" class="form-control" name="tracking_no">
							</div>
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="email_notifi" name="order_canceld">
				                            <label class="custom-control-label" for="email_notifi">Order Cancelled</label>
			                        </div>
		                    	</div>

		                    	<div class="col-md-6 text-right">
		                    		<button type="submit" name="comment_btn" value="comment_btn" class="btn btn-primary">Update/Add</button>
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
					</div>

					<div class="row mt_20">
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
					</div>

					<div class="row text-right">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Allocate Certificates</button>
					</div>


					<div class="row add_top_value add_scroll">
						<div class="row mb_20">
							<a href="#" class="active_link_btn">PENDING</a>
							<a href="#" class="archive_link_btn">CLOSED</a>
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
	datepicker('.skill_date');
})
</script>
<script type="text/javascript">
$(function(){
		
		var options = {
			url 	: 	'<?php echo base_url()."admin/cocmanagement/cocmanagementstatement/Coc_orders/CocorderType"; ?>',
			columns : 	[
			{ "data": "order_id" },
			{ "data": "inv_id" },
			{ "data": "created_at" },
			{ "data": "status" },
			{ "data": "Internal_inv" },
			{ "data": "user_id" },
			{ "data": "coc_type" },
			{ "data": "coc_purchase" },
			{ "data": "delivery_type" },
			{ "data": "address" },
			{ "data": "tracking_no" },
			{ "data": "action" }
			]
		};
		ajaxdatatables('.datatables', options);
		});
		</script>

<script type="text/javascript">

$("#hide").click(function(){
  $("p").hide();
});

$("#show").click(function(){
  $("p").show();
});
		</script>