<?php echo $notification; ?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Notification and SMS Templates</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Notification and SMS Templates</li>
			</ol>
		</div>
	</div>
</div>
<!-- <?php echo $notification; ?> -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				
				<form class="form" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<table id="table" class="table table-bordered fullwidth text_issue">
								<thead>
									<tr>
										<th>Notification/SMS</th>
										<th>Email Active</th>
										<th>SMS Active</th>
										<th>Action</th> 
									</tr>
								</thead>

								<?php 
								if(count($result) > 0)
								{
									
									foreach($result as $key=>$val)
									{ 
										
										?>


										<tbody>
											<tr>
												<td colspan="4" style="text-align: center;font-weight: bold;"><?php echo $val['cat_name']; ?></td>
											</tr>

											<?php																		foreach($val['data'] as $k=>$v)
											{ 

												?>
												<tr>

													<td><?php echo $v['name']; ?></td>
													<td>
														<?php if($v['email'] == '1')
														{ 
															?>

															<input type="checkbox" disabled="disabled" name="email_notification" id="email_notification" value="" checked="checked">
														<?php } else { ?>
															<input type="checkbox" name="email_notification" id="email_notification" value="">
														<?php } ?>

													</td>
													<td>
														<?php if($v['sms'] == '1')
														{ 
															?>

															<input type="checkbox" disabled="disabled" name="sms_notification" id="sms_notification" checked="checked" >

														<?php } else { ?>
															<input type="checkbox" name="sms_notification" id="sms_notification" >
														<?php } ?>
													</td>
													<td><div class="table-action">
														<a href="<?php echo base_url();?>admin/communication/notification/index/edit/<?php echo $v['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil-alt"></i></a>

													</div></td>
												</tr>									

											<?php } ?>



										</tbody>
									<?php	}  } ?>
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

			fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".auditor_image", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.auditor_picture', '.auditor_photo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);

			fileupload(["<?php echo base_url('ajax/index/ajaxfileupload'); ?>", ".comp_emb", "./assets/uploads/auditor/<?php echo $userid; ?>/"], ['.comp_photo', '.comp_logo', '<?php echo base_url()."assets/uploads/auditor/".$userid; ?>']);

			citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $("#province").val()}, '#city', '<?php echo $city; ?>'], ['<?php echo base_url()."ajax/index/ajaxsuburb"; ?>', {provinceid : $("#province").val(),cityid : '<?php echo $city; ?>'}, '#suburb', '<?php echo $suburb; ?>']);


			validation(
				'.form',
				{
					name : {
						required	: true,
					},
					surname : {
						required	: true,
					},
					idno : {
						required	: true,
					},
					email : {
						required	: true,
						email		: true,
						remote		: 	{
							url	: "<?php echo base_url().'authentication/login/emailvalidation'; ?>",
							type: "post",
							data: {
								id : '<?php echo $id; ?>'
							}
						}
					},
					pass : {
						required	: true,
					},
					phonework : {
						required	: true,
					},
					phonemobile : {
						required	: true,
					},
					billingname : {
						required	: true,
					},
					regnumber : {
						required	: true,
					},
					vat : {
						required	: true,
					},
					billingaddress : {
						required	: true,
					},
					postalcode : {
						required	: true,
					},
					bankname : {
						required	: true,
					},
					accountname : {
						required	: true,
					},
					branchcode : {
						required	: true,	
					},
					accountnumber : {
						required	: true,	
					},
					accounttype : {
						required	: true,	
					}			

				},

				{
					name 	: {
						required	: "Please enter the firstname."
					},
					surname 	: {
						required	: "Please enter the surname."
					},				
					idno : {
						required	: "Please enter the ID"
					},
					email : {
						required	: "Please enter the email",					
						remote		: "Email already exists."
					},
					pass : {
						required	: "Please enter the password"
					},
					phonework : {
						required	: "Please enter the work phone"
					},
					phonemobile : {
						required	: "Please enter the mobile phone"
					},
					billingname : {
						required	: "Please enter the billing name"
					},
					regnumber : {
						required	: "Please enter the register number"
					},
					vat : {
						required	: "Please enter the VAT"
					},
					billingaddress : {
						required	: "Please enter the billing address"
					},
					postalcode : {
						required	: "Please enter the postal code"
					},
					bankname : {
						required	: "Please enter the bank name"
					},				
					accountname : {
						required	: "Please enter the account name"
					},
					branchcode : {
						required	: "Please enter the branch code"	
					},
					accountnumber : {
						required	: "Please enter the account number"	
					},
					accounttype : {
						required	: "Please enter the account type"	
					}
				}
				);

			var areas = $.parseJSON('<?php echo json_encode($areas); ?>');
			if(areas.length){
				$(areas).each(function(i, v){
					var areadatas = v.split('@@@');
					areadata([areadatas[1],areadatas[2],areadatas[3],areadatas[0]], [areadatas[4],areadatas[5],areadatas[6]]);
				})			
			}
		});

		$('.province_name').on('change', function(){
			citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $("#province").val()}, '#city', '<?php echo $city; ?>'], ['<?php echo base_url()."ajax/index/ajaxsuburb"; ?>', {provinceid : $("#province").val(),cityid : '<?php echo $city; ?>'}, '#suburb', '<?php echo $suburb; ?>']);
		});

		var areacount = 0;

		$("#addarea").click(function() { 

			var areaprovinceval = $('#area_province').val();
			var areacityval 	= $('#area_city').val();
			var areasuburbval 	= $('#area_suburb').val();

			var areaprovincetxt = $('#area_province :selected').text();
			var areacitytxt 	= $('#area_city :selected').text();
			var areasuburbtxt 	= $('#area_suburb :selected').text();

			areadata([areaprovinceval, areacityval, areasuburbval], [areaprovincetxt, areacitytxt, areasuburbtxt]);

		});

		$('#area_province').on('change', function(){
			citysuburb(['<?php echo base_url()."ajax/index/ajaxcity"; ?>', {provinceid : $("#area_province").val()}, '#area_city'], ['<?php echo base_url()."ajax/index/ajaxsuburb"; ?>', {provinceid : $("#area_province").val(), cityid : '<?php echo $city; ?>'}, '#area_suburb']);
		});

		function areadata(data1, data2){
			var append			= 	'\
			<tr class="">\
			<td>'+data2[0]+'</td>\
			<td>'+data2[1]+'</td>\
			<td>'+data2[2]+'</td>\
			<td>\
			<a href="javascript:void(0);" class="area_remove"><i class="fa fa-trash"></i></a>\
			<input type="hidden" value="'+data1[0]+'" name="area['+areacount+'][province]">\
			<input type="hidden" value="'+data1[1]+'" name="area['+areacount+'][city]">\
			<input type="hidden" value="'+data1[2]+'" name="area['+areacount+'][suburb]">\
			<input type="hidden" value="'+((data1[3]) ? data1[3] : "")+'" name="area['+areacount+'][id]">\
			</td>\
			</tr>\
			';

			$('#area_table').append(append);
			areacount++;
		}

		$(document).on('click', '.area_remove', function(){
			$(this).parent().parent().remove();
		})
	</script>