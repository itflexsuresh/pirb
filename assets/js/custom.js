function baseurl(){
	var base = window.location;

	if(base.host=='localhost'){
		return base.protocol + "//" + base.host + "/nantha/pirb/";
	}else{
		return base.protocol + "//" + base.host + "/auditit_new/pirb/";
	}
}


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
	
	var order = (options.order) ? options.order : [[0, 'asc']];
	
	var columndefs 		= [];
	var columndefsobj 	= {};
	if(options.target) 	columndefsobj['targets'] 	= options.target;
	if(options.sort) 	columndefsobj['orderable'] 	= (options.sort=='1') ? true : false;
	columndefs.push(columndefsobj);
		
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
		'columns'		: 	options.columns,
		'order'			: 	order,
		'columnDefs'	: 	columndefs,
		'searching'		: 	(options.search && options.search=='0') ? false : true,
		'lengthMenu'	: 	(options.lengthmenu && options.lengthmenu.length > 0) ? options.lengthmenu : [10, 25, 50, 100]
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
											if(element.attr('data-date') == 'datepicker'){
												$(element).parent().parent().append(error);
											}else if(element.attr('data-checkbox') == 'checkbox1'){
												$(element).parent().append(error);
											}else if(element.attr('data-radio') == 'radio1'){
												$(element).parent().append(error);
											}else if(element.attr('data-select') == 'select2'){
												$(element).parent().append(error);
											}else if(element.attr('data-textbox') == 'textbox1'){
												$(element).parent().append(error);
											}else{
												error.insertAfter(element);
											}
										}
	var validator = $(selector).validate(validation);						
	if(extras['callback']){
		return validator;
	}
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

function sweetalertautoclose(title, html='', timer=''){
	let timerInterval;
	Swal.fire({
		title: title,
		timer: (timer=='') ? 1000 : timer,
		timerProgressBar: true,
		onBeforeOpen: () => {
			Swal.showLoading();
		},
		onClose: () => {
			clearInterval(timerInterval);
		}
	}).then((result) => {})
}

function datepicker(selector, extras=[]){
	var options = {};	
	options['format'] = 'dd-mm-yyyy';
	options['autoclose'] = true;
	if($.inArray('currentdate', extras) != -1) options['startDate'] = new Date();
	if($.inArray('enddate', extras) != -1) options['endDate'] = new Date();
	if($.inArray('pastfivedate', extras) != -1){
		var pastfivedate = new Date();
		pastfivedate.setDate(pastfivedate.getDate() - 5)
		options['startDate'] = pastfivedate;
	}

	$(selector).datepicker(options).on('keypress paste', function(e){
		e.preventDefault();
		return false;
	});
}

function formsubmit(action, data){
	$('<form action="'+action+'" method="post">'+data+'</form>').appendTo('body').submit();
}

function ajax(url, data, method, extras=[]){
	var options = {};
	
	options['url'] 			= 	url;
	options['type'] 		=	(extras['type']) ? extras['type'] : 'post';
	options['data'] 		=	data;
	options['dataType'] 	=	(extras['datatype']) ? extras['datatype'] : 'json';
	
	if(extras['contenttype']) 	options['contentType'] 	=	false;
	if(extras['processdata']) 	options['processData'] 	=	false;
	if(extras['asynchronous']) 	options['async'] 		=	false;
	if(extras['beforesend'])	options['beforeSend'] 	=	extras['beforesend'];
	if(extras['complete']) 		options['complete'] 	=	extras['complete'];
	
	if(extras['success']){
 		options['success'] 		=	extras['success'];
	}else{
		options['success'] 		=	function(data){ 
										method(data);
									}
	}	
	
	$.ajax(options);
}

function formatdate(date, type){
	var date = new Date(date)
	if(type==1)				return ('0' + date.getDate()).slice(-2)+"-"+('0' + (date.getMonth()+1)).slice(-2)+ "-" +date.getFullYear();
	else if(type==2)		return date.getFullYear()+"/"+('0' + (date.getMonth()+1)).slice(-2)+ "/" +('0' + date.getDate()).slice(-2);
	else if(type==3)		return ('0' + date.getDate()).slice(-2)+"-"+('0' + (date.getMonth()+1)).slice(-2)+ "-" +date.getFullYear()+' '+('0' + date.getHours()).slice(-2)+':'+('0' + date.getMinutes()).slice(-2)+':'+('0' + date.getSeconds()).slice(-2);
}

function numberonly(selector){
	$(selector).keyup(function(){
		if (/\D/g.test(this.value))
		{
			this.value = this.value.replace(/\D/g, '');
		}
	})
}

function inputmask(selector, type=''){
	
	if(type==1) $(selector).inputmask("(999) 999-9999")
}

function editor(selector, validation='', height=300){
	tinymce.init({
		selector	: 	selector,
		height		: 	height,
		menubar		:	false,
		statusbar	: 	false,
		plugins		: 	'hr textcolor table code preview',
		toolbar1	: 	'formatselect | bold italic underline strikethrough superscript subscript hr | forecolor backcolor | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | table | preview code',
		content_css	: 	[
							'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
							'//www.tinymce.com/css/codepen.min.css'
						],
		setup		: 	function(editor){
							
						}
	});
}

function fileupload(data1=[], data2=[], multiple='', customfunction=''){
	var ajaxurl 	= baseurl()+"ajax/index/ajaxfileupload";
	
	var selector 	= data1[0];
	var extension = data1[2] ? data1[2] : ['jpg','jpeg','png'];
	
	$(document).on('change', selector, function(){
		var name 		= $(this).val();
		var ext 		= name.split('.').pop().toLowerCase();
		
		if($.inArray(ext, extension) !== -1){
			var form_data 	= new FormData();
			form_data.append("file", $(selector)[0].files[0]);
			form_data.append("path", data1[1]);
			form_data.append("type", extension.join('|'));
			
			ajax(ajaxurl, form_data, fileappend, { contenttype : 1, processdata : 1});
		}else{
			$(selector).val('');
			alert('Supported file format are '+extension.join(','));
		}
	})
	
	function fileappend(data){
		if((data.file_name && data2.length) || (data.file_name && customfunction!='')){
			var file 		= data.file_name;
			
			if(customfunction!=''){
				customfunction(file);
			}else{
				if(data2[1] && data2[2]){
					var ext = data.file_name.split('.').pop().toLowerCase();
					
					if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='tif' || ext=='tiff'){
						var filesrc = data2[2]+'/'+file;
					}else if(ext=='pdf'){
						var filesrc = data2[3];
					}
				}
				
				if(multiple==''){
					$(data2[0]).val(file);
					
					if(filesrc){
						$(data2[1]).attr('src', filesrc);
					}				
				}else{
					if(filesrc){
						$(data2[1]).append('<div class="multipleupload"><input type="hidden" value="'+file+'" name="'+data2[0]+'"><img src="'+filesrc+'" width="100"><i class="fa fa-times"></i></div>');
					}
				}
			}
		}
		
		$(selector).val('');
		if (typeof installationdefaultimage !== 'undefined' && $.isFunction(installationdefaultimage)) installationdefaultimage();
	}
	
	$(document).on('click', '.multipleupload i', function(){
		$(this).parent().remove();
		if (typeof installationdefaultimage !== 'undefined' && $.isFunction(installationdefaultimage)) installationdefaultimage();
	})
}

function citysuburb(data1=[], data2=[], data3=[]){
	var cityurl 			= baseurl()+"ajax/index/ajaxcity";
	var suburburl 			= baseurl()+"ajax/index/ajaxsuburb";
	var cityactionurl 		= baseurl()+"ajax/index/ajaxcityaction";
	var suburbactionurl 	= baseurl()+"ajax/index/ajaxsuburbaction";
	
	var cityappend		= (data1[1]) ? data1[1].substr(1)+'append' : '';
	var suburbappend	= (data1[2]) ? data1[2].substr(1)+'append' : '';
	
	var citydata 		= { provinceid : $(data1[0]).val() };
	
	ajax(cityurl, citydata, city)

	$(document).on('change', data1[0], function(){
		citydata.provinceid = $(this).val();
		ajax(cityurl, citydata, city)
	})

	function city(data){
		$('.'+cityappend).remove();

		if(data.status=='1'){
			var append = [];
			$(data.result).each(function(i, v){
				var selected = (data2[0] && data2[0]==v.id) ? 'selected="selected"' : '';
				append.push('<option value="'+v.id+'" '+selected+' class="'+cityappend+'">'+v.name+'</option>');
			})

			$(data1[1]).append(append);
			
			var suburbdata  = { provinceid : $(data1[0]).val(), cityid : $(data1[1]).val() };
			if(data1[2]) ajax(suburburl, suburbdata, suburb);
		}
	}

	if(data1[2]){
		$(document).on('change', data1[1], function(){
			var suburbdata  = { provinceid : $(data1[0]).val(), cityid : $(this).val() };
			ajax(suburburl, suburbdata, suburb);
		})

		function suburb(data){
			$('.'+suburbappend).remove();

			if(data.status=='1'){
				var append = [];
				$(data.result).each(function(i, v){
					var selected = (data2[1] && data2[1]==v.id) ? 'selected="selected"' : '';
					append.push('<option value="'+v.id+'" '+selected+' class="'+suburbappend+'">'+v.name+'</option>');
				})

				$(data1[2]).append(append);
			}
		}
	}
	
	if(data3.length > 0){
		$(data3[0]).click(function(){
			$(this).parent().find('input').val('');
			$(this).parent().find('.addcity_wrapper').removeClass('displaynone');
			$(this).hide().after('<a href="javascript:void(0);" class="addcityremove">Hide</a>');
		})
		
		$(document).on('click', data3[1], function(){
			var inputfieldwrapper = $(this).parent().parent();
			
			inputfieldwrapper.parent().find('.tagline').remove();
			
			if($(data1[0]).val()==''){
				inputfieldwrapper.after('<p class="tagline">Please select province.</p>');
				return false;
			}
			
			if(inputfieldwrapper.find('input').val()==''){
				inputfieldwrapper.after('<p class="tagline">Please fill the input field.</p>');
				return false;
			}
			
			if(validation==0){
				return false;
			}
			
			ajax(cityactionurl, { id :'', province : $(data1[0]).val(), city1 : inputfieldwrapper.find('input').val() }, cityaction)
		})
		
		$(document).on('click', '.addcityremove', function(){			
			$(this).remove();
			$(data3[0]).parent().find('.addcity_wrapper').addClass('displaynone');
			$(data3[0]).show();
		})
		
		function cityaction(data){
			if(data.status==1){
				var addcityid 	= data.result.id;
				var addcityname = data.result.name;
				
				$(data1[1]).append('<option value="'+addcityid+'" class="'+cityappend+'">'+addcityname+'</option>');
				$(data1[1]).val(addcityid);
				
				$(data3[0]).show();
				$(data3[0]).parent().find('.addcity_wrapper').addClass('displaynone');
				$(data3[0]).parent().find('.addcityremove').remove();
			}else if(data.status==2){
				$(data3[0]).parent().append('<p class="tagline">City Already Exists.</p>');
			}
		}
		
		$(data3[2]).click(function(){
			$(this).parent().find('input').val('');
			$(this).parent().find('.addsuburb_wrapper').removeClass('displaynone');
			$(this).hide().after('<a href="javascript:void(0);" class="addsuburbremove">Hide</a>');
		})
		
		$(document).on('click', data3[3], function(){
			var inputfieldwrapper = $(this).parent().parent();
			
			inputfieldwrapper.parent().find('.tagline').remove();
			
			if($(data1[0]).val()==''){
				inputfieldwrapper.after('<p class="tagline">Please select province.</p>');
				return false;
			}
			
			if($(data1[1]).val()==''){
				inputfieldwrapper.after('<p class="tagline">Please select city.</p>');
				return false;
			}
			
			if(inputfieldwrapper.find('input').val()==''){
				inputfieldwrapper.after('<p class="tagline">Please fill the input field.</p>');
				return false;
			}
			
			ajax(suburbactionurl, { id :'', province : $(data1[0]).val(), city : $(data1[1]).val(), suburb : inputfieldwrapper.find('input').val(), status : '1' }, suburbaction)
		})
		
		$(document).on('click', '.addsuburbremove', function(){		
			$(this).remove();	
			$(data3[2]).parent().find('.addsuburb_wrapper').addClass('displaynone');
			$(data3[2]).show();
		})
		
		function suburbaction(data){
			if(data.status==1){
				var addsuburbid 	= data.result.id;
				var addsuburbname 	= data.result.name;
				
				$(data1[2]).append('<option value="'+addsuburbid+'" class="'+suburbappend+'">'+addsuburbname+'</option>');
				$(data1[2]).val(addsuburbid);
			
				$(data3[2]).show();
				$(data3[2]).parent().find('.addsuburb_wrapper').addClass('displaynone');
				$(data3[2]).parent().find('.addsuburbremove').remove();
			}else if(data.status==2){
				$(data3[2]).parent().append('<p class="tagline">Suburb Already Exists.</p>');
			}
		}
	}
}

function subtypereportinglist(data1=[], data2=[], customfunction=''){
	var subtypeurl 				= baseurl()+"ajax/index/ajaxsubtype";
	var reportlistingurl 		= baseurl()+"ajax/index/ajaxreportlisting";
	
	$('.subtypeappend').remove();
	$('.reportlistingappend').remove();
	
	var subtypedata 			= { installationtypeid : $(data1[0]).val() };
	
	ajax(subtypeurl, subtypedata, subtypefn)

	$(document).on('change', data1[0], function(){		
		$('.subtypeappend').remove();
		$('.reportlistingappend').remove();
		
		subtypedata.installationtypeid = $(this).val();
		ajax(subtypeurl, subtypedata, subtypefn)
		if(customfunction!='') customfunction();
	})

	function subtypefn(data){
		$('.subtypeappend').remove();

		if(data.status=='1'){
			var append = [];
			$(data.result).each(function(i, v){
				var selected = (data2[0] && data2[0]==v.id) ? 'selected="selected"' : '';
				append.push('<option value="'+v.id+'" '+selected+' class="subtypeappend">'+v.name+'</option>');
			})

			$(data1[1]).append(append);
			
			var reportlistingdata  = { installationtypeid : $(data1[0]).val(), subtypeid : $(data1[1]).val() };
			if(data1[2]) ajax(reportlistingurl, reportlistingdata, reportlistingfn);
		}
	}
	
	if(data1[2]){
		$(document).on('change', data1[1], function(){
			$('.reportlistingappend').remove();
		
			var reportlistingdata  = { installationtypeid : $(data1[0]).val(), subtypeid : $(this).val() };
			ajax(reportlistingurl, reportlistingdata, reportlistingfn);
			if(customfunction!='') customfunction();
		})

		function reportlistingfn(data){
			$('.reportlistingappend').remove();

			if(data.status=='1'){
				var append = [];
				$(data.result).each(function(i, v){
					var selected = (data2[1] && data2[1]==v.id) ? 'selected="selected"' : '';
					append.push('<option value="'+v.id+'" '+selected+' class="reportlistingappend" data-reference="'+v.regulation+'" data-link="'+v.knowledge_link+'" data-comments="'+v.comments+'" data-compliment="'+v.compliment+'"  data-cautionary="'+v.cautionary+'" data-refixcomplete="'+v.refix_complete+'"  data-refixincomplete="'+v.refix_incomplete+'">'+v.statement+'</option>');
				})

				$(data1[2]).append(append);
			}
		}
		
		$(document).on('change', data1[2], function(){
			if(customfunction!='') customfunction();
		})
	}
	
	if(customfunction!='') customfunction();
}

function localstorage(type, name, value){
	if(type=='set'){
		localStorage.setItem(name, value);
	}else if(type=='get'){
		return localStorage.getItem(name);
	}else if(type=='remove'){
		localStorage.removeItem(name);
	}
}

function userautocomplete(data1=[], data2=[], customfunction='', customappend=''){
	var userurl 		= baseurl()+"ajax/index/ajaxuserautocomplete";
	var appendclass 	= (data1[0]) ? data1[0].substring(1) : '';
	
	var postdata = {};
	if(data2[2]) postdata 		= data2[2];
	postdata['search_keyword'] 	= data2[0];
	postdata['type'] 			= data2[1];
	
	if(customappend==''){
		ajax(userurl, postdata, user_search_result);
		
		function user_search_result(data)
		{
			var result = [];
			
			$(data).each(function(i, v){
				var id 				= (v.id) ? 'data-id="'+v.id+'"' : '';
				var name 			= (v.name) ? 'data-name="'+v.name+'"' : '';
				var count 			= (v.count) ? 'data-count="'+v.count+'"' : '';
				var electronic 		= (v.coc_electronic) ? 'data-electronic="'+v.coc_electronic+'"' : '';
				
				var openaudit 		= (v.openaudit) ? 'data-openaudit="'+v.openaudit+'"' : '';
				var mtd 			= (v.mtd) ? 'data-mtd="'+v.mtd+'"' : '';
				var allowedaudit 	= (v.allowedaudit) ? 'data-allowedaudit="'+v.allowedaudit+'"' : '';
				
				result.push('<li '+openaudit+' '+mtd+' '+allowedaudit+' '+id+' '+name+' '+count+' '+electronic+' class="autocompletelist'+appendclass+'">'+v.name+'</li>');
			})
			
			var append = '<ul class="autocomplete_list">'+result.join('')+'</ul>';
			$(data1[2]).html('').removeClass('displaynone').html(append);
		}
		
		$(document).on('click', '.autocompletelist'+appendclass, function(){
			var id 				= $(this).attr('data-id');
			var name 			= $(this).attr('data-name');
			var count 			= $(this).attr('data-count');
			var electronic 		= $(this).attr('data-electronic');
			
			var openaudit 		= $(this).attr('data-openaudit');
			var mtd 			= $(this).attr('data-mtd');
			var allowedaudit 	= $(this).attr('data-allowedaudit');
			
			$(data1[0]).val(name);
			$(data1[1]).val(id);
			$(data1[2]).html('');
			
			if(customfunction!='' && !$(this).attr('data-allowedaudit')) customfunction(name, id, count, electronic);
			else if(customfunction!='' && $(this).attr('data-allowedaudit')) customfunction($(data1[0]), openaudit, mtd, allowedaudit);
		})
	}else{
		var result = [];
		
		ajax(userurl, postdata, '', {
			asynchronous : 1,
			success : function(data){
				result.push(data);
			}
		});
		
		return result;
	}
}

function chat(data1=[], data2=[], data3=[], relationship=''){
	chatcontent({'cocid' : data2[0], 'checkfrom' : data2[1] }, 'initial');
	
	var seperatechat = null;
	
	$('#seperatechat').click(function(){
		if($(this).attr('data-url')!=''){
			seperatechat = window.open($(this).attr('data-url'), "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
		}
	})
	
	if(relationship=='childparent' || relationship=='parentchild'){
		chatcontent({'cocid' : data2[0], 'id' : data2[3] });
		return false;
	}
	
	var audioselector = document.getElementById('beeepaudio');
	chatcontent({'cocid' : data2[0], 'fromto' : data2[1] });
	startunread();
	
	$(data1[0]).keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		
		if(keycode == '13' && event.shiftKey){
			$(this).val($(this).val());
		}else if(keycode == '13'){	
			if($.trim($(this).val())=='') $(this).val($(this).val().replace(/\r?\n/gi, ''));
			
			if($.trim($(this).val())!=''){
				var data = 	{
					'cocid' 		: data2[0], 
					'fromid' 		: data2[1],
					'toid' 			: data2[2],
					'message' 		: $(this).val(),
					'state1' 		: '0',
					'type' 			: '1'
				}
				
				if($(document).find('.quote').length && $(document).find('.quote').val()!='') data['quote'] = $('.quote').val();
				if($(document).find('.quoteattachment').length && $(document).find('.quoteattachment').val()!='') data['quoteattachment'] = $('.quoteattachment').val();
				
				var chatid = chataction(data);
				chatcontent({'cocid' : data2[0], 'checkfrom' : data2[1] }, 'checkfrom');
				$(data1[0]).val('');
				$(document).find('.chatquote').remove();
				
				if(relationship=='child') window.opener.postMessage('id-'+chatid, "*");
				if(seperatechat!=null) seperatechat.postMessage('id-'+chatid, "*");
			}
		}		
		
	});
	
	function chatcontent(param, state=''){
		ajax(
			baseurl()+'ajax/index/ajaxchat', 
			param, 
			'', 
			{ 
				success : function(data){ 
					if(data.status=='1'){
						var chatdata 	= [];
						var result 		= data.result;
						var sound		= '0';
						
						$(result).each(function(i,v){
							if(state=='initial'){
								chataction({'id' : v.id, 'state1' : '1'});
							}else{
								sound = '1';
								
								// Start Options
								var options = 	'<div class="chatbar_options">\
													<i class="fa fa-chevron-down"></i>\
													<div class="displaynone">';
								if(data2[1]==v.from_id){
									options +=			'<p><a href="javascript:void(0);" class="chatbar_delete" data-id="'+v.id+'">Delete</a></p>';
								}
								options 	+=			'<p><a href="javascript:void(0);" class="chatbar_quote" data-id="'+v.id+'">Quote</a></p>\
													</div>\
												</div>';
								
								var quote = '';
								
								if(v.quote!=''){
									var quote = '<div class="chatbar_quotes">"'+v.quote+'"</div>';
								}
								
								if(v.quoteattachment!=''){
									var ext = v.quoteattachment.split('.').pop().toLowerCase();
									if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='tif' || ext=='tiff'){
										var filesrc = data3[0]+'/'+v.quoteattachment;
									}else if(ext=='pdf'){
										var filesrc = data3[1];
									}
									var quote = '<div class="chatbar_quotes"><img src="'+filesrc+'" width="100"></div>';
								}
								// End Options
								
								var chatappend = '<div class="chatbar_section"><div class="chatbar_wrapper '+((v.from_id!=data2[1]) ? 'chatbar_wrapper_right' : '')+'"><p class="chatbar_user">'+v.name+'  '+formatdate(v.created_at, 3)+'</p>';							
								if(v.type=='2'){
									var ext = v.attachment.split('.').pop().toLowerCase();
									if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='tif' || ext=='tiff'){
										var filesrc = data3[0]+'/'+v.attachment;
									}else if(ext=='pdf'){
										var filesrc = data3[1];
									}
									
									chatappend += '<div class="chatfile">'+options+'<a href="'+data3[0]+'/'+v.attachment+'" target="_blank"><img src="'+filesrc+'" data-img="'+v.attachment+'" width="100" class="chatattachmentimage"></a><a href="'+downloadurl+'/'+data2[0]+'/'+v.attachment+'" class="chatattachmentdownload"><i class="fa fa-download"></i></a></div>';
								}else{									
									chatappend += '<div class="chatbar">'+quote+'<p class="chatbar_message">'+v.message+'</p>'+options+'<div class="clear"></div></div>';
								}	
								
								if(v.from_id!=data2[1]) chatappend += '<div class="clear"></div>';
									
								chatappend += '</div></div>';
								
								chatdata.push(chatappend)
								
								if(state=='checkfrom') chataction({'id' : v.id, 'state1' : '1'});
								else if(state=='checkto') chataction({'id' : v.id, 'state2' : '1'});
							}
						})
						
						if(state!='initial'){
							$(data1[1]).append(chatdata.join(''));						
							if(sound=='1' && state=='checkto') audioselector.play();
							scrolltobottom(data1[1].substring(1));
						}
					}
				},
				asynchronous : 1
			}
		);
	}
	
	function chataction(param){
		var result = '';
		ajax(baseurl()+'ajax/index/ajaxchataction', param, '', { success : function(data){ if(data.status=='1'){ result = data.result.id; } }, asynchronous : 1 });
		return result;
	}
	
	// File Upload
	
	$('#chatattachment').click(function(){
		$('#chatattachmentfile').click();		
	})
	
	fileupload(["#chatattachmentfile", "./assets/uploads/chat/"+data2[0]+"/", ['jpg','gif','jpeg','png','pdf','tiff']], [], '', chatattachmentaction);
		
	function chatattachmentaction(file){
		var data = 	{
			'cocid' 		: data2[0], 
			'fromid' 		: data2[1],
			'toid' 			: data2[2],
			'attachment' 	: file,
			'state1' 		: '0',
			'type' 			: '2'
		}
		
		var chatid = chataction(data);
		chatcontent({'cocid' : data2[0], 'checkfrom' : data2[1] }, 'checkfrom');
		$('#chatattachmentfile').val('');
		
		if(relationship=='child') window.opener.postMessage('id-'+chatid, "*");
		if(seperatechat!=null) seperatechat.postMessage('id-'+chatid, "*");
	}
	
	// Timer
	
	function chatunread(){
		chatcontent({'cocid' : data2[0], 'checkto' : data2[1] }, 'checkto');
	}
	
	var unreadinterval;
	
	function startunread(){
		unreadinterval = setInterval(chatunread, 5000);
	}
	
	function stopunread(){
		clearInterval(unreadinterval);
	}
	
	$(document).on('click', '.chatbar_options i', function(){
		$(this).parent().find('div').toggleClass('displaynone');		
	})
	
	$(document).on('click', '.chatbar_delete', function(){
		var _this = $(this);
		ajax(baseurl()+'ajax/index/ajaxdelete', {id : _this.attr('data-id')}, '', { success : function(data){ if(data.status=='1'){ _this.parents('.chatbar_section').remove(); } }, asynchronous : 1 });	
	})
	
	$(document).on('click', '.chatbar_quote', function(){
		$(document).find('.chatquote').remove();
		$(document).find('.chatbar_options div').addClass('displaynone');
		
		var _this = $(this);
		
		if(_this.parents('.chatbar_section').find('.chatbar_message').length){
			var quotetext 	= '"'+_this.parents('.chatbar_section').find('.chatbar_message').text()+'"';
			var quoteval 	= _this.parents('.chatbar_section').find('.chatbar_message').text();
			var quotename 	= 'quote';
		}else{
			var quotetext 	= _this.parents('.chatbar_section').find('.chatattachmentimage').parent().html();
			var quoteval 	= _this.parents('.chatbar_section').find('.chatattachmentimage').attr('data-img');
			var quotename 	= 'quoteattachment';
		}
		
		var data = '<div class="chatquote">'+quotetext+'<input type="text" class="displaynone '+quotename+'" value="'+quoteval+'"><i class="fa fa-times"></i></div>';
		$('.chatfooter').prepend(data);
	})
	
	$(document).on('click', '.chatquote i', function(){
		$(this).parent().remove();
	})
}

function scrolltobottom(id){
	var div = document.getElementById(id);
	$('#' + id).animate({
		scrollTop: div.scrollHeight - div.clientHeight
	}, 500);
}

function knobchart(){
	$('[data-plugin="knob"]').knob();
}

function piechart(selector, options){
	var myChart = echarts.init(document.getElementById(selector));
	
	option = {
		tooltip : {
			trigger: 'item',
			formatter: "{a} <br/>{b} : {c} ({d}%)"
		},
		legend: {
			orient 	: 'vertical',
			x 		: 'left',
			data	: options['xaxis']
		},
		calculable : true,
		series : [
			{
				name		: 	options['name'],
				type		: 	'pie',
				radius 		: 	'55%',
				center		: 	['50%', '60%'],
				data		: 	options['yaxis'],
				itemStyle 	: 	{
									normal : {
										label : {
											formatter : function (params) {    
												return params.name+'\n'+(params.percent - 0).toFixed(0) + '%'
											}
										}
									}
								}
			}
		],
		color: options['colors']
	};
	
	myChart.setOption(option, true), $(function() {
		function resize() {
			setTimeout(function() {
				myChart.resize()
			}, 100)
		}
		$(window).on("resize", resize), $(".icon-menu").on("click", resize)
	});
}

function barchart(selector, options){
	var myChart = echarts.init(document.getElementById(selector));
	
	var series = [];
	$(options['series']).each(function(i, v){
		series.push({
			name		: 	v.name,
			type		: 	'bar',
			barMaxWidth	: 	60,
			itemStyle	: 	{
								normal: {
									color: function(params) {
										return (v.colors) ? v.colors[params.dataIndex] : v.color
									},
									label : {
										show: true, 
										position: 'top'
									}
								}
							},
			data		: 	v.yaxis
		})
	})
	
	option = {
		tooltip : {
			trigger: 'item'
		},
		calculable : true,
		grid: {
			borderWidth: 0
		},
		xAxis : [
			{
				type : 'category',
				data : 	options['xaxis'],
				splitLine: { show: false },
				axisLine: {show: false},	
				axisTick : {show: false},		
				axisLabel:{interval:0}			
			}
		],
		yAxis : [
			{
				type : 'value',
				axisLine: {show: false}
			}
		],
		series : series
	};
                    

	myChart.setOption(option, true), $(function() {
		function resize() {
			setTimeout(function() {
				myChart.resize()
			}, 100)
		}
		$(window).on("resize", resize), $(".icon-menu").on("click", resize)
	});
}

function barchart2(selector, options){
	var myChart = echarts.init(document.getElementById(selector));
	
	var series = [];
	$(options['series']).each(function(i, v){
		series.push({
			name		: 	v.name,
			type		: 	'bar',
			barMaxWidth	: 	60,
			itemStyle	: 	{
								normal: {
									color: function(params) {
										return (v.colors) ? v.colors[params.dataIndex] : v.color
									},
									label : {
										show: true, 
										position: 'top'
									}
								}
							},
			data		: 	v.yaxis
		})
	})
	
	option = {
		tooltip : {
			trigger: 'item'
		},
		calculable : true,
		grid: {
			borderWidth: 0,
			height :200,
			width:170
		},
		xAxis : [
			{
				type : 'category',
				data : 	options['xaxis'],
				splitLine: { show: false },
				axisLine: {show: false},	
				axisTick : {show: false},		
				axisLabel:{interval:0,rotate:-70}			
			}
		],
		yAxis : [
			{
				show: false
			}
		],
		series : series
	};
                    

	myChart.setOption(option, true), $(function() {
		function resize() {
			setTimeout(function() {
				myChart.resize()
			}, 100)
		}
		$(window).on("resize", resize), $(".icon-menu").on("click", resize)
	});
}

function linechart(selector, options){
	var linechart = echarts.init(document.getElementById(selector));
	
	var series = [];
	$(options['series']).each(function(i, v){
		var seriesoption = {
			name		:	v.name,
			type		:	'line',
			smooth		:	true,
			data		:	v.yaxis,
			symbolSize	:	v.symbol
		};
		
		if(i!=0) seriesoption['itemStyle'] = {normal: {areaStyle: {color: v.color, type: 'default'}}};
		
		series.push(seriesoption)
	})
	
	option = {	   
		tooltip : {
			trigger: 'item'
		},
		color: options['colors'],
		calculable : true,
		grid: {
			borderWidth: 0
		},	
		xAxis : [
			{
				type : 'category',
				boundaryGap : false,
				splitLine: { show: false },
				axisLine: {show: false},	
				axisTick : {show: false},		
				axisLabel:{interval:0},
				data : options['xaxis']
			}
		],
		yAxis : [
			{
				type : 'value',
				axisLine: {show: false}
			}
		],
		series : series 
	};

	if (option && typeof option === "object") {
		linechart.setOption(option, true), $(function() {
			function resize() {
				setTimeout(function() {
					linechart.resize()
				}, 100)
			}
			
			$(window).on("resize", resize), $(".icon-menu").on("click", resize)
		});
	}

}

function gaugechart(selector, options){
	var gaugeChart = echarts.init(document.getElementById(selector));

	option = {
		tooltip : {
			formatter: "{a} <br/>{b} : {c}%"
		},
		series : [
			{
				name		: options.name,
				type		:'gauge',
				detail 		: {formatter:'{value}'},
				data		: options.data,
				axisLine	: {            
								lineStyle: {       
									color: options.colors 
									
								}
							  }
				
			}
		]
	};
		   
	gaugeChart.setOption(option, true), $(function() {
		function resize() {
			setTimeout(function(){
				gaugeChart.resize()
			}, 100)
		}
		$(window).on("resize", resize), $(".icon-menu").on("click", resize)
	});
}

function currencyconvertor(currency){
	amount 	= (Math.floor(currency*100)/100).toFixed(2);
	lastchr	= amount[amount.length-1];
	
	if(lastchr < 5){
		amount[amount.length-1] = '0';
	}else{
		amount[amount.length-1] = '5';
	}
	
	return amount;
}

function googlemap(selector, address){
	var geocoder 	= new google.maps.Geocoder();

	geocoder.geocode({'address': address}, function(results, status){
		if (status == google.maps.GeocoderStatus.OK){
			var latitude 		= results[0].geometry.location.lat();
			var longitude 		= results[0].geometry.location.lng();
			var markertoggle 	= 1;
		}else{
			var latitude 		= -26.195246;
			var longitude 		= 28.034088;
			var markertoggle 	= 0;
		} 
		
		var myLatLng = {lat: latitude, lng: longitude};
		
		var map = new google.maps.Map(document.getElementById(selector), {
			zoom: 9,
			center: myLatLng,
			scrollwheel: false,
			draggable:false,
			disableDefaultUI: true
		});
		
		if(markertoggle==1){
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map
			});
		}
	});
}