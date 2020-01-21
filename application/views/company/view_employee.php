    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style2.css">
    
    

    
    

      <div class="row">
  <div class="col-sm-12">
    <div class="white-box">
            
      <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('get_company/view') ?>" class="nav-link" aria-controls="home" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Company Details</span></a></li>

                                <li role="presentation" class="active nav-item"><a href="<?php echo base_url('get_company/employeelist')."/".$dataaa[0]->CompanyID; ?>" aria-controls="profile" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Employee Listing</span></a></li>

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('purchase_coc/pur_coc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Management</span></a></li>


                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('allocation/coc_alloc')."/".$dataaa[0]->CompanyID; ?>" aria-controls="messages" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">COC Allocation</span></a></li>
                                

                                <li role="presentation" class="nav-item"><a href="<?php echo base_url('company_diary/load_comment')."/".$dataaa[0]->CompanyID; ?>" aria-controls="diary" role="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Diary & Comments</span></a></li>
                            </ul>
                            <br>
                
            <form method="post" action="Get_company/get_user" id="form1">
            <div class="col-sm-12">
                      <div class="table-responsive">
                       <div id="activeTable-message">
                        <table id="isActive_message" class="display">
                          <thead>
                            <tr>
                             <th>Registration Number</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Plumbers Name and Surname</th>
                                <th>CPD Status</th>
                                <th>Performance Status</th>
                                <th>Overall Industry Rating</th>
                                <th>Badges</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                        
                        <?php
                          $i=1;              
                        //             $query =$this->db->query("SELECT regno FROM users");
                            // $result=$query->result();
                          
                            foreach ($list_emp as $row)
                          { 
                            
                            //print_r($records1);
                          $query10 = $this->db->get_where("newapplications", array("UserID"=>$row->UserID));     

                          $desigid = $query10->result();
                          
						 $designation = $desigid[0]->Designation;


                          $conc = $row->fname.$row->lname;   
                          



                          // $query2 = $this->db->get_where("performancestatus", array("PerformanceStatusID"=>$row->UserID));

                          // $perid = $query2->result(); 
                          // $PerformancePointAllocation = $perid[0]->PerformancePointAllocation;
                            
                             //foreach ($desigid as $row1) {


                              

                              // print_r($perid);
                              // foreach ($perid as $row2) {

                                

                              //   $query3 = $this->db->get_where("users", array("UserID"=>$row->regno));
                              // $regid = $query3->result();

                              // foreach ($regid as $row3)
                              // {

                            

                          
                          ?>

                              
 


                
                                     <tr>
                                      <td> <?php echo $row->regno; ?> </td>
                                      <td> <?php echo $designation; ?> </td>
                                          
                                      <td> <?php echo $row->status; ?></td>
                                      <td> <?php echo $conc; ?></td> 
                                      <td> <?php echo $row->CPDStatus; ?></td>
                                      <td> <?php echo $PerformancePointAllocation; ?></td>
                                      <td> <?php echo $row->PerformanceStatusID; ?></td>
                                      <td> <?php echo $row->Badge; ?></td>
                                      <td ><a href = '<?php echo "edit/".$row->CompanyID; ?>'>View</a></td>
                                      
                                      </tr>
                                      <?php  $i++; 
                                  //  } 
                                  } ?>
                                 
                                      
                       </tbody>
                    </table>
                        
                      </div>
                    </div>
                    <!-- </div> -->
                  </div>


                       
                        
                        
                    </div>

                </div>
            </div>
         
   
    </form>




<script type="text/javascript">
  $(document).ready( function () {
  $('#isActive_message').DataTable({

aoColumnDefs: [
    {
     bSortable: false,
     aTargets: [ -1 ]
   }
   ]});







});
    
</script>