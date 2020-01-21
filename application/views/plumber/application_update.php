<?php

$application_status_arr = $application_update['application_status_arr'];
echo form_open_multipart('', array('data-toggle' => 'validator','id' => 'plumber-application-update',));
?>
<div class="container">
	<div class="top_box" style="background: #fff;">
	
    <label class="idapplication_status_label">

        <?php

            // echo form_input([
            //    'type' => 'checkbox',
            //    'name' => 'ProcedureRegistration',
            //    'id' => 'ProcedureRegistration' ,
            //    'class' => 'form-control',
            //    'value' => set_value('ProcedureRegistration')
            // ]);



            
            // if($res['ProcedureRegistration']==1){
            //     $ProcedureRegistration_checkbox['checked'] = TRUE;
            // }
        	
            //	echo $Designation;exit;
        	//	$required_arr = array();
        		$required_arr = array(
        			1=>array(1,2,3,4,5,6),
        			2=>array(1,2,3,4,5,6,8),
        			3=>array(1,2,3,4,5,6,7,8)
        		);

        	// if($Designation==1){
        	// 	$required_arr =array(1,2,3,4,5,6);
        	// } 
        	// else if($Designation==2){
        	// 	$required_arr =array(1,2,3,4,5,6,8);
        	// }

            foreach($application_status_arr as $key=>$val){

            	$name = $this->commonModel->slug($val);

            	$application_status_checkbox = array(
	                'name'        => "application_status_$key",
	                //'name'        => "$key",
	                'value'       => $val,
	                //'required'       => 1,
            	);	
            	if(in_array($key, $required_arr[$Designation])){
            		$application_status_checkbox['required'] = 1;
            	}
            	echo '<div class="form-group">';
            	echo form_checkbox($application_status_checkbox).$val.'<br>';
            	echo '<div class="help-block with-errors"></div>';
            	echo '</div>';
            }
        ?>
        
    </label>


    <div class="form-group">
    <?php
                                    
        foreach($designation_arr as $key=>$val){
            //  $key++;
            if($key==$Designation){
                $checked = "checked='true'";
            } else {
                $checked = "";
            }
            echo "<input type='radio' name='ApplationDesignation' value='$key' $checked> $val<br>";    
        }
    ?>
    <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
    <?php
                                    
        foreach($approve_arr as $key=>$val){
            echo "<input required type='radio' name='approve' value='$key'> $val<br>";    
        }
    ?>
    <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">

        <?php
        $comment_txtarea = array(
            'name'        => 'CommentDisplay',
            'id'          => 'CommentDisplay',
            'value'       => set_value('CommentDisplay'),
            'cols'        => '10',
            'style'       => 'width:50%',
            'class'       => 'form-control'
        );

        echo form_textarea($comment_txtarea);  
    ?>
    </div>
    <div class="form-group">
        <?php
            echo form_input([
           'name' => 'Comment',
           'id' => 'Comment' ,
           'class' => 'form-control',
           'value' => set_value('Comment')
            ]);
        ?>
	</div>

    <div class="form-group">
        <input type="submit" name="add_comment" value="Add Comment">
    </div>

	<div class="form-group">
		<input type="submit" name="application_update" value="Save">
	</div>
	
</div>
<?php echo form_close(); ?>