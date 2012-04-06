<?php $this->includeJs(PF_ROOT_URL.'/app/libs/js/global.js'); ?>
<?php $this->includeCss(PF_ROOT_URL.'/app/css/global.css'); ?>

<?php $this->renderElement('jsglobalvars'); ?>

<?php 
	// automatically attach the js/css file for this controller
	// if they exist. Find the controller name by backtracing.
	$backtrace = debug_backtrace();
	
	$path = substr($backtrace[4]['class'],10,-11);
	$path .= '/'.$backtrace[4]['function'];
	$path = strtolower($path);
	
	$this->includeJs(PF_ROOT_URL.'/app/pages/'.$path.'/js.js');
	$this->includeCss(PF_ROOT_URL.'/app/pages/'.$path.'/css.css');
?>

