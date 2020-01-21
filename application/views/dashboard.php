<?php
$user_role = $this->session->userdata('usrrole');

if($user_role=='1'){
	echo "Hello Admin"; ?>
	<h1>DASHBOARD</h1>
	<div class="widget" style="width:90%">
		<a href="#">Dashboard</a><br/>
		<a href="../../sub_types/view" target="_blank">Installation type</a><br/>
		<a href="../../sub_types/view" target="_blank">Sub types</a><br/>								
		<a href="../../manage_area/view" target="_blank">Manage Area</a><br/>
		<a href="../../system_users/view" target="_blank">Admin System Users</a><br/>
		<a href="../../rates/view/" target="_blank">Rates</a><br/>
		<a href="../../settings/view" target="_blank">Settings</a><br/>
		<a href="../../message/view/" target="_blank">Global message</a><br/>
		<a href="../../get_company/view" target="_blank">Company list</a><br/>
		<a href="../../plumber/list" target="_blank">Plumber New applications</a><br/>
	</div>
<?php
}elseif($user_role=='2'){
	echo "hii plumber"; ?>
	<h1>DASHBOAR</h1>
	<div class="widget" style="width:90%">
		<a href="#">Dashboard</a><br/>
		<a href="#">Purchase COC</a><br/>
		<a href="#">COC Statement</a><br/>
		<a href="#">Audit Review</a><br/>
		<a href="#">My Accounts</a><br/>
		<a href="#">My CPD</a><br/>
		<a href="#">My Apprentice Mantees</a><br/>
		<a href="#">Performance Status</a><br/>
		<a href="#">Registration Details</a><br/>
		<a href="#">System Message</a><br/>
	</div>
<?php
}elseif($user_role=='3'){
	echo "hii auditor"; ?>
	<h1>DASHBOAR</h1>
		<div class="widget" style="width:90%">
		<a href="#">Dashboard</a><br/>
		<a href="#">Audit Statement</a><br/>
		<a href="#">Accounts</a><br/>
		<a href="#">My Report Listing</a><br/>
		
</div>
<?php
}elseif($user_role=='5'){
	echo "hii company"; ?>
		<h1>DASHBOAR</h1>
		<div class="widget" style="width:90%">
		<a href="#">Dashboard</a><br/>
		<a href="#">COC Management</a><br/>
		<a href="#">COC Statement</a><br/>
		<a href="#">Accounts</a><br/>
		<a href="#">Employee Listing</a><br/>
		<a href="#">Company Details</a><br/>
		<a href="#">Company Development Activities</a><br/>
		<a href="#">System Message</a><br/>
		
</div>
<?php
}elseif($user_role=='4'){
	echo "hii reseller"; ?>
		<h1>DASHBOAR</h1>
		<div class="widget" style="width:90%">
		<a href="#">Dashboard</a><br/>
		<a href="#">COC Statement</a><br/>
		<a href="#">Allocate COC</a><br/>
		<a href="#">Purchase COC</a><br/>
		<a href="#">My Accounts</a><br/>
		
</div>
<?php
}


?>


<a href="<?php echo base_url(); ?>Login/logout">Logout</a>