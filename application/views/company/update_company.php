
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">

<div class="row"> 
<div class="col-md-12">
    <div class="white-box">
        <form data-toggle="validator" method="post">
            
        <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active nav-item"><a href="<?php echo base_url('get_company/view') ?>" class="nav-link" aria-controls="home" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Company Details</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('get_company/employeelist')."/".$data[0]->CompanyID; ?>" aria-controls="profile" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Employee Listing</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('purchase_coc/pur_coc')."/".$data[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Management</span></a></li>


                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('allocation/coc_alloc')."/".$data[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Allocation</span></a></li>
                                

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('company_diary/load_comment')."/".$data[0]->CompanyID; ?>" aria-controls="diary" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Diary & Comments</span></a></li>
                            </ul>
        
            <div class="col-md-6">
                <div class="form-group">
                    <h4>Registration Details</h4>
                    <label class="control-label">Company ID*</label>
                    <input type="text" name="company_id" id="CompanName" value="<?php echo $data[0]->CompanyID; ?>" class="form-control" placeholder="Company Name" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                

                

                <div class="form-group">
                    <label class="control-label">Password*</label>
                    <input type="password" name="company_id" id="CompanName" value="<?php echo(rand()); ?>" class="form-control" placeholder="Company Name" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                

                <p>Status: </p>
                <div class="form-group">
                                    
                                    <div class="radio">
                <input id="choose" name="choose" type="radio" class=""
                <?php if($data[0]->Status == 1) echo "checked ='checked'"; ?> 
                <?php echo $this->form_validation->set_radio('radio ', 1); ?> value="1"/>
                <label for="active" class="">Active</label>
                                    </div>
                                    <div class="radio">
                <input id="choose" name="choose" type="radio" class="" 
                <?php if($data[0]->Status == 2) echo "checked='checked'"; ?>  
                <?php echo $this->form_validation->set_radio('radio ', 2); ?> value="2"/>                
                <label for="expired" class="">Expired</label>
                                    </div>
                                    <div class="radio">
                <input id="choose" name="choose" type="radio" class="" 
                <?php if($data[0]->Status == 3) echo "checked='checked'"; ?>  
                <?php echo $this->form_validation->set_radio('choose', 3); ?> value="3"/>
                <label for="suspended" class="">Suspended</label>
                                    </div>
                                    <div class="radio">
                <input id="choose" name="choose" type="radio" class=""
                <?php if($data[0]->Status == 4) echo "checked='checked'"; ?>  
                <?php echo $this->form_validation->set_radio('choose', 4); ?> value="4"/>
                <label for="close" class="">Closed Down</label>
                                    </div>
                                
                </div>
            </div>



                <div class="col-md-6">
                <div class="form-group">
                    <h4>Company Details</h4>
                    <label class="control-label">Company Name*</label>
                    <input type="text" name="company_name" id="CompanName" value="<?php echo $data[0]->CompanyName; ?>" class="form-control" placeholder="Company Name" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                                             


                
                    <div class="form-group">
                        <label class="control-label">Company Registration Number*</label>
                        <input type="text" name="reg_number" value="<?php echo $data[0]->CompanyRegNo; ?>" id="lastName" class="form-control" placeholder="Registration Number" required>
                        <!-- <span class="help-block"> This field has error. </span> --> 
                        <div class="help-block with-errors"></div>
                    </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">VAT Number*</label>
                            <input type="text" name="vat_number" value="<?php echo $data[0]->VatNo; ?>" id="vatnumber" class="form-control" placeholder="VAT Number" required>
                            <!-- <span class="help-block"> This field has error. </span> --> 
                            <div class="help-block with-errors"></div>
                        </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Primary Contact Person*</label>
                                <input type="text" name="prim_person" value="<?php echo $data[0]->PrimaryContact; ?>" id="contact" class="form-control" placeholder="Contact Person" required>
                                <!-- <span class="help-block"> This field has error. </span> --><div class="help-block with-errors"></div> 
                            </div>
                            </div>




                            <div class="form-group">
                                <label for="message" class="control-label">Company Specific Message</label>
                                <textarea id="message" name="com_message" class="form-control" required><?php echo $data[0]->CompMessage; ?></textarea>
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
                                            <input type="text" name="phy_address" class="form-control" value="<?php echo $data[0]->PhysicalAddress; ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Address</label>
                                            <input type="text" name="post_address" class="form-control" value="<?php echo $data[0]->PostalAddress; ?>" required>
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
                                            <select class="form-control" name="province" data-placeholder="Choose a Category" id="phy_province" tabindex="1">

                                                <?php 
                                // foreach ($data as $row) { 
                                        $physical_province = $data[0]->Province;

                                    $query = $this->db->get("province");
                                    $province_name = $query->result();
           // print_r($sub_id);
                                    foreach ($province_name as $Ikey) {
                                     ?>
                                <option value="<?php echo $Ikey->ID; ?>" <?php if($Ikey->ID == $physical_province) echo "selected='selected'"; ?> ><?php echo $Ikey->Name; ?></option>
                                        <?php
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
                                            <select class="form-control" name="province_state" data-placeholder="Choose a Category" id="pos_province" tabindex="1">
                                                <option value="0">Select</option>

                                                <?php
                                                $postal_province = $data[0]->PostalProvince;
                                // foreach ($data as $row) { 

                                    $query1 = $this->db->get("province");
                                    $province_name1 = $query1->result();
           // print_r($sub_id);
                                    foreach ($province_name1 as $Ikeyy) {
                                     ?>
                                <option value="<?php echo $Ikeyy->ID; ?>" <?php if($Ikeyy->ID == $postal_province) echo "selected='selected'"; ?> ><?php echo $Ikeyy->Name; ?></option>
                                        <?php
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
                                        $physical_city = $data[0]->City;

                                        $this->db->where('ProvinceID', $data[0]->Province);
                                        $city_query = $this->db->get("area");
                                        $city_name = $city_query->result();

                                        foreach ($city_name as $Ckey) {

                                        ?>
                                        <option value="<?php echo $Ckey->ID; ?>" <?php if($Ckey->ID ==$physical_city) echo "selected = 'selected'";?> >
                                            <?php echo $Ckey->Name; ?></option>
                                            <?php
                                            }
                                             ?> 

                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">City</label>

                                            <select class="form-control" name="city_ci" data-placeholder="Choose a Category" id="pos_city" tabindex="1">
                                                <?php
                                                
                                            $postal_city = $data[0]->PostalCity;

                                        $this->db->where('ProvinceID', $data[0]->PostalProvince);
                                        $city_query1 = $this->db->get("area");
                                        $city_name1 = $city_query1->result();                              

                                        foreach ($city_name1 as $Ckeyy) {

                                        ?>
                                        <option value="<?php echo $Ckeyy->ID; ?>" <?php if($Ckeyy->ID == $postal_city) echo "selected = 'selected'";?> >
                                            <?php echo $Ckeyy->Name; ?></option>
                                            <?php
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
                                            $physical_suburb = $data[0]->Suburb;

                                            $this->db->where('CityID', $data[0]->City);
                                            $suburb_query = $this->db->get("areasuburbs");
                                            $suburb_name = $suburb_query->result();  

                                            foreach ($suburb_name as $Skey) {

                                            ?>
                                            <option value="<?php echo $Skey->SuburbID; ?>" <?php if($Skey->SuburbID == $physical_suburb) echo "selected = 'selected'";?> ><?php echo $Skey->Name; ?></option>
                                        <?php
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
                                            $physical_suburb = $data[0]->PostalSuburb;

                                            $this->db->where('CityID', $data[0]->PostalCity);
                                            $suburb_query = $this->db->get("areasuburbs");
                                            $suburb_name = $suburb_query->result();  

                                            foreach ($suburb_name as $Skey) {

                                            ?>
                                            <option value="<?php echo $Skey->SuburbID; ?>" <?php if($Skey->SuburbID == $physical_suburb) echo "selected = 'selected'";?> ><?php echo $Skey->Name; ?></option>
                                        <?php
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
                                        <input type="text" name="post_code" class="form-control" value="<?php echo $data[0]->PostalCode; ?>" required>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                                    


                                <h3 class="box-title">Contact Details</h3>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Work Phone*</label>
                                            <input type="text" name="work_phone" class="form-control" maxlength="10" value="<?php echo $data[0]->BusinessPhone; ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Phone*</label>
                                            <input type="text" name="mobile_phone" class="form-control" maxlength="10" value="<?php echo $data[0]->Mobile; ?>" required>

                                            <label style="color: red;">Note all SMS and OTP notifications will be sent to this mobile number above </label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <!--/row-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Secondary Mobile Phone</label>
                                            <input type="text" name="second_mobile" class="form-control" maxlength="10" value="<?php echo $data[0]->SecondaryMobilePh; ?>" >
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address*</label>
                                            
                                                <input type="email" name="email" class="form-control" value="<?php echo $data[0]->CompanyEmail; ?>" required>

                                                <label style="color: red;">Note all emails notifications will be sent to this email address above</label> 
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Secondary Email Address</label>
                                                <input type="email" name="second_mobile" class="form-control"  value="<?php echo $data[0]->SecondaryEmail; ?>">

                                            
                                        </div>
                                    </div>

                                </div>


                                <h4>Type of work Company Undertakes</h4>
                                <?php 
    
                                $fet_data = explode(',', $data[0]->WorkType); 
                                //print_r($chk_data);

                                foreach($fet_data as $row1)
                                        {
                                          
                                          if($row1 == '1')
                                            {
                                                
                                                $aba='checked';
                                            }
                                          if
                                            ($row1=='2')
                                            {

                                            $abb='checked';
                                            }

                                          if($row1=='3')
                                            {
                                                $abc='checked';
                                            }
                                            if($row1=='4')
                                            {
                                                $abd='checked';
                                            }
                                            if($row1=='5')
                                            {
                                                $abe='checked';
                                            }
                                            if($row1=='6')
                                            {
                                                $abf='checked';
                                            }
                                            if($row1=='7')
                                            {
                                                $abg='checked';
                                            }
                                        }
                                    ?>

                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="1" <?php echo $aba; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Maintenance-Residential</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="2" <?php echo $abb; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Maintenance-Industrial</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="3" <?php echo $abc; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Maintenance-Commercial</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="4" <?php echo $abd; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction-Residential</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="5" <?php echo $abe; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction-Industrial</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="6" <?php echo $abf; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction-Commercial</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="type[]" value="7" <?php echo $abg; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Construction-Civil Works</span>
                                        </label>
                                    </div>
                                </div>





                                <h4>Specialisations</h4>
                                <?php 
    //$c_box1=$c_box2=$c_box3='';
                                $chk_data = explode(',', $data[0]->Specialisations); 
                                //print_r($chk_data);

                                foreach($chk_data as $row)
                                        {
                                          
                                          if($row == '1')
                                            {
                                                
                                                $cha='checked';
                                            }
                                          if
                                            ($row=='2')
                                            {

                                            $chb='checked';
                                            }

                                          if($row=='3')
                                            {
                                                $chc='checked';
                                            }
                                            if($row=='4')
                                            {
                                                $chd='checked';
                                            }
                                            if($row=='5')
                                            {
                                                $che='checked';
                                            }
                                            if($row=='6')
                                            {
                                                $chf='checked';
                                            }
                                        }
                                    ?>

                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="1" <?php echo $cha; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Leak Detection</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="2" <?php echo $chb; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Drain Cleaning</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="3" <?php echo $chc; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Solar Water Heating</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="4" <?php echo $chd; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Heat Pumps</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="5" <?php echo $che; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Gas</span>
                                        </label>
                                    </div>  
                                    <div class="form-check">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="types[]" value="6" <?php echo $chf; ?> />

                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Bathroom Renovations</span>
                                        </label>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">                                                    
                                        <div class="col-lg-2 col-sm-4 col-xs-12">
                                            <button type="submit" name="save" class="btn btn-block btn-primary btn-rounded">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                   
                    <script type="text/javascript">
                    
                        $(document).ready(function(){
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
