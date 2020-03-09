<?php
	$cocid 					= isset($result['id']) ? $result['id'] : '';
	$plumberid 				= isset($result['u_id']) ? $result['u_id'] : '';
	$auditorid 				= isset($result['auditorid']) ? $result['auditorid'] : '';
	$auditcomplete 			= isset($result['as_auditcomplete']) ? $result['as_auditcomplete'] : '';
	
	$chatfilepath			= base_url().'assets/uploads/chat/'.$cocid.'/';
	$pdfimg 				= base_url().'assets/images/pdf.png';
	
	if($pagetype=='action'){
		$pagetype 		= '1';
	}else if($pagetype=='view'){
		$pagetype 		= '2';
	}
?>

<link href="<?php echo base_url().'assets/css/style.min.css'; ?>" rel="stylesheet">
<link href="<?php echo base_url().'assets/css/custom.css?vers=2.0'; ?>" rel="stylesheet">
<script src="<?php echo base_url().'assets/plugins/jquery/jquery-3.2.1.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/custom.js'; ?>"></script>

<div class="row">
	<div class="col-12">
		<h4 class="card-title">Chat (History)</h4>
		<div class="card">
			<div class="chatcontent" id="chatcontent"></div>
			<?php if(($pagetype=='1' && $roletype=='5') || ($pagetype=='2' && $roletype=='3' && $auditcomplete!='1')){ ?>
				<div class="chatfooter">
					<div class="input-group">
						<input type="text" class="form-control" id="chattext" placeholder="Type your message here">
						<div class="input-group-append">
							<span class="input-group-text">
								<i class="fa fa-paperclip" id="chatattachment"></i>
								<input type="file" name="file" class="displaynone" id="chatattachmentfile">
							</span>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>


<script type="text/javascript">
var roletype 	= '<?php echo $roletype; ?>';
var chatpath 	= '<?php echo $chatfilepath; ?>';
var pdfimg		= '<?php echo $pdfimg; ?>';
var cocid 		= '<?php echo $cocid; ?>';
var plumberid 	= '<?php echo $plumberid; ?>';
var auditorid 	= '<?php echo $auditorid; ?>';
var fromid		= (roletype=='3') ? plumberid : auditorid;
var toid		= (roletype=='3') ? auditorid : plumberid;

$(function(){
	chat(['#chattext', '#chatcontent'], [cocid, fromid, toid], [chatpath, pdfimg]);
})
</script>