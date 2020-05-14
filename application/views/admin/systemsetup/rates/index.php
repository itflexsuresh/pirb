<?php

if(isset($result) && $result){
	$id 			= $result['id'];
	$supplyitem     = (set_value('supplyitem')) ? set_value('supplyitem') : $result['supplyitem'];
	$amount 	    = (set_value('amount')) ? set_value('amount') : $result['amount'];
	$validfrom 		= (set_value('validfrom')) ? set_value('validfrom') : $result['validfrom'];
	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	$futuredate     = (set_value('futuredate')) ? set_value('futuredate') : $result['futuredate'];
    $futureamount   = (set_value('futureammount')) ? set_value('futureammount') : $result['futureammount'];
	$heading		= 'Update';
}else{
	$id 			= '';
	$supplyitem		= set_value('supplyitem');
	$amount		    = set_value('amount');
	$validfrom		= set_value('validfrom');
	$status			= set_value('status');
	$heading		= 'Add';
}

// $validfrom 		= isset($result['validfrom']) ? $result['validfrom'] : '';
if($validfrom!='')
	$vdate=date('d-m-Y',strtotime($validfrom));
else
	$vdate=date('d-m-Y');


?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Rates</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Rates</li>
			</ol>
		</div>
	</div>
</div>
<?php echo $notification; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if($heading=='Update'){ ?>
					<form class="mt-4 form" action="" method="post">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="name">Rate Type</label>
								<input type="text" autocomplete="off" class="form-control" id="rates" name="supplyitem" placeholder="Enter Rate *" value="<?php echo $supplyitem;?>">
							</div>

							<div class="form-group col-md-6">
								<label for="end-end">Amount (reflected as Excluding VAT)*</label>
								<input type="text" autocomplete="off" class="form-control" id="amount" name="amount" placeholder="Enter Amount*" value="<?php echo $amount;?>">
							</div>
						</div>
						<div class="row">
						<div class="form-group col-md-6">
							<label for="name">Valid From Date</label>
							<input type="text" autocomplete="off" class="form-control" id="valid-from" name="validfrom" placeholder="Enter Date *" value="<?php echo $vdate; ?>">
						</div>
                        <?php if($futuredate!=0){?>
                        <div class="form-group col-md-6">
							<label for="name">Future Date</label></br>

							<?php $fdate=date('d-m-Y',strtotime($futuredate)); echo $fdate; ?>
						</div>
					<?php }?>
					<?php if($futureamount!=0){?>
						 <div class="form-group col-md-6">
							<label for="name">Future Amount</label></br>
							<?php  echo $futureamount; ?>
						</div>
                    <?php }?>
						<div class="col-md-1 text-right">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php// echo $heading; ?> Update</button>
							</div>
						</div>						
					</form>
				<?php } ?>
				<div class="table-responsive">
						<table id="table" class="table table-bordered fullwidth text_issue">
							<thead>
								<tr>
									<th>Rate Type</th>
									<th>Amount(Excluding VAT)</th>
									<th>Valid Form Date</th>
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
								<?php 
									if(count($results) > 0){
										foreach($results as $result){
								?>
											<?php if($result['type']=='1'){ ?>
												<tr><td colspan="4" style="text-align: center !important;padding: 10px 20px 10px 20px !important;font-weight: bold;"><?php echo $result['supplyitem']; ?></td></tr>
											<?php }else{ ?>
												<tr>
													<td style="text-align: center !important;"><?php echo $result['supplyitem']; ?></td>
													<td style="text-align: center !important;"><?php echo $result['amount']; ?></td>
													<td style="text-align: center !important;"><?php echo date('m/d/Y',strtotime($result['validfrom'])); ?></td>

													<td style="text-align: center !important;">
													<?php
													if($checkpermission){
													?>
													<div class="table-action">
														<a href="<?php echo base_url().'admin/systemsetup/rates/rates/index/'.$result['id'].''?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
													</div>
													<?php } ?></td>
												</tr>
											<?php
												}
											?>
								<?php			
										}
									}
								?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>

	<script>
		$(function(){

			validation(
				'.form',
				{				
					validfrom : {
						required	: true,
					}
					// ,
					// futurefrom : {
					// 	required	: true,
					// }
				},
				{				
					validfrom 	: {
						required	: "validfrom field is required."
					}
					// ,
					// futurefrom 	: {
					// 	required	: "futurefrom field is required."
					// }
				}
				);

			datepicker('#valid-from', ['currentdate'])		
			// datepicker('#future-from', ['currentdate'])
	});


	// Delete
	
	$(document).on('click', '.delete', function(){
		var action 	= 	'<?php echo base_url().'admin/systemsetup/rates'; ?>';
		var data	= 	'\
		<input type="hidden" value="'+$(this).attr('data-id')+'" name="id">\
		<input type="hidden" value="2" name="status">\
		';

		sweetalert(action, data);
	})
</script>
