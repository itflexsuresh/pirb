
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> 
                     <i class="fa fa-pencil"></i> &nbsp;User Edit <a href="<?php echo base_url('admin/user/all_user_list') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-list"></i> All Users </a>

                </div>
                <div class="panel-body table-responsive">
				
				 <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
			
			
                    <form method="post" action="<?php echo base_url('admin/user/update/'.$user->id) ?>" class="form-horizontal" novalidate>
                       <div class="form-group">
                 	<label class="col-md-12" for="example-text">First Name</label>
                    <div class="col-sm-12">
                   <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                                        </div>
                                    </div>
                              

                           <div class="form-group">
                 	<label class="col-md-12" for="example-text">Last Name</label>
                    <div class="col-sm-12">
                     <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                                        </div>
                                    </div>
                              

                           <div class="form-group">
                 	<label class="col-md-12" for="example-text">Email</label>
                    <div class="col-sm-12">
                   <input type="text" name="mobile" class="form-control" value="<?php echo $user->mobile; ?>">
                                        </div>
                                    </div>
                              

                          <div class="form-group">
                 	<label class="col-md-12" for="example-text">Country</label>
                    <div class="col-sm-12">
                      <select class="form-control form-control-line" name="country">

                                                    <?php foreach ($country as $cn): ?>
                                                        <?php 
                                                            if($cn['id'] == $user->country){
                                                                $selec = 'selected';
                                                            }else{
                                                                $selec = '';
                                                            }
                                                        ?>
                                                        <option <?php echo $selec; ?> value="<?php echo $cn['id']; ?>"><?php echo $cn['name']; ?></option>
                                                    <?php endforeach ?>

                                                </select>
                                        </div>
                                    </div>
									
									
                           
						
                                    
                          New User <input <?php if($user->role == "user"){echo "checked";}; ?> type="radio" onclick="javascript:yesnoCheck();" name="role" id="yesCheck" value="user"> 
						  New Admin<input <?php if($user->role == "admin"){echo "checked";}; ?> type="radio" onclick="javascript:yesnoCheck();" name="role" id="noCheck" value="admin"><br>
    					  <div id="ifYes" style="visibility:hidden">
						  <hr>
        Select Permission:&nbsp;
		
		 <?php foreach ($power as $pw): ?>

                                                <?php foreach ($user_role as $role){
                                                        if ($role['action'] == $pw['id']) {
                                                            $check = 'checked';
                                                            break;
                                                        }else{
                                                            $check = '';
                                                        }
                                                    }
                                                ?>

                                              
<input <?php if(isset($check)) {echo $check;} else {echo "";} ?> type="checkbox" value="<?php echo $pw['power_id'] ?>" name="role_action[]" class="js-switch">&nbsp;&nbsp;<?php echo $pw['name'] ?>
                                            <?php endforeach ?>
    </div>
	<hr>
                          
                            <!-- CSRF token -->
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
  <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
                            </div>
                        </div>
                           
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->