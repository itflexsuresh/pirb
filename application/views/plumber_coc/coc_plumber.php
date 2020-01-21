
                <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">


                <div class="row"> 
                    <div class="col-md-12">
                        <div class="white-box">


                           <?php
                           if ($this->session->flashdata('success') != '') {
                              echo "<div class='alert alert-success'>";
                              echo $this->session->flashdata('success');
                              echo "</div>";
                          }
                          ?>


                          <!-- <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class=""><a href="" aria-controls="home" role="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Plumber Details</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('get_company/employeelist')."/".$dataaa[0]->CompanyID; ?>" aria-controls="profile" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Employee Listing</span></a></li>
                                -->
                                <!-- <li role="presentation" class="active nav-item"><a href="<?php echo base_url('plumber_coc/pur_coc'); ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Management</span></a></li>
 -->
                                <!-- <li role="presentation" class="nav-item"><a href="<?php echo base_url('allocation/coc_alloc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Allocation</span></a></li> -->
                                

                                <!-- <li role="presentation" class="nav-item"><a href="<?php echo base_url('company_diary/load_comment')."/".$dataaa[0]->CompanyID; ?>" aria-controls="diary" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Diary & Comments</span></a></li> 
                                </ul>
                                <br>
								-->
                            

<?php
 if(isset($_POST['purchase']) == ''){ ?>

                            <form data-toggle="validator" method="post" id="pur_coc">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Non Allocated COC's</label>
                                        <input type="text" name="non_loggedcoc" id="non_loggedcoc" value="<?php echo $non_all['num_of_time']; ?>" class="form-control" readonly="readonly">
                                        <!-- <span class="help-block"> This is inline help </span> --> 

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Number COC's You are Permitted</label>
                                        <input type="text" name="total" id="total" value="<?php echo $res12; ?>"
                                        class="form-control" readonly="readonly">
                                        <!-- <span class="help-block"> This is inline help </span> --> 

                                    </div>
                                </div>
                                </div>


                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Permitted COC's that you are able to purchase</label>
                                        <input type="text" name="permitted" id="permitted" value="<?php echo $total; ?>" class="form-control" readonly="readonly">
                                        <!-- <span class="help-block"> This is inline help </span> --> 

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label disclai">Select type of COC you wish to purchase</label>

                                        <?php

                                        $dat5 = array('1' => 'Electronic', '2' => 'Paper Based');

                                        $i=0;

                                        foreach($amou as $key=>$val)
                                        {
                                        	$i =$i+1;

                                        	if($key==0)
                                        	{
                                        		$key = 'Electronic';
                                        	} 
                                        	else 
                                        	{
                                        		$key = 'Paper Based';
                                        	}

                                        	$value = $val['Amount'];
                                        	echo "<input type='radio' class=cal_amount id=amoun_rad$i value='$value' name=rad>$key";
                                        }

                                        ?>
                                        
                                    </div>

                                </div>
                                </div>



                               
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="method_delivery">
                                        <label class="control-label">Method of Delivery</label>

                                        <select class="form-control" id="met_del" name="method_delivery">
                                        <option>Select</option> 
                                        	<?php 

                                        	$dat2 = array('1'=>'Delivery by Courier','2'=>'Delivery By Registered Post','3'=>'Delivery for Collection');

                                        	foreach ($dat2 as $key => $value) {
                                        		$key_new= $key-1;

                                        		$amount = $meth[$key_new]['Amount'];
                                        		echo "<option value='$key' amount='$amount'>$value</option>";
                                        	}
                                        	?>
                                        </select>
                                        <?php
                                        //	exit;
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of COC's You wish to Purchase</label>
                                        <input type="number" min="0" name="no_coc" id="no_coc" value="" class="form-control" required>
                                        <!-- <span class="help-block"> This is inline help </span> --> 
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                </div>
                                

                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Cost of COC Type</label>
                                        <input type="text" name="cost" id="cost" value="0" class="form-control" readonly="readonly">
                                        <!-- <input type="text" name="cost" id="cost" value="<?php echo $val['Amount']; ?>" class="form-control" readonly="readonly">
 -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Cost of Delivery</label>
                                        <input type="text" name="delivery" id="delivery" value="" class="form-control" readonly="readonly">
                                        <!-- <span class="help-block"> This is inline help </span> --> 

                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">VAT @<span class="vat_per"><?php echo $vat_cal[0]->VatPercentage; ?></span>%</label>
                                        <input type="text" name="vat" id="vat" value="0" class="form-control" readonly="readonly">
                                        <!-- <span class="help-block"> This is inline help </span> --> 

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Due</label>
                                        <input type="text" name="due" id="due" value="0" class="form-control" readonly="readonly">
                                        <!-- <span class="help-block"> This is inline help </span> --> 

                                    </div>
                                </div>
                                </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label disclai">Disclaimer :</label>
                                            <input type="checkbox" name="discl" id="discl" value=""  class="form-control" required>
                                            <label>I declare and understand:</label>
                                            
                                            <ul>
                                                <li>That I will be held accountable for the COC’s until such time that they are allocated (sold) to a Licensed Plumber in the appropriate manner.</li>

                                            </ul>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    </div>
                                


                                <div class="row">
                                    <div class="col-md-12">   
                                        <div class="col-lg-2 col-sm-3 col-xs-10">
 <!--                                                            <button type="submit" id="purchase" class="btn btn-block btn-primary btn-rounded"> Purchase</button>
 -->
 <button type="submit" id="purchase" class="btn btn-success btn-rounded btn-sm waves-effect waves-light m-r-10" name="purchase">Purchase</button>

 <button type="submit" class="btn btn-inverse btn-rounded btn-sm waves-effect waves-light" >Cancel</button>
</div>
</div>
</div>


</div>

<?php echo form_close(); ?>

<?php } ?>
					

</div>
</div> 
</div>


<?php

 if(isset($_POST['purchase']) != '')
 	{ ?>
	<div id="otpform">
<form method="post" name="otpgenerate" action="">

	
				<p>A One Time Pin (OTP) was sent to the Licensed Plumber with the following Mobile Number:</p>
				<label class="control-label">Enter OTP</label>
				<input type="text" class="form-control" name="otp" placeholder="OTP">

				<button type="submit" id="pur_cancel" class="btn btn-success btn-rounded btn-sm waves-effect waves-light m-r-10" onclick="location.href='<?php echo base_url();?>plumber_coc/pur_coc'">Cancel</button>
				<button type="submit" id="resend" class="btn btn-success btn-rounded btn-sm waves-effect waves-light m-r-10">Resend</button>
				<button type="submit" id="verify" class="btn btn-success btn-rounded btn-sm waves-effect waves-light m-r-10">Verify</button>
			

			</form>
</div>
<?php } ?>
			
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 -->
<script type="text/javascript">
   $('.alert, .alert-success').delay('3000').fadeOut(300);

   $(document).ready(function(){

   	$('#purchase').click(function(){
   		$('#otpform').show();
   	});



   	$('#amoun_rad1').prop('checked', true)

   	   if ($('#amoun_rad1').prop('checked'))
   	   {
           $("#method_delivery").hide();
        }

		
        $('#amoun_rad1').click(function()
   	   {
         $("#method_delivery").hide();    
        
    		});

		$('#amoun_rad2').click(function()
   	   {
         $("#method_delivery").show();    
        
    		});   






    		$('#amoun_rad1').prop('checked', true);


    		$('input[name="rad"]').change(function() 
    		{	

    			 var radrad = null;
    			 rad =this.value;
    			 //alert(i.val());
    		});




    		$('#no_coc').on('keyup change', function(){
    			calc();
    			calcs();
    			cal(); 

    		});


    $("#met_del").change(function () 
    {
    	var selectedValue = $(this).attr('value');
    	$("#delivery").val($(this).find("option:selected").attr("amount"))
    });

    
        $('.cal_amount').on('click keyup change', function(){

          calc();
 });



    
    function calc(){
	
	var tot1 = $('.cal_amount:checked').val();
    var tot2 = $('input[name="no_coc"]').val();

    var ggf = tot1 * tot2;

    $('#cost').val(ggf);

}

  
//     function match(){

//       var txt1 = $('#permitted').val();
//       var txt2 = $('#no_coc').val();

//       if (txt1 > txt2)
//       {
//      // alert('Matching!');
//      return true;
//  }
//  else
//  {
//     alert('Not matching!');
//     return false;
// }

// }
    


function calcs()
{
	
	var ggf = $('#cost').val();
	//var ott = $('#delivery').val();
     var ott = $('#delivery option:selected').attr('amount');
     
     if(ott===undefined){
     	ott = 0;
     }
    

//ott = $('#met_del option[value="'+del_val+'"').attr('amount');
	
	var vat_value = (parseFloat(ggf)+parseFloat(ott))*9/100;
    //var vat_value = (ggf+ott*15)/100;

	$('#vat').val(vat_value);
} 	



function cal()
{
	
	var tott = $('#cost').val();
	//var ott = $('#delivery').val();
	var ott = $('#delivery option:selected').attr('amount');

	if(ott === undefined){
     	ott = 0;
     }
	//	ott = $('#met_del option[value="'+del_val+'"').attr('amount');
	var ttto = $('#vat').val();

  var grand_total = (parseFloat(tott)+parseFloat(ott)+parseFloat(ttto)).toFixed(1);

  $('#due').val(grand_total);

}    
});

</script>






