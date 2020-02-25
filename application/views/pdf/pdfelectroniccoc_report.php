<?php
require_once APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

echo '<pre>'; print_r($userdata);
echo '<pre>'; print_r($specialisations);
echo '<pre>'; print_r($result);

$cocid 					= isset($result['id']) ? $result['id'] : '';	
$completiondate 		= isset($result['cl_completion_date']) && $result['cl_completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_completion_date'])) : '';
$cl_order_no 					= isset($result['cl_order_no']) ? $result['cl_order_no'] : '';
$name 					= isset($result['cl_name']) ? $result['cl_name'] : '';
$address 				= isset($result['cl_address']) ? $result['cl_address'] : '';
$street 				= isset($result['cl_street']) ? $result['cl_street'] : '';
$number 				= isset($result['cl_number']) ? $result['cl_number'] : '';
$province 				= isset($result['cl_province_name']) ? $result['cl_province_name'] : '';
$city 					= isset($result['cl_city_name']) ? $result['cl_city_name'] : '';
$suburb 				= isset($result['cl_suburb_name']) ? $result['cl_suburb_name'] : '';

$cl_contact_no 				= isset($result['cl_contact_no']) ? $result['cl_contact_no'] : '';



$html='
<!DOCTYPE html> 
<html>
  <head>
    <title>Electronic COC PDF</title>
  </head>    
            
  <body style="-webkit-print-color-adjust: exact; margin:0;  font-family: arial; width:100%; ">

      <div id="wrapper">
          <div class="certificate-block">
              <div class="container" style="width:1300px; margin:0 auto; padding:16px 25px 25px 25px; border: 4px solid #00aeef; border-radius: 50px;">
                  <div class="uper-block">
                      <h2 align="center" style="padding-bottom:10px; margin:0;"><img  src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/text-img.png"  style="width:96%; margin:0 auto;"></h2>
                      <div class="logo-block" style="width:48%; float: left; ">
                          <img style="margin-top: 50px; width: 100%; height: auto;" width: 70%; height: auto; src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/logo-img.png" />
                      </div>
                      <div class="rt-side" style="float: right;width: 50%;padding: 20px 0 0 15px;margin-top: 50px; box-sizing: border-box;">
                          <div class="box" style="height: 40px; padding:7px 4px 3px 6px; margin: 0 0 4px; background: #d1d3d4;">
                              <h4 style="font-size: 23px;font-weight: 400;color: #000;padding:10px;float: left; margin:0;">Certificate N:</h4><span style="background: #fff;padding:12px 0;width: 70%;display: inline-block;height: 14px;float: right;">'.$cocid.'</span>
                              <div style="clear:both;"></div>
                          </div>
                          <div class="box" style="text-align: center;padding:10px;margin: 0 0 4px;background: #f3cfc1;;">
                              <p style="font-size:14px;line-height:19px;font-weight: 500;color: #000;padding: 0;margin:0;">ONLY PIRB REGISTERED LICENSED PLUMBERS ARE AUTHORISED TO ISSUE THIS PLUMBING CERTIFICATE OF COMPLIANCE</p>
                          </div>
                          <div class="box" style="background: #d2232a;font-size: 14px;color: #fff;text-align: center;padding:12px;">
                              <p style="font-size: 14px;font-weight: 500;padding:0; margin: 0;">TO VERIFY AND AUTHENTICATE THIS CERTIFICATE OF COMPLIANCE VISIT PIRB.CO.ZA AND CLICK ON VERIFY/AUTHENTICATE LINK</p>
                          </div>
                      </div>
                      <div style="clear:both;"></div>
                  </div>
                  <div class="down-block" style="padding-bottom: 4px; margin-top: 70px;">
                      <div class="lt-side" style="float: left; width:50%;">
                          <labeel style="font-size: 18px; line-height: 22px; font-weight: 400; color: #000; padding: 0; margin: 0px 30px; float: left;">Plumbing Work <br>Completion Date:</labeel> <span style="width:60%;height: 40px;border: 1px solid #bbbcbe;display: inline-block;padding: 0;margin: 0;float: right;">'.$completiondate.'</span>
                      </div>
                      <div class="rt-side" style="float: right; width:47%; clear: both;">
                          <label style="font-size: 18px;line-height: 23px;font-weight: 400;color: #000;padding: 0;margin:11px 0 0;float: left;">INSURANCE CLAIM/ORDER NO. (If relevant)</label><span style="width: 40%;height: 25px;border: 1px solid #bbbcbe;display: inline-block;padding: 0;margin:11px 0 0;float: right;">'.$cl_order_no.'</span>
                      </div>
                      <div style="clear:both;"></div>
                  </div>
                  <div style="clear:both;"></div>
                  <div class="address-block" style="border: 1px solid #aab294; margin:12px">
                      <h2 style="text-align: center;background: #c9db82;padding: 10;border-bottom: 1px solid #aab294;font-size: 18px;line-height: 18px;color: #000; margin:10px;">Physical Address Details of Installation:</h2>
                      <div class="block" style=" border-bottom: 1px solid #aab294; width:40%; float:left">
                          <h5 style="font-size:20px; line-height:17px; font-weight: 300; color: #000; padding: 8px 7px; margin:0;">Owners name: '.$name.'</h5>
                      </div>
                      <div class="block" style=" border-bottom: 1px solid #aab294; width:60%; box-sizing:border-box; float:right; border-left:1px #424242 solid;">
                          <h5 style="font-size:20px; line-height: 17px; font-weight: 300; color: #000; padding: 8px 7px; margin:0;">Name of complex/flat (if applicable): '.$address.'</h5>
                      </div>
                      <div style="clear:both;"></div>
                      <div class="block" style=" border-bottom: 1px solid #aab294;">
                          <div class="lt-side" style="float: left; width: 74%; border-right: 1px solid #adabad;">
                              <h5 style="font-size:20px; line-height:17px; margin:0; font-weight: 300; color: #000; padding: 8px 7px;">Street: '.$street.'</h5>
                          </div>
                          <div class="rt-side" style="float: right; text-align: left; width: 25%; " >
                              <h5 style="font-size:20px; line-height:17px; font-weight: 300; color: #000; padding: 8px 0px;padding-right: 35px; border-right: 1px solid #adabad; display: inline-block; float:left; margin:0;">Number: '.$number.'</h5><h5 style="font-size:16px; line-height:12px; font-weight: 300; color: #000; padding: 2px 7px; padding-right: 70px; display: inline-block; margin:0; float:left"> </h5>
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                      <div class="block" style=" border-bottom: 1px solid #aab294;">
                          <div class="lt-left" style="width: 55%; border-right: 1px solid #adabad; float: left;">
                              <h5 style="font-size:20px; line-height:17px; font-weight: 300; color: #000; padding: 8px 7px; padding-right: 70px; border-right: 1px solid #adabad; display: inline-block; margin:0; float:left">Suburb: '.$suburb.'</h5><h5 style="font-size:16px; line-height:12px; font-weight: 300; color: #000; padding: 2px 7px; padding-right: 70px; display: inline-block; margin:0; float:left"> </h5>
                          </div>
                          <div class="rt-right" style="float: right; text-align: left; width: 44%;">
                             <h5 style="font-size:20px; line-height:17px; font-weight: 300; color: #000; padding: 8px 0px; padding-right:50px; border-right: 1px solid #adabad; display: inline-block; margin:0; float:left;">City: '.$city.'</h5><h5 style="font-size:16px; line-height:12px; font-weight: 300; color: #000; padding: 2px 7px; padding-right: 70px; display: inline-block; margin:0; float:left"> </h5> 
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                      <div class="block">
                          <div class="lt-left" style="width: 55%; border-right: 1px solid #adabad; float: left;">
                              <h5 style="font-size: 20px;line-height:17px;font-weight: 300;color: #000;padding: 8x 7px;padding-right: 10px;border-right: 1px solid #adabad;display: inline-block; margin:0; float:left;">Area Code: (of property where COC was issued) </h5><h5 style="font-size:16px; line-height:12px; font-weight: 300; color: #000; padding: 2px 7px; padding-right: 70px; display: inline-block; margin:0; float:left"> </h5>
                          </div>
                          <div class="rt-right" style="float: right; text-align: left; width: 44%;">
                              <h5 style="font-size:20px; line-height:17px; font-weight: 300; color: #000; padding: 8px 0; padding-right:39px; border-right: 1px solid #adabad; display: inline-block; margin:0; float:left;">Tel No: '.$cl_contact_no.'</h5><h5 style="font-size:16px; line-height:12px; font-weight: 300; color: #000; padding: 2px 7px; padding-right: 70px; display: inline-block; margin:0; float:left"> </h5>
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                  </div>
                  <div style="clear:both;"></div>
                  <div class="up_block" style="margin: 6px 0 0; border: 1px solid #adabad;">
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #d1e28d; text-align: center; padding:10px 0;">
                             <h4 style="font-size:18px; line-height:18px; margin:0;">Type of Installation Carried Out by '.$designation2[$userdata['designation']].'</h4>
                              <p style="padding: 0; margin: 0; font-size:18px;">(Clearly tick the appropriate Installation Category Code and complete the installation details below)</p>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; padding:9px 0;">
                             <h4 style="font-size:18px; margin:0;">Code</h4>
                         </div>
                         <div class="block_sec" style="width:10%;float: left;text-align: center;padding: 9px 0;">
                             <h4 style="font-size:18px; margin:0;">Tick</h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                       <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #fff; padding: 10px 0;">
                          <h5 style="font-size:20px; line-height:18px; color: #000; font-weight: 400; margin:0; padding: 0 0 0 5px; ">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #d2232a;">Hot water System</span></h5>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"> </h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #eff9fe; padding: 10px 0;">
                          <h5 style="font-size:20px; line-height:18px; color: #000; font-weight: 400; padding: 0 0 0 5px; margin:0; ">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #00aeef;">Cold water System</span></h5>
                         </div>
                        <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"></h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #f0eff7; padding: 10px 0;">
                          <h5 style="font-size:20px; line-height:18px; color: #000; font-weight: 400; padding: 0 0 0 5px;  margin:0;">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #5b579c;">Sanitary-ware and Sanitary-fittings</span></h5>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"> </h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                       <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #fff; padding: 10px 0;">
                          <h5 style="font-size:20px; line-height:18px; color: #000; font-weight: 400; margin:0; padding: 0 0 0 5px; ">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #d2232a;">Below-ground Drainage System</span></h5>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"></h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                          <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #eff9fe; padding: 10px 0;">
                            <h5 style="font-size:20px; line-height:18px; color: #000; font-weight: 400; padding: 0 0 0 5px; margin:0; ">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #00aeef;">Above-ground Drainage System</span></h5>
                          </div>
                          <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"> </h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #f0eff7; padding: 10px 0;">
                          <h5 style="font-size:20px; line-height:18px; color: #000; font-weight: 400; padding: 0 0 0 5px;  margin:0;">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #5b579c;">Rain Water Disposal System</span></h5>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"></h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                  </div>
                  <div class="up_block" style="margin: 6px 0 0; border: 1px solid #adabad;">
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #d1e28d; text-align: center; padding:10px 0;">
                             <h4 style="font-size:16px; line-height:18px; margin:0;">Specialisations: To be Carried Out by Licensed Plumber Only Registered to do the Specialised Work </h4>
                              <p style="padding: 0; margin: 0; font-size:18px;">(To verify and authenticate Licensed Plumbers specialisations visit pirb.co.z)</p>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; padding:9px 0;">
                             <h4 style="font-size:18px; margin:0;">Code</h4>
                         </div>
                         <div class="block_sec" style="width:10%;float: left;text-align: center;padding: 9px 0;">
                             <h4 style="font-size:18px; margin:0;">Tick</h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #fff5ed; padding: 10px 0;">
                          <h5 style="font-size:19px; line-height:18px; color: #000; font-weight: 400; padding: 0 0 0 5px;  margin:0;">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #f36f21;">Solar Water Heating System</span></h5>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"> </h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                      <div class="top" style="border-bottom: 1px solid #adabad;">
                         <div class="block_sec" style="width:79%; float: left; border-right: 1px solid #adabad; background: #f5e9e3; padding: 10px 0;">
                          <h5 style="font-size:19px; line-height:18px; color: #000; font-weight: 400; padding: 0 0 0 5px; margin:0; ">Installation, Replacement and/or Repair of a <span style="font-weight: 600; color: #790000;">Heat Pump </span></h5>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; border-right: 1px solid #adabad; text-align: center; ">
                             <h4 style="padding: 2px 0;font-size: 9px;line-height: 16px; margin:0;">&nbsp;  </h4>
                         </div>
                         <div class="block_sec" style="width:10%; float: left; text-align: center;">
                             <h4 style="padding-top:2px; margin:0;"></h4>
                         </div>
                         <div style="clear:both;"></div>
                      </div>
                  </div>
                  <div class="block" style="text-align: center;">
                                          
                      <p style="padding: 5px 0; margin: 0; font-size: 16px; line-height: 12px; color: #000; font-weight: 400; font-style: italic;">See explanations of the above on the reverse of this certificate</p>
                  </div>
                  <div class="installetion" id="preexisting_table" style="border:1px solid #a7a9ab;">
                      <div class="box" style="background: #d1e28d; padding: 10px 5px; border-bottom:1px solid #a7a9ab;">
                          <h4 style="font-size: 19px; line-height:18px; font-weight: 600; margin:0;">Installation Details <span style="font-size: 18px;line-height: 10px;font-weight: 400;">(Details of the work undertaken or scope of work for which the COC is being issued for)</span></h4>
                      </div>
                      <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>
                      <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>
                      <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>
                      <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>
                  </div>
                  <div class="installetion" style="border:1px solid #a7a9ab; margin:5px 0 0">
                      <div class="box" style="background: #d1e28d; padding:10px 5px; border-bottom:1px solid #a7a9ab; text-align: center;">
                          <h4 style="font-size:19px; line-height:14px; font-weight: 600; margin:0;">Pre-Existing Non Compliance* Conditions 
                          <span style="font-size:18px; line-height:17px; font-weight: 400;">(Details of any non-compliance of the pre-existing plumbing installation on which work was done  that needs to be brought to the attention of owner/user)</span></h4>
                      </div>
                       <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:15px; margin:0;"></h6>
                      </div>
                       <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>
                       <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>
                       <div class="box" style="background: #fff; padding: 10px 5px; border-bottom:1px solid #e7e8e9;">
                          <h6 style="font-size:14px; margin:0;"> </h6>
                      </div>

                  </div>
                  <div class="white_box" style="border:1px solid #adafb1; margin:5px 0 0; font-size:16px;">
                      <div class="block" style="padding:10px 5px; border-bottom:1px solid #adafb1;">
                          <p style="line-height:25px; color: #000; padding: 0; margin: 0; ">I (Licensed Plumbers Name and Surname), Licensed registration number, certify that, the above compliance certificate details are true and correct and will be logged in accordance with the prescribed requirements as defined by the PIRB.  I further certify that;<br>I further certify that (as highlighted);</p>Delete either <span style="font-weight: 700;">A</span> or <span style="font-weight: 700;">B</span> as appropriate
                      </div>
                      <div class="block" style="padding:5px 0 0 6px; float:right; width:32%; position:relative; ">
  
                      </div>
                      <div style="clear:both;"></div>
                  </div>
                  <div class="notoice" style="border:1px solid #adafb1; margin: 6px 0 0 0; background: #f3cfc1;">
                      <div class="text" style="padding:10px; background: #d2232a; text-align: center; color: #fff;">
                          <p style="padding: 0; margin: 0; font-size:18px; line-height:14px; font-weight:600;">IMPORTANCE NOTICE</p>
                      </div>
  
                      <div class="text" style="padding:3px 10px 0 5px;">
                          <span style="padding: 0 0 0 0; float: left; width:3%;"><img src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/round.png" style="margin:10px;" /></span>
                          <p style="float: right;width: 97%; font-size:14px; line-height:20px; color: #000; font-weight:400; padding: 0; margin: 0;">An incorrect statement of fact, including an omission, is an offence in terms of the PIRB Code of conduct, and will be subjected to PIRB disciplinary procedures.</p>
                          <div style="clear:both;"></div>
                      </div>
                      <div class="text" style="padding:3px 10px 0 5px;">
                          <span style="padding: 0 0 0 0; float: left; width:3%;"><img src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/round.png" style="margin:10px;"/></span>
                          <p style="float: right;width: 97%; font-size:14px; line-height:20px; color: #000; font-weight:400; padding: 0; margin: 0;">A completed Certificate of Compliance must be provided to the owner/consumer within 5 days of the completion of the plumbing works and the details of the Certificate of Compliance must be logged electronically with the PIRB within that period.</p>
                          <div style="clear:both;"></div>
                      </div>
                      <div class="text" style="padding:3px 10px 0 5px;">
                          <span style="float: left; width: 3%; padding: 0 0 0 0;"><img src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/round.png" style="margin:10px;"/></span>
                          <p style="float: right; width: 97%; font-size:14px; line-height:20px; color: #000; font-weight:400; padding: 0; margin: 0 0 7px;">The relevant plumbing work that was certified as complaint through the issuing of this certificate may be possibly be audited by a PIRB Auditor for compliance to the regulations, work- manship and health and safety of the plumbing.</p>
                      </div>
                      <div class="text" style="padding:3px 10px 0 5px;">
                          <span style="float: left; width: 3%; padding: 0 0 0 0;"><img src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/round.png" style="margin:22px 6px;" /></span>
                          <p style="float: right; width: 97%; font-size:14px; line-height:20px; color: #000; font-weight:400; padding: 0; margin: 0;">If this Certificate of Compliance has been chosen for an audit you must cooperated fully with the PIRB Auditor in allowing them to carry out the relevant audit.</p>
                          <div style="clear:both;"></div>
                      </div>
                      <div class="text" style="padding:3px 10px 0 5px;">
                          <span style="float: left; width: 3%; padding: 0 0 0 0;"><img src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/round.png"  style="float:left;margin:10px;" /></span>
                          <p style="float: right; width:97%; font-size:14px; line-height:20px; color: #000; font-weight:400; padding: 0; margin: 0;">See reverse side of this Certificate of Compliance for further details </p>
                          <div style="clear:both;"></div>
                      </div>
                  </div>
                  <div class="owners" style="margin: 2px 0 0;">
                      <img style="width: 100%; height: auto;" src="'.$_SERVER['DOCUMENT_ROOT'].'/auditit_new/pirb/assets/images/owners.png" />
                  </div>
              </div>
          </div>
      </div>
  
  	
  
  <div id="wrapper">
  <div class="certificate-block">
    <div class="container" style="width:1327px; margin: 300px 0px; padding:10px 15px 15px 15px; border: 4px solid #00aeef; background: #fff; border-radius: 20px; ">
        <div class="title" style="background: #d1e28d; text-align: center; color: #000; padding:10px 0; margin-bottom:4px;">
            <h3 style="margin:0; margin:0; font-size:21px; line-height: 14px; font-weight: 600;">TERMS & CONDITIONS</h3>
        </div>
        <div class="lt-block" style="float: left; width:50%;">
            <h3 style="margin:5px 0px; font-size:14px; line-height: 17px; color: #000; text-transform: uppercase; ">WHAT IS A PluMBINg CERTIfICATE Of COMPlIANCE (COC)?</h3>
            <p style="font-size: 14px; line-height: 17px; padding: 0; margin: 2px 0; color: #000; font-weight: 400;"> A  Plumbing  COC  is  a  means  by  which  the  Plumbing  Industry  Registration  Board  (PIRB) 
              licensed plumber self certifies that their work complies with all the current plumbing regulations 
              and laws as define by the National Compulsory Standards and Local Bylaws. COCs may 
              only be purchased, and used by a registered and approved PIRB licensed persons and at 
              the time of purchase, the COC is captured against the PIRB licensed plumber, and becomes 
              their responsibility. 
              upon issuing of a COC the PIRB licensed plumber has to log the relevant 
              COC into the PIRBs Plumbing audit/data management system within five days. 
              each day, a 
              computer random selection of jobs for which a COC has be logged with the PIRB, is selected for 
              an audit. 
              upon which a PIRB auditor will be sent out to carry out the audit. If the installation is 
              found to be incorrect or not up to standard the PIRB licensed plumber will be sent a rectification 
              notice on which the licensed plumber will have to react within the specified period as by the 
              auditor. This is usually 5 days.</p>
              <h3 style="margin:1px 0px; font-size:16px; line-height: 17px; color: #000; text-transform: uppercase; ">JOBS wHICH REqUIRE A COC</h3>
              <p style="font-size: 14px; line-height: 14px; padding: 0; margin: 1px 0; color: #000; font-weight: 400;">COC must be provided to the consumer for all plumbing jobs which fall into one or more of the following categories:</p>
              <ul style="font-size: 14px; line-height: 30px;  color: #000; font-weight: 400;">
                    <li style="line-height: 20px; padding-bottom:0px;">Where the total value of the work, including materials, labour and VAT, is more than the prescribe value as defined by the PIRB (material costs must be included, regardless of whether the materials were supplied by another person) a certificate must be issued for the following:</li><br>
                 <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">When an Installation, Replacement and/or Repair of Hot Water Systems and/ or Components is carried out</li><br>
                  <li style="line-height:30px;float: right; width:90%; list-style: none;">When an Installation, Replacement and/or Repair of Cold Water Systems and/ or Components is carried out</li><br>
                    <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">Installation, Replacement and/or Repair of Sanitary-ware and Sanitary-fittings is carried out</li><br>
                     <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">Installation, Replacement and/or Repair of a Solar Water Heating System</li><br>
                      <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">Installation, Replacement and/or Repair of a Below-ground Drainage System</li><br>
                       <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">stallation, Replacement and/or Repair of an Above-ground Drainage System</li><br>
                        <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">Installation, Replacement and/or Repair of an Above-ground Drainage System</li><br>
                         <li style="line-height:30px; line-height: 15px;float: right; width:90%; list-style: none;">Installation, Replacement and/or Repair of a Heat Pump Water Heating System</li><br>
                          <div style="clear:both;"></div>
                        <li style="margin:0px 0px; line-height: 20px;">Any  work  that  requires  the  installation,  replacement  and/or  repair  of  any  of  an electrical/solar hot water cylinder valves or components must have a COC issued to the consumer regardless of the cost.</li><br>
                    </ul>
                    <div style="clear:both;"></div>
              <h3 style="margin:0; font-size:16px; line-height:15px; color: #000; text-transform: uppercase; margin-top:0px; ">STAgE AT wHICH COC MUST BE COMPLETED</h3>
              <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 1px 0; color: #000; font-weight: 400;">A completed COC must be provided to the consumer within <span style="font-weight: 700;">5 DAYS</span> of the completion of the 
              plumbing work and the details of the COC must be logged electronically with the PIRB within that 
              period. A job is considered to be completed when the plumbing work is practically completed or 
              when plumbing work is capable of being used within an existing system - whichever comes first.</p>
              <h3 style="margin:2px 0px; font-size:16px; line-height: 16px; color: #000; text-transform: uppercase; ">LOggINg COC THROUgH THE SMS SERVICE</h3>
              <p style="font-size: 14px; line-height: 16px; padding: 0; margin:2px 0px; color: #000; font-weight: 400;">Details are to be SmS to 082 934 9334 in the following format:</p>
              <p style="font-size: 14px; line-height: 16px; margin:2px 0 3px; color: #000; font-weight: 400;">Your License Registration Number; Compliance Certificate Number; Numeric Code(s) of what work was undertaken; Area code where the work was carried out/installed example: 00001/75; 123456; 01; 0149.</p>
              <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 2px 0 3px; color: #000; font-weight: 400;">Incorrectly formatted smss will be rejected and you will be required to resubmit the details.</p>
        </div>
        <div class="rt-block" style="float: right; width: 49%;">
            <h3 style="margin:9px 0px; font-size:16px; line-height: 16px; text-transform: uppercase; margin-bottom: 10px;">HOw COMPLIANCE CERTIFICATES MAY BE PURCHASED</h3>
            <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 2px 0;">Compliance Certificates may be purchased by licensed persons or authorized persons through any of the following methods:</p>
            <ul style="font-size: 14px; line-height: 16px; color: #000; font-weight: 400; padding: 0; margin: 9px 0px;"> 
              <li style="padding-bottom: 8px;"><span style="font-weight: 700;">Over the counter at the Plumbing Industry Registration Board offices.</span>Purchasers will need to present their current license card. Compliance certificates may only be given on-the spot where payment is by cash, credit card, bank transfer (confirmation required) and or bank cheque.</li>
              <li style="padding-bottom: 8px;"><span style="font-weight: 700; display: block; padding-bottom: 10px;">Online:</span>Purchasers should log on to www.pirb.co.za, click on Order COC and follow the prompts.</li>
              <li style="padding-bottom: 8px;"><span style="font-weight: 700;">Resellers (merchant): </span>The PIRB Licensed Plumber will need to present his/her current licensed card upon purchasing a compliance certificate from a participating reseller (merchant) outlet.  No third parties may purchase from a reseller unless preapproved and verified by the PIRB first.</li>
            </ul>
            <h3 style="margin:8px 0px; font-size:16px; line-height: 16px; color: #000; text-transform: uppercase; margin:2px 0; ">DISPOSAL OF COMPLIANCE CERTIFICATES</h3>
            <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 9px 0; color: #000; font-weight: 400;">If for any reason, a licensed person does not intend to use a compliance certificate for its 
            intended purpose they should return it to the PIRB office and, if all is found to be in order, a 
            refund could be arranged. If a licensed person has a compliance certificate stolen or loses a 
            compliance certificate, he should report it immediately to the PIRB in the form of a statutory 
            declaration. </p>
            <h3 style="margin:8px 0px; font-size:16px; line-height: 16px; color: #000; text-transform: uppercase; margin:3px 0; ">THE PURPOSE OF AN AUDIT</h3>
            <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 3px 0; color: #000; font-weight: 400;">Audits  are  conducted  to  provide  a  measure  of  the  standard  of  the  plumbing  work  being performed across the country. The aim is to ensure a correct and consistent application of the standards is reflected in the work done.</p>
            <h3 style="margin:9px 0px; font-size:16px; line-height: 16px; color: #000; text-transform: uppercase; ">AUDIT PROCESS</h3>
            <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 9px 0; color: #000; font-weight: 400;">A computer random selection of COC for which a compliance certificate has be lodged with 
            the  PIRB,  is  selected  for  an  audit. Audits  are  conducted  by  qualified  experienced  trained 
            plumbers and experts authorized by the PIRB to perform the function. PIRB Plumbing Auditors 
            are registered with the PIRB and carry identification cards. When one of your COC has been 
            selected for an audit you will be contacted by the PIRB Auditor. You will be asked for details of 
            where the work was performed and arrangements will be made by the Auditor with the relevant 
            consumer. You will be requested by the Auditor to attend the audit.</p>
            <h3 style="margin:9px 0px; font-size:16px; line-height: 19px; color: #000; text-transform: uppercase; ">wHAT HAPPENS IF MY wORK DOES NOT PASS AN AUDIT?</h3>
            <p style="font-size: 14px; line-height: 16px; padding: 0; margin: 9px 0; color: #000; font-weight: 400;">If the audited work is found not to comply, you will be advised of the work requiring attention in 
            the form of a Rectification Notice. You are required to rectify the work in the time period specified 
            by the auditor. This is usually 5 days. The work may then be re-audited.  Failure to respond, act 
            or co-operate will result in disciplinary procedures</p>
            <h3 style="margin:9px 0px; font-size:15px; line-height: 17px; color: #000; text-transform: uppercase; margin-top: 3px; ">IF YOU DISAgREE wITH AN AUDIT RESULT</h3>
            <p style="font-size: 14px; line-height: 18px; padding: 0; margin: 3px 0; color: #000; font-weight: 400;">If you believe  that the rectification notice is incorrect, you may contact the PIRB and your objection will be reviewed. Objections must be submitted in writing on the relevant PIRB form, obtainable from PIRB office. </p>
        </div>
        <div style="clear:both;"></div>
        <div class="type" style="border: 1px solid #939598; width: 100%; font-size: 14px; line-height: 16px; font-weight: 400;">
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding: 10px 0; box-sizing: border-box;">
              <h3 style="margin:0; font-size:16px; line-height: 16px; font-weight: 600; color: #000;">Code</h3>
            </div>
            <div class="rt-right" style="float: left; width:92%; background: #d1e28d;  box-sizing: border-box;">
              <h3 style="margin:0; font-size:18px; line-height: 17px; padding: 0; margin:0; text-align: center; color: #000; padding: 10px 0px; margin: 0;">Type of Installation Carried Out:</h3>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px; box-sizing: border-box; ">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #d2232a;">01</h3>
            </div>
            <div class="rt-right" style="float: left; width:92%; background: #fbf0eb; padding:4px; box-sizing: border-box;">
              <h3 style="margin:2px 0px; font-size: 18px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#d2232a; font-weight: 600;">Hot water System and /or Components</span> </h4>
              <p style="font-size:11px; line-height:16px; line-height:16px padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)</p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px; box-sizing: border-box;">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #00aeef;">02</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #eff9fe; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#00aeef; font-weight: 600;">Cold water System and /or Components</span> </h4>
              <p style="font-size:11px; line-height:16px; padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)</p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px; box-sizing: border-box;">
              <h3 style="margin:12px 0x; font-size: 22px; line-height:17px; font-weight: 600; color: #5b579c;">03</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #f0eff7; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#5b579c; font-weight: 600;">Sanitary-ware and Sanitary-fittings</span> </h4>
              <p style="font-size:11px; line-height:16px;  padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)</p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="box-sizing: border-box; float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px;">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #f36f21;">04</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #fff5ed; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#f36f21; font-weight: 600;">Solar water Heating System</span> </h4>
              <p style="font-size: 11px; line-height:16px; padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)<span style="color: #d2232a; font-weight: 600; font-size: 15px;">work can only be undertaken by a Licensed Plumber registered to do this specialised work.</span></p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="box-sizing: border-box; float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:19px 4px;">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #7d4e35;">05</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #f3efeb; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#7d4e35; font-weight: 600;">Below-ground Drainage System</span> </h4>
              <p style="font-size:11px; line-height:16px; padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)</p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="box-sizing: border-box; float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px;">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #41ad49;">06</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #f3f8f1; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#41ad49; font-weight: 600;">Above-ground Drainage System</span> </h4>
              <p style="font-size:11px; line-height:16px; padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)</p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block" style="border-bottom: 1px solid #939598;">
            <div class="lt-left" style="box-sizing: border-box; float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px;">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #00386c;">07</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #e7e9f1; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#00386c; font-weight: 600;">Rain water Disposal System</span> </h4>
              <p style="font-size:11px; line-height:16px; padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)</p>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="block">
            <div class="lt-left" style="box-sizing: border-box; float: left; width: 6%; text-align: center; border-right: 1px solid #939598; padding:18px 4px;">
              <h3 style="margin:12px 0px; font-size: 22px; line-height: 17px; font-weight: 600; color: #790000;">08</h3>
            </div>
            <div class="rt-right" style="box-sizing: border-box; float: left; width:92%; background: #f5e9e3; padding: 4px 4px 4px 4px; box-sizing: border-box;">
              <h3 style="margin: 2px 0px; font-size: 20px; line-height: 16px; color: #000; font-weight: 600;">Installation, Replacement and/or Repair of a <span style="color:#790000; font-weight: 600;">Heat Pump</span> </h4>
              <p style="font-size:11px; line-height:16px; padding: 0; margin: 2px 0px;">(A Certificate of Compliance is to be issued for  the  installation,  replacement  and/or  repair  of any plumbing work carried out on the hot water reticulation system upstream of the 
              pressure regulating valve, which shall include but not be limited to: the pressure regulating valve; an electrical hot water cylinder; all relevant valves and components and all hot 
              water pipe and fittings, and shall end at any of the hot water terminal fittings;  but shall  exclude  any sanitary  fittings,  solar and heat pump installations. The scope of work and 
              non-compliance on pre-existing installations by others must be clearly noted in the installation details provided overleaf.)<span style="color: #d2232a; font-weight: 600; font-size: 15px;">work can only be undertaken by a Licensed Plumber registered to do this specialised work.</span></p>
            </div>
            <div style="clear:both;"></div>
          </div>
        </div>
    </div>
  </div>
  </div>
  </body>
</html>';

$pdfFilePath = 'electroniccoc.pdf';
$filePath = FCPATH.'assets/inv_pdf/';

$dompdf = new DOMPDF();

$dompdf->loadHtml($html);
$dompdf->setPaper('A2', 'portrait');
$dompdf->render();
$output = $dompdf->output();
file_put_contents($filePath.$pdfFilePath, $output);
?>

