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

<div>
	<a href="<?php echo base_url().$url.'history/'.$id; ?>">Plumber Audit History</a>
	<a href="<?php echo base_url().$url.$reviewtype.$id; ?>">Audit Review</a>
	<a href="<?php echo base_url().$url.'diary/'.$id; ?>">Diary/Comments</a>
</div>