<?php 
class App_Tools_ViewHelper extends Pf_Core_View
{
	public function evalViewElement($element, Array $data = array())
	{
		ob_start();
		eval('?>'.file_get_contents(PF_ROOT_PATH.'/app/elements/'.$element.'.php').'<?');
		$content = $eval_buffer = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}
}

?>