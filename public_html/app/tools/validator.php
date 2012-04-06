<?php
class App_Tools_Validator
{
	public static function email($email)
	{
		$regex = '/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i';
		if (preg_match($regex, $email) == true) {
			return true;
		} else{
			return false;
		}
	}
	
	public static function username($username)
	{
		$regex = '/^([a-zA-Z0-9_-]+)$/';
		if (preg_match($regex, $username) == true) {
			return true;
		} else{
			return false;
		}	
	}
	
	public static function url($url)
	{
		$regex = '/^https?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/i';
		if (preg_match($regex, $url) == true) {
			return true;
		} else{
			return false;
		}	
	}
	
	public static function hexColor($hexColor) {
		if(preg_match('/^#[a-f0-9]{6}$/i', $hexColor)) {
			return true;
		} else {
			return false;
		}
	}
}