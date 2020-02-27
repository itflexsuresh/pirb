<?php 
if($roletype=='1') $url = 'admin/audits/index/';
elseif($roletype=='5') $url = 'auditor/auditstatement/index/';
?>

<div>
	<a href="<?php echo base_url().$url.'history/'.$id; ?>">Plumber Audit History</a>
	<a href="<?php echo base_url().$url.'view/'.$id; ?>">Audit Review</a>
	<a href="<?php echo base_url().$url.'diary/'.$id; ?>">Diary/Comments</a>
</div>