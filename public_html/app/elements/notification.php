<?php if($this->notification->get() != null) { ?>
	<script type="text/javascript">
		showNotification(
			'<?=$this->notification->getType()?>',
			'<?=addslashes($this->notification->getMessage())?>'
		);
	</script>
	<?php $this->notification->clear(); ?>
<?php } ?>