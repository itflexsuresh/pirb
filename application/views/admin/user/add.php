
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> 
                     <i class="fa fa-plus"></i> &nbsp;Add New User <a href="<?php echo base_url('admin/user/all_user_list') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-list"></i> List Users </a>

                </div>
                <div class="panel-body table-responsive">
				
				 <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
			
			
                    <form method="post" action="<?php echo base_url('admin/user/add') ?>" class="form-horizontal" novalidate>
                       <div class="form-group">
                 	<label class="col-md-12" for="example-text">First Name</label>
                    <div class="col-sm-12">
                                            <input type="text" name="first_name" class="form-control">
                                        </div>
                                    </div>
                              

                           <div class="form-group">
                 	<label class="col-md-12" for="example-text">Last Name</label>
                    <div class="col-sm-12">
                                            <input type="text" name="last_name" class="form-control" required data-validation-required-message="Last Name is required">
                                        </div>
                                    </div>
                              

                           <div class="form-group">
                 	<label class="col-md-12" for="example-text">Email</label>
                    <div class="col-sm-12">
                                            <input type="email" name="email" class="form-control" required data-validation-required-message="Email is required">
                                        </div>
                                    </div>
                              

                          <div class="form-group">
                 	<label class="col-md-12" for="example-text">Password</label>
                    <div class="col-sm-12">
                                            <input type="password" name="password" class="form-control" required data-validation-required-message="Password is required">
                                        </div>
                                    </div>
									
									
                           <div class="form-group">
                 	<label class="col-md-12" for="example-text">Phone Number</label>
                    <div class="col-sm-12">
                                            <input type="text" name="mobile" class="form-control">
                                        </div>
                                    </div>
									
									
                          <div class="form-group">
                 	<label class="col-md-12" for="example-text">Country</label>
                    <div class="col-sm-12">
                                                <select class="form-control custom-select" name="country" aria-invalid="false">
                                                    <option value="0">Select</option>
                                                    <?php foreach ($country as $cn): ?>
                                                        <option value="<?php echo $cn['id']; ?>"><?php echo $cn['name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    
                          New User <input type="radio"  onclick="javascript:yesnoCheck();" name="role" id="yesCheck" value="user"> 
						  New Admin<input type="radio" onclick="javascript:yesnoCheck();" name="role" id="noCheck" value="admin"><br>
    					  <div id="ifYes" style="visibility:hidden">
						  <hr>
        Select Permission:&nbsp;
	
		<?php foreach ($power as $pw): ?>
		
  <input type="checkbox" value="<?php echo $pw['power_id']; ?>" name="role_action[]" class="js-switch">&nbsp;&nbsp;<?php echo $pw['name']; ?>
                                               
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