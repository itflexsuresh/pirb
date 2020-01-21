 <!-- .row -->
 <?php
 $attributes_installationType = array('class' => 'performance_type', 'id' => 'performance_type', 'method' => 'post','data-toggle'=>'validator');
 //$performanceID = $this->session->userdata('Per_ID');
 ?>
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <!-- <h3 class="box-title m-b-0">Plumber Performance Type</h3> -->
      <!-- <p class="text-muted m-b-30"> Bootstrap Form Validation</p> -->
      <?php echo form_open_multipart('plumber_performance_type/get_update/'.$performance__ID.'', $attributes_installationType); ?>
      <!-- <form data-toggle="validator"> -->
        <div class="form-group">
          <label for="inputName1" class="control-label">Performance Type</label>
          <input class="form-control" type="text" name="performance_type" id="performance_type" value="<?php echo $records[0]->Type; ?>" placeholder="Enter an Performance Type" class="form-control" required>
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          <label for="inputEmail" class="control-label">Performance Point Allocation</label>
          <input type="number" name="Performance_Point_Allocation" id="Performance_Point_Allocation" value="<?php echo $records[0]->Points; ?>" placeholder="Enter an Performance Point Allocation" class="form-control" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-check">
          <label class="custom-control custom-checkbox">
            <input type="checkbox" name="limitted_period" <?php if($records[0]->isCompany==1){echo "checked='checked'"; } ?> id="limitted_box" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">This Performance Type has limited period to it</span>
          </label>
        </div>
        <!-- <div class="col-md-6"> -->
          <div class="form-group">
            <div id="send_date_msg">
              <label class="control-label">Select date when Performance type is archived</label>
              <input type="text" name="start_date" id="date_id_send" value="<?php if($records[0]->isCompany==1){ $date = strtotime($records[0]->Archivedatee); echo date('d-m-Y',$date); } ?>" placeholder="Enter an start date" class="form-control" required="required" autocomplete="off" class="form-control" >
              <!-- </div> -->
            </div>
          </div>
          <div class="form-check">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" name="isActive_box" <?php if($records[0]->isActive==1){echo "checked='checked'"; } ?>  id="isActive_box" id="isActive_box" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Active</span>
            </label>
          </div>
          <div class="form-group">
            <button type="submit" name="ContentPlaceHolder1btn_update_rates" class="btn btn-rounded btn-sm btn-primary" id="ContentPlaceHolder1_btn_add">Update Plumber Performance Type</button>
          </div>
        </form>
<!--         <div id="active_archive">
         <input type="button" id="active_btn" name="active_btn" value="ACTIVE">
         <input type="button" id="archive_btn" name="archive_btn" value="ARCHIVED">
       </div> -->
       <div class="row button-box">
         <div class="col-lg-2 col-sm-4 col-xs-12">
          <button id="active_btn" name="active_btn" class="btn btn-block btn-success">ACTIVE</button>
        </div>
        <div class="col-lg-2 col-sm-4 col-xs-12">
          <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">ARCHIVED</button>
        </div>
      </div>
      <div class="col-sm-12">
        <!-- <div class="white-box"> -->
                  <!-- <h3 class="box-title m-b-0">Data Export</h3>
                    <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p> -->
                    <div class="table-responsive">
                      <div id="activeTable">
                        <table id="Active" class="display nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Performance Type</th>
                              <th>Points</th>
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

                  <div class="col-sm-12">
                    <!-- <div class="white-box"> -->
                  <!-- <h3 class="box-title m-b-0">Data Export</h3>
                    <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p> -->
                    <div class="table-responsive">
                      <div id="archiveTable">
                        <table id="Archive" class="display nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Performance Type</th>
                              <th>Points</th>
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"></script> -->
<script>
  $(document).ready(function(){
    $('.installation_sucess-msg, .green').delay('3000').fadeOut(300);
    $("#date_id_send").datepicker({
      //dateFormat: 'dd-mm-yy',
      dateFormat: 'dd-mm-yy',
      minDate: '0'
        // onSelect: function(selected) {
        //   $("#date_id_end").datepicker(maxDate: '0')
        // }
      });
    $('#Active').DataTable({
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
      'url':'<?=base_url()?>plumber_performance_type/get_ajaxpagination_view_active'
    },
    'columns': [
    { data: 'Type' },
    { data: 'Points' },   
    { data: 'action' },           
    ]
  });
    $('#Archive').DataTable({
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
      'url':'<?=base_url()?>plumber_performance_type/get_ajaxpagination_view_archive'
    },
    'columns': [
    { data: 'Type' },
    { data: 'Points' },   
    { data: 'action' },           
    ]
  });
    if($('#limitted_box'). prop("checked") == true){
      $('#send_date_msg').show();
      $('#date_id_send').show();
      $('#date_id_send').prop('required',true);
    }
    else{
      $('#send_date_msg').hide();
      $('#date_id_send').datepicker('setDate', null);
      $('#date_id_send').prop('required',false);
    }

    var clickCount = 0;
    // $('#send_date_msg').hide();
    // $('#date_id_send').prop('required',false);
    $('#limitted_box').click(function(){
      clickCount = clickCount+1;
      if (clickCount%2==0) {
        $('#send_date_msg').show();
        $('#date_id_send').show();
        $('#date_id_send').prop('required',true);
      }else{
        $('#send_date_msg').hide();
        $('#date_id_send').datepicker('setDate', null);
        $('#date_id_send').prop('required',false);
      }
    });
    $('.installation_sucess-msg, .green').delay('3000').fadeOut(300);
    
    $('#archiveTable').hide();   
    $('#archive_btn').css("color","#333");
    $('#archive_btn').css("background-color","#ebebeb");
    $('#archive_btn').css("border-color","#adadad");
    
    $('#archive_btn').click(function(){
      $('#activeTable').hide();
      $('#archiveTable').show();
      $('#archive_btn').css("color","#333");
      $('#archive_btn').css("background-color","#00c292");
      $('#archive_btn').css("border-color","#adadad");
      $('#active_btn').css("color","#333");
      $('#active_btn').css("background-color","#ebebeb");
      $('#active_btn').css("border-color","#adadad");


    });
    $('#active_btn').click(function(){
      $('#activeTable').show();
      $('#archiveTable').hide();
      $('#active_btn').css("color","#333");
      $('#active_btn').css("background-color","#00c292");
      $('#active_btn').css("border-color","#adadad");      
      $('#archive_btn').css("color","#333");
      $('#archive_btn').css("background-color","#ebebeb");
      $('#archive_btn').css("border-color","#adadad");
      
      
    });
  });
</script>