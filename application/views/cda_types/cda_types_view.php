 <?php
 $attributes_installationType = array('class' => 'localtion_types_view',"data-toggle"=>"validator", 'id' => 'localtion_types_view', 'method' => 'post');
 ?>
 <!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <!-- <h3 class="box-title m-b-0">Rates Details</h3> -->
      <!-- <form data-toggle="validator"> -->
        <?php
        if ($this->session->flashdata('CDA_add_sucess')!='') {
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('CDA_add_sucess');
          echo "</div>";
        }elseif ($this->session->flashdata('CDA_update_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('CDA_update_sucess');
         echo "</div>";
       }elseif ($this->session->flashdata('CDA_archive_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('CDA_archive_sucess');
         echo "</div>";
       }elseif ($this->session->flashdata('CDA_active_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('CDA_active_sucess');
         echo "</div>";
       }elseif ($this->session->flashdata('CDA_delete_sucess')!='') {
         echo "<div class='alert alert-danger'>";
         echo $this->session->flashdata('CDA_delete_sucess');
         echo "</div>";
       }
       ?>
       <?php
       echo form_open_multipart('cda_types/insert/', $attributes_installationType);
       ?>
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Activity*</label>
            <input type="text" name="activity" class="form-control" autocomplete="off" placeholder="Enter an Activity" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>CDA Start Date*</label>
            <input type="text" id="start_date" name="start_date" placeholder="Enter an Start Date" class="form-control" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>CDA Points*</label>
            <input type="number" name="cpdPoints" class="form-control" autocomplete="off" placeholder="Enter an CDA Points" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>CDA End Date*</label>
            <input type="text" id="end_date" name="end_date" placeholder="Enter an CDA End Date" class="form-control" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Product Code*</label>
            <input type="text" name="product_code" class="form-control" autocomplete="off" placeholder="Enter an Product Code" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">CDA Stream*</label>
            <select class="form-control" name="CPDstreams">
              <option value="Developmental Activities">Developmental</option>
              <option value="Work-based Activities">Work-based</option>
              <option value="Individual Activities">Individual</option>
            </select>
          </div>
          <div class="help-block with-errors"></div>
        </div>
      </div>



      <!--/span-->
      <div class="form-check">
        <div class="checkbox">
         <input name="ContentPlaceHolder1isActive" type="checkbox" id="terms">
         <label for="terms"> Active </label>    
       </div>
     </div>

     <div class="form-group">
      <button type="submit" name="ContentPlaceHolder1btn_Add_location_types" class="btn btn-rounded btn-sm btn-primary">Add CDA Types</button>                
    </div>
  </form>
  <div class="row button-box">
   <div class="col-lg-2 col-sm-4 col-xs-12">
    <button id="active_btn" name="active_btn" class="btn btn-block btn-success">ACTIVE</button>
  </div>
  <div class="col-lg-2 col-sm-4 col-xs-12">
    <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">ARCHIVED</button>
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
          <th>CDA Start Date</th>
          <th>CDA End Date</th>
          <th>CDA Stream</th>
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
  <div class="table-responsive">
   <div id="archiveTable">
    <table id="isArchive" class="display">
      <thead>
        <tr>
          <th>Porduct Code</th>
          <th>Activity</th>
          <th>CDA Start Date</th>
          <th>CDA End Date</th>
          <th>CDA Stream</th>
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
</div>
<script>
  $(document).ready(function(){
    start_end();
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
    $('.alert, .alert-danger').delay('3000').fadeOut(300);
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
    'url':'<?=base_url()?>cda_types/get_ajaxpagination_view_active'
  },
  'columns': [
  { data: 'ProductCode' },
  { data: 'Activity'},
  { data: 'StartDate'},
  { data: 'EndDate'},
  { data: 'CPDStream'},
  { data: 'Points' },
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
      'url':'<?=base_url()?>cda_types/get_ajaxpagination_view_archive'
    },
    'columns': [
    { data: 'ProductCode'},
    { data: 'Activity'},
    { data: 'StartDate'},
    { data: 'EndDate'},
    { data: 'CPDStream'},
    { data: 'Points' },
    { data: 'action' },     
    ]
  });
    $('#archiveTable').hide();
    $('#archive_btn').css("color","#333");
    $('#archive_btn').css("background-color","#ebebeb");
    $('#archive_btn').css("border-color","#adadad");


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