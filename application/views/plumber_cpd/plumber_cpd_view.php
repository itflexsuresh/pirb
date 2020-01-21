<?php
// print_r($plumber_details);
// die;
?>
<!-- .row -->
<div class="row">
    <input type="hidden" name="hidden_input_id" id="hidden_input_id" value="<?php echo $plumber_details[0]->UserID; ?>">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
           <!--  <h3 class="box-title m-b-0">Default Tab</h3>
            <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="nav-item"><a href="#home" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Home</span></a></li>
                <li role="presentation" class="active nav-item"><a href="#" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">CPD</span></a></li>
                <li role="presentation" class="nav-item"><a href="#messages" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Messages</span></a></li>
                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Settings</span></a></li>
                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Audit Review</span></a></li>
                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Plumber Accounts</span></a></li>
                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Assessments</span></a></li>
                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Doc/Letters</span></a></li>
                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Dairy & Comments</span></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <!----------------  Table  ------------------------>
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
                              <th>Date of Activity</th>
                              <th>Activity</th>
                              <th>CPD Stream</th>
                              <th>CPD Points</th>
                              <th>Status</th>
                              <th>Attachement</th>
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
                      <th>Date of Activity</th>
                      <th>Activity</th>
                      <th>CPD Stream</th>
                      <th>CPD Points</th>
                      <th>Status</th>
                      <th>Attachement</th>
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
<!--                     <div class="col-md-6">
                        <h3>Best Clean Tab ever</h3>
                        <h4>you can use it with the small code</h4>
                    </div>
                    <div class="col-md-5 pull-right">
                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                    </div> -->
                    <div class="clearfix"></div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    //alert($('#hidden_input_id').val());
    var UserID = $('#hidden_input_id').val();
    //alert(UserID);
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
      'url':'<?=base_url()?>plumber_cpd/get_ajaxpagination_view_active',
      'type' : 'post',
     'data' :{'UserID':UserID}

 },
 'columns': [
 { data: 'CreateDate' },
 { data: 'Activity'},
 { data: 'CPD_Stream'},
 { data: 'NoPoints'},
 { data: 'isApproved'},
 { data: 'PDF' },
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
      'url':'<?=base_url()?>plumber_cpd/get_ajaxpagination_view_archive',
      'type' : 'post',
      'data' :{'UserID':UserID}
  },
  'columns': [
  { data: 'CreateDate' },
  { data: 'Activity'},
  { data: 'CPD_Stream'},
  { data: 'NoPoints'},
  { data: 'isApproved'},
  { data: 'PDF' },
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
