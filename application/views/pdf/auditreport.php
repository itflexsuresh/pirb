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
    display: inline-block;
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
}
table.coc_details_overall label, table.auditor_details_overall label {
    font-weight: bold;
}
table.notice-license-text tbody tr td {
    padding: 5px;
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
							<td><h2>PIRB AUDIT REVIEW REPORT</h2></td>
							<td><img src="<?php echo base64conversion(base_url().'assets/images/pitrb-logo.png'); ?>"></td>                   
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
							<td style="padding: 0;"> <h3>COC DETAILS</h3> </td>
						</tr>
						<tr>
							<td style="padding: 0;"><label>Certificate No</label></td>
							<td><label>Plumbing Work Completion Date</label></td>
							<td><label>Owners Name</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text" value="<?php echo $cocid; ?>"></td>
							<td><input type="text" value="<?php echo $completiondate; ?>"></td>
							<td><input type="text" value="<?php echo $name; ?>"></td>
						</tr> 
						<tr>
							<td style="padding: 0;"><label>Name of Complex/Flat (if applicable)</label></td>
							<td><label>Street</label></td>
							<td><label>Number</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text" value="<?php echo $address; ?>"></td>
							<td><input type="text" value="<?php echo $street; ?>"></td>
							<td><input type="text" value="<?php echo $number; ?>"></td>
						</tr>
						<tr>
							<td style="padding: 0;"><label>Province</label></td>
							<td><label>City</label></td>
							<td><label>Suburb</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text" value="<?php echo $province; ?>"></td>
							<td><input type="text" value="<?php echo $city; ?>"></td>
							<td><input type="text" value="<?php echo $suburb; ?>"></td>
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
							<td style="padding: 0;"><h3>AUDITOR DETAILS</h3></td>
						</tr>						
						<tr>
							<td style="padding: 0;"><label>Auditors Name and Surname</label></td>
							<td><label>Phone (Mobile)</label></td>
							<td><label>Email</label></td>
						</tr>
						<tr>
							<td style="padding: 0;"><input type="text" value="<?php echo $auditorname; ?>"></td>
							<td><input type="text" value="<?php echo $auditormobile; ?>"></td>
							<td><input type="text" value="<?php echo $auditoremail; ?>"></td>                   
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
						<th><h3>NOTICE TO LICENSED PLUMBER</h3></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>It is your responsible to complete your refix's with in the allocted time. Failure to do so within the alloated time will result in the refix being marked as Audit Complete (with Refix(s)) and relevant remedial action will follow.</td>             
						</tr>

						<tr>
							<td>Please login into your PIRB Profile for further details pertaining to this audit review.</td>               
						</tr>

					</tbody>
				</table>
			</td>
		</tr>
		
		<tr>
			<td>
			<h3 class="audit-table-heading">AUDIT REVIEW</h3>
				<table class="table table-bordered reviewtable">    
					<thead>
						<tr>
							<th>Review Type</th>
							<th>Statement</th>
							<th>SANS/Regulation/Bylaw Reference</th>
							<th>Comments</th>
							<th>Images</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach($reviewlist as $list){ ?>
							<tr>
								<td><?php echo isset($this->config->item('reviewtype')[$list['reviewtype']]) ? $this->config->item('reviewtype')[$list['reviewtype']] : ''; ?></td>
								<td><?php echo $list['statementname']; ?></td>
								<td><?php echo $list['reference']; ?></td>
								<td><?php echo $list['comments']; ?></td>
								<td>
									<?php 
										$filelist = array_filter(explode(',', $list['file'])); 
										foreach($filelist as $file){
									?>
											<img src="<?php echo base64conversion(base_url().'assets/uploads/auditor/statement/'.$file); ?>" width="50">
									<?php
										}
									?>
								</td>
							</tr>
						<?php } ?>      
					</tbody>                            
				</table>
			</td>
		</tr>
	</tbody>
</table>