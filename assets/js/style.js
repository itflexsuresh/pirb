$(document).ready(function(){
    $('.main_menu_read').click(function(){
        ths_val = $(this).val();
        if($(this).prop("checked") == true){
            $('.sub_menu_read.'+ths_val).prop('checked',true);
        } else {
        	$('.sub_menu_read.'+ths_val).prop('checked',false);
        }
    });
        $('.main_menu').click(function(){
        ths_val = $(this).val();
        if($(this).prop("checked") == true){
        	$('.sub_menu_read.'+ths_val).prop('checked',true);
        	$('.main_menu_read.'+ths_val).prop('checked',true);
            $('.sub_menu.'+ths_val).prop('checked',true);
        } else {
        	//$('.sub_menu_read.'+ths_val).prop('checked',false);
        	$('.sub_menu.'+ths_val).prop('checked',false);
        }

    });
});