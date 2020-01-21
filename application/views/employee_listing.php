<?php
include('sidebar.php');
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><meta charset="utf-8" /><title>
	View Companies
</title>   
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">



    <style>
        .dropdown-backdrop {
             position: fixed; 
             top: 0; 
             right: 0; 
             bottom: 0; 
             left: 0; 
             width:1px;
             height:1px;
             /*z-index: 990;*/ 
        }
    </style>    

</head>
<body id="BodyElement" class="fixed-header  sidebar-visible menu-pin">
    
    <form method="post" action="Get_company/get_user" id="form1">
       <!-- <?php echo form_open('get_company/update'); ?> -->

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar" data-pages="sidebar">
      <div id="appMenu" class="sidebar-overlay-slide from-top">
      </div>

      

    </div>
    <!-- END SIDEBAR -->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      <!-- START PAGE HEADER WRAPPER -->
      <!-- START HEADER -->
      <div class="header ">
        
        <!-- START MOBILE CONTROLS -->
        
<!-- LEFT SIDE -->
<div class="pull-left full-height visible-sm visible-xs">
    <!-- START ACTION BAR -->
    <div class="sm-action-bar">
    <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
        <span class="icon-set menu-hambuger"></span>
    </a>
    </div>
    <!-- END ACTION BAR -->
</div>
<!-- RIGHT SIDE -->

        <!-- END MOBILE CONTROLS -->
        
       
        
      </div>
      <div class="page-content-wrapper">
        
        <div class="content">
          
          <div class="container-fluid container-fixed-lg">
            
            

    
    <div class="container-fluid container-fixed-lg bg-white company-register">
        
        <div class="panel panel-transparent">
            <div class="panel-heading">

                <div class="panel-title">
                    Companies
                </div>
                

                
            </div>
            <div class="panel-body"> 
                <div class="panel cmpny_reg">

                    <div>
                        <input type="button" id="active_btn" name="active_btn" value="ACTIVE">
                        <input type="button" id="archive_btn" name="archive_btn" value="ARCHIVED">
                    </div>



                    <div class="tab-content" id="hideTwo">
                        <div class="tab-pane active" id="TabActive">
                            
                            <div class="clearfix"></div>
                          <table id="isActive" class="display_data" width="600" border="1" >
                        <thead>
                            <tr>
                                <th>Company ID</th>
                                <th>Company Name</th>
                                <th>App Status</th>
                                <th>Status</th>
                                <th>Number of Employees Licensed</th>
                                <th>Number of Employees Non-Licensed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                                         $i=1;
                                    foreach($records as $row)
                                            { ?>
                                      <tr>
                                      <td> <?php echo $row->id; ?> </td>
                                      <td> <?php echo $row->company_name; ?> </td>
                                      <td>0</td>
                                      <td>0</td>
                                      <td>0</td>
                                      <td>0</td>
                                      <td ><a href = '<?php echo "edit/".$row->id; ?>'>Edit</a></td>
                                      
                                      </tr>
                                      
                                      <?php 
                                      $i++; 
                                  }
                                       ?>
                                       </tbody>
                    </table>
                                    
                        </div>


                        <!-- <div class="tab-pane" id="TabArchived">
                          
                            <div class="clearfix"></div>
                            <table id="isActive" class="hover table-striped">
                        <thead>
                            <tr class="gridStyle">
                                <th>Company ID</th>
                                <th>Company Name</th>
                                <th>App Status</th>
                                <th>Status</th>
                                <th>Number of Employees Licensed</th>
                                <th>Number of Employees Non-Licensed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                        </div> -->
                        
                        <div class="auto-style1">
                        <input type="submit" name="submit" value="Add" id="add_submit" class="add_submit" style="float: right; background-color: #8B4513;  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;"
/>                   
                    </div>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
    
    
    



            
          </div>
          
        </div>
        

        
      </div>
      
    </div>  
   
    </form>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
  $('#isActive').DataTable();
});
    
</script>