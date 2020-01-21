<!DOCTYPE html>
<html>
<head>
</head>
<body class="login-container">
   
     <?php
     $this->load->helper('form'); ?>
     <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style.css">
     <link rel = "stylesheet" type = "text/css" href = "http://diyesh.com/auditit/assets/css/ui/style.css">
   <?php $attributes = array('class' => 'email', 'id' => 'form2', 'method' => 'post','data-toggle' => 'validator');
   $register_attr = array('class' => 'register','data-toggle' => 'validator', 'id' => 'plumber_register', 'method' => 'post');
    
    ?>
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">

                        <!-- <div class="col-md-4">
                        </div> -->
                        <div class="col-md-4 login_section">
                           
                            <div class="logo_section">
                                <img src="http://diyesh.com/auditit_new/auditit/assets/images/PIRB_Logo_Portrait.png" style="height: 150px;">
                            </div>

                            <!-- Simple login form -->
                            <div class="panel panel-body additonal_text">
                                <div class="text-center">
                                    <h3>Already Registered</h3>
                                    <p>If you are already registered please enter your login details</p>
                                    <!-- <h5 class="content-group">Sign in to your PIRB account </h5> -->
                                </div>
                                <?php
                                echo form_open_multipart('Login/index', $attributes);
                                ?>
                                <div class="form-group has-feedback has-feedback-left">
                                    <input name="username" type="text" id="username" class="form-control" placeholder="Email Address" required="" />
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required="" />
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>

                                <div class="forget_section">
                                    <h5>Forgot Password</h5>
                                    <a href="#">PIRB Company Login</a>
                                </div>

                                <div class="form-group text-center">
                                    <input type="submit" name="SignIN" value="LOGIN" id="SignIN" class="btn btn-primary btn-cons" />
                                </div>
<!--                                 <div class="form-group text-center">
                                    <a href="http://www.sluggvideos.co.za/videos/Webinar%20Recordings/Inspect/How%20tos/How%20to%20sign%20in.wmv" target="_blank">
                                        <label class="btn btn-info">How to login</label></a>
                                    <a href="http://www.sluggvideos.co.za/videos/Webinar%20Recordings/Inspect/How%20tos/How%20to%20Log%20a%20CoC.wmv" target="_blank">
                                        <label class="btn btn-info">How to Log a coc</label></a>
                                    <a href="http://www.sluggvideos.co.za/videos/Webinar%20Recordings/Inspect/How%20tos/How%20to%20Purchase%20a%20CoC.wmv " target="_blank">
                                        <label class="btn btn-info">How to Purchase a CoC</label></a>
                                </div> -->
                                <br /> <?php
                                echo form_close(); 
                                if (validation_errors() != false)
    {
echo '<div class="nNote nFailure">';

            echo form_error('username', '<p>', '</p>');
                   echo form_error('password', '<p>', '</p>');
                   echo '</div>';
            
        } ?> <br />
                                <!-- <div class="text-center">
                                    <a href="<?php //   echo base_url(); ?>Login/Forgot_password" class="text-info small">Forgot password</a>
                                </div> -->
                                
                                

                               <!--  <img src="assets/PIRB%20landscape.png" class="img-responsive" style="width: 100%;" /> -->
                            </div>

                            <div class="new_registeration_sec">
                                <div class="reg_overall">
                                    <div class="reg_heading">
                                        <h3>Individual Registeration with the PIRB</h3>
                                        <p>Register as a Individaul with the Plumbing Regsitration Board</p>
                                        <a href="#">About the Registration Process</a>
                                    </div>
                                     <?php
                                    echo form_open_multipart('Login/index', $register_attr);
                                    ?>
                                    <div class="reg_form">
                                        <div class="form-group">
                                            <input name="email" type="email" data-toggle="validator" id="email" required class="form-control" placeholder="Email Address" />
                                            <div class="help-block with-errors"></div>
                                            <?php echo form_error('email'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input name="verify_email" type="email" id="verify_email" required class="form-control" placeholder="Verifiy Email Address" data-match="#email" data-match-error="Email address don't match" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                        <input name="user_password" type="password" data-toggle="validator" id="user_password" required class="form-control" placeholder="Password"  />
                                        <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                        <input name="user_verify_password" type="password" id="verifiy_pass" required class="form-control" placeholder="Verifiy Password" data-match="#user_password" data-match-error="Password don't match" />
                                        <div class="help-block with-errors"></div>
                                        </div>
                                        <p>Password must be 8 to 24 characters, is case sensitive, and cannot contain spaces.</p>
                                    </div>
                                    <div class="reg_footer">
                                        <a href="#">Register your Company with the PIRB</a>
                                        <input type="submit" name="register" value="Register Now" id="register_now" class="btn btn-primary btn-cons" />
                                    </div>
                                    <?php   echo form_close(); 


?>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="col-md-4">
                        </div> -->

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
<script src="<?= $base_path; ?>assets/js/main/jquery.min.js"></script>    
<link rel="stylesheet" href="http://diyesh.com/auditit_new/auditit/optimum/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script type="text/javascript" src="http://diyesh.com/auditit_new/auditit/optimum/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
<script type="text/javascript" src="http://diyesh.com/auditit_new/auditit/optimum/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>
<script src="<?= $base_path; ?>optimum/js/validator.js"></script>
</body>

</html>