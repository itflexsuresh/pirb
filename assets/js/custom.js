function datatables(selector, options={}){
	$(selector).DataTable({
		"searching"		: (options.search && options.search=='0') ? false : true,
		"lengthChange"	: (options.length && options.length=='0') ? false : true
	});
}

function ajaxdatatables(selector, options={}){
	if(options.destroy && options.destroy==1){
		$(selector).DataTable().destroy();
	}
	
	$(selector).DataTable({
		'processing'	: 	true,
		'serverSide'	: 	true,
		'ajax'			: 	{
								'url' 		: 	options.url,
								'data'		: 	(options.data) ? options.data : {},
								'dataType'	: 	'json',
								'type'		: 	(options.method) ? options.method : 'post',
								'complete'	: 	function(){
													tooltip();
												}
								
							},
		'columns'		: 	options.columns
	});
}


/** Jquery Validation **/

function validation(selector, rules, messages, extras=[])
{
	var validation = {};
	
	validation['rules'] 			= 	rules;
	validation['messages'] 			=	messages;
	validation['errorElement'] 		= 	(extras['errorElement']) ? extras['errorElement'] : 'p';
	validation['errorClass'] 		= 	(extras['errorClass']) ? extras['errorClass'] : 'error_class_1';
	validation['ignore'] 			= 	(extras['ignore']) ? extras['ignore'] : ':hidden';
	validation['errorPlacement']	= 	function(error, element) {
											error.insertAfter(element);
										}
										
	var validator = $(selector).validate(validation);
}

function select2(selector){
	$(selector).select2();
}

function tooltip(){
	$('[data-toggle="tooltip"]').tooltip(); 
}

function sweetalert(action, data){
	Swal.fire({
		title: 'Are you sure?',
		text: "You want to proceed?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes',
		cancelButtonText:'No'
	}).then((result) => {
		if (result.value) {
			formsubmit(action, data)
		}
	})
}

function datepicker(selector, extras=[]){
	var options = {};	
	options['format'] = 'dd-mm-yyyy';
	options['autoclose'] = true;
	if($.inArray('currentdate', extras) != -1) options['startDate'] = new Date();
	
	$(selector).datepicker(options);
}

function formsubmit(action, data){
	$('<form action="'+action+'" method="post">'+data+'</form>').appendTo('body').submit();
}

function ajax(url, data, method, type="post", datatype="json", contenttype='', processdata=''){
	var options = {};
	
	options['url'] 			= 	url;
	options['type'] 		=	type;
	options['data'] 		=	data;
	options['dataType'] 	=	datatype;
	if(contenttype!='') options['contentType'] 	=	false;
	if(processdata!='') options['processData'] 	=	false;
	options['success'] 		=	function(data){ 
									method(data);
								}
		
	$.ajax(options);
}

function formatdate(date, type){
	var date = new Date(date)
	if(type==1)	return ('0' + date.getDate()).slice(-2)+"-"+('0' + (date.getMonth()+1)).slice(-2)+ "-" +date.getFullYear();
}

function fileupload(data1=[], data2=[]){
	
	var selector 	= data1[1];
	var extension 	= data1[3] ? data1[3] : ['jpg','jpeg','png'];
	
	$(document).on('change', selector, function(){
		var name 		= $(this).val();
		var ext 		= name.split('.').pop().toLowerCase();
		
		if($.inArray(ext, extension) !== -1){
			var form_data 	= new FormData();
			form_data.append("file", $(selector)[0].files[0]);
			form_data.append("path", data1[2]);
			form_data.append("type", extension.join('|'));
			
			ajax(data1[0], form_data, fileappend, 'post', 'json', '1', '1');
		}else{
			$(selector).val('');
			alert('Supported file format are '+extension.join(','));
		}
	})
	
	function fileappend(data){
		if(data.file_name && data2.length){
			var file 		= data.file_name;
			$(data2[0]).val(file);
			
			if(data2[1] && data2[2]){
				var ext 		= data.file_name.split('.').pop().toLowerCase();
				
				if(ext=='jpg' || ext=='jpeg' || ext=='png'){
					$(data2[1]).attr('src', data2[2]+'/'+file);
				}else if(ext=='pdf'){
					$(data2[1]).attr('src', data2[2]);
				}
			}
		}
		
		$(selector).val('');
	}
}