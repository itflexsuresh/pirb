 <?php
 $attributes_installationType = array('class' => 'Message_view', 'id' => 'Message_view', 'method' => 'post',"data-toggle"=>"validator");
 ?><!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <!-- <p class="text-muted m-b-30"> Bootstrap Form Validation</p> -->
      <?php
      echo form_open_multipart('',$attributes_installationType);
      ?>
      <!-- <form data-toggle="validator"> -->
        <?php
        if($this->session->flashdata('new_msg_sucess')!=''){
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('new_msg_sucess');
          echo '</div>';
        }elseif($this->session->flashdata('delete_sucess')!=''){
          echo "<div class='alert alert-danger'>";
          echo $this->session->flashdata('delete_sucess');
          echo '</div>';
        }elseif($this->session->flashdata('update_sucess')!=''){
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('update_sucess');
          echo '</div>';
        }
        //elseif ($this->session->flashdata('update_sucess')!='') {
       //   echo "<div class='emplty_msg_class green'>";
       //   echo $this->session->flashdata('update_sucess');
       //   echo "</div>";
       // } ?>


<!--        <div class="form-group">
        <button type="button" name="ContentPlaceHolder1btn_addmanage" class="btn btn-rounded btn-sm btn-primary" onclick="window.location.href = '<?php //echo base_url()."message/new_message_view/";?>';" >Add</button>
        
      </div> -->


    </form>
<!--   <div>
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
  <div class="col-lg-8 col-sm-13 col-xs-12">
        <button type="button" name="ContentPlaceHolder1btn_addmanage" class="btn pull-right m-l-25 btn-primary btn-rounded" onclick="window.location.href = '<?php echo base_url()."message/new_message_view/";?>';">Add Message</button>
      </div>
</div>
<div class="col-sm-12">
  <!-- <div class="white-box"> -->
                    <!-- <h3 class="box-title m-b-0">Data Export</h3>
                      <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p> -->
                      <div class="table-responsive">
                       <div id="activeTable-message">
                        <table id="isActive_message" class="display">
                          <thead>
                            <tr>
                              <th>Message Group</th>
                              <th>Message Start Date</th>
                              <th>Message End Date</th>
                              <th>Message Text</th>
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
                       <div id="historyTable-message">
                        <table id="historyTable_message" class="display">
                          <thead>
                            <tr>
                             <th>Message Group</th>
                             <th>Message Start Date</th>
                             <th>Message End Date</th>
                             <th>Message Text</th>
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
         <!-- /.row -->
         <script>
          $(document).ready(function(){
            $('.alert, .alert-success').delay('3000').fadeOut(300);
            $('.alert, .alert-danger').delay('3000').fadeOut(300);
            $('#historyTable-message').hide();
            $('#archive_btn').css("color","#333");
            $('#archive_btn').css("background-color","#ebebeb");
            $('#archive_btn').css("border-color","#adadad");
            $('#isActive_message').DataTable({
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
               'url':'<?=base_url()?>message/get_ajaxpagination_view'
             },
             'columns': [
             { data: 'MessageGroup' },
             { data: 'MessageStart' },
             { data: 'MessageEnd' },
             { data: 'Message' },  
             { data: 'action' },           
             ]
           });
    // History table

    $('#historyTable_message').DataTable({
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
       'url':'<?=base_url()?>message/get_ajaxpagination_view_history'
     },
     'columns': [
     { data: 'MessageGroup' },
     { data: 'MessageStart' },
     { data: 'MessageEnd' },
     { data: 'Message' },
     { data: 'action' },
     ]
   });
    /// Active Button

    $('#archive_btn').click(function(){
      $('#activeTable-message').hide();
      $('#historyTable-message').show();
      $('#archive_btn').css("color","#333");
      $('#archive_btn').css("background-color","#00c292");
      $('#archive_btn').css("border-color","#adadad");
      $('#active_btn').css("color","#333");
      $('#active_btn').css("background-color","#ebebeb");
      $('#active_btn').css("border-color","#adadad");
      /// Archive Button
    });
    $('#active_btn').click(function(){
      $('#activeTable-message').show();
      $('#historyTable-message').hide();
      $('#active_btn').css("color","#333");
      $('#active_btn').css("background-color","#00c292");
      $('#active_btn').css("border-color","#adadad");      
      $('#archive_btn').css("color","#333");
      $('#archive_btn').css("background-color","#ebebeb");
      $('#archive_btn').css("border-color","#adadad");


    });
  });
</script>