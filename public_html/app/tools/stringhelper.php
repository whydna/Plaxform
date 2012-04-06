<?php 
class App_Tools_StringHelper
{
    public static function replaceAccents($string)
    {
        $search = explode(",","�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,e,i,�,u");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
        return str_replace($search, $replace, $string);
    }    
	
	// this function cleans a string by removing
	// leading and trailing spaces, and removing
	// new lines.
	public static function cleanString($string)
	{
		return trim(str_replace(array("\r", "\r\n", "\n"), '', $string));
	}
	
	public static function stringShorten($text, $numChars) 
	{
		if (strlen($text)<$numChars) {
			return $text;
		}
		
		// this accounts for the '...' at the end
		$numChars = $numChars-3;
		
		//First chop the string to the given character length
    	$text = substr($text, 0, $numChars); 
    	//If there exists any space just before the end of the chopped string take upto that portion only.
    	if(substr($text, 0, strrpos($text, ' '))!='') 
    		$text = substr($text, 0, strrpos($text, ' ')); 
    	//In this way we remove any incomplete word from the paragraph
		$text = $text.'...'; //Add continuation ... sign

    	return $text; //Return the value
	}
}

?>