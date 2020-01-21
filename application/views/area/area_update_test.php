 <?php
 $attributes_installationType = array('class' => 'Installation_type','data-toggle' => 'validator', 'id' => 'Installation_type1', 'method' => 'post');
 //$areasubID = $this->session->userdata('areasuburb_id');
 ?>
 <!-- .row -->
 <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <!-- <form data-toggle="validator"> -->
        <?php
        echo form_open_multipart('Manage_area_test/getupdate/'.$areasuburb_id.'', $attributes_installationType);
        ?>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Post Code</label>
              <select name="Province_down" id="Province_down" class="form-control" aria-required="true" tabindex="1">
                <?php

                foreach ($data as $row) {
                  $query = $this->db->get("province");
                  $province_name = $query->result();
           // print_r($sub_id);
                  foreach ($province_name as $Ikey) {
                    ?>
                    <option value="<?php echo $Ikey->ID; ?>" <?php if($Ikey->ID == $row->ProvinceID) echo "selected='selected'"; ?> ><?php echo $Ikey->Name; ?></option>
                    <?php
                  }
                  ?>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <select name="city_down" id="city_down" class="form-control" aria-required="true" tabindex="1">
                  <?php
                  $this->db->where('ProvinceID', $data[0]->ProvinceID);
                  $city_query = $this->db->get("area");
                  $city_name = $city_query->result();
                  foreach ($city_name as $Ckey) {

                    ?>
                    <option value="<?php echo $Ckey->ID; ?>" <?php if($Ckey->ID == $row->CityID) echo 'selected = "selected"';?> ><?php echo $Ckey->Name; ?></option>
                    <?php
                  }
                  ?>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">                                 
                <label>Suburb</label>              
                <input type="text" name="Suburb_update" class="form-control" id="ContentPlaceHolder1_Suburb_update" placeholder="Enter an Suburb" value="<?php echo $row->Name; ?>" data-error="Enter Suburb" required>             
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="checkbox">
             <input name="ContentPlaceHolder1isActive" <?php if($row->isActive ==1) echo "checked='checked'"; ?> type="checkbox" id="terms">
             <label for="terms"> Active </label>    
           </div>

         </div>




<!--               <div class="form-check">
                <div class="checkbox">
                  <input name="ContentPlaceHolder1isActive" <?php //if($row->isActive ==1) echo "checked='checked'"; ?> type="checkbox" id="ContentPlaceHolder1_isActive">
                 <label for="terms"> Active </label>    
               </div>
             </div> -->


             <?php
           }
           ?>
           <div class="form-group">
            <button type="submit" class="btn btn-rounded btn-sm btn-primary">Save</button>
            <button type="button" class="btn  btn-rounded btn-sm btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url()."manage_area/view/";?>';" >Cancel</button>
          </div>
        </form>

        <div class="row button-box">
         <div class="col-lg-2 col-sm-4 col-xs-12">
          <button id="active_btn" name="active_btn" class="btn btn-block btn-success">ACTIVE</button>
        </div>
        <div class="col-lg-2 col-sm-4 col-xs-12">
          <button id="archive_btn" name="archive_btn" class="btn btn-block btn-success">ARCHIVED</button>
        </div>
        <div class="col-lg-8 col-sm-13 col-xs-12">
          <button type="button" name="ContentPlaceHolder1btn_addmanage" class="btn pull-right m-l-25 btn-primary btn-rounded" onclick="window.location.href = '<?php echo base_url()."Manage_area/view/";?>';">Add Manage Area</button>
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
                  <th>Action</th>
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
                            <td id="ones"><div class="col-sm-6 col-md-4 col-lg-3"><a href='<?php echo base_url()."Manage_area_test/addToArchive/".$key->SuburbID; ?>' data-toggle="tooltip" data-original-title="Add To Archive" onclick="return confirm('You Want Move This To Archive ?');" ><i class="fa fa-check-circle"></i></a></div><a href='<?php echo base_url()."Manage_area_test/update/".$key->SuburbID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a></td>
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
                        <th> </th>
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
                            <td id="zeros"><div class="col-sm-6 col-md-4 col-lg-3"><a href='<?php echo base_url()."Manage_area_test/addToActive/".$sel_data1->SuburbID; ?>' data-toggle="tooltip" data-original-title="Add To Active" onclick="return confirm('You Want Move This To Active ?');"><i class="fa fa-check-circle"></i></a></div><a href='<?php echo base_url()."Manage_area_test/update/".$sel_data1->SuburbID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a> <a href='<?php echo base_url()."Manage_area_test/deleteArea/".$sel_data1->SuburbID; ?>' data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger" onclick="return confirm('You Want Delete This ?');"></i> </a></td>
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

   $('#Province_down').on('change', function(){
    var provinceID = $(this).val();
    if(provinceID){
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Manage_area/fetch_city',
        data:'ajaxprovince_id='+provinceID,
        success:function(html){
          $('#city_down').html(html);
                    //$('#city_down').html('<option value="">Select state first</option>'); 
                  }
                }); 
    }else{

      $('#city_down').html('<option value="">Select province first</option>'); 
    }
  });
 });
</script>