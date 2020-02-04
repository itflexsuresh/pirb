<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
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
									<input type="text" class="form-control dob" name="dob" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Order ID</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Inv Number</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="row add_top_value">
								<div class="col-md-3">
									<div class="custom-control custom-radio">
				                        <input type="radio" id="plumber" name="plumber" class="custom-control-input">
				                        <label class="custom-control-label" for="plumber">Plumber</label>
				                    </div>
			                	</div>

			                	<div class="col-md-3">
				                    <div class="custom-control custom-radio">
				                        <input type="radio" id="reseller" name="reseller" class="custom-control-input">
				                        <label class="custom-control-label" for="reseller">Reseller</label>
				                    </div>
				                </div>
			            	</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber</label>
								<input type="search" class="form-control" name="">
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Reseller</label>
								<input type="search" class="form-control" name="">
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
								<input type="text" class="form-control" name="">
							</div>

							<div class="form-group">
								<label>Number Of COC's Requested</label>
								<input type="number" class="form-control" name="">
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
							                        <input type="radio" id="electronic" name="electronic" class="custom-control-input">
							                        <label class="custom-control-label" for="electronic">Electronic</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="paper_based" name="paper_based" class="custom-control-input">
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
								<select name="designation" class="form-control">
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
							                        <input type="radio" id="paid" name="paid" class="custom-control-input">
							                        <label class="custom-control-label" for="paid">Paid</label>
							                    </div>
						                	</div>

						                	<div class="col-md-5">
							                    <div class="custom-control custom-radio">
							                        <input type="radio" id="unpaid" name="unpaid" class="custom-control-input">
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
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Tracking No</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="custom-control custom-checkbox">
				                            <input type="checkbox" class="custom-control-input" id="email_notifi">
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
		                            <input type="checkbox" class="custom-control-input" id="sms_notifi">
		                            <label class="custom-control-label" for="sms_notifi">Send a SMS Tracking Notification</label>
		                        </div>

		                        <div class="custom-control custom-checkbox">
		                            <input type="checkbox" class="custom-control-input" id="email_trak_notifi">
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

						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th style="text-align: center;">OrderID</th>
								<th style="text-align: center;">Inv Number</th>
								<th style="text-align: center;">Date of order</th>
								<th style="text-align: center;">Payment Status</th>
								<th style="text-align: center;">Internal Inv Number</th>
								<th style="text-align: center;">Plumber Name and Surname/Reseller</th>
								<th style="text-align: center;">COC Type</th>
								<th style="text-align: center;">Total COC</th>
								<th style="text-align: center;">Delivery Method</th>
								<th style="text-align: center;">Delivery Address</th>
								<th style="text-align: center;">Tracking Number</th>
								<th style="text-align: center;"></th>
							</tr>
							<tr>
								<td>23226</td>
								<td></td>
								<td>21-12-02</td>
								<td>Not Paid</td>
								<td></td>
								<td>SAM Smit</td>
								<td>COC - Paper</td>
								<td>1</td>
								<td>courier</td>
								<td>144 Eland st, Wierdpark</td>
								<td>Not Paid</td>
								<td>
									<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" aria-describedby="tooltip477736"><i class="fa fa-pencil-alt"></i></a>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" aria-describedby="tooltip477736"><i class="fa fa-pencil-alt"></i></a>
								</td>
							</tr>
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