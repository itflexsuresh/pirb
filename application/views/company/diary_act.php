<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css"> 


<div class="row"> 
<div class="col-md-12">
    <div class="white-box">
        <form data-toggle="validator" method="post" action="index">
        <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class=""><a href="" aria-controls="home" role="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Company Details</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('get_company/employeelist')."/".$dataaa[0]->CompanyID; ?>" aria-controls="profile" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Employee Listing</span></a></li>
                                
                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('purchase_coc/pur_coc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Management</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('allocation/coc_alloc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Allocation</span></a></li>
                                

                                <li role="presentation" class="active nav-item"><a href="<?php echo base_url('company_diary/load_comment')."/".$dataaa[0]->CompanyID; ?>" aria-controls="diary" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Diary & Comments</span></a></li>
                            </ul>

    <div class="col-md-6">
                <div class="form-group">                    
                    <label class="control-label">Diary of Activities</label>
                    
                    <textarea id="message" name="company_diary" rows="25" cols="4"  class="form-control" disabled="disabled" required><?php 
                                        
                                         foreach ($get_aud as $row) {

                                            echo date('d/m/Y',strtotime($row->CreateDate));

                                            echo "-";
                                            
                                            echo $get_aud[0]->fname;
                                            echo $get_aud[0]->lname;
                                            
                                            echo "-";


                                             echo $row->Comments; 
                                             echo "\n";

                                        }
                                        foreach ($get_com as $row) {

                                            echo date('d/m/Y',strtotime($row->CreateDate));

                                            echo "-";
                                            
                                            echo $get_com[0]->fname;
                                            echo $get_com[0]->lname;
                                            
                                            echo "-";


                                             echo $row->Comments; 
                                             echo "\n";

                                        }
                                        ?></textarea>
                    
                    
                    
                    
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    
                    <label class="control-label">Admin Comments</label>
                    
                    <textarea id="message" name="ad_comments" rows="25" cols="4" class="form-control" disabled="disabled" required><?php    


                                            foreach ($rec_comment as $row)            
                                                {   

                                            echo date('d/m/Y',strtotime($row->CommentsDate));

                                            echo "-";
                                            echo $get_adm[0]->fname;
                                            echo $get_adm[0]->lname;

                                            echo "-";

                                             echo $row->Comments; 
                                             echo "\n";

                                                    } 
                                                    

                                             
                                             ?></textarea>
                    
                    
                    
                </div>

            </div>



                             <div class="col-md-6">
                            <div class="form-group">
                                
                                <input type="text" name="admin_comment" id="contact" class="form-control" placeholder="Type your Comment here" required>
                                <div class="help-block with-errors"></div> 
                            </div>
                            </div>


                            <div class="row">
                                                                                        
                                        <div class="col-lg-2 col-sm-4 col-xs-12">
                                            <button type="submit" name="save" class="btn btn-block btn-primary btn-rounded">Add</button>
                                        </div>
                                    </div>
                                
        


        </form>
        </div>
        </div>
    </div>
</div>







                            
                                
                               
                         
                     
        
                           


    
    