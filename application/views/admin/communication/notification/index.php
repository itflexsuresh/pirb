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
												<td colspan="4" style="text-align: center !important;padding: 10px 20px 10px 20px !important;font-weight: bold;"><?php echo $val['cat_name']; ?></td>
											</tr>

											<?php																		foreach($val['data'] as $k=>$v)
											{
												?>
												<tr>

													<td><?php echo $v['name']; ?></td>
													<td style="text-align: center !important;">
														<?php if($v['email'] == '1')
														{ 
															?>

															<input type="checkbox" disabled="disabled" name="email_notification" id="email_notification" value="" checked="checked">
														<?php } else { ?>
															<input type="checkbox" name="email_notification" id="email_notification" value="">
														<?php } ?>

													</td>
													<td style="text-align: center !important;">
														<?php if($v['sms'] == '1')
														{ 
															?>

															<input type="checkbox" disabled="disabled" name="sms_notification" id="sms_notification" checked="checked" >

														<?php } else { ?>
															<input type="checkbox" name="sms_notification" id="sms_notification" >
														<?php } ?>
													</td>
													<td>
														<?php
															if($checkpermission){ ?>
																<div class="table-action">
														<a href="<?php echo base_url();?>admin/communication/notification/index/edit/<?php echo $v['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil-alt"></i></a>

													</div>

														<?php } ?>
														</td>
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
