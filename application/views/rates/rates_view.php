<!-- .row -->
<div class="row">
  <div class="col-sm-12">
        <!-- <div class="row">
          <div class="col-sm-12"> -->
            <div class="white-box">
              <?php
              if($this->session->flashdata('update_sucess')!=''){
                echo '<div class="alert alert-success">';
                echo $this->session->flashdata('update_sucess');
                echo '</div>';
              }
              ?>
              <h3 class="box-title m-b-0">Rates Details</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Rate Type</th>
                      <th>Amount (Excluding VAT)</th>        
                      <th>Valid From Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                      foreach ($records as $key) {
                        $date = date("m/d/Y", strtotime($key->ValidFrom));
                        ?>
                        <td><?php echo $key->SupplyItem; ?></td>
                        <td><?php echo $key->Amount; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><a href='<?php echo base_url()."rates/update_view/".$key->ID; ?>' data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a></td>

                      </tr>
                      <?php 
                    } 
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
<!--       </div>
</div> -->
</div>
</div>
<script>
  $(document).ready(function(){
    $('.alert, .alert-success').delay('3000').fadeOut(300);
  });
</script>