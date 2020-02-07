<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">CPD Activity Form</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">CPD Activity Form</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">CPD Activity Form</h4>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>PIRB CPD Activity</label>
								<input type="search" class="form-control" name="">
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Plumber Name and Surname</label>
								<div class="input-group">
									<input type="text" class="form-control" name="" value="">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>PIRB CPD Activity</label>
								<input type="search" class="form-control" name="">
								<div class="search_icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>The Date on which the Activity took place or started</label>
								<div class="input-group">
									<input type="text" class="form-control dob" name="dob" value="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="icon-calender"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Comments</label>
								<textarea class="form-control" id="comments" name="comments" placeholder=""></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Supporting Document</label>
								<div class="form-group">
									<div class="uploaded_img">
										<img src="<?php echo base_url()?>/assets/images/profile.jpg" class="document_image" width="100">
									</div>
									<input type="file" id="supporting" class="document_file">
									<label for="supporting" class="choose_file">Add File/Images</label>
									<input type="hidden" name="image1" class="document" value="">
									<p>(Image/File Size Smaller than 5mb)</p>
								</div>
							</div>
						</div>

						<div class="col-md-8">
							<div class="custom-control custom-checkbox add_top_value">
                                <input type="checkbox" class="custom-control-input" id="info_text">
                                <label class="custom-control-label" for="info_text">I declare that the information contained in this CPD Activity form is complete, accurate and true.  I further decalre that I understadn that I must keep verifiable evidence of all the CPD activities for at least 2 years and the PRIB may conduct a random audit of my activity(s) which would require me to submit the evidence to the PIRB.</label>
                            </div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Activity Points</label>
							<input type="number" class="form-control" name="">
						</div>

						<div class="col-md-6">
							<label>CPD Stream</label>
							<select name="" id="" class="form-control">
								<option value="" selected="selected">Developmental</option>
								<option value="0">Work-based</option>
								<option value="1">Individual</option>
							</select>
						</div>
					</div>

					<div class="row add_top_value">
						<div class="col-md-12">
							<div class="form-group">
								<h4 class="card-title">CPD Activity Approval Status</h4>
								<div class="row">
									<label></label>
									<div class="col-md-2">
					                    <div class="custom-control custom-radio">
					                        <input type="radio" id="activity" name="status" class="custom-control-input">
					                        <label class="custom-control-label" for="activity">Approve</label>
					                    </div>
				                    </div>

				                    <div class="col-md-2">
					                    <div class="custom-control custom-radio">
					                        <input type="radio" id="rejected" name="status" class="custom-control-input">
					                        <label class="custom-control-label" for="rejected">Rejected</label>
					                    </div>
				                    </div>

				                    <div class="col-md-12 mt_40">
			                			<label>Admin Comments</label>
			                			<textarea class="form-control" id="admin_comments" name="admin_comments" placeholder=""></textarea>
			                		</div>
			                	</div>
							</div>
						</div>
					</div>

					<div class="row text-right">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Update/Add</button>
					</div>

					<div class="row add_top_value">
						<div class="col-md-12">
							<h4 class="card-title mb_20">CPD Activity Queue</h4>
						</div>

						<div class="col-md-12 mt_20 mb_20 ">
							<a href="#" style="margin-left: 0px;" class="active_link_btn">PENDING</a>
							<a href="#" class="archive_link_btn">COMPLETED</a>
						</div>

						<table class="table table-bordered table-striped datatables fullwidth">
							<tr>
								<th style="text-align: center;">Date</th>
								<th style="text-align: center;">Name & Surname</th>
								<th style="text-align: center;">Activity</th>
								<th style="text-align: center;">Points</th>
								<th style="text-align: center;">Status</th>
								<th style="text-align: center;"></th>
							</tr>
							<tr>
								<td>19-03-09</td>
								<td>Shaugn Fray</td>
								<td>0001/10</td>
								<td>dfasdfasd</td>
								<td>5</td>
								<td>
									<div style="text-align: center;" class="table-action">
										<a href="#"><i class="fa fa-pencil-alt"></i></a>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
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