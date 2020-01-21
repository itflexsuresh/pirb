<script type="text/javascript">
  start_end();  
</script>
<?php
$attributes_installationType = array('class' => 'Message_send', 'data-toggle' =>'validator', 'id' => 'Message_send', 'method' => 'post');
?>
<!-- .row -->
<div class="row">
  <div class="col-sm-12">
    <div class="white-box">

      <!-- <p class="text-muted m-b-30"> Bootstrap Form Validation</p> -->
      <?php
      echo form_open_multipart('message/send_message', $attributes_installationType);
      ?>
      <div class="form-group">
        <label class="control-label">Message Group</label>
        <!-- <div class="col-sm-12"> -->
          <select name="msg_role" class="custom-select col-12" id="inlineFormCustomSelect">
            <option value="1">Plumber Message</option>
            <option value="2">Auditor Message</option>
            <option value="3">Reseller Message</option>
            <option value="4">Company Message</option>
          </select>
          <!-- </div> -->
        </div>
            <!-- <div class="form-group">
                <label for="inputName1" class="control-label">Message Group</label>
                <input type="text" class="form-control" id="inputName1" placeholder="Cina Saffary" required>
              </div> -->
              <div class="form-group">
                <label for="inputEmail" class="control-label">Message Start Date</label>
                <input type="text" name="start_date" id="date_id_send" autocomplete="off" placeholder="Enter an start date" class="form-control" required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                <label for="inputEmail" class="control-label">Message End Date</label>
                <input type="text" name="end_date" id="date_id_end" autocomplete="off" placeholder="Enter an end date" class="form-control" required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                <label for="textarea" class="control-label">Enter Message</label>
                <textarea name="editor" id="editor" rows="10" cols="80" required></textarea>
                <span class="help-block with-errors"></span> </div>

                <div class="form-group">
                  <button type="submit" name="ContentPlaceHolder1btn_update_rates" class="btn btn-rounded btn-sm btn-primary">Send Message</button>
                  <button type="button" class="btn  btn-rounded btn-sm btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url()."message/view/";?>';">Cancel</button>
                </div>

              </form>
            </div>
          </div>

        </div>
        <!-- /.row -->
        <script src="<?php echo base_url(); ?>assets/js/libraries/ckeditor_4.13.1_standard/ckeditor/ckeditor.js"></script>
        <script type="text/javascript"></script>

        <script>
          $(document).ready(function(){
            $("#date_id_send").datepicker({
              startDate: new Date
            }).on('changeDate', function (selected) {
              console.log(selected);
              $("#date_id_end").datepicker({     
                startDate: new Date(selected.format()),
              });
            });
            // start_end();
            // function start_end(){
            //   $("#date_id_send").datepicker({
            //     startDate: new Date(),
            //   });      
            // }

            // $("#date_id_end").click(function(){
            //   start_Date = $('#date_id_send').val();

            //   $("#date_id_end").datepicker({     
            //     startDate: new Date(start_Date),
            //   });
            // });

   //          $("#date_id_send").datepicker({
   //    //dateFormat: 'dd-mm-yy',
   //    dateFormat: 'dd-mm-yy',
   //    onSelect: function(selected) {
   //      $("#date_id_end").datepicker("option","minDate", selected)
   //    }
   //  });
   //          $("#date_id_end").datepicker({
   //    //  dateFormat: 'dd-mm-yy',
   //    dateFormat: 'dd-mm-yy',
   //    onSelect: function(selected) {
   //     $("#date_id_send").datepicker("option","maxDate", selected)
   //   }
   // });
   $('.installation_sucess-msg, .green').delay('3000').fadeOut(300);
   CKEDITOR.replace('editor');

 });
</script>