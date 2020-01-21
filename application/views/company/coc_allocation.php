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
                                
                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('purchase_coc/pur_coc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Management</span></a></li>

                                <li role="presentation" class="active nav-item"><a href="<?php echo base_url('allocation/coc_alloc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Allocation</span></a></li>
                                

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('company_diary/load_comment')."/".$dataaa[0]->CompanyID; ?>" aria-controls="diary" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Diary & Comments</span></a></li>
                            </ul>
                                <br>        


        
                <form data-toggle="validator" method="post">
                                    <div class="row">   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Plumber</label>
                                            <select class="form-control" name="plumber" data-placeholder="Choose a Category" id="sel_plumber" value="<?php echo set_select('sel_plumber'); ?>"tabindex="1" required>

                                                <option value="0">Select</option>

                                                <?php
                                                foreach ($sel_plum as $key => $value) 

                                                {   
                                                    // if($value->UserID==set_value('plumber')){
                                                    //     $sel = 'selected="true"';
                                                    // } else {
                                                    //     $sel = '';
                                                    // }
                                                    echo '<option '.$sel.' value="'.$value->role.'">'.$value->fname.'</option>';
                                                }
                                                
                                                ?>


                                                
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>
                                </div>
                                
                <div class="row">                                 
                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Number of Non Allocated COC's</label>
                    <input type="text" name="non_loggedcoc" id="non_loggedcoc" value="<?php echo $non_all['num_of_time']; ?>" class="form-control" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                   <div class="help-block with-errors"></div>
                   </div>
                </div>
                </div>

                <div class="row"> 
                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Total Number COC's You are Permitted</label>
                    <input type="text" name="total" id="total" value="<?php echo $res['NoCOCpurchases']; ?>"
class="form-control" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                 <div class="help-block with-errors"></div>  
                </div>
                </div>
            </div>

                <div class="row"> 
                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Number of Permitted COC's that you are able to purchase</label>
                    <input type="text" name="permitted" id="permitted" value="<?php echo $total; ?>"  class="form-control" required>
                    <!-- <span class="help-block"> This is inline help </span> --> 
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>

                <div class="row"> 
                <div class="col-md-6">
                                        <h5>Assign Certificate Stock</h5>
                                        <div class="form-group">
                                            <label>Certificate: </label>
                                            <select class="form-control" name="type_plumber" data-placeholder="Choose a Category" id="sel_plumber" value="<?php echo set_select('sel_plumber'); ?>"tabindex="1">

                                                <option value="">Select</option>
                                                <option value="1">Electronic</option>
                                                <option value="2">Paper Based</option>
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    </div>
                
                                            <div class="row">
                                                <div class="col-md-12">   
                                                        <div class="col-lg-2 col-sm-3 col-xs-10">
                                                            <button type="submit" class="btn btn-block btn-primary btn-rounded"> Allocate Certificates</button>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            <br>
                                        

                                <div class="col-sm-12">
                      <div class="table-responsive">
                       <div id="activeTable-message">
                        <table id="isActive_message" class="display">
                          <thead>
                            <tr>
                             <th>Date of Allocation</th>
                              <th>COC Number</th>        
                              <th>Plumber Name and Surname</th>
                              
                            </tr>
                          </thead>
                          <tbody>   
                                   <!--  <?php
                                $query10 = $this->db->query("SELECT COCNumber, AssignedDate FROM cocstatements");
                                    $data['non_all'] = $query10->row_array();

                                ?> -->

                                        
                                      <tr>    
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      </tr>
                                      
                                      

                                    
                                       </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- </div> -->
                  </div>






                    
										<?php echo form_close(); ?>
                
            
    </div>
            </div> 
            </div>

            <script type="text/javascript">
            	$(document).ready( function () {

                    $('#isActive_message').DataTable();

                });
            </script>