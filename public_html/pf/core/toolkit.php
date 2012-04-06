<?php
class Pf_Core_Toolkit extends Pf_Core_Object
{	
	public static function getDebugger()
	{
		if (Pf_Core_Registry::getInstance()->isRegistered('debug') == false) {
			Pf_Core_Registry::getInstance()->register('debug', new Pf_Tools_Debug());
		}
		
		return Pf_Core_Registry::getInstance()->get('debug');
	}
	
	public static function getLogger()
	{
		if (Pf_Core_Registry::getInstance()->isRegistered('log') == false) {
			$config = Pf_Core_Configuration::getValues();
			Pf_Core_Registry::getInstance()->register('log', new Pf_Tools_Log($config['paths']['logsDir']));
		}
		
		return Pf_Core_Registry::getInstance()->get('log');
	}
	
	public static function getBenchmark()
	{
		if (Pf_Core_Registry::getInstance()->isRegistered('benchmark') == false) {
			Pf_Core_Registry::getInstance()->register('benchmark', new Pf_Tools_Benchmark());
		}
		
		return Pf_Core_Registry::getInstance()->get('benchmark');
	}
	
	public static function getSnoopy()
	{
		if (Pf_Core_Registry::getInstance()->isRegistered('snoopy') == false) {
			Pf_Core_Registry::getInstance()->register('snoopy', new Pf_Tools_Snoopy());
		}
		
		return Pf_Core_Registry::getInstance()->get('snoopy');
	}
}