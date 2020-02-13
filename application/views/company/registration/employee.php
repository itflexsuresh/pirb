<?php // admin company edit view file 
if(isset($edit)){
	 foreach ($edit as $key=>$value) {
		  if($value['id']){
			   $id 					= isset($value['id']) ? $value['id'] : '';
			   $company_name 		= isset($value['company_name']) ? $value['company_name'] : ''; 
			   $company_message 	= isset($value['comments']) ? $value['comments'] : ''; 
			   $reg_no 				= isset($value['reg_no']) ? $value['reg_no'] : ''; 
			   $vat_no 				= isset($value['vat_no']) ? $value['vat_no'] : ''; 
			   $contact_person 		= isset($value['contact_person']) ? $value['contact_person'] : ''; 
			   $mobile_phone 		= isset($value['mobile_phone']) ? $value['mobile_phone'] : ''; 
			   $work_phone 			= isset($value['work_phone']) ? $value['work_phone'] : ''; 
			   $email 				= isset($value['email']) ? $value['email'] : ''; 
			   $user_id 			= isset($value['user_id']) ? $value['user_id'] : ''; 
			   $work_type 			= isset($value['work_type']) ? explode(',',$value['work_type']) : ''; 
			   $specialisations 	= isset($value['specialisations']) ? explode(',',$value['specialisations']) : ''; 
			   $date 				= date("d-m-Y", strtotime($register_date['created_at'])); 
			   $email 				= isset($register_date['email']) ? $register_date['email'] : ''; 
			   $status 				= isset($value['status']) ? $value['status'] : ''; 
			} 
			} if(isset($id)){
				 foreach ($user_detail as $key => $result) {
					  if($result['type']==1){
						   $address1 = $result['address']; 
							$suburb1 = $result['suburb']; $city1 = $result['city']; $province1 = $result['province']; 
						}
						elseif ($result['type']==2) {
							 $address2 = $result['address']; $suburb2 = $result['suburb']; $city2 = $result['city']; $province2 = $result['province']; $postal_code2 = $result['postal_code']; 
						}
				 } 
			} 
		} 
// echo '<pre>';
// print_r($edit);
// die;

?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Employee Details</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Company Details</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>

<!-- 				<div class="col-md-12">
					<a href="javascript:void(0);" id="previous">Previous</a>
					<a href="javascript:void(0);" id="next">Next</a>
				</div> -->
<!-- 								<div class="steps active" data-id="1">
					<h4 class="card-title">Registered Company Details</h4>
				</div> -->


				<div class="table-responsive m-t-40">
					<table class="table table-bordered table-striped datatables fullwidth">
						<thead>
							<tr>
								<th>Registration Number</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Plumbers Name and Surname</th>
								<th>CPD Status</th>
								<th>Performance Status</th>
								<th>Overall Industry Rating</th>
								<th>View</th>
							</tr>
						</thead>
					</table>
				</div>
			
			
		</div>	
<script type="text/javascript">
$(function(){
	checkstep();
})

$('#next').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))+1;		
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	checkstep();
})

$('#previous').click(function(){
	var step = parseInt($('.steps.active').attr('data-id'))-1;
	$('.steps.active').addClass('displaynone').removeClass('active');
	$('.steps[data-id="'+step+'"]').removeClass('displaynone').addClass('active');
	
	checkstep();
})

function checkstep(){
	$('#next, #previous').removeClass('displaynone');
	
	var step = $('.steps.active').attr('data-id');
		
	if(step=='1'){
		$('#previous').addClass('displaynone');
	}else if(step=='2'){
		$('#next').addClass('displaynone');
	}
}
$(function(){
	var id = "<?php echo $id ?>"
	var options = {
			url 	: 	'<?php echo base_url()."company/registration/company/plumber_list_DT/"; ?>',
			type: "post",
            data: {id: id},
			columns : 	[
							{ "data": "regnum" },
							{ "data": "designation" },
							{ "data": "status" },
							{ "data": "name" },
							{ "data": "cpd" },
							{ "data": "Performance" },
							{ "data": "rating" },
							{ "data": "action" }
						]
		};
		
		ajaxdatatables('.datatables', options);

			validation(
				'.form',
				{				
					name : {
						required	: true,
					},
					vat_num : {
						number: true,
					},
					reg_num : {
						required	: true,
						number: true,
					},
					'address[1][address]' : {
						required	: true,
					},
					'address[1][suburb]' : {
						required	: true,
					},
					'address[1][city]' : {
						required	: true,
					},
					phy_province : {
						required	: true,
					},
					'address[2][address]' : {
						required	: true,
					},
					'address[2][suburb]' : {
						required	: true,
					},
					'address[2][city]' : {
						required	: true,
					},
					post_province : {
						required	: true,
					},
					'address[2][postal_code]' : {
						required	: true,
						number: true,
					},
					primary_phone : {
						required	: true,
						number: true,
						minlength: 10,
						maxlength: 10,
					},
					contact : {
						required	: true,
					},
					email_address : {
						required	: true,
						email: true,
					},
					work_phone : {
						number: true,
						minlength:  10,
						maxlength:  10,
					},
				},
				{				
					name : {
						required	: "Name field is required."
					},
					reg_num :{
						required	: "Registration Number is required.",
						number: "Enter Numbers Only",
					},
					'address[1][address]' : {
						required	: "Physical Address field is required.",
					},
					'address[1][suburb]' : {
						required	: "Suburb field is required.",
					},
					'address[1][city]' : {
						required	: "City field is required.",
					},
					phy_province : {
						required	: "Province field is required.",
					},
					'address[2][address]' : {
						required	: "Postal Address field is required.",
					},
					'address[2][suburb]' : {
						required	: "Suburb field is required.",
					},
					'address[2][city]' : {
						required	: "City field is required.",
					},
					'address[2][postal_code]' : {
						required	: "Postal Code field is required.",
						number: "Enter Numbers Only",
					},
					primary_phone : {
						required	: "Primary Contact Number field is required.",
						number: "Enter Numbers Only",
						minlength: "Enter 10Digits Only.",
						maxlength: "Enter 10Digits Only.",
					},
					contact : {
						required	: "Primary Contact field is required.",
					},
					email_address : {
						required	: "Email field is required.",
						email: "Please Enter Valid Email.",
					},
					vat_num : {
						number: "Enter Numbers Only.",
					},
					work_phone : {
						number: "Enter Numbers Only.",
						minlength:  "Enter 10Digits Only.",
						maxlength:  "Enter 10Digits Only.",
					},
				}
				);

	
	});


</script>

