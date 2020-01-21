 <?php
 //$attributes_installationType = array('class' => 'Rates_update',"data-toggle"=>"validator", 'id' => 'Rates_update', 'method' => 'post');
 //$role_id = $this->session->userdata('rateID');
 ?>
 <!-- .row -->
 <div class="row">
 	<div class="col-sm-12">
 		<div class="white-box">
 			<!-- <h3 class="box-title m-b-0">Rates Details</h3> -->
 			<form data-toggle="validator">
 				<?php
                //echo form_open_multipart('rates/add_update/'.$rates_id.'', $attributes_installationType);
 				?>
 				<div class="row">
 					<div class="col-md-6">
 						<div class="form-group">
 							<label for="inputEmail" class="control-label">Plumber / Reg Number</label>
 							<input type="text" name="plumbreg" id="Plumberreg" class="form-control" id="inputEmail" placeholder="Enter An Plumber / Reg Number"  >
 							<div class="help-block with-errors"></div>
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group" id="staus-id-plumber">
 							<label>Status</label>
 							<select class="form-control">
 								<option value="0">Pending</option>
 								<option value="1">Active</option>
 								<option value="3">CPD Suspension</option>
 								<option value="4">Expiered</option>
 								<option value="5">Deceased</option>
 								<option value="6">Resigned</option>
 							</select>
 						</div>
 					</div>
 				</div>

 				<div class="row">
 					<div class="col-md-6">
 						<div class="form-group">
 							<label for="inputEmail" class="control-label">Plumber Id Number</label>
 							<input type="number" id="Plumberid" class="form-control" id="inputEmail" placeholder="Enter An Plumber Id Number"  >
 							<div class="help-block with-errors"></div>
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label for="inputEmail" class="control-label">Plumber Mobile</label>
 							<input type="number" name="Plumbermob" id="Plumbermob" min="0" data-minlength="10" class="form-control" id="inputEmail" placeholder="Enter An Plumber Mobile"  >
 							<div class="help-block with-errors"></div>
 						</div>
 					</div>
 				</div>

 				<div class="row">
 					<div class="col-md-6">
 						<div class="form-group">
 							<label for="inputEmail" class="control-label">Plumber Date of Birth</label>
 							<input type="text" id="Plumberdob" class="form-control" id="inputEmail" placeholder="Enter An Plumber Date of Birth"  >
 							<div class="help-block with-errors"></div>
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Company</label>
 							<select class="form-control" id="Plumbercomp">
 								<option>com1</option>
 								<option>com1</option>
 								<option>com2</option>
 								<option>com3</option>
 								<option>com4</option>
 								<option>com5</option>
 							</select>
 						</div>
 					</div>
 				</div>
 				<div class="form-group">
 					<button type="button" id="search-addtional-ajax" class="btn btn-rounded btn-sm btn-primary">Search</button>
 				</div>

 			</form>
 			<div class="col-sm-12">
 				<div class="table-responsive">
 					<div id="activeTable">
 						<table id="isActive" class="display">
 							<thead>
 								<tr>
 									<th>Reg No</th>
 									<th>Name</th>
 									<th>Surname</th>
 									<th>Email Address</th>
 									<th>Designation</th>
 									<th>Satus</th>
 									<th> </th>
 								</tr>
 							</thead>
 							<tbody>
 							</tbody>
 						</table>
 					</div>
 				</div>
 				<!-- </div> -->
 			</div>
 		</div>
 	</div>
 </div>
 <script>
  //$(document).ready(function(){
 //   $( "#date_id" ).datepicker();
//});

$(document).ready(function(){

	var userDataTable = $('#isActive').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
         //'searching': false, // Remove default Search Control
         'ajax': {
         	'url':'<?= base_url()?>register_plumber_list/get_ajaxpagination_view_list_test',
         	'data': function(data){
         		data.searchReg = $('#Plumberreg').val();
         		data.searchMOB = $('#Plumbermob').val();
         		data.searchIDno = $('#Plumberid').val();
         		data.statusPlumb = $('#staus-id-plumber').val();
         	}
         },
         'columns': [
         { data: 'regno' },
         { data: 'fname' },
         { data: 'lname' },
         { data: 'email' },
         { data: 'Designation' },
         { data: 'status' },
         { data: 'action' },
         ]
     });

  //   $('#sel_city,#sel_gender').change(function(){
  //     userDataTable.draw();
  // });
  $('#search-addtional-ajax').click(function(){

  });

  $('#Plumberreg').keyup(function(){
  		userDataTable.draw();
  	});
  	$('#Plumbermob').keyup(function(){
  		userDataTable.draw();
  	});
  	$('#Plumberid').keyup(function(){
  		userDataTable.draw();
  	});
  	$('#staus-id-plumber').keyup(function(){
  		userDataTable.draw();
  	});	
  
//     $( "#date_id" ).datepicker();
// });


// $('.future_date').hide();
// $('#radio2').on('change', function() {
//     $('#amountVATNumber').prop('readonly',false);
//     $('.current_date').hide();
//     $('.future_date').show();
//     $("#futuredate_id").datepicker({
//         startDate: new Date
//     });
//     $("#future_rate_date").prop('required',true);
// })
// $('#radio1').on('change', function() {
//     $('#amountVATNumber').prop('readonly',false);
//     $('.current_date').show();
//     $('.future_date').hide();
// })
});
</script>