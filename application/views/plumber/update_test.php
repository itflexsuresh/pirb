<?php
extract($res);

?>


    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
     <!-- <link href="<?= $base_path; ?>assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_path; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_path; ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" />
    <link href="<?= $base_path; ?>assets/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_path; ?>assets/css/components.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_path; ?>assets/css/colors.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?= $base_path; ?>assets/css/custom.css" rel="stylesheet" type="text/css" /> 
    

    <link rel="stylesheet" href="<?= $base_path; ?>optimum/plugins/bower_components/dropify/dist/css/dropify.min.css">
    

    <style type="text/css">
        .picker {
        }
        .zoom {
            transition: transform .2s;
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }
        .zoom:hover {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Safari 3-8 */
            transform: scale(1.5);
        }
        .registration .box_accordian .with-errors ul li::before {
            content: '';
        }
        .registration .box_accordian .with-errors ul li {
            color: red;
            padding: 0;
        }
    </style>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <input type="hidden" id="site_url" value="<?= $base_path; ?>">
                <input type="hidden" class="pk_val" value="<?= $id; ?>">
                <?php 
        //$this->load->view('plumber/application_update',$application_update);
        
        //echo form_open(); 
        echo form_open_multipart('', array('data-toggle' => 'validator','id' => 'plumber-update','ajax_submit' => 0,));

            if ($this->session->flashdata('msg')!='') {
                echo "<div class='alert alert-success'>";
                echo $this->session->flashdata('msg');
                echo "</div>";
            }
            ?>
                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Procedure of Registration<span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt1">
                                <ul>
                                    <li>All qualifications of any individual applying for registration will be vetted and verified with the various authenticating bodies.</li>
                                    <li>The applicant will be notified via email/sms/telephone of any discrepancies that are found and the applicants application will be put on hold. The process of the application/registration will only continue once it has been addressed. </li>
                                    <li>Once the application has been approved a pro-forma invoice for the yearly registration fee will be sent (current yearly registration fees can be found at www.pirb.co.za). The pro-forma invoice will be sent to the contact details that appear on the application/registration form. </li>
                                    <li>Only once payment has been received, the PIRB will continue with the application and the application will be registered on the PIRB database. </li>
                                    <li>It the applicant requested a card, the PIRB registration card registration will be sent via registered mail to the postal address that appears on the application form, or alternatively the PIRB Registration Card can also be collected from the PIRB registration office or collection points. </li>
                                    <li>If the registration card is sent via registered mail the relevant tracking number will be sms’d to the applicant and it will be the applicants responsibility to keep track of the registered mail. Any registered mail returned to PIRB office due to non-collection by the applicant will only be resent if an additional administration fee is paid. Alternatively it can be collected at the PIRB registration office. </li>
                                    <li>If the application is found to be in order and payment of the invoice has been within a reasonable time, the PIRB registration process should not take longer than 20 working days from receipt of application. </li>
                                    <li>Further information can be obtained from www.pirb.co.za or you may email registration@pirb.co.za </li>
                                </ul>
                                <div class="form-group">
                                <label class="ideclare_label">

                                    <?php


                                        $ProcedureRegistration_checkbox = array(
                                            'name'        => 'ProcedureRegistration',
                                            'value'       => 1,        
                                            'required'    => TRUE,                                    
                                        );
                                        if($res['ProcedureRegistration']==1){
                                            $ProcedureRegistration_checkbox['checked'] = TRUE;
                                        }
                                        echo form_checkbox($ProcedureRegistration_checkbox);
                                    ?>
                                    I declare that I have fully read and understood the Procedure of Registration <span>*</span>
                                    <div class="help-block with-errors"></div>
                                    <?php echo form_error('ProcedureRegistration'); ?>
                                </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                    //  exit;
                    ?>
                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Registration Card <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>

                            <div class="accr_cnt1">
                                <p>
                                    Due to the high number of card returns and cost incurred the registration fees do not include a registration card. Registration cards are available but must be requested separately. An
                                    <br />
                                    electronic format of the card will be available on the plumbers app.
                                </p>
                                <div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group form-group-default">
                                                <label>Registration Card  :</label>
                                                <div class="controls dropdown_arrow">
                                                    <?php
                                                    //$yes_no_arr = $this->config->item('yes_no_arr');

                                                    ?>
                                                    <?php
                                                        //  echo form_dropdown('RegistrationCard', $yes_no_arr, set_value('RegistrationCard'));
                                                        echo form_dropdown('RegistrationCard', $yes_no_arr, $res['RegistrationCard'],['id'=>'RegistrationCard','required'    => TRUE,'class'=>'form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group form-group-default">
                                                <label>Method of Delivery :</label>
                                                <div class="controls  dropdown_arrow">
                                                    <!-- <select id="DeliveryMethod" name="DeliveryMethod" class="form-control"> -->
                                                        <?php 
                                                                    
                                                        /*foreach($delivery_method_arr as $key=>$val){
                                                            echo "<option value='$key'>$val</option>";    
                                                        }*/
                                                        echo form_dropdown('DeliveryMethod', $delivery_method_arr, $res['DeliveryMethod'],['id'=>'DeliveryMethod','required'    => TRUE,'class'=>'form-control']);
                                                        ?>
                                                    <!-- </select> -->
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Register Personal Details <span id="dispMissingDataPersonal" style="display: none; color: red;"></span>  <span id="spanPersonal"  class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divPersonalDetails"  class="accr_cnt1">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group form-group-default">
                                            <b>Registered Plumber Details</b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <label>Title : <span>*</span></label>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                    <div class="controls dropdown_arrow">
                                                        <?php
                                                            
                                                        ?>
                                                        <?php
                                                            //  $title_arr['0']='';
                                                            echo form_dropdown('title', $title_arr, $res['title'],['id'=>'title','required'    => TRUE,'class'=>'form-control']);
                                                        ?>
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="form-group form-group-default">
                                                    <label>Date of Birth : <span>*</span></label>
                                                </div>

                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                    <div class="controls">
                                                        
                                                        <?php
                                                        echo form_input(['name' => 'DateofBirth','id' => 'dateofbirth' ,'class' => 'form-control','value' => $DateofBirth,'required'    => TRUE,'placeholder' => "DD/MM/YYYY",'autocomplete' => "off"]);
                                                        ?>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <?php echo form_error('DateofBirth'); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Name : <span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="Name" name="fname" class="form-control"  onkeypress="return AllowAlphabet(event)" value="<?= $fname; ?>">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('fname'); ?>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Surname : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="Surname" name="lname" class="form-control name"  onkeypress="return AllowAlphabet(event)" value="<?= $lname; ?>">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('lname'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Gender :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    
                                                    <?php

                                                            //  $title_arr['0']='';
                                                            echo form_dropdown('Gender', $gender_data, $Gender,['id'=>'Gender','required'    => TRUE,'class'=>'form-control']);
                                                        ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('Gender'); ?>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Racial Status : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <?php
                                                    
                                                    echo form_dropdown('Equity', $racialstatus_arr, $Equity,['id'=>'RacialStatus','required'    => TRUE,'class'=>'form-control']);
                                                    ?>
                                                    
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('Equity'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">                                        
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>South African National :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <?php
                                                    echo form_dropdown('CitizenResidentStatus', $yes_no_arr, $ResidentStatus,['id'=>'ddlSouthAfrNationanl','required'    => TRUE,'class'=>'form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <?php echo form_error('CitizenResidentStatus'); ?>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>id Number :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required name="IDNo" id="IDNumber" class="form-control exists_check" onkeypress="return AllowNumber(event)" MaxLength="13" value="<?= $IDNo; ?>" table="users" field="IDNo">
                                                    <div class="help-block with-errors"></div>
                                                    <span class="error"></span>
                                                </div>
                                                
                                            </div>
                                            <?php echo form_error('IDNo'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="other_nation" show="<?= $nationality_show; ?>">
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <label>Other Nationality :</label>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                    <div class="dropdown_arrow">
                                                        <?php
                                                        echo form_dropdown('Nationality', $nationality_arr, $Nationality,['id'=>'Nationality','required'    => TRUE,'class'=>'form-control']);
                                                        ?>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <?php echo form_error('Nationality'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Alternate id : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="AlternateID" name="Alternate" class="form-control"  onkeypress="return AllowAlphabetNumber(event)" value="<?= $Alternate; ?>">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('Alternate'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Home Language :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <?php
                                                    echo form_dropdown('Language', $home_language_arr, $Language,['id'=>'HomeLanguage','required'    => TRUE,'class'=>'form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('Language'); ?>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Disability : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <?php
                                                    echo form_dropdown('DisabilityStatus', $disability_arr, $DisabilityStatus,['id'=>'Disability','required'    => TRUE,'class'=>'form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('DisabilityStatus'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Citizen Residential Status :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <?php
                                                    echo form_dropdown('ResidentStatus', $resident_status_arr, $CitizenResidentStatus,['id'=>'ResidentStatus','required'    => TRUE,'class'=>'form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <?php echo form_error('ResidentStatus'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label><b>Identity Document(Example: id card/id Book/Passport)</b></label><span>*</span>
                                        </div>
                                        <div class="col-sm-5 ol-md-6 col-xs-12">
                                            <div class="white-box">
                                                <input type="file" id="photo" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="PNG png gif jpg jpeg pdf tiff" accept=".gif,.png,.jpg,.pdf,.tiff" name="Photo" data-default-file="<?php echo $base_path; ?>/uploads/certificates/<?php echo $Photo; ?>" value="<?= $Photo; ?>"/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Image or File Size Smaller than 2mb)</p>
                                            <label id="lblIdentity" ></label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<img id="imgThumbIdentity"  style="height: 50px;" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <b>Physical Address</b>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <b>Postal Address</b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label><span>Note all delivery services will be sent to this address</span></label>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label><span>Note all Postal services will be sent to this address</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Physical Address : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="PhysicalAddress" name="ResidentialStreet" class="form-control" value="<?= $ResidentialStreet ?>">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Postal Address :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required name="PostalAddress" id="postalAddress" class="form-control" value="<?= $PostalAddress ?>">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Province : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    
                                                    <?php
                                                    echo form_dropdown('Province', $province_data, $Province,['id'=>'ddlphysicalProvince','required'    => TRUE,'field'=>'province','class'=>'province form-control ajax_change']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Province : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    
                                                    <?php
                                                    echo form_dropdown('PostalProvince', $province_data, $PostalProvince,['id'=>'ddlPostalProvince','field'=>'province','required'=>TRUE,'change'=>'city-1','in-change'=>'area-1','class'=>'province form-control ajax_change']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>City : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    
                                                    <?php
                                                    echo form_dropdown('ResidentialCity', $city_data, $ResidentialCity,['id'=>'physicalCities','field'=>'city','required'    => TRUE,'class'=>'city form-control ajax_change','value'=>set_value('ResidentialCity')]);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>City : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    
                                                    <?php
                                                    echo form_dropdown('PostalCity', $phy_city_data, $PostalCity,['id'=>'postalCities','field'=>'city','change'=>'area-1','required'    => TRUE,'class'=>'form-control ajax_change city-1']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Suburb : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    
                                                    <?php
                                                    echo form_dropdown('ResidentialSuburb', $area_data, $ResidentialSuburb,['id'=>'physicalSuburb','field'=>'area','required'=> TRUE,'class'=>'area form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Suburb : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <!-- <select id="postalSuburb" name="postalSuburb"  class="form-control select2">
                                                    </select> -->
                                                    <?php
                                                    echo form_dropdown('PostalSuburb', $phy_area_data, $PostalSuburb,['id'=>'postalSuburb','field'=>'area','required'=> TRUE,'class'=>'area-1 form-control']);
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Postal Code : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required name="PostalCode" id="PostalCode" class="form-control" onkeypress="return AllowNumber(event)" value="<?= $PostalCode ?>">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label><b>Contact Details</b></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Home Phone : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="homePhone" name="homePhone" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)" value="<?= $homePhone ?>">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Mobile Phone : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="Mobile" name="contact" class="form-control"    MaxLength="10" onkeypress="return AllowNumber(event)" value="<?= $contact ?>">
                                                    <div class="help-block with-errors"></div>

                                                </div>
                                            </div>
                                            <?php echo form_error('contact'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label><span>Note all SMS and OTP notifications will be sent to this mobile number above</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Work Phone : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="txtContactWorkPhone" name="BusinessPhone" class="form-control" MaxLength="10" onkeypress="return AllowNumber(event)" value="<?= $BusinessPhone ?>">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Secondary Mobile Phone :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" id="txtContactSecMobilePhone" name="secondContact" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)" value="<?= $secondContact ?>">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Email Address :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" required id="txtContactEmailAddress" name="Email" class="form-control exists_check" value="<?= $Email ?>" table="users" field="email">
                                                    <div class="help-block with-errors"></div>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <?php echo form_error('Email'); ?>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Secondary Email Address : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="text" id="txtContactSecEmailAddress" name="SecondEmail" class="form-control" value="<?= $SecondEmail ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label><span>Note all Email notifications will be sent to this Email Address above</span></label>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Employment Details <span id="dispMissingDataEmployment" style="display: none; color: red;"></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divEmploymentDetails"  class="accr_cnt1">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Employment Status :  <span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="dropdown_arrow">
                                                <?php
                                                    echo form_dropdown('SocioeconomicStatus', $employment_status_data, $SocioeconomicStatus,['id'=>'EmploymentStatus','required'=> TRUE,'class'=>'form-control']);
                                                ?>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <?php echo form_error('SocioeconomicStatus'); ?>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group company_list" show="1">
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <label>Company :  <span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="dropdown_arrow">
                                                <?php
                                                    echo form_dropdown('company', $company_data, $company,['id'=>'CompanyID','required'=> TRUE,'class'=>'form-control']);
                                                ?>
                                                
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Photo Identification <span id="dispMissingDataPhoto" style="display: none; color: red;"></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divPhotoIdentification"  class="accr_cnt1">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12">
                                        <ul class="mb-0">
                                            <li>Photos must be no more than 6 months old </li>
                                            <li>Photos must be high quality </li>
                                            <li>Photos must be in colour </li>
                                            <li>Photos must have clear preferably white background </li>
                                            <li>Photos must be in sharp focus and clear </li>
                                            <li>Photo must be only of your head and shoulders </li>
                                            <li>You must be looking directly at the camera </li>
                                            <li>No sunglasses or hats </li>
                                            <li>Attachment should be no larger than 5MB</li>
                                            <li>File name is your NAME and SURNAME.</li>
                                        </ul>
                                        <br />
                                    </div>
                                    <div class="col-md-2">
                                        <img src="<?php echo $base_path; ?>assets/images/photo_identification.png" class="zoom" />
                                    </div>
                                    <div class="form-group">
                                    <div class="col-sm-5 ol-md-6 col-xs-12">
                                        <div class="white-box">
                                            <input type="file" id="IDPhoto" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="PNG png gif jpg jpeg pdf tiff" accept="image/*,.pdf,.tiff" data-default-file="<?php echo $base_path; ?>/uploads/certificates/<?php echo $IDPhoto; ?>" name="IDPhoto"/>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Designation <span id="dispMissingDataDesignation"  style="display: none; color: red;"></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt1">
                                <p>
                                    Note: Applications to Direct and Master Plumber and or specialisations can only be done once your registration has been verified and approved.
                                </p>
                                <p>Please select the relevant designation being applied for. To view the designation requirements <a href="PDF/Designations Chart.pdf" target="_blank">Click here</a></p>
                                <?php
                                    
                                    foreach($designation_arr as $key=>$val){
                                        //  $key++;
                                        if($key==$Designation){
                                            $checked = "checked='true'";
                                        } else {
                                            $checked = "";
                                        }
                                        echo "<input required type='radio' name='Designation' value='$key' $checked> $val<br>";    
                                    }
                                ?>
                                <div class="help-block with-errors"></div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Attachment <span id="dispMissingDataAttachment" style="display: none; color: red;"></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divAttachment"  class="accr_cnt1">
                                <p>
                                    If applicable attached all relevant documentation and or certificates for the respective designation being applied for. All qualification/doucmentation/certificates of any 
                                    individual applying for registration will be vetted and verified with the various authenticating bodies.
                                    <br />
                                </p>
                                <p>Please Attach ALL your qualification/documentation/certificates.</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="white-box">
                                            <div action="#" class="dropzone">
                                                <div class="fallback">
                                                    <input id="files" multiple="true" name="files[]" type="file" accept=".gif,.png,.jpg,.pdf,.tiff">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>PIRB’s Code of Conduct <span id="dispMissingDatacoconduct" style="display: none; color: red;"></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt1">
                                <ul>
                                    <li>PIRB registered plumbers agree to conduct themselves and their business in a professional manner which shall be seen by those they serve as being honourable, transparent and fair. </li>
                                    <li>PIRB registered plumbers agree to proactively perform, work and act to promote plumbing practices that protect the health and safety of the community and the integrity of the water supply and wastewater systems. </li>
                                    <li>PIRB registered plumbers agree to promote, protect and encourage the upliftment and advancement of the skills development and training in terms of the National Skills ACT., for themselves and individuals in the plumbing sector or wishing to join the plumbing industry. </li>
                                    <li>PIRB registered plumbers agree to monitor and enforce compliance with technical standards of plumbing work that comply with all requirements of the relevant SANS codes of practice and regulations set out in the compulsory National Standards of the Water Service Act 1997 Amended (8th June2001) as well as relevant local municipal bylaws. </li>
                                    <li>PIRB registered plumbers agree to actively promote and support a consistent and effective regulatory plumbing environment throughout South Africa. </li>
                                    <li>PIRB registered plumbers agree to regularly consult and liaise with the plumbing industry in an open forum free of any political or commercial agenda for the discussion of matters affecting the plumbing industry and the role of plumbing for the well-being of the community and the integrity of the water supply and wastewater systems. </li>
                                    <li>PIRB registered plumbers agree to promote, monitor and maintain expertise and competencies among our registered and non-registered plumbing professionals. </li>
                                    <li>PIRB registered Licensed plumbers agree to issue a PIRB Plumbing Certificate of Compliance (COC) on all plumbing works undertaken as a PIRB Licensed Plumber and shall further issue the COC in terms of the prescribe requirements for issuing of a PIRB Plumbing COC. </li>
                                </ul>
                                <div class="form-group">
                                <label class="ideclare_label">
                                    <?php
$CodeConduct_checkbox = array(
        'name'        => 'CodeConduct',
        'id'        => 'chkPIRBCodeConduct',      
        'required'=> TRUE,  
        'value'       => 1,
        //  'checked'     => set_checkbox('CodeConduct', set_value('CodeConduct'), false)
    );
if($res['CodeConduct']==1){
    $CodeConduct_checkbox['checked'] = TRUE;
}
    echo form_checkbox($CodeConduct_checkbox);
?>
                                    <!-- <input type="CheckBox" id="chkPIRBCodeConduct"  name="chkPIRBCodeConduct"  /> -->
                                    I declare that I have fully read and understood the PIRB’s Code of Conduct : <span>*</span>
                                    <div class="help-block with-errors"></div>
                                    <?php echo form_error('CodeConduct'); ?>
                                </label>
                            </div>

                            </div>

                        </div>
                    </div>
                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Acknowledgement <span id="dispMissingDataAck" style="display: none; color: red;"></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>

                            <div class="accr_cnt1">
                                <ul>
                                    <li>I acknowledge that part of the PIRB registration process, all qualifications of any individual applying for registration is vetted and verified with various authenticating bodies. If it is found that the relevant authenticating bodies have no knowledge or records of the relevant individuals qualification it will be forwarded to the PIRB Steering Committee to be reviewed. Only once the PIRB steering committee have reviewed your trade test result and gave authorization will be the PIRB register the relevant individual. Further to this if the verification bodies at any stage communicate to the PIRB that the relevant individuals qualification is no longer valid for reason beyond the PIRB’s control, the PIRB reserve the right to remove the PIRB status of the registered individual with immediate effect and the PIRB will not be held liable for any possible damages that may arise from this. It will further not be the responsibility of the PIRB to address or follow this up with the authenticating body. </li>
                                    <li>I acknowledge that plumber registration is an annual registration and that a registration fee is charged for plumber registration and this fee which is subject to change is to be paid into the PIRB bank account before I am to be registered. </li>
                                    <li>I acknowledge that I must reapply for re-registration, one calendar month before the renewal date that appears on my registration card and that the PIRB reserves the right to level a penalty fee for late registration. </li>
                                    <li>I acknowledge that the PIRB has the authority to suspend or terminate my registration if I act against the best interest of the PIRB, its aims and objectives and the PIRB’s Plumbers Code of Conduct. I further acknowledge that in the event of a suspension and or termination the PIRB’s reserves the right to notify this fact publically and the reason for the suspension and/or termination. </li>
                                    <li>I acknowledge that if I register for the designation of a Licensed, I shall agree to issue a PIRB Plumbing Certificate of Compliance (COC) on all plumbing works undertaken as a PIRB Licensed Plumber. </li>
                                    <li>I acknowledged that the issuing of the PIRB Plumbing COC shall be done in the strict defined terms of the prescribe requirements for issuing of a PIRB Plumbing COC and acknowledge that random audits will take place on the COC’s and that I will give full cooperation in this regard. </li>
                                    <li>I acknowledge that as a Licensed Plumber if I fail to issue a PIRB Plumbing Certificate of Compliance (COC) for work undertaken, carried out and or work adequately supervised; and a complaint is raised against the said plumbing works and or my actions; and the said plumbing works and or my actions are found to be contra to the PIRB’s Code of Conduct, I may and can be held accountable for all cost incurred in resolving the said complaint. </li>
                                    <li>I acknowledge and understand that unless otherwise stated all personal data will be held by the PIRB under strict confidence and will not be shared with any third parties without consent.</li>
                                </ul>
                                <div class="form-group">
                                <label class="ideclare_label">
                                    <?php
                                    $Acknowledgement_checkbox = array(
                                            'name'        => 'Acknowledgement',
                                            'required'=> TRUE,
                                            'id'        => 'chkAcknowledge',                                            
                                            'value'       => 1,
                                            //  'checked'     => set_checkbox('Acknowledgement', set_value('Acknowledgement'), false)
                                        );
                                    if($res['Acknowledgement']==1){
                                        $Acknowledgement_checkbox['checked'] = TRUE;
                                    }
                                        echo form_checkbox($Acknowledgement_checkbox);
                                    ?>
                                   <!--  <input type="CheckBox" id="chkAcknowledge" name="chkAcknowledge" /> -->
                                    I declare that I have fully read and understood the Acknowledgement :<span>*</span>
                                    <div class="help-block with-errors"></div>
                                    <?php echo form_error('Acknowledgement'); ?>
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Declaration <span id="dispMissingDataDec"   style="display: none; color: red; width:20%"></span><span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt1">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="col-md-1 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <label>I</label>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                    <div class="controls">
                                                        <input type="text" id="DeclarationName" name="DeclarationName" class="form-control" onkeypress="return AllowAlphabet(event)" value="<?= $DeclarationName; ?>">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="form-group form-group-default">
                                                    <label>Identification number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                    <div class="controls">
                                                       <input type="text" id="DeclarationIDNumber" name="DeclarationIDNumber" class="form-control"   onkeypress="return AllowAlphabetNumber(event)" value="<?= $DeclarationIDNumber; ?>" >
                                                       <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <label class="ideclare_label">
                                                    <br />
                                                    <br />
                                                    <?php
                                                    $Declaration_checkbox = array(
                                            'name'        => 'Declaration',
                                            'id'        => 'chkDeclare',
                                            'required'=> TRUE,
                                            'value'       => 1,
                                            'checked'     => set_checkbox('Declaration', set_value('Declaration'), false)
                                        );
                                                    if($res['Declaration']==1){
                                                        $Declaration_checkbox['checked'] = TRUE;
                                                    }
                                        echo form_checkbox($Declaration_checkbox);
                                        ?>
                                                    <!-- <input type="CheckBox" id="chkDeclare" name="chkDeclare" /> -->
                                                    &nbsp;&nbsp;&nbsp;Declare that the information contained in this application, or attracted by me to this application, is comaplete, accurate and true to the best of my knowledge. I further declarea that by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;forwarding this completed
                                                    application form to the PIRB I am acknowledging that i have read and fully understood what is registered and professional! plumber and that I adhere to all aims and &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;objectivies to the PIRB and
                                                    the PIRB's Plumber Code of Conduct. I give consent for enquires for verification purposes to be made into any information i have given on this application.<span>*</span>
                                                    <div class="help-block with-errors"></div>
                                                    <?php echo form_error('Declaration'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <?php echo form_submit(array('id' => 'Submit', 'class' => 'btn btn-primary','name' => 'save', 'value' => 'Submit')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
              
        </div>
        <!-- /boxed layout wrapper -->
    
    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    <script src="<?= $base_path; ?>assets/js/main/jquery.min.js"></script>
    <script src="<?= $base_path; ?>assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_path; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    

    <script src="<?= $base_path; ?>assets/js/app.js"></script>
    <script src="<?= $base_path; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?= $base_path; ?>assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="<?= $base_path; ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="<?= $base_path; ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="<?= $base_path; ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="<?= $base_path; ?>assets/js/custom.js"></script>

    <script>


        function AllowAlphabet(e) {
            isIE = document.all ? 1 : 0
            keyEntry = !isIE ? e.which : event.keyCode;
            if (((keyEntry >= '65') && (keyEntry <= '90')) || ((keyEntry >= '97') && (keyEntry <= '122')) || (keyEntry == '46') || (keyEntry == '32') || keyEntry == '45')
                return true;
            else {
                //alert('Please Enter Only Character values.');
                return false;
            }
        }

        function AllowNumber(e) {
            isIE = document.all ? 1 : 0
            keyEntry = !isIE ? e.which : event.keyCode;
            if ((keyEntry >= '48') && (keyEntry <= '57'))
                return true;
            else {
                //alert('Please Enter Only Character values.');
                return false;
            }
        }

        function AllowAlphabetNumber(e) {
            isIE = document.all ? 1 : 0
            keyEntry = !isIE ? e.which : event.keyCode;
            if (((keyEntry >= '65') && (keyEntry <= '90')) || ((keyEntry >= '97') && (keyEntry <= '122')) || (keyEntry == '46') || (keyEntry == '32') || keyEntry == '45' || ((keyEntry >= '48') && (keyEntry <= '57')))
                return true;
            else {
                //alert('Please Enter Only Character values.');
                return false;
            }
            
        }


        $('.anytime-month-numeric').AnyTime_picker({
            format: '%d/%m/%Z'
        });
        

        $('.pickadate-accessibility').pickadate({
            labelMonthNext: 'Go to the next month',
            labelMonthPrev: 'Go to the previous month',
            labelMonthSelect: 'Pick a month from the dropdown',
            labelYearSelect: 'Pick a year from the dropdown',
            selectMonths: true,
            selectYears: true
        });

    </script>

    <script>

        $(document).ready(function () {
            
            $('.tittle_box').click(function () {
                var accnt = $(this).parents('.box_accordian').find('.accr_cnt1');
                if ($(accnt).css('display') == 'block') {
                    $(this).find('.fa').addClass('fa-angle-down');
                    $(this).find('.fa').removeClass('fa-angle-up');
                    $(accnt).slideUp(300);
                }
                if ($(accnt).css('display') == 'none') {
                    $('.accr_cnt1').slideUp(300);
                    $('.tittle_box .fa').addClass('fa-angle-down');
                    $('.tittle_box .fa').removeClass('fa-angle-up');
                    $(this).find('.fa').removeClass('fa-angle-down');
                    $(this).find('.fa').addClass('fa-angle-up');
                    $(accnt).slideDown(300);
                }
            })
        })
    </script>
    <script>
        $(document).ready(function (e) {
            $('.genter_btn').click(function () {
                $('.genter_btn').toggleClass('open');
                $(this).toggleClass("active");
                $(this).removeClass("remove");
            });
        });

    </script>
    <script type="text/javascript" src="<?= $base_path; ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var date_input = $('input[name="DateofBirth"]'); //our date input has the name "dateofbirth"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
                close: true,
            };
            date_input.datepicker(options);
        })
    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $(".only-numeric").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode

                if (!(keyCode >= 48 && keyCode <= 57)) {
                    $(".error").css("display", "inline");
                    return false;
                } else {
                    $(".error").css("display", "none");
                }
            });
        });

    </script>
    <script src="<?= $base_path; ?>optimum/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.dropify').dropify();
        });

    </script>    

    <script src="<?= $base_path; ?>optimum/js/validator.js"></script>

    <script type="text/javascript" src="<?= $base_path; ?>optimum/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
    <link rel="stylesheet" href="<?= $base_path; ?>optimum/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
    <script type="text/javascript" src="<?= $base_path; ?>optimum/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
    <script type="text/javascript" src="<?= $base_path; ?>optimum/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?= $base_path; ?>assets/dropzone.css">
    <script type="text/javascript" src="<?= $base_path; ?>assets/dropzone.js"></script>

    <script type='text/javascript'>
        Dropzone.autoDiscover = false;
            $(".dropzone").dropzone({
                url: "../upload",
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                maxFilesize: 2,
                addRemoveLinks: true,
                dictInvalidFileType:"Select valid file",
                removedfile: function(file) {
                    var name = file.name;                    
                    $.ajax({
                        type: 'POST',
                        url: '../upload',
                        data: {name: name,request: 2},
                        sucess: function(data){
                            console.log('success: ' + data);
                        }
                    });
                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                init: function() {   
                    myDropzone = this;
                    $.ajax({
                        url: '../upload',
                        type: 'post',
                        data: {request: 3,user_id:<?= $id ?>},
                        dataType: 'json',
                        success: function(response){
                            
                            $.each(response, function(key,value) {
                                var mockFile = { name: value.name, size: value.size };

                                myDropzone.emit("addedfile", mockFile);
                                myDropzone.emit("thumbnail", mockFile, value.path);
                                myDropzone.emit("complete", mockFile);

                            });

                        }
                    });
                }
            });
    </script>