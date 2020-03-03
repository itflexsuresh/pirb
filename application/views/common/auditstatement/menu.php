<?php 
$id 			= $result['id'];
$auditcomplete 	= $result['as_auditcomplete'];

if($roletype=='1'){
	$url 		= 'admin/audits/auditstatement/index/';
	$reviewtype = 'view/';
}elseif($roletype=='5'){
	$url 		= 'auditor/auditstatement/index/';
	$reviewtype = ($auditcomplete=='1') ? 'view/' : 'action/';
}
?>

<div class="col-md-12 auditmenu_wrapper">
	<div class="row">
		<div class="col-md-4 auditmenu"><a href="<?php echo base_url().$url.'history/'.$id; ?>">Plumber Audit History</a></div>
		<div class="col-md-4 auditmenu"><a href="<?php echo base_url().$url.$reviewtype.$id; ?>">Audit Review</a></div>
		<div class="col-md-4 auditmenu"><a href="<?php echo base_url().$url.'diary/'.$id; ?>">Diary/Comments</a></div>
	</div>
</div>