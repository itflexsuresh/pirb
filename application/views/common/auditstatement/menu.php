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

$segment5 = $this->uri->segment(5);
?>

<div class="col-md-12 auditmenu_wrapper">
	<div class="row">
		<div class="col-md-4 auditmenu <?php if($segment5=='history'){ echo 'auditmenuactive';} ?>"><a href="<?php echo base_url().$url.'history/'.$id; ?>">Plumber Audit History</a></div>
		<div class="col-md-4 auditmenu <?php if($segment5=='view' || $segment5=='action'){ echo 'auditmenuactive';} ?>"><a href="<?php echo base_url().$url.$reviewtype.$id; ?>">Audit Review</a></div>
		<div class="col-md-4 auditmenu <?php if($segment5=='diary'){ echo 'auditmenuactive';} ?>"><a href="<?php echo base_url().$url.'diary/'.$id; ?>">Diary/Comments</a></div>
	</div>
</div>