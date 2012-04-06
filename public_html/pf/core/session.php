<?php
/**
 * Plaxform Rapid Development Framework
 * Copyright (c) 2008, Andory Internet Ventures (http://www.andory.com)
 */

/**
 * Simple wrapper class of standard PHP SESSION's
 * 
 * Implements a basic session handler using the singleton pattern
 */
class Pf_Core_Session
{
    /**
     * Instance of a session
     *
     * @access public
     * @var mixed $instance
     */
    private static $instance = null;
    
    /**
     * The session Id
     *
     * @var string $sessionId
     */
    private $sessionId = null;
    
    /**
     * Returns session instance, implements the singleton pattern
     *
     * @access public
     * @return mixed The session instance
     */
    public static function getInstance()
    {
          if (!isset(self::$instance)) {
              self::$instance = new Pf_Core_Session();
          }

          return self::$instance;
    }
    
    /**
     * Constructor, starts the session
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        session_start();
        $this->sessionId = session_id();
    }
    
    /**
     * Destroys a session
     *
     * @access public
     * @return void
     */
    public function destroy()
    {
        foreach ($_SESSION as $key) {
            $_SESSION[$key] = null;
        }
        
        session_destroy();
    }
    
    /**
     * Overrides and disables the __clone() method
     * 
     * @access public
     * @return void
     */
    public function __clone()
    {
        throw new Exception("Cloning is not allowed for: ".__CLASS__);
    }
    
    /**
     * Gets a session variables value
     *
     * @access public
     * @param string $key
     * @return string The value of the session variable
     */
    public function get($key)
    {
        return $_SESSION[$key];
    }
    
    /**
     * Sets a new session variable
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
	
	public function delete($key)
	{
		$_SESSION[$key] = null;
	}
	
    /**
     * Destructor, ends the session
     *
     * @access public
     * @return void
     */
    public function __destruct()
    {
        session_write_close();
    }

}

?>