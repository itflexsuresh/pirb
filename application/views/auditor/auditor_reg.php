
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">
<style type="text/css">
	h4.form_title {
    width: 100%;
    display: inline-block;
    margin-left: 7px;
    font-weight: 500;
}
.help-block + input[type="checkbox"] {
    width: 15px;
    height: 15px;
    display: inline-block;
    position: relative;
    top: 3px;
    margin-right: 7px;
}
table#isActive_message {
    width: 100%;
    border: 1px solid #e4e7ea;
    margin-bottom: 30px;
}

table#isActive_message tr, th, td {
    padding: 7px;
    border: 1px solid #e4e7ea;
}
</style>
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
      


        <form data-toggle="validator" enctype="multipart/form-data" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">First Name*</label>
                    <input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control" placeholder="Name" required/><?php echo form_error('first_name'); ?>
                    
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                </div>                              

                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Surname*</label>
                    <input type="text" name="sur_name" id="sur_name" value="<?php echo set_value('sur_name'); ?>" class="form-control" placeholder="Surname" required/><?php echo form_error('sur_name'); ?>
                    
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">ID Number*</label>
                        <input type="text" name="id_number" id="id_number" value="<?php echo set_value('id_number'); ?>" class="form-control" placeholder="ID Number" required>
                        <!-- <span class="help-block"> This field has error. </span> --> 
                        <div class="help-block with-errors"></div>
                    </div>
                    </div>

                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Photo</label>
                                        <input type="file" name="userfile"/>
                                    
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">                              
                                        <div class="col-lg-7 col-sm-4 col-xs-12">
                                            <button type="submit" name="add_photo" class="btn btn-block btn-primary btn-rounded">Add File/Images</button>
                                        </div>
                                    </div>
                                </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Email*</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email" required>
                            <label style="color: red;">Note all emails notifications will be sent to this email address above</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Password*</label>
                                <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>"class="form-control" placeholder="Password" required>
                                <!-- <span class="help-block"> This field has error. </span> --><div class="help-block with-errors"></div> 
                            </div>
                            </div>

                            
                            <div class="col-md-6" style="clear: both;">
                                <div class="form-group">
                                    <label class="control-label">Phone (Work)*</label>
                                    <input type="text" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number'); ?>" class="form-control" placeholder="Phone" required>
                                    <!-- <span class="help-block"> This field has error. </span> --> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phone (Mobile)*</label>
                                    <input type="text" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number'); ?>" class="form-control" placeholder="Mobile" required>
                                    <label style="color: red;">Note all SMS and OTP notifications will be sent to this mobile number above </label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        
                                    <div class="row">
                                    	<h4 class="form_title">Billing Details</h4>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">                 
                                            <label>Billing Name*</label>
                                            <input type="text" name="billing" class="form-control" value="<?php echo set_value('billing'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Reg Number*</label>
                                            <input type="text" name="reg_number" class="form-control" value="<?php echo set_value('reg_number'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company VAT*</label>
                                            <input type="text" name="comp_vat" class="form-control" value="<?php echo set_value('comp_vat'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        <input type="checkbox" name="vendor" class="form-control" value="VAT Vendor"><label>VAT Vendor</label>
                                        </div>
                                    </div>
                                	
                                	<h4 class="form_title">Billing Address</h4>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">                 
                                            <label>Billing Address*</label>
                                            <input type="text" name="billing_address" class="form-control" value="<?php echo set_value('billing_address'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <select class="form-control" name="province" data-placeholder="Choose a Category" id="province" value="<?php echo set_select('province'); ?>"tabindex="1" >

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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">City</label>                
                                            <select class="form-control" name="city" data-placeholder="Choose a Category" id="city" value="<?php echo set_select('city'); ?>"tabindex="1">
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

                                            </select required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
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

                                            </select required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Postal Code*</label>
                                        <input type="text" name="post_code" class="form-control" value="<?php echo set_value('post_code'); ?>" required>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Logo</label>
                                        <input type="file" name="comp_logo"/>
                                    
                                    </div>
                                </div>
                                 
                                    <div class="col-md-6">                              
                                        <div class="col-lg-6 col-sm-4 col-xs-12">
                                            <button type="submit" name="add_image" class="btn btn-block btn-primary btn-rounded">Add Images</button>
                                        </div>
                                    </div>
                                


                                <div class="row">
                                	<h4 class="form_title">Banking Details</h4>
                                <div class="col-md-6">
                                        
                                        <div class="form-group">                 
                                            <label>Bank Name*</label>
                                            <input type="text" name="bank_name" class="form-control" value="<?php echo set_value('bank_name'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group">                 
                                            <label>Account Name*</label>
                                            <input type="text" name="account_name" class="form-control" value="<?php echo set_value('account_name'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">                 
                                            <label>Branch Code*</label>
                                            <input type="text" name="branch_code" class="form-control" value="<?php echo set_value('branch_code'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                               

                               
                                <div class="col-md-6">
                                        <div class="form-group">                 
                                            <label>Account Number*</label>
                                            <input type="text" name="account_number" class="form-control" value="<?php echo set_value('account_number'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                        </div>

                                        <div class="col-md-6">
                                        <div class="form-group">                 
                                            <label>Account Type*</label>
                                            <input type="text" name="account_type" class="form-control" value="<?php echo set_value('account_type'); ?>" required>
                                        <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                    </div>

                                    <h4 class="form_title">My Auditting Areas</h4>
                                    <div class="col-sm-12">
                                      <div class="table-responsive">
                                         <div id="activeTable-message">
                                            <table id="isActive_message" class="display">
                                              <thead>
                                                <tr>
                                                   <th>Province</th>
                                                   <th>City</th>        
                                                   <th>Suburb</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>


                                              <tr>    
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                        <td>  <i class="fas fa-trash"></i></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <select class="form-control" name="province" data-placeholder="Choose a Category" id="province" value="<?php echo set_select('province'); ?>"tabindex="1" >

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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">City</label>                
                                            <select class="form-control" name="city" data-placeholder="Choose a Category" id="city" value="<?php echo set_select('city'); ?>"tabindex="1">
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
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
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
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">                                                    
                                        <div class="col-lg-5 col-sm-4 col-xs-12">
                                            <button type="submit" name="add_area" class="btn btn-block btn-primary btn-rounded">Add Area</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">                                                    
                                        <div class="col-lg-7 col-sm-4 col-xs-12">
                                            <button type="submit" name="update" class="btn btn-block btn-primary btn-rounded">Save/Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                   
