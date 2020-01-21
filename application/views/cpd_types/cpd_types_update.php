 <?php
 $attributes_installationType = array('class' => 'localtion_types_view',"data-toggle"=>"validator", 'id' => 'localtion_types_view', 'method' => 'post');
 //print_r($records);die;
 $d1  = strtotime($records[0]->StartDate);
 $d2  = strtotime($records[0]->EndDate);
 $start_DD = date("m/d/Y",$d1);
 $end_DD = date("m/d/Y",$d2);
 ?>
 <!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <!-- <h3 class="box-title m-b-0">Rates Details</h3> -->
      <!-- <form data-toggle="validator"> -->
        <?php
        if ($this->session->flashdata('CPD_add_sucess')!='') {
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('CPD_add_sucess');
          echo "</div>";
        }elseif ($this->session->flashdata('location_update_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('CPD_add_sucess');
         echo "</div>";
       }
       ?>
       <?php
       echo form_open_multipart('cpd_points/get_udpate/'.$CPD_Id.'', $attributes_installationType);
       ?>
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Activity*</label>
            <input type="text" name="activity" value="<?php echo $records[0]->Activity; ?>" class="form-control" autocomplete="off" placeholder="Enter an Activity" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>CPD Start Date*</label>
            <input type="text" id="start_date" value="<?php echo $start_DD; ?>" name="start_date" placeholder="Enter an Start Date" class="form-control" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>CPD Points*</label>
            <input type="number" name="cpdpoints" value="<?php echo $records[0]->Points; ?>" class="form-control" autocomplete="off" placeholder="Enter an CPD Points" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>CPD End Date*</label>
            <input type="text" id="end_date" name="end_date" value="<?php echo $end_DD; ?>" placeholder="Enter an CPD End Date" class="form-control" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group activity-group">
            <label>Product Code*</label>
            <input type="text" name="product_code" id="activity-box" value="<?php echo $records[0]->ProductCode; ?>"  class="form-control" autocomplete="off" placeholder="Enter an Product Code" autocomplete="off" required>
            <div class="help-block with-errors activity-group1"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">CPD Stream*</label>
            <select class="form-control" name="CPDstreams">
              <option value="Developmental Activities"<?php if($records[0]->CPDStream=='Developmental Activities'){ echo 'selected="selected"'; } ?>>Developmental Activities</option>
              <option value="Work-based Activities"<?php if($records[0]->CPDStream=='Work-based Activities'){ echo 'selected="selected"'; } ?>>Work-based Activities</option>
              <option value="Individual Activities"<?php if($records[0]->CPDStream=='Individual Activities'){ echo 'selected="selected"'; } ?>>Individual Activities</option>
            </select>
          </div>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group"><!-- 
            <label>Product Code*</label> -->
            <button type="button" id="genrete-btn" name="ContentPlaceHolder1btn_Add_location_types" class="btn btn-info btn-rounded btn-sm waves-effect waves-light m-t-10 btn-rounded btn-sm btn-primary">Generate QR Code</button>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <div id="QR-code-div"></div>
            <!-- <label class="control-label">CPD Stream*</label>
            <select class="form-control" name="CPDstreams">
              <option value="Developmental Activities">Developmental Activities</option>
              <option value="Work-based Activities">Work-based Activities</option>
              <option value="Individual Activities">Individual Activities</option>
            </select> -->
          </div>
          <!-- <div class="help-block with-errors"></div> -->
        </div>
      </div>



      <!--/span-->
      <div class="form-check">
        <div class="checkbox">
         <input name="ContentPlaceHolder1isActive" <?php if($records[0]->isActive==1){ echo "checked='checked'"; } ?> type="checkbox" id="terms">
         <label for="terms"> Active </label>    
       </div>
     </div>

     <div class="form-group">
      <button type="submit" name="ContentPlaceHolder1btn_Add_location_types" class="btn btn-rounded btn-sm btn-primary">Update CPD Types</button>
      <button type="button" class="btn  btn-rounded btn-sm btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url()."cpd_points/view/";?>';">Cancel</button>      
    </div>
  </form>
  <div class="row button-box">
   <div class="col-lg-2 col-sm-4 col-xs-12">
    <button id="active_btn" name="active_btn" class="btn btn-block btn-success">ACTIVE</button>
  </div>
  <div class="col-lg-2 col-sm-4 col-xs-12">
    <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">ARCHIVED</button>
  </div>
  <div class="col-lg-8 col-sm-13 col-xs-12">
    <button type="button" name="ContentPlaceHolder1btn_addmanage" class="btn pull-right m-l-25 btn-primary btn-rounded" onclick="window.location.href = '<?php echo base_url()."cpd_points/view/";?>';">Add CPD Types</button>
  </div>
</div>

<div class="col-sm-12">
  <div class="table-responsive">
   <div id="activeTable">
    <table id="isActive" class="display">
      <thead>
        <tr>
          <th>Porduct Code</th>
          <th>Activity</th>
          <th>CPD Start Date</th>
          <th>CPD End Date</th>
          <th>CPD Stream</th>
          <th>Points</th>
          <th> </th>
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
  <div class="table-responsive">
   <div id="archiveTable">
    <table id="isArchive" class="display">
      <thead>
        <tr>
          <th>Porduct Code</th>
          <th>Activity</th>
          <th>CPD Start Date</th>
          <th>CPD End Date</th>
          <th>CPD Stream</th>
          <th>Points</th>
          <th> </th>
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
</div>
<script>
  $(document).ready(function(){
    start_end();
    var start_Date = $('#start_date').val();
    function start_end(){
      $("#start_date").datepicker({
        startDate: new Date(),
      });      
    }
    
    $("#end_date").click(function(){
      var start_Date = $('#start_date').val();
      
      $("#end_date").datepicker({     
        startDate: new Date(start_Date),
      });
    });
    $('.alert, .alert-success').delay('3000').fadeOut(300);
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
    'url':'<?=base_url()?>cpd_points/get_ajaxpagination_view_active'
  },
  'columns': [
  { data: 'ProductCode' },
  { data: 'Activity'},
  { data: 'StartDate'},
  { data: 'EndDate'},
  { data: 'CPDStream'},
  { data: 'Points' },
  { data: 'pdf' },
  { data: 'action' },
  ]
});
    $('#isArchive').DataTable({
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
      'url':'<?=base_url()?>cpd_points/get_ajaxpagination_view_archive'
    },
    'columns': [
    { data: 'ProductCode'},
    { data: 'Activity'},
    { data: 'StartDate'},
    { data: 'EndDate'},
    { data: 'CPDStream'},
    { data: 'Points' },
    { data: 'pdf' },
    { data: 'action' },     
    ]
  });
    $('#archiveTable').hide();
    $('#archive_btn').css("color","#333");
    $('#archive_btn').css("background-color","#ebebeb");
    $('#archive_btn').css("border-color","#adadad");

    $('#genrete-btn').click(function(){
      //alert('hiii');
      var textBox = $('#activity-box').val();
      if (textBox == "") {
        $('.activity-group').addClass("has-error");
        var error_msg = '<ul class="list-unstyled"><li>Please fill out this field.</li></ul>';
        $('.activity-group1').html(error_msg);
      }else{        
       $("#QR-code-div").html('').qrcode({
        text: textBox,
      });
     }
   });
    $( "#activity-box" ).keyup(function(){
      $('.activity-group1').hide();
    });


    $('#archive_btn').click(function(){
     $('#archiveTable').show();
     $('#activeTable').hide();
     $('#archive_btn').css("color","#333");
     $('#archive_btn').css("background-color","#00c292");
     $('#archive_btn').css("border-color","#adadad");
     $('#active_btn').css("color","#333");
     $('#active_btn').css("background-color","#ebebeb");
     $('#active_btn').css("border-color","#adadad");
   });
    $('#active_btn').click(function(){
      $('#archiveTable').hide();
      $('#activeTable').show();     
      $('#active_btn').css("color","#333");
      $('#active_btn').css("background-color","#00c292");
      $('#active_btn').css("border-color","#adadad");      
      $('#archive_btn').css("color","#333");
      $('#archive_btn').css("background-color","#ebebeb");
      $('#archive_btn').css("border-color","#adadad");
    });

  });
</script>