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


        <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class=""><a href="" aria-controls="home" role="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Company Details</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('get_company/employeelist')."/".$dataaa[0]->CompanyID; ?>" aria-controls="profile" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Employee Listing</span></a></li>

                                <li role="presentation" class="active nav-item"><a href="<?php echo base_url('purchase_coc/pur_coc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Management</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('allocation/coc_alloc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Allocation</span></a></li>
                                

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('company_diary/load_comment')."/".$dataaa[0]->CompanyID; ?>" aria-controls="diary" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Diary & Comments</span></a></li>
                            </ul>
                                
                            <br>

        
                <form data-toggle="validator" method="post" id="pur_coc">
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
                    <input type="text" name="total" id="total" value="<?php echo $res['NoCOCpurchases']; ?>"
class="form-control" readonly="readonly">
                    <!-- <span class="help-block"> This is inline help </span> --> 
                   
                </div>
                </div>

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
                        <input id="rad" name="rad" type="radio" class="form-control" value="1">
                        <label>Electronic</label>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Number of COC's You wish to Purchase</label>
                    <input type="number" name="no_coc" id="no_coc" value="" class="form-control" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Cost of COC Type</label>
                    <input type="text" name="cost" id="cost" value="<?php echo $amou['Amount']; ?>" class="form-control" readonly="readonly">
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Cost of Delivery</label>
                    <input type="text" name="delivery" id="delivery" value="1001" class="form-control" readonly="readonly">
                    <!-- <span class="help-block"> This is inline help </span> --> 
                   
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">VAT @15%</label>
                    <input type="text" name="vat" id="vat" value="" class="form-control" readonly="readonly">
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Total Due</label>
                    <input type="text" name="due" id="due" value="" class="form-control" readonly="readonly">
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    
                </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label disclai">Disclaimer :</label>
                    <input type="checkbox" name="discl" id="discl" value="" required>
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
                                                            <button type="submit" id="purchase" class="btn btn-success btn-rounded btn-sm waves-effect waves-light m-r-10">Purchase</button>

                                                            <button type="submit" class="btn btn-inverse btn-rounded btn-sm waves-effect waves-light" onclick="location.href='<?php echo base_url();?>get_company/view'">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        
                       </div>
                    
										<?php echo form_close(); ?>
                
            
    </div>
            </div> 
            </div>

            <script type="text/javascript">
            	$('.alert, .alert-success').delay('3000').fadeOut(300);
                    
                        $(document).ready(function(){

                            // var $submit = $("#purchase").hide(),
                            // $cbs = $('input[name="discl"]').click(function() {
                            //     $submit.toggle( $cbs.is(":checked") );
                            // });



                        	$('#no_coc').on('keyup change', function(){
                        		calc();
                        		calcs();
                        		cal();
                                delivcal();
                                match();
                        	});

                        
        

function match() {
  var txt1 = $('#permitted').val();
  var txt2 = $('#no_coc').val();
  
  if (txt1 >= txt2)
  {
     // alert('Matching!');
     return true;
  }
  else
  {
    alert('Not matching!');
    return false;
  }
}

});



function calc(){
	
	var tot = $('#no_coc').val();

    var ggf = $('#cost').attr('value') * tot;

	$('#cost').val(ggf);
}  

function delivcal(){
    
    var ott = $('#delivery').val();

    
}
 
function calcs()
{
	
	var tott = $('#cost').val();

	var vat_value = ((tott * 15)/100);

	$('#vat').val(vat_value);
} 	
 		    

function cal()
{
	
	var tott = $('#cost').val();
	var ott = $('#delivery').val();
	var ttto = $('#vat').val();

		    var grand_total = (parseFloat(tott)+parseFloat(ott)+parseFloat(ttto)).toFixed(1);
		  
		    $('#due').val(grand_total);
		 
}    

</script>


            	
               
            
        
