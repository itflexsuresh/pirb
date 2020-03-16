<?php
	if(isset($result) && $result){
		$id 			= $result['id'];
		$role_id        = (set_value('type')) 			? set_value('type') 			: $result['type'];
		$name 			= (set_value('name')) ? set_value('name') : $result['name'];
		$surname        = (set_value('surname')) ? set_value('surname') : $result['surname'];
		$email          = (set_value('email')) ? set_value('email') : $result['email'];
		$password       = (set_value('password_raw')) 	? set_value('password_raw') 	: $result['password_raw'];
		$type           = (set_value('type')) ? set_value('type') : $result['type'];
		$comments       = (set_value('comments')) ? set_value('comments') : $result['comments'];
		$status 		= (set_value('status')) ? set_value('status') : $result['status'];
	    $read 		    = (set_value('read')) 		? set_value('read') 			: $result['read_permission'];
	    $write 		    = (set_value('write')) 		? set_value('write') 			: $result['write_permission'];
		$heading		= 'Update';
	}else{
		$id 			= '';
		$role_id        = set_value('role_id'); 
		$name			= set_value('name');
		$surname        = set_value('surname');
		$password       = set_value('password_raw');
		$email          = set_value('email');
		$type           = set_value('type');
		$comments       = set_value('comments');
		$status			= set_value('status');
		$read       	= set_value('read');
     	$write			= set_value('write');
		
		$heading		= 'Save';
	}
?>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Add Edit System Users</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="j<?php echo base_url().'admin/dashboard'; ?>">Home</a></li>
				<li class="breadcrumb-item active">Add Edit System Users</li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Add Edit System Users</h4>
				<form class="mt-4 form" action="" method="post">
					<div class="row">
					<div class="form-group col-md-6">
						<label for="name">Name *</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter the name*" value="<?php echo $name; ?>">
					</div>
					<div class="form-group  col-md-6">
						<label for="surname">Surname *</label>
						<input type="text" class="form-control" id="surname" name="surname" placeholder="Enthe the surname*" value="<?php echo $surname; ?>">
					</div>
			
					<div class="form-group col-md-6">
						<label for="email">Email Address*</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enthe the Email*" value="<?php echo $email; ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="password">Password *</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enthe the Password*" value="<?php echo $password; ?>">
					</div>
					<div class="form-group col-md-6">
						
						<label for="role_id">Role Type *</label>
						<?php echo form_dropdown('type', $roletype, $role_id, ['id' => 'role_id', 'class' => 'form-control']); ?>
				    </div>
				    <div class="form-group col-md-6">
						<label for="comments">Comments </label>
							<textarea class="form-control" id="comments" name="comments" placeholder="Enter the comments "><?php echo $comments; ?></textarea>
					</div>
				</div>


					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-checkbox mr-sm-2 mb-3 pt-2">
								<input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($status=='1')echo 'checked'; ?> value="1">
								<label class="custom-control-label" for="status">Active</label>
							</div>
						</div>

						<div class="table-responsive m-t-40">
					
					<table class="table table-bordered table-striped  fullwidth">
						<thead>
							<tr>
								<th>Permissions</th>
								<th>Read</th>
								<th>Write</th>
							</tr>
						</thead>
						<?php 
						if(count($permission_list) > 0)
						{
							foreach($permission_list as $key=>$val)
							{  
								$read_key=str_replace(' ', '', $key);
						?>
								<tbody>
									<tr style="background-color:lightgray">
										<td><?php echo $key;?></td>
										<td>&nbsp;<input data-id="<?php echo $read_key.'_read';?>" type="checkbox" name="read[]" id="checkbox3" class="<?php echo $read_key.'_read';?> checkbox3"></td>
										<td>&nbsp;<input data-id="<?php echo $read_key;?>" type="checkbox" name="checkbox" id="checkbox4" class="<?php echo $read_key;?> checkbox4"></td>
									</tr>
									<?php 
									foreach($val as $k=>$v)
									{
										$read_permission = explode(',', $read);
										$write_permission = explode(',', $write);
									?>
										<tr>
											<td><?php echo $v['name'];?></td>
											
											<?php if(in_array($v['id'],$read_permission)){ ?>
												<td><input data-id="<?php echo $read_key.'_read';?>" class="<?php echo $read_key.'_read';?> read_key"  checked="checked" type="checkbox" name="read[]" value="<?php echo $v['id'];?>"></td>	
											<?php }else{ ?>
												<td><input  class="<?php echo $read_key.'_read';?> read_key" type="checkbox" name="read[]" value="<?php echo $v['id'];?>"></td>
											<?php } ?>
											
											<?php if(in_array($v['id'],$write_permission)){ ?>							
												<td><input data-id="<?php echo $read_key;?>" class="<?php echo $read_key;?> write_key" checked="checked" type="checkbox" name="write[]" value="<?php echo $v['id'];?>"></td>
											<?php }else{ ?>
												<td><input data-id="<?php echo $read_key;?>" class="<?php echo $read_key;?> write_key" type="checkbox" name="write[]" value="<?php echo $v['id'];?>"></td>
											<?php } ?>
										</tr>
									<?php
									}
									?>
								</tbody>
						<?php 
							} 
						} 
						?>
					</table>
				
				</div>
						<div class="col-md-6 text-right">
							<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
							<button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $heading; ?></button>
						</div>
					</div>
				</form>
			</div>
			</div>
	</div>
</div>
		
			</div>
		</div>
	</div>
</div>
		
<script>
	$(function(){
		
		$.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-z \s]+$/i.test(value);
        }, "Only Letters");
		
		jQuery.validator.addMethod("noSpace", function(value, element) { 
  			return value.indexOf(" ") < 0 && value != ""; 
		}, "No space please and don't leave it empty");
		
		validation(
			'.form',
			{
				name : {
					    required    : true,
						lettersonly: true,
						 },
				
				surname:{
					required    : true,
					lettersonly: true,
				},
				email  :{
					required    : true,
					remote		: 	{
						url	: "<?php echo base_url().'admin/systemsetup/systemusers/systemusers/DTemailValidation'; ?>",
						type: "post",
						async:false,
						data: {
							email: function() {
								return $( "#email" ).val();
							},
							id: function() {
								return $( "#id" ).val();
							}
						}

					}
				},
				password:{
					required    : true,
					minlength	: 8,
					maxlength	: 24,
					noSpace		: true
				},
				type   :{
					required    :true,
				}

			},
			{
				name : {
					required	: "Please enter the name",
				},
				surname:{
					required    : "Please enter the surname",
				},
				email  :{
					required    : "Please enter the email",
					remote		: "Please enter the differene email",
				},
				password:{
					required    : "Please enter the password",
				},
				type    :{
					required    : "Please Select the type",
				}
			}
		);
		
	});
	
	$(document).ready(function(){

		$(".checkbox3").click(function(){
		var c = $(this).attr("data-id");
		// alert(c);

	// alert($(this).prop("checked"));

		if( $(this).prop("checked")==true){
		
	   
		 $("."+c).prop("checked", true);
		}else{
		
			 $("."+c).prop("checked", false);
	   /*  $("."+c+"_read").prop("checked",true);
		 $("."+c).prop("checked",true);*/
		}
		});


		$(".checkbox4").click(function(){
		var c = $(this).attr("data-id");
		 if( $("."+c+"_read").prop("checked")==false){
		 $("."+c+"_read").prop("checked", true);
		 $("."+c).prop("checked", true);
		}else{
		 $("."+c+"_read").prop("checked", false);
		 $("."+c).prop("checked", false);
		}
		
		
		});

		$(".write_key").click(function(){		
			if($(this).closest('tr').find("input[name='read[]']").prop('checked')==false) {
				$(this).closest('tr').find("input[name='read[]']").prop('checked', true);
			}else{
				$(this).closest('tr').find("input[name='read[]']").prop('checked', false);
			};		
			
			keycheck($(this).attr('data-id'), 2);
			
		});

		$('.read_key').click(function(){
			keycheck($(this).attr('data-id'), 1);
		})
	});
	
	function keycheck(dataid, type){		
		var parentcheck1 = 0;
		
		var dataid1 = (type==1) ? dataid : dataid+'_read';
		var dataid2 = (type==1) ? dataid.replace("_read", "") : dataid;
		
		$('.'+dataid1+'.read_key').each(function(i,v){
			if($(this).is(':checked')){
				parentcheck1 = 1;
			}
		})
		
		if(parentcheck1==1) $('.checkbox3.'+dataid1).prop('checked', true);
		else $('.checkbox3.'+dataid1).prop('checked', false);
		
		var parentcheck2 = 0;
			
		$('.'+dataid2+'.write_key').each(function(i,v){
			if($(this).is(':checked')){
				parentcheck2 = 1;
			}
		})
		
		if(parentcheck2==1) $('.checkbox4.'+dataid2).prop('checked', true);
		else $('.checkbox4.'+dataid2).prop('checked', false);
	}
</script>

