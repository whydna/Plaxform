<?php
/**
 * Plaxform Rapid Development Framework
 * Copyright (c) 2008, Andory Internet Ventures (http://www.andory.com)
 */

/**
 * Simple wrapper class of standard PHP COOKIE's
 * 
 * Implements a basic cookie handler using the singleton pattern
 */
class Pf_Core_Cookie
{
    private static $instance = null;
    
    public static function getInstance()
    {
          if (!isset(self::$instance)) {
              $className = __CLASS__;
              self::$instance = new $className;
          }

          return self::$instance;
    }
        
    public function get($key)
    {
    	return unserialize($_COOKIE[$key]);
    }
    
    public function set($key, $value, $expire = 0)
    {
    	setcookie($key, serialize($value), $expire, '/');
    }
	
	public function delete($key)
	{
		setcookie($key, '', time()-3600, '/');
	}
}

?>