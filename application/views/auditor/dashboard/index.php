<?php

$openaudits			= $history['openaudits'];
$total 				= $history['total'];
$refixincomplete 	= $history['refixincomplete'];
$refixcomplete 		= $history['refixcomplete'];
$compliment 		= $history['compliment'];
$cautionary 		= $history['cautionary'];
$noaudit 			= $history['noaudit'];

$refixincompletepercentage 	= ($refixincomplete!=0) ? round(($refixincomplete/$total)*100,2).'%' : '0%'; 
$refixcompletepercentage 	= ($refixcomplete!=0) ? round(($refixcomplete/$total)*100,2).'%' : '0%'; 
$complimentpercentage 		= ($compliment!=0) ? round(($compliment/$total)*100,2).'%' : '0%'; 
$cautionarypercentage 		= ($cautionary!=0) ? round(($cautionary/$total)*100,2).'%' : '0%'; 
$noauditpercentage 			= ($noaudit!=0) ? round(($noaudit/$total)*100,2).'%' : '0%'; 

?>

<style>
.circle{
  width:100%;
  border-radius:50%;
  text-align:center;
  font-size: 12px;
  padding:50% 0;
  line-height:0;
  position:relative;
  color: white;
  margin-bottom:5px;
  box-shadow: 2px 2px 3px 0px #afabab;
  font-family: Helvetica, Arial Black, sans;
}
.unread{
	width: 100px;
    height: 91px;
    font-size: 21px;
    padding: 30px 0px;
    text-align: center;
    position: relative;
    background-image: url("<?php echo base_url().'assets/images/unread.png'; ?>");
    background-repeat: no-repeat;
    color: white;
}

</style>

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Dashboard</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Home</li>
			</ol>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				<div class="row">
					<div class="col-md-12 message_sec">
						<div class="cus_msg">
						<p>My Audit Finding History as a No</p>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group coc_pur_sec">
								<div class="circle" style="background-color: #385723;"><?php echo $total;?></div>
								<label style="font-size: 9px;font-weight: 600;">Total Number of Audit Findings</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group coc_pur_sec">
								<div class="circle" style="background-color: #548235;"><?php echo $noaudit;?></div>
								<label style="font-size: 9px;font-weight: 600;">Total Number of No Audit Findings</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group coc_pur_sec">
								<div class="circle" style="background-color: #6da945;"><?php echo $cautionary;?></div>
								<label style="font-size: 9px;font-weight: 600;">Cautionary Audit Findings</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group coc_pur_sec">
								<div class="circle" style="background-color: #a9d18e;"><?php echo $refixincomplete;?></div>
								<label style="font-size: 9px;font-weight: 600;">Refix (In -Complete) Audit Findings</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group coc_pur_sec">
								<div class="circle" style="background-color: #bedeaa;"><?php echo $refixcomplete;?></div>
								<label style="font-size: 9px;font-weight: 600;">Refix (Complete) Audit Findings</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group coc_pur_sec">
								<div class="circle" style="background-color: #c5e0b4;"><?php echo $compliment;?></div>
								<label style="font-size: 9px;font-weight: 600;">Compliment Audit Findings</label>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>

				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3 cpd_section_sec">
								<div class="cpd_points_sec">
									<p class="cus_my_cpd">My Open Audits</p>
									<div class="text-center">
										<img src="<?php echo base_url().'assets/images/search.png'; ?>" alt=""> 
										<input data-plugin="knob" data-width="200" data-height="200" data-min="0" data-thickness="0.2" data-fgColor="#ff0000" data-angleOffset=-125 data-angleArc=250 value="<?php echo $openaudits; ?>" readonly/>
									</div>
								</div>
							</div>
							<div class="col-md-7 coc_sectiom_cus">
								<div class="coc_sec">
									<p class="cus_my_coc">My Audit Finding History as a %</p>
									<div id="auditpie" style="width:100%; height:400px;"></div>
								</div>
							</div>
							<div class="col-md-2 message_sec" style="height:157px">
								<div class="cus_msg">
									<p>Un read Chats</p>
									<div class="unread"><?php echo $unread_chat;?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8">
						<div class="col-md-12 message_sec">
							<div class="cus_msg">
								<p>My Pirb Messages</p>
								<?php 
									$data 	= $this->db->where("groups='3' AND status='1'")->get('messages')->result_array();
									$msg 	= "";
									foreach ($data as $key => $value) {
										$currentDate = date('Y-m-d');
										$startdate   = date('Y-m-d',strtotime($value['startdate']));
										$enddate = date('Y-m-d',strtotime($value['enddate']));
										if ($currentDate>= $startdate && $currentDate<=$enddate){
											$msg = $msg.$value['message'].'</br></br>'; 
										}
									}
									
									echo '<div class="col-md-12">'.$msg.'</div>';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var openaudits 		= '<?php echo $openaudits; ?>';
	var total 			= '<?php echo $total; ?>';
	var refixincomplete = '<?php echo $refixincomplete; ?>';
	var refixcomplete 	= '<?php echo $refixcomplete; ?>';
	var compliment 		= '<?php echo $compliment; ?>';
	var cautionary 		= '<?php echo $cautionary; ?>';
	var noaudit 		= '<?php echo $noaudit; ?>';

	$(function(){
		
		piechart(
			'auditpie',
			{
				name : 'Audit',
				xaxis : [
					'Compliments',
					'Cautionary',
					'Refix (Complete)',
					'Refix(In Complete)',
					'No Audit'
				],
				yaxis : [
					{value : compliment, name : 'Compliments'},
					{value : cautionary, name : 'Cautionary'},
					{value : refixcomplete, name : 'Refix (Complete)'},
					{value : refixincomplete, name : 'Refix(In Complete)'},
					{value : noaudit, name : 'No Audit'}
				],
				colors : ['#843C0C','#FF0000','#ED7D31','#333F50','#4472C4']				
			}
		)

		knobchart();
		gaugechart(
			'performancechart',
			{
				name : 'Performance Chart',
				data : [{value: openaudits, name: ''}],
				colors : [[0.2, '#55ce63'],[0.5, '#FBB596'],[0.8, '#009efb'],[1, '#f62d51']]
				
			}
		);
		
	});
</script>
