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
    <link href="<?php echo base_url().'assets/css/mobile?version=3.0.css'; ?>" rel="stylesheet">
    <script src="<?php echo base_url().'assets/plugins/jquery/jquery-3.2.1.min.js?version=5.0'; ?>"></script>
    <title></title>
</head>
<body>
   <div class="add_top_value <?php echo (isset($cardcolor[$designation2id]) ? $cardcolor[$designation2id] : ''); ?>  inner rotate">
      <div class="p_card">
         <img class="p_logo" src="<?php echo base_url();?>assets/images/pitrb-logo.png">
         <p>Reg No: <?php echo ($registration_no!='') ? $registration_no : '-'; ?></p>
         <p>Renewal Date: <?php echo $renewal_date; ?></p>
         <div class="p_profile">
            <img class="p_admin" src="<?php echo $photoidimg; ?>">
            <p style="text-align:center"><?php echo $name.' '.$surname; ?></p>
         </div>
         <div class="p_bottom">
            <img class="p_lic" src="<?php echo base_url().$plumber_icon; ?>">
            <h2 class="p_h2"><?php echo isset($designation2[$designation2id]) ? $designation2[$designation2id] : '-'; ?></h2>
         </div>
      </div>
   </div>
</body>
</html>



