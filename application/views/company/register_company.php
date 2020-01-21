
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">

<div class="row"> 
<div class="col-md-12">
    <div class="white-box">


         
        <?php
        if ($this->session->flashdata('success') != '') {
          echo "<div class='alert alert-success'>";
          echo $this->session->flashdata('success');
          echo "</div>";
        }
        ?>
      


        <form data-toggle="validator" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Company Name*</label>
                    <input type="text" name="company_name" id="CompanName" value="<?php echo set_value('company_name'); ?>" class="form-control" placeholder="Company Name" required/><?php echo form_error('company_name'); ?>
                    
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                </div>                              


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Company Registration Number*</label>
                        <input type="text" name="reg_number" value="<?php echo set_value('reg_number'); ?>"id="lastName" class="form-control" placeholder="Registration Number" required>
                        <!-- <span class="help-block"> This field has error. </span> --> 
                        <div class="help-block with-errors"></div>
                    </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">VAT Number*</label>
                            <input type="text" name="vat_number" value="<?php echo set_value('vat_number'); ?>"id="vatnumber" class="form-control" placeholder="VAT Number" required>
                            <!-- <span class="help-block"> This field has error. </span> --> 
                            <div class="help-block with-errors"></div>
                        </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Primary Contact Person*</label>
                                <input type="text" name="prim_person" value="<?php echo set_value('prim_person'); ?>"id="contact" class="form-control" placeholder="Contact Person" required>
                                <!-- <span class="help-block"> This field has error. </span> --><div class="help-block with-errors"></div> 
                            </div>
                            </div>




                            <div class="form-group">
                                <label for="message" class="control-label">Company Specific Message</label>
                                <textarea id="message" name="com_message" class="form-control" ><?php echo set_value('com_message'); ?></textarea>
                                <!-- <span class="help-block with-errors">Hey look, this one has feedback icons!</span> --> 
                                
                            </div> 

                                <div class="row">
                                    <div class="col-md-6">

                                        <h3 class="box-title">Physical Address</h3>
                                        <label style="color: red;">Note all delivery services will be sent to this address</label>
                                    </div>


                                    <div class="col-md-6">
                                        <h3 class="box-title">Postal Address*</h3>
                                        <label style="color: red;">Note all postal services will be sent to this address </label>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Physical Address*</label>
                                            <input type="text" name="phy_address" class="form-control" value="<?php echo set_value('phy_address'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Address</label>
                                            <input type="text" name="post_address" class="form-control" value="<?php echo set_value('post_address'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <select class="form-control" name="province" data-placeholder="Choose a Category" id="phy_province" value="<?php echo set_select('province'); ?>"tabindex="1">

                                                <option value="0">Select</option>

                                                <?php
                                                foreach ($province_data as $key => $value) 
                                                {        
                                                    if($value->ID==set_value('province')){
                                                        $sel = 'selected="true"';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option '.$sel.' value="'.$value->ID.'">'.$value->Name.'</option>';
                                                }
                                                ?>
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <select class="form-control" name="province_state" data-placeholder="Choose a Category" id="pos_province" value="<?php echo set_select('province_state'); ?>"tabindex="1">
                                                <option value="0">Select</option>

                                                <?php
                                                foreach ($province_data as $key => $value) 
                                                {        
                                                    if($value->ID==set_value('province_state')){
                                                        $sel = 'selected="true"';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option '.$sel.' value="'.$value->ID.'">'.$value->Name.'</option>';
                                                }
                                                ?>
                                                <div class="help-block with-errors"></div>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">City</label>                
                                            <select class="form-control" name="city" data-placeholder="Choose a Category" id="phy_city" value="<?php echo set_select('city'); ?>"tabindex="1">
                                                <?php
                                                foreach ($city_data as $key => $value) 
                                                {        
                                                    if($value->ID==set_value('city')){
                                                        $sel = 'selected="true"';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option '.$sel.' value="'.$value->ID.'">'.$value->Name.'</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">City</label>

                                            <select class="form-control" name="city_ci" data-placeholder="Choose a Category" id="pos_city" value="<?php echo set_select('city_ci'); ?>"tabindex="1">
                                                <?php

                                                foreach ($city_dataa as $key => $value) 
                                                {        
                                                    if($value->ID==set_value('city_ci')){
                                                        $sel = 'selected="true"';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option '.$sel.' value="'.$value->ID.'">'.$value->Name.'</option>';
                                                }
                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                </div>






                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Suburb</label>

                                            <select class="form-control" name="suburb" data-placeholder="Choose a Category" id="phy_suburb" value="<?php echo set_value('suburb'); ?>"tabindex="1">
                                                <?php 

                                                foreach ($suburb_data as $key => $value) { 

                                                    if($value->SuburbID == set_value('suburb'))
                                                    {
                                                        $sel = 'selected="selected"';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option '.$sel.' value="'.$value->SuburbID.'">'.$value->Name.'</option>';
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Suburb</label>

                                            <select class="form-control" name="suburb_si" data-placeholder="Choose a Category" id="pos_suburb" value="<?php echo set_value('suburb_si'); ?>"tabindex="1">

                                                <?php 

                                                foreach ($suburb_dataa as $key => $value) { 

                                                    if($value->SuburbID == set_value('suburb_si'))
                                                    {
                                                        $sel = 'selected="selected"';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    echo '<option '.$sel.' value="'.$value->SuburbID.'">'.$value->Name.'</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Postal Code*</label>
                                        <input type="text" name="post_code" class="form-control" value="<?php echo set_value('post_code'); ?>" required>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                                    


                                <h3 class="box-title">Contact Details</h3>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Work Phone*</label>
                                            <input type="text" name="work_phone" class="form-control" maxlength="10" value="<?php echo set_value('work_phone'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Phone*</label>
                                            <input type="text" name="mobile_phone" class="form-control" maxlength="10" value="<?php echo set_value('mobile_phone'); ?>" required>

                                            <label style="color: red;">Note all SMS and OTP notifications will be sent to this mobile number above </label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <!--/row-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Secondary Mobile Phone</label>
                                            <input type="text" name="second_mobile" class="form-control" maxlength="10" value="<?php echo set_value('second_mobile'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address*</label>
                                            
                                                <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required>

                                                <label style="color: red;">Note all emails notifications will be sent to this email address above</label> 
                                                <?php echo form_error('email'); ?>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Secondary Email Address</label>
                                                <input type="email" name="second_mobile" class="form-control"  value="<?php echo set_value('second_mobile'); ?>">

                                            
                                        </div>
                                    </div>

                                </div>
                                



                                <h4>Type of work Company Undertakes</h4>

                                <?php 

                                
                                
                                $dat1 = array('1' => 'Maintenance - Residential', '2' => 'Maintenance - Industrial', '3' => 'Maintenance - Commercial', '4' =>'Construction - Residential', '5' => 'Construction - Industrial', '6' => 'Construction - Commercial', '7' => 'Construction - Civil Works');
                                    

                                    foreach ($dat1 as $key => $value) { ?>
                                         
                                     <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="1" <?php echo set_checkbox('type[]', '1'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Maintenance - Residential</span>
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="2" <?php echo set_checkbox('type[]', '2'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Maintenance - Industrial</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="3" <?php echo set_checkbox('type[]', '3'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Maintenance - Commercial</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="4" <?php echo set_checkbox('type[]', '4'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction - Residential</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="5" <?php echo set_checkbox('type[]', '5'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction - Industrial</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="6" <?php echo set_checkbox('type[]', '6'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction - Commercial</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="7" <?php echo set_checkbox('type[]', '7'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction - Civil Works</span>
                                        </label>
                                    </div>
                                </div>

                                     
                                     <?php
                                      break; } ?>



                                <h4>Specialisations</h4>

                                <?php 
                                
                                $dat2 = array('1' => 'Leak Detection', '2' => 'Drain Cleaning', '3' => 'Solar Water Heating', '4' =>'Heat Pumps', '5' => 'Gas', '6' => 'Bathroom Renovations');
                                    

                                    foreach ($dat2 as $key => $value) { ?>

                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="1" <?php echo set_checkbox('types[]', '1'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Leak Detection</span>
                                        </label>
                                    </div>                                    
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="2" <?php echo set_checkbox('types[]', '2'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Drain Cleaning</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="3" <?php echo set_checkbox('types[]', '3'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Solar Water Heating</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="4" <?php echo set_checkbox('types[]', '4'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Heat Pumps</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="5" <?php echo set_checkbox('types[]', '5'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Gas</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="6" <?php echo set_checkbox('types[]', '6'); ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Bathroom Renovations</span>
                                        </label>
                                    </div>
                                    
                                </div>

                            <?php 
                            break; } ?>


                                <div class="row">
                                    <div class="col-md-6">                                                    
                                        <div class="col-lg-2 col-sm-4 col-xs-12">
                                            <button type="submit" name="save" class="btn btn-block btn-primary btn-rounded">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                   
                    <script type="text/javascript">
                    
                        $(document).ready(function(){
                            $('.alert, .alert-success').delay('3000').fadeOut(300);
                            $('#phy_province').on('change', function(){
                                var provinceID = $(this).val();
                                if(provinceID){
                                  $.ajax({
                                    type:'POST',
                                    url:'<?php echo base_url(); ?>admin_company/fetch_city',
                                    data:'ajaxprovince_id='+provinceID,
                                    success:function(html){
                                      $('#phy_city').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
                              }else{

                                  $('#phy_city').html('<option value="">Select province first</option>'); 
                              }
                          });

                            $('#phy_city').on('change', function(){
                                var cityID = $(this).val();
                                if(cityID){
                                  $.ajax({
                                    type:'POST',
                                    url:'<?php echo base_url(); ?>admin_company/fetch_suburb',
                                    data:'ajaxcity_id='+cityID,
                                    success:function(html){
                                      $('#phy_suburb').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
                              }else{

                                  $('#phy_suburb').html('<option value="">Select city first</option>'); 
                              }
                          });
                            $('#pos_province').on('change', function(){
                                var provinceID = $(this).val();
                                if(provinceID){
                                  $.ajax({
                                    type:'POST',
                                    url:'<?php echo base_url(); ?>admin_company/fetch_city',
                                    data:'ajaxprovince_id='+provinceID,
                                    success:function(html){
                                      $('#pos_city').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
                              }else{

                                  $('#pos_city').html('<option value="">Select province first</option>'); 
                              }
                          });
                            $('#pos_city').on('change', function(){
                                var cityID = $(this).val();
                                if(cityID){
                                  $.ajax({
                                    type:'POST',
                                    url:'<?php echo base_url(); ?>admin_company/fetch_suburb',
                                    data:'ajaxcity_id='+cityID,
                                    success:function(html){
                                      $('#pos_suburb').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
                              }else{

                                  $('#pos_suburb').html('<option value="">Select city first</option>'); 
                              }
                          });
                        });
                    </script>
