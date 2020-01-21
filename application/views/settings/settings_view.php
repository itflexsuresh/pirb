
<?php
$attributes_installationType = array('class' => 'form-horizontal settings_submit', "data-toggle"=>"validator", 'id' => 'validation', 'method' => 'post');

?>
<style type="text/css">
  .showSweetAlert {
    display: none !important;
  }
  tbody.cpd_body td input[type=number]::-webkit-inner-spin-button, 
  tbody.cpd_body td input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
}
</style>
<div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      <?php
      if ($this->session->flashdata('updateMSG')!='') {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('updateMSG');
        echo '</div>';
      }
      ?>
      <!-- <h3 class="box-title m-b-0">Validation</h3>
        <p class="text-muted m-b-30 font-13"> This is the Validation wizard with validation.</p> -->
        <div id="exampleValidator" class="wizard">
          <ul class="wizard-steps" role="tablist">
            <li class="active" role="tab">
              <h4><span><i class="ti-user"></i></span>PIRB Company Details</h4>
            </li>
            <li role="tab">
              <h4><span><i class="ti-credit-card"></i></span>Banking Details</h4>
            </li>
            <li role="tab">
              <h4><span><i class="ti-check"></i></span>Global Settings</h4>
            </li>
            <li role="tab">
              <h4><span><i class="ti-check"></i></span>CPD Points</h4>
            </li>
          </ul>
          <!--           <form id="validation" class="form-horizontal"> -->
            <?php
            echo form_open_multipart('Settings/update', $attributes_installationType);
            ?>
            <div class="wizard-content">
              <div class="wizard-pane" role="tabpanel">
                <div class="form-group">
                  <label class="col-xs-3 control-label">Company Name</label>
                  <div class="col-xs-5">
                    <input name="CompanyName" type="text" id="ContentPlaceHolder1_CompanyName" class="form-control" value="<?php echo $records[0]->CompanyName; ?>" placeholder="Enter an Company Name" required>
                    <div class="with-errors"></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-xs-3 control-label">VAT Number</label>
                  <div class="col-xs-5">
                    <input name="VATNumber" type="text" id="ContentPlaceHolder1_VATNumber" class="form-control" value="<?php echo $records[0]->CompanyVatNumber; ?>" placeholder="Enter an VAT Number" required>
                    <div class="with-errors"></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-xs-3 control-label">Company Registration Number</label>
                  <div class="col-xs-5">
                    <input name="CompanyRegistrationNumber" type="text" id="ContentPlaceHolder1_CompanyRegistrationNumber" value="<?php echo $records[0]->CompanyRegistrationNumber; ?>" class="form-control" placeholder="Enter an Company Registration Number" required>
                    <div class="with-errors"></div>
                  </div>
                </div>

                <div class="form-group">                
                  <div class="col-md-6">
                    <label>Physical Address*</label>
                    <input name="PhysicalAddress" type="text" id="ContentPlaceHolder1_PhysicalAddress" value="<?php echo $records[0]->PhysicalAddress; ?>" class="form-control" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-md-6">
                    <label>Postal Address</label>
                    <input name="PhysicalAddress" type="text" id="ContentPlaceHolder1_PostalAddress" value="<?php echo $records[0]->PostalAddress; ?>" class="form-control" placeholder="Enter an Postal Address" required>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>

                <div class="form-group">                
                  <div class="col-md-6">
                    <label>Province</label>
                    <select class="form-control" name="province_down" id="province_down" required aria-required="true" tabindex="1">
                      <option value="">select</option>

                      <option value="1"<?php if($records[0]->Province==1){ echo 'selected="selected"'; } ?>>Gauten</option>
                      <option value="2"<?php if($records[0]->Province==2){ echo 'selected="selected"'; } ?>>Eastern Cape</option>
                      <option value="3"<?php if($records[0]->Province==3){ echo 'selected="selected"'; } ?>>Free State</option>
                      <option value="4"<?php if($records[0]->Province==4){ echo 'selected="selected"'; } ?>>KwaZulu-Natal</option>
                      <option value="5"<?php if($records[0]->Province==5){ echo 'selected="selected"'; } ?>>Limpopo</option>
                      <option value="6"<?php if($records[0]->Province==6){ echo 'selected="selected"'; } ?>>Mpumalanga</option>
                      <option value="7"<?php if($records[0]->Province==7){ echo 'selected="selected"'; } ?>>North West</option>
                      <option value="8"<?php if($records[0]->Province==8){ echo 'selected="selected"'; } ?>>Northen Cape</option>
                      <option value="9"<?php if($records[0]->Province==9){ echo 'selected="selected"'; } ?>>Wester Cape</option>

                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-md-6">
                    <label>Province</label>
                    <select class="form-control" name="postal_province_down" id="postal_province_down" required aria-required="true" tabindex="1">
                      <option value="">select</option>

                      <option value="1"<?php if($records[0]->PostalProvince==1){ echo 'selected="selected"'; } ?>>Gauten</option>
                      <option value="2"<?php if($records[0]->PostalProvince==2){ echo 'selected="selected"'; } ?>>Eastern Cape</option>
                      <option value="3"<?php if($records[0]->PostalProvince==3){ echo 'selected="selected"'; } ?>>Free State</option>
                      <option value="4"<?php if($records[0]->PostalProvince==4){ echo 'selected="selected"'; } ?>>KwaZulu-Natal</option>
                      <option value="5"<?php if($records[0]->PostalProvince==5){ echo 'selected="selected"'; } ?>>Limpopo</option>
                      <option value="6"<?php if($records[0]->PostalProvince==6){ echo 'selected="selected"'; } ?>>Mpumalanga</option>
                      <option value="7"<?php if($records[0]->PostalProvince==7){ echo 'selected="selected"'; } ?>>North West</option>
                      <option value="8"<?php if($records[0]->PostalProvince==8){ echo 'selected="selected"'; } ?>>Northen Cape</option>
                      <option value="9"<?php if($records[0]->PostalProvince==9){ echo 'selected="selected"'; } ?>>Wester Cape</option>

                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>

                <!---- CITY ----->
                <div class="form-group">                
                  <div class="col-md-6">
                   <label>City</label>
                   <?php
                   $provinceID = $records[0]->Province;
                   $physical_city_query = $this->db->get_where('area',array('ProvinceID' => $provinceID));
                   $physical_city_result = $physical_city_query->result();
                   ?>
                   <select class="form-control" name="city_down" id="city_down" required aria-required="true" tabindex="1">
                    <?php
                    foreach ($city_data as $key => $value)
                    {        
                     if($value->ID==$records[0]->City){
                       $sel = 'selected="true"';
                     } else {
                       $sel = '';
                     }
                     echo '<option '.$sel.' value="'.$value->ID.'">'.$value->Name.'</option>';
                   } ?>
                 </select>
                 <div class="help-block with-errors"></div>
               </div>

               <div class="col-md-6">
                <label>City</label>
                <?php
                $postal_provinceID = $records[0]->PostalProvince;
                $postal_city_query = $this->db->get_where('area',array('ProvinceID' => $postal_provinceID));
                $postal_city_result = $postal_city_query->result();
                ?>
                <select class="form-control" name="postal_city_down" id="postal_city_down" required aria-required="true" tabindex="1">
                  <?php
                  foreach ($postal_city_data as $key2 => $value2)
                  {        
                   if($value2->ID==$records[0]->PostalCity){
                     $sel2 = 'selected="true"';
                   } else {
                     $sel2 = '';
                   }
                   echo '<option '.$sel2.' value="'.$value2->ID.'">'.$value2->Name.'</option>';
                 } ?>
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div>  

           <!---- SUBURB ----->
           <div class="form-group">                
            <div class="col-md-6">
              <label>Suburb</label>
              <?php
              $cityID = $records[0]->City;
              $physical_suburb_query = $this->db->get_where('areasuburbs',array('CityID' => $cityID));
              $physical_suburb_result = $physical_suburb_query->result();
              ?>
              <select class="form-control" name="suburb_down" id="suburb_down" required aria-required="true" tabindex="1">
                <?php
                foreach ($suburb_data as $key1 => $value1)
                {        
                 if($value1->SuburbID==$records[0]->Suburb){
                   $sel1 = 'selected="true"';
                 } else {
                   $sel1 = '';
                 }
                 echo '<option '.$sel1.' value="'.$value1->SuburbID.'">'.$value1->Name.'</option>';
               } ?>

             </select>
             <div class="help-block with-errors"></div>
           </div>

           <div class="col-md-6">
            <label>Suburb</label>
            <?php
            $postal_cityID = $records[0]->PostalCity;
            $postal_suburb_query = $this->db->get_where('areasuburbs',array('CityID' => $postal_cityID));
            $postal_suburb_result = $postal_suburb_query->result();
            ?>
            <select class="form-control" name="postal_suburb_down" id="postal_suburb_down" required aria-required="true" tabindex="1">
              <?php
              foreach ($postal_suburb_data as $key3 => $value3)
              {        
               if($value3->SuburbID==$records[0]->PostalSuburb){
                 $sel3 = 'selected="true"';
               } else {
                 $sel3 = '';
               }
               echo '<option '.$sel3.' value="'.$value3->SuburbID.'">'.$value3->Name.'</option>';
             } ?>
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div>  
       <div class="form-group">                
        <div class="col-xs-5">
         <!-- <div class="col-md-6"> -->
          <label class="col-xs-3 control-label">Postal Code</label>
          <input name="postalcode" type="number" id="ContentPlaceHolder1_postalcode" value="<?php echo $records[0]->PostalCode; ?>" placeholder="Enter an Postal Code" class="form-control" required>
          <div class="with-errors"></div>
        </div>
        
      </div>
      <div class="form-group"> 
        <div class="col-xs-5">

         <!-- <div class="col-md-6"> -->
          <label>Work Phone</label>
          <input name="workphone" type="number" id="ContentPlaceHolder1_workphone" value="<?php echo $records[0]->CompanyTelephoneNumber; ?>" placeholder="Enter an Work Phone" data-error="Minimum 10 digits" class="form-control" data-toggle="validator" data-minlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" required>
          <div class="with-errors"></div>
        </div>
      </div>
      <div class="form-group"> 
        <div class="col-xs-5">

         <!-- <div class="col-md-6"> -->
          <label>Email</label>
          <input name="amailaddress" type="email" id="ContentPlaceHolder1_amailaddress" value="<?php echo $records[0]->CompEmailAddress; ?>" placeholder="Enter an Email Address" class="form-control" required>
         <div class="with-errors"></div>
        </div>
      </div>



    </div>
    <!------ Banking details ----------->

    <div class="wizard-pane" role="tabpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
            <!-- <div class="panel-heading"> With two column</div> -->
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">

                <div class="form-body">
                  <h3 class="box-title">Banking Details</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Bank Name</label>
                        <input name="bankname" type="text" id="ContentPlaceHolder1_bankname" value="<?php echo $records[0]->BankName; ?>" class="form-control" laceholder="Enter an Bank Name" required>
                        <div class="with-errors"></div> </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group col-sm-12">
                          <label class="control-label">Account Name</label>
                          <input name="accname" type="text" id="ContentPlaceHolder1_accname" value="<?php echo $records[0]->AccountName; ?>" class="form-control" placeholder="Enter an Account Name" required>
                          <div class="with-errors"></div> </div>
                        </div>
                        <!--/span-->
                      </div>
                      <!--/row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group col-sm-12">
                            <label class="control-label">Branch Code</label>
                            <input name="branchcode" type="text" id="ContentPlaceHolder1_branchcode" value="<?php echo $records[0]->BranchCode; ?>" class="form-control" placeholder="Enter an Branch Code" required>
                            <div class="with-errors"></div> </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-6">
                            <div class="form-group col-sm-12">
                              <label class="control-label">Account Number</label>
                              <input name="AccountNumber" type="number" id="ContentPlaceHolder1_AccountNumber" value="<?php echo $records[0]->AccountNumber; ?>" class="form-control" placeholder="Enter an Account Number" required>
                              <div class="with-errors"></div> </div>
                            </div>
                            <!--/span-->
                          </div>
                          <!--/row-->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group col-sm-12">
                                <label class="control-label">Account Type</label>
                                <input name="AccountType" type="text" id="ContentPlaceHolder1_AccountType" value="<?php echo $records[0]->AccountType; ?>" class="form-control" placeholder="Enter an Account Type" required>
                                <div class="with-errors"></div> </div>
                              </div>                  
                              <!--/span-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!----------- Global Settings  -------------->
              <div class="wizard-pane" role="tabpanel">
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-info">
                      <!-- <div class="panel-heading"> With two column</div> -->
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">

                          <div class="form-body">
                            <h3 class="box-title">Global Settings</h3>
                            <hr>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Vat Percentage*</label>
                                  <input name="VatPercentage" type="number" id="ContentPlaceHolder1_VatPercentage" value="<?php echo $records[0]->VatPercentage; ?>" class="form-control" placeholder="Enter an Vat Percentage" min="1" required>
                                  <div class="with-errors"></div> </div>
                                </div>
                                <!--/span-->
                              </div>
                              <!--/row-->
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="inputEmail" class="control-label">Email</label>
                                    <input name="systyememail" type="email" class="form-control" id="ContentPlaceHolder1_systyememail" value="<?php echo $records[0]->SystemEmailAddress; ?>" placeholder="Enter an System Email Address" data-error="that email address is invalid" required>
                                    <div class="with-errors"></div>
                                  </div>
                                </div>
                                <!--/span-->
                              </div>
                              <!--/row-->
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Default Plumber Max Non - Logged Certificates</label>
                                    <input name="deafultplumbermax" type="number" id="ContentPlaceHolder1_deafultplumbermaxl" value="<?php echo $records[0]->PlumberMaxNonLoggedCertificates; ?>" class="form-control" placeholder="Enter an Default Plumber Max Non - Logged Certificates" min="1" required>
                                    <div class="with-errors"></div> </div>
                                  </div>
                                  <!--/span-->
                                </div>
                                <!--/row-->

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Default  Resellers Max Non - Logged Certificates</label>
                                      <input name="deafultcompanymax" type="number" id="ContentPlaceHolder1_deafultresellermax" value="<?php echo $records[0]->CompanyMaxNonLoggedCertificates; ?>" class="form-control" placeholder="Enter an Default Company's Max Non - Logged Certificates" min="1" required>
                                      <div class="with-errors"></div> </div>
                                    </div>
                                    <!--/span-->
                                  </div>
                                  <!--/row-->
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Default Company's Max Non - Logged Certificates</label>
                                        <input name="deafultcompanymax" type="number" id="ContentPlaceHolder1_deafultcompanymax" value="<?php echo $records[0]->CompanyMaxNonLoggedCertificates; ?>" class="form-control" placeholder="Enter an Default Company's Max Non - Logged Certificates" min="1" required>
                                        <div class="with-errors"></div> </div>
                                      </div>
                                      <!--/span-->
                                    </div>
                                    
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">Defult Refix Period in days*</label>
                                          <input name="deafultrefixperiod" type="number" id="ContentPlaceHolder1_deafultrefixperiod" value="<?php echo $records[0]->RefixPeriod; ?>" class="form-control" placeholder="Enter an Defult Refix Period in days" min="1" required>
                                          <div class="with-errors"></div> </div>
                                        </div>
                                        <!--/span-->
                                      </div>
                                      <!--/row-->
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="control-label">Audit Ratio (as a Percentage)*</label>
                                            <input name="AuditRatio" type="number" id="ContentPlaceHolder1_AuditRatio" value="<?php echo $records[0]->AuditPercentage; ?>" class="form-control" placeholder="Enter an Audit Ratio (as a Percentage)" min="1" required>
                                            <div class="with-errors"></div> </div>
                                          </div>
                                          <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>Days allowed after regsitration date has
                                                Days allowed after regsitration before making
                                              passed (Late Payment Days)</label>
                                              <input name="daysallowed" type="number" id="ContentPlaceHolder1_daysallowed" value="<?php echo $records[0]->latepayment; ?>" class="form-control" placeholder="Enter an Days allowed after regsitration" min="1" required>
                                              <div class="with-errors"></div> </div>
                                            </div>
                                            <!--/span-->
                                          </div>
                                          <!--/row-->
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label class="control-label">Plumber expired</label>
                                                <input name="plumberexpired" type="number" id="ContentPlaceHolder1_plumberexpired" value="<?php echo $records[0]->plumberexpirelimit; ?>" class="form-control" placeholder="Enter an Plumber expired" min="1" required>
                                                <div class="with-errors"></div> </div>
                                              </div>
                                              <!--/span-->
                                            </div>
                                            <!--/row-->
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!----------  CPD POINTS TABLE  ------------>

                              <div class="wizard-pane" role="tabpanel">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="panel panel-info">
                                      <!-- <div class="panel-heading"> With two column</div> -->
                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">

                                          <div class="form-body">
                                            <table id="mainTable" class="table editable-table table-bordered table-striped m-b-0">
                                              <?php 
                                              $query = $this->db->get('plumberdesignationpoints');
                                              $record  = $query->result();
    // print_r('<pre>');
    // print_r($record);
    // print_r('</pre>');
                                              ?>
                                              <thead>
                                                <tr>
                                                  <th>CPD Stream</th>
                                                  <th><?php echo $record[0]->Designation; ?></th>
                                                  <th><?php echo $record[1]->Designation; ?></th>
                                                  <th><?php echo $record[2]->Designation; ?></th>
                                                  <th><?php echo $record[3]->Designation; ?></th>
                                                  <th><?php echo $record[4]->Designation; ?></th>
                                                  <th><?php echo $record[5]->Designation; ?></th>
                                                </tr>
                                              </thead>
                                              <tbody class="cpd_body">
                                                <tr>
                                                  <td>Developmental</td>
                                                  <td><input id="developmental1" type="number" class="col-sm-5" name="developmental1" required="required" value="<?php echo $record[0]->Developmental; ?>"></td>
                                                  <td><input  id="developmental2" type="number" class="col-sm-5" name="developmental2" required="required" value="<?php echo $record[1]->Developmental; ?>"></td>
                                                  <td><input  id="developmental3" type="number" class="col-sm-5" name="developmental3" required="required" value="<?php echo $record[2]->Developmental; ?>"></td>
                                                  <td><input  id="developmental4" type="number" class="col-sm-5" name="developmental4" required="required" value="<?php echo $record[3]->Developmental; ?>"></td>
                                                  <td><input  id="developmental5" type="number" class="col-sm-5" name="developmental5" required="required" value="<?php echo $record[4]->Developmental; ?>"></td>
                                                  <td><input  id="developmental6" type="number" class="col-sm-5" name="developmental6" required="required" value="<?php echo $record[5]->Developmental; ?>"></td>
                                                </tr>
                                                <tr>
                                                  <td>WorkBased</td>
                                                  <td><input id="workbased1" type="number" class="col-sm-5" name="workbased1" required="required" value="<?php echo $record[0]->WorkBased; ?>"></td>
                                                  <td><input id="workbased2" type="number" class="col-sm-5" name="workbased2" required="required" value="<?php echo $record[1]->WorkBased; ?>"></td>
                                                  <td><input id="workbased3" type="number" class="col-sm-5" name="workbased3" required="required"  value="<?php echo $record[2]->WorkBased; ?>"></td>
                                                  <td><input id="workbased4" type="number" class="col-sm-5" name="workbased4" required="required" value="<?php echo $record[3]->WorkBased; ?>"></td>
                                                  <td><input id="workbased5" type="number" class="col-sm-5" name="workbased5" required="required" value="<?php echo $record[4]->WorkBased; ?>"></td>
                                                  <td><input id="workbased6" type="number" class="col-sm-5" name="workbased6" required="required" value="<?php echo $record[5]->WorkBased; ?>"></td>
                                                </tr>
                                                <tr>
                                                  <td>Individual</td>
                                                  <td><input id="individual1" name="individual1" class="col-sm-5" type="number" required="required" value="<?php echo $record[0]->Individual; ?>"></td>
                                                  <td><input id="individual2" name="individual2" class="col-sm-5" type="number" required="required" value="<?php echo $record[1]->Individual; ?>"></td>
                                                  <td><input id="individual3" name="individual3" class="col-sm-5" type="number" required="required" value="<?php echo $record[2]->Individual; ?>"></td>
                                                  <td><input id="individual4" name="individual4" class="col-sm-5" type="number" required="required" value="<?php echo $record[3]->Individual; ?>"></td>
                                                  <td><input id="individual5" name="individual5" class="col-sm-5" type="number" required="required" value="<?php echo $record[4]->Individual; ?>"></td>
                                                  <td><input id="individual6" name="individual6" class="col-sm-5" type="number" required="required" value="<?php echo $record[5]->Individual; ?>"></td>
                                                </tr>
                                                <tr>
                                                  <td>Total</td>
                                                  <td><input id="direct-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
                                                  <td><input id="master-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
                                                  <td><input id="license-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
                                                  <td><input id="techinical-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
                                                  <td><input id="assisting-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>
                                                  <td><input id="learner-plumber" class="col-sm-5" type="text" name="" readonly="readonly"></td>      
                                                </tr>

                                              </tbody>

                                            </table>
                                          </div>
                                        </div>
                                      </div>

                                      <!--/row-->
                                    </div>
                                  </div>
                                </div>
                              </div>



<!-- 
                        <div class="wizard-pane" role="tabpanel">
                            
                        </div>

                        <div class="wizard-pane" role="tabpanel">
                           
                        </div>

                        <div class="wizard-pane" role="tabpanel">
                            
                        </div> -->
                        
                      </div>
                      <!-- <input type="submit" class="submit" name="submit" formaction="http://diyesh.com/auditit_new/auditit/Settings/update"> -->
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
          // echo form_open();
          // echo '<input type="submit" class="test_submit">';
          // echo form_close();
          ?>


          <script type="text/javascript">
            $(document).ready( function () {
              $('.alert, .alert-success').delay('3000').fadeOut(300);
  /////Physical city fetch//////////////////////
  $('#province_down').on('change', function(){
    var provinceID = $(this).val();
    if(provinceID!=''){
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>settings/fetch_city',
        data:'ajaxprovince_id='+provinceID,
        success:function(html){
          $('#city_down').html(html);
          $('#city_down').html(); 
        }
      }); 
    }else{

      $('#city_down').html('<option value="">Select province first</option>');
      $('#suburb_down').html('<option value="">Select City</option>');
    }
  });

     //// physical suburb fetch///////////////////////////

     $('#city_down').on('change', function(){
      var cityid = $(this).val();
      if(cityid!=''){
        $.ajax({
          type:'POST',
          url:'<?php echo base_url(); ?>settings/fetch_suburb',
          data:'ajaxcity_id='+cityid,
          success:function(html){
            $('#suburb_down').html(html);
            $('#suburb_down').html(); 
          }
        }); 
      }else{

        $('#suburb_down').html('<option value="">Select City</option>');
      }
    });

            /////postal city fetch//////////////////////
            $('#postal_province_down').on('change', function(){
              var psotal_provinceID = $(this).val();
              if(psotal_provinceID!=''){
                $.ajax({
                  type:'POST',
                  url:'<?php echo base_url(); ?>settings/psotal_fetch_city',
                  data:'ajaxpostal_province_id='+psotal_provinceID,
                  success:function(html){
                    $('#postal_city_down').html(html);
                    $('#postal_city_down').html(); 
                  }
                }); 
              }else{

                $('#postal_city_down').html('<option>Select province first</option>'); 
                $('#postal_suburb_down').html('<option value="">Select City</option>');
              }
            });
          //// psotal suburb fetch///////////////////////////

          $('#postal_city_down').on('change', function(){
            var postal_cityid = $(this).val();
            if(postal_cityid!=''){
              $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>settings/postal_fetch_suburb',
                data:'ajaxpostal_city_id='+postal_cityid,
                success:function(html){
                  $('#postal_suburb_down').html(html);
                  $('#postal_suburb_down').html(); 
                }
              }); 
            }else{

              $('#postal_suburb_down').html('<option>Select city</option>'); 
            }
          });
          function testInput(event) {
           var value = String.fromCharCode(event.which);
           var pattern = new RegExp(/[a-zåäö ]/i);
           return pattern.test(value);
         }

         $('#ContentPlaceHolder1_accname').bind('keypress', testInput);
         $('#ContentPlaceHolder1_branchcode').bind('keypress', testInput);
         $('#ContentPlaceHolder1_AccountType').bind('keypress', testInput);
         $('.installation_sucess-msg, .green').delay('3000').fadeOut(300);

         ////////////////////////////////////
         var directvv1 = $('#developmental1').val();
         var directvv2 = $('#workbased1').val();
         var directvv3 = $('#individual1').val();
         $('#direct-plumber').val(parseInt(directvv1)+parseInt(directvv2)+parseInt(directvv3));

         $('#developmental1').on('keyup',function(){
           var directv1 = $(this).val();
           var directv2 = $('#workbased1').val();
           var directv3 = $('#individual1').val();


           $('#direct-plumber').val(parseInt(directv1)+parseInt(directv2)+parseInt(directv3));
         });
         $('#workbased1').on('keyup',function(){
           var directv4 = $(this).val();
           var directv5 = $('#developmental1').val();
           var directv6 = $('#individual1').val();

           $('#direct-plumber').val(parseInt(directv4)+parseInt(directv5)+parseInt(directv6));
         });
         $('#individual1').on('keyup',function(){
           var directv7 = $(this).val();
           var directv8 = $('#developmental1').val();
           var directv9 = $('#workbased1').val();

           $('#direct-plumber').val(parseInt(directv7)+parseInt(directv8)+parseInt(directv9));
         });

         //////////////////////////////////// master plumber
         var mastvv1 = $('#developmental2').val();
         var mastvv2 = $('#workbased2').val();
         var mastvv3 = $('#individual2').val();
         $('#master-plumber').val(parseInt(mastvv1)+parseInt(mastvv2)+parseInt(mastvv3));

         $('#developmental2').on('keyup',function(){
           var mastv1 = $(this).val();
           var mastv2 = $('#workbased2').val();
           var mastv3 = $('#individual2').val();

           
           $('#master-plumber').val(parseInt(mastv1)+parseInt(mastv2)+parseInt(mastv3));
         });
         $('#workbased2').on('keyup',function(){
           var mastv4 = $(this).val();
           var mastv5 = $('#developmental2').val();
           var mastv6 = $('#individual2').val();

           $('#master-plumber').val(parseInt(mastv4)+parseInt(mastv5)+parseInt(mastv6));
         });
         $('#individual2').on('keyup',function(){
           var mastv7 = $(this).val();
           var mastv8 = $('#developmental2').val();
           var mastv9 = $('#workbased2').val();

           $('#master-plumber').val(parseInt(mastv7)+parseInt(mastv8)+parseInt(mastv9));
         });
         //////////////////////////////////// Licensed plumber
         var licensevv1 = $('#developmental3').val();
         var licensevv2 = $('#workbased3').val();
         var licensevv3 = $('#individual3').val();
         $('#license-plumber').val(parseInt(licensevv1)+parseInt(licensevv2)+parseInt(licensevv3));

         $('#developmental3').on('keyup',function(){
           var licensev1 = $(this).val();
           var licensev2 = $('#workbased3').val();
           var licensev3 = $('#individual3').val();

           
           $('#license-plumber').val(parseInt(licensev1)+parseInt(licensev2)+parseInt(licensev3));
         });
         $('#workbased3').on('keyup',function(){
           var licensev4 = $(this).val();
           var licensev5 = $('#developmental3').val();
           var licensev6 = $('#individual3').val();

           $('#license-plumber').val(parseInt(licensev4)+parseInt(licensev5)+parseInt(licensev6));
         });
         $('#individual3').on('keyup',function(){
           var licensev7 = $(this).val();
           var licensev8 = $('#developmental3').val();
           var licensev9 = $('#workbased3').val();

           $('#license-plumber').val(parseInt(licensev7)+parseInt(licensev8)+parseInt(licensev9));
         });
         //////////////////////////////////// Technical operator plumber
         var techinicalvv1 = $('#developmental4').val();
         var techinicalvv2 = $('#workbased4').val();
         var techinicalvv3 = $('#individual4').val();
         $('#techinical-plumber').val(parseInt(techinicalvv1)+parseInt(techinicalvv2)+parseInt(techinicalvv3));

         $('#developmental4').on('keyup',function(){
           var techinicalvv3v1 = $(this).val();
           var techinicalvv3v2 = $('#workbased4').val();
           var techinicalvv3v3 = $('#individual4').val();

           
           $('#techinical-plumber').val(parseInt(techinicalvv3v1)+parseInt(techinicalvv3v1)+parseInt(techinicalvv3v1));
         });
         $('#workbased4').on('keyup',function(){
           var techinicalv4 = $(this).val();
           var techinicalv5 = $('#developmental4').val();
           var techinicalv6 = $('#individual4').val();

           $('#techinical-plumber').val(parseInt(techinicalv4)+parseInt(techinicalv5)+parseInt(techinicalv6));
         });
         $('#individual4').on('keyup',function(){
           var techinicalv7 = $(this).val();
           var techinicalv8 = $('#developmental4').val();
           var techinicalv9 = $('#workbased4').val();

           $('#techinical-plumber').val(parseInt(techinicalv7)+parseInt(techinicalv8)+parseInt(techinicalv9));
         });

         ///// technical Assissting
         
         var techinicalassvv1 = $('#developmental5').val();
         var techinicalassvv2 = $('#workbased5').val();
         var techinicalassvv3 = $('#individual5').val();
         $('#assisting-plumber').val(parseInt(techinicalassvv1)+parseInt(techinicalassvv2)+parseInt(techinicalassvv3));

         $('#developmental5').on('keyup',function(){
           var techinicalassv1 = $(this).val();
           var techinicalassv2 = $('#workbased5').val();
           var techinicalassv3 = $('#individual5').val();

           
           $('#assisting-plumber').val(parseInt(techinicalassv1)+parseInt(techinicalassv2)+parseInt(techinicalassv3));
         });
         $('#workbased5').on('keyup',function(){
           var techinicalassv4 = $(this).val();
           var techinicalassv5 = $('#developmental5').val();
           var techinicalassv6 = $('#individual5').val();

           $('#assisting-plumber').val(parseInt(techinicalassv6)+parseInt(techinicalassv6)+parseInt(techinicalassv6));
         });
         $('#individual5').on('keyup',function(){
           var techinicalassv7 = $(this).val();
           var techinicalassv8 = $('#developmental5').val();
           var techinicalassv9 = $('#workbased5').val();

           $('#assisting-plumber').val(parseInt(techinicalassv7)+parseInt(techinicalassv8)+parseInt(techinicalassv9));
         });

         ///// Learner plumber
         
         var learnvv1 = $('#developmental6').val();
         var learnvv2 = $('#workbased6').val();
         var learnvv3 = $('#individual6').val();
         $('#learner-plumber').val(parseInt(learnvv1)+parseInt(learnvv2)+parseInt(learnvv3));

         $('#developmental6').on('keyup',function(){
           var learnv1 = $(this).val();
           var learnv2 = $('#workbased6').val();
           var learnv3 = $('#individual6').val();

           
           $('#learner-plumber').val(parseInt(learnv1)+parseInt(learnv2)+parseInt(learnv3));
         });
         $('#workbased6').on('keyup',function(){
           var learnv4 = $(this).val();
           var learnv5 = $('#developmental6').val();
           var learnv6 = $('#individual6').val();

           $('#learner-plumber').val(parseInt(learnv4)+parseInt(learnv5)+parseInt(learnv6));
         });
         $('#individual6').on('keyup',function(){
           var learnv7 = $(this).val();
           var learnv8 = $('#developmental6').val();
           var learnv9 = $('#workbased6').val();

           $('#learner-plumber').val(parseInt(learnv7)+parseInt(learnv8)+parseInt(learnv9));
         });
         $('.wizard-finish').click(function(){
          //// COMPANY DETAILS
          var comp_compName = $('#ContentPlaceHolder1_CompanyName').val();
          var comp_VAT = $('#ContentPlaceHolder1_VATNumber').val();
          var comp_RegNum = $('#ContentPlaceHolder1_CompanyRegistrationNumber').val();
          var comp_postcode = $('#ContentPlaceHolder1_postalcode').val();
          var comp_pone = $('#ContentPlaceHolder1_workphone').val();
          var comp_Email = $('#ContentPlaceHolder1_amailaddress').val();
          // PHYSICAL
          var phy_Addrs = $('#ContentPlaceHolder1_PhysicalAddress').val();
          var phy_province = $('#province_down').val();
          var phy_city = $('#city_down').val();
          var phy_suburb = $('#suburb_down').val();
          //// POSTAL
          var post_Addrs = $('#ContentPlaceHolder1_PostalAddress').val();
          var post_province = $('#postal_province_down').val();
          var post_city = $('#postal_city_down').val();
          var post_suburb = $('#postal_suburb_down').val();
          ////////////////////////////

          /// BANK DETAILS
          var bnk_Bname = $('#ContentPlaceHolder1_bankname').val();
          var bnk_AcName = $('#ContentPlaceHolder1_accname').val();
          var bnk_Bcode = $('#ContentPlaceHolder1_branchcode').val();
          var bnk_AcNo = $('#ContentPlaceHolder1_AccountNumber').val();
          var bnk_AcType = $('#ContentPlaceHolder1_AccountType').val();
          ////////////////////////////////////

          /// Global Settings
          var Glb_percentage = $('#ContentPlaceHolder1_VatPercentage').val();
          var Glb_SysEmail = $('#ContentPlaceHolder1_systyememail').val();
          var Glb_plumbermax = $('#ContentPlaceHolder1_deafultplumbermaxl').val();
          var Glb_Reseller_max = $('#ContentPlaceHolder1_deafultresellermax').val();
          var Glb_Company_max = $('#ContentPlaceHolder1_deafultcompanymax').val();
          var Glb_REfix = $('#ContentPlaceHolder1_deafultrefixperiod').val();
          var Glb_AuditRatio = $('#ContentPlaceHolder1_AuditRatio').val();
          var Glb_DayAllowed = $('#ContentPlaceHolder1_daysallowed').val();
          var Glb_plumberExpired = $('#ContentPlaceHolder1_plumberexpired').val();
          /////////////////////////////////////

          /// CPD POINTS
          //// DEVELOPMENT
          var dev_Direct = $('#developmental1').val();
          var dev_Master = $('#developmental2').val();
          var dev_License = $('#developmental3').val();
          var dev_TechOp = $('#developmental4').val();
          var dev_TechAss = $('#developmental5').val();
          var dev_Learner = $('#developmental6').val();
          var Glb_DayAllowed = $('#ContentPlaceHolder1_daysallowed').val();

          //// WOKBASE
          var work_Direct = $('#workbased1').val();
          var work_Master = $('#workbased2').val();
          var work_License = $('#workbased3').val();
          var work_TechOp = $('#workbased4').val();
          var work_TechAss = $('#workbased5').val();
          var work_Learner = $('#workbased6').val();

          //// INDIVIDUALS
          var indi_Direct = $('#individual1').val();
          var indi_Master = $('#individual2').val();
          var indi_License = $('#individual3').val();
          var indi_TechOp = $('#individual4').val();
          var indi_TechAss = $('#individual5').val();
          var indi_Learner = $('#individual6').val();


          $('.sweet-alert, .showSweetAlert, visible').hide();
          
          $.ajax({
           type: "POST",
           url: "<?=base_url()?>settings/update",
           //data: comp_compName,comp_VAT,comp_RegNum,
           //data: {comp_compName: comp_compName, comp_VAT: comp_VAT},
           data: {comp_compName: comp_compName, comp_VAT: comp_VAT, comp_RegNum: comp_RegNum, phy_Addrs: phy_Addrs, comp_postcode: comp_postcode, comp_pone: comp_pone, comp_Email: comp_Email, phy_province: phy_province, phy_city: phy_city, phy_suburb: phy_suburb, post_Addrs: post_Addrs, post_province: post_province, post_city: post_city, post_suburb: post_suburb, bnk_Bname: bnk_Bname, bnk_AcName: bnk_AcName, bnk_Bcode: bnk_Bcode, bnk_AcNo: bnk_AcNo, bnk_AcType: bnk_AcType, Glb_percentage: Glb_percentage, Glb_SysEmail: Glb_SysEmail, Glb_plumbermax: Glb_plumbermax, Glb_Reseller_max: Glb_Reseller_max, Glb_Company_max: Glb_Company_max, Glb_REfix: Glb_REfix, Glb_AuditRatio: Glb_AuditRatio, Glb_DayAllowed: Glb_DayAllowed, Glb_plumberExpired: Glb_plumberExpired, dev_Direct: dev_Direct, dev_Master: dev_Master, dev_License: dev_License, dev_TechOp: dev_TechOp, dev_TechAss: dev_TechAss, dev_Learner: dev_Learner, Glb_DayAllowed: Glb_DayAllowed, work_Direct: work_Direct, work_Master: work_Master, work_License: work_License, work_TechOp: work_TechOp, work_TechAss: work_TechAss, work_Learner: work_Learner, indi_Direct: indi_Direct, indi_Master: indi_Master, indi_License: indi_License, indi_TechOp: indi_TechOp, indi_TechAss: indi_TechAss, indi_Learner: indi_Learner},
           // return false;  //stop the actual form post !important!

           success: function(html)
           {
            if (html=='Sucess') {
              window.location.href = "<?=base_url()?>settings/view?id=2";
            }

          }

        });
        });

} );
</script>