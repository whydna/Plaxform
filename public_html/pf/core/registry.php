<?php

// See "registry pattern"
class Pf_Core_Registry extends Pf_Core_Object
{
	private static $instance = null;
	private $items; 
	
    public static function getInstance()
    {
		if (!isset(self::$instance)) {
              self::$instance = new Pf_Core_Registry();
          }

          return self::$instance;
    }
    
    public function __construct()
    {
    	$this->items = array();
    }
    
    public function get($key)
    {
    	return $this->items[$key];
    }
    
	public function isRegistered($key)
	{
		if (array_key_exists($key, $this->items)) {
			return true;
		} else {
			return false;
		}
	}
		
	public function register($key, $value)
	{
		$this->items[$key] = $value;
	}
	
	public function unregister($key)
	{
		unset($this->items[$key]);
	}
}