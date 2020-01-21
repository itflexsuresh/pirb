 <?php
 $attributes_installationType = array('class' => 'Rates_update',"data-toggle"=>"validator", 'id' => 'Rates_update', 'method' => 'post');
 //$role_id = $this->session->userdata('rateID');
 ?>
 <!-- .row -->
 <div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Rates Details</h3>
            <!-- <form data-toggle="validator"> -->
                <?php
                echo form_open_multipart('rates_test/add_update/'.$rates_id.'', $attributes_installationType);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rate Type</label>
                            <input type="text" name="rate_type" value="<?php echo $records[0]->SupplyItem; ?>" placeholder="Enter an rate type" class="form-control" autocomplete="off" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount (reflected as Excluding VAT)*</label>
                            <input type="number" id="amountVATNumber" name="amountVAT" value="<?php echo $records[0]->Amount; ?>" placeholder="Enter an Amount" class="form-control" autocomplete="off" min="1" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if ($rates_id!='') {
                         $date = date("d/m/Y", strtotime($records[0]->ValidFrom));
                     }
                     ?>
                     <div class="form-group current_date">
                        <label>Valid From Date</label>
                        <input type="text" name="rate_date" id="date_id" value="<?php echo $date; ?>" placeholder="Enter an valid form" class="form-control" autocomplete="off" required readonly>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group future_date">
                        <label>Valid Future Date</label>
                        <input type="text" name="future_rate_date" id="futuredate_id" placeholder="Enter an valid form" class="form-control" autocomplete="off" required>
                        <div class="help-block with-errors"></div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- <label class="control-label">Membership</label> -->
                        <div class="radio-list">
                            <label class="radio-inline p-0">
                                <div class="radio radio-info">
                                    <input type="radio" name="radio" id="radio1" value="option1" checked>
                                    <label for="radio1">Curent</label>
                                </div>
                            </label>
                            <label class="radio-inline">
                                <div class="radio radio-info">
                                    <input type="radio" name="radio" id="radio2" value="option2">
                                    <label for="radio2">Future</label>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

            </div>



            <div class="form-group">
                <button type="submit" name="ContentPlaceHolder1btn_update_rates" class="btn btn-rounded btn-sm btn-primary">Update Rate</button>
                <button type="button" class="btn  btn-rounded btn-sm btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url()."rates/view/";?>';">Cancel</button>



            </div>
        </form>
    </div>
</div>
</div>
<script>
  $(document).ready(function(){
//     $( "#date_id" ).datepicker();
// });


$('.future_date').hide();
$('#radio2').on('change', function() {
    $('#amountVATNumber').prop('readonly',false);
    $('.current_date').hide();
    $('.future_date').show();
    $("#futuredate_id").datepicker({
        startDate: new Date
    });
    $("#future_rate_date").prop('required',true);
})
$('#radio1').on('change', function() {
    $('#amountVATNumber').prop('readonly',false);
    $('.current_date').show();
    $('.future_date').hide();
})
});
</script>