<?php
if(isset($result) && $result){
	$id 			= $result['id'];
	//$msgid 			= (set_value('groups')) ? set_value('groups') : $result['groups'];
	$supplyitem     = (set_value('supplyitem')) ? set_value('supplyitem') : $result['supplyitem'];
	$amount 	    = (set_value('amount')) ? set_value('amount') : $result['amount'];
	$validfrom 		= (set_value('validfrom')) ? set_value('validfrom') : $result['validfrom'];
	$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	
	$heading		= 'Update';
}else{
	$id 			= '';
	// $msgid			= set_value('groups');		
	$supplyitem			= set_value('supplyitem');
	$amount		    = set_value('amount');
	$validfrom		= set_value('validfrom');
	$status			= set_value('status');

	$heading		= 'Add';
}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Rates</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
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
				<h4 class="card-title">Rates</h4>
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
							<input type="text" autocomplete="off" class="form-control" id="valid-from" name="validfrom" placeholder="Enter Date *" value="<?php echo $validfrom; ?>">
						</div>
						<div class="col-md-1 text-right">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Update</button>
							</div>
						</div>						
					</form>
				<?php } ?>
				<div class="table-responsive m-t-40">
						<table id="table" class="table table-bordered fullwidth">
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
												<tr><td colspan="4" style="text-align: center;font-weight: bold;"><?php echo $result['supplyitem']; ?></td></tr>
											<?php }else{ ?>
												<tr>
													<td><?php echo $result['supplyitem']; ?></td>
													<td><?php echo $result['amount']; ?></td>
													<td><?php echo date('m/d/Y',strtotime($result['validfrom'])); ?></td>
													<td><div class="table-action">
																	<a href="<?php echo base_url().'admin/systemsetup/rates/rates/index/'.$result['id'].''?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
																</div></td>
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
				},
				{				
					validfrom 	: {
						required	: "validfrom field is required."
					}
				}
				);

			datepicker('#valid-from', ['currentdate'])		
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
