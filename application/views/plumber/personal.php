<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="menu-links">
                <a href="">Welcome</a> > <a href="personal">Personal Details</a>
            </div>
            <div class="row">
                <?php
                    echo form_open_multipart('', array('data-toggle' => 'validator','id' => 'plumber-profile-update'));                    
                ?>
            </div>
            
                        
                            
                            <div id="divPersonalDetails"  class="card accr_cnt1">
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

                                    <div class="card">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group form-group-default">
                                                <label>Registration Card  :</label>
                                                <span>
                                                Due to the high number of card returns and cost incurred the registration fees do not include a registration card. Registration cards are available but must be requested separately.  If registration card is selected you will be billed accordingly.
                                                </span>
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
                                                    <!-- <select id="ddlPostalProvince"  class="city form-control" OnSelectedIndexChanged="ddlPostalProvince_SelectedIndexChanged" AutoPostBack="true" ReadOnly="true">
                                                    </select> -->
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
                                                    <!-- <select id="physicalCities"  class="form-control select2"
                                                        OnSelectedIndexChanged="physicalCities_SelectedIndexChanged" AutoPostBack="true" ReadOnly="true">
                                                        <option value=""></option>
                                                    </select> -->
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
                                                    <!-- <select id="postalCities"  class="form-control select2" ReadOnly="true">
                                                        <option value=""></option>
                                                    </select> -->
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
                                                    <!-- <select id="physicalSuburb" name="physicalSuburb"  class="form-control select2">
                                                    </select> -->
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
                        
            <div class="col-sm-3">
                <?php
                    echo $plumber_submit_application;
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>