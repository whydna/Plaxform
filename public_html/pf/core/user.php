<?php

class Pf_Core_User
{
	private static $instance = null; 
	
	private $session = null;
	private $cookie = null;

	// implements the singleton pattern
    public static function getInstance()
    {
		if (!isset(self::$instance)) {
              self::$instance = new Pf_Core_User();
          }

          return self::$instance;
    }
	
	public function __construct()
	{
		$this->session = Pf_Core_Session::getInstance();
		$this->cookie = Pf_Core_Cookie::getInstance();
		
		// if session is not set but cookie exists, load it into the session
		if (!$this->session->get('pfUser') && $this->cookie->get('pfUser')) {
			$this->session->set('pfUser', $this->cookie->get('pfUser'));
		}
	}
	
	public function isLoggedIn()
	{
		if ($this->session->get('pfUser')) {
			return true;
		} else {
			return false;
		}
	}
	
	public function login($user, $remember = false)
	{
		$this->session->set('pfUser', $user);
		
		if ($remember == true) {
			// set cookie with expiry time of 1 year
			$this->cookie->set('pfUser', $user, time()+31556926);
		}
	}
	
	public function logout()
	{
		$this->session->delete('pfUser');
		$this->cookie->delete('pfUser');
	}
	
	// sets a field for the logged in user
	public function setLoggedInUser($key, $value) 
	{
		if ($this->isLoggedIn() == true) {
			$user = $this->session->get('pfUser');
			$user[$key] = $value;
			$this->session->set('pfUser',$user);
		}
	}
	
	// if user is logged in will return the user, else will return null
	// If $key is provided, will return that specific field
	public function getLoggedInUser($key = null)
	{
		if ($this->isLoggedIn() == true) {
			$user = $this->session->get('pfUser');
			if ($key) {
				return $user[$key];
			} else {
				return $user;
			}
		} else {
			return null;
		}
	}
}

?>