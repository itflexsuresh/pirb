<?php

    
    $userid                 =isset($result['id']) ? $result['id'] : '';

    $name                   = isset($result['name']) ? $result['name'] : '';
    $surname                = isset($result['surname']) ? $result['surname'] : '';
    
    $designation2id         = isset($result['designation']) ? $result['designation'] : '';
    $registration_no        = isset($result['registration_no']) ? $result['registration_no'] : '';
    $registration_date      = isset($result['registration_date']) && $result['registration_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['registration_date'])) : '';
    $renewal_date           = $registration_date!='' ? date('d-m-Y', strtotime($result['registration_date']. ' +365 days')) : '';
    $specialisationsid      = isset($result['specialisations']) ? array_filter(explode(',', $result['specialisations'])) : [];
    $companyname        	= isset($result['companyname']) ? $result['companyname'] : '';

    $work_phone         	= isset($settings['work_phone']) ? $settings['work_phone'] : '';

    $filepath               = base_url().'assets/uploads/plumber/'.$userid.'/';
    $pdfimg                 = base_url().'assets/images/pdf.png';
    $profileimg             = base_url().'assets/images/profile.jpg';
    $logo                   = base_url().'assets/images/card/logo.png';
    $spl1                   = base_url().'assets/images/card/Solar.png';
    $spl2                   = base_url().'assets/images/card/Gas.png';
    $spl3                   = base_url().'assets/images/card/Estimator.png';
    $spl4                   = base_url().'assets/images/card/Heatpump.png';
    $spl5                   = base_url().'assets/images/card/Training Assessor.png';
    $spl6                   = base_url().'assets/images/card/Arbitrator.png';
    $backcard               = base_url().'assets/images/card/back-card/Above Ground Drainage Icon.png';
    $backcard1              = base_url().'assets/images/card/back-card/Below Ground Drainage Icon.png';
    $backcard2              = base_url().'assets/images/card/back-card/Cold Water Icon.png';
    $backcard3              = base_url().'assets/images/card/back-card/Drainage Icon.png';
    $backcard4              = base_url().'assets/images/card/back-card/Gas.png';
    $backcard5              = base_url().'assets/images/card/back-card/Heatpump.png';
    $backcard6              = base_url().'assets/images/card/back-card/Hot Water Icon.png';
    $backcard7              = base_url().'assets/images/card/back-card/Rainwater Disposal Icon.png';
    $backcard8              = base_url().'assets/images/card/back-card/Solar.png';
    $backcard9              = base_url().'assets/images/card/back-card/Water Energy Efficiency Icon.png';



    $file2                  = isset($result['file2']) ? $result['file2'] : '';
    if($file2!=''){
        $explodefile2   = explode('.', $file2);
        $extfile2       = array_pop($explodefile2);
        $photoidimg     = (in_array($extfile2, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$file2;
    }else{
        $photoidimg     = $profileimg;
    }
    
    $filepath               = base_url().'assets/uploads/plumber/'.$userid.'/';
    $pdfimg                 = base_url().'assets/images/pdf.png';
    $profileimg             = base_url().'assets/images/profile.jpg';

    $cardcolor = ['1' => 'learner_plumber', '2' => 'technical_assistant', '3' => 'technical_operator', '4' => 'licensed_plumber', '5' => 'qualified_plumber', '6' => 'master_plumber'];

    if ($designation2[$designation2id] == 'Learner Plumber') {
        $plumber_icon = 'assets/images/card/Learner plumber.png';

    }elseif($designation2[$designation2id] == 'Technical Assistant Practitioner'){
        $plumber_icon = 'assets/images/card/Technical Assistant.png';

    }elseif($designation2[$designation2id] == 'Technical Operator Practitioner'){
        $plumber_icon = 'assets/images/card/Technical Operator.png';

    }elseif($designation2[$designation2id] == 'Licensed Plumber'){
        $plumber_icon = 'assets/images/card/licensed plumber.png';

    }elseif($designation2[$designation2id] == 'Qualified Plumber'){
        $plumber_icon = 'assets/images/card/licensed plumber';

    }elseif($designation2[$designation2id] == 'Master Plumber'){
        $plumber_icon = 'assets/images/card/Master-plumber.png';
    }
    
?>


<div class="row add_top_value <?php echo (isset($cardcolor[$designation2id]) ? $cardcolor[$designation2id] : ''); ?>">
    <div class="col-md-6">  
        <table id="id_Card" width="442" height="285" class="front--card--design">
            <tbody>
                <tr>
                    <td>
                        <img class="id_logo" src="<?php echo base_url();?>assets/images/pitrb-logo.png">
                        <p class="register-num">Reg No: <?php echo ($registration_no!='') ? $registration_no : '-'; ?></p>
                        <p class="rene-date">Renewal Date: <?php echo $renewal_date; ?></p>
                    </td>
                    <td style="vertical-align: baseline;">
                        <img class="id_admin" src="<?php echo $photoidimg; ?>">
                        <p><?php echo $name.' '.$surname; ?></p>
                    </td>
                </tr>
                <tr class="add_idcard_color" >
                    <td colspan="2">
                        <div class="idcard_icon">
                            <img class="plum_lic" src="<?php echo base_url().$plumber_icon; ?>">
                        </div>
                        <div class="idcard--name">
                            <p class="license"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></p>
                        </div>                   
                    </td>
                        
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 alter_img">
        <table id="id_Card_back" width="442" height="285" class="back---card--design">
            <tbody>
                
                <?php if($designation2id != '1' and $designation2id != '2' and $designation2id != '3'){ ?>
                <tr>
                    <td colspan="2">
                        <p class="first-card-txt">This card holder is only entitled to purchase and issue Plumbing COC’s for the following categories of plumbing and plumbing specialisations</p>
                    </td>
                </tr>

                <tr class="stct---icons">
                    <td colspan="2" class="add_width img-txt">
                                <span class="abve---img"><p><img src="<?php echo $backcard; ?>"></p></span>
                                <div class="txt-img-card abve-grnd--ttle">Above Ground Drainage</div>

                                <span class="hot--wtr---img"><p><img src="<?php echo $backcard6; ?>"></p></span>
                                <div class="txt-img-card ht--wtr--ttle">Hot Water</div>

                                <span class="blw---img"><p><img src="<?php echo $backcard1; ?>"></p></span>
                                <div class="txt-img-card blw-grnd--ttle">Below Ground Drainage</div>

                                <span class="solar---img"><p><img src="<?php echo $backcard8; ?>"></p></span>
                                <div class="txt-img-card slr--wtr-ttle">Solar Water Heating</div>

                                <span class="rain--wtr---img"><p><img src="<?php echo $backcard7; ?>"></p></span>
                                <div class="txt-img-card rain---ttle">Rain Water Drainage</div>

                                <span class="heat---img"><p><img src="<?php echo $backcard5; ?>"></p></span>
                                <div class="txt-img-card heat---ttle">Heat Pumps</div>

                                <span class="cold--wtr---img"><p><img src="<?php echo $backcard2; ?>"></p></span>
                                <div class="txt-img-card cold---ttle">Cold Water</div>

                                <span class="gas---img"><p><img src="<?php echo $backcard4; ?>"></p></span>
                                <div class="txt-img-card gas-title">Gas</div>
                                    
                   </td>
                </tr>
            
                <tr class="dynmci---icns">
                    <?php 
                        if(!empty($specialisationsid)){
                            $specialisationskey = 0; ?>
                            <td colspan="2" class="add_width img-txt">
                            	<?php
                            foreach($specialisationsid as $specialkey => $specialisationsdata){
                                if($specialisationskey==0){
                    ?>
                                    
                                
                    <?php
                                }
                    ?>              
                            
                            
                                <?php
                                    if($specialisationsdata  =='1'){ echo "<span><p><img src='".$spl1 ."'></p></span>";} 
                                    if($specialisationsdata  =='2'){ echo "<span><p><img src='".$spl2 ."'></p></span>";} 
                                    if($specialisationsdata  =='3'){ echo "<span><p><img src='".$spl3 ."'></p></span>";} 
                                    if($specialisationsdata  =='4'){ echo "<span><p><img src='".$spl4 ."'></p></span>";} 
                                    if($specialisationsdata  =='5'){ echo "<span><p><img src='".$spl5 ."'></p></span>";} 
                                    else{
                                    if($specialisationsdata  =='6'){ echo "<span><p><img src='".$spl6 ."'></p></span>";}
                                    }
                                    ?>
                                <div class="txt-img-card"><?php echo isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-'; ?></div>
                                <?php if($specialkey=='4'){ echo '<br>'; } ?>            
                    <?php
                                if($specialisationskey==2 || (count($specialisationsid)-1)==$specialisationskey){
                    ?>
                                        
                                        

                                    
                    <?php
                                }
                                
                                $specialisationskey++;
                                if($specialisationskey==3) $specialisationskey=0;
                            } ?>
                            </td>
                            <?php
                        }else{
                    ?>
                            <td class="add_width empty-data" style="vertical-align: top;">-</td>
                    <?php 
                        }
                        
                    }   else{
                        echo "<img src='".$logo."'>";
                    }
                    ?>
                </tr>
                <tr class="technical----operator--top--cntnt">
                    <td colspan="2">
                        <p class="first-card-txt">This card holder is technically proficient and declared competent in the following categories:</p>
                    </td>
                </tr>
                <tr class="back--crd--logo">
                    <td colspan="2">
                        <img src="<?php echo base_url();?>assets/images/logo.png">
                    </td>
                </tr>
                <tr class="technical----operator--static-icons">
                    <td colspan="2" class="add_width img-txt">
                       <span class="wtr--efncy---img"><p><img src="<?php echo $backcard9; ?>"></p></span>
                       <div class="txt-img-card wtr--efncy--ttle">Water Energy Efficiency</div>

                       <span class="drngee---img"><p><img src="<?php echo $backcard3; ?>"></p></span>
                       <div class="txt-img-card drngee--ttle">Drainage</div>

                       <span class="cold--wtr---img"><p><img src="<?php echo $backcard2; ?>"></p></span>       
                       <div class="txt-img-card cold---ttle">Cold Water</div>

                       <span class="hot--wtr---img"><p><img src="<?php echo $backcard6; ?>"></p></span>
                       <div class="txt-img-card ht--wtr--ttle">Hot Water</div>
                    </td>
                </tr>
                <tr style="border-top: 1px solid #000;">
                    <td class="curr_emptxt" style="border-right: 1px solid #000;">
                        <span class="curr_txts"><p class="emp_title">Current <br> Employer </p> 
                        <p class="plumber_name add_style"><?php echo  $companyname; ?></p></span>
                        <p class="alter_lost_veri" style="width: 100%;">Lost or Found <?php echo $work_phone; ?></p>
						<p class="vrfy">Verification can be done via www.pirb.co.za</p>
                        <img class="tchn--asiiisss" src="<?php echo base_url().$plumber_icon; ?>">
                    </td>
                    <?php if($designation2id != '1' and $designation2id != '2' and $designation2id != '3'){ ?>
                    <td class="spclizatn---sctn" style=" vertical-align: top;">
                        <p style="width: 100%; margin-right: 0; margin-left: 0;">Specialisations</p>
                        <div>
                        <?php 
                            if(count($specialisationsid) > 0){
                                foreach($specialisationsid as $specialisationsdata){
                                    
                               
                                
                        ?>
                                    <div><?php echo  isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-';?></div>
                        <?php   
                                }
                            }else{
                            
                        ?>
                                <p>-</p>
                        <?php 
                            }
                        }

                        ?>
                        </div>
                    </td>

                </tr>
                
            </tbody>
            <tbody class="rght-rotate-txt">
                <tr style="height: 298px;">
                    <td class="add_idcard_color" colspan="2" style="text-align: center; padding: 0px;">
                        <p class="back_license" style="transform: rotate(-90deg) !important;margin: -48px;"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
