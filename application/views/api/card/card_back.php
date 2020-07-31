<?php
    $userid                 =isset($result['id']) ? $result['id'] : '';

    $name                   = isset($result['name']) ? $result['name'] : '';
    $surname                = isset($result['surname']) ? $result['surname'] : '';
    
    $designation2id         = isset($result['designation']) ? $result['designation'] : '';
    $registration_no        = isset($result['registration_no']) ? $result['registration_no'] : '';
    $registration_date      = isset($result['registration_date']) && $result['registration_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['registration_date'])) : '';
    $renewal_date           = date('d-m-Y', strtotime($result['expirydate']));
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

    }elseif($designation2[$designation2id] == 'Technical Assistant'){
        $plumber_icon = 'assets/images/card/Technical Assistant.png';

    }elseif($designation2[$designation2id] == 'Technical Operator'){
        $plumber_icon = 'assets/images/card/Technical Operator.png';

    }elseif($designation2[$designation2id] == 'Licensed Plumber'){
        $plumber_icon = 'assets/images/card/licensed plumber.png';

    }elseif($designation2[$designation2id] == 'Qualified Plumber'){
        $plumber_icon = 'assets/images/card/licensed plumber';

    }elseif($designation2[$designation2id] == 'Master Plumber'){
        $plumber_icon = 'assets/images/card/Master-plumber.png';
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo base_url().'assets/css/mobile.css?version=3.0.css'; ?>" rel="stylesheet">
    <script src="<?php echo base_url().'assets/plugins/jquery/jquery-3.2.1.min.js?version=5.0'; ?>"></script>
    <title></title>
</head>

<body>
   <div class="add_top_value <?php echo (isset($cardcolor[$designation2id]) ? $cardcolor[$designation2id] : ''); ?>  pb_inner pb_rotate">
      <div class="pb_card">
         <div class="p_top">
         <p class="pb_first_txt">This card holder is only entitled to purchase and issue Plumbing COC’s for the following categories of plumbing and plumbing specialisations</p>
         <p style="margin-top: -5px;"><span><img src="<?php echo $backcard; ?>"></span><span>Above Ground Drainage</span>
         <span><img src="<?php echo $backcard6; ?>"></span><span>Hot Water</span>
         <span><img src="<?php echo $backcard1; ?>"></span><span>Below Ground Drainage</span>
         <span><img src="<?php echo $backcard; ?>"></span><span>Solar Water Heating</span>
         <span><img src="<?php echo $backcard; ?>"></span><span>Rain Water Drainage</span>
         <span><img src="<?php echo $backcard; ?>"></span><span>Heat Pumps</span>
         <span><img src="<?php echo $backcard; ?>"></span><span>Cold Water</span>
         <span><img src="<?php echo $backcard; ?>"></span><span>Gas</span></p>
         </div>
         <div class="pb_bottom_left">
            <span class="pb_title">Current</span><br>
            <span class="pb_title">Employer</span>
            <p class="plumber_name add_style"><?php echo  $companyname; ?></p></span>
            <!-- <img class="tchn--asiiisss" src="<?php// echo base_url().$plumber_icon; ?>"> -->
            <p class="pb_p pb_lost">Lost or Found <?php echo $work_phone; ?></p>
            <p class="pb_p pb_vrfy">Verification can be done via</p>
            <p class="pb_p pb_web">www.pirb.co.za</p>
         </div>
         <div class="pb_right">
            <p style="font-weight: 600;font-size: 14px;">specialisations</p>
            <?php if($designation2id != '1' and $designation2id != '2' and $designation2id != '3'){ ?>
                        <?php 
                            if(count($specialisationsid) > 0){
                                foreach($specialisationsid as $specialisationsdata){
                                    
                               
                                
                        ?>
                                    <p style="font-size: 13px;margin-bottom: -10px;margin-left: 20px;"><?php echo  isset($specialisations[$specialisationsdata]) ? $specialisations[$specialisationsdata] : '-';?></p>
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
         <div class="pb_bar">
         </div>
         <h2 class="pb_lic"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></h2>
      </div>
   </div>
</body>
</html>



