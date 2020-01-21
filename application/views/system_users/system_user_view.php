<div class="row">
  <div class="col-md-12">
    <div class="white-box">
      <?php
      if($this->session->flashdata('insert_sucess')!=''){
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('insert_sucess');
        echo '</div>';
      }elseif ($this->session->flashdata('email_check')!='') {
        echo '<div class="alert alert-danger">';
        echo $this->session->flashdata('email_check');                    
        echo '</div>';

      }elseif ($this->session->flashdata('update_sucess')!='') {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('update_sucess');
        echo "</div>";
      }
      elseif ($this->session->flashdata('Archive_userss')!='') {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('Archive_userss');
        echo "</div>";
      }
      elseif ($this->session->flashdata('Active_userss')!='') {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('Active_userss');
        echo "</div>";
      }elseif ($this->session->flashdata('delete_userss')!='') {
        echo '<div class="alert alert-danger">';
        echo $this->session->flashdata('delete_userss');
        echo "</div>";
      }

      ?>
      <div class="row button-box">
       <div class="col-lg-2 col-sm-4 col-xs-12">
        <button id="active_btn" name="active_btn" class="btn btn-block btn-success">ACTIVE</button>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-12">
        <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">ARCHIVED</button>
      </div>
      <div class="col-lg-8 col-sm-13 col-xs-12">
        <button type="button" name="ContentPlaceHolder1btn_addmanage" class="btn pull-right m-l-25 btn-primary btn-rounded" onclick="window.location.href = '<?php echo base_url()."system_users/addnew_view/";?>';">Add Users</button>
      </div>
    </div>  

    <div id="activeTable">
      <div class="table-responsive">
        <!-- <table id="isActive_normal" class="table table-bordered table-striped"> -->
          <table id="isActive_normal" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Role</th>
                <th>Email Address</th>
                <th>Pin</th>
                <th> </th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
             <?php
             foreach ($records as $row) {
               if ($row->role==1 || $row->role==6 || $row->role==7 || $row->role==8) {
     //print_r($row->password); ?>
     
     <?php if($row->status==1){ ?>
      <tr>
        <td><?php echo $row->fname; ?></td>
        <td><?php echo $row->lname; ?></td>
        <?php 
        $query = $this->db->get_where('role', array('id' => $row->role, ));
        $result = $query->result();
        foreach ($result as $roleId) { 
          $ciphering = "AES-128-CTR"; 
          $options = 0;
          $decryption_iv = '1234567891011121'; 

// Store the decryption key 
          $decryption_key = "GeeksforGeeks"; 

// Use openssl_decrypt() function to decrypt the data 
          $decryption=openssl_decrypt ($row->password, $ciphering,  
            $decryption_key, $options, $decryption_iv); 
            ?>
            <td><?php echo $roleId->role; ?></td>

          <?php   }
          ?>

          <td><?php echo $row->email; ?></td>
          <td><?php echo $decryption; ?></td>
          <td><a href='<?php echo base_url()."system_users/update_view/".$row->UserID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a></td>
          <!-- <td> <a href = '<?php // echo base_url()."system_users/update_view/".$row->UserID; ?>'><img src="<?php // echo base_url(); ?>assets/images/edit.png" height="25" width="25"></a></td> -->
          <td><div class="col-sm-6 col-md-4 col-lg-6"><a href='<?php echo base_url()."system_users/addToArchive/".$row->UserID; ?>' data-toggle="tooltip" data-original-title="Add To Archive"> <i class="fa fa-check-circle" onclick="return confirm('You Want Move This To Archive ?');"></i></a></div></td>
        </tr>
      <?php } ?>

    <?php   } ?>

 <?php } //exit;

 ?>
</tbody>
</table>
</div>
</div>

<div id="archiveTable">
  <div class="table-responsive">
    <table id="isArchive_normal" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Role</th>
          <th>Email Address</th>
          <th>Pin</th>
          <th> </th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <?php
 //print_r($records);
        foreach ($records as $row1) {
         if ($row1->role==1 || $row1->role==6 || $row1->role==7 || $row1->role==8) {
     //print_r($row->password); ?>
     
     <?php if($row1->status==0){ 
      $ciphering = "AES-128-CTR"; 
      $options = 0;
      $decryption_iv1 = '1234567891011121'; 

// Store the decryption key 
      $decryption_key1 = "GeeksforGeeks"; 

// Use openssl_decrypt() function to decrypt the data 
      $decryption1=openssl_decrypt ($row1->password, $ciphering,  
        $decryption_key1, $options, $decryption_iv1); 
        ?>
        <tr>
          <td><?php echo $row1->fname; ?></td>
          <td><?php echo $row1->lname; ?></td>
          <?php 
          $query1 = $this->db->get_where('role', array('id' => $row1->role, ));
          $result1 = $query1->result();
          foreach ($result1 as $roleId1) { ?>
            <td><?php echo $roleId1->role; ?></td>

          <?php   }
          ?>

          <td><?php echo $row1->email; ?></td>
          <td><?php echo $decryption1; ?></td>
          <td><a href='<?php echo base_url()."system_users/update_view/".$row1->UserID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a><a href="<?php echo base_url()."system_users/delete/".$row1->UserID; ?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('You Want Delete This ?');"><i class="fa fa-close text-danger"></i></a></td>
          <!-- <td> <a href = '<?php // echo "update_view/".$row1->UserID; ?>'><img src="<?php // echo base_url(); ?>assets/images/edit.png" height="25" width="25"></a></td> -->
          <td><div class="col-sm-6 col-md-4 col-lg-6"><a href='<?php echo base_url()."system_users/addToActive/".$row1->UserID; ?>' data-toggle="tooltip" data-original-title="Add To Active"> <i class="fa fa-check-circle" onclick="return confirm('You Want Move This To Active ?');"></i></a></div></td>
        </tr>
      <?php } ?>

    <?php   }
 } //exit;

 ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<script>
  $(document).ready(function(){
    $('.alert, .alert-success').delay('3000').fadeOut(300);
    $('.alert, .alert-danger').delay('3000').fadeOut(300);
    $('#isArchive_normal').DataTable({
     aoColumnDefs: [
     {
       bSortable: false,
       aTargets: [ -1,-2 ]
     }
     ]
   });
    $('#isActive_normal').DataTable({
     aoColumnDefs: [
     {
       bSortable: false,
       aTargets: [ -1,-2 ]
     }
     ],
     
   });
    $('#archiveTable').hide();
    $('#archive_btn').css("color","#333");
    $('#archive_btn').css("background-color","#ebebeb");
    $('#archive_btn').css("border-color","#adadad");

    $('#isArchive_normal').hide();
    $('#archive_btn').click(function(){
      $('#archiveTable').show();
      $('#isArchive_normal').show();
      $('#isActive_normal').hide();
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
      $('#isArchive_normal').hide();
      $('#isActive_normal').show(); 
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