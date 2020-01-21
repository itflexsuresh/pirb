<?php
include('sidebar.php');
?>
<html>
<head>
    <title> Company Details</title>
       <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">
      <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/sample.js"></script> 


</head>
<center>
    <body style="background-color: #FFF;">
    <div class="">
            <h2 class="title">Company Application</h2>
            
            <?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
<?php } ?>

        <?php //echo form_open('Admin_Company/insert'); ?>
        <?php echo form_open(); ?>

        
    <table id="first-one" style="width: 20%">
          
          <div class="tab-content">
                        <div class="tab-pane cmpny_det active" id="compdetails">

        <div class="col-md-12 form-group cmpny_sections complany_dtls">                                
                                <div class="col-md-6 form-group ">
                                    <label>Company Name <span style="color: red;">*</span> </label>
                                    <div class="user_edits">
                                        <input name="company_name" type="text" id="ContentPlaceHolder1_CompanyName" value="<?php echo $data[0]->company_name; ?>" class="form-control" onkeypress="return AllowAlphabet(event)"  /><div id="message"><?php echo form_error('company_name'); ?></div></br>
                                    </div>
                                </div>
                                                     


                            <div class="col-md-6 form-group" style="float: right;">
                                    <label>Company Registration Number</label>
                                    <div class="user_edits">
                                        <input name="reg_number" type="text" id="ContentPlaceHolder1_CompanyRegNo" value="<?php echo $data[0]->register_number; ?>" class="form-control" onkeypress="return AllowNumber(event)" /><div id="message"><?php echo form_error('reg_number'); ?></div></br>
                                    </div>
                                </div> 

        

        <div class="col-md-6 form-group" style="clear: both;">
                                    <label>VAT Number</label>
                                    <div class="user_edits">
                                        <input name="vat_number" type="text" id="ContentPlaceHolder1_VatNo" value="<?php echo $data[0]->vat_number; ?>" class="form-control" onkeypress="return AllowNumber(event)" /><div id="message"><?php echo form_error('vat_number'); ?></div></br>
                                    </div>
                                </div>


        <div class="col-md-6 form-group required" style="clear: both;">
                                    <label>Primary Contact Person</label>
                                    <div class="user_edits">
                                        <input name="prim_person" type="text" id="ContentPlaceHolder1_CompanyContactPerson" value="<?php echo $data[0]->contact_person; ?>"class="form-control" onkeypress="return AllowAlphabet(event)" /><div id="message"><?php echo form_error('prim_person'); ?></div></br>
                                    </div>
                                </div>

                            </div> 

        
        <div class="col-md-12 form-group cmpny_sections txt_area_msg">

                                <div class="col-md-6 form-group required">
                                    <h4><b>Company Specific Message </b></h4>
                                    <div class="user_edits">
                                        <textarea name="com_message" value="<?php echo $data[0]->message; ?>"rows="2" cols="20" id="ContentPlaceHolder1_txtCompMsg" class="form-control">
</textarea><div id="message"><?php echo form_error('com_address'); ?></div></br>
                                    </div>
                                </div>
                            </div> 


        
        <div class="col-md-6 qualification_details cmpny_sections physcl_addrss" style="padding-left: 0px; padding-right: 0px">
                                <h3>Physical Address</h3>
                                <label style="color: red;">Note all delivery services will be sent to this address</label>
                                <div class="col-md-6 form-group ">
                                    <label>Physical Address</label>
                                    <div class="user_edits">
                                        <input name="phy_address" type="text" value="<?php echo $data[0]->physical_address; ?>"id="ContentPlaceHolder1_CompanyPhysicalAddress" class="form-control" />
                                        <div id="message"><?php echo form_error('phy_address'); ?></div></br>   
                                    </div>
                                </div> 


        <div class="col-md-6 form-group  required">
                      <label>Physical Province</label>
                                    <div class="user_edits">
                                        <select name="province" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ContentPlaceHolder1$DropDownList5\&#39;,\&#39;\&#39;   )&#39;, 0)" id="ContentPlaceHolder1_DropDownList5" value="<?php echo $data[0]->physical_province; ?>" class="form-control carets_icon">              
    <option selected="selected" value="">Selected</option>
    <option value="1">Eastern Cape</option>
    <option value="2">Free State</option>
    <option value="3">Gauteng</option>
    <option value="4">Kwazulu Natal</option>
    <option value="5">Limpopo</option>
    <option value="6">Mpumalanga</option>
    <option value="8">North West</option>
    <option value="7">Northern Cape</option>
    <option value="9">Western Cape</option>

</select>
                                        
                                    </div>
                                </div>

        
        <div class="col-md-6 form-group  required">
                                    <label>City </label>
                                    <div class="user_edits">
                                        <div class="controls">
                                            <select name="city" value="<?php echo $data[0]->physical_city; ?>" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ContentPlaceHolder1$physicalCities\&#39;,\&#39;\&#39;)&#39;, 0)" id="ContentPlaceHolder1_physicalCities" class="form-control  carets_icon">
    <option selected="selected" value=""></option>

</select>
                                            <!-- <input name="ctl00$ContentPlaceHolder1$adminphysicalCities" type="text" id="ContentPlaceHolder1_adminphysicalCities" class="form-control custom-pro-opa" /> -->
                                        </div>
                                    </div>
                                </div>

        
    <div class="col-md-6 form-group  required">
                                    <label>Suburb </label>
                                    <div class="user_edits">
                                        <div class="controls">
                                            <select name="suburb" value="<?php echo $data[0]->company_name; ?>"id="ContentPlaceHolder1_physicalSuburb" class="form-control select2  carets_icon">
    <option value=""></option>

</select>
                                            <!-- <input name="ctl00$ContentPlaceHolder1$adminphysicalSuburb" type="text" id="ContentPlaceHolder1_adminphysicalSuburb" class="form-control custom-pro-opa" />
 -->                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-6 qualification_details cmpny_sections pstl_addrss" style="padding-left: 0px; padding-right: 0px">
                                <h4>Postal Address </h4>
                                <label style="color: red;">Note all postal services will be sent to this address </label>
                                <div class="col-md-6 form-group ">
                                    <label>Postal Address :</label>
                                    <div class="user_edits">
                                        <input name="post_address" value="<?php echo $data[0]->postal_address; ?>" type="text" id="ContentPlaceHolder1_CompanyPostalAddress" class="form-control" /><div id="message"><?php echo form_error('post_address'); ?></div></br>
                                    </div>
                                </div> 


                                <div class="col-md-6 form-group ">
                                    <label>Province</label>
                                    <div class="user_edits">
                                        <div class="controls">
                                            <select name="province_state" value="<?php echo $data[0]->postal_province; ?>" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ContentPlaceHolder1$DropDownList4\&#39;,\&#39;\&#39;)&#39;, 0)" id="ContentPlaceHolder1_DropDownList4" class="form-control carets_icon">
    <option selected="selected" value="Selected">Selected</option>
    <option value="1">Eastern Cape</option>
    <option value="2">Free State</option>
    <option value="3">Gauteng</option>
    <option value="4">Kwazulu Natal</option>
    <option value="5">Limpopo</option>
    <option value="6">Mpumalanga</option>
    <option value="8">North West</option>
    <option value="7">Northern Cape</option>
    <option value="9">Western Cape</option>

</select>
                                            <!-- <input name="ctl00$ContentPlaceHolder1$TextBox3" type="text" id="ContentPlaceHolder1_TextBox3" class="form-control custom-pro-opa" /> -->
                                        </div>
                                    </div>
                                </div> 
        
        <div class="col-md-6 form-group required">
                                    <label>City</label>
                                    <div class="user_edits">
                                        <div class="controls">
                                            <select name="city_ci" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ContentPlaceHolder1$postalCities\&#39;,\&#39;\&#39;)&#39;, 0)" id="ContentPlaceHolder1_postalCities" class="form-control select2 carets_icon">
    <option selected="selected" value=""></option>

</select>
                                            <!-- <input name="ctl00$ContentPlaceHolder1$adminpostalCities" type="text" id="ContentPlaceHolder1_adminpostalCities" class="form-control custom-pro-opa" /> -->
                                        </div>
                                    </div>
                                </div> 
        
        <div class="col-md-6 form-group  required">
                                    <label>Suburb</label>
                                    <div class="user_edits">
                                        <div class="controls">
                                            <select name="suburb_si" id="ContentPlaceHolder1_postalSuburb" class="form-control select2  carets_icon">
    <option value=""></option>

</select>
                                            <!-- <input name="ctl00$ContentPlaceHolder1$adminpostalSuburb" type="text" id="ContentPlaceHolder1_adminpostalSuburb" class="form-control custom-pro-opa" /> -->
                                        </div>
                                    </div>
                                </div>

        
        <div class="col-md-6 form-group" style="clear: both;">
                                    <label>Postal Code</label>
                                    <div class="user_edits">
                                        <input name="post_code" type="text" id="ContentPlaceHolder1_CompanyPostalCode" class="form-control" onkeypress="return AllowNumber(event)" /><div id="message"><?php echo form_error('post_code'); ?></div></br>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 qualification_details cmpny_sections cntct_dtls" style="padding-left: 0px; padding-right: 0px">
                                <h3>Contact Details </h3>

                                <div class="col-md-6 form-group">
                                    <label>Work Phone</label>
                                    <div class="user_edits">
                                        <input name="work_phone" value="<?php echo $data[0]->work_phone; ?>" type="text" maxlength="10" id="ContentPlaceHolder1_CompanyWorkPhone" class="form-control" onkeypress="return AllowNumber(event)" /><div id="message"><?php echo form_error('work_phone'); ?></div></br>
                                    </div>
                                </div>


        
        <div class="col-md-6 form-group" style="clear: both;">
                                    <label>Mobile Phone  <span style="color: red;">*</span></label>
                                    <div class="user_edits">
                                        <input name="mobile_phone" value="<?php echo $data[0]->mobile_phone; ?>" type="text" maxlength="10" id="ContentPlaceHolder1_CompanyMobilePhone" class="form-control"  onkeypress="return AllowNumber(event)" /><div id="message"><?php echo form_error('mobile_phone'); ?></div></br>
                                    </div>
                                    <label style="color: red;white-space: nowrap;">Note all SMS and OTP notifications will be sent to this mobile number above </label>
                                </div>

        
        <div class="col-md-6 form-group  required" style="clear: both;">
                                    <label>Email Address <span style="color: red;">*</span></label>
                                    <div class="user_edits">
                                        <input name="email" value="<?php echo $data[0]->email; ?>" type="email" id="ContentPlaceHolder1_CompanyEmailAddress" class="form-control"  /><div id="message"><?php echo form_error('email'); ?></div></br>
                                    </div>
                                    <label style="color: red;white-space: nowrap;">Note all emails notifications will be sent to this email address above</label>
                                </div>

        
        <div class="col-md-6 form-group">
                                    <label>Secondary Mobile Phone</label>
                                    <div class="user_edits">
                                        <input name="second_mobile" type="text" maxlength="10" id="ContentPlaceHolder1_txtSecMobilePhone" class="form-control" onkeypress="return AllowNumber(event)" /><div id="message"><?php echo form_error('second_mobile'); ?></div></br>
                                    </div>
                                </div>

        
        <div class="col-md-6 form-group">
                                    <label>Secondary Email Address</label>
                                    <div class="user_edits">
                                        <input name="email_1" type="email" id="ContentPlaceHolder1_txtSecEmail" class="form-control" />
                                    </div><div id="message"><?php echo form_error('email_1'); ?></div></br>
                                </div>
                                </div>
                        </div> 
    
      


        

            <div class="col-md-12 qualification_details cmpny_sections type_of_wrk">                              

                                <div class="checkbox">
                                    <h4>Type of work Company Undertakes</h4>

                                    <label for="ContentPlaceHolder1_Maintenance" class="Pirbs_checkbox">

                                       
                                        
                                        <?php echo form_checkbox('type[]', 'Maintenance-Residential'); ?>Maintenance-Residential 
 
                                        
                                        <?php echo form_checkbox('type[]', 'Maintenance-Industrial'); ?>Maintenance-Industrial 
                                       
                                       
                                         <?php echo form_checkbox('type[]', 'Maintenance-Commercial'); ?>Maintenance-Commercial 
                                       
                                       
                                         <?php echo form_checkbox('type[]', 'Construction-Residential'); ?>Construction-Residential 
                                       
                                      
                                         <?php echo form_checkbox('type[]', 'Construction-Industrial'); ?>Construction-Industrial 
                                      
                                         <?php echo form_checkbox('type[]', 'Construction-Commercial'); ?>Construction-Commercial 
                                       
                                      
                                         <?php echo form_checkbox('type[]', 'Construction-Civil Works'); ?>Construction-Civil Works 
                                       
                                      
                                    </label>
                                </div>
                               
        <h4>Specilisations</h4> 
                                <div class="checkbox">
                                    <label for="ContentPlaceHolder1_Maintenance" class="Pirbs_checkbox">
                                        <?php echo form_checkbox('types[]', 'Leak Detection'); ?>Leak Detection 
                                       
                                         <?php echo form_checkbox('types[]', 'Drain Cleaning'); ?>Drain Cleaning 
                                       
                                      
                                         <?php echo form_checkbox('types[]', 'Solar Water Heating'); ?>Solar Water Heating 
                                     
                                         <?php echo form_checkbox('types[]', 'Heat Pumps'); ?>Heat Pumps 
                                       
                                      
                                        <?php echo form_checkbox('types[]', 'Gas'); ?>Gas 
                                       
                                     

                                        <?php echo form_checkbox('types[]', 'Bathroom Renovations'); ?>Bathroom Renovations 
                                     
                                    </label>

                                </div>
                            </div>
                        </div>



                            </div> <br/>
        <?php echo form_submit(array('id' => 'submit', 'name' => 'save', 'value' => 'Update')); ?>
    <?php echo form_close(); ?><br/>


    
    </table>

    </div>
</body>
</center>
</html>