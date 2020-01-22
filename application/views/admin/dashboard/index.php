<ol class="breadcrumb">
	<li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
	<div class="col-12">
		<h1>Dashboard</h1>
		
		<div class="row">
			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-primary o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-globe"></i>
						</div>
					<div class="mr-5">Customers</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo base_url().'admin/customers'; ?>">
						<span class="float-left">View Details</span>
						<span class="float-right">
							<i class="fa fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-danger o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-users"></i>
						</div>
					<div class="mr-5">Profile</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo base_url().'admin/profile/updateprofile'; ?>">
						<span class="float-left">View Details</span>
						<span class="float-right">
							<i class="fa fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-warning o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-users"></i>
						</div>
					<div class="mr-5">Change Password</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo base_url().'admin/profile/changepassword'; ?>">
						<span class="float-left">View Details</span>
						<span class="float-right">
							<i class="fa fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>
		</div>
		
	</div>
</div>