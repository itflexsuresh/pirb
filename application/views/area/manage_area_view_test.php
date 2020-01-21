 <?php
 $attributes_installationType = array('class' => 'Manage_Area','data-toggle' => 'validator', 'id' => 'Manage_area', 'method' => 'post');
 ?>
 <!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
           <!--  <h3 class="box-title m-b-0">Form Validation</h3>
            <p class="text-muted m-b-30"> Bootstrap Form Validation</p> -->
            <!-- <form data-toggle="validator"> -->
              <?php
              echo form_open_multipart('manage_area_test/insert_records', $attributes_installationType);
              ?>
              <div class="form-group">
                <?php
                if ($this->session->flashdata('city_sucess')!='') {
                  echo "<div class='alert alert-success'>";
                  echo $this->session->flashdata('city_sucess');
                  echo "</div>";
                }

                elseif ($this->session->flashdata('suburb_sucess')!='') {
                  echo '<div class="alert alert-success">';
                  echo $this->session->flashdata('suburb_sucess');                    
                  echo '</div>';

                }elseif ($this->session->flashdata('suburb_update')!='') {
                  echo "<div class='alert alert-success'>";
                  echo $this->session->flashdata('suburb_update');
                  echo "</div>";
                }elseif ($this->session->flashdata('city_check')!='') {
                  echo "<div class='alert alert-danger'>";
                  echo $this->session->flashdata('city_check');
                  echo "</div>";
                }elseif ($this->session->flashdata('Archive_suburb')!='') {
                  echo '<div class="alert alert-success">';
                  echo $this->session->flashdata('Archive_suburb');
                  echo "</div>";
                }
                elseif ($this->session->flashdata('Active_suburb')!='') {
                  echo '<div class="alert alert-success">';
                  echo $this->session->flashdata('Active_suburb');
                  echo "</div>";
                }
                elseif ($this->session->flashdata('delete_suburb')!='') {
                  echo "<div class='alert alert-danger'>";
                  echo $this->session->flashdata('delete_suburb');
                  echo "</div>";
                }elseif ($this->session->flashdata('suburb_check')!='') {
                  echo "<div class='alert alert-danger'>";
                  echo $this->session->flashdata('suburb_check');
                  echo "</div>";
                }
                ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-4">Province</label>
                      <div class="col-md-13">
                        <select class="form-control" name="province_down" id="province_down" required="" aria-required="true" tabindex="1">
                          <option value="">select</option>

                          <option value="1" <?php if($this->session->flashdata('province_validate')==1 || $this->session->flashdata('province_citychk')==1){ echo 'selected="selected"'; } ?>>Gauten</option>
                          <option value="2" <?php if($this->session->flashdata('province_validate')==2 || $this->session->flashdata('province_citychk')==2){ echo 'selected="selected"'; } ?>>Eastern Cape</option>
                          <option value="3" <?php if($this->session->flashdata('province_validate')==3 || $this->session->flashdata('province_citychk')==3){ echo 'selected="selected"'; } ?>>Free State</option>
                          <option value="4" <?php if($this->session->flashdata('province_validate')==4 || $this->session->flashdata('province_citychk')==4){ echo 'selected="selected"'; } ?>>KwaZulu-Natal</option>
                          <option value="5" <?php if($this->session->flashdata('province_validate')==5 || $this->session->flashdata('province_citychk')==5){ echo 'selected="selected"'; } ?>>Limpopo</option>
                          <option value="6" <?php if($this->session->flashdata('province_validate')==6 || $this->session->flashdata('province_citychk')==6){ echo 'selected="selected"'; } ?>>Mpumalanga</option>
                          <option value="7"<?php if($this->session->flashdata('province_validate')==7 || $this->session->flashdata('province_citychk')==7){ echo 'selected="selected"'; } ?> >North West</option>
                          <option value="8" <?php if($this->session->flashdata('province_validate')==8 || $this->session->flashdata('province_citychk')==8){ echo 'selected="selected"'; } ?>>Northen Cape</option>
                          <option value="9" <?php if($this->session->flashdata('province_validate')==9 || $this->session->flashdata('province_citychk')==9){ echo 'selected="selected"'; } ?>>Wester Cape</option>
                        </select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="custom-control custom-radio">
                        <input type="radio" name="allthings" id="new" value="Newcity"<?php if($this->session->flashdata('radio_flash')=='Newcity'){ echo 'checked="checked"'; } ?> class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">New city</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="custom-control custom-radio">
                        <input type="radio" name="allthings" id="existing" value="Existingcity"<?php if($this->session->flashdata('radio_flash')!='Newcity'){ echo 'checked="checked"'; } ?> class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Existing city</span>
                      </label>
                    </div>
                  </div>
                </div>

                <?php //if($this->session->flashdata('radio_flash')!=='Newcity'){ 
                  if ($this->session->flashdata('province_citychk')!='') {
                   $select = "SELECT `ID` FROM `area` WHERE `ProvinceID`='".$this->session->flashdata('province_citychk')."'";
                        $resultSUB = $this->db->query($select)->result();

            
                  }
                        
                  ?>

                  <div class="row city-exist">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>City</label>
                        
                        <select class="form-control" name="city_down" id="city_down" required="" aria-required="true" tabindex="1">                          
                          <option value="">select</option>
                          <?php
foreach ($resultSUB as $key => $value) {
                         if ($this->session->flashdata('city_citychk')==$value) {
                          $dropDown_Data = 'selected="true"';
                        }else{
                          $dropDown_Data = '';
                        }
                        echo '<option '.$dropDown_Data.' value="'.$value.'">'.$key->Name.'</option>';
                        //echo '<option '.$dropDown_Data.' value="'.$value.'">'.$key->Name.'</option>';
}

                        ?>
                        </select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row suburb-manage">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="sub_lable">Suburb</label>
                        <input name="managesuburb" type="text" id="ContentPlaceHolder1_managesuburb" class="form-control" placeholder="Suburb" value="<?php if($this->session->flashdata('suburb_check')!==''){ echo $this->session->flashdata('suburb_flash'); } ?>">
                      </div>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                <?php  //} 
                //elseif($this->session->flashdata('radio_flash')=='Newcity'){ ?>
<!--                   <div class="row">
                    <div class="col-md-6">
                      <div  class="form-group">
                        <label>City</label>
                        <input  placeholder="Suburb" id="ContentPlaceHolder1_managecity" value="<?php // if($this->session->// flashdata('suburb_validate')!==''){ echo $this->session->flashdata('suburb_validate'); } ?>" type="text" class="form-control" required>
                      </div>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div> -->
                  <div class="row city-manage">
                    <div class="col-md-6">
                      <div  class="form-group">
<label>City</label>
                        <input name="managecity" type="text" id="ContentPlaceHolder1_managecity"placeholder="City" value="<?php if($this->session->flashdata('city_flash')!=''){ echo $this->session->flashdata('city_flash'); } ?>" class="form-control" required>
                      </div>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                <?php  //} ?>
                <!--- city text ---------->

                <!--- city text ---------->
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-rounded btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                      </div> -->
                      <div class="form-check">
                        <div class="checkbox">
                         <input name="ContentPlaceHolder1isActive" type="checkbox" id="terms">
                         <label for="terms"> Active </label>    
                       </div>
                     </div>
                     <div class="col-sm-1">
                      <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-rounded btn-sm btn-primary">Save</button>
                        </div>
                      </div>
                    </div>
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
                    <table id="isActive" class="display nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Subrub</th>
                          <th>City</th>
                          <th>Province</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                // $base = base_url();
                // $url = '"'base_url()'."Installation_type/installation_type_update/"';
                        $all_data = $this->db->get('areasuburbs');
                        $sel_data = $all_data->result();

                        foreach ($sel_data as $key) {
                          $query = $this->db->get_where("area",array("ID"=>$key->CityID));
                          $icity_name = $query->result();
                    //if($key->is_active==1){   

                          foreach ($icity_name as $CKey) {
                           $query1 = $this->db->get_where("province",array("ID"=>$key->ProvinceID));
                           $province_name = $query1->result();
                           foreach ($province_name as $PKey) {
                        //echo $key->is_active;?>
                        
                        <?php if ($key->isActive==1) { ?>
                          <tr>
                            <td id="ones"><?php echo $key->Name; ?></td>
                            <td id="ones"><?php echo $CKey->Name; ?></td>
                            <td id="ones"><?php echo $PKey->Name; ?></td>                            
                            <td id="ones"><div class="col-sm-6 col-md-4 col-lg-3"><a href='<?php echo base_url()."Manage_area_test/addToArchive/".$key->SuburbID; ?>' data-toggle="tooltip" data-original-title="Add To Archive" onclick="return confirm('You Want Move This To Archive ?');" ><i class="fa fa-check-circle"></i></a></div> <a href='<?php echo base_url()."Manage_area_test/update/".$key->SuburbID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a></td>
                            <!-- <td id="ones"><a href = '<?php // echo $key->SuburbID; ?>'><img src="<?php // echo base_url(); ?>assets/images/edit.png" height="25" width="25"></a></td> -->
                          </tr>
                        <?php   }  ?>



                      <?php } } }  ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- </div> -->
            </div>

            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="archiveTable">
                  <table id="isArchive" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Subrub</th>
                        <th>City</th>
                        <th>Province</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                // $base = base_url();
                // $url = '"'base_url()'."Installation_type/installation_type_update/"';
                      $all_data1 = $this->db->get('areasuburbs');
                      $sel_data0 = $all_data1->result();

                      foreach ($sel_data0 as $sel_data1) {
                        $query1 = $this->db->get_where("area",array("ID"=>$sel_data1->CityID));
                        $icity_name1 = $query1->result();
                    //if($sel_data1->is_active==1){   

                        foreach ($icity_name1 as $Csel_data1) {
                         $query11 = $this->db->get_where("province",array("ID"=>$sel_data1->ProvinceID));
                         $province_name1 = $query11->result();
                         foreach ($province_name1 as $Psel_data1) {
                        //echo $sel_data1->is_active;?>
                        
                        <?php if ($sel_data1->isActive==0) { ?>
                          <tr>
                            <td id="zeros"><?php echo $sel_data1->Name; ?></td>
                            <td id="zeros"><?php echo $Csel_data1->Name; ?></td>
                            <td id="zeros"><?php echo $Psel_data1->Name; ?></td>
                            <td id="zeros"><div class="col-sm-6 col-md-4 col-lg-3"><a href='<?php echo base_url()."Manage_area_test/addToActive/".$sel_data1->SuburbID; ?>' data-toggle="tooltip" data-original-title="Add To Active" onclick="return confirm('You Want Move This To Active ?');"><i class="fa fa-check-circle"></i></a></div> <a href='<?php echo base_url()."Manage_area_test/update/".$sel_data1->SuburbID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href='<?php echo base_url()."Manage_area_test/deleteArea/".$sel_data1->SuburbID; ?>' data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger" onclick="return confirm('You Want Delete This ?');"></i> </a></td>
                            <!--  <td id="zeros"><a href = '<?php // echo $sel_data1->SuburbID; ?>'><img src="<?php // echo base_url(); ?>assets/images/edit.png" height="25" width="25"></a></td> -->
                          </tr>
                        <?php   }  ?>



                      <?php } } }  ?>

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
          $('#archive_btn').css("color","#333");
          $('#archive_btn').css("background-color","#ebebeb");
          $('#archive_btn').css("border-color","#adadad");
          $('#ContentPlaceHolder1_managecity').hide().prop('required',false);
   //$('#city_down').show().prop('required',true);
   $('.sub_lable').show();
   $('#ContentPlaceHolder1_managesuburb').show().prop('required',true);
   $('#isActive').DataTable({
    "order": [],
    aoColumnDefs: [
    {
     bSortable: false,
     aTargets: [ -1 ]
   }
   ]
 }); 
   $('#isArchive').DataTable({
    "order": [],
    aoColumnDefs: [
    {
     bSortable: false,
     aTargets: [ -1 ]
   }
   ]
 });
   $('#archiveTable').hide();
   
   
   $('#archive_btn').click(function(){
    $('#activeTable').hide();
    $('#archiveTable').show();
    $('#archive_btn').css("color","#333");
    $('#archive_btn').css("background-color","#00c292");
    $('#archive_btn').css("border-color","#adadad");
    $('#active_btn').css("color","#333");
    $('#active_btn').css("background-color","#ebebeb");
    $('#active_btn').css("border-color","#adadad");


  });
   $('#active_btn').click(function(){
    $('#activeTable').show();
    $('#archiveTable').hide();
    $('#active_btn').css("color","#333");
    $('#active_btn').css("background-color","#00c292");
    $('#active_btn').css("border-color","#adadad");      
    $('#archive_btn').css("color","#333");
    $('#archive_btn').css("background-color","#ebebeb");
    $('#archive_btn').css("border-color","#adadad");
    
    
  });

   if ($("#new").prop("checked")) {
    $('.city-manage').show();
    $('.city-exist').hide();
    $('.suburb-manage').hide();
    $('#city_down').hide().prop('required',false);
    $('#ContentPlaceHolder1_managecity').show().prop('required',true);
  }else{
    $('.city-exist').show();
    $('.city-manage').hide();
    $('.suburb-manage').show();
    $('#ContentPlaceHolder1_managecity').hide().prop('required',false);
    $('#city_down').show().prop('required',true);

    $('#ContentPlaceHolder1_managesuburb').show().prop('required',true);
  }

  $('#new').on('click', function(){
    //$('#active_lable').hide();
    //$('#ContentPlaceHolder1_isActive').hide();
    //$('#ContentPlaceHolder1_isActive').hide().prop('required',false);
    $('.city-manage').show();
    $('.city-exist').hide();
    $('.suburb-manage').hide();
    $('#city_down').hide().prop('required',false);
    $('#ContentPlaceHolder1_managecity').show().prop('required',true);
    
    $('#ContentPlaceHolder1_managesuburb').hide().prop('required',false);
    
  });

  $('#existing').on('click', function(){
    $('.city-exist').show();
    $('.city-manage').hide();
    $('.suburb-manage').show();
    $('#ContentPlaceHolder1_managecity').hide().prop('required',false);
    $('#city_down').show().prop('required',true);

    $('#ContentPlaceHolder1_managesuburb').show().prop('required',true);



  });
  var proId = $('#province_down').val();
  if (proId!='') {
          $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Manage_area/fetch_city',
        data:'ajaxprovince_id='+proId,
        success:function(html){
          $('#city_down').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                  }
                }); 
  }

  $('#province_down').on('change', function(){
    var provinceID = $(this).val();
    if(provinceID){
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Manage_area/fetch_city',
        data:'ajaxprovince_id='+provinceID,
        success:function(html){
          $('#city_down').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                  }
                }); 
    }else{

      $('#city_down').html('<option value="">Select province first</option>'); 
    }
  });
  $('.installation_sucess-msg, .green').delay('3000').fadeOut(300);



});
</script>