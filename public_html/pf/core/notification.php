<?php
class Pf_Core_Notification
{
	private static $instance = null;

	private $session = null;
	private static $notificationTypes = array('success', 'error');
	
	// implements the singleton pattern
    public static function getInstance()
    {
		if (!isset(self::$instance)) {
              self::$instance = new Pf_Core_Notification();
          }

          return self::$instance;
    }
	
	public function __construct()
	{
		$this->session = Pf_Core_Session::getInstance();
	}
	
	public function set($type, $message)
	{
		if (in_array($type, self::$notificationTypes) == false) {
			throw new Exception('Invalid notification type');
		}
		
		$this->session->set('PfNotificationType', $type);
		$this->session->set('PfNotificationMessage', $message);
	}
	
	public function get()
	{
		if ($this->getType() != null) {
			return array(
					'type' => $this->getType(),
					'message' => $this->getMessage()
				);
		} else {
			return null;
		}
	}
	
	public function getType()
	{
		return $this->session->get('PfNotificationType');
	}
	
	public function getMessage()
	{
		return $this->session->get('PfNotificationMessage');
	}
	
	public function clear()
	{
		$this->session->delete('PfNotificationType');
		$this->session->delete('PfNotificationMessage');
	}
}
	