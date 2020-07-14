<style type="text/css">
table.page_overall_auditreport {
    margin: 10px auto;
}
table.head-all {
    width: 100%;
    border-bottom: 1.5px solid;    
    margin-bottom: 20px;
    padding-bottom: 20px;    
}
table.coc_details_overall {
    width: 100%;
    border-bottom: 1.5px solid;   
    margin-bottom: 20px;
    padding-bottom: 20px;    
}
table.coc_details_overall h3 {
    border-bottom: 1.5px solid #000;
    display: inline-block;
    margin: 0;
    margin-bottom: 10px;
}	
table.reviewtable h3 {
    border-bottom: 1.5px solid #000;
    display: inline-block;
    margin: 0;
    margin-bottom: 10px;
}	
table.coc_details_overall td, table.auditor_details_overall td {
    padding: 5px;
    width: 33.3%;
}
table.page_overall_auditreport input[type="text"] {
    padding: 5px;
}
table.auditor_details_overall h3 {
    border-bottom: 1.5px solid #000;
    display: inline-block;
    margin: 0;
    margin-bottom: 10px;
}

table.auditor_details_overall {
    width: 100%;
    border-bottom: 1.5px solid #000;
    margin-bottom: 20px; 
    padding-bottom: 20px;       
}
table.notice-license-text {
    width: 100%;
    border: 1px solid #000;
    border-collapse: collapse;
    margin-bottom: 25px; 
}
table.notice-license-text th {
    background: #f00;
}
table.notice-license-text th h3 {
    color: #fff;
    font-weight: 600;
    margin: 0;
    padding: 5px 0;
}
table.table.table-bordered.reviewtable {
    width: 100%;
    border-collapse: collapse;
}
h3.audit-table-heading {
    border-bottom: 1.5px solid #000;
    width: auto;
    margin: 20px 0 20px;
}
table.table.table-bordered.reviewtable td {
    border: 1px solid #000;
    padding: 10px;
    text-align: center;
}
table.table.table-bordered.reviewtable th {
    border: 1px solid #000;
	padding: 15px;    
	text-align: center;
}
table.coc_details_overall label, table.auditor_details_overall label {
    font-weight: bold;
}
table.notice-license-text tbody tr td {
    padding: 5px;
}
.review_failure{
    background-color: #ffa58f;
}

.review_cautionary{
    background-color: #ffc;
}

.review_compliment{
    background-color: #9f9;
}

.review_noaudit{
    background-color: #00ffff;
}
</style>

<?php
$cocid 					= isset($result['id']) ? $result['id'] : '';
	
$completiondate 		= isset($result['cl_completion_date']) && $result['cl_completion_date']!='1970-01-01' ? date('d-m-Y', strtotime($result['cl_completion_date'])) : '';
$name 					= isset($result['cl_name']) ? $result['cl_name'] : '';
$address 				= isset($result['cl_address']) ? $result['cl_address'] : '';
$street 				= isset($result['cl_street']) ? $result['cl_street'] : '';
$number 				= isset($result['cl_number']) ? $result['cl_number'] : '';
$province 				= isset($result['cl_province_name']) ? $result['cl_province_name'] : '';
$city 					= isset($result['cl_city_name']) ? $result['cl_city_name'] : '';
$suburb 				= isset($result['cl_suburb_name']) ? $result['cl_suburb_name'] : '';

$auditorname 			= isset($result['auditorname']) ? $result['auditorname'] : '';
$auditormobile 			= isset($result['auditormobile']) ? $result['auditormobile'] : '';
$auditoremail 			= isset($result['auditoremail']) ? $result['auditoremail'] : '';

$reviewtableclass		= ['1' => 'review_failure', '2' => 'review_cautionary', '3' => 'review_compliment', '4' => 'review_noaudit'];

function base64conversion($path){
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	return 'data:image/' . $type . ';base64,' . base64_encode($data);
}
?>

<table class="page_overall_auditreport">
	<tbody>
		<tr>
			<td>
				<table class="head-all">
					<tbody>
						<tr>
							<td style="font-family:Helvetica;"><h2>PIRB AUDIT REVIEW REPORT</h2></td>
							<td style="text-align: right; width:250px;"><img width="200px" src="<?php echo base64conversion(base_url().'assets/images/pitrb-logo.png'); ?>"></td>                   
						</tr>
					</tbody>
				</table>
			</td>
		</tr>

		<tr> 
			<td>
				<table class="coc_details_overall">
					<tbody>
						<tr> 
							<td style="padding: 0;"> <h3 style="font-family:Helvetica;">COC DETAILS</h3> </td>
						</tr>
						<tr>
							<td style="padding: 0;"><label style="font-family:Helvetica;">Certificate No</label></td>
							<td><label style="font-family:Helvetica;">Plumbing Work Completion Date</label></td>
							<td><label style="font-family:Helvetica;">Owners Name</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text"  style="font-family:Helvetica;"value="<?php echo $cocid; ?>"></td>
							<td><input type="text"  style="font-family:Helvetica;" value="<?php echo $completiondate; ?>"></td>
							<td><input type="text"  style="font-family:Helvetica;" value="<?php echo $name; ?>"></td>
						</tr> 
						<tr>
							<td style="padding: 0;"><label style="font-family:Helvetica;">Name of Complex/Flat and Unit Number (if applicable)</label></td>
							<td><label style="font-family:Helvetica;">Street</label></td>
							<td><label style="font-family:Helvetica;">Number</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text"  style="font-family:Helvetica;"value="<?php echo $address; ?>"></td>
							<td><input type="text"  style="font-family:Helvetica;" value="<?php echo $street; ?>"></td>
							<td><input type="text"  style="font-family:Helvetica;" value="<?php echo $number; ?>"></td>
						</tr>
						<tr>
							<td style="padding: 0;"><label style="font-family:Helvetica;">Province</label></td>
							<td><label style="font-family:Helvetica;">City</label></td>
							<td><label style="font-family:Helvetica;">Suburb</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text"  style="font-family:Helvetica;"value="<?php echo $province; ?>"></td>
							<td><input type="text"  style="font-family:Helvetica;" value="<?php echo $city; ?>"></td>
							<td><input type="text"  style="font-family:Helvetica;" value="<?php echo $suburb; ?>"></td>
						</tr>						
					</tbody>
				</table>
			</td>
		</tr>    

		<tr>
			<td>
				<table class="auditor_details_overall">
					<tbody>
						<tr>
							<td style="padding: 0;"><h3 style="font-family:Helvetica;">AUDITOR DETAILS</h3></td>
						</tr>						
						<tr>
							<td style="padding: 0;"><label style="font-family:Helvetica;">Auditors Name and Surname</label></td>
							<td><label style="font-family:Helvetica;">Phone (Mobile)</label></td>
							<td><label style="font-family:Helvetica;">Email</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text"  style="font-family:Helvetica;" value="<?php echo $auditorname; ?>"></td>
							<td><input type="text" style="font-family:Helvetica;" value="<?php echo $auditormobile; ?>"></td>
							<td><input type="text" style="font-family:Helvetica;font-size: 14px;" value="<?php echo $auditoremail; ?>"></td>                   
						</tr>
					</tbody>
				</table>
			</td>
		</tr>

		<tr>
			<td style="border-bottom: 1.5px solid #000">
				<table class="notice-license-text">
					<thead>
						<tr>
						<th><h3 style="text-align:center;">NOTICE TO LICENSED PLUMBER</h3></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="font-family:Helvetica;">It is your responsible to complete your refix's with in the allocted time. Failure to do so within the alloated time will result in the refix being marked as Audit Complete (with Refix(s)) and relevant remedial action will follow.</td>             
						</tr>

						<tr>
							<td style="font-family:Helvetica;">Please login into your PIRB Profile for further details pertaining to this audit review.</td>               
						</tr>

					</tbody>
				</table>
			</td>
		</tr>
		
	</tbody>
</table>
<table class="table table-bordered reviewtable">    
	<thead>
		<tr>
			<th colspan="4" style="border:none; font-family:Helvetica; padding-left:0px; width:100%; text-align: left;">
				<h3>AUDIT REVIEW</h3>
			</th>
		</tr>
		<tr>
			<th style="font-family:Helvetica;">Review Type</th>
			<th style="font-family:Helvetica;">Statement</th>
			<th style="font-family:Helvetica;">SANS/Regulation<br>/Bylaw Reference</th>
			<th style="font-family:Helvetica;">Comments</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($reviewlist as $list){ ?>
			<tr>
				<td style="font-family:Helvetica;" class="<?php echo isset($reviewtableclass[$list['reviewtype']]) ? $reviewtableclass[$list['reviewtype']] : ''; ?>">
					<?php echo isset($this->config->item('reviewtype')[$list['reviewtype']]) ? $this->config->item('reviewtype')[$list['reviewtype']] : ''; ?>
					<?php 
						if($list['reviewtype']=='1'){
							if($list['status']=='0'){
								echo '<p>(Incomplete)</p>';
							}else{
								echo '<p>(Complete)</p>';
							}
						}
					?>
				</td>
				<td style="font-family:Helvetica;"><?php echo $list['statementname']; ?></td>
				<td style="font-family:Helvetica;"><?php echo $list['reference']; ?></td>
				<td style="font-family:Helvetica;"><?php echo $list['comments']; ?></td>
			</tr>
			<?php if($list['file']!=''){ ?>
				<tr>
					<td colspan="4" style="font-family:Helvetica;">
						<?php 
							$filelist = array_filter(explode(',', $list['file'])); 
							foreach($filelist as $file){
								if(!file_exists('./assets/uploads/auditor/statement/'.$file)) continue;
						?>
								<p style="display:inline-block;width:200px;margin-right:10px;"><img src="<?php echo base64conversion(base_url().'assets/uploads/auditor/statement/'.$file); ?>" width="200" height="200"></p>
						<?php
							}
						?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>      
	</tbody>                            
</table>