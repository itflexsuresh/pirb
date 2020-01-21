<html>
<head>
	<title> Company Details</title>
	   <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">
      <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/sample.js"></script>
      link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" >
       <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
       <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<center>
	<body style="background-color: #FFF;">
	<div>
		    <h2 class="title">Company Details</h2>
		    
		    <?php if (isset($message)) { ?>
                    <CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
            <?php } ?>
		
		<?php echo form_open(); ?>
        <?php echo form_open_multipart(''); ?>
		
	<table id="first-one" style="width: 20%">
		  
		  <div class="tab-content">
                        <div class="tab-pane cmpny_det active" id="compdetails">


                            <div class="col-md-12 form-group cmpny_sections complany_dtls">                                
                                <div class="col-md-6 form-group ">
                                    <label>Product Code :<span style="color: red;">*</span> </label>
                                    <div class="user_edits">
                                        <input name="product_code" type="text" id="pro_code" class="form-control" onkeypress="return AllowAlphabet(event)"  /><div id="message"><?php echo form_error('product_code'); ?></div>
                                    </div>
                                </div>
                            </div>

		<div class="col-md-12 form-group cmpny_sections complany_dtls">                                
                                <div class="col-md-6 form-group ">
                                    <label>Activity Name :</label>
                                    <div class="user_edits">
                                        <input name="activity_name" type="text" id="ContentPlaceHolder1_CompanyName" class="form-control" onkeypress="return AllowAlphabet(event)"  /><div id="message"><?php echo form_error('activity_name'); ?></div></br>
                                    </div>
                                </div>
                                                     


							<div class="col-md-6 form-group">
                                    <label>Activity Date:</label>
                                    <div class="user_edits">
                                        <input name="date" type="text" id="act_date" class="form-control"/><div id="message"><?php echo form_error('act_date'); ?></div></br>
                                    </div>
                                </div> 

		
                                <div class="col-md-6 form-group">
                                    <label>Renewal Date of this Activity</label>
                                    <div class="user_edits">
                                        <input name="date" type="text" id="act_date" class="form-control"/><div id="message"><?php echo form_error('act_date'); ?></div></br>
                                    </div>
                                </div> </div>	 

		
 		<div class="col-md-12 form-group cmpny_sections txt_area_msg">

                                <div class="col-md-6 form-group required">
                                    <h4><b>Comments </b></h4>
                                    <div class="user_edits">
                                        <textarea name="com_message" rows="3" cols="15" id="ContentPlaceHolder1_txtCompMsg" class="form-control">
</textarea><div id="message"><?php echo form_error('com_message'); ?></div></br>
                                    </div>
                                </div>
                            </div> 

<div class="col-md-12 form-group cmpny_sections txt_area_msg">

                                <div class="col-md-6 form-group required">
                                    <h4><b>Activity: </b></h4>
                                    <div class="user_edits">
                                        <input type="text" name="act_data" id="act_data" class="form-control"/><div id="message"><?php echo form_error('com_message'); ?></div></br>
                                    </div>
                                </div>
                            </div> 

                            <?php echo "<input type='file' name='userfile' size='20' />"; ?>
<?php echo "<input type='submit' name='submit' value='upload' /> ";?>


		
		                        </div>
                            </div>
                        </div>



                            </div> <br/>
		<?php echo form_submit(array('id' => 'submit', 'name' => 'save', 'value' => 'Submit')); ?>
	<?php echo form_close(); ?><br/>


	
	</table>

	</div>
</body>
</center>
</html>