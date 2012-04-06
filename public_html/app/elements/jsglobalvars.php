<script type="text/javascript">
	var PF_ROOT_URL = '<?=PF_ROOT_URL?>'; 

	var GET = new Array();
	<?php foreach ($_GET as $key => $val) { ?>
		<?php if (is_numeric($val)) { ?>
			GET['<?=$key?>'] = <?=$val?>;
		<?php } else { ?>
			GET['<?=$key?>'] = '<?=$val?>';
		<?php } ?>
	<?php } ?>
	
</script>