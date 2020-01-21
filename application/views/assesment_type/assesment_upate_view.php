 <?php
 $attributes_installationType = array('class' => 'assesment_type', 'id' => 'assesment_type', 'method' => 'post',"data-toggle"=>"validator");
 //$assId = $this->session->userdata('Assesment_ID');
 ?><!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <!-- <h3 class="box-title m-b-0">Assesment Types</h3> -->
      <!-- <p class="text-muted m-b-30"> Bootstrap Form Validation</p> -->
      <?php
      echo form_open_multipart('assesment_type/udpate/'.$assID.'',$attributes_installationType);
      ?>
      <!-- <form data-toggle="validator"> -->
        <?php
        // if ($this->session->flashdata('insert_sucess')!='') {
        //   echo "<div class='alert alert-info'>";
        //   echo $this->session->flashdata('insert_sucess');
        //   echo "</div>";
        // }

        // elseif ($this->session->flashdata('sucess_update')!='') {
        //   echo '<div class="alert alert-info">';
        //   echo $this->session->flashdata('sucess_update');                    
        //   echo '</div>';

        // }elseif ($this->session->flashdata('archive_update')!='') {
        //   echo '<div class="alert alert-info">';
        //   echo $this->session->flashdata('archive_update');                    
        //   echo '</div>';

        // }
        // elseif ($this->session->flashdata('active_update')!='') {
        //   echo '<div class="alert alert-info">';
        //   echo $this->session->flashdata('active_update');                    
        //   echo '</div>';

        // }
        // elseif ($this->session->flashdata('delete_update')!='') {
        //   echo '<div class="alert alert-info">';
        //   echo $this->session->flashdata('delete_update');                    
        //   echo '</div>';

        // }
        //elseif ($this->session->flashdata('update_sucess')!='') {
       //   echo "<div class='emplty_msg_class green'>";
       //   echo $this->session->flashdata('update_sucess');
       //   echo "</div>";
       // } ?>
       <div class="form-group">
        <label for="inputName1" class="control-label">Assessment Type</label>
        <input type="text" class="form-control" name="assesment_type_name_update" value="<?php echo $records[0]->Type; ?>" id="inputName1" placeholder="Enter an Assessment Type" autocomplete="off" required>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group">
        <label for="inputEmail" class="control-label">Assessment Rate</label>
        <input type="number" name="assesment_rate_name_update" value="<?php echo $records[0]->Rates; ?>" class="form-control" id="inputEmail" placeholder="Enter an Assessment Rate" autocomplete="off" required>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-check">
        <label class="custom-control custom-checkbox">
          <input id="ContentPlaceHolder1_isActive" type="checkbox" name="ContentPlaceHolder1isActive" class="custom-control-input" <?php if($records[0]->isActive==1){ echo "checked='checked'"; } ?> >
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description">Active</span>
        </label>
      </div>

      <div class="form-group">
        <button type="submit" name="ContentPlaceHolder1btn_addmanage" class="btn btn-rounded btn-sm btn-primary">Update Asessment</button>
        <button type="button" class="btn  btn-rounded btn-sm btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url()."assesment_type/view/";?>';">Cancel</button> 
      </div>
    </form>
<!--     <div>
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
                        <table id="isActive" class="display">
                          <thead>
                            <tr>
                              <th>Assessment Type</th>
                              <th>Rate</th>        
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

                  <!------------- Archive -------------------->
                  <div class="col-sm-12">
                    <!-- <div class="white-box"> -->
                    <!-- <h3 class="box-title m-b-0">Data Export</h3>
                      <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p> -->
                      <div class="table-responsive">
                       <div id="archiveTable">
                        <table id="isArchive" class="display">
                          <thead>
                            <tr>
                              <th>Assessment Type</th>
                              <th>Rate</th>        
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
            <!-- /.row -->
            <script>
              $(document).ready(function(){
                $('.alert, .alert-info').delay('3000').fadeOut(300);
  //  $('#isArchive_normal').DataTable();
  $('#isActive').DataTable({
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
    'url':'<?=base_url()?>assesment_type/get_ajaxpagination_view_active'
  },
  'columns': [
  { data: 'Type' },
  { data: 'Rates' },   
  { data: 'action' },           
  ]
});
  //// Archive
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
    'url':'<?=base_url()?>assesment_type/get_ajaxpagination_view_archive'
  },
  'columns': [
  { data: 'Type' },
  { data: 'Rates' },   
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