
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>New Registration</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>assets/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>assets/css/components.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL; ?>assets/css/colors.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- /global style sheets -->

      


    <style>
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
    </style>
</head>
<body class="">
    
    	<?php echo form_open(); ?>
        <!-- Boxed layout wrapper -->
        <div class="d-flex flex-column flex-1 header_blue_bg">
            <div class="tittle">
                <div class="container">
                    <h1></h1>
                </div>
            </div>
            <div class="registration">
                <div class="container">
                    <div class="top_box">
                        <div class="box_accordian">
                            <!--<span style="color:red;">Please take note of all the  fields</span>
                        <div class="alert alert-danger"  id="ERRMSGsub"></div>-->
                            <div class="tittle_box">
                                <h2>Procedure of Registration <span id="dispMissingDataproc" style="display: none; color: red;"><b>Missing Data</b></span> <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt">
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
                                <label class="ideclare_label">
                                    I declare that I have fully read and understood the Procedure of Registration <span>*</span>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Registration Card <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>

                            <div class="accr_cnt">
                                <p>
                                    Due to the high number of card returns and cost incurred the registration fees do not include a registration card. Registration cards are available but must be requested separately. An
                                    <br />
                                    electronic format of the card will be available on the plumbers app.
                                </p>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group form-group-default">
                                                <label>Registration Card  :</label>
                                                <div class="controls dropdown_arrow">
                                                    <?php
                                                    $yes_no_arr = $this->config->item('yes_no_arr');
                                                    ?>
                                                    <?php
                                                        //  echo form_dropdown('RegistrationCard', $yes_no_arr, set_value('RegistrationCard'));
                                                        echo form_dropdown('RegistrationCard', $yes_no_arr, set_value('RegistrationCard'),['id'=>'RegistrationCard','class'=>'form-control']);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group form-group-default">
                                                <label>Method of Delivery :</label>
                                                <div class="controls  dropdown_arrow">
                                                    <select id="DeliveryMethod" name="DeliveryMethod" class="form-control">
                                                        <?php 
                                                        $delivery_method_arr = $this->config->item('delivery_method_arr');            
                                                        foreach($delivery_method_arr as $key=>$val){
                                                            echo "<option value='$key'>$val</option>";    
                                                        }
                                                        ?>
                                                    </select>
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
                                <h2>Register Personal Details <span id="dispMissingDataPersonal" style="display: none; color: red;"><b>Missing Data</b></span>  <span id="spanPersonal"  class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divPersonalDetails"  class="card accr_cnt">
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
                                                            $title_arr = $this->config->item('title_arr');
                                                        ?>
                                                        <?php
                                                            //  $title_arr['0']='';
                                                            echo form_dropdown('title', $title_arr, set_value('title'),['id'=>'title','class'=>'form-control']);
                                                        ?>
                                                    </div>
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
                                                        <input class="form-control" id="dateofbirth" name="DateofBirth" placeholder="DD/MM/YYYY"  autocomplete="off" value="<?= set_value('DateofBirth') ?>"/>
                                                    </div>
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
                                                    <input type="textbox" id="Name" name="fname" class="form-control"  onkeypress="return AllowAlphabet(event)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Surname : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="Surname" name="lname" class="form-control"  onkeypress="return AllowAlphabet(event)" value="<?= set_value('lname') ?>">
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
                                            <label>Gender :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="Gender" name="Gender" class="form-control"  >
                                                        <option value=""></option>
                                                        <?php 
                                                            $gender_arr = $this->config->item('gender_arr');            
                                                            foreach($gender_arr as $key=>$val){
                                                                echo "<option value='$key'>$val</option>";    
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Racial Status : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="RacialStatus" name="Equity" class="form-control" >
                                                        <option value=""></option>
                                                        <?php 
                                                            $racialstatus_arr = $this->config->item('racialstatus_arr');            
                                                            foreach($racialstatus_arr as $key=>$val){
                                                                echo "<option value='$key'>$val</option>";    
                                                            }
                                                        ?>
                                                    </select>
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
                                            <label>South African National :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="ddlSouthAfrNationanl" name="CitizenResidentStatus" class="form-control" >
                                                        <option value=""></option>
                                                        <?php 

                                                        $yes_no_arr = $this->config->item('yes_no_arr');            
                                                        
                                                        foreach($yes_no_arr as $key=>$val){
                                                            echo "<option value='$key'>$val</option>";    
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
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
                                                    <input type="textbox" name="IDNo" id="IDNumber" class="form-control" onkeypress="return AllowNumber(event)" MaxLength="13">
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
                                            <label>Other Nationality :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="Nationality" name="Nationality" class="form-control" >
                                                        <option value=""></option>
                                                        <?php
                                                            $nationality_arr = $this->config->item('nationality_arr');
                                                            foreach($nationality_arr as $key=>$val){
                                                                $key++;
                                                                echo "<option value='$key'>$val</option>";    
                                                            }
                                                        ?>
                                                        <!-- <option value="Angola">Angola</option>
                                                        <option value="Asian countries">Asian countries</option>
                                                        <option value="Australia Oceania countries">Australia Oceania countries</option>
                                                        <option value="Botswana">Botswana</option>
                                                        <option value="European countries">European countries</option>
                                                        <option value="Lesotho">Lesotho</option>
                                                        <option value="Malawi">Malawi</option>
                                                        <option value="Mauritius">Mauritius</option>
                                                        <option value="Mozambique">Mozambique</option>
                                                        <option value="N/A: Institution">N/A: Institution</option>
                                                        <option value="Namibia">Namibia</option>
                                                        <option value="North American countries">North American countries</option>
                                                        <option value="Other & rest of Oceania">Other & rest of Oceania</option>
                                                        <option value="Rest of Africa">Rest of Africa</option>
                                                        <option value="SADC except SA">SADC except SA</option>
                                                        <option value="Seychelles">Seychelles</option>
                                                        <option value="South / Central American countries">South / Central American countries</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="Swaziland">Swaziland</option>
                                                        <option value="Tanzania">Tanzania</option>
                                                        <option value="Unspecified">Unspecified</option>
                                                        <option value="Zaire">Zaire</option>
                                                        <option value="Zambia">Zambia</option>
                                                        <option value="Zimbabwe">Zimbabwe</option> -->
                                                    </select>
                                                </div>
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
                                                    <input type="textbox" id="AlternateID" name="AlternateID" class="form-control"  onkeypress="return AllowAlphabetNumber(event)" >
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
                                            <label>Home Language :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="HomeLanguage" name="HomeLanguage" class="form-control" >
                                                        <option value=""></option>
                                                        <?php
                                                            $home_language_arr = $this->config->item('home_language_arr');
                                                            foreach($home_language_arr as $key=>$val){
                                                                $key++;
                                                                echo "<option value='$key'>$val</option>";    
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Disability : <span>*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="Disability" name="Disability" class="form-control" >
                                                        <option value=""></option>
                                                        <?php
                                                            $disability_arr = $this->config->item('disability_arr');
                                                            foreach($disability_arr as $key=>$val){
                                                                $key++;
                                                                echo "<option value='$key'>$val</option>";    
                                                            }
                                                        ?>
                                                    </select>
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
                                            <label>Citizen Residential Status :<span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="ResidentStatus" name="ResidentStatus" class="form-control" >
                                                        <option value=""></option>
                                                        <?php
                                                            $resident_status_arr = $this->config->item('resident_status_arr');
                                                            foreach($resident_status_arr as $key=>$val){
                                                                $key++;
                                                                echo "<option value='$key'>$val</option>";    
                                                            }
                                                        ?>
                                                    </select>
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
                                            <label><b>Identity Document(Example: id card/id Book/Passport)</b></label><span>*</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="file_fields">
                                                    <input type="File" id="FilePersonalIdentity" id="FilePersonalIdentity"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <button id="btnPersonalIdentity" class="btn btn-primary"  Text="Upload" OnClick="btnPersonalIdentity_Click1" formnovalidate />
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Image or File Size Smaller than 5mb)</p>
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
                                                    <input type="textbox" id="PhysicalAddress" name="ResidentialStreet" class="form-control"  >
                                                </div>
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
                                                    <input type="textbox" id="postalAddress" class="form-control"  >
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
                                                    <select id="ddlphysicalProvince"  class="form-control"
                                                        OnSelectedIndexChanged="ddlphysicalProvince_SelectedIndexChanged" AutoPostBack="true">
                                                    </select>
                                                </div>
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
                                                    <select id="ddlPostalProvince"  class="form-control" OnSelectedIndexChanged="ddlPostalProvince_SelectedIndexChanged" AutoPostBack="true" ReadOnly="true">
                                                    </select>
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
                                            <label>City : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="physicalCities"  class="form-control select2"
                                                        OnSelectedIndexChanged="physicalCities_SelectedIndexChanged" AutoPostBack="true" ReadOnly="true">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
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
                                                    <select id="postalCities"  class="form-control select2" ReadOnly="true">
                                                        <option value=""></option>
                                                    </select>
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
                                            <label>Suburb : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="physicalSuburb" name="physicalSuburb"  class="form-control select2">
                                                    </select>
                                                </div>
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
                                                    <select id="postalSuburb" name="postalSuburb"  class="form-control select2">
                                                    </select>
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
                                                    <input type="textbox" name="PostalCode" id="PostalCode" class="form-control"   onkeypress="return AllowNumber(event)">
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
                                                    <input type="textbox" id="homePhone" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)">
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
                                                    <input type="textbox" id="Mobile" class="form-control"    MaxLength="10" onkeypress="return AllowNumber(event)">

                                                </div>
                                            </div>
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
                                                    <input type="textbox" id="txtContactWorkPhone" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)">
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
                                                    <input type="textbox" id="txtContactSecMobilePhone" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)">
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
                                                    <input type="textbox" id="txtContactEmailAddress" class="form-control"    TextMode="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Secondary Email Address : </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtContactSecEmailAddress" class="form-control"   TextMode="Email">

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
                                <h2>Employment Details <span id="dispMissingDataEmployment" style="display: none; color: red;"><b>Missing Data</b></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divEmploymentDetails"  class="accr_cnt">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Employment Status :  <span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="dropdown_arrow">
                                                <select id="EmploymentStatus"  class="form-control" >
                                                    <option value=""></option>
                                                    <option value="Employed">Employed</option>
                                                    <option value="Unemployed">Unemployed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <label>Company :  <span>*</span></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="dropdown_arrow">
                                                <select id="CompanyID"  class="form-control" OnSelectedIndexChanged="CompanyID_SelectedIndexChanged" AutoPostBack="True"></select>
                                            </div>
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
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label><b>New Company Details</b></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Company Name :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtEmpCompanyName" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Company Registration Number :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtEmpCompanyRegNo" class="form-control"  >
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
                                            <label>VAT Number :  </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="controls">
                                                <input type="textbox" id="CompanyVAt" class="form-control"  >
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <label>Primary Contact Person : </label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="controls">
                                                <input type="textbox" id="primaryContact" class="form-control"  >
                                            </div>
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
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Physical Address :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="empAddress" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Postal Address :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="empPostalAddress" class="form-control"  >
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
                                            <label>Province :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="ddlEmpPhysProvince"  class="form-control" AutoPostBack="true" OnSelectedIndexChanged="ddlEmpPhysProvince_SelectedIndexChanged"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Province :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="dropdown_arrow">
                                                    <select id="ddlEmpPostalProvince"  class="form-control" OnSelectedIndexChanged="ddlEmpPostalProvince_SelectedIndexChanged" AutoPostBack="true">
                                                    </select>
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
                                            <label>City :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="ddlEmpPhysCity"  class="form-control select2"
                                                        OnSelectedIndexChanged="ddlEmpPhysCity_SelectedIndexChanged" AutoPostBack="true" ReadOnly="true">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>City :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="ddlEmpPostalCity"  class="form-control select2"
                                                        OnSelectedIndexChanged="ddlEmpPostalCity_SelectedIndexChanged" AutoPostBack="true" ReadOnly="true">
                                                        <option value=""></option>
                                                    </select>
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
                                            <label>Suburb :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="ddlEmpPhysSuburb"  class="form-control select2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Suburb :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls dropdown_arrow">
                                                    <select id="ddlEmpPostalSuburb"  class="form-control select2">
                                                    </select>
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
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label></label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-right: 0 !important; margin-bottom: 0 !important;">
                                            <div class="form-group form-group-default">
                                                <label>Postal Code :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtEmpPostalCode" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)">
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
                                            <label>Company Tel :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtEmpContWorkPhone" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Fax Number :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="controls">
                                                <input type="textbox" id="txtEmpFaxno" class="form-control"   MaxLength="10" onkeypress="return AllowNumber(event)">
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
                                            <label>Mobile Phone :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtEmpContMobilePhone" class="form-control" MaxLength="10" onkeypress="return AllowNumber(event)"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <label>Email Address :</label>
                                        </div>
                                        <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                            <div class="user_edits">
                                                <div class="controls">
                                                    <input type="textbox" id="txtEmpEmailAddress" class="form-control"   TextMode="Email">
                                                </div>
                                            </div>
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
                                <h2>Photo Identification <span id="dispMissingDataPhoto" style="display: none; color: red;"><b>Missing Data</b></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divPhotoIdentification"  class="accr_cnt">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
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
                                    <div class="col-md-4 col-xs-12">
                                        <!--<p>Attached Photo : <span>*</span></p>-->
                                        <img src="assets/img/Picture1.png" class="zoom" />
                                        <div class="input_box">
                                            <div class="file_fields">
                                                Choose Picture :<input type="File" id="FilePhotoIdentity" name="FilePhotoIdentity"/>
                                            </div>
                                            <div>
                                                <button id="btnPhotoIdentification" class="btn btn-primary"  Text="Upload" OnClick="btnPhotoIdentification_Click" formnovalidate="false" />
                                            </div>
                                            <label id="lblErrPhotoIdentification" ></label>
                                            <img id="imgthumbPhotoIdentification"  style="height: 50px;" />
                                            <div id="divPhotoIdentificationValue" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Designation <span id="dispMissingDataDesignation"  style="display: none; color: red;"><b>Missing Data</b></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt">
                                <p>
                                    Note: Applications to Direct and Master Plumber and or specialisations can only be done once your registration has been verified and approved.
                                </p>
                                <p>Please select the relevant designation being applied for. To view the designation requirements <a href="PDF/Designations Chart.pdf" target="_blank">Click here</a></p>
                                <?php
                                    $designation_arr = $this->config->item('designation_arr');
                                    foreach($designation_arr as $key=>$val){
                                        $key++;
                                        echo "<input type='radio' name='Designation' value='$key'> $val<br>";    
                                    }
                                ?>
                                <!-- <input type="radio" name="Designation" value="1"> Learner Plumber<br>
                                <input type="radio" name="Designation" value="2"> Technical Operator Plumber<br>
                                <input type="radio" name="Designation" value="3"> Technical Assisting Practitioner<br>
                                <input type="radio" name="Designation" value="4"> Qualified Plumber -->
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Attachment <span id="dispMissingDataAttachment" style="display: none; color: red;"><b>Missing Data</b></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div id="divAttachment"  class="accr_cnt">
                                <p>
                                    If applicable attached all relevant documentation and or certificates for the respective designation being applied for. All qualification/doucmentation/certificates of any 
                                    individual applying for registration will be vetted and verified with the various authenticating bodies.
                                    <br />
                                </p>
                                <p>Please Attach ALL your qualification/documentation/certificates.</p>
                                <div class="boxs">
                                    <div class="form-group attach_field_3">
                                        <div class="file_fields">
                                            <input type="file" id="FileUploadCertificate" name="FileUploadCertificate" />
                                        </div>
                                    </div>
                                    <button id="btnFileUpload" class="btn btn-primary"  Text="Upload" OnClick="btnFileUpload_Click" formnovalidate />Upload</button>
                                </div>
                                                                <!-- <img id="imgSign"  style="height: 50px;" /> -->
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Image or File Size Smaller than 5mb)</p>
                                <div id="listOfAttachments" ></div>
                                <label id="lblErrAttachment" ></label>
                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>PIRB’s Code of Conduct <span id="dispMissingDatacoconduct" style="display: none; color: red;"><b>Missing Data</b></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt">
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

                                <label class="ideclare_label">
                                    <input type="CheckBox" id="chkPIRBCodeConduct"  name="chkPIRBCodeConduct"  />
                                    I declare that I have fully read and understood the PIRB’s Code of Conduct : <span>*</span>
                                </label>

                            </div>

                        </div>
                    </div>
                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Acknowledgement <span id="dispMissingDataAck" style="display: none; color: red;"><b>Missing Data</b></span>  <span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>

                            <div class="accr_cnt">
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

                                <label class="ideclare_label">
                                    <input type="CheckBox" id="chkAcknowledge" name="chkAcknowledge" />
                                    I declare that I have fully read and understood the Acknowledgement :<span>*</span>
                                </label>

                            </div>
                        </div>
                    </div>

                    <div class="top_box">
                        <div class="box_accordian">
                            <div class="tittle_box">
                                <h2>Declaration <span id="dispMissingDataDec"   style="display: none; color: red; width:20%"><b>Missing Data</b></span><span class="dd_arrow"><i class="fa fa-angle-down"></i></span></h2>
                            </div>
                            <div class="accr_cnt">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="col-md-1 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <label>I</label>
                                            </div>
                                            <div class="col-md-3 form-group" style="padding-left: 0 !important; margin-bottom: 0 !important;">
                                                <div class="user_edits">
                                                    <div class="controls">
                                                        <input type="textbox" id="DeclarationName" name="DeclarationName" class="form-control"    onkeypress="return AllowAlphabet(event)">
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
                                                       <input type="textbox" id="DeclarationIDNumber" name="DeclarationIDNumber" class="form-control"   onkeypress="return AllowAlphabetNumber(event)" >
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
                                                    <input type="CheckBox" id="chkDeclare" name="chkDeclare" />
                                                    &nbsp;&nbsp;&nbsp;Declare that the information contained in this application, or attracted by me to this application, is comaplete, accurate and true to the best of my knowledge. I further declarea that by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;forwarding this completed
                                                    application form to the PIRB I am acknowledging that i have read and fully understood what is registered and professional! plumber and that I adhere to all aims and &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;objectivies to the PIRB and
                                                    the PIRB's Plumber Code of Conduct. I give consent for enquires for verification purposes to be made into any information i have given on this application.<span>*</span>
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
                                    <!-- <label id="lblUploadFiles" Visible="false" ></label>
                                    <label id="lblPhotoIdentification" Visible="false" ></label>
                                    <label id="lblPersonalIDentity" Visible="false" ></label>
                                    <label id="lblSignaturePhoto" Visible="false" ></label>
                                    <button id="submitNewApplication"  Text="Submit" OnClientClick="javascript:IsValidated();" OnClick="submitNewApplication_Click" class="btn btn-primary" />
                                    <label id="lblSubmit" Visible="false" ></label> -->
                                    <?php echo form_submit(array('id' => 'submit', 'name' => 'save', 'value' => 'Submit')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
              
        </div>
        <!-- /boxed layout wrapper -->
    
	<?php echo form_close(); ?><br/>
    <!-- Core JS files -->
    <script src="<?php echo BASE_URL; ?>assets/js/main/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo BASE_URL; ?>assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

    <script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
    <!-- <script src="<?php echo BASE_URL; ?>assets/global_assets/js/demo_pages/dashboard_boxed.js"></script> -->
    <!-- /theme JS files -->   


    <!-- Theme JS files -->
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/plugins/notifications/jgrowl.min.js"></script>  

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

        
        

        $("input").change(function () {
            IsValidated();
        });

        //RadioButtonList1
        $('.anytime-month-numeric').AnyTime_picker({
            format: '%d/%m/%Z'
        });
        
        //$('.datepicker-range').datepicker({
        //});
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
                var accnt = $(this).parents('.box_accordian').find('.accr_cnt');
                if ($(accnt).css('display') == 'block') {
                    $(this).find('.fa').addClass('fa-angle-down');
                    $(this).find('.fa').removeClass('fa-angle-up');
                    $(accnt).slideUp(300);
                }
                if ($(accnt).css('display') == 'none') {
                    $('.accr_cnt').slideUp(300);
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
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
</body>
</html>
