<?php
$dob = isset($result['dob']) && $result['dob']!='1970-01-01' ? date('d-m-Y', strtotime($result['dob'])) : '';
$file1 = isset($result['file1']) ? $result['file1'] : '';
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">COC Status</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">COC Status</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form" method="post">

					<h4 class="card-title">COC Status</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Certificate No</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>COC Type</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>COC Status</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Audit Status</label>
								<input type="text" class="form-control" name="">
							</div>
						</div>
					</div>

					<h5 class="card-title add_top_value">Reseller Details</h5>
					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" name="">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Date and Time of Allocation to Plumber:</label>
							<input type="text" class="form-control" name="">
						</div>
					</div>

						<div class="col-md-6">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" name="">
						</div>
					</div>
                 </div>

					<h5 class="card-title add_top_value">Plumber Details</h5>
					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label>Registration Number</label>
							<input type="text" class="form-control" name="">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Name and Surname:</label>
							<input type="text" class="form-control" name="">
						</div>
					</div>

						<div class="col-md-6">
						<div class="form-group">
							<label>Current Status:</label>
							<input type="text" class="form-control" name="">
						</div>
					</div>
					</div>

                   	<div class="row add_top_value">
                   		<div class="col-md-5">
							<h5 class="card-title add_left_value">COC Details</h5>
						</div>

						<div class="col-md-5">
							<a href="#">View COC Details in full</a>
						</div>
					</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label>Date and Time of Logging COC:</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				    <div class="col-md-6">
						<div class="form-group">
						<label>Certificate No</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				    <div class="col-md-6">
						<div class="form-group">
						<label>Plumbing Work Completion Date</label>
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
						<label>Owners Name</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				<div class="col-md-6">
						<div class="form-group">
						<label>Name of Complex/Flat (if applicable)</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				<div class="col-md-6">
						<div class="form-group">
						<label>Street</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				<div class="col-md-6">
						<div class="form-group">
						<label>Number</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>
			</div>
               
               <div class="row">
				<div class="col-md-4">
						<div class="form-group">
						<label>Owners Name</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				<div class="col-md-4">
						<div class="form-group">
						<label>City</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				<div class="col-md-4">
						<div class="form-group">
						<label>Suburb</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				</div>

               <div class="row">

               	<div class="col-md-6">
						<div class="form-group">
						<label>Contact Mobile</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>

				<div class="col-md-6">
						<div class="form-group">
						<label>Alternate Contact</label>
						<input type="text" class="form-control" name="">
					</div>
				</div>
			</div>

						
	             <div class="row add_top_value">
	             	<h5 class="card-title add_left_value">Diary of Activities and Comments</h5>
	             	<div class="col-md-12">
	         			<textarea type="text" class="form-control" id="message" name="message"></textarea>
	             	</div>

	             	<div class="col-md-6">
	             		<div class="form-group">
	             			<label></label>
	             			<input type="text" class="form-control" placeholder="Type your Comment here" name="">
	             		</div>
	             	</div>

	             	<div class="col-md-4 mt_20">
	             		<button type="submit" name="submit" value="submit" class="btn btn-primary">Add Comment</button>
	             	</div>
	             </div>


	             <div class="row add_top_value">
	             	<h4 class="card-title add_left_value">Reallocate/Cancel a COC</h4>
	             	<div class="col-md-6">
	             		<div class="form-group">
							<label>Reseller</label>
							<input type="search" class="form-control" name="plumber_reseller">
							<div class="search_icon">
								<i class="fa fa-search" aria-hidden="true"></i>
							</div>
						</div>
	             	</div>

	             	<div class="col-md-6">
	             		<div class="form-group">
							<label>Plumber</label>
							<input type="search" class="form-control" name="plumber_reseller">
							<div class="search_icon">
								<i class="fa fa-search" aria-hidden="true"></i>
							</div>
						</div>
	             	</div>

	             	<div class="col-md-3">
	             		<div class="custom-control custom-checkbox">
	                            <input type="checkbox" class="custom-control-input" id="cancel_coc" name="order_canceld">
	                            <label class="custom-control-label" for="cancel_coc">Cancel COC</label>
                        </div>
	             	</div>
             	</div>

             	<div class="row add_top_value">
             		<div class="col-md-12">
             			<h4 class="card-title mb_0">Reason Canceling COC</h4>
             		</div>

	             	<div class="col-md-2">
	             		<div class="form-group">
	             			<label></label>
	             			<div class="custom-control custom-radio">
		                        <input type="radio" id="lost" name="status" class="custom-control-input">
		                        <label class="custom-control-label" for="lost">Lost</label>
		                    </div>
	             		</div>
	             	</div>

	             	<div class="col-md-2">
	             		<div class="form-group">
	             			<label></label>
	             			<div class="custom-control custom-radio">
		                        <input type="radio" id="stolen" name="status" class="custom-control-input">
		                        <label class="custom-control-label" for="stolen">Stolen</label>
		                    </div>
	             		</div>
	             	</div>

	             	<div class="col-md-2">
	             		<div class="form-group">
	             			<label></label>
	             			<div class="custom-control custom-radio">
		                        <input type="radio" id="destroyed" name="status" class="custom-control-input">
		                        <label class="custom-control-label" for="destroyed">Destroyed</label>
		                    </div>
	             		</div>
	             	</div>
	             </div>

	             <div class="row">
	             	<div class="col-md-6">
	             		<div class="form-group">
							<div class="photo_upload">
								<img style="margin-left: 20px;" src="<?php echo base_url()?>assets/images/profile.jpg" class="photo_image" width="100">
							</div>
							<input type="file" id="cancel_document" class="photo_file" data-multiple-caption="{count} files selected" multiple="">
							<label for="cancel_document" class="choose_file">Add File/Images</label>
							<input type="hidden" name="image2" class="photo" value="">
							<p>(Image/File Size Smaller than 5mb)</p>
						</div>
	             	</div>
	             </div>


					<div class="row text-right">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Cancel/Reallocate</button>
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