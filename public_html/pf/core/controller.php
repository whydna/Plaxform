<?php
abstract class Pf_Core_Controller extends Pf_Core_Object
{
	protected $session = null;
	protected $cookie = null;
	
	protected $view = null;
	
	protected $user = null;
	protected $notification = null;
	
    public function __construct()
    {
        parent::__construct(); 

        // setup the session and cookie handler
        $this->session = Pf_Core_Session::getInstance();
		$this->cookie = Pf_Core_Cookie::getInstance();
		
		$this->view = new Pf_Core_View();
		
		$this->user = Pf_Core_User::getInstance();
		$this->notification = Pf_Core_Notification::getInstance();
    }
	
    protected function redirect($url)
    {
        header("location:".$url);
        exit();
    }
	
	// Runs a controller in a seperate thread.
	protected function createThread($controllerUrl)
	{
		return new Pf_Core_Thread($controllerUrl);
	}
}
?>