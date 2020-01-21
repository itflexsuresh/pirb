<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url()."assets/css/custom-form-style.css"; ?>">
 <?php
 $attributes_installationType = array('class' => 'Manage_Area','data-toggle' => 'validator', 'id' => 'Manage_area', 'method' => 'post');
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
        echo form_open_multipart('system_users/add_insert', $attributes_installationType);
        ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputName1" class="control-label">Name*</label>
              <input name="user_name" type="text" id="ContentPlaceHolder1_user_name" value="<?php if($this->session->flashdata('name')!==''){echo $this->session->flashdata('name');} ?>" class="form-control" placeholder="Name" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputEmail" class="control-label">Surname*</label>
              <input name="name_surname" type="text" id="ContentPlaceHolder1_name_surname" value="<?php if($this->session->flashdata('surname')!==''){echo $this->session->flashdata('surname');} ?>" class="form-control" placeholder="Surname" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputEmail" class="control-label">Email*</label>
              <input name="user_email" type="email" id="ContentPlaceHolder1_user_email" value="<?php if($this->session->flashdata('Exmail')!==''){echo $this->session->flashdata('Exmail');} ?>" class="form-control" placeholder="Email" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputEmail" class="control-label">Pin*</label>
              <input name="user_password" type="password" id="ContentPlaceHolder1_user_password" class="form-control" placeholder="Pin" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-6">Role Type*</label>
              <div class="col-md-9">
                <select name="role_type" value="<?php if($this->session->flashdata('userRole')!==''){echo $this->session->flashdata('userRole');} ?>" class="form-control" aria-required="true" tabindex="1">
                 <option value="1" <?php if($this->session->flashdata('userRole')!=='' && $this->session->flashdata('userRole')==1){echo "selected='selected'";} ?>>Administrator</option>
                 <option value="6" <?php if($this->session->flashdata('userRole')!=='' && $this->session->flashdata('userRole')==6){echo "selected='selected'";} ?>>Local Authorities</option>
                 <option value="7" <?php if($this->session->flashdata('userRole')!=='' && $this->session->flashdata('userRole')==7){echo "selected='selected'";} ?>>Insurance</option>
                 <option value="8" <?php if($this->session->flashdata('userRole')!=='' && $this->session->flashdata('userRole')==8){echo "selected='selected'";} ?>>Guest</option>
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
              <textarea rows="4" cols="50" name="comment_area" value="<?php if($this->session->flashdata('commentBox')!==''){echo $this->session->flashdata('commentBox');} ?>"></textarea>
            </div>
          </div>
        </div>
        <!--/span-->
      </div>

      <div class="form-group">
        <div class="checkbox">
          <input name="ContentPlaceHolder1isActive" type="checkbox" id="terms">
          <label for="terms"> Active </label>    
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
          foreach ($menu_records as $key) { 
            $menu_id= $key->menu_id;
            $read_box_name = "read_box[]";
            $write_box_name = "write_box[]";
            ?>
            <tr>
              <?php if ($key->level==0) {
               ?>
               <td class="menus_td active"><?php echo $key->menu_name; ?></td>
               <td class="menus_td active"><input type="checkbox" class="main_menu_read <?php echo $key->menu_id; ?>" name="<?php echo $read_box_name; ?>" value="<?php echo $key->menu_id; ?>"></td>
               <td class="menus_td active"><input type="checkbox" class="main_menu <?php echo $key->menu_id; ?>" name="<?php echo $write_box_name; ?>" value="<?php echo $key->menu_id; ?>"></td>
               <?php 
             }else{
              ?> 
              <td><?php 
              echo $key->menu_name; 

              ?></td>
              <td><input type="checkbox" class="sub_menu_read <?php echo $key->parent_id; ?>" name="<?php echo $read_box_name; ?>" value="<?php echo $key->menu_id; ?>"></td>
              <td><input type="checkbox" class="sub_menu <?php echo $key->parent_id; ?>" name="<?php echo $write_box_name; ?>" value="<?php echo $key->menu_id; ?>"></td>
        <?php //echo '</div>'; 
      } ?>
    </tr>
  <?php }

  ?>
</tbody>
</table>
</div>
</div>
<div class="form-group">
  <button name="ContentPlaceHolder1btn_addmanage" type="submit" class="btn btn-rounded btn-sm btn-primary">Add System Users</button>
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
</script>