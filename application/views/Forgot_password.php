<!DOCTYPE html>
<html>
<head>
</head>
<body class="login-container">
   <!--  <form method="post" action="./Default" id="form2"> -->
     <?php
     $this->load->helper('form'); ?>
     <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style.css">
   <?php $attributes = array('class' => 'email', 'id' => 'form2', 'method' => 'post');
    echo form_open_multipart('Login/Forgot_password_update', $attributes);
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
                        <div class="col-md-4">
                           
                            <!-- Simple login form -->
                            <div class="panel panel-body">
                                <div class="text-center">
                                    <img src="<?php echo base_url('assets/images/PIRB_Logo_Portrait.png'); ?>" style="height: 150px;" style="height: 150px;" />
                                    <h5 class="content-group">Reset your PIRB account </h5>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <input name="username" type="text" id="username" class="form-control" placeholder="Enter your username" required="" />
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <!-- <div class="form-group has-feedback has-feedback-left">
                                    <input name="password" type="password" id="password" class="form-control" placeholder="Enter your password" required="" />
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div> -->
                                <div class="form-group text-center">
                                    <input type="submit" name="Forgot_pwd" value="Reset" id="Forgot_pwd" class="btn btn-primary btn-cons" />
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
                                if (validation_errors() != false)
    {
echo '<div class="nNote nFailure">';

            echo form_error('username', '<p>', '</p>');
                   echo form_error('password', '<p>', '</p>');
                   echo '</div>';
            
        } ?> <br />
                                <div class="text-center">
                                    <a href="<?php echo base_url(); ?>Login/index" class="text-info small">Go Back</a>
                                </div>
                                
                                

                               <!--  <img src="assets/PIRB%20landscape.png" class="img-responsive" style="width: 100%;" /> -->
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
    <!-- </form> -->
<?php    form_close(); 


?>
</body>

</html>