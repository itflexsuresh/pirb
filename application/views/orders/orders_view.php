 <?php
 $attributes_installationType = array('class' => 'oders_and_allocations','data-toggle' => 'validator', 'id' => 'oders_and_allocations', 'method' => 'post');
 //  print"<pre>";
 // print_r($plumber_records);
 // print"</pre>";
 ?>
 <!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
           <!--  <h3 class="box-title m-b-0">Form Validation</h3>
            <p class="text-muted m-b-30"> Bootstrap Form Validation</p> -->
            <!-- <form data-toggle="validator">  -->
              <?php
              echo form_open_multipart('orders/insert_records', $attributes_installationType);
              ?>
              <div class="form-group">
                <?php
                // if ($this->session->flashdata('city_sucess')!='') {
                //   echo "<div class='alert alert-success'>";
                //   echo $this->session->flashdata('city_sucess');
                //   echo "</div>";
                // }

                // elseif ($this->session->flashdata('suburb_sucess')!='') {
                //   echo '<div class="alert alert-success">';
                //   echo $this->session->flashdata('suburb_sucess');                    
                //   echo '</div>';

                // }elseif ($this->session->flashdata('suburb_update')!='') {
                //   echo "<div class='alert alert-success'>";
                //   echo $this->session->flashdata('suburb_update');
                //   echo "</div>";
                // }elseif ($this->session->flashdata('city_check')!='') {
                //   echo "<div class='alert alert-danger'>";
                //   echo $this->session->flashdata('city_check');
                //   echo "</div>";
                // }elseif ($this->session->flashdata('Archive_suburb')!='') {
                //   echo '<div class="alert alert-success">';
                //   echo $this->session->flashdata('Archive_suburb');
                //   echo "</div>";
                // }
                // elseif ($this->session->flashdata('Active_suburb')!='') {
                //   echo '<div class="alert alert-success">';
                //   echo $this->session->flashdata('Active_suburb');
                //   echo "</div>";
                // }
                // elseif ($this->session->flashdata('delete_suburb')!='') {
                //   echo "<div class='alert alert-danger'>";
                //   echo $this->session->flashdata('delete_suburb');
                //   echo "</div>";
              //}
                ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-6">Date of Order</label>
                      <div class="col-md-13">
                        <input type="text" name="dateOfOrders" id="orders_date" class="form-control" placeholder="Enter An Date Of Order Raised" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>

<!--                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-6">Order ID</label>
                      <div class="col-md-13">
                        <input type="text" name="orderID" id="" class="form-control" placeholder="Enter An Order ID" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-6">Inv Number</label>
                      <div class="col-md-13">
                        <input type="text" name="inv_no" id="" class="form-control" placeholder="Enter An Inv Number" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div> -->

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <!-- <label class="control-label">Membership</label> -->
                      <div class="radio-list">
                        <label class="radio-inline p-0">
                          <div class="radio radio-info">
                            <input type="radio" name="radio" id="radio1" value="option1" checked>
                            <label for="radio1">Plumber</label>
                          </div>
                        </label>
                        <label class="radio-inline">
                          <div class="radio radio-info">
                            <input type="radio" name="radio" id="radio2" value="option2">
                            <label for="radio2">Reseller</label>
                          </div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6 plumber-dopdown">
                    <div class="form-group">
                      <label class="control-label col-md-6">Plumber</label>
                      <div class="col-md-13">
                        <select name="Plumber_name" class="form-control" id="plumber-drop" required aria-required="true" tabindex="1">
                          <option value="">--Select Plumber--</option>
                          <?php
                          foreach ($plumber_records as $key) { 
                            $plumber_name = $key->fname." ".$key->lname;
                            $plumber_reg_number = $key->regno;

                            ?>
                            <option value="<?php echo $key->UserID; ?>"><?php echo $plumber_name." ".$plumber_reg_number ?></option>  
                            <?php
                          }
                          ?>
                          
                          
                          <!-- <option value="2">plumber2</option> -->
                        </select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 reseller-dopdown">
                    <div class="form-group">
                      <label class="control-label col-md-6">Reseller</label>
                      <div class="col-md-13">
                        <select name="Reseller_name" class="form-control" id="reseller-drop" required aria-required="true" tabindex="1">
                          <option value="">--Select Reseller--</option>
                          <option value="1">Reseller1</option>
                          <option value="2">Reseller2</option>
                        </select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-12">Number of COC's Permitted to be allocated</label>
                      <div class="col-md-13">
                        <input type="number" name="coc_clacs" id="coc-allocate" class="form-control" placeholder="Enter An COC Calculation" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-6">Comments</label>
                      <div class="col-md-13">
                        <textarea rows="5" cols="70" name="commetns" ></textarea>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-12">Number Of COC's Requested</label>
                      <div class="col-md-13">
                        <input type="number" name="number_of_coc" id="No-of-coc" class="form-control" placeholder="Enter An Number Of COC" required minlength="1">
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Type of COC</label>
                      <div class="radio-list">
                       <label class="radio-inline p-0">
                         <div class="radio radio-info">
                          <input type="radio" name="COC_Types" id="out" checked>
                          <label for="out"> Electronic </label>
                        </div>
                      </label>
                      <label class="radio-inline">
                       <div class="radio radio-info">
                        <input type="radio" name="COC_Types" id="in">
                        <label for="in"> Paper Based </label>
                      </div>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-6">Method Of Delivery</label>
                  <div class="col-md-13">
                    <select name="delivey_method" class="form-control" id="reseller-drop">
                      <option value="1">Collect from PIRB</option>
                      <option value="2">By Courier</option>
                      <option value="3">By Registered Post</option>
                    </select>                    
                  </div>
                </div>
              </div>
              <!--  </div> -->

              <!-- <div class="row"> -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-12">Payment Status</label>
                    <div class="radio-list">
                     <label class="radio-inline p-0">
                       <div class="radio radio-info">
                        <input type="radio" name="payment" id="rad1" required checked>
                        <label for="rad1"> Paid </label>
                      </div>
                    </label>
                    <label class="radio-inline">
                     <div class="radio radio-info">
                      <input type="radio" name="payment" id="rad2" required>
                      <label for="rad2"> Unpaid </label>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-6">Internal Acc Invocie Number</label>
                <div class="col-md-13">
                  <input type="text" name="internal_inv_no" id="" class="form-control" placeholder="Enter An Internal Invoice Number" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
        <!-- </div>
          <div class="row"> -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-6">Tracking No</label>
                <div class="col-md-13">
                  <input type="text" name="tracking_no" id="" class="form-control" placeholder="Enter An Tracking Number" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>



        </div>

        <div class="row">
          <div class="form-check">
            <div class="checkbox">
             <input name="sendNotification" type="checkbox" id="terms">
             <label for="terms"> Send Notification </label>    
           </div>
         </div>

         <div class="form-check">
          <div class="checkbox">
            <input name="tracking_notification" type="checkbox" id="notifi">
            <label for="notifi"> Send a SMS Tracking Notification </label>    
          </div>
        </div>

        <div class="form-check">
          <div class="checkbox">
            <input name="email_notification" type="checkbox" id="email_notifi">
            <label for="email_notifi"> Send an Email Tracking Notifiation </label>    
          </div>
        </div>

      </div>

      <div class="col-sm-1">
        <div class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <button id="ordersbtn" type="submit" class="btn btn-rounded btn-sm btn-primary">Add</button>
          </div>
        </div>
      </div>

    </form>
    <div class="row button-box">
     <div class="col-lg-2 col-sm-4 col-xs-12">
      <button id="active_btn" name="active_btn" class="btn btn-block btn-success">PENDING</button>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
      <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">CLOSE</button>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="table-responsive">
     <div id="activeTable">
      <table id="isActive" class="display">
        <thead>
          <tr>
            <th>OrderID</th>
            <th>Inv Number</th>
            <th>Date of order</th>
            <th>Payment Status</th>
            <th>Internal Inv Number</th>
            <th>Plumber Name and Surname/Reseller</th>
            <th>COC Type</th>
            <th>Total COC</th>
            <th>Delivery Method</th>
            <th>Delivery Address</th>
            <th>Tracking Number</th>
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
  $(document).ready(function(){
    $('#orders_date').datepicker({
      startDate: new Date
    });

    $('#isActive').DataTable({
    // "pageLength": 3,
    aoColumnDefs: [
    {
     bSortable: false,
     aTargets: [ -1 ]
   }
   ],
   'processing': true,
   'serverSide': true,
   'serverMethod': 'post',
   'ajax': {
    'url':'<?=base_url()?>orders/get_ajaxpagination_view_active'
  },
  'columns': [
  { data: 'OrderID' },
  { data: 'InvoiceNumber'},
  { data: 'CreateDate'},
  { data: 'isPaid'},
  { data: 'InternalInvoiceNumber'},
  { data: 'plumbername' },
  { data: 'COCType'},
  { data: 'TotalNoItems'},
  { data: 'Delivery'},
  { data: 'Delivery_address'},
  { data: 'TrackingNo'},
  { data: 'action' },
  ]
});

    $("#plumber-drop").select2();
    $("#reseller-drop").select2();
    var coc='';
    $('#plumber-drop').on('change', function() {
      if ($('#plumber-drop').val()!='') {
        //alert($('#plumber-drop').val());        
        var usrId = $('#plumber-drop').val();
        $.ajax({
          url: "<?=base_url()?>orders/fetch_user_details",
          type: 'post',
          dataType: "json",
          data: 'user_id='+usrId,
          success: function( result ) {
            //console.log(result[0]);
            $('#coc-allocate').val(result[0]);
            //coc = $('#coc-allocate').val();
          }
        });
        
      }       
      
    });
//     $('#No-of-coc').keyup(function() {

//       var xx = $('#coc-allocate').val();
//       var zz = $(this).val();

//       if (xx==zz) {
// //alert('hiii');
// $('#No-of-coc').prop('readonly',true);
// }
// });
//     $('#No-of-coc').keypress(function(){
//       //$('#No-of-coc').prop('readonly',true);
//       var xx = $('#coc-allocate').val();
//       var zz = $(this).val();

//       if (xx<zz) {
// //alert('hiii');
// alert('out of range');
// }
// // else{

// // }
// });

    $('#No-of-coc').on('input', function () {
    var xx = $('#coc-allocate').val();
    var value = $(this).val();
    
    if ((value !== '') && (value.indexOf('.') === -1)) {
        if (xx>=value) {
          $(this).val(Math.max(Math.min(value, xx), -xx));
        }else{          
          alert('out of range');
          $(this).val(Math.max(Math.min(value, xx), -xx));
        }
        
    }
});

   // $('#coc-allocate').on('change', function() {

    // if (coc!=0 || coc!='') {
    //   alert('notnull');
    // }  
    //});
    



    if ($('#radio1').prop('checked')) {
      $('.reseller-dopdown').hide();
      $('#reseller-drop').prop('aria-required',false);
      $('#reseller-drop').prop('required',false);
    }
    $('#radio2').click(function(){
      $('.reseller-dopdown').show();
      $('.plumber-dopdown').hide();
      $('#reseller-drop').prop('aria-required',true);
      $('#reseller-drop').prop('required',true);
      $('#plumber-drop').prop('aria-required',false);
      $('#plumber-drop').prop('required',false);
    });
    $('#radio1').click(function(){
      $('.plumber-dopdown').show();
      $('.reseller-dopdown').hide();
      $('#plumber-drop').prop('aria-required',true);
      $('#plumber-drop').prop('required',true);
      $('#reseller-drop').prop('aria-required',false);
      $('#reseller-drop').prop('required',false);
    });
  });
</script>