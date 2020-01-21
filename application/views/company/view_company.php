
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">

<div class="row">
  <div class="col-sm-12">
    <div class="white-box">
        
       <?php
        if ($this->session->flashdata('success') != '') {
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('success');
          echo "</div>";
        }
        ?>

      <div class="row button-box">
     <div class="col-lg-2 col-sm-4 col-xs-12">
      <button id="active_btn" name="active_btn" class="btn btn-block btn-success">ACTIVE</button>
    </div>
    <!-- <div class="col-lg-2 col-sm-4 col-xs-12">
      <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">ARCHIVED</button>
    </div> -->

    <div class="col-lg-10 col-sm-14 col-xs-12">
                                    
                        <button class="btn pull-right m-l-25 btn-primary btn-rounded" onclick="location.href='<?php echo base_url();?>admin_company/index'">Add</button>
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
                             <th>Company ID</th>
                              <th>Company Name</th>        
                              <th>App Status</th>
                              <th>Status</th>
                              <th>Number of Employees Licensed</th>
                              <th>Number of Employees Non-Licensed</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                                        <?php
                                         $i=1;

                                    foreach($records as $row => $value)
                                            {                                      
                                              if($value->Status == 1 )
                                              {
                                                $act = 'Active';
                                              }
                                              elseif($value->Status == 2)
                                              {
                                                $act = 'Expired';
                                              }
                                              elseif($value->Status == 3)
                                                  { 
                                                $act = 'Suspended';
                                                    }
                                              elseif($value->Status == 4){
                                                $act = 'Closed Down';
                                                    }

                                        ?>
                                      <tr>    
                                      <td> <?php echo $value->CompanyID; ?> </td>
                                      <td> <?php echo $value->CompanyName; ?> </td>
                                      <td>0</td>
                                      <td><?php echo $act; ?></td>
                                      <td>0</td>
                                      <td>0</td>
                                      <td ><a href = '<?php echo "edit/".$value->CompanyID; ?>'>

                                        <i class="fa fa-pencil text-inverse m-r-10"></i></a></td>
                                      
                                      </tr>
                                      
                                      <?php 
                                      $i++; 
                                  }

                                       ?>
                                       </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- </div> -->
                  </div>
                    
                      
                  
               

<!-- <div class="col-sm-12">
    
                      <div class="table-responsive">
                       <div id="activeTable">
                        <table id="isActive" class="display">
                          <thead>
                            <tr>
                              <th>Company ID</th>
                              <th>Company Name</th>        
                              <th>App Status</th>
                              <th>Status</th>
                              <th>Number of Employees Licensed</th>
                              <th>Number of Employees Non-Licensed</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  
                </div> -->

                        

                    </div>
                    </div>
                    </div>
        
                                    
    
    
    
    
                    </div>
                    </div>
                  </div>

<script type="text/javascript">
  $(document).ready( function () {
    $('.alert, .alert-success').delay('3000').fadeOut(300);
  $('#isActive_message').DataTable({
  aoColumnDefs: [
    {
     bSortable: false,
     aTargets: [ -1, -2, -3, -5 ]
   }
   ]});

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