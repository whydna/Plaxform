<?php
class Pf_Core_View extends Pf_Core_Object
{	
	protected $user = null;
	protected $notification = null;
	
	public function __construct()
	{
		$this->user = Pf_Core_User::getInstance();
		$this->notification = Pf_Core_Notification::getInstance();
	}

	public function render(Array $data = array())
	{	
		// parse the calling controller name and action
		// to get the path to the corresponding view.
		$backtrace = debug_backtrace();
		$layout = substr($backtrace[1]['class'],10,-11);
		$layout .= '/'.$backtrace[1]['function'];
		$layout = strtolower($layout);
		
		require PF_ROOT_PATH.'/app/pages/'.$layout.'/view.php';
	}
	
	protected function renderElement($element, Array $data = array())
	{		
		require PF_ROOT_PATH.'/app/elements/'.$element.'.php';
	}
	
	protected function includeJs($url)
	{
		echo '<script type="text/javascript" src="'.$url.'"></script>';
	}
	
	protected function includeCss($url)
	{		
		echo '<link type="text/css" href="'.$url.'" rel="stylesheet">';
	}
}