<?php
$attributes_installationType = array('class' => 'Installation_type','data-toggle'=>'validator', 'id' => 'Installation_type1', 'method' => 'post');


  //   $this->load->helper('form'); ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="white-box">
        <!-- <form data-toggle="validator"> -->
          <?php
          echo form_open_multipart('sub_types/addsubtypes', $attributes_installationType);
          ?>
          <?php
            if ($this->session->flashdata('subtype_sucess')!='') {
              echo "<div class='alert alert-success'>";
              echo $this->session->flashdata('subtype_sucess');
              echo "</div>";
            }

            elseif ($this->session->flashdata('subtype_update')!='') {
              echo "<div class='alert alert-success'>";
              echo $this->session->flashdata('subtype_update');                    
              echo '</div>';

            }elseif ($this->session->flashdata('Archive_subtype')!='') {
              echo "<div class='alert alert-success'>";
              echo $this->session->flashdata('Archive_subtype');                    
              echo '</div>';

            }elseif ($this->session->flashdata('Active_subtype')!='') {
              echo "<div class='alert alert-success'>";
              echo $this->session->flashdata('Active_subtype');                    
              echo '</div>';

            }elseif ($this->session->flashdata('delete_subtype')!='') {
              echo "<div class='alert alert-danger'>";
              echo $this->session->flashdata('delete_subtype');                    
              echo '</div>';

            }
            ?>
          <div class="row">
            <!--/span-->
            <div class="col-md-6">
              <div class="form-group">
                <label>Installation Type</label>
                <select class="form-control" name="subType_down" id="subType_down"  required aria-required="true" tabindex="1">
                  <option value="">select</option>
                  <?php

                  foreach ($install_records as $recrds) {
                   ?>
                   <option value="<?php echo $recrds->installationtype_id; ?>"><?php echo $recrds->installation_type; ?></option>

                 <?php  }

                 ?>
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div>
           <!--/span-->
           <div class="col-md-6">
            <div class="form-group">
              <label>Sub Type</label>
              <input name="InstallationSubType" type="text" id="ContentPlaceHolder1_InstallationSubType" class="form-control"required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <input name="ContentPlaceHolder1isActive" type="checkbox" id="terms">
            <label for="terms"> Active </label>    
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-rounded btn-sm btn-primary">Add Sub Type</button>
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
                <th>Installation Type</th>
                <th>Sub Type</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($records as $key) {
                $query = $this->db->get_where("InstallationTypes",array("installationtype_id"=>$key->InstallationTypeID));
                $installation_name = $query->result();
                foreach ($installation_name as $Ikey) {

                  ?>

                  <?php if($key->isActive==1){ ?>
                    <tr>
                      <td><?php echo $Ikey->installation_type; ?></td>
                      <td><?php echo $key->Name; ?></td>
                      <td><div class="col-sm-6 col-md-4 col-lg-3"><a href='<?php echo base_url()."sub_types/addToArchive/".$key->subID; ?>' data-toggle="tooltip" data-original-title="Add To Archive" onclick="return confirm('You Want Move This To Archive ?');" ><i class="fa fa-check-circle"></i></a></div><a href='<?php echo base_url()."sub_types/sub_type_update/".$key->subID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a></td>
                     <!--  <td><a href = '<?php // echo "sub_type_update/".$key->subID; ?>'><img src="<?php // echo base_url(); ?>assets/images/edit.png" height="25" width="25"></a></td> -->
                    </tr>
                  <?php } ?>

                <?php } } ?>

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
                  <th>Installation Type</th>
                  <th>Sub Type</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($records as $key1) {
                  $query1 = $this->db->get_where("InstallationTypes",array("installationtype_id"=>$key1->InstallationTypeID));
                  $installation_name1 = $query1->result();
                  foreach ($installation_name1 as $Ikey1) {

                    ?>

                    <?php if($key1->isActive==0){ ?>
                      <tr>
                        <td><?php echo $Ikey1->installation_type; ?></td>
                        <td><?php echo $key1->Name; ?></td>
                        <td><div class="col-sm-6 col-md-4 col-lg-3"><a href='<?php echo base_url()."sub_types/addToActive/".$key1->subID; ?>' data-toggle="tooltip" data-original-title="Add To Active" onclick="return confirm('You Want Move This To Active ?');" ><i class="fa fa-check-circle"></i></a></div><a href='<?php echo base_url()."sub_types/sub_type_update/".$key1->subID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href='<?php echo base_url()."sub_types/deletesub/".$key1->subID; ?>' data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger" onclick="return confirm('You Want Delete This ?');"></i> </a></td>
                       <!--  <td><a href = '<?php // echo "sub_type_update/".$key1->subID; ?>'><img src="<?php // echo base_url(); ?>assets/images/edit.png" height="25" width="25"></a></td> -->
                      </tr>
                    <?php } ?>

                  <?php } } ?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- </div> -->
        </div>

      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready( function () {
      $('.alert, .alert-success').delay('3000').fadeOut(300);
      $('.alert, .alert-danger').delay('3000').fadeOut(300);
      $('#isActive').DataTable({
        aoColumnDefs: [
        {
         bSortable: false,
         aTargets: [ -1 ]
       }
       ]
     });
      $('#isArchive').DataTable({
        aoColumnDefs: [
        {
         bSortable: false,
         aTargets: [ -1 ]
       }
       ]
     });
      $('#archiveTable').hide();
      $('#archive_btn').css("color","#333");
      $('#archive_btn').css("background-color","#ebebeb");
      $('#archive_btn').css("border-color","#adadad");
      if ($("subType_down").val()==0) {
        $("subType_down").prop('required',true);
      }



      $('#archive_btn').click(function(){
        $('#isActive_wrapper').hide();
        $('#archiveTable').show();
        $('#isActive').hide();
        $('#archive_btn').css("color","#333");
        $('#archive_btn').css("background-color","#00c292");
        $('#archive_btn').css("border-color","#adadad");
        $('#active_btn').css("color","#333");
        $('#active_btn').css("background-color","#ebebeb");
        $('#active_btn').css("border-color","#adadad");
      });
      $('#active_btn').click(function(){
       $('#archiveTable').hide();
       $('#isActive').show();
       $('#isActive_wrapper').show();
       $('#active_btn').css("color","#333");
       $('#active_btn').css("background-color","#00c292");
       $('#active_btn').css("border-color","#adadad");      
       $('#archive_btn').css("color","#333");
       $('#archive_btn').css("background-color","#ebebeb");
       $('#archive_btn').css("border-color","#adadad");
     });

    } );
  // $(document).ready( function () {
  //  $('#isActive_Archive').DataTable();
  // } );
</script>