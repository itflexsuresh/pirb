<!-- Company front view file -->
<?php
if(isset($edit)){
	foreach ($edit as $key => $value) {
 	if($value['id']){
 		$id         =	$value['id'];
	}
 }
 $date = date("d-m-Y", strtotime($register_date['created_at'])); 

}
	
// echo '<pre>';
// print_r($register_date);
// die;

?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>PIRB Company ID:</label>
			<input type="text" class="form-control"  name="comapany_id" 
			value="<?php if(isset($id)){echo $id;} ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Registration Date:</label>
			<input type="text" class="form-control"  name="reg_date" value="<?php if(isset($date)){echo $date;} ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Status</label>
			  <select name="cars">
			    <option value=""></option>
			  </select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="specific_mgs">Specific Message to Company</label>
			<textarea rows="4" cols="50" name="company_message">				
			</textarea>		
		</div>
	</div>
</div>
