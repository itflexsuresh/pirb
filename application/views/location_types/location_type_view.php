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
        if ($this->session->flashdata('location_add_sucess')!='') {
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('location_add_sucess');
          echo "</div>";
        }elseif ($this->session->flashdata('location_update_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('location_update_sucess');
         echo "</div>";
       }elseif ($this->session->flashdata('location_archive_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('location_archive_sucess');
         echo "</div>";
       }elseif ($this->session->flashdata('location_active_sucess')!='') {
         echo "<div class='alert alert-success'>";
         echo $this->session->flashdata('location_active_sucess');
         echo "</div>";
       }elseif ($this->session->flashdata('location_delete_sucess')!='') {
         echo "<div class='alert alert-danger'>";
         echo $this->session->flashdata('location_delete_sucess');
         echo "</div>";
       }
       ?>
       <?php
       echo form_open_multipart('location_types/insert/', $attributes_installationType);
       ?>
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Location Type*</label>
            <input type="text" name="location_type" class="form-control" autocomplete="off" placeholder="Enter an Location Types" autocomplete="off" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Address*</label>
            <input type="text" name="Address_location" placeholder="Enter an Address" class="form-control" autocomplete="off" required>
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
     </div>
     <div class="form-group">
      <button type="submit" name="ContentPlaceHolder1btn_Add_location_types" class="btn btn-rounded btn-sm btn-primary">Add Location Types</button>                
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
          <th>Location Type</th>
          <th>Address</th>        
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
          <th>Location Type</th>
          <th>Address</th>        
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
    'url':'<?=base_url()?>location_types/get_ajaxpagination_view_active'
  },
  'columns': [
  { data: 'Location' },
  { data: 'Address' },   
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
      'url':'<?=base_url()?>location_types/get_ajaxpagination_view_archive'
    },
    'columns': [
    { data: 'Location' },
    { data: 'Address' },   
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