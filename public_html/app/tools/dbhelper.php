<?php
class App_Tools_DbHelper
{
    // returns a 32 character GUID
    public static function generateGuid()
    {
        return md5(uniqid(rand(),true));
    }

    public static function getDateTime($unixTimestamp = null)
    {
    	if (!$unixTimestamp) {
    		$unixTimestamp = time();
    	}
    	
        return date('Y-m-d H:i:s', $unixTimestamp);     
    }
}
?>