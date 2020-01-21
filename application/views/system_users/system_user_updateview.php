<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url()."assets/css/custom-form-style.css"; ?>">
<?php
$attributes_installationType = array('class' => 'Manage_Area','data-toggle' => 'validator', 'id' => 'Manage_area', 'method' => 'post');
 //$userID = $this->session->userdata('update_userId');
?>
<!-- .row -->
<div class="row">
  <div class="col-sm-12">
    <div class="white-box">            
      <!-- <form data-toggle="validator"> -->
        <?php
        if ($this->session->flashdata('email_check')!='') {
          echo "<div class='alert alert-danger'>";
          echo $this->session->flashdata('email_check');
          echo "</div>";
        }
        ?>
        <?php
        echo form_open_multipart('system_users/add_update/'.$usr_id.'', $attributes_installationType);
        ?>
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-xs-11">
            <button type="button" name="ContentPlaceHolder1btn_addmanage" class="btn pull-right m-l-25 btn-primary btn-rounded btn-inverse" onclick="window.location.href = '<?php echo base_url()."system_users/view/";?>';">Go Back</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                        <?php //print_r($data);exit;

                        foreach ($data as $key) {
            //echo $key->status;
          //echo $key->Comments; ?>

          <label for="inputName1" class="control-label">Name*</label>
          <input name="user_name" type="text" id="ContentPlaceHolder1_user_name" value="<?php echo $key->fname; ?>" class="form-control" placeholder="Name" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputEmail" class="control-label">Surname*</label>
          <input name="name_surname" type="text" id="ContentPlaceHolder1_name_surname" value="<?php echo $key->lname; ?>" class="form-control" placeholder="Surname" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputEmail" class="control-label">Email*</label>
          <input name="user_email" type="email" id="ContentPlaceHolder1_user_email" value="<?php echo $key->email; ?>" class="form-control" placeholder="Email" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <?php
      // Non-NULL Initialization Vector for decryption 
      $ciphering = "AES-128-CTR"; 
      $options = 0;
      $decryption_iv = '1234567891011121'; 

// Store the decryption key 
      $decryption_key = "GeeksforGeeks"; 

// Use openssl_decrypt() function to decrypt the data 
      $decryption=openssl_decrypt ($key->password, $ciphering,  
        $decryption_key, $options, $decryption_iv); 
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputEmail" class="control-label">Pin*</label>
            <input name="user_password" type="password" id="ContentPlaceHolder1_user_password"class="form-control" placeholder="Pin" value="<?php echo $decryption; ?>" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-6">Role Type*</label>
            <div class="col-md-9">
              <?php 
              $query_role = $this->db->get_where("role", array("id"=>$key->role));
              $role_deatils = $query_role->result();
              ?>
              <select name="role_type" class="form-control">
               <option value="1" <?php if($key->role==1){ echo "selected='selected'"; } ?>>Administrator</option>
               <option value="6" <?php if($key->role==6){ echo "selected='selected'"; } ?>>Local Authorities</option>
               <option value="7" <?php if($key->role==7){ echo "selected='selected'"; } ?>>Insurance</option>
               <option value="8" <?php if($key->role==8){ echo "selected='selected'"; } ?>>Guest</option>
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div>
       </div>
       <!--/span-->
       <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-6">Comments</label>
          <div class="col-md-9">
            <textarea rows="4" cols="50" name="comment_area"><?php echo $key->Comments; ?></textarea>
          </div>
        </div>
      </div>
      <!--/span-->
    </div>

    <div class="row">
      <div class="form-group">
        <div class="checkbox">
          <input type="checkbox" name="ContentPlaceHolder1isActive" <?php if($key->status==1){ echo "checked='checked'" ;} ?> type="checkbox" id="terms">
          <label for="terms"> Active </label>    
        </div>

      </div>

    </div>

    <!-- </div> -->
    <div class="table_overall_system_users">
      <div class="table-responsive">
        <table class="table table-bordered">
         <thead>

          <tr>
            <th>Permission</th>
            <th>Read</th>
            <th>write</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $this->db->select("menu_id,permission");
          $menu_check_arr =  array();
          $select_query = $this->db->get_where('page_rights', array('UserID' => $key->UserID));
          $menu_records1 = $select_query->result();
          foreach($menu_records1  as $key=>$val){
            $menu_check_arr[$val->menu_id]=$val->permission;
          }     

          $menu_query = $this->db->get('menu');
          $menu_records = $menu_query->result();

          foreach ($menu_records as $key1) { 

            $menu_id = $key1->menu_id;
            $check_val = 0;
            if(array_key_exists($menu_id, $menu_check_arr)==TRUE){
              $check_val = $menu_check_arr[$menu_id];
            }
            $check_read_status = '';
            $check_write_status = '';
            if($check_val>0){
              $check_read_status = "checked=checked";
            }
            if($check_val>1){
              $check_write_status = "checked=checked";
            }
          //$read_box_name = "read_box[$menu_id]";
            $read_box_name = "read_box[]";
            $write_box_name = "write_box[]";
            ?>
            <tr>
              <?php if ($key1->level==0) {
          //echo '<div class="menu_head">';
               ?>
               <td class="active"><?php echo $key1->menu_name; ?></td>
               <td class="active"><input type="checkbox" class="main_menu_read <?php echo $key1->menu_id; ?>" name="<?php echo $read_box_name; ?>" value="<?php echo $key1->menu_id; ?>" <?php echo $check_read_status; ?>></td>
               <td class="active"><input type="checkbox" class="main_menu <?php echo $key1->menu_id; ?>" name="<?php echo $write_box_name; ?>" value="<?php echo $key1->menu_id; ?>" <?php echo $check_write_status; ?>></td>
        <?php //echo '</div>'; 
      }else{ 
          //echo '<div class="sub_menu">';
        ?> 
        <td><?php 
        echo $key1->menu_name; 

        ?></td>
        <td><input type="checkbox" class="sub_menu_read <?php echo $key1->parent_id; ?>" name="<?php echo $read_box_name; ?>" value="<?php echo $key1->menu_id; ?>" <?php echo $check_read_status; ?>></td>
        <td><input type="checkbox" class="sub_menu <?php echo $key1->parent_id; ?>" name="<?php echo $write_box_name; ?>" value="<?php echo $key1->menu_id; ?>" <?php echo $check_write_status; ?>></td>
        <?php //echo '</div>'; 
      } ?>
    </tr>
  <?php } 

  ?>
</tbody>
</table>
</div>
</div>
<?php     }

?>
<div class="form-group">
  <button name="ContentPlaceHolder1btn_addmanage" type="submit" class="btn btn-rounded btn-sm btn-primary">Update System Users</button>
  <button type="button" class="btn  btn-rounded btn-sm btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url()."system_users/view/";?>';">Cancel</button>
</div>

</form>
</div>
</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/style.js"></script>
<script type="text/javascript">
  $('.alert, .alert-success').delay('3000').fadeOut(300);
  $('.alert, .alert-danger').delay('5000').fadeOut(500);
  $('.btn, .btn-rounded, .btn-sm, .btn-primary, .disabled').click(function(){
    $("#ContentPlaceHolder1_user_password").focus();

//     if($('#ContentPlaceHolder1_user_name').val()!=''){
//   $('#ContentPlaceHolder1_user_name').focus();
// }
//  if($('#ContentPlaceHolder1_name_surname').val()!=''){
//   $('#ContentPlaceHolder1_name_surname').focus();
// }
// if($('#ContentPlaceHolder1_user_email').val()!=''){
//   $('#ContentPlaceHolder1_user_email').focus();
// }
// if($('#ContentPlaceHolder1_user_email').val()!=''){
//   $('#ContentPlaceHolder1_user_email').focus();
// }
// if($('#ContentPlaceHolder1_user_password').val()!=''){
//   $('#ContentPlaceHolder1_user_password').focus();
// }

  })
</script>