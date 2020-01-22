$(function(){


    $('.alert, .alert-success').delay('3000').fadeOut(300);

    site_url = $('#site_url').val();    
    $('.name').change(function(){
        name_combine = '';
        
        
        name_val = $('#Name').val();
        surname_val = $('#Surname').val();
        name_combine = name_val+' '+surname_val;
        $('#DeclarationName').val(name_combine);
        $('.dropify').attr('required',1);
    });

    $('#IDNumber').change(function(){
        ths_val = $(this).val();
        $('#DeclarationIDNumber').val(ths_val);
    });
    
    
    $('.ajax_change').on('change',function(){
        ths_val = $(this).val();
        ths_field = $(this).attr('field');
        ths_change_field = $(this).attr('change');
        ths_in_change_field = $(this).attr('in-change');
        ajax_url = site_url+'ajax/get_data';
        action = 'get_';

        inner_change_field = '';

        if(ths_field=='province'){
            change_field = 'city';
            inner_change_field = 'area';
        } else if(ths_field=='city'){
            change_field = 'area';
        }

        action += change_field;
        
        if (typeof ths_change_field !== typeof undefined && ths_change_field !== false && ths_change_field !== '') {
            change_field = ths_change_field;
            inner_change_field = ths_in_change_field;
        }
        
        
        $.ajax({
            url:ajax_url,
            data:{'action':action,'id':ths_val,},
            async: false,
            success: function (res) {  
                $('.'+change_field+' option').not(":first").remove();
                if(inner_change_field!=''){
                    $('.'+inner_change_field+' option').not(":first").remove();
                }
                var json_data = $.parseJSON(res);
                
                $(json_data).each(function (i,data) {

                    $('.'+change_field+' option:last-child').after('<option value="'+data.id+'">'+data.val+'</option>');
                }); 
            }
        });
    });
    

    $('#EmploymentStatus').on('change',function(){
        $('#CompanyID').val('');
        ths_val = $(this).val();
        if(ths_val==1){
            $('.company_list').attr('show',1);
        } else {
            $('.company_list').attr('show',0);
             $('.company_add').attr('show',0);
        }

    });

    $('#CompanyID').on('change',function(){
        ths_val = $(this).val();
        if(ths_val!='' && ths_val==0){
            $('.company_add').attr('show',1);
        } else {
            $('.company_add').attr('show',0);
        }
    });

    $('#ddlSouthAfrNationanl').on('change',function(){
        ths_val = $(this).val();
        if(ths_val>0){
            $('.other_nation').attr('show',0);
        } else {
            $('.other_nation').attr('show',1);
        }
    });


    $('form#plumber-register').validator().on('submit', function(e) {
            $('.error').text('');
            if (e.isDefaultPrevented()) {
            	i = 1;
            	$('.top_box .with-errors ul.list-unstyled').each(function(){
            		if(i==1){
            			$('html, body').animate({
				            scrollTop: $(this).parents('.form-group').offset().top
				        }, 1000);
        			}
        			i++;
		        });
            } else {
            err = $('form#plumber-register').validator().data('bs.validator').hasErrors();
            if(err==false){                                
                ajax_submit = $('form#plumber-register').attr('ajax_submit');
                if(ajax_submit==0){
                    e.preventDefault();
                    exists_check();
                }
            } 
          }
    })

    $('form#plumber-update').validator().on('submit', function(e) {

            $('.error').text('');
            if (e.isDefaultPrevented()) {
            	console.log(1);
            	i = 1;
            	$('.top_box .with-errors ul.list-unstyled').each(function(){
            		if(i==1){
            			$('html, body').animate({
				            scrollTop: $(this).offset().top
				        }, 1000);
        			}
        			i++;
		        });
            } else {
            err = $('form#plumber-update').validator().data('bs.validator').hasErrors();

            if(err==false){                                
                ajax_submit = $('form#plumber-update').attr('ajax_submit');
                if(ajax_submit==0){
                    e.preventDefault();
                    exists_check_update();
                }
            } else {
				console.log(2);
            } 		
          }
    });

});

function exists_check(){
    err = 0;
    field_cnt = 0;
    field_len = $('.exists_check:visible').length;
    first_err = 0;
    $('.exists_check:visible').each(function(){
        field_cnt++;
        ths = $(this);
        table = $(this).attr('table');
        field = $(this).attr('field');
        value = $(this).val();
        
        if(value!=''){
            ajax_url = site_url+'ajax/exists';
            $.ajax({
                url:ajax_url,
                //method:'POST',
                data:{'table':table,'field':field,'value':value,},
                async: false,
                success: function (res) {  
                    if(res==1){                        
                        ths.parent('div').find('.error').text('This value already exists');
                        if(first_err == 0){
	                        $('html, body').animate({
					            scrollTop: ths.parent('div').find('.error').parents('.form-group').offset().top
					        }, 1000);
				        }
				        first_err = 1;
                        err++;                        
                    }
                    else if(field_len==field_cnt && err==0) {
                        // $('form#plumber-register').removeAttr('data-toggle');
                        // $('form#plumber-register').removeAttr('novalidate');
                        
                        $('form#plumber-register').attr('ajax_submit',1);
                        $('form#plumber-register').submit();
                        //  $('#Submit').trigger('click');
                    }
                }
            });      
        }
    });
}

function exists_check_update(){
    err = 0;
    field_cnt = 0;
    field_len = $('.exists_check:visible').length;
    pk_val = $('.pk_val').val();
    $('.exists_check:visible').each(function(){
        
        ths = $(this);
        table = $(this).attr('table');
        field = $(this).attr('field');
        value = $(this).val();

        field_cnt++;
        
        if(value!=''){

            ajax_url = site_url+'ajax/exists_update';
            $.ajax({
                url:ajax_url,
                //method:'POST',
                data:{'table':table,'field':field,'value':value,'pk':'UserID','pk_val':pk_val},
                async: false,
                success: function (res) {  
                    if(res==1){                        
                        ths.parent('div').find('.error').text('This value already exists');
                        err++;                        
                    }
                    else if(field_len==field_cnt && err==0) {
                        // $('form#plumber-register').removeAttr('data-toggle');
                        // $('form#plumber-register').removeAttr('novalidate');
                        
                        $('form#plumber-update').attr('ajax_submit',1);
                        $('form#plumber-update').submit();
                        //  $('#Submit').trigger('click');
                    }
                }
            });      
        } else {
        	if(field_len==field_cnt && err==0) {                
                $('form#plumber-update').attr('ajax_submit',1);
                $('form#plumber-update').submit();
            }
        }
    });

}